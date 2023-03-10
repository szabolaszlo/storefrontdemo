<?php


namespace App\Infrastructure\Presentation\Web\Controller;


use App\Application\AddToCartCommand;
use App\Application\CreateCartCommand;
use App\Application\DeleteCartCommand;
use App\Application\DeleteItemCommand;
use App\Application\GetCartFilteredQuery;
use App\Application\GetCartQuery;
use App\Application\GetCartResponse;
use App\Application\UpdateCustomerIdentifierCommand;
use App\Application\UpdateItemCommand;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use function dd;

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

        if (isset($post->customerIdentifier)){
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
        try {
            /** @var GetCartResponse $response */
            $response = $this->handle(new GetCartQuery($id));
        } catch (HandlerFailedException $exception) {
            return new JsonResponse(['code' => $exception->getPrevious()->getCode(), 'message' => 'Cart not found'], 401);
        }

        return new JsonResponse($response);
    }

    public function getCartCollection(Request $request)
    {
        $from = $request->query->get('from');
        $to = $request->query->get('to');

        try {
            /** @var GetCartResponse $response */
            $response = $this->handle(new GetCartFilteredQuery(
                new DateTimeImmutable($from ?? '1990-10-21'),
                new DateTimeImmutable($to ?? '2024-01-01')
            ));
        } catch (HandlerFailedException $exception) {
            dd($exception->getPrevious());
            return new JsonResponse(['code' => $exception->getPrevious()->getCode(), 'message' => 'Sámting rong'], 401);
        }

        return new JsonResponse($response);
    }

    public function addToCart(string $id, Request $request)
    {
        $post = json_decode($request->getContent());
        $command = new AddToCartCommand($id);

        if (isset($post->items)) {
            foreach ($post->items as $i){
                $command->addItem($i->sku,$i->quantity);
            }
        }

        try {
            $response = $this->handle($command);
        } catch (HandlerFailedException $exception) {
            return new JsonResponse(['code' => $exception->getPrevious()->getCode(), 'message' => 'Cart not found'], 401);
        }

        return new JsonResponse($response);
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

        $response = $this->handle(new DeleteItemCommand($cartid, $itemid));

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