<?php

class Progreso{

    private $Candidato;
    private $Datos_Generales;
    private $Datos_Adicionales;
    private $Documentos;
    private $Salud;
    private $Sociales;
    private $Ubicacion;
    private $Estructura;
    private $Ref_Vecinal;
    private $Obs_Generales;
    private $Fecha;
    private $Terminado;
    private $Comentario;
    private $Evaluador_Fallida;

    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getDatos_Generales(){
		return $this->Datos_Generales;
	}

	public function setDatos_Generales($Datos_Generales){
		$this->Datos_Generales = $Datos_Generales;
	}

	public function getDatos_Adicionales(){
		return $this->Datos_Adicionales;
	}

	public function setDatos_Adicionales($Datos_Adicionales){
		$this->Datos_Adicionales = $Datos_Adicionales;
	}

	public function getDocumentos(){
		return $this->Documentos;
	}

	public function setDocumentos($Documentos){
		$this->Documentos = $Documentos;
	}

	public function getSalud(){
		return $this->Salud;
	}

	public function setSalud($Salud){
		$this->Salud = $Salud;
	}

	public function getSociales(){
		return $this->Sociales;
	}

	public function setSociales($Sociales){
		$this->Sociales = $Sociales;
	}

	public function getUbicacion(){
		return $this->Ubicacion;
	}

	public function setUbicacion($Ubicacion){
		$this->Ubicacion = $Ubicacion;
	}

	public function getEstructura(){
		return $this->Estructura;
	}

	public function setEstructura($Estructura){
		$this->Estructura = $Estructura;
	}

	public function getRef_Vecinal(){
		return $this->Ref_Vecinal;
	}

	public function setRef_Vecinal($Ref_Vecinal){
		$this->Ref_Vecinal = $Ref_Vecinal;
	}

	public function getObs_Generales(){
		return $this->Obs_Generales;
	}

	public function setObs_Generales($Obs_Generales){
		$this->Obs_Generales = $Obs_Generales;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

	public function getTerminado(){
		return $this->Terminado;
	}

	public function setTerminado($Terminado){
		$this->Terminado = $Terminado;
	}

	public function getComentario(){
		return $this->Comentario;
	}

	public function setComentario($Comentario){
		$this->Comentario = $Comentario;
	}

	public function getEvaluador_Fallida(){
		return $this->Evaluador_Fallida;
	}

	public function setEvaluador_Fallida($Evaluador_Fallida){
		$this->Evaluador_Fallida = $Evaluador_Fallida;
	}

    public function getOne(){
        $Candidato = $this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM Progreso_Gestor WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function create(){
        $result = false;

		$Candidato = $this->getCandidato();

        $stmt = $this->db->prepare("INSERT INTO Progreso_Gestor(Candidato) VALUES (:Candidato)");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateDatosGenerales(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Datos_Generales = $this->getDatos_Generales();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Datos_Generales=:Datos_Generales, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Datos_Generales", $Datos_Generales, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateDatosAdicionales(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Datos_Adicionales = $this->getDatos_Adicionales();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Datos_Adicionales=:Datos_Adicionales, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Datos_Adicionales", $Datos_Adicionales, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateDocumentos(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Documentos = $this->getDocumentos();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Documentos=:Documentos, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Documentos", $Documentos, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateSalud(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Salud = $this->getSalud();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Salud=:Salud, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Salud", $Salud, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateSociales(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Sociales = $this->getSociales();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Sociales=:Sociales, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Sociales", $Sociales, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateUbicacion(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Ubicacion = $this->getUbicacion();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Ubicacion=:Ubicacion, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Ubicacion", $Ubicacion, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateEstructura(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Estructura = $this->getEstructura();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Estructura=:Estructura, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Estructura", $Estructura, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateRefVecinal(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Ref_Vecinal = $this->getRef_Vecinal();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Ref_Vecinal=:Ref_Vecinal, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Ref_Vecinal", $Ref_Vecinal, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateObsGenerales(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Obs_Generales = $this->getObs_Generales();

        $stmt = $this->db->prepare("UPDATE Progreso_Gestor SET Obs_Generales=:Obs_Generales, Fecha=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Obs_Generales", $Obs_Generales, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
}