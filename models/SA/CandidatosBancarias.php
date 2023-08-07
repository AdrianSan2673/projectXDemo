<?php 
 

 class CandidatosBancarias {

    private $Candidato;
    private $Renglon;
    private $Institucion;
    private $Tipo_Cuenta;
    private $Objetivo;
    private $Deposito_Mensual;


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

	public function getTipo_Cuenta(){
		return $this->Tipo_Cuenta;
	}

	public function setTipo_Cuenta($Tipo_Cuenta){
		$this->Tipo_Cuenta = $Tipo_Cuenta;
	}

	public function getObjetivo(){
		return $this->Objetivo;
	}

	public function setObjetivo($Objetivo){
		$this->Objetivo = $Objetivo;
	}

	public function getDeposito_Mensual(){
		return $this->Deposito_Mensual;
	}

	public function setDeposito_Mensual($Deposito_Mensual){
		$this->Deposito_Mensual = $Deposito_Mensual;
	}
    
    public function getCuentasPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Bancarias WHERE Candidato=:Candidato"
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
            "SELECT * FROM rh_Candidatos_Bancarias WHERE Candidato=:Candidato AND Renglon=:Renglon"
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
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Bancarias WHERE Candidato=:Candidato");
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
        $Tipo_Cuenta = $this->getTipo_Cuenta();
        $Objetivo = $this->getObjetivo();
		$Deposito_Mensual = $this->getDeposito_Mensual();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Bancarias(
			Candidato, Renglon, Institucion, Tipo_Cuenta, Objetivo, Deposito_Mensual)
		VALUES (:Candidato, :Renglon, :Institucion, :Tipo_Cuenta, :Objetivo, :Deposito_Mensual)");
        $stmt->bindParam(":Institucion", $Institucion, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo_Cuenta", $Tipo_Cuenta, PDO::PARAM_STR);
		$stmt->bindParam(":Objetivo", $Objetivo, PDO::PARAM_STR);
		$stmt->bindParam(":Deposito_Mensual", $Deposito_Mensual, PDO::PARAM_STR);
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
        $Tipo_Cuenta = $this->getTipo_Cuenta();
        $Objetivo = $this->getObjetivo();
		$Deposito_Mensual = $this->getDeposito_Mensual();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Bancarias SET Institucion=:Institucion,  Tipo_Cuenta=:Tipo_Cuenta, Objetivo=:Objetivo, Deposito_Mensual=:Deposito_Mensual WHERE Candidato=:Candidato and Renglon=:Renglon");
        $stmt->bindParam(":Institucion", $Institucion, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo_Cuenta", $Tipo_Cuenta, PDO::PARAM_STR);
		$stmt->bindParam(":Objetivo", $Objetivo, PDO::PARAM_STR);
		$stmt->bindParam(":Deposito_Mensual", $Deposito_Mensual, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Bancarias WHERE Candidato=:Candidato AND Renglon=:Renglon");
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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Bancarias(
			Candidato, Renglon, Institucion, Tipo_Cuenta, Objetivo, Deposito_Mensual)
		SELECT :Candidato, Renglon, Institucion, Tipo_Cuenta, Objetivo, Deposito_Mensual FROM rh_Candidatos_Bancarias WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

 }