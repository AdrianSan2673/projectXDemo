<?php

class CustomerContactsCollection{

    private $id;
    private $id_customer;
    private $name;
    private $email;
    private $phone;
    private $extension;
    private $db;

    public function __construct() {
        $this->db = Connection::connect();
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId_customer(){
		return $this->id_customer;
	}

	public function setId_customer($id_customer){
		$this->id_customer = $id_customer;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setPhone($phone){
		$this->phone = $phone;
	}

	public function getExtension(){
		return $this->extension;
	}

	public function setExtension($extension){
		$this->extension = $extension;
	}

    
    public function save()
    {
        $result = false;

        $id_customer = $this->getId_customer();
        $name = $this->getName();
        $email = $this->getEmail();
        $phone= $this->getPhone();
        $extension = $this->getExtension();

        $stmt = $this->db->prepare("INSERT INTO root.customer_contacts_collection(id_customer,name,email,phone,extension) VALUES (:id_customer,:name,:email,:phone,:extension)");
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, PDO::PARAM_INT);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_INT);
        $stmt->bindParam(":extension", $extension, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    public function update()
    {
        $result = false;

        $id = $this->getId();
        $name = $this->getname();
        $email = $this->getemail();
        $phone = $this->getphone();
        $extension = $this->getExtension();

        $stmt = $this->db->prepare("UPDATE root.customer_contacts_collection SET  name=:name,email=:email,phone=:phone,extension=:extension WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, PDO::PARAM_INT);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_INT);
        $stmt->bindParam(":extension", $extension, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }


    public function delete()
    {
        $id = $this->getId();

        $stmt = $this->db->prepare("DELETE TOP(1) root.customer_contacts_collection WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        return $fetch;
    }

    public function getOne()
    {
        $id = $this->getId();

        $stmt = $this->db->prepare("SELECT * FROM root.customer_contacts_collection WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }


    public function getALLById_cliente()
    {
        $id_customer = $this->getId_customer();

        $stmt = $this->db->prepare("SELECT * FROM root.customer_contacts_collection WHERE id_customer=:id_customer ORDER BY name");
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchAll();
        return $fetch;
    }

}