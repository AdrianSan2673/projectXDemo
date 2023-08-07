<?php

class Acuerdos_RAL{
    private $ID;
    private $Fecha;
    private $Acuerdo;
    private $Tipo;
    private $Actor;
    private $Demandado;
    private $ID_Expediente_RAL;

    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getID(){
		return $this->ID;
	}

	public function setID($ID){
		$this->ID = $ID;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

	public function getAcuerdo(){
		return $this->Acuerdo;
	}

	public function setAcuerdo($Acuerdo){
		$this->Acuerdo = $Acuerdo;
	}

	public function getTipo(){
		return $this->Tipo;
	}

	public function setTipo($Tipo){
		$this->Tipo = $Tipo;
	}

	public function getActor(){
		return $this->Actor;
	}

	public function setActor($Actor){
		$this->Actor = $Actor;
	}

	public function getDemandado(){
		return $this->Demandado;
	}

	public function setDemandado($Demandado){
		$this->Demandado = $Demandado;
	}

	public function getID_Expediente_RAL(){
		return $this->ID_Expediente_RAL;
	}

	public function setID_Expediente_RAL($ID_Expediente_RAL){
		$this->ID_Expediente_RAL = $ID_Expediente_RAL;
	}

	public function getAcuerdosPorExpediente(){
        $ID_Expediente_RAL = $this->getID_Expediente_RAL();
        
		$stmt = $this->db->prepare(
            "SELECT * FROM Acuerdos_RAL WHERE ID_Expediente_RAL=:ID_Expediente_RAL"
        );
        $stmt->bindParam(":ID_Expediente_RAL", $ID_Expediente_RAL, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function create(){
		$result = false;

        $Fecha = $this->getFecha();
        $Acuerdo = $this->getAcuerdo();
        $Tipo = $this->getTipo();
        $Actor = $this->getActor();
        $Demandado = $this->getDemandado();
        $ID_Expediente_RAL = $this->getID_Expediente_RAL();
		
        $stmt = $this->db->prepare("INSERT INTO Acuerdos_RAL (Fecha, Acuerdo,  Actor, Demandado, Tipo, ID_Expediente_RAL)
		VALUES (:Fecha, :Acuerdo, :Actor, :Demandado, :Tipo, :ID_Expediente_RAL)");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->bindParam(":Acuerdo", $Acuerdo, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo", $Tipo, PDO::PARAM_STR);
        $stmt->bindParam(":Actor", $Actor, PDO::PARAM_STR);
        $stmt->bindParam(":Demandado", $Demandado, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Expediente_RAL", $ID_Expediente_RAL, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}