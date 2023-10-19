<?php

class WorkDays
{


    private $id;
    private $sunday;
    private $monday;
    private $tuesday;
    private $wednesday;
    private $thursday;
    private $friday;
    private $saturday;
    private $Cliente;
    private $Empresa;
    private $created_at;
    private $modified_at;

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

    public function getSunday()
    {
        return $this->sunday;
    }

    public function setSunday($sunday)
    {
        $this->sunday = $sunday;
    }

    public function getMonday()
    {
        return $this->monday;
    }

    public function setMonday($monday)
    {
        $this->monday = $monday;
    }

    public function getTuesday()
    {
        return $this->tuesday;
    }

    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;
    }

    public function getWednesday()
    {
        return $this->wednesday;
    }

    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;
    }

    public function getThursday()
    {
        return $this->thursday;
    }

    public function setThursday($thursday)
    {
        $this->thursday = $thursday;
    }

    public function getFriday()
    {
        return $this->friday;
    }

    public function setFriday($friday)
    {
        $this->friday = $friday;
    }

    public function getSaturday()
    {
        return $this->saturday;
    }

    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;
    }

    public function getCliente()
    {
        return $this->Cliente;
    }

    public function setCliente($Cliente)
    {
        $this->Cliente = $Cliente;
    }

    public function getEmpresa()
    {
        return $this->Empresa;
    }

    public function setEmpresa($Empresa)
    {
        $this->Empresa = $Empresa;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getModified_at()
    {
        return $this->modified_at;
    }

    public function setModified_at($modified_at)
    {
        $this->modified_at = $modified_at;
    }

    public function getOne()
    {
        $cliente = $this->getCliente();
        $stmt = $this->db->prepare("SELECT TOP 1 * FROM root.work_days  WHERE Cliente=:cliente");
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchObject();

        return $result;
    }
}
