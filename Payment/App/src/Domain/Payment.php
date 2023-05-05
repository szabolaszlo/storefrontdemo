<?php

namespace App\Domain;

class Payment
{
    private PaymentId $paymentId;

    private PaymentMethodId $paymentMethodId;

    private Customer $customer;

    private float $amount;

    /**
     * @TODO enumnak kellene lennie
     */
    private string $status;

    private string $redirectUrl;
}
