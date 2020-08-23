<?php

declare(strict_types=1);


namespace ShoppingCart\Infrastructure\Persistence\Product;


use ShoppingCart\Domain\Entities\Product\Product;
use ShoppingCart\Domain\Entities\Product\ProductRepository;

class MySQLProductRepository implements ProductRepository
{

    public function getOfId(string $id): Product
    {
        // TODO: Implement getOfId() method.
    }

    public function add(Product $product): void
    {
        // TODO: Implement add() method.
    }

    public function update(Product $product): void
    {
        // TODO: Implement update() method.
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }
}