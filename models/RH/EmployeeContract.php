<?php

class EmployeeContract
{
	private $id_employee;
	private $created_at;
	private $contract_start;
	private $contract_end;
	private $type;
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

	public function getContract_start()
	{
		return $this->contract_start;
	}

	public function setContract_start($contract_start)
	{
		$this->contract_start = $contract_start;
	}

	public function getContract_end()
	{
		return $this->contract_end;
	}

	public function setContract_end($contract_end)
	{
		$this->contract_end = $contract_end;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setType($type)
	{
		$this->type = $type;
	}




	public function save()
	{
		$result = false;

		$id_employee = $this->getId_employee();
		$contract_start = $this->getContract_start();
		$contract_end = $this->getContract_end();
		$type = $this->getType();

		$stmt = $this->db->prepare("INSERT INTO root.employee_contract (id_employee,created_at,contract_start,contract_end,type) VALUES (:id_employee,GETDATE(),:contract_start,:contract_end,:type)");

		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":contract_start", $contract_start, PDO::PARAM_STR);
		$stmt->bindParam(":contract_end", $contract_end, PDO::PARAM_STR);
		$stmt->bindParam(":type", $type, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}

	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM root.employee_contract WHERE id=:id ");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}
	public function getOneByIdEmployeeAndType()
	{
		$id_employee = $this->getId_employee();
		$type = $this->getType();
		
		$stmt = $this->db->prepare("SELECT * FROM root.employee_contract WHERE id_employee=:id_employee AND type=:type ORDER BY contract_start DESC	");
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":type", $type, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}
	

	public function getOneByIdEmployee()
	{
		$id_employee = $this->getId_employee();
		$stmt = $this->db->prepare("SELECT * FROM root.employee_contract WHERE id_employee=:id_employee ORDER BY contract_start DESC");
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}
	
	public function getAllByIdEmployee()
	{
		$id_employee = $this->getId_employee();
		$stmt = $this->db->prepare("SELECT * FROM root.employee_contract WHERE id_employee=:id_employee ORDER BY contract_start DESC");
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}

	public function delete()
	{
		$id= $this->getId();
		$stmt = $this->db->prepare("DELETE root.employee_contract WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$fetch=$stmt->execute();
		return $fetch;
	}




}
