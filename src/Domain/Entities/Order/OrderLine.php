<?php

declare(strict_types=1);


namespace ShoppingCart\Domain\Entities\Order;


class OrderLine
{
    protected string $orderId;
    protected string $producId;
    protected int $quantity;
    protected int $price;

    /**
     * OrderLine constructor.
     * @param string $orderId
     * @param string $producId
     * @param int $quantity
     * @param int $price
     */
    public function __construct(string $orderId, string $producId, int $quantity, int $price)
    {
        $this->orderId = $orderId;
        $this->producId = $producId;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getProducId(): string
    {
        return $this->producId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): int
    {
        return $this->price;
    }



}