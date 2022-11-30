<?php


namespace App\WebshopBundle\Application\QueryCustomer;


class QueryCustomerCommand
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}