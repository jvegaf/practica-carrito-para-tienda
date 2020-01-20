<?php


namespace ShoppingCart\Persistence;


use ShoppingCart\Model\Client;

class ClientDAO
{
    private $pdo;
    private $getClientWithId = "SELECT * FROM client WHERE id=?";
    private $getAllClients = "SELECT * FROM client";
    private $getClientWithEmail = "SELECT * FROM client WHERE email=?";

    public function __construct()
    {
        $this->pdo = DatabaseRepository::getConnection();
    }

    public function getClientWithId($id)
    {
        $select = $this->pdo->prepare($this->getClientWithId);
        $select->execute([$id]);
        $rs = $select->fetch();
        return new Client(
            $id,
            $rs['password'],
            $rs['name'],
            $rs['surname_first'],
            $rs['surname_last'],
            $rs['email'],
            $rs['ci'],
            $rs['address']
        );
    }

    public function getClientWithEmail($email)
    {
        $select = $this->pdo->prepare($this->getClientWithEmail);
        $select->execute([$email]);
        $rs = $select->fetch();
        return new Client(
            $rs['id'],
            $rs['password'],
            $rs['name'],
            $rs['surname_first'],
            $rs['surname_last'],
            $email,
            $rs['ci'],
            $rs['address']
        );
    }

    public function getAll()
    {
        $clients = array();
        $select = $this->pdo->prepare($this->getAllClients);
        $select->execute();
        $rs = $select->fetchAll();
        foreach ($rs as $row) {
            $client = new Client(
                $row['id'],
                $row['password'],
                $row['name'],
                $row['surname_first'],
                $row['surname_last'],
                $row['email'],
                $row['ci'],
                $row['address']
            );
            array_push($clients, $client);
        }
        return $clients;
    }


}