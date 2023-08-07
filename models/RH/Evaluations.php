<?php

class Evaluations
{
    private $id;
    private $name;
    private $level;
    private $status;
    private $ID_Empresa;
    private $created_by;
    private $created_at;
    private $modified_at;
    private $type;
    private $db;
    //===[gabo 11 junio excel evaluaciones pt2]===
    private $ID_Cliente;
    //===[gabo 11 junio excel evaluaciones fin pt2]===

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getID_Empresa()
    {
        return $this->ID_Empresa;
    }

    public function setID_Empresa($ID_Empresa)
    {
        $this->ID_Empresa = $ID_Empresa;
    }

    public function getCreated_by()
    {
        return $this->created_by;
    }

    public function setCreated_by($created_by)
    {
        $this->created_by = $created_by;
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }



    //===[gabo 11 junio excel evaluaciones pt2]===
    public function getID_Cliente()
    {
        return $this->ID_Cliente;
    }

    public function setID_Cliente($ID_Cliente)
    {
        $this->ID_Cliente = $ID_Cliente;
    }

    //===[gabo 11 junio excel evaluaciones fin pt2]===



    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT *,CASE  WHEN eva.level=1 THEN 'Operativo' WHEN  eva.level=2 THEN 'Administrativo' END levelFormat FROM root.evaluations eva WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }
    //===[gabo 12 junio excel evaluaciones pt2]===


    public function getAll($ID_Contacto)
    {
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT *,CASE  WHEN eva.level=1 THEN 'Operativo' WHEN  eva.level=2 THEN 'Administrativo' END levelFormat
        FROM root.evaluations eva WHERE  ID_Cliente IN  (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto)AND eva.status=:status");
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }



    //===[gabo 12 junio excel evaluaciones fin pt2]===

    public function save()
    {
        $result = false;

        $name = $this->getName();
        $level = $this->getLevel();
        $status = $this->getStatus();
        $ID_Empresa = $this->getID_Empresa();
        $created_by = $this->getCreated_by();
        $type = $this->getType();
        $id_cliente = $this->getID_Cliente();


        $stmt = $this->db->prepare("INSERT INTO root.evaluations (name, level,status,ID_Empresa,created_by,created_at, modified_at,type,ID_Cliente) VALUES (:name,:level,:status,:ID_Empresa,:created_by, GETDATE(), GETDATE(),:type,:id_cliente)");

        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":level", $level, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Empresa", $ID_Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);


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
        $name = $this->getName();
        $level = $this->getLevel();
        $type = $this->getType();

        $stmt = $this->db->prepare("UPDATE root.evaluations
									SET 
									name=:name,
									level=:level,
									type=:type,
									modified_at=GETDATE()
									WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":level", $level, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_STR);
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

        $stmt = $this->db->prepare("UPDATE root.evaluations
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
        $stmt = $this->db->prepare("DELETE root.evaluations WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        return $fetch;
    }





    //===[gabo 11 junio excel evaluaciones pt2]===
    public function getALLEvaluationsByID_contact($ID_Contacto)
    {

        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT * from  root.evaluations where ID_Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) AND status =:status");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
    //===[gabo 11 junio excel evaluaciones fin pt2]===

//===[gabo 11 junio excel evaluaciones pt2]===
    public function getAllAvaiableEvaluations($ID_Contacto)
    {

        $stmt = $this->db->prepare("SELECT *,CASE  WHEN eva.level=1 THEN 'Operativo' WHEN  eva.level=2 THEN 'Administrativo' END levelFormat
        FROM root.evaluations eva WHERE  ID_Cliente IN  (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) AND eva.id IN(SELECT id_evaluation from root.evaluation_employee)
        ");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    //===[gabo 11 junio excel evaluaciones fin pt2]===
 public function getAllByID_Cliente()
    {
        $status = $this->getStatus();
        $ID_Cliente = $this->getID_Cliente();
        $stmt = $this->db->prepare("SELECT *,CASE  WHEN eva.level=1 THEN 'Operativo' WHEN  eva.level=2 THEN 'Administrativo' END levelFormat
        FROM root.evaluations eva WHERE  ID_Cliente=:ID_Cliente AND eva.status=:status");
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }


    public function getALLEvaluationsByID_Cliente()
    {
        $ID_Cliente = $this->getID_Cliente();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT * from  root.evaluations where ID_Cliente=:ID_Cliente AND status =:status");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getAllAvaiableEvaluationsByID_Cliente()
    {
        $ID_Cliente = $this->getID_Cliente();
        $stmt = $this->db->prepare("SELECT *,CASE  WHEN eva.level=1 THEN 'Operativo' WHEN  eva.level=2 THEN 'Administrativo' END levelFormat
        FROM root.evaluations eva WHERE  ID_Cliente=:ID_Cliente AND eva.id IN(SELECT id_evaluation from root.evaluation_employee)
        ");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
}
