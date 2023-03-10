<?php

namespace App\Infrastructure\Persistence\Doctrine\Specification;

use App\Domain\Specification\CartSpecification;
use Doctrine\Common\Collections\Criteria;

interface DqlCartSpecification extends CartSpecification
{
    public function toDqlCriteria(): Criteria;
}