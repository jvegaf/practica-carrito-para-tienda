<?php


namespace ShoppingCart\Services\Client;

use ShoppingCart\Persistence\ClientDAO;

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