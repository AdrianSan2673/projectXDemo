<?php

class CandidateAdditionalPreparation
{
	private $id;
	private $course;
	private $institution;
	private $start_date;
	private $end_date;
	private $id_candidate;
	private $id_level;

	private $db;

	public function __construct()
	{
		$this->db = Connection::connect();
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getCourse()
	{
		return $this->course;
	}

	public function setCourse($course)
	{
		$this->course = $course;
	}

	public function getInstitution()
	{
		return $this->institution;
	}

	public function setInstitution($institution)
	{
		$this->institution = $institution;
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

	public function getId_candidate()
	{
		return $this->id_candidate;
	}

	public function setId_candidate($id_candidate)
	{
		$this->id_candidate = $id_candidate;
	}

	public function getId_level()
	{
		return $this->id_level;
	}

	public function setId_level($id_level)
	{
		$this->id_level = $id_level;
	}

	public function getAdditionalPreparationsByCandidate()
	{
		$candidate = $this->getId_candidate();
		$stmt = $this->db->prepare("SELECT cap.*, el.level FROM candidate_additional_preparation cap LEFT JOIN education_levels el ON cap.id_level=el.id WHERE id_candidate=:id_candidate");
		$stmt->bindParam(":id_candidate", $candidate, PDO::PARAM_STR);
		$stmt->execute();
		$preparations = $stmt->fetchAll();
		return $preparations;
	}

	public function save()
	{
		$result = false;

		$id_candidate = $this->getId_candidate();
		$course = $this->getCourse();
		$institution = $this->getInstitution();
		$start_date = $this->getStart_date();
		$end_date = $this->getEnd_date();
		$id_level = $this->getId_level();

		$stmt = $this->db->prepare("INSERT INTO candidate_additional_preparation(id_candidate, course, institution, start_date, end_date, id_level) VALUES (:id_candidate, :course, :institution, :start_date, :end_date, :id_level)");
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":course", $course, PDO::PARAM_STR);
		$stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_level", $id_level, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function update()
	{
		$result = false;

		$id = $this->getId();
		$course = $this->getCourse();
		$institution = $this->getInstitution();
		$start_date = $this->getStart_date();
		$end_date = $this->getEnd_date();
		$id_level = $this->getId_level();

		$stmt = $this->db->prepare("UPDATE candidate_additional_preparation SET course=:course, institution=:institution, start_date=:start_date, end_date=:end_date, id_level=:id_level WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":course", $course, PDO::PARAM_STR);
		$stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_level", $id_level, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT cap.*, c.first_name, c.surname, c.last_name FROM candidate_additional_preparation cap INNER JOIN candidates c ON cap.id_candidate=c.id LEFT JOIN education_levels el ON cap.id_level=el.id WHERE cap.id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}

	// ===[GABO 26 ABRIL VER CANDIDATO]===
	public function delete()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("DELETE TOP (1) FROM candidate_additional_preparation WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}
	// ===[FIN]===
}
