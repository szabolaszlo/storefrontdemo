<?php


namespace App\WebshopBundle\Presentation\Web\Controller;


use App\WebshopBundle\Infrastructure\CartService\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class CartController extends AbstractController
{

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {

        $products = [];

        return $this->render('@webshop/customer_space/cart.html.twig', [
            'products' => $products
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->get('sku');
        $request->get('quantity');
        new RedirectResponse($this->generateUrl('cart'));
    }
}