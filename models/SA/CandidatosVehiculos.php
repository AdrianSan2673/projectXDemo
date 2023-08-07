<?php
class CandidatosVehiculos{

    private $Candidato;
    private $Renglon;
    private $Marca;
    private $Modelo;
    private $Pagado;
    private $Abono_Mensual;
    private $Valor;

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

	public function getRenglon(){
		return $this->Renglon;
	}

	public function setRenglon($Renglon){
		$this->Renglon = $Renglon;
	}

	public function getMarca(){
		return $this->Marca;
	}

	public function setMarca($Marca){
		$this->Marca = $Marca;
	}

	public function getModelo(){
		return $this->Modelo;
	}

	public function setModelo($Modelo){
		$this->Modelo = $Modelo;
	}

	public function getPagado(){
		return $this->Pagado;
	}

	public function setPagado($Pagado){
		$this->Pagado = $Pagado;
	}

	public function getAbono_Mensual(){
		return $this->Abono_Mensual;
	}

	public function setAbono_Mensual($Abono_Mensual){
		$this->Abono_Mensual = $Abono_Mensual;
	}

	public function getValor(){
		return $this->Valor;
	}

	public function setValor($Valor){
		$this->Valor = $Valor;
	}
    
    public function getVehiculosPorCandidato(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Vehiculos WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

	public function getOne(){
        $Candidato=$this->getCandidato();
        $Renglon=$this->getRenglon();
        $stmt = $this->db->prepare(
            "SELECT * FROM rh_Candidatos_Vehiculos WHERE Candidato=:Candidato AND Renglon=:Renglon"
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
            "SELECT ISNULL(MAX(Renglon), 0) AS Renglon FROM rh_Candidatos_Vehiculos WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Renglon;
    }

	public function create(){
		$result = false;

		$Renglon = $this->getRenglonMax() + 1;
		$Candidato = $this->getCandidato();
        $Marca = $this->getMarca();
        $Modelo = $this->getModelo();
		$Valor = $this->getValor();
		$Pagado = $this->getPagado();
		$Abono_Mensual = $this->getAbono_Mensual();
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Vehiculos(
			Candidato, Renglon, Marca, Modelo, Pagado, Abono_Mensual,Valor)
		VALUES (:Candidato, :Renglon, :Marca, :Modelo, :Pagado, :Abono_Mensual,:Valor)");
        $stmt->bindParam(":Marca", $Marca, PDO::PARAM_STR);
        $stmt->bindParam(":Modelo", $Modelo, PDO::PARAM_STR);
		$stmt->bindParam(":Valor", $Valor, PDO::PARAM_STR);
		$stmt->bindParam(":Pagado", $Pagado, PDO::PARAM_INT);
		$stmt->bindParam(":Abono_Mensual", $Abono_Mensual, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function update(){
        $result = false;

        $Renglon = $this->getRenglon();
		$Candidato = $this->getCandidato();
		$Marca = $this->getMarca();
        $Modelo = $this->getModelo();
		$Valor = $this->getValor();
		$Pagado = $this->getPagado();
		$Abono_Mensual = $this->getAbono_Mensual();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Vehiculos SET Marca=:Marca, Modelo=:Modelo, Pagado=:Pagado, Abono_Mensual=:Abono_Mensual, Valor=:Valor WHERE Candidato=:Candidato and Renglon=:Renglon");
        $stmt->bindParam(":Marca", $Marca, PDO::PARAM_STR);
        $stmt->bindParam(":Modelo", $Modelo, PDO::PARAM_STR);
		$stmt->bindParam(":Valor", $Valor, PDO::PARAM_STR);
		$stmt->bindParam(":Pagado", $Pagado, PDO::PARAM_INT);
		$stmt->bindParam(":Abono_Mensual", $Abono_Mensual, PDO::PARAM_STR);
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
		
        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Vehiculos WHERE Candidato=:Candidato AND Renglon=:Renglon");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Renglon", $Renglon, PDO::PARAM_INT);

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
		
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Vehiculos(
			Candidato, Renglon, Marca, Modelo, Pagado, Abono_Mensual,Valor)
		SELECT :Candidato, Renglon, Marca, Modelo, Pagado, Abono_Mensual, Valor FROM rh_Candidatos_Vehiculos WHERE Candidato=:Folio");
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
}