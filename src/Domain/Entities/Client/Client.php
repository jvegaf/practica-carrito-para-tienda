<?php

declare(strict_types=1);

namespace ShoppingCart\Domain\Entities\Client;


use Ramsey\Uuid\Uuid;

class Client
{
    protected ?string $id;
    protected string $email;
    protected string $password;
    protected string $name;
    protected string $address;
    protected string $phone;


    public function __construct(
        string $email,
        string $password,
        string $name,
        string $address,
        string $phone,
        string $id = null
    ) {
        $this->id = $id ?? Uuid::uuid4()->toString();
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}