<?php

class Clientes{
 
    private $Cliente;
    private $Empresa;
    private $Nombre_Cliente;
    private $ESE;
    private $RAL;
    private $Investigacion_L;
    private $Paquetes;
    private $Plazo_Credito;
    private $Corte_Servicio;
    private $Fechas_Especificas;
    private $OC_NP;
    private $Recepcion_Facturas;
    private $Uso_Portal;
    private $Portal_Direccion;
    private $Portal_Usuario;
    private $Portal_Contraseña;
    private $Centro_Costos;
    private $Cuentas_Contacto;
    private $Cuentas_Correo;
    private $Cuentas_Telefono;
    private $Cuentas_Extension;
    private $Comentario;
    private $Fecha_Registro;
    private $Dias_Credito;
    private $Activo;
	private $Validacion_Licencia;
	private $ESE_Visita;
	private $SMART;
	private $Tiene_IL;
	private $Tiene_ESE;
	private $Tiene_SOI;
	private $Tiene_SMART;
	private $creado_por;
	private $Eliminado_por;
	private $Fecha_eliminado;

    public function __construct() {
        $this->db = Connection::connectSA();
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

	public function getNombre_Cliente(){
		return $this->Nombre_Cliente;
	}

	public function setNombre_Cliente($Nombre_Cliente){
		$this->Nombre_Cliente = $Nombre_Cliente;
	}

	public function getESE(){
		return $this->ESE;
	}

	public function setESE($ESE){
		$this->ESE = $ESE;
	}

	public function getRAL(){
		return $this->RAL;
	}

	public function setRAL($RAL){
		$this->RAL = $RAL;
	}

	public function getInvestigacion_L(){
		return $this->Investigacion_L;
	}

	public function setInvestigacion_L($Investigacion_L){
		$this->Investigacion_L = $Investigacion_L;
	}

	public function getPaquetes(){
		return $this->Paquetes;
	}

	public function setPaquetes($Paquetes){
		$this->Paquetes = $Paquetes;
	}

	public function getPlazo_Credito(){
		return $this->Plazo_Credito;
	}

	public function setPlazo_Credito($Plazo_Credito){
		$this->Plazo_Credito = $Plazo_Credito;
	}

	public function getCorte_Servicio(){
		return $this->Corte_Servicio;
	}

	public function setCorte_Servicio($Corte_Servicio){
		$this->Corte_Servicio = $Corte_Servicio;
	}

	public function getFechas_Especificas(){
		return $this->Fechas_Especificas;
	}

	public function setFechas_Especificas($Fechas_Especificas){
		$this->Fechas_Especificas = $Fechas_Especificas;
	}

	public function getOC_NP(){
		return $this->OC_NP;
	}

	public function setOC_NP($OC_NP){
		$this->OC_NP = $OC_NP;
	}

	public function getRecepcion_Facturas(){
		return $this->Recepcion_Facturas;
	}

	public function setRecepcion_Facturas($Recepcion_Facturas){
		$this->Recepcion_Facturas = $Recepcion_Facturas;
	}

	public function getUso_Portal(){
		return $this->Uso_Portal;
	}

	public function setUso_Portal($Uso_Portal){
		$this->Uso_Portal = $Uso_Portal;
	}

	public function getPortal_Direccion(){
		return $this->Portal_Direccion;
	}

	public function setPortal_Direccion($Portal_Direccion){
		$this->Portal_Direccion = $Portal_Direccion;
	}

	public function getPortal_Usuario(){
		return $this->Portal_Usuario;
	}

	public function setPortal_Usuario($Portal_Usuario){
		$this->Portal_Usuario = $Portal_Usuario;
	}

	public function getPortal_Contraseña(){
		return $this->Portal_Contraseña;
	}

	public function setPortal_Contraseña($Portal_Contraseña){
		$this->Portal_Contraseña = $Portal_Contraseña;
	}

	public function getCentro_Costos(){
		return $this->Centro_Costos;
	}

	public function setCentro_Costos($Centro_Costos){
		$this->Centro_Costos = $Centro_Costos;
	}

	public function getCuentas_Contacto(){
		return $this->Cuentas_Contacto;
	}

	public function setCuentas_Contacto($Cuentas_Contacto){
		$this->Cuentas_Contacto = $Cuentas_Contacto;
	}

	public function getCuentas_Correo(){
		return $this->Cuentas_Correo;
	}

	public function setCuentas_Correo($Cuentas_Correo){
		$this->Cuentas_Correo = $Cuentas_Correo;
	}

	public function getCuentas_Telefono(){
		return $this->Cuentas_Telefono;
	}

	public function setCuentas_Telefono($Cuentas_Telefono){
		$this->Cuentas_Telefono = $Cuentas_Telefono;
	}

	public function getCuentas_Extension(){
		return $this->Cuentas_Extension;
	}

	public function setCuentas_Extension($Cuentas_Extension){
		$this->Cuentas_Extension = $Cuentas_Extension;
	}

	public function getComentario(){
		return $this->Comentario;
	}

	public function setComentario($Comentario){
		$this->Comentario = $Comentario;
	}

	public function getFecha_Registro(){
		return $this->Fecha_Registro;
	}

	public function setFecha_Registro($Fecha_Registro){
		$this->Fecha_Registro = $Fecha_Registro;
	}

	public function getDias_Credito(){
		return $this->Dias_Credito;
	}

	public function setDias_Credito($Dias_Credito){
		$this->Dias_Credito = $Dias_Credito;
	}

	public function getActivo(){
		return $this->Activo;
	}

	public function setActivo($Activo){
		$this->Activo = $Activo;
	}

	public function getValidacion_Licencia(){
		return $this->Validacion_Licencia;
	}

	public function setValidacion_Licencia($Validacion_Licencia){
		$this->Validacion_Licencia = $Validacion_Licencia;
	}

	public function getESE_Visita(){
		return $this->ESE_Visita;
	}

	public function setESE_Visita($ESE_Visita){
		$this->ESE_Visita = $ESE_Visita;
	}
	public function getSMART()
	{
		return $this->SMART;
	}

	public function setSMART($SMART)
	{
		$this->SMART = $SMART;
	}
	
	public function getTiene_IL(){
		return $this->Tiene_IL;
	}

	public function setTiene_IL($Tiene_IL){
		$this->Tiene_IL = $Tiene_IL;
	}

	public function getTiene_ESE(){
		return $this->Tiene_ESE;
	}

	public function setTiene_ESE($Tiene_ESE){
		$this->Tiene_ESE = $Tiene_ESE;
	}

	public function getTiene_SOI(){
		return $this->Tiene_SOI;
	}

	public function setTiene_SOI($Tiene_SOI){
		$this->Tiene_SOI = $Tiene_SOI;
	}

	public function getTiene_SMART(){
		return $this->Tiene_SMART;
	}

	public function setTiene_SMART($Tiene_SMART){
		$this->Tiene_SMART = $Tiene_SMART;
	}

	public function getCreado_por()
	{
		return $this->creado_por;
	}

	public function setCreado_por($creado_por)
	{
		$this->creado_por = $creado_por;
	}

		public function getEliminado_por(){
		return $this->Eliminado_por;
	}

	public function setEliminado_por($Eliminado_por){
		$this->Eliminado_por = $Eliminado_por;
	}

	public function getFecha_eliminado(){
		return $this->Fecha_eliminado;
	}

	public function setFecha_eliminado($Fecha_eliminado){
		$this->Fecha_eliminado = $Fecha_eliminado;
	}
	
    public function getOne(){
        $Cliente=$this->getCliente();
		$stmt = $this->db->prepare(
			"SELECT *,c.creado_por as creadopor FROM rh_Ventas_Alta c INNER JOIN rh_Ventas_Empresas e ON c.Empresa=e.Empresa WHERE Cliente=:Cliente"
		);
		
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta WHERE Activo=1 ORDER BY Nombre_Cliente");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }
	
	
	public function getAllSuspender(){
        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta  ORDER BY Nombre_Cliente");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

	public function getAllClientes()
	{
		$stmt = $this->db->prepare(
			"SELECT
			RVA.creado_por,
			RVA.Fecha_Registro,
            RVE.Empresa AS ID_Empresa,
			RVE.Nombre_Empresa AS Empresa,
            RVA.Cliente,
            Nombre_Cliente,
            Centro_Costos,
            (SELECT COUNT(Candidato) FROM rh_Candidatos RC WHERE MONTH(Fecha)=MONTH(GETDATE()) AND YEAR(Fecha) =YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova'  AND RC.Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Servicios,
            (SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision)=MONTH(GETDATE()) AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente) AS Facturacion_Mes,
            (SELECT COUNT(Cliente)/(MONTH(GETDATE())) FROM rh_Candidatos RC WHERE YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Prom_Mensual,
            ROUND((SELECT ISNULL(SUM(Monto), '')/MONTH(GETDATE()) FROM rh_Candidatos_Facturas CF WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente),2) AS Prom_Fact,
            (SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente) AS Anual_Fact,
            Fecha_Ultima_Evaluacion,
            ROUND((CAST((VCE.Tiempo + VCE.Informe + VCE.Calidad + VCE.Criterio + VCE.Sistema)AS float) /5), 2) AS Calificacion
        FROM
            rh_Ventas_Alta RVA
        LEFT JOIN
            rh_Ventas_Cliente_Evaluacion VCE
        ON
            RVA.Cliente=VCE.ID_Evaluacion
        LEFT JOIN rh_Ventas_Empresas RVE ON RVE.Empresa=RVA.Empresa
        ORDER BY 
            RVA.Nombre_Cliente ASC"
		);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getAllClientesCreadoPor()
	{

		$creado_por=$this->getCreado_por();
		$stmt = $this->db->prepare(
			"SELECT
			RVA.creado_por,
			RVA.Fecha_Registro,
            RVE.Empresa AS ID_Empresa,
			RVE.Nombre_Empresa AS Empresa,
            RVA.Cliente,
            Nombre_Cliente,
            Centro_Costos,
            (SELECT COUNT(Candidato) FROM rh_Candidatos RC WHERE MONTH(Fecha)=MONTH(GETDATE()) AND YEAR(Fecha) =YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova'  AND RC.Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Servicios,
            (SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision)=MONTH(GETDATE()) AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente) AS Facturacion_Mes,
            (SELECT COUNT(Cliente)/(MONTH(GETDATE())) FROM rh_Candidatos RC WHERE YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Prom_Mensual,
            ROUND((SELECT ISNULL(SUM(Monto), '')/MONTH(GETDATE()) FROM rh_Candidatos_Facturas CF WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente),2) AS Prom_Fact,
            (SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente) AS Anual_Fact,
            Fecha_Ultima_Evaluacion,
            ROUND((CAST((VCE.Tiempo + VCE.Informe + VCE.Calidad + VCE.Criterio + VCE.Sistema)AS float) /5), 2) AS Calificacion
        FROM
            rh_Ventas_Alta RVA
        LEFT JOIN
            rh_Ventas_Cliente_Evaluacion VCE
        ON
            RVA.Cliente=VCE.ID_Evaluacion
        LEFT JOIN rh_Ventas_Empresas RVE ON RVE.Empresa=RVA.Empresa
		WHERE RVA.creado_por=:creado_por
        ORDER BY 
            RVA.Nombre_Cliente ASC"
		);

		$stmt->bindParam(":creado_por", $creado_por, PDO::PARAM_INT);

		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}
	
	public function getDetalle(){
        $stmt = $this->db->prepare("SELECT 
		RVA.Nombre_Cliente, 
		RVA.Centro_Costos,
		RVA.RAL,
		RVA.Investigacion_L,
		RVA.ESE,
		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 1 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Enero_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 1 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Enero_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 2 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Febrero_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 2 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Febrero_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 3 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Marzo_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 3 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Marzo_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 4 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Abril_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 4 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Abril_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 5 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Mayo_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 5 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Mayo_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 6 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Junio_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 6 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Junio_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 7 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Julio_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 7 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Julio_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 8 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Agosto_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 8 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Agosto_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 9 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Septiembre_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 9 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Septiembre_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 10 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Octubre_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 10 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Octubre_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 11 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Noviembre_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 11 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Noviembre_Fact,

		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE MONTH(Fecha) = 12 AND YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Diciembre_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE MONTH(Fecha_Emision) = 12 AND YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Diciembre_Fact,



		(SELECT COUNT(Cliente) FROM rh_Candidatos RC WHERE YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Anual_No,
		(SELECT ISNULL(SUM(Monto), '') FROM rh_Candidatos_Facturas CF WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Anual_Fact,
		(SELECT COUNT(Cliente)/(MONTH(GETDATE())) FROM rh_Candidatos RC WHERE YEAR(Fecha) = YEAR(GETDATE()) AND RC.Cliente=RVA.Cliente AND RC.Ejecutivo<>'miguelcasanova' AND RC.Estado<>257 AND RC.Estado<>258  AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)) AS Prom_Mensual,
		(SELECT ISNULL(SUM(Monto), '')/MONTH(GETDATE()) FROM rh_Candidatos_Facturas CF WHERE YEAR(Fecha_Emision) = YEAR(GETDATE()) AND CF.ID_Cliente=RVA.Cliente AND CF.Estado<>'Cancelada') AS Prom_Fact
	FROM 
		rh_Ventas_Alta RVA
	ORDER BY Anual_No DESC");
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

	public function getClientesPorEmpresa(){
		$Empresa = $this->getEmpresa();

        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta WHERE Empresa=:Empresa ORDER BY Nombre_Cliente");
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

	public function create()
	{
		$result = false;

		$Empresa = $this->getEmpresa();
		$Nombre_Cliente = $this->getNombre_Cliente();
		$ESE = $this->getESE();
		$RAL = $this->getRAL();
		$Investigacion_L = $this->getInvestigacion_L();
		$Paquetes = $this->getPaquetes();
		$Plazo_Credito = $this->getPlazo_Credito();
		$Corte_Servicio = $this->getCorte_Servicio();
		$Fechas_Especificas = $this->getFechas_Especificas();
		$OC_NP = $this->getOC_NP();
		$Recepcion_Facturas = $this->getRecepcion_Facturas();
		$Uso_Portal = $this->getUso_Portal();
		$Portal_Direccion = $this->getPortal_Direccion();
		$Portal_Usuario = $this->getPortal_Usuario();
		$Portal_Contraseña = $this->getPortal_Contraseña();
		$Centro_Costos = $this->getCentro_Costos();
		$Cuentas_Contacto = $this->getCuentas_Contacto();
		$Cuentas_Correo = $this->getCuentas_Correo();
		$Cuentas_Telefono = $this->getCuentas_Telefono();
		$Cuentas_Extension = $this->getCuentas_Extension();
		$Comentario = $this->getComentario();
		$Dias_Credito = $this->getDias_Credito();
		$Validacion_Licencia = $this->getValidacion_Licencia();
		$ESE_Visita = $this->getESE_Visita();

		$creado_por = $this->getCreado_por();

		$stmt = $this->db->prepare("INSERT INTO rh_Ventas_Alta (Empresa, Nombre_Cliente, ESE, RAL, Investigacion_L, Paquetes, Plazo_Credito,Corte_Servicio, Fechas_Especificas, OC_NP, Recepcion_Facturas, Uso_Portal, 
		Portal_Direccion, Portal_Usuario, Portal_Contraseña, Centro_Costos, Cuentas_Contacto, Cuentas_Correo, Cuentas_Telefono, Cuentas_Extension, Comentario, Dias_Credito, Fecha_Registro, Activo, Reclutamiento, Psicometrico, Validacion_Licencia, ESE_Visita,creado_por) VALUES (:Empresa, :Nombre_Cliente, :ESE, :RAL, :Investigacion_L, :Paquetes, :Plazo_Credito, :Corte_Servicio, :Fechas_Especificas, :OC_NP, :Recepcion_Facturas, :Uso_Portal, :Portal_Direccion, :Portal_Usuario, :Portal_Contrasena, :Centro_Costos, :Cuentas_Contacto, :Cuentas_Correo, :Cuentas_Telefono, :Cuentas_Extension, :Comentario, :Dias_Credito, GETDATE(), 1, 0, 0, :Validacion_Licencia, :ESE_Visita, :creado_por)");
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":Nombre_Cliente", $Nombre_Cliente, PDO::PARAM_STR);
		$stmt->bindParam(":ESE", $ESE, PDO::PARAM_STR);
		$stmt->bindParam(":RAL", $RAL, PDO::PARAM_STR);
		$stmt->bindParam(":Investigacion_L", $Investigacion_L, PDO::PARAM_STR);
		$stmt->bindParam(":Paquetes", $Paquetes, PDO::PARAM_STR);
		$stmt->bindParam(":Plazo_Credito", $Plazo_Credito, PDO::PARAM_STR);
		$stmt->bindParam(":Corte_Servicio", $Corte_Servicio, PDO::PARAM_INT);
		$stmt->bindParam(":Fechas_Especificas", $Fechas_Especificas, PDO::PARAM_STR);
		$stmt->bindParam(":OC_NP", $OC_NP, PDO::PARAM_STR);
		$stmt->bindParam(":Recepcion_Facturas", $Recepcion_Facturas, PDO::PARAM_STR);
		$stmt->bindParam(":Uso_Portal", $Uso_Portal, PDO::PARAM_INT);
		$stmt->bindParam(":Portal_Direccion", $Portal_Direccion, PDO::PARAM_STR);
		$stmt->bindParam(":Portal_Usuario", $Portal_Usuario, PDO::PARAM_STR);
		$stmt->bindParam(":Portal_Contrasena", $Portal_Contraseña, PDO::PARAM_STR);
		$stmt->bindParam(":Centro_Costos", $Centro_Costos, PDO::PARAM_STR);
		$stmt->bindParam(":Cuentas_Contacto", $Cuentas_Contacto, PDO::PARAM_STR);
		$stmt->bindParam(":Cuentas_Correo", $Cuentas_Correo, PDO::PARAM_STR);
		$stmt->bindParam(":Cuentas_Telefono", $Cuentas_Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Cuentas_Extension", $Cuentas_Extension, PDO::PARAM_STR);
		$stmt->bindParam(":Comentario", $Comentario, PDO::PARAM_STR);
		$stmt->bindParam(":Dias_Credito", $Dias_Credito, PDO::PARAM_INT);
		$stmt->bindParam(":Validacion_Licencia", $Validacion_Licencia, PDO::PARAM_STR);
		$stmt->bindParam(":ESE_Visita", $ESE_Visita, PDO::PARAM_STR);

		$stmt->bindParam(":creado_por", $creado_por, PDO::PARAM_STR);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
			$this->setCliente($this->db->lastInsertId());
		}
		return $result;
	}
	
	public function updateNombreCliente()
	{
		$result = false;

		$Cliente = $this->getCliente();
		$Empresa = $this->getEmpresa();
		$Nombre_Cliente = $this->getNombre_Cliente();
		$creado_por = $this->getCreado_por();

		$stmt = $this->db->prepare("UPDATE rh_Ventas_Alta SET Empresa=:Empresa, Nombre_Cliente=:Nombre_Cliente,creado_por=:creado_por WHERE Cliente=:Cliente");
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->bindParam(":Nombre_Cliente", $Nombre_Cliente, PDO::PARAM_STR);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":creado_por", $creado_por, PDO::PARAM_STR);
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function updateServicios(){
        $result = false;

		$Cliente = $this->getCliente();
		$Tiene_IL = $this->getTiene_IL();
		$Tiene_ESE = $this->getTiene_ESE();
		$Tiene_SOI = $this->getTiene_SOI();
		$Tiene_SMART = $this->getTiene_SMART();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta SET Tiene_IL=:Tiene_IL, Tiene_ESE=:Tiene_ESE, Tiene_SOI=:Tiene_SOI, Tiene_SMART=:Tiene_SMART WHERE Cliente=:Cliente");
        $stmt->bindParam(":Tiene_IL", $Tiene_IL, PDO::PARAM_INT);
        $stmt->bindParam(":Tiene_ESE", $Tiene_ESE, PDO::PARAM_INT);
		$stmt->bindParam(":Tiene_SOI", $Tiene_SOI, PDO::PARAM_INT);
		$stmt->bindParam(":Tiene_SMART", $Tiene_SMART, PDO::PARAM_INT);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateCondicionesCliente(){
        $result = false;

		$Cliente = $this->getCliente();
		$ESE = $this->getESE();
		$RAL = $this->getRAL();
		$Investigacion_L = $this->getInvestigacion_L();
		$Validacion_Licencia = $this->getValidacion_Licencia();
		$ESE_Visita = $this->getESE_Visita();
		$Paquetes = $this->getPaquetes();
		$Plazo_Credito = $this->getPlazo_Credito();
		$Dias_Credito = $this->getDias_Credito();
		$SMART = $this->getSMART();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta SET ESE=:ESE, RAL=:RAL, Investigacion_L=:Investigacion_L, Validacion_Licencia=:Validacion_Licencia, ESE_Visita=:ESE_Visita, Paquetes=:Paquetes, Plazo_Credito=:Plazo_Credito, Dias_Credito=:Dias_Credito,SMART=:SMART WHERE Cliente=:Cliente");
        $stmt->bindParam(":ESE", $ESE, PDO::PARAM_STR);
        $stmt->bindParam(":RAL", $RAL, PDO::PARAM_STR);
		$stmt->bindParam(":Investigacion_L", $Investigacion_L, PDO::PARAM_STR);
		$stmt->bindParam(":Validacion_Licencia", $Validacion_Licencia, PDO::PARAM_STR);
		$stmt->bindParam(":ESE_Visita", $ESE_Visita, PDO::PARAM_STR);
		$stmt->bindParam(":Paquetes", $Paquetes, PDO::PARAM_STR);
		$stmt->bindParam(":Plazo_Credito", $Plazo_Credito, PDO::PARAM_STR);
		$stmt->bindParam(":Dias_Credito", $Dias_Credito, PDO::PARAM_INT);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":SMART", $SMART, PDO::PARAM_INT);


        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateFacturacionCliente(){
        $result = false;

		$Cliente = $this->getCliente();
		$Corte_Servicio = $this->getCorte_Servicio();
		$Fechas_Especificas = $this->getFechas_Especificas();
		$OC_NP = $this->getOC_NP();
		$Recepcion_Facturas = $this->getRecepcion_Facturas();
		$Uso_Portal = $this->getUso_Portal();
		$Portal_Direccion = $this->getPortal_Direccion();
		$Portal_Usuario = $this->getPortal_Usuario();
		$Portal_Contraseña = $this->getPortal_Contraseña();
		$Centro_Costos = $this->getCentro_Costos();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta SET Corte_Servicio=:Corte_Servicio, Fechas_Especificas=:Fechas_Especificas, OC_NP=:OC_NP, Recepcion_Facturas=:Recepcion_Facturas, Uso_Portal=:Uso_Portal, Portal_Direccion=:Portal_Direccion, Portal_Usuario=:Portal_Usuario, Portal_Contraseña=:Portal_Contrasena, Centro_Costos=:Centro_Costos WHERE Cliente=:Cliente");
        $stmt->bindParam(":Corte_Servicio", $Corte_Servicio, PDO::PARAM_INT);
		$stmt->bindParam(":Fechas_Especificas", $Fechas_Especificas, PDO::PARAM_STR);
		$stmt->bindParam(":OC_NP", $OC_NP, PDO::PARAM_STR);
		$stmt->bindParam(":Recepcion_Facturas", $Recepcion_Facturas, PDO::PARAM_STR);
		$stmt->bindParam(":Uso_Portal", $Uso_Portal, PDO::PARAM_INT);
		$stmt->bindParam(":Portal_Direccion", $Portal_Direccion, PDO::PARAM_STR);
		$stmt->bindParam(":Portal_Usuario", $Portal_Usuario, PDO::PARAM_STR);
		$stmt->bindParam(":Portal_Contrasena", $Portal_Contraseña, PDO::PARAM_STR);
		$stmt->bindParam(":Centro_Costos", $Centro_Costos, PDO::PARAM_STR);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateCuentasCliente(){
        $result = false;

		$Cliente = $this->getCliente();
		$Cuentas_Contacto = $this->getCuentas_Contacto();
		$Cuentas_Correo = $this->getCuentas_Correo();
		$Cuentas_Telefono = $this->getCuentas_Telefono();
		$Cuentas_Extension = $this->getCuentas_Extension();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta SET Cuentas_Contacto=:Cuentas_Contacto, Cuentas_Correo=:Cuentas_Correo, Cuentas_Telefono=:Cuentas_Telefono, Cuentas_Extension=:Cuentas_Extension WHERE Cliente=:Cliente");
        $stmt->bindParam(":Cuentas_Contacto", $Cuentas_Contacto, PDO::PARAM_STR);
		$stmt->bindParam(":Cuentas_Correo", $Cuentas_Correo, PDO::PARAM_STR);
		$stmt->bindParam(":Cuentas_Telefono", $Cuentas_Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Cuentas_Extension", $Cuentas_Extension, PDO::PARAM_STR);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateComentarioCliente(){
        $result = false;

		$Cliente = $this->getCliente();
		$Comentario = $this->getComentario();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta SET Comentario=:Comentario WHERE Cliente=:Cliente");
        $stmt->bindParam(":Comentario", $Comentario, PDO::PARAM_STR);
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
	//============================[Ulises Febrero 17]=========================================
	public function getFacturaPendienteClientePorEstatus($Estado)
	{
		$Empresa = $this->getEmpresa();
		$stmt = $this->db->prepare("SELECT va.Cliente, va.Nombre_Cliente
		FROM rh_Candidatos_Facturas cf INNER JOIN rh_Ventas_Alta va on cf.ID_Cliente=va.Cliente 
		WHERE Estado=:Estado AND va.Empresa=:Empresa GROUP BY va.Cliente, va.Nombre_Cliente");
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_STR);
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);

		$stmt->execute();

		$fetch = $stmt->fetchAll();
		return $fetch;
	}
	//==========================================================================================


	//============================[Ulises Marzo 07]=========================================
	public function getClienteByEmpresaConPorPrefacturar()
	{
		$Empresa = $this->getEmpresa();
		$stmt = $this->db->prepare("SELECT va.Cliente, va.Nombre_Cliente
	FROM rh_Candidatos RC INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
						  LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura 
						  LEFT JOIN [rh_Ventas_Alta] va on va.Cliente = rc.Cliente
						  LEFT JOIN rh_Ventas_Empresas ve on va.Empresa = ve.Empresa
						  WHERE (rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 ) AND RC.Estado=252 AND (Factura <>'' AND Factura not like 'F-%') AND ve.Empresa=:Empresa
	GROUP BY va.Cliente, va.Nombre_Cliente
	ORDER BY va.Nombre_Cliente");
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getClienteByEmpresaSinPrefacturar()
	{
		$Empresa = $this->getEmpresa();
		$stmt = $this->db->prepare("SELECT va.Cliente, va.Nombre_Cliente
	FROM rh_Candidatos RC INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
						  LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura 
						  LEFT JOIN [rh_Ventas_Alta] va on va.Cliente = rc.Cliente
						  LEFT JOIN rh_Ventas_Empresas ve on va.Empresa = ve.Empresa
						  WHERE (rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 ) AND RC.Estado=252 AND Factura ='' AND ve.Empresa=:Empresa
	GROUP BY va.Cliente, va.Nombre_Cliente
	ORDER BY va.Nombre_Cliente");
		$stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function getPrefacutraPorCliente()
	{
		$Cliente = $this->getCliente();
		$stmt = $this->db->prepare("SELECT  RC.Factura, count(RC.Candidato) Numero_prefacturas
		FROM rh_Candidatos RC INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
							  LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura 
							  LEFT JOIN [rh_Ventas_Alta] va on va.Cliente = rc.Cliente
							  LEFT JOIN rh_Ventas_Empresas ve on va.Empresa = ve.Empresa
		WHERE (rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 ) AND RC.Estado=252 AND (Factura <>'' AND Factura not like 'F-%') AND va.Cliente=:Cliente
		Group by  RC.Factura
		ORDER BY  RC.Factura");
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->execute();

		$fetch = $stmt->fetchAll();
		return $fetch;
	}
	//==========================================================================================
	
		//============================[Ulises Marzo 31 Vetar cliente]===============================
	public function updateClienteActivo()
	{
		$result = false;

		$Cliente = $this->getCliente();
		$Activo = $this->getActivo();

		$stmt = $this->db->prepare("UPDATE top(1) rh_Ventas_Alta SET Activo=:Activo WHERE Cliente=:Cliente");
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":Activo", $Activo, PDO::PARAM_STR);


		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}
		return $result;
	}

	public function updateClientesActivosAll()
	{
		$result = false;
		$stmt = $this->db->prepare("UPDATE rh_Ventas_Alta SET Activo=1");
		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}
		return $result;
	}
	
	
	//==========================================================================================
	
		//====================================[Ulises 20 Junio Modulo RH]======================================================
	public function getAllClientesRH()
	{
		$stmt = $this->db->prepare(
			"SELECT
			RVA.Fecha_Registro,
			RVE.Empresa AS ID_Empresa,
			RVE.Nombre_Empresa AS Empresa,
			RVA.Cliente,
			Nombre_Cliente,
			Centro_Costos,
			RVA.Modulo_RH,
			(SELECT count(*) FROM rh_module rm WHERE rm.id_cliente=RVA.Cliente) Servicios,
			(SELECT TOP(1) p.name FROM rh_module rm INNER JOIN root.packages_RH p on rm.id_package=p.id WHERE rm.id_cliente=RVA.Cliente ORDER BY rm.id_package DESC)  Paquete,
			(SELECT TOP(1) rm.cancellation_date FROM rh_module rm WHERE rm.id_cliente=RVA.Cliente ORDER BY rm.created_at DESC) Fecha_cancelacion 
		FROM rh_Ventas_Alta RVA 
		LEFT JOIN rh_Ventas_Cliente_Evaluacion VCE 
		ON RVA.Cliente=VCE.ID_Evaluacion
		LEFT JOIN rh_Ventas_Empresas RVE 
		ON RVE.Empresa=RVA.Empresa
		ORDER BY RVA.Nombre_Cliente ASC"
		);
		$stmt->execute();
		$fetch = $stmt->fetchAll();
		return $fetch;
	}

	public function updateClienteActivoRH()
	{
		$result = false;

		$Cliente = $this->getCliente();
		$Activo = $this->getActivo();

		$stmt = $this->db->prepare("UPDATE top(1) rh_Ventas_Alta SET Modulo_RH=:Activo WHERE Cliente=:Cliente");
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":Activo", $Activo, PDO::PARAM_STR);


		$flag = $stmt->execute();

		if ($flag) {
			$result = true;
		}
		return $result;
	}
	//==========================================================================================
	
		public function saveClienteeliminado()
	{
		$Cliente = $this->getCliente();
		$Usuario = $this->getEliminado_por();

		$stmt = $this->db->prepare("INSERT INTO root.rh_Ventas_Alta_Eliminados (
			Cliente, Empresa, Nombre_Cliente, Reclutamiento, ESE, RAL, Investigacion_L, Psicometrico, Paquetes,
			Plazo_Credito, Corte_Servicio, Fechas_Especificas, OC_NP, Recepcion_Facturas, Uso_Portal, Portal_Direccion,
			Portal_Usuario, Portal_Contraseña, Centro_Costos, Cuentas_Contacto, Cuentas_Correo, Cuentas_Telefono,
			Cuentas_Extension, Comentario, Fecha_Registro, Dias_Credito, Activo, Validacion_Licencia, ESE_Visita,
			Representante_Legal, Modulo_RH, SMART, creado_por, Tiene_IL, Tiene_ESE, Tiene_SOI, Tiene_SMART, Eliminado_por,
			Fecha_eliminado
		)  Select *,:Usuario,GETDATE() from rh_Ventas_Alta where Cliente=:Cliente");
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$stmt->bindParam(":Usuario", $Usuario, PDO::PARAM_STR);
		$flag = $stmt->execute();

		return $flag;
	}

	public function eliminarCliente()
	{
		$Cliente = $this->getCliente();
		$stmt = $this->db->prepare("DELETE TOP(1) rh_Ventas_Alta where Cliente=:Cliente");
		$stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
		$flag = $stmt->execute();
		return $flag;
	}

}