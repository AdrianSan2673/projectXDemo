<?php

class PsychometryType{
    private $id;
    private $type;

    private $db;

    public function __construct(){
        $this->db = Connection::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM psychometry_types");
        $stmt->execute();
        $types = $stmt->fetchAll();
        return $types;
    }
}