<?php

declare(strict_types=1);


namespace ShoppingCart\Infrastructure\Persistence\Product;


use ShoppingCart\Domain\Entities\Product\Product;
use ShoppingCart\Domain\Entities\Product\ProductRepository;
use ShoppingCart\Infrastructure\Persistence\Shared\MySQLRepository;

class MySQLProductRepository extends MySQLRepository implements ProductRepository
{
    private const GET_WITH_ID = "SELECT * FROM product WHERE id=?";
    private const GET_ALL = "SELECT * FROM product";
    private const ADD = "INSERT INTO product (id, name, description, price) VALUES (?,?,?,?)";

    public function getOfId(string $id): ?Product
    {
        $select = $this->pdo->prepare($this::GET_WITH_ID);
        $select->execute([$id]);
        $rs = $select->fetch();
        return new Product(
            $rs['name'],
            $rs['description'],
            $rs['price'],
            $rs['id']
        );
    }

    public function add(Product $product): void
    {
        $this->pdo->prepare($this::ADD)
            ->execute(
                [
                    $product->getId(),
                    $product->getName(),
                    $product->getDescription(),
                    $product->getPrice()
                ]
            );
    }

    public function update(Product $product): void
    {
        // TODO: Implement update() method.
    }

    public function remove(Product $product): void
    {
        // TODO: Implement remove() method.
    }

    public function getAll(): array
    {
        $products = array();
        $select = $this->pdo->prepare($this::GET_ALL);
        $select->execute();
        $rs = $select->fetchAll();
        foreach ($rs as $row) {
            $product = new Product(
                $row['name'],
                $row['description'],
                $row['price'],
                $row['id']
            );
            array_push($products, $product);
        }
        return $products;
    }
}