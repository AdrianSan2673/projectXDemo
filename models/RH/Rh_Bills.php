<?php

class RH_Bills
{
    private $id;
    private $factura_anterior;
    private $factura;
    private $emision_date;
    private $id_cliente;
    private $cost;
    private $status;
    private $iva_amount;
    private $payment_date;
    private $id_package;
    private $razon_social;
    private $created_at;
    private $Proxima_Gestion;
    private $Promesa_Pago;
    private $db;



    public function __construct()
    {
        $this->db = Connection::connectSA();
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFactura()
    {
        return $this->factura;
    }

    public function setFactura($factura)
    {
        $this->factura = $factura;
    }

    public function getFactura_Anterior()
    {
        return $this->factura_anterior;
    }

    public function setFactura_Anterior($factura_anterior)
    {
        $this->factura_anterior = $factura_anterior;
    }


    public function getEmision_date()
    {
        return $this->emision_date;
    }

    public function setEmision_date($emision_date)
    {
        $this->emision_date = $emision_date;
    }

    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getIva_amount()
    {
        return $this->iva_amount;
    }

    public function setIva_amount($iva_amount)
    {
        $this->iva_amount = $iva_amount;
    }

    public function getPayment_date()
    {
        return $this->payment_date;
    }

    public function setPayment_date($payment_date)
    {
        $this->payment_date = $payment_date;
    }

    public function getId_package()
    {
        return $this->id_package;
    }

    public function setId_package($id_package)
    {
        $this->id_package = $id_package;
    }

    public function getRazon_social()
    {
        return $this->razon_social;
    }

    public function setRazon_social($razon_social)
    {
        $this->razon_social = $razon_social;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getProxima_Gestion()
    {
        return $this->Proxima_Gestion;
    }

    public function setProxima_Gestion($Proxima_Gestion)
    {
        $this->Proxima_Gestion = $Proxima_Gestion;
    }




    public function save()
    {
        $result = false;
        $ID_Cliente = $this->getID_Cliente();
        $razon = $this->getRazon_social();
        $factura = $this->getFactura();
        $status = $this->getStatus();



        $stmt = $this->db->prepare("INSERT INTO rh_bills(factura,ID_Cliente,created_at,emision_date,cost,razon_social,status) VALUES (:factura,:ID_Cliente,  GETDATE(),GETDATE(),0,:razon,:status)");
        $stmt->bindParam(":factura", $factura, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":razon", $razon, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $this->setId($this->db->lastInsertId());
        }
        return $flag;
    }



    public function update()
    {
        $resultado = false;
        $razon = $this->getRazon_social();
        $factura = $this->getFactura();
        $status = $this->getStatus();
        $cost = $this->getCost();
        $id = $this->getId();
        $payment_date = $this->getPayment_date();
        $emision_date = $this->getEmision_date();
        $stmt = $this->db->prepare("UPDATE rh_bills set factura=:factura,status=:status,emision_date=:emision_date,cost=:cost,razon_social=:razon,payment_date=:payment_date where id=:id");
        $stmt->bindParam(":factura", $factura, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":razon", $razon, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":payment_date", $payment_date, PDO::PARAM_STR);
        $stmt->bindParam(":cost", $cost, PDO::PARAM_INT);
        $stmt->bindParam(":emision_date", $emision_date, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $resultado = true;
        }
        return $resultado;
    }



    public function getOne()
    {

        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT CF.*, DATEDIFF(DAY, emision_date, GETDATE()) AS Dias_Transcurridos, E.Nombre_Empresa,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito,
          (SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as nombre_cliente,
          CONVERT(DATE, (SELECT top 1 Promesa_pago FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc)) as Promesa_Pago,
           (SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=CF.id_cliente) as Nombre_Cliente,
           (SELECT Nombre_Razon FROM rh_Ventas_Cliente_Razones WHERE ID_Razon=CF.razon_social AND ID_Cliente=CF.id_cliente) as razon
       FROM rh_bills CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa WHERE CF.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM rh_bills ");
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }

    public function facturaExiste()
    {
        $result = FALSE;
        $factura = $this->getFactura();
        $stmt = $this->db->prepare("SELECT TOP 1 factura FROM rh_bills WHERE factura = :factura");
        $stmt->bindParam(":factura", $factura, PDO::PARAM_STR);
        $stmt->execute();
        $fetch = $stmt->fetchObject();

        return $fetch;
    }


    public function getFacturasPendientes()
    {
        $stmt = $this->db->prepare("SELECT CF.*, DATEDIFF(DAY, emision_date, GETDATE()) AS Dias_Transcurridos, E.Nombre_Empresa,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito,
          (SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as nombre_cliente,
           (SELECT top 1 Promesa_pago FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc) as Promesa_Pago,
           (SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=CF.id_cliente) as Nombre_Cliente,
           (SELECT Nombre_Razon FROM rh_Ventas_Cliente_Razones WHERE ID_Razon=CF.razon_social AND ID_Cliente=CF.id_cliente) as razon
       FROM rh_bills CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa WHERE status='Pendiente de pago' ORDER BY emision_Date ASC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
    }


    public function getFacturasPagadas()
    {
        $stmt = $this->db->prepare("SELECT CF.*, DATEDIFF(DAY, emision_date, GETDATE()) AS Dias_Transcurridos, E.Nombre_Empresa,
        (SELECT top 1 Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc) as Ultima_Gestion,
        (SELECT top 1 Fecha FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc) as Fecha_Ultima_Gestion,
         (SELECT Dias_Credito FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as Plazo_Credito,
          (SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=CF.ID_Cliente) as nombre_cliente,
            (SELECT top 1 Promesa_pago FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=CF.factura order by Fecha desc) as Promesa_Pago,
           (SELECT Nombre_Cliente FROM rh_Ventas_Alta WHERE Cliente=CF.id_cliente) as Nombre_Cliente,
           (SELECT Nombre_Razon FROM rh_Ventas_Cliente_Razones WHERE ID_Razon=CF.razon_social AND ID_Cliente=CF.id_cliente) as razon
	   FROM rh_bills CF INNER JOIN rh_Ventas_Alta V ON CF.ID_Cliente=V.Cliente INNER JOIN rh_Ventas_Empresas E ON V.Empresa=E.Empresa WHERE status='Pagada' ORDER BY emision_date DESC");
        $stmt->execute();
        $facturas = $stmt->fetchAll();
        return $facturas;
    }



    public function updateSeguimientosPorFolio()
    {
        $result = false;

        $factura = $this->getFactura();
        $factura_anterior = $this->getFactura_Anterior();

        $stmt = $this->db->prepare("UPDATE rh_Candidatos_Facturas_Gestiones SET Folio_Factura=:factura  WHERE Folio_Factura=:factura_anterior");
        $stmt->bindParam(":factura_anterior", $factura_anterior, PDO::PARAM_STR);
        $stmt->bindParam(":factura", $factura, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }


    public function updateFolioYRazonDeServiciosPorFolio()
    {
        $result = false;

        $factura = $this->getFactura();
        $factura_anterior = $this->getFactura_Anterior();


        $stmt = $this->db->prepare("UPDATE rh_module SET Factura=:factura, status=254 WHERE factura=:factura_anterior");
        $stmt->bindParam(":factura_anterior", $factura_anterior, PDO::PARAM_STR);
        $stmt->bindParam(":factura", $factura, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }


    public function updateFollowUp()
    {
        $result = false;
        $id = $this->getId();
        $Proxima_Gestion = $this->getProxima_Gestion();

        $stmt = $this->db->prepare("UPDATE rh_bills SET Proxima_Gestion=:Proxima_Gestion WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":Proxima_Gestion", $Proxima_Gestion, PDO::PARAM_STR);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            //$this->setFolio_Factura($this->db->lastInsertId());
        }
        return $result;
    }


    public function getSeguimientosPorFolio()
    {
        $factura = $this->getFactura();
        $stmt = $this->db->prepare("SELECT Fecha,Usuario,Folio_Factura,Contacto_Con,Promesa_Pago,Comentarios FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=:factura ORDER BY Fecha DESC");
        $stmt->bindParam(":factura", $factura, PDO::PARAM_STR);
        $stmt->execute();
        $follow_ups = $stmt->fetchAll();
        return $follow_ups;
    }

  public function getServiciosPorIDFactura()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT * FROM rh_module rm INNER JOIN rh_bills rb ON rm.factura=rb.factura  INNER JOIN rh_Ventas_Alta rv ON rm.id_cliente=rv.Cliente INNER JOIN root.packages_RH pr ON pr.id= rm.id_package where rb.id=:id ");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $facturas = $stmt->fetchAll();

        return $facturas;
    }
}
