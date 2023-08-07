<?php

class Usuarios{
    private $Perfil;

    private $db;

    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getPerfil(){
        return $this->Perfil;
    }

    public function setPerfil($Perfil){
        $this->Perfil = $Perfil;
    }


    public function getUsuariosPorPerfil(){
        $Perfil = $this->getPerfil();
        
        $stmt = $this->db->prepare("SELECT Usuario= UPPER(Usuario), 
		Nombre= UPPER(LTRIM(RTRIM(US.Nombres +' '+US.Apellidos))),
		us.Perfil
	FROM Seguridad_Usuarios US
	WHERE (Perfil= :Perfil or Perfil=1 or Perfil = 7) and Activo=1");
        
        $stmt->bindParam(":Perfil", $Perfil, PDO::PARAM_INT);
        $stmt->execute();
        $usuarios = $stmt->fetchAll();
        return $usuarios;
    }
}