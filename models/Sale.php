<?php

class Sale {
    private $id;
    private $price;
    private $id_product;
    private $orderID;
    private $payerID;
    private $paymentID;
    private $paymentSource;
    private $id_user;
    
    private $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId_product(){
		return $this->id_product;
	}

	public function setId_product($id_product){
		$this->id_product = $id_product;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}

	public function getOrderID(){
		return $this->orderID;
	}

	public function setOrderID($orderID){
		$this->orderID = $orderID;
	}

	public function getPayerID(){
		return $this->payerID;
	}

	public function setPayerID($payerID){
		$this->payerID = $payerID;
	}

	public function getPaymentID(){
		return $this->paymentID;
	}

	public function setPaymentID($paymentID){
		$this->paymentID = $paymentID;
	}

	public function getPaymentSource(){
		return $this->paymentSource;
	}

	public function setPaymentSource($paymentSource){
		$this->paymentSource = $paymentSource;
	}

	public function getId_user(){
		return $this->id_user;
	}

	public function setId_user($id_user){
		$this->id_user = $id_user;
	}

    public function create() {
		$result = false;

        $id_product = $this->getId_product();
        $price = $this->getPrice();
        $orderID = $this->getOrderID();
        $payerID = $this->getPayerID();
        $paymentID = $this->getPaymentID();
        $paymentSource = $this->getPaymentSource();
        $id_user = $this->getId_user();

		$id_user = $this->getId_user();
        $stmt = $this->db->prepare("INSERT INTO sales (id_product, price, orderID, payerID, paymentID, paymentSource, id_user, created_at) VALUES(:id_product, :price, :orderID, :payerID, :paymentID, :paymentSource, :id_user, GETDATE())");
		$stmt->bindParam(":id_product", $id_product, PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":orderID", $orderID, PDO::PARAM_STR);
        $stmt->bindParam(":payerID", $payerID, PDO::PARAM_STR);
        $stmt->bindParam(":paymentID", $paymentID, PDO::PARAM_STR);
        $stmt->bindParam(":paymentSource", $paymentSource, PDO::PARAM_STR);
		$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        
        return $result;
    }

    public function getOne() {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM sales WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute())
            return $stmt->fetchObject();
        else
            return false;
    }

    public function getSalesByUser(){

        $id_user = $this->getId_user();
        $stmt = $this->db->prepare("SELECT * FROM sales WHERE id_user=:id_user ORDER BY id DESC");
		$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $sales = $stmt->fetchAll();
        return $sales;
	}

}