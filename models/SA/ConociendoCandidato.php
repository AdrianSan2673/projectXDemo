<?php 
 class ConociendoCandidato {


    private $Candidato;
    private $Interes_Puesto;							
    private $Que_Esperas_Lograr;
    private $Caracteristicas_Empleo;
    private $Objetivo_Laboral;
    private $Que_Esperas_Empresa;
    private $Cualidades;
    private $Trabajo_Equipo;
    private $Ultimos_Jefes;
    private $Que_Esperas_Aportar;
    private $Jornada_Laboral;
    private $Motivacion;
    private $Que_Dirian_Jefes_Anteriores;
    private $Orgullo_Trayectoria_Laboral;
    private $No_Te_Gusto_Empleos_Anteriores;
    private $Estas_Otros_Procesos;

 	private $db;

	
    public function __construct() {
        $this->db = Connection::connectSA();
    }


    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getInteres_Puesto(){
		return $this->Interes_Puesto;
	}

	public function setInteres_Puesto($Interes_Puesto){
		$this->Interes_Puesto = $Interes_Puesto;
	}

	public function getQue_Esperas_Lograr(){
		return $this->Que_Esperas_Lograr;
	}

	public function setQue_Esperas_Lograr($Que_Esperas_Lograr){
		$this->Que_Esperas_Lograr = $Que_Esperas_Lograr;
	}

	public function getCaracteristicas_Empleo(){
		return $this->Caracteristicas_Empleo;
	}

	public function setCaracteristicas_Empleo($Caracteristicas_Empleo){
		$this->Caracteristicas_Empleo = $Caracteristicas_Empleo;
	}

	public function getObjetivo_Laboral(){
		return $this->Objetivo_Laboral;
	}

	public function setObjetivo_Laboral($Objetivo_Laboral){
		$this->Objetivo_Laboral = $Objetivo_Laboral;
	}

	public function getQue_Esperas_Empresa(){
		return $this->Que_Esperas_Empresa;
	}

	public function setQue_Esperas_Empresa($Que_Esperas_Empresa){
		$this->Que_Esperas_Empresa = $Que_Esperas_Empresa;
	}

	public function getCualidades(){
		return $this->Cualidades;
	}

	public function setCualidades($Cualidades){
		$this->Cualidades = $Cualidades;
	}

	public function getTrabajo_Equipo(){
		return $this->Trabajo_Equipo;
	}

	public function setTrabajo_Equipo($Trabajo_Equipo){
		$this->Trabajo_Equipo = $Trabajo_Equipo;
	}

	public function getUltimos_Jefes(){
		return $this->Ultimos_Jefes;
	}

	public function setUltimos_Jefes($Ultimos_Jefes){
		$this->Ultimos_Jefes = $Ultimos_Jefes;
	}

	public function getQue_Esperas_Aportar(){
		return $this->Que_Esperas_Aportar;
	}

	public function setQue_Esperas_Aportar($Que_Esperas_Aportar){
		$this->Que_Esperas_Aportar = $Que_Esperas_Aportar;
	}

	public function getJornada_Laboral(){
		return $this->Jornada_Laboral;
	}

	public function setJornada_Laboral($Jornada_Laboral){
		$this->Jornada_Laboral = $Jornada_Laboral;
	}

	public function getMotivacion(){
		return $this->Motivacion;
	}

	public function setMotivacion($Motivacion){
		$this->Motivacion = $Motivacion;
	}

	public function getQue_Dirian_Jefes_Anteriores(){
		return $this->Que_Dirian_Jefes_Anteriores;
	}

	public function setQue_Dirian_Jefes_Anteriores($Que_Dirian_Jefes_Anteriores){
		$this->Que_Dirian_Jefes_Anteriores = $Que_Dirian_Jefes_Anteriores;
	}

	public function getOrgullo_Trayectoria_Laboral(){
		return $this->Orgullo_Trayectoria_Laboral;
	}

	public function setOrgullo_Trayectoria_Laboral($Orgullo_Trayectoria_Laboral){
		$this->Orgullo_Trayectoria_Laboral = $Orgullo_Trayectoria_Laboral;
	}

	public function getNo_Te_Gusto_Empleos_Anteriores(){
		return $this->No_Te_Gusto_Empleos_Anteriores;
	}

	public function setNo_Te_Gusto_Empleos_Anteriores($No_Te_Gusto_Empleos_Anteriores){
		$this->No_Te_Gusto_Empleos_Anteriores = $No_Te_Gusto_Empleos_Anteriores;
	}

	public function getEstas_Otros_Procesos(){
		return $this->Estas_Otros_Procesos;
	}

	public function setEstas_Otros_Procesos($Estas_Otros_Procesos){
		$this->Estas_Otros_Procesos = $Estas_Otros_Procesos;
	}

	public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM Conociendo_Candidato  WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Interes_Puesto = $this->getInteres_Puesto();
        $Que_Esperas_Lograr = $this->getQue_Esperas_Lograr();
        $Caracteristicas_Empleo = $this->getCaracteristicas_Empleo();
		$Objetivo_Laboral = $this->getObjetivo_Laboral();
		$Que_Esperas_Empresa = $this->getQue_Esperas_Empresa();
		$Cualidades = $this->getCualidades();
		$Trabajo_Equipo = $this->getTrabajo_Equipo();
		$Ultimos_Jefes = $this->getUltimos_Jefes();
		$Que_Esperas_Aportar = $this->getQue_Esperas_Aportar();
		$Jornada_Laboral = $this->getJornada_Laboral();
		$Motivacion = $this->getMotivacion();
		$Que_Dirian_Jefes_Anteriores = $this->getQue_Dirian_Jefes_Anteriores();
		$Orgullo_Trayectoria_Laboral = $this->getOrgullo_Trayectoria_Laboral();
		$No_Te_Gusto_Empleos_Anteriores = $this->getNo_Te_Gusto_Empleos_Anteriores();
		$Estas_Otros_Procesos = $this->getEstas_Otros_Procesos();

        $stmt = $this->db->prepare("INSERT INTO Conociendo_Candidato
			(Candidato, 
			Interes_Puesto, Que_Esperas_Lograr, 
			Caracteristicas_Empleo, Objetivo_Laboral, 
			Que_Esperas_Empresa, Cualidades, 
			Trabajo_Equipo, Ultimos_Jefes, 
			Que_Esperas_Aportar, Jornada_Laboral, Motivacion,
			Que_Dirian_Jefes_Anteriores, Orgullo_Trayectoria_Laboral,
			No_Te_Gusto_Empleos_Anteriores, Estas_Otros_Procesos)
		VALUES (:Candidato, 
			:Interes_Puesto, :Que_Esperas_Lograr, 
			:Caracteristicas_Empleo, :Objetivo_Laboral, 
			:Que_Esperas_Empresa, :Cualidades, 
			:Trabajo_Equipo, :Ultimos_Jefes, 
			:Que_Esperas_Aportar, :Jornada_Laboral, :Motivacion, :Que_Dirian_Jefes_Anteriores,
			:Orgullo_Trayectoria_Laboral, :No_Te_Gusto_Empleos_Anteriores, :Estas_Otros_Procesos)");
        $stmt->bindParam(":Interes_Puesto", $Interes_Puesto, PDO::PARAM_STR);
        $stmt->bindParam(":Que_Esperas_Lograr", $Que_Esperas_Lograr, PDO::PARAM_STR);
		$stmt->bindParam(":Caracteristicas_Empleo", $Caracteristicas_Empleo, PDO::PARAM_STR);
        $stmt->bindParam(":Objetivo_Laboral", $Objetivo_Laboral, PDO::PARAM_STR);
		$stmt->bindParam(":Que_Esperas_Empresa", $Que_Esperas_Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":Cualidades", $Cualidades, PDO::PARAM_STR);
		$stmt->bindParam(":Trabajo_Equipo", $Trabajo_Equipo, PDO::PARAM_STR);
        $stmt->bindParam(":Ultimos_Jefes", $Ultimos_Jefes, PDO::PARAM_STR);
		$stmt->bindParam(":Que_Esperas_Aportar", $Que_Esperas_Aportar, PDO::PARAM_STR);
        $stmt->bindParam(":Jornada_Laboral", $Jornada_Laboral, PDO::PARAM_STR);
		$stmt->bindParam(":Motivacion", $Motivacion, PDO::PARAM_STR);
        $stmt->bindParam(":Que_Dirian_Jefes_Anteriores", $Que_Dirian_Jefes_Anteriores, PDO::PARAM_STR);
		$stmt->bindParam(":Orgullo_Trayectoria_Laboral", $Orgullo_Trayectoria_Laboral, PDO::PARAM_STR);
        $stmt->bindParam(":No_Te_Gusto_Empleos_Anteriores", $No_Te_Gusto_Empleos_Anteriores, PDO::PARAM_STR);
		$stmt->bindParam(":Estas_Otros_Procesos", $Estas_Otros_Procesos, PDO::PARAM_STR);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function update(){
        $result = false;

        $Candidato = $this->getCandidato();
        $Interes_Puesto = $this->getInteres_Puesto();
        $Que_Esperas_Lograr = $this->getQue_Esperas_Lograr();
        $Caracteristicas_Empleo = $this->getCaracteristicas_Empleo();
		$Objetivo_Laboral = $this->getObjetivo_Laboral();
		$Que_Esperas_Empresa = $this->getQue_Esperas_Empresa();
		$Cualidades = $this->getCualidades();
		$Trabajo_Equipo = $this->getTrabajo_Equipo();
		$Ultimos_Jefes = $this->getUltimos_Jefes();
		$Que_Esperas_Aportar = $this->getQue_Esperas_Aportar();
		$Jornada_Laboral = $this->getJornada_Laboral();
		$Motivacion = $this->getMotivacion();
		$Que_Dirian_Jefes_Anteriores = $this->getQue_Dirian_Jefes_Anteriores();
		$Orgullo_Trayectoria_Laboral = $this->getOrgullo_Trayectoria_Laboral();
		$No_Te_Gusto_Empleos_Anteriores = $this->getNo_Te_Gusto_Empleos_Anteriores();
		$Estas_Otros_Procesos = $this->getEstas_Otros_Procesos();

        $stmt = $this->db->prepare("UPDATE Conociendo_Candidato
		SET Interes_Puesto=:Interes_Puesto
			,Que_Esperas_Lograr=:Que_Esperas_Lograr
			,Caracteristicas_Empleo=:Caracteristicas_Empleo
			,Objetivo_Laboral=:Objetivo_Laboral
			,Que_Esperas_Empresa=:Que_Esperas_Empresa
			,Cualidades=:Cualidades
			,Trabajo_Equipo=:Trabajo_Equipo
			,Ultimos_Jefes=:Ultimos_Jefes
			,Que_Esperas_Aportar=:Que_Esperas_Aportar
			,Jornada_Laboral=:Jornada_Laboral
			,Motivacion=:Motivacion
			,Que_Dirian_Jefes_Anteriores=:Que_Dirian_Jefes_Anteriores
			,Orgullo_Trayectoria_Laboral=:Orgullo_Trayectoria_Laboral
            ,No_Te_Gusto_Empleos_Anteriores=:No_Te_Gusto_Empleos_Anteriores
			,Estas_Otros_Procesos=:Estas_Otros_Procesos
		WHERE Candidato=:Candidato");
        $stmt->bindParam(":Interes_Puesto", $Interes_Puesto, PDO::PARAM_STR);
        $stmt->bindParam(":Que_Esperas_Lograr", $Que_Esperas_Lograr, PDO::PARAM_STR);
		$stmt->bindParam(":Caracteristicas_Empleo", $Caracteristicas_Empleo, PDO::PARAM_STR);
        $stmt->bindParam(":Objetivo_Laboral", $Objetivo_Laboral, PDO::PARAM_STR);
		$stmt->bindParam(":Que_Esperas_Empresa", $Que_Esperas_Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":Cualidades", $Cualidades, PDO::PARAM_STR);
		$stmt->bindParam(":Trabajo_Equipo", $Trabajo_Equipo, PDO::PARAM_STR);
        $stmt->bindParam(":Ultimos_Jefes", $Ultimos_Jefes, PDO::PARAM_STR);
		$stmt->bindParam(":Que_Esperas_Aportar", $Que_Esperas_Aportar, PDO::PARAM_STR);
        $stmt->bindParam(":Jornada_Laboral", $Jornada_Laboral, PDO::PARAM_STR);
		$stmt->bindParam(":Motivacion", $Motivacion, PDO::PARAM_STR);
        $stmt->bindParam(":Que_Dirian_Jefes_Anteriores", $Que_Dirian_Jefes_Anteriores, PDO::PARAM_STR);
		$stmt->bindParam(":Orgullo_Trayectoria_Laboral", $Orgullo_Trayectoria_Laboral, PDO::PARAM_STR);
        $stmt->bindParam(":No_Te_Gusto_Empleos_Anteriores", $No_Te_Gusto_Empleos_Anteriores, PDO::PARAM_STR);
		$stmt->bindParam(":Estas_Otros_Procesos", $Estas_Otros_Procesos, PDO::PARAM_STR);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

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

        $stmt = $this->db->prepare("INSERT INTO Conociendo_Candidato
			(Candidato, 
			Interes_Puesto, Que_Esperas_Lograr, 
			Caracteristicas_Empleo, Objetivo_Laboral, 
			Que_Esperas_Empresa, Cualidades, 
			Trabajo_Equipo, Ultimos_Jefes, 
			Que_Esperas_Aportar, Jornada_Laboral, Motivacion,
			Que_Dirian_Jefes_Anteriores, Orgullo_Trayectoria_Laboral,
			No_Te_Gusto_Empleos_Anteriores, Estas_Otros_Procesos)
		SELECT :Candidato, 
			Interes_Puesto, Que_Esperas_Lograr, 
			Caracteristicas_Empleo, Objetivo_Laboral, 
			Que_Esperas_Empresa, Cualidades, 
			Trabajo_Equipo, Ultimos_Jefes, 
			Que_Esperas_Aportar, Jornada_Laboral, Motivacion, Que_Dirian_Jefes_Anteriores,
			Orgullo_Trayectoria_Laboral, No_Te_Gusto_Empleos_Anteriores, Estas_Otros_Procesos
		FROM Conociendo_Candidato
		WHERE Candidato=:Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}

