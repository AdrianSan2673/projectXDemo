<?php

class CandidateDirectory
{
	private $id;
	private $first_name;
	private $last_name;
	private $surname;
	private $telephone;
	private $experience;
	private $id_state;
	private $id_city;
	private $email;
	private $url;
	private $status;
	private $comment;
	private $created_at;
	private $created_by;
	private $id_customer;
	private $id_vacancy;
	private $modified_at;
	private $id_candidate;
	private $db;

	/////////////////////////////////////////7
	private $date_birth;
	private $age;
	private $id_gender;
	private $id_civil_status;
	private $job_title;
	private $description;
	private $cellphone;
	private $id_area;
	private $id_subarea;
	private $id_user;


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

	public function getLast_name()
	{
		return $this->last_name;
	}

	public function setLast_name($last_name)
	{
		$this->last_name = $last_name;
	}

	public function getSurname()
	{
		return $this->surname;
	}

	public function setSurname($surname)
	{
		$this->surname = $surname;
	}

	public function getTelephone()
	{
		return $this->telephone;
	}

	public function setTelephone($telephone)
	{
		$this->telephone = $telephone;
	}

	public function getExperience()
	{
		return $this->experience;
	}

	public function setExperience($experience)
	{
		$this->experience = $experience;
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

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function setComment($comment)
	{
		$this->comment = $comment;
	}

	public function getCreated_at()
	{
		return $this->created_at;
	}

	public function setCreated_at($created_at)
	{
		$this->created_at = $created_at;
	}

	public function getCreated_by()
	{
		return $this->created_by;
	}

	public function setCreated_by($created_by)
	{
		$this->created_by = $created_by;
	}

	public function getId_customer()
	{
		return $this->id_customer;
	}

	public function setId_customer($id_customer)
	{
		$this->id_customer = $id_customer;
	}

	public function getId_vacancy()
	{
		return $this->id_vacancy;
	}

	public function setId_vacancy($id_vacancy)
	{
		$this->id_vacancy = $id_vacancy;
	}

	public function getModified_at()
	{
		return $this->modified_at;
	}

	public function setModified_at($modified_at)
	{
		$this->modified_at = $modified_at;
	}

	public function getId_candidate()
	{
		return $this->id_candidate;
	}

	public function setId_candidate($id_candidate)
	{
		$this->id_candidate = $id_candidate;
	}

	//////////////////////////////////////////////
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

	public function getCellphone()
	{
		return $this->cellphone;
	}

	public function setCellphone($cellphone)
	{
		$this->cellphone = $cellphone;
	}

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

	// public function getLinkedinn()
	// {
	// 	return $this->linkedinn;
	// }

	// public function setLinkedinn($linkedinn)
	// {
	// 	$this->linkedinn = $linkedinn;
	// }

	// public function getFacebook()
	// {
	// 	return $this->facebook;
	// }

	// public function setFacebook($facebook)
	// {
	// 	$this->facebook = $facebook;
	// }

	// public function getInstagram()
	// {
	// 	return $this->instagram;
	// }

	// public function setInstagram($instagram)
	// {
	// 	$this->instagram = $instagram;
	// }

	public function getId_user()
	{
		return $this->id_user;
	}

	public function setId_user($id_user)
	{
		$this->id_user = $id_user;
	}



	public function getOne()
	{
		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM root.candidate_directory  WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		return $fetch;
	}

	public function getAll()
	{
		$stmt = $this->db->prepare("SELECT cd.*, (SELECT state FROM states WHERE id=cd.id_state ) state, (SELECT city FROM cities WHERE id=cd.id_city) city,(select vacancy from vacancies where id=cd.id_vacancy) vacancy  FROM root.candidate_directory cd WHERE cd.status<>0 ORDER BY cd.created_at DESC");
		$stmt->execute();
		$cities = $stmt->fetchAll();
		return $cities;
	}

	public function getAllById_customer()
	{
		$id_customer = $this->getId_customer();
		$stmt = $this->db->prepare("SELECT cd.*, (SELECT state FROM states WHERE id=cd.id_state ) state, (SELECT city FROM cities WHERE id=cd.id_city) city FROM root.candidate_directory cd WHERE cd.status<>0 and cd.id_customer=:id_customer ORDER BY cd.created_at DESC");
		$stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_STR);
		$stmt->execute();
		$cities = $stmt->fetchAll();
		return $cities;
	}

	public function save()
	{
		$result = false;

		$first_name = $this->getFirst_name();
		$surname = $this->getSurname();
		$last_name = $this->getLast_name();
		$telephone = $this->getTelephone();
		$experience = $this->getExperience();
		$id_state = $this->getId_state();
		$id_city = $this->getId_city();
		$email = $this->getEmail();
		$url = $this->getUrl();
		$comment = $this->getComment();
		$created_by = $this->getCreated_by();
		$id_customer = $this->getId_customer();
		$id_vacancy = $this->getId_vacancy();

		$stmt = $this->db->prepare("INSERT INTO root.candidate_directory (first_name,surname,last_name,telephone,experience,id_state,id_city,email,url,comment,created_at,created_by,id_customer,id_vacancy,modified_at) VALUES(:first_name,:surname,:last_name,:telephone,:experience,:id_state,:id_city,:email,:url,:comment,GETDATE(),:created_by,:id_customer,:id_vacancy,GETDATE())");

		$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
		$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
		$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
		$stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
		$stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
		$stmt->bindParam(":id_state", $id_state, PDO::PARAM_STR);
		$stmt->bindParam(":id_city", $id_city, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":url", $url, PDO::PARAM_STR);
		$stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
		$stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
		$stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_STR);
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_STR);

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
		$telephone = $this->getTelephone();
		$experience = $this->getExperience();
		$id_vacancy = $this->getId_vacancy();
		$id_state = $this->getId_state();
		$id_city = $this->getId_city();
		$email = $this->getEmail();
		$url = $this->getUrl();
		$comment = $this->getComment();
		$satus = $this->getStatus();

		$stmt = $this->db->prepare("UPDATE root.candidate_directory SET first_name=:first_name,surname=:surname,last_name=:last_name,telephone=:telephone,experience=:experience,id_state=:id_state,id_city=:id_city,email=:email,url=:url,comment=:comment,id_vacancy=:id_vacancy,modified_at=GETDATE(),status=:status WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
		$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
		$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
		$stmt->bindParam(":telephone", $telephone, PDO::PARAM_INT);
		$stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_state", $id_state, PDO::PARAM_INT);
		$stmt->bindParam(":id_city", $id_city, PDO::PARAM_INT);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":url", $url, PDO::PARAM_STR);
		$stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
		$stmt->bindParam(":status", $satus, PDO::PARAM_INT);

		$result = $stmt->execute();

		return $result;
	}


	public function updateSatusCandidate()
	{
		$result = false;

		$id = $this->getId();
		$status = $this->getStatus();
		$id_candidate = $this->getId_candidate();

		$stmt = $this->db->prepare("UPDATE root.candidate_directory SET modified_at=GETDATE(),status=:status,id_candidate=:id_candidate WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_INT);
		$stmt->bindParam(":id_candidate", $id_candidate, PDO::PARAM_INT);

		$result = $stmt->execute();

		return $result;
	}



	public function delete()
	{
		$result = false;
		$id = $this->getId();
		$stmt = $this->db->prepare("UPDATE root.candidate_directory SET status=0  WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$result = $stmt->execute();
		return $result;
	}


	public function updateByVacancy()
	{
		$result = false;

		$id_vacancy = $this->getId_vacancy();
		$id_state = $this->getId_state();
		$id_city = $this->getId_city();

		$stmt = $this->db->prepare("UPDATE root.candidate_directory SET id_state=:id_state,id_city=:id_city WHERE id_vacancy=:id_vacancy AND id_candidate is null");

		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);
		$stmt->bindParam(":id_state", $id_state, PDO::PARAM_INT);
		$stmt->bindParam(":id_city", $id_city, PDO::PARAM_INT);

		$result = $stmt->execute();
		return $result;
	}



	public function getAllCandidateByVacancy()
	{
		$stmt = $this->db->prepare("SELECT v.id,v.vacancy, c.customer
		FROM root.candidate_directory cd inner join vacancies v on cd.id_vacancy=v.id  INNER JOIN customers c on c.id=v.id_customer
		GROUP BY v.id ,v.vacancy, c.customer ");
		$stmt->execute();
		$cities = $stmt->fetchAll();
		return $cities;
	}



	public function getAllByVacancy()
	{
		$id_vacancy = $this->getId_vacancy();
		$stmt = $this->db->prepare("SELECT cd.*, (SELECT state FROM states WHERE id=cd.id_state ) state, (SELECT city FROM cities WHERE id=cd.id_city) city,(select vacancy from vacancies where id=cd.id_vacancy) vacancy  FROM root.candidate_directory cd WHERE cd.status<>0 AND id_vacancy=:id_vacancy  ORDER BY cd.created_at DESC");
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_INT);

		$stmt->execute();
		$cities = $stmt->fetchAll();
		return $cities;
	}

	//gabo 9 oct
	public function save_candidate()
	{

		///
		$result = false;
		$first_name = $this->getFirst_name();
		$surname = $this->getSurname();
		$last_name = $this->getLast_name();
		$telephone = $this->getTelephone();
		$age = $this->getAge();
		$experience = $this->getExperience();
		$id_state = $this->getId_state();
		$id_city = $this->getId_city();
		$email = $this->getEmail();
		$url = $this->getUrl();
		$comment = $this->getComment();
		$created_by = $this->getCreated_by();
		//$id_customer = $this->getId_customer();
		$id_vacancy = $this->getId_vacancy();
		$status = $this->getStatus();
		$date_birth = $this->getDate_birth();
		$id_civil_status = $this->getId_civil_status();
		//$job_title = $this->getJob_title();
		$description = $this->getDescription();
		$cellphone = $this->getCellphone();
		$id_area = $this->getId_area();
		$id_subarea = $this->getId_subarea();
		$id_gender = $this->getId_gender();



		$stmt = $this->db->prepare("INSERT INTO root.candidate_directory (first_name,surname,last_name,telephone,age,experience,id_state,id_city,email,url,comment,created_at,id_vacancy,status,created_by,date_birth,id_civil_status,description,cellphone,id_area,id_subarea,id_gender ) VALUES (:first_name,:surname,:last_name,:telephone,:age,:experience,:id_state,:id_city,:email,:url,:comment,GETDATE(),:id_vacancy,:status,:created_by,:date_birth,:id_civil_status,:description,:cellphone,:id_area,:id_subarea,:id_gender)");

		$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
		$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
		$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
		$stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
		$stmt->bindParam(":age", $age, PDO::PARAM_STR);
		$stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
		$stmt->bindParam(":id_state", $id_state, PDO::PARAM_STR);
		$stmt->bindParam(":id_city", $id_city, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":url", $url, PDO::PARAM_STR);
		$stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		$stmt->bindParam(":created_by", $created_by, PDO::PARAM_STR);
		//$stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_STR);
		$stmt->bindParam(":date_birth", $date_birth, PDO::PARAM_STR);
		$stmt->bindParam(":id_civil_status", $id_civil_status, PDO::PARAM_STR);
		//$stmt->bindParam(":job_title", $job_title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $description, PDO::PARAM_STR);
		$stmt->bindParam(":cellphone", $cellphone, PDO::PARAM_STR);
		$stmt->bindParam(":id_area", $id_area, PDO::PARAM_STR);
		$stmt->bindParam(":id_subarea", $id_subarea, PDO::PARAM_STR);
		$stmt->bindParam(":id_gender", $id_gender, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}

	public function update_candidate()
	{

		///
		$result = false;
		$id = $this->getId();
		$first_name = $this->getFirst_name();
		$surname = $this->getSurname();
		$last_name = $this->getLast_name();
		$telephone = $this->getTelephone();
		$age = $this->getAge();
		$experience = $this->getExperience();
		$id_state = $this->getId_state();
		$id_city = $this->getId_city();
		$email = $this->getEmail();
		$url = $this->getUrl();
		$comment = $this->getComment();
		$created_by = $this->getCreated_by();
		$id_vacancy = $this->getId_vacancy();
		$status = $this->getStatus();
		$date_birth = $this->getDate_birth();
		$id_civil_status = $this->getId_civil_status();
		$description = $this->getDescription();
		$cellphone = $this->getCellphone();
		$id_area = $this->getId_area();
		$id_subarea = $this->getId_subarea();
		$id_gender = $this->getId_gender();


		$stmt = $this->db->prepare("UPDATE root.candidate_directory SET first_name=:first_name, surname=:surname, last_name=:last_name, date_birth=:date_birth, age=:age, id_gender=:id_gender, id_civil_status=:id_civil_status, experience=:experience,id_vacancy=:id_vacancy, description=:description,url=:url,status=:status, telephone=:telephone, cellphone=:cellphone, email=:email, id_state=:id_state, id_city=:id_city, id_area=:id_area, id_subarea=:id_subarea,comment=:comment, modified_at=GETDATE() WHERE id=:id");

		$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
		$stmt->bindParam(":surname", $surname, PDO::PARAM_STR);
		$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
		$stmt->bindParam(":telephone", $telephone, PDO::PARAM_STR);
		$stmt->bindParam(":age", $age, PDO::PARAM_STR);
		$stmt->bindParam(":experience", $experience, PDO::PARAM_STR);
		$stmt->bindParam(":id_state", $id_state, PDO::PARAM_STR);
		$stmt->bindParam(":id_city", $id_city, PDO::PARAM_STR);
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":url", $url, PDO::PARAM_STR);
		$stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
		$stmt->bindParam(":id_vacancy", $id_vacancy, PDO::PARAM_STR);
		$stmt->bindParam(":status", $status, PDO::PARAM_STR);
		//$stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_STR);
		$stmt->bindParam(":date_birth", $date_birth, PDO::PARAM_STR);
		$stmt->bindParam(":id_civil_status", $id_civil_status, PDO::PARAM_STR);
		//$stmt->bindParam(":job_title", $job_title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $description, PDO::PARAM_STR);
		$stmt->bindParam(":cellphone", $cellphone, PDO::PARAM_STR);
		$stmt->bindParam(":id_area", $id_area, PDO::PARAM_STR);
		$stmt->bindParam(":id_subarea", $id_subarea, PDO::PARAM_STR);
		$stmt->bindParam(":id_gender", $id_gender, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}
}