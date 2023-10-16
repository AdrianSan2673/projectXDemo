<?php

class UserAccess {
    private $id;
    private $section_name;
    private $create;
    private $read;
    private $update;
    private $delete;
    private $created_at;
    private $modified_at;
    private $id_user;
    private $created_by;

    private $db;

	public function __construct()
	{
		$this->db = Connection::connectSA();
	}

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getSection_name(){
		return $this->section_name;
	}

	public function setSection_name($section_name){
		$this->section_name = $section_name;
	}

	public function getCreate(){
		return $this->create;
	}

	public function setCreate($create){
		$this->create = $create;
	}

	public function getRead(){
		return $this->read;
	}

	public function setRead($read){
		$this->read = $read;
	}

	public function getUpdate(){
		return $this->update;
	}

	public function setUpdate($update){
		$this->update = $update;
	}

	public function getDelete(){
		return $this->delete;
	}

	public function setDelete($delete){
		$this->delete = $delete;
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

	public function getId_user(){
		return $this->id_user;
	}

	public function setId_user($id_user){
		$this->id_user = $id_user;
	}

	public function getCreated_by(){
		return $this->created_by;
	}

	public function setCreated_by($created_by){
		$this->created_by = $created_by;
	}

    public function getAccessById_user() {
        $id_user = $this->getId_user();

		$stmt = $this->db->prepare("SELECT * FROM root.user_access WHERE id_user=:id_user");
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $access = $stmt->fetchAll();

		return $access;
    }

    public function save()
    {

        $result = false;

        $section_name = $this->getSection_name();
        $create = $this->getCreate();
        $read = $this->getRead();
        $update = $this->getUpdate();
        $delete = $this->getDelete();
        $id_user = $this->getId_user();
        $created_by = $this->getCreated_by();

        $stmt = $this->db->prepare("INSERT INTO root.user_access (section_name, [create], [read], [update], [delete], id_user, created_by, created_at, modified_at) VALUES(:section_name, :create, :read, :update, :delete, :id_user, :created_by, GETDATE(), GETDATE())");
        $stmt->bindParam(":section_name", $section_name, PDO::PARAM_STR);
        $stmt->bindParam(":create", $create, PDO::PARAM_STR);
        $stmt->bindParam(":read", $read, PDO::PARAM_STR);
        $stmt->bindParam(":update", $update, PDO::PARAM_STR);
        $stmt->bindParam(":delete", $delete, PDO::PARAM_STR);
        $stmt->bindParam(":id_user", $id_user, PDO::PARAM_STR);
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
        $create = $this->getCreate();
        $read = $this->getRead();
        $update = $this->getUpdate();
        $delete = $this->getDelete();
        //$id_user = $this->getId_user();

        $stmt = $this->db->prepare("UPDATE root.user_access SET [create]=:create, [read]=:read, [update]=:update, [delete]=:delete, modified_at=GETDATE() WHERE id=:id");
        $stmt->bindParam(":create", $create, PDO::PARAM_STR);
        $stmt->bindParam(":read", $read, PDO::PARAM_STR);
        $stmt->bindParam(":update", $update, PDO::PARAM_STR);
        $stmt->bindParam(":delete", $delete, PDO::PARAM_STR);
        //$stmt->bindParam(":id_user", $id_user, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }
 }