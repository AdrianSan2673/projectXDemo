<?php
class Usuario {

    private $id;
    private $usuariomanuel;
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

	public function getAllUsuario(){
            $stmt = $this->db->prepare("SELECT * FROM usuarios ORDER BY id ASC;");
            $stmt->execute();
            $roles = $stmt->fetchAll();
            return $roles;
	}

	public function getOne(){
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * from usuarios WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function save() {
 
        $usuario = $this->getUsuario();
        $password = $this->getPassword();
        $Nombres = $this->getNombres();
        $Apellidos = $this->getApellidos();
        $Correo = $this->getCorreo();
		$Telefono = $this->getTelefono();
        $activation = $this->getActivation();
        $id_tipo_usuario = $this->getId_tipo_usuario();
    
        $stmt = $this->db->prepare("INSERT INTO users (usuario, password, Nombres, Apellidos, Correo,Telefono, Activation, id_tipo_usuario, creado) VALUES(:usuario, :password, :Nombres, :Apellidos, :Correo, :Telefono, :activation, :id_tipo_usuario, GETDATE())");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":Nombres", $Nombres, PDO::PARAM_STR);
        $stmt->bindParam(":Apellidos", $Apellidos, PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $Correo, PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_INT);
        $stmt->bindParam(":Activation", $activation, PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_usuario", $id_tipo_usuario, PDO::PARAM_INT);
		

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
            $this->setToken($token);
        }
        
        return $result;
    }
}
?>
