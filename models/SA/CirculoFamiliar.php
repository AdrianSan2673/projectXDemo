<?php

class CirculoFamiliar{
	//circulo_familiar
	private $Id;
	private $Parentesco;
	private $Telefono_Parentesco;
	private $Nombre_Parentesco;
	private $Candidato;
	private $Estatus;


	
	public function __construct() {
		$this->db = Connection::connectSA();
	}

	public function getId(){
		return $this->Id;
	}

	public function setId($Id){
		$this->Id = $Id;
	}

	public function getParentesco(){
		return $this->Parentesco;
	}

	public function setParentesco($Parentesco){
		$this->Parentesco = $Parentesco;
	}

	public function getTelefono_Parentesco(){
		return $this->Telefono_Parentesco;
	}

	public function setTelefono_Parentesco($Telefono_Parentesco){
		$this->Telefono_Parentesco = $Telefono_Parentesco;
	}

	public function getNombre_Parentesco(){
		return $this->Nombre_Parentesco;
	}

	public function setNombre_Parentesco($Nombre_Parentesco){
		$this->Nombre_Parentesco = $Nombre_Parentesco;
	}

	public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getEstatus(){
		return $this->Estatus;
	}

	public function setEstatus($Estatus){
		$this->Estatus = $Estatus;
	}
    
    public function getFamiliaresPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM circulo_familiar WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    
    public function getOne(){
        $Id=$this->getId();
        $stmt = $this->db->prepare(
            "SELECT * FROM circulo_familiar WHERE Id=:Id"
        );
        $stmt->bindParam(":Id", $Id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Nombre_Parentesco = $this->getNombre_Parentesco();
        $Parentesco = $this->getParentesco();
        $Telefono_Parentesco = $this->getTelefono_Parentesco();
		$Estatus = $this->getEstatus();
		
        $stmt = $this->db->prepare("INSERT INTO Circulo_Familiar (Candidato, Parentesco, Nombre_Parentesco, Telefono_Parentesco, Estatus)
		VALUES (:Candidato, :Parentesco, :Nombre_Parentesco, :Telefono_Parentesco, :Estatus)");
        $stmt->bindParam(":Nombre_Parentesco", $Nombre_Parentesco, PDO::PARAM_STR);
        $stmt->bindParam(":Parentesco", $Parentesco, PDO::PARAM_INT);
		$stmt->bindParam(":Telefono_Parentesco", $Telefono_Parentesco, PDO::PARAM_STR);
        $stmt->bindParam(":Estatus", $Estatus, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function update(){
        $result = false;

        $Id = $this->getId();
        $Nombre_Parentesco = $this->getNombre_Parentesco();
        $Parentesco = $this->getParentesco();
        $Telefono_Parentesco = $this->getTelefono_Parentesco();
		$Estatus = $this->getEstatus();

        $stmt = $this->db->prepare("UPDATE Circulo_Familiar
		SET Parentesco=:Parentesco
			,Nombre_Parentesco=:Nombre_Parentesco
			,Telefono_Parentesco=:Telefono_Parentesco
			,Estatus=:Estatus
		WHERE Id=:Id");
        $stmt->bindParam(":Nombre_Parentesco", $Nombre_Parentesco, PDO::PARAM_STR);
        $stmt->bindParam(":Parentesco", $Parentesco, PDO::PARAM_INT);
		$stmt->bindParam(":Telefono_Parentesco", $Telefono_Parentesco, PDO::PARAM_STR);
        $stmt->bindParam(":Estatus", $Estatus, PDO::PARAM_STR);
		$stmt->bindParam(":Id", $Id, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function delete(){
		$result = false;

		$Id = $this->getId();
		
        $stmt = $this->db->prepare("DELETE FROM Circulo_Familiar WHERE Id=:Id");
		$stmt->bindParam(":Id", $Id, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

}