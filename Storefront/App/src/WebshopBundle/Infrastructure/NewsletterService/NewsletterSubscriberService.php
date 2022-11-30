<?php


namespace App\WebshopBundle\Infrastructure\NewsletterService;


use App\WebshopBundle\Domain\Customer;
use App\WebshopBundle\Domain\NewsletterSubscriber;
use App\WebshopBundle\Domain\NewsletterSubscriberInterface;

class NewsletterSubscriberService implements NewsletterSubscriberInterface
{

    public function subscribe(NewsletterSubscriber $subscriber)
    {
        $url = 'http://newsletter_api:8082/api/subscribers';

        $fields = [
            'firstname' => $subscriber->getFirstName(),
            'lastname' => $subscriber->getLastName(),
            'email'   => $subscriber->getEmail(),
            'customer'   => $subscriber->getCustomer(),
        ];

        // for sending data as json type
        $fields = json_encode($fields);

        $ch = curl_init($url);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json'
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);
        $createdCustomer = new NewsletterSubscriber();
        $createdCustomer->setId($response->id);
        $createdCustomer->setEmail($response->email);
        $createdCustomer->setFirstName($response->firstname);
        $createdCustomer->setLastName($response->lastname);
        $createdCustomer->setCustomer($response->customer);

        return $createdCustomer;
    }
}