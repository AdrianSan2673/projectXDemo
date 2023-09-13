<?php

class Positions
{

	private $id;
	private $title;
	private $objective;
	private $authority;
	private $scholarship;
	private $experience;
	private $additional_studies;
	private $experience_years;
	private $language;
	private $id_boss_position;
	private $id_reviewed_by;
	private $id_approved_by;
	private $id_created_by;
	private $id_department;
	private $Empresa;
	private $ID_Contacto;
	private $created_at;
	private $modified_at;
	private $status;
	private $clave_ocupacion;
	private $type_position;
	//===[gabo 7 junio puestos]===
	private $ID_Cliente;
	//===[gabo 7 junio puestos fin]===
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

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getObjective()
	{
		return $this->objective;
	}

	public function setObjective($objective)
	{
		$this->objective = $objective;
	}

	public function getAuthority()
	{
		return $this->authority;
	}

	public function setAuthority($authority)
	{
		$this->authority = $authority;
	}

	public function getScholarship()
	{
		return $this->scholarship;
	}

	public function setScholarship($scholarship)
	{
		$this->scholarship = $scholarship;
	}

	public function getExperience()
	{
		return $this->experience;
	}

	public function setExperience($experience)
	{
		$this->experience = $experience;
	}

	public function getAdditional_studies()
	{
		return $this->additional_studies;
	}

	public function setAdditional_studies($additional_studies)
	{
		$this->additional_studies = $additional_studies;
	}

	public function getExperience_years()
	{
		return $this->experience_years;
	}

	public function setExperience_years($experience_years)
	{
		$this->experience_years = $experience_years;
	}

	public function getLanguage()
	{
		return $this->language;
	}

	public function setLanguage($language)
	{
		$this->language = $language;
	}

	public function getId_boss_position()
	{
		return $this->id_boss_position;
	}

	public function setId_boss_position($id_boss_position)
	{
		$this->id_boss_position = $id_boss_position;
	}

	public function getId_reviewed_by()
	{
		return $this->id_reviewed_by;
	}

	public function setId_reviewed_by($id_reviewed_by)
	{
		$this->id_reviewed_by = $id_reviewed_by;
	}

	public function getId_approved_by()
	{
		return $this->id_approved_by;
	}

	public function setId_approved_by($id_approved_by)
	{
		$this->id_approved_by = $id_approved_by;
	}

	public function getId_created_by()
	{
		return $this->id_created_by;
	}

	public function setId_created_by($id_created_by)
	{
		$this->id_created_by = $id_created_by;
	}

	public function getId_department()
	{
		return $this->id_department;
	}

	public function setId_department($id_department)
	{
		$this->id_department = $id_department;
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

	public function getClave_ocupacion()
	{
		return $this->clave_ocupacion;
	}

	public function setClave_ocupacion($clave_ocupacion)
	{
		$this->clave_ocupacion = $clave_ocupacion;
	}
	public function getType_position()
	{
		return $this->type_position;
	}

	public function setType_position($type_position)
	{
		$this->type_position = $type_position;
	}
	//===[gabo 7 junio puestos]===
	public function getID_Cliente()
	{
		return $this->ID_Cliente;
	}

	public function setID_Cliente($ID_Cliente)
	{
		$this->ID_Cliente = $ID_Cliente;
	}

	//===[gabo 7 junio puestos fin]===
	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT p.status,p.id id_position, p.title,p.objective,p.authority,p.scholarship,p.experience,p.additional_studies,p.experience_years,p.language,CONVERT(DATE,p.created_at,103) created_at,d.department,p.id_department,p.id_boss_position,p.id_reviewed_by,p.id_approved_by,p.modified_at,p.clave_ocupacion,p.type_position,p.ID_Cliente
		FROM root.positions p, root.department d WHERE p.id=:id AND p.id_department=d.id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}

	public function getOneAll()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT p.title,p.objective,p.authority,p.scholarship,p.experience,p.additional_studies,p.experience_years,p.language,CONVERT(DATE,p.created_at,103) created_at,d.department,p.id_department,p.id_boss_position,p.id_reviewed_by,p.id_approved_by,p.modified_at
		FROM root.positions p, root.department d WHERE p.id=:id AND p.id_department=d.id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("SELECT * FROM positions");
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getPositionsByContacto()
	{
		$ID_Contacto = $this->getID_Contacto();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("SELECT p.id,va.Nombre_Empresa, p.title,p.objective,p.authority,p.scholarship,p.experience,p.additional_studies,p.experience_years,p.language,CONVERT(DATE,p.created_at,103) created_at,d.department,p.id_department,p.id_boss_position,p.id_reviewed_by,p.id_approved_by,p.modified_at
		FROM root.positions p, root.department d, rh_Ventas_Empresas va WHERE p.Empresa=va.Empresa AND p.status=:status AND p.id_department=d.id AND p.Empresa IN (SELECT Empresa FROM rh_Ventas_Alta_Contactos WHERE ID=:ID_Contacto) ORDER BY p.title");
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getPositionEmployeeByIdDepartment()
	{
		$id_department = $this->getId_department();
		$stmt = $this->db->prepare("SELECT *,e.id id_employe, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 date_birth  FROM root.positions p, root.employees e WHERE e.status=1 AND  p.id=e.id_position AND p.id_department=:id_department");
		$stmt->bindParam(":id_department", $id_department, PDO::PARAM_STR);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getPositionByIdeDeparment()
	{
		$id_department = $this->getId_department();
		$stmt = $this->db->prepare("SELECT p.id,p.title, p.objective, p.modified_at, p.created_at FROM root.positions p WHERE  p.id_department=:id_department and p.status=1");
		$stmt->bindParam(":id_department", $id_department, PDO::PARAM_STR);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getAllPositionByTypePosition()
	{
		$status = $this->getStatus();
		//$type_position = $this->getType_position();
		$ID_Contacto = $this->getID_Contacto();

		$stmt = $this->db->prepare("SELECT  CONCAT(e.first_name,' ',e.surname,' ',e.last_name,' - ', p.title) employePosition,e.id id_employee,* FROM root.positions p, root.employees e  WHERE  e.id_position=p.id AND p.status=:status AND e.status=1 AND e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) ORDER BY p.type_position,p.title,e.first_name");

		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		//$stmt->bindParam(":type_position", $type_position, PDO::PARAM_STR);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_STR);

		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	//===[gabo 7 junio puestos evaluaciones]===
	public function save()
	{
		$result = false;
		$title = $this->getTitle();
		$objective = $this->getObjective();
		$authority = $this->getAuthority();
		$scholarship = $this->getScholarship();
		$experience = $this->getExperience();
		$additional_studies = $this->getAdditional_studies();
		$experience_years = $this->getExperience_years();
		$language = $this->getLanguage();
		$id_boss_position = $this->getId_boss_position();
		$id_reviewed_by = $this->getId_reviewed_by();
		$id_approved_by = $this->getId_approved_by();
		$id_created_by = $this->getId_created_by();
		$id_department = $this->getId_department();
		$Empresa = $this->getEmpresa();
		$ID_Contacto = $this->getID_Contacto();
		$clave_ocupacion = $this->getClave_ocupacion();
		$type_position = $this->getType_position();
		//===[gabo 6 puestos evaluaciones]===
		$id_cliente = $this->getID_Cliente();
		//===[gabo 6 puestos evaluaciones fin]===

		/* $created_at = $this->getCreated_at();
	$modified_at = $this->getModified_at(); */

		$stmt = $this->db->prepare("INSERT INTO root.positions (title,objective,authority,scholarship,experience,additional_studies,experience_years,language,id_boss_position,id_reviewed_by,id_approved_by,id_created_by,id_department, Empresa, ID_Contacto, created_at,modified_at,clave_ocupacion,type_position,ID_Cliente) 
	VALUES (:title,:objective,:authority,:scholarship,:experience,:additional_studies,:experience_years,:language,:id_boss_position,:id_reviewed_by,:id_approved_by,:id_created_by,:id_department, :Empresa, :ID_Contacto, GETDATE(),GETDATE(),:clave_ocupacion,:type_position,:id_cliente)");

		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":objective", $objective, PDO::PARAM_STR);
		$stmt->bindParam(":authority", $authority, PDO::PARAM_STR);
		$stmt->bindParam(":scholarship", $scholarship, PDO::PARAM_STR);
		$stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
		$stmt->bindParam(":additional_studies", $additional_studies, PDO::PARAM_STR);
		$stmt->bindParam(":experience_years", $experience_years, PDO::PARAM_STR);
		$stmt->bindParam(":language", $language, PDO::PARAM_STR);
		$stmt->bindParam(":id_boss_position", $id_boss_position, PDO::PARAM_INT);
		$stmt->bindParam(":id_reviewed_by", $id_reviewed_by, PDO::PARAM_INT);
		$stmt->bindParam(":id_approved_by", $id_approved_by, PDO::PARAM_INT);
		$stmt->bindParam(":id_created_by", $id_created_by, PDO::PARAM_INT);
		$stmt->bindParam(":id_department", $id_department, PDO::PARAM_INT);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":clave_ocupacion", $clave_ocupacion, PDO::PARAM_INT);
		$stmt->bindParam(":type_position", $type_position, PDO::PARAM_INT);

		$stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);


		/* $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);
	$stmt->bindParam(":modified_at", $modified_at, PDO::PARAM_STR); */
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}
	//===[gabo 9 junio excel evaluaciones]===
	public function save2() //No sabia que nombre ponerle
	{
		$result = false;
		$title = $this->getTitle();
		$id_created_by = $this->getId_created_by();
		$id_department = $this->getId_department();
		$Empresa = $this->getEmpresa();
		$ID_Contacto = $this->getID_Contacto();
		$ID_Cliente = $this->getID_Cliente();

		$stmt = $this->db->prepare("INSERT INTO	root.positions (title, id_department, id_created_by,Empresa,ID_Contacto,created_at,modified_at,ID_Cliente) 
		VALUES (:title,:id_department,:id_created_by,:Empresa,:ID_Contacto,GETDATE(),GETDATE(),:ID_Cliente)");

		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":id_created_by", $id_created_by, PDO::PARAM_INT);
		$stmt->bindParam(":id_department", $id_department, PDO::PARAM_INT);
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
	//===[gabo 9 junio excel evaluaciones fin]===

	public function update()
	{
		$result = false;

		$id = $this->getId();
		$title = $this->getTitle();
		$objective = $this->getObjective();
		$authority = $this->getAuthority();
		$scholarship = $this->getScholarship();
		$experience = $this->getExperience();
		$additional_studies = $this->getAdditional_studies();
		$experience_years = $this->getExperience();
		$language = $this->getLanguage();
		$id_boss_position = $this->getId_boss_position();
		$id_reviewed_by = $this->getId_reviewed_by();
		$id_approved_by = $this->getId_approved_by();
		$id_created_by = $this->getId_created_by();
		$id_department = $this->getId_department();
		$Empresa = $this->getEmpresa();
		$ID_Contacto = $this->getID_Contacto();
		$clave_ocupacion = $this->getClave_ocupacion();

		$stmt = $this->db->prepare("UPDATE root.positions 
									SET title=:title,objective=:objective,authority=:authority,scholarship=:scholarship,experience=:experience,additional_studies=:additional_studies,experience_years=:experience_years,language=:language,id_boss_position=:id_boss_position,id_reviewed_by=:id_reviewed_by,id_approved_by=:id_approved_by,id_created_by=:id_created_by,id_department=:id_department,Empresa=:Empresa,ID_Contacto=:ID_Contacto, modified_at=GETDATE(),clave_ocupacion=:clave_ocupacion
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":objective", $objective, PDO::PARAM_STR);
		$stmt->bindParam(":authority", $authority, PDO::PARAM_STR);
		$stmt->bindParam(":scholarship", $scholarship, PDO::PARAM_STR);
		$stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
		$stmt->bindParam(":additional_studies", $additional_studies, PDO::PARAM_STR);
		$stmt->bindParam(":experience_years", $experience_years, PDO::PARAM_STR);
		$stmt->bindParam(":language", $language, PDO::PARAM_STR);
		$stmt->bindParam(":id_boss_position", $id_boss_position, PDO::PARAM_STR);
		$stmt->bindParam(":id_reviewed_by", $id_reviewed_by, PDO::PARAM_STR);
		$stmt->bindParam(":id_approved_by", $id_approved_by, PDO::PARAM_STR);
		$stmt->bindParam(":id_created_by", $id_created_by, PDO::PARAM_STR);
		$stmt->bindParam(":id_department", $id_department, PDO::PARAM_STR);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":clave_ocupacion", $clave_ocupacion, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function updateObjective()
	{
		$result = false;
		$id = $this->getId();
		$objective = $this->getObjective();
		$stmt = $this->db->prepare("UPDATE root.positions 
									SET objective=:objective, modified_at=GETDATE()
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":objective", $objective, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function updateAuthority()
	{
		$result = false;
		$id = $this->getId();
		$scholarship = $this->getScholarship();
		$experience = $this->getExperience();
		$additional_studies = $this->getAdditional_studies();
		$experience_years = $this->getExperience_years();
		$language = $this->getLanguage();

		$stmt = $this->db->prepare("UPDATE root.positions 
									SET scholarship=:scholarship,experience=:experience,additional_studies=:additional_studies,experience_years=:experience_years,language=:language, modified_at=GETDATE()
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":scholarship", $scholarship, PDO::PARAM_STR);
		$stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
		$stmt->bindParam(":additional_studies", $additional_studies, PDO::PARAM_STR);
		$stmt->bindParam(":experience_years", $experience_years, PDO::PARAM_STR);
		$stmt->bindParam(":language", $language, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function updateOnlyAuthority()
	{
		$result = false;
		$id = $this->getId();
		$authority = $this->getAuthority();
		$stmt = $this->db->prepare("UPDATE root.positions 
									SET authority=:authority, modified_at=GETDATE()
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":authority", $authority, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}


	public function updateGeneral()
	{
		$result = false;
		$id = $this->getId();
		$title = $this->getTitle();
		$id_department = $this->getId_department();
		$id_boss_position = $this->getId_boss_position();
		$clave_ocupacion = $this->getClave_ocupacion();
		$type_position = $this->getType_position();
		$ID_Cliente = $this->getID_Cliente();

		$stmt = $this->db->prepare("UPDATE root.positions 
									SET title=:title,
									id_department=:id_department,
									id_boss_position=:id_boss_position, 
									modified_at=GETDATE(),
									clave_ocupacion=:clave_ocupacion,
									ID_Cliente=:ID_Cliente,
									type_position=:type_position
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":id_department", $id_department, PDO::PARAM_STR);
		$stmt->bindParam(":id_boss_position", $id_boss_position, PDO::PARAM_STR);
		$stmt->bindParam(":clave_ocupacion", $clave_ocupacion, PDO::PARAM_STR);
		$stmt->bindParam(":type_position", $type_position, PDO::PARAM_STR);
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function updatePlanCarrera()
	{
		$result = false;
		$id = $this->getId();
		$id_reviewed_by = $this->getId_reviewed_by();
		$id_approved_by = $this->getId_approved_by();

		$stmt = $this->db->prepare("UPDATE root.positions 
									SET id_approved_by=:id_approved_by,id_reviewed_by=:id_reviewed_by, modified_at=GETDATE()
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":id_reviewed_by", $id_reviewed_by, PDO::PARAM_INT);
		$stmt->bindParam(":id_approved_by", $id_approved_by, PDO::PARAM_INT);


		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}


	public function updateSatusPosition()
	{
		$result = false;
		$id = $this->getId();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("UPDATE root.positions 
									SET status=:status, modified_at=GETDATE()
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}


	public function getSupervisingPositionByIdPosition()
	{
		$result = false;
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT p.title,p.id,sp.id as id_supervising 
		FROM root.supervising_positions sp, root.positions p 
		WHERE id_position=:id AND p.id=sp.id_supervising_position");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	//===[gabo 7 junio puestos]===
	public function getPositionsByIDContacto()
	{
		$ID_Cliente = $this->getID_Cliente();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("SELECT rva.Nombre_Cliente,p.id,va.Nombre_Empresa, p.title,p.objective,p.authority,p.scholarship,p.experience,p.additional_studies,p.experience_years,p.language,CONVERT(DATE,p.created_at,103) created_at,d.department,p.id_department,p.id_boss_position,p.id_reviewed_by,p.id_approved_by,p.modified_at
			FROM root.positions p, root.department d, rh_Ventas_Empresas va,rh_Ventas_Alta rva WHERE p.Empresa=va.Empresa AND p.status=:status AND p.id_department=d.id  AND p.ID_Cliente=rva.Cliente    AND p.ID_Cliente=:ID_Cliente  ORDER BY p.title");

		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_STR);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}
	//===[gabo 7 junio puestos fin]===

    // <!--===[gabo 3 JULIO MODULO RH]=== -->
	public function getPositionsByCliente()
	{
		$ID_Cliente = $this->getID_Cliente();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("SELECT p.id,va.Nombre_Empresa, p.title,p.objective,p.authority,p.scholarship,p.experience,p.additional_studies,p.experience_years,p.language,CONVERT(DATE,p.created_at,103) created_at,d.department,p.id_department,p.id_boss_position,p.id_reviewed_by,p.id_approved_by,p.modified_at
		FROM root.positions p, root.department d, rh_Ventas_Empresas va WHERE p.Empresa=va.Empresa AND p.status=:status AND p.id_department=d.id AND p.ID_Cliente =:ID_Cliente ORDER BY p.title");
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	
	public function getAllPositionByTypePositionAndCliente()
	{
		$status = $this->getStatus();
		//$type_position = $this->getType_position();
		$ID_Cliente = $this->getID_Cliente();

		$stmt = $this->db->prepare("SELECT  CONCAT(e.first_name,' ',e.surname,' ',e.last_name,' - ', p.title) employePosition,e.id id_employee,* FROM root.positions p, root.employees e  WHERE  e.id_position=p.id AND p.status=:status AND e.status=1 AND e.Cliente=:ID_Cliente ORDER BY p.type_position,p.title,e.first_name");

		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		//$stmt->bindParam(":type_position", $type_position, PDO::PARAM_STR);
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_STR);

		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

    // <!-- //===[gabo 3 JULIO MODULO RH]=== -->

	//===[gabo 19 julio cliente session]===
	public function getAllPositionByID_Cliente()
	{
		$status = $this->getStatus();
		//$type_position = $this->getType_position();
		$Cliente = $this->getID_Cliente();

		$stmt = $this->db->prepare("SELECT  CONCAT(e.first_name,' ',e.surname,' ',e.last_name,' - ', p.title) employePosition,e.id id_employee,* FROM root.positions p, root.employees e  WHERE  e.id_position=p.id AND p.status=:status AND e.status=1 AND e.Cliente=:Cliente ORDER BY p.type_position,p.title,e.first_name");

		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		//$stmt->bindParam(":type_position", $type_position, PDO::PARAM_STR);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_STR);

		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}
	//===[gabo 19 julio cliente session fin]===



}
