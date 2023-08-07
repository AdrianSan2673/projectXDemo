<?php

class EmployeeAvatar
{
	private $id;
	private $id_employee;
	private $image;
	private $created_at;
	private $modified_at;
	private $file_name;
	private $db;


	public function __construct()
	{
		$this->db = Connection::connectSA();
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId_employee()
	{
		return $this->id_employee;
	}

	public function setId_employee($id_employee)
	{
		$this->id_employee = $id_employee;
	}

	public function getImage()
	{
		return $this->image;
	}

	public function setImage($image)
	{
		$this->image = $image;
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

	public function getFile_name()
	{
		return $this->file_name;
	}

	public function setFile_name($file_name)
	{
		$this->file_name = $file_name;
	}

	public function save()
	{
		$result = false;

		$id_employee = $this->getId_employee();
		$image = $this->getImage();
		$file_name = $this->getFile_name();
		$stmt = $this->db->prepare("INSERT INTO root.employee_avatar (id_employee,	image,	created_at,	modified_at,file_name) VALUES (:id_employee, :image, GETDATE(), GETDATE(),:file_name)");

		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->bindParam(":image", $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
		$stmt->bindParam(":file_name", $file_name, PDO::PARAM_STR);

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
		$stmt = $this->db->prepare("UPDATE root.employee_avatar SET image=:image,file_name=:file_name,modified_at=GETDATE() WHERE id=:id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":image", $image, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
		$stmt->bindParam(":file_name", $file_name, PDO::PARAM_STR);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function delete()
	{
		$result = false;

		$id_employee = $this->getId_employee();
		$stmt = $this->db->prepare("DELETE FROM root.employee_avatar WHERE id_employee=:id_employee");

		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}

		return $result;
	}

	public function getOne()
	{

		$id = $this->getId();
		$stmt = $this->db->prepare("SELECT * FROM root.employee_avatar WHERE id=:id");
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

	public function getOneByIdEmployee()
	{
		$id_employee = $this->getId_employee();
		$stmt = $this->db->prepare("SELECT * FROM root.employee_avatar WHERE id_employee=:id_employee");
		$stmt->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
		$stmt->execute();
		$fetch =  $stmt->fetchObject();
		if ($fetch) {
			$foto = base64_encode($fetch->image);
			$pic = "data:image/jpg;base64, $foto";
			$fetch->image = Utils::getImage($pic);
		}else
			$fetch = false;

		return $fetch;
	}
}
