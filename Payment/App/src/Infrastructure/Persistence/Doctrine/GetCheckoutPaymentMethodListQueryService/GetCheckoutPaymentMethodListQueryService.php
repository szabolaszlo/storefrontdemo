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
        return [$this->entityManager
            ->getRepository(PaymentMethod::class)
            ->find(new PaymentMethodId('8b16ce29-eb46-11ed-83b7-0242ac1d000a'))];
    }
}
