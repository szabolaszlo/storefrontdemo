<?php


namespace App\Infrastructure\Persistence\Doctrine\Repository;


use App\Domain\Cart;
use App\Domain\CartId;
use App\Domain\CartRepository as CartRepoInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CartRepository extends ServiceEntityRepository implements CartRepoInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function nextIdentity()
    {
        return CartId::create();
    }

    public function add(Cart $cart)
    {
        $this->getEntityManager()->persist($cart);
        $this->getEntityManager()->flush();
    }

    public function remove(Cart $cart)
    {
        $this->getEntityManager()->remove($cart);
        $this->getEntityManager()->flush();
    }

    public function findById(CartId $id){
        return $this->find($id);
    }
}