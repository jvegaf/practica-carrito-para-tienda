<?php


namespace ShoppingCart\Model;


class Client
{
    private $id;
    private $email;
    private $password;
    private $cookieCode;
    private $name;
    private $address;
    private $phone;
    private $enrolled;

    /**
     * Client constructor.
     * @param $id
     * @param $email
     * @param $password
     * @param $cookieCode
     * @param $name
     * @param $address
     * @param $phone
     * @param $enrolled
     */
    public function __construct($id, $email, $password, $cookieCode, $name, $address, $phone, $enrolled)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->cookieCode = $cookieCode;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->enrolled = $enrolled;
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
    public function getCookieCode()
    {
        return $this->cookieCode;
    }

    /**
     * @param mixed $cookieCode
     */
    public function setCookieCode($cookieCode): void
    {
        $this->cookieCode = $cookieCode;
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

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEnrolled()
    {
        return $this->enrolled;
    }

    /**
     * @param mixed $enrolled
     */
    public function setEnrolled($enrolled): void
    {
        $this->enrolled = $enrolled;
    }
}