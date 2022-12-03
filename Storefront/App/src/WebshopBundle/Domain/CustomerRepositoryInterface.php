<?php


namespace App\WebshopBundle\Domain;


interface CustomerRepositoryInterface
{
    public function add(Customer $customer): Customer;

    public function getById($id):Customer;
}
