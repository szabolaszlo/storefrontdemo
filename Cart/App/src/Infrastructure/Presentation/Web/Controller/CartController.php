<?php


namespace App\Infrastructure\Presentation\Web\Controller;


use App\Application\AddToCartCommand;
use App\Application\CreateCartCommand;
use App\Application\DeleteCartCommand;
use App\Application\DeleteItemCommand;
use App\Application\GetCartQuery;
use App\Application\UpdateCustomerIdentifierCommand;
use App\Application\UpdateItemCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CartController extends AbstractController
{

    use HandleTrait;

    protected $serializer;

    public function __construct(MessageBusInterface $messageBus,SerializerInterface $serializer)
    {
        $this->messageBus = $messageBus;
        $this->serializer = $serializer;
    }

    public function createCart( Request $request)
    {

        $post = json_decode($request->getContent());
        $command = new CreateCartCommand();

        if (isset($post->user)){
            $command->setCustomerIdentifier($post->customerIdentifier);
        }

        if (isset($post->items)){
            foreach ($post->items as $i){
                $command->addItem($i->sku,$i->quantity);
            }
        }
        $response = $this->handle(
            $command
        );

        $jsonresponse = $this->serializer->serialize($response,'json');
        return new Response($jsonresponse);
    }


    public function getCart(string $id)
    {
        $query = new GetCartQuery($id);
        $response = $this->handle($query);
        $jsonresponse = $this->serializer->serialize($response,'json');
        return new Response($jsonresponse);
    }

    public function addToCart(string $id, Request $request)
    {
        $post = json_decode($request->getContent());
        $command = new AddToCartCommand($id);

        if (isset($post->items)){
            foreach ($post->items as $i){
                $command->addItem($i->sku,$i->quantity);
            }
        }
        $response = $this->handle(
            $command
        );

        $jsonresponse = $this->serializer->serialize($response,'json');
        return new Response($jsonresponse);
    }

    public function updateCart(string $id, Request $request)
    {
        $post = json_decode($request->getContent());

        $command = new UpdateCustomerIdentifierCommand($id);
        $command->setCustomerIdentifier($post->customerIdentifier);


        $response = $this->handle(
            $command
        );

        $jsonresponse = $this->serializer->serialize($response,'json');
        return new Response($jsonresponse);
    }

    public function deleteCart(string $id)
    {

        $command = new DeleteCartCommand($id);

        $response = $this->handle(
            $command
        );

        $jsonresponse = $this->serializer->serialize($response,'json');
        return new Response($jsonresponse);
    }

    public function deleteCartItem(string $cartid,string $itemid)
    {

        $command = new DeleteItemCommand($cartid,$itemid);

        $response = $this->handle(
            $command
        );

        $jsonresponse = $this->serializer->serialize($response,'json');
        return new Response($jsonresponse);
    }

    public function updateCartItem(string $cartid,string $itemid, Request $request)
    {

        $post = json_decode($request->getContent());

        $command = new UpdateItemCommand($cartid,$itemid, $post->quantity);

        $response = $this->handle(
            $command
        );

        $jsonresponse = $this->serializer->serialize($response,'json');
        return new Response($jsonresponse);
    }
}