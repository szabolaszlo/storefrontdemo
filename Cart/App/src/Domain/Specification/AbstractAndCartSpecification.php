<?php

namespace App\Domain\Specification;

abstract class AbstractAndCartSpecification implements CartSpecification
{
    /**
     * @var CartSpecification[]
     */
    protected $specifications;

    public function __construct(CartSpecification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function addCartSpecification(CartSpecification $cartSpecification): void
    {
        $this->specifications[] = $cartSpecification;
    }
}
