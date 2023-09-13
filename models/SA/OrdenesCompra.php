<?php

class OrdenesCompra{

    private $Folio;
    private $Folio_Factura;
    private $Estado_OC;
    private $Fecha_Gestion;
    private $Comentarios;
    private $Fecha_Emision;
    private $Fecha_Prox_Gestion;
    private $Razon_Social;

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

	public function getEstado_OC(){
		return $this->Estado_OC;
	}

	public function setEstado_OC($Estado_OC){
		$this->Estado_OC = $Estado_OC;
	}

	public function getFecha_Gestion(){
		return $this->Fecha_Gestion;
	}

	public function setFecha_Gestion($Fecha_Gestion){
		$this->Fecha_Gestion = $Fecha_Gestion;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios = $Comentarios;
	}

	public function getFecha_Emision(){
		return $this->Fecha_Emision;
	}

	public function setFecha_Emision($Fecha_Emision){
		$this->Fecha_Emision = $Fecha_Emision;
	}

	public function getFecha_Prox_Gestion(){
		return $this->Fecha_Prox_Gestion;
	}

	public function setFecha_Prox_Gestion($Fecha_Prox_Gestion){
		$this->Fecha_Prox_Gestion = $Fecha_Prox_Gestion;
    }

    public function getRazon_Social(){
		return $this->Razon_Social;
	}

	public function setRazon_Social($Razon_Social){
		$this->Razon_Social = $Razon_Social;
    }

    public function getOne(){
        $folio = $this->getFolio_Factura();
        $stmt = $this->db->prepare("SELECT Folio_Factura, CONVERT(DATE, Fecha_Emision) AS Fecha_Emision, CONVERT(Time, Fecha_Emision) AS Hora_Emision, ID_Cliente=rc.Cliente, Cliente=(CASE WHEN rc.Cliente=0 THEN 
        (SELECT 
            AE.Alias 
        FROM 
            [adm_Empresas] AE 
        WHERE 
            AE.Empresa=RC.Empresa) 
    ELSE 
        (SELECT 
            UPPER(AE.Nombre_Cliente) 
        FROM 
            [rh_Ventas_Alta] AE 
        WHERE AE.Cliente=rc.Cliente) 
    END), 
    rc.Razon, Estado_OC, oc.Comentarios, Fecha_Gestion, CONVERT(DATE, Fecha_Prox_Gestion) AS Fecha_Prox_Gestion FROM rh_candidatos_Facturas_OC oc INNER JOIN rh_Candidatos rc ON oc.Folio_Factura=rc.Factura WHERE Folio_Factura=:folio GROUP BY Folio_Factura, Fecha_Emision, Estado_OC, Comentarios, Fecha_Gestion, Fecha_Prox_Gestion, Empresa, rc.Cliente, rc.Razon");
        $stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }
    
    public function getOrdenesPendientes(){
        $stmt = $this->db->prepare("SELECT
            --Convert(DATE, Fecha) AS Solicitud,
            DISTINCT RC.Factura,
            Convert(DATE, OC.Fecha_Emision) AS Fecha_Emision,
            [Cliente] = ISNULL(RF.Cliente, CASE WHEN RC.Cliente=0 THEN 
                    (SELECT 
                        AE.Alias 
                    FROM 
                        [adm_Empresas] AE 
                    WHERE 
                        AE.Empresa=RC.Empresa) 
                ELSE 
                    (SELECT 
                        UPPER(AE.Nombre_Cliente) 
                    FROM 
                        [rh_Ventas_Alta] AE 
                    WHERE AE.Cliente=RC.Cliente) 
                END)
                ,
            [Razon] = 
                ISNULL(RF.Razon_Social, RC.Razon),
            Monto,
            COUNT(DISTINCT(Candidato)) AS No_Servicios,
            Estado =UPPER((SELECT 
                                ES.Descripcion 
                            FROM 
                                sys_Campos ES 
                            WHERE 
                                ES.Campo= RC.Estado)),
            OC.Estado_OC,
            OC.Fecha_Gestion,
            OC.Fecha_Prox_Gestion,
            OC.Comentarios
        FROM
                rh_Candidatos RC
            LEFT JOIN
                rh_Candidatos_Facturas RF
            ON 
                RC.Factura=RF.Folio_Factura
            INNER JOIN
                rh_Candidatos_Facturas_OC OC
            ON
                RC.Factura=OC.Folio_Factura
        WHERE
            Factura <>'' AND Estado_OC <> 'Liberada'
        GROUP BY
            Factura, Convert(DATE, OC.Fecha_Emision), RC.Cliente, RF.Cliente, RC.Empresa, Razon_Social, Razon, Monto, Monto_IVA, RC.Estado, OC.Estado_OC, OC.Fecha_Gestion, OC.Fecha_Prox_Gestion, OC.Comentarios
        ORDER BY
            Factura DESC");
        $stmt->execute();
        $ordenes = $stmt->fetchAll();
        return $ordenes;
    }
    
    public function getOrdenesLiberadas(){
        $stmt = $this->db->prepare("SELECT
            --Convert(DATE, Fecha) AS Solicitud,
            DISTINCT RC.Factura,
            Convert(DATE, RF.Fecha_Emision) AS Fecha_Emision,
            [Cliente] = ISNULL(RF.Cliente, CASE WHEN RC.Cliente=0 THEN 
                    (SELECT 
                        AE.Alias 
                    FROM 
                        [adm_Empresas] AE 
                    WHERE 
                        AE.Empresa=RC.Empresa) 
                ELSE 
                    (SELECT 
                        UPPER(AE.Nombre_Cliente) 
                    FROM 
                        [rh_Ventas_Alta] AE 
                    WHERE AE.Cliente=RC.Cliente) 
                END)
                ,
            [Razon] = 
                ISNULL(RF.Razon_Social, RC.Razon),
            Monto,
            COUNT(DISTINCT(Candidato)) AS No_Servicios,
            Estado =UPPER((SELECT 
                                ES.Descripcion 
                            FROM 
                                sys_Campos ES 
                            WHERE 
                                ES.Campo= RC.Estado)),
            OC.Estado_OC,
            OC.Fecha_Gestion,
            OC.Comentarios
        FROM
                rh_Candidatos RC
            LEFT JOIN
                rh_Candidatos_Facturas RF
            ON 
                RC.Factura=RF.Folio_Factura
            INNER JOIN
                rh_Candidatos_Facturas_OC OC
            ON
                RC.Factura=OC.Folio_Factura
        WHERE
            Factura <>'' AND Estado_OC = 'Liberada'
        GROUP BY
            Factura, Convert(DATE, RF.Fecha_Emision), RC.Cliente, RF.Cliente, RC.Empresa, Razon_Social, Razon, Monto, Monto_IVA, RC.Estado, OC.Estado_OC, OC.Fecha_Gestion, OC.Comentarios
        ORDER BY
            Factura DESC");
        $stmt->execute();
        $ordenes = $stmt->fetchAll();
        return $ordenes;
    }

    public function getOrdenesPorFecha(){
        $Fecha_Prox_Gestion = $this->getFecha_Prox_Gestion();
        $stmt = $this->db->prepare("SELECT
        --Convert(DATE, Fecha) AS Solicitud,
        DISTINCT RC.Factura,
        Convert(DATE, OC.Fecha_Emision) AS Fecha_Emision,
        [Cliente] = ISNULL(RF.Cliente, CASE WHEN RC.Cliente=0 THEN 
                (SELECT 
                    AE.Alias 
                FROM 
                    [adm_Empresas] AE 
                WHERE 
                    AE.Empresa=RC.Empresa) 
            ELSE 
                (SELECT 
                    UPPER(AE.Nombre_Cliente) 
                FROM 
                    [rh_Ventas_Alta] AE 
                WHERE AE.Cliente=RC.Cliente) 
            END)
            ,
        [Razon] = 
            ISNULL(RF.Razon_Social, RC.Razon),
        Monto,
        COUNT(DISTINCT(Candidato)) AS No_Servicios,
        Estado =UPPER((SELECT 
                            ES.Descripcion 
                        FROM 
                            sys_Campos ES 
                        WHERE 
                            ES.Campo= RC.Estado)),
        OC.Estado_OC,
        OC.Fecha_Gestion,
        OC.Fecha_Prox_Gestion,
        OC.Comentarios
    FROM
            rh_Candidatos RC
        LEFT JOIN
            rh_Candidatos_Facturas RF
        ON 
            RC.Factura=RF.Folio_Factura
        INNER JOIN
            rh_Candidatos_Facturas_OC OC
        ON
            RC.Factura=OC.Folio_Factura
    WHERE
        Factura <>'' AND Estado_OC <> 'Liberada' AND Fecha_Prox_Gestion=:Fecha_Prox_Gestion
    GROUP BY
        Factura, Convert(DATE, OC.Fecha_Emision), RC.Cliente, RF.Cliente, RC.Empresa, Razon_Social, Razon, Monto, Monto_IVA, RC.Estado, OC.Estado_OC, OC.Fecha_Gestion, OC.Fecha_Prox_Gestion, OC.Comentarios
    ORDER BY
        Factura DESC");
        $stmt->bindParam(':Fecha_Prox_Gestion', $Fecha_Prox_Gestion, PDO::PARAM_STR);
        $stmt->execute();
        $ordenes = $stmt->fetchAll();
        return $ordenes;
    }
    
    public function getDetalleOrdenPorFolio(){
        $Folio_Factura = $this->getFolio_Factura();

        $stmt = $this->db->prepare("SELECT
            [Cliente] = ISNULL(RF.Cliente, CASE WHEN RC.Cliente=0 THEN 
                    (SELECT 
                        AE.Alias 
                    FROM 
                        [adm_Empresas] AE 
                    WHERE 
                        AE.Empresa=RC.Empresa) 
                ELSE 
                    (SELECT 
                        UPPER(AE.Nombre_Cliente) 
                    FROM 
                        [rh_Ventas_Alta] AE 
                    WHERE AE.Cliente=RC.Cliente) 
                END),
            [Razon] = ISNULL(RF.Razon_Social, RC.Razon),
            Nombre_Candidato=UPPER(CD.Nombres +' '+ CD.Apellido_Paterno +' '+ CD.Apellido_Materno),
            [Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado),
            Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END,
            Fecha_Entregado,
            Estado =UPPER((SELECT 
                                ES.Descripcion 
                            FROM 
                                sys_Campos ES 
                            WHERE 
                                ES.Campo= RC.Estado)),
            [Ejecutivo] = UPPER(RC.Ejecutivo),
            [Solicita] = ISNULL((SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente),''),
            [CC] = (SELECT Centro_Costos FROM rh_Ventas_Alta VA WHERE VA.Cliente=RC.Cliente)

        FROM
                rh_Candidatos RC
            INNER JOIN
                rh_Candidatos_Datos CD
            ON
                RC.Candidato=CD.Candidato
            LEFT JOIN
                rh_Candidatos_Facturas RF
            ON 
                RC.Factura=RF.Folio_Factura
        WHERE
            Factura=:folio
        ORDER BY
            Fecha_Entregado DESC");
        $stmt->bindParam(":folio", $Folio_Factura, PDO::PARAM_STR);
        $stmt->execute();
        $ordenes = $stmt->fetchAll();
        return $ordenes;
    }
    
    public function getListadoOrdenPorFolio(){
        $Folio_Factura = $this->getFolio_Factura();

        $stmt = $this->db->prepare("SELECT
            [Folio] = RC.Candidato,
            [Solicitud] = RC.Fecha,
            [Tiempo] = CASE WHEN RC.Fecha_Entregado IS NULL THEN CONCAT(dbo.count_days(RC.Fecha, GETDATE()),'d ', (DATEDIFF(MINUTE, RC.Fecha, GETDATE()))%1440/60, 'h ') ELSE CONCAT(dbo.count_days(RC.Fecha, RC.Fecha_Entregado),'d ', (DATEDIFF(MINUTE, RC.Fecha, RC.Fecha_Entregado))%1440/60, 'h ') END,
            [Cliente] = ISNULL(RF.Cliente, CASE WHEN RC.Cliente=0 THEN 
                    (SELECT 
                        AE.Alias 
                    FROM 
                        [adm_Empresas] AE 
                    WHERE 
                        AE.Empresa=RC.Empresa) 
                ELSE 
                    (SELECT 
                        UPPER(AE.Nombre_Cliente) 
                    FROM 
                        [rh_Ventas_Alta] AE 
                    WHERE AE.Cliente=RC.Cliente) 
                END),
            [Razon] = ISNULL(RF.Razon_Social, RC.Razon),
            Nombre_Candidato=UPPER(CD.Nombres +' '+ CD.Apellido_Paterno +' '+ CD.Apellido_Materno),
            [Servicio_Solicitado] = (SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio_Solicitado),
            Fase = CASE WHEN RC.Servicio>0 THEN(SELECT UPPER(TS.Descripcion) FROM sys_Campos TS WHERE TS.Campo=RC.Servicio)ELSE' -sin asignar-'END,
            Fecha_Entregado,
            Estado =UPPER((SELECT 
                                ES.Descripcion 
                            FROM 
                                sys_Campos ES 
                            WHERE 
                                ES.Campo= RC.Estado)),
            [Ejecutivo] = UPPER(RC.Ejecutivo),
            RC.CC_Cliente,
            RC.Factura,
            RC.Puesto,
            [Solicita] = ISNULL((SELECT Nombre FROM rh_Candidatos_Personas_Solicitan WHERE ID=RC.Nombre_Cliente),''),
            [CC_RHI] = (SELECT Centro_Costos FROM rh_Ventas_Alta VA WHERE VA.Cliente=RC.Cliente),
            [Ciudad]=(SELECT Municipio FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato),
            [Edo]=(SELECT Descripcion FROM General_Estados WHERE Estado=(SELECT Estado FROM rh_Candidatos_Ubicacion WHERE Candidato=RC.Candidato)),
            [Viabilidad] = (select CONVERT(varchar(1), Viable) from rh_Candidatos_Obs_Generales where Candidato=Rc.Candidato)
        FROM
                rh_Candidatos RC
            INNER JOIN
                rh_Candidatos_Datos CD
            ON
                RC.Candidato=CD.Candidato
            LEFT JOIN
                rh_Candidatos_Facturas RF
            ON 
                RC.Factura=RF.Folio_Factura
        WHERE Factura=:folio
        ORDER BY
            Fecha DESC");
        $stmt->bindParam(":folio", $Folio_Factura, PDO::PARAM_STR);
        $stmt->execute();
        $ordenes = $stmt->fetchAll();
        return $ordenes;
	}

    public function update() {
		$result = false;

		$Folio_Factura = $this->getFolio_Factura();
		$Fecha_Emision = $this->getFecha_Emision();
		$Estado_OC = $this->getEstado_OC();
		$Comentarios = $this->getComentarios();
		$Fecha_Prox_Gestion = $this->getFecha_Prox_Gestion();
		$Folio = $this->getFolio();

		$stmt = $this->db->prepare("UPDATE rh_Candidatos_Facturas_OC SET Folio_Factura=:Folio_Factura, Fecha_Emision=:Fecha_Emision, Estado_OC=:Estado_OC, Comentarios=:Comentarios, Fecha_Prox_Gestion=:Fecha_Prox_Gestion WHERE Folio_Factura=:Folio");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Emision", $Fecha_Emision, PDO::PARAM_STR);
		$stmt->bindParam(":Estado_OC", $Estado_OC, PDO::PARAM_STR);
		$stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Prox_Gestion", $Fecha_Prox_Gestion, PDO::PARAM_STR);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_STR);
		
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
		$Estado = $this->getEstado_OC();

		$stmt = $this->db->prepare("UPDATE rh_Candidatos SET Factura=:Folio_Factura, Razon=:Razon_Social, Estado=:Estado WHERE Factura=:Folio");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
		$stmt->bindParam(":Razon_Social", $Razon_Social, PDO::PARAM_STR);
		$stmt->bindParam(":Folio", $Folio, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $Estado, PDO::PARAM_STR);
		
        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
	}

    public function ordenExiste(){
        $result = FALSE;
        $folio = $this->getFolio_Factura();
		$stmt = $this->db->prepare("SELECT TOP 1 Folio_Factura FROM rh_Candidatos_Facturas_OC WHERE Folio_Factura = :folio", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$stmt->bindParam(":folio", $folio, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
		$num = $stmt->rowCount();
		if ($num > 0){
			$result = $fetch->id;
		}
        return $result;
    }

    public function save() {
        $result = false;
		$Folio_Factura = $this->getFolio_Factura();
        $Estado_OC = 'Pendiente';
        $Comentarios = '';

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Facturas_OC(Folio_Factura, Estado_OC, Comentarios, Fecha_Emision) VALUES (:Folio_Factura, :Estado_OC, :Comentarios, GETDATE())");
		$stmt->bindParam(":Folio_Factura", $Folio_Factura, PDO::PARAM_STR);
        $stmt->bindParam(":Estado_OC", $Estado_OC, PDO::PARAM_STR);
        $stmt->bindParam(":Comentarios", $Comentarios, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setFolio_Factura($this->db->lastInsertId());
        }
        return $result;
	}
}