<?php

namespace App\Services\Payments;

use App\Contracts\Payment;

class PayPalService implements Payment
{
    public function payment(): bool
    {
        return true;
    }
}
