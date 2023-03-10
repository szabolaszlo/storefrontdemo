<?php


namespace App\Domain;


interface ProductRepository
{
    public function findBySku($sku): Product;
}