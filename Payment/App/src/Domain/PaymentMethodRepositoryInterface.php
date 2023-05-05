<?php

namespace App\Domain;

interface PaymentMethodRepositoryInterface
{
    public function getPaymentMethod(PaymentMethodId $id): PaymentMethod;
}
