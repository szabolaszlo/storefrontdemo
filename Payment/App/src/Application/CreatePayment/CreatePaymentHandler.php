<?php

namespace App\Application\CreatePayment;

use App\Application\Service\PaymentRedirectUrlFactory;
use App\Domain\Payment;
use App\Domain\PaymentId;
use App\Domain\PaymentMethodId;
use App\Domain\PaymentRepositoryInterface;

class CreatePaymentHandler
{
    private PaymentRepositoryInterface $paymentRepository;

    private PaymentRedirectUrlFactory $redirectUrlFactory;

    public function __construct(
        PaymentRepositoryInterface $paymentRepository,
        PaymentRedirectUrlFactory $redirectUrlFactory
    ) {
        $this->paymentRepository = $paymentRepository;
        $this->redirectUrlFactory = $redirectUrlFactory;
    }

    public function execute(CreatePaymentCommand $command) {
        $payment = new Payment();

        $payment->setPaymentId(
            new PaymentId($command->getPaymentId())
        );

        $payment->setPaymentMethodId(
            new PaymentMethodId($command->getPaymentMethodId())
        );

        $payment->setAmount($command->getAmount());
        $payment->setCustomer($command->getCustomer());
        $payment->setStatus($command->getInitialState());
        $payment->setRedirectUrl(
            $this->redirectUrlFactory->createRedirectUrl($command->getPaymentId(), $command->getPaymentMethodId())
        );

        $this->paymentRepository->add($payment);
    }
}
