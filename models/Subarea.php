<?php

class Subarea
{
    private $id;
    private $subarea;
    private $id_area;

    private $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSubarea()
    {
        return $this->subarea;
    }

    public function setSubarea($subarea)
    {
        $this->subarea = $subarea;
    }

    public function getId_area()
    {
        return $this->id_area;
    }

    public function setId_area($id_area)
    {
        $this->id_area = $id_area;
    }
    //===[gabo 28 julio modulo areas]===
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM subareas WHERE status=1 ORDER BY id_area ASC;");
        $stmt->execute();
        $subareas = $stmt->fetchAll();
        return $subareas;
    }

    public function getSubareasBySubarea()
    {
        $result = false;

        $subarea = $this->getSubarea();
        $id_area = $this->getId_area();
        $stmt = $this->db->prepare("SELECT * FROM areas INNER JOIN subareas ON areas.id = subareas.id_area WHERE areas.id = :id_area AND subareas.subarea LIKE :subarea ");

        $stmt->bindParam(":subarea", $subarea, PDO::PARAM_STR);
        $stmt->bindParam(":id_area", $id_area, PDO::PARAM_INT);

        $flag = $stmt->execute();
        $subarea = $stmt->fetchObject();

        return $subarea;
    }

    public function getSubareasByArea()
    {
        $area = $this->getId_area();
        $stmt = $this->db->prepare("SELECT * FROM subareas WHERE id_area=:id_area AND status=1 ORDER BY id DESC;");
        $stmt->bindParam(":id_area", $area, PDO::PARAM_INT);
        $stmt->execute();
        $areasComp = $stmt->fetchAll();
        return $areasComp;
    }
    //===[gabo 28 julio modulo areas fin]===
    public function getAVacancyCountBySubarea()
    {
        $stmt = $this->db->prepare("SELECT sa.id, sa.subarea, COUNT(sa.id) AS total FROM vacancies v INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE v.id_status < 5 GROUP BY sa.id, sa.subarea ORDER BY total DESC, sa.subarea");
        $stmt->execute();
        $areas = $stmt->fetchAll();
        return $areas;
    }

    public function save()
    {
        $result = false;

        $Subarea = $this->getSubarea();
        $id_area = $this->getId_area();

        $stmt = $this->db->prepare("INSERT INTO subareas(subarea,id_area) VALUES (:Subarea,:id_area)");

        $stmt->bindParam(":Subarea", $Subarea, PDO::PARAM_STR);
        $stmt->bindParam(":id_area", $id_area, PDO::PARAM_STR);

        $flag = $stmt->execute();

        return $flag;
    }

    //=== [ gabo  31 julio modulo areas]===
    public function HideSubarea()
    {
        $id_subarea = $this->getId();

        $stmt = $this->db->prepare("UPDATE subareas set status=0 where id=:id_subarea");
        $stmt->bindParam(":id_subarea", $id_subarea, PDO::PARAM_INT);
        $result = $stmt->execute();
        return $result;
    }

    public function getOne()
    {

        $id_subarea = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM subareas where id=:id_subarea");
        $stmt->bindParam(":id_subarea", $id_subarea, PDO::PARAM_STR);
        $flag = $stmt->execute();
        $subarea = $stmt->fetchObject();

        return $subarea;
    }

    public function validarSubarea()
    {

        $id_area = $this->getId_area();
        $subarea = $this->getSubarea();
        $stmt = $this->db->prepare("SELECT * FROM subareas where id_area=:id_area AND subarea LIKE :subarea");
        $stmt->bindParam(":id_area", $id_area, PDO::PARAM_INT);
        $stmt->bindParam(":subarea", $subarea, PDO::PARAM_STR);
        $flag = $stmt->execute();
        $subarea = $stmt->fetchObject();
        return $subarea;
    }


    //=== [ gabo  31 julio modulo areas]===
}
