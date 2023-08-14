<?php 

class CivilStatus{
	private $id;
	private $status;

	private $db;

    public function __construct() {
        $this->db = Connection::connect();
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getAll(){
		$stmt = $this->db->prepare("SELECT * FROM civil_status;");
        $stmt->execute();
        $status = $stmt->fetchAll();
        return $status;
	}
	
		public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM civil_status where id=:id;");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$status = $stmt->fetchObject();
		return $status;
	}
}