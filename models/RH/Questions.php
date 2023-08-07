
<?php
class Questions
{
    private $id;
    private $question;
    private $definition;
    private $status;
    private $id_criterion;
    private $created_at;
    private $modified_at;
    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
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

	public function getDefinition(){
		return $this->definition;
	}

	public function setDefinition($definition){
		$this->definition = $definition;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getId_criterion(){
		return $this->id_criterion;
	}

	public function setId_criterion($id_criterion){
		$this->id_criterion = $id_criterion;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

	public function getModified_at(){
		return $this->modified_at;
	}

	public function setModified_at($modified_at){
		$this->modified_at = $modified_at;
	}

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.questions WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.questions WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    public function getAllByIdCriterion()
    {
        $id_criterion = $this->getId_criterion();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT * FROM root.questions WHERE id_criterion=:id_criterion AND status=:status");
        $stmt->bindParam(":id_criterion", $id_criterion, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;
        $question = $this->getQuestion();
        $definition = $this->getDefinition();
        $status = $this->getStatus();
        $id_criterion = $this->getId_criterion();

        $stmt = $this->db->prepare("INSERT INTO root.questions (question,definition,status,id_criterion, created_at, modified_at) VALUES (:question,:definition,:status,:id_criterion, GETDATE(), GETDATE())");

        $stmt->bindParam(":question", $question, PDO::PARAM_STR);
        $stmt->bindParam(":definition", $definition, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":id_criterion", $id_criterion, PDO::PARAM_STR);
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
        $definition = $this->getDefinition();
        $status = $this->getStatus();
        $id_criterion = $this->getId_criterion();

        $stmt = $this->db->prepare("UPDATE root.questions
									SET 
									question=:question,
									definition=:definition,
									modified_at=GETDATE()
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":question", $question, PDO::PARAM_INT);
        $stmt->bindParam(":definition", $definition, PDO::PARAM_INT);
     

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

        $stmt = $this->db->prepare("UPDATE root.questions
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
