<?php 
    class Proyecto_integrantes {
        private $id;
        private $id_proyecto;
        private $id_usuario;
        private $fechaCreacion;
    }

    public function __construct() {
        $this->db = Connection::connect();
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId_proyecto(){
		return $this->id_proyecto;
	}

	public function setId_proyecto($id_proyecto){
		$this->id_proyecto = $id_proyecto;
	}

	public function getId_usuario(){
		return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	public function getFechaCreacion(){
		return $this->fechaCreacion;
	}

	public function setFechaCreacion($fechaCreacion){
		$this->fechaCreacion = $fechaCreacion;
	}

    public function getAllProject(){
        $stmt = this->db->prepare("SELECT * FROM Proyecto_integrantes ORDER BY id ASC;");
        $stmt->execute();
        $roles = $stmt->fetchAll();
        return $roles;
    }

    public function getOne(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM Proyecto_integrantes WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getOneByIdProject(){
        $id_proyecto = $this->getId_proyecto();
        $stmt = $this->db->prepare("SELECT * FROM Proyecto_integrantes WHERE id_proyecto=:id_proyecto");
        $stmt->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getOneByIdUser(){
        $id_usuario = $this->getId_usuario();
        $stmt = $this->db->prepare("SELECT * FROM Proyecto_integrantes WHERE id_usuario=:id_usuario");
        $stmt->bindParam(":id_usuario", $id_proyecto, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function createNewAsoccietProject(){
        $id = $this->->getId();
        $id_proyecto = $this->getId_proyecto();
        $id_usuario = $this->getId_usuario();
        $fetchCreacion = $this->getFechaCreacion();

        $stmt = $this->db->prepare("INSERT INTO Proyecto_integrantes (id,id_proyecto,id_usuario,fechaCreacion)");
    }
?>