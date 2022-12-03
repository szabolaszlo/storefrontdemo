<?php


namespace App\WebshopBundle\Application\Registration;


use App\WebshopBundle\Domain\Customer;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;
use App\WebshopBundle\Domain\NewsletterSubscriber;
use App\WebshopBundle\Domain\NewsletterSubscriberRepositoryInterface;


class RegistrationCommandHandler
{

    protected $customerService;

    protected $subscriberService;

    public function __construct(CustomerRepositoryInterface $customerService, NewsletterSubscriberRepositoryInterface $subscriberService)
    {
        $this->customerService = $customerService;
        $this->subscriberService = $subscriberService;
    }

    public function __invoke(RegistrationCommand $command)
    {
        $customer = new Customer();
        $customer->setEmail($command->getEmail());
        $customer->setFirstName($command->getFirstname());
        $customer->setLastName($command->getLastname());
        $customer->setPassword($command->getPassword());


        $customer = $this->customerService->add($customer);
        $subscriptionId = null;

        if ($command->needToSubscribeNewsletter()){
            $subscriber = new NewsletterSubscriber();
            $subscriber->setEmail($command->getEmail());
            $subscriber->setFirstname($command->getFirstname());
            $subscriber->setLastname($command->getLastname());
            $subscriber->setCustomerId($customer->getId());
            $subscriber = $this->subscriberService->add($subscriber);
            $subscriptionId = $subscriber->getId();
        }

        return  new RegistrationResponse($customer, $subscriptionId);
    }
}