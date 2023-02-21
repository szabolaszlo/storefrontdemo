<?php


namespace App\Application;


class DeleteCartCommandResponse
{
    protected $msg = 'Cart deleted';

    public function getMsg()
    {
        return $this->msg;
    }
}