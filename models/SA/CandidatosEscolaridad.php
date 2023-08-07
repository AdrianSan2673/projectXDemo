<?php



class CandidatosEscolaridad {
    private $Candidato;
    private $Renglon;
    private $Grado;
    private $Institucion;
    private $Localidad;
    private $Periodo;
    private $Documento;
    private $Folio;

	
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

	public function getGrado(){
		return $this->Grado;
	}

	public function setGrado($Grado){
		$this->Grado = $Grado;
	}

	public function getInstitucion(){
		return $this->Institucion;
	}

	public function setInstitucion($Institucion){
		$this->Institucion = $Institucion;
	}

	public function getLocalidad(){
		return $this->Localidad;
	}

	public function setLocalidad($Localidad){
		$this->Localidad = $Localidad;
	}

	public function getPeriodo(){
		return $this->Periodo;
	}

	public function setPeriodo($Periodo){
		$this->Periodo = $Periodo;
	}

	public function getDocumento(){
		return $this->Documento;
	}

	public function setDocumento($Documento){
		$this->Documento = $Documento;
	}

	public function getFolio(){
		return $this->Folio;
	}

	public function setFolio($Folio){
		$this->Folio = $Folio;
	}
    
    public function getEscolaridadPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Escolaridad WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

	public function getOne(){
        $Candidato=$this->getCandidato();
		$Renglon = $this->getRenglon();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Escolaridad WHERE Candidato=:Candidato AND Renglon=:Renglon"
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
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Escolaridad WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Renglon;
    }

	public function create(){
		$result = false;

		$Renglon = $this->getRenglonMax() + 1;
		$Candidato = $this->getCandidato();
        $Grado = $this->getGrado();
        $Institucion = $this->getInstitucion();
        $Localidad = $this->getLocalidad();
		$Periodo = $this->getPeriodo();
		$Documento = $this->getDocumento();
		$Folio = $this->getFolio();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Escolaridad(Candidato, Renglon, Grado, Institucion, Localidad, Periodo, Documento, Folio)
		VALUES (:Candidato, :Renglon, :Grado, :Institucion, :Localidad, :Periodo, :Documento, :Folio)");
		$stmt->bindParam(":Grado", $Grado, PDO::PARAM_INT);
        $stmt->bindParam(":Institucion", $Institucion, PDO::PARAM_STR);
        $stmt->bindParam(":Localidad", $Localidad, PDO::PARAM_STR);
		$stmt->bindParam(":Periodo", $Periodo, PDO::PARAM_STR);
		$stmt->bindParam(":Documento", $Documento, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_STR);
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
        $Grado = $this->getGrado();
        $Institucion = $this->getInstitucion();
        $Localidad = $this->getLocalidad();
		$Periodo = $this->getPeriodo();
		$Documento = $this->getDocumento();
		$Folio = $this->getFolio();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Escolaridad SET Grado=:Grado, Institucion=:Institucion, Localidad=:Localidad, Periodo=:Periodo, Documento=:Documento, Folio=:Folio WHERE Candidato=:Candidato and Renglon=:Renglon");
        $stmt->bindParam(":Grado", $Grado, PDO::PARAM_INT);
        $stmt->bindParam(":Institucion", $Institucion, PDO::PARAM_STR);
        $stmt->bindParam(":Localidad", $Localidad, PDO::PARAM_STR);
		$stmt->bindParam(":Periodo", $Periodo, PDO::PARAM_STR);
		$stmt->bindParam(":Documento", $Documento, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Escolaridad WHERE Candidato=:Candidato AND Renglon=:Renglon");
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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Escolaridad(Candidato, Renglon, Grado, Institucion, Localidad, Periodo, Documento, Folio)
		SELECT :Candidato, Renglon, Grado, Institucion, Localidad, Periodo, Documento, Folio FROM rh_Candidatos_Escolaridad WHERE Candidato=:Folio");
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}
