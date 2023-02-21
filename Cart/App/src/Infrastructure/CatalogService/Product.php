<?php


namespace App\Infrastructure\CatalogService;

use \App\Domain\Product as BaseProduct;

class Product implements BaseProduct
{

    protected $price;

    protected $sku;

    public function __construct($sku, $price)
    {
        $this->price = $price;
        $this->sku = $sku;
    }

    public function getPrice($customerIdentifier)
    {
        if ($customerIdentifier == 12){
            return $this->price *2;
        }
        return $this->price;
    }

    public function getSku()
    {
        return $this->sku;
    }
}