<?php


namespace App\Infrastructure\CatalogService;


use App\Domain\ProductRepository as BaseRepository;

class ProductRepository implements BaseRepository
{

    public function findBySku($sku): Product
    {

        $url = 'http://api_gateway_nginx:8080/catalog/api/products/by_sku/'.$sku;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = json_decode(curl_exec($ch));

        curl_close($ch);

        return new Product($output->sku,$output->grossPrice);
    }
}