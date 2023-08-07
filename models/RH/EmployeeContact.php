<?php

class EmployeeContact
{
    private $id;
    private $phone_number1;
    private $label1;
    private $phone_number2;
    private $label2;
    private $email;
    private $emergency_number1;
    private $emergency_contact1;
    private $emergency_relationship1;
    private $emergency_number2;
    private $emergency_contact2;
    private $emergency_relationship2;
    private $institutional_email;
    private $id_employee;

    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPhone_number1()
    {
        return $this->phone_number1;
    }

    public function setPhone_number1($phone_number1)
    {
        $this->phone_number1 = $phone_number1;
    }

    public function getLabel1()
    {
        return $this->label1;
    }

    public function setLabel1($label1)
    {
        $this->label1 = $label1;
    }

    public function getPhone_number2()
    {
        return $this->phone_number2;
    }

    public function setPhone_number2($phone_number2)
    {
        $this->phone_number2 = $phone_number2;
    }

    public function getLabel2()
    {
        return $this->label2;
    }

    public function setLabel2($label2)
    {
        $this->label2 = $label2;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmergency_number1()
    {
        return $this->emergency_number1;
    }

    public function setEmergency_number1($emergency_number1)
    {
        $this->emergency_number1 = $emergency_number1;
    }

    public function getEmergency_contact1()
    {
        return $this->emergency_contact1;
    }

    public function setEmergency_contact1($emergency_contact1)
    {
        $this->emergency_contact1 = $emergency_contact1;
    }

    public function getEmergency_relationship1()
    {
        return $this->emergency_relationship1;
    }

    public function setEmergency_relationship1($emergency_relationship1)
    {
        $this->emergency_relationship1 = $emergency_relationship1;
    }

    public function getEmergency_number2()
    {
        return $this->emergency_number2;
    }

    public function setEmergency_number2($emergency_number2)
    {
        $this->emergency_number2 = $emergency_number2;
    }

    public function getEmergency_contact2()
    {
        return $this->emergency_contact2;
    }

    public function setEmergency_contact2($emergency_contact2)
    {
        $this->emergency_contact2 = $emergency_contact2;
    }

    public function getEmergency_relationship2()
    {
        return $this->emergency_relationship2;
    }

    public function setEmergency_relationship2($emergency_relationship2)
    {
        $this->emergency_relationship2 = $emergency_relationship2;
    }

    public function getId_employee()
    {
        return $this->id_employee;
    }

    public function setId_employee($id_employee)
    {
        $this->id_employee = $id_employee;
    }

    public function getInstitutional_email(){
		return $this->institutional_email;
	}

	public function setInstitutional_email($institutional_email){
		$this->institutional_email = $institutional_email;
	}


    public function getOne()
    {
        $id_employee = $this->getId_employee();
        $stmt = $this->db->prepare("SELECT * FROM root.employee_contacts WHERE id_employee=:id_employee");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function save()
    {
        $result = false;

        $phone_number1 = $this->getPhone_number1();
        $label1 = $this->getLabel1();
        $phone_number2 = $this->getPhone_number2();
        $label2 = $this->getLabel2();
        $email = $this->getEmail();
        $emergency_number1 = $this->getEmergency_number1();
        $emergency_contact1 = $this->getEmergency_contact1();
        $emergency_relationship1 = $this->getEmergency_relationship1();
        $emergency_number2 = $this->getEmergency_number2();
        $emergency_contact2 = $this->getEmergency_contact2();
        $emergency_relationship2 = $this->getEmergency_relationship2();
        $id_employee = $this->getId_employee();

        $stmt = $this->db->prepare("INSERT INTO root.employee_contacts VALUES(:phone_number1, :label1, :phone_number2, :label2, :email, :emergency_number1, :emergency_contact1, :emergency_relationship1, :emergency_number2, :emergency_contact2, :emergency_relationship2, :id_employee)");
        $stmt->bindParam(":phone_number1", $phone_number1, PDO::PARAM_STR);
        $stmt->bindParam(":label1", $label1, PDO::PARAM_STR);
        $stmt->bindParam(":phone_number2", $phone_number2, PDO::PARAM_STR);
        $stmt->bindParam(":label2", $label2, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_number1", $emergency_number1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_contact1", $emergency_contact1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_relationship1", $emergency_relationship1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_number2", $emergency_number2, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_contact2", $emergency_contact2, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_relationship2", $emergency_relationship2, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }

        return $result;
    }

    public function save1()
    {
        $result = false;
        $phone_number1 = $this->getPhone_number1();
        $label1 = $this->getLabel1();
        $phone_number2 = $this->getPhone_number2();
        $label2 = $this->getLabel2();
        $email = $this->getEmail();
        $institutional_email=$this->getInstitutional_email();
        $id_employee = $this->getId_employee();

        $stmt = $this->db->prepare("INSERT INTO root.employee_contacts (phone_number1,label1,phone_number2,label2,email, id_employee,institutional_email) VALUES(:phone_number1, :label1, :phone_number2, :label2, :email, :id_employee,:institutional_email)");

        $stmt->bindParam(":phone_number1", $phone_number1, PDO::PARAM_STR);
        $stmt->bindParam(":label1", $label1, PDO::PARAM_STR);
        $stmt->bindParam(":phone_number2", $phone_number2, PDO::PARAM_STR);
        $stmt->bindParam(":label2", $label2, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":institutional_email", $institutional_email, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }

        return $result;
    }




    public function save2()
    {
        $result = false;
        $emergency_number1 = $this->getEmergency_number1();
        $emergency_contact1 = $this->getEmergency_contact1();
        $emergency_relationship1 = $this->getEmergency_relationship1();
        $emergency_number2 = $this->getEmergency_number2();
        $emergency_contact2 = $this->getEmergency_contact2();
        $emergency_relationship2 = $this->getEmergency_relationship2();
        $id_employee = $this->getId_employee();

        $stmt = $this->db->prepare("INSERT INTO root.employee_contacts (emergency_number1, emergency_contact1, emergency_relationship1, emergency_number2, emergency_contact2, emergency_relationship2, id_employee) VALUES(:emergency_number1, :emergency_contact1, :emergency_relationship1, :emergency_number2, :emergency_contact2, :emergency_relationship2, :id_employee)");

        $stmt->bindParam(":emergency_number1", $emergency_number1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_contact1", $emergency_contact1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_relationship1", $emergency_relationship1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_number2", $emergency_number2, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_contact2", $emergency_contact2, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_relationship2", $emergency_relationship2, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

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

        $phone_number1 = $this->getPhone_number1();
        $label1 = $this->getLabel1();
        $phone_number2 = $this->getPhone_number2();
        $label2 = $this->getLabel2();
        $email = $this->getEmail();
        $emergency_number1 = $this->getEmergency_number1();
        $emergency_contact1 = $this->getEmergency_contact1();
        $emergency_relationship1 = $this->getEmergency_relationship1();
        $emergency_number2 = $this->getEmergency_number2();
        $emergency_contact2 = $this->getEmergency_contact2();
        $emergency_relationship2 = $this->getEmergency_relationship2();
        $id_employee = $this->getId_employee();

        $stmt = $this->db->prepare("UPDATE root.employee_contacts SET phone_number1=:phone_number1, label1=:label1, phone_number2=:phone_number2, label2=:label2, email=:email, emergency_number1=:emergency_number1, emergency_contact1=:emergency_contact1, emergency_relationship1=:emergency_relationship1, emergency_number2=:emergency_number2, emergency_contact2=:emergency_contact2, emergency_relationship2=:emergency_relationship2 WHERE id_employee=:id_employee");
        $stmt->bindParam(":phone_number1", $phone_number1, PDO::PARAM_STR);
        $stmt->bindParam(":label1", $label1, PDO::PARAM_STR);
        $stmt->bindParam(":phone_number2", $phone_number2, PDO::PARAM_STR);
        $stmt->bindParam(":label2", $label2, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_number1", $emergency_number1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_contact1", $emergency_contact1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_relationship1", $emergency_relationship1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_number2", $emergency_number2, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_contact2", $emergency_contact2, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_relationship2", $emergency_relationship2, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag)
            $result = true;

        return $result;
    }




    public function updateContact()
    {
        $result = false;
        $phone_number1 = $this->getPhone_number1();
        $label1 = $this->getLabel1();
        $phone_number2 = $this->getPhone_number2();
        $label2 = $this->getLabel2();
        $email = $this->getEmail();
        $institutional_email=$this->getInstitutional_email();
        $id_employee = $this->getId_employee();
        

        $stmt = $this->db->prepare("UPDATE root.employee_contacts SET phone_number1=:phone_number1, label1=:label1, phone_number2=:phone_number2, label2=:label2, email=:email,institutional_email=:institutional_email WHERE id_employee=:id_employee");
        $stmt->bindParam(":phone_number1", $phone_number1, PDO::PARAM_STR);
        $stmt->bindParam(":label1", $label1, PDO::PARAM_STR);
        $stmt->bindParam(":phone_number2", $phone_number2, PDO::PARAM_STR);
        $stmt->bindParam(":label2", $label2, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":institutional_email", $institutional_email, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag)
            $result = true;

        return $result;
    }


    public function updateContactEmergency()
    {
        $result = false;
        $emergency_number1 = $this->getEmergency_number1();
        $emergency_contact1 = $this->getEmergency_contact1();
        $emergency_relationship1 = $this->getEmergency_relationship1();
        $emergency_number2 = $this->getEmergency_number2();
        $emergency_contact2 = $this->getEmergency_contact2();
        $emergency_relationship2 = $this->getEmergency_relationship2();
        $id_employee = $this->getId_employee();

        $stmt = $this->db->prepare("UPDATE root.employee_contacts SET emergency_number1=:emergency_number1, emergency_contact1=:emergency_contact1, emergency_relationship1=:emergency_relationship1, emergency_number2=:emergency_number2, emergency_contact2=:emergency_contact2, emergency_relationship2=:emergency_relationship2 WHERE id_employee=:id_employee");

        $stmt->bindParam(":emergency_number1", $emergency_number1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_contact1", $emergency_contact1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_relationship1", $emergency_relationship1, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_number2", $emergency_number2, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_contact2", $emergency_contact2, PDO::PARAM_STR);
        $stmt->bindParam(":emergency_relationship2", $emergency_relationship2, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag)
            $result = true;

        return $result;
    }



    public function getEmailsByIdEmployee(){
        $id_employee= $this->getId_employee();
        $stmt = $this->db->prepare("SELECT email, institutional_email FROM root.employee_contacts WHERE id_employee=:id_employee");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    

    }
}
