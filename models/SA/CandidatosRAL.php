<?php

class CandidatosRAL{
    private $Candidato;
    private $Nombre;
    private $Estado;
    private $Demandas;
    private $Total_Demandas;
    private $Total_Acuerdos;
    private $Tipo_Juicio;
    private $Fecha;
	private $Comentarios;

    private $db;
	 
	public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	//Este se va a quitar ya después
    public function getNombre(){
		return $this->Nombre;
	}

	public function setNombre($Nombre){
		$this->Nombre = $Nombre;
	}

    public function getEstado(){
		return $this->Estado;
	}

	public function setEstado($Estado){
		$this->Estado = $Estado;
	}

    public function getDemandas(){
		return $this->Demandas;
	}

	public function setDemandas($Demandas){
		$this->Demandas = $Demandas;
	}

    public function getTotal_Demandas(){
		return $this->Total_Demandas;
	}

	public function setTotal_Demandas($Total_Demandas){
		$this->Total_Demandas = $Total_Demandas;
	}

    public function getTotal_Acuerdos(){
		return $this->Total_Acuerdos;
	}

	public function setTotal_Acuerdos($Total_Acuerdos){
		$this->Total_Acuerdos = $Total_Acuerdos;
	}

	public function getTipo_Juicio(){
		return $this->Tipo_Juicio;
	}

	public function setTipo_Juicio($Tipo_Juicio){
		$this->Tipo_Juicio = $Tipo_Juicio;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios = $Comentarios;
	}

	public function getOne(){
        $Candidato=$this->getCandidato();

		$stmt = $this->db->prepare("SELECT * FROM rh_Candidatos_RAL WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;
		
		$Candidato = $this->getCandidato();
		$Nombre = $this->getNombre();
        $Demandas = $this->getDemandas();
        $Estado = $this->getEstado();
        $Total_Demandas = $this->getTotal_Demandas();
		$Total_Acuerdos = $this->getTotal_Acuerdos();
		$Tipo_Juicio = $this->getTipo_Juicio();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_RAL
			(Candidato, 
			Demandas, Nombre, Estado, 
			Total_Demandas, Total_Acuerdos, 
			Tipo_Juicio, Fecha)
		VALUES (:Candidato, 
			:Demandas, :Nombre, :Estado, 
			:Total_Demandas, :Total_Acuerdos, 
			:Tipo_Juicio, GETDATE())");
        $stmt->bindParam(":Demandas", $Demandas, PDO::PARAM_STR);
		$stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_STR);
		$stmt->bindParam(":Total_Demandas", $Total_Demandas, PDO::PARAM_STR);
        $stmt->bindParam(":Total_Acuerdos", $Total_Acuerdos, PDO::PARAM_STR);
		$stmt->bindParam(":Tipo_Juicio", $Tipo_Juicio, PDO::PARAM_STR);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function update(){
        $result = false;

        $Candidato = $this->getCandidato();
		$Nombre = $this->getNombre();
        $Demandas = $this->getDemandas();
        $Estado = $this->getEstado();
        $Total_Demandas = $this->getTotal_Demandas();
		$Total_Acuerdos = $this->getTotal_Acuerdos();
		$Tipo_Juicio = $this->getTipo_Juicio();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_RAL
		SET  Demandas=:Demandas
			,Nombre=:Nombre
			,Estado=:Estado
			,Total_Demandas=:Total_Demandas
			,Total_Acuerdos=:Total_Acuerdos
			,Tipo_Juicio=:Tipo_Juicio
		WHERE Candidato=:Candidato");
        $stmt->bindParam(":Demandas", $Demandas, PDO::PARAM_STR);
		$stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_STR);
		$stmt->bindParam(":Total_Demandas", $Total_Demandas, PDO::PARAM_STR);
        $stmt->bindParam(":Total_Acuerdos", $Total_Acuerdos, PDO::PARAM_STR);
		$stmt->bindParam(":Tipo_Juicio", $Tipo_Juicio, PDO::PARAM_STR);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateComentarios(){
        $result = false;

        $Candidato = $this->getCandidato();
		$Comentarios = $this->getComentarios();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_RAL
		SET  Comentarios=:Comentarios
		WHERE Candidato=:Candidato");
        $stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
}