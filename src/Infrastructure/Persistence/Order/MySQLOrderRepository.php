<?php

declare(strict_types=1);


namespace ShoppingCart\Infrastructure\Persistence\Order;


use ShoppingCart\Domain\Entities\Order\Order;
use ShoppingCart\Domain\Entities\Order\OrderRepository;

class MySQLOrderRepository implements OrderRepository
{

    public function getOfId(string $id): Order
    {
        // TODO: Implement getOfId() method.
    }

    public function getOfClientId(string $clientId): Order
    {
        // TODO: Implement getOfClientId() method.
    }

    public function add(Order $order): void
    {
        // TODO: Implement add() method.
    }

    public function update(Order $order): void
    {
        // TODO: Implement update() method.
    }
}