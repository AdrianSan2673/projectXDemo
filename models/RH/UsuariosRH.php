<?php
class UsuariosRH
{
    private $id;
    private $username;
    private $password;
    private $id_cliente;
    private $created_at;
    private $db;
	private $status;



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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
    }
	 public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }


    //===[gabo 7 julio rh_empleado]===
    public function save()
    {

        $username = $this->getUsername();
        $password = $this->getPassword();
        $id_cliente = $this->getId_cliente();

        $stmt = $this->db->prepare("INSERT INTO usuarios_rh(username,password,id_cliente,created_at) VALUES (:username,:password,:id_cliente, GETDATE())");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $this->setId($this->db->lastInsertId());
        }
        return $flag;
    }
    //===[gabo 7 julio rh_empleado]===

    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * from usuarios_rh where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function update_password_rh()
    {

        $id = $this->getId();
        $password = $this->getPassword();
        $stmt = $this->db->prepare("UPDATE usuarios_rh SET password=:password where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $flag = $stmt->execute();
        return $flag;
    }

    //===[gabo 7 julio  user_rh]===
     public function login_rh()
    {
        $result = false;
        $username = $this->getUsername();
        $password = $this->getPassword();

        $stmt = $this->db->prepare("SELECT * from usuarios_rh WHERE username = :username", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        $numRows = $stmt->rowCount();

        if ($fetch && $numRows == 1) {

            $verify = ($password === Encryption::decode($fetch->password) ? true : false);
            if ($verify) {
                $result = $fetch;
            }
        }
        return $result;
    }
    //===[gabo  7 julio user_rh fin]===

    public function updateUsername()
    {

        $id = $this->getId();
        $username = $this->getUsername();
        $stmt = $this->db->prepare("UPDATE usuarios_rh SET username=:username where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $flag = $stmt->execute();
        return $flag;
    }
	 public function exist_username()
    {
        $username = $this->getUsername();
        $stmt = $this->db->prepare("SELECT * from usuarios_rh where username=:username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }


    public function updateStatus()
    {
        $status = $this->getStatus();
        $id = $this->getId();

        $username = $this->getUsername();
        $stmt = $this->db->prepare("UPDATE usuarios_rh SET status=:status where id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $flag = $stmt->execute();
        return $flag;
    }
	    public function getOneBYusername()
    {
        $username = $this->getUsername();
        $stmt = $this->db->prepare("SELECT * from usuarios_rh where username=:username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }
	
    public function getUsersInfo()
    {

        $stmt = $this->db->prepare("SELECT * from usuarios_rh u INNER JOIN root.employees e ON u.id=e.usuario_rh where id_cliente=132");

        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
}
