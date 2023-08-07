<?php

class CandidatosIngresos {
    //rh_Candidatos_Ingresos
    private $Candidato;
    private $Reglon;
    private $Renglon;
    private $Aporta;
    private $Fuente;
    private $Monto;
    
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

    public function getReglon(){
        return $this->Reglon;
    }

    public function setReglon($Reglon){
        $this->Reglon = $Reglon;
    }

    public function getRenglon(){
        return $this->Renglon;
    }

    public function setRenglon($Renglon){
        $this->Renglon = $Renglon;
    }

    public function getAporta(){
        return $this->Aporta;
    }

    public function setAporta($Aporta){
        $this->Aporta = $Aporta;
    }

    public function getFuente(){
        return $this->Fuente;
    }

    public function setFuente($Fuente){
        $this->Fuente = $Fuente;
    }

    public function getMonto(){
        return $this->Monto;
    }

    public function setMonto($Monto){
        $this->Monto = $Monto;
    }

    public function getIngresosPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Ingresos WHERE Candidato=:Candidato ORDER BY Monto DESC"
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
            "SELECT * FROM rh_Candidatos_Ingresos WHERE Candidato=:Candidato  AND Renglon=:Renglon"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getTotalIngresos(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT SUM(i.Monto) AS Total_Ingresos FROM rh_Candidatos_Ingresos i WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Total_Ingresos;
    }

	public function getRenglonMax(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Ingresos WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Renglon;
    }

	public function create(){
		$result = false;

		$Renglon = $this->getRenglonMax() + 1;
		$Candidato = $this->getCandidato();
        $Aporta = $this->getAporta();
        $Fuente = $this->getFuente();
        $Monto = $this->getMonto();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Ingresos (Candidato, Renglon, Aporta, Fuente, Monto)
		VALUES (:Candidato, :Renglon, :Aporta, :Fuente, :Monto)");
        $stmt->bindParam(":Aporta", $Aporta, PDO::PARAM_STR);
        $stmt->bindParam(":Fuente", $Fuente, PDO::PARAM_STR);
		$stmt->bindParam(":Monto", $Monto, PDO::PARAM_STR);
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
        $Aporta = $this->getAporta();
        $Fuente = $this->getFuente();
        $Monto = $this->getMonto();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Ingresos SET Aporta=:Aporta, Fuente=:Fuente, Monto=:Monto WHERE Candidato=:Candidato and Renglon=:Renglon");
        $stmt->bindParam(":Aporta", $Aporta, PDO::PARAM_STR);
        $stmt->bindParam(":Fuente", $Fuente, PDO::PARAM_STR);
		$stmt->bindParam(":Monto", $Monto, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Ingresos WHERE Candidato=:Candidato AND Renglon=:Renglon");
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

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Ingresos (Candidato, Renglon, Aporta, Fuente, Monto)
		SELECT :Candidato, Renglon, Aporta, Fuente, Monto FROM rh_Candidatos_Ingresos WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}