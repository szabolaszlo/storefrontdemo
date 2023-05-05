<?php

namespace App\Application\GetPaymentMethod;

use App\Domain\PaymentMethodId;

class GetPaymentMethodQuery
{
    public function __construct(
        private string $id
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}