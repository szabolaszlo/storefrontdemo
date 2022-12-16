<?php

namespace App\WebshopBundle\Domain;

interface CustomerRepositoryInterface
{
    public function add(Customer $customer): Customer;
    public function getById(int $id):Customer;
    public function getByEmail(string $email): ?Customer;
    public function authenticate(string $email, string $password): ?Customer;
}
