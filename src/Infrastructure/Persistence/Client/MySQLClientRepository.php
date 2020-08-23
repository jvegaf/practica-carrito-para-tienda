<?php

declare(strict_types=1);


namespace ShoppingCart\Infrastructure\Persistence\Client;


use ShoppingCart\Domain\Entities\Client\Client;
use ShoppingCart\Domain\Entities\Client\ClientRepository;

class MySQLClientRepository implements ClientRepository
{

    public function exists(string $email): bool
    {
        // TODO: Implement exists() method.
    }

    public function getWithId(string $id): Client
    {
        // TODO: Implement getWithId() method.
    }

    public function getWithEmail(string $email): Client
    {
        // TODO: Implement getWithEmail() method.
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function add(Client $client): void
    {
        // TODO: Implement add() method.
    }

    public function update(Client $client): void
    {
        // TODO: Implement update() method.
    }
}