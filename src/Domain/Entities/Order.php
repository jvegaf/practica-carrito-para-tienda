<?php


namespace ShoppingCart\Domain\Entities;


class Order
{
    private $id;
    private $clientId;
    private $shippingAdress;
    private $confirmedDate;


    /**
     * Order constructor.
     * @param $id
     * @param $clientId
     * @param $shippingAdress
     * @param $confirmedDate
     */
    public function __construct($id, $clientId, $shippingAdress, $confirmedDate)
    {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->shippingAdress = $shippingAdress;
        $this->confirmedDate = $confirmedDate;
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
    public function getShippingAdress()
    {
        return $this->shippingAdress;
    }

    /**
     * @param mixed $shippingAdress
     */
    public function setShippingAdress($shippingAdress): void
    {
        $this->shippingAdress = $shippingAdress;
    }

    /**
     * @return mixed
     */
    public function getConfirmedDate()
    {
        return $this->confirmedDate;
    }

    /**
     * @param mixed $confirmedDate
     */
    public function setConfirmedDate($confirmedDate): void
    {
        $this->confirmedDate = $confirmedDate;
    }
}