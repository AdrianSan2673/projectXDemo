<?php  

class CandidatosSalud{

	//rh_Candidatos_Salud
	private $Candidato;
	private $Diabetes;
	private $Diabetes_Familiar;
	private $Cancer;
	private $Cancer_Familiar;
	private $Hipertension;
	private $Hipertension_Familiar;
	private $Disfuncion_Renal;
	private $Disfuncion_Renal_Familiar;
	private $Fibrosis_Quistica;
	private $Fibrosis_Quistica_Familiar;
	private $Miopia;
	private $Miopia_Familiar;
	private $Asma;
	private $Asma_Familiar;
	private $Migranas;
	private $Migranas_Familiar;
	private $Esclerosis_Multiple;
	private $Esclerosis_Multiple_Familiar;
	private $Fuma;
	private $Fuma_Cuanto;
	private $Bebe;
	private $Bebe_Frecuencia;
	private $Consume_Droga;
	private $Cual_Droga;
	private $Servico_Medico; 
	private $Deportes;
	private $Deportes_Cual;
	private $Deportes_Frecuencia;

      public function __construct() {
        $this->db = Connection::connectSA();
    }



      public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getDiabetes(){
		return $this->Diabetes;
	}

	public function setDiabetes($Diabetes){
		$this->Diabetes = $Diabetes;
	}

	public function getDiabetes_Familiar(){
		return $this->Diabetes_Familiar;
	}

	public function setDiabetes_Familiar($Diabetes_Familiar){
		$this->Diabetes_Familiar = $Diabetes_Familiar;
	}

	public function getCancer(){
		return $this->Cancer;
	}

	public function setCancer($Cancer){
		$this->Cancer = $Cancer;
	}

	public function getCancer_Familiar(){
		return $this->Cancer_Familiar;
	}

	public function setCancer_Familiar($Cancer_Familiar){
		$this->Cancer_Familiar = $Cancer_Familiar;
	}

	public function getHipertension(){
		return $this->Hipertension;
	}

	public function setHipertension($Hipertension){
		$this->Hipertension = $Hipertension;
	}

	public function getHipertension_Familiar(){
		return $this->Hipertension_Familiar;
	}

	public function setHipertension_Familiar($Hipertension_Familiar){
		$this->Hipertension_Familiar = $Hipertension_Familiar;
	}

	public function getDisfuncion_Renal(){
		return $this->Disfuncion_Renal;
	}

	public function setDisfuncion_Renal($Disfuncion_Renal){
		$this->Disfuncion_Renal = $Disfuncion_Renal;
	}

	public function getDisfuncion_Renal_Familiar(){
		return $this->Disfuncion_Renal_Familiar;
	}

	public function setDisfuncion_Renal_Familiar($Disfuncion_Renal_Familiar){
		$this->Disfuncion_Renal_Familiar = $Disfuncion_Renal_Familiar;
	}

	public function getFibrosis_Quistica(){
		return $this->Fibrosis_Quistica;
	}

	public function setFibrosis_Quistica($Fibrosis_Quistica){
		$this->Fibrosis_Quistica = $Fibrosis_Quistica;
	}

	public function getFibrosis_Quistica_Familiar(){
		return $this->Fibrosis_Quistica_Familiar;
	}

	public function setFibrosis_Quistica_Familiar($Fibrosis_Quistica_Familiar){
		$this->Fibrosis_Quistica_Familiar = $Fibrosis_Quistica_Familiar;
	}

	public function getMiopia(){
		return $this->Miopia;
	}

	public function setMiopia($Miopia){
		$this->Miopia = $Miopia;
	}

	public function getMiopia_Familiar(){
		return $this->Miopia_Familiar;
	}

	public function setMiopia_Familiar($Miopia_Familiar){
		$this->Miopia_Familiar = $Miopia_Familiar;
	}

	public function getAsma(){
		return $this->Asma;
	}

	public function setAsma($Asma){
		$this->Asma = $Asma;
	}

	public function getAsma_Familiar(){
		return $this->Asma_Familiar;
	}

	public function setAsma_Familiar($Asma_Familiar){
		$this->Asma_Familiar = $Asma_Familiar;
	}

	public function getMigranas(){
		return $this->Migranas;
	}

	public function setMigranas($Migranas){
		$this->Migranas = $Migranas;
	}

	public function getMigranas_Familiar(){
		return $this->Migranas_Familiar;
	}

	public function setMigranas_Familiar($Migranas_Familiar){
		$this->Migranas_Familiar = $Migranas_Familiar;
	}

	public function getEsclerosis_Multiple(){
		return $this->Esclerosis_Multiple;
	}

	public function setEsclerosis_Multiple($Esclerosis_Multiple){
		$this->Esclerosis_Multiple = $Esclerosis_Multiple;
	}

	public function getEsclerosis_Multiple_Familiar(){
		return $this->Esclerosis_Multiple_Familiar;
	}

	public function setEsclerosis_Multiple_Familiar($Esclerosis_Multiple_Familiar){
		$this->Esclerosis_Multiple_Familiar = $Esclerosis_Multiple_Familiar;
	}

	public function getFuma(){
		return $this->Fuma;
	}

	public function setFuma($Fuma){
		$this->Fuma = $Fuma;
	}

	public function getFuma_Cuanto(){
		return $this->Fuma_Cuanto;
	}

	public function setFuma_Cuanto($Fuma_Cuanto){
		$this->Fuma_Cuanto = $Fuma_Cuanto;
	}

	public function getBebe(){
		return $this->Bebe;
	}

	public function setBebe($Bebe){
		$this->Bebe = $Bebe;
	}

	public function getBebe_Frecuencia(){
		return $this->Bebe_Frecuencia;
	}

	public function setBebe_Frecuencia($Bebe_Frecuencia){
		$this->Bebe_Frecuencia = $Bebe_Frecuencia;
	}

	public function getConsume_Droga(){
		return $this->Consume_Droga;
	}

	public function setConsume_Droga($Consume_Droga){
		$this->Consume_Droga = $Consume_Droga;
	}

	public function getCual_Droga(){
		return $this->Cual_Droga;
	}

	public function setCual_Droga($Cual_Droga){
		$this->Cual_Droga = $Cual_Droga;
	}

	public function getServico_Medico(){
		return $this->Servico_Medico;
	}

	public function setServico_Medico($Servico_Medico){
		$this->Servico_Medico = $Servico_Medico;
	}

	public function getDeportes(){
		return $this->Deportes;
	}

	public function setDeportes($Deportes){
		$this->Deportes = $Deportes;
	}

	public function getDeportes_Cual(){
		return $this->Deportes_Cual;
	}

	public function setDeportes_Cual($Deportes_Cual){
		$this->Deportes_Cual = $Deportes_Cual;
	}

	public function getDeportes_Frecuencia(){
		return $this->Deportes_Frecuencia;
	}

	public function setDeportes_Frecuencia($Deportes_Frecuencia){
		$this->Deportes_Frecuencia = $Deportes_Frecuencia;
	}
  
    public function getAll(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Salud"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    
    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Salud WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Diabetes = $this->getDiabetes();
		$Diabetes_Familiar = $this->getDiabetes_Familiar();
		$Cancer = $this->getCancer();
		$Cancer_Familiar = $this->getCancer_Familiar();
		$Hipertension = $this->getHipertension();
		$Hipertension_Familiar = $this->getHipertension_Familiar();
		$Disfuncion_Renal = $this->getDisfuncion_Renal();
		$Disfuncion_Renal_Familiar = $this->getDisfuncion_Renal_Familiar();
		$Fibrosis_Quistica = $this->getFibrosis_Quistica();
		$Fibrosis_Quistica_Familiar = $this->getFibrosis_Quistica_Familiar();
		$Miopia = $this->getMiopia();
		$Miopia_Familiar = $this->getMiopia_Familiar();
		$Asma = $this->getAsma();
		$Asma_Familiar = $this->getAsma_Familiar();
		$Migranas = $this->getMigranas();
		$Migranas_Familiar = $this->getMigranas_Familiar();
		$Esclerosis_Multiple = $this->getEsclerosis_Multiple();
		$Esclerosis_Multiple_Familiar = $this->getEsclerosis_Multiple_Familiar();
		$Fuma = $this->getFuma();
		$Fuma_Cuanto = $this->getFuma_Cuanto();
		$Bebe = $this->getBebe();
		$Bebe_Frecuencia = $this->getBebe_Frecuencia();
		$Consume_Droga = $this->getConsume_Droga();
		$Cual_Droga = $this->getCual_Droga();
		$Deportes = $this->getDeportes();
		$Deportes_Frecuencia = $this->getDeportes_Frecuencia();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Salud(Candidato, 
		Diabetes,Cancer,Hipertension,Disfuncion_Renal, Fibrosis_Quistica, Miopia,Asma, Migranas,Esclerosis_Multiple, Fuma, Bebe, Consume_Droga,Servicio_Medico, Deportes, Diabetes_Familiar, Cancer_Familiar, Hipertension_Familiar, Disfuncion_Renal_Familiar, Fibrosis_Quistica_Familiar, Miopia_Familiar, Asma_Familiar, Migranas_Familiar, Esclerosis_Multiple_Familiar, Fuma_Cuanto, Bebe_Frecuencia, Cual_Droga, Otro_Seguro, Deportes_Frecuencia) 	
		
	VALUES (:Candidato, 
		:Diabetes,:Cancer,:Hipertension,:Disfuncion_Renal, :Fibrosis_Quistica, :Miopia,:Asma, :Migranas,:Esclerosis_Multiple, :Fuma, :Bebe, :Consume_Droga, 0, :Deportes, :Diabetes_Familiar, :Cancer_Familiar, :Hipertension_Familiar, :Disfuncion_Renal_Familiar, :Fibrosis_Quistica_Familiar, :Miopia_Familiar, :Asma_Familiar, :Migranas_Familiar, :Esclerosis_Multiple_Familiar, :Fuma_Cuanto, :Bebe_Frecuencia, :Cual_Droga, '', :Deportes_Frecuencia)");
        $stmt->bindParam(":Diabetes", $Diabetes, PDO::PARAM_STR);
        $stmt->bindParam(":Cancer", $Cancer, PDO::PARAM_STR);
		$stmt->bindParam(":Hipertension", $Hipertension, PDO::PARAM_STR);
		$stmt->bindParam(":Disfuncion_Renal", $Disfuncion_Renal, PDO::PARAM_STR);
        $stmt->bindParam(":Fibrosis_Quistica", $Fibrosis_Quistica, PDO::PARAM_STR);
        $stmt->bindParam(":Miopia", $Miopia, PDO::PARAM_STR);
		$stmt->bindParam(":Asma", $Asma, PDO::PARAM_STR);
		$stmt->bindParam(":Migranas", $Migranas, PDO::PARAM_STR);
        $stmt->bindParam(":Esclerosis_Multiple", $Esclerosis_Multiple, PDO::PARAM_STR);
		$stmt->bindParam(":Diabetes_Familiar", $Diabetes_Familiar, PDO::PARAM_STR);
        $stmt->bindParam(":Cancer_Familiar", $Cancer_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Hipertension_Familiar", $Hipertension_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Disfuncion_Renal_Familiar", $Disfuncion_Renal_Familiar, PDO::PARAM_STR);
        $stmt->bindParam(":Fibrosis_Quistica_Familiar", $Fibrosis_Quistica_Familiar, PDO::PARAM_STR);
        $stmt->bindParam(":Miopia_Familiar", $Miopia_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Asma_Familiar", $Asma_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Migranas_Familiar", $Migranas_Familiar, PDO::PARAM_STR);
        $stmt->bindParam(":Esclerosis_Multiple_Familiar", $Esclerosis_Multiple_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Fuma", $Fuma, PDO::PARAM_INT);
		$stmt->bindParam(":Fuma_Cuanto", $Fuma_Cuanto, PDO::PARAM_STR);
		$stmt->bindParam(":Bebe", $Bebe, PDO::PARAM_INT);
		$stmt->bindParam(":Bebe_Frecuencia", $Bebe_Frecuencia, PDO::PARAM_STR);
		$stmt->bindParam(":Consume_Droga", $Consume_Droga, PDO::PARAM_INT);
		$stmt->bindParam(":Cual_Droga", $Cual_Droga, PDO::PARAM_STR);
		$stmt->bindParam(":Deportes", $Deportes, PDO::PARAM_INT);
		$stmt->bindParam(":Deportes_Frecuencia", $Deportes_Frecuencia, PDO::PARAM_STR);
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
        $Diabetes = $this->getDiabetes();
		$Diabetes_Familiar = $this->getDiabetes_Familiar();
		$Cancer = $this->getCancer();
		$Cancer_Familiar = $this->getCancer_Familiar();
		$Hipertension = $this->getHipertension();
		$Hipertension_Familiar = $this->getHipertension_Familiar();
		$Disfuncion_Renal = $this->getDisfuncion_Renal();
		$Disfuncion_Renal_Familiar = $this->getDisfuncion_Renal_Familiar();
		$Fibrosis_Quistica = $this->getFibrosis_Quistica();
		$Fibrosis_Quistica_Familiar = $this->getFibrosis_Quistica_Familiar();
		$Miopia = $this->getMiopia();
		$Miopia_Familiar = $this->getMiopia_Familiar();
		$Asma = $this->getAsma();
		$Asma_Familiar = $this->getAsma_Familiar();
		$Migranas = $this->getMigranas();
		$Migranas_Familiar = $this->getMigranas_Familiar();
		$Esclerosis_Multiple = $this->getEsclerosis_Multiple();
		$Esclerosis_Multiple_Familiar = $this->getEsclerosis_Multiple_Familiar();
		$Fuma = $this->getFuma();
		$Fuma_Cuanto = $this->getFuma_Cuanto();
		$Bebe = $this->getBebe();
		$Bebe_Frecuencia = $this->getBebe_Frecuencia();
		$Consume_Droga = $this->getConsume_Droga();
		$Cual_Droga = $this->getCual_Droga();
		$Deportes = $this->getDeportes();
		$Deportes_Frecuencia = $this->getDeportes_Frecuencia();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Salud
		SET Diabetes=:Diabetes
			,Cancer=:Cancer
			,Hipertension=:Hipertension
			,Disfuncion_Renal=:Disfuncion_Renal
			,Fibrosis_Quistica=:Fibrosis_Quistica
			,Miopia=:Miopia
			,Asma=:Asma
            ,Migranas=:Migranas
			,Esclerosis_Multiple=:Esclerosis_Multiple
            ,Fuma=:Fuma
            ,Bebe=:Bebe
			,Consume_Droga=:Consume_Droga
			,Deportes=:Deportes
            ,Diabetes_Familiar=:Diabetes_Familiar
			,Cancer_Familiar=:Cancer_Familiar
			,Hipertension_Familiar=:Hipertension_Familiar
			,Disfuncion_Renal_Familiar=:Disfuncion_Renal_Familiar
			,Fibrosis_Quistica_Familiar=:Fibrosis_Quistica_Familiar
			,Miopia_Familiar=:Miopia_Familiar
			,Asma_Familiar=:Asma_Familiar
            ,Migranas_Familiar=:Migranas_Familiar
			,Esclerosis_Multiple_Familiar=:Esclerosis_Multiple_Familiar
            ,Fuma_Cuanto=:Fuma_Cuanto
            ,Bebe_Frecuencia=:Bebe_Frecuencia
			,Cual_Droga=:Cual_Droga
            ,Otro_Seguro=''
			,Deportes_Frecuencia=:Deportes_Frecuencia
		WHERE Candidato=:Candidato");
        $stmt->bindParam(":Diabetes", $Diabetes, PDO::PARAM_STR);
        $stmt->bindParam(":Cancer", $Cancer, PDO::PARAM_STR);
		$stmt->bindParam(":Hipertension", $Hipertension, PDO::PARAM_STR);
		$stmt->bindParam(":Disfuncion_Renal", $Disfuncion_Renal, PDO::PARAM_STR);
        $stmt->bindParam(":Fibrosis_Quistica", $Fibrosis_Quistica, PDO::PARAM_STR);
        $stmt->bindParam(":Miopia", $Miopia, PDO::PARAM_STR);
		$stmt->bindParam(":Asma", $Asma, PDO::PARAM_STR);
		$stmt->bindParam(":Migranas", $Migranas, PDO::PARAM_STR);
        $stmt->bindParam(":Esclerosis_Multiple", $Esclerosis_Multiple, PDO::PARAM_STR);
		$stmt->bindParam(":Diabetes_Familiar", $Diabetes_Familiar, PDO::PARAM_STR);
        $stmt->bindParam(":Cancer_Familiar", $Cancer_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Hipertension_Familiar", $Hipertension_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Disfuncion_Renal_Familiar", $Disfuncion_Renal_Familiar, PDO::PARAM_STR);
        $stmt->bindParam(":Fibrosis_Quistica_Familiar", $Fibrosis_Quistica_Familiar, PDO::PARAM_STR);
        $stmt->bindParam(":Miopia_Familiar", $Miopia_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Asma_Familiar", $Asma_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Migranas_Familiar", $Migranas_Familiar, PDO::PARAM_STR);
        $stmt->bindParam(":Esclerosis_Multiple_Familiar", $Esclerosis_Multiple_Familiar, PDO::PARAM_STR);
		$stmt->bindParam(":Fuma", $Fuma, PDO::PARAM_INT);
		$stmt->bindParam(":Fuma_Cuanto", $Fuma_Cuanto, PDO::PARAM_STR);
		$stmt->bindParam(":Bebe", $Bebe, PDO::PARAM_INT);
		$stmt->bindParam(":Bebe_Frecuencia", $Bebe_Frecuencia, PDO::PARAM_STR);
		$stmt->bindParam(":Consume_Droga", $Consume_Droga, PDO::PARAM_INT);
		$stmt->bindParam(":Cual_Droga", $Cual_Droga, PDO::PARAM_STR);
		$stmt->bindParam(":Deportes", $Deportes, PDO::PARAM_INT);
		$stmt->bindParam(":Deportes_Frecuencia", $Deportes_Frecuencia, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Salud(Candidato, 
		Diabetes,Cancer,Hipertension,Disfuncion_Renal, Fibrosis_Quistica, Miopia,Asma, Migranas,Esclerosis_Multiple, Fuma, Bebe, Consume_Droga,Servicio_Medico, Deportes, Diabetes_Familiar, Cancer_Familiar, Hipertension_Familiar, Disfuncion_Renal_Familiar, Fibrosis_Quistica_Familiar, Miopia_Familiar, Asma_Familiar, Migranas_Familiar, Esclerosis_Multiple_Familiar, Fuma_Cuanto, Bebe_Frecuencia, Cual_Droga, Otro_Seguro, Deportes_Frecuencia) 	SELECT :Candidato, 
		Diabetes,Cancer,Hipertension,Disfuncion_Renal, Fibrosis_Quistica, Miopia,Asma, Migranas,Esclerosis_Multiple, Fuma, Bebe, Consume_Droga, 0, Deportes, Diabetes_Familiar, Cancer_Familiar, Hipertension_Familiar, Disfuncion_Renal_Familiar, Fibrosis_Quistica_Familiar, Miopia_Familiar, Asma_Familiar, Migranas_Familiar, Esclerosis_Multiple_Familiar, Fuma_Cuanto, Bebe_Frecuencia, Cual_Droga, '', Deportes_Frecuencia FROM rh_Candidatos_Salud WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}