<?php

class EmployeeIncidence
{
	private $id;
	private $type;
	private $comments;
	private $id_employee;
	private $created_at;
	private $modified_at;
	private $amount;
	private $type_of_foul;
	private $hours;
	private $type_of_incapacity;
	private $permission;
	private $end_date;
	private $db;

	public function __construct()
	{
		$this->db = Connection::connectSA();
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getComments()
	{
		return $this->comments;
	}

	public function setComments($comments)
	{
		$this->comments = $comments;
	}

	public function getId_employee()
	{
		return $this->id_employee;
	}

	public function setId_employee($id_employee)
	{
		$this->id_employee = $id_employee;
	}

	public function getCreated_at()
	{
		return $this->created_at;
	}

	public function setCreated_at($created_at)
	{
		$this->created_at = $created_at;
	}

	public function getModified_at()
	{
		return $this->modified_at;
	}

	public function setModified_at($modified_at)
	{
		$this->modified_at = $modified_at;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function setAmount($amount)
	{
		$this->amount = $amount;
	}

	public function getType_of_foul()
	{
		return $this->type_of_foul;
	}

	public function setType_of_foul($type_of_foul)
	{
		$this->type_of_foul = $type_of_foul;
	}

	public function getHours()
	{
		return $this->hours;
	}

	public function setHours($hours)
	{
		$this->hours = $hours;
	}

	public function getType_of_incapacity(){
		return $this->type_of_incapacity;
	}

	public function setType_of_incapacity($type_of_incapacity){
		$this->type_of_incapacity = $type_of_incapacity;
	}

	public function getPermission(){
		return $this->permission;
	}

	public function setPermission($permission){
		$this->permission = $permission;
	}
	public function getEnd_date(){
		return $this->end_date;
	}

	public function setEnd_date($end_date){
		$this->end_date = $end_date;
	}



	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM root.employee_incidence WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}

	public function getOneById()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT ei.id id_incident,e.id id_employe, p.title, CONCAT(e.first_name,' ',e.last_name,' ',e.surname) as employeFullName, ei.type,ei.comments,ei.created_at,ei.end_date,ei.modified_at, CONCAT(e.first_name,' ',e.last_name,' ',e.surname,' - ',p.title) as employeDeparment
        FROM root.employees e, root.positions p, root.employee_incidence ei,root.department d
        WHERE p.id=e.id_position AND  p.id_department= d.id  AND e.status=1 AND e.id=ei.id_employee  AND ei.id=:id ");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}


	public function getAllByIdEmployee()
	{
		$id_employee = $this->getId_employee();
		$stmt = $this->db->prepare("SELECT * FROM root.employee_incidence WHERE id_employee=:id_employee ORDER BY created_at DESC" );
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function save()
	{
		$id_employee = $this->getId_employee();
		$type = $this->getType();
		$comments = $this->getComments();
		$amount = $this->getAmount();
		$type_of_foul = $this->getType_of_foul();
		$hours = $this->getHours();
		$type_of_incapacity=$this->getType_of_incapacity();
		$permission=$this->getPermission();
		$created_at=$this->getCreated_at();
		$end_date=$this->getEnd_date();

		$stmt = $this->db->prepare("INSERT INTO root.employee_incidence(type,comments,id_employee,created_at,modified_at,amount,hours,type_of_foul,type_of_incapacity,permission,end_date) 
		VALUES (:type,:comments,:id_employee,:created_at,GETDATE(),:amount,:hours,:type_of_foul,:type_of_incapacity,:permission,:end_date)");

		$stmt->bindParam(":type", $type, PDO::PARAM_STR);
		$stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":amount", $amount, PDO::PARAM_INT);
		$stmt->bindParam(":type_of_foul", $type_of_foul, PDO::PARAM_STR);
		$stmt->bindParam(":hours", $hours, PDO::PARAM_INT);
		$stmt->bindParam(":type_of_incapacity", $type_of_incapacity, PDO::PARAM_STR);
		$stmt->bindParam(":permission", $permission, PDO::PARAM_STR);
		$stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);

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
		$id_employee = $this->getId_employee();
		$type = $this->getType();
		$comments = $this->getComments();

		$stmt = $this->db->prepare("UPDATE root.employee_incidence 
		SET type=:type,comments=:comments,id_employee=:id_employee,modified_at=GETDATE() 
		WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":type", $type, PDO::PARAM_STR);
		$stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}

	public function delete()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("DELETE root.employee_incidence WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$fetch = $stmt->execute();
		return $fetch;
	}
}
