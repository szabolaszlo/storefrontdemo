<?php


namespace App\Application;


use JsonSerializable;
use function get_object_vars;

class GetCartResponse extends CartResponse implements JsonSerializable
{

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}