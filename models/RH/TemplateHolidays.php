<?php

class TemplateHolidays
{
    private $id;
    private $name;
    private $cliente;
    private $empresa;
    private $status;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
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



    //gabo 31 oct
    public function getAllByClient()
    {
        $cliente = $this->getCliente();
        $stmt = $this->db->prepare(" SELECT th.*,(select  COUNT( id )from rrhhinge_Candidatos.root.employee_holidays where id_template=th.id) as usado FROM template_holidays  th WHERE cliente=:cliente  and th.status<>2 order by id desc");
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $name = $this->getName();
        $cliente = $this->getCliente();
        $empresa = $this->getEmpresa();
        $status = $this->getStatus();


        $stmt = $this->db->prepare("INSERT INTO template_holidays (name, cliente, empresa,status,created_at) VALUES (:name, :cliente, :empresa,:status,GETDATE() )");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $stmt->bindParam(":empresa", $empresa, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }

        return $result;
    }

    public function getOne()
    {
        $id = $this->getId();

        $stmt = $this->db->prepare("SELECT * FROM template_holidays WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }


    public function update()
    {
        $id = $this->getId();
        $name = $this->getName();
        $cliente = $this->getCliente();
        $empresa = $this->getEmpresa();
        $status = $this->getStatus();


        $stmt = $this->db->prepare("UPDATE root.holidays_by_years SET  name:name, cliente:cliente, empresa:empresa,status:status, , modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_INT);
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_STR);
        $stmt->bindParam(":empresa", $empresa, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag)
            $result = true;

        return $result;
    }


    public function getAllHolidays()
    {
        $cliente = $this->getCliente();

        $stmt = $this->db->prepare("SELECT h.* FROM holidays h LEFT JOIN  template_holidays th  on h.id_template=th.id where th.cliente=:cliente  and h.status=1 order by h.id desc");
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
    public function getActivatedTemplate()
    {
        $cliente = $this->getCliente();

        $stmt = $this->db->prepare("SELECT * from template_holidays where cliente=:cliente  and  status=1 ");
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }


    public function update_status()
    {
        $result = false;
        $status = $this->getStatus();
        $id = $this->getId();

        $stmt = $this->db->prepare("UPDATE template_holidays set status=:status where id=:id ");
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();
        if ($flag)
            $result = true;

        return $result;
    }


    public function getLastHolidays()
    {
        $cliente = $this->getCliente();

        $stmt = $this->db->prepare("SELECT * from holidays where id_template in (SELECT TOP (1) id from template_holidays  where cliente=:cliente and  status <> 2 order by  id desc) order by id asc");
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


    //gabo 31 oct
    public function getStatusTemplate()
    {
        $result = false;
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * from template_holidays where id=:id  and  status=1 ");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $flag = $stmt->fetchObject();
        if ($flag)
            $result = true;

        return $result;
    }
}
