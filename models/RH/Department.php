<?php


class Department
{
	private $id;
	private $department;
	private $Empresa;
	private $ID_Contacto;
	private $created_at;
	private $modified_at;
	private $status;
	
	private $ID_Cliente;

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

	public function getDepartment()
	{
		return $this->department;
	}

	public function setDepartment($department)
	{
		$this->department = $department;
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

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	//===[gabo 5 de junio departamento]===
	public function getID_Cliente()
	{
		return $this->ID_Cliente;
	}

	public function setID_Cliente($ID_Cliente)
	{
		$this->ID_Cliente = $ID_Cliente;
	}
	//===[gabo 5 de junio departamento fin]===

	public function getOne()
	{

		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM root.department WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}

	public function getDepartmentsByEmpresa()
	{
		$Empresa = $this->getEmpresa();
		$stmt = $this->db->prepare("SELECT *, (SELECT COUNT(e.id) FROM root.positions p INNER JOIN root.employees e ON p.id=e.id_position WHERE p.id_department=d.id AND e.status=1) no_employees,(SELECT COUNT(p.id)  FROM root.positions p WHERE p.id_department=d.id AND p.status=1) no_positions  FROM root.department d WHERE Empresa=:Empresa AND d.status=1 ORDER BY department");
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}
	public function getDepartmentsByCliente()
	{
		$ID_Cliente = $this->getID_Cliente();

		$stmt = $this->db->prepare("SELECT *, (SELECT COUNT(e.id) FROM root.positions p INNER JOIN root.employees e ON p.id=e.id_position WHERE p.id_department=d.id AND e.status=1) no_employees,(SELECT COUNT(p.id)  FROM root.positions p WHERE p.id_department=d.id AND p.status=1) no_positions  FROM root.department d WHERE ID_Cliente=:ID_Cliente AND d.status=1 ORDER BY department");
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}


	public function countEmployeesAndPositionByIdDepartment()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT *, (SELECT COUNT(e.id) FROM root.positions p INNER JOIN root.employees e ON p.id=e.id_position WHERE p.id_department=d.id ) no_employees,(SELECT COUNT(p.id) FROM root.positions p WHERE p.id_department=d.id) no_positions  FROM root.department d WHERE d.id=:id and d.status=1");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}

	//===[gabo 5 de junio departamento]===

	public function save()
	{
		$result = false;

		$department = $this->getDepartment();
		$Empresa = $this->getEmpresa();
		$ID_Contacto = $this->getID_Contacto();
		$ID_Cliente = $this->getID_Cliente();

		$stmt = $this->db->prepare("INSERT INTO root.department (department, Empresa, ID_Contacto, created_at, modified_at,ID_Cliente) VALUES (:department, :Empresa, :ID_Contacto, GETDATE(), GETDATE(),:ID_Cliente)");

		$stmt->bindParam(":department", $department, PDO::PARAM_STR);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}

	//===[gabo 5 de junio departamento fin]===


	public function update()
	{
		$result = false;

		$id = $this->getId();
		$department = $this->getDepartment();
		$Empresa = $this->getEmpresa();
		$ID_Contacto = $this->getID_Contacto();

		$stmt = $this->db->prepare("UPDATE root.department 
									SET 
									department=:department,
									Empresa=:Empresa,
									ID_Contacto=:ID_Contacto,
									modified_at=GETDATE()
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":department", $department, PDO::PARAM_STR);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function updateDepartament()
	{
		$result = false;

		$id = $this->getId();
		$department = $this->getDepartment();

		$stmt = $this->db->prepare("UPDATE root.department 
									SET department=:department,modified_at=GETDATE()
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":department", $department, PDO::PARAM_STR);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function delete()
	{
		$id = $this->getId();
		//$stmt = $this->db->prepare("DELETE root.department WHERE id=:id");
		$stmt = $this->db->prepare("UPDATE root.department SET status=0 WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt;
	}

	// ===[gabo 5 junio  departamento]===

	public function getDepartmentsByClientes($ids_clientes)
	{
		$stmt = $this->db->prepare("SELECT d.department,d.id,d.ID_Contacto,(SELECT COUNT(e.id) FROM root.positions p INNER JOIN root.employees e ON p.id=e.id_position WHERE p.id_department=d.id AND e.status=1) no_employees,(SELECT COUNT(p.id)  FROM root.positions p WHERE p.id_department=d.id AND p.status=1) no_positions  from root.department d WHERE d.status=1 and " . $ids_clientes . "  GROUP BY d.department, d.id,d.ID_Contacto ORDER BY d.department");
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}



	// ===[gabo 5 junio  departamento fin]===
}
