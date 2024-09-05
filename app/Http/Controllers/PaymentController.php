<?php

namespace App\Http\Controllers;

use App\Services\Payments\PaymentService;

class PaymentController extends Controller
{
    /**
     * @throws \Exception
     */
    public function payment(PaymentService $paymentService)
    {
        $payPal = $paymentService->setPaymentService('PayPal');
        $stripe = $paymentService->setPaymentService('Stripe');
        $paymentService->makePayment($payPal);
        $paymentService->makePayment($stripe);
    }
}
