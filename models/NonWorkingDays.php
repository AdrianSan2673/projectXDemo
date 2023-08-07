<?php

class NonWorkingDays{
    private $date;

    private $db;

    public function __construct(){
        $this->db = Connection::connect();
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getOne(){
        $date = $this->getDate();
        $stmt = $this->db->prepare("SELECT TOP 1 date FROM non_working_days WHERE date=:date;", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":date", $date, PDO::PARAM_STR);
        $stmt->execute();
        
        $stmt->fetchObject();
        $num = $stmt->rowCount();
        return $num;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM non_working_days");
        $stmt->execute();
        $days = $stmt->fetchAll();
        return $days;
    }
}