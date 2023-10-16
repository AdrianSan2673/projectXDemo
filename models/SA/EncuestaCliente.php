<?php

class EncuestaCliente {

    private $Id;
    private $Experiencia;
    private $Objetivos;
    private $Asesoria;
    private $Resolucion;
    private $Comentarios;
    private $Usuario;
    private $ID_Empresa;
    private $ID_Cliente;
    private $ID_Cliente_Reclu;
    private $Fecha;
    
    public function __construct() {
        $this->db = Connection::connectSA();
        $this->db2 = Connection::connectSA2();
    }

    public function getId(){
        return $this->Id;
    }

    public function setId($Id){
        $this->Id = $Id;
    }

    public function getExperiencia(){
        return $this->Experiencia;
    }

    public function setExperiencia($Experiencia){
        $this->Experiencia = $Experiencia;
    }

    public function getObjetivos(){
        return $this->Objetivos;
    }

    public function setObjetivos($Objetivos){
        $this->Objetivos = $Objetivos;
    }

    public function getAsesoria(){
        return $this->Asesoria;
    }

    public function setAsesoria($Asesoria){
        $this->Asesoria = $Asesoria;
    }

    public function getResolucion(){
        return $this->Resolucion;
    }

    public function setResolucion($Resolucion){
        $this->Resolucion = $Resolucion;
    }

    public function getComentarios(){
        return $this->Comentarios;
    }

    public function setComentarios($Comentarios){
        $this->Comentarios = $Comentarios;
    }

    public function getUsuario(){
        return $this->Usuario;
    }

    public function setUsuario($Usuario){
        $this->Usuario = $Usuario;
    }

    public function getID_Empresa(){
        return $this->ID_Empresa;
    }

    public function setID_Empresa($ID_Empresa){
        $this->ID_Empresa = $ID_Empresa;
    }

    public function getID_Cliente(){
        return $this->ID_Cliente;
    }

    public function setID_Cliente($ID_Cliente){
        $this->ID_Cliente = $ID_Cliente;
    }

    public function getID_Cliente_Reclu(){
        return $this->ID_Cliente_Reclu;
    }

    public function setID_Cliente_Reclu($ID_Cliente_Reclu){
        $this->ID_Cliente_Reclu = $ID_Cliente_Reclu;
    }

    public function getFecha(){
        return $this->Fecha;
    }

    public function setFecha($Fecha){
        $this->Fecha = $Fecha;
    }

    public function getOneSA(){
        $Usuario = $this->getUsuario();
        $ID_Cliente = $this->getID_Cliente();
        $ID_Empresa = $this->getID_Empresa();
        $Mes = $this->getFecha();
        $Anio = $this->getFecha();

        $stmt = $this->db->prepare("SELECT * FROM Encuesta_Cliente WHERE Usuario=:Usuario AND ID_Cliente=:ID_Cliente AND ID_Empresa=:ID_Empresa AND YEAR(Fecha)=YEAR(:Anio) AND MONTH(Fecha)=MONTH(:Mes)");
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Empresa", $ID_Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":Mes", $Mes, PDO::PARAM_STR);
        $stmt->bindParam(":Anio", $Anio, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getOneReclu(){
        $Usuario = $this->getUsuario();
        $ID_Cliente_Reclu = $this->getID_Cliente_Reclu();
        $Mes = $this->getFecha();
        $Anio = $this->getFecha();

        $stmt = $this->db->prepare(
            "SELECT * FROM Encuesta_Cliente WHERE Usuario=:Usuario AND ID_Cliente_Reclu=:ID_Cliente_Reclu AND YEAR(Fecha)=YEAR(:Anio) AND MONTH(Fecha)=MONTH(:Mes)");
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Cliente_Reclu", $ID_Cliente_Reclu, PDO::PARAM_INT);
        $stmt->bindParam(":Mes", $Mes, PDO::PARAM_STR);
        $stmt->bindParam(":Anio", $Anio, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getAll(){
        $stmt = $this->db2->prepare("SELECT e.id, Experiencia, Objetivos, Asesoria, Resolucion, ROUND((CAST((Experiencia + Objetivos + Asesoria + Resolucion) AS float)/4), 2) AS Promedio, Comentarios, e.Fecha, e.Usuario, first_name, last_name, email, Nombre_Empresa, Nombre_Cliente, customer, ID_Empresa, ID_Cliente, ID_Cliente_Reclu FROM rrhhinge_Candidatos.dbo.Encuesta_Cliente e LEFT JOIN reclutamiento.dbo.users u ON e.Usuario=u.username LEFT JOIN rrhhinge_Candidatos.dbo.rh_Ventas_Empresas ve ON e.ID_Empresa=ve.Empresa LEFT JOIN rrhhinge_Candidatos.dbo.rh_Ventas_Alta va ON va.Cliente=e.ID_Cliente LEFT JOIN reclutamiento.dbo.customers c ON e.ID_Cliente_Reclu=c.id ORDER BY Fecha DESC");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function create(){
		$result = false;

		$ID_Empresa = $this->getID_Empresa();
        $ID_Cliente = $this->getID_Cliente();
        $ID_Cliente_Reclu = $this->getID_Cliente_Reclu();
        $Experiencia = $this->getExperiencia();
        $Objetivos = $this->getObjetivos();
        $Asesoria = $this->getAsesoria();
        $Resolucion = $this->getResolucion();
        $Comentarios = $this->getComentarios();
        $Usuario = $this->getUsuario();
		
        $stmt = $this->db->prepare("INSERT INTO Encuesta_Cliente (Comentarios, ID_Empresa, ID_Cliente, ID_Cliente_Reclu, Experiencia, Objetivos, Asesoria, Resolucion, Fecha, Usuario) VALUES (:Comentarios, :ID_Empresa, :ID_Cliente, :ID_Cliente_Reclu, :Experiencia, :Objetivos, :Asesoria, :Resolucion, GETDATE(), :Usuario)");
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Empresa", $ID_Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Cliente_Reclu", $ID_Cliente_Reclu, PDO::PARAM_INT);
        $stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
        $stmt->bindParam(":Experiencia", $Experiencia, PDO::PARAM_INT);
        $stmt->bindParam(":Objetivos", $Objetivos, PDO::PARAM_INT);
        $stmt->bindParam(":Asesoria", $Asesoria, PDO::PARAM_INT);
        $stmt->bindParam(":Resolucion", $Resolucion, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
			$this->setID($this->db->lastInsertId());
        }
        return $result;
    }
}