<?php

class Holidays
{
    private $id;
    private $name;
    private $holiday;
    private $status;
    private $id_template;
    private $created_at;
    private $modified_at;
    private $day;
    private $month;


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

    public function getHoliday()
    {
        return $this->holiday;
    }

    public function setHoliday($holiday)
    {
        $this->holiday = $holiday;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getId_template()
    {
        return $this->id_template;
    }

    public function setId_template($id_template)
    {
        $this->id_template = $id_template;
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

    public function getDay()
    {
        return $this->day;
    }

    public function setDay($day)
    {
        $this->day = $day;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function setMonth($month)
    {
        $this->month = $month;
    }

    public function getOne()
    {
        $id = $this->getId();

        $stmt = $this->db->prepare("SELECT * FROM root.holidays WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }


    public function save()
    {
        $name = $this->getName();
        //$holiday = $this->getHoliday();
        $day = $this->getDay();
        $month = $this->getMonth();

        $id_template = $this->getId_template();
        $status = $this->getStatus();


        $stmt = $this->db->prepare("INSERT INTO root.holidays (name, day,month, id_template,status,created_at) VALUES (:name, :day,:month, :id_template,:status,GETDATE())");
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        //$stmt->bindParam(":holiday", $holiday, PDO::PARAM_STR);
        $stmt->bindParam(":day", $day, PDO::PARAM_STR);
        $stmt->bindParam(":month", $month, PDO::PARAM_STR);
        $stmt->bindParam(":id_template", $id_template, PDO::PARAM_INT);
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
        $name = $this->getName();
        $id = $this->getId();
        $day = $this->getDay();
        $month = $this->getMonth();

        $stmt = $this->db->prepare("UPDATE root.holidays  SET  name=:name, day=:day,month=:month,modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":name", $name, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":day", $day, PDO::PARAM_INT);
        $stmt->bindParam(":month", $month, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag)
            $result = true;

        return $result;
    }


    public function getAllByIdTemplate()
    {
        $id_template = $this->getId_template();

        $stmt = $this->db->prepare("SELECT * FROM root.holidays WHERE id_template=:id_template and status=1 order by id desc");
        $stmt->bindParam(":id_template", $id_template, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }



    public function delete_holiday()
    {
        $id = $this->getId();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("UPDATE root.holidays SET status=:status, modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag)
            $result = true;

        return $result;
    }
}
