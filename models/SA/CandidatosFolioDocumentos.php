<?php 

class CandidatosFolioDocumentos{
	//rh_Candidatos_Folio_Documentos
	private $Candidato;
	private $Acta_Nacimiento;
	private $Licencia;
	private $INE;
	private $Cartilla_Militar;
	private $CURP;
	private $RFC;
	private $NSS;
	private $Afore;
	private $Comprobante_domicilio;
	private $P_Acta;
	private $P_Licencia;
	private $P_INE;
	private $P_Cartilla_Militar;
	private $P_CURP;
	private $P_RFC;
	private $P_NSS;
	private $P_Afore;
	private $P_ComprobanteD;
	private $Redes_Sociales;

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

	public function getActa_Nacimiento(){
		return $this->Acta_Nacimiento;
	}

	public function setActa_Nacimiento($Acta_Nacimiento){
		$this->Acta_Nacimiento = $Acta_Nacimiento;
	}

	public function getLicencia(){
		return $this->Licencia;
	}

	public function setLicencia($Licencia){
		$this->Licencia = $Licencia;
	}

	public function getINE(){
		return $this->INE;
	}

	public function setINE($INE){
		$this->INE = $INE;
	}

	public function getCartilla_Militar(){
		return $this->Cartilla_Militar;
	}

	public function setCartilla_Militar($Cartilla_Militar){
		$this->Cartilla_Militar = $Cartilla_Militar;
	}

	public function getCURP(){
		return $this->CURP;
	}

	public function setCURP($CURP){
		$this->CURP = $CURP;
	}

	public function getRFC(){
		return $this->RFC;
	}

	public function setRFC($RFC){
		$this->RFC = $RFC;
	}

	public function getNSS(){
		return $this->NSS;
	}

	public function setNSS($NSS){
		$this->NSS = $NSS;
	}

	public function getAfore(){
		return $this->Afore;
	}

	public function setAfore($Afore){
		$this->Afore = $Afore;
	}

	public function getComprobante_domicilio(){
		return $this->Comprobante_domicilio;
	}

	public function setComprobante_domicilio($Comprobante_domicilio){
		$this->Comprobante_domicilio = $Comprobante_domicilio;
	}

	public function getP_Acta(){
		return $this->P_Acta;
	}

	public function setP_Acta($P_Acta){
		$this->P_Acta = $P_Acta;
	}

	public function getP_Licencia(){
		return $this->P_Licencia;
	}

	public function setP_Licencia($P_Licencia){
		$this->P_Licencia = $P_Licencia;
	}

	public function getP_INE(){
		return $this->P_INE;
	}

	public function setP_INE($P_INE){
		$this->P_INE = $P_INE;
	}

	public function getP_Cartilla_Militar(){
		return $this->P_Cartilla_Militar;
	}

	public function setP_Cartilla_Militar($P_Cartilla_Militar){
		$this->P_Cartilla_Militar = $P_Cartilla_Militar;
	}

	public function getP_CURP(){
		return $this->P_CURP;
	}

	public function setP_CURP($P_CURP){
		$this->P_CURP = $P_CURP;
	}

	public function getP_RFC(){
		return $this->P_RFC;
	}

	public function setP_RFC($P_RFC){
		$this->P_RFC = $P_RFC;
	}

	public function getP_NSS(){
		return $this->P_NSS;
	}

	public function setP_NSS($P_NSS){
		$this->P_NSS = $P_NSS;
	}

	public function getP_Afore(){
		return $this->P_Afore;
	}

	public function setP_Afore($P_Afore){
		$this->P_Afore = $P_Afore;
	}

	public function getP_ComprobanteD(){
		return $this->P_ComprobanteD;
	}

	public function setP_ComprobanteD($P_ComprobanteD){
		$this->P_ComprobanteD = $P_ComprobanteD;
	}

	public function getRedes_Sociales(){
		return $this->Redes_Sociales;
	}

	public function setRedes_Sociales($Redes_Sociales){
		$this->Redes_Sociales = $Redes_Sociales;
	}

    public function getAll(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Folio_Documentos"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Folio_Documentos WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function updateFolios(){
        $result = false;

        $CURP = $this->getCURP();
		$Candidato = $this->getCandidato();
        $RFC = $this->getRFC();
		$NSS = $this->getNSS();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Folio_Documentos SET RFC=:RFC, CURP=:CURP, NSS=:NSS WHERE Candidato=:Candidato");
        $stmt->bindParam(":RFC", $RFC, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
		$stmt->bindParam(":NSS", $NSS, PDO::PARAM_STR);


        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateRedesSociales(){
        $result = false;

        $Redes_Sociales = $this->getRedes_Sociales();
		$Candidato = $this->getCandidato();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Folio_Documentos SET Redes_Sociales=:Redes_Sociales WHERE Candidato=:Candidato");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Redes_Sociales", $Redes_Sociales, PDO::PARAM_STR);


        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Acta_Nacimiento = $this->getActa_Nacimiento();
        $Licencia = $this->getLicencia();
        $INE = $this->getINE();
        $Cartilla_Militar = $this->getCartilla_Militar();
		$CURP = $this->getCURP();
        $RFC = $this->getRFC();
        $NSS = $this->getNSS();
        $Afore = $this->getAfore();
        $Comprobante_Domicilio = $this->getComprobante_Domicilio();
        $P_Acta = $this->getP_Acta();
        $P_Licencia = $this->getP_Licencia();
		$P_INE = $this->getP_INE();
		$P_Cartilla_Militar = $this->getP_Cartilla_Militar();
		$P_CURP = $this->getP_CURP();
		$P_RFC = $this->getP_RFC();
		$P_NSS = $this->getP_NSS();
		$P_Afore = $this->getP_Afore();
		$P_ComprobanteD = $this->getP_ComprobanteD();
		$Redes_Sociales = $this->getRedes_Sociales();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Folio_Documentos(Candidato, Acta_Nacimiento, Licencia, INE, Cartilla_Militar, CURP, RFC, NSS, Afore, Comprobante_Domicilio, P_Acta, P_Licencia, P_INE, P_Cartilla_Militar, P_CURP, P_RFC, P_NSS, P_Afore, P_ComprobanteD, Redes_Sociales) VALUES (:Candidato, :Acta_Nacimiento, :Licencia, :INE, :Cartilla_Militar, :CURP, :RFC, :NSS, :Afore, :Comprobante_Domicilio, :P_Acta, :P_Licencia, :P_INE, :P_Cartilla_Militar, :P_CURP, :P_RFC, :P_NSS, :P_Afore, :P_ComprobanteD, :Redes_Sociales)");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Acta_Nacimiento", $Acta_Nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(":Licencia", $Licencia, PDO::PARAM_STR);
        $stmt->bindParam(":INE", $INE, PDO::PARAM_STR);
        $stmt->bindParam(":Cartilla_Militar", $Cartilla_Militar, PDO::PARAM_STR);
		$stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
        $stmt->bindParam(":RFC", $RFC, PDO::PARAM_STR);
        $stmt->bindParam(":NSS", $NSS, PDO::PARAM_STR);
        $stmt->bindParam(":Afore", $Afore, PDO::PARAM_STR);
        $stmt->bindParam(":Comprobante_Domicilio", $Comprobante_Domicilio, PDO::PARAM_STR);
        $stmt->bindParam(":P_Acta", $P_Acta, PDO::PARAM_INT);
        $stmt->bindParam(":P_Licencia", $P_Licencia, PDO::PARAM_INT);
        $stmt->bindParam(":P_INE", $P_INE, PDO::PARAM_INT);
        $stmt->bindParam(":P_Cartilla_Militar", $P_Cartilla_Militar, PDO::PARAM_INT);
        $stmt->bindParam(":P_CURP", $P_CURP, PDO::PARAM_INT);
		$stmt->bindParam(":P_RFC", $P_RFC, PDO::PARAM_INT);
		$stmt->bindParam(":P_NSS", $P_NSS, PDO::PARAM_INT);
		$stmt->bindParam(":P_Afore", $P_Afore, PDO::PARAM_INT);
		$stmt->bindParam(":P_ComprobanteD", $P_ComprobanteD, PDO::PARAM_INT);
		$stmt->bindParam(":Redes_Sociales", $Redes_Sociales, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setCandidato($Candidato);
        }
        return $result;
    }
	
	public function duplicate(Candidatos $candidate){
		$result = false;

		$Candidato = $this->getCandidato();
		$Folio = $candidate->getCandidato();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Folio_Documentos(Candidato, Acta_Nacimiento, Licencia, INE, Cartilla_Militar, CURP, RFC, NSS, Afore, Comprobante_Domicilio, P_Acta, P_Licencia, P_INE, P_Cartilla_Militar, P_CURP, P_RFC, P_NSS, P_Afore, P_ComprobanteD, Redes_Sociales) SELECT :Candidato, Acta_Nacimiento, Licencia, INE, Cartilla_Militar, CURP, RFC, NSS, Afore, Comprobante_Domicilio, P_Acta, P_Licencia, P_INE, P_Cartilla_Militar, P_CURP, P_RFC, P_NSS, P_Afore, P_ComprobanteD, Redes_Sociales FROM rh_Candidatos_Folio_Documentos WHERE Candidato=:Folio");
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

		$stmt = $this->db->prepare("UPDATE rh_Candidatos_Folio_Documentos SET CURP=t2.CURP, RFC=t2.RFC, NSS=t2.NSS, Redes_Sociales=t2.Redes_Sociales FROM (SELECT * FROM rh_Candidatos_Folio_Documentos WHERE Candidato=:Folio) t2 WHERE rh_Candidatos_Folio_Documentos.Candidato=:Candidato");

        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    } 
}