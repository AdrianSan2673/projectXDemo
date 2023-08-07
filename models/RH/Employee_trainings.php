<?php 


class Employee_trainings
{
	private $id;
	private $id_employee;
	private $id_training;
	private $id_position;
	private $Cliente;
	private $id_razon;
	private $created_at;
	private $modified_at;

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

	public function getId_employee(){
		return $this->id_employee;
	}

	public function setId_employee($id_employee){
		$this->id_employee = $id_employee;
	}

	public function getId_training(){
		return $this->id_training;
	}

	public function setId_training($id_training){
		$this->id_training = $id_training;
	}

	public function getId_position(){
		return $this->id_position;
	}

	public function setId_position($id_position){
		$this->id_position = $id_position;
	}

	public function getCliente(){
		return $this->Cliente;
	}

	public function setCliente($Cliente){
		$this->Cliente = $Cliente;
	}

	public function getId_razon(){
		return $this->id_razon;
	}

	public function setId_razon($id_razon){
		$this->id_razon = $id_razon;
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

	public function save()
	{
		$id_training=$this->getId_training();
		$id_employee=$this->getId_employee();
		$id_position = $this->getId_position();
		$Cliente = $this->getCliente();
		$id_razon = $this->getId_razon();
		$stmt = $this->db->prepare("INSERT INTO root.employee_trainings(id_employee,id_training, id_position, Cliente, id_razon, created_at) VALUES (:id_employee,:id_training, :id_position, :Cliente, :id_razon, GETDATE())");
		$stmt->bindParam(":id_training", $id_training, PDO::PARAM_INT);
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":id_razon", $id_razon, PDO::PARAM_INT);
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
		$id_training=$this->getId_training();
		$id_employee=$this->getId_employee();
		$id_position = $this->getId_position();
		$Cliente = $this->getCliente();
		$id_razon = $this->getId_razon();
		$stmt = $this->db->prepare("UPDATE root.employee_trainings SET id_employee=:id_employee, id_training=:id_training, id_position=:id_position, Cliente=:Cliente, id_razon=:id_razon, modified_at=GETDATE() WHERE id=:id");
		$stmt->bindParam(":id_training", $id_training, PDO::PARAM_INT);
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":id_position", $id_position, PDO::PARAM_INT);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":id_razon", $id_razon, PDO::PARAM_INT);
		$flag = $stmt->execute();

		if ($flag)
			$result = true;

		return $result;
	}

	public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT et.*, e.first_name, e.surname, e.last_name, e.curp, p.title, p.clave_ocupacion, co.descripcion, r.Razon, r.RFC, t.title as training, t.hours, t.start_date, t.end_date, t.training_agent, t.instructor, a.descripcion AS area_tematica, c.Representante_Legal, w.full_name AS Representante_Trabajadores FROM root.employee_trainings et INNER JOIN root.employees e ON et.id_employee=e.id INNER JOIN root.positions p ON e.id_position=p.id LEFT JOIN root.catalogo_ocupaciones co ON p.clave_ocupacion=co.clave INNER JOIN rh_Ventas_Alta_Razones r ON e.id_razon=r.ID INNER JOIN root.trainings t ON et.id_training=t.id INNER JOIN root.catalogo_areas_tematicas a ON t.clave_area_tematica=a.clave INNER JOIN rh_Ventas_Alta c ON e.Cliente=c.Cliente LEFT JOIN root.worker_representative w ON et.id_worker_representative=w.id WHERE et.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

	public function getAllByidTraing(){
		$id_training = $this->getId_training();
		
		$stmt = $this->db->prepare("SELECT et.*, e.first_name, e.surname, e.last_name, e.curp, p.title, p.clave_ocupacion, co.descripcion, r.Razon, r.RFC FROM root.employee_trainings et INNER JOIN root.employees e ON et.id_employee=e.id INNER JOIN root.positions p ON e.id_position=p.id LEFT JOIN root.catalogo_ocupaciones co ON p.clave_ocupacion=co.clave INNER JOIN rh_Ventas_Alta_Razones r ON e.id_razon=r.ID  WHERE id_training=:id_training");		
		$stmt->bindParam(":id_training", $id_training, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
        return $fetch;
	}
	
	
    public function getAllByIdEmployee()
    {
        $id_employee = $this->getId_employee();
		$stmt = $this->db->prepare("SELECT *,(SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=t.Cliente) nombre_cliente, et.id id_employee_training
		FROM root.trainings t, root.employee_trainings et 
		WHERE t.id=et.id_training AND et.id_employee=:id_employee AND t.status=1");		
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


	public function deleteByIdTraing(){
		$id_training = $this->getId_training();
		$stmt = $this->db->prepare("DELETE root.employee_trainings WHERE id_training=:id_training");		
		$stmt->bindParam(":id_training", $id_training, PDO::PARAM_INT);
        $fetch =$stmt->execute();
        return $fetch;
	}

	public function delete(){
		$id = $this->getId();
		$stmt = $this->db->prepare("DELETE root.employee_trainings WHERE id=:id");		
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $fetch =$stmt->execute();
        return $fetch;
	}



}