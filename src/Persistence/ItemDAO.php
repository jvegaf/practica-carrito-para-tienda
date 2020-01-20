<?php


namespace ShoppingCart\Persistence;


use ShoppingCart\Model\Item;

class ItemDAO
{
    private $pdo;
    private $getItemWithId = "SELECT * FROM item WHERE id=?";
    private $getAllItems = "SELECT * FROM item";



    public function __construct()
    {
        $this->pdo = DatabaseRepository::getConnection();
    }

    public function getItemWithId($id): Item
    {
        $select = $this->pdo->prepare($this->getItemWithId);
        $select->execute([$id]);
        $rs = $select->fetch();
        return new Item(
            $id,
            $rs['name'],
            $rs['description'],
            $rs['price']
        );
    }

    public function getAll(): array
    {
        $items = array();
        $select = $this->pdo->prepare($this->getAllItems);
        $select->execute();
        $rs = $select->fetchAll();
        foreach ($rs as $row){
            $item = new Item(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price']
            );
            array_push($items, $item);
        }
        return $items;
    }
}