<?php

class HolidaysByYears {
    private $id;
    private $years;
    private $holidays;
    private $id_policy;

    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getYears(){
		return $this->years;
	}

	public function setYears($years){
		$this->years = $years;
	}

	public function getHolidays(){
		return $this->holidays;
	}

	public function setHolidays($holidays){
		$this->holidays = $holidays;
	}

	public function getId_policy(){
		return $this->id_policy;
	}

	public function setId_policy($id_policy){
		$this->id_policy = $id_policy;
	}

	public function getOne() {
        $id = $this->getId();
        
        $stmt = $this->db->prepare("SELECT * FROM root.holidays_by_years WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getHolidaysByIdPolicy() {
        $id_policy = $this->getId_policy();
        $stmt = $this->db->prepare("SELECT * FROM root.holidays_by_years WHERE id_policy=:id_policy");
        $stmt->bindParam(":id_policy", $id_policy, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function save()
	{
		$years = $this->getYears();
		$holidays = $this->getHolidays();
        $id_policy = $this->getId_policy();

        $stmt = $this->db->prepare("INSERT INTO root.holidays_by_years (years, holidays, id_policy) VALUES (:years, :holidays, :id_policy)");
		$stmt->bindParam(":years", $years, PDO::PARAM_INT);
		$stmt->bindParam(":holidays", $holidays, PDO::PARAM_INT);
        $stmt->bindParam(":id_policy", $id_policy, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}

	public function update()
	{
		$id = $this->getId();
		$years = $this->getYears();
		$holidays = $this->getHolidays();
        $id_policy = $this->getId_policy();

		$stmt = $this->db->prepare("UPDATE root.holidays_by_years SET holidays=:holidays, modified_at=GETDATE() WHERE id_policy=:id_policy AND years=:years");
		$stmt->bindParam(":years", $years, PDO::PARAM_INT);
		$stmt->bindParam(":holidays", $holidays, PDO::PARAM_INT);
        $stmt->bindParam(":id_policy", $id_policy, PDO::PARAM_INT);
        
		$flag = $stmt->execute();

		if ($flag)
			$result = true;

		return $result;
	}  
}