<?php

class Busqueda_RAL{

    private $ID;
    private $Nombres;
    private $Apellidos;
    private $CURP;
    private $Fecha;
    private $Creado;

    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getID(){
		return $this->ID;
	}

	public function setID($ID){
		$this->ID = $ID;
	}

	public function getNombres(){
		return $this->Nombres;
	}

	public function setNombres($Nombres){
		$this->Nombres = $Nombres;
	}

	public function getApellidos(){
		return $this->Apellidos;
	}

	public function setApellidos($Apellidos){
		$this->Apellidos = $Apellidos;
	}

	public function getCURP(){
		return $this->CURP;
	}

	public function setCURP($CURP){
		$this->CURP = $CURP;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

    public function getCreado(){
		return $this->Creado;
	}

	public function setCreado($Creado){
		$this->Creado = $Creado;
	}

    public function getOne(){
        $ID = $this->getID();

		$stmt = $this->db->prepare("SELECT b.* FROM Busqueda_RAL b INNER JOIN rh_Candidatos c ON b.ID=c.ID_Busqueda_RAL WHERE b.ID=:ID ORDER BY Fecha DESC");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getOneByCandidato(Candidatos $candidato){
        $Candidato = $candidato->getCandidato();

		$stmt = $this->db->prepare("SELECT b.* FROM Busqueda_RAL b INNER JOIN rh_Candidatos c ON b.ID=c.ID_Busqueda_RAL WHERE Candidato=:Candidato ORDER BY Fecha DESC");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getOneByCURP(){
        $CURP = $this->getCURP();

		$stmt = $this->db->prepare("SELECT b.*, v.* FROM Busqueda_RAL b INNER JOIN rh_Candidatos_Datos d ON b.CURP=d.CURP INNER JOIN rh_Candidatos c ON d.Candidato=c.Candidato INNER JOIN rh_Ventas_Alta v ON c.Cliente=v.Cliente WHERE b.CURP=:CURP AND b.CURP <>''");
        $stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getOneByILOrESE(Candidatos $candidato){
        $IL = $candidato->getIL();
        $ESE = $candidato->getESE();

		$stmt = $this->db->prepare("SELECT TOP 1 b.*, v.*, c.Candidato FROM Busqueda_RAL b INNER JOIN rh_Candidatos c ON b.ID=c.ID_Busqueda_RAL INNER JOIN rh_Ventas_Alta v ON c.Cliente=v.Cliente WHERE IL=:IL OR c.ESE=:ESE ORDER BY Fecha DESC");
        $stmt->bindParam(":IL", $IL, PDO::PARAM_INT);
        $stmt->bindParam(":ESE", $ESE, PDO::PARAM_INT);

        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function create(){
		$result = false;

        $Nombres = $this->getNombres();
        $Apellidos = $this->getApellidos();
        $CURP = $this->getCURP();
        $Creado = $this->getCreado();
		
        $stmt = $this->db->prepare("INSERT INTO Busqueda_RAL (Nombres, Apellidos, CURP, Fecha, Creado)
		VALUES (:Nombres, :Apellidos, :CURP, GETDATE(), :Creado)");
        $stmt->bindParam(":Nombres", $Nombres, PDO::PARAM_STR);
        $stmt->bindParam(":Apellidos", $Apellidos, PDO::PARAM_STR);
        $stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
        $stmt->bindParam(":Creado", $Creado, PDO::PARAM_STR);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
            $this->setID($this->db->lastInsertId());
        }
        return $result;
    }
}