<?php

namespace App\WebshopBundle\Domain\Model\Cart;

class Item
{
    public function __construct(
        private int $id,
        private string $sku,
        private int $quantity,
        private float $price,
        private float $total
    )
    {
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}