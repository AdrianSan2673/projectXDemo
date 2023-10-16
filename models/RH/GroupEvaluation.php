<?php

class GroupEvaluation
{
    private $id_group;
    private $group_name;
    private $id_boss;
    private $start_date;
    private $end_date;
    private $id_contact;
    private $modified_at;
    //===[gabo 6 junio evaluaciones]===
    private $ID_Cliente;
    //===[gabo 6 junio evaluaciones fin]===
    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getId_group()
    {
        return $this->id_group;
    }

    public function setId_group($id_group)
    {
        $this->id_group = $id_group;
    }
    public function getGroup_name()
    {
        return $this->group_name;
    }

    public function setGroup_name($group_name)
    {
        $this->group_name = $group_name;
    }

    public function getId_boss()
    {
        return $this->id_boss;
    }

    public function setId_boss($id_boss)
    {
        $this->id_boss = $id_boss;
    }


    public function getStart_date()
    {
        return $this->start_date;
    }

    public function setStart_date($start_date)
    {
        $this->start_date = $start_date;
    }

    public function getEnd_date()
    {
        return $this->end_date;
    }

    public function setEnd_date($end_date)
    {
        $this->end_date = $end_date;
    }
    public function getId_contact()
    {
        return $this->id_contact;
    }

    public function setId_contact($id_contact)
    {
        $this->id_contact = $id_contact;
    }
    public function getModified_at()
    {
        return $this->modified_at;
    }

    public function setModified_at($modified_at)
    {
        $this->modified_at = $modified_at;
    }


    //===[gabo 6 junio evaluaciones]===
    public function getID_Cliente()
    {
        return $this->ID_Cliente;
    }

    public function setID_Cliente($ID_Cliente)
    {
        $this->ID_Cliente = $ID_Cliente;
    }


    public function getAllGroupsEvaluationBIdCliente($condicion)
    {
        $stmt = $this->db->prepare("SELECT ge.id_group, ge.group_name as name, ge.created_at, ee.id_evaluation, ge.id_boss, ge.start_date, ge.end_date,ev.level,CONCAT(e.first_name,' ',e.surname,' ',e.last_name) fullNameBoss,p.title FROM  root.groups_evaluation ge  LEFT JOIN root.evaluation_employee ee ON ge.id_group=ee.id_group_evaluation INNER JOIN root.evaluations ev  ON ev.id=ee.id_evaluation  INNER JOIN root.employees e ON ge.id_boss=e.id   INNER JOIN root.positions p ON e.id_position=p.id
        WHERE " . $condicion . "
        GROUP BY ge.ID_Cliente, ge.group_name,ge.created_at, ge.id_boss, ee.id_evaluation,e.first_name, e.surname, e.last_name, ev.name, ge.start_date, ge.end_date,ev.level,ge.id_group,p.title ORDER BY ge.created_at DESC, ev.name");

        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    //===[gabo 6 junio evaluaciones fin]===

   //===[gabo 9 junio excel evaluaciones]===
   public function getAllGroupsEvaluationBIdBoss()
   {
       $id_contact = $this->getId_contact();

       $stmt = $this->db->prepare("SELECT ge.id_group, ge.group_name as name, ge.created_at, ee.id_evaluation, ge.id_boss, ge.start_date, ge.end_date,ev.level,CONCAT(e.first_name,' ',e.surname,' ',e.last_name) fullNameBoss,p.title FROM  root.groups_evaluation ge  LEFT JOIN root.evaluation_employee ee ON ge.id_group=ee.id_group_evaluation INNER JOIN root.evaluations ev  ON ev.id=ee.id_evaluation  INNER JOIN root.employees e ON ge.id_boss=e.id   INNER JOIN root.positions p ON e.id_position=p.id
       WHERE ge.ID_Cliente in  (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:id_contact)
       GROUP BY ge.group_name,ge.created_at, ge.id_boss, ee.id_evaluation,e.first_name, e.surname, e.last_name, ev.name, ge.start_date, ge.end_date,ev.level,ge.id_group,p.title ORDER BY ge.created_at DESC, ev.name");

       $stmt->bindParam(":id_contact", $id_contact, PDO::PARAM_INT);
       $stmt->execute();
       $fetch =  $stmt->fetchAll();
       return $fetch;
   }
   //===[gabo 9 junio excel evaluaciones fin]===

    public function getOne()
    {
        $id_group = $this->getId_group();
        $stmt = $this->db->prepare("SELECT * FROM root.groups_evaluation WHERE id_group=:id_group");
        $stmt->bindParam(":id_group", $id_group, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }


    //===[gabo 6 junio evaluaciones]===
    public function save()
    {
        $result = false;

        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $id_boss = $this->getId_boss();
        $group_name = $this->getGroup_name();
        $id_contact = $this->getId_contact();
        $id_cliente = $this->getID_Cliente();
        $stmt = $this->db->prepare("INSERT INTO root.groups_evaluation (group_name, start_date,end_date,id_boss,id_contact,ID_Cliente) VALUES (:group_name,:start_date,:end_date,:id_boss,:id_contact,:id_cliente)");

        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_STR);
        $stmt->bindParam(":group_name", $group_name, PDO::PARAM_STR);
        $stmt->bindParam(":id_contact", $id_contact, PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId_group($this->db->lastInsertId());
        }

        return $result;
    }
    //===[gabo 6 junio evaluaciones fin]===




    public function delete()
    {
        $id_group = $this->getId_group();
        $stmt = $this->db->prepare("DELETE root.groups_evaluation WHERE id_group=:id_group");
        $stmt->bindParam(":id_group", $id_group, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        return $fetch;
    }


    public function getEvaluationsByIdGroup()
    {
        $id_group = $this->getId_group();

        $stmt = $this->db->prepare("SELECT ee.id_boss,ee.id, ev.name, e.first_name, e.surname, e.last_name, p.title, d.department,  eb.first_name AS first_name_boss, eb.surname AS surname_boss, eb.last_name AS last_name_boss, ge.start_date, ge.end_date, ee.status, ee.date_of_realization, ee.created_at
        FROM root.evaluation_employee ee LEFT JOIN root.evaluations ev ON ee.id_evaluation=ev.id LEFT JOIN root.employees e ON ee.id_employee=e.id LEFT JOIN root.positions p ON e.id_position=p.id LEFT JOIN root.department d ON p.id_department=d.id
         LEFT JOIN root.groups_evaluation ge ON ge.id_group=ee.id_group_evaluation LEFT JOIN root.employees eb ON ee.id_boss=eb.id
        WHERE ee.id_group_evaluation=:id_group  ORDER BY ee.created_at, ev.name");

        $stmt->bindParam(":id_group", $id_group, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }



    // ===[gabo 23 de mayo agrupar]===
    public function obtieneGruposPorFecha()
    {
        $stmt = $this->db->prepare(" SELECT start_date,end_date from  root.evaluation_employee   group by start_date,end_date ");
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    // ===[gabo 23 de mayo fin agrupar]===
	    public function getAllGroupsEvaluationByID_Cliente()
    {
        $ID_Cliente = $this->getID_Cliente();

        $stmt = $this->db->prepare("SELECT ge.id_group, ge.group_name as name, ge.created_at, ee.id_evaluation, ge.id_boss, ge.start_date, ge.end_date,ev.level,CONCAT(e.first_name,' ',e.surname,' ',e.last_name) fullNameBoss,p.title FROM  root.groups_evaluation ge  LEFT JOIN root.evaluation_employee ee ON ge.id_group=ee.id_group_evaluation INNER JOIN root.evaluations ev  ON ev.id=ee.id_evaluation  INNER JOIN root.employees e ON ge.id_boss=e.id   INNER JOIN root.positions p ON e.id_position=p.id
          WHERE ge.ID_Cliente =:ID_Cliente
          GROUP BY ge.group_name,ge.created_at, ge.id_boss, ee.id_evaluation,e.first_name, e.surname, e.last_name, ev.name, ge.start_date, ge.end_date,ev.level,ge.id_group,p.title ORDER BY ge.created_at DESC, ev.name");

        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
}
