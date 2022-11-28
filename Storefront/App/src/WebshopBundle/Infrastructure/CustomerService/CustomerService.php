<?php


namespace App\WebshopBundle\Infrastructure\CustomerService;


use App\WebshopBundle\Domain\Customer;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;

class CustomerService implements CustomerRepositoryInterface
{


    public function register(Customer $customer): Customer
    {
        $customer->setId(1);
        return $customer;
    }
}