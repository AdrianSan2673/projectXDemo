<?php

class Area
{
	private $id;
	private $area;
	private $db;
	//===[28 julio gabo]===
	private $status;
	//===[28 julio gabo fin]===

	public function __construct()
	{
		$this->db = Connection::connect();
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getArea()
	{
		return $this->area;
	}

	public function setArea($area)
	{
		$this->area = $area;
	}
	//===[28 juliomodulo area  gabo]===
	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("SELECT * FROM areas WHERE status=1 ORDER BY area ASC;");
		$stmt->execute();
		$areas = $stmt->fetchAll();
		return $areas;
	}
	//===[28 julio modulo area gabo fin]===
	public function getAreasByArea()
	{
		$result = false;

		$Area = $this->getArea();

		$stmt = $this->db->prepare("SELECT * FROM areas WHERE area LIKE :Area");

		$stmt->bindParam(":Area", $Area, PDO::PARAM_STR);

		$flag = $stmt->execute();
		$area = $stmt->fetchObject();

		return $area;
	}

	public function insertSubareaInArea()
	{
		$result = false;

		$Area = $this->getArea();

		$stmt = $this->db->prepare("INSERT INTO subareas(subarea,id_area) VALUES (:Subarea,:Id_area)");

		$stmt->bindParam(":Area", $Area, PDO::PARAM_STR);

		$flag = $stmt->execute();
		$area = $stmt->fetchObject();

		return $area;
	}


	public function getVacancyCountByArea()
	{
		$stmt = $this->db->prepare("SELECT a.id, a.area, COUNT(a.id) AS total FROM vacancies v INNER JOIN areas a ON v.id_area=a.id GROUP BY a.id, a.area ORDER BY total DESC, a.area");
		$stmt->execute();
		$areas = $stmt->fetchAll();
		return $areas;
	}

	public function getAVacancyCountByArea()
	{
		$stmt = $this->db->prepare("SELECT a.id, a.area, COUNT(a.id) AS total FROM vacancies v INNER JOIN areas a ON v.id_area=a.id WHERE v.id_status < 5 GROUP BY a.id, a.area ORDER BY total DESC, a.area");
		$stmt->execute();
		$areas = $stmt->fetchAll();
		return $areas;
	}

	public function save()
	{
		$result = false;

		$Area = $this->getArea();

		$stmt = $this->db->prepare("INSERT INTO areas(area) VALUES (:Area)");

		$stmt->bindParam(":Area", $Area, PDO::PARAM_STR);

		$flag = $stmt->execute();

		$this->setId($this->db->lastInsertId());



		return $flag;
	}

	// ===[28 julio gabo modulo areas ]=== 

	public function getAllAreasAvaiable()
	{
		$stmt = $this->db->prepare("SELECT * FROM areas where status=1 ORDER BY id DESC;");
		$stmt->execute();
		$areas = $stmt->fetchAll();
		return $areas;
	}

	public function getAreaByIdArea()
	{
		$id_area = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM areas where id=:id_area");
		$stmt->bindParam(":id_area", $id_area, PDO::PARAM_STR);
		$stmt->execute();
		$area = $stmt->fetchObject();
		return $area;
	}


	public function HideArea()
	{
		$id_area = $this->getId();

		$stmt = $this->db->prepare("UPDATE areas set status=0 where id=:id_area");
		$stmt->bindParam(":id_area", $id_area, PDO::PARAM_INT);
		$result = $stmt->execute();
		return $result;
	}

	// ===[28 julio gabo modulo areas fin]=== HideArea


}
