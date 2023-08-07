<?php

class Employees
{

    private $id;
    private $first_name;
    private $surname;
    private $last_name;
    private $job_title;
    private $Cliente;
    private $ID_Contacto;
    private $date_birth;
    private $id_gender;
    private $start_date;
    private $end_date;
    private $id_position;
    private $created_at;
    private $modified_at;
    private $ID_Candidato;
    private $status;
    private $scholarship;
    private $reason_for_leaving;
    private $curp;
    private $rfc;
    private $nss;
    private $re_entry_date;
    private $comment_for_leaving;
    private $employee_number;
    private $civil_status;
    private $id_razon;
    private $id_boss;
	private $id_usuario_rh;
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

    public function getFirst_name()
    {
        return $this->first_name;
    }

    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getLast_name()
    {
        return $this->last_name;
    }

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getJob_title()
    {
        return $this->job_title;
    }

    public function setJob_title($job_title)
    {
        $this->job_title = $job_title;
    }

    public function getCliente()
    {
        return $this->Cliente;
    }

    public function setCliente($Cliente)
    {
        $this->Cliente = $Cliente;
    }

    public function getID_Contacto()
    {
        return $this->ID_Contacto;
    }

    public function setID_Contacto($ID_Contacto)
    {
        $this->ID_Contacto = $ID_Contacto;
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

    public function getDate_birth()
    {
        return $this->date_birth;
    }

    public function setDate_birth($date_birth)
    {
        $this->date_birth = $date_birth;
    }

    public function getId_gender()
    {
        return $this->id_gender;
    }

    public function setId_gender($id_gender)
    {
        $this->id_gender = $id_gender;
    }

    public function getStart_date()
    {
        return $this->start_date;
    }

    public function setStart_date($start_date)
    {
        $this->start_date = $start_date;
    }

    public function getEnd_date()
    {
        return $this->end_date;
    }

    public function setEnd_date($end_date)
    {
        $this->end_date = $end_date;
    }

    public function getId_position()
    {
        return $this->id_position;
    }

    public function setId_position($id_position)
    {
        $this->id_position = $id_position;
    }

    public function getID_Candidato()
    {
        return $this->ID_Candidato;
    }

    public function setID_Candidato($ID_Candidato)
    {
        $this->ID_Candidato = $ID_Candidato;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getScholarship()
    {
        return $this->scholarship;
    }

    public function setScholarship($scholarship)
    {
        $this->scholarship = $scholarship;
    }

    public function getReason_for_leaving()
    {
        return $this->reason_for_leaving;
    }

    public function setReason_for_leaving($reason_for_leaving)
    {
        $this->reason_for_leaving = $reason_for_leaving;
    }

    public function getCurp()
    {
        return $this->curp;
    }

    public function setCurp($curp)
    {
        $this->curp = $curp;
    }

    public function getRfc()
    {
        return $this->rfc;
    }

    public function setRfc($rfc)
    {
        $this->rfc = $rfc;
    }

    public function getNss()
    {
        return $this->nss;
    }

    public function setNss($nss)
    {
        $this->nss = $nss;
    }

    public function getRe_entry_date()
    {
        return $this->re_entry_date;
    }

    public function setRe_entry_date($re_entry_date)
    {
        $this->re_entry_date = $re_entry_date;
    }

    public function getComment_for_leaving()
    {
        return $this->comment_for_leaving;
    }

    public function setComment_for_leaving($comment_for_leaving)
    {
        $this->comment_for_leaving = $comment_for_leaving;
    }

    public function getEmployee_number()
    {
        return $this->employee_number;
    }

    public function setEmployee_number($employee_number)
    {
        $this->employee_number = $employee_number;
    }

    public function getCivil_status()
    {
        return $this->civil_status;
    }

    public function setCivil_status($civil_status)
    {
        $this->civil_status = $civil_status;
    }

    public function getId_razon()
    {
        return $this->id_razon;
    }

    public function setId_razon($id_razon)
    {
        $this->id_razon = $id_razon;
    }

    public function getId_boss()
    {
        return $this->id_boss;
    }

    public function setId_boss($id_boss)
    {
        $this->id_boss = $id_boss;
    }
	
public function getId_Usuario_Rh()
    {
        return $this->id_usuario_rh;
    }

    public function setId_Usuario_Rh($id_usuario_rh)
    {
        $this->id_usuario_rh = $id_usuario_rh;
    }
	
    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT e.* ,(select top 1 ep.gross_pay from root.employee_payroll ep where ep.id_employee=e.id ORDER BY ep.created_at ASC) start_pay, (select top 1 ep.created_at from root.employee_payroll ep where ep.id_employee=e.id ORDER BY ep.created_at ASC) date_start_pay,(select top 1  ep.gross_pay from root.employee_payroll ep where ep.id_employee=e.id ORDER BY ep.created_at DESC) end_pay, (select top 1  ep.created_at from root. employee_payroll ep where ep.id_employee=e.id ORDER BY ep.created_at DESC) date_end_pay,(SELECT CONCAT(eboss.first_name,' ',eboss.surname,' ',eboss.last_name) FROM root.employees eboss WHERE eboss.id=e.id_boss) nameBoss
         FROM root.employees e WHERE e.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getEmployeeByID_Candidato()
    {
        $ID_Candidato = $this->getID_Candidato();
        $stmt = $this->db->prepare("SELECT * FROM root.employees WHERE ID_Candidato=:ID_Candidato");
        $stmt->bindParam(":ID_Candidato", $ID_Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAllEmployeesByIDcontacto()
    {
        $ID_Contacto = $this->getID_Contacto();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT e.id AS id_employee, CONCAT(e.first_name,' ',e.surname,' ',e.last_name,' - ', p.title) employePosition, e.first_name, e.surname, e.last_name, e.Cliente, Nombre_Cliente, p.title, d.department, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 date_birth,e.start_date, e.modified_at, ID_Candidato, e.employee_number,e.civil_status
        FROM root.employees e INNER JOIN rh_Ventas_Alta v ON e.Cliente=v.Cliente LEFT JOIN root.positions p ON e.id_position=p.id LEFT JOIN root.department d ON p.id_department=d.id 
        WHERE e.status=:status AND e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) ORDER BY e.first_name");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getAllEmployeesIncidenceByIDcontacto()
    {
        $id = $this->getId();
        $status = $this->getStatus();
        $ID_Contacto = $this->getID_Contacto();
        $stmt = $this->db->prepare("SELECT ei.id id_incident,e.id id_employe, p.title, CONCAT(e.first_name,' ',e.last_name,' ',e.surname) as employeFullName, ei.type,ei.comments,ei.created_at,ei.end_date,ei.modified_at,ei.amount,ei.type_of_foul,ei.hours,ei.type_of_incapacity,ei.permission,d.department
        FROM root.employees e, root.positions p, root.employee_incidence ei, root.department d
        WHERE p.id=e.id_position AND e.status=:status AND e.id=ei.id_employee AND p.id_department=d.id  AND Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) ORDER BY ei.created_at DESC");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getAllEmployeesIncidenceByIdEmployee()
    {
        $id = $this->getId();
        $status = $this->getStatus();
        $ID_Contacto = $this->getID_Contacto();
        $stmt = $this->db->prepare("SELECT ei.id id_incident,e.id id_employe, p.title, CONCAT(e.first_name,' ',e.last_name,' ',e.surname) as employeFullName, ei.type,ei.comments,ei.created_at,ei.end_date,ei.modified_at,ei.amount,ei.type_of_foul,ei.hours,ei.type_of_incapacity
        FROM root.employees e, root.positions p, root.employee_incidence ei
        WHERE e.id=:id AND p.id=e.id_position AND e.status=:status AND e.id=ei.id_employee  AND Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) ORDER BY ei.created_at DESC");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM root.employees  ORDER BY created_at DESC");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getEmployeesByContacto()
    {
        $ID_Contacto = $this->getID_Contacto();
        $stmt = $this->db->prepare("SELECT e.*, v.Nombre_Cliente FROM root.employees e LEFT JOIN rh_Ventas_Alta v ON e.Cliente=v.Cliente
         WHERE e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto)
        ORDER BY created_at DESC");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


    public function getEmployeesBirthdayCurrentMonth()
    {
        $Cliente = $this->getCliente();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT e.id id_employee,CONCAT(e.first_name,' ', e.surname,' ', e.last_name) fullName, e.id_gender, e.date_birth ,p.title, d.department, Nombre_Cliente AS nombre_comercial, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 age, image
        FROM root.employees e INNER JOIN root.positions p ON e.id_position=p.id INNER JOIN root.department d ON p.id_department=d.id INNER JOIN rrhhinge_Candidatos.dbo.rh_Ventas_Alta v ON v.Cliente=e.Cliente LEFT JOIN root.employee_avatar a ON a.id_employee=e.id
        WHERE MONTH(e.date_birth)=MONTH(GETDATE()) AND e.status=:status AND e.Cliente=:Cliente  ORDER BY MONTH(e.date_birth), DAY( e.date_birth)");
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getEmployeesBirthdayToday()
    {
        $Cliente = $this->getCliente();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT CONCAT(e.first_name,' ', e.surname,' ', e.last_name) fullName, e.id_gender, e.date_birth ,p.title, d.department, Nombre_Cliente AS nombre_comercial, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 age
        FROM root.employees e INNER JOIN root.positions p ON e.id_position=p.id INNER JOIN root.department d ON p.id_department=d.id INNER JOIN rrhhinge_Candidatos.dbo.rh_Ventas_Alta v ON v.Cliente=e.Cliente LEFT JOIN root.employee_avatar a ON a.id_employee=e.id
        WHERE MONTH(e.date_birth)=MONTH(GETDATE()) AND DAY(e.date_birth)=DAY(GETDATE()) AND e.status=:status AND e.Cliente=:Cliente ");
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getEmployeesBirthdayNextMonth()
    {
        $Cliente = $this->getCliente();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT e.id id_employee,CONCAT(e.first_name,' ', e.surname,' ', e.last_name) fullName, e.id_gender, e.date_birth ,p.title, d.department, Nombre_Cliente AS nombre_comercial, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 age, image
        FROM root.employees e INNER JOIN root.positions p ON e.id_position=p.id INNER JOIN root.department d ON p.id_department=d.id INNER JOIN rrhhinge_Candidatos.dbo.rh_Ventas_Alta v ON v.Cliente=e.Cliente LEFT JOIN root.employee_avatar a ON a.id_employee=e.id
        WHERE MONTH(e.date_birth)=MONTH(DATEADD(MM, 1, GETDATE())) AND e.status=:status AND e.Cliente =:Cliente  ORDER BY MONTH(e.date_birth), DAY( e.date_birth)");
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getFinishContracEmployee()
    {
        $ID_Contacto = $this->getID_Contacto();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT e.id id_employee,CONCAT(e.first_name,' ',e.surname,' ',e.last_name) fullName,p.title,d.department,ec.contract_start,ec.contract_end,ec.type, (SELECT Nombre_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Alta  WHERE Cliente=e.Cliente ) nombre_comercial
        FROM root.employees e, root.employee_contract ec, root.positions p, root.department d 
        WHERE e.id_position=p.id AND p.id_department=d.id AND e.status=:status AND e.id=ec.id_employee AND ec.type<>'Tiempo indeterminado'  AND ec.contract_end>GETDATE() AND DATEADD(DAY,-10,ec.contract_end)<getdate()   
        AND e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) ORDER BY  ec.contract_end DESC");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getAllEmployeeByIdBoss()
    {
        $id_boss = $this->getId_boss();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("SELECT e.id id_employee FROM root.employees e WHERE e.id_boss=:id_boss and e.status=:status ");

        $stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }




    public function getEmployeesAllInformation()
    {
        $ID_Contacto = $this->getID_Contacto();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT e.id AS id_employee, CONCAT(e.first_name,' ',e.surname,' ',e.last_name) fullName,  p.title, d.department,e.date_birth, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 age,e.start_date,dbo.GetMonthsDifference(e.start_date, GETDATE())/12 antiquity ,e.modified_at, e.employee_number,e.civil_status, e.id_gender,
                (SELECT title FROM root.positions WHERE id=p.id_boss_position) boss_title_position,
                (SELECT TOP 1  p.title FROM root.history_positions hp, root.positions p WHERE hp.id_employee=e.id AND p.id=hp.id_position ORDER BY hp.created_at DESC) history_position,
                (SELECT TOP 1  created_at FROM root.history_positions WHERE id_employee=e.id ORDER BY created_at DESC) history_position_date,
                (SELECT top 1 created_at FROM root.employee_payroll ep WHERE id_employee =e.id order by id DESC) employee_payroll,
                e.nss, e.rfc, e.curp,
                (SELECT CASE  WHEN COUNT(ef.type)>=1 THEN 'Tiene padre' WHEN  COUNT(ef.type)<=0 OR ef.type=Null THEN 'No tiene'  END  FROM root.employee_family ef WHERE ef.type=6 AND id_employee=e.id) father,
                (SELECT CASE  WHEN COUNT(ef.type)>=1 THEN 'Tiene madre' WHEN  COUNT(ef.type)<=0 OR ef.type=Null THEN 'No tiene'  END  FROM root.employee_family ef WHERE ef.type=5 AND id_employee=e.id) mother,
                (SELECT count(ef.type) FROM root.employee_family ef WHERE (ef.type=1 OR ef.type=2) AND ef.id_employee=e.id) spouse,
                (SELECT count(ef.type) FROM root.employee_family ef WHERE ef.type=4 AND ef.id_employee=e.id) son,
                (SELECT count(ef.type) FROM root.employee_family ef WHERE ef.type=3 AND ef.id_employee=e.id) daughter,
                (SELECT  ect.email FROM root.employee_contacts ect WHERE ect.id_employee=e.id ) email,
                (SELECT  ect.institutional_email FROM root.employee_contacts ect WHERE ect.id_employee=e.id ) institutional_email,
                (SELECT CONCAT( ect.phone_number1,' ',CASE  WHEN ect.label1=0 AND  ect.phone_number1<>'' THEN 'Movíl' WHEN  ect.label1=1 AND  ect.phone_number1<>'' THEN 'Casa' WHEN ect.label1=2 AND  ect.phone_number1<>'' THEN 'Principal' WHEN ect.label1=3 AND  ect.phone_number1<>'' THEN 'Trabajo' WHEN ect.label1=4 AND  ect.phone_number1<>'' THEN 'Otro' WHEN ect.label1=Null OR ect.label1=''  THEN ''  END) FROM root.employee_contacts ect WHERE ect.id_employee=e.id ) phone1,
                (SELECT CONCAT( ect.phone_number2,' ',CASE  WHEN ect.label2=0 AND  ect.phone_number2<>'' THEN 'Movíl' WHEN  ect.label2=1 AND  ect.phone_number2<>'' THEN 'Casa' WHEN ect.label2=2 AND  ect.phone_number2<>'' THEN 'Principal' WHEN ect.label2=3 AND  ect.phone_number2<>'' THEN 'Trabajo' WHEN ect.label2=4 AND  ect.phone_number2<>'' THEN 'Otro' WHEN ect.label2=Null OR ect.label2=''  THEN ''  END) FROM root.employee_contacts ect WHERE ect.id_employee=e.id ) phone2,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Periodo de prueba' ORDER BY ect.contract_start DESC) contract_start1,
                (SELECT TOP 1 ect.contract_end   FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Periodo de prueba' ORDER BY ect.contract_start DESC) contract_end1,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Capacitación inicial' ORDER BY ect.contract_start DESC) contract_start2,
                (SELECT TOP 1 ect.contract_end   FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Capacitación inicial' ORDER BY ect.contract_start DESC) contract_end2,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Laborales temporal' ORDER BY ect.contract_start DESC) contract_start3,
                (SELECT TOP 1 ect.contract_end   FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Laborales temporal' ORDER BY ect.contract_start DESC) contract_end3,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Tiempo determinado' ORDER BY ect.contract_start DESC) contract_start4,
                (SELECT TOP 1 ect.contract_end   FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Tiempo determinado' ORDER BY ect.contract_start DESC) contract_end4,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Tiempo indeterminado' ORDER BY ect.contract_start DESC) contract_start5
                FROM root.employees e INNER JOIN rh_Ventas_Alta v ON e.Cliente=v.Cliente LEFT JOIN root.positions p ON e.id_position=p.id LEFT JOIN root.department d ON p.id_department=d.id 
                WHERE e.status=:status AND e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) ORDER BY e.first_name");

        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }



    public function getEmployeesByDepartment(Department $department)
    {
        $id_department = $department->getId();

        $stmt = $this->db->prepare("SELECT * FROM root.employees e LEFT JOIN rh_Ventas_Alta v ON e.Cliente=v.Cliente LEFT JOIN root.positions p ON e.id_position=p.id WHERE p.id_department=:id_department ORDER BY surname DESC");
        $stmt->bindParam(":id_department", $id_department, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function save()
    {
        $result = false;
        $first_name = $this->getFirst_name();
        $surname = $this->getSurname();
        $last_name = $this->getLast_name();
        $job_title = $this->getJob_title();
        $Cliente = $this->getCliente();
        $ID_Contacto = $this->getID_Contacto();
        $date_birth = $this->getDate_birth();
        $id_gender = $this->getId_gender();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $id_position = $this->getId_position();
        //$ID_Candidato = $this->getID_Candidato();
        $scholarship = $this->getScholarship();
        $curp = $this->getCurp();
        $rfc = $this->getRfc();
        $nss = $this->getNss();
        $employee_number = $this->getEmployee_number();
        $civil_status = $this->getCivil_status();
        $id_razon = $this->getId_razon();
        $id_boss = $this->getId_boss();

        $stmt = $this->db->prepare("INSERT INTO root.employees (first_name, surname, last_name, Cliente, ID_Contacto, date_birth, id_gender, start_date,id_position,created_at,modified_at,scholarship,curp,rfc,nss,employee_number,civil_status,id_razon,id_boss) VALUES (:first_name, :surname, :last_name, :Cliente, :ID_Contacto, :date_birth, :id_gender, :start_date,:id_position,GETDATE(),GETDATE(),:scholarship,:curp,:rfc,:nss,:employee_number,:civil_status,:id_razon,:id_boss)");
        //$stmt = $this->db->prepare("INSERT INTO root.employees (first_name, surname, last_name, Cliente, ID_Contacto, date_birth, id_gender, start_date, ID_Candidato) VALUES (:first_name, :surname, :last_name, :Cliente, :ID_Contacto, :date_birth, :id_gender, :start_date, :id_position, :ID_Candidato)");
        //el de arriba es con id de candidato
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":date_birth", $date_birth, PDO::PARAM_STR);
        $stmt->bindParam(":id_gender", $id_gender, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        //$stmt->bindParam(":ID_Candidato", $ID_Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":scholarship", $scholarship, PDO::PARAM_INT);
        $stmt->bindParam(":curp", $curp, PDO::PARAM_INT);
        $stmt->bindParam(":rfc", $rfc, PDO::PARAM_INT);
        $stmt->bindParam(":nss", $nss, PDO::PARAM_INT);
        $stmt->bindParam(":employee_number", $employee_number, PDO::PARAM_INT);
        $stmt->bindParam(":civil_status", $civil_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_razon", $id_razon, PDO::PARAM_INT);
        $stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_INT);

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
        $first_name = $this->getFirst_name();
        $surname = $this->getSurname();
        $last_name = $this->getLast_name();
        $Cliente = $this->getCliente();
        //$ID_Contacto = $this->getID_Contacto();
        $date_birth = $this->getDate_birth();
        $id_gender = $this->getId_gender();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $id_position = $this->getId_position();
        $ID_Candidato = $this->getID_Candidato();
        $reason_for_leaving = $this->getReason_for_leaving();
        $comment_for_leaving = $this->getComment_for_leaving();
        $re_entry_date = $this->getRe_entry_date();
        $scholarship = $this->getScholarship();
        $curp = $this->getCurp();
        $rfc = $this->getRfc();
        $nss = $this->getNss();
        $employee_number = $this->getEmployee_number();
        $civil_status = $this->getCivil_status();
        $id_razon = $this->getId_razon();
        $id_boss = $this->getId_boss();


        $stmt = $this->db->prepare("UPDATE root.employees 
        SET first_name=:first_name, surname=:surname, last_name=:last_name, Cliente=:Cliente, date_birth=:date_birth, id_gender=:id_gender, start_date=:start_date, end_date=:end_date, id_position=:id_position, ID_Candidato=:ID_Candidato,modified_at=GETDATE(),reason_for_leaving=:reason_for_leaving,comment_for_leaving=:comment_for_leaving ,re_entry_date=:re_entry_date,scholarship=:scholarship,curp=:curp,rfc=:rfc,nss=:nss,employee_number=:employee_number,civil_status=:civil_status,id_razon=:id_razon,id_boss=:id_boss
        WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        //$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":date_birth", $date_birth, PDO::PARAM_STR);
        $stmt->bindParam(":id_gender", $id_gender, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Candidato", $ID_Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":reason_for_leaving", $reason_for_leaving, PDO::PARAM_INT);
        $stmt->bindParam(":comment_for_leaving", $comment_for_leaving, PDO::PARAM_INT);
        $stmt->bindParam(":scholarship", $scholarship, PDO::PARAM_INT);
        $stmt->bindParam(":re_entry_date", $re_entry_date, PDO::PARAM_INT);
        $stmt->bindParam(":curp", $curp, PDO::PARAM_INT);
        $stmt->bindParam(":rfc", $rfc, PDO::PARAM_INT);
        $stmt->bindParam(":nss", $nss, PDO::PARAM_INT);
        $stmt->bindParam(":employee_number", $employee_number, PDO::PARAM_INT);
        $stmt->bindParam(":civil_status", $civil_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_razon", $id_razon, PDO::PARAM_INT);
        $stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }


    public function updateReasonForLeaving()
    {
        $result = false;

        $id = $this->getId();
        $end_date = $this->getEnd_date();
        $reason_for_leaving = $this->getReason_for_leaving();
        $comment_for_leaving = $this->getComment_for_leaving();
        $status = $this->getStatus();


        $stmt = $this->db->prepare("UPDATE root.employees 
        SET end_date=:end_date,reason_for_leaving=:reason_for_leaving,modified_at=GETDATE(),status=:status,comment_for_leaving=:comment_for_leaving
        WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":reason_for_leaving", $reason_for_leaving, PDO::PARAM_STR);
        $stmt->bindParam(":comment_for_leaving", $comment_for_leaving, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result;
    }



    public function updateRe_entry_date()
    {
        $result = false;
        $id = $this->getId();
        $re_entry_date = $this->getRe_entry_date();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("UPDATE root.employees  SET re_entry_date=:re_entry_date,modified_at=GETDATE(),status=:status  WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":re_entry_date", $re_entry_date, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $flag = $stmt->execute();

        return $flag;
    }

    public function updateEmployeeStatus()
    {
        $result = false;

        $id = $this->getId();
        $status = $this->getStatus();


        $stmt = $this->db->prepare("UPDATE root.employees 
        SET modified_at=GETDATE(),status=:status
        WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }



    public function updateID_cadidato()
    {
        $id = $this->getId();
        $ID_Candidato = $this->getID_Candidato();

        $stmt = $this->db->prepare("UPDATE root.employees  SET ID_Candidato=:ID_Candidato  WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Candidato", $ID_Candidato, PDO::PARAM_STR);

        $result = $stmt->execute();


        return $result;
    }

    // <!-- //===[gabo 7 junio incidencias]=== -->

    public function getAllEmployeesIncidenceByIDcontactoAndFecha()
    {
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $status = $this->getStatus();
        $ID_Contacto = $this->getID_Contacto();



        $stmt = $this->db->prepare("SELECT ei.id id_incident,e.id id_employe, p.title, CONCAT(e.first_name,' ',e.last_name,' ',e.surname) as employeFullName, ei.type,ei.comments,ei.created_at,ei.end_date,ei.modified_at,ei.amount,ei.type_of_foul,ei.hours,ei.type_of_incapacity,ei.permission,d.department
        FROM root.employees e, root.positions p, root.employee_incidence ei, root.department d
        WHERE p.id=e.id_position AND e.status=:status AND e.id=ei.id_employee AND p.id_department=d.id  AND Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) AND ei.created_at>=:start_date AND ei.created_at<=:end_date ORDER BY ei.created_at DESC  ");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    //  <!-- //===[gabo 7 junio incidencias fin]=== -->

    // <!-- //===[gabo 3 JULIO MODULO RH]=== -->
    public function getAllEmployeesByCliente()
    {
        $Cliente = $this->getCliente();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT e.id AS id_employee, CONCAT(e.first_name,' ',e.surname,' ',e.last_name,' - ', p.title) employePosition, e.first_name, e.surname, e.last_name, e.Cliente, Nombre_Cliente, p.title, d.department, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 date_birth,e.start_date, e.modified_at, ID_Candidato, e.employee_number,e.civil_status
        FROM root.employees e INNER JOIN rh_Ventas_Alta v ON e.Cliente=v.Cliente LEFT JOIN root.positions p ON e.id_position=p.id LEFT JOIN root.department d ON p.id_department=d.id 
        WHERE e.status=:status AND e.Cliente =:Cliente ORDER BY e.first_name");
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getAllEmployeesIncidenceByCliente()
    {
        $status = $this->getStatus();
        $Cliente = $this->getCliente();
        $stmt = $this->db->prepare("SELECT ei.id id_incident,e.id id_employe, p.title, CONCAT(e.first_name,' ',e.last_name,' ',e.surname) as employeFullName, ei.type,ei.comments,ei.created_at,ei.end_date,ei.modified_at,ei.amount,ei.type_of_foul,ei.hours,ei.type_of_incapacity,ei.permission,d.department
        FROM root.employees e, root.positions p, root.employee_incidence ei, root.department d
        WHERE p.id=e.id_position AND e.status=:status AND e.id=ei.id_employee AND p.id_department=d.id  AND Cliente=:Cliente ORDER BY ei.created_at DESC");
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }




    public function getEmployeesAllInformationByCliente()
    {
        
        $Cliente = $this->getCliente();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT e.id AS id_employee, CONCAT(e.first_name,' ',e.surname,' ',e.last_name) fullName,  p.title, d.department,e.date_birth, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 age,e.start_date,dbo.GetMonthsDifference(e.start_date, GETDATE())/12 antiquity ,e.modified_at, e.employee_number,e.civil_status, e.id_gender,
                (SELECT title FROM root.positions WHERE id=p.id_boss_position) boss_title_position,
                (SELECT TOP 1  p.title FROM root.history_positions hp, root.positions p WHERE hp.id_employee=e.id AND p.id=hp.id_position ORDER BY hp.created_at DESC) history_position,
                (SELECT TOP 1  created_at FROM root.history_positions WHERE id_employee=e.id ORDER BY created_at DESC) history_position_date,
                (SELECT top 1 created_at FROM root.employee_payroll ep WHERE id_employee =e.id order by id DESC) employee_payroll,
                (SELECT top 1 gross_pay FROM root.employee_payroll ep WHERE id_employee =e.id order by id DESC) employee_payroll_gross_pay,
                e.nss, e.rfc, e.curp,
                (SELECT CASE  WHEN COUNT(ef.type)>=1 THEN 'Tiene padre' WHEN  COUNT(ef.type)<=0 OR ef.type=Null THEN 'No tiene'  END  FROM root.employee_family ef WHERE ef.type=6 AND id_employee=e.id) father,
                (SELECT CASE  WHEN COUNT(ef.type)>=1 THEN 'Tiene madre' WHEN  COUNT(ef.type)<=0 OR ef.type=Null THEN 'No tiene'  END  FROM root.employee_family ef WHERE ef.type=5 AND id_employee=e.id) mother,
                (SELECT count(ef.type) FROM root.employee_family ef WHERE (ef.type=1 OR ef.type=2) AND ef.id_employee=e.id) spouse,
                (SELECT count(ef.type) FROM root.employee_family ef WHERE ef.type=4 AND ef.id_employee=e.id) son,
                (SELECT count(ef.type) FROM root.employee_family ef WHERE ef.type=3 AND ef.id_employee=e.id) daughter,
                (SELECT  ect.email FROM root.employee_contacts ect WHERE ect.id_employee=e.id ) email,
                (SELECT  ect.institutional_email FROM root.employee_contacts ect WHERE ect.id_employee=e.id ) institutional_email,
                (SELECT CONCAT( ect.phone_number1,' ',CASE  WHEN ect.label1=0 AND  ect.phone_number1<>'' THEN 'Movíl' WHEN  ect.label1=1 AND  ect.phone_number1<>'' THEN 'Casa' WHEN ect.label1=2 AND  ect.phone_number1<>'' THEN 'Principal' WHEN ect.label1=3 AND  ect.phone_number1<>'' THEN 'Trabajo' WHEN ect.label1=4 AND  ect.phone_number1<>'' THEN 'Otro' WHEN ect.label1=Null OR ect.label1=''  THEN ''  END) FROM root.employee_contacts ect WHERE ect.id_employee=e.id ) phone1,
                (SELECT CONCAT( ect.phone_number2,' ',CASE  WHEN ect.label2=0 AND  ect.phone_number2<>'' THEN 'Movíl' WHEN  ect.label2=1 AND  ect.phone_number2<>'' THEN 'Casa' WHEN ect.label2=2 AND  ect.phone_number2<>'' THEN 'Principal' WHEN ect.label2=3 AND  ect.phone_number2<>'' THEN 'Trabajo' WHEN ect.label2=4 AND  ect.phone_number2<>'' THEN 'Otro' WHEN ect.label2=Null OR ect.label2=''  THEN ''  END) FROM root.employee_contacts ect WHERE ect.id_employee=e.id ) phone2,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Periodo de prueba' ORDER BY ect.contract_start DESC) contract_start1,
                (SELECT TOP 1 ect.contract_end   FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Periodo de prueba' ORDER BY ect.contract_start DESC) contract_end1,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Capacitación inicial' ORDER BY ect.contract_start DESC) contract_start2,
                (SELECT TOP 1 ect.contract_end   FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Capacitación inicial' ORDER BY ect.contract_start DESC) contract_end2,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Laborales temporal' ORDER BY ect.contract_start DESC) contract_start3,
                (SELECT TOP 1 ect.contract_end   FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Laborales temporal' ORDER BY ect.contract_start DESC) contract_end3,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Tiempo determinado' ORDER BY ect.contract_start DESC) contract_start4,
                (SELECT TOP 1 ect.contract_end   FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Tiempo determinado' ORDER BY ect.contract_start DESC) contract_end4,
                (SELECT TOP 1 ect.contract_start FROM root.employee_contract ect WHERE ect.id_employee=e.id AND ect.type='Tiempo indeterminado' ORDER BY ect.contract_start DESC) contract_start5
                FROM root.employees e INNER JOIN rh_Ventas_Alta v ON e.Cliente=v.Cliente LEFT JOIN root.positions p ON e.id_position=p.id LEFT JOIN root.department d ON p.id_department=d.id 
                WHERE e.status=:status AND e.Cliente =:Cliente ORDER BY e.first_name");

        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


    public function getAllEmployeesIncidenceByIDCliente()
    {
        $id = $this->getId();
        $status = $this->getStatus();
        $Cliente = $this->getCliente();
        $stmt = $this->db->prepare("SELECT ei.id id_incident,e.id id_employe, p.title, CONCAT(e.first_name,' ',e.last_name,' ',e.surname) as employeFullName, ei.type,ei.comments,ei.created_at,ei.end_date,ei.modified_at,ei.amount,ei.type_of_foul,ei.hours,ei.type_of_incapacity,ei.permission,d.department
        FROM root.employees e, root.positions p, root.employee_incidence ei, root.department d
        WHERE p.id=e.id_position AND e.status=:status AND e.id=ei.id_employee AND p.id_department=d.id  AND Cliente=:Cliente ORDER BY ei.created_at DESC");
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }


    public function getAllEmployeesIncidenceByClienteAndFecha()
    {
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $status = $this->getStatus();
        $Cliente = $this->getCliente();

        $stmt = $this->db->prepare("SELECT ei.id id_incident,e.id id_employe, p.title, CONCAT(e.first_name,' ',e.last_name,' ',e.surname) as employeFullName, ei.type,ei.comments,ei.created_at,ei.end_date,ei.modified_at,ei.amount,ei.type_of_foul,ei.hours,ei.type_of_incapacity,ei.permission,d.department
        FROM root.employees e, root.positions p, root.employee_incidence ei, root.department d
        WHERE p.id=e.id_position AND e.status=:status AND e.id=ei.id_employee AND p.id_department=d.id  AND Cliente=:Cliente AND ei.created_at>=:start_date AND ei.created_at<=:end_date ORDER BY ei.created_at DESC  ");
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

      public function getOneByIdUserRh()
    {
        $id_usuario_rh = $this->getId_Usuario_Rh();

        $stmt = $this->db->prepare("SELECT e.* ,(select top 1 ep.gross_pay from root.employee_payroll ep where ep.id_employee=e.id ORDER BY ep.created_at ASC) start_pay, (select top 1 ep.created_at from root.employee_payroll ep where ep.id_employee=e.id ORDER BY ep.created_at ASC) date_start_pay,(select top 1  ep.gross_pay from root.employee_payroll ep where ep.id_employee=e.id ORDER BY ep.created_at DESC) end_pay, (select top 1  ep.created_at from root. employee_payroll ep where ep.id_employee=e.id ORDER BY ep.created_at DESC) date_end_pay,(SELECT CONCAT(eboss.first_name,' ',eboss.surname,' ',eboss.last_name) FROM root.employees eboss WHERE eboss.id=e.id_boss) nameBoss
         FROM root.employees e WHERE e.usuario_rh=:id_usuario_rh");
        $stmt->bindParam(":id_usuario_rh", $id_usuario_rh, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }


    public function has_subordinates()
    {

        $id_boss = $this->getId_boss();
        $stmt = $this->db->prepare("SELECT count(*) as total_subordinados FROM root.employees  WHERE  id_boss=:id_boss");
        $stmt->bindParam(":id_boss", $id_boss, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        $result = false;
        if ($fetch->total_subordinados > 0) {
            $result = true;
        }
        return $result;
    }
	
	public function Update_Id_userRH()
    {

        $id = $this->getId();
        $usuario_rh = $this->getId_Usuario_Rh();
        $stmt = $this->db->prepare("UPDATE root.employees SET usuario_rh=:usuario_rh where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":usuario_rh", $usuario_rh, PDO::PARAM_INT);
        $flag = $stmt->execute();
        return $flag;
    }
	
	  public function Validate_Curp()
    {
        $cliente = $this->getCliente();
        $curp = $this->getCurp();

        $stmt = $this->db->prepare("SELECT * FROM root.employees where curp=:curp and Cliente=:cliente ");

        $stmt->bindParam(":curp", $curp, PDO::PARAM_INT);
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_STR);

        $stmt->execute();
        $result =  $stmt->fetchObject();
        return $result;
    }
	
	public function getAllEmployeesByIDCliente()
    {
        $Cliente = $this->getCliente();
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT e.id AS id_employee, CONCAT(e.first_name,' ',e.surname,' ',e.last_name,' - ', p.title) employePosition, e.first_name, e.surname, e.last_name, e.Cliente, Nombre_Cliente, p.title, d.department, dbo.GetMonthsDifference(e.date_birth, GETDATE())/12 date_birth,e.start_date, e.modified_at, ID_Candidato, e.employee_number,e.civil_status
        FROM root.employees e INNER JOIN rh_Ventas_Alta v ON e.Cliente=v.Cliente LEFT JOIN root.positions p ON e.id_position=p.id LEFT JOIN root.department d ON p.id_department=d.id 
        WHERE e.status=:status AND e.Cliente=:Cliente ORDER BY e.first_name");
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function getEmployeesAllHolidaysRequested()
    {
        $Cliente = $this->getCliente();
        $stmt = $this->db->prepare(
            "SELECT 
            e.first_name,
            e.surname,
            e.last_name,
            eh.start_date,
            eh.end_date,
			eh.created_at,
			eh.id,
			eh.status,
			eh.comments,
            dbo.count_days(eh.start_date, eh.end_date) + 1 AS days,
            ISNULL((SELECT top(1) holidays FROM root.holidays_by_years WHERE years = (dbo.GetMonthsDifference(e.start_date, GETDATE())/12)), 0) AS holidays_by_year,
            ISNULL((SELECT top(1) SUM(dbo.count_days(eh.start_date, eh.end_date) + 1) FROM root.employee_holidays eh WHERE eh.status='Aceptada' and  e.id=eh.id_employee AND eh.start_date BETWEEN DATEADD(YEAR, (dbo.GetMonthsDifference(eh.start_date, GETDATE())/12), eh.start_date) AND DATEADD(YEAR, (dbo.GetMonthsDifference(eh.start_date, GETDATE())/12) + 1, eh.start_date) ), 0) AS taken_holidays
        FROM  
            root.employees e INNER JOIN root.employee_holidays eh ON e.id=eh.id_employee 
        WHERE e.status=1  and e.Cliente=:Cliente
		
        ORDER BY eh.id DESC"
        );
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
}
