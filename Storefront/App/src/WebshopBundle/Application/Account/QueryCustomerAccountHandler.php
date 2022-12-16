<?php


namespace App\WebshopBundle\Application\Account;


use App\WebshopBundle\Application\Account\QueryCustomerAccountResponse;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;
use App\WebshopBundle\Domain\NewsletterSubscriberRepositoryInterface;
use App\WebshopBundle\Infrastructure\CustomerService\CustomerService;
use function dd;

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
        $customer = $command->getId() ? $this->customerService->getById($command->getId()) : $this->customerService->getByEmail();
        $subscriber = $this->newsletterService->findByCustomerId($customer->getId());

        $id = null;
        if ($subscriber){
            $id = $subscriber->getId();
        }

        return new QueryCustomerAccountResponse($customer,$id);

    }
}