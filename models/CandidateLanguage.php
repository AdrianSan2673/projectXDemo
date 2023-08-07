<?php

class CandidateLanguage{

	private $id;
	private $id_language;
	private $level;
	private $institution;
	private $start_date;
	private $end_date;
	private $id_candidate;

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

	public function getId_language(){
		return $this->id_language;
	}

	public function setId_language($id_language){
		$this->id_language = $id_language;
	}

	public function getLevel(){
		return $this->level;
	}

	public function setLevel($level){
		$this->level = $level;
	}

	public function getInstitution(){
		return $this->institution;
	}

	public function setInstitution($institution){
		$this->institution = $institution;
	}

	public function getStart_date(){
		return $this->start_date;
	}

	public function setStart_date($start_date){
		$this->start_date = $start_date;
	}

	public function getEnd_date(){
		return $this->end_date;
	}

	public function setEnd_date($end_date){
		$this->end_date = $end_date;
	}

	public function getId_candidate(){
		return $this->id_candidate;
	}

	public function setId_candidate($id_candidate){
		$this->id_candidate = $id_candidate;
	}

	public function getLanguagesByCandidate(){
		$candidate = $this->getId_candidate();
        $stmt = $this->db->prepare("SELECT cl.*, l.language, ll.language_level FROM candidate_language cl INNER JOIN languages l ON cl.id_language=l.id INNER JOIN language_levels ll ON cl.level=ll.id WHERE id_candidate=:id_candidate;");
        $stmt->bindParam(":id_candidate", $candidate, PDO::PARAM_STR);
        $stmt->execute();
        $languages = $stmt->fetchAll();
        return $languages;
	}

	public function save(){
		$result = false;

        $id_candidate = $this->getId_candidate();
        $id_language = $this->getId_language();
        $level = $this->getLevel();
        $institution = $this->getInstitution();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();

        $stmt = $this->db->prepare("INSERT INTO candidate_language(id_candidate, id_language, level, institution, start_date, end_date) VALUES (:id_candidate, :id_language, :level, :institution, :start_date, :end_date)");
        $stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":id_language", $id_language, PDO::PARAM_INT);
        $stmt->bindParam(":level", $level, PDO::PARAM_INT);
        $stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);

		$flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
	}
	
	public function update(){
		$result = false;

        $id = $this->getId();
        $id_language = $this->getId_language();
        $level = $this->getLevel();
        $institution = $this->getInstitution();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        
        $stmt = $this->db->prepare("UPDATE candidate_language SET id_language=:id_language, level=:level, institution=:institution, start_date=:start_date, end_date=:end_date WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":id_language", $id_language, PDO::PARAM_INT);
        $stmt->bindParam(":level", $level, PDO::PARAM_INT);
        $stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        
		$flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
	}

    public function getOne(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT cl.*, c.first_name, c.surname, c.last_name FROM candidate_language cl INNER JOIN candidates c ON cl.id_candidate=c.id WHERE cl.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }


	// ===[GABO 25 ABRIL 2023 VER CANDIDATO]===

	public function getOneFull(){
		$id = $this->getId();
        $stmt = $this->db->prepare("SELECT cl.*, l.language, ll.language_level FROM candidate_language cl INNER JOIN languages l ON cl.id_language=l.id INNER JOIN language_levels ll ON cl.level=ll.id WHERE cl.id=:id;");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
		$fetch = $stmt->fetchObject();
        return $fetch;
	}

	public function getLanguageByCandidateAndLanguage(){
		$id_language = $this->getId_language();
		$id_candidate = $this->getId_candidate();
        $stmt = $this->db->prepare("SELECT * FROM candidate_language cl  WHERE id_language=:id_language and id_candidate=:id_candidate");
        $stmt->bindParam(":id_language", $id_language, PDO::PARAM_STR);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_STR);
        $stmt->execute();
		$fetch = $stmt->fetchObject();
        return $fetch;
	}

	public function delete(){
        $id = $this->getId();
        $stmt = $this->db->prepare("DELETE TOP (1) FROM candidate_language WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag=$stmt->execute();
		if ($flag) {
            $result = true;
        }
        return $result;
    }
 // ===[FIN]===



	// ===[FIN]===
}