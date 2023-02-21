<?php


namespace App\Domain;


interface Product
{

    public function getPrice($customerIdentifier);

    public function getSku();
}