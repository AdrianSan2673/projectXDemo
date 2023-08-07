
<?php
class EvaluationQuestionsEmployee
{
    private $id;
    private $id_question;
    private $value;
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

    public function getId_question()
    {
        return $this->id_question;
    }

    public function setId_question($id_question)
    {
        $this->id_question = $id_question;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
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
        $stmt = $this->db->prepare("SELECT * FROM root.evaluation_questions_employee WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }
  
    public function getOneValue()
    {
        $id_evaluation_employee = $this->getId_evaluation_employee();
        $id_question= $this->getId_question();
        $stmt = $this->db->prepare("SELECT * FROM root.evaluation_questions_employee WHERE id_question=:id_question AND id_evaluation_employee=:id_evaluation_employee");
        $stmt->bindParam(":id_evaluation_employee", $id_evaluation_employee, PDO::PARAM_INT);
        $stmt->bindParam(":id_question", $id_question, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAnswersById()
    {
        $id_evaluation_employee = $this->getId_evaluation_employee();
        $stmt = $this->db->prepare("SELECT * FROM root.evaluation_questions_employee WHERE id_evaluation_employee=:id_evaluation_employee");
        $stmt->bindParam(":id_evaluation_employee", $id_evaluation_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;

        $id_question = $this->getId_question();
        $value = $this->getValue();
        $id_evaluation_employee = $this->getId_evaluation_employee();

        $stmt = $this->db->prepare("INSERT INTO root.evaluation_questions_employee (id_question,value,id_evaluation_employee, created_at) VALUES (:id_question,:value,:id_evaluation_employee, GETDATE())");

        $stmt->bindParam(":id_question", $id_question, PDO::PARAM_INT);
        $stmt->bindParam(":value", $value, PDO::PARAM_INT);
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
        $id_question = $this->getId_question();
        $value = $this->getValue();
        $id_evaluation_employee = $this->getId_evaluation_employee();

        $stmt = $this->db->prepare("UPDATE root.evaluation_questions_employee
									SET 
									id_question=:id_question,
									value=:value,
                                    id_evaluation_employee=:id_evaluation_employee
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_question", $id_question, PDO::PARAM_INT);
        $stmt->bindParam(":value", $value, PDO::PARAM_INT);
        $stmt->bindParam(":id_evaluation_employee", $id_evaluation_employee, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }
}
