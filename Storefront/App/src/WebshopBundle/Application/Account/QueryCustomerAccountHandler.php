<?php


namespace App\WebshopBundle\Application\Account;


use App\WebshopBundle\Application\Account\QueryCustomerAccountResponse;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;
use App\WebshopBundle\Domain\NewsletterSubscriberRepositoryInterface;
use App\WebshopBundle\Infrastructure\CustomerService\CustomerService;

class QueryCustomerAccountHandler
{

    protected $customerService;
    protected $subscriberService;

    public function __construct(CustomerRepositoryInterface $customerService, NewsletterSubscriberRepositoryInterface $subscriberService)
    {
        $this->customerService = $customerService;
        $this->newsletterService = $subscriberService;
    }

    public function __invoke(QueryCustomerAccountCommand $command)
    {
        $customer = $this->customerService->getById($command->getId());
        $subscriber = $this->newsletterService->findByCustomerId($customer->getId());

        return new QueryCustomerAccountResponse($customer,$subscriber->getId());

    }
}