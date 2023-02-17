<?php


namespace App\WebshopBundle\Infrastructure\NewsletterService;

use App\WebshopBundle\Domain\Model\Newsletter\NewsletterSubscriber;
use App\WebshopBundle\Domain\Model\Newsletter\NewsletterSubscriberRepositoryInterface;

class NewsletterSubscriberService implements NewsletterSubscriberRepositoryInterface
{

    public function add(NewsletterSubscriber $subscriber)
    {
        $url = 'http://newsletter_api:8082/api/subscribers';

        $fields = [
            'firstname' => $subscriber->getFirstName(),
            'lastname' => $subscriber->getLastName(),
            'email'   => $subscriber->getEmail(),
            'customerId'   => $subscriber->getCustomerId(),
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
        $createdCustomer->setCustomerId($response->customerId);

        return $createdCustomer;
    }

    public function remove(NewsletterSubscriber $subscriber)
    {
        // TODO: Implement remove() method.
    }

    public function findByCustomerId($id)
    {
        $url = 'http://newsletter_api:8082/api/subscribers';

        $params = array('customerId' => $id);
        $url = $url . '?' . http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response=curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        if (!isset($response[0])){
            return false;
        }

        $response = $response[0];

        $subscriber = new NewsletterSubscriber();
        $subscriber->setCustomerId($response->customerId);
        $subscriber->setEmail($response->email);
        $subscriber->setFirstname($response->firstname);
        $subscriber->setLastname($response->lastname);
        $subscriber->setId($response->id);

        return $subscriber;
    }
}