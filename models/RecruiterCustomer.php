<?php

class RecruiterCustomer{
	private $id;
	private $id_recruiter;
	private $id_customer;

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

    public function getId_recruiter(){
    	return $this->id_recruiter;
    }

    public function setId_recruiter($id_recruiter){
    	$this->id_recruiter = $id_recruiter;
    }

    public function getId_customer(){
    	return $this->id_customer;
    }

    public function setId_customer($id_customer){
    	$this->id_customer = $id_customer;
    }

    public function getUnassignedCustomers(){

        $stmt = $this->db->prepare("SELECT c.id, customer, alias, cc.cost_center, created_at, modified_at  FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id LEFT JOIN recruiter_customers rc ON c.id=rc.id_customer WHERE rc.id_customer IS NULL ORDER BY customer ASC");
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
    }
    
    public function getRecruiterByCustomer(){
        $customer = $this->getId_customer();
        $stmt = $this->db->prepare("SELECT u.id, u.first_name, u.last_name FROM users u INNER JOIN recruiter_customers rc ON u.id=rc.id_recruiter WHERE rc.id_customer=:id_customer");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $recluiter = $stmt->fetchAll();
        return $recluiter;
    }

    public function getCustomersByRecruiter(){
		$id_recruiter = $this->getId_recruiter();

        $stmt = $this->db->prepare("SELECT c.id, customer, alias, cc.cost_center, created_at, modified_at  FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN recruiter_customers rc ON c.id=rc.id_customer WHERE rc.id_recruiter=:id_recruiter ORDER BY customer ASC");
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_INT);
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
	}

    public function create(){
		$result = false;

		$id_recruiter = $this->getId_recruiter();
        $id_customer = $this->getId_customer();

        $stmt = $this->db->prepare("INSERT INTO recruiter_customers(id_recruiter, id_customer) VALUES (:id_recruiter, :id_customer)");
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);

		$flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function delete(){
    	$result = false;

		$id_recruiter = $this->getId_recruiter();
        $id_customer = $this->getId_customer();

        $stmt = $this->db->prepare("DELETE FROM recruiter_customers WHERE id_recruiter=:id_recruiter AND id_customer=:id_customer");
        $stmt->bindParam(":id_recruiter", $id_recruiter, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);

		$flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}