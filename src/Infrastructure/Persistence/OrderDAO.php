<?php


namespace ShoppingCart\Infrastructure\Persistence;


use ShoppingCart\Domain\Entities\Order;

class OrderDAO
{
    private $pdo;
    private $getOrderIdWithClientID = "SELECT id FROM pedido WHERE cliente_id=? AND fechaConfirmacion IS NULL";
    private $getOrderWithId = "SELECT * FROM pedido WHERE id=?";
    private $getOrderWithClientId = "SELECT * FROM pedido WHERE cliente_id=? AND fechaConfirmacion IS NULL";
    private $updateConfirmOrder = "UPDATE pedido SET fechaConfirmacion=?, direccionEnvio=? WHERE id=?";
    private $addOrder = "INSERT INTO pedido (cliente_id, direccionEnvio, fechaConfirmacion) VALUES (?,?,?)";


    public function __construct()
    {
        $this->pdo = MySQLDatabase::getConnection();
    }

    public function getOrderWithClientId($clientId): Order
    {
        $select = $this->pdo->prepare($this->getOrderWithClientId);
        $select->execute([$clientId]);
        $rs = $select->fetch();
        return new Order(
            $rs['id'],
            $rs['cliente_id'],
            $rs['direccionEnvio'],
            $rs['fechaConfirmacion']
        );
    }

    public function getOrderWithId($orderId): Order
    {
        $select = $this->pdo->prepare($this->getOrderWithId);
        $select->execute([$orderId]);
        $rs = $select->fetch();
        return new Order(
            $rs['id'],
            $rs['cliente_id'],
            $rs['direccionEnvio'],
            $rs['fechaConfirmacion']
        );
    }

    public function confirmOrder($orderId, $address): void
    {
        $now = date("YmdHi");

        $this->pdo->prepare($this->updateConfirmOrder)->execute([
            $now,
            $address,
            $orderId
        ]);
        return;
    }

    public function createOrderOfClient($clientId): Order
    {
        $this->pdo->prepare($this->addOrder)->execute([
            $clientId,
            null,
            null
        ]);

        return $this->getOrderWithClientId($clientId);
    }
}