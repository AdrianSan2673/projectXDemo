<?php

class RecluiterCustomer{
	private $id;
	private $id_recluiter;
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

    public function getId_recluiter(){
    	return $this->id_recluiter;
    }

    public function setId_recluiter($id_recluiter){
    	$this->id_recluiter = $id_recluiter;
    }

    public function getId_customer(){
    	return $this->id_customer;
    }

    public function setId_customer($id_customer){
    	$this->id_customer = $id_customer;
    }

    public function getUnassignedCustomers(){

        $stmt = $this->db->prepare("SELECT c.id, customer, alias, cc.cost_center, created_at, modified_at  FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id LEFT JOIN recluiter_customers rc ON c.id=rc.id_customer WHERE rc.id_customer IS NULL ORDER BY customer ASC");
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
	}

    public function getCustomersByRecluiter(){
		$id_recluiter = $this->getId_recluiter();

        $stmt = $this->db->prepare("SELECT c.id, customer, alias, cc.cost_center, created_at, modified_at  FROM customers c INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN recluiter_customers rc ON c.id=rc.id_customer WHERE rc.id_recluiter=:id_recluiter ORDER BY customer ASC");
        $stmt->bindParam(":id_recluiter", $id_recluiter, PDO::PARAM_INT);
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
	}

    public function create(){
		$result = false;

		$id_recluiter = $this->getId_recluiter();
        $id_customer = $this->getId_customer();

        $stmt = $this->db->prepare("INSERT INTO recluiter_customers(id_recluiter, id_customer) VALUES (:id_recluiter, :id_customer)");
        $stmt->bindParam(":id_recluiter", $id_recluiter, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);

		$flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function delete(){
    	$result = false;

		$id_recluiter = $this->getId_recluiter();
        $id_customer = $this->getId_customer();

        $stmt = $this->db->prepare("DELETE FROM recluiter_customers WHERE id_recluiter=:id_recluiter AND id_customer=:id_customer");
        $stmt->bindParam(":id_recluiter", $id_recluiter, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);

		$flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}