<?php

class Facturas{

	private $Folio;
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
	private $Proxima_Gestion;

    private $db;

    public function __construct() {
        $this->db = Connection::connectSA();
	}
	
	public function getFolio(){
		return $this->Folio;
	}

	public function setFolio($Folio){
		$this->Folio = $Folio;
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

	public function getProxima_Gestion(){
		return $this->Proxima_Gestion;
	}

	public function setProxima_Gestion($Proxima_Gestion){
		$this->Proxima_Gestion = $Proxima_Gestion;
	}
	
	public function getOne(){
        $folio = $this->getFolio_Factura();
        $stmt = $this->db->prepare("SELECT Folio_Factura, CONVERT(DATE, Fecha_Emision) AS Fecha_Emision, CONVERT(Time, Fecha_Emision) AS Hora_Emision, Monto, CONVERT(DATE, Proxima_Gestion) AS Proxima_Gestion, CONVERT(DATE, Promesa_Pago) AS Promesa_Pago, Estado, Cliente, Ultima_Modificacion, Monto_IVA, Fecha_de_Pago, ID_Cliente, Razon_Social, (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) AS Ultima_Gestion, (SELECT top 1 CONVERT(DATE, Fecha) FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) AS Fecha_Ultima_Gestion FROM rh_candidatos_Facturas CF WHERE Folio_Factura=:folio");
        $stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
	}
	
	public function update() {
		$result = false;

		$Folio_Factura = $this->getFolio_Factura();
		$Fecha_Emision = $this->getFecha_Emision();
		$Razon_Social = $this->getRazon_Social();
		$Estado = $this->getEstado();
		$Promesa_Pago = $this->getPromesa_Pago();
		$Monto = $this->getMonto();
		$Monto_IVA = $this->getMonto_IVA();
		$Fecha_de_Pago = $this->getFecha_de_Pago();
		$Folio = $this->getFolio();

		$stmt = $this->db->prepare("UPDATE rh_Candidatos_Facturas SET Folio_Factura=:Folio_Factura, Fecha_Emision=:Fecha_Emision, Razon_Social=:Razon_Social, Estado=:Estado, Promesa_Pago=:Promesa_Pago, Monto=:Monto, Monto_IVA=:Monto_IVA, Fecha_de_Pago=:Fecha_de_Pago WHERE Folio_Factura=:Folio");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Emision", $Fecha_Emision, PDO::PARAM_STR);
		$stmt->bindParam(":Razon_Social", $Razon_Social, PDO::PARAM_INT);
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
		$stmt->bindParam(":Promesa_Pago", $Promesa_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Monto", $Monto, PDO::PARAM_STR);
		$stmt->bindParam(":Monto_IVA", $Monto_IVA, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_de_Pago", $Fecha_de_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_STR);
		
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setFolio_Factura($this->db->lastInsertId());
        }
        return $result;
	}

	public function updateFollowUp() {
		$result = false;

		$Folio_Factura = $this->getFolio_Factura();
		$Estado = $this->getEstado();
		$Promesa_Pago = $this->getPromesa_Pago();
		$Proxima_Gestion = $this->getProxima_Gestion();

		if ($Estado == 'Pagada') {
			$stmt = $this->db->prepare("UPDATE rh_Candidatos_Facturas SET Estado=:Estado, Promesa_Pago=:Promesa_Pago, Proxima_Gestion=:Proxima_Gestion, Fecha_de_Pago=GETDATE() WHERE Folio_Factura=:Folio_Factura");
		}else{
			$stmt = $this->db->prepare("UPDATE rh_Candidatos_Facturas SET Estado=:Estado, Promesa_Pago=:Promesa_Pago, Proxima_Gestion=:Proxima_Gestion WHERE Folio_Factura=:Folio_Factura");
		}

		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
		$stmt->bindParam(":Promesa_Pago", $Promesa_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Proxima_Gestion", $Proxima_Gestion, PDO::PARAM_STR);
		
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setFolio_Factura($this->db->lastInsertId());
        }
        return $result;
	}

	public function updateFolioYRazonDeServiciosPorFolio() {
		$result = false;

		$Folio_Factura = $this->getFolio_Factura();
		$Razon_Social = $this->getRazon_Social();
		$Folio = $this->getFolio();

		$stmt = $this->db->prepare("UPDATE rh_Candidatos SET Factura=:Folio_Factura, Razon=:Razon_Social, Estado=254 WHERE Factura=:Folio");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Razon_Social", $Razon_Social, PDO::PARAM_INT);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_STR);
		
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
	}

	public function updateSeguimientosPorFolio() {
		$result = false;

		$Folio_Factura = $this->getFolio_Factura();
		$Folio = $this->getFolio();

		$stmt = $this->db->prepare("UPDATE rh_Candidatos_Facturas_Gestiones SET Folio_Factura=:Folio_Factura  WHERE Folio_Factura=:Folio");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_STR);
		
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
	}

	public function getSeguimientosPorFolio(){
        $Folio = $this->getFolio_Factura();
        $stmt = $this->db->prepare("SELECT Fecha,Usuario,Folio_Factura,Contacto_Con,Promesa_Pago,Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=:Folio ORDER BY Fecha DESC");
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);
        $stmt->execute();
        $follow_ups = $stmt->fetchAll();
        return $follow_ups;
	}
    
    public function getFacturasPendientes(){
        $stmt = $this->db->prepare("SELECT CF.*, DATEDIFF(DAY, Fecha_Emision, GETDATE()) AS Dias_Transcurridos, E.Nombre_Empresa,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito
       FROM rh_Candidatos_Facturas CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa WHERE Estado='Pendiente de pago' ORDER BY Fecha_Emision ASC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}
	
	public function getFacturasPagadas(){
        $stmt = $this->db->prepare("SELECT CF.*, DATEDIFF(DAY, Fecha_Emision, GETDATE()) AS Dias_Transcurridos, E.Nombre_Empresa,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito
	   FROM rh_Candidatos_Facturas CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa WHERE Estado='Pagada' ORDER BY Fecha_Emision DESC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}

		public function getFacturasCanceladas(){
        $stmt = $this->db->prepare("SELECT CF.*, DATEDIFF(DAY, Fecha_Emision, GETDATE()) AS Dias_Transcurridos, E.Nombre_Empresa,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito
	   FROM rh_Candidatos_Facturas CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa WHERE Estado='Cancelada' ORDER BY Fecha_Emision DESC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}
	
    public function getServiciosPorFactura(){
		$folio = $this->getFolio_Factura();
		$stmt = $this->db->prepare("SELECT DISTINCT Folio=RC.Candidato
		,Estatus =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
		,RC.Estado
		,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
		,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,RC.Servicio
		,Nombre=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
		,[Entrega]=RC.Fecha_Entregado
		,[Fecha] = RC.Fecha
		,[Factura] = RC.Factura
		,[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado)
		,RAL = cral.Candidato
        ,RC.ID_Busqueda_RAL
	FROM rh_Candidatos RC
		INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato
        LEFT JOIN rh_Candidatos_RAL cral ON RC.Candidato=cral.Candidato
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
	
	public function getCuentasPorCobrarPorFecha(){
        $Promesa_Pago = $this->getPromesa_Pago();
        
        $stmt = $this->db->prepare("SELECT *, DATEDIFF(DAY, Fecha_Emision, GETDATE()) AS Dias_Transcurridos,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito
       FROM rh_Candidatos_Facturas CF WHERE Estado='Pendiente de pago' AND CONVERT(DATE, Promesa_Pago) = :Promesa_Pago ORDER BY Fecha_Emision ASC");
        $stmt->bindParam(":Promesa_Pago", $Promesa_Pago, PDO::PARAM_STR);
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
    }

	public function getTotalOperacionesFacturadasMensual(){
        $stmt = $this->db->prepare("SELECT COUNT(RC.Candidato) AS total FROM rh_Candidatos RC LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
		WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 AND MONTH(RF.Fecha_Emision) = MONTH(GETDATE()) AND YEAR(RF.Fecha_Emision) = YEAR(GETDATE()) AND RF.Estado <> 'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}

	public function getTotalOperacionesFacturadasMesAnterior(){
        $stmt = $this->db->prepare("SELECT COUNT(RC.Candidato) AS total FROM rh_Candidatos RC LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
		WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 AND MONTH(RF.Fecha_Emision) = MONTH(GETDATE())-1 AND YEAR(RF.Fecha_Emision) = YEAR(GETDATE()) AND RF.Estado <> 'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}

	public function getTotalOperacionesFacturadasMesTrasAnterior(){
        $stmt = $this->db->prepare("SELECT COUNT(RC.Candidato) AS total FROM rh_Candidatos RC LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
		WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 AND MONTH(RF.Fecha_Emision) = MONTH(GETDATE())-2 AND YEAR(RF.Fecha_Emision) = YEAR(GETDATE()) AND RF.Estado <> 'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}

	public function getTotalOperacionesFacturadasAnual(){
        $stmt = $this->db->prepare("SELECT COUNT(RC.Candidato) AS total FROM rh_Candidatos RC LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
		WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 AND YEAR(RF.Fecha_Emision) = YEAR(GETDATE()) AND RF.Estado <> 'Cancelada'");
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch->total;
	}

	public function facturaExiste(){
        $result = FALSE;
        $folio = $this->getFolio_Factura();
		$stmt = $this->db->prepare("SELECT TOP 1 Folio_Factura FROM rh_Candidatos_Facturas WHERE Folio_Factura = :folio", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
		$num = $stmt->rowCount();
		if ($num > 0){
			$result = $fetch->Folio_Factura;
		}
        return $result;
	}

	public function save() {
        $result = false;
		$Folio_Factura = $this->getFolio_Factura();
		$ID_Cliente = $this->getID_Cliente();
		$Cliente = $this->getCliente();
		$Razon_Social = $this->getRazon_Social();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Facturas(Folio_Factura, ID_Cliente, Cliente, Razon_Social, Fecha_Emision) VALUES (:Folio_Factura, :ID_Cliente, :Cliente, :Razon_Social, GETDATE())");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_STR);
		$stmt->bindParam(":Razon_Social", $Razon_Social, PDO::PARAM_STR);
           
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setFolio_Factura($this->db->lastInsertId());
        }
        return $result;
	}
	
	

	//============================[Ulises Febrero 17]=========================================
	public function getFacturaPendienteEmpresaPorEstatus($Empresa)
	{	
		$Estado = $this->getEstado();
		$stmt = $this->db->prepare("SELECT CF.* 
		FROM rh_Candidatos_Facturas CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa 
		WHERE E.Empresa=:Empresa AND  Estado=:Estado ORDER BY Fecha_Emision ASC");
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_STR);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);

		$stmt->execute();

		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getFolioPendienteIdCliente()
	{
		$ID_Cliente = $this->getID_Cliente();
		$stmt = $this->db->prepare("SELECT CF.* FROM rh_Candidatos_Facturas CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa WHERE CF.ID_Cliente=:ID_Cliente AND  Estado='Pendiente de pago' ORDER BY Fecha_Emision ASC");
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_STR);

		$stmt->execute();

		$fetch = $stmt->fetchAll();
		return $fetch;
	}


	public function updateEstadoFacturas()
	{
		$result = false;
		$Folio_Factura = $this->getFolio_Factura();
		$Estado = $this->getEstado();
		$Fecha_de_Pago = $this->getFecha_de_Pago();
		$ID_Cliente = $this->getID_Cliente();
		$Razon_Social = $this->getRazon_Social();

		$stmt = $this->db->prepare("UPDATE rh_Candidatos_Facturas SET ID_Cliente=:ID_Cliente, Razon_Social=:Razon_Social, Estado=:Estado,  Fecha_de_Pago=:Fecha_de_Pago WHERE Folio_Factura=:Folio_Factura");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":Fecha_de_Pago", $Fecha_de_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Razon_Social", $Razon_Social, PDO::PARAM_STR);


		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}
	
	public function updateEstadoFacturasSinCliente()
	{
		$result = false;
		$Folio_Factura = $this->getFolio_Factura();
		$Estado = $this->getEstado();
		$Fecha_de_Pago = $this->getFecha_de_Pago();
		$Razon_Social = $this->getRazon_Social();

		$stmt = $this->db->prepare("UPDATE rh_Candidatos_Facturas SET  Razon_Social=:Razon_Social, Estado=:Estado,  Fecha_de_Pago=:Fecha_de_Pago WHERE Folio_Factura=:Folio_Factura");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
		$stmt->bindParam(":Fecha_de_Pago", $Fecha_de_Pago, PDO::PARAM_STR);
		$stmt->bindParam(":Razon_Social", $Razon_Social, PDO::PARAM_STR);


		$flag = $stmt->execute();
		if ($flag) {
			$result = true;
		}
		return $result;
	}
	//==========================================================================================
	//============================[Ulises Marzo 07]=========================================

	public function getEmpresaConPorPrefacturar()
	{
		$stmt = $this->db->prepare("SELECT  ve.Empresa, UPPER( ve.Nombre_Empresa) Nombre_Empresa
		FROM rh_Candidatos RC INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
							  LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura 
							  LEFT JOIN [rh_Ventas_Alta] va on va.Cliente = rc.Cliente
							  LEFT JOIN rh_Ventas_Empresas ve on va.Empresa = ve.Empresa
		WHERE (rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 ) AND RC.Estado=252 AND (Factura <>'' AND Factura not like 'F-%')
		Group by ve.Empresa, ve.Nombre_Empresa
		ORDER BY ve.Nombre_Empresa");

		$stmt->execute();

		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getPrefacturaPorCliente()
	{
		$ID_Cliente = $this->getID_Cliente();
		$stmt = $this->db->prepare("SELECT  RC.Factura
		FROM rh_Candidatos RC INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
							  LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura 
							  LEFT JOIN [rh_Ventas_Alta] va on va.Cliente = rc.Cliente
							  LEFT JOIN rh_Ventas_Empresas ve on va.Empresa = ve.Empresa
		WHERE (rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 ) AND RC.Estado=252 AND (Factura <>'' AND Factura not like 'F-%') AND va.Cliente=:ID_Cliente
		Group by  RC.Factura
		ORDER BY  RC.Factura");
		$stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_STR);

		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	//==========================================================================================

	//============================[Ulises Marzo 21]=========================================
	public function getEmpresaSinfacturar()
	{
		$stmt = $this->db->prepare("SELECT  ve.Empresa, UPPER( ve.Nombre_Empresa) Nombre_Empresa
		FROM rh_Candidatos RC INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
							  LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura 
							  LEFT JOIN [rh_Ventas_Alta] va on va.Cliente = rc.Cliente
							  LEFT JOIN rh_Ventas_Empresas ve on va.Empresa = ve.Empresa
		WHERE (rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 ) AND RC.Estado=252 AND Factura='' 
		Group by ve.Empresa, ve.Nombre_Empresa
		ORDER BY ve.Nombre_Empresa");

		$stmt->execute();

		$fetch = $stmt->fetchAll();
		return $fetch;
	}
	//==========================================================================================
	
	public function getFacturasVencidasHoy(){
        $stmt = $this->db->prepare("SELECT *,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.Folio_Factura order by Fecha desc) as Fecha_Ultima_Gestion,
         Dias_Credito as Plazo_Credito,
		 Nombre_Cliente
       FROM rh_Candidatos_Facturas CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa WHERE Estado='Pendiente de pago' AND DATEDIFF(DAY, Fecha_Emision, GETDATE())=Dias_Credito ORDER BY Fecha_Emision ASC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}

	public function getFacturasVencimiento(){
        $stmt = $this->db->prepare("SELECT f.Fecha_Emision, f.Folio_Factura, f.Razon_Social, f.Monto, f.Monto_IVA, c.Cliente, c.Nombre_Cliente, DATEDIFF(DAY, Fecha_Emision, GETDATE()) AS Dias_Transcurridos, c.Dias_Credito, f.Fecha_Emision + c.Dias_Credito AS Fecha_Vencimiento, IIF(DATEDIFF(DAY, Fecha_Emision, GETDATE()) > c.Dias_Credito, DATEDIFF(DAY, Fecha_Emision, GETDATE()) - Dias_Credito, 0) AS Dias_Vencimiento, f.Promesa_Pago FROM rh_Candidatos_Facturas f INNER JOIN rh_Ventas_Alta c ON f.ID_Cliente=c.Cliente WHERE Estado='Pendiente de pago' AND IIF(DATEDIFF(DAY, Fecha_Emision, GETDATE()) > c.Dias_Credito, DATEDIFF(DAY, Fecha_Emision, GETDATE()) - Dias_Credito, 0) > 0 AND (f.Promesa_Pago IS NULL OR CONVERT(DATE, f.Promesa_Pago) < CONVERT(DATE, GETDATE())) ORDER BY Dias_Vencimiento DESC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}

	public function getFacturasPorVencer(){
        $stmt = $this->db->prepare("SELECT f.Fecha_Emision, f.Folio_Factura, f.Razon_Social, f.Monto, f.Monto_IVA, c.Cliente, c.Nombre_Cliente, DATEDIFF(DAY, Fecha_Emision, GETDATE()) AS Dias_Transcurridos, c.Dias_Credito, f.Fecha_Emision + c.Dias_Credito AS Fecha_Vencimiento, IIF(DATEDIFF(DAY, Fecha_Emision, GETDATE()) > c.Dias_Credito, DATEDIFF(DAY, Fecha_Emision, GETDATE()) - Dias_Credito, 0) AS Dias_Vencimiento, f.Promesa_Pago FROM rh_Candidatos_Facturas f INNER JOIN rh_Ventas_Alta c ON f.ID_Cliente=c.Cliente WHERE Estado='Pendiente de pago' AND CONVERT(DATE, (f.Fecha_Emision + c.Dias_Credito - 5)) = CONVERT(DATE, GETDATE()) AND Promesa_Pago IS NULL ORDER BY Dias_Vencimiento DESC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
	}
}