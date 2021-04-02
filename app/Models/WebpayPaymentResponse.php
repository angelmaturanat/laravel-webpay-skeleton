<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebpayPaymentResponse extends Model
{
    use HasFactory;

    protected $table = 'webpay_payment_response';

    /**
     * Get the purchase attempt
     */
    public function purchaseAttempt()
    {
        return $this->belongsTo(PurchaseAttempt::class);
    }
}
