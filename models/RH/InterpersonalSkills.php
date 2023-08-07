<?php

class InterpersonalSkills
{

	private $id;
	private $skill;
	private $id_position;
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

	public function getSkill()
	{
		return $this->skill;
	}

	public function setSkill($skill)
	{
		$this->skill = $skill;
	}

	public function getId_position()
	{
		return $this->id_position;
	}

	public function setId_position($id_position)
	{
		$this->id_position = $id_position;
	}

	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM root.interpersonal_skills WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("SELECT * FROM interpersonal_skills");
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}
	public function getAllByIdPosition()
	{
		$id_position = $this->getId_position();
		$stmt = $this->db->prepare("SELECT * FROM root.interpersonal_skills WHERE id_position=:id_position");
		$stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}


	public function save()
	{
		$result = false;
		$skill = $this->getSkill();
		$id_position = $this->getId_position();

		$stmt = $this->db->prepare("INSERT INTO root.interpersonal_skills (skill,id_position) VALUES	(:skill,:id_position)");

		$stmt->bindParam(":skill", $skill, PDO::PARAM_STR);
		$stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);

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
		$skill = $this->getSkill();
		//$id_position = $this->getId_position();

		$stmt = $this->db->prepare("UPDATE root.interpersonal_skills 
									SET skill=:skill
									WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":skill", $skill, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function delete(){
        $id=$this->getId();
        $stmt = $this->db->prepare("DELETE root.interpersonal_skills WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }

        return $result;
    }
}
