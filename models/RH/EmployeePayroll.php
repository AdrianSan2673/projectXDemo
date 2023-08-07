<?php

class EmployeePayroll
{

    private $id;
    private $gross_pay;
    private $net_pay;
    private $bank;
    private $account_number;
    private $CLABE;
    private $id_employee;
    private $modified_at;
    private $created_at;

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

    public function getGross_pay()
    {
        return $this->gross_pay;
    }

    public function setGross_pay($gross_pay)
    {
        $this->gross_pay = $gross_pay;
    }

    public function getNet_pay()
    {
        return $this->net_pay;
    }

    public function setNet_pay($net_pay)
    {
        $this->net_pay = $net_pay;
    }

    public function getBank()
    {
        return $this->bank;
    }

    public function setBank($bank)
    {
        $this->bank = $bank;
    }

    public function getAccount_number()
    {
        return $this->account_number;
    }

    public function setAccount_number($account_number)
    {
        $this->account_number = $account_number;
    }

    public function getCLABE()
    {
        return $this->CLABE;
    }

    public function setCLABE($CLABE)
    {
        $this->CLABE = $CLABE;
    }

    public function getId_employee()
    {
        return $this->id_employee;
    }

    public function setId_employee($id_employee)
    {
        $this->id_employee = $id_employee;
    }
    public function getModified_at()
    {
        return $this->modified_at;
    }

    public function setModified_at($modified_at)
    {
        $this->modified_at = $modified_at;
    }

    public function getcreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }


    public function getOne()
    {
        $id_employee = $this->getId_employee();
        $stmt = $this->db->prepare("SELECT epp.*,(select top 1 ep.gross_pay from root.employee_payroll ep where ep.id_employee=epp.id_employee ORDER BY ep.created_at ASC) start_pay FROM root.employee_payroll epp WHERE id_employee=:id_employee ORDER BY created_at DESC");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getOne1()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT epp.*,(select top 1 ep.gross_pay from root.employee_payroll ep where ep.id_employee=epp.id_employee ORDER BY ep.created_at ASC) start_pay  FROM root.employee_payroll epp WHERE id=:id  ORDER BY created_at DESC");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    public function getOneByIdEmployee()
    {
        $id_employee = $this->getId_employee();
        $stmt = $this->db->prepare("SELECT epp.*,(select top 1 ep.gross_pay from root.employee_payroll ep where ep.id_employee=epp.id_employee ORDER BY ep.created_at ASC) start_pay  FROM root.employee_payroll epp WHERE id_employee=:id_employee  ORDER BY created_at DESC");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $id_employee = $this->getId_employee();
        $stmt = $this->db->prepare("SELECT * FROM root.employee_payroll WHERE id_employee=:id_employee  ORDER BY created_at DESC");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;
        $gross_pay = $this->getGross_pay();
        $net_pay = $this->getNet_pay();
        $bank = $this->getBank();
        $account_number = $this->getAccount_number();
        $CLABE = $this->getCLABE();
        $id_employee = $this->getId_employee();
        $created_at = $this->getcreated_at();

        $stmt = $this->db->prepare("INSERT INTO root.employee_payroll(gross_pay,net_pay,bank,account_number,CLABE,id_employee,created_at,modified_at)
        VALUES(:gross_pay, :net_pay, :bank, :account_number, :CLABE, :id_employee, :created_at,GETDATE())");
        $stmt->bindParam(":gross_pay", $gross_pay, PDO::PARAM_STR);
        $stmt->bindParam(":net_pay", $net_pay, PDO::PARAM_STR);
        $stmt->bindParam(":bank", $bank, PDO::PARAM_STR);
        $stmt->bindParam(":account_number", $account_number, PDO::PARAM_STR);
        $stmt->bindParam(":CLABE", $CLABE, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_INT);

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

        $gross_pay = $this->getGross_pay();
        $net_pay = $this->getNet_pay();
        $bank = $this->getBank();
        $account_number = $this->getAccount_number();
        $CLABE = $this->getCLABE();
        $id_employee = $this->getId_employee();

        $stmt = $this->db->prepare("UPDATE root.employee_payroll SET gross_pay=:gross_pay, net_pay=:net_pay, bank=:bank, account_number=:account_number, CLABE=:CLABE,modified_at=GETDATE() WHERE id_employee=:id_employee");
        $stmt->bindParam(":gross_pay", $gross_pay, PDO::PARAM_STR);
        $stmt->bindParam(":net_pay", $net_pay, PDO::PARAM_STR);
        $stmt->bindParam(":bank", $bank, PDO::PARAM_STR);
        $stmt->bindParam(":account_number", $account_number, PDO::PARAM_STR);
        $stmt->bindParam(":CLABE", $CLABE, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;

        return $result;
    }


    public function delete()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("DELETE root.employee_payroll WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
}
