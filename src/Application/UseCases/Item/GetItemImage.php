<?php

declare(strict_types=1);


namespace ShoppingCart\Application\UseCases\Item;


use ShoppingCart\Services\ImageBase64\CanNotLoadImageException;
use ShoppingCart\Services\ImageBase64\ImageToBase64Encoder;

class GetItemImage
{
    private string $itemId;
    private const PATH = __DIR__ . "/../../../../img-data/";

    public function __construct(string $itemId)
    {
        $this->itemId = $itemId;
    }

    public function execute(): string
    {
        $encoder = new ImageToBase64Encoder(self::PATH . $this->itemId . ".jpg");
        try {
            $result = $encoder->execute();
        } catch (CanNotLoadImageException $e) {
            printf($e->getMessage());
        }
        return $result;
    }
}