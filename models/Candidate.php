<?php

class Candidate
{

	private $id;
	private $first_name;
	private $surname;
	private $last_name;
	private $date_birth;
	private $age;
	private $id_gender;
	private $id_civil_status;
	private $job_title;
	private $description;
	private $telephone;
	private $cellphone;
	private $email;
	private $id_state;
	private $id_city;
	private $id_area;
	private $id_subarea;
	private $linkedinn;
	private $facebook;
	private $instagram;
	private $created_at;
	private $modified_at;
	private $id_user;
	private $created_by;

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

	public function getDate_birth()
	{
		return $this->date_birth;
	}

	public function setDate_birth($date_birth)
	{
		$this->date_birth = $date_birth;
	}

	public function getAge()
	{
		return $this->age;
	}

	public function setAge($age)
	{
		$this->age = $age;
	}

	public function getId_gender()
	{
		return $this->id_gender;
	}

	public function setId_gender($id_gender)
	{
		$this->id_gender = $id_gender;
	}

	public function getId_civil_status()
	{
		return $this->id_civil_status;
	}

	public function setId_civil_status($id_civil_status)
	{
		$this->id_civil_status = $id_civil_status;
	}

	public function getJob_title()
	{
		return $this->job_title;
	}

	public function setJob_title($job_title)
	{
		$this->job_title = $job_title;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getTelephone()
	{
		return $this->telephone;
	}

	public function setTelephone($telephone)
	{
		$this->telephone = $telephone;
	}

	public function getCellphone()
	{
		return $this->cellphone;
	}

	public function setCellphone($cellphone)
	{
		$this->cellphone = $cellphone;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getId_state()
	{
		return $this->id_state;
	}

	public function setId_state($id_state)
	{
		$this->id_state = $id_state;
	}

	public function getId_city()
	{
		return $this->id_city;
	}

	public function setId_city($id_city)
	{
		$this->id_city = $id_city;
	}

	//
	public function getId_area()
	{
		return $this->id_area;
	}

	public function setId_area($id_area)
	{
		$this->id_area = $id_area;
	}

	public function getId_subarea()
	{
		return $this->id_subarea;
	}

	public function setId_subarea($id_subarea)
	{
		$this->id_subarea = $id_subarea;
	}
	//
	public function getLinkedinn()
	{
		return $this->linkedinn;
	}

	public function setLinkedinn($linkedinn)
	{
		$this->linkedinn = $linkedinn;
	}

	public function getFacebook()
	{
		return $this->facebook;
	}

	public function setFacebook($facebook)
	{
		$this->facebook = $facebook;
	}

	public function getInstagram()
	{
		return $this->instagram;
	}

	public function setInstagram($instagram)
	{
		$this->instagram = $instagram;
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

	public function getId_user()
	{
		return $this->id_user;
	}

	public function setId_user($id_user)
	{
		$this->id_user = $id_user;
	}

	public function getCreated_by()
	{
		return $this->created_by;
	}

	public function setCreated_by($created_by)
	{
		$this->created_by = $created_by;
	}

	public function getCandidateByUsername()
	{
		$id_user = $this->getId_user();
		$stmt = $this->db->prepare("SELECT c.*, c.id_state AS id_state, c.id_city AS id_city, s.state, ct.city, el.level, ce.id_level AS id_education_level, ce.title, ce.institution AS institution, ce.start_date AS start_date, ce.end_date AS end_date, ce.still_studies AS still_studies FROM candidates c INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN candidate_education ce ON c.id=ce.id_candidate LEFT JOIN education_levels el ON ce.id_level=el.id WHERE c.id_user=:id_user");
		$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}

	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT *, c.id, c.id_state AS id_state, c.id_city AS id_city, s.state, ct.city, el.level, ce.id_level AS id_education_level, ce.title, ce.institution AS institution, ce.start_date AS start_date, ce.end_date AS end_date FROM candidates c INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN candidate_education ce ON c.id=ce.id_candidate LEFT JOIN education_levels el ON ce.id_level=el.id WHERE c.id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("SELECT c.id, c.first_name, c.surname, c.last_name, description, c.id_gender, job_title, CONCAT(u.first_name, ' ', u.last_name) AS created_by, ISNULL(edl.level,'NA') AS level, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age, CONCAT(ct.city, ', ', s.abbreviation) AS residence, ISNULL(ct.city, 'NA') AS city, s.abbreviation AS state, ISNULL(
STUFF((SELECT CONCAT('\n*', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))/12, ' años ', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))%12, ' meses en ', subarea) FROM candidate_experience ce INNER JOIN subareas sa ON ce.id_subarea=sa.id WHERE ce.id_candidate=c.id GROUP BY id_candidate, sa.subarea FOR XML PATH('')), 1, 1, ''), '-') AS experiences, ISNULL(STRING_AGG('*'+aptitude, '\n'), '-') AS  aptitudes, c.created_at
FROM candidates c LEFT JOIN candidate_aptitude ca ON c.id=ca.id_candidate  INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN candidate_education ced ON c.id=ced.id_candidate LEFT JOIN education_levels edl ON ced.id_level=edl.id LEFT JOIN users u ON c.created_by=u.id WHERE c.id<>7666 GROUP BY c.id, c.first_name, c.surname, c.last_name, description, id_gender, job_title, date_birth, age, city, abbreviation, c.created_at, edl.level, u.first_name, u.last_name ORDER BY c.created_at DESC");
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}

	public function getAllNames()
	{
		$stmt = $this->db->prepare("SELECT c.id, c.first_name, c.surname, c.last_name FROM candidates c ORDER BY c.created_at DESC");
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}
	//  ===[GABO 3 MAYO  modal vacantes] ===
	public function getCandidatesByArea(Vacancy $vacancy)
	{
		$id_area = $vacancy->getId_area();
		$id_vacancy = $vacancy->getId();

		$stmt = $this->db->prepare("SELECT c.id, c.first_name, c.surname, c.last_name, description, job_title, CONCAT(u.first_name, ' ', u.last_name) AS created_by, id_gender,
		ISNULL(edl.level,'NA') AS level, CONCAT(ct.city, ', ', s.abbreviation) AS residence, ISNULL(ct.city, 'NA') AS city, s.abbreviation AS state,
		ISNULL(
		STUFF(
		(SELECT CONCAT('\n*', (SUM(CASE WHEN ce.still_works=1 and YEAR(ce.start_date)>1950  THEN dbo.GetMonthsDifference(ce.start_date, GETDATE())
		ELSE (CASE WHEN YEAR(ce.start_date)>1950  and YEAR(ce.end_date)>1950  THEN  dbo.GetMonthsDifference(ce.start_date, ce.end_date) END)         END)    
		)/12, ' años ', (SUM(CASE WHEN ce.still_works=1 AND YEAR(ce.start_date)>1950  THEN dbo.GetMonthsDifference(ce.start_date, 
		GETDATE()) ELSE   (CASE WHEN   YEAR(ce.start_date) >1950  and YEAR(ce.end_date)>1950  THEN  dbo.GetMonthsDifference(ce.start_date, ce.end_date)  END)       END))%12, ' meses en ', subarea) FROM candidate_experience ce INNER JOIN subareas sa 
		ON ce.id_subarea=sa.id WHERE ce.id_candidate=c.id GROUP BY id_candidate, sa.subarea FOR XML PATH('')), 1, 1, ''), '-') AS experiences,
		ISNULL(STUFF((SELECT '\n*' + ca.aptitude FROM candidate_aptitude ca WHERE ca.id_candidate=c.id FOR XML PATH('')), 1, 1, ''), '') AS aptitudes,
		(SELECT id_status FROM vacancy_applicants va WHERE va.id_candidate=c.id AND va.id_vacancy=:id_vacancy) AS id_status, (SELECT vas.status 
		FROM vacancy_applicants va LEFT JOIN vacancy_applicant_status vas ON va.id_status=vas.id WHERE va.id_candidate=c.id AND va.id_vacancy=:id_vacancy2)
		AS status, c.created_at FROM candidates c LEFT JOIN candidate_experience cexp ON c.id=cexp.id_candidate INNER JOIN states s ON c.id_state=s.id 
		LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN candidate_education ced ON c.id=ced.id_candidate LEFT JOIN education_levels edl ON ced.id_level=edl.id 
		LEFT JOIN users u ON c.created_by=u.id WHERE (cexp.id_area=:id_area OR c.id_area=:id_area2 ) AND c.id<18500 AND c.id NOT IN(SELECT vas.id_candidate 
		FROM vacancy_applicants vas WHERE vas.id_vacancy=:id_vacancy3) GROUP BY c.id, c.first_name, surname, c.last_name, description, job_title, id_gender, 
		date_birth, age, city, abbreviation, edl.level, c.created_at, u.first_name, u.last_name ORDER BY c.created_at DESC");
		$stmt->bindParam(":id_area", $id_area, PDO::PARAM_INT);
		$stmt->bindParam(":id_area2", $id_area, PDO::PARAM_INT);
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_vacancy2", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_vacancy3", $id_vacancy, PDO::PARAM_INT);
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}
	//  ===[GABO 3 MAYO   modal vacantes FIN] ===

	public function getCandidatesByVacancy(Vacancy $vacancy)
	{
		$id_vacancy = $vacancy->getId();

		$stmt = $this->db->prepare("SELECT c.id, c.first_name, c.surname, c.last_name, description, job_title, CONCAT(u.first_name, ' ', u.last_name) AS created_by, id_gender, ISNULL(edl.level,'NA') AS level, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age, CONCAT(ct.city, ', ', s.abbreviation) AS residence, ISNULL(ct.city, 'NA') AS city, s.abbreviation AS state, ISNULL(
STUFF((SELECT CONCAT('\n*', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))/12, ' años ', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))%12, ' meses en ', subarea) FROM candidate_experience ce INNER JOIN subareas sa ON ce.id_subarea=sa.id WHERE ce.id_candidate=c.id GROUP BY id_candidate, sa.subarea FOR XML PATH('')), 1, 1, ''), '-') AS experiences, ISNULL(STUFF((SELECT '\n*' + ca.aptitude FROM candidate_aptitude ca WHERE ca.id_candidate=c.id FOR XML PATH('')), 1, 1, ''), '') AS aptitudes, (SELECT id_status FROM vacancy_applicants va WHERE va.id_candidate=c.id AND va.id_vacancy=:id_vacancy) AS id_status, (SELECT vas.status FROM vacancy_applicants va LEFT JOIN vacancy_applicant_status vas ON va.id_status=vas.id WHERE va.id_candidate=c.id AND va.id_vacancy=:id_vacancy2) AS status, c.created_at FROM candidates c LEFT JOIN candidate_experience cexp ON c.id=cexp.id_candidate INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN candidate_education ced ON c.id=ced.id_candidate LEFT JOIN education_levels edl ON ced.id_level=edl.id LEFT JOIN users u ON c.created_by=u.id GROUP BY c.id, c.first_name, surname, c.last_name, description, job_title, id_gender, date_birth, age, city, abbreviation, edl.level, c.created_at, u.first_name, u.last_name ORDER BY c.created_at DESC");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_vacancy2", $id_vacancy, PDO::PARAM_INT);
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}

	public function getCandidatesByApplication(Vacancy $vacancy)
	{
		$id_vacancy = $vacancy->getId();

		$stmt = $this->db->prepare("SELECT c.id, c.first_name, c.surname, c.last_name, description, job_title, CONCAT(u.first_name, ' ', u.last_name) AS created_by, id_gender, ISNULL(edl.level,'NA') AS level, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age, CONCAT(ct.city, ', ', s.abbreviation) AS residence, ISNULL(ct.city, 'NA') AS city, s.abbreviation AS state, ISNULL(
STUFF((SELECT CONCAT('\n*', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))/12, ' años ', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))%12, ' meses en ', subarea) FROM candidate_experience ce INNER JOIN subareas sa ON ce.id_subarea=sa.id WHERE ce.id_candidate=c.id GROUP BY id_candidate, sa.subarea FOR XML PATH('')), 1, 1, ''), '-') AS experiences, ISNULL(STUFF((SELECT '\n*' + ca.aptitude FROM candidate_aptitude ca WHERE ca.id_candidate=c.id FOR XML PATH('')), 1, 1, ''), '') AS aptitudes, ISNULL(va.id_status, '') AS id_status, ISNULL(vas.status,'') AS status, va.about, va.recruiter_date, va.customer_date, va.entry_date, va.id AS id_applicant, va.interview_comments, va.interview_date, va.video_call_url, c.created_at
FROM candidates c LEFT JOIN candidate_experience cexp ON c.id=cexp.id_candidate INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN vacancy_applicants va ON va.id_candidate=c.id LEFT JOIN vacancy_applicant_status vas ON va.id_status=vas.id LEFT JOIN candidate_education ced ON c.id=ced.id_candidate LEFT JOIN education_levels edl ON ced.id_level=edl.id LEFT JOIN users u ON c.created_by=u.id WHERE va.id_vacancy=:id_vacancy AND c.created_by IS NULL GROUP BY c.id, c.first_name, c.surname, c.last_name, description, job_title, id_gender, date_birth, age, city, abbreviation, va.id_status, vas.status, edl.level, va.about, va.entry_date, va.id, va.interview_comments, va.interview_date, va.video_call_url, u.first_name, u.last_name, c.created_at, va.recruiter_date, customer_date ORDER BY CASE WHEN va.id_status=1 THEN 6 WHEN va.id_status=6 THEN 1 ELSE va.id_status END DESC, c.first_name");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}

	//gabo activar
	public function getCandidatesByApplicationStatus(Vacancy $vacancy, $id_status)
	{
		$id_vacancy = $vacancy->getId();

		$stmt = $this->db->prepare("SELECT va.comments,va.id_profile, c.id, c.first_name, c.surname, c.last_name, description, job_title, CONCAT(u.first_name, ' ', u.last_name) AS created_by, id_gender, ISNULL(edl.level,'NA') AS level, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age, CONCAT(ct.city, ', ', s.abbreviation) AS residence, ISNULL(ct.city, 'NA') AS city, s.abbreviation AS state, ISNULL(
			STUFF((SELECT CONCAT('\n*', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))/12, ' aÃ±os ', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))%12, ' meses en ', subarea) FROM candidate_experience ce INNER JOIN subareas sa ON ce.id_subarea=sa.id WHERE ce.id_candidate=c.id GROUP BY id_candidate, sa.subarea FOR XML PATH('')), 1, 1, ''), '-') AS experiences, ISNULL(STUFF((SELECT '\n*' + ca.aptitude FROM candidate_aptitude ca WHERE ca.id_candidate=c.id FOR XML PATH('')), 1, 1, ''), '') AS aptitudes, ISNULL(va.id_status, '') AS id_status, ISNULL(vas.status,'') AS status, va.about, va.recruiter_date, va.customer_date, va.entry_date, va.id AS id_applicant, va.interview_comments, va.interview_date, va.video_call_url, c.created_at, va.amount
			FROM candidates c LEFT JOIN candidate_experience cexp ON c.id=cexp.id_candidate INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN vacancy_applicants va ON va.id_candidate=c.id LEFT JOIN vacancy_applicant_status vas ON va.id_status=vas.id LEFT JOIN candidate_education ced ON c.id=ced.id_candidate LEFT JOIN education_levels edl ON ced.id_level=edl.id LEFT JOIN users u ON c.created_by=u.id 
			WHERE va.id_vacancy=:id_vacancy AND va.id_status >= :id_status AND va.id_status <= 4 
			GROUP BY va.comments, va.id_profile,c.id, c.first_name, c.surname, c.last_name, description, job_title, id_gender, date_birth, age, city, abbreviation, va.id_status, vas.status, edl.level, va.about, va.entry_date, va.id, va.interview_comments, va.interview_date, va.video_call_url, u.first_name, u.last_name, c.created_at, va.recruiter_date, customer_date, va.amount 
			ORDER BY CASE va.id_status WHEN 4 then 1 else 0 end DESC,CASE va.id_status WHEN 3 then 2 else 3 end ASC, va.customer_date DESC");

		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}
	// gabo activar
	public function getCandidatesByApplicationStatus2(Vacancy $vacancy, $id_status)
	{
		$id_vacancy = $vacancy->getId();

		$stmt = $this->db->prepare("SELECT va.descard_date, va.comments, va.id_profile, c.id, c.first_name, c.surname, c.last_name, description, job_title, CONCAT(u.first_name, ' ', u.last_name) AS created_by, id_gender, ISNULL(edl.level,'NA') AS level, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age, CONCAT(ct.city, ', ', s.abbreviation) AS residence, ISNULL(ct.city, 'NA') AS city, s.abbreviation AS state, ISNULL(
			STUFF((SELECT CONCAT('\n*', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))/12, ' años ', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))%12, ' meses en ', subarea) FROM candidate_experience ce INNER JOIN subareas sa ON ce.id_subarea=sa.id WHERE ce.id_candidate=c.id GROUP BY id_candidate, sa.subarea FOR XML PATH('')), 1, 1, ''), '-') AS experiences, ISNULL(STUFF((SELECT '\n*' + ca.aptitude FROM candidate_aptitude ca WHERE ca.id_candidate=c.id FOR XML PATH('')), 1, 1, ''), '') AS aptitudes, ISNULL(va.id_status, '') AS id_status, ISNULL(vas.status,'') AS status, va.about, va.recruiter_date, va.customer_date, va.entry_date, va.id AS id_applicant, va.interview_comments, va.interview_date, va.video_call_url, c.created_at, va.amount
			FROM candidates c LEFT JOIN candidate_experience cexp ON c.id=cexp.id_candidate INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN vacancy_applicants va ON va.id_candidate=c.id LEFT JOIN vacancy_applicant_status vas ON va.id_status=vas.id LEFT JOIN candidate_education ced ON c.id=ced.id_candidate LEFT JOIN education_levels edl ON ced.id_level=edl.id LEFT JOIN users u ON c.created_by=u.id 
			WHERE va.id_vacancy=:id_vacancy AND va.id_status >= :id_status AND va.id_status < 5  or va.id_status = 7 AND va.id_vacancy=:id_vacancy2
			GROUP BY va.descard_date, va.comments, va.id_profile,c.id, c.first_name, c.surname, c.last_name, description, job_title, id_gender, date_birth, age, city, abbreviation, va.id_status, vas.status, edl.level, va.about, va.entry_date, va.id, va.interview_comments, va.interview_date, va.video_call_url, u.first_name, u.last_name, c.created_at, va.recruiter_date, customer_date, va.amount 
			ORDER BY CASE va.id_status WHEN 4 then 1 else 0 end DESC,CASE va.id_status WHEN 3 then 2 else 3 end ASC, va.customer_date DESC");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_vacancy2", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_status", $id_status, PDO::PARAM_INT);
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}

	public function getTotal()
	{
		$stmt = $this->db->prepare("SELECT COUNT(c.id) AS total FROM candidates c");
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch->total;
	}

	public function getCandidateCountPerDay()
	{
		$date = $this->getCreated_at();
		$stmt = $this->db->prepare("SELECT COUNT(c.id) AS total FROM candidates c WHERE CONVERT(DATE, c.created_at)=CONVERT(DATE, :date)");
		$stmt->bindParam(":date", $date, PDO::PARAM_STR);
		$stmt->execute();
		$fetch = $stmt->fetchObject();
		return $fetch->total;
	}

	public function getCandidateCountFromLast7Days()
	{
		$stmt = $this->db->prepare("SELECT DAY(created_at) AS dia, DATENAME(WEEKDAY, DATEADD(DW,0,created_at)) AS dia_semana, COUNT(c.id) AS total FROM candidates c WHERE created_at BETWEEN dateadd(day, -6, GETDATE()) AND GETDATE() GROUP BY DAY(created_at), DATENAME(WEEKDAY, DATEADD(DW,0,created_at)), CONVERT(DATE,created_at) ORDER BY CONVERT(DATE,created_at)");
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}

	public function getCandidateCountByExecutive()
	{
		$stmt = $this->db->prepare("SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS name, SUM(case when  CONVERT(DATE, c.created_at) = CONVERT(DATE, GETDATE()) then 1 else 0 end) AS total FROM candidates c LEFT JOIN users u ON c.created_by=u.id WHERE CONVERT(DATE, c.created_at) = CONVERT(DATE, GETDATE()) GROUP BY u.first_name, u.last_name, u.id ORDER BY total DESC");
		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}

	public function save()
	{

		$result = false;

		$first_name = $this->getFirst_name();
		$surname = $this->getSurname();
		$last_name = $this->getLast_name();
		$date_birth = $this->getDate_birth();
		$age = $this->getAge();
		$id_gender = $this->getId_gender();
		$id_civil_status = $this->getId_civil_status();
		$job_title = $this->getJob_title();
		$description = $this->getDescription();
		$telephone = $this->getTelephone();
		$cellphone = $this->getCellphone();
		$email = $this->getEmail();
		$id_state = $this->getId_state();
		$id_city = $this->getId_city();
		$id_area = $this->getId_area();
		$id_subarea = $this->getId_subarea();
		$linkedinn = $this->getLinkedinn();
		$facebook = $this->getFacebook();
		$instagram = $this->getInstagram();
		$id_user = $this->getId_user();
		$created_by = $this->getCreated_by();

		$stmt = $this->db->prepare("INSERT INTO candidates(first_name, surname, last_name, date_birth, age, id_gender, id_civil_status, job_title, description, telephone, cellphone, email, id_state, id_city, id_area, id_subarea, linkedinn, facebook, instagram, id_user, created_at, modified_at, created_by) VALUES (:first_name, :surname, :last_name, :date_birth, :age, :id_gender, :id_civil_status, :job_title, :description, :telephone, :cellphone, :email, :id_state, :id_city, :id_area, :id_subarea, :linkedinn, :facebook, :instagram, :id_user, GETDATE(), GETDATE(), :created_by)");
		$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
		$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
		$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
		$stmt->bindParam(":date_birth", $date_birth, PDO::PARAM_STR);
		$stmt->bindParam(":age", $age, PDO::PARAM_INT);
		$stmt->bindParam(":id_gender", $id_gender, PDO::PARAM_INT);
		$stmt->bindParam(":id_civil_status", $id_civil_status, PDO::PARAM_INT);
		$stmt->bindParam(":job_title", $job_title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $description, PDO::PARAM_STR);
		$stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
		$stmt->bindParam(":cellphone", $cellphone, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":id_state", $id_state, PDO::PARAM_INT);
		$stmt->bindParam(":id_city", $id_city, PDO::PARAM_INT);
		$stmt->bindParam(":id_area", $id_area, PDO::PARAM_INT);
		$stmt->bindParam(":id_subarea", $id_subarea, PDO::PARAM_INT);
		$stmt->bindParam(":linkedinn", $linkedinn, PDO::PARAM_STR);
		$stmt->bindParam(":facebook", $facebook, PDO::PARAM_STR);
		$stmt->bindParam(":instagram", $instagram, PDO::PARAM_STR);
		$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
		$stmt->bindParam(":created_by", $created_by, PDO::PARAM_INT);

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
		$date_birth = $this->getDate_birth();
		$age = $this->getAge();
		$id_gender = $this->getId_gender();
		$id_civil_status = $this->getId_civil_status();
		$job_title = $this->getJob_title();
		$description = $this->getDescription();
		$telephone = $this->getTelephone();
		$cellphone = $this->getCellphone();
		$email = $this->getEmail();
		$id_state = $this->getId_state();
		$id_city = $this->getId_city();
		$id_area = $this->getId_area();
		$id_subarea = $this->getId_subarea();
		$linkedinn = $this->getLinkedinn();
		$facebook = $this->getFacebook();
		$instagram = $this->getInstagram();
		//$id_user = $this->getId_user();

		$stmt = $this->db->prepare("UPDATE candidates SET first_name=:first_name, surname=:surname, last_name=:last_name, date_birth=:date_birth, age=:age, id_gender=:id_gender, id_civil_status=:id_civil_status, job_title=:job_title, description=:description, telephone=:telephone, cellphone=:cellphone, email=:email, id_state=:id_state, id_city=:id_city, id_area=:id_area, id_subarea=:id_subarea, linkedinn=:linkedinn, facebook=:facebook, instagram=:instagram, modified_at=GETDATE() WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
		$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
		$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
		$stmt->bindParam(":date_birth", $date_birth, PDO::PARAM_STR);
		$stmt->bindParam(":age", $age, PDO::PARAM_INT);
		$stmt->bindParam(":id_gender", $id_gender, PDO::PARAM_INT);
		$stmt->bindParam(":id_civil_status", $id_civil_status, PDO::PARAM_INT);
		$stmt->bindParam(":job_title", $job_title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $description, PDO::PARAM_STR);
		$stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
		$stmt->bindParam(":cellphone", $cellphone, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":id_state", $id_state, PDO::PARAM_INT);
		$stmt->bindParam(":id_city", $id_city, PDO::PARAM_INT);
		$stmt->bindParam(":id_area", $id_area, PDO::PARAM_INT);
		$stmt->bindParam(":id_subarea", $id_subarea, PDO::PARAM_INT);
		$stmt->bindParam(":linkedinn", $linkedinn, PDO::PARAM_STR);
		$stmt->bindParam(":facebook", $facebook, PDO::PARAM_STR);
		$stmt->bindParam(":instagram", $instagram, PDO::PARAM_STR);
		//$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);


		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function update_name()
	{

		$result = false;

		$id = $this->getId();
		$first_name = $this->getFirst_name();
		$surname = $this->getSurname();
		$last_name = $this->getLast_name();

		$stmt = $this->db->prepare("UPDATE candidates SET first_name=:first_name, surname=:surname, last_name=:last_name, modified_at=GETDATE() WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
		$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
		$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function update2()
	{

		$result = false;

		$id = $this->getId();
		$first_name = $this->getFirst_name();
		$surname = $this->getSurname();
		$last_name = $this->getLast_name();
		$job_title = $this->getJob_title();
		$telephone = $this->getTelephone();
		$email = $this->getEmail();

		$stmt = $this->db->prepare("UPDATE candidates SET first_name=:first_name, surname=:surname, last_name=:last_name, job_title=:job_title, telephone=:telephone, email=:email, modified_at=GETDATE() WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
		$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
		$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
		$stmt->bindParam(":job_title", $job_title, PDO::PARAM_STR);
		$stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);

		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}

		return $result;
	}



	//======================[GABOOOOOOO  Marzo 10]=================
	public function getCandidatesByKey($consulta, $campos, $inners)
	{
		if ($consulta != '' || $campos != '' || $inners != '') {
			$stmt = $this->db->prepare("SELECT   c.id, c.first_name, c.surname, c.last_name, description, c.id_gender " . $campos . ", job_title, CONCAT(u.first_name, ' ', u.last_name) AS created_by, ISNULL(edl.level,'NA') AS level, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age, CONCAT(ct.city, ', ', s.abbreviation) AS residence, ISNULL(ct.city, 'NA') AS city, s.abbreviation AS state, ISNULL(
				STUFF((SELECT CONCAT('\n*', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))/12, ' años ', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))%12, ' meses en ', subarea) FROM candidate_experience ce INNER JOIN subareas sa ON ce.id_subarea=sa.id WHERE ce.id_candidate=c.id GROUP BY id_candidate, sa.subarea FOR XML PATH('')), 1, 1, ''), '-') AS experiences, ISNULL(STRING_AGG('*'+aptitude, '\n'), '-') AS  aptitudes, c.created_at
				FROM candidates c LEFT JOIN candidate_aptitude ca ON c.id=ca.id_candidate  INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN candidate_education ced ON c.id=ced.id_candidate LEFT JOIN education_levels edl ON ced.id_level=edl.id LEFT JOIN users u ON c.created_by=u.id  " . $inners . "
				WHERE c.id<>7666 and c.id<>18499 " . $consulta . "
				GROUP BY c.id, c.first_name, c.surname, c.last_name, description, id_gender, job_title " . $campos . " ,date_birth, age, city, abbreviation, c.created_at, edl.level, u.first_name, u.last_name ORDER BY c.created_at DESC");
		} else {



			$stmt = $this->db->prepare("SELECT c.created_by,c.id_city,c.id_state,c.id, c.first_name, c.surname, c.last_name, description, c.id_gender , job_title, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age,


			(SELECT city FROM  cities ct where  ct.id = c.id_city) as city,
			(SELECT s.abbreviation FROM  states s where s.id=c.id_state) as state,
			CONCAT((SELECT city FROM  cities ct where  ct.id = c.id_city) , ', ', (SELECT s.abbreviation FROM  states s where s.id=c.id_state)) AS residence,

			CONCAT((SELECT first_name from users u where u.id=c.created_by), ', ', (SELECT last_name from users u where u.id=c.created_by)) AS created_by,
			(SELECT level FROM education_levels edl where edl.id=(SELECT id_level from candidate_education ced where ced.id_candidate=c.id )) as level,

			(SELECT id_level from candidate_education ced where ced.id_candidate=c.id ) as id_level,

			(SELECT ISNULL(STRING_AGG('*'+aptitude, '\n'), '-') AS  aptitudes FROM candidate_aptitude ca where c.id=ca.id_candidate ) as aptitudes

			      , ISNULL(
			        STUFF((SELECT CONCAT('\n*', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))/12, ' años ', (SUM(CASE WHEN ce.still_works=1 THEN dbo.GetMonthsDifference(ce.start_date, GETDATE()) ELSE dbo.GetMonthsDifference(ce.start_date, ce.end_date) END))%12, ' meses en ', subarea) FROM candidate_experience ce INNER JOIN subareas sa ON ce.id_subarea=sa.id WHERE ce.id_candidate=c.id GROUP BY id_candidate, sa.subarea FOR XML PATH('')), 1, 1, ''), '-') AS experiences, c.created_at
			        FROM candidates c 
			        WHERE c.id<>7666 and c.id<>18499 and c.id in (select DISTINCT(id_candidate) from vacancies v INNER JOIN  vacancy_applicants va on v.id=va.id_vacancy where v.created_at>'2022-08-28' )

			        GROUP BY  c.created_by,c.id_city, c.id_state,c.id, c.first_name, c.surname, c.last_name, description, id_gender, job_title  ,date_birth, age, c.created_at ORDER BY c.created_at DESC");
		}


		$stmt->execute();
		$candidates = $stmt->fetchAll();
		return $candidates;
	}

	public function getLanguageFromCandidate()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * from candidates c LEFT JOIN candidate_language cl ON cl.id_candidate=c.id  LEFT JOIN languages l ON l.id=cl.id_language where c.id=:id ");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		$resultado = $stmt->fetchObject();
		return $resultado;
	}

	public function getAreasYSubareasFromCandidate()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * from candidates c inner join candidate_experience ce on ce.id_candidate=c.id inner join subareas sa on ce.id_subarea = sa.id inner join areas a on sa.id_area=a.id  where c.id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		$resultado = $stmt->fetchObject();
		return $resultado;
	}
	//========================================================

	//======================[Gabo Marzo 28 Perfil Postulado]===============
	public function getOneFull()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT *,c.description, c.first_name,  c.surname,  c.last_name, cv.status, g.gender, c.id, c.id_state AS id_state, c.id_city AS id_city, s.state, ct.city, el.level, ce.id_level AS id_education_level, ce.title, ce.institution AS institution, ce.start_date AS start_date, ce.end_date AS end_date, CASE WHEN c.date_birth IS NULL AND c.age IS NOT NULL THEN c.age ELSE (dbo.GetMonthsDifference(c.date_birth, GETDATE())/12) END AS age_cal FROM candidates c INNER JOIN states s ON c.id_state=s.id LEFT JOIN cities ct ON c.id_city=ct.id LEFT JOIN candidate_education ce ON c.id=ce.id_candidate  LEFT JOIN genders g ON c.id_gender=g.id LEFT JOIN civil_status cv ON c.id_civil_status=cv.id  WHERE c.id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchObject();
		return $fetch;
	}
	//========================================================

}
