<?php


namespace ShoppingCart\Infrastructure\Controllers;


use ShoppingCart\Application\UseCases\Item\GetItemImage;
use ShoppingCart\Infrastructure\Persistence\ItemDAO;

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

    public function getImg($itemId): string
    {
        $getImgUseCase = new GetItemImage($itemId);
        return $getImgUseCase->execute();
    }
}