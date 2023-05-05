<?php

namespace App\Domain;

class PaymentMethod
{
    private PaymentMethodId $id;
    private string $name;
    private string $description;
    private int $fee;
    private array $availableShippingMethods;
    private bool $isEnabled;

    public function __construct(
        PaymentMethodId $id,
        string $name,
        string $description,
        int $fee,
        bool $isEnabled,
        array $availableShippingMethods
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->fee = $fee;
        $this->isEnabled = $isEnabled;
        $this->availableShippingMethods = $availableShippingMethods;
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getFee(): int
    {
        return $this->fee;
    }

    /**
     * @param int $fee
     */
    public function setFee(int $fee): void
    {
        $this->fee = $fee;
    }

    /**
     * @return array
     */
    public function getAvailableShippingMethods(): array
    {
        return $this->availableShippingMethods;
    }

    /**
     * @param ShippingMethodId $id
     */
    public function addAvailableShippingMethod(ShippingMethodId $id): void
    {
        $this->availableShippingMethods[] = $id;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled(bool $isEnabled): void
    {
        $this->isEnabled = $isEnabled;
    }
}




