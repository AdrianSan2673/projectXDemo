<?php

class PackagesRH
{
    private $id;
    private $name;
    private $cost;
    private $status;
    private $number_employees;
    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getNumber_employees()
    {
        return $this->number_employees;
    }

    public function setNumber_employees($number_employees)
    {
        $this->number_employees = $number_employees;
    }

    public function getOne()
    {

        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.packages_RH WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM root.packages_RH");
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
}
