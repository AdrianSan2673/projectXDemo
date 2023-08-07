
<?php
class CriterionScore
{
    private $id;
    private $name;
    private $value;
    private $id_criterion;
    private $status;
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

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getValue(){
		return $this->value;
	}

	public function setValue($value){
		$this->value = $value;
	}

	public function getId_criterion(){
		return $this->id_criterion;
	}

	public function setId_criterion($id_criterion){
		$this->id_criterion = $id_criterion;
	}
	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.criterion_score WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.criterion_score WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    public function getAllByIdCriterion()
    {
        $id_criterion = $this->getId_criterion();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT * FROM root.criterion_score WHERE id_criterion=:id_criterion AND status=:status");
        $stmt->bindParam(":id_criterion", $id_criterion, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;

        $name= $this->getName();
        $value= $this->getValue();
        $id_criterion= $this->getId_criterion();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("INSERT INTO root.criterion_score (name,value,id_criterion,status) VALUES (:name,:value,:id_criterion,:status)");

        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":value", $value, PDO::PARAM_INT);
        $stmt->bindParam(":id_criterion", $id_criterion, PDO::PARAM_STR);
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
        $name= $this->getName();
        $value= $this->getValue();

        $stmt = $this->db->prepare("UPDATE root.criterion_score
									SET 
									name=:name,
									value=:value
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":value", $value, PDO::PARAM_STR);

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
        $status= $this->getStatus();
        
        $stmt = $this->db->prepare("UPDATE root.criterion_score
									SET status=:status
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }




}
