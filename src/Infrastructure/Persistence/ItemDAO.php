<?php


namespace ShoppingCart\Infrastructure\Persistence;



class ItemDAO
{
    private $pdo;
    private $getItemWithId = "SELECT * FROM producto WHERE id=?";
    private $getAllItems = "SELECT * FROM producto";



    public function __construct()
    {
        $this->pdo = DatabaseRepository::getConnection();
    }

    public function getItemWithId($id)
    {
        $select = $this->pdo->prepare($this->getItemWithId);
        $select->execute([$id]);
        $rs = $select->fetch();
        return [
            "itemId" => $rs['id'],
            "itemName" => $rs['nombre'],
            "itemDesc" => $rs['descripcion'],
            "itemPrice" => $rs['precio']
        ];
    }

    public function getAll(): array
    {
        $items = array();
        $select = $this->pdo->prepare($this->getAllItems);
        $select->execute();
        $rs = $select->fetchAll();
        foreach ($rs as $row){
            array_push($items, [
                "itemId" => $row['id'],
                "itemName" => $row['nombre'],
                "itemDesc" => $row['descripcion'],
                "itemPrice" => $row['precio']
            ]);
        }
        return $items;
    }
}