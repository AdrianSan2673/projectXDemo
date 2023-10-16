<?php

class CandidateExperience{
	private $id;
	private $position;
	private $enterprise;
	private $id_area;
	private $id_subarea;
	private $id_state;
	private $id_city;
	private $start_date;
	private $end_date;
	private $still_works;
	private $review;
	private $activity1;
	private $activity2;
	private $activity3;
	private $activity4;
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

	public function getPosition(){
		return $this->position;
	}

	public function setPosition($position){
		$this->position = $position;
	}

	public function getEnterprise(){
		return $this->enterprise;
	}

	public function setEnterprise($enterprise){
		$this->enterprise = $enterprise;
	}

	public function getId_area(){
		return $this->id_area;
	}

	public function setId_area($id_area){
		$this->id_area = $id_area;
	}

	public function getId_subarea(){
		return $this->id_subarea;
	}

	public function setId_subarea($id_subarea){
		$this->id_subarea = $id_subarea;
	}

	public function getId_state(){
		return $this->id_state;
	}

	public function setId_state($id_state){
		$this->id_state = $id_state;
	}

	public function getId_city(){
		return $this->id_city;
	}

	public function setId_city($id_city){
		$this->id_city = $id_city;
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

	public function getStill_works(){
		return $this->still_works;
	}

	public function setStill_works($still_works){
		$this->still_works = $still_works;
	}

	public function getReview(){
		return $this->review;
	}

	public function setReview($review){
		$this->review = $review;
	}

	public function getActivity1(){
		return $this->activity1;
	}

	public function setActivity1($activity1){
		$this->activity1 = $activity1;
	}

	public function getActivity2(){
		return $this->activity2;
	}

	public function setActivity2($activity2){
		$this->activity2 = $activity2;
	}

	public function getActivity3(){
		return $this->activity3;
	}

	public function setActivity3($activity3){
		$this->activity3 = $activity3;
	}

	public function getActivity4(){
		return $this->activity4;
	}

	public function setActivity4($activity4){
		$this->activity4 = $activity4;
	}

	public function getId_candidate(){
		return $this->id_candidate;
	}

	public function setId_candidate($id_candidate){
		$this->id_candidate = $id_candidate;
	}

	public function getExperiencesByCandidate(){
		$candidate = $this->getId_candidate();
        $stmt = $this->db->prepare("SELECT *, ce.id AS id_experience FROM candidate_experience ce INNER JOIN states s ON ce.id_state=s.id INNER JOIN cities ct ON ce.id_city=ct.id WHERE id_candidate=:id_candidate ORDER BY ce.still_works DESC, ce.end_date DESC, ce.start_date DESC");
        $stmt->bindParam(":id_candidate", $candidate, PDO::PARAM_STR);
        $stmt->execute();
        $experiences = $stmt->fetchAll();
        return $experiences;
	}

	public function save(){
		$result = false;

        $id_candidate = $this->getId_candidate();
        $position = $this->getPosition();
        $enterprise = $this->getEnterprise();
        $id_area = $this->getId_area();
        $id_subarea = $this->getId_subarea();
        $id_state = $this->getId_state();
        $id_city = $this->getId_city();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $still_works = $this->getStill_works();
        $review = $this->getReview();
        $activity1 = $this->getActivity1();
        $activity2 = $this->getActivity2();
        $activity3 = $this->getActivity3();
        $activity4 = $this->getActivity4();

        $stmt = $this->db->prepare("INSERT INTO candidate_experience(id_candidate, position, enterprise, id_area, id_subarea, id_state, id_city, start_date, end_date, still_works, review, activity1, activity2, activity3, activity4) VALUES (:id_candidate, :position, :enterprise, :id_area, :id_subarea, :id_state, :id_city, :start_date, :end_date, :still_works, :review, :activity1, :activity2, :activity3, :activity4)");
        $stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
        $stmt->bindParam(":position", $position, PDO::PARAM_STR);
        $stmt->bindParam(":enterprise", $enterprise, PDO::PARAM_STR);
        $stmt->bindParam(":id_area", $id_area, PDO::PARAM_INT);
        $stmt->bindParam(":id_subarea", $id_subarea, PDO::PARAM_INT);
        $stmt->bindParam(":id_state", $id_state, PDO::PARAM_INT);
        $stmt->bindParam(":id_city", $id_city, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":still_works", $still_works, PDO::PARAM_INT);
        $stmt->bindParam(":review", $review, PDO::PARAM_STR);
        $stmt->bindParam(":activity1", $activity1, PDO::PARAM_STR);
        $stmt->bindParam(":activity2", $activity2, PDO::PARAM_STR);
        $stmt->bindParam(":activity3", $activity3, PDO::PARAM_STR);
        $stmt->bindParam(":activity4", $activity4, PDO::PARAM_STR);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function update(){
		$result = false;

        $id = $this->getId();
        $position = $this->getPosition();
        $enterprise = $this->getEnterprise();
        $id_area = $this->getId_area();
        $id_subarea = $this->getId_subarea();
        $id_state = $this->getId_state();
        $id_city = $this->getId_city();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $still_works = $this->getStill_works();
        $review = $this->getReview();
        $activity1 = $this->getActivity1();
        $activity2 = $this->getActivity2();
        $activity3 = $this->getActivity3();
        $activity4 = $this->getActivity4();

        $stmt = $this->db->prepare("UPDATE candidate_experience SET position=:position, enterprise=:enterprise, id_area=:id_area, id_subarea=:id_subarea, id_state=:id_state, id_city=:id_city, start_date=:start_date, end_date=:end_date, still_works=:still_works, review=:review, activity1=:activity1, activity2=:activity2, activity3=:activity3, activity4=:activity4 WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":position", $position, PDO::PARAM_STR);
        $stmt->bindParam(":enterprise", $enterprise, PDO::PARAM_STR);
        $stmt->bindParam(":id_area", $id_area, PDO::PARAM_INT);
        $stmt->bindParam(":id_subarea", $id_subarea, PDO::PARAM_INT);
        $stmt->bindParam(":id_state", $id_state, PDO::PARAM_INT);
        $stmt->bindParam(":id_city", $id_city, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":still_works", $still_works, PDO::PARAM_INT);
        $stmt->bindParam(":review", $review, PDO::PARAM_STR);
        $stmt->bindParam(":activity1", $activity1, PDO::PARAM_STR);
        $stmt->bindParam(":activity2", $activity2, PDO::PARAM_STR);
        $stmt->bindParam(":activity3", $activity3, PDO::PARAM_STR);
        $stmt->bindParam(":activity4", $activity4, PDO::PARAM_STR);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function getOne(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT ce.*, c.first_name, c.surname, c.last_name FROM candidate_experience ce INNER JOIN candidates c ON ce.id_candidate=c.id WHERE ce.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	// ===[GABO 26 ABRIL VER CANDIDATO]===
	public function delete(){
        $id = $this->getId();
        $stmt = $this->db->prepare("DELETE TOP (1) FROM candidate_experience WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag=$stmt->execute();
		if ($flag) {
            $result = true;
        }
        return $result;
    }
	 // ===[FIN]===


	 	 
	//    ===[gabo 21 mayo operativa]===
	public function delete_experiences(){
        $id_candidate = $this->getId_candidate();
        $stmt = $this->db->prepare("DELETE  FROM candidate_experience WHERE id_candidate=:id_candidate");
        $stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
        $flag=$stmt->execute();
		if ($flag) {
            $result = true;
        }
        return $result;
    }
}