<?php 

class Investigacion_Laboral{

    private $Candidato;
	private $Circunstancias_Laborales;
    private $Proporciono_Datos_Empleos;
    private $Motivo_No_Proporciono_Datos;
    private $Demanda_Laboral;
    private $Motivo_Demanda;
    private $No_Empleos;
    private $Tiempo_Promedio_Empleos;

	private $Sindicalizado;
	private $Sindicato;
	private $Comite_Sindical;
	private $Puesto_Sindical;
	private $Funciones_Sindicato;
	private $Tiempo_Sindicato;
	private $Trabajo_Ternium;
	private $Alta_Ternium;
	private $Veto_Ternium;

	private $Positivo_Antidoping;
	private $Sustancia_Antidoping;
	private $Accidentes_Empresa;
	private $Abandono_Unidad;

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

	public function getCircunstancias_Laborales(){
		return $this->Circunstancias_Laborales;
	}

	public function setCircunstancias_Laborales($Circunstancias_Laborales){
		$this->Circunstancias_Laborales = $Circunstancias_Laborales;
	}

	public function getProporciono_Datos_Empleos(){
		return $this->Proporciono_Datos_Empleos;
	}

	public function setProporciono_Datos_Empleos($Proporciono_Datos_Empleos){
		$this->Proporciono_Datos_Empleos = $Proporciono_Datos_Empleos;
	}

	public function getMotivo_No_Proporciono_Datos(){
		return $this->Motivo_No_Proporciono_Datos;
	}

	public function setMotivo_No_Proporciono_Datos($Motivo_No_Proporciono_Datos){
		$this->Motivo_No_Proporciono_Datos = $Motivo_No_Proporciono_Datos;
	}

	public function getDemanda_Laboral(){
		return $this->Demanda_Laboral;
	}

	public function setDemanda_Laboral($Demanda_Laboral){
		$this->Demanda_Laboral = $Demanda_Laboral;
	}

	public function getMotivo_Demanda(){
		return $this->Motivo_Demanda;
	}

	public function setMotivo_Demanda($Motivo_Demanda){
		$this->Motivo_Demanda = $Motivo_Demanda;
	}

	public function getNo_Empleos(){
		return $this->No_Empleos;
	}

	public function setNo_Empleos($No_Empleos){
		$this->No_Empleos = $No_Empleos;
	}

	public function getTiempo_Promedio_Empleos(){
		return $this->Tiempo_Promedio_Empleos;
	}

	public function setTiempo_Promedio_Empleos($Tiempo_Promedio_Empleos){
		$this->Tiempo_Promedio_Empleos = $Tiempo_Promedio_Empleos;
	}

	public function getSindicalizado(){
		return $this->Sindicalizado;
	}

	public function setSindicalizado($Sindicalizado){
		$this->Sindicalizado = $Sindicalizado;
	}

	public function getSindicato(){
		return $this->Sindicato;
	}

	public function setSindicato($Sindicato){
		$this->Sindicato = $Sindicato;
	}

	public function getComite_Sindical(){
		return $this->Comite_Sindical;
	}

	public function setComite_Sindical($Comite_Sindical){
		$this->Comite_Sindical = $Comite_Sindical;
	}

	public function getPuesto_Sindical(){
		return $this->Puesto_Sindical;
	}

	public function setPuesto_Sindical($Puesto_Sindical){
		$this->Puesto_Sindical = $Puesto_Sindical;
	}

	public function getFunciones_Sindicato(){
		return $this->Funciones_Sindicato;
	}

	public function setFunciones_Sindicato($Funciones_Sindicato){
		$this->Funciones_Sindicato = $Funciones_Sindicato;
	}

	public function getTiempo_Sindicato(){
		return $this->Tiempo_Sindicato;
	}

	public function setTiempo_Sindicato($Tiempo_Sindicato){
		$this->Tiempo_Sindicato = $Tiempo_Sindicato;
	}

	public function getTrabajo_Ternium(){
		return $this->Trabajo_Ternium;
	}

	public function setTrabajo_Ternium($Trabajo_Ternium){
		$this->Trabajo_Ternium = $Trabajo_Ternium;
	}

	public function getAlta_Ternium(){
		return $this->Alta_Ternium;
	}

	public function setAlta_Ternium($Alta_Ternium){
		$this->Alta_Ternium = $Alta_Ternium;
	}

	public function getVeto_Ternium(){
		return $this->Veto_Ternium;
	}

	public function setVeto_Ternium($Veto_Ternium){
		$this->Veto_Ternium = $Veto_Ternium;
	}

	public function getPositivo_Antidoping(){
		return $this->Positivo_Antidoping;
	}

	public function setPositivo_Antidoping($Positivo_Antidoping){
		$this->Positivo_Antidoping = $Positivo_Antidoping;
	}

	public function getSustancia_Antidoping(){
		return $this->Sustancia_Antidoping;
	}

	public function setSustancia_Antidoping($Sustancia_Antidoping){
		$this->Sustancia_Antidoping = $Sustancia_Antidoping;
	}

	public function getAccidentes_Empresa(){
		return $this->Accidentes_Empresa;
	}

	public function setAccidentes_Empresa($Accidentes_Empresa){
		$this->Accidentes_Empresa = $Accidentes_Empresa;
	}

	public function getAbandono_Unidad(){
		return $this->Abandono_Unidad;
	}

	public function setAbandono_Unidad($Abandono_Unidad){
		$this->Abandono_Unidad = $Abandono_Unidad;
	}

    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM Investigacion_Laboral WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Proporciono_Datos_Empleos = $this->getProporciono_Datos_Empleos();
        $Motivo_No_Proporciono_Datos = $this->getMotivo_No_Proporciono_Datos();
        $Demanda_Laboral = $this->getDemanda_Laboral();
		$Motivo_Demanda = $this->getMotivo_Demanda();
		$No_Empleos = $this->getNo_Empleos();
		$Circunstancias_Laborales = $this->getCircunstancias_Laborales();
		$Tiempo_Promedio_Empleos = $this->getTiempo_Promedio_Empleos();

		$Sindicalizado = $this->getSindicalizado();
		$Sindicato = $this->getSindicato();
		$Comite_Sindical = $this->getComite_Sindical();
		$Puesto_Sindical = $this->getPuesto_Sindical();
		$Funciones_Sindicato = $this->getFunciones_Sindicato();
		$Tiempo_Sindicato = $this->getTiempo_Sindicato();
		$Trabajo_Ternium = $this->getTrabajo_Ternium();
		$Alta_Ternium = $this->getAlta_Ternium();
		$Veto_Ternium = $this->getVeto_Ternium();

		$Positivo_Antidoping = $this->getPositivo_Antidoping();
		$Sustancia_Antidoping = $this->getSustancia_Antidoping();
		$Accidentes_Empresa = $this->getAccidentes_Empresa();
		$Abandono_Unidad = $this->getAbandono_Unidad();
		
        $stmt = $this->db->prepare("INSERT INTO Investigacion_Laboral(Candidato, 
		Proporciono_Datos_Empleos, Motivo_No_Proporciono_Datos, 
		Demanda_Laboral, Motivo_Demanda, 
		No_Empleos, 
		Circunstancias_Laborales, Tiempo_Promedio_Empleos, Sindicalizado, Sindicato,
		Comite_Sindical, Puesto_Sindical, Funciones_Sindicato, Tiempo_Sindicato, Trabajo_Ternium,Alta_Ternium,Veto_Ternium, Positivo_Antidoping, Sustancia_Antidoping, Accidentes_Empresa, Abandono_Unidad)
		VALUES (:Candidato, 
		:Proporciono_Datos_Empleos, :Motivo_No_Proporciono_Datos, 
		:Demanda_Laboral, :Motivo_Demanda, 
		:No_Empleos,  
		:Circunstancias_Laborales, :Tiempo_Promedio_Empleos, :Sindicalizado, :Sindicato,
		:Comite_Sindical, :Puesto_Sindical, :Funciones_Sindicato, :Tiempo_Sindicato, :Trabajo_Ternium,:Alta_Ternium,:Veto_Ternium, :Positivo_Antidoping, :Sustancia_Antidoping, :Accidentes_Empresa, :Abandono_Unidad)");
        $stmt->bindParam(":Proporciono_Datos_Empleos", $Proporciono_Datos_Empleos, PDO::PARAM_STR);
        $stmt->bindParam(":Motivo_No_Proporciono_Datos", $Motivo_No_Proporciono_Datos, PDO::PARAM_STR);
		$stmt->bindParam(":Demanda_Laboral", $Demanda_Laboral, PDO::PARAM_STR);
        $stmt->bindParam(":Motivo_Demanda", $Motivo_Demanda, PDO::PARAM_STR);
		$stmt->bindParam(":No_Empleos", $No_Empleos, PDO::PARAM_STR);
        $stmt->bindParam(":Circunstancias_Laborales", $Circunstancias_Laborales, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Promedio_Empleos", $Tiempo_Promedio_Empleos, PDO::PARAM_STR);
		$stmt->bindParam(":Sindicalizado", $Sindicalizado, PDO::PARAM_INT);
		$stmt->bindParam(":Sindicato", $Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Comite_Sindical", $Comite_Sindical, PDO::PARAM_INT);
		$stmt->bindParam(":Puesto_Sindical", $Puesto_Sindical, PDO::PARAM_STR);
		$stmt->bindParam(":Funciones_Sindicato", $Funciones_Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Sindicato", $Tiempo_Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Trabajo_Ternium", $Trabajo_Ternium, PDO::PARAM_STR);
		$stmt->bindParam(":Alta_Ternium", $Alta_Ternium, PDO::PARAM_STR);
		$stmt->bindParam(":Veto_Ternium", $Veto_Ternium, PDO::PARAM_STR);
		$stmt->bindParam(":Positivo_Antidoping", $Positivo_Antidoping, PDO::PARAM_INT);
		$stmt->bindParam(":Sustancia_Antidoping", $Sustancia_Antidoping, PDO::PARAM_STR);
		$stmt->bindParam(":Accidentes_Empresa", $Accidentes_Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":Abandono_Unidad", $Abandono_Unidad, PDO::PARAM_INT);
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
        $Proporciono_Datos_Empleos = $this->getProporciono_Datos_Empleos();
        $Motivo_No_Proporciono_Datos = $this->getMotivo_No_Proporciono_Datos();
        $Demanda_Laboral = $this->getDemanda_Laboral();
		$Motivo_Demanda = $this->getMotivo_Demanda();
		$No_Empleos = $this->getNo_Empleos();
		$Tiempo_Promedio_Empleos = "";
		$Circunstancias_Laborales = $this->getCircunstancias_Laborales();
		$Alta_Ternium = $this->getAlta_Ternium();
		$Veto_Ternium = $this->getVeto_Ternium();

		$Sindicalizado = $this->getSindicalizado();
		$Sindicato = $this->getSindicato();
		$Comite_Sindical = $this->getComite_Sindical();
		$Puesto_Sindical = $this->getPuesto_Sindical();
		$Funciones_Sindicato = $this->getFunciones_Sindicato();
		$Tiempo_Sindicato = $this->getTiempo_Sindicato();
		$Trabajo_Ternium = $this->getTrabajo_Ternium();

		$Positivo_Antidoping = $this->getPositivo_Antidoping();
		$Sustancia_Antidoping = $this->getSustancia_Antidoping();
		$Accidentes_Empresa = $this->getAccidentes_Empresa();
		$Abandono_Unidad = $this->getAbandono_Unidad();

        $stmt = $this->db->prepare("UPDATE Investigacion_Laboral
		SET Proporciono_Datos_Empleos=:Proporciono_Datos_Empleos
			,Motivo_No_Proporciono_Datos=:Motivo_No_Proporciono_Datos
			,Demanda_Laboral=:Demanda_Laboral
			,Motivo_Demanda=:Motivo_Demanda
			,No_Empleos=:No_Empleos
			,Tiempo_Promedio_Empleos=:Tiempo_Promedio_Empleos
			,Circunstancias_Laborales=:Circunstancias_Laborales
			,Sindicalizado = :Sindicalizado,
			Sindicato = :Sindicato,
			Comite_Sindical = :Comite_Sindical,
			Puesto_Sindical = :Puesto_Sindical,
			Funciones_Sindicato = :Funciones_Sindicato,
			Tiempo_Sindicato = :Tiempo_Sindicato,
			Trabajo_Ternium = :Trabajo_Ternium,
			Alta_Ternium = :Alta_Ternium,
			Veto_Ternium = :Veto_Ternium,
			Positivo_Antidoping = :Positivo_Antidoping,
			Sustancia_Antidoping = :Sustancia_Antidoping,
			Accidentes_Empresa = :Accidentes_Empresa,
			Abandono_Unidad = :Abandono_Unidad
		WHERE Candidato=:Candidato");
        $stmt->bindParam(":Proporciono_Datos_Empleos", $Proporciono_Datos_Empleos, PDO::PARAM_STR);
        $stmt->bindParam(":Motivo_No_Proporciono_Datos", $Motivo_No_Proporciono_Datos, PDO::PARAM_STR);
		$stmt->bindParam(":Demanda_Laboral", $Demanda_Laboral, PDO::PARAM_STR);
        $stmt->bindParam(":Motivo_Demanda", $Motivo_Demanda, PDO::PARAM_STR);
		$stmt->bindParam(":No_Empleos", $No_Empleos, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Promedio_Empleos", $Tiempo_Promedio_Empleos, PDO::PARAM_STR);
        $stmt->bindParam(":Circunstancias_Laborales", $Circunstancias_Laborales, PDO::PARAM_STR);
		$stmt->bindParam(":Sindicalizado", $Sindicalizado, PDO::PARAM_INT);
		$stmt->bindParam(":Sindicato", $Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Comite_Sindical", $Comite_Sindical, PDO::PARAM_INT);
		$stmt->bindParam(":Puesto_Sindical", $Puesto_Sindical, PDO::PARAM_STR);
		$stmt->bindParam(":Funciones_Sindicato", $Funciones_Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Sindicato", $Tiempo_Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Trabajo_Ternium", $Trabajo_Ternium, PDO::PARAM_STR);
		$stmt->bindParam(":Alta_Ternium", $Alta_Ternium, PDO::PARAM_STR);
		$stmt->bindParam(":Veto_Ternium", $Veto_Ternium, PDO::PARAM_STR);
		$stmt->bindParam(":Positivo_Antidoping", $Positivo_Antidoping, PDO::PARAM_INT);
		$stmt->bindParam(":Sustancia_Antidoping", $Sustancia_Antidoping, PDO::PARAM_STR);
		$stmt->bindParam(":Accidentes_Empresa", $Accidentes_Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":Abandono_Unidad", $Abandono_Unidad, PDO::PARAM_INT);
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
		
        $stmt = $this->db->prepare("INSERT INTO Investigacion_Laboral(Candidato, 
		Proporciono_Datos_Empleos, Motivo_No_Proporciono_Datos, 
		Demanda_Laboral, Motivo_Demanda, 
		No_Empleos, 
		Circunstancias_Laborales, Tiempo_Promedio_Empleos, Sindicalizado, Sindicato,
		Comite_Sindical, Puesto_Sindical, Funciones_Sindicato, Tiempo_Sindicato, Trabajo_Ternium)
		SELECT :Candidato, 
		Proporciono_Datos_Empleos, Motivo_No_Proporciono_Datos, 
		Demanda_Laboral, Motivo_Demanda, 
		No_Empleos,  
		Circunstancias_Laborales, Tiempo_Promedio_Empleos, Sindicalizado, Sindicato,
		Comite_Sindical, Puesto_Sindical, Funciones_Sindicato, Tiempo_Sindicato, Trabajo_Ternium FROM Investigacion_Laboral WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}