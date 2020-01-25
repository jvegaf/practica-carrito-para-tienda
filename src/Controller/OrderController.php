<?php


namespace ShoppingCart\Controller;


use ShoppingCart\Model\Order;
use ShoppingCart\Persistence\OrderDAO;
use ShoppingCart\Persistence\OrderLineDAO;

class OrderController
{


    private $oDao;
    private $olDao;
    private $cart;

    public function __construct()
    {
        session_start();
        $this->oDao = new OrderDAO();
        $this->olDao = new OrderLineDAO();
    }

    public function getOrderOfClient($clientId): Order
    {
        if ($clientId == null) {
            return new Order(null, null, 0);
        }
        $order = $this->oDao->getOrderWithClientId($clientId);
        if ($order->getId() == null) {
            $order = $this->createOrderOfClient($clientId);
            $order->setId($order->getId());
            $order->setClientId($clientId);
            return $order;
        }
        return $order;
    }

    private function createOrderOfClient($clientId): Order
    {
        return $this->oDao->createOrderOfClient($clientId);
    }

    public function addNewItemToOrder($item): void
    {
        if (isset($_SESSION['orderId'])) {
            $this->cart = $this->olDao->getGetLinesOfOrderId($_SESSION['orderId']);
            foreach ($this->cart as $oLine) {
                if ($oLine['itemId'] == $item['itemId']) {
                    $oLine['quantity']+= $item['quantity'];
                    $this->olDao->updateOrderLine($oLine);
                    return;
                }
            }
            $this->olDao->insertOrderLine(
                [
                    'orderId' => $_SESSION['orderId'],
                    'itemId' => $item['itemId'],
                    'quantity' => 1,
                    'price' => null
                ]
            );
        }
        array_push($_SESSION['cart'], $item);
        return;
    }

    public function updateOrderLine($oLine): void
    {
        // TODO
    }

    public function getOrderLinesOfOrder($orderId)
    {
        return $this->olDao->getGetLinesOfOrderId($orderId);
    }
}