<?php


namespace ShoppingCart\Model;


class CartItem
{
    private $orderId;
    private $itemId;
    private $quantity;

    /**
     * CartItem constructor.
     * @param $orderId
     * @param $itemId
     * @param $quantity
     */
    public function __construct($orderId, $itemId, $quantity)
    {
        $this->orderId = $orderId;
        $this->itemId = $itemId;
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId): void
    {
        $this->itemId = $itemId;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @param int $quantity
     */
    public function addQuant($quantity): void
    {
        $this->$quantity += $quantity;
    }

}