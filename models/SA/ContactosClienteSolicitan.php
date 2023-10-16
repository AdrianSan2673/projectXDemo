<?php

class ContactosClienteSolicitan{
 
    private $ID;
	private $Empresa;
	private $Cliente;
	private $Nombre;
	private $Fecha;
	private $Usuario;

    public function __construct() {
        $this->db = Connection::connectSA();
    }

	public function getID(){
		return $this->ID;
	}

	public function setID($ID){
		$this->ID = $ID;
	}

	public function getEmpresa(){
		return $this->Empresa;
	}

	public function setEmpresa($Empresa){
		$this->Empresa = $Empresa;
	}

	public function getCliente(){
		return $this->Cliente;
	}

	public function setCliente($Cliente){
		$this->Cliente = $Cliente;
	}

	public function getNombre(){
		return $this->Nombre;
	}

	public function setNombre($Nombre){
		$this->Nombre = $Nombre;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

	public function getUsuario(){
		return $this->Usuario;
	}

	public function setUsuario($Usuario){
		$this->Usuario = $Usuario;
	}

    public function getContactosPorCliente(){
		$Cliente = $this->getCliente();

        $stmt = $this->db->prepare("SELECT * FROM rh_Candidatos_Personas_Solicitan WHERE Cliente=:Cliente ORDER BY Nombre");
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

	public function getContactoPorUsuario(){
		$Usuario = $this->getUsuario();

        $stmt = $this->db->prepare("SELECT * FROM rh_Candidatos_Personas_Solicitan WHERE Usuario=:Usuario");
		$stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function getOne(){
		$Usuario = $this->getUsuario();
		$Cliente = $this->getCliente();

        $stmt = $this->db->prepare("SELECT * FROM rh_Candidatos_Personas_Solicitan WHERE Usuario=:Usuario AND Cliente=:Cliente");
		$stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;

        $Empresa = $this->getEmpresa();
        $Cliente = $this->getCliente();
        $Usuario = $this->getUsuario();
        $Nombre = $this->getNombre();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Personas_Solicitan(Empresa, Cliente, Usuario, Nombre, Fecha) VALUES (:Empresa, :Cliente, :Usuario, :Nombre, GETDATE())");
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
			$this->setID($this->db->lastInsertId());
        }
        return $result;
    }
}