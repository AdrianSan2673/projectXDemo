<?php

class CostCenter{
	private $id;
	private $cost_center;

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

	public function getCost_center(){
		return $this->cost_center;
	}

	public function setCost_center($cost_center){
		$this->cost_center = $cost_center;
	}

	public function getAll(){
		$stmt = $this->db->prepare("SELECT * FROM cost_centers;");
		$stmt->execute();
		$cost_centers = $stmt->fetchAll();
		return $cost_centers;
	}
}