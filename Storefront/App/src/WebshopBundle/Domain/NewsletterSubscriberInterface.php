<?php


namespace App\WebshopBundle\Domain;


interface NewsletterSubscriberInterface
{
    public function subscribe(NewsletterSubscriber $subscriber);
}