<?php

namespace App\Application\CreatePayment;

use App\Domain\PaymentRepositoryInterface;

class CreatePaymentHandler
{
    private PaymentRepositoryInterface $paymentRepository;

    public function __construct(
        PaymentRepositoryInterface $paymentRepository,
    ) {

    }

    public function execute(CreatePaymentCommand $command): string {

    }
}
