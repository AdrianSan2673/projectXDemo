<?php

class Customer
{
    private $id;
    private $customer;
    private $alias;
    private $id_cost_center;
    private $recruitment_fee;
    private $price_for_psychometrics;
    private $price_for_talent_attraction;
    private $credit_days;
    private $box_cut;
    private $created_at;
    private $modified_at;
    private $created_by;
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

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    public function getId_cost_center()
    {
        return $this->id_cost_center;
    }

    public function setId_cost_center($id_cost_center)
    {
        $this->id_cost_center = $id_cost_center;
    }

    public function getRecruitment_fee()
    {
        return $this->recruitment_fee;
    }

    public function setRecruitment_fee($recruitment_fee)
    {
        $this->recruitment_fee = $recruitment_fee;
    }

    public function getPrice_for_psychometrics()
    {
        return $this->price_for_psychometrics;
    }

    public function setPrice_for_psychometrics($price_for_psychometrics)
    {
        $this->price_for_psychometrics = $price_for_psychometrics;
    }

    public function getPrice_for_talent_attraction()
    {
        return $this->price_for_talent_attraction;
    }

    public function setPrice_for_talent_attraction($price_for_talent_attraction)
    {
        $this->price_for_talent_attraction = $price_for_talent_attraction;
    }

    public function getCredit_days()
    {
        return $this->credit_days;
    }

    public function setCredit_days($credit_days)
    {
        $this->credit_days = $credit_days;
    }

    public function getBox_cut()
    {
        return $this->box_cut;
    }

    public function setBox_cut($box_cut)
    {
        $this->box_cut = $box_cut;
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

    //===[gabo 7 agosto creado por ]===
    public function getCreated_by()
    {
        return $this->created_by;
    }

    public function setCreated_by($created_by)
    {
        $this->created_by = $created_by;
    }
    //===[gabo 7 agosto creado por fin===

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT c.*, cc.cost_center FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id WHERE c.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    //===[gabo 7 agosto creado por ]===
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT c.id, customer, alias, cc.cost_center, (SELECT COUNT(vacancy) FROM vacancies v WHERE MONTH(request_date)=MONTH(GETDATE()) AND YEAR(request_date) =YEAR(GETDATE()) AND c.id=v.id_customer AND v.id_status < 7) AS monthly, (SELECT COUNT(vacancy) FROM vacancies v WHERE YEAR(request_date) =YEAR(GETDATE()) AND c.id=v.id_customer AND v.id_status < 7) AS annually, (SELECT TOP 1 ROUND((CAST((ce.reception_time + ce.communication_with_executive + ce.executive_friendliness + ce.quality_of_candidates) AS float) /4), 2) FROM customer_evaluations ce WHERE ce.id_customer=c.id ORDER BY created_at DESC) AS score, (SELECT TOP 1 ce.created_at FROM customer_evaluations ce WHERE ce.id_customer=c.id ORDER BY created_at DESC) AS last_evaluation, c.created_at, c.modified_at ,c.created_by  FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id  ORDER BY customer ASC");
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
    }
	
	
    public function getAllByCreate()
    {
        $created_by=$this->getCreated_at();
        $stmt = $this->db->prepare("SELECT c.id, customer, alias, cc.cost_center, (SELECT COUNT(vacancy) FROM vacancies v WHERE MONTH(request_date)=MONTH(GETDATE()) AND YEAR(request_date) =YEAR(GETDATE()) AND c.id=v.id_customer AND v.id_status < 7) AS monthly, (SELECT COUNT(vacancy) FROM vacancies v WHERE YEAR(request_date) =YEAR(GETDATE()) AND c.id=v.id_customer AND v.id_status < 7) AS annually, (SELECT TOP 1 ROUND((CAST((ce.reception_time + ce.communication_with_executive + ce.executive_friendliness + ce.quality_of_candidates) AS float) /4), 2) FROM customer_evaluations ce WHERE ce.id_customer=c.id ORDER BY created_at DESC) AS score, (SELECT TOP 1 ce.created_at FROM customer_evaluations ce WHERE ce.id_customer=c.id ORDER BY created_at DESC) AS last_evaluation, c.created_at, c.modified_at ,c.created_by  FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id WHERE created_by=:created_by ORDER BY customer ASC");
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);

        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
    }

    //===[gabo 7 agosto creado por fin===
    public function getEvaluations()
    {
        $stmt = $this->db->prepare("SELECT c.id, customer, alias, cc.cost_center, ce.*, (SELECT TOP 1 ROUND((CAST((ce.reception_time + ce.communication_with_executive + ce.executive_friendliness + ce.quality_of_candidates) AS float) /4), 2)) AS score FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN customer_evaluations ce ON ce.id_customer=c.id WHERE ce.created_at=(SELECT MAX(created_at) FROM customer_evaluations cev WHERE cev.id_customer=c.id) ORDER BY ce.created_at DESC");
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
    }
    //===[gabo 7 agosto creado por ]===
    public function create()
    {
        $result = false;

        $customer = $this->getCustomer();
        $alias = $this->getAlias();
        $id_cost_center = $this->getId_cost_center();
        $created_by = $this->getCreated_by();

        $stmt = $this->db->prepare("INSERT INTO customers(customer, alias, id_cost_center, created_at, modified_at,created_by) VALUES (:customer, :alias, :id_cost_center, GETDATE(), GETDATE(),:created_by);");
        $stmt->bindParam(":customer", $customer, PDO::PARAM_STR);
        $stmt->bindParam(":alias", $alias, PDO::PARAM_STR);
        $stmt->bindParam(":id_cost_center", $id_cost_center, PDO::PARAM_INT);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $flag = $stmt->execute();

        if ($flag) {
            $this->setId($this->db->lastInsertId());
        }
        return $flag;
    }

    public function update()
    {
        $result = false;

        $id = $this->getId();
        $customer = $this->getCustomer();
        $alias = $this->getAlias();
        $id_cost_center = $this->getId_cost_center();
        $created_by = $this->getCreated_by();

        $stmt = $this->db->prepare("UPDATE customers SET customer = :customer, alias = :alias, id_cost_center = :id_cost_center, modified_at = GETDATE(),created_by=:created_by WHERE id = :id;");
        $stmt->bindParam(":customer", $customer, PDO::PARAM_STR);
        $stmt->bindParam(":alias", $alias, PDO::PARAM_STR);
        $stmt->bindParam(":id_cost_center", $id_cost_center, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
    //===[gabo 7 agosto creado por fin===
    public function updateConditions()
    {
        $result = false;

        $id = $this->getId();
        $recruitment_fee = $this->getRecruitment_fee();
        $price_for_psychometrics = $this->getPrice_for_psychometrics();
        $price_for_talent_attraction = $this->getPrice_for_talent_attraction();
        $credit_days = $this->getCredit_days();
        $box_cut = $this->getBox_cut();

        $stmt = $this->db->prepare("UPDATE customers SET recruitment_fee = :recruitment_fee, price_for_psychometrics = :price_for_psychometrics, price_for_talent_attraction = :price_for_talent_attraction, credit_days = :credit_days, box_cut=:box_cut, modified_at = GETDATE() WHERE id = :id;");
        $stmt->bindParam(":recruitment_fee", $recruitment_fee, PDO::PARAM_STR);
        $stmt->bindParam(":price_for_psychometrics", $price_for_psychometrics, PDO::PARAM_STR);
        $stmt->bindParam(":price_for_talent_attraction", $price_for_talent_attraction, PDO::PARAM_INT);
        $stmt->bindParam(":credit_days", $credit_days, PDO::PARAM_INT);
        $stmt->bindParam(":box_cut", $box_cut, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function getCustomerCountPerMonth()
    {
        $year = $this->getCreated_at();
        $month = $this->getCreated_at();

        $stmt = $this->db->prepare("SELECT COUNT(c.id) AS total FROM customers c WHERE YEAR(c.created_at) = YEAR(:year) AND MONTH(c.created_at) = MONTH(:month)");
        $stmt->bindParam(":year", $year, PDO::PARAM_STR);
        $stmt->bindParam(":month", $month, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getCustomerCountInPreviousMonths()
    {

        $stmt = $this->db->prepare("SELECT COUNT(c.id) AS total FROM customers c WHERE YEAR(c.created_at) = YEAR(GETDATE()) AND MONTH(c.created_at) <> MONTH(GETDATE())");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }


    public function getYearlyReport()
    {
        $stmt = $this->db->prepare("SELECT 
        customer, 
        cost_center,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 1 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS january,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 2 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS february,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 3 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS march ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 4 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS april ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 5 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS may ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 6 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS june ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 7 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS july ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 8 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS august ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 9 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS september ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 10 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS octuber ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 11 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS november ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE MONTH(request_date) = 12 AND YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS december ,
        (SELECT COUNT(v.id) FROM vacancies v WHERE YEAR(request_date) = YEAR(GETDATE()) AND v.id_customer=c.id AND v.id_status <= 5) AS yearly
    FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id ORDER BY yearly DESC");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
}
