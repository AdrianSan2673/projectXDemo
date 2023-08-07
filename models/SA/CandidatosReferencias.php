<?php
class CandidatosReferencias{

       //rh_Candidatos_Referencias
       private $Candidato;
       private $Renglon;
       private $Tipo;
       private $Relacion;
       private $Nombre;
       private $Telefono;
       private $Domicilio;
       private $Domicilio_Candidato;
       private $Tiempo_Conocerlo;
       private $Tiempo_Viviendo;
       private $Tiene_Hijos;
       private $Dedicacion;
       private $Estado_Civil;
       private $Comentarios;
   
       public function __construct() {
        $this->db = Connection::connectSA();
    }

	public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getRenglon(){
		return $this->Renglon;
	}

	public function setRenglon($Renglon){
		$this->Renglon = $Renglon;
	}

	public function getTipo(){
		return $this->Tipo;
	}

	public function setTipo($Tipo){
		$this->Tipo = $Tipo;
	}

	public function getRelacion(){
		return $this->Relacion;
	}

	public function setRelacion($Relacion){
		$this->Relacion = $Relacion;
	}

	public function getNombre(){
		return $this->Nombre;
	}

	public function setNombre($Nombre){
		$this->Nombre = $Nombre;
	}

	public function getTelefono(){
		return $this->Telefono;
	}

	public function setTelefono($Telefono){
		$this->Telefono = $Telefono;
	}

	public function getDomicilio(){
		return $this->Domicilio;
	}

	public function setDomicilio($Domicilio){
		$this->Domicilio = $Domicilio;
	}

	public function getDomicilio_Candidato(){
		return $this->Domicilio_Candidato;
	}

	public function setDomicilio_Candidato($Domicilio_Candidato){
		$this->Domicilio_Candidato = $Domicilio_Candidato;
	}

	public function getTiempo_Conocerlo(){
		return $this->Tiempo_Conocerlo;
	}

	public function setTiempo_Conocerlo($Tiempo_Conocerlo){
		$this->Tiempo_Conocerlo = $Tiempo_Conocerlo;
	}

	public function getTiempo_Viviendo(){
		return $this->Tiempo_Viviendo;
	}

	public function setTiempo_Viviendo($Tiempo_Viviendo){
		$this->Tiempo_Viviendo = $Tiempo_Viviendo;
	}

	public function getTiene_Hijos(){
		return $this->Tiene_Hijos;
	}

	public function setTiene_Hijos($Tiene_Hijos){
		$this->Tiene_Hijos = $Tiene_Hijos;
	}

	public function getDedicacion(){
		return $this->Dedicacion;
	}

	public function setDedicacion($Dedicacion){
		$this->Dedicacion = $Dedicacion;
	}

	public function getEstado_Civil(){
		return $this->Estado_Civil;
	}

	public function setEstado_Civil($Estado_Civil){
		$this->Estado_Civil = $Estado_Civil;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios = $Comentarios;
	}

	public function getReferenciasPorCandidato(){
		$Candidato=$this->getCandidato();
		$stmt = $this->db->prepare(
			"SELECT * FROM rh_Candidatos_Referencias WHERE Candidato=:Candidato"
		);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->execute();
		$referencias = $stmt->fetchAll();
		return $referencias;
	}

	
	public function getOne(){
        $Candidato=$this->getCandidato();
        $Renglon=$this->getRenglon();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Referencias WHERE Candidato=:Candidato AND Renglon=:Renglon"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function getRenglonMax(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Referencias WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Renglon;
    }

	public function create(){
		$result = false;

		$Renglon = $this->getRenglonMax() + 1;
		$Candidato = $this->getCandidato();
		$Tipo = $this->getTipo();
        $Relacion = $this->getRelacion();
        $Nombre = $this->getNombre();
		$Telefono = $this->getTelefono();
		$Domicilio = $this->getDomicilio();
		$Domicilio_Candidato = $this->getDomicilio_Candidato();
		$Tiempo_Viviendo = $this->getTiempo_Viviendo();
		$Tiempo_Conocerlo = $this->getTiempo_Conocerlo();
		$Tiene_Hijos = $this->getTiene_Hijos();
        $Dedicacion = $this->getDedicacion();
        $Estado_Civil = $this->getEstado_Civil();
        $Comentarios = $this->getComentarios();

		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Referencias(Candidato, Renglon, Tipo, Relacion, Nombre, Telefono, Domicilio, Domicilio_Candidato, Tiempo_Viviendo, Tiempo_Conocerlo, Tiene_Hijos, Dedicacion, Estado_Civil, Comentarios)
		VALUES (:Candidato, :Renglon, :Tipo, :Relacion, :Nombre, :Telefono, :Domicilio, :Domicilio_Candidato, :Tiempo_Viviendo, :Tiempo_Conocerlo, :Tiene_Hijos, :Dedicacion, :Estado_Civil, :Comentarios)");
		$stmt->bindParam(":Tipo", $Tipo, PDO::PARAM_INT);
        $stmt->bindParam(":Relacion", $Relacion, PDO::PARAM_STR);
        $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
		$stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Domicilio", $Domicilio, PDO::PARAM_STR);
		$stmt->bindParam(":Domicilio_Candidato", $Domicilio_Candidato, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Viviendo", $Tiempo_Viviendo, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Conocerlo", $Tiempo_Conocerlo, PDO::PARAM_STR);
		$stmt->bindParam(":Tiene_Hijos", $Tiene_Hijos, PDO::PARAM_STR);
		$stmt->bindParam(":Dedicacion", $Dedicacion, PDO::PARAM_STR);
		$stmt->bindParam(":Estado_Civil", $Estado_Civil, PDO::PARAM_STR);
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
			$this->setRenglon($Renglon);
        }
        return $result;
    }

	public function update(){
        $result = false;

		$Renglon = $this->getRenglon();
		$Candidato = $this->getCandidato();
		$Tipo = $this->getTipo();
        $Relacion = $this->getRelacion();
        $Nombre = $this->getNombre();
		$Telefono = $this->getTelefono();
		$Domicilio = $this->getDomicilio();
		$Domicilio_Candidato = $this->getDomicilio_Candidato();
		$Tiempo_Viviendo = $this->getTiempo_Viviendo();
		$Tiempo_Conocerlo = $this->getTiempo_Conocerlo();
		$Tiene_Hijos = $this->getTiene_Hijos();
        $Dedicacion = $this->getDedicacion();
        $Estado_Civil = $this->getEstado_Civil();
        $Comentarios = $this->getComentarios();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Referencias
		SET 
			Tipo = :Tipo, 
			Relacion = :Relacion, 
			Nombre = :Nombre, 
			Telefono = :Telefono, 
			Domicilio = :Domicilio, 
			Domicilio_Candidato = :Domicilio_Candidato, 
			Tiempo_Viviendo = :Tiempo_Viviendo, 
			Tiempo_Conocerlo = :Tiempo_Conocerlo, 
			Tiene_Hijos = :Tiene_Hijos, 
			Dedicacion = :Dedicacion, 
			Estado_Civil = :Estado_Civil, 
			Comentarios = :Comentarios
		WHERE 
			Candidato = :Candidato
			AND Renglon = :Renglon");
        $stmt->bindParam(":Tipo", $Tipo, PDO::PARAM_INT);
        $stmt->bindParam(":Relacion", $Relacion, PDO::PARAM_STR);
        $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_STR);
		$stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Domicilio", $Domicilio, PDO::PARAM_STR);
		$stmt->bindParam(":Domicilio_Candidato", $Domicilio_Candidato, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Viviendo", $Tiempo_Viviendo, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Conocerlo", $Tiempo_Conocerlo, PDO::PARAM_STR);
		$stmt->bindParam(":Tiene_Hijos", $Tiene_Hijos, PDO::PARAM_STR);
		$stmt->bindParam(":Dedicacion", $Dedicacion, PDO::PARAM_STR);
		$stmt->bindParam(":Estado_Civil", $Estado_Civil, PDO::PARAM_STR);
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function delete(){
		$result = false;

		$Candidato = $this->getCandidato();
		$Renglon = $this->getRenglon();
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Referencias WHERE Candidato=:Candidato AND Renglon=:Renglon");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
	
	public function duplicate($duplicado){
		$result = false;

		$Candidato = $this->getCandidato();
		$Folio = $duplicado;
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Referencias(Candidato, Renglon, Tipo, Relacion, Nombre, Telefono, Domicilio, Domicilio_Candidato, Tiempo_Viviendo, Tiempo_Conocerlo, Tiene_Hijos, Dedicacion, Estado_Civil, Comentarios)
		SELECT :Candidato, Renglon, Tipo, Relacion, Nombre, Telefono, Domicilio, Domicilio_Candidato, Tiempo_Viviendo, Tiempo_Conocerlo, Tiene_Hijos, Dedicacion, Estado_Civil, Comentarios FROM rh_Candidatos_Referencias WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function getBaseContactos(){
		$stmt = $this->db->prepare(
			"select DISTINCT Empresa, Informante, Telefono from rh_Candidatos_Laborales WHERE Empresa <> '' AND Telefono <> '' ORDER BY Empresa ASC"
		);
		$stmt->execute();
		$referencias = $stmt->fetchAll();
		return $referencias;
	}

}