<?php

namespace App\WebshopBundle\Application\CustomerSpace\Dto;

use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;
use function count;

class ProductCatalogToCustomerSpace implements IteratorAggregate, Countable, JsonSerializable
{
    public function __construct(
        private array $products
    )
    {}

    public function getIterator(): Traversable
    {
        yield from $this->products;
    }

    public function count(): int
    {
        return count($this->products);
    }

    public function jsonSerialize(): mixed
    {
        return $this->products;
    }
}