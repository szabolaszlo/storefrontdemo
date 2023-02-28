<?php

namespace App\WebshopBundle\Presentation\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('@webshop/home.html.twig', [
            'sign_in_link' => $this->generateUrl('app_login'),
            'sign_up_link' => $this->generateUrl('app_signup'),
            'catalog_link' => $this->generateUrl('app_customer_space'),
        ]);
    }
}