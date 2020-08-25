<?php

namespace ShoppingCart\Domain\Entities\Order;

interface OrderRepository
{
    public function getOfId(string $id): ?Order;

    public function getOfClientId(string $clientId): array;

    public function add(Order $order): void;

    public function update(Order $order): void;
}