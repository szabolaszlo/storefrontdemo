<?php

namespace App\Infrastructure\Persistence\Doctrine\GetCheckoutPaymentMethodListQueryService;

use App\Application\GetCheckoutPaymentMethodList\QueryServiceInterface;
use App\Domain\ShippingMethodId;
use Doctrine\ORM\EntityManagerInterface;

class GetCheckoutPaymentMethodListQueryService implements QueryServiceInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCheckoutPaymentMethodListByShippingMethodId(ShippingMethodId $id): array
    {
        $this->entityManager
            ->getRepository('App:PaymentMethod')
            ->findBy(['shippingMethodId' => $id]);
    }
}
