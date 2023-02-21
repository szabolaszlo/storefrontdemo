<?php


namespace App\WebshopBundle\Domain\Model\Newsletter;


interface NewsletterSubscriberRepositoryInterface
{
    public function remove(NewsletterSubscriber $subscriber);

    public function add(NewsletterSubscriber $subscriber);

    public function findByCustomerId($id);
}