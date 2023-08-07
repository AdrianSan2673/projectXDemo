<?php

class ValidacionLicenciaFederal {

    private $Candidato;
    private $Numero_Licencia;
    private $CategoriaA;
    private $CategoriaB;
    private $CategoriaC;
    private $CategoriaD;
    private $CategoriaE;
    private $CategoriaF;
    private $Licencia_Vigente_Del;
    private $Licencia_Vigente_Hasta;
    private $Numero_Examen;
    private $Tipo_Examen;
    private $Resultado_Examen;
    private $Fecha_Dictamen_Examen;
    private $Vigente_Hasta_Examen;
    private $Caracteristicas;
    private $Resultado;
    private $Tipo_Licencia;
    private $Estatus;
    
    private $db;
    
    public function __construct() {
        $this->db = Connection::connectSA();
        $this->CategoriaA = 0;
        $this->CategoriaB = 0;
        $this->CategoriaC = 0;
        $this->CategoriaD = 0;
        $this->CategoriaE = 0;
        $this->CategoriaF = 0;
        $this->Licencia_Vigente_Del = NULL;
        $this->Licencia_Vigente_Hasta = NULL;
        $this->Tipo_Examen = '';
        $this->Resultado_Examen = '';
        $this->Fecha_Dictamen_Examen = NULL;
        $this->Vigente_Hasta_Examen = NULL;
        $this->Caracteristicas = '';
        $this->Resultado = '';
        $this->Tipo_Licencia = 1;
        $this->Estatus = '';
    }

    public function getCandidato(){
        return $this->Candidato;
    }

    public function setCandidato($Candidato){
        $this->Candidato = $Candidato;
    }

    public function getNumero_Licencia(){
		return $this->Numero_Licencia;
	}

	public function setNumero_Licencia($Numero_Licencia){
		$this->Numero_Licencia = $Numero_Licencia;
	}

	public function getCategoriaA(){
		return $this->CategoriaA;
	}

	public function setCategoriaA($CategoriaA){
		$this->CategoriaA = $CategoriaA;
	}

	public function getCategoriaB(){
		return $this->CategoriaB;
	}

	public function setCategoriaB($CategoriaB){
		$this->CategoriaB = $CategoriaB;
	}

	public function getCategoriaC(){
		return $this->CategoriaC;
	}

	public function setCategoriaC($CategoriaC){
		$this->CategoriaC = $CategoriaC;
	}

	public function getCategoriaD(){
		return $this->CategoriaD;
	}

	public function setCategoriaD($CategoriaD){
		$this->CategoriaD = $CategoriaD;
	}

    public function getCategoriaE(){
		return $this->CategoriaE;
	}

	public function setCategoriaE($CategoriaE){
		$this->CategoriaE = $CategoriaE;
	}

	public function getCategoriaF(){
		return $this->CategoriaF;
	}

	public function setCategoriaF($CategoriaF){
		$this->CategoriaF = $CategoriaF;
	}

	public function getLicencia_Vigente_Del(){
		return $this->Licencia_Vigente_Del;
	}

	public function setLicencia_Vigente_Del($Licencia_Vigente_Del){
		$this->Licencia_Vigente_Del = $Licencia_Vigente_Del;
	}

	public function getLicencia_Vigente_Hasta(){
		return $this->Licencia_Vigente_Hasta;
	}

	public function setLicencia_Vigente_Hasta($Licencia_Vigente_Hasta){
		$this->Licencia_Vigente_Hasta = $Licencia_Vigente_Hasta;
	}

	public function getNumero_Examen(){
		return $this->Numero_Examen;
	}

	public function setNumero_Examen($Numero_Examen){
		$this->Numero_Examen = $Numero_Examen;
	}

	public function getTipo_Examen(){
		return $this->Tipo_Examen;
	}

	public function setTipo_Examen($Tipo_Examen){
		$this->Tipo_Examen = $Tipo_Examen;
	}

	public function getResultado_Examen(){
		return $this->Resultado_Examen;
	}

	public function setResultado_Examen($Resultado_Examen){
		$this->Resultado_Examen = $Resultado_Examen;
	}

	public function getFecha_Dictamen_Examen(){
		return $this->Fecha_Dictamen_Examen;
	}

	public function setFecha_Dictamen_Examen($Fecha_Dictamen_Examen){
		$this->Fecha_Dictamen_Examen = $Fecha_Dictamen_Examen;
	}

	public function getVigente_Hasta_Examen(){
		return $this->Vigente_Hasta_Examen;
	}

	public function setVigente_Hasta_Examen($Vigente_Hasta_Examen){
		$this->Vigente_Hasta_Examen = $Vigente_Hasta_Examen;
	}

	public function getCaracteristicas(){
		return $this->Caracteristicas;
	}

	public function setCaracteristicas($Caracteristicas){
		$this->Caracteristicas = $Caracteristicas;
	}

	public function getResultado(){
		return $this->Resultado;
	}

	public function setResultado($Resultado){
		$this->Resultado = $Resultado;
	}

    public function getTipo_Licencia(){
        return $this->Tipo_Licencia;
    }

    public function setTipo_Licencia($Tipo_Licencia){
        $this->Tipo_Licencia = $Tipo_Licencia;
    }

    public function getEstatus(){
        return $this->Estatus;
    }

    public function setEstatus($Estatus){
        $this->Estatus = $Estatus;
    }

    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare("SELECT *, CONVERT(varchar, Licencia_Vigente_Del,103) as Licencia_Vigente_Del, CONVERT(varchar, Licencia_Vigente_Hasta,103) as Licencia_Vigente_Hasta, CONVERT(varchar, Fecha_Dictamen_Examen,103) as Fecha_Dictamen_Examen, CONVERT(varchar, Vigente_Hasta_Examen,103) as Vigente_Hasta_Examen FROM Validacion_Licencia_Federal WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }


	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Numero_Licencia = $this->getNumero_Licencia();
        $CategoriaA = $this->getCategoriaA();
        $CategoriaB = $this->getCategoriaB();
        $CategoriaC = $this->getCategoriaC();
        $CategoriaD = $this->getCategoriaD();
        $CategoriaE = $this->getCategoriaE();
        $CategoriaF = $this->getCategoriaF();
        $Licencia_Vigente_Del = $this->getLicencia_Vigente_Del();
        $Licencia_Vigente_Hasta = $this->getLicencia_Vigente_Hasta();
        $Numero_Examen = $this->getNumero_Examen();
        $Tipo_Examen = $this->getTipo_Examen();
        $Resultado_Examen = $this->getResultado_Examen();
        $Fecha_Dictamen_Examen = $this->getFecha_Dictamen_Examen();
        $Vigente_Hasta_Examen = $this->getVigente_Hasta_Examen();
        $Caracteristicas = $this->getCaracteristicas();
        $Resultado = $this->getResultado();
        $Tipo_Licencia = $this->getTipo_Licencia();
        $Estatus = $this->getEstatus();
		
        $stmt = $this->db->prepare("INSERT INTO Validacion_Licencia_Federal (Candidato, Numero_Licencia, CategoriaA, CategoriaB, CategoriaC, CategoriaD, CategoriaE, CategoriaF, Licencia_Vigente_Del, Licencia_Vigente_Hasta, Numero_Examen, Tipo_Examen, Resultado_Examen, Fecha_Dictamen_Examen, Vigente_Hasta_Examen, Caracteristicas, Resultado, Tipo_Licencia, Estatus)
		VALUES (:Candidato, :Numero_Licencia, :CategoriaA, :CategoriaB, :CategoriaC, :CategoriaD, :CategoriaE, :CategoriaF, :Licencia_Vigente_Del, :Licencia_Vigente_Hasta, :Numero_Examen, :Tipo_Examen, :Resultado_Examen, :Fecha_Dictamen_Examen, :Vigente_Hasta_Examen, :Caracteristicas, :Resultado, :Tipo_Licencia, :Estatus)");
        $stmt->bindParam(":Numero_Licencia", $Numero_Licencia, PDO::PARAM_STR);
        $stmt->bindParam(":CategoriaA", $CategoriaA, PDO::PARAM_INT);
        $stmt->bindParam(":CategoriaB", $CategoriaB, PDO::PARAM_INT);
		$stmt->bindParam(":CategoriaC", $CategoriaC, PDO::PARAM_INT);
        $stmt->bindParam(":CategoriaD", $CategoriaD, PDO::PARAM_INT);
        $stmt->bindParam(":CategoriaE", $CategoriaE, PDO::PARAM_INT);
		$stmt->bindParam(":CategoriaF", $CategoriaF, PDO::PARAM_INT);
        $stmt->bindParam(":Licencia_Vigente_Del", $Licencia_Vigente_Del, PDO::PARAM_STR);
        $stmt->bindParam(":Licencia_Vigente_Hasta", $Licencia_Vigente_Hasta, PDO::PARAM_STR);
        $stmt->bindParam(":Numero_Examen", $Numero_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo_Examen", $Tipo_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Resultado_Examen", $Resultado_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Dictamen_Examen", $Fecha_Dictamen_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Vigente_Hasta_Examen", $Vigente_Hasta_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Caracteristicas", $Caracteristicas, PDO::PARAM_STR);
        $stmt->bindParam(":Resultado", $Resultado, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo_Licencia", $Tipo_Licencia, PDO::PARAM_INT);
        $stmt->bindParam(":Estatus", $Estatus, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateLicencia(){
        $result = false;

        $Candidato = $this->getCandidato();
        $Tipo_Licencia = $this->getTipo_Licencia();
        $Numero_Licencia = $this->getNumero_Licencia();
        $CategoriaA = $this->getCategoriaA();
        $CategoriaB = $this->getCategoriaB();
        $CategoriaC = $this->getCategoriaC();
        $CategoriaD = $this->getCategoriaD();
        $CategoriaE = $this->getCategoriaE();
        $CategoriaF = $this->getCategoriaF();
        $Licencia_Vigente_Del = $this->getLicencia_Vigente_Del();
        $Licencia_Vigente_Hasta = $this->getLicencia_Vigente_Hasta();
        $Estatus = $this->getEstatus();

        $stmt = $this->db->prepare("UPDATE Validacion_Licencia_Federal SET Numero_Licencia=:Numero_Licencia, CategoriaA=:CategoriaA, CategoriaB=:CategoriaB, CategoriaC=:CategoriaC, CategoriaD=:CategoriaD, CategoriaE=:CategoriaE, CategoriaF=:CategoriaF, Licencia_Vigente_Del=:Licencia_Vigente_Del, Licencia_Vigente_Hasta=:Licencia_Vigente_Hasta, Tipo_Licencia=:Tipo_Licencia, Estatus=:Estatus WHERE Candidato=:Candidato");
        $stmt->bindParam(":Tipo_Licencia", $Tipo_Licencia, PDO::PARAM_INT);
        $stmt->bindParam(":Numero_Licencia", $Numero_Licencia, PDO::PARAM_STR);
        $stmt->bindParam(":CategoriaA", $CategoriaA, PDO::PARAM_INT);
        $stmt->bindParam(":CategoriaB", $CategoriaB, PDO::PARAM_INT);
		$stmt->bindParam(":CategoriaC", $CategoriaC, PDO::PARAM_INT);
        $stmt->bindParam(":CategoriaD", $CategoriaD, PDO::PARAM_INT);
        $stmt->bindParam(":CategoriaE", $CategoriaE, PDO::PARAM_INT);
		$stmt->bindParam(":CategoriaF", $CategoriaF, PDO::PARAM_INT);
        $stmt->bindParam(":Licencia_Vigente_Del", $Licencia_Vigente_Del, PDO::PARAM_STR);
        $stmt->bindParam(":Licencia_Vigente_Hasta", $Licencia_Vigente_Hasta, PDO::PARAM_STR);
		$stmt->bindParam(":Estatus", $Estatus, PDO::PARAM_STR);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag)
            $result = true;

        return $result;
    }

    public function updateExamen(){
        $result = false;

        $Candidato = $this->getCandidato();
        $Numero_Examen = $this->getNumero_Examen();
        $Tipo_Examen = $this->getTipo_Examen();
        $Resultado_Examen = $this->getResultado_Examen();
        $Fecha_Dictamen_Examen = $this->getFecha_Dictamen_Examen();
        $Vigente_Hasta_Examen = $this->getVigente_Hasta_Examen();

        $stmt = $this->db->prepare("UPDATE Validacion_Licencia_Federal SET Numero_Examen=:Numero_Examen, Tipo_Examen=:Tipo_Examen, Resultado_Examen=:Resultado_Examen, Fecha_Dictamen_Examen=:Fecha_Dictamen_Examen, Vigente_Hasta_Examen=:Vigente_Hasta_Examen WHERE Candidato=:Candidato");
        $stmt->bindParam(":Numero_Examen", $Numero_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo_Examen", $Tipo_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Resultado_Examen", $Resultado_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Dictamen_Examen", $Fecha_Dictamen_Examen, PDO::PARAM_STR);
        $stmt->bindParam(":Vigente_Hasta_Examen", $Vigente_Hasta_Examen, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag)
            $result = true;
            
        return $result;
    }

    public function updateResultados(){
        $result = false;

        $Candidato = $this->getCandidato();
        $Caracteristicas = $this->getCaracteristicas();
        $Resultado = $this->getResultado();

        $stmt = $this->db->prepare("UPDATE Validacion_Licencia_Federal SET Caracteristicas=:Caracteristicas, Resultado=:Resultado WHERE Candidato=:Candidato");
        $stmt->bindParam(":Caracteristicas", $Caracteristicas, PDO::PARAM_STR);
        $stmt->bindParam(":Resultado", $Resultado, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag)
            $result = true;
            
        return $result;
    }
}