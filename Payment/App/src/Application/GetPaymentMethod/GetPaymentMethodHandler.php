<?php

namespace App\Application\GetPaymentMethod;

use App\Domain\PaymentMethod;
use App\Domain\PaymentMethodId;
use App\Domain\PaymentMethodRepositoryInterface;

class GetPaymentMethodHandler
{
    public function __construct(
        private PaymentMethodRepositoryInterface $paymentMethodRepository
    )
    {
    }


    public function handle(GetPaymentMethodQuery $query): PaymentMethod
    {
        return $this->paymentMethodRepository->getPaymentMethod(new PaymentMethodId($query->getId()));

    }
}