<?php

class PurchaseOrder{
    private $id;
    private $folio;
    private $emit_date;
    private $status;
    private $next_follow_up_date;
    private $id_customer;
    private $id_business_name;
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

	public function getFolio(){
		return $this->folio;
	}

	public function setFolio($folio){
		$this->folio = $folio;
	}

	public function getEmit_date(){
		return $this->emit_date;
	}

	public function setEmit_date($emit_date){
		$this->emit_date = $emit_date;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
    }
    
    public function getNext_follow_up_date(){
		return $this->next_follow_up_date;
	}

	public function setNext_follow_up_date($next_follow_up_date){
		$this->next_follow_up_date = $next_follow_up_date;
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
    
    public function purchaseOrderExists(){
        $result = FALSE;
        $folio = $this->getFolio();
		$stmt = $this->db->prepare("SELECT TOP 1 id, folio FROM purchase_orders WHERE folio = :folio", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
		$num = $stmt->rowCount();
		if ($num > 0){
			$result = $fetch->id;
		}
        return $result;
    }
    
    public function getFolioById(){
        $result = FALSE;
        $id = $this->getId();
		$stmt = $this->db->prepare("SELECT TOP 1 folio FROM purchase_orders WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        
        return $fetch->folio;
    }
    
    public function getOne(){
        $result = FALSE;
        $id = $this->getId();
		$stmt = $this->db->prepare("SELECT TOP 1 po.id, po.folio, po.emit_date, po.status, po.id_customer, c.customer, po.id_business_name, po.next_follow_up_date, ISNULL(b.folio, '') AS bill_folio FROM purchase_orders po INNER JOIN customers c ON po.id_customer=c.id LEFT JOIN bills b ON b.id_purchase_order=po.id WHERE po.id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        
        return $fetch;
	}

    public function save() {
        $result = false;
        $folio = $this->getFolio();
        $id_customer = $this->getId_customer();
        $id_business_name = $this->getId_business_name();

        $stmt = $this->db->prepare("INSERT INTO purchase_orders(folio, id_customer, id_business_name, emit_date, created_at, modified_at) VALUES (:folio, :id_customer, :id_business_name, GETDATE(), GETDATE(), GETDATE())");
        $stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
		$stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
           
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
        $folio = $this->getFolio();
        $emit_date = $this->getEmit_date();
        $id_business_name = $this->getId_business_name();
        $status = $this->getStatus();
        $next_follow_up_date = $this->getNext_follow_up_date();

        $stmt = $this->db->prepare("UPDATE purchase_orders SET folio=:folio, emit_date=:emit_date, id_business_name=:id_business_name, status=:status, next_follow_up_date=:next_follow_up_date WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->bindParam(":emit_date", $emit_date, PDO::PARAM_STR);
        $stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->bindParam(":next_follow_up_date", $next_follow_up_date, PDO::PARAM_STR);
           
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
    }
    
    public function getPurchaseOrdersByStatus(){
        $status = $this->getStatus();
        $stmt = $this->db->prepare("SELECT po.id, po.folio, po.emit_date, customer, ISNULL(business_name, 'Pendiente') AS business_name, (SELECT COUNT(va.id) FROM vacancy_applicants va WHERE va.id_purchase_order=po.id) + (SELECT COUNT(p.id) FROM psychometrics p WHERE p.id_purchase_order=po.id) AS no_services , (SELECT ISNULL(SUM(va.amount), 0) FROM vacancy_applicants va WHERE va.id_purchase_order=po.id) + (SELECT ISNULL(SUM(p.amount), 0) FROM psychometrics p WHERE p.id_purchase_order=po.id) AS total, ISNULL(b.folio, '') AS folio_fact, po.status, CASE WHEN po.status=1 THEN 'Pendiente' WHEN po.status=2 THEN 'En proceso' ELSE 'Facturada' END AS estado, po.next_follow_up_date, (SELECT TOP 1 contact_date FROM purchase_order_follow_ups pf WHERE pf.id_purchase_order=po.id ORDER BY contact_date DESC) AS last_follow_up_date, (SELECT TOP 1 comments FROM purchase_order_follow_ups pf WHERE pf.id_purchase_order=po.id ORDER BY contact_date DESC) AS last_follow_up_comments FROM purchase_orders po INNER JOIN customers c ON po.id_customer=c.id LEFT JOIN customer_business_name cbn ON po.id_business_name=cbn.id LEFT JOIN bills b ON b.id_purchase_order=po.id WHERE po.status=:status ORDER BY po.emit_date DESC");
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $purchase_orders = $stmt->fetchAll();
        return $purchase_orders;
    }

    public function getApplicantsByPurchaseOrder(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT va.id, v.request_date, c.customer, cc.cost_center, ISNULL(cbn.business_name, 'Pendiente') AS business_name, CONCAT(cnd.first_name, ' ', cnd.surname, ' ',cnd.last_name) AS candidate, v.vacancy, va.amount, v.send_date, vs.status, v.id_status, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, CONCAT(cct.first_name, ' ', cct.last_name) AS customer_contact, s.state, ct.city, s.abbreviation, CASE WHEN va.id_bill IS NULL AND va.id_purchase_order IS NULL THEN NULL WHEN va.id_bill IS NULL AND va.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customers_contacts cct ON v.id_customer_contact=cct.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy INNER JOIN candidates cnd ON va.id_candidate=cnd.id LEFT JOIN purchase_orders po ON va.id_purchase_order=po.id LEFT JOIN bills b ON va.id_bill=b.id WHERE po.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $applicants = $stmt->fetchAll();
        return $applicants;
    }

    public function getPsychometricsByPurchaseOrder(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT p.request_date, p.id, pt.type, c.first_name, c.surname, c.last_name, ct.customer, cc.cost_center, ISNULL(cbn.business_name, 'Pendiente') AS business_name, p.status, CONVERT(DATE, p.end_date) AS end_date, CASE WHEN p.status=1 THEN 'Pendiente' WHEN p.status=2 THEN 'Entregado' WHEN p.status=3 THEN 'Facturado' WHEN p.status=0 THEN 'Cancelado' END AS estado, CASE WHEN p.id_bill IS NULL AND p.id_purchase_order IS NULL THEN NULL WHEN p.id_bill IS NULL AND p.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio, p.amount FROM psychometrics p INNER JOIN psychometry_types pt ON p.id_psychometry_type=pt.id INNER JOIN candidates c ON p.id_candidate=c.id INNER JOIN customers ct ON p.id_customer=ct.id LEFT JOIN customer_business_name cbn ON p.id_business_name=cbn.id INNER JOIN cost_centers cc ON ct.id_cost_center=cc.id LEFT JOIN purchase_orders po ON p.id_purchase_order=po.id LEFT JOIN bills b ON p.id_bill=b.id WHERE po.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $psychometrics = $stmt->fetchAll();
        return $psychometrics;
    }

    public function getFollowUpsByPurchaseOrder(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM purchase_order_follow_ups pof LEFT JOIN users u ON pof.created_by=u.id WHERE id_purchase_order=:id ORDER BY pof.contact_date DESC");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $follow_ups = $stmt->fetchAll();
        return $follow_ups;
	}

}