<?php


namespace App\WebshopBundle\Application\RegisterCustomer;


use App\WebshopBundle\Domain\Customer;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;

class RegisterCustomerHandler
{

    protected $customerService;

    public function __construct(CustomerRepositoryInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function __invoke(RegisterCustomerCommand $command)
    {
        $customer = new Customer();
        $customer->setEmail($command->getEmail());
        $customer->setFirstName($command->getFirstname());
        $customer->setLastName($command->getLastname());
        $customer->setPassword($command->getPassword());

        return $this->customerService->register($customer);
    }
}