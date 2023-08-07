<?php

class CustomerEvaluation{
    private $id;
    private $response_time;
    private $reception_time;
    private $communication_with_executive;
    private $executive_friendliness;
    private $quality_of_candidates;
    private $comments;
    private $id_customer;
    private $created_at;
    private $modified_at;
    private $created_by;

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

	public function getResponse_time(){
		return $this->response_time;
	}

	public function setResponse_time($response_time){
		$this->response_time = $response_time;
	}

	public function getReception_time(){
		return $this->reception_time;
	}

	public function setReception_time($reception_time){
		$this->reception_time = $reception_time;
	}

	public function getCommunication_with_executive(){
		return $this->communication_with_executive;
	}

	public function setCommunication_with_executive($communication_with_executive){
		$this->communication_with_executive = $communication_with_executive;
	}

	public function getExecutive_friendliness(){
		return $this->executive_friendliness;
	}

	public function setExecutive_friendliness($executive_friendliness){
		$this->executive_friendliness = $executive_friendliness;
	}

	public function getQuality_of_candidates(){
		return $this->quality_of_candidates;
	}

	public function setQuality_of_candidates($quality_of_candidates){
		$this->quality_of_candidates = $quality_of_candidates;
	}

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getId_customer(){
		return $this->id_customer;
	}

	public function setId_customer($id_customer){
		$this->id_customer = $id_customer;
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

	public function getCreated_by(){
		return $this->created_by;
	}

	public function setCreated_by($created_by){
		$this->created_by = $created_by;
    }
    
    public function getEvaluationsByCustomer(){
        $customer = $this->getId_customer();
        $stmt = $this->db->prepare("SELECT *, ROUND((CAST((ce.reception_time + ce.communication_with_executive + ce.executive_friendliness + ce.quality_of_candidates)AS float) /4), 2) AS score FROM customer_evaluations ce WHERE id_customer=:id_customer ORDER BY created_at DESC");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $evaluations_names = $stmt->fetchAll();
        return $evaluations_names;
    }


    public function create(){
        $result = false;

        $id_customer = $this->getId_customer();
        $response_time = $this->getResponse_time();
        $reception_time = $this->getReception_time();
        $communication_with_executive = $this->getCommunication_with_executive();
        $executive_friendliness = $this->getExecutive_friendliness();
        $quality_of_candidates = $this->getQuality_of_candidates();
        $comments = $this->getComments();
        $created_by = $this->getCreated_by();

        $stmt = $this->db->prepare("INSERT INTO customer_evaluations(id_customer, response_time, reception_time, communication_with_executive, quality_of_candidates, executive_friendliness, comments, created_at, modified_at, created_by) VALUES (:id_customer, :response_time, :reception_time, :communication_with_executive, :quality_of_candidates, :executive_friendliness, :comments, GETDATE(), GETDATE(), :created_by)");
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
        $stmt->bindParam(":response_time", $response_time, PDO::PARAM_INT);
        $stmt->bindParam(":reception_time", $reception_time, PDO::PARAM_INT);
        $stmt->bindParam(":communication_with_executive", $communication_with_executive, PDO::PARAM_INT);
        $stmt->bindParam(":executive_friendliness", $executive_friendliness, PDO::PARAM_INT);
        $stmt->bindParam(":quality_of_candidates", $quality_of_candidates, PDO::PARAM_INT);
        $stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
}