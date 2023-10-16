<?php

class ApplicantProfile
{

    private $id;
    private $gender;
    private $status_gender;
    private $age;
    private $status_age;
    private $civil_status;
    private $status_civil_status;
    private $level;
    private $status_level;
    private $language;
    private $status_language;
    private $language_level;
    private $status_language_level;
    private $functions;
    private $experience_years;
    private $status_experience_years;
    private $created_at;
    private $modified_at;
    //gabo mod
    private $experiencia_comments;
    private $functions_comments;
    private $status_functions;
    private $general_comments;




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

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getStatus_gender()
    {
        return $this->status_gender;
    }

    public function setStatus_gender($status_gender)
    {
        $this->status_gender = $status_gender;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getStatus_age()
    {
        return $this->status_age;
    }

    public function setStatus_age($status_age)
    {
        $this->status_age = $status_age;
    }

    public function getCivil_status()
    {
        return $this->civil_status;
    }

    public function setCivil_status($civil_status)
    {
        $this->civil_status = $civil_status;
    }

    public function getStatus_civil_status()
    {
        return $this->status_civil_status;
    }

    public function setStatus_civil_status($status_civil_status)
    {
        $this->status_civil_status = $status_civil_status;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getStatus_level()
    {
        return $this->status_level;
    }

    public function setStatus_level($status_level)
    {
        $this->status_level = $status_level;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getStatus_language()
    {
        return $this->status_language;
    }

    public function setStatus_language($status_language)
    {
        $this->status_language = $status_language;
    }

    public function getLanguage_level()
    {
        return $this->language_level;
    }

    public function setLanguage_level($language_level)
    {
        $this->language_level = $language_level;
    }

    public function getStatus_language_level()
    {
        return $this->status_language_level;
    }

    public function setStatus_language_level($status_language_level)
    {
        $this->status_language_level = $status_language_level;
    }


    public function getFunctions()
    {
        return $this->functions;
    }

    public function setFunctions($functions)
    {
        $this->functions = $functions;
    }

    public function getExperience_years()
    {
        return $this->experience_years;
    }

    public function setExperience_years($experience_years)
    {
        $this->experience_years = $experience_years;
    }

    public function getStatus_experience_years()
    {
        return $this->status_experience_years;
    }

    public function setStatus_experience_years($status_experience_years)
    {
        $this->status_experience_years = $status_experience_years;
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



    // gabo mod

    public function getGeneral_comments()
    {
        return $this->general_comments;
    }

    public function setGeneral_comments($general_comments)
    {
        $this->general_comments = $general_comments;
    }


    public function getStatus_functions()
    {
        return $this->status_functions;
    }

    public function setStatus_functions($status_functions)
    {
        $this->status_functions = $status_functions;
    }


    public function getFunctions_comments()
    {
        return $this->functions_comments;
    }

    public function setFunctions_comments($functions_comments)
    {
        $this->functions_comments = $functions_comments;
    }



    public function getExperiencia_comments()
    {
        return $this->experiencia_comments;
    }

    public function setExperiencia_comments($experiencia_comments)
    {
        $this->experiencia_comments = $experiencia_comments;
    }






    public function getALL()
    {

        $stmt = $this->db->prepare("SELECT * FROM root.vacancy_applicant_profile  ");
        $stmt->execute();

        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getOne()
    {
        $id = $this->getId();

        $stmt = $this->db->prepare("SELECT * FROM root.vacancy_applicant_profile  WHERE id=:id ");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }


    public function save()
    {

        $result = false;

        $gender = $this->getGender();
        $status_gender = $this->getStatus_gender();
        $age = $this->getAge();
        $status_age = $this->getStatus_age();
        $civil_status = $this->getCivil_status();
        $status_civil_status = $this->getStatus_civil_status();
        $level = $this->getLevel();
        $status_level = $this->getStatus_level();
        $language = $this->getLanguage();
        $status_language = $this->getStatus_language();
        $language_level = $this->getLanguage_level();
        $status_language_level = $this->getStatus_language_level();
        $experience_years = $this->getExperience_years();
        $functions = $this->getFunctions();
        $status_experience_years = $this->getStatus_experience_years();



        // gabo mod
        $general_comments = $this->getGeneral_comments();
        $status_functions = $this->getStatus_functions();
        $functions_comments = $this->getFunctions_comments();
        $experiencia_comments = $this->getExperiencia_comments();

        //gabo maod
        $stmt = $this->db->prepare("INSERT INTO root.vacancy_applicant_profile ( gender, status_gender,age,status_age,civil_status,status_civil_status, level,status_level,language,status_language,language_level,status_language_level,functions,experience_years,status_experience_years,general_comments,status_functions ,functions_comments,experiencia_comments,created_at) 
    VALUES (:gender, :status_gender, :age, :status_age, :civil_status, :status_civil_status, :level, :status_level, :language, :status_language, :language_level, :status_language_level, :functions, :experience_years, :status_experience_years,  :general_comments, :status_functions ,:functions_comments,:experiencia_comments   , GETDATE())");
        $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
        $stmt->bindParam(":status_gender", $status_gender, PDO::PARAM_STR);
        $stmt->bindParam(":age", $age, PDO::PARAM_INT);
        $stmt->bindParam(":status_age", $status_age, PDO::PARAM_STR);
        $stmt->bindParam(":civil_status", $civil_status, PDO::PARAM_STR);
        $stmt->bindParam(":status_civil_status", $status_civil_status, PDO::PARAM_STR);
        $stmt->bindParam(":level", $level, PDO::PARAM_STR);
        $stmt->bindParam(":status_level", $status_level, PDO::PARAM_STR);
        $stmt->bindParam(":language", $language, PDO::PARAM_STR);
        $stmt->bindParam(":status_language", $status_language, PDO::PARAM_STR);
        $stmt->bindParam(":language_level", $language_level, PDO::PARAM_STR);
        $stmt->bindParam(":status_language_level", $status_language_level, PDO::PARAM_STR);
        //$stmt->bindParam(":requirements", $requirements, PDO::PARAM_STR);
        $stmt->bindParam(":experience_years", $experience_years, PDO::PARAM_INT);
        $stmt->bindParam(":functions", $functions, PDO::PARAM_STR);
        $stmt->bindParam(":status_experience_years", $status_experience_years, PDO::PARAM_STR);
        $stmt->bindParam(":status_experience_years", $status_experience_years, PDO::PARAM_STR);

        // gabo mod
        $stmt->bindParam(":general_comments", $general_comments, PDO::PARAM_STR);
        $stmt->bindParam(":status_functions", $status_functions, PDO::PARAM_STR);
        $stmt->bindParam(":functions_comments", $functions_comments, PDO::PARAM_STR);
        $stmt->bindParam(":experiencia_comments", $experiencia_comments, PDO::PARAM_STR);



        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }

        return $result;
    }

    public function update_profile()
    {

        $result = false;

        $id = $this->getId();
        $gender = $this->getGender();
        $status_gender = $this->getStatus_gender();
        $age = $this->getAge();
        $status_age = $this->getStatus_age();
        $civil_status = $this->getCivil_status();
        $status_civil_status = $this->getStatus_civil_status();
        $level = $this->getLevel();
        $status_level = $this->getStatus_level();
        $language = $this->getLanguage();
        $status_language = $this->getStatus_language();
        $language_level = $this->getLanguage_level();
        $status_language_level = $this->getStatus_language_level();
        // $requirements = $this->getRequirements();
        $experience_years = $this->getExperience_years();
        $functions = $this->getFunctions();
        $status_experience_years = $this->getStatus_experience_years();


        // gabo mod
        $general_comments = $this->getGeneral_comments();
        $status_functions = $this->getStatus_functions();
        $functions_comments = $this->getFunctions_comments();
        $experiencia_comments = $this->getExperiencia_comments();




        //gabomod
        $stmt = $this->db->prepare("UPDATE TOP(1) root.vacancy_applicant_profile SET  gender=:gender, status_gender=:status_gender,age=:age,status_age=:status_age,civil_status=:civil_status,status_civil_status=:status_civil_status, level=:level,status_level=:status_level    
        ,language=:language,status_language=:status_language ,language_level=:language_level , status_language_level=:status_language_level,experience_years=:experience_years,functions=:functions,status_experience_years=:status_experience_years , general_comments= :general_comments, status_functions= :status_functions , functions_comments=:functions_comments, experiencia_comments=:experiencia_comments   ,modified_at=GETDATE()  WHERE id=:id ");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
        $stmt->bindParam(":status_gender", $status_gender, PDO::PARAM_STR);
        $stmt->bindParam(":age", $age, PDO::PARAM_STR);
        $stmt->bindParam(":status_age", $status_age, PDO::PARAM_STR);
        $stmt->bindParam(":civil_status", $civil_status, PDO::PARAM_STR);
        $stmt->bindParam(":status_civil_status", $status_civil_status, PDO::PARAM_STR);
        $stmt->bindParam(":level", $level, PDO::PARAM_STR);
        $stmt->bindParam(":status_level", $status_level, PDO::PARAM_STR);
        $stmt->bindParam(":language", $language, PDO::PARAM_STR);
        $stmt->bindParam(":status_language", $status_language, PDO::PARAM_STR);
        $stmt->bindParam(":language_level", $language_level, PDO::PARAM_STR);
        $stmt->bindParam(":status_language_level", $status_language_level, PDO::PARAM_STR);
        // $stmt->bindParam(":requirements", $requirements, PDO::PARAM_STR);
        $stmt->bindParam(":experience_years", $experience_years, PDO::PARAM_STR);
        $stmt->bindParam(":functions", $functions, PDO::PARAM_STR);
        $stmt->bindParam(":status_experience_years", $status_experience_years, PDO::PARAM_STR);

        // gabo mod
        $stmt->bindParam(":general_comments", $general_comments, PDO::PARAM_STR);
        $stmt->bindParam(":status_functions", $status_functions, PDO::PARAM_STR);
        $stmt->bindParam(":functions_comments", $functions_comments, PDO::PARAM_STR);
        $stmt->bindParam(":experiencia_comments", $experiencia_comments, PDO::PARAM_STR);


        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }

        return $result;
    }
	
	
	
    public function delete()
    {
        $result = false;
        $id = $this->getId();

        $stmt = $this->db->prepare("DELETE FROM root.vacancy_applicant_profile WHERE id=:id ");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
	
	
}
