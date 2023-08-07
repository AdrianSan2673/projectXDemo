<?php

class TalentAttraction{
    private $id;
    private $job_title;
    private $request_date;
    private $end_date;
    private $id_state;
    private $id_city;
    private $salary;
    private $id_customer;
    private $id_business_name;
    private $status;
    private $id_bill;
    private $id_purchase_order;
    private $amount;
    private $created_by;
    private $created_at;
    private $modified_at;

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

	public function getJob_title(){
		return $this->job_title;
	}

	public function setJob_title($job_title){
		$this->job_title = $job_title;
	}

	public function getRequest_date(){
		return $this->request_date;
	}

	public function setRequest_date($request_date){
		$this->request_date = $request_date;
	}

	public function getEnd_date(){
		return $this->end_date;
	}

	public function setEnd_date($end_date){
		$this->end_date = $end_date;
	}

	public function getId_state(){
		return $this->id_state;
	}

	public function setId_state($id_state){
		$this->id_state = $id_state;
	}

	public function getId_city(){
		return $this->id_city;
	}

	public function setId_city($id_city){
		$this->id_city = $id_city;
	}

	public function getSalary(){
		return $this->salary;
	}

	public function setSalary($salary){
		$this->salary = $salary;
	}

	public function getId_customer(){
		return $this->id_customer;
	}

	public function setId_customer($id_customer){
		$this->id_customer = $id_customer;
	}

	public function getId_business_name(){
		return $this->id_business_name;
	}

	public function setId_business_name($id_business_name){
		$this->id_business_name = $id_business_name;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getId_bill(){
		return $this->id_bill;
	}

	public function setId_bill($id_bill){
		$this->id_bill = $id_bill;
	}

	public function getId_purchase_order(){
		return $this->id_purchase_order;
	}

	public function setId_purchase_order($id_purchase_order){
		$this->id_purchase_order = $id_purchase_order;
	}

    public function getAmount(){
        return $this->amount;
    }

    public function setAmount($amount){
        $this->amount = $amount;
    }

	public function getCreated_by(){
		return $this->created_by;
	}

	public function setCreated_by($created_by){
		$this->created_by = $created_by;
	}

	public function getCreated_at(){
		return $this->created_at;
	}

	public function setCreated_at($created_at){
		$this->created_at = $created_at;
	}

	public function getModified_at(){
		return $this->modified_at;
	}

	public function setModified_at($modified_at){
		$this->modified_at = $modified_at;
	}

    public function getOne(){
        $id = $this->getId();

        $stmt = $this->db->prepare("SELECT ta.id, ta.job_title, ta.request_date, ta.end_date, ta.id_state, ta.id_city, s.state, s.abbreviation, ct.city, ta.salary, ta.id_customer, c.customer, ta.id_business_name, bn.business_name, ta.status, ta.id_bill, ta.id_purchase_order, created_by, CONCAT(u.first_name, ' ', u.last_name) AS creator, CASE WHEN ta.status = 1 THEN 'En proceso' WHEN ta.status = 2 THEN 'Finalizado' WHEN ta.status = 3 THEN 'Facturado' ELSE '-' END AS estatus, CASE WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NULL THEN NULL WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio, ta.amount FROM talent_attraction ta INNER JOIN customers c ON ta.id_customer=c.id INNER JOIN states s ON ta.id_state=s.id INNER JOIN cities ct ON ta.id_city=ct.id INNER JOIN users u ON ta.created_by=u.id LEFT JOIN customer_business_name bn ON ta.id_business_name=bn.id LEFT JOIN bills b ON ta.id_bill=b.id LEFT JOIN purchase_orders po ON ta.id_purchase_order=po.id WHERE ta.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getAll(){
        $stmt = $this->db->prepare(
        "SELECT ta.id, ta.job_title, ta.request_date, ta.end_date, ta.id_state, ta.id_city, s.state, s.abbreviation, ct.city, ta.salary, ta.id_customer, c.customer, ta.id_business_name, bn.business_name, ta.status, ta.id_bill, ta.id_purchase_order, created_by, CONCAT(u.first_name, ' ', u.last_name) AS creator, CASE WHEN ta.status = 1 THEN 'En proceso' WHEN ta.status = 2 THEN 'Finalizado' WHEN ta.status = 3 THEN 'Facturado' ELSE '-' END AS estatus, CASE WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NULL THEN NULL WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio FROM talent_attraction ta INNER JOIN customers c ON ta.id_customer=c.id INNER JOIN states s ON ta.id_state=s.id INNER JOIN cities ct ON ta.id_city=ct.id INNER JOIN users u ON ta.created_by=u.id LEFT JOIN customer_business_name bn ON ta.id_business_name=bn.id LEFT JOIN bills b ON ta.id_bill=b.id LEFT JOIN purchase_orders po ON ta.id_purchase_order=po.id ORDER BY ta.request_date DESC"
        );
        $stmt->execute();

        $attractions = $stmt->fetchAll();
        return $attractions;
    }

    public function getAttractionsFromTheLast60Days(){
        $stmt = $this->db->prepare(
        "SELECT ta.id, ta.job_title, ta.request_date, ta.end_date, ta.id_state, ta.id_city, s.state, s.abbreviation, ct.city, ta.salary, ta.id_customer, c.customer, ta.id_business_name, bn.business_name, ta.status, ta.id_bill, ta.id_purchase_order, created_by, CONCAT(u.first_name, ' ', u.last_name) AS creator, CASE WHEN ta.status = 1 THEN 'En proceso' WHEN ta.status = 2 THEN 'Finalizado' WHEN ta.status = 3 THEN 'Facturado' ELSE '-' END AS estatus, CASE WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NULL THEN NULL WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio FROM talent_attraction ta INNER JOIN customers c ON ta.id_customer=c.id INNER JOIN states s ON ta.id_state=s.id INNER JOIN cities ct ON ta.id_city=ct.id INNER JOIN users u ON ta.created_by=u.id LEFT JOIN customer_business_name bn ON ta.id_business_name=bn.id LEFT JOIN bills b ON ta.id_bill=b.id LEFT JOIN purchase_orders po ON ta.id_purchase_order=po.id WHERE ta.request_date >= DATEADD(DAY, -60, GETDATE()) ORDER BY ta.request_date DESC"
        );
        $stmt->execute();

        $attractions = $stmt->fetchAll();
        return $attractions;
    }

    public function getAttractionsByDateRange(){
        $date1 = $this->getRequest_date();
        $date2 = $this->getEnd_date();

        $stmt = $this->db->prepare(
        "SELECT ta.id, ta.job_title, ta.request_date, ta.end_date, ta.id_state, ta.id_city, s.state, s.abbreviation, ct.city, ta.salary, ta.id_customer, c.customer, ta.id_business_name, bn.business_name, ta.status, ta.id_bill, ta.id_purchase_order, created_by, CONCAT(u.first_name, ' ', u.last_name) AS creator, CASE WHEN ta.status = 1 THEN 'En proceso' WHEN ta.status = 2 THEN 'Finalizado' WHEN ta.status = 3 THEN 'Facturado' ELSE '-' END AS estatus, CASE WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NULL THEN NULL WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio FROM talent_attraction ta INNER JOIN customers c ON ta.id_customer=c.id INNER JOIN states s ON ta.id_state=s.id INNER JOIN cities ct ON ta.id_city=ct.id INNER JOIN users u ON ta.created_by=u.id LEFT JOIN customer_business_name bn ON ta.id_business_name=bn.id LEFT JOIN bills b ON ta.id_bill=b.id LEFT JOIN purchase_orders po ON ta.id_purchase_order=po.id WHERE CONVERT(date, ta.request_date) BETWEEN :date1 AND :date2 ORDER BY ta.request_date DESC"
        );
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();

        $attractions = $stmt->fetchAll();
        return $attractions;
    }

    public function create() {
        
        $result = false;

        $job_title = $this->getJob_title();
        $request_date = $this->getRequest_date();
        $end_date = $this->getEnd_date();
        $id_state = $this->getId_state();
        $id_city = $this->getId_city();
        $salary = $this->getSalary();
        $id_customer = $this->getId_customer();
        $id_business_name = $this->getId_business_name();
        $status = $this->getStatus();
        $id_bill = $this->getId_bill();
        $id_purchase_order = $this->getId_purchase_order();
        $created_by = $this->getCreated_by();

        $stmt = $this->db->prepare("INSERT INTO talent_attraction (job_title, request_date, end_date, id_state, id_city, salary, id_customer, id_business_name, status, id_bill, id_purchase_order, created_by, created_at, modified_at) VALUES(:job_title, :request_date, :end_date, :id_state, :id_city, :salary, :id_customer, :id_business_name, :status, :id_bill, :id_purchase_order, :created_by, GETDATE(), GETDATE())");
        $stmt->bindParam(":job_title", $job_title, PDO::PARAM_STR);
        $stmt->bindParam(":request_date", $request_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":id_state", $id_state, PDO::PARAM_INT);
        $stmt->bindParam(":id_city", $id_city, PDO::PARAM_INT);
        $stmt->bindParam(":salary", $salary, PDO::PARAM_STR);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
        $stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":id_bill", $id_bill, PDO::PARAM_INT);
        $stmt->bindParam(":id_purchase_order", $id_purchase_order, PDO::PARAM_INT);
        $stmt->bindParam(":created_by", $created_by, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        
        return $result;
    }

    public function update() {
        $result = false;

        $id = $this->getId();
        $job_title = $this->getJob_title();
        $request_date = $this->getRequest_date();
        $end_date = $this->getEnd_date();
        $id_state = $this->getId_state();
        $id_city = $this->getId_city();
        $salary = $this->getSalary();
        $id_customer = $this->getId_customer();
        $id_business_name = $this->getId_business_name();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("UPDATE talent_attraction SET job_title=:job_title, request_date=:request_date, end_date=:end_date, id_state=:id_state, id_city=:id_city, salary=:salary, id_customer=:id_customer, id_business_name=:id_business_name, status=:status, modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":job_title", $job_title, PDO::PARAM_STR);
        $stmt->bindParam(":request_date", $request_date, PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":id_state", $id_state, PDO::PARAM_INT);
        $stmt->bindParam(":id_city", $id_city, PDO::PARAM_INT);
        $stmt->bindParam(":salary", $salary, PDO::PARAM_STR);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
        $stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateBill(){
        $result = FALSE;
		$id = $this->getId();
		$id_bill = $this->getId_bill();
		$amount = $this->getAmount();
		$end_date = $this->getEnd_date();
						
        $stmt = $this->db->prepare("UPDATE talent_attraction SET id_bill=:id_bill, amount=:amount, end_date=:end_date WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":id_bill", $id_bill, PDO::PARAM_INT);
		$stmt->bindParam(":amount", $amount, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        
		$flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
	}

    public function updatePurchaseOrder(){
        $result = FALSE;
		$id = $this->getId();
		$id_purchase_order = $this->getId_purchase_order();
		$amount = $this->getAmount();
		$end_date = $this->getEnd_date();
						
        $stmt = $this->db->prepare("UPDATE talent_attraction SET id_purchase_order=:id_purchase_order, amount=:amount, end_date=:end_date WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":id_purchase_order", $id_purchase_order, PDO::PARAM_INT);
		$stmt->bindParam(":amount", $amount, PDO::PARAM_STR);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        
		$flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
	}
}