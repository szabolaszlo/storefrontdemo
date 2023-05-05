<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\PaymentMethodId;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class PaymentMethodIdType extends GuidType
{
    public function getName()
    {
        return 'PaymentMethodId';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new PaymentMethodId($value);
    }
}
