<?php
// ===[gabo 12 mayo evaluaciones]===


class EvaluationEmployee
{
	private $id;
	private $id_evaluation;
	private $id_employee;
	private $id_position;
	private $id_boss;
	private $start_date;
	private $end_date;
	private $status;
	private $boss_email;
	private $employee_email;
	private $date_of_realization;
	private $feedback_date;
	private $signed_date;
	private $token_sign;
	private $ID_Contacto;
	private $created_at;
	private $modified_at;
	private $db;
	private $score;
	//===[gabo 12 mayo evaluaciones]==
	private $id_group_evaluation;
	private $ID_Cliente;

	//===[gabo 12 mayo evaluaciones fin]==

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

	public function getId_evaluation()
	{
		return $this->id_evaluation;
	}

	public function setId_evaluation($id_evaluation)
	{
		$this->id_evaluation = $id_evaluation;
	}

	public function getId_employee()
	{
		return $this->id_employee;
	}

	public function setId_employee($id_employee)
	{
		$this->id_employee = $id_employee;
	}

	public function getId_position()
	{
		return $this->id_position;
	}

	public function setId_position($id_position)
	{
		$this->id_position = $id_position;
	}

	public function getId_boss()
	{
		return $this->id_boss;
	}

	public function setId_boss($id_boss)
	{
		$this->id_boss = $id_boss;
	}

	public function getStart_date()
	{
		return $this->start_date;
	}

	public function setStart_date($start_date)
	{
		$this->start_date = $start_date;
	}

	public function getEnd_date()
	{
		return $this->end_date;
	}

	public function setEnd_date($end_date)
	{
		$this->end_date = $end_date;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function getBoss_email()
	{
		return $this->boss_email;
	}

	public function setBoss_email($boss_email)
	{
		$this->boss_email = $boss_email;
	}

	public function getEmployee_email()
	{
		return $this->employee_email;
	}

	public function setEmployee_email($employee_email)
	{
		$this->employee_email = $employee_email;
	}

	public function getDate_of_realization()
	{
		return $this->date_of_realization;
	}

	public function setDate_of_realization($date_of_realization)
	{
		$this->date_of_realization = $date_of_realization;
	}

	public function getFeedback_date()
	{
		return $this->feedback_date;
	}

	public function setFeedback_date($feedback_date)
	{
		$this->feedback_date = $feedback_date;
	}

	public function getSigned_date()
	{
		return $this->signed_date;
	}

	public function setSigned_date($signed_date)
	{
		$this->signed_date = $signed_date;
	}

	public function getToken_sign()
	{
		return $this->token_sign;
	}

	public function setToken_sign($token_sign)
	{
		$this->token_sign = $token_sign;
	}

	public function getTokenMD5()
	{
		return md5(uniqid(mt_rand(), false));
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

	public function getScore()
	{
		return $this->score;
	}

	public function setScore($score)
	{
		$this->score = $score;
	}

	// ===[gabo 12 mayo evaluaciones ]===
	public function getId_group_evaluation()
	{
		return $this->id_group_evaluation;
	}

	public function setId_group_evaluation($id_group_evaluation)
	{
		$this->id_group_evaluation = $id_group_evaluation;
	}

	public function getID_Cliente()
	{
		return $this->ID_Cliente;
	}

	public function setID_Cliente($ID_Cliente)
	{
		$this->ID_Cliente = $ID_Cliente;
	}

	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT ee.id_group_evaluation, ee.id, ee.id_evaluation, ee.id_employee, ev.name, e.first_name, e.surname, e.last_name, ee.id_boss, eb.first_name AS first_name_boss, eb.surname AS surname_boss, eb.last_name AS last_name_boss, ee.start_date, ee.end_date, ee.status, ee.date_of_realization, ee.boss_email, ee.employee_email, ee.created_at,ee.score FROM root.evaluation_employee ee INNER JOIN root.evaluations ev ON ee.id_evaluation=ev.id INNER JOIN root.employees e ON ee.id_employee=e.id INNER JOIN root.employees eb ON ee.id_boss=eb.id WHERE ee.id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}
	// ===[gabo 12 mayo evaluaciones fin]===

	public function getEvaluationByID_Contacto()
	{
		$ID_Contacto = $this->getID_Contacto();

		$stmt = $this->db->prepare("SELECT ee.id, ev.name, e.first_name, e.surname, e.last_name, p.title, d.department, ee.id_boss, eb.first_name AS first_name_boss, eb.surname AS surname_boss, eb.last_name AS last_name_boss, ee.start_date, ee.end_date, ee.status, ee.date_of_realization, ee.created_at FROM root.evaluation_employee ee INNER JOIN root.evaluations ev ON ee.id_evaluation=ev.id INNER JOIN root.employees e ON ee.id_employee=e.id INNER JOIN root.positions p ON e.id_position=p.id INNER JOIN root.department d ON p.id_department=d.id INNER JOIN root.employees eb ON ee.id_boss=eb.id WHERE e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) ORDER BY ee.created_at, ev.name");

		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}
	// ===[ gabo15 de mayo inicio]===
	public function getEvaluationByID_ContactoAndStatus()
	{
		$ID_Contacto = $this->getID_Contacto();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("SELECT ee.id, ev.name, e.first_name, e.surname, e.last_name, p.title, d.department, ee.id_boss, eb.first_name AS first_name_boss, eb.surname AS surname_boss, eb.last_name AS last_name_boss, ee.start_date, ee.end_date, ee.status, ee.date_of_realization, ee.created_at FROM root.evaluation_employee ee INNER JOIN root.evaluations ev ON ee.id_evaluation=ev.id INNER JOIN root.employees e ON ee.id_employee=e.id INNER JOIN root.positions p ON e.id_position=p.id INNER JOIN root.department d ON p.id_department=d.id INNER JOIN root.employees eb ON ee.id_boss=eb.id WHERE e.Cliente=:ID_Contacto  AND ee.status<:status ORDER BY ee.created_at, ev.name");

		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}
	// ===[ gabo 15 de mayo inicio fin]===


	public function getAllByIdEmployee()
	{
		$id_employee = $this->getId_employee();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("SELECT * 
		FROM root.evaluations eva, root.evaluation_employee evaemploye, employees e, department d, positions p 
		WHERE evaemploye.id_evaluation=eva.id AND evaemploye.id_employee=:id_employee AND e.id_position=p.id AND p.id_department= d.id AND eva.status=:status
		ORDER BY eva.name");

		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}

	// ===[gabo 12 mayo evaluaciones]===
	public function save()
	{
		$result = false;

		$id_evaluation = $this->getId_evaluation();
		$id_group_evaluation = $this->getId_group_evaluation();
		$id_employee = $this->getId_employee();
		$id_position = $this->getId_position();
		$id_boss = $this->getId_boss();
		$start_date = $this->getStart_date();
		$end_date = $this->getEnd_date();
		$status = $this->getStatus();
		$boss_email = $this->getBoss_email();
		$date_of_realization = $this->getDate_of_realization();
		$ID_Contacto = $this->getID_Contacto();

		$stmt = $this->db->prepare("INSERT INTO root.evaluation_employee (id_evaluation,id_employee,	id_position,id_boss,start_date,end_date,status,boss_email,date_of_realization,ID_Contacto,created_at,modified_at,id_group_evaluation) VALUES (:id_evaluation,:id_employee,:id_position,:id_boss,:start_date,:end_date,:status,:boss_email,:date_of_realization,:ID_Contacto,GETDATE(), GETDATE(),:id_group_evaluation)");

		$stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_STR);
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_STR);
		$stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);
		$stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_STR);
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":boss_email", $boss_email, PDO::PARAM_STR);
		$stmt->bindParam(":date_of_realization", $date_of_realization, PDO::PARAM_STR);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":id_group_evaluation", $id_group_evaluation, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}
	// ===[gabo 12 mayo evaluaciones fin]===

	public function update()
	{
		$result = false;

		$id = $this->getId();
		$id_evaluation = $this->getId_evaluation();
		$id_employee = $this->getId_employee();
		$id_position = $this->getId_position();
		$id_boss = $this->getId_boss();
		$start_date = $this->getStart_date();
		$end_date = $this->getEnd_date();
		$status = $this->getStatus();
		$date_of_realization = $this->getDate_of_realization();
		$ID_Contacto = $this->getID_Contacto();

		$stmt = $this->db->prepare("UPDATE root.evaluation_employee
									SET 
									id_evaluation=:id_evaluation,
									id_employee=:id_employee,
									id_position=:id_position,
									id_boss=:id_boss,
									start_date=:start_date,
									end_date=:end_date,
									status=:status,
									date_of_realization=:date_of_realization,
									ID_Contacto=:ID_Contacto,
									modified_at=GETDATE()
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_STR);
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_STR);
		$stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);
		$stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_STR);
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt->bindParam(":date_of_realization", $date_of_realization, PDO::PARAM_STR);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function evaluationComplete()
	{
		$result = false;

		$id = $this->getId();
		$status = $this->getStatus();

		$stmt = $this->db->prepare("UPDATE root.evaluation_employee SET status=:status, date_of_realization=GETDATE() WHERE id=:id");
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag)
			$result = true;

		return $result;
	}

	public function evaluationFeedback()
	{
		$result = false;

		$id = $this->getId();
		$status = $this->getStatus();
		$employee_email = $this->getEmployee_email();
		$token_sign = $this->getTokenMD5();

		$stmt = $this->db->prepare("UPDATE root.evaluation_employee SET status=:status, feedback_date=GETDATE(), employee_email=:employee_email, token_sign=:token_sign WHERE id=:id");
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":employee_email", $employee_email, PDO::PARAM_STR);
		$stmt->bindParam(":token_sign", $token_sign, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setToken_sign($token_sign);
		}


		return $result;
	}

	public function getEvaluationByIdBoss()
	{
		$id_boss = $this->getId_boss();

		$stmt = $this->db->prepare("SELECT ee.id, ev.name, e.first_name, e.surname, e.last_name, p.title, d.department, ee.id_boss, eb.first_name AS first_name_boss, eb.surname AS surname_boss, eb.last_name AS last_name_boss, ee.start_date, ee.end_date, ee.status, ee.date_of_realization, ee.created_at FROM root.evaluation_employee ee INNER JOIN root.evaluations ev ON ee.id_evaluation=ev.id INNER JOIN root.employees e ON ee.id_employee=e.id INNER JOIN root.positions p ON e.id_position=p.id INNER JOIN root.department d ON p.id_department=d.id INNER JOIN root.employees eb ON ee.id_boss=eb.id WHERE ee.id_boss=:id_boss ORDER BY ev.name");
		$stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}

	public function getEvaluationByIdBossByDates()
	{
		$id_boss = $this->getId_boss();
		$start_date = $this->getStart_date();
		$end_date = $this->getEnd_date();

		$stmt = $this->db->prepare("SELECT ee.id, ev.name, e.first_name, e.surname, e.last_name, p.title, d.department, ee.id_boss, eb.first_name AS first_name_boss, eb.surname AS surname_boss, eb.last_name AS last_name_boss, ee.start_date, ee.end_date, ee.status, ee.date_of_realization, ee.created_at FROM root.evaluation_employee ee INNER JOIN root.evaluations ev ON ee.id_evaluation=ev.id INNER JOIN root.employees e ON ee.id_employee=e.id INNER JOIN root.positions p ON e.id_position=p.id INNER JOIN root.department d ON p.id_department=d.id INNER JOIN root.employees eb ON ee.id_boss=eb.id WHERE ee.id_boss=:id_boss AND ee.start_date=:start_date AND ee.end_date=:end_date ORDER BY ev.name");
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}

	public function signEvaluation()
	{
		$id = $this->getId();

		$stmt = $this->db->prepare("UPDATE root.evaluation_employee SET status=4, signed_date=GETDATE() WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$result = $stmt->execute();
		return $result;
	}

	public function validateIdToken()
	{
		$id = $this->getId();
		$token_sign = $this->getToken_sign();

		$stmt = $this->db->prepare("SELECT TOP 1 status FROM root.evaluation_employee WHERE id = :id AND token_sign = :token_sign", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":token_sign", $token_sign, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->rowCount();

		if ($rows > 0) {
			$fetch = $stmt->fetchObject();
			if ($fetch->status == 1) {
				$case = 1;
			} else {
				if ($this->signEvaluation()) {
					$case = 2;
				} else {
					$case = 3;
				}
			}
		} else {
			$case = 4;
		}
		return $case;
	}

	// ===[gabo 12 mayo evaluaciones]===
	public function getAllEvaluationEmployeeBIdBoss()
	{
		$ID_Contacto = $this->getID_Contacto();

		$stmt = $this->db->prepare("SELECT ee.created_at, ee.id_evaluation, ee.id_boss, ev.name, p.title, CONCAT(e.first_name,' ',e.surname,' ',e.last_name) fullNameBoss, ee.start_date, ee.end_date,ev.level
		FROM root.evaluations ev INNER JOIN root.evaluation_employee ee ON ev.id=ee.id_evaluation INNER JOIN root.employees e ON ee.id_boss=e.id INNER JOIN root.positions p ON e.id_position=p.id
		WHERE e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) GROUP BY ee.created_at, ee.id_boss, ee.id_evaluation, ev.name, p.title, e.first_name, e.surname, e.last_name, ee.start_date, ee.end_date,ev.level ORDER BY ee.created_at DESC, ev.name, e.first_name");

		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}
	// ===[gabo 12 mayo evaluaciones fin]===


	//===[gabo 11 mayo calificaciones]==
	public function updateScore()
	{
		$result = false;

		$id = $this->getId();
		$score = $this->getScore();
		$stmt = $this->db->prepare("UPDATE root.evaluation_employee SET score=:score  WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":score", $score, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag)
			$result = true;

		return $result;
	}


	//===[gabo 11 mayo calificaciones fin]==

	// ===[gabo 12 mayo evaluaciones]===
	public function getEvalutionsByID_evaluation()
	{
		$id_evaluation = $this->getId_evaluation();

		$stmt = $this->db->prepare("SELECT ee.id, ev.name, e.first_name, e.surname, e.last_name, p.title, d.department, ee.id_boss, eb.first_name AS first_name_boss, eb.surname AS surname_boss, eb.last_name AS last_name_boss, ee.start_date, ee.end_date, ee.status, ee.date_of_realization, ee.created_at FROM root.evaluation_employee ee INNER JOIN root.evaluations ev ON ee.id_evaluation=ev.id INNER JOIN root.employees e ON ee.id_employee=e.id INNER JOIN root.positions p ON e.id_position=p.id INNER JOIN root.department d ON p.id_department=d.id INNER JOIN root.employees eb ON ee.id_boss=eb.id WHERE ee.id_evaluation=:id_evaluation  ORDER BY ee.created_at, ev.name");

		$stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}

	public function delete_evaluation()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("DELETE root.evaluation_employee WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$fetch = $stmt->execute();
		return $fetch;
	}
	// ===[gabo 12 mayo evaluaciones fin]===


	// ===[gabo 23 mayo agrupar]===
	public function actualizaId_group_evaluation()
	{
		$start_date = $this->getStart_date();
		$end_date = $this->getEnd_date();
		$id_group_evaluation = $this->getId_group_evaluation();


		$stmt = $this->db->prepare("UPDATE root.evaluation_employee set id_group_evaluation=:id_group_evaluation WHERE start_date=:start_date AND end_date=:end_date");
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_group_evaluation", $id_group_evaluation, PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt) {
			return true;
		}
	}

	public function obtieneOneEvaluationXFecha()
	{
		$start_date = $this->getStart_date();
		$end_date = $this->getEnd_date();


		$stmt = $this->db->prepare(" SELECT TOP(1) * from root.evaluation_employee ee LEFT JOIN root.evaluations e on ee.id_evaluation=e.id where start_date=:start_date and end_date=:end_date");
		$stmt->bindParam(":start_date",  $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date",  $end_date, PDO::PARAM_STR);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}
	// ===[gabo 23 mayo agrupar fin]===

	// ===[gabo 25 mayo table ]===
	public function getValuequestionForEmployee()
	{
		$id_group_evaluation = $this->getId_group_evaluation();

		$stmt = $this->db->prepare("SELECT ee.score,ee.id, eplo.id id_employee,CONCAT(eplo.first_name,' ',eplo.surname,' ',eplo.last_name) employeeName,p.title, CONCAT(boss.first_name,' ',boss.surname,' ',boss.last_name) BossName
		from root.evaluation_employee ee,root.employees eplo, root.employees  boss, root.positions p
		where id_group_evaluation=:id_group_evaluation AND ee.id_employee=eplo.id AND ee.id_boss=boss.id AND ee.id_position=p.id 
		group by  eplo.id,eplo.first_name,eplo.surname,eplo.last_name,p.title,boss.first_name,boss.surname,boss.last_name,ee.id,ee.score
		ORDER BY eplo.first_name,eplo.surname,eplo.last_name");

		$stmt->bindParam(":id_group_evaluation", $id_group_evaluation, PDO::PARAM_INT);

		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}

	// ===[gabo 25 mayo table fin]===

	public function getValuequestionByIdEmployee()
	{
		$id = $this->getId();


		$stmt = $this->db->prepare("SELECT *, eqe.id_question id_question_employee,eqe.value value_question_employee, ec.id id_category, ee.id id_evaluation_employe
		FROM root.evaluation_employee ee,root.evaluation_questions_employee eqe, root.questions q,root.category_criterion cc,root.evaluation_category ec
		WHERE  ee.id=:id AND eqe.id_evaluation_employee=ee.id AND eqe.id_question=q.id AND q.id_criterion=cc.id AND cc.id_category=ec.id AND ec.id_evaluation=ee.id_evaluation 
		");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}



	// ===[gabo 23 de mayo agrupar]===
	public function getGroupsByIdEvaluation()
	{

		$id_evaluation = $this->getId_evaluation();
		$stmt = $this->db->prepare("SELECT * from root.groups_evaluation where id_group  IN (select ee.id_group_evaluation from root.groups_evaluation ge LEFT JOIN root.evaluation_employee ee on  ee.id_group_evaluation= ge.id_group where ee.id_evaluation=:id_evaluation group by id_group_evaluation)");
		$stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}
	// ===[gabo 23 de mayo agrupar fin]===

	// ===[gabo 11 junio excel evaluaciones]==

	public function getGroupsByIdContacto()
	{
		$id_evaluation = $this->getId_evaluation();
		$id_contacto = $this->getID_Contacto();
		$stmt = $this->db->prepare("SELECT * FROM  root.groups_evaluation WHERE id_group in(
			SELECT ge.id_group from root.groups_evaluation ge INNER JOIN root.evaluation_employee ee 
			ON ge.id_group=ee.id_group_evaluation 
			where ee.id_evaluation=:id_evaluation AND  
			ge.ID_Cliente  IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos
			WHERE ID_Contacto=:id_contacto) group by id_group)");		$stmt->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}

	// ===[gabo 11 junio excel evaluaciones]===
	//===[gabo 19 julio cliente session]===
public function getGroupsByID_Cliente()
	{
		$id_evaluation = $this->getId_evaluation();
		$ID_Cliente = $this->getID_Cliente();
		$stmt = $this->db->prepare("SELECT start_date,end_date FROM  root.groups_evaluation WHERE id_group in(
			SELECT ge.id_group from root.groups_evaluation ge INNER JOIN root.evaluation_employee ee 
			ON ge.id_group=ee.id_group_evaluation 
			where ee.id_evaluation=:id_evaluation AND  
			ge.ID_Cliente=:ID_Cliente group by id_group) group by start_date,end_date");
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}


	public function getValuequestionForEmployeeBYStartAndEndDate()
	{
		$start_date = $this->getStart_date();
		$end_date = $this->getEnd_date();

		$stmt = $this->db->prepare("SELECT ge.group_name, ee.score,ee.id, eplo.id id_employee,CONCAT(eplo.first_name,' ',eplo.surname,' ',eplo.last_name) employeeName,p.title, CONCAT(boss.first_name,' ',boss.surname,' ',boss.last_name) BossName
		from root.evaluation_employee ee,root.employees eplo, root.employees  boss, root.positions p, root.groups_evaluation ge
		where   ee.id_employee=eplo.id AND ee.id_boss=boss.id AND ee.id_position=p.id  AND ee.id_group_evaluation=ge.id_group AND ge.start_date=:start_date AND ge.end_date=:end_date
		group by  eplo.id,eplo.first_name,eplo.surname,eplo.last_name,p.title,boss.first_name,boss.surname,boss.last_name,ee.id,ee.score,ge.group_name
		ORDER BY eplo.first_name,eplo.surname,eplo.last_name");

		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);

		$stmt->execute();
		$fetch =  $stmt->fetchAll();
		return $fetch;
	}
	//===[gabo 19 julio cliente session fin]===

}
