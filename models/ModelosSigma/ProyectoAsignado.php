<?php
class Proyecto_asignado {
    private $id;
    private $id_proyecto;
    private $id_usuario;
    private $creado;
    private $modificado;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getIdProyecto(){
		return $this->idProyecto;
	}

	public function setIdProyecto($idProyecto){
		$this->idProyecto = $idProyecto;
	}

	public function getId_usuario(){
		return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	public function getCreado(){
		return $this->creado;
	}

	public function setCreado($creado){
		$this->creado = $creado;
	}

	public function getModificado(){
		return $this->modificado;
	}

	public function setModificado($modificado){
		$this->modificado = $modificado;
	}
	public function getAllProject(){
		$stmt = $this->db->prepare("SELECT * FROM proyecto_asignado ORDER BY id ASC;");
		$stmt->execute();
		$roles = $stmt->fetchAll();
		return $roles;
	}

	public function getOne(){
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * from proyecto_asignado WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		
		$fetch = $stmt->fetchObject();
		return $fetch;
	}
}
