<?php

class CandidateAptitude
{

	private $id;
	private $aptitude;
	private $level;
	private $id_candidate;

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

	public function getAptitude()
	{
		return $this->aptitude;
	}

	public function setAptitude($aptitude)
	{
		$this->aptitude = $aptitude;
	}

	public function getLevel()
	{
		return $this->level;
	}

	public function setLevel($level)
	{
		$this->level = $level;
	}

	public function getId_candidate()
	{
		return $this->id_candidate;
	}

	public function setId_candidate($id_candidate)
	{
		$this->id_candidate = $id_candidate;
	}

	public function getAptitudesByCandidate()
	{
		$candidate = $this->getId_candidate();
		$stmt = $this->db->prepare("SELECT * FROM candidate_aptitude WHERE id_candidate=:id_candidate;");
		$stmt->bindParam(":id_candidate", $candidate, PDO::PARAM_STR);
		$stmt->execute();
		$aptitudes = $stmt->fetchAll();
		return $aptitudes;
	}

	public function save()
	{
		$result = false;

		$id_candidate = $this->getId_candidate();
		$aptitude = $this->getAptitude();
		$level = $this->getLevel();

		$stmt = $this->db->prepare("INSERT INTO candidate_aptitude(id_candidate, aptitude, level) VALUES (:id_candidate, :aptitude, :level)");
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":aptitude", $aptitude, PDO::PARAM_INT);
		$stmt->bindParam(":level", $level, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
		return $result;
	}

	public function update()
	{
		$result = false;

		$id = $this->getId();
		$aptitude = $this->getAptitude();
		$level = $this->getLevel();

		$stmt = $this->db->prepare("UPDATE candidate_aptitude SET aptitude=:aptitude, level=:level WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":aptitude", $aptitude, PDO::PARAM_INT);
		$stmt->bindParam(":level", $level, PDO::PARAM_INT);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT ca.*, c.first_name, c.surname, c.last_name FROM candidate_aptitude ca INNER JOIN candidates c ON ca.id_candidate=c.id WHERE ca.id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}

	// ===[GABO 26 ABRIL VER CANDIDATO]===
	public function delete()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("DELETE TOP (1) FROM candidate_aptitude WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}
	// ===[FIN]===
}
