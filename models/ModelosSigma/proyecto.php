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
    }
?>