<?php


namespace ShoppingCart\Infrastructure\Controllers;


use ShoppingCart\Domain\Entities\Order;
use ShoppingCart\Domain\Entities\Order\OrderRepository;
use ShoppingCart\Infrastructure\Persistence\OrderDAO;
use ShoppingCart\Infrastructure\Persistence\OrderLineDAO;

class OrderController
{


    private OrderRepository $repository;


    public function __construct(OrderRepository $repository)
    {
        session_start();
        $this->repository = $repository;
    }

    public function getOrdersOf($clientId): array
    {
        $orders = $this->repository->getOfClientId($clientId);
        if (empty($orders)){

        }

        if ($order->getId() == null) {
            $order = $this->createOrderOfClient($clientId);
        }
        $_SESSION['orderId'] = $order->getId();
    }

    private function createOrderOfClient($clientId): Order
    {
        return $this->oDao->createOrderOfClient($clientId);
    }

    public function addNewItem($itemId): void
    {
        if (isset($_SESSION['orderId'])) {
            $cart = $this->olDao->getGetLinesOfOrderId($_SESSION['orderId']);
            foreach ($cart as $oLine) {
                if ($oLine['itemId'] == $itemId) {
                    $oLine['quantity']++;
                    $this->olDao->updateOrderLine($oLine);
                    $this->updateCart();
                    return;
                }
            }
            $this->olDao->insertOrderLine(
                [
                    'orderId' => $_SESSION['orderId'],
                    'itemId' => $itemId,
                    'quantity' => 1,
                    'price' => null
                ]
            );
            $this->updateCart();
            return;
        }

        foreach ($_SESSION['cart'] as $item) {
            if ($item['itemId'] == $itemId) {
                $item['quantity']++;
                return;
            }
        }

        array_push($_SESSION['cart'], [
            "itemId" => $itemId,
            "orderId" => null,
            "quantity" => 1
        ]);
        return;
    }

    public function updateOrderLine($oLine): void
    {
        if (isset($_SESSION['orderId'])){
            $this->olDao->updateOrderLine($oLine);
        }

        foreach ($_SESSION['cart'] as $item) {
            if ($item['itemId'] == $oLine['itemId']) {
                $item['quantity']+=$oLine['quantity'];
                return;
            }
        }
    }

    public function confirmOrder($address): void
    {
        if (isset($_SESSION['orderId'])){
            $this->oDao->confirmOrder($_SESSION['orderId'], $address);
        }
    }

    public function getOrderLinesOfOrder($orderId)
    {
        return $this->olDao->getGetLinesOfOrderId($orderId);
    }

    public function updateCart(): void
    {
        $_SESSION['cart'] = $this->getOrderLinesOfOrder($_SESSION['orderId']);
        return;
    }
}