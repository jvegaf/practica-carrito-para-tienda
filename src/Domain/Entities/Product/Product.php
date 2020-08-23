<?php
declare(strict_types=1);


namespace ShoppingCart\Domain\Entities\Product;


use Ramsey\Uuid\Uuid;

class Product
{
    protected ?string $id;
    protected string $name;
    protected string $description;
    protected float $price;

    public function __construct(string $name, string $description, float $price, string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}