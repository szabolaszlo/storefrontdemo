<?php


namespace App\WebshopBundle\Infrastructure\CustomerService;


interface TokenProviderInterface
{
    public function getAccessToken();
}