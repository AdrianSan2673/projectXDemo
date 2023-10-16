<?php 

class Subarea{
	private $id;
    private $subarea;
    private $id_area;

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

	public function getSubarea(){
		return $this->subarea;
	}

	public function setSubarea($subarea){
		$this->subarea = $subarea;
	}

	public function getId_area(){
		return $this->id_area;
	}

	public function setId_area($id_area){
		$this->id_area = $id_area;
	}

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM subareas ORDER BY id_area ASC;");
        $stmt->execute();
        $subareas = $stmt->fetchAll();
        return $subareas;
    }

    public function getSubareasByArea(){
        $area = $this->getId_area();
        $stmt = $this->db->prepare("SELECT * FROM subareas WHERE id_area=:id_area;");
        $stmt->bindParam(":id_area", $area, PDO::PARAM_STR);
        $stmt->execute();
        $subareas = $stmt->fetchAll();
        return $subareas;
    }

    public function getAVacancyCountBySubarea(){
        $stmt = $this->db->prepare("SELECT sa.id, sa.subarea, COUNT(sa.id) AS total FROM vacancies v INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE v.id_status < 5 GROUP BY sa.id, sa.subarea ORDER BY total DESC, sa.subarea");
        $stmt->execute();
        $areas = $stmt->fetchAll();
        return $areas;
    }
}