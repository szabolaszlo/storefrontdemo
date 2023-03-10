<?php

namespace App\Infrastructure\Persistence\Doctrine\Specification;

use Doctrine\Common\Collections\Criteria;

class DqlHasCartCustomerIdentifierSpecification implements DqlCartSpecification
{
    public function toDqlCriteria(): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->neq('customerIdentifier', null));
    }
}