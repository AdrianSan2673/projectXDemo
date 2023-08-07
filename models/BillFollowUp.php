<?php

class BillFollowUp{
	private $id;
	private $contact_date;
	private $who_contacted;
	private $comments;
	private $payment_promise_date;
	private $created_by;
	private $created_at;
	private $modified_at;
	private $id_bill;

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

	public function getContact_date(){
		return $this->contact_date;
	}

	public function setContact_date($contact_date){
		$this->contact_date = $contact_date;
	}

	public function getWho_contacted(){
		return $this->who_contacted;
	}

	public function setWho_contacted($who_contacted){
		$this->who_contacted = $who_contacted;
	}

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getPayment_promise_date(){
		return $this->payment_promise_date;
	}

	public function setPayment_promise_date($payment_promise_date){
		$this->payment_promise_date = $payment_promise_date;
	}

	public function getCreated_by(){
		return $this->created_by;
	}

	public function setCreated_by($created_by){
		$this->created_by = $created_by;
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

	public function getId_bill(){
		return $this->id_bill;
	}

	public function setId_bill($id_bill){
		$this->id_bill = $id_bill;
	}

	public function save() {
		$result = false;

		$id_bill = $this->getId_bill();
		$who_contacted = $this->getWho_contacted();
		$payment_promise_date = $this->getPayment_promise_date();
		$comments = $this->getComments();
		$id_user = $this->getCreated_by();

        $stmt = $this->db->prepare("INSERT INTO bill_follow_ups(contact_date, who_contacted, comments, payment_promise_date, created_by, created_at, modified_at, id_bill) VALUES(GETDATE(), :who_contacted, :comments, :payment_promise_date, :id_user, GETDATE(), GETDATE(), :id_bill)");
		$stmt->bindParam(":who_contacted", $who_contacted, PDO::PARAM_STR);
		$stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
		$stmt->bindParam(":payment_promise_date", $payment_promise_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
		$stmt->bindParam(":id_bill", $id_bill, PDO::PARAM_INT);
           
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
	}
}