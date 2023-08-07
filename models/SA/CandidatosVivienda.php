<?php

class CandidatosVivienda{
    private $Candidato;
    private $Tipo_Vivienda;
    private $Plantas;
    private $Recamaras;
    private $Sanitarios;
    private $Capacidad_Cochera;
    private $Domicilio_es;
    private $Propietario;
    private $Terreno;
    private $Construccion;
    private $Valor;
    private $Tiempo_Viviendo;
    private $Foto;
    private $Conoce_Valor;
    private $Conoce_Mts;
    private $Conoce_Mts_C;
    private $TerrenoMts;
    private $ConstruccionMts;
    private $Parentesco;
    private $Telefono_Parentesco;
    private $Contrato_Arrendamiento;
    private $Tiempo_Contrato;

    
    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getTipo_Vivienda(){
		return $this->Tipo_Vivienda;
	}

	public function setTipo_Vivienda($Tipo_Vivienda){
		$this->Tipo_Vivienda = $Tipo_Vivienda;
	}

	public function getPlantas(){
		return $this->Plantas;
	}

	public function setPlantas($Plantas){
		$this->Plantas = $Plantas;
	}

	public function getRecamaras(){
		return $this->Recamaras;
	}

	public function setRecamaras($Recamaras){
		$this->Recamaras = $Recamaras;
	}

	public function getSanitarios(){
		return $this->Sanitarios;
	}

	public function setSanitarios($Sanitarios){
		$this->Sanitarios = $Sanitarios;
	}

	public function getCapacidad_Cochera(){
		return $this->Capacidad_Cochera;
	}

	public function setCapacidad_Cochera($Capacidad_Cochera){
		$this->Capacidad_Cochera = $Capacidad_Cochera;
	}

	public function getDomicilio_es(){
		return $this->Domicilio_es;
	}

	public function setDomicilio_es($Domicilio_es){
		$this->Domicilio_es = $Domicilio_es;
	}

	public function getPropietario(){
		return $this->Propietario;
	}

	public function setPropietario($Propietario){
		$this->Propietario = $Propietario;
	}

	public function getTerreno(){
		return $this->Terreno;
	}

	public function setTerreno($Terreno){
		$this->Terreno = $Terreno;
	}

	public function getConstruccion(){
		return $this->Construccion;
	}

	public function setConstruccion($Construccion){
		$this->Construccion = $Construccion;
	}

	public function getValor(){
		return $this->Valor;
	}

	public function setValor($Valor){
		$this->Valor = $Valor;
	}

	public function getTiempo_Viviendo(){
		return $this->Tiempo_Viviendo;
	}

	public function setTiempo_Viviendo($Tiempo_Viviendo){
		$this->Tiempo_Viviendo = $Tiempo_Viviendo;
	}

	public function getFoto(){
		return $this->Foto;
	}

	public function setFoto($Foto){
		$this->Foto = $Foto;
	}

	public function getConoce_Valor(){
		return $this->Conoce_Valor;
	}

	public function setConoce_Valor($Conoce_Valor){
		$this->Conoce_Valor = $Conoce_Valor;
	}

	public function getConoce_Mts(){
		return $this->Conoce_Mts;
	}

	public function setConoce_Mts($Conoce_Mts){
		$this->Conoce_Mts = $Conoce_Mts;
	}

	public function getConoce_Mts_C(){
		return $this->Conoce_Mts_C;
	}

	public function setConoce_Mts_C($Conoce_Mts_C){
		$this->Conoce_Mts_C = $Conoce_Mts_C;
	}

	public function getTerrenoMts(){
		return $this->TerrenoMts;
	}

	public function setTerrenoMts($TerrenoMts){
		$this->TerrenoMts = $TerrenoMts;
	}

	public function getConstruccionMts(){
		return $this->ConstruccionMts;
	}

	public function setConstruccionMts($ConstruccionMts){
		$this->ConstruccionMts = $ConstruccionMts;
	}

	public function getParentesco(){
		return $this->Parentesco;
	}

	public function setParentesco($Parentesco){
		$this->Parentesco = $Parentesco;
	}

	public function getTelefono_Parentesco(){
		return $this->Telefono_Parentesco;
	}

	public function setTelefono_Parentesco($Telefono_Parentesco){
		$this->Telefono_Parentesco = $Telefono_Parentesco;
	}

	public function getContrato_Arrendamiento(){
		return $this->Contrato_Arrendamiento;
	}

	public function setContrato_Arrendamiento($Contrato_Arrendamiento){
		$this->Contrato_Arrendamiento = $Contrato_Arrendamiento;
	}

	public function getTiempo_Contrato(){
		return $this->Tiempo_Contrato;
	}

	public function setTiempo_Contrato($Tiempo_Contrato){
		$this->Tiempo_Contrato = $Tiempo_Contrato;
	}

    
	public function getAll(){
		$Candidato=$this->getCandidato();
		$stmt = $this->db->prepare(
			"SELECT * FROM rh_Candidatos_Vivienda"
		);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->execute();
		$servicios = $stmt->fetchAll();
		return $servicios;
	}

	public function getOne(){
		$Candidato=$this->getCandidato();
		$stmt = $this->db->prepare(
			"SELECT * FROM rh_Candidatos_Vivienda WHERE Candidato=:Candidato"
		);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->execute();
		$fetch = $stmt->fetchObject();
		return $fetch;
	}

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Tipo_Vivienda = $this->getTipo_Vivienda();
		$Plantas = $this->getPlantas();
		$Recamaras = $this->getRecamaras();
		$Sanitarios = $this->getSanitarios();
		$Capacidad_Cochera = $this->getCapacidad_Cochera();
		$Domicilio_es = $this->getDomicilio_es();
		$Propietario = $this->getPropietario();
		$Terreno = $this->getTerreno();
		$Construccion = $this->getConstruccion();
		$Valor = $this->getValor();
		$Tiempo_Viviendo = $this->getTiempo_Viviendo();
		$Conoce_Valor = $this->getConoce_Valor();
		$Conoce_Mts = $this->getConoce_Mts();
		$Conoce_Mts_C = $this->getConoce_Mts_C();
		$TerrenoMts = $this->getTerrenoMts();
		$ConstruccionMts = $this->getConstruccionMts();
		$Parentesco = $this->getParentesco();
        $Telefono_Parentesco = $this->getTelefono_Parentesco();
		$Contrato_Arrendamiento = $this->getContrato_Arrendamiento();
		$Tiempo_Contrato = $this->getTiempo_Contrato();
        
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Vivienda(
			Candidato, Tipo_Vivienda, Plantas, Recamaras, Sanitarios, Capacidad_Cochera,
			Domicilio_es, Propietario, Terreno, Construccion, Valor, Conoce_Valor, Tiempo_Viviendo,Conoce_Mts,Conoce_Mts_C,TerrenoMts,ConstruccionMts, Parentesco, Telefono_Parentesco, Contrato_Arrendamiento, Tiempo_Contrato)
		VALUES (:Candidato,:Tipo_Vivienda,:Plantas,:Recamaras,:Sanitarios,:Capacidad_Cochera, :Domicilio_es,:Propietario,:Terreno,:Construccion,:Valor,:Conoce_Valor,:Tiempo_Viviendo,:Conoce_Mts,:Conoce_Mts_C,:TerrenoMts,:ConstruccionMts, :Parentesco, :Telefono_Parentesco, :Contrato_Arrendamiento, :Tiempo_Contrato)");
        $stmt->bindParam(":Tipo_Vivienda", $Tipo_Vivienda, PDO::PARAM_INT);
		$stmt->bindParam(":Plantas", $Plantas, PDO::PARAM_INT);
		$stmt->bindParam(":Recamaras", $Recamaras, PDO::PARAM_INT);
		$stmt->bindParam(":Sanitarios", $Sanitarios, PDO::PARAM_INT);
		$stmt->bindParam(":Capacidad_Cochera", $Capacidad_Cochera, PDO::PARAM_INT);
		$stmt->bindParam(":Domicilio_es", $Domicilio_es, PDO::PARAM_INT);
		$stmt->bindParam(":Propietario", $Propietario, PDO::PARAM_STR);
		$stmt->bindParam(":Terreno", $Terreno, PDO::PARAM_INT);
		$stmt->bindParam(":Construccion", $Construccion, PDO::PARAM_INT);
		$stmt->bindParam(":Valor", $Valor, PDO::PARAM_INT);
        $stmt->bindParam(":Tiempo_Viviendo", $Tiempo_Viviendo, PDO::PARAM_STR);
		$stmt->bindParam(":Conoce_Valor", $Conoce_Valor, PDO::PARAM_INT);
		$stmt->bindParam(":Conoce_Mts", $Conoce_Mts, PDO::PARAM_INT);
		$stmt->bindParam(":Conoce_Mts_C", $Conoce_Mts_C, PDO::PARAM_INT);
		$stmt->bindParam(":TerrenoMts", $TerrenoMts, PDO::PARAM_INT);
		$stmt->bindParam(":ConstruccionMts", $ConstruccionMts, PDO::PARAM_STR);
        $stmt->bindParam(":Parentesco", $Parentesco, PDO::PARAM_STR);
		$stmt->bindParam(":Telefono_Parentesco", $Telefono_Parentesco, PDO::PARAM_STR);
		$stmt->bindParam(":Contrato_Arrendamiento", $Contrato_Arrendamiento, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Contrato", $Tiempo_Contrato, PDO::PARAM_STR);
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
        $Tipo_Vivienda = $this->getTipo_Vivienda();
		$Plantas = $this->getPlantas();
		$Recamaras = $this->getRecamaras();
		$Sanitarios = $this->getSanitarios();
		$Capacidad_Cochera = $this->getCapacidad_Cochera();
		$Domicilio_es = $this->getDomicilio_es();
		$Propietario = $this->getPropietario();
		$Terreno = $this->getTerreno();
		$Construccion = $this->getConstruccion();
		$Valor = $this->getValor();
		$Tiempo_Viviendo = $this->getTiempo_Viviendo();
		$Conoce_Valor = $this->getConoce_Valor();
		$Conoce_Mts = $this->getConoce_Mts();
		$Conoce_Mts_C = $this->getConoce_Mts_C();
		$TerrenoMts = $this->getTerrenoMts();
		$ConstruccionMts = $this->getConstruccionMts();
		$Parentesco = $this->getParentesco();
        $Telefono_Parentesco = $this->getTelefono_Parentesco();
		$Contrato_Arrendamiento = $this->getContrato_Arrendamiento();
		$Tiempo_Contrato = $this->getTiempo_Contrato();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Vivienda
		SET Tipo_Vivienda = :Tipo_Vivienda, 
			Plantas = :Plantas, 
			Recamaras = :Recamaras, 
			Sanitarios = :Sanitarios, 
			Capacidad_Cochera = :Capacidad_Cochera, 
			Domicilio_es = :Domicilio_es, 
			Propietario = :Propietario, 
			Terreno = :Terreno, 
			Construccion = :Construccion,
			Valor = :Valor, 
			Conoce_Valor = :Conoce_Valor, 
			Tiempo_Viviendo = :Tiempo_Viviendo,
			Conoce_Mts = :Conoce_Mts,
			Conoce_Mts_C = :Conoce_Mts_C,
			TerrenoMts = :TerrenoMts,
			ConstruccionMts = :ConstruccionMts,
			Parentesco = :Parentesco,
			Telefono_Parentesco = :Telefono_Parentesco,
			Contrato_Arrendamiento = :Contrato_Arrendamiento,
			Tiempo_Contrato = :Tiempo_Contrato
		WHERE Candidato = :Candidato");
        $stmt->bindParam(":Tipo_Vivienda", $Tipo_Vivienda, PDO::PARAM_INT);
		$stmt->bindParam(":Plantas", $Plantas, PDO::PARAM_INT);
		$stmt->bindParam(":Recamaras", $Recamaras, PDO::PARAM_INT);
		$stmt->bindParam(":Sanitarios", $Sanitarios, PDO::PARAM_INT);
		$stmt->bindParam(":Capacidad_Cochera", $Capacidad_Cochera, PDO::PARAM_INT);
		$stmt->bindParam(":Domicilio_es", $Domicilio_es, PDO::PARAM_INT);
		$stmt->bindParam(":Propietario", $Propietario, PDO::PARAM_STR);
		$stmt->bindParam(":Terreno", $Terreno, PDO::PARAM_INT);
		$stmt->bindParam(":Construccion", $Construccion, PDO::PARAM_INT);
		$stmt->bindParam(":Valor", $Valor, PDO::PARAM_INT);
        $stmt->bindParam(":Tiempo_Viviendo", $Tiempo_Viviendo, PDO::PARAM_STR);
		$stmt->bindParam(":Conoce_Valor", $Conoce_Valor, PDO::PARAM_INT);
		$stmt->bindParam(":Conoce_Mts", $Conoce_Mts, PDO::PARAM_INT);
		$stmt->bindParam(":Conoce_Mts_C", $Conoce_Mts_C, PDO::PARAM_INT);
		$stmt->bindParam(":TerrenoMts", $TerrenoMts, PDO::PARAM_INT);
		$stmt->bindParam(":ConstruccionMts", $ConstruccionMts, PDO::PARAM_STR);
        $stmt->bindParam(":Parentesco", $Parentesco, PDO::PARAM_STR);
		$stmt->bindParam(":Telefono_Parentesco", $Telefono_Parentesco, PDO::PARAM_STR);
		$stmt->bindParam(":Contrato_Arrendamiento", $Contrato_Arrendamiento, PDO::PARAM_STR);
		$stmt->bindParam(":Tiempo_Contrato", $Tiempo_Contrato, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateFoto() {
        
        $result = false;

        $Candidato = $this->getCandidato();
        $Foto = $this->getFoto();
        
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Vivienda SET Foto=:Foto WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Foto", $Foto, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag)
            $result = true;
            
        return $result;
    }
	
	public function duplicate($duplicado){
		$result = false;

		$Candidato = $this->getCandidato();
		$Folio = $duplicado;
        
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Vivienda(
			Candidato, Tipo_Vivienda, Plantas, Recamaras, Sanitarios, Capacidad_Cochera,
			Domicilio_es, Propietario, Terreno, Construccion, Valor, Conoce_Valor, Tiempo_Viviendo,Conoce_Mts,Conoce_Mts_C,TerrenoMts,ConstruccionMts, Parentesco, Telefono_Parentesco, Contrato_Arrendamiento, Tiempo_Contrato)
		SELECT :Candidato, Tipo_Vivienda, Plantas, Recamaras, Sanitarios, Capacidad_Cochera,  Domicilio_es, Propietario, Terreno, Construccion, Valor, Conoce_Valor, Tiempo_Viviendo, Conoce_Mts, Conoce_Mts_C, TerrenoMts, ConstruccionMts,  Parentesco,  Telefono_Parentesco,  Contrato_Arrendamiento,  Tiempo_Contrato FROM rh_Candidatos_Vivienda WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}