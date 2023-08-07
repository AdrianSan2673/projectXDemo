<?php

class SupervisingPositions
{

    private $id;
    private $id_position;
    private $id_supervising_position;
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

    public function getId_position()
    {
        return $this->id_position;
    }

    public function setId_position($id_position)
    {
        $this->id_position = $id_position;
    }

    public function getId_supervising_position()
    {
        return $this->id_supervising_position;
    }

    public function setId_supervising_position($id_supervising_position)
    {
        $this->id_supervising_position = $id_supervising_position;
    }



    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.supervising_positions WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM supervising_positions");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


    public function save()
    {
        $result = false;
        $id_position = $this->getId_position();
        $id_supervising_position = $this->getId_supervising_position();

        $stmt = $this->db->prepare("INSERT INTO root.supervising_positions (id_position,id_supervising_position) VALUES	(:id_position,:id_supervising_position)");

        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);
        $stmt->bindParam(":id_supervising_position", $id_supervising_position, PDO::PARAM_STR);

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
        $id_position = $this->getId_position();
        $id_supervising_position = $this->getId_supervising_position();

        $stmt = $this->db->prepare("UPDATE .root.supervising_positions 
									SET id_position=:id_position,id_supervising_position=:id_supervising_position
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);
        $stmt->bindParam(":id_supervising_position", $id_supervising_position, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }


    public function deleteByIdPosition()
    {
        $result = false;

        $id_position = $this->getId_position();
        $stmt = $this->db->prepare("DELETE root.supervising_positions WHERE id_position=:id_position");
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }


        return $result;
    }
}
