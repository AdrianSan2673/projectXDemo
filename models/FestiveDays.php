<?php

class Festive
{
	private $Ndays;
	private $db;

	public function __construct()
    {
        $this->db = Connection::connect();
    }

	public function getNdays(){
		return $this->Ndays;
	}

	public function setNdays($Ndays){
		$this->Ndays = $Ndays;
	}
	public function save(){
		$result = false;

		$Ndays = $this->getNdays();

		$stmt = $this->db->prepare("INSERT INTO non_working_days(Date) VALUES (:Date)");

		$stmt->bindParam(":Date", $Ndays, PDO::PARAM_STR);
	
		$flag = $stmt->execute();
		return $flag;
	}


	
	}

