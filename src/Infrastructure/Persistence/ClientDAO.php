<?php


namespace ShoppingCart\Infrastructure\Persistence;


use ShoppingCart\Domain\Entities\Client\Client;

class ClientDAO
{
    private $pdo;
    private $getClientWithId = "SELECT * FROM cliente WHERE id=?";
    private $getAllClients = "SELECT * FROM cliente";
    private $getClientWithEmail = "SELECT * FROM cliente WHERE email=?";
    private $getEmail = "SELECT `email` FROM cliente WHERE email=?";
    private $insertClient = "INSERT INTO cliente (email, contrasenna, nombre, direccion, telefono, registrado) VALUES (?,?,?,?,?,?)";
    private $getWithToken = "SELECT * FROM cliente WHERE codigoCookie=?";
    private $updateToken = "UPDATE cliente SET codigoCookie=? WHERE id=?";


    public function __construct()
    {
        $this->pdo = MySQLDatabase::getConnection();
    }

    public function getClientWithId($id)
    {
        $select = $this->pdo->prepare($this->getClientWithId);
        $select->execute([$id]);
        $rs = $select->fetch();
        return new Client(
            $rs['id'],
            $rs['email'],
            $rs['contrasenna'],
            $rs['nombre'],
            $rs['direccion'],
            $rs['telefono'],
        );
    }

    public function getClientWithEmail($email)
    {
        $select = $this->pdo->prepare($this->getClientWithEmail);
        $select->execute([$email]);
        $rs = $select->fetch();
        return new Client(
            $rs['id'],
            $rs['email'],
            $rs['contrasenna'],
            $rs['nombre'],
            $rs['direccion'],
            $rs['telefono']
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
                $rs['id'],
                $rs['email'],
                $rs['contrasenna'],
                $rs['nombre'],
                $rs['direccion'],
                $rs['telefono']
            );
            array_push($clients, $client);
        }
        return $clients;
    }

    public function checkUserEmail($email)
    {
        $select = $this->pdo->prepare($this->getEmail);
        $select->execute([$email]);
        return $select->fetch();
    }

    public function insertClient($email, $pass, $name, $addr, $phone)
    {
        $this->pdo->prepare($this->insertClient)
            ->execute(
                [
                    $email,
                    $pass,
                    $name,
                    $addr,
                    $phone
                ]
            );
    }

    public function getClientWithToken($token): Client
    {
        $select = $this->pdo->prepare($this->getWithToken);
        $select->execute([$token]);
        $rs = $select->fetch();
        return new Client(
            $rs['id'],
            $rs['email'],
            $rs['contrasenna'],
            $rs['nombre'],
            $rs['direccion'],
            $rs['telefono'],
        );
    }

    public function updateClientToken($clientId, $token)
    {
        $this->pdo->prepare($this->updateToken)
            ->execute([$token, $clientId]);
    }

    public function deleteToken($clientId)
    {
        $this->pdo->prepare($this->updateToken)
            ->execute([null, $clientId]);
    }

}