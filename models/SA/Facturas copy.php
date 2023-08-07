<?php

class Facturas{
    private $Folio_Factura;
    private $Fecha_Emision;
    private $Monto;
    private $Promesa_Pago;
    private $Estado;
    private $Cliente;
    private $Ultima_Modificacion;
    private $Monto_IVA;
    private $Fecha_de_Pago;
    private $ID_Cliente;
    private $Razon_Social;

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

	public function getFecha_Emision(){
		return $this->Fecha_Emision;
	}

	public function setFecha_Emision($Fecha_Emision){
		$this->Fecha_Emision = $Fecha_Emision;
	}

	public function getMonto(){
		return $this->Monto;
	}

	public function setMonto($Monto){
		$this->Monto = $Monto;
	}

	public function getPromesa_Pago(){
		return $this->Promesa_Pago;
	}

	public function setPromesa_Pago($Promesa_Pago){
		$this->Promesa_Pago = $Promesa_Pago;
	}

	public function getEstado(){
		return $this->Estado;
	}

	public function setEstado($Estado){
		$this->Estado = $Estado;
	}

	public function getCliente(){
		return $this->Cliente;
	}

	public function setCliente($Cliente){
		$this->Cliente = $Cliente;
	}

	public function getUltima_Modificacion(){
		return $this->Ultima_Modificacion;
	}

	public function setUltima_Modificacion($Ultima_Modificacion){
		$this->Ultima_Modificacion = $Ultima_Modificacion;
	}

	public function getMonto_IVA(){
		return $this->Monto_IVA;
	}

	public function setMonto_IVA($Monto_IVA){
		$this->Monto_IVA = $Monto_IVA;
	}

	public function getFecha_de_Pago(){
		return $this->Fecha_de_Pago;
	}

	public function setFecha_de_Pago($Fecha_de_Pago){
		$this->Fecha_de_Pago = $Fecha_de_Pago;
	}

	public function getID_Cliente(){
		return $this->ID_Cliente;
	}

	public function setID_Cliente($ID_Cliente){
		$this->ID_Cliente = $ID_Cliente;
	}

	public function getRazon_Social(){
		return $this->Razon_Social;
	}

	public function setRazon_Social($Razon_Social){
		$this->Razon_Social = $Razon_Social;
	}
	
	public function getOne(){
        $folio = $this->getFolio_Factura();
        $stmt = $this->db->prepare("SELECT Folio_Factura, CONVERT(DATE, Fecha_Emision) AS Fecha_Emision, CONVERT(Time, Fecha_Emision) AS Hora_Emision, Monto, Promesa_Pago, Estado, Cliente, Ultima_Modificacion, Monto_IVA, Fecha_de_Pago, ID_Cliente, Razon_Social FROM rh_candidatos_Facturas WHERE Folio_Factura=:folio");
        $stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    
    public function getFacturasPendientes(){
        $stmt = $this->db->prepare("SELECT *,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito
       FROM rh_Candidatos_Facturas CF WHERE Estado='Pendiente de pago' ORDER BY Fecha_Emision ASC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}
	
	public function getFacturasPagadas(){
        $stmt = $this->db->prepare("SELECT *,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito
	   FROM rh_Candidatos_Facturas CF WHERE Estado='Pagada' ORDER BY Fecha_Emision DESC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}

    public function getServiciosPorFactura(){
		$folio = $this->getFolio_Factura();
		$stmt = $this->db->prepare("SELECT Folio=RC.Candidato
		,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
		,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
		,Servicio = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,Nombre=UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno)
		,[Entrega]=RC.Fecha_Entregado
		,[Fecha] = RC.Fecha
		,[Factura] = RC.Factura
		,[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado)
	FROM rh_Candidatos RC
		INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
		 WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Factura=:folio
		ORDER BY Folio DESC");
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}
	

	public function getTotalFacturadoMensual(){
        $stmt = $this->db->prepare("SELECT ISNULL(SUM(Monto), 0) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND MONTH(Fecha_Emision) = MONTH(GETDATE()) AND Estado<>'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	
	public function getTotalCobradoMensual(){
        $stmt = $this->db->prepare("SELECT ISNULL(SUM(Monto), 0) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND MONTH(Fecha_Emision) = MONTH(GETDATE()) AND Estado='Pagada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	

	public function getTotalFacturadoMesAnterior(){
        $stmt = $this->db->prepare("SELECT SUM(Monto) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND MONTH(Fecha_Emision) = MONTH(GETDATE())-1  AND Estado<>'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	
	public function getTotalCobradoMesAnterior(){
        $stmt = $this->db->prepare("SELECT SUM(Monto) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND MONTH(Fecha_Emision) = MONTH(GETDATE())-1 AND Estado='Pagada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	

	public function getTotalFacturadoMesTrasAnterior(){
        $stmt = $this->db->prepare("SELECT SUM(Monto) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND MONTH(Fecha_Emision) = MONTH(GETDATE())-2 AND Estado<>'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	
	public function getTotalCobradoMesTrasAnterior(){
        $stmt = $this->db->prepare("SELECT SUM(Monto) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND MONTH(Fecha_Emision) = MONTH(GETDATE())-2 AND Estado='Pagada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	

	public function getTotalFacturadoDiciembre(){
        $stmt = $this->db->prepare("SELECT SUM(Monto) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE())-1 AND MONTH(Fecha_Emision) = 12  AND Estado<>'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	
	public function getTotalCobradoDiciembre(){
        $stmt = $this->db->prepare("SELECT SUM(Monto) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE())-1 AND MONTH(Fecha_Emision) = 12 AND Estado='Pagada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	

	public function getTotalFacturadoNoviembre(){
        $stmt = $this->db->prepare("SELECT SUM(Monto) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE())-1 AND MONTH(Fecha_Emision) = 11 AND Estado<>'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	
	public function getTotalCobradoNoviembre(){
        $stmt = $this->db->prepare("SELECT SUM(Monto) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE())-1 AND MONTH(Fecha_Emision) = 11 AND Estado='Pagada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	

	public function getTotalFacturadoAnual(){
        $stmt = $this->db->prepare("SELECT ISNULL(SUM(Monto), 0) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND Estado<>'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}
	
	public function getTotalCobradoAnual(){
        $stmt = $this->db->prepare("SELECT ISNULL(SUM(Monto), 0) AS total FROM rh_Candidatos_Facturas WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND Estado='Pagada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }
}