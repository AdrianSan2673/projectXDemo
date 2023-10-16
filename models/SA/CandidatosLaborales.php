<?php 

class CandidatosLaborales{
    private $Candidato;
    private $Renglon;
    private $Empresa;
    private $Giro;
    private $Domicilio;
    private $Telefono;
    private $Fecha_Ingreso;
    private $Fecha_Baja;
    private $Puesto_Inicial;
    private $Puesto_Final;
    private $Jefe;
    private $Puesto_Jefe;
    private $Motivo_Separacion;
    private $Comentarios;
    private $Recontratable;
    private $Recontratable_PorQue;
    private $Informante;
	private $Calif;
	private $Dopaje;
	
	//Transportistas
	/* private $Finiquitado_Liquidado;
	private $Recomienda_Contratacion; */
	private $Sindicalizado;
	private $Sindicato;
	private $Comite_Sindical;
	private $Puesto_Sindical;
	private $Funciones_Sindicato;
	private $Tiempo_Sindicato;
  
	
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

	public function getEmpresa(){
		return $this->Empresa;
	}

	public function setEmpresa($Empresa){
		$this->Empresa = $Empresa;
	}

	public function getGiro(){
		return $this->Giro;
	}

	public function setGiro($Giro){
		$this->Giro = $Giro;
	}

	public function getDomicilio(){
		return $this->Domicilio;
	}

	public function setDomicilio($Domicilio){
		$this->Domicilio = $Domicilio;
	}

	public function getTelefono(){
		return $this->Telefono;
	}

	public function setTelefono($Telefono){
		$this->Telefono = $Telefono;
	}

	public function getFecha_Ingreso(){
		return $this->Fecha_Ingreso;
	}

	public function setFecha_Ingreso($Fecha_Ingreso){
		$this->Fecha_Ingreso = $Fecha_Ingreso;
	}

	public function getFecha_Baja(){
		return $this->Fecha_Baja;
	}

	public function setFecha_Baja($Fecha_Baja){
		$this->Fecha_Baja = $Fecha_Baja;
	}

	public function getPuesto_Inicial(){
		return $this->Puesto_Inicial;
	}

	public function setPuesto_Inicial($Puesto_Inicial){
		$this->Puesto_Inicial = $Puesto_Inicial;
	}

	public function getPuesto_Final(){
		return $this->Puesto_Final;
	}

	public function setPuesto_Final($Puesto_Final){
		$this->Puesto_Final = $Puesto_Final;
	}

	public function getJefe(){
		return $this->Jefe;
	}

	public function setJefe($Jefe){
		$this->Jefe = $Jefe;
	}

	public function getPuesto_Jefe(){
		return $this->Puesto_Jefe;
	}

	public function setPuesto_Jefe($Puesto_Jefe){
		$this->Puesto_Jefe = $Puesto_Jefe;
	}

	public function getMotivo_Separacion(){
		return $this->Motivo_Separacion;
	}

	public function setMotivo_Separacion($Motivo_Separacion){
		$this->Motivo_Separacion = $Motivo_Separacion;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios = $Comentarios;
	}

	public function getRecontratable(){
		return $this->Recontratable;
	}

	public function setRecontratable($Recontratable){
		$this->Recontratable = $Recontratable;
	}

	public function getRecontratable_PorQue(){
		return $this->Recontratable_PorQue;
	}

	public function setRecontratable_PorQue($Recontratable_PorQue){
		$this->Recontratable_PorQue = $Recontratable_PorQue;
	}

	public function getInformante(){
		return $this->Informante;
	}

	public function setInformante($Informante){
		$this->Informante = $Informante;
	}

	public function getCalif(){
		return $this->Calif;
	}

	public function setCalif($Calif){
		$this->Calif = $Calif;
	}

	public function getDopaje(){
		return $this->Dopaje;
	}

	public function setDopaje($Dopaje){
		$this->Dopaje = $Dopaje;
	}

	/* public function getFiniquitado_Liquidado(){
		return $this->Finiquitado_Liquidado;
	}

	public function setFiniquitado_Liquidado($Finiquitado_Liquidado){
		$this->Finiquitado_Liquidado = $Finiquitado_Liquidado;
	}

	public function getFRecomienda_Contratacion(){
		return $this->Recomienda_Contratacion;
	}

	public function setFRecomienda_Contratacion($Recomienda_Contratacion){
		$this->Recomienda_Contratacion = $Recomienda_Contratacion;
	} */

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

    public function getLaboralesPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT *, l.Renglon FROM rh_Candidatos_Laborales l LEFT JOIN rh_Candidatos_Laborales_Conceptos lc ON l.Candidato=lc.Candidato AND l.Renglon=lc.Renglon WHERE l.Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
	
	public function getAll(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Laborales WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
	
	public function getOne(){
        $Candidato=$this->getCandidato();
        $Renglon=$this->getRenglon();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Laborales l LEFT JOIN rh_Candidatos_Laborales_Conceptos lc ON l.Candidato=lc.Candidato AND l.Renglon=lc.Renglon WHERE l.Candidato=:Candidato AND l.Renglon=:Renglon"
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
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Laborales WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Renglon;
    }

    public function create(){
		$result = false;

		$Renglon = $this->getRenglonMax() + 1;
		$Candidato = $this->getCandidato();
        $Empresa = $this->getEmpresa();
        $Giro = $this->getGiro();
		$Domicilio = $this->getDomicilio();
		$Telefono = $this->getTelefono();
		$Fecha_Ingreso = $this->getFecha_Ingreso();
		$Fecha_Baja = $this->getFecha_Baja();
		$Puesto_Inicial = $this->getPuesto_Inicial();
		$Puesto_Final = $this->getPuesto_Final();
        $Jefe = $this->getJefe();
        $Puesto_Jefe = $this->getPuesto_Jefe();
        $Motivo_Separacion = $this->getMotivo_Separacion();
        $Recontratable = $this->getRecontratable();
        $Recontratable_PorQue = $this->getRecontratable_PorQue();
        $Informante = $this->getInformante();
        $Comentarios = $this->getComentarios();
        $Calif = $this->getCalif();
		$Dopaje = $this->getDopaje();
		$Sindicalizado = $this->getSindicalizado();
		$Sindicato = $this->getSindicato();
		$Comite_Sindical = $this->getComite_Sindical();
		$Puesto_Sindical = $this->getPuesto_Sindical();
		$Funciones_Sindicato = $this->getFunciones_Sindicato();
		$Tiempo_Sindicato = $this->getTiempo_Sindicato();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Laborales (Candidato, Renglon, Empresa, Giro, Domicilio, Telefono, Fecha_Ingreso, Fecha_Baja, Puesto_Inicial, Puesto_Final, Jefe, Puesto_Jefe, Motivo_Separacion, Comentarios, Recontratable, Recontratable_PorQue, Informante, Calif, Dopaje, Sindicalizado, Sindicato, Comite_Sindical, Puesto_Sindical, Funciones_Sindicato, Tiempo_Sindicato)
		VALUES (:Candidato, :Renglon, :Empresa, :Giro, :Domicilio, :Telefono, :Fecha_Ingreso, :Fecha_Baja, :Puesto_Inicial, :Puesto_Final, :Jefe, :Puesto_Jefe, :Motivo_Separacion, :Comentarios, :Recontratable, :Recontratable_PorQue, :Informante,:Calif, :Dopaje, :Sindicalizado, :Sindicato, :Comite_Sindical, :Puesto_Sindical, :Funciones_Sindicato, :Tiempo_Sindicato)");
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":Giro", $Giro, PDO::PARAM_STR);
		$stmt->bindParam(":Domicilio", $Domicilio, PDO::PARAM_STR);
		$stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Ingreso", $Fecha_Ingreso, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Baja", $Fecha_Baja, PDO::PARAM_STR);
		$stmt->bindParam(":Puesto_Inicial", $Puesto_Inicial, PDO::PARAM_STR);
		$stmt->bindParam(":Puesto_Final", $Puesto_Final, PDO::PARAM_STR);
		$stmt->bindParam(":Jefe", $Jefe, PDO::PARAM_STR);
		$stmt->bindParam(":Puesto_Jefe", $Puesto_Jefe, PDO::PARAM_STR);
		$stmt->bindParam(":Motivo_Separacion", $Motivo_Separacion, PDO::PARAM_STR);
		$stmt->bindParam(":Recontratable", $Recontratable, PDO::PARAM_INT);
		$stmt->bindParam(":Recontratable_PorQue", $Recontratable_PorQue, PDO::PARAM_STR);
		$stmt->bindParam(":Informante", $Informante, PDO::PARAM_STR);
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
		$stmt->bindParam(":Calif", $Calif, PDO::PARAM_INT);
		$stmt->bindParam(":Dopaje", $Dopaje, PDO::PARAM_INT);
		$stmt->bindParam(":Sindicalizado", $Sindicalizado, PDO::PARAM_INT);
		$stmt->bindParam(":Sindicato", $Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Comite_Sindical", $Comite_Sindical, PDO::PARAM_INT);
		$stmt->bindParam(":Puesto_Sindical", $Puesto_Sindical, PDO::PARAM_STR);
		$stmt->bindParam(":Funciones_Sindicato", $Funciones_Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Sindicato", $Tiempo_Sindicato, PDO::PARAM_STR);
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
        $Empresa = $this->getEmpresa();
        $Giro = $this->getGiro();
		$Domicilio = $this->getDomicilio();
		$Telefono = $this->getTelefono();
		$Fecha_Ingreso = $this->getFecha_Ingreso();
		$Fecha_Baja = $this->getFecha_Baja();
		$Puesto_Inicial = $this->getPuesto_Inicial();
		$Puesto_Final = $this->getPuesto_Final();
        $Jefe = $this->getJefe();
        $Puesto_Jefe = $this->getPuesto_Jefe();
        $Motivo_Separacion = $this->getMotivo_Separacion();
        $Recontratable = $this->getRecontratable();
        $Recontratable_PorQue = $this->getRecontratable_PorQue();
        $Informante = $this->getInformante();
        $Comentarios = $this->getComentarios();
        $Calif = $this->getCalif();
		$Dopaje = $this->getDopaje();
		$Sindicalizado = $this->getSindicalizado();
		$Sindicato = $this->getSindicato();
		$Comite_Sindical = $this->getComite_Sindical();
		$Puesto_Sindical = $this->getPuesto_Sindical();
		$Funciones_Sindicato = $this->getFunciones_Sindicato();
		$Tiempo_Sindicato = $this->getTiempo_Sindicato();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Laborales
		SET Empresa = :Empresa, 
			Giro = :Giro, 
			Domicilio = :Domicilio, 
			Telefono = :Telefono, 
			Fecha_Ingreso = :Fecha_Ingreso, 
			Fecha_Baja = :Fecha_Baja, 
			Puesto_Inicial = :Puesto_Inicial, 
			Puesto_Final = :Puesto_Final, 
			Jefe = :Jefe, 
			Puesto_Jefe = :Puesto_Jefe, 
			Motivo_Separacion = :Motivo_Separacion, 
			Comentarios = :Comentarios, 
			Recontratable = :Recontratable, 
			Recontratable_PorQue = :Recontratable_PorQue, 
			Informante = :Informante,
			Calif = :Calif,
			Dopaje = :Dopaje,
			Sindicalizado = :Sindicalizado,
			Sindicato = :Sindicato,
			Comite_Sindical = :Comite_Sindical,
			Puesto_Sindical = :Puesto_Sindical,
			Funciones_Sindicato = :Funciones_Sindicato,
			Tiempo_Sindicato = :Tiempo_Sindicato
		WHERE Candidato = :Candidato
		AND Renglon = :Renglon");
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":Giro", $Giro, PDO::PARAM_STR);
		$stmt->bindParam(":Domicilio", $Domicilio, PDO::PARAM_STR);
		$stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Ingreso", $Fecha_Ingreso, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Baja", $Fecha_Baja, PDO::PARAM_STR);
		$stmt->bindParam(":Puesto_Inicial", $Puesto_Inicial, PDO::PARAM_STR);
		$stmt->bindParam(":Puesto_Final", $Puesto_Final, PDO::PARAM_STR);
		$stmt->bindParam(":Jefe", $Jefe, PDO::PARAM_STR);
		$stmt->bindParam(":Puesto_Jefe", $Puesto_Jefe, PDO::PARAM_STR);
		$stmt->bindParam(":Motivo_Separacion", $Motivo_Separacion, PDO::PARAM_STR);
		$stmt->bindParam(":Recontratable", $Recontratable, PDO::PARAM_STR);
		$stmt->bindParam(":Recontratable_PorQue", $Recontratable_PorQue, PDO::PARAM_STR);
		$stmt->bindParam(":Informante", $Informante, PDO::PARAM_STR);
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
		$stmt->bindParam(":Calif", $Calif, PDO::PARAM_INT);
		$stmt->bindParam(":Dopaje", $Dopaje, PDO::PARAM_INT);
		$stmt->bindParam(":Sindicalizado", $Sindicalizado, PDO::PARAM_INT);
		$stmt->bindParam(":Sindicato", $Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Comite_Sindical", $Comite_Sindical, PDO::PARAM_INT);
		$stmt->bindParam(":Puesto_Sindical", $Puesto_Sindical, PDO::PARAM_STR);
		$stmt->bindParam(":Funciones_Sindicato", $Funciones_Sindicato, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Sindicato", $Tiempo_Sindicato, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Laborales WHERE Candidato=:Candidato AND Renglon=:Renglon");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	
	public function updateRenglon($RenglonCambio){
		$result = false;

		$Candidato = $this->getCandidato();
		$Renglon = $this->getRenglon();
		
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Laborales SET Renglon=:RenglonCambio  WHERE Candidato=:Candidato AND Renglon=:Renglon");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);
		$stmt->bindParam(":RenglonCambio", $RenglonCambio, PDO::PARAM_INT);

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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Laborales (Candidato, Renglon, Empresa, Giro, Domicilio, Telefono, Fecha_Ingreso, Fecha_Baja, Puesto_Inicial, Puesto_Final, Jefe, Puesto_Jefe, Motivo_Separacion, Comentarios, Recontratable, Recontratable_PorQue, Informante, Calif, Dopaje, Sindicalizado, Sindicato, Comite_Sindical, Puesto_Sindical, Funciones_Sindicato, Tiempo_Sindicato)
		SELECT :Candidato, Renglon, Empresa, Giro, Domicilio, Telefono, Fecha_Ingreso, Fecha_Baja, Puesto_Inicial, Puesto_Final, Jefe, Puesto_Jefe, Motivo_Separacion, Comentarios, Recontratable, Recontratable_PorQue, Informante,Calif, Dopaje, Sindicalizado, Sindicato, Comite_Sindical, Puesto_Sindical, Funciones_Sindicato, Tiempo_Sindicato FROM rh_Candidatos_Laborales WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
		}
        return $result;
    }
}