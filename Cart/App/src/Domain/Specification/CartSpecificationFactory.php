<?php

namespace App\Domain\Specification;

use DateTimeImmutable;

interface CartSpecificationFactory
{
    public function createCartCreatedAtInterval(DateTimeImmutable $from, DateTimeImmutable $to): CartSpecification;
    public function createHasCartCustomerIdentifier(): CartSpecification;
    public function createAnd(CartSpecification ...$cartSpecifications): CartSpecification;
}