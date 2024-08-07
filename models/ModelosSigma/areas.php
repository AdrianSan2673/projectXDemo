<?php 
    class areas {
        private $id;
        private $nombre_area;

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getNombre_area(){
            return $this->nombre_area;
        }
    
        public function setNombre_area($nombre_area){
            $this->nombre_area = $nombre_area;
        }
    }
?>