<?php


namespace App\Domain;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class Cart
{
    protected $id;

    protected $customerIdentifier;

    protected Collection $items;

    protected $created;

    public function __construct(CartId $id, $customerIdentifier = null)
    {
        $this->id = $id;
        $this->customerIdentifier = $customerIdentifier;
        $this->created = new \DateTime('now');
        $this->items = new ArrayCollection();
    }

    public function addItem($sku, $quantity,$price)
    {

        foreach ($this->items as $item){
            if ($item->getSku() == $sku){
                $item->increaseQuantity($quantity);
                return;
            }
        }

        $item = new Item(
            ItemId::create(),
            $sku,
            $quantity,
            $price
        );
        $this->items[] = $item;
    }

    public function changeQuantity($itemid, $quantity)
    {
        foreach ($this->items as $item){
            if ($item->getId() == $itemid){
                $item->setQuantity($quantity);
                return;
            }
        }
    }

    public function removeItem($id)
    {
        foreach ($this->items as $key=>$item){
            if ($item->getId() == $id){
                $this->items->remove($key);
            }
        }
    }

    public function getTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }

        return $total;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCustomerIdentifier()
    {
        return $this->customerIdentifier;
    }

    public function setCustomerIdentifier($id)
    {
        $this->customerIdentifier = $id;
    }

    public function getItems()
    {
        return $this->items;
    }
}