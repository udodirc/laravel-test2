<?php

namespace App\Services\Payments;

use App\Contracts\Payment;

class StripeService implements Payment
{
    public function payment(): bool
    {
        return true;
    }
}
