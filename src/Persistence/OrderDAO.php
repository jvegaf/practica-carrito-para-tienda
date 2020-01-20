<?php


namespace ShoppingCart\Persistence;


use ShoppingCart\Model\Order;

class OrderDAO
{
    private $pdo;
    private $getOrderIdWithClientID = "SELECT id FROM `order` WHERE client_id=? AND confirmed=0";
    private $getOrderWithId = "SELECT * FROM `order` WHERE id=?";
    private $getOrderWithClientId = "SELECT * FROM `order` WHERE client_id=? AND confirmed=0";
    private $updateConfirmOrder = "UPDATE `order` SET confirmed=1 WHERE id=?";
    private $addOrder = "INSERT INTO `order` (client_id, confirmed) VALUES (?,0)";


    public function __construct()
    {
        $this->pdo = DatabaseRepository::getConnection();
    }

    public function getOrderWithClientId($clientId): Order
    {
        $select = $this->pdo->prepare($this->getOrderWithClientId);
        $select->execute([$clientId]);
        $rs = $select->fetch();
        return new Order(
            $rs['id'],
            $clientId,
            $rs['confirmed']
        );
    }

    public function getOrderWithId($orderId): Order
    {
        $select = $this->pdo->prepare($this->getOrderWithId);
        $select->execute([$orderId]);
        $rs = $select->fetch();
        return new Order(
            $orderId,
            $rs['client_id'],
            $rs['confirmed']
        );
    }

    public function updateConfirmOrder($orderId)
    {
        $this->pdo->prepare($this->updateConfirmOrder)->execute([
            $orderId
        ]);
        return;
    }

    public function createOrderOfClient($clientId): Order
    {
        $this->pdo->prepare($this->addOrder)->execute([
            $clientId
        ]);

        return $this->getOrderWithClientId($clientId);

    }
}