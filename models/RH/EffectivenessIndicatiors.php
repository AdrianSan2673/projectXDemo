<?php

class EffectivenessIndicatiors
{

    private $id;
    private $indicator;
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

    public function getIndicator()
    {
        return $this->indicator;
    }

    public function setIndicator($indicator)
    {
        $this->indicator = $indicator;
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
        $stmt = $this->db->prepare("SELECT * FROM root.effectiveness_indicatiors WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAllByIdPosition()
    {
        $id_position = $this->getId_position();
        $stmt = $this->db->prepare("SELECT * FROM root.effectiveness_indicatiors WHERE id_position=:id_position");
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;
        $indicator = $this->getIndicator();
        $id_position = $this->getId_position();

        $stmt = $this->db->prepare("INSERT INTO root.effectiveness_indicatiors (indicator,id_position) VALUES (:indicator,:id_position)");

        $stmt->bindParam(":indicator", $indicator, PDO::PARAM_STR);
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
        $indicator = $this->getindicator();
        $id_position = $this->getId_position();

        $stmt = $this->db->prepare("UPDATE root.effectiveness_indicatiors 
									SET indicator=:indicator
									WHERE id=:id");

        $stmt->bindParam(":indicator", $indicator, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

    public function delete()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("DELETE root.effectiveness_indicatiors WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }

        return $result;
    }
}
