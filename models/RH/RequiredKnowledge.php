<?php

class RequiredKnowledge
{

    private $id;
    private $knowledge;
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

    public function getKnowledge()
    {
        return $this->knowledge;
    }

    public function setKnowledge($knowledge)
    {
        $this->knowledge = $knowledge;
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
        $stmt = $this->db->prepare("SELECT * FROM root.required_knowledge WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM required_knowledge");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getAllByIdPosition()
    {
        $id_position=$this->getId_position();
        $stmt = $this->db->prepare("SELECT * FROM root.required_knowledge WHERE id_position=:id_position");
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;
        $knowledge = $this->getKnowledge();
        $id_position = $this->getId_position();

        $stmt = $this->db->prepare("INSERT INTO root.required_knowledge (knowledge,id_position) VALUES	(:knowledge,:id_position)");

        $stmt->bindParam(":knowledge", $knowledge, PDO::PARAM_STR);
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
        $knowledge = $this->getKnowledge();

        $stmt = $this->db->prepare("UPDATE root.required_knowledge 
									SET knowledge=:knowledge
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":knowledge", $knowledge, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }





    public function delete(){
        $id=$this->getId();
        $stmt = $this->db->prepare("DELETE root.required_knowledge WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }

        return $result;
    }



}
