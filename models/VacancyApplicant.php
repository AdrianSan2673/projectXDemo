<?php

class VacancyApplicant
{
	private $id;
	private $applicant_date;
	private $id_vacancy;
	private $id_candidate;
	private $id_status;
	private $about;
	private $recruiter_date;
	private $customer_date;
	private $entry_date;
	private $id_bill;
	private $id_purchase_order;
	private $amount;
	private $interview_comments;
	private $interview_date;
	private $video_call_url;
	private $id_profile;
	private $comments;
	//gabo activar
	private $descard_date;
	private $db;

	public function __construct()
	{
		$this->db = Connection::connect();
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getApplicant_date()
	{
		return $this->applicant_date;
	}

	public function setApplicant_date($applicant_date)
	{
		$this->applicant_date = $applicant_date;
	}

	public function getId_vacancy()
	{
		return $this->id_vacancy;
	}

	public function setId_vacancy($id_vacancy)
	{
		$this->id_vacancy = $id_vacancy;
	}

	public function getId_candidate()
	{
		return $this->id_candidate;
	}

	public function setId_candidate($id_candidate)
	{
		$this->id_candidate = $id_candidate;
	}

	public function getId_status()
	{
		return $this->id_status;
	}

	public function setId_status($id_status)
	{
		$this->id_status = $id_status;
	}

	public function getAbout()
	{
		return $this->about;
	}

	public function setAbout($about)
	{
		$this->about = $about;
	}

	public function getRecruiter_date()
	{
		return $this->recruiter_date;
	}

	public function setRecruiter_date($recruiter_date)
	{
		$this->recruiter_date = $recruiter_date;
	}

	public function getCustomer_date()
	{
		return $this->customer_date;
	}

	public function setCustomer_date($customer_date)
	{
		$this->customer_date = $customer_date;
	}

	public function getEntry_date()
	{
		return $this->entry_date;
	}

	public function setEntry_date($entry_date)
	{
		$this->entry_date = $entry_date;
	}

	public function getId_bill()
	{
		return $this->id_bill;
	}

	public function setId_bill($id_bill)
	{
		$this->id_bill = $id_bill;
	}

	public function getId_purchase_order()
	{
		return $this->id_purchase_order;
	}

	public function setId_purchase_order($id_purchase_order)
	{
		$this->id_purchase_order = $id_purchase_order;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function setAmount($amount)
	{
		$this->amount = $amount;
	}

	public function getInterview_comments()
	{
		return $this->interview_comments;
	}

	public function setInterview_comments($interview_comments)
	{
		$this->interview_comments = $interview_comments;
	}

	public function getInterview_date()
	{
		return $this->interview_date;
	}

	public function setInterview_date($interview_date)
	{
		$this->interview_date = $interview_date;
	}

	public function getVideo_call_url()
	{
		return $this->video_call_url;
	}

	public function setVideo_call_url($video_call_url)
	{
		$this->video_call_url = $video_call_url;
	}

	public function getId_profile()
	{
		return $this->id_profile;
	}

	public function setId_profile($id_profile)
	{
		$this->id_profile = $id_profile;
	}

	public function getComments()
	{
		return $this->comments;
	}

	public function setComments($comments)
	{
		$this->comments = $comments;
	}
	//gabo activar
	public function getDescard_date()
	{
		return $this->descard_date;
	}

	public function setDescard_date($descard_date)
	{
		$this->descard_date = $descard_date;
	}

	public function getApplicantByVacancy()
	{
		$id_vacancy = $this->getId_vacancy();

		$stmt = $this->db->prepare("SELECT * FROM vacancy_applicants WHERE id_vacancy=:id_vacancy");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}

	public function getApplicantsByCandidate()
	{
		$id_candidate = $this->getId_candidate();

		$stmt = $this->db->prepare("SELECT v.id, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, v.vacancy, s.abbreviation, ct.city, c.customer, cc.cost_center, v.salary_min, v.salary_max, v.send_date, CASE WHEN v.end_date IS NULL THEN CONCAT(dbo.count_days(v.request_date, GETDATE()),'d ', (DATEDIFF(MINUTE, v.request_date, GETDATE()))%1440/60, 'h ')ELSE CONCAT(dbo.count_days(v.request_date, v.end_date),'d ', (DATEDIFF(MINUTE,v.request_date, v.end_date))%1440/60, 'h ') END AS number_days, CASE WHEN v.end_date IS NULL THEN dbo.count_days(v.request_date, GETDATE()) ELSE dbo.count_days(v.request_date, v.end_date) END AS n_days, vs.status, v.id_status, v.end_date, v.functions, va.applicant_date, vas.status AS applicant_status, va.about, va.interview_comments, va.interview_date FROM vacancies v INNER JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id INNER JOIN vacancy_applicants va ON va.id_vacancy=v.id INNER JOIN vacancy_applicant_status vas ON va.id_status=vas.id WHERE va.id_candidate=:id_candidate AND v.id_status < 6 ORDER BY applicant_date DESC");
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->execute();
		$vacancies = $stmt->fetchAll();
		return $vacancies;
	}
	//inventel
	//correo al postular candidato
	public function getOne()
	{
		$id_vacancy = $this->getId_vacancy();
		$id_candidate = $this->getId_candidate();
		$stmt = $this->db->prepare("SELECT  va.id_profile ,va.applicant_date, va.id_vacancy, va.id_candidate, va.id_status, va.about, v.request_date, v.vacancy, c.first_name, c.surname, c.last_name, va.video_call_url FROM vacancy_applicants va LEFT JOIN vacancies v ON va.id_vacancy=v.id LEFT JOIN candidates c ON va.id_candidate=c.id WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");

		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("SELECT c.id, c.first_name, c.surname, c.last_name, description, job_title, CONCAT(u.first_name, ' ', u.last_name) AS created_by, c.id_gender, ISNULL(edl.level,'NA') AS level, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age, CONCAT(ct.city, ', ', s.abbreviation) AS residence, ISNULL(ct.city, 'NA') AS city, s.abbreviation AS state, v.vacancy, cust.customer, v.salary_min, v.salary_max, ISNULL(va.id_status, '') AS id_status, ISNULL(vas.status,'') AS status, va.applicant_date, va.about, va.entry_date, va.id AS id_applicant, va.interview_comments, va.interview_date, c.created_at FROM candidates c LEFT JOIN candidate_experience cexp ON c.id=cexp.id_candidate INNER JOIN states s ON c.id_state=s.id INNER JOIN cities ct ON c.id_city=ct.id INNER JOIN vacancy_applicants va ON va.id_candidate=c.id INNER JOIN vacancies v ON va.id_vacancy=v.id LEFT JOIN customers cust ON v.id_customer=cust.id INNER JOIN vacancy_applicant_status vas ON va.id_status=vas.id LEFT JOIN candidate_education ced ON c.id=ced.id_candidate INNER JOIN education_levels edl ON ced.id_level=edl.id LEFT JOIN users u ON c.created_by=u.id GROUP BY c.id, c.first_name, c.surname, c.last_name, description, job_title, c.id_gender, date_birth, age, city, abbreviation, v.vacancy, cust.customer, v.salary_min, v.salary_max, va.id_status, vas.status, edl.level, va.applicant_date, va.about, va.entry_date, va.id, va.interview_comments, va.interview_date, u.first_name, u.last_name, c.created_at ORDER BY va.applicant_date DESC");
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}

	public function getTotal()
	{
		$id_vacancy = $this->getId_vacancy();
		$id_candidate = $this->getId_candidate();

		$stmt = $this->db->prepare("SELECT COUNT(id) AS total FROM vacancy_applicants WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch->total;
	}

	public function create()
	{
		$result = false;

		$id_vacancy = $this->getId_vacancy();
		$id_candidate = $this->getId_candidate();

		$stmt = $this->db->prepare("INSERT INTO vacancy_applicants(applicant_date, id_vacancy, id_candidate, id_status) VALUES (GETDATE(), :id_vacancy, :id_candidate, 1)");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function updateStatus()
	{
		$result = false;

		$id_vacancy = $this->getId_vacancy();
		$id_candidate = $this->getId_candidate();
		$id_status = $this->getId_status();
		$entry_date = $this->getEntry_date();
		$amount = $this->getAmount();

		$recruiter_date = $this->getRecruiter_date();
		$customer_date = $this->getCustomer_date();

		if ($id_status == 2 && $recruiter_date) {
			$stmt = $this->db->prepare("UPDATE vacancy_applicants SET id_status=:id_status, entry_date=:entry_date, amount=:amount, recruiter_date=GETDATE() WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");
		} elseif ($id_status == 3 && $customer_date) {
			$stmt = $this->db->prepare("UPDATE vacancy_applicants SET id_status=:id_status, entry_date=:entry_date, amount=:amount, customer_date=GETDATE() WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");
		} else {
			$stmt = $this->db->prepare("UPDATE vacancy_applicants SET id_status=:id_status, entry_date=:entry_date, amount=:amount WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");
		}


		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);
		$stmt->bindParam(":entry_date", $entry_date, PDO::PARAM_STR);
		$stmt->bindParam(":amount", $amount, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function updateDescription()
	{
		$result = false;

		$id_vacancy = $this->getId_vacancy();
		$id_candidate = $this->getId_candidate();
		$id_status = $this->getId_status();
		$about = $this->getAbout();
		$video_call_url = $this->getVideo_call_url();

		if ($id_status == 3) {
			$stmt = $this->db->prepare("UPDATE vacancy_applicants SET about=:about, video_call_url=:video_call_url WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");
		} else {
			$stmt = $this->db->prepare("UPDATE vacancy_applicants SET about=:about, video_call_url=:video_call_url, customer_date=GETDATE(), id_status=3 WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");
		}

		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":about", $about, PDO::PARAM_STR);
		$stmt->bindParam(":video_call_url", $video_call_url, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function delete()
	{
		$result = false;

		$id_vacancy = $this->getId_vacancy();
		$id_candidate = $this->getId_candidate();

		$stmt = $this->db->prepare("DELETE FROM vacancy_applicants WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function getApplicantById()
	{
		$id_applicant = $this->getId();
		$stmt = $this->db->prepare("SELECT TOP(1) v.id, va.id AS id_applicant, CONCAT(u.first_name, ' ', u.last_name) AS recruiter, v.request_date, v.id_customer AS id_customer, v.id_business_name AS id_business_name, c.customer, v.vacancy, ISNULL(CONCAT(cnd.first_name, ' ', cnd.surname, ' ',cnd.last_name), 'No seleccionado') AS candidate, s.abbreviation, ct.city, cc.cost_center, v.salary_min, v.salary_max, ISNULL(cbn.business_name, 'Pendiente') AS business_name, va.entry_date, va.id_purchase_order, va.id_bill, ROUND(va.amount,2) AS amount, v.send_date, CASE WHEN va.id_bill IS NULL AND va.id_purchase_order IS NULL THEN NULL WHEN va.id_bill IS NULL AND va.id_purchase_order IS NOT NULL THEN po.folio ELSE b.folio END AS folio, interview_comments, va.interview_date FROM vacancies v LEFT JOIN users u ON v.id_recruiter=u.id INNER JOIN customers c ON v.id_customer=c.id LEFT JOIN customer_business_name cbn ON v.id_business_name=cbn.id INNER JOIN cost_centers cc ON c.id_cost_center=cc.id INNER JOIN states s ON v.id_state=s.id INNER JOIN cities ct ON v.id_city=ct.id INNER JOIN vacancy_status vs ON v.id_status=vs.id LEFT JOIN vacancy_applicants va ON v.id=va.id_vacancy INNER JOIN candidates cnd ON va.id_candidate=cnd.id LEFT JOIN purchase_orders po ON va.id_purchase_order=po.id LEFT JOIN bills b ON va.id_bill=b.id WHERE va.id=:id_applicant");
		$stmt->bindParam(":id_applicant", $id_applicant, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}


	public function updateBill()
	{
		$result = FALSE;
		$id = $this->getId();
		$id_bill = $this->getId_bill();
		$amount = $this->getAmount();
		$entry_date = $this->getEntry_date();

		$stmt = $this->db->prepare("UPDATE vacancy_applicants SET id_bill=:id_bill, amount=:amount, entry_date=:entry_date WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":id_bill", $id_bill, PDO::PARAM_INT);
		$stmt->bindParam(":amount", $amount, PDO::PARAM_STR);
		$stmt->bindParam(":entry_date", $entry_date, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function updatePurchaseOrder()
	{
		$result = FALSE;
		$id = $this->getId();
		$id_purchase_order = $this->getId_purchase_order();
		$amount = $this->getAmount();
		$entry_date = $this->getEntry_date();

		$stmt = $this->db->prepare("UPDATE vacancy_applicants SET id_purchase_order=:id_purchase_order, amount=:amount, entry_date=:entry_date WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":id_purchase_order", $id_purchase_order, PDO::PARAM_INT);
		$stmt->bindParam(":amount", $amount, PDO::PARAM_STR);
		$stmt->bindParam(":entry_date", $entry_date, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function updateBillByPurchaseOrder()
	{
		$result = FALSE;
		$id = $this->getId();
		$id_bill = $this->getId_bill();
		$id_purchase_order = $this->getId_purchase_order();

		$stmt = $this->db->prepare("UPDATE vacancy_applicants SET id_bill=:id_bill WHERE id_purchase_order=:id_purchase_order");
		$stmt->bindParam(":id_bill", $id_bill, PDO::PARAM_INT);
		$stmt->bindParam(":id_purchase_order", $id_purchase_order, PDO::PARAM_INT);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function updateInterview()
	{
		$result = FALSE;
		$id = $this->getId();
		$interview_comments = $this->getInterview_comments();
		$interview_date = $this->getInterview_date();

		$stmt = $this->db->prepare("UPDATE vacancy_applicants SET interview_comments=:interview_comments, interview_date=:interview_date WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":interview_comments", $interview_comments, PDO::PARAM_STR);
		$stmt->bindParam(":interview_date", $interview_date, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function updateVideoCallURL()
	{
		$result = false;

		$id_vacancy = $this->getId_vacancy();
		$id_candidate = $this->getId_candidate();
		$video_call_url = $this->getVideo_call_url();

		$stmt = $this->db->prepare("UPDATE vacancy_applicants SET video_call_url=:video_call_url WHERE id_vacancy=:id_vacancy AND id_candidate=:id_candidate");

		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":video_call_url", $video_call_url, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	//==================================[Gabo Marzo 21]==========================
	public function move_postulant()
	{
		$result = false;
		$id_vacancy = $this->getId_vacancy();
		$id_candidate = $this->getId_candidate();

		$stmt = $this->db->prepare("INSERT INTO vacancy_applicants(applicant_date,customer_date, id_vacancy, id_candidate, id_status) VALUES (GETDATE(),GETDATE(), :id_vacancy, :id_candidate, 3)");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}
	//======================================+=========================


	//======================[Gabo Marzo 28 Perfil Postulado]===============
	public function update_id_profile()
	{
		$result = false;
		$id_candidate = $this->getId_candidate();
		$id_vacancy = $this->getId_vacancy();
		$id_profile = $this->getId_profile();

		$stmt = $this->db->prepare("UPDATE TOP(1) vacancy_applicants SET   id_profile=:id_profile  WHERE id_candidate=:id_candidate AND id_vacancy=:id_vacancy ");
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_profile", $id_profile, PDO::PARAM_INT);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}


	public function update_profile()
	{
		$result = false;

		$id_candidate = $this->getId_candidate();
		$id_vacancy = $this->getId_vacancy();
		$id_profile = $this->getId_profile();

		$stmt = $this->db->prepare("UPDATE TOP(1) vacancy_applicants SET   id_profile=:id_profile  WHERE id_candidate=:id_candidate AND id_vacancy=:id_vacancy ");
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_profile", $id_profile, PDO::PARAM_INT);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}


	//========================================================

	//gabo act

	public function update_comments()
	{
		$result = false;

		$id_candidate = $this->getId_candidate();
		$id_vacancy = $this->getId_vacancy();
		$comments = $this->getComments();
		//gabo activar
		$stmt = $this->db->prepare("UPDATE TOP(1) vacancy_applicants  SET   comments=:comments, descard_date=GETDATE()  WHERE id_candidate=:id_candidate AND id_vacancy=:id_vacancy ");
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":comments", $comments, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}

	//gabo 26
	public function getOneByCandidate()
	{

		$id_candidate = $this->getId_candidate();
		$stmt = $this->db->prepare("SELECT  TOP (1) *  from vacancy_applicants WHERE id_candidate=:id_candidate AND id_profile is not null order by applicant_date  DESC ");

		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}
	//gabo 27
	public function getVacanciesTypeOperativaByCandidate()
	{

		$id_candidate = $this->getId_candidate();
		$stmt = $this->db->prepare("select * from candidates c INNER JOIN vacancy_applicants va ON va.id_candidate=c.id INNER JOIN vacancies 
		v ON va.id_vacancy=v.id where v.type=1 and va.id_candidate=:id_candidate");

		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}
}
