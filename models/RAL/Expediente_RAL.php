<?php

class Expediente_RAL{
    private $ID;
    private $Fecha;
    private $Num_Expediente;
    private $Anio;
    private $Estado;
    private $ciudad;
    private $Juzgado;
    private $Op;
    private $Toca;
    private $Actor;
    private $Demandado;
    private $Tipo;
    private $ID_Busqueda_RAL;

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

	public function getNum_Expediente(){
		return $this->Num_Expediente;
	}

	public function setNum_Expediente($Num_Expediente){
		$this->Num_Expediente = $Num_Expediente;
	}

	public function getAnio(){
		return $this->Anio;
	}

	public function setAnio($Anio){
		$this->Anio = $Anio;
	}

	public function getEstado(){
		return $this->Estado;
	}

	public function setEstado($Estado){
		$this->Estado = $Estado;
	}

	public function getCiudad(){
		return $this->ciudad;
	}

	public function setCiudad($ciudad){
		$this->ciudad = $ciudad;
	}

	public function getJuzgado(){
		return $this->Juzgado;
	}

	public function setJuzgado($Juzgado){
		$this->Juzgado = $Juzgado;
	}

	public function getOp(){
		return $this->Op;
	}

	public function setOp($Op){
		$this->Op = $Op;
	}

	public function getToca(){
		return $this->Toca;
	}

	public function setToca($Toca){
		$this->Toca = $Toca;
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

	public function getTipo(){
		return $this->Tipo;
	}

	public function setTipo($Tipo){
		$this->Tipo = $Tipo;
	}

	public function getID_Busqueda_RAL(){
		return $this->ID_Busqueda_RAL;
	}

	public function setID_Busqueda_RAL($ID_Busqueda_RAL){
		$this->ID_Busqueda_RAL = $ID_Busqueda_RAL;
	}

	public function getOne(){
        $ID = $this->getID();
        
		$stmt = $this->db->prepare(
            "SELECT * FROM Expediente_RAL WHERE ID=:ID"
        );
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function getExpedientesPorBusqueda(){
        $ID_Busqueda_RAL = $this->getID_Busqueda_RAL();
        
		$stmt = $this->db->prepare(
            "SELECT TOP(200) * FROM Expediente_RAL WHERE ID_Busqueda_RAL=:ID_Busqueda_RAL"
        );
        $stmt->bindParam(":ID_Busqueda_RAL", $ID_Busqueda_RAL, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function create(){
		$result = false;

        $Fecha = $this->getFecha();
        $Num_Expediente = $this->getNum_Expediente();
        $Anio = $this->getAnio();
        $Estado = $this->getEstado();
        $Ciudad = $this->getCiudad();
        $Juzgado = $this->getJuzgado();
        $Op = $this->getOp();
        $Toca = $this->getToca();
        $Actor = $this->getActor();
        $Demandado = $this->getDemandado();
        $Tipo = $this->getTipo();
        $ID_Busqueda_RAL = $this->getID_Busqueda_RAL();
		
        $stmt = $this->db->prepare("INSERT INTO Expediente_RAL (Fecha, Num_Expediente, Anio, Estado, Ciudad, Juzgado, Op, Toca, Actor, Demandado, Tipo, ID_Busqueda_RAL)
		VALUES (:Fecha, :Num_Expediente, :Anio,  :Estado, :Ciudad, :Juzgado, :Op, :Toca, :Actor, :Demandado, :Tipo, :ID_Busqueda_RAL)");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->bindParam(":Num_Expediente", $Num_Expediente, PDO::PARAM_STR);
        $stmt->bindParam(":Anio", $Anio, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
        $stmt->bindParam(":Ciudad", $Ciudad, PDO::PARAM_STR);
        $stmt->bindParam(":Juzgado", $Juzgado, PDO::PARAM_STR);
        $stmt->bindParam(":Op", $Op, PDO::PARAM_STR);
        $stmt->bindParam(":Toca", $Toca, PDO::PARAM_STR);
        $stmt->bindParam(":Actor", $Actor, PDO::PARAM_STR);
        $stmt->bindParam(":Demandado", $Demandado, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo", $Tipo, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Busqueda_RAL", $ID_Busqueda_RAL, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
			$this->setID($this->db->lastInsertId());
        }
        return $result;
    }
}