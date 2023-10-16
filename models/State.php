<?php

class State{

    private $id;
    private $state;
    private $abbreviation;

    private $db;

    public function __construct() {
        $this->db = Connection::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getState(){
        return $this->state;
    }

    public function setState($state){
        $this->state = $state;
    }

    public function getAbbreviation(){
        return $this->abbreviation;
    }

    public function setAbbreviation($abbreviation){
        $this->abbreviation = $abbreviation;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM states ORDER BY state ASC;");
        $stmt->execute();
        $states = $stmt->fetchAll();
        return $states;
    }

    public function getVacancyCountByState(){
        $stmt = $this->db->prepare("SELECT s.id, s.state, COUNT(s.id) AS total FROM vacancies v INNER JOIN states s ON v.id_state=s.id GROUP BY s.id, s.state ORDER BY total DESC, s.state");
        $stmt->execute();
        $areas = $stmt->fetchAll();
        return $areas;
    }

    public function getAVacancyCountByState(){
        $stmt = $this->db->prepare("SELECT s.id, s.state, COUNT(s.id) AS total FROM vacancies v INNER JOIN states s ON v.id_state=s.id WHERE v.id_status < 5 GROUP BY s.id, s.state ORDER BY total DESC, s.state");
        $stmt->execute();
        $areas = $stmt->fetchAll();
        return $areas;
    }
}