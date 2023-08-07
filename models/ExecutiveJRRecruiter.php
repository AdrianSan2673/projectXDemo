<?php

class ExecutiveJRRecruiter{
	private $id;
    private $id_executiveJR;
	private $id_recruiter;
	
	private $db;

    public function __construct(){
        $this->db = Connection::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId_executiveJR(){
        return $this->id_executiveJR;
    }

    public function setId_executiveJR($id_executiveJR){
        $this->id_executiveJR = $id_executiveJR;
    }

    public function getId_recruiter(){
    	return $this->id_recruiter;
    }

    public function setId_recruiter($id_recruiter){
    	$this->id_recruiter = $id_recruiter;
    } 

    public function getUnassignedRecruiters(){
        $id_executiveJR = $this->getId_executiveJR();

        $stmt = $this->db->prepare("SELECT r.id, r.first_name, r.last_name FROM users r LEFT JOIN executiveJR_recruiters er ON r.id=er.id_recruiter WHERE r.id_user_type=2 AND Er.id_recruiter IS NULL OR er.id_executiveJR<>:id_executiveJR ORDER BY r.first_name ASC");
        $stmt->bindParam(":id_executiveJR", $id_executiveJR, PDO::PARAM_INT);
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
    }

    public function getRecruitersByExecutiveJR(){
		$id_executiveJR = $this->getId_executiveJR();

        $stmt = $this->db->prepare("SELECT r.id, r.first_name, r.last_name, r.email FROM users r INNER JOIN executiveJR_recruiters er ON r.id=er.id_recruiter WHERE er.id_executiveJR=:id_executiveJR");
        $stmt->bindParam(":id_executiveJR", $id_executiveJR, PDO::PARAM_INT);
        $stmt->execute();
        $recruiters = $stmt->fetchAll();
        return $recruiters;
	}

    public function getExecutiveJRByRecruiter(){
		$id_recruiter = $this->getId_recruiter();

        $stmt = $this->db->prepare("SELECT TOP(1) e.id, e.first_name, e.last_name, e.email FROM users e INNER JOIN executiveJR_recruiters er ON e.id=er.id_executiveJR WHERE er.id_recruiter=:id_recruiter");
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
	}

    public function create(){
		$result = false;

        $id_executiveJR = $this->getId_executiveJR();
		$id_recruiter = $this->getId_recruiter();

        $stmt = $this->db->prepare("INSERT INTO executiveJR_recruiters(id_executiveJR, id_recruiter) VALUES (:id_executiveJR, :id_recruiter)");
        $stmt->bindParam(":id_executiveJR", $id_executiveJR, PDO::PARAM_INT);
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_INT);
        
		$flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function delete(){
    	$result = false;

		$id_executiveJR = $this->getId_executiveJR();
        $id_recruiter = $this->getId_recruiter();

        $stmt = $this->db->prepare("DELETE FROM executiveJR_recruiters WHERE id_executiveJR=:id_executiveJR AND id_recruiter=:id_recruiter");
        $stmt->bindParam(":id_executiveJR", $id_executiveJR, PDO::PARAM_INT);
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}