<?php 

class Area {
	private $id;
	private $area;

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

	public function getArea(){
		return $this->area;
	}

	public function setArea($area){
		$this->area = $area;
	}

	public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM areas ORDER BY area ASC;");
        $stmt->execute();
        $areas = $stmt->fetchAll();
        return $areas;
    }

    public function getVacancyCountByArea(){
    	$stmt = $this->db->prepare("SELECT a.id, a.area, COUNT(a.id) AS total FROM vacancies v INNER JOIN areas a ON v.id_area=a.id GROUP BY a.id, a.area ORDER BY total DESC, a.area");
    	$stmt->execute();
    	$areas = $stmt->fetchAll();
    	return $areas;
    }

    public function getAVacancyCountByArea(){
    	$stmt = $this->db->prepare("SELECT a.id, a.area, COUNT(a.id) AS total FROM vacancies v INNER JOIN areas a ON v.id_area=a.id WHERE v.id_status < 5 GROUP BY a.id, a.area ORDER BY total DESC, a.area");
    	$stmt->execute();
    	$areas = $stmt->fetchAll();
    	return $areas;
    }
}