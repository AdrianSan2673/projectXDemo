<?php

class CandidatosCreditos{

    private $Candidato;
    private $Renglon;
    private $Institucion;
    private $Limite_Credito;
    private $Saldo_Actual;
    private $Vencimiento;
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

	public function getInstitucion(){
		return $this->Institucion;
	}

	public function setInstitucion($Institucion){
		$this->Institucion = $Institucion;
	}

	public function getLimite_Credito(){
		return $this->Limite_Credito;
	}

	public function setLimite_Credito($Limite_Credito){
		$this->Limite_Credito = $Limite_Credito;
	}

	public function getSaldo_Actual(){
		return $this->Saldo_Actual;
	}

	public function setSaldo_Actual($Saldo_Actual){
		$this->Saldo_Actual = $Saldo_Actual;
	}

	public function getVencimiento(){
		return $this->Vencimiento;
	}

	public function setVencimiento($Vencimiento){
		$this->Vencimiento = $Vencimiento;
	}

	public function getAbono_Mensual(){
		return $this->Abono_Mensual;
	}

	public function setAbono_Mensual($Abono_Mensual){
		$this->Abono_Mensual = $Abono_Mensual;
	}

    public function getCreditosPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Creditos WHERE Candidato=:Candidato"
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
            "SELECT * FROM rh_Candidatos_Creditos WHERE Candidato=:Candidato AND Renglon=:Renglon"
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
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Creditos WHERE Candidato=:Candidato");
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
        $Limite_Credito = $this->getLimite_Credito();
        $Saldo_Actual = $this->getSaldo_Actual();
		$Vencimiento = $this->getVencimiento();
		$Abono_Mensual = $this->getAbono_Mensual();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Creditos(Candidato,Renglon,Institucion,Limite_Credito,Saldo_Actual,Vencimiento,Abono_Mensual)
		VALUES (:Candidato, :Renglon, :Institucion, :Limite_Credito, :Saldo_Actual, :Vencimiento, :Abono_Mensual)");
        $stmt->bindParam(":Institucion", $Institucion, PDO::PARAM_STR);
        $stmt->bindParam(":Limite_Credito", $Limite_Credito, PDO::PARAM_STR);
		$stmt->bindParam(":Saldo_Actual", $Saldo_Actual, PDO::PARAM_STR);
		$stmt->bindParam(":Vencimiento", $Vencimiento, PDO::PARAM_STR);
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
        $Institucion = $this->getInstitucion();
        $Limite_Credito = $this->getLimite_Credito();
        $Saldo_Actual = $this->getSaldo_Actual();
		$Vencimiento = $this->getVencimiento();
		$Abono_Mensual = $this->getAbono_Mensual();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Creditos SET Institucion=:Institucion,  Limite_Credito=:Limite_Credito, Saldo_Actual=:Saldo_Actual, Vencimiento=:Vencimiento, Abono_Mensual=:Abono_Mensual WHERE Candidato=:Candidato and Renglon=:Renglon");
        $stmt->bindParam(":Institucion", $Institucion, PDO::PARAM_STR);
        $stmt->bindParam(":Limite_Credito", $Limite_Credito, PDO::PARAM_STR);
		$stmt->bindParam(":Saldo_Actual", $Saldo_Actual, PDO::PARAM_STR);
		$stmt->bindParam(":Vencimiento", $Vencimiento, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Creditos WHERE Candidato=:Candidato AND Renglon=:Renglon");
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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Creditos(Candidato,Renglon,Institucion,Limite_Credito,Saldo_Actual,Vencimiento,Abono_Mensual)
		SELECT :Candidato, Renglon, Institucion, Limite_Credito, Saldo_Actual, Vencimiento, Abono_Mensual FROM rh_Candidatos_Creditos WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}
