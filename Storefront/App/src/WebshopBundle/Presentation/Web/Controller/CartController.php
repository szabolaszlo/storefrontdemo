<?php

namespace App\WebshopBundle\Presentation\Web\Controller;

use App\WebshopBundle\Application\Cart\AddToCart\AddToCartCommand;
use App\WebshopBundle\Application\Cart\CreateCart\CreateCartCommand;
use App\WebshopBundle\Application\Cart\CreateCart\Dto\CreateCartOutput;
use App\WebshopBundle\Application\Cart\Exception\CartNotFoundException;
use App\WebshopBundle\Application\Cart\GetCart\Dto\GetCartOutput;
use App\WebshopBundle\Application\Cart\GetCart\GetCartQuery;
use App\WebshopBundle\Application\Cart\RemoveItemFromCart\RemoveItemFromCartCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
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

        if (!$request->cookies->has('cart_id')) {
            $cart = $this->handle(new CreateCartCommand());
            $cartId = $cart->getCartId();
            $newCart = true;
        } else {
            try {
                /** @var GetCartOutput $cart */
                $cart = $this->handle(new GetCartQuery($request->cookies->get('cart_id')));
                $cartId = $cart->getId();
            } catch (HandlerFailedException $exception) {
                $cart = $this->handle(new CreateCartCommand());
                $cartId = $cart->getCartId();
                $newCart = true;
            }
        }

        $sku = $request->get('sku');
        $quantity = $request->get('quantity');

        try {
            $this->handle(new AddToCartCommand(
                $cartId,
                $sku,
                $quantity
            ));
        } catch (HandlerFailedException $exception) {
            new RedirectResponse($this->generateUrl('cart'));
        }

        $response = new RedirectResponse($this->generateUrl('cart'));

        if ($newCart) $response->headers->setCookie(new Cookie("cart_id", $cart->getId()));

        return $response;
    }

    public function removeItemFromCart(Request $request, string $itemId): Response
    {
        $cartId = $request->cookies->get('cart_id');

        if ($cartId) {
            try {
                $this->handle(new RemoveItemFromCartCommand(
                    $cartId,
                    $itemId
                ));
            } catch (HandlerFailedException $exception) {
                return $this->redirect($this->generateUrl('cart'));
            }
        }

        return $this->redirect($this->generateUrl('cart'));
    }
}