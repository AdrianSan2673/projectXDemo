<?php

class FacturasGestiones{

	private $Folio_Factura;
	private $Contacto_Con;
	private $Comentarios;
    private $Promesa_Pago;
    private $Usuario;
    private $Fecha;
	private $Proxima_Gestion;

    private $db;

    public function __construct() {
        $this->db = Connection::connectSA();
	}

    public function getFolio_Factura(){
		return $this->Folio_Factura;
	}

	public function setFolio_Factura($Folio_Factura){
		$this->Folio_Factura = $Folio_Factura;
	}

	public function getContacto_Con(){
		return $this->Contacto_Con;
	}

	public function setContacto_Con($Contacto_Con){
		$this->Contacto_Con = $Contacto_Con;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios = $Comentarios;
	}

	public function getPromesa_Pago(){
		return $this->Promesa_Pago;
	}

	public function setPromesa_Pago($Promesa_Pago){
		$this->Promesa_Pago = $Promesa_Pago;
	}

	public function getUsuario(){
		return $this->Usuario;
	}

	public function setUsuario($Usuario){
		$this->Usuario = $Usuario;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

	public function getProxima_Gestion(){
		return $this->Proxima_Gestion;
	}

	public function setProxima_Gestion($Proxima_Gestion){
		$this->Proxima_Gestion = $Proxima_Gestion;
	}

	public function create() {
        
        $result = false;

		$Folio_Factura = $this->getFolio_Factura();
		$Contacto_Con = $this->getContacto_Con();
		$Comentarios = $this->getComentarios();
		$Promesa_Pago = $this->getPromesa_Pago();
		$Usuario = $this->getUsuario();
		$Proxima_Gestion = $this->getProxima_Gestion();
        
        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Facturas_Gestiones(Folio_Factura, Contacto_Con, Comentarios, Promesa_Pago, Usuario, Fecha, Proxima_Gestion) VALUES (:Folio_Factura, :Contacto_Con, :Comentarios, :Promesa_Pago, :Usuario, GETDATE(), :Proxima_Gestion)");
        $stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Contacto_Con", $Contacto_Con, PDO::PARAM_STR);
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
		$stmt->bindParam(":Promesa_Pago", $Promesa_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
		$stmt->bindParam(":Proxima_Gestion", $Proxima_Gestion, PDO::PARAM_STR);
        
        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }
	
}