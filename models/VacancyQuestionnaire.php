<?php

class VacancyQuestionnaire{
    private $id;
    private $how_many_interviews;
    private $accept_reentry;
    private $offer_transportation;
    private $do_medical_exam;
    private $time_without_filling;
    private $another_agency;
    private $id_vacancy;

    private $db;

    public function __construct(){
        $this->db = Connection::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getHow_many_interviews(){
        return $this->how_many_interviews;
    }

    public function setHow_many_interviews($how_many_interviews){
        $this->how_many_interviews = $how_many_interviews;
    }

    public function getAccept_reentry(){
        return $this->accept_reentry;
    }

    public function setAccept_reentry($accept_reentry){
        $this->accept_reentry = $accept_reentry;
    }

    public function getOffer_transportation(){
        return $this->offer_transportation;
    }

    public function setOffer_transportation($offer_transportation){
        $this->offer_transportation = $offer_transportation;
    }

    public function getDo_medical_exam(){
        return $this->do_medical_exam;
    }

    public function setDo_medical_exam($do_medical_exam){
        $this->do_medical_exam = $do_medical_exam;
    }

    public function getTime_without_filling(){
        return $this->time_without_filling;
    }

    public function setTime_without_filling($time_without_filling){
        $this->time_without_filling = $time_without_filling;
    }

    public function getAnother_agency(){
        return $this->another_agency;
    }

    public function setAnother_agency($another_agency){
        $this->another_agency = $another_agency;
    }

    public function getId_vacancy(){
        return $this->id_vacancy;
    }

    public function setId_vacancy($id_vacancy){
        $this->id_vacancy = $id_vacancy;
    }

    public function save(){
        $result = false;

        $id_vacancy = $this->getId_vacancy();
        $how_many_interviews = $this->getHow_many_interviews();
        $accept_reentry = $this->getAccept_reentry();
        $offer_transportation = $this->getOffer_transportation();
        $do_medical_exam = $this->getDo_medical_exam();
        $time_without_filling = $this->getTime_without_filling();
        $another_agency = $this->getAnother_agency();

        $stmt = $this->db->prepare("INSERT INTO vacancy_questionnaire(id_vacancy, how_many_interviews, accept_reentry, offer_transportation, do_medical_exam, time_without_filling, another_agency) VALUES (:id_vacancy, :how_many_interviews, :accept_reentry, :offer_transportation, :do_medical_exam, :time_without_filling, :another_agency);");
        $stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
        $stmt->bindParam(":how_many_interviews", $how_many_interviews, PDO::PARAM_INT);
        $stmt->bindParam(":accept_reentry", $accept_reentry, PDO::PARAM_INT);
        $stmt->bindParam(":offer_transportation", $offer_transportation, PDO::PARAM_INT);
        $stmt->bindParam(":do_medical_exam", $do_medical_exam, PDO::PARAM_INT);
        $stmt->bindParam(":time_without_filling", $time_without_filling, PDO::PARAM_STR);
        $stmt->bindParam(":another_agency", $another_agency, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function update(){
        $result = false;

        $id_vacancy = $this->getId_vacancy();
        $how_many_interviews = $this->getHow_many_interviews();
        $accept_reentry = $this->getAccept_reentry();
        $offer_transportation = $this->getOffer_transportation();
        $do_medical_exam = $this->getDo_medical_exam();
        $time_without_filling = $this->getTime_without_filling();
        $another_agency = $this->getAnother_agency();

        $stmt = $this->db->prepare("UPDATE vacancy_questionnaire SET how_many_interviews=:how_many_interviews, accept_reentry=:accept_reentry, offer_transportation=:offer_transportation, do_medical_exam=:do_medical_exam, time_without_filling=:time_without_filling, another_agency=:another_agency WHERE id_vacancy=:id_vacancy");
        $stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
        $stmt->bindParam(":how_many_interviews", $how_many_interviews, PDO::PARAM_INT);
        $stmt->bindParam(":accept_reentry", $accept_reentry, PDO::PARAM_INT);
        $stmt->bindParam(":offer_transportation", $offer_transportation, PDO::PARAM_INT);
        $stmt->bindParam(":do_medical_exam", $do_medical_exam, PDO::PARAM_INT);
        $stmt->bindParam(":time_without_filling", $time_without_filling, PDO::PARAM_STR);
        $stmt->bindParam(":another_agency", $another_agency, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
    
    public function duplicate() {
        
        $result = false;

        $id_vacancy = $this->getId_vacancy();
        $id = $this->getId();
        
        $stmt = $this->db->prepare("INSERT INTO vacancy_questionnaire(how_many_interviews, accept_reentry, offer_transportation, do_medical_exam, time_without_filling, another_agency, id_vacancy) SELECT how_many_interviews, accept_reentry, offer_transportation, do_medical_exam, time_without_filling, another_agency, :id_vacancy FROM vacancy_questionnaire WHERE id_vacancy=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        
        return $result;
    }
}