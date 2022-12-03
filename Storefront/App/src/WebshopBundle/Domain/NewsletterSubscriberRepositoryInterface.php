<?php


namespace App\WebshopBundle\Domain;


interface NewsletterSubscriberRepositoryInterface
{
    public function remove(NewsletterSubscriber $subscriber);

    public function add(NewsletterSubscriber $subscriber);

    public function findByCustomerId($id);
}