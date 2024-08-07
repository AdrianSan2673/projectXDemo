<?php 
    class mensajes_foro_proyecto {
        private $id;
        private $id_proyecto;
        private $id_area;
        private $id_usuario;
        private $mensaje;
        private $creado;

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getId_proyecto(){
            return $this->id_proyecto;
        }
    
        public function setId_proyecto($id_proyecto){
            $this->id_proyecto = $id_proyecto;
        }
    
        public function getId_area(){
            return $this->id_area;
        }
    
        public function setId_area($id_area){
            $this->id_area = $id_area;
        }
    
        public function getId_usuario(){
            return $this->id_usuario;
        }
    
        public function setId_usuario($id_usuario){
            $this->id_usuario = $id_usuario;
        }
    
        public function getMensaje(){
            return $this->mensaje;
        }
    
        public function setMensaje($mensaje){
            $this->mensaje = $mensaje;
        }
    
        public function getCreado(){
            return $this->creado;
        }
    
        public function setCreado($creado){
            $this->creado = $creado;
        }

    }
?>