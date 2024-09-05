<?php

namespace App\Services\Payments;

use App\Contracts\Payment;

class PaymentService
{
    public function makePayment(Payment $paymentSystem): bool
    {
        return $paymentSystem->payment();
    }

    /**
     * @throws \Exception
     */
    public function setPaymentService(string $paymentService): object
    {
        $paymentService = 'App\Services\Payments\\'.$paymentService.'Service';

        if (class_exists($paymentService)) {
            return new $paymentService();
        }

        throw new \Exception('Payment service not found');
    }
}
