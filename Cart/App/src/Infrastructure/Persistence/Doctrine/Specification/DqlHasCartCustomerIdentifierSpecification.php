<?php

namespace App\Infrastructure\Persistence\Doctrine\Specification;

use App\Domain\Specification\CartSpecification;
use App\Domain\Specification\CriteriaInterface;

class DqlHasCartCustomerIdentifierSpecification implements CartSpecification
{
    public function toCriteria(): CriteriaInterface
    {
        return DoctrineCriteria::create()
            ->andWhere(DoctrineCriteria::expr()->neq('customerIdentifier', null));
    }
}