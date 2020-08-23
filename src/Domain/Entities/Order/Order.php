<?php


namespace ShoppingCart\Domain\Entities\Order;


use Ramsey\Uuid\Uuid;

class Order
{
    protected ?string $id;
    protected string $clientId;
    protected string $shippingAdress;
    protected \DateTime $confirmedDate;

    public function __construct(string $clientId, string $shippingAdress, \DateTime $confirmedDate, string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->clientId = $clientId;
        $this->shippingAdress = $shippingAdress;
        $this->confirmedDate = $confirmedDate;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getShippingAdress(): string
    {
        return $this->shippingAdress;
    }

    public function getConfirmedDate(): \DateTime
    {
        return $this->confirmedDate;
    }
}