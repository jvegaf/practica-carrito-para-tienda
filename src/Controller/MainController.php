<?php


namespace ShoppingCart\Controller;

use ShoppingCart\Model\Client;
use ShoppingCart\Persistence\ItemDAO;

class MainController
{

    private $clientC;
    private $orderC;
    private $shopC;

    public function __construct()
    {
        session_start();
        $this->clientC = new ClientController();
        $this->orderC = new OrderController();
        $this->shopC = new ShopController();
        if (isset($_SESSION['clientId'])) {
            $this->orderC->getOrderId($_SESSION['clientId']);
        } else {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
        }
    }

    public function addItemToCart($itemId)
    {
        $this->orderC->addNewItem($itemId);
    }

    public function checkClientToken($token)
    {
        $result = $this->clientC->checkClientToken($token);
        if ($result){
            $this->orderC->getOrderId($_SESSION['clientId']);
            $oLines = $this->orderC->getOrderLinesOfOrder($_SESSION['orderId']);
            foreach ($oLines as $item) {
                array_push($_SESSION['cart'], $item);
            }
        }
        header("Location: main.php");
    }

    public function loginClient($email, $pass, $remember)
    {
        $result = $this->clientC->login($email, $pass, $remember);
        if ($result == false) {
            header('Location: login.php?error=true');
            exit();
        }

        $this->orderC->getOrderId($_SESSION['clientId']);
        if (isset($_SESSION['cart'])){
            if ( count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $item){
                    $this->orderC->addNewItem($item['itemId']);
                }
            }
        }
        $this->orderC->updateCart();
        header('Location: main.php');
        exit();
    }

    public function isClientLogged(): bool
    {
        if (isset($_SESSION['sesion-started'])) {
            return true;
        }
        return false;
    }

    public function getClientName(): string
    {
        if(isset($_SESSION['sesion-started'])){
            $name = $this->clientC->getFullName($_SESSION['clientId']);
            if ($name != null){
                return $name;
            }
        }
        return "";
    }

    public function getAllShopItems(): array
    {
        return $this->shopC->getItems();
    }

    public function getCartItemsAmount(): int
    {
        $counter = 0;
        foreach ($_SESSION['cart'] as $item){
            $counter+= $item['quantity'];
        }
        return $counter;
    }

    public function getCartItems(): array
    {
        return $_SESSION['cart'];
    }

    public function getItemFromShop($itemId)
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

    public function getImgSrc($itemId): string
    {
        return $this->shopC->getImgSrc($itemId);
    }

}