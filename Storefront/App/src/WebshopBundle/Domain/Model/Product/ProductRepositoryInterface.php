<?php

namespace App\WebshopBundle\Domain\Model\Product;

interface ProductRepositoryInterface
{
    /**
     * @return Product[]
     */
    public function getProducts(): array;
}