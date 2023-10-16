<?php

class EvaluationCategory
{
    private $id;
    private $category;
    private $id_evaluation;
    private $status;
    private $description;
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

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getId_evaluation()
    {
        return $this->id_evaluation;
    }

    public function setId_evaluation($id_evaluation)
    {
        $this->id_evaluation = $id_evaluation;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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
        $stmt = $this->db->prepare("SELECT * FROM root.evaluation_category WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAllByIdEvaluation()
    {
        $id_evaluation = $this->getId_evaluation();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT ec.* FROM root.evaluation_category ec
        WHERE  ec.id_evaluation=:id_evaluation AND status=:status");

        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getAllQuestionsByIdEvalaution()
    {

        $id_evaluation = $this->getId_evaluation();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT q.question,q.id id_question, ec.category, ec.id id_category
        FROM root.evaluations e,root.evaluation_category ec,root.category_criterion cc, root.questions q 
        WHERE e.id=:id_evaluation AND  ec.id_evaluation=e.id AND cc.id_category=ec.id AND q.id_criterion=cc.id AND ec.status=:status AND q.status=1
        ");

         $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT); 
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;

        $category = $this->getCategory();
        $id_evaluation = $this->getId_evaluation();
        $status = $this->getStatus();
        $description = $this->getDescription();

        $stmt = $this->db->prepare("INSERT INTO root.evaluation_category (category,id_evaluation,status,description, created_at, modified_at) VALUES (:category,:id_evaluation,:status,:description, GETDATE(), GETDATE())");

        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);


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
        $category = $this->getCategory();
        $id_evaluation = $this->getId_evaluation();
        $status = $this->getStatus();
        $description = $this->getDescription();
        $stmt = $this->db->prepare("UPDATE root.evaluation_category
									SET 
									category=:category,
									id_evaluation=:id_evaluation,
									status=:status,
									description=:description,
									modified_at=GETDATE()
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

    public function updateDeleteCategory()
    {
        $result = false;

        $id = $this->getId();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("UPDATE root.evaluation_category
									SET 
									status=:status,
									modified_at=GETDATE()
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

    public function delete()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("DELETE root.evaluation_category WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        return $fetch;
    }
}
