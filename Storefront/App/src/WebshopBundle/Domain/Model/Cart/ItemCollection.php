<?php

namespace App\WebshopBundle\Domain\Model\Cart;

use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

class ItemCollection implements IteratorAggregate, Countable, JsonSerializable
{

    public function __construct(
        private array $items
    )
    {}

    public function getIterator(): Traversable
    {
        yield from $this->items;
    }

    public function count(): int
    {
        return  count($this->items);
    }

    public function jsonSerialize(): mixed
    {
        return $this->items;
    }
}