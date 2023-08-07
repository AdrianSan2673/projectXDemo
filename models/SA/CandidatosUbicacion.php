<?php 


class CandidatosUbicacion{


    //rh_Candidatos_Ubicacion 
    private $Candidato;
    private $Calle;
    private $Exterior;
    private $Interior;
    private $Colonia;
    private $Entre_Calles;
    private $Municipio;
    private $Estado;//cbo_Ciudad_Estado
    private $Codigo_Postal;
    private $Via_acceso;
    private $Fachada;
    private $Zona;
    private $Foto;
    private $Foto1;
    private $Maps;

    public function __construct() {
        $this->db = Connection::connectSA();
    }
    public function getCandidato(){
        return $this->Candidato;
    }

    public function setCandidato($Candidato){
        $this->Candidato = $Candidato;
    }

    public function getCalle(){
        return $this->Calle;
    }

    public function setCalle($Calle){
        $this->Calle = $Calle;
    }

    public function getExterior(){
        return $this->Exterior;
    }

    public function setExterior($Exterior){
        $this->Exterior = $Exterior;
    }

    public function getInterior(){
        return $this->Interior;
    }

    public function setInterior($Interior){
        $this->Interior = $Interior;
    }

    public function getColonia(){
        return $this->Colonia;
    }

    public function setColonia($Colonia){
        $this->Colonia = $Colonia;
    }

    public function getEntre_Calles(){
        return $this->Entre_Calles;
    }

    public function setEntre_Calles($Entre_Calles){
        $this->Entre_Calles = $Entre_Calles;
    }

    public function getMunicipio(){
        return $this->Municipio;
    }

    public function setMunicipio($Municipio){
        $this->Municipio = $Municipio;
    }

    public function getEstado(){
        return $this->Estado;
    }

    public function setEstado($Estado){
        $this->Estado = $Estado;
    }

    public function getCodigo_Postal(){
        return $this->Codigo_Postal;
    }

    public function setCodigo_Postal($Codigo_Postal){
        $this->Codigo_Postal = $Codigo_Postal;
    }

    public function getVia_acceso(){
        return $this->Via_acceso;
    }

    public function setVia_acceso($Via_acceso){
        $this->Via_acceso = $Via_acceso;
    }

    public function getFachada(){
        return $this->Fachada;
    }

    public function setFachada($Fachada){
        $this->Fachada = $Fachada;
    }

    public function getZona(){
        return $this->Zona;
    }

    public function setZona($Zona){
        $this->Zona = $Zona;
    }

    public function getFoto(){
        return $this->Foto;
    }

    public function setFoto($Foto){
        $this->Foto = $Foto;
    }

    public function getFoto1(){
        return $this->Foto1;
    }

    public function setFoto1($Foto1){
        $this->Foto1 = $Foto1;
    }

    public function getMaps(){
        return $this->Maps;
    }

    public function setMaps($Maps){
        $this->Maps = $Maps;
    }

    public function getAll(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Ubicacion"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    
    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT u.*, e.Descripcion AS Estado, u.Estado AS id_estado FROM rh_Candidatos_Ubicacion u LEFT JOIN General_Estados e ON u.Estado=e.Estado WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    public function getDomicilioCompleto(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT CONCAT(Calle,' ',Exterior,' ',Colonia,' ',Municipio) AS domicilio FROM rh_Candidatos_Ubicacion WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        if ($fetch)
            return $fetch->domicilio;
        else
            return $fetch;
        
    }

    public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Calle = $this->getCalle();
        $Exterior = $this->getExterior();
		$Interior = $this->getInterior();
		$Colonia = $this->getColonia();
		$Entre_Calles = $this->getEntre_Calles();
		$Municipio = $this->getMunicipio();
		$Estado = $this->getEstado();
		$Codigo_Postal = $this->getCodigo_Postal();
        $Via_acceso = $this->getVia_acceso();
        $Fachada = $this->getFachada();
        $Zona = $this->getZona();
        $Maps = $this->getMaps();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Ubicacion (Candidato,Calle,Exterior,Interior,Colonia,Entre_Calles,Municipio,Estado,Codigo_Postal,Via_acceso,Fachada,Zona,Maps)
        VALUES (:Candidato, :Calle, :Exterior, :Interior, :Colonia, :Entre_Calles, :Municipio, :Estado, :Codigo_Postal, :Via_acceso, :Fachada, :Zona, :Maps)");
        $stmt->bindParam(":Calle", $Calle, PDO::PARAM_STR);
        $stmt->bindParam(":Exterior", $Exterior, PDO::PARAM_STR);
		$stmt->bindParam(":Interior", $Interior, PDO::PARAM_STR);
		$stmt->bindParam(":Colonia", $Colonia, PDO::PARAM_STR);
		$stmt->bindParam(":Entre_Calles", $Entre_Calles, PDO::PARAM_STR);
		$stmt->bindParam(":Municipio", $Municipio, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
		$stmt->bindParam(":Codigo_Postal", $Codigo_Postal, PDO::PARAM_INT);
        $stmt->bindParam(":Via_acceso", $Via_acceso, PDO::PARAM_STR);
		$stmt->bindParam(":Fachada", $Fachada, PDO::PARAM_STR);
        $stmt->bindParam(":Zona", $Zona, PDO::PARAM_STR);
        $stmt->bindParam(":Maps", $Maps, PDO::PARAM_STR);
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
        $Calle = $this->getCalle();
        $Exterior = $this->getExterior();
		$Interior = $this->getInterior();
		$Colonia = $this->getColonia();
		$Entre_Calles = $this->getEntre_Calles();
		$Municipio = $this->getMunicipio();
		$Estado = $this->getEstado();
		$Codigo_Postal = $this->getCodigo_Postal();
        $Via_acceso = $this->getVia_acceso();
        $Fachada = $this->getFachada();
        $Zona = $this->getZona();
        $Maps = $this->getMaps();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Ubicacion
		SET Calle = :Calle
			,Exterior = :Exterior
			,Interior = :Interior
			,Colonia = :Colonia
			,Entre_Calles = :Entre_Calles
			,Municipio = :Municipio
			,Estado = :Estado
			,Codigo_Postal = :Codigo_Postal
			,Via_acceso = :Via_acceso
			,Fachada = :Fachada
			,Zona = :Zona
            ,Maps = :Maps
		WHERE Candidato = :Candidato");
        $stmt->bindParam(":Calle", $Calle, PDO::PARAM_STR);
        $stmt->bindParam(":Exterior", $Exterior, PDO::PARAM_STR);
		$stmt->bindParam(":Interior", $Interior, PDO::PARAM_STR);
		$stmt->bindParam(":Colonia", $Colonia, PDO::PARAM_STR);
		$stmt->bindParam(":Entre_Calles", $Entre_Calles, PDO::PARAM_STR);
		$stmt->bindParam(":Municipio", $Municipio, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
		$stmt->bindParam(":Codigo_Postal", $Codigo_Postal, PDO::PARAM_INT);
        $stmt->bindParam(":Via_acceso", $Via_acceso, PDO::PARAM_STR);
		$stmt->bindParam(":Fachada", $Fachada, PDO::PARAM_STR);
        $stmt->bindParam(":Zona", $Zona, PDO::PARAM_STR);
        $stmt->bindParam(":Maps", $Maps, PDO::PARAM_STR);
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
        
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Ubicacion SET Foto=:Foto WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Foto", $Foto, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag)
            $result = true;
            
        return $result;
    }

    public function updateFotoNo() {
        
        $result = false;

        $Candidato = $this->getCandidato();
        $Foto1 = $this->getFoto1();
        
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Ubicacion SET Foto1=:Foto1 WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Foto1", $Foto1, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag)
            $result = true;
            
        return $result;
    }

    public function updateCiudadEstado() {
        
        $result = false;

        $Candidato = $this->getCandidato();
        $Municipio = $this->getMunicipio();
        $Estado = $this->getEstado();
        
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Ubicacion SET Municipio=:Municipio, Estado=:Estado WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Municipio", $Municipio, PDO::PARAM_STR);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
        
        $flag = $stmt->execute();
        if ($flag)
            $result = true;
            
        return $result;
    }
	
	public function duplicate($duplicado){
		$result = false;

		$Candidato = $this->getCandidato();
        $Folio = $duplicado();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Ubicacion (Candidato,Calle,Exterior,Interior,Colonia,Entre_Calles,Municipio,Estado,Codigo_Postal,Via_acceso,Fachada,Zona,Maps)
        SELECT :Candidato, Calle, Exterior, Interior, Colonia, Entre_Calles, Municipio, Estado, Codigo_Postal, Via_acceso, Fachada, Zona, Maps FROM rh_Candidatos_Ubicacion WHERE Candidato=:Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function copiarInfo($duplicado){
		$result = false;

		$Candidato = $this->getCandidato();
        $Folio = $duplicado;
		
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Ubicacion SET Calle=t2.Calle, Exterior=t2.Exterior, Interior=t2.Interior, Colonia=t2.Colonia, Entre_Calles=t2.Entre_Calles, Estado=t2.Estado, Codigo_Postal=t2.Codigo_Postal, Via_acceso=t2.Via_acceso, Fachada=t2.Fachada FROM (SELECT * FROM rh_Candidatos_Ubicacion WHERE Candidato=:Folio) t2 WHERE rh_Candidatos_Ubicacion.Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}