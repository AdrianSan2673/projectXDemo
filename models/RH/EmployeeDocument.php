<?php

class EmployeeDocument{
    private $id;
	private $id_employee;
	private $image;
	private $file_name;
    private $document;
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

	public function getImage(){
		return $this->image;
	}

	public function setImage($image){
		$this->image = $image;
	}

	public function getFile_name(){
		return $this->file_name;
	}

	public function setFile_name($file_name){
		$this->file_name = $file_name;
	}

	public function getDocument(){
		return $this->document;
	}

	public function setDocument($document){
		$this->document = $document;
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
		$result = false;

		$id_employee = $this->getId_employee();
		$image = $this->getImage();
		$file_name = $this->getFile_name();
        $document = $this->getDocument();
		$stmt = $this->db->prepare("INSERT INTO root.employee_documents (id_employee, image, file_name, document, created_at, modified_at) VALUES (:id_employee, :image, :file_name, :document, GETDATE(), GETDATE())");

		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":image", $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
		$stmt->bindParam(":file_name", $file_name, PDO::PARAM_STR);
        $stmt->bindParam(":document", $document, PDO::PARAM_INT);

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
		$image = $this->getImage();
		$file_name = $this->getFile_name();
        $document = $this->getDocument();
		$stmt = $this->db->prepare("UPDATE root.employee_documents SET image=:image, file_name=:file_name, modified_at=GETDATE() WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":image", $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
		$stmt->bindParam(":file_name", $file_name, PDO::PARAM_STR);
        //$stmt->bindParam(":document", $document, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function delete()
	{
		$result = false;

		$id = $this->getId();
		$stmt = $this->db->prepare("DELETE FROM root.employee_documents WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

    public function getOne()
	{

		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM root.employee_documents WHERE id=:id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		if ($fetch) {
			$foto = base64_encode($fetch->image);
			$pic = "data:image/jpg;base64, $foto";
			$fetch->image = array($pic, 'jpg');
		}else
			$fetch = false;

		return $fetch;
	}

    public function getDocumentsByIdEmployee()
    {
        $id_employee = $this->getId_employee();
        $stmt = $this->db->prepare("SELECT d.id, id_employee, file_name, document, c.Descripcion, created_at, modified_at FROM root.employee_documents d INNER JOIN sys_Campos c ON d.document=c.Campo WHERE id_employee=:id_employee");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

	public function getMissingDocuments()
    {
        $id_employee = $this->getId_employee();
        $stmt = $this->db->prepare("SELECT c.Campo, c.Descripcion FROM (SELECT * FROM sys_Campos WHERE Tabla=104) c LEFT OUTER JOIN (SELECT id, document FROM root.employee_documents WHERE id_employee=:id_employee) e ON e.document=c.Campo WHERE e.document IS NULL ORDER BY c.Descripcion");
        $stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
}