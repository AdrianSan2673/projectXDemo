<?php

class CandidatosEgresos{

    private $Candidato;
    private $Egreso;
    private $Monto;
 

    public function __construct() {
        $this->db = Connection::connectSA();
    }
    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getEgreso(){
		return $this->Egreso;
	}

	public function setEgreso($Egreso){
		$this->Egreso = $Egreso;
	}

	public function getMonto(){
		return $this->Monto;
	}

	public function setMonto($Monto){
		$this->Monto = $Monto;
	}

    public function getEgresosPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT e.*, c.Descripcion FROM rh_Candidatos_Egresos e INNER JOIN (SELECT * FROM sys_Campos WHERE Tabla=115) c ON e.Egreso=c.Campo WHERE Candidato=:Candidato ORDER BY e.Monto DESC"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
    
    public function getOne(){
        $Candidato=$this->getCandidato();
		$Egreso=$this->getEgreso();
        $stmt = $this->db->prepare(
            "SELECT e.*, c.Descripcion FROM rh_Candidatos_Egresos e INNER JOIN (SELECT * FROM sys_Campos WHERE Tabla=115) c ON e.Egreso=c.Campo WHERE Candidato=:Candidato AND Egreso=:Egreso"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Egreso", $Egreso, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getTotalEgresos(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT SUM(e.Monto) AS Total_Egresos FROM rh_Candidatos_Egresos e WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Total_Egresos;
    }

	public function create(){
		$result = false;

		$Egreso = $this->getEgreso();
		$Candidato = $this->getCandidato();
        $Monto = $this->getMonto();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Egresos (Candidato, Egreso, Monto)
		VALUES (:Candidato, :Egreso, :Monto)");
        $stmt->bindParam(":Monto", $Monto, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Egreso", $Egreso, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function update(){
        $result = false;

        $Egreso = $this->getEgreso();
		$Candidato = $this->getCandidato();
        $Monto = $this->getMonto();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Egresos SET Monto=:Monto WHERE Candidato=:Candidato and Egreso=:Egreso");
        $stmt->bindParam(":Monto", $Monto, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Egreso", $Egreso, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function delete(){
		$result = false;

		$Candidato = $this->getCandidato();
		$Egreso = $this->getEgreso();
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Egresos WHERE Candidato=:Candidato AND Egreso=:Egreso");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Egreso", $Egreso, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
    
    public function getEgresosFaltantesPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT c.Campo, c.Descripcion FROM (SELECT * FROM sys_Campos WHERE Tabla=115) c LEFT OUTER JOIN (SELECT * FROM rh_Candidatos_Egresos WHERE Candidato=:Candidato) e ON e.Egreso=c.Campo WHERE e.Egreso IS NULL ORDER BY c.Descripcion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
	
	public function duplicate($duplicado){
		$result = false;

		$Candidato = $this->getCandidato();
        $Folio = $duplicado;
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Egresos (Candidato, Egreso, Monto)
		SELECT :Candidato, Egreso, Monto FROM rh_Candidatos_Egresos WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}