<?php

namespace App\WebshopBundle\Domain\Model\Product;

class Product
{

    public function __construct(
        private int $id,
        private string $name,
        private string $description,
        private float $netPrice,
        private float $vat,
        private float $grossPrice,
        private string $sku,
    )
    {
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getNetPrice(): float
    {
        return $this->netPrice;
    }

    public function getGrossPrice(): float
    {
        //return $this->price * (1 + $this->vat / 100);
        return $this->grossPrice;
    }
}