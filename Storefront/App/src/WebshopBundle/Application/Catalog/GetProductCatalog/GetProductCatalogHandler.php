<?php

namespace App\WebshopBundle\Application\Catalog\GetProductCatalog;

use App\WebshopBundle\Application\Catalog\GetProductCatalog\Dto\ProductCatalogToCustomerSpace;
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
