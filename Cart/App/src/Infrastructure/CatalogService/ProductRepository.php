<?php


namespace App\Infrastructure\CatalogService;


use App\Domain\ProductRepository as BaseRepository;

class ProductRepository implements BaseRepository
{

    public function findBySku($sku)
    {
        return new Product($sku,100);
    }
}