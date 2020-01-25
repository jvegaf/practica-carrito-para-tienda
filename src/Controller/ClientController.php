<?php


namespace ShoppingCart\Controller;


use ShoppingCart\Model\Client;
use ShoppingCart\Persistence\ClientDAO;

class ClientController
{
    private $cDao;
    private $client;


    public function __construct()
    {
        $this->cDao = new ClientDAO();
    }

    public function login($email, $passwd): Client
    {
        $client = $this->cDao->getClientWithEmail($email);
        if (isset($client)) {
            if ($client->getPassword() == $passwd) {
                $this->client = $client;
                return $this->client;
            }
        }
        return null;
    }

    public function getClient($id): Client
    {
        return $this->cDao->getClientWithId($id);
    }

    public function registerNewClient($email, $pass, $name, $addr, $phone): void
    {
        $this->cDao->insertClient(
            $email,
            $pass,
            $name,
            $addr,
            $phone,
            true
        );
        return;
    }


    public function checkEmail($email)
    {
        $response = $this->cDao->checkUserEmail($email);
        if ($response == null) {
            return false;
        }
        return true;
    }

    public function getClientWithToken($token): Client
    {
        $user = $this->cDao->getClientWithToken($token);
        if ($user->getId()) {
            return $user;
        }
        return null;
    }
}