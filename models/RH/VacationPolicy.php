<?php

class VacationPolicy
{
	private $id;
	private $name;
	private $Cliente;
	private $Empresa;
	private $ID_Contacto;
	private $status;
	private $created_at;
	private $modified_at;
	//17 oct
	private $years;

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

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getCliente()
	{
		return $this->Cliente;
	}

	public function setCliente($Cliente)
	{
		$this->Cliente = $Cliente;
	}

	public function getEmpresa()
	{
		return $this->Empresa;
	}

	public function setEmpresa($Empresa)
	{
		$this->Empresa = $Empresa;
	}

	public function getID_Contacto()
	{
		return $this->ID_Contacto;
	}

	public function setID_Contacto($ID_Contacto)
	{
		$this->ID_Contacto = $ID_Contacto;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status = $status;
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

	//17 oct
	public function getYears()
	{
		return $this->years;
	}

	public function setYears($years)
	{
		$this->years = $years;
	}







	public function getOne()
	{
		$id = $this->getId();

		$stmt = $this->db->prepare("SELECT * FROM root.vacation_policy WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchObject();
		return $fetch;
	}

	public function getPoliciesByEmpresa()
	{
		$Empresa = $this->getEmpresa();
		$stmt = $this->db->prepare("SELECT * FROM root.vacation_policy WHERE Empresa=:Empresa");
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function save()
	{
		$name = $this->getName();
		$Cliente = $this->getCliente();
		$Empresa = $this->getEmpresa();
		$ID_Contacto = $this->getID_Contacto();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("INSERT INTO root.vacation_policy (name, Cliente, Empresa, ID_Contacto, status, created_at, modified_at) VALUES (:name, :Cliente, :Empresa, :ID_Contacto, :status, GETDATE(), GETDATE())");
		$stmt->bindParam(":name", $name, PDO::PARAM_STR);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
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
		$name = $this->getName();
		$Cliente = $this->getCliente();
		$Empresa = $this->getEmpresa();
		$ID_Contacto = $this->getID_Contacto();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("UPDATE root.vacation_policy SET name=:name, Cliente=:Cliente, Empresa=:Empresa, ID_Contacto=:ID_Contacto, status=:status, modified_at=GETDATE() WHERE id=:id");
		$stmt->bindParam(":name", $name, PDO::PARAM_STR);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag)
			$result = true;

		return $result;
	}


	//gabo 17 oct

	public function getPoliciesById_Cliente()
	{
		$cliente = $this->getCliente();
		$years = $this->getYears();
		$stmt = $this->db->prepare("SELECT holidays FROM root.vacation_policy vp INNER JOIN  root.holidays_by_years  hby on vp.id=hby.id_policy WHERE vp.Cliente=:cliente and hby.years=:years");
		$stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
		$stmt->bindParam(":years", $years, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchObject();
		return $fetch;
	}
}
