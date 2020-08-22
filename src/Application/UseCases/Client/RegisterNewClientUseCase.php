<?php


namespace ShoppingCart\Application\UseCases\Client;

use ShoppingCart\Infrastructure\Persistence\ClientDAO;

class RegisterNewClientUseCase
{
    private $cDao;

    public function __construct(ClientDAO $clientDao)
    {
        $this->cDao = $clientDao;
    }

    public function execute(
        $email,
        $pass,
        $name,
        $addr,
        $phone)
    {
        $this->cDao->insertClient(
            $email,
            $pass,
            $name,
            $addr,
            $phone,
            true
        );
    }

}