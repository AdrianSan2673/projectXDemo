<?php 

class SanLuisPotosi{
    private $id;
    private $Juzgado;
    private $Fecha;
    private $Expediente;
    private $Actor;
    private $Demandado;
    private $Resumen;    
    private $db;

    public function __construct(){
        $this->db = Connection::connectRAL();
    }
    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getJuzgado(){
		return $this->Juzgado;
	}

	public function setJuzgado($Juzgado){
		$this->Juzgado = $Juzgado;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

	public function getExpediente(){
		return $this->Expediente;
	}

	public function setExpediente($Expediente){
		$this->Expediente = $Expediente;
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

	public function getResumen(){
		return $this->Resumen;
	}

	public function setResumen($Resumen){
		$this->Resumen = $Resumen;
	}

    public function getExpedientesPorNombre(){
        $Actor = $this->getActor();
        $Demandado = $this->getDemandado();
        
		$stmt = $this->db->prepare(
            "SELECT *, Fecha AS Fecha1, CONVERT(DATE, Fecha) AS Fecha FROM san_luis WHERE CONTAINS(Actor,:Actor) OR CONTAINS(Demandado,:Demandado) ORDER BY Fecha1 DESC, Expediente DESC");
        $stmt->bindParam(":Actor", $Actor, PDO::PARAM_STR);
        $stmt->bindParam(":Demandado", $Demandado, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
}