<?php


namespace ShoppingCart\Infrastructure\Persistence;


class OrderLineDAO
{
    private $pdo;
    private $getLinesOfOrderId = "SELECT * FROM lineaPedido WHERE pedido_id=?";
    private $insertOrderLine = "INSERT INTO lineaPedido (pedido_id, producto_id, unidades, precioUnitario) VALUES (?,?,?,?)";
    private $updateOrderLine = "UPDATE lineaPedido SET unidades=?, precioUnitario=? WHERE pedido_id=? AND producto_id=?";
    private $deleteOrderLine = "DELETE FROM lineaPedido WHERE pedido_id=? AND producto_id=?";


    public function __construct()
    {
        $this->pdo = DatabaseRepository::getConnection();
    }


    public function getGetLinesOfOrderId($orderId): array
    {
        $orderLines = array();
        $select = $this->pdo->prepare($this->getLinesOfOrderId);
        $select->execute([$orderId]);
        $rs = $select->fetchAll();
        foreach ($rs as $row) {
            $line = [
                'orderId' => $orderId,
                'itemId' => $row['producto_id'],
                'quantity' => $row['unidades'],
                'price' => $row['precioUnitario']
            ];
            array_push($orderLines, $line);
        }
        return $orderLines;
    }

    public function insertOrderLine($oLine){
        $this->pdo->prepare($this->insertOrderLine)->execute([
            $oLine['orderId'],
            $oLine['itemId'],
            $oLine['quantity'],
            $oLine['price']
        ]);
        return;
    }

    public function updateOrderLine($oLine){
        $this->pdo->prepare($this->updateOrderLine)->execute([
            $oLine['quantity'],
            null,
            $oLine['orderId'],
            $oLine['itemId']
        ]);
        return;
    }

    public function deleteOrderLine($oLine){
        $this->pdo->prepare($this->deleteOrderLine)->execute([
            $oLine['orderId'],
            $oLine['itemId']
        ]);
        return;
    }


}