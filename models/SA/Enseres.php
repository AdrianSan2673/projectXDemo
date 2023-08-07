<?php 

class Enseres{
    private $Candidato;
    private $Computadoras;
    private $Pantallas;
    private $Laptop;
    private $Refrigerador;
    private $Estufa;
    private $Aire_Acondicionado;
    private $Lavadora;
    private $Secadora;
    private $Otros;
    private $Mobiliario;
    private $Comentarios;
	private $Impresoras;

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

	public function getComputadoras(){
		return $this->Computadoras;
	}

	public function setComputadoras($Computadoras){
		$this->Computadoras = $Computadoras;
	}

	public function getPantallas(){
		return $this->Pantallas;
	}

	public function setPantallas($Pantallas){
		$this->Pantallas = $Pantallas;
	}

	public function getLaptop(){
		return $this->Laptop;
	}

	public function setLaptop($Laptop){
		$this->Laptop = $Laptop;
	}

	public function getRefrigerador(){
		return $this->Refrigerador;
	}

	public function setRefrigerador($Refrigerador){
		$this->Refrigerador = $Refrigerador;
	}

	public function getEstufa(){
		return $this->Estufa;
	}

	public function setEstufa($Estufa){
		$this->Estufa = $Estufa;
	}

	public function getAire_Acondicionado(){
		return $this->Aire_Acondicionado;
	}

	public function setAire_Acondicionado($Aire_Acondicionado){
		$this->Aire_Acondicionado = $Aire_Acondicionado;
	}

	public function getLavadora(){
		return $this->Lavadora;
	}

	public function setLavadora($Lavadora){
		$this->Lavadora = $Lavadora;
	}

	public function getSecadora(){
		return $this->Secadora;
	}

	public function setSecadora($Secadora){
		$this->Secadora = $Secadora;
	}

	public function getOtros(){
		return $this->Otros;
	}

	public function setOtros($Otros){
		$this->Otros = $Otros;
	}

	public function getMobiliario(){
		return $this->Mobiliario;
	}

	public function setMobiliario($Mobiliario){
		$this->Mobiliario = $Mobiliario;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios = $Comentarios;
	}

	public function getImpresoras(){
		return $this->impresoras;
	}

	public function setImpresoras($impresoras){
		$this->impresoras = $impresoras;
	}
        
    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT * FROM Enseres WHERE Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Computadoras = $this->getComputadoras();
        $Pantallas = $this->getPantallas();
        $Laptop = $this->getLaptop();
		$Refrigerador = $this->getRefrigerador();
        $Estufa = $this->getEstufa();
        $Aire_Acondicionado = $this->getAire_Acondicionado();
		$Lavadora = $this->getLavadora();
        $Secadora = $this->getSecadora();
        $Otros = $this->getOtros();
		$Mobiliario = $this->getMobiliario();
		$Comentarios = $this->getComentarios();
		$Impresoras = $this->getImpresoras();
		
        $stmt = $this->db->prepare("INSERT INTO Enseres(Candidato, 
		Computadoras, Pantallas, Laptop, Refrigerador, Estufa, 
	Aire_Acondicionado, Lavadora, Secadora, Otros, Mobiliario, Comentarios, Impresoras)
	VALUES (:Candidato,  :Computadoras, :Pantallas, :Laptop, :Refrigerador, :Estufa, 
	:Aire_Acondicionado, :Lavadora, :Secadora, :Otros, :Mobiliario, :Comentarios, :Impresoras)");
        $stmt->bindParam(":Computadoras", $Computadoras, PDO::PARAM_INT);
        $stmt->bindParam(":Pantallas", $Pantallas, PDO::PARAM_INT);
		$stmt->bindParam(":Laptop", $Laptop, PDO::PARAM_INT);
        $stmt->bindParam(":Refrigerador", $Refrigerador, PDO::PARAM_INT);
        $stmt->bindParam(":Estufa", $Estufa, PDO::PARAM_INT);
		$stmt->bindParam(":Aire_Acondicionado", $Aire_Acondicionado, PDO::PARAM_INT);
        $stmt->bindParam(":Lavadora", $Lavadora, PDO::PARAM_INT);
        $stmt->bindParam(":Secadora", $Secadora, PDO::PARAM_INT);
		$stmt->bindParam(":Otros", $Otros, PDO::PARAM_STR);
		$stmt->bindParam(":Mobiliario", $Mobiliario, PDO::PARAM_INT);
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
		$stmt->bindParam(":Impresoras", $Impresoras, PDO::PARAM_INT);
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
        $Computadoras = $this->getComputadoras();
        $Pantallas = $this->getPantallas();
        $Laptop = $this->getLaptop();
		$Refrigerador = $this->getRefrigerador();
        $Estufa = $this->getEstufa();
        $Aire_Acondicionado = $this->getAire_Acondicionado();
		$Lavadora = $this->getLavadora();
        $Secadora = $this->getSecadora();
        $Otros = $this->getOtros();
		$Mobiliario = $this->getMobiliario();
		$Comentarios = $this->getComentarios();
		$Impresoras = $this->getImpresoras();

        $stmt = $this->db->prepare("UPDATE Enseres
		SET Computadoras=:Computadoras
			,Pantallas=:Pantallas
			,Laptop=:Laptop
			,Refrigerador=:Refrigerador
			,Estufa=:Estufa
			,Aire_Acondicionado=:Aire_Acondicionado
			,Lavadora=:Lavadora
			,Secadora=:Secadora
			,Otros=:Otros
			,Mobiliario=:Mobiliario
			,Comentarios=:Comentarios
			,Impresoras=:Impresoras
		WHERE Candidato=:Candidato");
        $stmt->bindParam(":Computadoras", $Computadoras, PDO::PARAM_INT);
        $stmt->bindParam(":Pantallas", $Pantallas, PDO::PARAM_INT);
		$stmt->bindParam(":Laptop", $Laptop, PDO::PARAM_INT);
        $stmt->bindParam(":Refrigerador", $Refrigerador, PDO::PARAM_INT);
        $stmt->bindParam(":Estufa", $Estufa, PDO::PARAM_INT);
		$stmt->bindParam(":Aire_Acondicionado", $Aire_Acondicionado, PDO::PARAM_INT);
        $stmt->bindParam(":Lavadora", $Lavadora, PDO::PARAM_INT);
        $stmt->bindParam(":Secadora", $Secadora, PDO::PARAM_INT);
		$stmt->bindParam(":Otros", $Otros, PDO::PARAM_STR);
		$stmt->bindParam(":Mobiliario", $Mobiliario, PDO::PARAM_INT);
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
		$stmt->bindParam(":Impresoras", $Impresoras, PDO::PARAM_INT);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
}