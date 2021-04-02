<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;

use App\Models\PurchaseAttempt;
use App\Models\WebpayPaymentResponse;

class WebPayController extends Controller
{
    private $provider = 'WEBPAY';


    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_cc'), config('services.transbank.webpay_plus_api_key'));
        } else {
            WebpayPlus::configureForTesting('597035769625', '0b12a12a7ec72992cf1f557042c4fa9b');
        }
    }

    public function index()
    {
        $webpay_request = [
            "buy_order" => rand(10000, 999999),
            "session_id" => rand(1000, 9999),
            "return_url" => route('webpay.plus.response')
        ];

        return view('webpay/create', [
            "params" => $webpay_request
        ]);
    }

    public function init(Request $request)
    {
        $webpay_request = [
            "buy_order" => $request->buy_order,
            "session_id" => $request->session_id,
            "amount" => $request->amount,
            "return_url" => route('webpay.plus.response')
        ];

        $webpay_response = WebpayPlus\Transaction::create(
            $webpay_request["buy_order"],
            $webpay_request["session_id"],
            $webpay_request["amount"],
            $webpay_request["return_url"]
        );

        $this->saveTrasactionAttempt($webpay_response, $request);

        return view('webpay/confirmation', [
            "params" => $webpay_request,
            "response" => $webpay_response
        ]);
    }

    public function response(Request $request)
    {
        $webpay_request = $request->except('_token');
        $webpay_response = WebpayPlus\Transaction::commit($webpay_request["token_ws"]);

        $this->updateTrasactionAttempt($webpay_request["token_ws"], $webpay_response);

        return view('webpay/committed', ["resp" => $webpay_response, 'req' => $webpay_request]);
    }

    private function updateTrasactionAttempt($token, $webpay)
    {
        $purchase_attempt = PurchaseAttempt::where('token', $token)->first();
        $purchase_attempt->status = $webpay->getStatus();
        $purchase_attempt->save();

        $this->saveWebPaymentResponse($webpay, $purchase_attempt->id);

        return $purchase_attempt;
    }

    private function saveTrasactionAttempt($webpay, Request $request)
    {
        $purchase_attempt = new PurchaseAttempt;
        $purchase_attempt->token = $webpay->getToken();
        $purchase_attempt->status = 'ATTEMPT';
        $purchase_attempt->payment_provider = $this->provider;
        $purchase_attempt->amount = $request->amount;
        
        $purchase_attempt->save();
    }

    private function saveWebPaymentResponse($webpay_response, $purchase_attempt_id)
    {
        $webpay_payment_response = new WebpayPaymentResponse();

        $webpay_payment_response->purchase_order = $webpay_response->buyOrder;
        $webpay_payment_response->vci = $webpay_response->vci;
        $webpay_payment_response->amount = $webpay_response->amount;
        $webpay_payment_response->status = $webpay_response->status;
        $webpay_payment_response->sessionId = $webpay_response->sessionId;
        $webpay_payment_response->cardDetail = json_encode($webpay_response->cardDetail);
        $webpay_payment_response->cardDetail_card_number = $webpay_response->cardDetail["card_number"];
        $webpay_payment_response->accountingDate = $webpay_response->accountingDate;
        $webpay_payment_response->transactionDate = date_format(date_create($webpay_response->transactionDate),"Y-m-d H:i:s");
        $webpay_payment_response->authorizationCode = $webpay_response->authorizationCode;
        $webpay_payment_response->paymentTypeCode = $webpay_response->paymentTypeCode;
        $webpay_payment_response->responseCode = $webpay_response->responseCode;
        $webpay_payment_response->installmentsAmount = $webpay_response->installmentsAmount ?? "";
        $webpay_payment_response->installmentsNumber = $webpay_response->installmentsNumber;
        $webpay_payment_response->balance = $webpay_response->balance ?? "";
        $webpay_payment_response->purchase_attempt_id = $purchase_attempt_id;

        return $webpay_payment_response->save();
    }
}
