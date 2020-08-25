<?php

declare(strict_types=1);


namespace ShoppingCart\Infrastructure\Persistence\Order;


use ShoppingCart\Domain\Entities\Order\Order;
use ShoppingCart\Domain\Entities\Order\OrderRepository;
use ShoppingCart\Infrastructure\Persistence\Shared\MySQLRepository;

class MySQLOrderRepository extends MySQLRepository implements OrderRepository
{

    private const GET_WITH_ID = "SELECT * FROM `order` WHERE id=?";
    private const GET_WITH_CLIENT_ID = "SELECT * FROM `order` WHERE client_id=?";
    private const ADD = "INSERT INTO `order` (id, client_id, ship_address, confirm_date) VALUES (?,?,?,?)";

    public function getOfId(string $id): ?Order
    {
        $select = $this->pdo->prepare($this::GET_WITH_ID);
        $select->execute([$id]);
        $rs = $select->fetch();
        return new Order(
                $rs['client_id'],
                $rs['ship_address'],
                $rs['confirm_date'],
                $rs['id']
            );
    }

    public function getOfClientId(string $clientId): array
    {
        $orders = array();
        $select = $this->pdo->prepare($this::GET_WITH_CLIENT_ID);
        $select->execute([$clientId]);
        $rs = $select->fetchAll();
        foreach ($rs as $row) {
            $order = new Order(
                $row['client_id'],
                $row['ship_address'],
                $row['confirm_date'],
                $row['id']
            );
            array_push($orders, $order);
        }
        return $orders;
    }

    public function add(Order $order): void
    {
        $this->pdo->prepare($this::ADD)
            ->execute(
                [
                    $order->getId(),
                    $order->getClientId(),
                    $order->getShippingAdress(),
                    $order->getConfirmedDate()
                ]
            );
    }

    public function update(Order $order): void
    {
        // TODO: Implement update() method.
    }
}