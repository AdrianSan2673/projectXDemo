<?php

class CatalogoAreasTematicas
{
	private $clave;
	private $descripcion;
	private $db;

	public function __construct(){
		$this->db = Connection::connectSA();
	}

    public function getClave(){
		return $this->clave;
	}

	public function setClave($clave){
		$this->clave = $clave;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	public function getAll(){
		$stmt = $this->db->prepare("SELECT * FROM root.catalogo_areas_tematicas ");
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}
	
	public function getOne(){
		$clave=$this->getClave();
		$stmt = $this->db->prepare("SELECT * FROM root.catalogo_areas_tematicas WHERE clave=:clave");
		$stmt->bindParam(":clave", $clave, PDO::PARAM_INT);

		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}


}
