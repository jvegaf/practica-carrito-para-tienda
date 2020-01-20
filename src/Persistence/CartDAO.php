<?php


namespace ShoppingCart\Persistence;


use ShoppingCart\Model\CartItem;

class CartDAO
{
    private $pdo;
    private $getCartItemsWithOrderId = "SELECT * FROM order_items WHERE order_id=?";
    private $insertCartItem = "INSERT INTO order_items (order_id, item_id, quantity) VALUES (?,?,?)";
    private $updateCartItem = "UPDATE order_items SET quantity=? WHERE order_id=? AND item_id=?";
    private $deleteCartItem = "DELETE FROM order_items WHERE order_id=? AND item_id=?";


    public function __construct()
    {
        $this->pdo = DatabaseRepository::getConnection();
    }


    public function getGetCartItemsWithOrderId($orderId): array
    {
        $items = array();
        $select = $this->pdo->prepare($this->getCartItemsWithOrderId);
        $select->execute([$orderId]);
        $rs = $select->fetchAll();
        foreach ($rs as $row) {
            $item = new CartItem(
                $orderId,
                $row['item_id'],
                $row['quantity']
            );
            array_push($items, $item);
        }
        return $items;
    }

    public function insertCartItem($orderId, $itemId, $quantity){
        $this->pdo->prepare($this->insertCartItem)->execute([
            $orderId,
            $itemId,
            $quantity,
        ]);
        return;
    }

    public function updateCartItem($orderId, $itemId, $quantity){
        $this->pdo->prepare($this->updateCartItem)->execute([
            $quantity,
            $orderId,
            $itemId
        ]);
        return;
    }

    public function deleteCartItem($orderId, $itemId){
        $this->pdo->prepare($this->deleteCartItem)->execute([
            $orderId,
            $itemId
        ]);
        return;
    }


}