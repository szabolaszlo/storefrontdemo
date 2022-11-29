<?php


namespace App\WebshopBundle\Infrastructure\CustomerService;


use App\WebshopBundle\Domain\Customer;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;

class CustomerService implements CustomerRepositoryInterface
{

    public function register(Customer $customer): Customer
    {

        $url = 'http://customer_api:8081/api/customers';

        $fields = [
            'firstname' => $customer->getFirstName(),
            'lastname' => $customer->getLastName(),
            'password'   => $customer->getPassword(),
            'email'   => $customer->getEmail(),
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
        $createdCustomer = new Customer();
        $createdCustomer->setId($response->id);
        $createdCustomer->setEmail($response->email);
        $createdCustomer->setFirstName($response->firstname);
        $createdCustomer->setLastName($response->lastname);
        $createdCustomer->setPassword($response->password);

        return $createdCustomer;
    }
}