<?php

class CustomerContact{

    private $id;
    private $first_name;
    private $last_name;
    private $position;
    private $email;
    private $telephone;
    private $extension;
    private $cellphone;
    private $id_user;
    private $id_customer;
    private $birthday;

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

    public function getFirst_name(){
        return $this->first_name;
    }

    public function setFirst_name($first_name){
        $this->first_name = $first_name;
    }

    public function getLast_name(){
        return $this->last_name;
    }

    public function setLast_name($last_name){
        $this->last_name = $last_name;
    }

    public function getPosition(){
        return $this->position;
    }

    public function setPosition($position){
        $this->position = $position;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getTelephone(){
        return $this->telephone;
    }

    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function getExtension(){
        return $this->extension;
    }

    public function setExtension($extension){
        $this->extension = $extension;
    }

    public function getCellphone(){
        return $this->cellphone;
    }

    public function setCellphone($cellphone){
        $this->cellphone = $cellphone;
    }

    public function getId_user(){
        return $this->id_user;
    }

    public function setId_user($id_user){
        $this->id_user = $id_user;
    }

    public function getId_customer(){
        return $this->id_customer;
    }

    public function setId_customer($id_customer){
        $this->id_customer = $id_customer;
    }

    public function getBirthday(){
        return $this->birthday;
    }

    public function setBirthday($birthday){
        $this->birthday = $birthday;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT cc.id, cc.first_name, cc.last_name, cc.position, cc.email, cc.telephone, cc.extension, cc.cellphone, cc.id_user, u.username, u.password, c.customer, cc.birthday FROM customers_contacts cc LEFT JOIN users u ON cc.id_user=u.id INNER JOIN customers c ON cc.id_customer=c.id ORDER BY c.customer");
        $stmt->execute();
        $contacts = $stmt->fetchAll();
        return $contacts;
    }

    public function getOne(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT c.id, c.first_name, c.last_name, c.position, c.email, c.telephone, c.extension, c.cellphone, c.id_user, c.id_customer, u.username, u.password, c.birthday FROM customers_contacts c LEFT JOIN users u ON c.id_user=u.id WHERE c.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getContactByUser(){
        $id_user = $this->getId_user();
        $stmt = $this->db->prepare("SELECT cc.*, c.customer FROM customers_contacts cc INNER JOIN customers c ON c.id=cc.id_customer WHERE cc.id_user=:id_user");
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
	
	 public function getContactByUser2(){
        $id_user = $this->getId_user();
        $stmt = $this->db->prepare("SELECT cc.*, c.customer FROM customers_contacts cc INNER JOIN customers c ON c.id=cc.id_customer WHERE cc.id_user=:id_user");
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getContactsByCustomer(){
        $customer = $this->getId_customer();
        $stmt = $this->db->prepare("SELECT cc.id, cc.first_name, cc.last_name, cc.position, cc.email, cc.telephone, cc.extension, cc.cellphone, cc.id_user, u.username, cc.birthday FROM customers_contacts cc LEFT JOIN users u ON cc.id_user=u.id WHERE id_customer=:id_customer;");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $contacts = $stmt->fetchAll();
        return $contacts;
    }

	   public function getContactsByCustomer2(){
        $customer = $this->getId_customer();
        $stmt = $this->db->prepare("SELECT cc.id, cc.first_name, cc.last_name, cc.position, cc.email, cc.telephone, cc.extension, cc.cellphone, cc.id_user, u.username, cc.birthday FROM customers_contacts cc LEFT JOIN users u ON cc.id_user=u.id WHERE id_customer=:id_customer;");
        $stmt->bindParam(":id_customer", $customer, PDO::PARAM_STR);
        $stmt->execute();
        $contacts = $stmt->fetchAll();
        return $contacts;
    }
	
    public function create(){
        $result = false;

        $first_name = $this->getFirst_name();
        $last_name = $this->getLast_name();
        $position = $this->getPosition();
        $email = $this->getEmail();
        $telephone = $this->getTelephone();
        $extension = $this->getExtension();
        $cellphone = $this->getCellphone();
        $id_customer = $this->getId_customer();
        $id_user = $this->getId_user();
        $birthday = $this->getBirthday();

        $stmt = $this->db->prepare("INSERT INTO customers_contacts(first_name, last_name, position, email, telephone, extension, cellphone, id_customer, id_user, birthday) VALUES (:first_name, :last_name, :position, :email, :telephone, :extension, :cellphone, :id_customer, :id_user, :birthday);");
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":position", $position, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
        $stmt->bindParam(":extension", $extension, PDO::PARAM_STR);
        $stmt->bindParam(":cellphone", $cellphone, PDO::PARAM_STR);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->bindParam(":birthday", $birthday, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

       public function update()
    {
        $result = false;

        $id = $this->getId();
        $first_name = $this->getFirst_name();
        $last_name = $this->getLast_name();
        $position = $this->getPosition();
        $email = $this->getEmail();
        $telephone = $this->getTelephone();
        $extension = $this->getExtension();
        $cellphone = $this->getCellphone();
        $id_user = $this->getId_user();
        $birthday = $this->getBirthday();

        $stmt = $this->db->prepare("UPDATE customers_contacts SET first_name=:first_name, last_name=:last_name, position=:position, email=:email, telephone=:telephone, extension=:extension, cellphone=:cellphone, id_user=:id_user, birthday=:birthday WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":position", $position, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
        $stmt->bindParam(":extension", $extension, PDO::PARAM_STR);
        $stmt->bindParam(":cellphone", $cellphone, PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->bindParam(":birthday", $birthday, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
	
	   public function getBirthdayByClient(){
        $stmt = $this->db->prepare("SELECT con.first_name, con.last_name,con.position,con.email,con.telephone,con.extension,con.cellphone,con.birthday,c.customer,CASE
        WHEN con.birthday=FORMAT (GETDATE() - 1, 'dd/MM') THEN
            'Ayer'
            WHEN con.birthday=FORMAT (GETDATE(), 'dd/MM') THEN
            'Hoy'
            WHEN con.birthday=FORMAT (GETDATE() + 1, 'dd/MM') THEN
            'Mañana'
            WHEN con.birthday=FORMAT (GETDATE() + 2, 'dd/MM') THEN
            'Pasado mañana'
            END AS Cumple
        FROM customers c INNER JOIN customers_contacts con ON c.id=con.id_customer
        WHERE (con.birthday=FORMAT (GETDATE() - 1, 'dd/MM') OR con.birthday=FORMAT (GETDATE(), 'dd/MM') OR con.birthday=FORMAT (GETDATE() + 1, 'dd/MM') OR con.birthday=FORMAT (GETDATE()+2, 'dd/MM'))
        ORDER BY  CONCAT(SUBSTRING(con.birthday, 4, 2) ,SUBSTRING(con.birthday, 1, 2))");
        $stmt->execute();
        $contacts = $stmt->fetchAll();
        return $contacts;
    }
	
	  ////////////////////////////////////////// INICIO GABOOO ///////////////////////////////////////////
    public function getCustumerContactByidCustomerAndidUser()
    { //gabo 22/02/2022
        $result = false;
        $id_customer = $this->getId_customer();
        $id_user = $this->getId_user();
        $stmt = $this->db->prepare("SELECT * FROM customers_contacts  WHERE id_customer=:id_customer  and  id_user=:id_user;");
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_STR);
        $stmt->execute();
        $contact = $stmt->fetchObject();
       
        return $contact;
    }


    public function deleteContact_modal()
    {  //gabop 27/feb
        $result = false;

        $id = $this->getId();
        $id_customer = $this->getId_customer();
      
        $stmt = $this->db->prepare("DELETE customers_contacts where id=:id and id_customer=:id_customer");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
    ////////////////////////////////////////// FIN GABOOO ///////////////////////////////////////////
	
}