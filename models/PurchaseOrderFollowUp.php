<?php

class PurchaseOrderFollowUp{
	private $id;
	private $contact_date;
	private $comments;
	private $next_follow_up_date;
	private $created_by;
	private $created_at;
	private $modified_at;
	private $id_purchase_order;

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

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getNext_follow_up_date(){
		return $this->next_follow_up_date;
	}

	public function setNext_follow_up_date($next_follow_up_date){
		$this->next_follow_up_date = $next_follow_up_date;
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

	public function getId_purchase_order(){
		return $this->id_purchase_order;
	}

	public function setId_purchase_order($id_purchase_order){
		$this->id_purchase_order = $id_purchase_order;
	}

	public function save() {
		$result = false;

		$id_purchase_order = $this->getId_purchase_order();
		$next_follow_up_date = $this->getNext_follow_up_date();
		$comments = $this->getComments();
		$id_user = $this->getCreated_by();

        $stmt = $this->db->prepare("INSERT INTO purchase_order_follow_ups(contact_date, comments, next_follow_up_date, created_by, created_at, modified_at, id_purchase_order) VALUES(GETDATE(), :comments, :next_follow_up_date, :id_user, GETDATE(), GETDATE(), :id_purchase_order)");
		$stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
		$stmt->bindParam(":next_follow_up_date", $next_follow_up_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
		$stmt->bindParam(":id_purchase_order", $id_purchase_order, PDO::PARAM_INT);
           
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
	}
}