<?php

namespace App\WebshopBundle\Presentation\Web\Controller;

use App\WebshopBundle\Application\Cart\AddToCart\AddToCartCommand;
use App\WebshopBundle\Application\Cart\CreateCart\CreateCartCommand;
use App\WebshopBundle\Application\Cart\CreateCart\Dto\CreateCartOutput;
use App\WebshopBundle\Application\Cart\GetCart\GetCartQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use function dd;

class CartController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function index(Request $request)
    {
        $cart = null;

        if ($request->cookies->has('cart_id')) {
            $cart = $this->handle(new GetCartQuery($request->cookies->get('cart_id')));
        }

        return $this->render('@webshop/customer_space/cart.html.twig', [
            'cart' => $cart
        ]);
    }

    public function addToCart(Request $request)
    {

        $newCart = false;
        if (!$request->cookies->has('cart_id')){
            /** @var CreateCartOutput $cart */
            $cart = $this->handle(new CreateCartCommand());
            $cartId = $cart->getCartId();
            $newCart = true;
        }

        $cartId = !$newCart ? $request->cookies->get('cart_id') : $cartId;

        $sku = $request->get('sku');
        $quantity = $request->get('quantity');

        $this->handle(new AddToCartCommand(
            $cartId,
            $sku,
            $quantity
        ));

        $response = new RedirectResponse($this->generateUrl('cart'));

        if ($newCart) $response->headers->setCookie(new Cookie("cart_id", $cart->getCartId()));

        return $response;
    }
}