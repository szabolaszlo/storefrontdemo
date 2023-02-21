<?php


namespace App\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;


class CartId extends GuidType
{
    public function getName()
    {
        return 'CartId';
    }
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->id();
    }
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new App\Domain\CartId($value);
    }
}