<?php

class Vacancy
{

    private $id;
    private $vacancy;
    private $request_date;
    private $business_name;
    private $department;
    private $report_to;
    private $personal_in_charge;
    private $id_education_level;
    private $position_number;
    private $experience_years;
    private $experience;
    private $age_min;
    private $age_max;
    private $id_gender;
    private $id_civil_status;
    private $id_language;
    private $id_language_level;
    private $salary_min;
    private $salary_max;
    private $benefits;
    private $workdays;
    private $schedule;
    private $requirements;
    private $functions;
    private $skills;
    private $technical_knowledge;
    private $id_customer;
    private $id_customer_contact;
    private $id_state;
    private $id_city;
    private $created_by;
    private $end_date;
    private $id_status;
    private $created_at;
    private $modified_at;
    private $id_recruiter;
    private $id_area;
    private $id_subarea;
    private $send_date;
    private $interview_date;
    private $follow_up_date;
    private $cancellation_date;
    private $standby_date;
    private $comments;
    private $time;
    private $type;
    private $warranty_time;
    private $amount_to_invoice;
    private $authorization_date;
    private $commitment_date;
    private $send_date_candidate;
    private $advance_payment;
    private $payment_amount;
    private $working_day;
    private $experience_type;
    private $recruitment_service_cost;
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

    public function getVacancy()
    {
        return $this->vacancy;
    }

    public function setVacancy($vacancy)
    {
        $this->vacancy = $vacancy;
    }

    public function getRequest_date()
    {
        return $this->request_date;
    }

    public function setRequest_date($request_date)
    {
        $this->request_date = $request_date;
    }

    public function getBusiness_name()
    {
        return $this->business_name;
    }

    public function setBusiness_name($business_name)
    {
        $this->business_name = $business_name;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
    }

    public function getReport_to()
    {
        return $this->report_to;
    }

    public function setReport_to($report_to)
    {
        $this->report_to = $report_to;
    }

    public function getPersonal_in_charge()
    {
        return $this->personal_in_charge;
    }

    public function setPersonal_in_charge($personal_in_charge)
    {
        $this->personal_in_charge = $personal_in_charge;
    }

    public function getId_education_level()
    {
        return $this->id_education_level;
    }

    public function setId_education_level($id_education_level)
    {
        $this->id_education_level = $id_education_level;
    }

    public function getPosition_number()
    {
        return $this->position_number;
    }

    public function setPosition_number($position_number)
    {
        $this->position_number = $position_number;
    }

    public function getExperience_years()
    {
        return $this->experience_years;
    }

    public function setExperience_years($experience_years)
    {
        $this->experience_years = $experience_years;
    }

    public function getExperience()
    {
        return $this->experience;
    }

    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    public function getAge_min()
    {
        return $this->age_min;
    }

    public function setAge_min($age_min)
    {
        $this->age_min = $age_min;
    }

    public function getAge_max()
    {
        return $this->age_max;
    }

    public function setAge_max($age_max)
    {
        $this->age_max = $age_max;
    }

    public function getId_gender()
    {
        return $this->id_gender;
    }

    public function setId_gender($id_gender)
    {
        $this->id_gender = $id_gender;
    }

    public function getId_civil_status()
    {
        return $this->id_civil_status;
    }

    public function setId_civil_status($id_civil_status)
    {
        $this->id_civil_status = $id_civil_status;
    }

    public function getId_language()
    {
        return $this->id_language;
    }

    public function setId_language($id_language)
    {
        $this->id_language = $id_language;
    }

    public function getId_language_level()
    {
        return $this->id_language_level;
    }

    public function setId_language_level($id_language_level)
    {
        $this->id_language_level = $id_language_level;
    }

    public function getSalary_min()
    {
        return $this->salary_min;
    }

    public function setSalary_min($salary_min)
    {
        $this->salary_min = $salary_min;
    }

    public function getSalary_max()
    {
        return $this->salary_max;
    }

    public function setSalary_max($salary_max)
    {
        $this->salary_max = $salary_max;
    }

    public function getBenefits()
    {
        return $this->benefits;
    }

    public function setBenefits($benefits)
    {
        $this->benefits = $benefits;
    }

    public function getWorkdays()
    {
        return $this->workdays;
    }

    public function setWorkdays($workdays)
    {
        $this->workdays = $workdays;
    }

    public function getSchedule()
    {
        return $this->schedule;
    }

    public function setSchedule($schedule)
    {
        $this->schedule = $schedule;
    }

    public function getRequirements()
    {
        return $this->requirements;
    }

    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;
    }

    public function getFunctions()
    {
        return $this->functions;
    }

    public function setFunctions($functions)
    {
        $this->functions = $functions;
    }

    public function getSkills()
    {
        return $this->skills;
    }

    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    public function getTechnical_knowledge()
    {
        return $this->technical_knowledge;
    }

    public function setTechnical_knowledge($technical_knowledge)
    {
        $this->technical_knowledge = $technical_knowledge;
    }

    public function getId_customer()
    {
        return $this->id_customer;
    }

    public function setId_customer($id_customer)
    {
        $this->id_customer = $id_customer;
    }

    public function getId_customer_contact()
    {
        return $this->id_customer_contact;
    }

    public function setId_customer_contact($id_customer_contact)
    {
        $this->id_customer_contact = $id_customer_contact;
    }

    public function getId_state()
    {
        return $this->id_state;
    }

    public function setId_state($id_state)
    {
        $this->id_state = $id_state;
    }

    public function getId_city()
    {
        return $this->id_city;
    }

    public function setId_city($id_city)
    {
        $this->id_city = $id_city;
    }

    public function getCreated_by()
    {
        return $this->created_by;
    }

    public function setCreated_by($created_by)
    {
        $this->created_by = $created_by;
    }

    public function getEnd_date()
    {
        return $this->end_date;
    }

    public function setEnd_date($end_date)
    {
        $this->end_date = $end_date;
    }

    public function getId_status()
    {
        return $this->id_status;
    }

    public function setId_status($id_status)
    {
        $this->id_status = $id_status;
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

    public function getId_recruiter()
    {
        return $this->id_recruiter;
    }

    public function setId_recruiter($id_recruiter)
    {
        $this->id_recruiter = $id_recruiter;
    }

    public function getId_area()
    {
        return $this->id_area;
    }

    public function setId_area($id_area)
    {
        $this->id_area = $id_area;
    }

    public function getId_subarea()
    {
        return $this->id_subarea;
    }

    public function setId_subarea($id_subarea)
    {
        $this->id_subarea = $id_subarea;
    }

    public function getSend_date()
    {
        return $this->send_date;
    }

    public function setSend_date($send_date)
    {
        $this->send_date = $send_date;
    }

    public function getInterview_date()
    {
        return $this->interview_date;
    }

    public function setInterview_date($interview_date)
    {
        $this->interview_date = $interview_date;
    }

    public function getFollow_up_date()
    {
        return $this->follow_up_date;
    }

    public function setFollow_up_date($follow_up_date)
    {
        $this->follow_up_date = $follow_up_date;
    }

    public function getCancellation_date()
    {
        return $this->cancellation_date;
    }

    public function setCancellation_date($cancellation_date)
    {
        $this->cancellation_date = $cancellation_date;
    }

    public function getStandby_date()
    {
        return $this->standby_date;
    }

    public function setStandby_date($standby_date)
    {
        $this->standby_date = $standby_date;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getWarranty_time()
    {
        return $this->warranty_time;
    }

    public function setWarranty_time($warranty_time)
    {
        $this->warranty_time = $warranty_time;
    }

    public function getAmount_to_invoice()
    {
        return $this->amount_to_invoice;
    }

    public function setAmount_to_invoice($amount_to_invoice)
    {
        $this->amount_to_invoice = $amount_to_invoice;
    }

    public function getAuthorization_date()
    {
        return $this->authorization_date;
    }

    public function setAuthorization_date($authorization_date)
    {
        $this->authorization_date = $authorization_date;
    }

    public function getCommitment_date()
    {
        return $this->commitment_date;
    }

    public function setCommitment_date($commitment_date)
    {
        $this->commitment_date = $commitment_date;
    }

    public function getWorking_day()
    {
        return $this->working_day;
    }

    public function setWorking_day($working_day)
    {
        $this->working_day = $working_day;
    }

    public function getSend_date_candidate()
    {
        return $this->send_date_candidate;
    }

    public function setSend_date_candidate($send_date_candidate)
    {
        $this->send_date_candidate = $send_date_candidate;
    }

    public function getAdvance_payment()
    {
        return $this->advance_payment;
    }

    public function setAdvance_payment($advance_payment)
    {
        $this->advance_payment = $advance_payment;
    }

    public function getPayment_amount()
    {
        return $this->payment_amount;
    }

    public function setPayment_amount($payment_amount)
    {
        $this->payment_amount = $payment_amount;
    }

    public function getExperience_type()
    {
        return $this->experience_type;
    }

    public function setExperience_type($experience_type)
    {
        $this->experience_type = $experience_type;
    }


    public function getRecruitment_service_cost()
    {
        return $this->recruitment_service_cost;
    }

    public function setRecruitment_service_cost($recruitment_service_cost)
    {
        $this->recruitment_service_cost = $recruitment_service_cost;
    }

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT *, v.id AS id_vacancy, vs.status AS vacancy_status, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, u.email AS recruiter_email, CONCAT(cc.first_name, ' ', cc.last_name) AS customer_contact, business_name, cc.email AS customer_contact_email, c.id AS id_customer, (SELECT SUM(CASE WHEN va.id_status >= 3 THEN 1 ELSE 0 END) FROM vacancy_applicants va WHERE va.id_vacancy=v.id) AS n_sent FROM vacancies v INNER JOIN vacancy_status vs ON v.id_status=vs.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customers_contacts cc ON v.id_customer_contact=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN education_levels e ON v.id_education_level=e.id INNER JOIN genders g ON V.id_gender=g.id INNER JOIN civil_status cs ON v.id_civil_status=cs.id LEFT JOIN languages l ON v.id_language=l.id LEFT JOIN language_levels ll ON v.id_language_level=ll.id LEFT JOIN vacancy_questionnaire vq ON vq.id_vacancy=v.id LEFT JOIN users u ON v.id_recruiter=u.id LEFT JOIN areas a ON v.id_area=a.id LEFT JOIN subareas sa ON v.id_subarea=sa.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id WHERE v.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4  OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, SUM(CASE WHEN va.id_status = 4 THEN 1 ELSE 0 END) AS n_chosen, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id GROUP BY v.id, u.first_name, u.last_name, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesInProcess()
    {
		$stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4  OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, SUM(CASE WHEN va.id_status = 4 THEN 1 ELSE 0 END) AS n_chosen, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE v.id_status <= 4 GROUP BY v.id, u.first_name, u.last_name, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        //$stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, SUM(CASE WHEN va.id_status = 4 THEN 1 ELSE 0 END) AS n_chosen, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE v.vacancy like '%ulises%' GROUP BY v.id, u.first_name, u.last_name, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }
    // ===[gabo 5 abril modal vacantes perdon:( )]===
    public function getVacanciesInProcessByIdRecruiter($id)
    {
        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, SUM(CASE WHEN va.id_status = 4 THEN 1 ELSE 0 END) AS n_chosen, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE v.id_status <= 4 and v.id_recruiter=:id GROUP BY v.id, u.first_name, u.last_name, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }
    // fin

    public function getVacanciesByDate()
    {
        $date1 = $this->getRequest_date();
        $date2 = $this->getEnd_date();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, SUM(CASE WHEN va.id_status = 4 THEN 1 ELSE 0 END) AS n_chosen, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE CONVERT(date, v.request_date) BETWEEN :date1 AND :date2 GROUP BY v.id, u.first_name, u.last_name, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesByRecruiter()
    {
        $id_recruiter = $this->getId_recruiter();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, SUM(CASE WHEN va.id_status = 4 THEN 1 ELSE 0 END) AS n_chosen, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE v.id_recruiter=:id_recruiter GROUP BY v.id, u.first_name, u.last_name, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_STR);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesInProcessByRecruiter()
    {
        $id_recruiter = $this->getId_recruiter();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, SUM(CASE WHEN va.id_status = 4 THEN 1 ELSE 0 END) AS n_chosen, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE v.id_recruiter=:id_recruiter AND v.id_status <= 4 GROUP BY v.id, u.first_name, u.last_name, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_STR);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesByRecruiterAndDate()
    {
        $id_recruiter = $this->getId_recruiter();
        $date1 = $this->getRequest_date();
        $date2 = $this->getEnd_date();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 AND v.send_date IS NULL THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, SUM(CASE WHEN va.id_status = 4 THEN 1 ELSE 0 END) AS n_chosen, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id WHERE v.id_recruiter=:id_recruiter AND CONVERT(date, v.request_date) BETWEEN :date1 AND :date2 GROUP BY v.id, u.first_name, u.last_name, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, v.position_number, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_STR);
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesPerMonth()
    {
        $year = $this->getRequest_date();
        $month = $this->getRequest_date();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.id_area, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id WHERE YEAR(v.request_date) = YEAR(:year) AND MONTH(v.request_date) = MONTH(:month) GROUP BY v.id, u.first_name, u.last_name, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.id_area, v.end_date, v.send_date, v.standby_date, vs.status, v.id_status, v.functions ORDER BY v.request_date DESC");
        $stmt->bindParam(":year", $year, PDO::PARAM_STR);
        $stmt->bindParam(":month", $month, PDO::PARAM_STR);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacancyCountPerMonth()
    {
        $year = $this->getRequest_date();
        $month = $this->getRequest_date();

        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE YEAR(v.request_date) = YEAR(:year) AND MONTH(v.request_date) = MONTH(:month) AND id_status <> 7");
        $stmt->bindParam(":year", $year, PDO::PARAM_STR);
        $stmt->bindParam(":month", $month, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacancyCountPerMonthAndCustomer()
    {
        $year = $this->getRequest_date();
        $month = $this->getRequest_date();
        $customer = $this->getId_customer();

        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE YEAR(v.request_date) = YEAR(:year) AND MONTH(v.request_date) = MONTH(:month) AND id_status <> 7 AND id_customer=:id_customer");
        $stmt->bindParam(":year", $year, PDO::PARAM_STR);
        $stmt->bindParam(":month", $month, PDO::PARAM_STR);
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacancyCountPerMonthAndStatus()
    {
        $year = $this->getRequest_date();
        $month = $this->getRequest_date();
        $id_status = $this->getId_status();

        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE YEAR(v.request_date) = YEAR(:year) AND MONTH(v.request_date) = MONTH(:month) AND id_status=:id_status");
        $stmt->bindParam(":year", $year, PDO::PARAM_STR);
        $stmt->bindParam(":month", $month, PDO::PARAM_STR);
        $stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacancyClosedCountInCurrentMonth()
    {
        $year = $this->getRequest_date();
        $month = $this->getRequest_date();
        $id_status = $this->getId_status();

        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE YEAR(v.end_date) = YEAR(:year) AND MONTH(v.end_date) = MONTH(:month) AND id_status=:id_status");
        $stmt->bindParam(":year", $year, PDO::PARAM_STR);
        $stmt->bindParam(":month", $month, PDO::PARAM_STR);
        $stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacancyClosedCountByCustomerInCurrentMonth()
    {
        $year = $this->getRequest_date();
        $month = $this->getRequest_date();
        $id_status = $this->getId_status();
        $customer = $this->getId_customer();

        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE YEAR(v.end_date) = YEAR(:year) AND MONTH(v.end_date) = MONTH(:month) AND id_status=:id_status AND id_customer=:id_customer");
        $stmt->bindParam(":year", $year, PDO::PARAM_STR);
        $stmt->bindParam(":month", $month, PDO::PARAM_STR);
        $stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacancyClosedCountByCustomer()
    {

        $id_status = $this->getId_status();
        $customer = $this->getId_customer();

        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE id_status=:id_status AND id_customer=:id_customer");
        $stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacancyCountByCustomer()
    {
        $customer = $this->getId_customer();
        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE id_status <> 7 AND id_customer=:id_customer");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacancyInProcessCount()
    {
        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE id_status < 5 OR id_status = 8");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacancyInProcessCountByCustomer()
    {
        $customer = $this->getId_customer();
        $stmt = $this->db->prepare("SELECT COUNT(v.id) AS total FROM vacancies v WHERE (id_status < 5 OR id_status = 8) AND id_customer=:id_customer");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getVacanciesAvailable()
    {
        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id WHERE id_status < 5 and (v.id<>2370 and v.id<>2369 and v.id<>2366) ORDER BY v.request_date DESC");
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesAByArea()
    {
        $area = $this->getId_area();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id WHERE id_area=:id_area AND v.id_status < 5 and (v.id<>2370 and v.id<>2369 and v.id<>2366) ORDER BY v.request_date DESC");
        $stmt->bindParam(":id_area", $area, PDO::PARAM_INT);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesABySubarea()
    {
        $subarea = $this->getId_subarea();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id WHERE id_subarea=:id_subarea AND v.id_status < 5 and (v.id<>2370 and v.id<>2369 and v.id<>2366) ORDER BY v.request_date DESC");
        $stmt->bindParam(":id_subarea", $subarea, PDO::PARAM_INT);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesAByState()
    {
        $state = $this->getId_state();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id WHERE v.id_state=:id_state AND v.id_status < 5 and (v.id<>2370 and v.id<>2369 and v.id<>2366) ORDER BY v.request_date DESC");
        $stmt->bindParam(":id_state", $state, PDO::PARAM_INT);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesAByCity()
    {
        $city = $this->getId_city();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id WHERE v.id_city=:id_city AND v.id_status < 5 and (v.id<>2370 and v.id<>2369 and v.id<>2366) ORDER BY v.request_date DESC");
        $stmt->bindParam(":id_city", $city, PDO::PARAM_INT);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesByCustomer()
    {
        $customer = $this->getId_customer();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id WHERE v.id_customer=:id_customer GROUP BY v.id, u.first_name, u.last_name, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.end_date, vs.status, v.id_status, v.functions, cbn.business_name, v.id_recruiter, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_INT);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesInProcessByCustomer()
    {
        $customer = $this->getId_customer();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id WHERE v.id_customer=:id_customer AND v.id_status <= 4 GROUP BY v.id, u.first_name, u.last_name, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.end_date, vs.status, v.id_status, v.functions, cbn.business_name, v.id_recruiter, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_INT);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesByCustomerAndDate()
    {
        $customer = $this->getId_customer();
        $date1 = $this->getRequest_date();
        $date2 = $this->getEnd_date();

        $stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.id_recruiter, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.send_date, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN CONCAT(dbo.count_days(v.request_date, v.standby_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.standby_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND (v.id_status >= 5 AND v.id_status <> 8) THEN dbo.count_days(v.request_date, v.end_date) WHEN v.standby_date IS NOT NULL AND v.id_status = 8 THEN dbo.count_days(v.request_date, v.standby_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id WHERE v.id_customer=:id_customer AND CONVERT(date, v.request_date) BETWEEN :date1 AND :date2 GROUP BY v.id, u.first_name, u.last_name, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.standby_date, v.end_date, vs.status, v.id_status, v.functions, cbn.business_name, v.id_recruiter, v.time, v.type, v.warranty_time, v.authorization_date, v.commitment_date ORDER BY CASE WHEN v.id_status=8 THEN 5 WHEN v.id_status=5 THEN 6 WHEN v.id_status=6 THEN 7 WHEN v.id_status=7 THEN 8 ELSE v.id_status END ASC, v.request_date DESC");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_INT);
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacancyCountByExecutive()
    {
        $stmt = $this->db->prepare("SELECT u.id, ISNULL(CONCAT(u.first_name, ' ', u.last_name),'Sin asignar') AS name, COUNT(*) AS total FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id WHERE v.id_status < 5 OR v.id_status=8 GROUP BY u.id, u.first_name, u.last_name ORDER BY total DESC");
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacancyInProcessCountByCustomers()
    {
        $stmt = $this->db->prepare("SELECT customer, COUNT(*) AS total FROM vacancies v LEFT JOIN customers c ON v.id_customer=c.id WHERE v.id_status < 5 GROUP BY customer ORDER BY total DESC");
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function save()
    {
        $result = false;
        $customer = $this->getId_customer();
        $customer_contact = $this->getId_customer_contact();
        $request_date = $this->getRequest_date();
        $business_name = $this->getBusiness_name();
        $recruiter = $this->getId_recruiter();
        $vacancy = $this->getVacancy();
        $department = $this->getDepartment();
        $report_to = $this->getReport_to();
        $personal_in_charge = $this->getPersonal_in_charge();
        $education_level = $this->getId_education_level();
        $position_number = $this->getPosition_number();
        $experience_years = $this->getExperience_years();
        $experience = $this->getExperience();
        $age_min = $this->getAge_min();
        $age_max = $this->getAge_max();
        $gender = $this->getId_gender();
        $civil_status = $this->getId_civil_status();
        $language = $this->getId_language();
        $language_level = $this->getId_language_level();
        $salary_min = $this->getSalary_min();
        $salary_max = $this->getSalary_max();
        $benefits = $this->getBenefits();
        $workdays = $this->getWorkdays();
        $schedule = $this->getSchedule();
        $requirements = $this->getRequirements();
        $functions = $this->getFunctions();
        $skills = $this->getSkills();
        $technical_knowledge = $this->getTechnical_knowledge();
        $state = $this->getId_state();
        $city = $this->getId_city();
        $created_by = $this->getCreated_by();
        $id_status = $this->getId_status();
        $area = $this->getId_area();
        $subarea = $this->getId_subarea();
        $comments = $this->getComments();
        $type = $this->getType();
        $warranty_time = $this->getWarranty_time();
        $amount_to_invoice = $this->getAmount_to_invoice();
        $authorization_date = $this->getAuthorization_date();
        $commitment_date = $this->getCommitment_date();
        $working_day = $this->getWorking_day();
        $send_date_candidate = $this->getSend_date_candidate();
        $advance_payment = $this->getAdvance_payment();
        $payment_amount = $this->getPayment_amount();
        $experience_type = $this->getExperience_type();
        $recruitment_service_cost = $this->getRecruitment_service_cost();

        $stmt = $this->db->prepare("INSERT INTO vacancies (id_customer, id_customer_contact, request_date, id_business_name, id_recruiter, vacancy, department, report_to, personal_in_charge, id_education_level, position_number, experience_years, experience, age_min, age_max, id_gender, id_civil_status, id_language, id_language_level, salary_min, salary_max, benefits, workdays, schedule, requirements, functions, skills, technical_knowledge, id_state, id_city, created_by, id_status, created_at, modified_at, end_date, id_area, id_subarea, comments, type, warranty_time, amount_to_invoice, authorization_date, commitment_date,working_day,send_date_candidate,advance_payment,payment_amount,experience_type,recruitment_service_cost) VALUES(:id_customer, :id_customer_contact, :request_date, :id_business_name, :recruiter, :vacancy, :department, :report_to, :personal_in_charge, :id_education_level, :position_number, :experience_years, :experience, :age_min, :age_max, :id_gender, :id_civil_status, :id_language, :id_language_level, :salary_min, :salary_max, :benefits, :workdays, :schedule, :requirements, :functions, :skills, :technical_knowledge, :id_state, :id_city, :created_by, :id_status, GETDATE(), GETDATE(), NULL, :id_area, :id_subarea, :comments, :type, :warranty_time, :amount_to_invoice, :authorization_date, :commitment_date,:working_day,:send_date_candidate,:advance_payment,:payment_amount,:experience_type,:recruitment_service_cost)");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer_contact", $customer_contact, PDO::PARAM_INT);
        $stmt->bindParam(":request_date", $request_date, PDO::PARAM_STR);
        $stmt->bindParam(":id_business_name", $business_name, PDO::PARAM_STR);
        $stmt->bindParam(":recruiter", $recruiter, PDO::PARAM_INT);
        $stmt->bindParam(":vacancy", $vacancy, PDO::PARAM_STR);
        $stmt->bindParam(":department", $department, PDO::PARAM_STR);
        $stmt->bindParam(":report_to", $report_to, PDO::PARAM_STR);
        $stmt->bindParam(":personal_in_charge", $personal_in_charge, PDO::PARAM_INT);
        $stmt->bindParam(":id_education_level", $education_level, PDO::PARAM_INT);
        $stmt->bindParam(":position_number", $position_number, PDO::PARAM_INT);
        $stmt->bindParam(":experience_years", $experience_years, PDO::PARAM_INT);
        $stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
        $stmt->bindParam(":age_min", $age_min, PDO::PARAM_INT);
        $stmt->bindParam(":age_max", $age_max, PDO::PARAM_INT);
        $stmt->bindParam(":id_gender", $gender, PDO::PARAM_INT);
        $stmt->bindParam(":id_civil_status", $civil_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_language", $language, PDO::PARAM_INT);
        $stmt->bindParam(":id_language_level", $language_level, PDO::PARAM_INT);
        $stmt->bindParam(":salary_min", $salary_min, PDO::PARAM_STR);
        $stmt->bindParam(":salary_max", $salary_max, PDO::PARAM_STR);
        $stmt->bindParam(":benefits", $benefits, PDO::PARAM_STR);
        $stmt->bindParam(":workdays", $workdays, PDO::PARAM_STR);
        $stmt->bindParam(":schedule", $schedule, PDO::PARAM_STR);
        $stmt->bindParam(":requirements", $requirements, PDO::PARAM_STR);
        $stmt->bindParam(":functions", $functions, PDO::PARAM_STR);
        $stmt->bindParam(":skills", $skills, PDO::PARAM_STR);
        $stmt->bindParam(":technical_knowledge", $technical_knowledge, PDO::PARAM_STR);
        $stmt->bindParam(":id_state", $state, PDO::PARAM_INT);
        $stmt->bindParam(":id_city", $city, PDO::PARAM_INT);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_INT);
        $stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_area", $area, PDO::PARAM_INT);
        $stmt->bindParam(":id_subarea", $subarea, PDO::PARAM_INT);
        $stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);
        $stmt->bindParam(":warranty_time", $warranty_time, PDO::PARAM_INT);
        $stmt->bindParam(":amount_to_invoice", $amount_to_invoice, PDO::PARAM_STR);
        $stmt->bindParam(":authorization_date", $authorization_date, PDO::PARAM_STR);
        $stmt->bindParam(":commitment_date", $commitment_date, PDO::PARAM_STR);
        $stmt->bindParam(":working_day", $working_day, PDO::PARAM_STR);
        $stmt->bindParam(":send_date_candidate", $send_date_candidate, PDO::PARAM_STR);
        $stmt->bindParam(":advance_payment", $advance_payment, PDO::PARAM_STR);
        $stmt->bindParam(":payment_amount", $payment_amount, PDO::PARAM_STR);
        $stmt->bindParam(":experience_type", $experience_type, PDO::PARAM_STR);
        $stmt->bindParam(":recruitment_service_cost", $recruitment_service_cost, PDO::PARAM_STR);


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
        $customer = $this->getId_customer();
        $customer_contact = $this->getId_customer_contact();
        $business_name = $this->getBusiness_name();
        $recruiter = $this->getId_recruiter();
        $vacancy = $this->getVacancy();
        $department = $this->getDepartment();
        $report_to = $this->getReport_to();
        $personal_in_charge = $this->getPersonal_in_charge();
        $education_level = $this->getId_education_level();
        $position_number = $this->getPosition_number();
        $experience_years = $this->getExperience_years();
        $experience = $this->getExperience();
        $age_min = $this->getAge_min();
        $age_max = $this->getAge_max();
        $gender = $this->getId_gender();
        $civil_status = $this->getId_civil_status();
        $language = $this->getId_language();
        $language_level = $this->getId_language_level();
        $salary_min = $this->getSalary_min();
        $salary_max = $this->getSalary_max();
        $benefits = $this->getBenefits();
        $workdays = $this->getWorkdays();
        $schedule = $this->getSchedule();
        $requirements = $this->getRequirements();
        $functions = $this->getFunctions();
        $skills = $this->getSkills();
        $technical_knowledge = $this->getTechnical_knowledge();
        $state = $this->getId_state();
        $city = $this->getId_city();
        $area = $this->getId_area();
        $subarea = $this->getId_subarea();
        $comments = $this->getComments();
        $type = $this->getType();
        $warranty_time = $this->getWarranty_time();
        $amount_to_invoice = $this->getAmount_to_invoice();
        $authorization_date = $this->getAuthorization_date();
        $commitment_date = $this->getCommitment_date();
        $working_day = $this->getWorking_day();
        $send_date_candidate = $this->getSend_date_candidate();
        $advance_payment = $this->getAdvance_payment();
        $payment_amount = $this->getPayment_amount();
        $experience_type = $this->getExperience_type();
        $recruitment_service_cost = $this->getRecruitment_service_cost();


        //$created_by = $this->getCreated_by();
        //$id_status = $this->getId_status();

        $stmt = $this->db->prepare("UPDATE vacancies SET id_customer=:id_customer, id_customer_contact=:id_customer_contact, id_business_name=:id_business_name, id_recruiter=:id_recruiter, vacancy=:vacancy, department=:department, report_to=:report_to, personal_in_charge=:personal_in_charge, id_education_level=:id_education_level, position_number=:position_number, experience_years=:experience_years, experience=:experience, age_min=:age_min, age_max=:age_max, id_gender=:id_gender, id_civil_status=:id_civil_status, id_language=:id_language, id_language_level=:id_language_level, salary_min=:salary_min, salary_max=:salary_max, benefits=:benefits, workdays=:workdays, schedule=:schedule, requirements=:requirements, functions=:functions, skills=:skills, technical_knowledge=:technical_knowledge, id_state=:id_state, id_city=:id_city, id_area=:id_area, id_subarea=:id_subarea, comments=:comments, type=:type, warranty_time=:warranty_time, amount_to_invoice=:amount_to_invoice, authorization_date=:authorization_date, commitment_date=:commitment_date, modified_at=GETDATE(),working_day=:working_day,send_date_candidate=:send_date_candidate,advance_payment=:advance_payment,payment_amount=:payment_amount,experience_type=:experience_type,recruitment_service_cost=:recruitment_service_cost  WHERE id=:id");
        //$stmt = $this->db->prepare("UPDATE vacancies SET id_customer=:id_customer, id_customer_contact=:id_customer_contact, id_business_name=:id_business_name, id_recruiter=:id_recruiter, vacancy=:vacancy, department=:department, report_to=:report_to, personal_in_charge=:personal_in_charge, id_education_level=:id_education_level, position_number=:position_number, experience_years=:experience_years, experience=:experience, age_min=:age_min, age_max=:age_max, id_gender=:id_gender, id_civil_status=:id_civil_status, id_language=:id_language, id_language_level=:id_language_level, salary_min=:salary_min, salary_max=:salary_max, benefits=:benefits, workdays=:workdays, schedule=:schedule, requirements=:requirements, functions=:functions, skills=:skills, technical_knowledge=:technical_knowledge, id_state=:id_state, id_city=:id_city, id_area=:id_area, id_subarea=:id_subarea, comments=:comments, type=:type, warranty_time=:warranty_time, amount_to_invoice=:amount_to_invoice, authorization_date=:authorization_date, commitment_date=:commitment_date, modified_at=GETDATE(),working_day=:working_day,send_date_candidate=:send_date_candidate,advance_payment=:advance_payment WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer_contact", $customer_contact, PDO::PARAM_INT);
        $stmt->bindParam(":id_business_name", $business_name, PDO::PARAM_STR);
        $stmt->bindParam(":id_recruiter", $recruiter, PDO::PARAM_INT);
        $stmt->bindParam(":vacancy", $vacancy, PDO::PARAM_STR);
        $stmt->bindParam(":department", $department, PDO::PARAM_STR);
        $stmt->bindParam(":report_to", $report_to, PDO::PARAM_STR);
        $stmt->bindParam(":personal_in_charge", $personal_in_charge, PDO::PARAM_INT);
        $stmt->bindParam(":id_education_level", $education_level, PDO::PARAM_INT);
        $stmt->bindParam(":position_number", $position_number, PDO::PARAM_INT);
        $stmt->bindParam(":experience_years", $experience_years, PDO::PARAM_INT);
        $stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
        $stmt->bindParam(":age_min", $age_min, PDO::PARAM_INT);
        $stmt->bindParam(":age_max", $age_max, PDO::PARAM_INT);
        $stmt->bindParam(":id_gender", $gender, PDO::PARAM_INT);
        $stmt->bindParam(":id_civil_status", $civil_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_language", $language, PDO::PARAM_INT);
        $stmt->bindParam(":id_language_level", $language_level, PDO::PARAM_INT);
        $stmt->bindParam(":salary_min", $salary_min, PDO::PARAM_STR);
        $stmt->bindParam(":salary_max", $salary_max, PDO::PARAM_STR);
        $stmt->bindParam(":benefits", $benefits, PDO::PARAM_STR);
        $stmt->bindParam(":workdays", $workdays, PDO::PARAM_STR);
        $stmt->bindParam(":schedule", $schedule, PDO::PARAM_STR);
        $stmt->bindParam(":requirements", $requirements, PDO::PARAM_STR);
        $stmt->bindParam(":functions", $functions, PDO::PARAM_STR);
        $stmt->bindParam(":skills", $skills, PDO::PARAM_STR);
        $stmt->bindParam(":technical_knowledge", $technical_knowledge, PDO::PARAM_STR);
        $stmt->bindParam(":id_state", $state, PDO::PARAM_INT);
        $stmt->bindParam(":id_city", $city, PDO::PARAM_INT);
        $stmt->bindParam(":id_area", $area, PDO::PARAM_INT);
        $stmt->bindParam(":id_subarea", $subarea, PDO::PARAM_INT);
        $stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);
        $stmt->bindParam(":warranty_time", $warranty_time, PDO::PARAM_INT);
        $stmt->bindParam(":amount_to_invoice", $amount_to_invoice, PDO::PARAM_STR);
        $stmt->bindParam(":authorization_date", $authorization_date, PDO::PARAM_STR);
        $stmt->bindParam(":commitment_date", $commitment_date, PDO::PARAM_STR);
        $stmt->bindParam(":working_day", $working_day, PDO::PARAM_STR);
        $stmt->bindParam(":send_date_candidate", $send_date_candidate, PDO::PARAM_STR);
        $stmt->bindParam(":advance_payment", $advance_payment, PDO::PARAM_STR);
        $stmt->bindParam(":payment_amount", $payment_amount, PDO::PARAM_STR);
        $stmt->bindParam(":experience_type", $experience_type, PDO::PARAM_STR);
        $stmt->bindParam(":recruitment_service_cost", $recruitment_service_cost, PDO::PARAM_STR);


        //$stmt->bindParam(":created_by", $created_by, PDO::PARAM_INT);
        //$stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }
        return $result;
    }


    public function changeStatus()
    {

        $result = false;

        $id = $this->getId();
        $id_status = $this->getId_status();

        if ($id_status == 2) {
            $stmt = $this->db->prepare("UPDATE vacancies SET id_status=:id_status, send_date=GETDATE() WHERE id=:id");
        } elseif ($id_status == 3) {
            $stmt = $this->db->prepare("UPDATE vacancies SET id_status=:id_status, interview_date=GETDATE() WHERE id=:id");
        } elseif ($id_status == 4) {
            $stmt = $this->db->prepare("UPDATE vacancies SET id_status=:id_status, follow_up_date=GETDATE() WHERE id=:id");
        } elseif ($id_status == 5) {
            $stmt = $this->db->prepare("UPDATE vacancies SET id_status=:id_status, end_date=GETDATE() WHERE id=:id");
        } elseif ($id_status == 8) {
            $stmt = $this->db->prepare("UPDATE vacancies SET id_status=:id_status, standby_date=GETDATE() WHERE id=:id");
        } else {
            $stmt = $this->db->prepare("UPDATE vacancies SET id_status=:id_status, end_date=GETDATE(), cancellation_date=GETDATE() WHERE id=:id");
        }

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }

        return $result;
    }

    public function restartSendDate()
    {

        $result = false;

        $id = $this->getId();
        $id_status = $this->getId_status();


        $stmt = $this->db->prepare("UPDATE vacancies SET send_date=NULL, id_status=1 WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }

        return $result;
    }

    public function duplicate()
    {

        $result = false;

        $id = $this->getId();
        $request_date = $this->getRequest_date();
        $created_by = $this->getCreated_by();

        $stmt = $this->db->prepare("INSERT INTO vacancies(vacancy, request_date, department, report_to, personal_in_charge, id_education_level, position_number, experience_years, age_min, age_max, id_gender, id_civil_status, id_language, id_language_level, salary_min, salary_max, benefits, workdays, schedule, id_state, id_city, requirements, functions, technical_knowledge, id_customer, id_customer_contact, created_by, id_status, created_at, modified_at, id_recruiter, id_business_name, id_area, id_subarea, type, warranty_time, authorization_date, commitment_date) SELECT vacancy, :request_date, department, report_to, personal_in_charge, id_education_level, position_number, experience_years, age_min, age_max, id_gender, id_civil_status, id_language, id_language_level, salary_min, salary_max, benefits, workdays, schedule, id_state, id_city, requirements, functions, technical_knowledge, id_customer, id_customer_contact, :created_by, 1, GETDATE(), GETDATE(), id_recruiter, id_business_name, id_area, id_subarea, type, warranty_time, authorization_date, commitment_date FROM vacancies WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":request_date", $request_date, PDO::PARAM_STR);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }

        return $result;
    }

    public function updateConfig()
    {

        $result = false;

        $id = $this->getId();
        $time = $this->getTime();
        $request_date = $this->getRequest_date();
        $send_date = $this->getSend_date();
        $end_date = $this->getEnd_date();

        $stmt = $this->db->prepare("UPDATE vacancies SET time=:time, request_date=:request_date, send_date=:send_date, end_date=:end_date, modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":time", $time, PDO::PARAM_INT);
        $stmt->bindParam(":request_date", $request_date, PDO::PARAM_STR);
        $stmt->bindParam(":send_date", $send_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }
        return $result;
    }


    /* MANAGEMENT MODULE */

    public function getVacanciesFromCurrentWeek()
    {
        $stmt = $this->db->prepare("SELECT v.id, va.id AS id_applicant, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, c.customer, v.vacancy, ISNULL(CONCAT(cnd.first_name, ' ', cnd.surname, ' ',cnd.last_name), 'No seleccionado') AS candidate, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN va.id_bill IS NULL AND va.id_purchase_order IS NULL THEN NULL WHEN va.id_bill IS NULL AND va.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND v.id_status >= 5 THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', DATEDIFF(MINUTE, v.request_date, v.end_date)%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND v.id_status >= 5 THEN dbo.count_days(v.request_date, v.end_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id INNER JOIN candidates cnd ON va.id_candidate=cnd.id LEFT JOIN purchase_orders po ON va.id_purchase_order=po.id LEFT JOIN bills b ON va.id_bill=b.id WHERE DATEPART(WK, v.request_date) = DATEPART(WK, GETDATE()) AND YEAR(v.request_date) = YEAR(GETDATE()) AND v.id_status <> 7 AND va.id_status = 4 GROUP BY v.id, u.first_name, u.last_name, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, cnd.first_name, cnd.surname, cnd.last_name, va.id, va.id_bill, va.id_purchase_order, po.folio, b.folio ORDER BY v.request_date DESC");
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }

    public function getVacanciesByDateRange()
    {
        $date1 = $this->getRequest_date();
        $date2 = $this->getEnd_date();

        $stmt = $this->db->prepare("SELECT v.id, va.id AS id_applicant, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, c.customer, v.vacancy, ISNULL(CONCAT(cnd.first_name, ' ', cnd.surname, ' ',cnd.last_name), 'No seleccionado') AS candidate, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, v.id_area, a.area, sa.subarea, v.send_date, CASE WHEN va.id_bill IS NULL AND va.id_purchase_order IS NULL THEN NULL WHEN va.id_bill IS NULL AND va.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ') WHEN v.send_date IS NULL AND v.id_status >= 5 THEN CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE, v.request_date, v.end_date))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(v.request_date, v.send_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.send_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.send_date IS NULL AND v.id_status < 5 THEN dbo.count_days(v.request_date, GETDATE()) WHEN v.send_date IS NULL AND v.id_status >= 5 THEN dbo.count_days(v.request_date, v.end_date) ELSE dbo.count_days(v.request_date, v.send_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, COUNT(va.id) AS n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL THEN 1 ELSE NULL END) AS real_n_applicants, COUNT(CASE WHEN va.id_vacancy=v.id AND cdn.created_by IS NULL AND va.id_status=1 THEN 1 ELSE NULL END) AS new_n_applicants, SUM(CASE WHEN va.id_status >= 2 AND va.id_status <= 4 THEN 1 ELSE 0 END) AS n_sent, SUM(CASE WHEN va.id_status >= 3 AND va.id_status <= 4 OR va.id_status=7  THEN 1 ELSE 0 END) AS n_selected FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy LEFT JOIN candidates cdn ON va.id_candidate=cdn.id INNER JOIN areas a ON v.id_area=a.id INNER JOIN subareas sa ON v.id_subarea=sa.id INNER JOIN candidates cnd ON va.id_candidate=cnd.id LEFT JOIN purchase_orders po ON va.id_purchase_order=po.id LEFT JOIN bills b ON va.id_bill=b.id WHERE CONVERT(date, v.request_date) BETWEEN :date1 AND :date2 AND v.id_status <> 7 AND va.id_status = 4 GROUP BY v.id, u.first_name, u.last_name, v.request_date, c.customer, v.vacancy, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, v.send_date, v.id_area, v.end_date, vs.status, v.id_status, v.functions, a.area, sa.subarea, cbn.business_name, cnd.first_name, cnd.surname, cnd.last_name, va.id, va.id_bill, va.id_purchase_order, po.folio, b.folio ORDER BY v.request_date DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $vacancies = $stmt->fetchAll();
        return $vacancies;
    }




    //==================================GABO 7 MARZO 2023=============================

    public function update_perfil()
    {
        $result = false;

        $id = $this->getId();
        $vacancy = $this->getVacancy();
        $department = $this->getDepartment();
        $salary_min = $this->getSalary_min();
        $salary_max = $this->getSalary_max();
        $working_day = $this->getWorking_day();
        $state = $this->getId_state();
        $city = $this->getId_city();
        $area = $this->getId_area();
        $subarea = $this->getId_subarea();
        $type = $this->getType();
        $warranty_time = $this->getWarranty_time();
        $amount_to_invoice = $this->getAmount_to_invoice();
        $authorization_date = $this->getAuthorization_date();
        $commitment_date = $this->getCommitment_date();
        $report_to = $this->getReport_to();
        $personal_in_charge = $this->getPersonal_in_charge();



        $stmt = $this->db->prepare("UPDATE vacancies SET vacancy=:vacancy, department=:department, salary_min=:salary_min, salary_max=:salary_max, working_day=:working_day, id_state=:id_state, id_city=:id_city, id_area=:id_area, id_subarea=:id_subarea, type=:type, warranty_time=:warranty_time, amount_to_invoice=:amount_to_invoice, authorization_date=:authorization_date, commitment_date=:commitment_date,  report_to=:report_to,  personal_in_charge=:personal_in_charge, modified_at=GETDATE()  WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":vacancy", $vacancy, PDO::PARAM_STR);
        $stmt->bindParam(":department", $department, PDO::PARAM_STR);
        $stmt->bindParam(":salary_min", $salary_min, PDO::PARAM_STR);
        $stmt->bindParam(":salary_max", $salary_max, PDO::PARAM_STR);
        $stmt->bindParam(":working_day", $working_day, PDO::PARAM_STR);
        $stmt->bindParam(":id_state", $state, PDO::PARAM_INT);
        $stmt->bindParam(":id_city", $city, PDO::PARAM_INT);
        $stmt->bindParam(":id_area", $area, PDO::PARAM_INT);
        $stmt->bindParam(":id_subarea", $subarea, PDO::PARAM_INT);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);
        $stmt->bindParam(":warranty_time", $warranty_time, PDO::PARAM_INT);
        $stmt->bindParam(":amount_to_invoice", $amount_to_invoice, PDO::PARAM_STR);
        $stmt->bindParam(":authorization_date", $authorization_date, PDO::PARAM_STR);
        $stmt->bindParam(":commitment_date", $commitment_date, PDO::PARAM_STR);
        $stmt->bindParam(":report_to", $report_to, PDO::PARAM_STR);
        $stmt->bindParam(":personal_in_charge", $personal_in_charge, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function update_descripcion()
    {
        $result = false;

        $id = $this->getId();
        $id_education_level = $this->getId_education_level();
        $position_number = $this->getPosition_number();
        $experience_years = $this->getExperience_years();
        $experience_type = $this->getExperience_type();
        $age_min = $this->getAge_min();
        $age_max = $this->getAge_max();
        $id_gender = $this->getId_gender();
        $id_civil_status = $this->getId_civil_status();
        $id_language = $this->getId_language();
        $id_language_level = $this->getId_language_level();
        $workdays = $this->getWorkdays();
        $schedule = $this->getSchedule();
        $requirements = $this->getRequirements();
        $functions = $this->getFunctions();
        $benefits = $this->getBenefits();
        $comments = $this->getComments();


        $stmt = $this->db->prepare("UPDATE vacancies SET id_education_level=:id_education_level, position_number=:position_number, experience_years=:experience_years, experience_type=:experience_type, age_min=:age_min, age_max=:age_max, 
    id_gender=:id_gender, id_civil_status=:id_civil_status, id_language=:id_language, id_language_level=:id_language_level, workdays=:workdays, schedule=:schedule, requirements=:requirements,benefits=:benefits,comments=:comments, functions=:functions, modified_at=GETDATE()  WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_education_level", $id_education_level, PDO::PARAM_STR);
        $stmt->bindParam(":position_number", $position_number, PDO::PARAM_STR);
        $stmt->bindParam(":experience_years", $experience_years, PDO::PARAM_STR);
        $stmt->bindParam(":experience_type", $experience_type, PDO::PARAM_STR);
        $stmt->bindParam(":age_min", $age_min, PDO::PARAM_STR);
        $stmt->bindParam(":age_max", $age_max, PDO::PARAM_INT);
        $stmt->bindParam(":id_gender", $id_gender, PDO::PARAM_INT);
        $stmt->bindParam(":id_civil_status", $id_civil_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_language", $id_language, PDO::PARAM_INT);
        $stmt->bindParam(":id_language_level", $id_language_level, PDO::PARAM_INT);
        $stmt->bindParam(":workdays", $workdays, PDO::PARAM_INT);
        $stmt->bindParam(":schedule", $schedule, PDO::PARAM_STR);
        $stmt->bindParam(":requirements", $requirements, PDO::PARAM_STR);
        $stmt->bindParam(":benefits", $benefits, PDO::PARAM_STR);
        $stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
        $stmt->bindParam(":functions", $functions, PDO::PARAM_STR);


        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }


    public function update_contacto()
    {
        $result = false;

        $id = $this->getId();
        $customer = $this->getId_customer();
        $customer_contact = $this->getId_customer_contact();
        $business_name = $this->getBusiness_name();
        $recruiter = $this->getId_recruiter();


        $stmt = $this->db->prepare("UPDATE vacancies SET id_customer=:customer, id_customer_contact=:customer_contact, id_business_name=:business_name,id_recruiter=:recruiter, modified_at=GETDATE()  WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":customer", $customer, PDO::PARAM_STR);
        $stmt->bindParam(":customer_contact", $customer_contact, PDO::PARAM_STR);
        $stmt->bindParam(":business_name", $business_name, PDO::PARAM_STR);
        $stmt->bindParam(":recruiter", $recruiter, PDO::PARAM_STR);



        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function update_condiciones()
    {
        $result = false;

        $id = $this->getId();
        $send_date_candidate = $this->getSend_date_candidate();
        $advance_payment = $this->getAdvance_payment();
        $payment_amount = $this->getPayment_amount();
        $recruitment_service_cost = $this->getRecruitment_service_cost();

        $stmt = $this->db->prepare("UPDATE vacancies SET send_date_candidate=:send_date_candidate, advance_payment=:advance_payment, payment_amount=:payment_amount,recruitment_service_cost=:recruitment_service_cost, modified_at=GETDATE()  WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":send_date_candidate", $send_date_candidate, PDO::PARAM_STR);
        $stmt->bindParam(":advance_payment", $advance_payment, PDO::PARAM_STR);
        $stmt->bindParam(":payment_amount", $payment_amount, PDO::PARAM_STR);
        $stmt->bindParam(":recruitment_service_cost", $recruitment_service_cost, PDO::PARAM_STR);
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    //===========FIN GABO=============
}
