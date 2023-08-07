<?php

class CandidatosInmuebles{
    private $Candidato;
    private $Renglon;
    private $Tipo_Inmueble;
    private $Ubicacion;
    private $Valor;
    private $Pagado;
    private $Abono_Mensual;

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

	public function getTipo_Inmueble(){
		return $this->Tipo_Inmueble;
	}

	public function setTipo_Inmueble($Tipo_Inmueble){
		$this->Tipo_Inmueble = $Tipo_Inmueble;
	}

	public function getUbicacion(){
		return $this->Ubicacion;
	}

	public function setUbicacion($Ubicacion){
		$this->Ubicacion = $Ubicacion;
	}

	public function getValor(){
		return $this->Valor;
	}

	public function setValor($Valor){
		$this->Valor = $Valor;
	}

	public function getPagado(){
		return $this->Pagado;
	}

	public function setPagado($Pagado){
		$this->Pagado = $Pagado;
	}

	public function getAbono_Mensual(){
		return $this->Abono_Mensual;
	}

	public function setAbono_Mensual($Abono_Mensual){
		$this->Abono_Mensual = $Abono_Mensual;
	}

    public function getInmueblesPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Inmuebles WHERE Candidato=:Candidato"
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
            "SELECT * FROM rh_Candidatos_Inmuebles WHERE Candidato=:Candidato AND Renglon=:Renglon"
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
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Inmuebles WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Renglon;
    }

	public function create(){
		$result = false;

		$Renglon = $this->getRenglonMax() + 1;
		$Candidato = $this->getCandidato();
        $Tipo_Inmueble = $this->getTipo_Inmueble();
        $Ubicacion = $this->getUbicacion();
        $Valor = $this->getValor();
		$Pagado = $this->getPagado();
		$Abono_Mensual = $this->getAbono_Mensual();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Inmuebles(
			Candidato, Renglon, Tipo_Inmueble, Ubicacion, Valor, Pagado, Abono_Mensual)
		VALUES (:Candidato, :Renglon, :Tipo_Inmueble, :Ubicacion, :Valor, :Pagado, :Abono_Mensual)");
        $stmt->bindParam(":Tipo_Inmueble", $Tipo_Inmueble, PDO::PARAM_STR);
        $stmt->bindParam(":Ubicacion", $Ubicacion, PDO::PARAM_STR);
		$stmt->bindParam(":Valor", $Valor, PDO::PARAM_STR);
		$stmt->bindParam(":Pagado", $Pagado, PDO::PARAM_STR);
		$stmt->bindParam(":Abono_Mensual", $Abono_Mensual, PDO::PARAM_STR);
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
        $Tipo_Inmueble = $this->getTipo_Inmueble();
        $Ubicacion = $this->getUbicacion();
        $Valor = $this->getValor();
		$Pagado = $this->getPagado();
		$Abono_Mensual = $this->getAbono_Mensual();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Inmuebles SET Tipo_Inmueble=:Tipo_Inmueble, Ubicacion=:Ubicacion, Valor=:Valor, Pagado=:Pagado, Abono_Mensual=:Abono_Mensual WHERE Candidato=:Candidato and Renglon=:Renglon");
        $stmt->bindParam(":Tipo_Inmueble", $Tipo_Inmueble, PDO::PARAM_STR);
        $stmt->bindParam(":Ubicacion", $Ubicacion, PDO::PARAM_STR);
		$stmt->bindParam(":Valor", $Valor, PDO::PARAM_STR);
		$stmt->bindParam(":Pagado", $Pagado, PDO::PARAM_STR);
		$stmt->bindParam(":Abono_Mensual", $Abono_Mensual, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Inmuebles WHERE Candidato=:Candidato AND Renglon=:Renglon");
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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Inmuebles(
			Candidato, Renglon, Tipo_Inmueble, Ubicacion, Valor, Pagado, Abono_Mensual)
		SELECT :Candidato, Renglon, Tipo_Inmueble, Ubicacion, Valor, Pagado, Abono_Mensual FROM rh_Candidatos_Inmuebles WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}