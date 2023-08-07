<?php

class NotasEjecutivo{
    private $Id;
    private $Nota;
    private $Candidato;
    private $Ejecutivo;
    private $created_at;
    private $modified_at;

    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getId(){
		return $this->Id;
	}

	public function setId($Id){
		$this->Id = $Id;
	}

	public function getNota(){
		return $this->Nota;
	}

	public function setNota($Nota){
		$this->Nota = $Nota;
	}

	public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getEjecutivo(){
		return $this->Ejecutivo;
	}

	public function setEjecutivo($Ejecutivo){
		$this->Ejecutivo = $Ejecutivo;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

	public function getModified_at(){
		return $this->modified_at;
	}

	public function setModified_at($modified_at){
		$this->modified_at = $modified_at;
	}

    public function getOne(){
		$Id=$this->getId();
        $stmt = $this->db->prepare(
            "SELECT * FROM Notas_Ejecutivo WHERE Id=:Id"
        );
        $stmt->bindParam(":Id", $Id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }


    public function getNotasPorCandidato(){
        $Candidato = $this->getCandidato();
        
        $stmt = $this->db->prepare("SELECT n.Id, n.Nota, n.Ejecutivo, CONVERT(DATE, n.created_at) AS Fecha, u.first_name, u.last_name, u.id AS id_user FROM Notas_Ejecutivo n LEFT JOIN reclutamiento.dbo.users u ON n.Ejecutivo=u.username WHERE Candidato=:Candidato ORDER BY n.created_at DESC");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function create(){
		$result = false;

		$Nota = $this->getNota();
        $Candidato = $this->getCandidato();
        $Ejecutivo = $this->getEjecutivo();
		
        $stmt = $this->db->prepare("INSERT INTO Notas_Ejecutivo (Nota, Candidato, Ejecutivo, created_at, modified_at) VALUES (:Nota, :Candidato, :Ejecutivo, GETDATE(), GETDATE())");
		$stmt->bindParam(":Nota", $Nota, PDO::PARAM_STR);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
			$this->setID($this->db->lastInsertId());
        }
        return $result;
    }

    public function update(){
        $result = false;

        $Id = $this->getId();
        $Nota = $this->getNota();
        $Candidato = $this->getCandidato();
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("UPDATE Notas_Ejecutivo SET Nota=:Nota, Candidato=:Candidato, Ejecutivo=:Ejecutivo, modified_at=GETDATE() WHERE Id=:Id");
        $stmt->bindParam(":Nota", $Nota, PDO::PARAM_STR);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->bindParam(":Id", $Id, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag)
            $result = true;

        return $result;
    }

    public function delete(){
		$result = false;

		$Candidato = $this->getCandidato();
		$id = $this->getId();
		
        $stmt = $this->db->prepare("DELETE FROM Notas_Ejecutivo WHERE Candidato=:Candidato AND id=:id");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}