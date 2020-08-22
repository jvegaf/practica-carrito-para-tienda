<?php


namespace ShoppingCart\Infrastructure\Controllers;


use ShoppingCart\Application\UseCases\Client\RegisterNewClientUseCase;
use ShoppingCart\Domain\Entities\Client;
use ShoppingCart\Infrastructure\Persistence\ClientDAO;

class ClientController
{
    private $cDao;


    public function __construct()
    {
        session_start();
        $this->cDao = new ClientDAO();
    }

    public function login($email, $pass, $remember): bool
    {

        $client = $this->cDao->getClientWithEmail($email);
        if (isset($client)) {
            if ($client->getPassword() == $pass) {
                $_SESSION['sesion-started'] = true;
                $_SESSION['clientId'] = $client->getId();
                if ($remember){
                    $this->addToken($client->getId());
                }
                return true;
            }
        }
        return false;
    }

    public function getClient($id): Client
    {
        return $this->cDao->getClientWithId($id);
    }

    public function registerNewClient($email, $pass, $name, $addr, $phone): void
    {
        (new RegisterNewClientUseCase($this->cDao))->execute(
            $email,
            $pass,
            $name,
            $addr,
            $phone
        );
    }

    public function getFullName($clientId)
    {
        return $this->getClient($clientId)->getName();
    }

    public function checkEmail($email)
    {
        $response = $this->cDao->checkUserEmail($email);
        if ($response == null) {
            return false;
        }
        return true;
    }

    public function checkClientToken($token): bool
    {
        $client = $this->cDao->getClientWithToken($token);
        if ($client) {
            $_SESSION['sesion-started'] = true;
            $_SESSION['clientId'] = $client->getId();
            $this->renewToken($client->getId());
            return true;
        }
        return false;
    }

    public function addToken($clientId): void
    {
        $value = date("YmdHi") . $clientId;
        $token = hash('sha1', $value);
        $this->cDao->updateClientToken($clientId, $token);
        setcookie('token', $token, strtotime( '+30 days' ));
        return;
    }

    public function renewToken($clientId): void
    {
        $this->addToken($clientId);
        return;
    }

    public function deleteToken($clientId): void
    {
        $this->cDao->deleteToken($clientId);
    }
}