<?php

class Language{
	private $id;
	private $language;

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

	public function getLanguage(){
		return $this->language;
	}

	public function setLanguage($language){
		$this->language = $language;
	}
    
    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM languages");
        $stmt->execute();
        $languages = $stmt->fetchAll();
        return $languages;
    }

	public function getOne() {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM languages WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute())
            return $stmt->fetchObject();
        else
            return false;
    }
}