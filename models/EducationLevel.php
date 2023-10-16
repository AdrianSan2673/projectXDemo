<?php

class EducationLevel{
    private $id;
    private $level;

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

    public function getLevel(){
        return $this->level;
    }

    public function setLevel($level){
        $this->level = $level;
    }

    public function getAll(){
		$stmt = $this->db->prepare("SELECT * FROM education_levels;");
        $stmt->execute();
        $levels = $stmt->fetchAll();
        return $levels;
	}
}