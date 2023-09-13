<?php

class City {
    private $id;
    private $city;
    private $id_state;

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

    public function getCity(){
        return $this->city;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function getId_state(){
        return $this->id_state;
    }

    public function setId_state($id_state){
        $this->id_state = $id_state;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM cities ORDER BY city ASC;");
        $stmt->execute();
        $cities = $stmt->fetchAll();
        return $cities;
    }

    public function getCitiesByState(){
        $state = $this->getId_state();
        $stmt = $this->db->prepare("SELECT * FROM cities WHERE id_state=:id_state ORDER BY city ASC");
        $stmt->bindParam(":id_state", $state, PDO::PARAM_STR);
        $stmt->execute();
        $cities = $stmt->fetchAll();
        return $cities;
    }

    public function getAVacancyCountByCity(){
        $stmt = $this->db->prepare("SELECT ct.id, ct.city, COUNT(ct.id) AS total FROM vacancies v INNER JOIN cities ct ON v.id_city=ct.id WHERE v.id_status < 5 GROUP BY ct.id, ct.city ORDER BY total DESC, ct.city");
        $stmt->execute();
        $areas = $stmt->fetchAll();
        return $areas;
    }

    public function getOne() {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM cities WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute())
            return $stmt->fetchObject();
        else
            return false;
    }
}