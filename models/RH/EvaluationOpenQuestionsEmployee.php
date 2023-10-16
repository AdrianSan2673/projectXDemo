<?php
class EvaluationOpenQuestionsEmployee
{
    private $id;
    private $id_open_question;
    private $answer;
    private $id_evaluation_employee;
    private $created_at;
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

    public function getId_open_question()
    {
        return $this->id_open_question;
    }

    public function setId_open_question($id_open_question)
    {
        $this->id_open_question = $id_open_question;
    }

    public function getAnswer(){
		return $this->answer;
	}

	public function setAnswer($answer){
		$this->answer = $answer;
	}

    public function getId_evaluation_employee(){
        return $this->id_evaluation_employee;
    }

    public function setId_evaluation_employee($id_evaluation_employee){
        $this->id_evaluation_employee = $id_evaluation_employee;
    }

    public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.evaluation_open_questions_employee WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getOpenQuestionByIdAndStatus(OpenQuestions $op)
    {
        $id_evaluation_employee = $this->getId_evaluation_employee();
        $status = $op->getStatus();

        $stmt = $this->db->prepare("SELECT eop.id, op.question, eop.answer FROM root.evaluation_open_questions_employee eop INNER JOIN root.open_questions op ON eop.id_open_question=op.id WHERE eop.id_evaluation_employee=:id_evaluation_employee AND op.status=:status");
        $stmt->bindParam(":id_evaluation_employee", $id_evaluation_employee, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getAllByIdEvvalautionEmployee()
    {
        $id_evaluation_employee = $this->getId_evaluation_employee();
        $stmt = $this->db->prepare("SELECT * FROM root.evaluation_open_questions_employee WHERE id_evaluation_employee=:id_evaluation_employee ");
        $stmt->bindParam(":id_evaluation_employee", $id_evaluation_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;

        $id_open_question = $this->getId_open_question();
        $answer = $this->getAnswer();
        $id_evaluation_employee = $this->getId_evaluation_employee();

        $stmt = $this->db->prepare("INSERT INTO root.evaluation_open_questions_employee (id_open_question,answer,id_evaluation_employee, created_at) VALUES (:id_open_question,:answer,:id_evaluation_employee, GETDATE())");

        $stmt->bindParam(":id_open_question", $id_open_question, PDO::PARAM_INT);
        $stmt->bindParam(":answer", $answer, PDO::PARAM_STR);
        $stmt->bindParam(":id_evaluation_employee", $id_evaluation_employee, PDO::PARAM_INT);

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
        $id_open_question = $this->getId_open_question();
        $answer = $this->getAnswer();
        $id_evaluation_employee = $this->getId_evaluation_employee();

        $stmt = $this->db->prepare("UPDATE root.evaluation_open_questions_employee
									SET 
									id_open_question=:id_open_question,
									answer=:answer,
                                    id_evaluation_employee=:id_evaluation_employee
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_open_question", $id_open_question, PDO::PARAM_INT);
        $stmt->bindParam(":answer", $answer, PDO::PARAM_STR);
        $stmt->bindParam(":id_evaluation_employee", $id_evaluation_employee, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }
}
