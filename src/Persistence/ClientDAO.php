<?php


namespace ShoppingCart\Persistence;


use ShoppingCart\Model\Client;

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

    public function checkUserEmail($email)
    {
        $select = $this->pdo->prepare($this->getEmail);
        $select->execute([$email]);
        return $select->fetch();
    }

    public function insertClient($email, $pass, $name, $addr, $phone, bool $enrolled)
    {
        $this->pdo->prepare($this->insertClient)
            ->execute([
                $email,
                $pass,
                $name,
                $addr,
                $phone,
                $enrolled
            ]);
        return;
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
            $rs['codigoCookie'],
            $rs['nombre'],
            $rs['direccion'],
            $rs['telefono'],
            $rs['registrado']
        );
    }

    public function updateClientToken($clientId, $token)
    {
        $select = $this->pdo->prepare($this->updateToken)
            ->execute([$token, $clientId]);
    }
}