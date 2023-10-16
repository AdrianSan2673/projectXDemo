<?php

class SentEmail {
    private $id;
    private $message;
    private $email;
    private $type;
    private $id_user;
    private $created_at;

    private $db;

    public function __construct()
    {
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

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getId_user(){
		return $this->id_user;
	}

	public function setId_user($id_user){
		$this->id_user = $id_user;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

    public function create() {
		$result = false;

        $message = $this->getMessage();
		$email = $this->getEmail();
		$type = $this->getType();
		$id_user = $this->getId_user();
        $stmt = $this->db->prepare("INSERT INTO sent_emails (message, email, type, id_user, created_at) VALUES(:message, :email, :type, :id_user, GETDATE())");
		$stmt->bindParam(":message", $message, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":type", $type, PDO::PARAM_INT);
		$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        
        return $result;

    }
	
	public function getCandidatesForDataUpdate(){

        $stmt = $this->db->prepare("SELECT TOP (1) * FROM candidates c INNER JOIN users u ON c.id_user=u.id WHERE DATEDIFF(MONTH, c.modified_at, GETDATE()) >= 3 AND c.id_user NOT IN (SELECT id_user FROM sent_emails WHERE DATEDIFF(MONTH, created_at, GETDATE()) <= 3 AND type=1) ORDER BY c.modified_at DESC");
        $stmt->execute();
        $candidates = $stmt->fetchAll();
        return $candidates;
	}

}