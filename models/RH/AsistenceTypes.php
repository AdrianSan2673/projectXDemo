<?php
class AsistenceTypes
{
    private $id;
    private $client;
    private $name;
    private $status;
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
    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getStatus()
    {
        return $this->status;
    }




    public function getOne()
    {

        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * from asistence_type where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {

        $stmt = $this->db->prepare("SELECT * from asistence_type where status=1 order by id DESC");
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getAllByClient()
    {
        $client = $this->getClient();
        $stmt = $this->db->prepare("SELECT * from asistence_type where client=:client and status=1 order by id DESC");
        $stmt->bindParam(":client", $client, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    public function save_type()
    {

        $client = $this->getClient();
        $name = $this->getName();

        $stmt = $this->db->prepare("INSERT INTO asistence_type (client,name,status) values (:client,:name,1)");
        $stmt->bindParam(":client", $client, PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);

        $result = $stmt->execute();

        return $result;
    }
    public function update_type()
    {

        $id = $this->getId();
        $name = $this->getName();

        $stmt = $this->db->prepare("UPDATE top(1) asistence_type set name=:name where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);

        $result = $stmt->execute();

        return $result;
    }

    public function delete_type()
    {

        $id = $this->getId();

        $stmt = $this->db->prepare("UPDATE top(1) asistence_type set status=0 where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $result = $stmt->execute();

        return $result;
    }
}