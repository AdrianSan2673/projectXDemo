<?php

class CandidatosSeguros{

	private $Candidato;
	private $Renglon;
	private $Institucion;
	private $Tipo_Seguro;
	private $Forma_Pago;
	private $Prima;
	private $Vigencia;
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

	public function getRenglon(){
		return $this->Renglon;
	}

	public function setRenglon($Renglon){
		$this->Renglon = $Renglon;
	}

	public function getInstitucion(){
		return $this->Institucion;
	}

	public function setInstitucion($Institucion){
		$this->Institucion = $Institucion;
	}

	public function getTipo_Seguro(){
		return $this->Tipo_Seguro;
	}

	public function setTipo_Seguro($Tipo_Seguro){
		$this->Tipo_Seguro = $Tipo_Seguro;
	}

	public function getForma_Pago(){
		return $this->Forma_Pago;
	}

	public function setForma_Pago($Forma_Pago){
		$this->Forma_Pago = $Forma_Pago;
	}

	public function getPrima(){
		return $this->Prima;
	}

	public function setPrima($Prima){
		$this->Prima = $Prima;
	}

	public function getVigencia(){
		return $this->Vigencia;
	}

	public function setVigencia($Vigencia){
		$this->Vigencia = $Vigencia;
	}

    public function getSegurosPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Seguros WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

	public function getOne(){
        $Candidato=$this->getCandidato();
        $Renglon=$this->getRenglon();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Seguros WHERE Candidato=:Candidato AND Renglon=:Renglon"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    
	public function getRenglonMax(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Seguros WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Renglon;
    }

	public function create(){
		$result = false;

		$Renglon = $this->getRenglonMax() + 1;
		$Candidato = $this->getCandidato();
        $Institucion = $this->getInstitucion();
        $Tipo_Seguro = $this->getTipo_Seguro();
        $Forma_Pago = $this->getForma_Pago();
		$Prima = $this->getPrima();
		$Vigencia = $this->getVigencia();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Seguros(
			Candidato, Renglon, Institucion, Tipo_seguro, Forma_Pago, Prima, Vigencia)
		VALUES (:Candidato, :Renglon, :Institucion, :Tipo_Seguro, :Forma_Pago, :Prima, :Vigencia)");
        $stmt->bindParam(":Institucion", $Institucion, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo_Seguro", $Tipo_Seguro, PDO::PARAM_STR);
		$stmt->bindParam(":Forma_Pago", $Forma_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Prima", $Prima, PDO::PARAM_STR);
		$stmt->bindParam(":Vigencia", $Vigencia, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function update(){
        $result = false;

        $Renglon = $this->getRenglon();
		$Candidato = $this->getCandidato();
        $Institucion = $this->getInstitucion();
        $Tipo_Seguro = $this->getTipo_Seguro();
        $Forma_Pago = $this->getForma_Pago();
		$Prima = $this->getPrima();
		$Vigencia = $this->getVigencia();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Seguros SET Institucion=:Institucion,  Tipo_Seguro=:Tipo_Seguro, Forma_Pago=:Forma_Pago, Prima=:Prima, Vigencia=:Vigencia WHERE Candidato=:Candidato and Renglon=:Renglon");
        $stmt->bindParam(":Institucion", $Institucion, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo_Seguro", $Tipo_Seguro, PDO::PARAM_STR);
		$stmt->bindParam(":Forma_Pago", $Forma_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Prima", $Prima, PDO::PARAM_STR);
		$stmt->bindParam(":Vigencia", $Vigencia, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Seguros WHERE Candidato=:Candidato AND Renglon=:Renglon");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Seguros(
			Candidato, Renglon, Institucion, Tipo_seguro, Forma_Pago, Prima, Vigencia)
		SELECT :Candidato, Renglon, Institucion, Tipo_Seguro, Forma_Pago, Prima, Vigencia FROM rh_Candidatos_Seguros WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}