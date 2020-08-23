<?php

namespace ShoppingCart\Domain\Entities\Client;

interface ClientRepository
{
    public function exists(string $email): bool;

    public function getOfId(string $id): Client;

    public function getOfEmail(string $email): Client;

    public function getAll(): array;

    public function add(Client $client): void;

    public function update(Client $client): void;
}