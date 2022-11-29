<?php


namespace App\WebshopBundle\Application\RegisterCustomer;


use App\WebshopBundle\Domain\Customer;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;
use App\WebshopBundle\Domain\NewsletterSubscriber;
use App\WebshopBundle\Domain\NewsletterSubscriberInterface;

class RegisterCustomerHandler
{

    protected $customerService;

    protected $newsletterSubscriberService;

    public function __construct(CustomerRepositoryInterface $customerService, NewsletterSubscriberInterface $subscriberService)
    {
        $this->customerService = $customerService;
        $this->newsletterSubscriberService = $subscriberService;
    }

    public function __invoke(RegisterCustomerCommand $command)
    {
        $customer = new Customer();
        $customer->setEmail($command->getEmail());
        $customer->setFirstName($command->getFirstname());
        $customer->setLastName($command->getLastname());
        $customer->setPassword($command->getPassword());



        if ($command->getNewsletter()){
            $subscriber = new NewsletterSubscriber();
            $subscriber->setEmail($customer->getEmail());
            $subscriber->setFirstname($customer->getFirstName());
            $subscriber->setLastname($customer->getLastname());
            $subscriber = $this->newsletterSubscriberService->subscribe($subscriber);

            $customer->setNewsletterSubscriptionId($subscriber->getId());
        }

        $customer = $this->customerService->register($customer);
        return $customer;
    }
}