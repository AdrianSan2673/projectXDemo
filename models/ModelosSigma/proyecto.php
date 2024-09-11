<?php 
    class Proyecto {
        private $id;
        private $Nombre;
        private $Estado;
        private $direccion;
        private $status;
        private $Telefono;
        private $Activacion;
        private $id_tipo_usuario;
        private $creado;
        private $modificado;

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
    
        public function getNombre(){
            return $this->Nombre;
        }
    
        public function setNombre($Nombre){
            $this->Nombre = $Nombre;
        }
    
        public function getEstado(){
            return $this->Estado;
        }
    
        public function setEstado($Estado){
            $this->Estado = $Estado;
        }
    
        public function getDireccion(){
            return $this->direccion;
        }
    
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
    
        public function getStatus(){
            return $this->status;
        }
    
        public function setStatus($status){
            $this->status = $status;
        }
    
        public function getTelefono(){
            return $this->Telefono;
        }
    
        public function setTelefono($Telefono){
            $this->Telefono = $Telefono;
        }
    
        public function getActivacion(){
            return $this->Activacion;
        }
    
        public function setActivacion($Activacion){
            $this->Activacion = $Activacion;
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

        public function getAllProject(){
            $stmt = $this->db->prepare("SELECT * FROM proyecto ORDER BY id ASC;");
            $stmt->execute();
            $roles = $stmt->fetchAll();
            return $roles;
        }

        public function getOne(){
            $id = $this->getId();
            $stmt = $this->db->prepare("SELECT * from proyecto WHERE id=:id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $fetch = $stmt->fetchObject();
            return $fetch;
        }

        public function getTipoUsuario(){
            $id = $this->getId_tipo_usuario();
            $stmt = $this->db->prepare("SELECT tipo_usuario from tipo_usuario WHERE id=:id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $fetch = $stmt->fetchObject();
            return $fetch;
        }

        public function updateProject() {
            //Recopilo la informacion del project
            $id = $this->getId();
            $Nombre = $this->getNombre();
            $Estado = $this->getEstado();
            $direccion = $this->getDireccion();// El valor de la direccion sera pasado por el input
            $status = $this->getStatus();// El vaalor de status sera pasado por el input
            $Telefono = $this->getTelefono();// El valor de telefono sera pasado por el input
            $Activacion = $this->getActivacion(); 
            $id_tipo_usuario = $this->getId_tipo_usuario(); // el valor de id sera pasado por el input
            $creado = $this->getCreado();
            $modificado = $this->getModificado();

            $stmt = $this->db->prepare("UPDATE proyecto 
            SET direccion=:direccion, status=:status, Telefono=:Telefono, id_tipo_usuario=:id_tipo_usuario WHERE id=:id");
            $stmt->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);
            $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
            $stmt->bindParam(':Telefono', $this->Telefono, PDO::PARAM_STR);
            $stmt->bindParam(':id_tipo_usuario', $this->id_tipo_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        
    } 
?>