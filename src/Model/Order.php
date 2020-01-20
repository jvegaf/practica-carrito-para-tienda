<?php


namespace ShoppingCart\Model;


class Order
{
    private $id;
    private $clientId;
    private $confirmed;
    private $cart;

    /**
     * Order constructor.
     * @param $id
     * @param $clientId
     * @param $confirmed
     */

    public function __construct($id, $clientId, $confirmed)
    {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->confirmed = $confirmed;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param mixed $confirmed
     */
    public function setConfirmed($confirmed): void
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return mixed
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * @param mixed $cart
     */
    public function setCart($cart): void
    {
        $this->cart = $cart;
    }
}