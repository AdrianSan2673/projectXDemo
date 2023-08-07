<?php

class CandidatosLaboralesConceptos {

    private $Candidato;
    private $Renglon;
    private $Desempeno;
    private $Honradez;
    private $Puntualidad;
    private $Relacion;
    private $Responsabilidad;
    private $Adaptacion;


    
    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getRenglon(){
		return $this->Renglon;
	}

	public function setRenglon($Renglon){
		$this->Renglon = $Renglon;
	}

	public function getDesempeno(){
		return $this->Desempeno;
	}

	public function setDesempeno($Desempeno){
		$this->Desempeno = $Desempeno;
	}

	public function getHonradez(){
		return $this->Honradez;
	}

	public function setHonradez($Honradez){
		$this->Honradez = $Honradez;
	}

	public function getPuntualidad(){
		return $this->Puntualidad;
	}

	public function setPuntualidad($Puntualidad){
		$this->Puntualidad = $Puntualidad;
	}

	public function getRelacion(){
		return $this->Relacion;
	}

	public function setRelacion($Relacion){
		$this->Relacion = $Relacion;
	}

	public function getResponsabilidad(){
		return $this->Responsabilidad;
	}

	public function setResponsabilidad($Responsabilidad){
		$this->Responsabilidad = $Responsabilidad;
	}

	public function getAdaptacion(){
		return $this->Adaptacion;
	}

	public function setAdaptacion($Adaptacion){
		$this->Adaptacion = $Adaptacion;
	}

    /* 
    
    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Laborales_Conceptos WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    } */
	
	public function getAll(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Laborales_Conceptos WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

	public function create(){
		$result = false;

		$Renglon = $this->getRenglon();
		$Candidato = $this->getCandidato();
        $Desempeno = $this->getDesempeno();
        $Honradez = $this->getHonradez();
		$Puntualidad = $this->getPuntualidad();
		$Relacion = $this->getRelacion();
		$Responsabilidad = $this->getResponsabilidad();
		$Adaptacion = $this->getAdaptacion();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Laborales_Conceptos(Candidato, Renglon, Desempeno, Honradez,Puntualidad,Relacion, Responsabilidad,Adaptacion)
		VALUES (:Candidato, :Renglon, :Desempeno, :Honradez, :Puntualidad, :Relacion, :Responsabilidad, :Adaptacion)");
        $stmt->bindParam(":Desempeno", $Desempeno, PDO::PARAM_INT);
        $stmt->bindParam(":Honradez", $Honradez, PDO::PARAM_INT);
		$stmt->bindParam(":Puntualidad", $Puntualidad, PDO::PARAM_INT);
		$stmt->bindParam(":Relacion", $Relacion, PDO::PARAM_INT);
		$stmt->bindParam(":Responsabilidad", $Responsabilidad, PDO::PARAM_INT);
		$stmt->bindParam(":Adaptacion", $Adaptacion, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
			$this->setRenglon($Renglon);
        }
        return $result;
    }

	public function update(){
        $result = false;

        $Renglon = $this->getRenglon();
		$Candidato = $this->getCandidato();
        $Desempeno = $this->getDesempeno();
        $Honradez = $this->getHonradez();
		$Puntualidad = $this->getPuntualidad();
		$Relacion = $this->getRelacion();
		$Responsabilidad = $this->getResponsabilidad();
		$Adaptacion = $this->getAdaptacion();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Laborales_Conceptos
		SET Desempeno= :Desempeno,
			Honradez=:Honradez,
			Puntualidad=:Puntualidad,
			Relacion=:Relacion,
			Responsabilidad=:Responsabilidad,
			Adaptacion=:Adaptacion
		WHERE Candidato= :Candidato 
			AND Renglon=:Renglon");
        $stmt->bindParam(":Desempeno", $Desempeno, PDO::PARAM_INT);
        $stmt->bindParam(":Honradez", $Honradez, PDO::PARAM_INT);
		$stmt->bindParam(":Puntualidad", $Puntualidad, PDO::PARAM_INT);
		$stmt->bindParam(":Relacion", $Relacion, PDO::PARAM_INT);
		$stmt->bindParam(":Responsabilidad", $Responsabilidad, PDO::PARAM_INT);
		$stmt->bindParam(":Adaptacion", $Adaptacion, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function delete(){
		$result = false;

		$Candidato = $this->getCandidato();
		$Renglon = $this->getRenglon();
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Laborales_Conceptos WHERE Candidato=:Candidato AND Renglon=:Renglon");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateRenglon($RenglonCambio){
		$result = false;

		$Candidato = $this->getCandidato();
		$Renglon = $this->getRenglon();
		
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Laborales_Conceptos SET Renglon=:RenglonCambio WHERE Candidato=:Candidato AND Renglon=:Renglon");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);
		$stmt->bindParam(":RenglonCambio", $RenglonCambio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
	
	public function duplicate($duplicado){
		$result = false;

		$Candidato = $this->getCandidato();
		$Folio = $duplicado;
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Laborales_Conceptos(Candidato, Renglon, Desempeno, Honradez,Puntualidad,Relacion, Responsabilidad,Adaptacion)
		SELECT :Candidato, Renglon, Desempeno, Honradez,Puntualidad,Relacion, Responsabilidad,Adaptacion FROM rh_Candidatos_Laborales_Conceptos WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
		}
        return $result;
    }
}