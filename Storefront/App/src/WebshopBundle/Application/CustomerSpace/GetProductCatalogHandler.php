<?php

namespace App\WebshopBundle\Application\CustomerSpace;

use App\WebshopBundle\Application\CustomerSpace\Dto\ProductCatalogToCustomerSpace;
use App\WebshopBundle\Domain\Model\Product\ProductRepositoryInterface;

class GetProductCatalogHandler
{
    public function __construct(
        private ProductRepositoryInterface $repository
    )
    {}

    public function __invoke(GetProductCatalogQuery $query): ProductCatalogToCustomerSpace
    {
        return new ProductCatalogToCustomerSpace($this->repository->getProducts());
    }
}
