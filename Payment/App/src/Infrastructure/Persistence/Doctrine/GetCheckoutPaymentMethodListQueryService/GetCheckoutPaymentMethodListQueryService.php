<?php

namespace App\Infrastructure\Persistence\Doctrine\GetCheckoutPaymentMethodListQueryService;

use App\Application\GetCheckoutPaymentMethodList\QueryServiceInterface;
use App\Domain\PaymentMethod;
use App\Domain\PaymentMethodId;
use App\Domain\ShippingMethodId;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Azért lett egy ilyen query service mert bizonyos feltételek alapjá szűrőgetni kell
 * és azt mindet be lehet ide verni
 * Persze a specifikaction pattern is megoldás lehetne ha időmilliomosak vagyunk
 */
class GetCheckoutPaymentMethodListQueryService implements QueryServiceInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCheckoutPaymentMethodListByShippingMethodId(ShippingMethodId $id):array
    {
        $paymentMethods = $this
            ->entityManager
            ->getRepository(PaymentMethod::class)
            ->findAll();
        // Azért findAll mert ha rossz ID jön akkor nincs lista és hadd működjön

        // Ide jöhetne akár adatbázis szinten hogy ShippingId szerint szűrjönk és azokat is ejtsük ki amelyek nincsenek engedélyezve

        return $paymentMethods;
    }
}
