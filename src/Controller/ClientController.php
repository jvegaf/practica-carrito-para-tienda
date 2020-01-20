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

    public function login($email, $passwd): Client{
        $client = $this->cDao->getClientWithEmail($email);
        if (isset($client)) if ($client->getPassword() == $passwd){
            $this->client = $client;
            return $this->client;
        }
        return null;
    }

    public function getClientWithId($id): Client{
        return $this->cDao->getClientWithId($id);
    }
}