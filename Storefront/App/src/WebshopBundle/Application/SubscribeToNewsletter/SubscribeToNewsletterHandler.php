<?php


namespace App\WebshopBundle\Application\SubscribeToNewsletter;

use App\WebshopBundle\Domain\NewsletterSubscriber;
use App\WebshopBundle\Domain\NewsletterSubscriberRepositoryInterface;

class SubscribeToNewsletterHandler
{
    protected $newsletterSubscriberService;

    public function __construct(NewsletterSubscriberRepositoryInterface $subscriberService)
    {
        $this->newsletterSubscriberService = $subscriberService;
    }

    public function __invoke(SubscribeToNewsletterCommand $command)
    {
        $subscriber = new NewsletterSubscriber();
        $subscriber->setEmail($command->getEmail());
        $subscriber->setFirstName($command->getFistname());
        $subscriber->setLastName($command->getLastname());
        $subscriber->setCustomer($command->getCustomer());


        $subscriber = $this->newsletterSubscriberService->subscribe($subscriber);
        return $subscriber;
    }
}