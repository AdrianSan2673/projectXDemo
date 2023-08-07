<?php

class SpecificResponsabilities
{

    private $id;
    private $responsability;
    private $activities;
    private $id_position;
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

    public function getResponsability()
    {
        return $this->responsability;
    }

    public function setResponsability($responsability)
    {
        $this->responsability = $responsability;
    }

    public function getActivities()
    {
        return $this->activities;
    }

    public function setActivities($activities)
    {
        $this->activities = $activities;
    }

    public function getId_position()
    {
        return $this->id_position;
    }

    public function setId_position($id_position)
    {
        $this->id_position = $id_position;
    }

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.specific_responsabilities WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM root.specific_responsabilities");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getAllByIdPosition()
    {
        $id_position=$this->getId_position();
        $stmt = $this->db->prepare("SELECT * FROM root.specific_responsabilities WHERE id_position=:id_position");
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


    public function save()
    {
        $result = false;
        $responsability = $this->getResponsability();
        $activities = $this->getActivities();
        $id_position = $this->getId_position();

        $stmt = $this->db->prepare("INSERT INTO root.specific_responsabilities (responsability,activities,id_position) VALUES	(:responsability,:activities,:id_position)");

        $stmt->bindParam(":responsability", $responsability, PDO::PARAM_STR);
        $stmt->bindParam(":activities", $activities, PDO::PARAM_STR);
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }

        return $result;
    }


    public function update()
    {
        $result = false;

        $id = $this->getId();
        $responsability = $this->getResponsability();
        $activities = $this->getActivities();
        $id_position = $this->getId_position();

        $stmt = $this->db->prepare("UPDATE root.specific_responsabilities 
									SET responsability=:responsability,activities=:activities
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":responsability", $responsability, PDO::PARAM_STR);
        $stmt->bindParam(":activities", $activities, PDO::PARAM_STR);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }


    public function delete(){
        $id=$this->getId();
        $stmt = $this->db->prepare("DELETE root.specific_responsabilities WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }

        return $result;
    }


}
