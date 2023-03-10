<?php

namespace App\Infrastructure\Persistence\Doctrine\Specification;

use App\Domain\Specification\AbstractAndCartSpecification;
use App\Domain\Specification\CriteriaInterface;

class DqlCartAndSpecification extends AbstractAndCartSpecification
{
    public function toCriteria(): CriteriaInterface
    {
        $criteria = DoctrineCriteria::create();

        foreach ($this->specifications as $specification) {
            $criteria->andWhere($specification->toCriteria()->getWhereExpression());
        }

        return $criteria;
    }
}