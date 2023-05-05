<?php

namespace App\Infrastructure\Persistence\Doctrine\GetCheckoutPaymentMethodListQueryService;

use App\Application\GetCheckoutPaymentMethodList\QueryServiceInterface;
use App\Domain\PaymentMethod;
use App\Domain\PaymentMethodId;
use App\Domain\ShippingMethodId;
use Doctrine\ORM\EntityManagerInterface;

class GetCheckoutPaymentMethodListQueryService implements QueryServiceInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCheckoutPaymentMethodListByShippingMethodId(ShippingMethodId $id):array
    {
        $paymentMethods = $this
            ->entityManager
            ->getRepository(PaymentMethod::class)
            ->findAll();

        //Filter payment methods by shipping method id

        return $paymentMethods;
    }
}
