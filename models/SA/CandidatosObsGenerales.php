<?php 
class CandidatosObsGenerales{


    private $Candidato;
    private $Sobre_Candidato;
    private $Sobre_Familia;
    private $Sobre_Casa;
    private $Documentacion;
    private $Entorno_Familiar;
    private $Entorno_Socioeconomico;
    private $Referencias_Laborales;
    private $Comentarios_Generales;
    private $Califica_como;
    private $Viable;
    private $Comentario_General_il;
    private $Sobre_Limpieza;

	private $Comentario_Demanda;
	private $Info_Proporcionada;
	private $Info_Confiable;
	private $Conclusiones_Entrevistador;
	private $Participacion_Candidato;
	private $Referencias_Vecinales;
	private $Viabilidad;

    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getSobre_Candidato(){
		return $this->Sobre_Candidato;
	}

	public function setSobre_Candidato($Sobre_Candidato){
		$this->Sobre_Candidato = $Sobre_Candidato;
	}

	public function getSobre_Familia(){
		return $this->Sobre_Familia;
	}

	public function setSobre_Familia($Sobre_Familia){
		$this->Sobre_Familia = $Sobre_Familia;
	}

	public function getSobre_Casa(){
		return $this->Sobre_Casa;
	}

	public function setSobre_Casa($Sobre_Casa){
		$this->Sobre_Casa = $Sobre_Casa;
	}

	public function getDocumentacion(){
		return $this->Documentacion;
	}

	public function setDocumentacion($Documentacion){
		$this->Documentacion = $Documentacion;
	}

	public function getEntorno_Familiar(){
		return $this->Entorno_Familiar;
	}

	public function setEntorno_Familiar($Entorno_Familiar){
		$this->Entorno_Familiar = $Entorno_Familiar;
	}

	public function getEntorno_Socioeconomico(){
		return $this->Entorno_Socioeconomico;
	}

	public function setEntorno_Socioeconomico($Entorno_Socioeconomico){
		$this->Entorno_Socioeconomico = $Entorno_Socioeconomico;
	}

	public function getReferencias_Laborales(){
		return $this->Referencias_Laborales;
	}

	public function setReferencias_Laborales($Referencias_Laborales){
		$this->Referencias_Laborales = $Referencias_Laborales;
	}

	public function getComentarios_Generales(){
		return $this->Comentarios_Generales;
	}

	public function setComentarios_Generales($Comentarios_Generales){
		$this->Comentarios_Generales = $Comentarios_Generales;
	}

	public function getCalifica_como(){
		return $this->Califica_como;
	}

	public function setCalifica_como($Califica_como){
		$this->Califica_como = $Califica_como;
	}

	public function getViable(){
		return $this->Viable;
	}

	public function setViable($Viable){
		$this->Viable = $Viable;
	}

	public function getComentario_General_il(){
		return $this->Comentario_General_il;
	}

	public function setComentario_General_il($Comentario_General_il){
		$this->Comentario_General_il = $Comentario_General_il;
	}

	public function getSobre_Limpieza(){
		return $this->Sobre_Limpieza;
	}

	public function setSobre_Limpieza($Sobre_Limpieza){
		$this->Sobre_Limpieza = $Sobre_Limpieza;
	}

	public function getComentario_Demanda(){
		return $this->Comentario_Demanda;
	}

	public function setComentario_Demanda($Comentario_Demanda){
		$this->Comentario_Demanda = $Comentario_Demanda;
	}

	public function getInfo_Proporcionada(){
		return $this->Info_Proporcionada;
	}

	public function setInfo_Proporcionada($Info_Proporcionada){
		$this->Info_Proporcionada = $Info_Proporcionada;
	}

	public function getInfo_Confiable(){
		return $this->Info_Confiable;
	}

	public function setInfo_Confiable($Info_Confiable){
		$this->Info_Confiable = $Info_Confiable;
	}

	public function getConclusiones_Entrevistador(){
		return $this->Conclusiones_Entrevistador;
	}

	public function setConclusiones_Entrevistador($Conclusiones_Entrevistador){
		$this->Conclusiones_Entrevistador = $Conclusiones_Entrevistador;
	}

	public function getParticipacion_Candidato(){
		return $this->Participacion_Candidato;
	}

	public function setParticipacion_Candidato($Participacion_Candidato){
		$this->Participacion_Candidato = $Participacion_Candidato;
	}

	public function getReferencias_Vecinales(){
		return $this->Referencias_Vecinales;
	}

	public function setReferencias_Vecinales($Referencias_Vecinales){
		$this->Referencias_Vecinales = $Referencias_Vecinales;
	}

	public function getViabilidad(){
		return $this->Viabilidad;
	}

	public function setViabilidad($Viabilidad){
		$this->Viabilidad = $Viabilidad;
	}
    
    public function getObservacionesPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Obs_Generales WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $observaciones = $stmt->fetchObject();
        return $observaciones;
    }

	public function createConclusiones(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Sobre_Candidato = $this->getSobre_Candidato();
        $Sobre_Casa = $this->getSobre_Casa();
        $Conclusiones_Entrevistador = $this->getConclusiones_Entrevistador();
		$Participacion_Candidato = $this->getParticipacion_Candidato();
        $Entorno_Familiar = $this->getEntorno_Familiar();
        $Referencias_Vecinales = $this->getReferencias_Vecinales();
		$Viabilidad = $this->getViabilidad();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Obs_Generales(Candidato, 
		Sobre_Candidato, Sobre_Casa, Conclusiones_Entrevistador, Participacion_Candidato, Entorno_Familiar, 
	Referencias_Vecinales, Viabilidad)
	VALUES (:Candidato,  :Sobre_Candidato, :Sobre_Casa, :Conclusiones_Entrevistador, :Participacion_Candidato, :Entorno_Familiar, 
	:Referencias_Vecinales, :Viabilidad)");
        $stmt->bindParam(":Sobre_Candidato", $Sobre_Candidato, PDO::PARAM_STR);
        $stmt->bindParam(":Sobre_Casa", $Sobre_Casa, PDO::PARAM_STR);
		$stmt->bindParam(":Conclusiones_Entrevistador", $Conclusiones_Entrevistador, PDO::PARAM_STR);
        $stmt->bindParam(":Participacion_Candidato", $Participacion_Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Entorno_Familiar", $Entorno_Familiar, PDO::PARAM_INT);
		$stmt->bindParam(":Referencias_Vecinales", $Referencias_Vecinales, PDO::PARAM_INT);
		$stmt->bindParam(":Viabilidad", $Viabilidad, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateConclusiones(){
        $result = false;

        $Candidato = $this->getCandidato();
        $Sobre_Candidato = $this->getSobre_Candidato();
        $Sobre_Casa = $this->getSobre_Casa();
        $Conclusiones_Entrevistador = $this->getConclusiones_Entrevistador();
		$Participacion_Candidato = $this->getParticipacion_Candidato();
        $Entorno_Familiar = $this->getEntorno_Familiar();
        $Referencias_Vecinales = $this->getReferencias_Vecinales();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Obs_Generales
		SET Sobre_Candidato=:Sobre_Candidato
			,Sobre_Casa=:Sobre_Casa
			,Conclusiones_Entrevistador=:Conclusiones_Entrevistador
			,Participacion_Candidato=:Participacion_Candidato
			,Entorno_Familiar=:Entorno_Familiar
			,Referencias_Vecinales=:Referencias_Vecinales
		WHERE Candidato=:Candidato");
        $stmt->bindParam(":Sobre_Candidato", $Sobre_Candidato, PDO::PARAM_STR);
        $stmt->bindParam(":Sobre_Casa", $Sobre_Casa, PDO::PARAM_STR);
		$stmt->bindParam(":Conclusiones_Entrevistador", $Conclusiones_Entrevistador, PDO::PARAM_STR);
        $stmt->bindParam(":Participacion_Candidato", $Participacion_Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Entorno_Familiar", $Entorno_Familiar, PDO::PARAM_INT);
		$stmt->bindParam(":Referencias_Vecinales", $Referencias_Vecinales, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function createComentariosGeneralesInv(){
		$result = false;

		$Candidato = $this->getCandidato();
		$Info_Proporcionada = $this->getInfo_Proporcionada();
		$Referencias_Laborales = $this->getReferencias_Laborales();
		$Info_Confiable = $this->getInfo_Confiable();
        $Comentario_General_il = $this->getComentario_General_il();
        $Viable = $this->getViable();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Obs_Generales(Candidato, Info_Proporcionada_Candidato, Referencias_Laborales, Info_Confiable,
		Comentario_General_il, Viable)
	VALUES (:Candidato, :Info_Proporcionada_Candidato, :Referencias_Laborales, :Info_Confiable, :Comentario_General_il, :Viable)");
		$stmt->bindParam(":Info_Proporcionada_Candidato", $Info_Proporcionada, PDO::PARAM_INT);
		$stmt->bindParam(":Referencias_Laborales", $Referencias_Laborales, PDO::PARAM_INT);
		$stmt->bindParam(":Info_Confiable", $Info_Confiable, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_General_il", $Comentario_General_il, PDO::PARAM_STR);
        $stmt->bindParam(":Viable", $Viable, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateComentariosGeneralesInv(){
        $result = false;

        $Candidato = $this->getCandidato();
		$Info_Proporcionada = $this->getInfo_Proporcionada();
		$Referencias_Laborales = $this->getReferencias_Laborales();
		$Info_Confiable = $this->getInfo_Confiable();
        $Comentario_General_il = $this->getComentario_General_il();
        $Viable = $this->getViable();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Obs_Generales
		SET Info_Proporcionada_Candidato=:Info_Proporcionada_Candidato, Referencias_Laborales=:Referencias_Laborales, Info_Confiable=:Info_Confiable,  Comentario_General_il=:Comentario_General_il
			,Viable=:Viable
		WHERE Candidato=:Candidato");
		$stmt->bindParam(":Info_Proporcionada_Candidato", $Info_Proporcionada, PDO::PARAM_INT);
		$stmt->bindParam(":Referencias_Laborales", $Referencias_Laborales, PDO::PARAM_INT);
		$stmt->bindParam(":Info_Confiable", $Info_Confiable, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_General_il", $Comentario_General_il, PDO::PARAM_STR);
        $stmt->bindParam(":Viable", $Viable, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function createComentariosGenerales(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Comentarios_Generales = $this->getComentarios_Generales();
        $Califica_como = $this->getCalifica_como();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Obs_Generales(Candidato, 
		Comentarios_Generales, Califica_como)
	VALUES (:Candidato, :Comentarios_Generales, :Califica_como)");
        $stmt->bindParam(":Comentarios_Generales", $Comentarios_Generales, PDO::PARAM_STR);
        $stmt->bindParam(":Califica_como", $Califica_como, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateComentariosGenerales(){
        $result = false;

        $Candidato = $this->getCandidato();
        $Comentarios_Generales = $this->getComentarios_Generales();
        $Califica_como = $this->getCalifica_como();
		$Viabilidad = $this->getViabilidad();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Obs_Generales
		SET Comentarios_Generales=:Comentarios_Generales
			,Califica_como=:Califica_como, Viabilidad=:Viabilidad
		WHERE Candidato=:Candidato");
        $stmt->bindParam(":Comentarios_Generales", $Comentarios_Generales, PDO::PARAM_STR);
        $stmt->bindParam(":Califica_como", $Califica_como, PDO::PARAM_STR);
		$stmt->bindParam(":Viabilidad", $Viabilidad, PDO::PARAM_INT);
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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Obs_Generales(Candidato, Comentarios_Generales, Comentario_General_il)
		SELECT :Candidato, Comentarios_Generales, Comentario_General_il FROM rh_Candidatos_Obs_Generales WHERE Candidato=:Folio");
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
} 