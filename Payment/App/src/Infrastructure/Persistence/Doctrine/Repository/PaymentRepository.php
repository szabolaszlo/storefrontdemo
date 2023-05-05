<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Payment;
use App\Domain\PaymentId;
use App\Domain\PaymentMethod;
use App\Domain\PaymentMethodId;
use \App\Domain\PaymentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PaymentRepository extends ServiceEntityRepository implements PaymentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentMethod::class);
    }

    public function get(PaymentId $id): Payment
    {
        return $this->find($id);
    }
}
