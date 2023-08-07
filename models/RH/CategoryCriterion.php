
<?php
class CategoryCriterion
{
    private $id;
    private $criterion;
    private $id_category;
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

	public function getCriterion(){
		return $this->criterion;
	}

	public function setCriterion($criterion){
		$this->criterion = $criterion;
	}

	public function getId_category(){
		return $this->id_category;
	}

	public function setId_category($id_category){
		$this->id_category = $id_category;
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
        $stmt = $this->db->prepare("SELECT * FROM root.category_criterion WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }
   
    public function getOneByIdCategory()
    {
        $id_category = $this->getId_category();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT * FROM root.category_criterion WHERE id_category=:id_category AND status=:status");
        $stmt->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);

        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $id = $this->getId();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT * FROM root.category_criterion WHERE id=:id AND status=:status");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    public function getAllByIdCategory()
    {
        $id_category = $this->getId_category();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT * FROM root.category_criterion  WHERE id_category=:id_category AND status=:status");
        $stmt->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;

        $criterion = $this->getCriterion();
        $id_category = $this->getId_category();
     
        $stmt = $this->db->prepare("INSERT INTO root.category_criterion (criterion,id_category,status) VALUES (:criterion,:id_category,1)");

        $stmt->bindParam(":criterion", $criterion, PDO::PARAM_STR);
        $stmt->bindParam(":id_category", $id_category, PDO::PARAM_STR);

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
        $criterion = $this->getCriterion();

        $stmt = $this->db->prepare("UPDATE root.category_criterion
									SET 
									criterion=:criterion
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":criterion", $criterion, PDO::PARAM_INT);
     

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }


    public function updateDeleteCriterion()
    {
        $result = false;

        $id = $this->getId();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("UPDATE root.category_criterion
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
