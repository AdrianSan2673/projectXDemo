<?php

class EmployeeHolidays{
    private $id;
    private $start_date;
    private $end_date;
    private $comments;
    private $id_employee;
    private $ID_Contacto;

    private $db;

	public function __construct(){
		$this->db = Connection::connectSA();
	}


    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getStart_date(){
		return $this->start_date;
	}

	public function setStart_date($start_date){
		$this->start_date = $start_date;
	}

	public function getEnd_date(){
		return $this->end_date;
	}

	public function setEnd_date($end_date){
		$this->end_date = $end_date;
	}

	public function getComments(){
		return $this->comments;
	}

	public function setComments($comments){
		$this->comments = $comments;
	}

	public function getId_employee(){
		return $this->id_employee;
	}

	public function setId_employee($id_employee){
		$this->id_employee = $id_employee;
	}

	public function getID_Contacto(){
		return $this->ID_Contacto;
	}

	public function setID_Contacto($ID_Contacto){
		$this->ID_Contacto = $ID_Contacto;
	}

    public function getEmployeesHolidaysByContacto(){
        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare(
            "SELECT 
            e.id, 
            e.first_name, 
            e.surname, 
            e.last_name, 
            e.ID_Contacto,
            e.start_date, 
            (dbo.GetMonthsDifference(e.start_date, GETDATE())/12) as years, 
            ISNULL((SELECT holidays FROM root.holidays_by_years WHERE years = (dbo.GetMonthsDifference(e.start_date, GETDATE())/12)), 0) AS holidays_by_year,
            ISNULL((SELECT SUM(dbo.count_days(eh.start_date, eh.end_date) + 1) FROM root.employee_holidays eh WHERE e.id=eh.id_employee AND eh.start_date BETWEEN DATEADD(YEAR, (dbo.GetMonthsDifference(e.start_date, GETDATE())/12), e.start_date) AND DATEADD(YEAR, (dbo.GetMonthsDifference(e.start_date, GETDATE())/12) + 1, e.start_date) ), 0) AS taken_holidays,
            CASE WHEN (dbo.GetMonthsDifference(e.start_date, GETDATE())/12) = 0 THEN 'Sin días' ELSE CONVERT(varchar, DATEADD(YEAR, (dbo.GetMonthsDifference(e.start_date, GETDATE())/12) + 1, e.start_date))END AS due_date
        FROM 
            root.employees e
        WHERE e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) AND status=1
        GROUP BY e.id, e.first_name, e.surname, e.last_name, e.ID_Contacto, e.start_date, e.end_date
        ORDER BY e.surname");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getEmployeesHolidaysRequestedByContacto(){
        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare(
        "SELECT 
            e.first_name,
            e.surname,
            e.last_name,
            eh.start_date,
            eh.end_date,
            dbo.count_days(eh.start_date, eh.end_date) + 1 AS days,
            ISNULL((SELECT holidays FROM root.holidays_by_years WHERE years = (dbo.GetMonthsDifference(e.start_date, GETDATE())/12)), 0) AS holidays_by_year,
            ISNULL((SELECT SUM(dbo.count_days(eh.start_date, eh.end_date) + 1) FROM root.employee_holidays eh WHERE e.id=eh.id_employee AND eh.start_date BETWEEN DATEADD(YEAR, (dbo.GetMonthsDifference(e.start_date, GETDATE())/12), e.start_date) AND DATEADD(YEAR, (dbo.GetMonthsDifference(e.start_date, GETDATE())/12) + 1, e.start_date) ), 0) AS taken_holidays
        FROM  
            root.employees e INNER JOIN root.employee_holidays eh ON e.id=eh.id_employee
        WHERE e.Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) AND status=1
        ORDER BY eh.start_date DESC");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function create(){
		$result = false;

		$id_employee = $this->getId_employee();
		$start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
        $comments = $this->getComments();
		$ID_Contacto = $this->getID_Contacto();

		$stmt = $this->db->prepare("INSERT INTO root.employee_holidays (start_date, end_date, comments, id_employee, ID_Contacto, created_at) VALUES (:start_date, :end_date, :comments, :id_employee, :ID_Contacto, GETDATE())");

		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}

    public function update()
	{
		$id = $this->getId();
		$id_employee = $this->getId_employee();
        $start_date = $this->getStart_date();
        $end_date = $this->getEnd_date();
		$comments = $this->getComments();
        $ID_Contacto = $this->getID_Contacto();

		$stmt = $this->db->prepare("UPDATE root.employee_holidays SET start_date=:start_date, end_date=:end_date, comments=:comments, id_employee=:id_employee, ID_Contacto=:ID_Contacto, modified_at=GETDATE() WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag)
			$result = true;

		return $result;
	}
}