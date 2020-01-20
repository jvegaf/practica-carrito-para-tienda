<?php


namespace ShoppingCart\Controller;


use ShoppingCart\Model\Cart;
use ShoppingCart\Model\CartItem;
use ShoppingCart\Model\Order;
use ShoppingCart\Persistence\CartDAO;

class CartController
{
    private $cDao;


    public function __construct()
    {
        session_start();
        $this->cDao = New CartDAO();
    }

    public function getCart($orderId): Cart
    {
        $cart = new Cart();
        if ($orderId != null) {
            $items = $this->cDao->getGetCartItemsWithOrderId($orderId);
            foreach ($items as $item) {
                $cart->addItemInCart($item);
            }
        }
        return $cart;
    }

    public function addCartItem(CartItem $cartItem, Cart $cart): Cart
    {
        $cart->addItemInCart($cartItem);
        $this->cDao->insertCartItem(
            $cartItem->getOrderId(),
            $cartItem->getItemId(),
            $cartItem->getQuantity()
        );
        return $cart;
    }

    public function updateItemInCart(CartItem $cartItem, Cart $cart): Cart
    {
        $cart->updateItemInCart($cartItem);
        if ($cartItem->getOrderId() != null) {
            $this->cDao->updateCartItem(
                $cartItem->getOrderId(),
                $cartItem->getItemId(),
                $cartItem->getQuantity()
            );
        }
        return $cart;
    }

    public function deleteItemInCart(CartItem $cartItem, Cart $cart): Cart
    {
        $cart->deleteItemInCart($cartItem);
        if ($cartItem->getOrderId() != null) {
            $this->cDao->deleteCartItem(
                $cartItem->getOrderId(),
                $cartItem->getItemId()
            );
        }
        return $cart;
    }

    public function addItemsOnOldOrder($oldOrderId, $simpleCart): void
    {
        $oldItems = $this->cDao->getGetCartItemsWithOrderId($oldOrderId);
        foreach ($simpleCart as $item) {
            foreach ($oldItems as $oldItem) {
                if ($item['itemId'] == $oldItem->getItemId()) {
                    $this->cDao->updateCartItem(
                        $oldOrderId,
                        $item['itemId'],
                        $oldItem->getQuantity() + $item['quantity']
                    );
                }else{
                    $this->cDao->insertCartItem(
                        $oldOrderId,
                        intval($item['itemId']),
                        $item['quantity']);
                }
            }
        }
        return;
    }

    public function addItem($itemId, $orderId, Cart $cart): Cart
    {
        $cartItem = new CartItem($orderId, $itemId, 1);
        $cart->addItemInCart($cartItem);
        return $cart;
    }
}