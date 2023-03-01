<?php

namespace App\WebshopBundle\Presentation\Web\Controller;

use App\WebshopBundle\Application\Catalog\GetProductCatalog\GetProductCatalogQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class CustomerSpaceController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function index()
    {
        $products = $this->handle(new GetProductCatalogQuery());

        return $this->render('@webshop/customer_space/catalog.html.twig', [
            'products' => $products
        ]);
    }
}