<?php

namespace App\Infrastructure\Persistence\Doctrine\Specification;

use App\Domain\Specification\AbstractAndCartSpecification;
use Doctrine\Common\Collections\Criteria;

class DqlCartAndSpecification extends AbstractAndCartSpecification implements DqlCartSpecification
{

    public function toDqlCriteria(): Criteria
    {
        $criteria = Criteria::create();

        foreach ($this->specifications as $specification) {
            $criteria->andWhere($specification->toDqlCriteria()->getWhereExpression());
        }

        return $criteria;
    }
}