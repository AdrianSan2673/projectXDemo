<?php

class Notification {
    private $id;
    private $message;
    private $url;
    private $status;
    private $id_type;
    private $id_user;
    private $created_by;
    private $cliente;
    private $customer;
    private $created_at;

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

	public function getMessage(){
		return $this->message;
	}

	public function setMessage($message){
		$this->message = $message;
	}

    public function getUrl(){
		return $this->url;
	}

	public function setUrl($url){
		$this->url = $url;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

    public function getId_type(){
		return $this->id_type;
	}

	public function setId_type($id_type){
		$this->id_type = $id_type;
	}

	public function getId_user(){
		return $this->id_user;
	}

	public function setId_user($id_user){
		$this->id_user = $id_user;
	}

    public function getCreated_by(){
		return $this->created_by;
	}

	public function setCreated_by($created_by){
		$this->created_by = $created_by;
	}

	public function getCliente(){
		return $this->cliente;
	}

	public function setCliente($cliente){
		$this->cliente = $cliente;
	}

	public function getCustomer(){
		return $this->customer;
	}

	public function setCustomer($customer){
		$this->customer = $customer;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

    public function getNotificationsByIdUser(){
        $id_user = $this->getId_user();

        $stmt = $this->db->prepare("SELECT n.*, nt.description, nt.icon, dbo.time_ago(created_at) AS time_ago FROM notifications n INNER JOIN notification_types nt ON n.id_type=nt.id WHERE id_user=:id_user ORDER BY created_at DESC");
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $levels = $stmt->fetchAll();
        return $levels;
    }

    public function received() {
        $result = false;

        $id_user = $this->getId_user();

        $stmt = $this->db->prepare("UPDATE notifications SET status=2 WHERE id_user=:id_user AND status=1");
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function checked() {
        $result = false;

        $id_user = $this->getId_user();

        $stmt = $this->db->prepare("UPDATE notifications SET status=3 WHERE id_user=:id_user AND status <= 2");
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function clicked() {
        $result = false;

        $id = $this->getId();

        $stmt = $this->db->prepare("UPDATE notifications SET status=4 WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function create(){
		$result = false;

		$id_user = $this->getId_user();
        $message = $this->getMessage();
        $url = $this->getUrl();
        $status = $this->getStatus();
        $id_type = $this->getId_type();
        $created_by = $this->getCreated_by();
        $cliente = $this->getCliente();
        $customer = $this->getCustomer();
	
        $stmt = $this->db->prepare("INSERT INTO notifications (message, url, status, id_type, id_user, created_by, cliente, customer, created_at) VALUES (:message, :url, :status, :id_type, :id_user, :created_by, :cliente, :customer, GETDATE())");
		$stmt->bindParam(":message", $message, PDO::PARAM_STR);
        $stmt->bindParam(":url", $url, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":id_type", $id_type, PDO::PARAM_INT);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_INT);
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $stmt->bindParam(":customer", $customer, PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
			$this->setID($this->db->lastInsertId());
        }
        return $result;
    }

}