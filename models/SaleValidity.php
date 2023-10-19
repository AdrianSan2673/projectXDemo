<?php

class SaleValidity {
    private $id;
    private $id_sale;
    private $time;

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

	public function getId_sale(){
		return $this->id_sale;
	}

	public function setId_sale($id_sale){
		$this->id_sale = $id_sale;
	}

	public function getTime(){
		return $this->time;
	}

	public function setTime($time){
		$this->time = $time;
	}

    public function create() {
		$result = false;

        $id_sale = $this->getId_sale();
        $time = $this->getTime();
        $stmt = $this->db->prepare("INSERT INTO sales_validity (id_sale, time, created_at, modified_at) VALUES(:id_sale, :time, GETDATE(), GETDATE())");
		$stmt->bindParam(":id_sale", $id_sale, PDO::PARAM_STR);
        $stmt->bindParam(":time", $time, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        
        return $result;
    }
}