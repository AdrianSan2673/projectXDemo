<?php
class TipoUsuario {
    private $id;
    private $tipo_usuario;
    private $id_area;
    
    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getTipo_usuario(){
		return $this->tipo_usuario;
	}

	public function setTipo_usuario($tipo_usuario){
		$this->tipo_usuario = $tipo_usuario;
	}

	public function getId_area(){
		return $this->id_area;
	}

	public function setId_area($id_area){
		$this->id_area = $id_area;
	}

	public function getAllProject(){
		$stmt = $this->db->prepare("SELECT * FROM tipo_usuario ORDER BY id ASC;");
		$stmt->execute();
		$roles = $stmt->fetchAll();
		return $roles;
	}

	public function getOne(){
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * from tipo_usuario WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		
		$fetch = $stmt->fetchObject();
		return $fetch;
	}
}
?>
