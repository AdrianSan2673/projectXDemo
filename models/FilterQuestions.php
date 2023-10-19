<?php

class FilterQuestions {
    private $id;
    private $question;
    private $id_vacancy;
    private $status;

    private $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getQuestion(){
		return $this->question;
	}

	public function setQuestion($question){
		$this->question = $question;
	}

	public function getId_vacancy(){
		return $this->id_vacancy;
	}

	public function setId_vacancy($id_vacancy){
		$this->id_vacancy = $id_vacancy;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

    public function getQuestionsByVacancy() {
        $id_vacancy = $this->getId_vacancy();

		$stmt = $this->db->prepare("SELECT * FROM filter_questions WHERE id_vacancy=:id_vacancy");
        $stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
        $stmt->execute();

        $access = $stmt->fetchAll();

		return $access;
    }

    public function save()
    {
        $result = false;
        $question = $this->getQuestion();
        $id_vacancy = $this->getId_vacancy();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("INSERT INTO filter_questions (question,  id_vacancy, status, created_at, modified_at) VALUES(:question, :id_vacancy, :status, GETDATE(), GETDATE())");
        $stmt->bindParam(":question", $question, PDO::PARAM_STR);
        $stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
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

        $result = false;

		$id = $this->getId();
        $question = $this->getQuestion();
        $id_vacancy = $this->getId_vacancy();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("UPDATE filter_questions SET question=:question, id_vacancy=:id_vacancy, status=:status, modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":create", $create, PDO::PARAM_STR);
        $stmt->bindParam(":question", $question, PDO::PARAM_STR);
        $stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

}