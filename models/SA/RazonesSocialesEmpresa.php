<?php

class RazonesSocialesEmpresa{
    private $ID;
    private $Cliente;
    private $Empresa;
    private $Nombre_Empresa;
    private $Razon;
    private $RFC;
	private $Contacto;
	private $Otro;
	private $Direccion_Fiscal;
	private $Forma_Pago;
	private $Regimen_Fiscal;
	private $Uso_CFDI;

    private $db;

    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getID(){
		return $this->ID;
	}

	public function setID($ID){
		$this->ID = $ID;
	}

	public function getCliente(){
		return $this->Cliente;
	}

	public function setCliente($Cliente){
		$this->Cliente = $Cliente;
	}

	public function getEmpresa(){
		return $this->Empresa;
	}

	public function setEmpresa($Empresa){
		$this->Empresa = $Empresa;
	}

	public function getNombre_Empresa(){
		return $this->Nombre_Empresa;
	}

	public function setNombre_Empresa($Nombre_Empresa){
		$this->Nombre_Empresa = $Nombre_Empresa;
	}

	public function getRazon(){
		return $this->Razon;
	}

	public function setRazon($Razon){
		$this->Razon = $Razon;
	}

	public function getRFC(){
		return $this->RFC;
	}

	public function setRFC($RFC){
		$this->RFC = $RFC;
	}

	public function getContacto(){
		return $this->Contacto;
	}

	public function setContacto($Contacto){
		$this->Contacto = $Contacto;
	}

	public function getOtro(){
		return $this->Otro;
	}

	public function setOtro($Otro){
		$this->Otro = $Otro;
	}

	public function getDireccion_Fiscal(){
		return $this->Direccion_Fiscal;
	}

	public function setDireccion_Fiscal($Direccion_Fiscal){
		$this->Direccion_Fiscal = $Direccion_Fiscal;
	}

	public function getForma_Pago(){
		return $this->Forma_Pago;
	}

	public function setForma_Pago($Forma_Pago){
		$this->Forma_Pago = $Forma_Pago;
	}

	public function getRegimen_Fiscal(){
		return $this->Regimen_Fiscal;
	}

	public function setRegimen_Fiscal($Regimen_Fiscal){
		$this->Regimen_Fiscal = $Regimen_Fiscal;
	}

	public function getUso_CFDI(){
		return $this->Uso_CFDI;
	}

	public function setUso_CFDI($Uso_CFDI){
		$this->Uso_CFDI = $Uso_CFDI;
	}

    public function getOne(){
        $id = $this->getID();
        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta_Razones WHERE ID=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
	
	public function getAll(){
        $stmt = $this->db->prepare("SELECT DISTINCT Razon FROM rh_Ventas_Alta_Razones ORDER BY Razon");
        $stmt->execute();
        $business_names = $stmt->fetchAll();
        return $business_names;
    }

    public function getRazonesSocialesPorEmpresa(){
        $Empresa = $this->getEmpresa();
        $stmt = $this->db->prepare("SELECT *, ID AS ID_Razon FROM rh_Ventas_Alta_Razones WHERE Empresa=:Empresa;");
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->execute();
        $business_names = $stmt->fetchAll();
        return $business_names;
    }

	public function create(){
		$result = false;

        $Empresa = $this->getEmpresa();
		$Nombre_Empresa = $this->getNombre_Empresa();
		$Razon = $this->getRazon();
		$RFC = $this->getRFC();
		$Contacto = $this->getContacto();
		$Otro = $this->getOtro();

		$Direccion_Fiscal = $this->getDireccion_Fiscal();
		$Forma_Pago = $this->getForma_Pago();
		$Regimen_Fiscal = $this->getRegimen_Fiscal();
		$Uso_CFDI = $this->getUso_CFDI();

        $stmt = $this->db->prepare("INSERT INTO rh_Ventas_Alta_Razones(Cliente, Empresa, Nombre_Empresa, Razon, RFC, Contacto, Otro, Direccion_Fiscal, Forma_Pago, Regimen_Fiscal, Uso_CFDI) VALUES (0, :Empresa, :Nombre_Empresa, :Razon, :RFC, :Contacto, :Otro, :Direccion_Fiscal, :Forma_Pago, :Regimen_Fiscal, :Uso_CFDI)");
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre_Empresa", $Nombre_Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":Razon", $Razon, PDO::PARAM_STR);
        $stmt->bindParam(":RFC", $RFC, PDO::PARAM_STR);
        $stmt->bindParam(":Contacto", $Contacto, PDO::PARAM_STR);
        $stmt->bindParam(":Otro", $Otro, PDO::PARAM_STR);
		$stmt->bindParam(":Direccion_Fiscal", $Direccion_Fiscal, PDO::PARAM_STR);
		$stmt->bindParam(":Forma_Pago", $Forma_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Regimen_Fiscal", $Regimen_Fiscal, PDO::PARAM_STR);
		$stmt->bindParam(":Uso_CFDI", $Uso_CFDI, PDO::PARAM_STR);
		
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
			$this->setID($this->db->lastInsertId());
        }
        return $result;
    }

	public function update(){
        $result = false;

		$ID = $this->getID();
        $Empresa = $this->getEmpresa();
		$Nombre_Empresa = $this->getNombre_Empresa();
		$Razon = $this->getRazon();
		$RFC = $this->getRFC();
		$Contacto = $this->getContacto();
		$Otro = $this->getOtro();

		$Direccion_Fiscal = $this->getDireccion_Fiscal();
		$Forma_Pago = $this->getForma_Pago();
		$Regimen_Fiscal = $this->getRegimen_Fiscal();
		$Uso_CFDI = $this->getUso_CFDI();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta_Razones SET Empresa=:Empresa, Nombre_Empresa=:Nombre_Empresa, Razon=:Razon, RFC=:RFC, Contacto=:Contacto, Otro=:Otro, Direccion_Fiscal=:Direccion_Fiscal, Forma_Pago=:Forma_Pago, Regimen_Fiscal=:Regimen_Fiscal, Uso_CFDI=:Uso_CFDI WHERE ID=:ID");
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":Nombre_Empresa", $Nombre_Empresa, PDO::PARAM_STR);
		$stmt->bindParam(":Razon", $Razon, PDO::PARAM_STR);
		$stmt->bindParam(":RFC", $RFC, PDO::PARAM_STR);
		$stmt->bindParam(":Contacto", $Contacto, PDO::PARAM_STR);
		$stmt->bindParam(":Otro", $Otro, PDO::PARAM_STR);
		$stmt->bindParam(":Direccion_Fiscal", $Direccion_Fiscal, PDO::PARAM_STR);
		$stmt->bindParam(":Forma_Pago", $Forma_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Regimen_Fiscal", $Regimen_Fiscal, PDO::PARAM_STR);
		$stmt->bindParam(":Uso_CFDI", $Uso_CFDI, PDO::PARAM_STR);
		
		$stmt->bindParam(":ID", $ID, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
}