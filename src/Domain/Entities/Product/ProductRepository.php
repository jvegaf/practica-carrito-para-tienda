<?php


namespace ShoppingCart\Domain\Entities\Product;


interface ProductRepository
{
    public function getOfId(string $id): Product;

    public function add(Product $product): void;

    public function update(Product $product): void;

    public function getAll(): array;
}