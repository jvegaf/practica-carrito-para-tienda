<?php
declare(strict_types=1);

namespace ShoppingCart\Infrastructure\Controllers;


use ShoppingCart\Application\UseCases\Client\RegisterNewClientUseCase;
use ShoppingCart\Domain\Entities\Client\Client;
use ShoppingCart\Domain\Entities\Client\ClientRepository;
use ShoppingCart\Infrastructure\Persistence\Client\MySQLClientRepository;

class ClientController
{
    private ClientRepository $clientRepository;

    public function __construct()
    {
        $this->clientRepository = new MySQLClientRepository();
    }

    public function Register(string $name, string $email, string $passwd, string $phone, string $address): void
    {
        $registerUseCase = new RegisterNewClientUseCase($this->clientRepository);
        $registerUseCase->execute(new Client($email,$passwd,$name,$address,$phone));
    }
}