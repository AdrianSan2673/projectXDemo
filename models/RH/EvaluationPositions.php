
<?php
class EvaluationPositions
{
    private $id;
    private $id_evaluation;
    private $id_position;
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

	public function getId_evaluation(){
		return $this->id_evaluation;
	}

	public function setId_evaluation($id_evaluation){
		$this->id_evaluation = $id_evaluation;
	}

	public function getId_position(){
		return $this->id_position;
	}

	public function setId_position($id_position){
		$this->id_position = $id_position;
	}

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.evaluation_positions WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM root.evaluation_positions WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;

        $id_evaluation = $this->getId_evaluation();
        $id_position = $this->getId_position();
     

        $stmt = $this->db->prepare("INSERT INTO root.evaluation_positions (id_evaluation,id_position) VALUES (:id_evaluation,:id_position)");

        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_STR);
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
        $id_evaluation = $this->getId_evaluation();
        $id_position = $this->getId_position();

        $stmt = $this->db->prepare("UPDATE root.evaluation_positions
									SET 
									id_evaluation=:id_evaluation,
									id_position=:id_position,
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_evaluation", $id_evaluation, PDO::PARAM_STR);
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }
}
