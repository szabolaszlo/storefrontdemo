<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\PaymentId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class PaymentIdType extends GuidType
{
    public function getName()
    {
        return 'PaymentId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new PaymentId($value);
    }
}
