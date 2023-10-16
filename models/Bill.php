<?php

class Bill{
    private $id;
    private $folio;
    private $emit_date;
	private $status;
	private $id_purchase_order;
    private $payment_promise_date;
	private $payment_date;
	private $iva;
	private $id_customer;
	private $id_business_name;
    private $created_at;
    private $modified_at;
    private $cancellation_date;
	private $comments;
	private $start_date;
	private $end_date;
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

	public function getId_purchase_order(){
		return $this->id_purchase_order;
	}

	public function setId_purchase_order($id_purchase_order){
		$this->id_purchase_order = $id_purchase_order;
	}

	public function getPayment_promise_date(){
		return $this->payment_promise_date;
	}

	public function setPayment_promise_date($payment_promise_date){
		$this->payment_promise_date = $payment_promise_date;
	}

	public function getPayment_date(){
		return $this->payment_date;
	}

	public function setPayment_date($payment_date){
		$this->payment_date = $payment_date;
	}

	public function getIva(){
		return $this->iva;
	}

	public function setIva($iva){
		$this->iva = $iva;
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
	
	public function getCancellation_date()
	{
		return $this->cancellation_date;
	}

	public function setCancellation_date($cancellation_date)
	{
		$this->cancellation_date = $cancellation_date;
	}

	public function getComments()
	{
		return $this->comments;
	}

	public function setComments($comments)
	{
		$this->comments = $comments;
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
    
    public function billExists(){
        $result = FALSE;
        $folio = $this->getFolio();
		$stmt = $this->db->prepare("SELECT TOP 1 id, folio FROM bills WHERE folio = :folio", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
		$num = $stmt->rowCount();
		if ($num > 0){
			$result = $fetch->id;
		}
        return $result;
	}

	public function getOne()
	{
		$result = FALSE;
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT TOP 1   b.cancellation_date,b.comments, b.id, b.folio, b.emit_date, b.status, b.id_customer, c.customer, b.id_business_name, b.payment_promise_date, CONVERT(date,b.payment_date) AS payment_date, ISNULL(po.folio, '') AS purchase_order_folio, (SELECT SUM(va.amount) FROM vacancy_applicants va WHERE va.id_bill=b.id) AS total, b.iva FROM bills b INNER JOIN customers c ON b.id_customer=c.id LEFT JOIN purchase_orders po ON b.id_purchase_order=po.id WHERE b.id = :id");
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
		$id_purchase_order = $this->getId_purchase_order();

        $stmt = $this->db->prepare("INSERT INTO bills(folio, id_customer, id_business_name, id_purchase_order, emit_date, created_at, modified_at) VALUES (:folio, :id_customer, :id_business_name, :id_purchase_order, GETDATE(), GETDATE(), GETDATE())");
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
		$stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT);
		$stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
		$stmt->bindParam(":id_purchase_order", $id_purchase_order, PDO::PARAM_INT);
           
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
		$folio = $this->getFolio();
		$emit_date = $this->getEmit_date();
		$id_business_name = $this->getId_business_name();
		$status = $this->getStatus();
		$payment_promise_date = $this->getPayment_promise_date();
		$payment_date = $this->getPayment_date();
		$iva = $this->getIva();

		$cancellation_date = $this->getCancellation_date();


		$stmt = $this->db->prepare("UPDATE bills SET folio=:folio, emit_date=:emit_date, id_business_name=:id_business_name, status=:status, payment_promise_date=:payment_promise_date, payment_date=:payment_date, iva=:iva, modified_at=GETDATE(),cancellation_date=:cancellation_date WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
		$stmt->bindParam(":emit_date", $emit_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":payment_promise_date", $payment_promise_date, PDO::PARAM_STR);
		$stmt->bindParam(":payment_date", $payment_date, PDO::PARAM_STR);
		$stmt->bindParam(":iva", $iva, PDO::PARAM_STR);
		$stmt->bindParam(":cancellation_date", $cancellation_date, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}
		return $result;
	}

	public function updateFolio() {
		$result = false;

		$id = $this->getId();
		$folio = $this->getFolio();
		
		$stmt = $this->db->prepare("UPDATE bills SET folio=:folio, modified_at=GETDATE() WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
		
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
	}

	public function getBillsByStatus()
	{
		$status = $this->getStatus();
		$stmt = $this->db->prepare("SELECT b.cancellation_date,b.comments,b.id, b.folio, b.emit_date, customer, c.credit_days, (CASE WHEN payment_date IS NULL THEN DATEDIFF(DAY, b.emit_date, CONVERT(DATE, GETDATE())) ELSE DATEDIFF(DAY, b.emit_date, CONVERT(DATE, GETDATE())) END) AS days_elapsed, ISNULL(business_name, 'Pendiente') AS business_name, b.payment_date, b.payment_promise_date, (SELECT COUNT(va.id) FROM vacancy_applicants va WHERE va.id_bill=b.id) + (SELECT ISNULL(COUNT(p.amount), 0) FROM psychometrics p WHERE p.id_bill=b.id) AS no_services , (SELECT ISNULL(SUM(va.amount), 0) FROM vacancy_applicants va WHERE va.id_bill=b.id) + (SELECT ISNULL(SUM(p.amount), 0) FROM psychometrics p WHERE p.id_bill=b.id) AS total, (SELECT ISNULL(SUM(va.amount) * b.iva, 0) FROM vacancy_applicants va WHERE va.id_bill=b.id) + (SELECT ISNULL(SUM(p.amount) * b.iva, 0) FROM psychometrics p WHERE p.id_bill=b.id) AS total_IVA, status, CASE WHEN status=1 THEN 'Pendiente de pago' WHEN status=2 THEN 'Pagada' WHEN status=3 THEN 'Cancelada' END AS estado, (SELECT TOP 1 contact_date FROM bill_follow_ups bf WHERE bf.id_bill=b.id ORDER BY contact_date DESC) AS last_follow_up_date, (SELECT TOP 1 comments FROM bill_follow_ups bf WHERE bf.id_bill=b.id ORDER BY contact_date DESC) AS last_follow_up_comments FROM bills b INNER JOIN customers c ON b.id_customer=c.id LEFT JOIN customer_business_name cbn ON b.id_business_name=cbn.id WHERE b.status=:status ORDER BY b.emit_date DESC");
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->execute();
		$bills = $stmt->fetchAll();
		return $bills;
	}
	
	public function getApplicantsByBill(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT va.id, v.request_date, c.customer, cc.cost_center, ISNULL(cbn.business_name, 'Pendiente') AS business_name, CONCAT(cnd.first_name, ' ', cnd.surname, ' ',cnd.last_name) AS candidate, v.vacancy, va.amount, v.send_date, vs.status, v.id_status, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, CONCAT(cct.first_name, ' ', cct.last_name) AS customer_contact, s.state, ct.city, s.abbreviation, CASE WHEN va.id_bill IS NULL AND va.id_purchase_order IS NULL THEN NULL WHEN va.id_bill IS NULL AND va.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customers_contacts cct ON v.id_customer_contact=cct.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy INNER JOIN candidates cnd ON va.id_candidate=cnd.id LEFT JOIN purchase_orders po ON va.id_purchase_order=po.id LEFT JOIN bills b ON va.id_bill=b.id WHERE b.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $applicants = $stmt->fetchAll();
        return $applicants;
	}
	
	public function getPsychometricsByBill(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT p.request_date, p.id, p.behavior, p.intelligence, p.labor_competencies, p.honesty_ethics_values, p.personality, p.sales_skills, p.leadership, c.first_name, c.surname, c.last_name, ct.customer, ISNULL(cbn.business_name, 'Pendiente') AS business_name, p.status, CONVERT(DATE, p.end_date) AS end_date, CASE WHEN p.status=1 THEN 'En Proceso' WHEN p.status=2 THEN 'Entregado' WHEN p.status=3 THEN 'Facturado' WHEN p.status=0 THEN 'Cancelado' END AS estado FROM psychometrics p INNER JOIN candidates c ON p.id_candidate=c.id INNER JOIN customers ct ON p.id_customer=ct.id LEFT JOIN customer_business_name cbn ON p.id_business_name=cbn.id LEFT JOIN purchase_orders po ON p.id_purchase_order=po.id LEFT JOIN bills b ON p.id_bill=b.id WHERE b.id=:id ORDER BY p.request_date DESC");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $psychometrics = $stmt->fetchAll();
        return $psychometrics;
	}

	public function getTalentAttractionsByBill()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare(
			"SELECT ta.id, ta.job_title, ta.request_date, ta.end_date, ta.id_state, ta.id_city, s.state, s.abbreviation, ct.city, ta.salary, ta.id_customer, c.customer, ta.id_business_name, bn.business_name, ta.status, ta.id_bill, ta.id_purchase_order, ta.created_by, CONCAT(u.first_name, ' ', u.last_name) AS creator, CASE WHEN ta.status = 1 THEN 'En proceso' WHEN ta.status = 2 THEN 'Finalizado' WHEN ta.status = 3 THEN 'Facturado' ELSE '-' END AS estatus, CASE WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NULL THEN NULL WHEN ta.id_bill IS NULL AND ta.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio FROM talent_attraction ta INNER JOIN customers c ON ta.id_customer=c.id INNER JOIN states s ON ta.id_state=s.id INNER JOIN cities ct ON ta.id_city=ct.id INNER JOIN users u ON ta.created_by=u.id LEFT JOIN customer_business_name bn ON ta.id_business_name=bn.id LEFT JOIN bills b ON ta.id_bill=b.id LEFT JOIN purchase_orders po ON ta.id_purchase_order=po.id WHERE b.id=:id ORDER BY ta.request_date DESC"
		);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$attractions = $stmt->fetchAll();
		return $attractions;
	}
	
	public function getFollowUpsByBill(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM bill_follow_ups bf LEFT JOIN users u ON bf.created_by=u.id WHERE id_bill=:id ORDER BY bf.contact_date DESC");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $follow_ups = $stmt->fetchAll();
        return $follow_ups;
	}

	public function updatePayment_promise_date_and_status()
	{
		$result = false;
		$id = $this->getId();
		$payment_promise_date = $this->getPayment_promise_date();
		$status = $this->getStatus();
		$cancellation_date = $this->getCancellation_date();

		if ($status == 2) {
			$stmt = $this->db->prepare("UPDATE bills SET payment_promise_date=:payment_promise_date, payment_date=GETDATE(), status=:status, modified_at=GETDATE() WHERE id=:id");
		} else {
			$stmt = $this->db->prepare("UPDATE bills SET payment_promise_date=:payment_promise_date, status=:status, modified_at=GETDATE(),cancellation_date=:cancellation_date WHERE id=:id");
		}

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":payment_promise_date", $payment_promise_date, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":cancellation_date", $cancellation_date, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}

		return $result;
	}
//=========================================[gabo 20/02/2022]===================================================================
public function update_bill()
	{  //gabo

		$result = false;
		$id = $this->getId();
		$folio = $this->getFolio();
		$emit_date = $this->getEmit_date();
		$id_business_name = $this->getId_business_name();
		$status = $this->getStatus();
		$payment_promise_date = $this->getPayment_promise_date();
		$payment_date = $this->getPayment_date();
		$iva = $this->getIva();

		$stmt = $this->db->prepare("UPDATE bills SET folio=:folio, emit_date=:emit_date, id_business_name=:id_business_name, status=:status, payment_promise_date=:payment_promise_date, payment_date=:payment_date, iva=:iva, modified_at=GETDATE() WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
		$stmt->bindParam(":emit_date", $emit_date, PDO::PARAM_STR);
		$stmt->bindParam(":id_business_name", $id_business_name, PDO::PARAM_INT);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":payment_promise_date", $payment_promise_date, PDO::PARAM_STR);
		$stmt->bindParam(":payment_date", $payment_date, PDO::PARAM_STR);
		$stmt->bindParam(":iva", $iva, PDO::PARAM_STR);
	
		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}
		public function updateInfoCancelled()
	{
		$result = false;
		$id = $this->getId();
		$comments = $this->getComments();
		$cancellation_date = $this->getCancellation_date();

		$stmt = $this->db->prepare("UPDATE bills SET  comments=:comments,cancellation_date=:cancellation_date WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":comments", $comments, PDO::PARAM_STR);
		$stmt->bindParam(":cancellation_date", $cancellation_date, PDO::PARAM_STR);
		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}
	//=======================================================================================================================
}