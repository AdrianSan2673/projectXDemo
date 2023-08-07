<?php

class HistoryPositions
{
    private $id;
    private $id_employee;
    private $id_position;
    private $created_at;
    private $start_date;
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

    public function getId_employee()
    {
        return $this->id_employee;
    }

    public function setId_employee($id_employee)
    {
        $this->id_employee = $id_employee;
    }

    public function getId_position()
    {
        return $this->id_position;
    }

    public function setId_position($id_position)
    {
        $this->id_position = $id_position;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getStart_date(){
		return $this->start_date;
	}

	public function setStart_date($start_date){
		$this->start_date = $start_date;
	}

	public function getModified_at(){
		return $this->modified_at;
	}

	public function setModified_at($modified_at){
		$this->modified_at = $modified_at;
	}

    public function save()
    {
        $result = false;
        $id_position = $this->getId_position();
        $id_employee = $this->getId_employee();

        $stmt = $this->db->prepare("INSERT INTO root.history_positions (id_position,id_employee,created_at,modified_at,start_date) VALUES (:id_position,:id_employee, GETDATE(),GETDATE(),GETDATE())");

        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
    }

    public function save1()
    {
        $result = false;
        $id_position = $this->getId_position();
        $id_employee = $this->getId_employee();
        $start_date = $this->getStart_date();

        $stmt = $this->db->prepare("INSERT INTO root.history_positions (id_position,id_employee,created_at,modified_at,start_date) VALUES (:id_position,:id_employee, GETDATE(),GETDATE(),:start_date)");

        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
    }
    public function updateStar_date()
    {
        $result = false;
        $id=$this->getId();
        $start_date = $this->getStart_date();

        $stmt = $this->db->prepare("UPDATE root.history_positions SET start_date=:start_date, modified_at=GETDATE() WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $flag = $stmt->execute();

       
        return $flag;
    }


    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT  * FROM root.history_positions  WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getAllByIdEmployee()
    {
        $id_employee = $this->getId_employee();
        $stmt = $this->db->prepare("SELECT  hp.id,hp.created_at, p.title, d.department,e.id id_employee,p.id id_position,hp.start_date FROM root.history_positions hp,root.positions p, root.employees e, root.department d WHERE hp.id_employee=e.id AND hp.id_position=p.id AND e.id=:id_employee AND p.id_department=d.id   ORDER BY hp.start_date desc ");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function delet()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("DELETE root.history_positions WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $fetch =     $stmt->execute();
        return $fetch;
    }
}
