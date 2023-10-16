<?php

class CandidatosDatos{
    private $fecha_solicitud;
    private $fecha_entregado;

    //rh_Candidatos_Datos
    private $Cliente;
    private $Candidato;
    private $Nombres;
    private $Apellido_Paterno;
    private $Apellido_Materno;
    private $Nacimiento;
    private $Lugar_Nacimiento;
    private $Sexo;
    private $Fecha_Matrimonio;
    private $Nacionalidad;
    private $Estado_Civil;//
    private $Hijos;
    private $Vive_con;
    private $Telefono_fijo;
    private $Correos;
    private $Celular;
    private $Otro_Contacto;
    private $Desplazamiento;
    private $Actividad_Adicional;
    private $Continuar_estudios;
    private $Cual_Estudio;
    private $Sindicato;
    private $Cual_Sindicato;
    private $Aspiracion;
    private $Espera_Empresa;
    private $Como_entro;
    private $Accidente;
    private $Demanda_Laboral;
    private $Religion;
    private $Pasatiempos;
    private $Afiliacion_politica;
    private $Afiliacion_Club;
	private $CURP;
	private $IMSS;
	private $RFC;
	private $Domicilio;
	private $Comentario_Demanda;
	private $Tiempo;
    private $Cual_Actividad;
    private $Comentario_Contacto;
    private $Edad;
    private $Linkedin;
    private $Facebook;
    private $Numero_Licencia;

	private $db;


    public function __construct() {
        $this->db = Connection::connectSA();
    }

    public function getFecha_solicitud(){
		return $this->fecha_solicitud;
	}

	public function setFecha_solicitud($fecha_solicitud){
		$this->fecha_solicitud = $fecha_solicitud;
	}

	public function getFecha_entregado(){
		return $this->fecha_entregado;
	}

	public function setFecha_entregado($fecha_entregado){
		$this->fecha_entregado = $fecha_entregado;
	}

    public function getCliente(){
		return $this->Cliente;
	}

	public function setCliente($Cliente){
		$this->Cliente = $Cliente;
	}

	public function getCandidato(){
		return $this->Candidato;
	}

	public function setCandidato($Candidato){
		$this->Candidato = $Candidato;
	}

	public function getNombres(){
		return $this->Nombres;
	}

	public function setNombres($Nombres){
		$this->Nombres = $Nombres;
	}

	public function getApellido_Paterno(){
		return $this->Apellido_Paterno;
	}

	public function setApellido_Paterno($Apellido_Paterno){
		$this->Apellido_Paterno = $Apellido_Paterno;
	}

	public function getApellido_Materno(){
		return $this->Apellido_Materno;
	}

	public function setApellido_Materno($Apellido_Materno){
		$this->Apellido_Materno = $Apellido_Materno;
	}

	public function getNacimiento(){
		return $this->Nacimiento;
	}

	public function setNacimiento($Nacimiento){
		$this->Nacimiento = $Nacimiento;
	}

	public function getLugar_Nacimiento(){
		return $this->Lugar_Nacimiento;
	}

	public function setLugar_Nacimiento($Lugar_Nacimiento){
		$this->Lugar_Nacimiento = $Lugar_Nacimiento;
	}

	public function getSexo(){
		return $this->Sexo;
	}

	public function setSexo($Sexo){
		$this->Sexo = $Sexo;
	}

	public function getFecha_Matrimonio(){
		return $this->Fecha_Matrimonio;
	}

	public function setFecha_Matrimonio($Fecha_Matrimonio){
		$this->Fecha_Matrimonio = $Fecha_Matrimonio;
	}

	public function getNacionalidad(){
		return $this->Nacionalidad;
	}

	public function setNacionalidad($Nacionalidad){
		$this->Nacionalidad = $Nacionalidad;
	}

	public function getEstado_Civil(){
		return $this->Estado_Civil;
	}

	public function setEstado_Civil($Estado_Civil){
		$this->Estado_Civil = $Estado_Civil;
	}

	public function getHijos(){
		return $this->Hijos;
	}

	public function setHijos($Hijos){
		$this->Hijos = $Hijos;
	}

	public function getVive_con(){
		return $this->Vive_con;
	}

	public function setVive_con($Vive_con){
		$this->Vive_con = $Vive_con;
	}

	public function getTelefono_fijo(){
		return $this->Telefono_fijo;
	}

	public function setTelefono_fijo($Telefono_fijo){
		$this->Telefono_fijo = $Telefono_fijo;
	}

	public function getCorreos(){
		return $this->Correos;
	}

	public function setCorreos($Correos){
		$this->Correos = $Correos;
	}

	public function getCelular(){
		return $this->Celular;
	}

	public function setCelular($Celular){
		$this->Celular = $Celular;
	}

	public function getOtro_Contacto(){
		return $this->Otro_Contacto;
	}

	public function setOtro_Contacto($Otro_Contacto){
		$this->Otro_Contacto = $Otro_Contacto;
	}

	public function getDesplazamiento(){
		return $this->Desplazamiento;
	}

	public function setDesplazamiento($Desplazamiento){
		$this->Desplazamiento = $Desplazamiento;
	}

	public function getActividad_Adicional(){
		return $this->Actividad_Adicional;
	}

	public function setActividad_Adicional($Actividad_Adicional){
		$this->Actividad_Adicional = $Actividad_Adicional;
	}

	public function getContinuar_estudios(){
		return $this->Continuar_estudios;
	}

	public function setContinuar_estudios($Continuar_estudios){
		$this->Continuar_estudios = $Continuar_estudios;
	}

	public function getCual_Estudio(){
		return $this->Cual_Estudio;
	}

	public function setCual_Estudio($Cual_Estudio){
		$this->Cual_Estudio = $Cual_Estudio;
	}

	public function getSindicato(){
		return $this->Sindicato;
	}

	public function setSindicato($Sindicato){
		$this->Sindicato = $Sindicato;
	}

	public function getCual_Sindicato(){
		return $this->Cual_Sindicato;
	}

	public function setCual_Sindicato($Cual_Sindicato){
		$this->Cual_Sindicato = $Cual_Sindicato;
	}

	public function getAspiracion(){
		return $this->Aspiracion;
	}

	public function setAspiracion($Aspiracion){
		$this->Aspiracion = $Aspiracion;
	}

	public function getEspera_Empresa(){
		return $this->Espera_Empresa;
	}

	public function setEspera_Empresa($Espera_Empresa){
		$this->Espera_Empresa = $Espera_Empresa;
	}

	public function getComo_entro(){
		return $this->Como_entro;
	}

	public function setComo_entro($Como_entro){
		$this->Como_entro = $Como_entro;
	}

	public function getAccidente(){
		return $this->Accidente;
	}

	public function setAccidente($Accidente){
		$this->Accidente = $Accidente;
	}

	public function getDemanda_Laboral(){
		return $this->Demanda_Laboral;
	}

	public function setDemanda_Laboral($Demanda_Laboral){
		$this->Demanda_Laboral = $Demanda_Laboral;
	}

	public function getReligion(){
		return $this->Religion;
	}

	public function setReligion($Religion){
		$this->Religion = $Religion;
	}

	public function getPasatiempos(){
		return $this->Pasatiempos;
	}

	public function setPasatiempos($Pasatiempos){
		$this->Pasatiempos = $Pasatiempos;
	}

	public function getAfiliacion_politica(){
		return $this->Afiliacion_politica;
	}

	public function setAfiliacion_politica($Afiliacion_politica){
		$this->Afiliacion_politica = $Afiliacion_politica;
	}

	public function getAfiliacion_Club(){
		return $this->Afiliacion_Club;
	}

	public function setAfiliacion_Club($Afiliacion_Club){
		$this->Afiliacion_Club = $Afiliacion_Club;
	}

	public function getCURP(){
		return $this->CURP;
	}

	public function setCURP($CURP){
		$this->CURP = $CURP;
	}

	public function getIMSS(){
		return $this->IMSS;
	}

	public function setIMSS($IMSS){
		$this->IMSS = $IMSS;
	}

	public function getRFC(){
		return $this->RFC;
	}

	public function setRFC($RFC){
		$this->RFC = $RFC;
	}

	public function getDomicilio(){
		return $this->Domicilio;
	}

	public function setDomicilio($Domicilio){
		$this->Domicilio = $Domicilio;
	}

	public function getComentario_Demanda(){
		return $this->Comentario_Demanda;
	}

	public function setComentario_Demanda($Comentario_Demanda){
		$this->Comentario_Demanda = $Comentario_Demanda;
	}

	public function getTiempo(){
		return $this->Tiempo;
	}

	public function setTiempo($Tiempo){
		$this->Tiempo = $Tiempo;
	}

	public function getCual_Actividad(){
		return $this->Cual_Actividad;
	}

	public function setCual_Actividad($Cual_Actividad){
		$this->Cual_Actividad = $Cual_Actividad;
	}

	public function getComentario_Contacto(){
		return $this->Comentario_Contacto;
	}

	public function setComentario_Contacto($Comentario_Contacto){
		$this->Comentario_Contacto = $Comentario_Contacto;
	}

	public function getEdad(){
		return $this->Edad;
	}

	public function setEdad($Edad){
		$this->Edad = $Edad;
	}

	public function getLinkedin(){
		return $this->Linkedin;
	}

	public function setLinkedin($Linkedin){
		$this->Linkedin = $Linkedin;
	}

	public function getFacebook(){
		return $this->Facebook;
	}

	public function setFacebook($Facebook){
		$this->Facebook = $Facebook;
	}

	public function getNumero_Licencia(){
		return $this->Numero_Licencia;
	}

	public function setNumero_Licencia($Numero_Licencia){
		$this->Numero_Licencia = $Numero_Licencia;
	}

    public function getServiciosDeHoy(){
        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
        ,Nombre=UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno)
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Entrega]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[Fecha] = RC.Fecha
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,[Puesto] = RC.Puesto
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))  
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,[CC_Cliente] = RC.CC_Cliente
        ,[Razon] = RC.Razon
        ,[Factura] = RC.Factura
        ,[Plaza_Cliente]=RC.Plaza_Cliente
        ,[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado)
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_Aplicacion]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Viabilidad] = (select CONVERT(varchar(1), Viable) from rh_Candidatos_Obs_Generales where Candidato=Rc.Candidato)
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
         WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 and Fecha >=CONVERT (date, GETDATE())
        ORDER BY RC.Estado DESC, Folio DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosPorRangoDeFecha(){
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
        ,Nombre=UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno)
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Entrega]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[Fecha] = RC.Fecha
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,[Puesto] = RC.Puesto
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))  
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,[CC_Cliente] = RC.CC_Cliente
        ,[Razon] = RC.Razon
        ,[Factura] = RC.Factura
        ,[Plaza_Cliente]=RC.Plaza_Cliente
        ,[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado)
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_Aplicacion]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Viabilidad] = (select CONVERT(varchar(1), Viable) from rh_Candidatos_Obs_Generales where Candidato=Rc.Candidato)
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
         WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 AND CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2
        ORDER BY RC.Estado DESC, Folio DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'d ', (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado),'d ', (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado))%1440/60, 'h ') END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
    FROM rh_Candidatos AS RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova'
        ORDER BY Fecha DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }


    public function getOne(){
        $Candidato=$this->getCandidato();
        $stmt = $this->db->prepare(
            "SELECT CD.*, 
				C.*, 
				V.Nombre_Cliente,
				F.CURP,
				F.RFC,
				F.NSS AS IMSS,
				[ID_Empresa] = (SELECT Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=C.Cliente)),
				[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=C.Cliente)),
				[Especificaciones] = (SELECT Especificaciones  FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=C.Cliente)),
				[Nuevo_Procedimiento] = (SELECT Nuevo_Procedimiento FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=C.Cliente)),
				[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=C.Servicio_Solicitado),
				[Quien_Solicita] = p.Nombre,
				vc.Correo AS Correo_Cliente,
				vc.Telefono AS Telefono_Cliente,
				vc.Extension AS Extension_Cliente,
				vc.Celular AS Celular_Cliente,
				Fase = CASE WHEN C.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=C.Servicio)ELSE' -sin asignar-'END,
				Estatus = UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= C.Estado)),
				CONCAT(cu.first_name, ' ', cu.last_name) AS Analista, 
				CONCAT(lo.first_name, ' ', lo.last_name) AS Verificador,
				cu.email AS Correo_Analista,
				C.Nombre_Cliente AS Solicita,
				e.Descripcion AS EstadoMX,
				u.Estado AS id_Estado,
				V.Transportista
			FROM rh_Candidatos_Datos CD 
				INNER JOIN rh_Candidatos C 
					ON CD.Candidato=C.Candidato 
				LEFT JOIN rh_Candidatos_Folio_Documentos F
					ON CD.Candidato=F.Candidato
				LEFT JOIN rh_Ventas_Alta V 
					ON C.Cliente=V.Cliente 
				LEFT JOIN reclutamiento.dbo.users cu 
					ON cu.username=C.Ejecutivo 
				LEFT JOIN reclutamiento.dbo.users lo 
					ON lo.username=C.Gestor 
				LEFT JOIN rh_Candidatos_Ubicacion u 
					ON C.Candidato=u.Candidato
				LEFT JOIN General_Estados e 
					ON u.Estado=e.Estado
				LEFT JOIN rh_Candidatos_Personas_Solicitan p
					ON C.Nombre_Cliente=p.ID
				LEFT JOIN rh_Ventas_Alta_Contactos vc
					ON p.Usuario=vc.Usuario
			WHERE C.Candidato=:Candidato"
        );
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

	public function create(){
		$result = false;

		$Candidato = $this->getCandidato();
        $Nombres = $this->getNombres();
        $Apellido_Paterno = $this->getApellido_Paterno();
        $Apellido_Materno = $this->getApellido_Materno();
        $Nacimiento = $this->getNacimiento();
		$Lugar_Nacimiento = $this->getLugar_Nacimiento();
        $Sexo = $this->getSexo();
        $Estado_Civil = $this->getEstado_Civil();
        $Fecha_Matrimonio = $this->getFecha_Matrimonio();
        $Hijos = $this->getHijos();
        $Vive_con = $this->getVive_con();
        $Telefono_fijo = $this->getTelefono_fijo();
		$Celular = $this->getCelular();
		$Otro_Contacto = $this->getOtro_Contacto();
		$Correos = $this->getCorreos();
		$CURP = $this->getCURP();
		$IMSS = $this->getIMSS();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Datos(Candidato, Nombres, Apellido_Paterno, Apellido_Materno, Nacimiento, Lugar_Nacimiento, Sexo, Estado_Civil, Fecha_Matrimonio, Hijos, Vive_con, Telefono_fijo, Celular, Otro_Contacto, Correos, CURP, IMSS) VALUES (:Candidato, :Nombres, :Apellido_Paterno, :Apellido_Materno, :Nacimiento, :Lugar_Nacimiento, :Sexo, :Estado_Civil, :Fecha_Matrimonio, :Hijos, :Vive_con, :Telefono_fijo, :Celular, :Otro_Contacto, :Correos, :CURP, :IMSS)");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Nombres", $Nombres, PDO::PARAM_STR);
        $stmt->bindParam(":Apellido_Paterno", $Apellido_Paterno, PDO::PARAM_STR);
        $stmt->bindParam(":Apellido_Materno", $Apellido_Materno, PDO::PARAM_STR);
        $stmt->bindParam(":Nacimiento", $Nacimiento, PDO::PARAM_STR);
		$stmt->bindParam(":Lugar_Nacimiento", $Lugar_Nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(":Sexo", $Sexo, PDO::PARAM_INT);
        $stmt->bindParam(":Estado_Civil", $Estado_Civil, PDO::PARAM_INT);
        $stmt->bindParam(":Fecha_Matrimonio", $Fecha_Matrimonio, PDO::PARAM_INT);
        $stmt->bindParam(":Hijos", $Hijos, PDO::PARAM_INT);
        $stmt->bindParam(":Vive_con", $Vive_con, PDO::PARAM_STR);
        $stmt->bindParam(":Telefono_fijo", $Telefono_fijo, PDO::PARAM_STR);
        $stmt->bindParam(":Celular", $Celular, PDO::PARAM_STR);
        $stmt->bindParam(":Otro_Contacto", $Otro_Contacto, PDO::PARAM_STR);
        $stmt->bindParam(":Correos", $Correos, PDO::PARAM_STR);
		$stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
		$stmt->bindParam(":IMSS", $IMSS, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setCandidato($Candidato);
        }
        return $result;
    }   

	public function updateContacto(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Telefono_fijo = $this->getTelefono_fijo();
        $Celular = $this->getCelular();
        $Otro_Contacto = $this->getOtro_Contacto();
		$Correos = $this->getCorreos();
		$Facebook = $this->getFacebook();
		$Linkedin = $this->getLinkedin();
		$Domicilio = $this->getDomicilio();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Datos SET Telefono_fijo=:Telefono_fijo, Celular=:Celular, Otro_Contacto=:Otro_Contacto, Correos=:Correos, Facebook=:Facebook, Linkedin=:Linkedin, Domicilio=:Domicilio WHERE Candidato=:Candidato");
        $stmt->bindParam(":Telefono_fijo", $Telefono_fijo, PDO::PARAM_STR);
        $stmt->bindParam(":Celular", $Celular, PDO::PARAM_STR);
		$stmt->bindParam(":Otro_Contacto", $Otro_Contacto, PDO::PARAM_STR);
		$stmt->bindParam(":Correos", $Correos, PDO::PARAM_STR);
		$stmt->bindParam(":Facebook", $Facebook, PDO::PARAM_STR);
		$stmt->bindParam(":Linkedin", $Linkedin, PDO::PARAM_STR);
		$stmt->bindParam(":Domicilio", $Domicilio, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateDatosPersonales(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Nacimiento = $this->getNacimiento();
		$Edad = $this->getEdad();
		$Sexo = $this->getSexo();
		$Lugar_Nacimiento = $this->getLugar_Nacimiento();
		$Estado_Civil = $this->getEstado_Civil();
		$Fecha_Matrimonio = $this->getFecha_Matrimonio();
		$Hijos = $this->getHijos();
		$Nacionalidad = $this->getNacionalidad();
		$Vive_con = $this->getVive_con();
		$CURP = $this->getCURP();
		$IMSS = $this->getIMSS();
		$RFC = $this->getRFC();
		$Numero_Licencia = $this->getNumero_Licencia();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Datos SET Nacimiento=:Nacimiento, Edad=:Edad, Sexo=:Sexo, Lugar_Nacimiento=:Lugar_Nacimiento, Estado_Civil=:Estado_Civil, Fecha_Matrimonio=:Fecha_Matrimonio, Hijos=:Hijos, Nacionalidad=:Nacionalidad, Vive_con=:Vive_con, CURP=:CURP, IMSS=:IMSS, RFC=:RFC,Numero_Licencia=:Numero_Licencia WHERE Candidato=:Candidato");
        $stmt->bindParam(":Nacimiento", $Nacimiento, PDO::PARAM_STR);
		$stmt->bindParam(":Edad", $Edad, PDO::PARAM_INT);
		$stmt->bindParam(":Sexo", $Sexo, PDO::PARAM_INT);
		$stmt->bindParam(":Lugar_Nacimiento", $Lugar_Nacimiento, PDO::PARAM_STR);
		$stmt->bindParam(":Estado_Civil", $Estado_Civil, PDO::PARAM_INT);
		$stmt->bindParam(":Fecha_Matrimonio", $Fecha_Matrimonio, PDO::PARAM_STR);
		$stmt->bindParam(":Hijos", $Hijos, PDO::PARAM_INT);
		$stmt->bindParam(":Nacionalidad", $Nacionalidad, PDO::PARAM_STR);
		$stmt->bindParam(":Vive_con", $Vive_con, PDO::PARAM_STR);
		$stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
		$stmt->bindParam(":IMSS", $IMSS, PDO::PARAM_STR);
		$stmt->bindParam(":RFC", $RFC, PDO::PARAM_STR);
		$stmt->bindParam(":Numero_Licencia", $Numero_Licencia, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateName(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Nombres = $this->getNombres();
        $Apellido_Paterno = $this->getApellido_Paterno();
        $Apellido_Materno = $this->getApellido_Materno();
		
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Datos SET Nombres=:Nombres, Apellido_Paterno=:Apellido_Paterno, Apellido_Materno=:Apellido_Materno WHERE Candidato=:Candidato");
        $stmt->bindParam(":Nombres", $Nombres, PDO::PARAM_STR);
        $stmt->bindParam(":Apellido_Paterno", $Apellido_Paterno, PDO::PARAM_STR);
		$stmt->bindParam(":Apellido_Materno", $Apellido_Materno, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

	public function updateNameData(){
        $result = false;
		$Candidato = $this->getCandidato();
        $Nombres = $this->getNombres();
        $Apellido_Paterno = $this->getApellido_Paterno();
        $Apellido_Materno = $this->getApellido_Materno();
		$RFC=$this->getRFC();
		$CURP=$this->getCURP();
		$IMSS=$this->getIMSS();
		
        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Datos SET Nombres=:Nombres, Apellido_Paterno=:Apellido_Paterno, Apellido_Materno=:Apellido_Materno,RFC=:RFC,CURP=:CURP,IMSS=:IMSS WHERE Candidato=:Candidato");
        $stmt->bindParam(":Nombres", $Nombres, PDO::PARAM_STR);
        $stmt->bindParam(":Apellido_Paterno", $Apellido_Paterno, PDO::PARAM_STR);
		$stmt->bindParam(":Apellido_Materno", $Apellido_Materno, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
		$stmt->bindParam(":RFC", $RFC, PDO::PARAM_INT);
		$stmt->bindParam(":CURP", $CURP, PDO::PARAM_INT);
		$stmt->bindParam(":IMSS", $IMSS, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
	
	public function getOneCurp(){
        $result = false;
		$CURP=$this->getCURP();
        $stmt = $this->db->prepare("SELECT Candidato,Nombres,Apellido_Paterno,Apellido_Materno FROM rh_Candidatos_Datos WHERE CURP=:CURP");
        $stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();

        return $fetch;
    }

	public function getOneCurpForDuplicate(){
        $result = false;
		$CURP=$this->getCURP();
        $stmt = $this->db->prepare("SELECT TOP(1) d.Candidato, Nombres,Apellido_Paterno, Apellido_Materno FROM rh_Candidatos_Datos d INNER JOIN rh_Candidatos c ON d.Candidato=c.Candidato WHERE (Estado=252 OR Estado=254) AND (Servicio=230 OR Servicio=231 OR Servicio=299 OR Servicio=300) AND CURP=:CURP");
        $stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();

        return $fetch;
    }
	
	public function getCandidatosPorCURPoIMSS(){
		$CURP = $this->getCURP();
		$IMSS = $this->getIMSS();
		$Candidato = $this->getCandidato();
        $stmt = $this->db->prepare("SELECT c.Candidato, Nombres, Apellido_Paterno, Apellido_Materno, Fecha, IMSS, v.Nombre_Cliente, Servicio, Fase = CASE WHEN C.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=C.Servicio)ELSE' -sin asignar-' END FROM rh_Candidatos_Datos d INNER JOIN rh_Candidatos c ON d.Candidato=c.Candidato INNER JOIN rh_Ventas_Alta v ON c.Cliente=v.Cliente WHERE (CURP=:CURP OR IMSS=:IMSS) AND c.Candidato<>:Candidato");
        $stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
		$stmt->bindParam(":IMSS", $IMSS, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = $stmt->fetchAll();

        return $servicios;
    }
	
	public function updateDatosBasicos(){
        $result = false;

		$Candidato = $this->getCandidato();
        $Nacimiento = $this->getNacimiento();
		$Lugar_Nacimiento = $this->getLugar_Nacimiento();
		$Celular = $this->getCelular();
		$CURP = $this->getCURP();
		$IMSS = $this->getIMSS();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Datos SET Nacimiento=:Nacimiento, Lugar_Nacimiento=:Lugar_Nacimiento, Celular=:Celular, CURP=:CURP, IMSS=:IMSS WHERE Candidato=:Candidato");
        $stmt->bindParam(":Nacimiento", $Nacimiento, PDO::PARAM_STR);
		$stmt->bindParam(":Lugar_Nacimiento", $Lugar_Nacimiento, PDO::PARAM_STR);
		$stmt->bindParam(":Celular", $Celular, PDO::PARAM_STR);
		$stmt->bindParam(":CURP", $CURP, PDO::PARAM_STR);
		$stmt->bindParam(":IMSS", $IMSS, PDO::PARAM_STR);
		$stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }
	
	public function duplicate(Candidatos $candidate){
		$result = false;

		$Candidato = $this->getCandidato();
        $Folio = $candidate->getCandidato();

		$stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Datos(Candidato, Nombres, Apellido_Paterno, Apellido_Materno, Nacimiento, Lugar_Nacimiento, Sexo, Estado_Civil, Fecha_Matrimonio, Hijos, Vive_con, Telefono_fijo, Celular, Otro_Contacto, Correos, CURP, IMSS) SELECT :Candidato, Nombres, Apellido_Paterno, Apellido_Materno, Nacimiento, Lugar_Nacimiento, Sexo, Estado_Civil, Fecha_Matrimonio, Hijos, Vive_con, Telefono_fijo, Celular, Otro_Contacto, Correos, CURP, IMSS FROM rh_Candidatos_Datos WHERE Candidato=:Folio");

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

		$stmt = $this->db->prepare("UPDATE rh_Candidatos_Datos SET Sexo=t2.Sexo, Fecha_Matrimonio=t2.Fecha_Matrimonio, Nacionalidad=t2.Nacionalidad, Estado_Civil=t2.Estado_Civil, Hijos=t2.Hijos, Vive_con=t2.Vive_con, Correos=t2.Correos, Celular=t2.Celular, Otro_Contacto=t2.Otro_Contacto, RFC=t2.RFC, Domicilio=t2.Domicilio, Comentario_Demanda=t2.Comentario_Demanda, Comentario_Contacto=t2.Comentario_Contacto  FROM (SELECT * FROM rh_Candidatos_Datos WHERE Candidato=:Folio) t2 WHERE rh_Candidatos_Datos.Candidato=:Candidato");

        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    } 
}