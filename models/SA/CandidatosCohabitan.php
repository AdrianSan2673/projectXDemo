<?php

class CandidatosCohabitan {

    
    //rh_Candidatos_Cohabitan
    private $Candidato;
    private $Renglon;
    private $Nombre;
    private $Parentesco;
    private $Edad;
    private $Edad_2;
    private $Estado_Civil;
    private $Ocupacion;
    private $Empresa;
    private $Dependiente;
    private $Telefono;
	private $Es_Mayor_Edad;

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

	public function getNombre(){
		return $this->Nombre;
	}

	public function setNombre($Nombre){
		$this->Nombre = $Nombre;
	}

	public function getParentesco(){
		return $this->Parentesco;
	}

	public function setParentesco($Parentesco){
		$this->Parentesco = $Parentesco;
	}

	public function getEdad(){
		return $this->Edad;
	}

	public function setEdad($Edad){
		$this->Edad = $Edad;
	}

	public function getEdad_2(){
		return $this->Edad_2;
	}

	public function setEdad_2($Edad_2){
		$this->Edad_2 = $Edad_2;
	}

	public function getEstado_Civil(){
		return $this->Estado_Civil;
	}

	public function setEstado_Civil($Estado_Civil){
		$this->Estado_Civil = $Estado_Civil;
	}

	public function getOcupacion(){
		return $this->Ocupacion;
	}

	public function setOcupacion($Ocupacion){
		$this->Ocupacion = $Ocupacion;
	}

	public function getEmpresa(){
		return $this->Empresa;
	}

	public function setEmpresa($Empresa){
		$this->Empresa = $Empresa;
	}

	public function getDependiente(){
		return $this->Dependiente;
	}

	public function setDependiente($Dependiente){
		$this->Dependiente = $Dependiente;
	}

	public function getTelefono(){
		return $this->Telefono;
	}

	public function setTelefono($Telefono){
		$this->Telefono = $Telefono;
	}

	public function getEs_Mayor_Edad(){
		return $this->Es_Mayor_Edad;
	}

	public function setEs_Mayor_Edad($Es_Mayor_Edad){
		$this->Es_Mayor_Edad = $Es_Mayor_Edad;
	}

    public function getCohabitantesPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Cohabitan WHERE Candidato=:Candidato"
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
            "SELECT * FROM rh_Candidatos_Cohabitan WHERE Candidato=:Candidato  AND Renglon=:Renglon"
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
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Cohabitan WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Renglon;
    }

	public function create(){
		$result = false;

		$Renglon = $this->getRenglonMax() + 1;
		$Candidato = $this->getCandidato();
        $Nombre = $this->getNombre();
        $Parentesco = $this->getParentesco();
		$Edad = $this->getEdad();
		$Edad_2 = $this->getEdad_2();
		$Estado_Civil = $this->getEstado_Civil();
		$Ocupacion = $this->getOcupacion();
		$Empresa = $this->getEmpresa();
		$Dependiente = $this->getDependiente();
        $Telefono = $this->getTelefono();
		$Es_Mayor_Edad = $this->getEs_Mayor_Edad();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Cohabitan (Candidato,Renglon,Nombre,Parentesco,Edad,Estado_Civil, Ocupacion, Empresa,Dependiente, Telefono, Edad_2, Es_Mayor_Edad)
		VALUES (:Candidato, :Renglon, :Nombre, :Parentesco, :Edad, :Estado_Civil, :Ocupacion, :Empresa, :Dependiente, :Telefono, :Edad_2, :Es_Mayor_Edad)");
        $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
        $stmt->bindParam(":Parentesco", $Parentesco, PDO::PARAM_INT);
		$stmt->bindParam(":Edad", $Edad, PDO::PARAM_INT);
		$stmt->bindParam(":Edad_2", $Edad_2, PDO::PARAM_STR);
		$stmt->bindParam(":Estado_Civil", $Estado_Civil, PDO::PARAM_INT);
		$stmt->bindParam(":Ocupacion", $Ocupacion, PDO::PARAM_STR);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);
		$stmt->bindParam(":Dependiente", $Dependiente, PDO::PARAM_INT);
		$stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);
		$stmt->bindParam(":Es_Mayor_Edad", $Es_Mayor_Edad, PDO::PARAM_INT);

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
        $Nombre = $this->getNombre();
        $Parentesco = $this->getParentesco();
		$Edad = $this->getEdad();
		$Edad_2 = $this->getEdad_2();
		$Estado_Civil = $this->getEstado_Civil();
		$Ocupacion = $this->getOcupacion();
		$Empresa = $this->getEmpresa();
		$Dependiente = $this->getDependiente();
        $Telefono = $this->getTelefono();
		$Es_Mayor_Edad = $this->getEs_Mayor_Edad();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Cohabitan SET Nombre=:Nombre, Parentesco=:Parentesco, Edad=:Edad, Estado_Civil=:Estado_Civil, Ocupacion=:Ocupacion, Empresa=:Empresa, Dependiente=:Dependiente, Telefono=:Telefono, Edad_2=:Edad_2, Es_Mayor_Edad=:Es_Mayor_Edad WHERE Candidato=:Candidato and Renglon=:Renglon");
        $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
        $stmt->bindParam(":Parentesco", $Parentesco, PDO::PARAM_INT);
		$stmt->bindParam(":Edad", $Edad, PDO::PARAM_INT);
		$stmt->bindParam(":Edad_2", $Edad_2, PDO::PARAM_STR);
		$stmt->bindParam(":Estado_Civil", $Estado_Civil, PDO::PARAM_INT);
		$stmt->bindParam(":Ocupacion", $Ocupacion, PDO::PARAM_STR);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);
		$stmt->bindParam(":Dependiente", $Dependiente, PDO::PARAM_INT);
		$stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);
		$stmt->bindParam(":Es_Mayor_Edad", $Es_Mayor_Edad, PDO::PARAM_INT);

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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Cohabitan WHERE Candidato=:Candidato AND Renglon=:Renglon");
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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Cohabitan (Candidato,Renglon,Nombre,Parentesco,Edad,Estado_Civil, Ocupacion, Empresa,Dependiente, Telefono, Edad_2, Es_Mayor_Edad)
		SELECT :Candidato, Renglon, Nombre, Parentesco, Edad, Estado_Civil, Ocupacion, Empresa, Dependiente, Telefono, Edad_2, Es_Mayor_Edad FROM rh_Candidatos_Cohabitan WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

}