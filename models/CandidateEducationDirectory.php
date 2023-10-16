<?php

class CandidateEducationDirectory
{
    private $id;
    private $title;
    private $institution;
    private $start_date;
    private $end_date;
    private $still_studies;
    private $id_level;
    private $id_document;
    private $id_directory;

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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getInstitution()
    {
        return $this->institution;
    }

    public function setInstitution($institution)
    {
        $this->institution = $institution;
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

    public function getStill_studies()
    {
        return $this->still_studies;
    }

    public function setStill_studies($still_studies)
    {
        $this->still_studies = $still_studies;
    }

    public function getId_level()
    {
        return $this->id_level;
    }

    public function setId_level($id_level)
    {
        $this->id_level = $id_level;
    }

    public function getId_document()
    {
        return $this->id_document;
    }

    public function setId_document($id_document)
    {
        $this->id_document = $id_document;
    }

    public function getId_directory()
    {
        return $this->id_directory;
    }

    public function setId_directory($id_directory)
    {
        $this->id_directory = $id_directory;
    }

    public function save()
    {
        $result = false;

        $id_directory = $this->getId_directory();
        $title = $this->getTitle();
        $institution = $this->getInstitution();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $still_studies = $this->getStill_studies();
        $id_level = $this->getId_level();
        //$id_document = $this->getId_document();

        $stmt = $this->db->prepare("INSERT INTO candidate_education_directory(id_directory, title, institution, start_date, end_date, still_studies, id_level) VALUES (:id_directory, :title, :institution, :start_date, :end_date, :still_studies, :id_level)");
        $stmt->bindParam(":id_directory", $id_directory, PDO::PARAM_INT);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":still_studies", $still_studies, PDO::PARAM_STR);
        $stmt->bindParam(":id_level", $id_level, PDO::PARAM_INT);
        //$stmt->bindParam(":id_document", $id_document, PDO::PARAM_INT);

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

        $id_directory = $this->getId_directory();
        $title = $this->getTitle();
        $institution = $this->getInstitution();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $still_studies = $this->getStill_studies();
        $id_level = $this->getId_level();
        //$id_document = $this->getId_document();

        $stmt = $this->db->prepare("UPDATE candidate_education_directory SET title=:title, institution=:institution, start_date=:start_date, end_date=:end_date, still_studies=:still_studies, id_level=:id_level WHERE id_directory=:id_directory");
        $stmt->bindParam(":id_directory", $id_directory, PDO::PARAM_INT);
        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":institution", $institution, PDO::PARAM_STR);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":still_studies", $still_studies, PDO::PARAM_STR);
        $stmt->bindParam(":id_level", $id_level, PDO::PARAM_INT);
        //$stmt->bindParam(":id_document", $id_document, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateLevel()
    {
        $result = false;

        $id_directory = $this->getId_directory();
        $id_level = $this->getId_level();

        $stmt = $this->db->prepare("UPDATE candidate_education_directory SET id_level=:id_level WHERE id_directory=:id_directory");
        $stmt->bindParam(":id_directory", $id_directory, PDO::PARAM_INT);
        $stmt->bindParam(":id_level", $id_level, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function getOne()
    {
        $id = $this->getId_directory();
        $stmt = $this->db->prepare("SELECT ce.*, ce.id_level AS id_education_level FROM candidate_education_directory ce  LEFT JOIN education_levels el ON ce.id_level=el.id WHERE ce.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    public function getOneById_Directory()
    {
        $id_directory = $this->getId_directory();
        $stmt = $this->db->prepare("SELECT ce.*, ce.id_level AS id_education_level FROM candidate_education_directory ce  LEFT JOIN education_levels el ON ce.id_level=el.id WHERE ce.id_directory=:id_directory");
        $stmt->bindParam(":id_directory", $id_directory, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }
}
