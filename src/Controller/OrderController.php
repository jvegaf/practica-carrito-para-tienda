<?php


namespace ShoppingCart\Controller;


use ShoppingCart\Model\Order;
use ShoppingCart\Persistence\OrderDAO;

class OrderController
{
    private $oDao;

    public function __construct()
    {
        $this->oDao = new OrderDAO();
    }

    public function getOrderOfClient($clientId): Order
    {
        if ($clientId == null) {
            return new Order(null,null,0);
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

}