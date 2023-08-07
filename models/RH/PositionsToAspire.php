<?php

class PositionsToAspire
{

    private $id;
    private $department;
    private $id_position;
    private $id_position_to_aspire;
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

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
    }

    public function getId_position()
    {
        return $this->id_position;
    }

    public function setId_position($id_position)
    {
        $this->id_position = $id_position;
    }

    public function getId_position_to_aspire()
    {
        return $this->id_position_to_aspire;
    }

    public function setId_position_to_aspire($id_position_to_aspire)
    {
        $this->id_position_to_aspire = $id_position_to_aspire;
    }

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.positions_to_aspire WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM root.positions_to_aspire");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


    public function getAllPositionsToAspireByIdPosition()
    {
        $result = false;
        $id_position = $this->getId_position();
        $stmt = $this->db->prepare("SELECT p.id as id_positions, pa.id,pa.id_position_to_aspire FROM root.positions p, root.positions_to_aspire pa WHERE p.id=pa.id_position AND pa.id_position=:id_position");
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


    public function save()
    {
        $result = false;
        $department = $this->getDepartment();
        $id_position = $this->getId_position();
        $id_position_to_aspire = $this->getId_position_to_aspire();

        $stmt = $this->db->prepare("INSERT INTO root.positions_to_aspire (id_position,id_position_to_aspire) VALUES	(:id_position,:id_position_to_aspire)");

        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);
        $stmt->bindParam(":id_position_to_aspire", $id_position_to_aspire, PDO::PARAM_STR);

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
        $department = $this->getDepartment();
        $id_position = $this->getId_position();
        $id_position_to_aspire = $this->getId_position_to_aspire();

        $stmt = $this->db->prepare("UPDATE root.positions_to_aspire 
									SET department=:department,id_position=:id_position,id_position_to_aspire=:id_position_to_aspire
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":department", $department, PDO::PARAM_STR);
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);
        $stmt->bindParam(":id_position_to_aspire", $id_position_to_aspire, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }



    public function deleteByIdPosition()
    {
        $id_position = $this->getId_position();
        $stmt = $this->db->prepare("DELETE root.positions_to_aspire WHERE id_position=:id_position");
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }
}
