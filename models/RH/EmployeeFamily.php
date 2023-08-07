<?php

class EmployeeFamily
{
    private $id;
    private $id_employee;
    private $name;
    private $age;
    private $type;
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

    public function getId_employee()
    {
        return $this->id_employee;
    }

    public function setId_employee($id_employee)
    {
        $this->id_employee = $id_employee;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
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


    public function save()
    {
        $result = false;

        $id_employee = $this->getId_employee();
        $name = $this->getName();
        $type = $this->getType();
        $age = $this->getAge();
        $stmt = $this->db->prepare("INSERT INTO root.employee_family (id_employee, name, type,age, created_at, modified_at) VALUES (:id_employee, :name, :type,:age, GETDATE(), GETDATE())");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);
        $stmt->bindParam(":age", $age, PDO::PARAM_INT);
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
        $stmt = $this->db->prepare("SELECT * FROM root.employee_family WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAllByIdEmployee()
    {
        $id_employee = $this->getId_employee();
        $stmt = $this->db->prepare("SELECT * FROM root.employee_family WHERE id_employee=:id_employee");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function delete()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("DELETE root.employee_family WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        return $fetch;
    }


    public function update()
    {
        $id = $this->getId();
        $name = $this->getName();
        $type = $this->getType();
        $age = $this->getAge();

        $stmt = $this->db->prepare("UPDATE root.employee_family SET name=:name,type=:type,age=:age,modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_INT);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);
        $stmt->bindParam(":age", $age, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        return $fetch;
    }
}
