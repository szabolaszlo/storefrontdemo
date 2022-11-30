<?php


namespace App\WebshopBundle\Application\CreateCustomer;


use App\WebshopBundle\Domain\Customer;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;


class CreateCustomerHandler
{

    protected $customerService;

    public function __construct(CustomerRepositoryInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function __invoke(CreateCustomerCommand $command)
    {
        $customer = new Customer();
        $customer->setEmail($command->getEmail());
        $customer->setFirstName($command->getFirstname());
        $customer->setLastName($command->getLastname());
        $customer->setPassword($command->getPassword());
        $customer->setNewsletterSubscriptionId($command->getNewsletterId());


        $customer = $this->customerService->register($customer);
        return $customer;
    }
}