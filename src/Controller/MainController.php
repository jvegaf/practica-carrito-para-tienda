<?php


namespace ShoppingCart\Controller;

use ShoppingCart\Model\Client;
use ShoppingCart\Model\Item;
use ShoppingCart\Persistence\ItemDAO;

class MainController
{

    private $clientC;
    private $orderC;
    private $cartC;
    private $shopC;
    private $client;
    private $cart;
    private $order;
    private $simpleCart;
    private $iDao;

    public function __construct()
    {
        session_start();
        $this->clientC = new ClientController();
        $this->orderC = new OrderController();
        $this->cartC = new CartController();
        $this->shopC = new ShopController();
        $this->iDao = new ItemDAO();

        if (isset($_SESSION['client-id'])) {
            $this->client = $this->clientC->getClientWithId($_SESSION['client-id']);
            $this->order = $this->orderC->getOrderOfClient($this->client->getId());
            $this->cart = $this->cartC->getCart($this->order->getId());
        } else {
            $this->order = $this->orderC->getOrderOfClient(null);
            if (isset($_SESSION['cart'])) {
                $this->simpleCart = $_SESSION['cart'];
            } else {
                $this->simpleCart = array();
            }
        }
    }

    public function addItemToCart($itemId)
    {
        if (!$this->isClientLogged()) {
            foreach ($this->simpleCart as $item) {
                if ($item['itemId'] == $itemId) {
                    $item['quantity']++;
                    $_SESSION['cart'] = $this->simpleCart;
                    exit();
                }
            }
            array_push($this->simpleCart, [
                "itemId" => $itemId,
                "orderId" => $this->order->getId(),
                "quantity" => 1
            ]);
            $_SESSION['cart'] = $this->simpleCart;
        }
    }

    public function loginClient($email, $passwd)
    {
        $resClient = $this->clientC->login($email, $passwd);
        if ($resClient == null) {
            header('Location: login.php?error=true');
            exit();
        }
        $this->client = $resClient;
        $this->order = $this->orderC->getOrderOfClient($this->client->getId());
        $this->cartC->addItemsOnOldOrder($this->order->getId(), $this->simpleCart);
        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'] = null;
        }
        $this->cart = $this->cartC->getCart($this->order->getId());
        $_SESSION['sesion-started'] = true;
        $_SESSION['client-id'] = $this->client->getId();
        /*
         * TODO: pasar la cart a la simplecart
         *
         * cuidado que los itemscart no son los arrays asociativos
         *
         * */
        header('Location: main.php');
        exit();
    }

    public function isClientLogged(): bool
    {
        if ($this->client == null) {
            return false;
        }
        return true;
    }

    public function getClientName(): string
    {
        if ($this->client == null) {
            return "";
        }
        return $this->client->getName() . " " . $this->client->getSurnameFirst();
    }

    public function getAllShopItems(): array
    {
        return $this->shopC->getItems();
    }

    public function getCartItemsAmount(): int
    {
        if (!$this->cart) {
            return count($this->simpleCart);
        }
        return $this->cart->getItemsAmount();
    }

    public function getCartItems(): array
    {
        if (!$this->cart) {
            return $this->simpleCart;
        }
        return $this->cart->getContent();
    }

    public function getItemFromShop($itemId): Item
    {
        return $this->iDao->getItemWithId($itemId);
    }

    public function deleteSimpleCartItem($position): void
    {
        $_SESSION['cart'] = $this->simpleCart;
        return;
    }

    public function removeItemFromSimpleCart($itemId)
    {
        foreach ($this->simpleCart as $key => $item){
            if ($item['itemId'] == $itemId){
                unset($this->simpleCart[$key]);
            }
        }
        $_SESSION['cart'] = $this->simpleCart;
        return;
    }
}