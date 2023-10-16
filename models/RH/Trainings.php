<?php

class Trainings
{
	private $id;
	private $title;
	private $description;
	private $start_date;
	private $end_date;
	private $hours;
	private $Cliente;
	private $ID_Contacto;
	private $created_at;
	private $modified_at;
	private $status;
	private $clave_area_tematica;
	private $training_agent;
	private $instructor;
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

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
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

	public function getHours(){
		return $this->hours;
	}

	public function setHours($hours){
		$this->hours = $hours;
	}

	public function getCliente(){
		return $this->Cliente;
	}

	public function setCliente($Cliente){
		$this->Cliente = $Cliente;
	}

	public function getID_Contacto(){
		return $this->ID_Contacto;
	}

	public function setID_Contacto($ID_Contacto){
		$this->ID_Contacto = $ID_Contacto;
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

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getClave_area_tematica(){
		return $this->clave_area_tematica;
	}

	public function setClave_area_tematica($clave_area_tematica){
		$this->clave_area_tematica = $clave_area_tematica;
	}

	public function getTraining_agent(){
		return $this->training_agent;
	}

	public function setTraining_agent($training_agent){
		$this->training_agent = $training_agent;
	}

	public function getInstructor(){
		return $this->instructor;
	}

	public function setInstructor($instructor){
		$this->instructor = $instructor;
	}

	public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT *,(SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=t.Cliente) nombre_cliente  FROM root.trainings t WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }


    
	public function save()
	{
		$title=$this->getTitle();
		$description=$this->getDescription();
		$start_date=$this->getStart_date();
		$end_date=$this->getEnd_date();
		$hours=$this->getHours();
		$Cliente=$this->getCliente();
		$ID_Contacto=$this->getID_Contacto();
		$clave_area_tematica=$this->getClave_area_tematica();
		$training_agent = $this->getTraining_agent();
		$instructor = $this->getInstructor();
		
		$stmt = $this->db->prepare("INSERT INTO root.trainings(title,description,start_date,end_date,hours,Cliente,ID_Contacto,created_at,modified_at,clave_area_tematica, training_agent, instructor) 
		VALUES (:title,:description,:start_date,:end_date,:hours,:Cliente,:ID_Contacto,GETDATE(),GETDATE(),:clave_area_tematica, :training_agent, :instructor)");

		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $description, PDO::PARAM_STR);
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_INT);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_INT);
		$stmt->bindParam(":hours", $hours, PDO::PARAM_INT);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":clave_area_tematica", $clave_area_tematica, PDO::PARAM_INT);
		$stmt->bindParam(":training_agent", $training_agent, PDO::PARAM_STR);
		$stmt->bindParam(":instructor", $instructor, PDO::PARAM_STR);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}


	public function update()
	{
		$id=$this->getId();
		$title=$this->getTitle();
		$description=$this->getDescription();
		$start_date=$this->getStart_date();
		$end_date=$this->getEnd_date();
		$hours=$this->getHours();
		$Cliente=$this->getCliente();
		$ID_Contacto=$this->getID_Contacto();
		$clave_area_tematica=$this->getClave_area_tematica();
		$training_agent = $this->getTraining_agent();
		$instructor = $this->getInstructor();
		
		$stmt = $this->db->prepare("UPDATE root.trainings SET title=:title,description=:description,start_date=:start_date,end_date=:end_date,hours=:hours,Cliente=:Cliente,ID_Contacto=:ID_Contacto,modified_at=GETDATE(),clave_area_tematica=:clave_area_tematica, training_agent=:training_agent, instructor=:instructor WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":description", $description, PDO::PARAM_STR);
		$stmt->bindParam(":start_date", $start_date, PDO::PARAM_INT);
		$stmt->bindParam(":end_date", $end_date, PDO::PARAM_INT);
		$stmt->bindParam(":hours", $hours, PDO::PARAM_INT);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
		$stmt->bindParam(":clave_area_tematica", $clave_area_tematica, PDO::PARAM_INT);
		$stmt->bindParam(":training_agent", $training_agent, PDO::PARAM_STR);
		$stmt->bindParam(":instructor", $instructor, PDO::PARAM_STR);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setId($this->db->lastInsertId());
		}

		return $result;
	}

	
    public function getAllByIdContacto()
    {
        $ID_Contacto = $this->getID_Contacto();
        $status= $this->getStatus();
        $stmt = $this->db->prepare("SELECT *,(SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=t.Cliente) nombre_cliente FROM root.trainings t WHERE Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto AND status=:status) ORDER BY created_at");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


		
    public function updateDelete()
    {
        $id = $this->getId();
		$status=$this->getStatus();
        $stmt = $this->db->prepare("UPDATE root.trainings SET status=:status WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        return $fetch;
    }



}