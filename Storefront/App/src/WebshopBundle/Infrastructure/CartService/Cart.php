<?php


namespace App\WebshopBundle\Infrastructure\CartService;


use App\WebshopBundle\Domain\Model\Product\Product;
use GuzzleHttp\Client;

class Cart
{
    public function __construct(
        private string $url,
        private Client $client = new Client()
    )
    {}


    public function createCart()
    {

    }

    public function getCart($id): array
    {
        $url = $this->url.'/'.$id;
        $response = $this->client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                //'Authorization' => 'Bearer ' . $accessToken->getToken()
            ],
            'verify' => 0
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }
}