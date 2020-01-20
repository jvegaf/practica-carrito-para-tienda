<?php


namespace ShoppingCart\Model;


class Item
{
    private $id;
    private $name;
    private $description;
    private $price;

    /**
     * Item constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $price
     */
    public function __construct($id, $name, $description, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getImgSrc()
    {
        return "items-img/" . $this->getId() . ".jpg";
    }
}