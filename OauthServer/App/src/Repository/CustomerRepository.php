<?php


namespace App\Repository;

use App\Entity\User;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

class CustomerRepository implements UserRepositoryInterface
{

    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        $ch = curl_init('http://customer_api:8081/api/customers/auth');
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
              //  'Authorization: Bearer ' . $accessToken->getToken()
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["email"=>$username,"password"=>$password]));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response = json_decode($response);

        $createdCustomer = new User();
        $createdCustomer->setId($response->id);
        $createdCustomer->setEmail($response->email);
        $createdCustomer->setPassword($response->password);

        return $createdCustomer;
    }
}