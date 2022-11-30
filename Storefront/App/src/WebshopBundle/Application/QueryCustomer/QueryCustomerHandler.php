<?php


namespace App\WebshopBundle\Application\QueryCustomer;


use App\WebshopBundle\Domain\CustomerRepositoryInterface;
use App\WebshopBundle\Infrastructure\CustomerService\CustomerService;

class QueryCustomerHandler
{

    protected $customerService;

    public function __construct(CustomerRepositoryInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function __invoke(QueryCustomerCommand $command)
    {
        return $this->customerService->getById($command->getId());

    }
}