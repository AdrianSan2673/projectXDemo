<?php

class Tamaulipas{
    private $id;
    private $Municipio;
    private $Juzgado;
    private $Materia;
    private $Fecha;
    private $Expediente;
    private $Folio;
    private $Resumen;
    private $Tipo;
    
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

	public function getMunicipio(){
		return $this->Municipio;
	}

	public function setMunicipio($Municipio){
		$this->Municipio = $Municipio;
	}

	public function getJuzgado(){
		return $this->Juzgado;
	}

	public function setJuzgado($Juzgado){
		$this->Juzgado = $Juzgado;
	}

	public function getMateria(){
		return $this->Materia;
	}

	public function setMateria($Materia){
		$this->Materia = $Materia;
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

	public function getFolio(){
		return $this->Folio;
	}

	public function setFolio($Folio){
		$this->Folio = $Folio;
	}

	public function getResumen(){
		return $this->Resumen;
	}

	public function setResumen($Resumen){
		$this->Resumen = $Resumen;
	}

	public function getTipo(){
		return $this->Tipo;
	}

	public function setTipo($Tipo){
		$this->Tipo = $Tipo;
	}

    public function getExpedientesPorNombre(){
        $Resumen = $this->getResumen();
        
		$stmt = $this->db->prepare(
            "SELECT *, Fecha AS Fecha1, CONVERT(DATE, Fecha) AS Fecha FROM tamaulipas WHERE CONTAINS(Resumen, :Resumen) ORDER BY Fecha1 DESC, Expediente DESC");
        $stmt->bindParam(":Resumen", $Resumen, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
}