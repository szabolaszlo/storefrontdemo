<?php

namespace App\WebshopBundle\Infrastructure\ProductService;

use App\WebshopBundle\Domain\Model\Product\Product;
use App\WebshopBundle\Domain\Model\Product\ProductRepositoryInterface;
use GuzzleHttp\Client;

use function json_decode;

class SrCatalogServiceAdapter implements ProductRepositoryInterface
{
    public function __construct(
        private string $url,
        private Client $client = new Client()
    )
    {}

    public function getProducts(): array
    {
        $response = $this->client->get($this->url, [
            'headers' => [
                'Content-Type' => 'application/json',
                //'Authorization' => 'Bearer ' . $accessToken->getToken()
            ],
            'verify' => 0
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        $products = [];
        foreach ($response as $product) {
            $products[$product['id']] = new Product(
                $product['id'],
                $product['name'] ?? "NAN",
                $product['description'],
                $product['netPrice'],
                $product['vat'],
                $product['grossPrice'],
                $product['sku']
            );
        }

        return $products;
    }
}
