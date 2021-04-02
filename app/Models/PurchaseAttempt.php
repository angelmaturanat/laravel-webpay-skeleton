<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseAttempt extends Model
{
    use HasFactory;

    protected $table = 'purchase_attempt';

    /**
     * Get the webpay payment response
     */
    public function webpayPaymentResponse()
    {
        return $this->hasMany(WebpayPaymentResponse::class);
    }
}
