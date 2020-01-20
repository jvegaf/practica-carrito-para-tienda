<?php


namespace ShoppingCart\Model;


class Client
{
    private $id;
    private $password;
    private $name;
    private $surnameFirst;
    private $surnameLast;
    private $email;
    private $ci;
    private $address;

    /**
     * Client constructor.
     * @param $id
     * @param $password
     * @param $name
     * @param $surnameFirst
     * @param $surnameLast
     * @param $email
     * @param $ci
     * @param $address
     */
    public function __construct($id, $password, $name, $surnameFirst, $surnameLast, $email, $ci, $address)
    {
        $this->id = $id;
        $this->password = $password;
        $this->name = $name;
        $this->surnameFirst = $surnameFirst;
        $this->surnameLast = $surnameLast;
        $this->email = $email;
        $this->ci = $ci;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurnameFirst()
    {
        return $this->surnameFirst;
    }

    /**
     * @param mixed $surnameFirst
     */
    public function setSurnameFirst($surnameFirst): void
    {
        $this->surnameFirst = $surnameFirst;
    }

    /**
     * @return mixed
     */
    public function getSurnameLast()
    {
        return $this->surnameLast;
    }

    /**
     * @param mixed $surnameLast
     */
    public function setSurnameLast($surnameLast): void
    {
        $this->surnameLast = $surnameLast;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * @param mixed $ci
     */
    public function setCi($ci): void
    {
        $this->ci = $ci;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }
}