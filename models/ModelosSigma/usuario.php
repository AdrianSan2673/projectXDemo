<?php
class Usuario {

    private $id;
    private $usuario;
    private $password;
    private $Nombres;
    private $Apellidos;
    private $Correo;
    private $Telefono;
    private $Activation;
    private $id_tipo_usuario;
    private $creado;
    private $modificado;
	private $nueva;
	private $db;

	public function __construct() {
        $this->db = Connection::connect();
    }

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getNombres(){
		return $this->Nombres;
	}

	public function setNombres($Nombres){
		$this->Nombres = $Nombres;
	}

	public function getApellidos(){
		return $this->Apellidos;
	}

	public function setApellidos($Apellidos){
		$this->Apellidos = $Apellidos;
	}

	public function getCorreo(){
		return $this->Correo;
	}

	public function setCorreo($Correo){
		$this->Correo = $Correo;
	}

	public function getTelefono(){
		return $this->Telefono;
	}

	public function setTelefono($Telefono){
		$this->Telefono = $Telefono;
	}

	public function getActivation(){
		return $this->Activation;
	}

	public function setActivation($Activation){
		$this->Activation = $Activation;
	}

	public function getId_tipo_usuario(){
		return $this->id_tipo_usuario;
	}

	public function setId_tipo_usuario($id_tipo_usuario){
		$this->id_tipo_usuario = $id_tipo_usuario;
	}

	public function getCreado(){
		return $this->creado;
	}

	public function setCreado($creado){
		$this->creado = $creado;
	}

	public function getModificado(){
		return $this->modificado;
	}

	public function setModificado($modificado){
		$this->modificado = $modificado;
	}

	public function getAll(){
        $stmt = $this->db->prepare("SELECT u.*,t.tipo_usuario FROM usuarios u INNER JOIN tipo_usuario t ON u.id_tipo_usuario=t.id where activacion=1 ORDER BY u.id ASC");
        $stmt->execute();
        $usuarios = $stmt->fetchAll();
        return $usuarios;
    }


	public function getAllUsuario(){
            $stmt = $this->db->prepare("SELECT * FROM usuarios ORDER BY id ASC;");
            $stmt->execute();
            $roles = $stmt->fetchAll();
            return $roles;
	}

	public function getUserTypes(){
        $stmt = $this->db->prepare("SELECT * FROM tipo_usuario ORDER BY id ASC;");
        $stmt->execute();
        $roles = $stmt->fetchAll();
        return $roles;
    }
    
    public function getOne(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT u.*, t.tipo_usuario FROM usuarios u INNER JOIN tipo_usuario t ON u.id_tipo_usuario=t.id  WHERE u.id=:id;");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	

	public function desactivar_usuario()
    {
  
		$id = $this->getId();
		$activacion = $this->getActivation();

    
        $stmt = $this->db->prepare("UPDATE usuarios 
        SET activacion=:activacion 
        WHERE id=:id");


		   $stmt->bindParam(":id", $id, PDO::PARAM_INT);
		   $stmt->bindParam(":activacion", $activacion, PDO::PARAM_INT);

		

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }

	public function updateUser()
    {
  
        $usuario = $this->getUsuario();
        $password = $this->getPassword();
        $Nombres = $this->getNombres();
        $Apellidos = $this->getApellidos();
        $Correo = $this->getCorreo();
		$id = $this->getId();
        $id_tipo_usuario = $this->getId_tipo_usuario();

        $stmt = $this->db->prepare("UPDATE usuarios 
        SET usuario=:usuario, password=:password, Nombres=:Nombres, Apellidos=:Apellidos, Correo=:Correo,id_tipo_usuario=:id_tipo_usuario,modificado=GETDATE() 
        WHERE id=:id");

           $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		   $stmt->bindParam(":password", $password, PDO::PARAM_STR);
		   $stmt->bindParam(":Nombres", $Nombres, PDO::PARAM_STR);
		   $stmt->bindParam(":Apellidos", $Apellidos, PDO::PARAM_STR);
		   $stmt->bindParam(":Correo", $Correo, PDO::PARAM_STR);
		   $stmt->bindParam(":id", $id, PDO::PARAM_INT);
		   $stmt->bindParam(":id_tipo_usuario", $id_tipo_usuario, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }

        return $result;
    }


	public function save() {
 
        $usuario = $this->getUsuario(); // saca el objeto de usuario, de la vista  va al JS, js va al controllador, controlador al modelo
        $password = $this->getPassword();
        $Nombres = $this->getNombres();
        $Apellidos = $this->getApellidos();
        $Correo = $this->getCorreo();
		// $Telefono = $this->getTelefono();
        $activation = $this->getActivation();
        $id_tipo_usuario = $this->getId_tipo_usuario();
    
        $stmt = $this->db->prepare("INSERT INTO usuarios (usuario, password, Nombres, Apellidos, Correo, Activacion, id_tipo_usuario, creado,modificado) VALUES(:usuario, :password, :Nombres, :Apellidos, :Correo, :activacion, :id_tipo_usuario, GETDATE(),GETDATE())");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":Nombres", $Nombres, PDO::PARAM_STR);
        $stmt->bindParam(":Apellidos", $Apellidos, PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $Correo, PDO::PARAM_STR);
       // $stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_INT);
        $stmt->bindParam(":activacion", $activation, PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_usuario", $id_tipo_usuario, PDO::PARAM_INT);
		

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
          //  $this->setToken($token);
        }
        
        return $result;
    }



	
    public function userExists(){
        $result = FALSE;
        $username = $this->getUsuario();
		$stmt = $this->db->prepare("SELECT TOP 1 id, usuario FROM usuarios WHERE usuario = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();       
        $fetch = $stmt->fetchObject();
		$num = $stmt->rowCount();
		if ($num > 0){
			$result = $fetch->username;
            $this->setId($fetch->id);
		}
        return $result;
    }



}
?>
