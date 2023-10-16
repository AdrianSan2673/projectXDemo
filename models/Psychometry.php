<?php

class Psychometry{
    private $id;
    private $request_date;
    private $id_psychometry_type;
    private $end_date;
    private $id_candidate;
    private $id_customer;
    private $id_business_name;
    private $status;
    private $id_bill;
    private $id_purchase_order;
    private $amount;
    private $behavior;
    private $intelligence;
    private $labor_competencies;
    private $honesty_ethics_values;
    private $personality;
    private $sales_skills;
    private $leadership;
    private $created_by;
    private $created_at;
    private $modified_at;

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

	public function getRequest_date(){
		return $this->request_date;
	}

	public function setRequest_date($request_date){
		$this->request_date = $request_date;
	}

	public function getId_psychometry_type(){
		return $this->id_psychometry_type;
	}

	public function setId_psychometry_type($id_psychometry_type){
		$this->id_psychometry_type = $id_psychometry_type;
	}

	public function getEnd_date(){
		return $this->end_date;
	}

	public function setEnd_date($end_date){
		$this->end_date = $end_date;
	}

	public function getId_candidate(){
		return $this->id_candidate;
	}

	public function setId_candidate($id_candidate){
		$this->id_candidate = $id_candidate;
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

    public function getBehavior(){
		return $this->behavior;
	}

	public function setBehavior($behavior){
		$this->behavior = $behavior;
	}

	public function getIntelligence(){
		return $this->intelligence;
	}

	public function setIntelligence($intelligence){
		$this->intelligence = $intelligence;
	}

	public function getLabor_competencies(){
		return $this->labor_competencies;
	}

	public function setLabor_competencies($labor_competencies){
		$this->labor_competencies = $labor_competencies;
	}

	public function getHonesty_ethics_values(){
		return $this->honesty_ethics_values;
	}

	public function setHonesty_ethics_values($honesty_ethics_values){
		$this->honesty_ethics_values = $honesty_ethics_values;
	}

	public function getPersonality(){
		return $this->personality;
	}

	public function setPersonality($personality){
		$this->personality = $personality;
	}

	public function getSales_skills(){
		return $this->sales_skills;
	}

	public function setSales_skills($sales_skills){
		$this->sales_skills = $sales_skills;
	}

	public function getLeadership(){
		return $this->leadership;
	}

	public function setLeadership($leadership){
		$this->leadership = $leadership;
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
    
    public function getAll(){
        $stmt = $this->db->prepare("SELECT p.request_date, p.id, p.behavior, p.intelligence, p.labor_competencies, p.honesty_ethics_values, p.personality, p.sales_skills, p.leadership, c.first_name, c.surname, c.last_name, ct.customer, ISNULL(cbn.business_name, 'Pendiente') AS business_name, p.status, CONVERT(DATE, p.end_date) AS end_date, CASE WHEN status=1 THEN 'En Proceso' WHEN status=2 THEN 'Entregado' WHEN status=3 THEN 'Facturado' WHEN status=0 THEN 'Cancelado' END AS estado FROM psychometrics p INNER JOIN candidates c ON p.id_candidate=c.id INNER JOIN customers ct ON p.id_customer=ct.id LEFT JOIN customer_business_name cbn ON p.id_business_name=cbn.id ORDER BY p.request_date DESC");
        $stmt->execute();
        $psychometrics = $stmt->fetchAll();
        return $psychometrics;
	}
	
	public function getPsychometricsByCustomer(){
		$id_customer = $this->getId_customer();

        $stmt = $this->db->prepare("SELECT p.request_date, p.id, c.first_name, c.surname, c.last_name, ct.customer, ISNULL(cbn.business_name, 'Pendiente') AS business_name, p.status, CONVERT(DATE, p.end_date) AS end_date, CASE WHEN status=1 THEN 'Pendiente' WHEN status=2 THEN 'Entregado' WHEN status=3 THEN 'Facturado' WHEN status=0 THEN 'Cancelado' END AS estado FROM psychometrics p  INNER JOIN candidates c ON p.id_candidate=c.id INNER JOIN customers ct ON p.id_customer=ct.id LEFT JOIN customer_business_name cbn ON p.id_business_name=cbn.id WHERE p.id_customer=:id_customer ORDER BY p.request_date DESC");
		$stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
		$stmt->execute();
        $psychometrics = $stmt->fetchAll();
        return $psychometrics;
	}

    public function getOne(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT p.id, p.request_date, c.first_name, c.surname, c.last_name, c.job_title, c.telephone, c.email, ISNULL(CONCAT(c.first_name, ' ', c.surname, ' ',c.last_name), 'No seleccionado') AS candidate, p.id_candidate, p.id_customer, p.behavior, p.intelligence, p.labor_competencies, p.honesty_ethics_values, p.personality, p.sales_skills, p.leadership, ct.customer, p.id_business_name, p.id_purchase_order, ISNULL(cbn.business_name, 'Pendiente') AS business_name, CONVERT(DATE,p.end_date) AS end_date, p.status AS status, CASE WHEN p.status = 1 THEN 'Pendiente' WHEN p.status = 2 THEN 'Entregado' WHEN p.status = 3 THEN 'Facturado' WHEN p.status = 0 THEN 'Cancelado' END AS estado, CASE WHEN p.id_bill IS NULL AND p.id_purchase_order IS NULL THEN NULL WHEN p.id_bill IS NULL AND p.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio, ROUND(p.amount,2) AS amount FROM psychometrics p INNER JOIN candidates c ON p.id_candidate=c.id INNER JOIN customers ct ON p.id_customer=ct.id LEFT JOIN customer_business_name cbn ON p.id_business_name=cbn.id LEFT JOIN purchase_orders po ON p.id_purchase_order=po.id LEFT JOIN bills b ON p.id_bill=b.id WHERE p.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function create() {
        $result = false;

        $id_candidate = $this->getId_candidate();
		$id_customer = $this->getId_customer();
		$id_business_name = $this->getId_business_name();
		$behavior = $this->getBehavior();
		$intelligence = $this->getIntelligence();
		$labor_competencies = $this->getLabor_competencies();
		$honesty_ethics_values = $this->getHonesty_ethics_values();
		$personality = $this->getPersonality();
		$sales_skills = $this->getSales_skills();
		$leadership = $this->getLeadership();

        $stmt = $this->db->prepare("INSERT INTO psychometrics(request_date, id_candidate, behavior, intelligence, labor_competencies, honesty_ethics_values, personality, sales_skills, leadership, id_customer, id_business_name, created_at, modified_at) VALUES (GETDATE(), :id_candidate, :behavior, :intelligence, :labor_competencies, :honesty_ethics_values, :personality, :sales_skills, :leadership, :id_customer, :id_business_name,  GETDATE(), GETDATE())");
		$stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
		$stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":behavior", $behavior, PDO::PARAM_INT);
		$stmt->bindParam(":intelligence", $intelligence, PDO::PARAM_INT);
		$stmt->bindParam(":labor_competencies", $labor_competencies, PDO::PARAM_INT);
		$stmt->bindParam(":honesty_ethics_values", $honesty_ethics_values, PDO::PARAM_INT);
		$stmt->bindParam(":personality", $personality, PDO::PARAM_INT);
		$stmt->bindParam(":sales_skills", $sales_skills, PDO::PARAM_INT);
		$stmt->bindParam(":leadership", $leadership, PDO::PARAM_INT);
           
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
	}
	
	public function add() {
        $result = false;

        $id_candidate = $this->getId_candidate();
		$id_psychometry_type = $this->getId_psychometry_type();
		$created_by = $this->getCreated_by();

        $stmt = $this->db->prepare("INSERT INTO candidate_psychometry(id_psychometry_type, id_candidate, created_by, created_at, modified_at) VALUES (:id_psychometry_type, :id_candidate, :created_by, GETDATE(), GETDATE())");
		$stmt->bindParam(":id_psychometry_type", $id_psychometry_type, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
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
        $request_date = $this->getRequest_date();
		$id_customer = $this->getId_customer();
        $id_business_name = $this->getId_business_name();
        $end_date = $this->getEnd_date();
        $status = $this->getStatus();
		$behavior = $this->getBehavior();
		$intelligence = $this->getIntelligence();
		$labor_competencies = $this->getLabor_competencies();
		$honesty_ethics_values = $this->getHonesty_ethics_values();
		$personality = $this->getPersonality();
		$sales_skills = $this->getSales_skills();
		$leadership = $this->getLeadership();

		$stmt = $this->db->prepare("UPDATE psychometrics SET request_date=:request_date, behavior=:behavior, intelligence=:intelligence, labor_competencies=:labor_competencies, honesty_ethics_values=:honesty_ethics_values, personality=:personality, sales_skills=:sales_skills, leadership=:leadership, id_customer=:id_customer, id_business_name=:id_business_name, end_date=:end_date, status=:status, modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":request_date", $request_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
		$stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":behavior", $behavior, PDO::PARAM_INT);
		$stmt->bindParam(":intelligence", $intelligence, PDO::PARAM_INT);
		$stmt->bindParam(":labor_competencies", $labor_competencies, PDO::PARAM_INT);
		$stmt->bindParam(":honesty_ethics_values", $honesty_ethics_values, PDO::PARAM_INT);
		$stmt->bindParam(":personality", $personality, PDO::PARAM_INT);
		$stmt->bindParam(":sales_skills", $sales_skills, PDO::PARAM_INT);
		$stmt->bindParam(":leadership", $leadership, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
	}

    public function getPsychometricsByCandidate(){
		$id_candidate = $this->getId_candidate();

        $stmt = $this->db->prepare("SELECT p.request_date, p.id, c.first_name, c.surname, c.last_name, ct.customer, cbn.business_name FROM psychometrics p INNER JOIN candidates c ON p.id_candidate=c.id INNER JOIN customers ct ON p.id_customer=ct.id LEFT JOIN customer_business_name cbn ON p.id_business_name=cbn.id WHERE p.id_candidate=:id_candidate ORDER BY p.request_date");
        $stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
        $stmt->execute();
        $psychometrics = $stmt->fetchAll();
        return $psychometrics;
	}
	
	public function getPsychometryFilesByCandidate(){
		$id_candidate = $this->getId_candidate();

        $stmt = $this->db->prepare("SELECT p.created_at, p.id, pt.type, c.first_name, c.surname, c.last_name FROM candidate_psychometry p INNER JOIN psychometry_types pt ON p.id_psychometry_type=pt.id INNER JOIN candidates c ON p.id_candidate=c.id WHERE p.id_candidate=:id_candidate ORDER BY p.id DESC");
        $stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
        $stmt->execute();
        $psychometrics = $stmt->fetchAll();
        return $psychometrics;
    }
    
    public function getPsychometricsFromCurrentWeek(){
        $stmt = $this->db->prepare("SELECT p.request_date, p.id, c.first_name, c.surname, c.last_name, ct.customer, ISNULL(cbn.business_name, 'Pendiente') AS business_name, p.status, CONVERT(DATE, p.end_date) AS end_date, CASE WHEN p.status=1 THEN 'Pendiente' WHEN p.status=2 THEN 'Entregado' WHEN p.status=3 THEN 'Facturado' WHEN p.status=0 THEN 'Cancelado' END AS estado, CASE WHEN p.id_bill IS NULL AND p.id_purchase_order IS NULL THEN NULL WHEN p.id_bill IS NULL AND p.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio FROM psychometrics p INNER JOIN candidates c ON p.id_candidate=c.id INNER JOIN customers ct ON p.id_customer=ct.id LEFT JOIN customer_business_name cbn ON p.id_business_name=cbn.id LEFT JOIN purchase_orders po ON p.id_purchase_order=po.id LEFT JOIN bills b ON p.id_bill=b.id WHERE DATEPART(WK, p.request_date) = DATEPART(WK, GETDATE()) ORDER BY p.request_date DESC");
        $stmt->execute();
        $psychometrics = $stmt->fetchAll();
        return $psychometrics;
    }

    public function getPsychometricsByDateRange(){
        $date1 = $this->getRequest_date();
        $date2 = $this->getEnd_date();

        $stmt = $this->db->prepare("SELECT p.request_date, p.id, c.first_name, c.surname, c.last_name, ct.customer, ISNULL(cbn.business_name, 'Pendiente') AS business_name, p.status, CONVERT(DATE, p.end_date) AS end_date, CASE WHEN p.status=1 THEN 'Pendiente' WHEN p.status=2 THEN 'Entregado' WHEN p.status=3 THEN 'Facturado' WHEN p.status=0 THEN 'Cancelado' END AS estado, CASE WHEN p.id_bill IS NULL AND p.id_purchase_order IS NULL THEN NULL WHEN p.id_bill IS NULL AND p.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio FROM psychometrics p INNER JOIN candidates c ON p.id_candidate=c.id INNER JOIN customers ct ON p.id_customer=ct.id LEFT JOIN customer_business_name cbn ON p.id_business_name=cbn.id LEFT JOIN purchase_orders po ON p.id_purchase_order=po.id LEFT JOIN bills b ON p.id_bill=b.id WHERE CONVERT(date, p.request_date) BETWEEN :date1 AND :date2 ORDER BY p.request_date DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();

        $psychometrics = $stmt->fetchAll();
        return $psychometrics;
    }

    public function updateBill(){
        $result = FALSE;
		$id = $this->getId();
		$id_bill = $this->getId_bill();
		$amount = $this->getAmount();
		$end_date = $this->getEnd_date();
						
        $stmt = $this->db->prepare("UPDATE psychometrics SET id_bill=:id_bill, amount=:amount, end_date=:end_date WHERE id=:id");
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
						
        $stmt = $this->db->prepare("UPDATE psychometrics SET id_purchase_order=:id_purchase_order, amount=:amount, end_date=:end_date WHERE id=:id");
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