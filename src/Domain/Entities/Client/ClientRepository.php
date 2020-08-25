<?php

namespace ShoppingCart\Domain\Entities\Client;

interface ClientRepository
{
    public function getWithId(string $id): ?Client;

    public function getWithEmail(string $email): ?Client;

    public function getAll(): array;

    public function add(Client $client): void;

    public function update(Client $client): void;
}