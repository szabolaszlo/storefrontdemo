<?php

namespace App\Domain;

interface PaymentRepositoryInterface
{
    public function get(PaymentId $id): Payment;
}
