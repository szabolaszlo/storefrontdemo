<?php

namespace App\Application\GetPaymentQuery;

use App\Application\DTO\PaymentDTO;
use App\Application\Service\PaymentRedirectUrlFactory;
use App\Domain\PaymentRepositoryInterface;

class GetPaymentHandler
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

    public function execute(GetPaymentQuery $query): PaymentDTO
    {
        return new PaymentDTO(

        );
    }

}
