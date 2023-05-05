<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\PaymentMethod;
use App\Domain\PaymentMethodId;
use App\Domain\PaymentMethodRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class PaymentMethodRepository extends ServiceEntityRepository implements PaymentMethodRepositoryInterface
{

    public function getPaymentMethod(PaymentMethodId $id): PaymentMethod
    {
        return $this->find($id);
    }
}
