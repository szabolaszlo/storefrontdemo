<?php

namespace App\WebshopBundle\Infrastructure\CustomerService;

use App\WebshopBundle\Domain\Customer;
use App\WebshopBundle\Domain\CustomerRepositoryInterface;
use App\WebshopBundle\Domain\DomainException;
use App\WebshopBundle\Infrastructure\Security\ClientCredentialsOauthClient;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\HttpFoundation\RequestStack;
use function curl_close;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function json_decode;
use const CURLINFO_HTTP_CODE;
use const CURLOPT_HEADER;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_SSL_VERIFYHOST;

class CustomerService implements CustomerRepositoryInterface
{

    public function __construct(
        private RequestStack $requestStack,
        private ClientCredentialsOauthClient $client,
        private $url = "http://api_gateway_nginx:8080/customer/api/customers"
    )
    {}

    public function add(Customer $customer): Customer
    {
        $this->accessTokenHandling();
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
        $this->accessTokenHandling();

        /** @var AccessToken $accessToken */
        $accessToken = $this->requestStack->getSession()->get('customer_service.access_token');


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

    public function getByEmail(string $email): ?Customer
    {

        $this->accessTokenHandling();

        /** @var AccessToken $accessToken */
        $accessToken = $this->requestStack->getSession()->get('customer_service.access_token');

        if (!$accessToken) {
            throw new DomainException('Access Token is missing');
        }

        $ch = curl_init($this->url . '/by_email');
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["email"=>$email]));


        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)){
            throw new DomainException(curl_error($ch));
        }

        $response = json_decode($response);

        $createdCustomer = new Customer();
        $createdCustomer->setId($response->id);
        $createdCustomer->setEmail($response->email);
        $createdCustomer->setFirstName($response->firstname);
        $createdCustomer->setLastName($response->lastname);
        $createdCustomer->setPassword($response->password);

        return $createdCustomer;
    }

    public function authenticate(string $email, $password) : ?Customer{

        $this->accessTokenHandling();

        /** @var AccessToken $accessToken */
        $accessToken = $this->requestStack->getSession()->get('customer_service.access_token');

        if (!$accessToken) {
            throw new DomainException('Access Token is missing');
        }

        $ch = curl_init($this->url . '/auth');
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["email"=>$email,"password"=>$password]));


        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (curl_errno($ch)){
            throw new DomainException(curl_error($ch));
        }

        if ($httpCode === 403){
            return null;
        }

        $response = json_decode($response);

        $createdCustomer = new Customer();
        $createdCustomer->setId($response->id);
        $createdCustomer->setEmail($response->email);
        $createdCustomer->setFirstName($response->firstname);
        $createdCustomer->setLastName($response->lastname);
        $createdCustomer->setPassword($response->password);

        return $createdCustomer;
    }

    /**
     * @return void
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    private function accessTokenHandling(): void
    {
        $session = $this->requestStack->getSession();
        if (!$session->has('customer_service.access_token')) {

            $session->set('customer_service.access_token', $this->client->getAccessToken());
        } else {
            if ($session->get('customer_service.access_token')->hasExpired()) {
                $new = $this->client->refreshAccessToken($session->get('customer_service.access_token')->getRefreshToken());
                $session->set('customer_service.access_token', $new);
            }
        }
    }
}