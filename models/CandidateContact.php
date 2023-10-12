<?php

class CandidateContact
{
    private $id;
    private $first_name;
    private $last_name;
    private $surname;
    private $telephone;
    private $status;
    private $created_at;
    private $id_vacancy;
    private $db;


    public function __construct()
    {
        $this->db = Connection::connect();
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirst_name()
    {
        return $this->first_name;
    }

    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLast_name()
    {
        return $this->last_name;
    }

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getId_vacancy()
    {
        return $this->id_vacancy;
    }

    public function setId_vacancy($id_vacancy)
    {
        $this->id_vacancy = $id_vacancy;
    }


    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM candidate_contact  WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }


    public function save()
    {
        $result = false;

        $first_name = $this->getFirst_name();
        $surname = $this->getSurname();
        $last_name = $this->getLast_name();
        $telephone = $this->getTelephone();
        $status = $this->getStatus();
        $id_vacancy = $this->getId_vacancy();

        $stmt = $this->db->prepare("INSERT INTO candidate_contact (first_name,surname,last_name,telephone,status,id_vacancy,created_at) VALUES(:first_name,:surname,:last_name,:telephone,:status,:id_vacancy,GETDATE())");

        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
        $stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);

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
        $first_name = $this->getFirst_name();
        $surname = $this->getSurname();
        $last_name = $this->getLast_name();
        $telephone = $this->getTelephone();
        $status = $this->getStatus();
        $id_vacancy = $this->getId_vacancy();

        $stmt = $this->db->prepare("UPDATE root.candidate_directory SET first_name=:first_name,surname=:surname,last_name=:last_name,telephone=:telephone,status=:status,id_vacancy=:id_vacancy,modified_at=GETDATE(),status=:status WHERE id=:id");

        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
        $stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

        $result = $stmt->execute();

        return $result;
    }
}