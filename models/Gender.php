<?php

class Gender{
    private $id;
    private $gender;

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

    public function getGender(){
        return $this->gender;
    }

    public function setGender($gender){
        $this->gender = $gender;
    }

    public function getAll(){
		$stmt = $this->db->prepare("SELECT * FROM genders;");
        $stmt->execute();
        $genders = $stmt->fetchAll();
        return $genders;
	}
}