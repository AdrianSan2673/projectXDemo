<?php

class CandidatosSaludSeguros{

    private $Candidato;
    private $Servicio_Medico;

    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getServicio_Medico(){
		return $this->Servicio_Medico;
	}

	public function setServicio_Medico($Servicio_Medico){
		$this->Servicio_Medico = $Servicio_Medico;
	}

    public function getSaludSegurosPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT s.*, c.Descripcion FROM rh_Candidatos_Salud_Seguro s INNER JOIN (SELECT Campo, Descripcion FROM sys_Campos WHERE Tabla=108) c ON s.Servicio_Medico=c.Campo WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Servicio_Medico = $this->getServicio_Medico();
        
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Salud_Seguro (Candidato, Servicio_Medico)
		VALUES (:Candidato, :Servicio_Medico)");
        $stmt->bindParam(":Servicio_Medico", $Servicio_Medico, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function deleteSegurosPorCandidato(){
		$result = false;

		$Candidato = $this->getCandidato();
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Salud_Seguro WHERE Candidato=:Candidato");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

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
        
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Salud_Seguro (Candidato, Servicio_Medico)
		SELECT :Candidato, Servicio_Medico FROM rh_Candidatos_Salud_Seguro WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}