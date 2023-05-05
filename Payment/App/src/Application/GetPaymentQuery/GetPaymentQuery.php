<?php

namespace App\Application\GetPaymentQuery;

class GetPaymentQuery
{
    private string $paymentId;

    public function __construct(string $paymentId) {
        $this->paymentId = $paymentId;
    }

    public function getPaymentId(): string {
        return $this->paymentId;
    }
}
