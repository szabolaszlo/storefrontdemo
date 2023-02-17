<?php

namespace App\WebshopBundle\Infrastructure\CustomerService;

use App\WebshopBundle\Domain\Model\Customer\Customer;
use App\WebshopBundle\Domain\Model\Customer\CustomerRepositoryInterface;
use League\OAuth2\Client\Token\AccessToken;
use function curl_close;
use function curl_exec;
use function curl_init;
use function curl_setopt;
use function json_decode;
use const CURLOPT_HEADER;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_SSL_VERIFYHOST;

class CustomerService implements CustomerRepositoryInterface
{

    public function __construct(
        private TokenProviderInterface $tokenProvider,
        private $url
    )
    {}

    public function add(Customer $customer): Customer
    {

        $fields = [
            'firstname' => $customer->getFirstName(),
            'lastname' => $customer->getLastName(),
            'password'   => $customer->getPassword(),
            'email'   => $customer->getEmail(),
        ];

        // for sending data as json type
        $fields = json_encode($fields);

        $ch = curl_init($this->url);
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
        $createdCustomer = new Customer();
        $createdCustomer->setId($response->id);
        $createdCustomer->setEmail($response->email);
        $createdCustomer->setFirstName($response->firstname);
        $createdCustomer->setLastName($response->lastname);
        $createdCustomer->setPassword($response->password);

        return $createdCustomer;
    }

    public function getById(int $id): Customer
    {

        /** @var AccessToken $accessToken */
        $accessToken = $this->tokenProvider->getAccessToken();


        $ch = curl_init($this->url . '/' . $id);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accessToken->getToken()
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);


        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);
        $createdCustomer = new Customer();
        $createdCustomer->setId($response->id);
        $createdCustomer->setEmail($response->email);
        $createdCustomer->setFirstName($response->firstname);
        $createdCustomer->setLastName($response->lastname);
        $createdCustomer->setPassword($response->password);

        return $createdCustomer;
    }

}