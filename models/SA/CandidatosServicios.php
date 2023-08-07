<?php
class CandidatosServicios{

    private $Candidato;
    private $Luz;
    private $Cable;
    private $Linea_telefonica;
    private $Sistema_Seguridad;
    private $Agua;
    private $Gas_Natural;
    private $Gas_LP;
    private $Drenaje;
    private $Internet;
    private $Pavimentacion;
    private $Recoleccion_Basura;
    private $Transporte;

    
    public function __construct() {
        $this->db = Connection::connectSA();
    }
    
    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getLuz(){
		return $this->Luz;
	}

	public function setLuz($Luz){
		$this->Luz = $Luz;
	}

	public function getCable(){
		return $this->Cable;
	}

	public function setCable($Cable){
		$this->Cable = $Cable;
	}

	public function getLinea_telefonica(){
		return $this->Linea_telefonica;
	}

	public function setLinea_telefonica($Linea_telefonica){
		$this->Linea_telefonica = $Linea_telefonica;
	}

	public function getSistema_Seguridad(){
		return $this->Sistema_Seguridad;
	}

	public function setSistema_Seguridad($Sistema_Seguridad){
		$this->Sistema_Seguridad = $Sistema_Seguridad;
	}

	public function getAgua(){
		return $this->Agua;
	}

	public function setAgua($Agua){
		$this->Agua = $Agua;
	}

	public function getGas_Natural(){
		return $this->Gas_Natural;
	}

	public function setGas_Natural($Gas_Natural){
		$this->Gas_Natural = $Gas_Natural;
	}

	public function getGas_LP(){
		return $this->Gas_LP;
	}

	public function setGas_LP($Gas_LP){
		$this->Gas_LP = $Gas_LP;
	}

	public function getDrenaje(){
		return $this->Drenaje;
	}

	public function setDrenaje($Drenaje){
		$this->Drenaje = $Drenaje;
	}

	public function getInternet(){
		return $this->Internet;
	}

	public function setInternet($Internet){
		$this->Internet = $Internet;
	}

	public function getPavimentacion(){
		return $this->Pavimentacion;
	}

	public function setPavimentacion($Pavimentacion){
		$this->Pavimentacion = $Pavimentacion;
	}

	public function getRecoleccion_Basura(){
		return $this->Recoleccion_Basura;
	}

	public function setRecoleccion_Basura($Recoleccion_Basura){
		$this->Recoleccion_Basura = $Recoleccion_Basura;
	}

	public function getTransporte(){
		return $this->Transporte;
	}

	public function setTransporte($Transporte){
		$this->Transporte = $Transporte;
	}

    public function getAll(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Servicios"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    
    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Servicios WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    
}