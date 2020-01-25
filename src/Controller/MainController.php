<?php


namespace ShoppingCart\Controller;

use ShoppingCart\Model\Client;
use ShoppingCart\Model\Item;
use ShoppingCart\Persistence\ItemDAO;

class MainController
{

    private $clientC;
    private $orderC;
    private $shopC;
    private $client;
    private $order;

    public function __construct()
    {
        session_start();
        $this->clientC = new ClientController();
        $this->orderC = new OrderController();
        $this->shopC = new ShopController();

        // revisar
        if (isset($_SESSION['clientId'])) {
            $this->client = $this->clientC->getClient($_SESSION['clientId']);
            $this->order = $this->orderC->getOrderOfClient($this->client->getId());
            // TODO: traer carro
        } else {
            $this->order = $this->orderC->getOrderOfClient(null);
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
        }
    }

    public function addItemToCart($itemId)
    {
        foreach ($_SESSION['cart'] as $item) {
            if ($item['itemId'] == $itemId) {
                $item['quantity']++;
                $_SESSION['cart'] = $_SESSION['cart'];
                exit();
            }
        }
        array_push($_SESSION['cart'], [
            "itemId" => $itemId,
            "orderId" => $this->order->getId(),
            "quantity" => 1
        ]);
        $_SESSION['cart'] = $_SESSION['cart'];
        if ($this->isClientLogged()) {
            $this->orderC->addNewItemToOrder($itemId, $this->order->getId());
        }
    }

    public function checkClientToken($token)
    {
        $client = $this->clientC->getClientWithToken($token);
        if ($client) {
            $this->client = $client;
            $_SESSION['sesion-started'] = true;
            $_SESSION['clientId'] = $this->client->getId();
            $_SESSION['orderId'] = $this->orderC->getOrderOfClient($this->client->getId())->getId();
            $oLines = $this->orderC->getOrderLinesOfOrder($this->order->getId());
            foreach ($oLines as $item) {
                array_push($_SESSION['cart'], $item);
            }
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
        $_SESSION['orderId'] = $this->orderC->getOrderOfClient($this->client->getId())->getId();
        $_SESSION['sesion-started'] = true;
        $_SESSION['clientId'] = $this->client->getId();
        if (!isEmpty($_SESSION['cart'])) { // si la cesta no esta vacia
            foreach ($_SESSION['cart'] as $item){
                $this->orderC->addNewItemToOrder($item);
            }
        }
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
        return count($_SESSION['cart']);
    }

    public function getCartItems(): array
    {
        return $_SESSION['cart'];
    }

    public function getItemFromShop($itemId): Item
    {
        return $this->shopC->getItem($itemId);
    }

    public function removeItemInCart($itemId)
    {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['itemId'] == $itemId) {
                unset($_SESSION['cart'][$key]);
            }
        }
        return;
    }

}