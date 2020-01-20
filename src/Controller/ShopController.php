<?php


namespace ShoppingCart\Controller;


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

}