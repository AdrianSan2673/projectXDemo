<?php 
    class Areas {
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
        public function getAllProject(){
            $stmt = $this->db->prepare("SELECT * FROM areas ORDER BY id ASC;");
            $stmt->execute();
            $roles = $stmt->fetchAll();
            return $roles;
        }

        public function getOne(){
            $id = $this->getId();
            $stmt = $this->db->prepare("SELECT * from areas WHERE id=:id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            
            $fetch = $stmt->fetchObject();
            return $fetch;
        }

    }
?>