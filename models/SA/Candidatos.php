<?php

class Candidatos
{
    private $candidato;
    private $fecha_solicitud;
    private $fecha_aplicacion;
    private $fecha_entregado;
    private $Ejecutivo;
    private $Logistica;
    private $Tipo_Investigacion;
    private $Servicio_Solicitado;
    private $Estado;
    private $Fase;
    private $Ciudad;
    private $Contacto;
    private $Razon;
    private $Puesto;
    private $Cliente;
    private $Nombre_Cliente;
    private $CC_Cliente;
    private $Enlace_Drive;
    private $Comentario_Escolaridad;
    private $Comentario_Documentos;
    private $Comentario_Economia;
    private $Comentario_Cliente;
    private $Comentario_Cancelado;
    private $Comentario_Cohabitan;
    private $Comentario_Vivienda;
    private $Comentario_Finalizacion;
    private $Factura;
    private $Foto;
    private $Plaza_Cliente;
    private $Nivel;
    private $ID_Busqueda_RAL;
    private $INFONAVIT;
    private $Reactivado;
    private $IL;
    private $ESE;
    private $A_RAL;
    private $Contactado;
    private $Fecha_Contactado;
    private $Fecha_Pausado_RAL;
    private $Fecha_Pausado_IL;
    private $Fecha_Pausado_ESE;
    private $Fecha_Reanudado_IL;
    private $Fecha_Reanudado_ESE;
    private $Comentario_Pausa;
    // ===[19 de mayo 2023 estudios]===
    private $replicado;
    // ===[19 de mayo 2023 estudios fin ]===

    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getCandidato()
    {
        return $this->candidato;
    }

    public function setCandidato($candidato)
    {
        $this->candidato = $candidato;
    }

    public function getFecha_solicitud()
    {
        return $this->fecha_solicitud;
    }

    public function setFecha_solicitud($fecha_solicitud)
    {
        $this->fecha_solicitud = $fecha_solicitud;
    }

    public function getFecha_aplicacion()
    {
        return $this->fecha_aplicacion;
    }

    public function setFecha_aplicacion($fecha_aplicacion)
    {
        $this->fecha_aplicacion = $fecha_aplicacion;
    }

    public function getFecha_entregado()
    {
        return $this->fecha_entregado;
    }

    public function setFecha_entregado($fecha_entregado)
    {
        $this->fecha_entregado = $fecha_entregado;
    }

    public function getEjecutivo()
    {
        return $this->Ejecutivo;
    }

    public function setEjecutivo($Ejecutivo)
    {
        $this->Ejecutivo = $Ejecutivo;
    }

    public function getLogistica()
    {
        return $this->Logistica;
    }

    public function setLogistica($Logistica)
    {
        $this->Logistica = $Logistica;
    }

    public function getTipo_Investigacion()
    {
        return $this->Tipo_Investigacion;
    }

    public function setTipo_Investigacion($Tipo_Investigacion)
    {
        $this->Tipo_Investigacion = $Tipo_Investigacion;
    }

    public function getServicio_Solicitado()
    {
        return $this->Servicio_Solicitado;
    }

    public function setServicio_Solicitado($Servicio_Solicitado)
    {
        $this->Servicio_Solicitado = $Servicio_Solicitado;
    }

    public function getFase()
    {
        return $this->Fase;
    }

    public function setFase($Fase)
    {
        $this->Fase = $Fase;
    }

    public function getCiudad()
    {
        return $this->Ciudad;
    }

    public function setCiudad($Ciudad)
    {
        $this->Ciudad = $Ciudad;
    }

    public function getEstado()
    {
        return $this->Estado;
    }

    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    public function getContacto()
    {
        return $this->Contacto;
    }

    public function setContacto($Contacto)
    {
        $this->Contacto = $Contacto;
    }

    public function getRazon()
    {
        return $this->Razon;
    }

    public function setRazon($Razon)
    {
        $this->Razon = $Razon;
    }

    public function getPuesto()
    {
        return $this->Puesto;
    }

    public function setPuesto($Puesto)
    {
        $this->Puesto = $Puesto;
    }

    public function getCliente()
    {
        return $this->Cliente;
    }

    public function setCliente($Cliente)
    {
        $this->Cliente = $Cliente;
    }

    public function getNombre_Cliente()
    {
        return $this->Nombre_Cliente;
    }

    public function setNombre_Cliente($Nombre_Cliente)
    {
        $this->Nombre_Cliente = $Nombre_Cliente;
    }

    public function getCC_Cliente()
    {
        return $this->CC_Cliente;
    }

    public function setCC_Cliente($CC_Cliente)
    {
        $this->CC_Cliente = $CC_Cliente;
    }

    public function getEnlace_Drive()
    {
        return $this->Enlace_Drive;
    }

    public function setEnlace_Drive($Enlace_Drive)
    {
        $this->Enlace_Drive = $Enlace_Drive;
    }

    public function getComentario_Escolaridad()
    {
        return $this->Comentario_Escolaridad;
    }

    public function setComentario_Escolaridad($Comentario_Escolaridad)
    {
        $this->Comentario_Escolaridad = $Comentario_Escolaridad;
    }

    public function getComentario_Documentos()
    {
        return $this->Comentario_Documentos;
    }

    public function setComentario_Documentos($Comentario_Documentos)
    {
        $this->Comentario_Documentos = $Comentario_Documentos;
    }

    public function getComentario_Economia()
    {
        return $this->Comentario_Economia;
    }

    public function setComentario_Economia($Comentario_Economia)
    {
        $this->Comentario_Economia = $Comentario_Economia;
    }

    public function getComentario_Cliente()
    {
        return $this->Comentario_Cliente;
    }

    public function setComentario_Cliente($Comentario_Cliente)
    {
        $this->Comentario_Cliente = $Comentario_Cliente;
    }

    public function getComentario_Cancelado()
    {
        return $this->Comentario_Cancelado;
    }

    public function setComentario_Cancelado($Comentario_Cancelado)
    {
        $this->Comentario_Cancelado = $Comentario_Cancelado;
    }

    public function getComentario_Cohabitan()
    {
        return $this->Comentario_Cohabitan;
    }

    public function setComentario_Cohabitan($Comentario_Cohabitan)
    {
        $this->Comentario_Cohabitan = $Comentario_Cohabitan;
    }

    public function getComentario_Vivienda()
    {
        return $this->Comentario_Vivienda;
    }

    public function setComentario_Vivienda($Comentario_Vivienda)
    {
        $this->Comentario_Vivienda = $Comentario_Vivienda;
    }

    public function getComentario_Finalizacion()
    {
        return $this->Comentario_Finalizacion;
    }

    public function setComentario_Finalizacion($Comentario_Finalizacion)
    {
        $this->Comentario_Finalizacion = $Comentario_Finalizacion;
    }

    public function getFactura()
    {
        return $this->Factura;
    }

    public function setFactura($Factura)
    {
        $this->Factura = $Factura;
    }

    public function getFoto()
    {
        return $this->Foto;
    }

    public function setFoto($Foto)
    {
        $this->Foto = $Foto;
    }

    public function getPlaza_Cliente()
    {
        return $this->Plaza_Cliente;
    }

    public function setPlaza_Cliente($Plaza_Cliente)
    {
        $this->Plaza_Cliente = $Plaza_Cliente;
    }

    public function getNivel()
    {
        return $this->Nivel;
    }

    public function setNivel($Nivel)
    {
        $this->Nivel = $Nivel;
    }

    public function getID_Busqueda_RAL()
    {
        return $this->ID_Busqueda_RAL;
    }

    public function setID_Busqueda_RAL($ID_Busqueda_RAL)
    {
        $this->ID_Busqueda_RAL = $ID_Busqueda_RAL;
    }

    public function getINFONAVIT()
    {
        return $this->INFONAVIT;
    }

    public function setINFONAVIT($INFONAVIT)
    {
        $this->INFONAVIT = $INFONAVIT;
    }

    public function getReactivado()
    {
        return $this->Reactivado;
    }

    public function setReactivado($Reactivado)
    {
        $this->Reactivado = $Reactivado;
    }

    public function getIL()
    {
        return $this->IL;
    }

    public function setIL($IL)
    {
        $this->IL = $IL;
    }

    public function getESE()
    {
        return $this->ESE;
    }

    public function setESE($ESE)
    {
        $this->ESE = $ESE;
    }

    public function getA_RAL()
    {
        return $this->A_RAL;
    }

    public function setA_RAL($A_RAL)
    {
        $this->A_RAL = $A_RAL;
    }

    public function getContactado()
    {
        return $this->Contactado;
    }

    public function setContactado($Contactado)
    {
        $this->Contactado = $Contactado;
    }

    public function getFecha_Contactado()
    {
        return $this->Fecha_Contactado;
    }

    public function setFecha_Contactado($Fecha_Contactado)
    {
        $this->Fecha_Contactado = $Fecha_Contactado;
    }

    public function getFecha_Pausado_RAL()
    {
        return $this->Fecha_Pausado_RAL;
    }

    public function setFecha_Pausado_RAL($Fecha_Pausado_RAL)
    {
        $this->Fecha_Pausado_RAL = $Fecha_Pausado_RAL;
    }

    public function getFecha_Pausado_IL()
    {
        return $this->Fecha_Pausado_IL;
    }

    public function setFecha_Pausado_IL($Fecha_Pausado_IL)
    {
        $this->Fecha_Pausado_IL = $Fecha_Pausado_IL;
    }

    public function getFecha_Pausado_ESE()
    {
        return $this->Fecha_Pausado_ESE;
    }

    public function setFecha_Pausado_ESE($Fecha_Pausado_ESE)
    {
        $this->Fecha_Pausado_ESE = $Fecha_Pausado_ESE;
    }

    public function getFecha_Reanudado_IL()
    {
        return $this->Fecha_Reanudado_IL;
    }

    public function setFecha_Reanudado_IL($Fecha_Reanudado_IL)
    {
        $this->Fecha_Reanudado_IL = $Fecha_Reanudado_IL;
    }

    public function getFecha_Reanudado_ESE()
    {
        return $this->Fecha_Reanudado_ESE;
    }

    public function setFecha_Reanudado_ESE($Fecha_Reanudado_ESE)
    {
        $this->Fecha_Reanudado_ESE = $Fecha_Reanudado_ESE;
    }

    public function getComentario_Pausa()
    {
        return $this->Comentario_Pausa;
    }

    public function setComentario_Pausa($Comentario_Pausa)
    {
        $this->Comentario_Pausa = $Comentario_Pausa;
    }

    // ===[19 de mayo 2023 estudios]===
    public function getReplicado()
    {
        return $this->replicado;
    }

    public function setReplicado($replicado)
    {
        $this->replicado = $replicado;
    }
    // ===[19 de mayo 2023 estudios fin ]===


    public function getMax()
    {
        $stmt = $this->db->prepare(
            "SELECT ISNULL(MAX(Candidato), 0) AS Candidato FROM rh_Candidatos"
        );
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->Candidato;
    }
    public function create()
    {
        $result = false;

        $Candidato = $this->getMax() + 1;
        $Fecha = $this->getFecha_solicitud();
        $Puesto = $this->getPuesto();
        $Ciudad = $this->getCiudad();
        $Ejecutivo = $this->getEjecutivo();
        $Razon = $this->getRazon();
        $Estado = $this->getEstado();
        $Servicio_Solicitado = $this->getServicio_Solicitado();
        $Fase = $this->getFase();
        $Cliente = $this->getCliente();
        $Nombre_Cliente = $this->getNombre_Cliente();
        $Comentario_Cliente = $this->getComentario_Cliente();
        $CC_Cliente = $this->getCC_Cliente();
        $Plaza_Cliente = $this->getPlaza_Cliente();
        $Nivel = $this->getNivel();
        // ===[19 de mayo 2023 estudios]===
        $Replicado = $this->getReplicado();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos(Candidato, Fecha, Puesto, Ciudad, Ejecutivo, Razon, Estado, Servicio_Solicitado, Servicio, Cliente, Nombre_Cliente, Viatico, Foto, Comentario_Cliente, CC_Cliente, Plaza_Cliente, Factura, Nivel, Contactado,replicado) VALUES (:Candidato, :Fecha, :Puesto, :Ciudad, :Ejecutivo, :Razon, :Estado, :Servicio_Solicitado, :Fase, :Cliente, :Nombre_Cliente, 0, 0, :Comentario_Cliente, :CC_Cliente, :Plaza_Cliente, '', :Nivel, 2,:Replicado)");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->bindParam(":Puesto", $Puesto, PDO::PARAM_INT);
        $stmt->bindParam(":Ciudad", $Ciudad, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->bindParam(":Razon", $Razon, PDO::PARAM_STR);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
        $stmt->bindParam(":Servicio_Solicitado", $Servicio_Solicitado, PDO::PARAM_INT);
        $stmt->bindParam(":Fase", $Fase, PDO::PARAM_INT);
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre_Cliente", $Nombre_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Cliente", $Comentario_Cliente, PDO::PARAM_STR);
        $stmt->bindParam(":CC_Cliente", $CC_Cliente, PDO::PARAM_STR);
        $stmt->bindParam(":Plaza_Cliente", $Plaza_Cliente, PDO::PARAM_STR);
        $stmt->bindParam(":Nivel", $Nivel, PDO::PARAM_INT);
        $stmt->bindParam(":Replicado", $Replicado, PDO::PARAM_INT);
        // ===[19 de mayo 2023 estudios fin ]===
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
            $this->setCandidato($Candidato);
        }
        return $result;
    }


    public function getServiciosDeHoy()
    {
        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,ID_Cliente = RC.Cliente
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Entrega]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Fecha] = RC.Fecha
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,[Puesto] = RC.Puesto
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))  
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP and rh_Candidatos_Datos.CURP<>'')) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,[CC_Cliente] = RC.CC_Cliente
        ,[Razon] = RC.Razon
        ,[Factura] = RC.Factura
        ,[Plaza_Cliente]=RC.Plaza_Cliente
        ,[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado)
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_MX]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Viabilidad] = (select CONVERT(varchar(1), Viable) from rh_Candidatos_Obs_Generales where Candidato=Rc.Candidato)
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,Comentario_Cliente
        ,Comentario_Cancelado
        ,ISNULL(Comentario_Finalizado, '') AS Comentario_Finalizado
        ,RC.Reactivado
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
         WHERE (rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 OR Fecha >=CONVERT (date, GETDATE())) AND (RC.Estado=250 OR RC.Estado=252 OR RC.Estado=251)
        ORDER BY Estatus DESC, Folio DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosUltimos30()
    {
        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres COLLATE Latin1_general_CI_AI =CD.Nombres COLLATE Latin1_general_CI_AI and rh_Candidatos_Datos.Apellido_Paterno COLLATE Latin1_general_CI_AI =CD.Apellido_Paterno COLLATE Latin1_general_CI_AI and rh_Candidatos_Datos.Apellido_Materno COLLATE Latin1_general_CI_AI =CD.Apellido_Materno COLLATE Latin1_general_CI_AI)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA') 
        ,RC.Factura
        ,Enlace_Drive
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,RC.Razon
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' AND Fecha >= DATEADD(DAY, -30, GETDATE())
        ORDER BY Fecha DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }


    public function getServiciosPorEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo=:Ejecutivo AND RC.Estado>=252
        ORDER BY Fecha DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosPorLogistica()
    {
        $Logistica = $this->getLogistica();
        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP and rh_Candidatos_Datos.CURP<>'')) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Gestor=:Logistica AND RC.Estado>=252
        ORDER BY Fecha DESC");
        $stmt->bindParam(":Logistica", $Logistica, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    public function getServiciosPorRangoDeFecha()
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,ID_Cliente = RC.Cliente
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Entrega]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[Fecha] = RC.Fecha
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,[Puesto] = RC.Puesto
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))  
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,[CC_Cliente] = RC.CC_Cliente
        ,[Razon] = RC.Razon
        ,[Factura] = RC.Factura
        ,[Plaza_Cliente]=RC.Plaza_Cliente
        ,[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado)
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_MX]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Viabilidad] = (select CONVERT(varchar(1), Viable) from rh_Candidatos_Obs_Generales where Candidato=Rc.Candidato)
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,RC.Reactivado
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
         WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 AND CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2
        ORDER BY Estatus DESC, RC.Candidato DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosHoyConCancelados()
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT Creado, Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Plaza_Cliente
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Puesto] = RC.Puesto
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_MX]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,RC.Razon
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,CC_Cliente
        ,Comentario_Cliente
        ,Comentario_Cancelado
        ,ISNULL(Comentario_Finalizado, '') AS Comentario_Finalizado
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 AND CONVERT(DATE,Fecha) >= CONVERT(DATE, GETDATE())
        ORDER BY RC.Fecha DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosPorRangoDeFechaConCancelados()
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT Creado, Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Plaza_Cliente
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
		,Puesto
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_MX]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
                 ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres COLLATE Latin1_general_CI_AI =CD.Nombres COLLATE Latin1_general_CI_AI and rh_Candidatos_Datos.Apellido_Paterno COLLATE Latin1_general_CI_AI =CD.Apellido_Paterno COLLATE Latin1_general_CI_AI and rh_Candidatos_Datos.Apellido_Materno COLLATE Latin1_general_CI_AI =CD.Apellido_Materno COLLATE Latin1_general_CI_AI)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA') 
        ,RC.Factura
        ,Enlace_Drive
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,RC.Razon
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
		,CC_Cliente
        ,Comentario_Cliente
        ,Comentario_Cancelado
        ,ISNULL(Comentario_Finalizado, '') AS Comentario_Finalizado
        ,ob.Viable
        ,RC.IL
        ,RC.ESE
		,RC.Factura
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
        LEFT JOIN rh_Candidatos_Obs_Generales ob ON RC.Candidato=ob.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' AND CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2
        ORDER BY RC.Fecha DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEnProceso()
    {
        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
		,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP and rh_Candidatos_Datos.CURP<>'')) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' AND rc.Estado < 252
        ORDER BY Fecha DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEnProcesoPorEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' AND rc.Estado < 252 AND RC.Ejecutivo=:Ejecutivo
        ORDER BY Fecha DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEnProcesoPorEjecutivoLogistica()
    {
        $Logistica = $this->getLogistica();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP and rh_Candidatos_Datos.CURP<>'')) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' AND rc.Estado < 252 And Servicio_Solicitado=230 AND rc.Cliente IN (SELECT ID_Cliente FROM Ejecutivos_Apoyo EA INNER JOIN rh_Candidatos_Ejecutivos_Plazas EP ON EA.Ejecutivo=EP.ID_Ejecutivo WHERE Usuario_Apoyo=:Logistica) AND rc.Gestor=''
        ORDER BY Fecha DESC");
        $stmt->bindParam(":Logistica", $Logistica, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosAgendados()
    {
        $Logistica = $this->getLogistica();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP and rh_Candidatos_Datos.CURP<>'')) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' AND rc.Estado < 252 AND RC.Servicio_Solicitado=230 AND RC.Gestor<>''
        ORDER BY Fecha_Aplicacion");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosAgendadosPorEjecutivoLogistica()
    {
        $Logistica = $this->getLogistica();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP and rh_Candidatos_Datos.CURP<>'')) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' AND rc.Estado < 252 AND RC.Gestor=:Logistica
        ORDER BY Fecha DESC");
        $stmt->bindParam(":Logistica", $Logistica, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosPorContacto()
    {
        $Contacto = $this->getContacto();
        $stmt = $this->db->prepare("SELECT TOP(7200) Folio=RC.Candidato,RC.Cliente ID_Ciente
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado_INV),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado_INV))%1440/14.4)) ELSE '' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado_ESE),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado_ESE))%1440/14.4)) ELSE '' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado))%1440/14.4)) ELSE '' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita]= (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,RC.Factura
        ,Enlace_Drive
        ,RC.CC_Cliente
        ,ob.Viable
		,RAL = cral.Candidato
        ,RC.ID_Busqueda_RAL
        ,RC.Fecha_Entregado_INV
        ,RC.Fecha_Entregado_ESE
        ,RC.replicado
		,[Cliente_Activo] = (SELECT Activo FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato
        LEFT JOIN rh_Candidatos_Obs_Generales ob ON RC.Candidato=ob.Candidato
		LEFT JOIN rh_Candidatos_RAL cral ON RC.Candidato=cral.Candidato
         WHERE RC.Cliente IN (SELECT ID_Cliente FROM rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:Contacto)
        ORDER BY RC.Fecha DESC");
        $stmt->bindParam(":Contacto", $Contacto, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosPorContactoTranspais()
    {
        $Contacto = $this->getContacto();
        $stmt = $this->db->prepare("SELECT TOP(7200) Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado_INV),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado_INV))%1440/14.4)) ELSE '' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado_ESE),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado_ESE))%1440/14.4)) ELSE '' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado))%1440/14.4)) ELSE '' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita]= (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,RC.Factura
        ,Enlace_Drive
        ,RC.CC_Cliente
        ,ob.Viable
		,RAL = cral.Candidato
        ,RC.ID_Busqueda_RAL
        ,RC.Fecha_Entregado_INV
        ,RC.Fecha_Entregado_ESE
		 ,[Cliente_Activo] = (SELECT Activo FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato
        LEFT JOIN rh_Candidatos_Obs_Generales ob ON RC.Candidato=ob.Candidato
		LEFT JOIN rh_Candidatos_RAL cral ON RC.Candidato=cral.Candidato
         WHERE RC.Cliente IN (SELECT ID_Cliente FROM rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:Contacto) AND YEAR(RC.Fecha)>=2022 
        ORDER BY RC.Fecha DESC");
        $stmt->bindParam(":Contacto", $Contacto, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosPorContacto1()
    {
        $Contacto = $this->getContacto();
        $stmt = $this->db->prepare("SELECT TOP(400) Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita]= (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,RC.Factura
        ,Enlace_Drive
        ,RC.CC_Cliente
        ,ob.Viable
		,RAL = cral.Candidato
        ,RC.ID_Busqueda_RAL
        ,RC.Fecha_Entregado_INV
        ,RC.Fecha_Entregado_ESE
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato
        LEFT JOIN rh_Candidatos_Obs_Generales ob ON RC.Candidato=ob.Candidato
		LEFT JOIN rh_Candidatos_RAL cral ON RC.Candidato=cral.Candidato
         WHERE RC.Cliente IN (SELECT ID_Cliente FROM rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:Contacto)
        ORDER BY RC.Fecha DESC");
        $stmt->bindParam(":Contacto", $Contacto, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP and rh_Candidatos_Datos.CURP<>'')) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' AND YEAR(RC.Fecha) = 2021
        ORDER BY Fecha DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getOne()
    {
        $candidato = $this->getCandidato();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,ID_Cliente = RC.Cliente
        ,Servicio = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
        ,Nombre_Candidato=UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno)
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Logistica] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Entrega]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[Fecha] = RC.Fecha
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,[Puesto] = RC.Puesto
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))  
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno) OR (rh_Candidatos_Datos.CURP=CD.CURP and rh_Candidatos_Datos.CURP<>'')) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
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
        ,RC.Comentario_Cliente
        ,RC.Comentario_Cancelado
        ,RC.Enlace_Drive
        ,RC.INFONAVIT
        ,RC.Fecha_Entregado_INV
        ,RC.Fecha_Entregado_ESE
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura 
         WHERE RC.Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $candidato, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getTime()
    {
        $candidato = $this->getCandidato();

        $stmt = $this->db->prepare("SELECT [Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
    FROM rh_Candidatos RC 
         WHERE RC.Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $candidato, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function updateConfig()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Fecha_Solicitud = $this->getFecha_solicitud();
        $Ejecutivo = $this->getEjecutivo();
        $Fecha_Entregado = $this->getFecha_entregado();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Fecha=:Fecha_Solicitud, Ejecutivo=:Ejecutivo, Fecha_Entregado=:Fecha_Entregado, Modificado=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Fecha_Solicitud", $Fecha_Solicitud, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Entregado", $Fecha_Entregado, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }
        return $result;
    }

    public function updateSchedule()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $fecha_aplicacion = $this->getFecha_aplicacion();
        $Logistica = $this->getLogistica();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Fecha_Aplicacion=:Fecha_Aplicacion, Gestor=:Logistica, Modificado=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Fecha_Aplicacion", $fecha_aplicacion, PDO::PARAM_STR);
        $stmt->bindParam(":Logistica", $Logistica, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setCandidato($this->db->lastInsertId());
        }
        return $result;
    }

    public function updateContact()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Contactado = $this->getContactado();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Contactado=:Contactado, Fecha_Contactado=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Contactado", $Contactado, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateTipoInvestigacion()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Tipo_Investigacion = $this->getTipo_Investigacion();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Tipo_Investigacion=:Tipo_Investigacion WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Tipo_Investigacion", $Tipo_Investigacion, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function getTipoServicio()
    {
        $candidato = $this->getCandidato();

        $stmt = $this->db->prepare("SELECT Fecha, Fecha_Entregado, Servicio_Solicitado,Servicio AS Fase,(SELECT Nuevo_Procedimiento FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)) as Nuevo_Procedimiento, RC.Estado, RC.Comentario_Cancelado, RC.Comentario_Finalizado, RC.Factura, RC.Comentario_Pausa FROM rh_candidatos RC WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $candidato, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function updateService()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Servicio_Solicitado = $this->getServicio_Solicitado();
        $Fase = $this->getFase();
        $Estado = $this->getEstado();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Servicio_Solicitado=:Servicio_Solicitado, Servicio=:Fase, Estado=:Estado, Modificado=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Servicio_Solicitado", $Servicio_Solicitado, PDO::PARAM_INT);
        $stmt->bindParam(":Fase", $Fase, PDO::PARAM_INT);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }
        return $result;
    }

    public function updateDatosEmpresa()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Cliente = $this->getCliente();
        $Contacto = $this->getContacto();
        $Razon = $this->getRazon();
        $Puesto = $this->getPuesto();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Cliente=:Cliente, Nombre_Cliente=:Contacto, Razon=:Razon, Puesto=:Puesto, Modificado=GETDATE() WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":Contacto", $Contacto, PDO::PARAM_INT);
        $stmt->bindParam(":Razon", $Razon, PDO::PARAM_STR);
        $stmt->bindParam(":Puesto", $Puesto, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }
        return $result;
    }

    public function updateEnlaceDrive()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Enlace_Drive = $this->getEnlace_Drive();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Enlace_Drive=:Enlace_Drive WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Enlace_Drive", $Enlace_Drive, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }
        return $result;
    }

    public function updateCiudad()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Ciudad = $this->getCiudad();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Ciudad=:Ciudad WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Ciudad", $Ciudad, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }
        return $result;
    }

    public function getComentarios()
    {
        $candidato = $this->getCandidato();

        $stmt = $this->db->prepare("SELECT RC.Comentario_Escolaridad, RC.Comentario_Documentos, RC.Comentario_Economia, RC.Comentario_Cliente, RC.Comentario_Cancelado, RC.Comentario_Cohabitan, RC.Comentario_Vivienda, RC.INFONAVIT FROM rh_candidatos RC WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $candidato, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function updateComentarioEscolaridad()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Comentario_Escolaridad = $this->getComentario_Escolaridad();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Escolaridad=:Comentario_Escolaridad WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Escolaridad", $Comentario_Escolaridad, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateComentarioCohabitan()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Comentario_Cohabitan = $this->getComentario_Cohabitan();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Cohabitan=:Comentario_Cohabitan WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Cohabitan", $Comentario_Cohabitan, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateComentarioEconomia()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Comentario_Economia = $this->getComentario_Economia();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Economia=:Comentario_Economia WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Economia", $Comentario_Economia, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateComentario_Vivienda()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Comentario_Vivienda = $this->getComentario_Vivienda();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Vivienda=:Comentario_Vivienda WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Vivienda", $Comentario_Vivienda, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateComentarioDocumentos()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Comentario_Documentos = $this->getComentario_Documentos();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Documentos=:Comentario_Documentos WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Documentos", $Comentario_Documentos, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateINFONAVIT()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $INFONAVIT = $this->getINFONAVIT();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET INFONAVIT=:INFONAVIT WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":INFONAVIT", $INFONAVIT, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function saveCancelacion()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Estado = $this->getEstado();
        $Fase = $this->getFase();
        $Comentario_Cancelado = $this->getComentario_Cancelado();

        if ($Estado == 252)
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Cancelado=:Comentario_Cancelado, Fecha_Entregado=GETDATE() WHERE Candidato=:Candidato");
        else
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Cancelado=:Comentario_Cancelado WHERE Candidato=:Candidato");

        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
        $stmt->bindParam(":Fase", $Fase, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Cancelado", $Comentario_Cancelado, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function saveFinalizacion()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Estado = $this->getEstado();
        $Fase = $this->getFase();
        $Comentario_Finalizacion = $this->getComentario_Finalizacion();

        if ($Fase == 298 || $Fase == 291) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_RAL=GETDATE(), Fecha_Entregado=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 231) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_INV=GETDATE(), Fecha_Entregado=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 232) {
            $Fase = 230;
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_INV=GETDATE(), Fecha_Entregado=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 299) {
            $Fase = 300;
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_ESE=GETDATE(), Fecha_Entregado=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 230) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_ESE=GETDATE(), Fecha_Entregado=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 300) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_INV=GETDATE(), Fecha_Entregado=GETDATE() WHERE Candidato=:Candidato");
        } else {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Servicio=:Fase, Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado=GETDATE() WHERE Candidato=:Candidato");
        }


        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
        $stmt->bindParam(":Fase", $Fase, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Finalizacion", $Comentario_Finalizacion, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function saveTerminado()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Fase = $this->getFase();
        $Comentario_Finalizacion = $this->getComentario_Finalizacion();

        if ($Fase == 231) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET  Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_INV=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 230) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_ESE=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 299) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_ESE=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 300) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_INV=GETDATE(), Servicio=300 WHERE Candidato=:Candidato");
        } elseif ($Fase == 232) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Finalizado=:Comentario_Finalizacion, Fecha_Entregado_INV=GETDATE() WHERE Candidato=:Candidato");
        }

        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Finalizacion", $Comentario_Finalizacion, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function saveAvanzar()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Estado = $this->getEstado();
        $Fase = $this->getFase();

        if ($Fase == 298) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Servicio=299, Fecha_Entregado_RAL=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 299) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Servicio=300, Fecha_Entregado_INV=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 310) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Servicio=298 WHERE Candidato=:Candidato");
        } elseif ($Fase == 300)
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Servicio=324 WHERE Candidato=:Candidato");


        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        //$stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function saveServicioSiguienteRAL()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Fecha_Solicitud = $this->getFecha_solicitud();
        $Servicio_Solicitado = $this->getServicio_Solicitado();
        $Fase = $this->getFase();
        $Puesto = $this->getPuesto();
        $Ejecutivo = $this->getEjecutivo();
        $Comentario_Cliente = $this->getComentario_Cliente();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Fecha=:Fecha, Servicio=:Fase, Servicio_Solicitado=:Servicio_Solicitado, Puesto=:Puesto, Ejecutivo=:Ejecutivo, Comentario_Cliente=:Comentario_Cliente, Estado=250, Fecha_Entregado=NULL WHERE Candidato=:Candidato");
        $stmt->bindParam(":Fecha", $Fecha_Solicitud, PDO::PARAM_STR);
        $stmt->bindParam(":Servicio_Solicitado", $Servicio_Solicitado, PDO::PARAM_INT);
        $stmt->bindParam(":Puesto", $Puesto, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->bindParam(":Comentario_Cliente", $Comentario_Cliente, PDO::PARAM_STR);
        $stmt->bindParam(":Fase", $Fase, PDO::PARAM_INT);
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function savePausa()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Estado = $this->getEstado();
        $Fase = $this->getFase();
        $Comentario_Pausa = $this->getComentario_Pausa();

        if ($Fase == 298 || $Fase == 291) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Comentario_Pausa=:Comentario_Pausa, Fecha_Pausado_RAL=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 231 || $Fase == 299) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Comentario_Pausa=:Comentario_Pausa, Fecha_Pausado_IL=GETDATE() WHERE Candidato=:Candidato");
        } elseif ($Fase == 230 || $Fase == 300) {
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Comentario_Pausa=:Comentario_Pausa, Fecha_Pausado_ESE=GETDATE() WHERE Candidato=:Candidato");
        }

        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);
        $stmt->bindParam(":Comentario_Pausa", $Comentario_Pausa, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function saveReanudar()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Estado = $this->getEstado();
        $Fase = $this->getFase();

        if ($Fase == 231 || $Fase == 299)
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Fecha_Reanudado_IL=GETDATE() WHERE Candidato=:Candidato");
        elseif ($Fase == 230 || $Fase == 300)
            $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Estado=:Estado, Fecha_Reanudado_ESE=GETDATE() WHERE Candidato=:Candidato");

        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function reactivar()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        //$Estado = $this->getEstado();
        $Fase = $this->getFase();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Servicio=:Fase, Fecha=GETDATE(), Fecha_Entregado=NULL, Estado=250, Reactivado=2 WHERE Candidato=:Candidato");

        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Fase", $Fase, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function eliminar()
    {

        $result = false;

        $Candidato = $this->getCandidato();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Ejecutivo='miguelcasanova', Cliente=6 WHERE Candidato=:Candidato");

        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function duplicate()
    {
        $result = false;

        $Candidato = $this->getMax() + 1;
        $Folio = $this->getCandidato();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos(Candidato, Fecha, Puesto, Ciudad, Ejecutivo, Razon, Estado, Servicio_Solicitado, Servicio, Cliente, Nombre_Cliente, Viatico, Foto, Comentario_Cliente, CC_Cliente, Plaza_Cliente, Factura, Nivel) SELECT :Candidato, GETDATE(), Puesto, Ciudad, Ejecutivo, Razon, Estado, Servicio_Solicitado, Fase, Cliente, Nombre_Cliente, 0, 0, Comentario_Cliente, CC_Cliente, Plaza_Cliente, '', Nivel FROM rh_Candidatos WHERE Candidato=:Folio");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function copiarInfo($duplicado)
    {
        $result = false;

        $Candidato = $this->getCandidato();
        $Folio = $duplicado;

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Comentario_Escolaridad=t2.Comentario_Escolaridad, Comentario_Documentos=t2.Comentario_Documentos, Comentario_Economia=t2.Comentario_Economia, Comentario_Cohabitan=t2.Comentario_Cohabitan, Comentario_Vivienda=t2.Comentario_Vivienda FROM (SELECT * FROM rh_Candidatos WHERE Candidato=:Folio) t2 WHERE	rh_Candidatos.Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Folio", $Folio, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function updateFactura()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Estado = $this->getEstado();
        $Factura = $this->getFactura();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Factura=:Factura, Estado=:Estado WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Factura", $Factura, PDO::PARAM_STR);
        $stmt->bindParam(":Estado", $Estado, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setId($this->db->lastInsertId());
        }
        return $result;
    }

    public function updateFoto()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $Foto = $this->getFoto();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET Foto=:Foto WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Foto", $Foto, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;

        return $result;
    }

    public function updateBusquedaRAL()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $ID_Busqueda_RAL = $this->getID_Busqueda_RAL();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET ID_Busqueda_RAL=:ID_Busqueda_RAL WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Busqueda_RAL", $ID_Busqueda_RAL, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateIL()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $IL = $this->getIL();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET IL=:IL WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":IL", $IL, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateESE()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $ESE = $this->getESE();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET ESE=:ESE WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":ESE", $ESE, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function updateARAL()
    {

        $result = false;

        $Candidato = $this->getCandidato();
        $A_RAL = $this->getA_RAL();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos SET A_RAL=:A_RAL WHERE Candidato=:Candidato");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":A_RAL", $A_RAL, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag)
            $result = true;
        return $result;
    }

    public function getTotalServiciosPorDia()
    {
        $Fecha = $this->getFecha_solicitud();
        /* $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)"); */
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 AND ESE IS NULL AND IL IS NULL");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalRALESPorDia()
    {
        $Fecha = $this->getFecha_solicitud();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Ejecutivo<>'miguelcasanova' AND (Servicio_Solicitado=298 OR Servicio_Solicitado=291 OR Servicio_Solicitado=328) AND ESE IS NULL AND IL IS NULL");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalInvPorDia()
    {
        $Fecha = $this->getFecha_solicitud();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=231");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalESESPorDia()
    {
        $Fecha = $this->getFecha_solicitud();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=230 AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }




    public function getTotalServiciosPorDiaYEjecutivo()
    {
        $Fecha = $this->getFecha_solicitud();
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalRALESPorDiaYEjecutivo()
    {
        $Fecha = $this->getFecha_solicitud();
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Servicio_Solicitado=298 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalInvPorDiaYEjecutivo()
    {
        $Fecha = $this->getFecha_solicitud();
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Servicio_Solicitado=231 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalESESPorDiaYEjecutivo()
    {
        $Fecha = $this->getFecha_solicitud();
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE CONVERT(date, Fecha)=CONVERT(date, :Fecha) AND Servicio_Solicitado=230 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Fecha", $Fecha, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }




    public function getTotalServiciosEnProceso()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Estado < 252 AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalRALESEnProceso()
    {
        $stmt = $this->db->prepare("SELECT COUNT(c.Candidato) AS total FROM rh_Candidatos c INNER JOIN rh_Candidatos_Datos d ON c.Candidato=d.Candidato WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=298 AND Estado < 252");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalInvEnProceso()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=231 AND Estado < 252");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalESESEnProceso()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=230 AND Estado < 252 AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }




    public function getTotalServiciosEnProcesoEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Estado < 252 AND Ejecutivo=:Ejecutivo AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalRALESEnProcesoEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=298 AND Estado < 252 AND Ejecutivo=:Ejecutivo");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalInvEnProcesoEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=231 AND Estado < 252 AND Ejecutivo=:Ejecutivo");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalESESEnProcesoEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=230 AND Estado < 252 AND Ejecutivo=:Ejecutivo AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }


    public function getTotalServiciosSemana()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 AND YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalRALESSemana()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=298 AND Estado<>257 AND Estado<>258 AND YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE())");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalInvSemana()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=231 AND Estado<>257 AND Estado<>258 AND YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE())");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalESESSemana()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=230 AND Estado<>257 AND Estado<>258 AND YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }




    public function getTotalServiciosSemanaEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalRALESSemanaEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=298 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE())");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalInvSemanaEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=231 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE())");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalESESSemanaEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=230 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }


    public function getTotalServiciosMes()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 AND YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha)=MONTH(GETDATE()) AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalRALESMes()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=298 AND Estado<>257 AND Estado<>258 AND YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha)=MONTH(GETDATE())");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalInvMes()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=231 AND Estado<>257 AND Estado<>258 AND YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha)=MONTH(GETDATE())");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalESESMes()
    {
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Ejecutivo<>'miguelcasanova' AND Servicio_Solicitado=230 AND Estado<>257 AND Estado<>258 AND YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha)=MONTH(GETDATE()) AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }




    public function getTotalServiciosMesEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha)=MONTH(GETDATE()) AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalRALESMesEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=298 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha)=MONTH(GETDATE())");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalInvMesEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=231 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha)=MONTH(GETDATE())");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalESESMesEjecutivo()
    {
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT COUNT(Candidato) AS total FROM rh_Candidatos WHERE Servicio_Solicitado=230 AND Estado<>257 AND Estado<>258 AND Ejecutivo=:Ejecutivo AND YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha)=MONTH(GETDATE()) AND Candidato NOT IN (SELECT Candidato FROM rh_Candidatos WHERE Cliente=139 AND Servicio_Solicitado=230 AND Servicio=230 AND Estado<252)");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getServiciosSolicitadosPorClientesHoy()
    {
        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE CONVERT(date, Fecha)=CONVERT(date, GETDATE()) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorClientesYEjecutivoHoy()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE CONVERT(date, Fecha)=CONVERT(date, GETDATE()) AND Ejecutivo=:Ejecutivo AND Estado<>257 AND Estado<>258 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorClientesEnProceso()
    {
        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE Ejecutivo<>'miguelcasanova' AND Estado < 252 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorClientesYEjecutivoEnProceso()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE Ejecutivo=:Ejecutivo AND Estado < 252 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorClientesSemana()
    {
        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorClientesYEjecutivoSemana()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Ejecutivo=:Ejecutivo AND Estado<>257 AND Estado<>258 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorClientesMes()
    {
        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha) = MONTH(GETDATE()) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorClientesYEjecutivoMes()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha) = MONTH(GETDATE()) AND Ejecutivo=:Ejecutivo AND Estado<>257 AND Estado<>258 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }




    public function getServiciosSolicitadosPorCCHoy()
    {
        $stmt = $this->db->prepare("SELECT RVA.Centro_Costos, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE CONVERT(date, Fecha)=CONVERT(date, GETDATE()) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY RVA.Centro_Costos ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorCCYEjecutivoHoy()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT RVA.Centro_Costos, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE CONVERT(date, Fecha)=CONVERT(date, GETDATE()) AND Ejecutivo=:Ejecutivo AND Estado<>257 AND Estado<>258 GROUP BY RVA.Centro_Costos ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorCCEnProceso()
    {
        $stmt = $this->db->prepare("SELECT RVA.Centro_Costos, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE Ejecutivo<>'miguelcasanova' AND Estado < 252 GROUP BY RVA.Centro_Costos ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorCCYEjecutivoEnProceso()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT RVA.Centro_Costos, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE Ejecutivo=:Ejecutivo AND Estado < 252 GROUP BY RVA.Centro_Costos ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorCCSemana()
    {
        $stmt = $this->db->prepare("SELECT RVA.Centro_Costos, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY RVA.Centro_Costos ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorCCYEjecutivoSemana()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT RVA.Centro_Costos, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Ejecutivo=:Ejecutivo AND Estado<>257 AND Estado<>258 GROUP BY RVA.Centro_Costos ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorCCMes()
    {
        $stmt = $this->db->prepare("SELECT RVA.Centro_Costos, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha) = MONTH(GETDATE()) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY RVA.Centro_Costos ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorCCYEjecutivoMes()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT RVA.Centro_Costos, SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha) = MONTH(GETDATE()) AND Ejecutivo=:Ejecutivo AND Estado<>257 AND Estado<>258 GROUP BY RVA.Centro_Costos ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorEjecutivoHoy()
    {
        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio_Solicitado = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE CONVERT(date, Fecha)=CONVERT(date, GETDATE()) AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorEjecutivoUnicoHoy()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio = 299 Or RC.Servicio = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio = 300 Or RC.Servicio = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE CONVERT(date, Fecha)=CONVERT(date, GETDATE()) AND Ejecutivo=:Ejecutivo AND Estado<>257 AND Estado<>258 GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEntregadosPorEjecutivoHoy()
    {
        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio = 299 Or RC.Servicio = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio = 300 Or RC.Servicio = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE CONVERT(date, Fecha)=CONVERT(date, GETDATE()) AND Ejecutivo<>'miguelcasanova' AND (Estado=254 OR Estado=252) GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEntregadosPorEjecutivoUnicoHoy()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio = 299 Or RC.Servicio = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio = 300 Or RC.Servicio = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE CONVERT(date, Fecha)=CONVERT(date, GETDATE()) AND Ejecutivo=:Ejecutivo AND (Estado=254 OR Estado=252) GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEntregadosPorEjecutivoSemana()
    {
        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio = 299 Or RC.Servicio = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio = 300 Or RC.Servicio = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE YEAR(Fecha)=YEAR(GETDATE()) AND  DATEPART(WEEK, Fecha) = DATEPART(WEEK, GETDATE()) AND Ejecutivo<>'miguelcasanova' AND (Estado=254 OR Estado=252) GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEntregadosPorEjecutivoUnicoSemana()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio = 299 Or RC.Servicio = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio = 300 Or RC.Servicio = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha) = MONTH(GETDATE()) AND Ejecutivo=:Ejecutivo AND (Estado=254 OR Estado=252) GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEntregadosPorEjecutivoMes()
    {
        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio = 299 Or RC.Servicio = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio = 300 Or RC.Servicio = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha) = MONTH(GETDATE()) AND Ejecutivo<>'miguelcasanova' AND (Estado=254 OR Estado=252) GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosEntregadosPorEjecutivoUnicoMes()
    {
        $Ejecutivo = $this->getEjecutivo();

        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio = 299 Or RC.Servicio = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio = 300 Or RC.Servicio = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha) = MONTH(GETDATE()) AND Ejecutivo=:Ejecutivo AND (Estado=254 OR Estado=252) GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorEjecutivoRangoFechas()
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when RC.Servicio_Solicitado = 298 then 1 else 0 end) AS No_RAL, SUM(case when RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231 then 1 else 0 end) AS No_INV, SUM(case when RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230 then 1 else 0 end) AS No_ESE, COUNT(DISTINCT(Candidato)) AS No_Servicios, AVG(CAST(dbo.count_days(RC.Fecha, RC.Fecha_Entregado) AS Decimal)) AS Tiempo FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2 AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY U.first_name, U.last_name ORDER BY No_Servicios DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosSolicitadosPorLogisticaRangoFechas()
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) and (RC.Estado = 252 OR Estado = 254) then 1 else 0 end) AS No_ESE_FIN FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Gestor=U.username WHERE CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2 AND Ejecutivo<>'miguelcasanova' AND Fecha_Aplicacion IS NOT NULL AND Estado<>257 AND Estado<>258 GROUP BY U.first_name, U.last_name ORDER BY No_ESE_FIN DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosFasePorEjecutivoRangoFechas()
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT CONCAT(U.first_name, ' ', U.last_name) AS Nombre, SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) and (RC.Estado = 252 OR Estado = 254) then 1 else 0 end) AS No_INV_FIN, SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) and (RC.Estado = 252 OR Estado = 254) then 1 else 0 end) AS No_ESE_FIN, SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) and (RC.Estado < 252) then 1 else 0 end) AS No_INV_Proc, SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) and (RC.Estado < 252) then 1 else 0 end) AS No_ESE_Proc, SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) and (RC.Estado = 252 OR Estado = 254 OR EStado < 252) then 1 else 0 end) AS No_INV_Total, SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) and (RC.Estado = 252 OR Estado = 254 OR Estado < 252) then 1 else 0 end) AS No_ESE_Total, SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231 or RC.Servicio = 300 Or RC.Servicio = 230) and (RC.Estado = 252 OR Estado = 254 OR Estado < 252) then 1 else 0 end) AS No_Total FROM rh_Candidatos RC INNER JOIN reclutamiento.dbo.Users U ON RC.Ejecutivo=U.username WHERE CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2 AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY U.first_name, U.last_name ORDER BY No_Total DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosPorClienteRangoFechas()
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT RVA.Nombre_Cliente, 
            SUM(case when RC.Servicio_Solicitado = 291 AND (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) then 1 else 0 end) AS No_RAL_Avanzados,
            SUM(case when (RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291) AND RC.ESE IS NULL AND RC.IL IS NULL then 1 else 0 end) AS No_RAL_Netos,
            SUM(case when RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291 then 1 else 0 end) AS No_RAL_Brutos, 
            SUM(case when (RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231) and (RC.Estado = 252 OR Estado = 254) then 1 else 0 end) AS No_INV_FIN,
            SUM(case when (RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230) and (RC.Estado = 252 OR Estado = 254) then 1 else 0 end) AS No_ESE_FIN, 
            SUM(case when (RC.Servicio_Solicitado = 299 Or RC.Servicio_Solicitado = 231) and (RC.Estado < 252) then 1 else 0 end) AS No_INV_Proc,
            SUM(case when (RC.Servicio_Solicitado = 300 Or RC.Servicio_Solicitado = 230) and (RC.Estado < 252) then 1 else 0 end) AS No_ESE_Proc, 
            SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) and (RC.Estado = 252 OR Estado = 254 OR EStado < 252) then 1 else 0 end) AS No_INV_Total, 
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) and (RC.Estado = 252 OR Estado = 254 OR Estado < 252) then 1 else 0 end) AS No_ESE_Total,
            SUM(case when ((RC.Servicio = 299 Or RC.Servicio = 231 or RC.Servicio = 300 Or RC.Servicio = 230) and (RC.Estado = 252 OR Estado = 254 OR Estado < 252) OR (RC.Servicio_Solicitado = 298 Or RC.Servicio_Solicitado = 291) AND RC.ESE IS NULL AND RC.IL IS NULL) then 1 else 0 end) AS No_Servicios
        FROM rh_Candidatos RC INNER JOIN rh_Ventas_Alta RVA ON RC.Cliente=RVA.Cliente WHERE  CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2 AND Ejecutivo<>'miguelcasanova' AND Estado<>257 AND Estado<>258 GROUP BY RVA.Nombre_Cliente ORDER BY No_Servicios DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getServiciosRALPorRangoDeFechaConCancelados()
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT Creado, Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado <= 251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado <= 251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado <= 251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado <= 251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado <= 251) THEN 'Visita Presencial en Proceso' WHEN RC.Estado=328 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' ELSE '' END
        ,VLF = (SELECT TOP(1) CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Plaza_Cliente
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Puesto] = RC.Puesto
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_MX]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,RC.Factura
        ,Enlace_Drive
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,RC.Razon
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,CC_Cliente
        ,Comentario_Cliente
        ,Comentario_Cancelado
        ,ISNULL(Comentario_Finalizado, '') AS Comentario_Finalizado
        ,ob.Viable
        ,RC.IL
        ,RC.ESE
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato
        LEFT JOIN rh_Candidatos_Obs_Generales ob ON RC.Candidato=ob.Candidato 
         WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 AND CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2 AND  (RC.Servicio_Solicitado=291 OR RC.Servicio_Solicitado=298)
        ORDER BY RC.Fecha DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getDetallePorAnio()
    {
        $Anio = $this->getFecha_solicitud();
        $stmt = $this->db->prepare(
            "SELECT 
			v.Nombre_Cliente,
			v.RAL,
			v.Investigacion_L,
			v.ESE,
			v.Centro_Costos,
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Brutos_Ene, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Avanzados_Ene,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Netos_Ene,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_INV_FIN_Ene,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_ESE_FIN_Ene,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_FIN_Ene,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Brutos_Feb,
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Avanzados_Feb,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Netos_Feb, 
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_INV_FIN_Feb,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_ESE_FIN_Feb,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_FIN_Feb,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Brutos_Mar, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Avanzados_Mar,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Netos_Mar,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_INV_FIN_Mar,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_ESE_FIN_Mar,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_FIN_Mar,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Brutos_Abr, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Avanzados_Abr,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Netos_Abr,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_INV_FIN_Abr,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_ESE_FIN_Abr,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_FIN_Abr,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Brutos_May, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Avanzados_May,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Netos_May,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_INV_FIN_May,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_ESE_FIN_May,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_FIN_May,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Brutos_Jun, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Avanzados_Jun,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Netos_Jun,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_INV_FIN_Jun,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_ESE_FIN_Jun,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_FIN_Jun,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Brutos_Jul, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Avanzados_Jul,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Netos_Jul,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_INV_FIN_Jul,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_ESE_FIN_Jul,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_FIN_Jul,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Brutos_Ago, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Avanzados_Ago,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Netos_Ago,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_INV_FIN_Ago,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_ESE_FIN_Ago,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_FIN_Ago,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Brutos_Sep, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Avanzados_Sep,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Netos_Sep,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_INV_FIN_Sep,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_ESE_FIN_Sep,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_FIN_Sep,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Brutos_Oct, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Avanzados_Oct,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Netos_Oct,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_INV_FIN_Oct,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_ESE_FIN_Oct,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_FIN_Oct,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Brutos_Nov, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Avanzados_Nov,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Netos_Nov,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_INV_FIN_Nov,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_ESE_FIN_Nov,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_FIN_Nov,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Brutos_Dic, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Avanzados_Dic,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Netos_Dic,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_INV_FIN_Dic,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_ESE_FIN_Dic,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_FIN_Dic,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) then 1 else 0 end) AS No_RAL_Brutos, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) then 1 else 0 end) AS No_RAL_Avanzados,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) AND RC.ESE IS NULL AND RC.IL IS NULL then 1 else 0 end) AS No_RAL_Netos,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) then 1 else 0 end) AS No_INV_FIN,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) then 1 else 0 end) AS No_ESE_FIN,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291 Or RC.Servicio = 328 ) then 1 else 0 end) AS No_FIN
		FROM rh_Candidatos RC
			INNER JOIN rh_Ventas_Alta v 
				ON RC.Cliente=v.Cliente 
			WHERE YEAR(Fecha)=:Anio
				AND Ejecutivo<>'miguelcasanova' AND (Estado=249 OR Estado=250 OR Estado=251 OR Estado=252 OR Estado=254 OR Estado=257 OR Estado=258) AND v.Cliente <> 132 AND v.Cliente <> 250 AND (v.RAL<>0  or v.Investigacion_L<>0 OR v.ESE<>0)
			GROUP BY v.Nombre_Cliente, v.RAL, v.Investigacion_L, v.ESE, v.Centro_Costos
			ORDER BY No_ESE_FIN DESC"
        );
        $stmt->bindParam(":Anio", $Anio, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getDetallePorAnioClienteSinServicio()
    {
        $Anio = $this->getFecha_solicitud();
        $stmt = $this->db->prepare("        SELECT Nombre_Cliente FROM rh_Ventas_Alta ve where ve.Cliente <> ALL
        (SELECT  	v.Cliente
                   FROM rh_Candidatos RC
                    INNER JOIN rh_Ventas_Alta v 
                        ON RC.Cliente=v.Cliente 
                    WHERE YEAR(Fecha)=:Anio 
                        AND Ejecutivo<>'miguelcasanova' AND (Estado=252 OR Estado=254) AND v.Cliente <> 132 AND v.Cliente <> 250
                    GROUP BY v.Nombre_Cliente, v.RAL, v.Investigacion_L, v.ESE, v.Centro_Costos, v.Cliente) ORDER BY Nombre_Cliente ASC");
        $stmt->bindParam(":Anio", $Anio, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }


    public function getAnios()
    {
        $stmt = $this->db->prepare("SELECT DISTINCT YEAR(Fecha) AS Anio FROM rh_Candidatos ORDER BY Anio DESC");
        $stmt->execute();
        $anios = $stmt->fetchAll();
        return $anios;
    }

    //============================[Ulises Marzo 07]==========================================
    public function getAllCandidatosPorPrefactura()
    {
        $Factura = $this->getFactura();

        $stmt = $this->db->prepare("SELECT * FROM rh_Candidatos WHERE Factura=:Factura");
        $stmt->bindParam(":Factura", $Factura, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    //==========================================================================================

    //============================[Ulises Marzo 21]==========================================
    public function getCandidatosSinprefacutraPorCliente()
    {
        $Cliente = $this->getCliente();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato,RC.Factura
        ,[Solicitud]=RC.Fecha
        ,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,ID_Cliente = RC.Cliente
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
         ,[Fecha] = RC.Fecha
        ,[Puesto] = RC.Puesto
        ,[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado)
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura
         WHERE (rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0) and  RC.Estado=252 AND RC.Factura='' AND RC.Cliente=:Cliente
		 ORDER BY Nombre_Candidato");

        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);

        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    //==========================================================================================

    //============================[Ulises Marzo 23]==========================================
    public function getServiciosPorRangoDeFechaEmpresa($Empresa)
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,Estado =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Estado))
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,ID_Cliente = RC.Cliente
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT UPPER(AE.Nombre_Cliente) FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Entrega]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[Fecha] = RC.Fecha
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,[Puesto] = RC.Puesto
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))  
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,[CC_Cliente] = RC.CC_Cliente
        ,[Razon] = RC.Razon
        ,[Factura] = RC.Factura
        ,[Plaza_Cliente]=RC.Plaza_Cliente
        ,[Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado)
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_MX]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Viabilidad] = (select CONVERT(varchar(1), Viable) from rh_Candidatos_Obs_Generales where Candidato=Rc.Candidato)
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,RC.Reactivado
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato LEFT JOIN [rh_Candidatos_Facturas] RF ON RC.Factura=rf.Folio_Factura  LEFT JOIN [rh_Ventas_Alta] va on va.Cliente = rc.Cliente
							  LEFT JOIN rh_Ventas_Empresas ve on va.Empresa = ve.Empresa
         WHERE rc.Ejecutivo<>'miguelcasanova' and RC.Cliente<>0 and RC.Estado<>257 and RC.Estado<>258 AND CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2 AND ve.Empresa=:Empresa
        ORDER BY Estatus DESC, RC.Candidato DESC
");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    //==========================================================================================
    //============================[Ulises Marzo 29]==========================================
    public function getServiciosPorRangoDeFechaConCanceladosEmpresa($Empresa)
    {
        $date1 = $this->getFecha_solicitud();
        $date2 = $this->getFecha_entregado();

        $stmt = $this->db->prepare("SELECT Creado, Folio=RC.Candidato
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,[Empresa] = (SELECT Nombre_Empresa FROM rh_Ventas_Empresas WHERE Empresa=(SELECT Empresa FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente))
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Plaza_Cliente
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
		,Puesto
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_INV IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_INV) ELSE '0' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND (RC.Estado<>258 AND RC.Estado<>249) THEN '0.0' WHEN RC.Fecha_Entregado_ESE IS NOT NULL AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado_ESE) ELSE '0' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, GETDATE()) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN dbo.count_days_with_decimal(RC.Fecha, RC.Fecha_Entregado) ELSE '0' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)
        ,[Estado_MX]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres COLLATE Latin1_general_CI_AI =CD.Nombres COLLATE Latin1_general_CI_AI and rh_Candidatos_Datos.Apellido_Paterno COLLATE Latin1_general_CI_AI =CD.Apellido_Paterno COLLATE Latin1_general_CI_AI and rh_Candidatos_Datos.Apellido_Materno COLLATE Latin1_general_CI_AI =CD.Apellido_Materno COLLATE Latin1_general_CI_AI)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA') 
        ,RC.Factura
        ,Enlace_Drive
        ,[Centro_C] = (SELECT Centro_Costos FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
        ,RC.Razon
        ,[Solicita] = (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
		,CC_Cliente
        ,Comentario_Cliente
        ,Comentario_Cancelado
        ,ISNULL(Comentario_Finalizado, '') AS Comentario_Finalizado
        ,ob.Viable
        ,RC.IL
        ,RC.ESE
		,RC.Factura
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato 
        LEFT JOIN rh_Candidatos_Obs_Generales ob ON RC.Candidato=ob.Candidato  LEFT JOIN [rh_Ventas_Alta] va on va.Cliente = rc.Cliente
							  LEFT JOIN rh_Ventas_Empresas ve on va.Empresa = ve.Empresa
         WHERE rc.Ejecutivo<>'miguelcasanova'  AND CONVERT(DATE,Fecha) BETWEEN :date1 AND :date2 AND ve.Empresa=:Empresa
        ORDER BY RC.Fecha DESC");
        $stmt->bindParam(":date1", $date1, PDO::PARAM_STR);
        $stmt->bindParam(":date2", $date2, PDO::PARAM_STR);
        $stmt->bindParam(":Empresa", $Empresa, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    //==========================================================================================
    //============================[Ulises Abril 20]==========================================
    public function getDetallePorAnioYCliente()
    {
        $Anio = $this->getFecha_solicitud();
        $Cliente = $this->getCliente();
        $stmt = $this->db->prepare(
            "SELECT v.Nombre_Cliente,
                        v.RAL,
                        v.Investigacion_L,
                        v.ESE,
                        v.Centro_Costos,
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Brutos_Ene, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Avanzados_Ene,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Netos_Ene,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_INV_FIN_Ene,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_ESE_FIN_Ene,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_FIN_Ene,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Brutos_Feb,
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Avanzados_Feb,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Netos_Feb, 
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_INV_FIN_Feb,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_ESE_FIN_Feb,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_FIN_Feb,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Brutos_Mar, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Avanzados_Mar,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Netos_Mar,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_INV_FIN_Mar,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_ESE_FIN_Mar,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_FIN_Mar,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Brutos_Abr, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Avanzados_Abr,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Netos_Abr,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_INV_FIN_Abr,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_ESE_FIN_Abr,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_FIN_Abr,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Brutos_May, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Avanzados_May,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Netos_May,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_INV_FIN_May,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_ESE_FIN_May,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_FIN_May,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Brutos_Jun, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Avanzados_Jun,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Netos_Jun,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_INV_FIN_Jun,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_ESE_FIN_Jun,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_FIN_Jun,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Brutos_Jul, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Avanzados_Jul,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Netos_Jul,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_INV_FIN_Jul,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_ESE_FIN_Jul,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_FIN_Jul,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Brutos_Ago, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Avanzados_Ago,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Netos_Ago,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_INV_FIN_Ago,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_ESE_FIN_Ago,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_FIN_Ago,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Brutos_Sep, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Avanzados_Sep,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Netos_Sep,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_INV_FIN_Sep,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_ESE_FIN_Sep,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_FIN_Sep,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Brutos_Oct, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Avanzados_Oct,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Netos_Oct,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_INV_FIN_Oct,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_ESE_FIN_Oct,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_FIN_Oct,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Brutos_Nov, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Avanzados_Nov,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Netos_Nov,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_INV_FIN_Nov,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_ESE_FIN_Nov,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_FIN_Nov,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Brutos_Dic, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Avanzados_Dic,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Netos_Dic,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_INV_FIN_Dic,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_ESE_FIN_Dic,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_FIN_Dic,
                    
                        SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) then 1 else 0 end) AS No_RAL_Brutos, 
                        SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) then 1 else 0 end) AS No_RAL_Avanzados,
                        SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL then 1 else 0 end) AS No_RAL_Netos,
                        SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) then 1 else 0 end) AS No_INV_FIN,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) then 1 else 0 end) AS No_ESE_FIN,
                        SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) then 1 else 0 end) AS No_FIN
                    FROM rh_Candidatos RC
                        INNER JOIN rh_Ventas_Alta v 
                            ON RC.Cliente=v.Cliente 
                        WHERE YEAR(Fecha)=:Anio
                            AND Ejecutivo<>'miguelcasanova' AND (Estado=252 OR Estado=254) AND v.Cliente <> 132 AND v.Cliente <> 250 AND v.Cliente=:Cliente
                        GROUP BY v.Nombre_Cliente, v.RAL, v.Investigacion_L, v.ESE, v.Centro_Costos
                        ORDER BY No_ESE_FIN DESC"
        );
        $stmt->bindParam(":Anio", $Anio, PDO::PARAM_INT);
        $stmt->bindParam(":Cliente", $Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    //==========================================================================================
    //===============================[Ulises Abril 26]==========================================================
    public function getDetallePorAnioCortesias()
    {
        $Anio = $this->getFecha_solicitud();
        $stmt = $this->db->prepare(
            "SELECT 
			v.Nombre_Cliente,
			v.RAL,
			v.Investigacion_L,
			v.ESE,
			v.Centro_Costos,
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Brutos_Ene, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Avanzados_Ene,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_RAL_Netos_Ene,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_INV_FIN_Ene,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_ESE_FIN_Ene,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=1 then 1 else 0 end) AS No_FIN_Ene,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Brutos_Feb,
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Avanzados_Feb,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_RAL_Netos_Feb, 
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_INV_FIN_Feb,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_ESE_FIN_Feb,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=2 then 1 else 0 end) AS No_FIN_Feb,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Brutos_Mar, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Avanzados_Mar,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_RAL_Netos_Mar,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_INV_FIN_Mar,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_ESE_FIN_Mar,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=3 then 1 else 0 end) AS No_FIN_Mar,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Brutos_Abr, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Avanzados_Abr,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_RAL_Netos_Abr,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_INV_FIN_Abr,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_ESE_FIN_Abr,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=4 then 1 else 0 end) AS No_FIN_Abr,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Brutos_May, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Avanzados_May,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_RAL_Netos_May,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_INV_FIN_May,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_ESE_FIN_May,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=5 then 1 else 0 end) AS No_FIN_May,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Brutos_Jun, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Avanzados_Jun,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_RAL_Netos_Jun,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_INV_FIN_Jun,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_ESE_FIN_Jun,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=6 then 1 else 0 end) AS No_FIN_Jun,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Brutos_Jul, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Avanzados_Jul,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_RAL_Netos_Jul,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_INV_FIN_Jul,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_ESE_FIN_Jul,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=7 then 1 else 0 end) AS No_FIN_Jul,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Brutos_Ago, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Avanzados_Ago,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_RAL_Netos_Ago,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_INV_FIN_Ago,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_ESE_FIN_Ago,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=8 then 1 else 0 end) AS No_FIN_Ago,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Brutos_Sep, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Avanzados_Sep,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_RAL_Netos_Sep,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_INV_FIN_Sep,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_ESE_FIN_Sep,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=9 then 1 else 0 end) AS No_FIN_Sep,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Brutos_Oct, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Avanzados_Oct,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_RAL_Netos_Oct,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_INV_FIN_Oct,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_ESE_FIN_Oct,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=10 then 1 else 0 end) AS No_FIN_Oct,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Brutos_Nov, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Avanzados_Nov,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_RAL_Netos_Nov,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_INV_FIN_Nov,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_ESE_FIN_Nov,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=11 then 1 else 0 end) AS No_FIN_Nov,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Brutos_Dic, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Avanzados_Dic,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_RAL_Netos_Dic,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_INV_FIN_Dic,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_ESE_FIN_Dic,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) AND MONTH(RC.Fecha)=12 then 1 else 0 end) AS No_FIN_Dic,
		
			SUM(case when ((RC.Servicio = 298 Or RC.Servicio = 291) OR (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL)) then 1 else 0 end) AS No_RAL_Brutos, 
			SUM(case when (RC.ESE IS NOT NULL OR RC.IL IS NOT NULL) then 1 else 0 end) AS No_RAL_Avanzados,
			SUM(case when (RC.Servicio = 298 Or RC.Servicio = 291) AND RC.ESE IS NULL AND RC.IL IS NULL then 1 else 0 end) AS No_RAL_Netos,
			SUM(case when (RC.Servicio = 299 Or RC.Servicio = 231) then 1 else 0 end) AS No_INV_FIN,
			SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230) then 1 else 0 end) AS No_ESE_FIN,
            SUM(case when (RC.Servicio = 300 Or RC.Servicio = 230 Or RC.Servicio = 299 Or RC.Servicio = 231 Or RC.Servicio = 298 Or RC.Servicio = 291) then 1 else 0 end) AS No_FIN
		FROM rh_Candidatos RC
			INNER JOIN rh_Ventas_Alta v 
				ON RC.Cliente=v.Cliente 
			WHERE YEAR(Fecha)=:Anio
				AND Ejecutivo<>'miguelcasanova' AND (Estado=252 OR Estado=254) AND v.Cliente <> 132 AND v.Cliente <> 250  AND v.Cliente <> 250 AND v.Investigacion_L=0  and v.ESE=0
			GROUP BY v.Nombre_Cliente, v.RAL, v.Investigacion_L, v.ESE, v.Centro_Costos
			ORDER BY No_ESE_FIN DESC"
        );
        $stmt->bindParam(":Anio", $Anio, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    // ===[19 de mayo 2023 estudios]===


    public function GetOnePorCurp($cliente, $curp)
    {
        $curp = $curp;
        $cliente = $cliente;

        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM rh_Candidatos RC
        INNER JOIN rh_Candidatos_Datos CD on CD.Candidato=RC.Candidato
         WHERE CD.curp=:curp and RC.cliente=:cliente");
        $stmt->bindParam(":curp", $curp, PDO::PARAM_INT);
        $stmt->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function updateReplicado()
    {
        $Candidato = $this->getCandidato();
        $Replicado=$this->getReplicado();
        $stmt = $this->db->prepare("UPDATE TOP(1) rh_Candidatos SET replicado=:Replicado WHERE Candidato=:Candidato ");
        $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
        $stmt->bindParam(":Replicado", $Replicado, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->execute();
        var_dump($fetch);die();
        return $fetch;
    }


    // ===[19 de mayo 2023 estudios fin]===


    //CIOSAA
    public function getServiciosPorContactoCIOSA()
    {
        $Contacto = $this->getContacto();
        $stmt = $this->db->prepare("SELECT TOP(7200) Folio=RC.Candidato,RC.Cliente ID_Ciente
        ,[Solicitud]=RC.Fecha
        ,RC.Estado
        ,[Estatus] = CASE WHEN RC.Servicio=298 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Ral en Proceso' WHEN (RC.Servicio=299 OR RC.Servicio=231) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Investigación en Proceso' WHEN (RC.Servicio=300 OR RC.Servicio=230) AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita en Proceso' WHEN RC.Servicio=310 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Validación de Licencia en Proceso' WHEN RC.Servicio=324 AND (RC.Estado=250 OR RC.Estado=251) THEN 'Visita Presencial en Proceso' WHEN RC.Servicio=328 AND RC.Estado=250 OR RC.Estado=251 THEN 'Análisis de RAL en Proceso' WHEN RC.Estado=252 THEN 'Finalizado' WHEN RC.Estado=254 THEN 'Facturado' WHEN RC.Estado=258 THEN 'Cancelado' WHEN RC.Estado=249 THEN 'Pausado' WHEN RC.Servicio=291 AND RC.Estado=250 OR RC.Estado=251 THEN 'RAL Consultado' ELSE '' END
        ,VLF = (SELECT TOP 1 CASE WHEN Candidato IS NOT NULL THEN 'VLF + ' ELSE '' END FROM Validacion_Licencia_Federal lic WHERE lic.Candidato=RC.Candidato)
        ,Cliente= CASE WHEN RC.Cliente=0 THEN (SELECT AE.Alias FROM [adm_Empresas] AE WHERE AE.Empresa=RC.Empresa) ELSE (SELECT AE.Nombre_Cliente FROM [rh_Ventas_Alta] AE WHERE AE.Cliente=RC.Cliente) END
        ,Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END
		,A_RAL = CASE WHEN A_RAL>0 THEN 'ARAL' ELSE '' END
        ,RC.Servicio
        ,Nombre_Candidato=TRANSLATE(UPPER(CD.Nombres +' '+ cd.Apellido_Paterno +' '+ cd.Apellido_Materno), 'ÁÉÍÓÚÑ', 'AEIOUN')
        ,[Aplicacion] = RC.Fecha_Aplicacion
        ,[Fecha_Entregado]=RC.Fecha_Entregado
        ,[Ejecutivo] = UPPER(RC.Ejecutivo)
        ,[HO] = RC.Gestor
        ,[Dias] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, GETDATE()) WHEN RC.Estado <> 258 THEN dbo.count_days(RC.Fecha, RC.Fecha_Entregado) ELSE '-1' END
        ,[Tiempo_IL] = CASE WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado_INV IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado_INV),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado_INV))%1440/14.4)) ELSE '' END
        ,[Tiempo_ESE] = CASE WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado_ESE IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado_ESE),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado_ESE))%1440/14.4)) ELSE '' END
        ,[Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha <= GETDATE() AND RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/14.4)) WHEN RC.Fecha_Entregado IS NULL AND RC.Fecha > GETDATE() AND RC.Estado<>258 THEN '0.0' WHEN RC.Estado<>258 THEN CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado),'.', CONVERT(INT, (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado))%1440/14.4)) ELSE '' END
        ,[Viatico] = RC.Viatico
        ,[Solicitud_De] = RC.Solicitud_De
        ,[Progreso] = (SELECT (Datos_Generales+Datos_Adicionales+Documentos+salud+Sociales+Ubicacion+Estructura+Ref_Vecinal+Obs_Generales) as Total from Progreso_Gestor WHERE Candidato=RC.Candidato)
        ,[Servicio_Solicitado] =UPPER((SELECT ES.Descripcion FROM sys_Campos ES WHERE ES.Campo= RC.Servicio_Solicitado))
        ,[Repetidos] = (SELECT COUNT(rh_Candidatos_Datos.Candidato) FROM rh_Candidatos_Datos left join rh_Candidatos on rh_Candidatos_Datos.Candidato = rh_Candidatos.Candidato WHERE ((rh_Candidatos_Datos.Nombres=CD.Nombres and rh_Candidatos_Datos.Apellido_Paterno=CD.Apellido_Paterno and rh_Candidatos_Datos.Apellido_Materno=CD.Apellido_Materno)) and rh_Candidatos.Ejecutivo<>'MIGUELCASANOVA')
        ,[Solicita]= (SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente)
        ,RC.Factura
        ,Enlace_Drive
        ,RC.CC_Cliente
        ,ob.Viable
		,RAL = cral.Candidato
        ,RC.ID_Busqueda_RAL
        ,RC.Fecha_Entregado_INV
        ,RC.Fecha_Entregado_ESE
        ,RC.replicado
		,[Cliente_Activo] = (SELECT Activo FROM rh_Ventas_Alta WHERE Cliente=RC.Cliente)
    FROM rh_Candidatos RC
        INNER JOIN [rh_Candidatos_Datos] CD on CD.Candidato=RC.Candidato
        LEFT JOIN rh_Candidatos_Obs_Generales ob ON RC.Candidato=ob.Candidato
		LEFT JOIN rh_Candidatos_RAL cral ON RC.Candidato=cral.Candidato
         WHERE RC.Cliente IN (SELECT ID_Cliente FROM rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:Contacto) AND RC.Nombre_Cliente='3533'
        ORDER BY RC.Fecha DESC");
        $stmt->bindParam(":Contacto", $Contacto, PDO::PARAM_STR);
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
}
