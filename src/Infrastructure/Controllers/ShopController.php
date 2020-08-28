<?php


namespace ShoppingCart\Infrastructure\Controllers;


use ShoppingCart\Application\UseCases\Item\GetItemImage;
use ShoppingCart\Domain\Entities\Product\Product;
use ShoppingCart\Infrastructure\Persistence\Product\MySQLProductRepository;

class ShopController
{

    private MySQLProductRepository $productsRepository;

    /**
     * ShopController constructor.
     */
    public function __construct()
    {
        $this->productsRepository = new MySQLProductRepository();
    }

    /**
     * @return array
     */
    public function getAllProducts(): array
    {
        return $this->productsRepository->getAll();
    }

    public function getProduct($id): Product
    {
        return $this->productsRepository->getOfId($id);
    }

    public function getImg($itemId): string
    {
        $getImgUseCase = new GetItemImage($itemId);
        return $getImgUseCase->execute();
    }
}