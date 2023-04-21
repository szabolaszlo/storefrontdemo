<?php

namespace App\Domain\Specification;

interface CartSpecification
{
    public function toCriteria(): CriteriaInterface;
}