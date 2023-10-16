<?php 
 

 class SOI {

    private $Folio;
    private $Candidato;
    private $Fecha_Emision;
    private $Autorizado_Por;
    private $Activo;

    private $db;

    public function __construct() {
        $this->db = Connection::connectSA();
    }

	public function getFolio(){
		return $this->Folio;
	}

	public function setFolio($Folio){
		$this->Folio = $Folio;
	}

    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getFecha_Emision(){
		return $this->Fecha_Emision;
	}

	public function setFecha_Emision($Fecha_Emision){
		$this->Fecha_Emision = $Fecha_Emision;
	}

	public function getAutorizado_Por(){
		return $this->Autorizado_Por;
	}

	public function setAutorizado_Por($Autorizado_Por){
		$this->Autorizado_Por = $Autorizado_Por;
	}

	public function getActivo(){
		return $this->Activo;
	}

	public function setActivo($Activo){
		$this->Activo = $Activo;
	}

	public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM SOI WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Autorizado_Por = $this->getAutorizado_Por();
        $Activo = $this->getActivo();
		
        $stmt = $this->db->prepare("INSERT INTO SOI(
			Candidato, Autorizado_Por, Activo, Fecha_Emision)
		VALUES (:Candidato, :Autorizado_Por, :Activo, GETDATE())");
        $stmt->bindParam(":Autorizado_Por", $Autorizado_Por, PDO::PARAM_STR);
		$stmt->bindParam(":Activo", $Activo, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateActivo(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Activo = $this->getActivo();

        $stmt = $this->db->prepare("UPDATE SOI SET Activo=:Activo WHERE Candidato=:Candidato");
        $stmt->bindParam(":Activo", $Activo, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
 }