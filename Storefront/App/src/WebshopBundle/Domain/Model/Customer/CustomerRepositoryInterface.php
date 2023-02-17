<?php

namespace App\WebshopBundle\Domain\Model\Customer;

interface CustomerRepositoryInterface
{
    public function add(Customer $customer): Customer;
    public function getById(int $id):Customer;
}
