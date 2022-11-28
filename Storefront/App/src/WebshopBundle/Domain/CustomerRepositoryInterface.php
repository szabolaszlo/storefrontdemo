<?php


namespace App\WebshopBundle\Domain;


interface CustomerRepositoryInterface
{
    public function register(Customer $customer): Customer;
}
