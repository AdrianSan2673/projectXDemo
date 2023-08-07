<?php

class BusinessName{
    private $id;
    private $business_name;
    private $RFC;
    private $fiscal_address;
    private $method_of_payment;
    private $fiscal_regime;
    private $use_of_CFDI;
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

    public function getBusiness_name(){
        return $this->business_name;
    }

    public function setBusiness_name($business_name){
        $this->business_name = $business_name;
    }

    public function getRFC(){
        return $this->RFC;
    }

    public function setRFC($RFC){
        $this->RFC = $RFC;
    }

    public function getFiscal_address(){
		return $this->fiscal_address;
	}

	public function setFiscal_address($fiscal_address){
		$this->fiscal_address = $fiscal_address;
	}

	public function getMethod_of_payment(){
		return $this->method_of_payment;
	}

	public function setMethod_of_payment($method_of_payment){
		$this->method_of_payment = $method_of_payment;
	}

	public function getFiscal_regime(){
		return $this->fiscal_regime;
	}

	public function setFiscal_regime($fiscal_regime){
		$this->fiscal_regime = $fiscal_regime;
	}

	public function getUse_of_CFDI(){
		return $this->use_of_CFDI;
	}

	public function setUse_of_CFDI($use_of_CFDI){
		$this->use_of_CFDI = $use_of_CFDI;
	}

    public function getId_customer(){
        return $this->id_customer;
    }

    public function setId_customer($id_customer){
        $this->id_customer = $id_customer;
    }

    public function getOne(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT c.id, c.business_name, c.RFC, c.fiscal_address, c.method_of_payment, c.fiscal_regime, c.use_of_CFDI, c.id_customer FROM customer_business_name c WHERE c.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getBNByCustomer(){
        $customer = $this->getId_customer();
        $stmt = $this->db->prepare("SELECT * FROM customer_business_name WHERE id_customer=:id_customer;");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $business_names = $stmt->fetchAll();
        return $business_names;
    }

    public function create(){
        $result = false;

        $business_name = $this->getBusiness_name();
        $RFC = $this->getRFC();
        $fiscal_address = $this->getFiscal_address();
        $method_of_payment = $this->getMethod_of_payment();
        $fiscal_regime = $this->getFiscal_regime();
        $use_of_CFDI = $this->getUse_of_CFDI();
        $id_customer = $this->getId_customer();

        $stmt = $this->db->prepare("INSERT INTO customer_business_name(business_name, RFC, fiscal_address, method_of_payment, fiscal_regime, use_of_CFDI, id_customer) VALUES (:business_name, :RFC, :fiscal_address, :method_of_payment, :fiscal_regime, :use_of_CFDI, :id_customer);");
        $stmt->bindParam(":business_name", $business_name, PDO::PARAM_STR);
        $stmt->bindParam(":RFC", $RFC, PDO::PARAM_STR);
        $stmt->bindParam(":fiscal_address", $fiscal_address, PDO::PARAM_STR);
        $stmt->bindParam(":method_of_payment", $method_of_payment, PDO::PARAM_STR);
        $stmt->bindParam(":fiscal_regime", $fiscal_regime, PDO::PARAM_STR);
        $stmt->bindParam(":use_of_CFDI", $use_of_CFDI, PDO::PARAM_STR);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function update(){
        $result = false;

        $id = $this->getId();
        $business_name = $this->getBusiness_name();
        $RFC = $this->getRFC();
        $fiscal_address = $this->getFiscal_address();
        $method_of_payment = $this->getMethod_of_payment();
        $fiscal_regime = $this->getFiscal_regime();
        $use_of_CFDI = $this->getUse_of_CFDI();

        $stmt = $this->db->prepare("UPDATE customer_business_name SET business_name=:business_name, RFC=:RFC, fiscal_address=:fiscal_address, method_of_payment=:method_of_payment, fiscal_regime=:fiscal_regime, use_of_CFDI=:use_of_CFDI WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":business_name", $business_name, PDO::PARAM_STR);
        $stmt->bindParam(":RFC", $RFC, PDO::PARAM_STR);
        $stmt->bindParam(":fiscal_address", $fiscal_address, PDO::PARAM_STR);
        $stmt->bindParam(":method_of_payment", $method_of_payment, PDO::PARAM_STR);
        $stmt->bindParam(":fiscal_regime", $fiscal_regime, PDO::PARAM_STR);
        $stmt->bindParam(":use_of_CFDI", $use_of_CFDI, PDO::PARAM_STR);

        $flag = $stmt->execute();
        
        if ($flag) {
            $result = true;
        }
        return $result;
    }    
}