<?php


namespace ShoppingCart\Controllers;


use ShoppingCart\Persistence\ItemDAO;

class ShopController
{

    private $itemsDao;


    /**
     * ShopController constructor.
     */
    public function __construct()
    {
        $this->itemsDao = new ItemDAO();
    }

    private function __clone()
    {
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->itemsDao->getAll();
    }

    public function getItem($id){
        return $this->itemsDao->getItemWithId($id);
    }

    public function getImgSrc($itemId): string
    {
        return "/items-img/" . $itemId . ".jpg";
    }
}