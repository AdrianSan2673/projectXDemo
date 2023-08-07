<?php

class OpenQuestions
{
	private $id;
    private $question;
    private $status;
    private $id_evaluation;
    private $created_at;
    private $modified_at;
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

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getId_evaluation()
    {
        return $this->id_evaluation;
    }

    public function setId_evaluation($id_evaluation)
    {
        $this->id_evaluation = $id_evaluation;
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

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.open_questions WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.open_questions WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getAllByIdEvalaution()
    {
        $id_evaluation = $this->getId_evaluation();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT * FROM root.open_questions WHERE id_evaluation=:id_evaluation AND status=:status");
        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    
    public function getAllByIdEvalaution2()
    {
        $id_evaluation = $this->getId_evaluation();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT * FROM root.open_questions WHERE id_evaluation=:id_evaluation AND status<3 and status>0");
        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getQuestionsByIdEvaluationAndStatus()
    {
        $id_evaluation = $this->getId_evaluation();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT * FROM root.open_questions WHERE id_evaluation=:id_evaluation AND status=:status");
        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }


    public function save()
    {
        $result = false;
        $question = $this->getQuestion();
        $status = $this->getStatus();
        $id_evaluation = $this->getId_evaluation();

        $stmt = $this->db->prepare("INSERT INTO root.open_questions (question,status,id_evaluation, created_at, modified_at) VALUES (:question,:status,:id_evaluation, GETDATE(), GETDATE())");

        $stmt->bindParam(":question", $question, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_STR);
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

        $stmt = $this->db->prepare("UPDATE root.open_questions
									SET 
									question=:question,
									modified_at=GETDATE()
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":question", $question, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

    public function updateDelete()
    {
        $result = false;

        $id = $this->getId();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("UPDATE root.open_questions
									SET 
									status=:status,
									modified_at=GETDATE()
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

}
