<?php

declare(strict_types=1);


namespace ShoppingCart\Infrastructure\Persistence\Client;


use ShoppingCart\Domain\Entities\Client\Client;
use ShoppingCart\Domain\Entities\Client\ClientRepository;
use ShoppingCart\Infrastructure\Persistence\Shared\MySQLRepository;

class MySQLClientRepository extends MySQLRepository implements ClientRepository
{

    private const GET_WITH_ID = "SELECT * FROM client WHERE id=?";
    private const GET_ALL = "SELECT * FROM client";
    private const GET_WITH_EMAIL = "SELECT * FROM client WHERE email=?";
    private const ADD = "INSERT INTO client(id, email, password, name, address, phone) VALUES (?,?,?,?,?,?)";

    public function getWithId(string $id): ?Client
    {
        $select = $this->pdo->prepare($this::GET_WITH_ID);
        $select->execute([$id]);
        $rs = $select->fetch();
        return new Client(
            $rs['email'],
            $rs['password'],
            $rs['name'],
            $rs['address'],
            $rs['phone'],
            $rs['id']
        );
    }

    public function getWithEmail(string $email): ?Client
    {
        $select = $this->pdo->prepare($this::GET_WITH_EMAIL);
        $select->execute([$email]);
        $rs = $select->fetch();
        return new Client(
            $rs['email'],
            $rs['password'],
            $rs['name'],
            $rs['address'],
            $rs['phone'],
            $rs['id']
        );
    }

    public function getAll(): array
    {
        $clients = array();
        $select = $this->pdo->prepare($this::GET_ALL);
        $select->execute();
        $rs = $select->fetchAll();
        foreach ($rs as $row) {
            $client = new Client(
                $row['email'],
                $row['password'],
                $row['name'],
                $row['address'],
                $row['phone'],
                $row['id']
            );
            array_push($clients, $client);
        }
        return $clients;
    }

    public function add(Client $client): void
    {
        $this->pdo->prepare($this::ADD)
            ->execute(
                [
                    $client->getId(),
                    $client->getEmail(),
                    $client->getPassword(),
                    $client->getName(),
                    $client->getAddress(),
                    $client->getPhone()
                ]
            );
    }

    public function update(Client $client): void
    {
        // TODO: Implement update() method.
    }
}