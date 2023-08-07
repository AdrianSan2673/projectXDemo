<?php
class RH_Module
{
    private $id;
    private $factura;
    private $cost;
    private $id_cliente;
    private $status;
    private $days;
    private $id_package;
    private $created_at;
    private $cancellation_date;
    private $cost_package;
    private $start_date;
    private $comment;
    //===[gabo 17 julio corte]===
    private $billed_days;
    //===[gabo 17 julio corte fin]===
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

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function setDays($days)
    {
        $this->days = $days;
    }

    public function getId_package()
    {
        return $this->id_package;
    }

    public function setId_package($id_package)
    {
        $this->id_package = $id_package;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCancellation_date()
    {
        return $this->cancellation_date;
    }

    public function setCancellation_date($cancellation_date)
    {
        $this->cancellation_date = $cancellation_date;
    }

    public function getCost_package()
    {
        return $this->cost_package;
    }

    public function setCost_package($cost_package)
    {
        $this->cost_package = $cost_package;
    }

    public function getStart_date()
    {
        return $this->start_date;
    }

    public function setStart_date($start_date)
    {
        $this->start_date = $start_date;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    //===[gabo 17 julio corte]===
    public function getBilled_days()
    {
        return $this->billed_days;
    }

    public function setBilled_days($billed_days)
    {
        $this->billed_days = $billed_days;
    }
    //===[gabo 17 julio corte fin]===
    public function getOne()
    {
        $id = $this->getId();
        $stmt = $this->db->prepare("SELECT  rm.factura,rm.id,rv.Nombre_Cliente,rm.status,rm.days,rm.cost,prh.name,rv.cliente FROM rh_module rm INNER JOIN rh_Ventas_Alta rv ON rm.id_cliente=rv.Cliente INNER JOIN root.packages_RH prh ON prh.id=rm.id_package WHERE rm.id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getOneByIdCliente()
    {
        $id_cliente = $this->getId_cliente();
        $stmt = $this->db->prepare("SELECT rm.*,prh.name,rv.cliente 
        FROM rh_module rm INNER JOIN rh_Ventas_Alta rv ON rm.id_cliente=rv.Cliente INNER JOIN root.packages_RH prh ON prh.id=rm.id_package 
        WHERE rm.id_cliente=:id_cliente Order by created_at desc");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchObject();
        return $fetch;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT rm.start_date, rm.factura,rm.id,rv.Nombre_Cliente,rm.status,rm.days,rm.cost,prh.name FROM rh_module rm INNER JOIN rh_Ventas_Alta rv ON rm.id_cliente=rv.Cliente INNER JOIN root.packages_RH prh  ON prh.id=rm.id_package  WHERE rm.status=252  order by rm.id");
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }


    public function update()
    {

        $result = false;

        $id = $this->getId();
        $Factura = $this->getFactura();
        $status = $this->getStatus();

        $stmt = $this->db->prepare("UPDATE rh_module SET factura=:Factura,status=:status WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Factura", $Factura, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
            $this->setId($this->db->lastInsertId());
        }
        return $result;
    }



    //=============================[ULISES ]
    public function updateCancel()
    {
        $id = $this->getId();
        $cancellation_date = $this->getCancellation_date();
        $comment = $this->getComment();

        $stmt = $this->db->prepare("UPDATE rh_module SET comment=:comment,cancellation_date=:cancellation_date WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":cancellation_date", $cancellation_date, PDO::PARAM_STR);
        $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);

        $result = $stmt->execute();

        return $result;
    }

    public function save()
    {

        $cost = $this->getCost();
        $id_cliente = $this->getId_cliente();
        $id_package = $this->getId_package();
        $days = $this->getDays();
        $status = $this->getStatus();
        $cost_package = $this->getCost_package();
        $start_date = $this->getStart_date();

        $stmt = $this->db->prepare("INSERT INTO rh_module (cost,id_cliente,status,	days,	id_package,	created_at,start_date,cost_package) VALUES (:cost,:id_cliente,:status,:days,:id_package, GETDATE(),:start_date,:cost_package)");

        $stmt->bindParam(":cost", $cost, PDO::PARAM_INT);
        $stmt->bindParam(":cost_package", $cost_package, PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(":id_package", $id_package, PDO::PARAM_STR);
        $stmt->bindParam(":days", $days, PDO::PARAM_STR);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":start_date", $start_date, PDO::PARAM_STR);


        $fetch = $stmt->execute();
        return $fetch;
    }
    //===[gabo 14 julio corte fin]===

    //===[gabo 17 julio  corte]===
    public function getOneByIdClienteSinFactura()
    {
        $id_cliente = $this->getId_cliente();
        $stmt = $this->db->prepare("SELECT TOP (1) rm.*,prh.name,rv.cliente 
                FROM rh_module rm INNER JOIN rh_Ventas_Alta rv ON rm.id_cliente=rv.Cliente INNER JOIN packages_RH prh ON prh.id=rm.id_package 
                WHERE rm.id_cliente=:id_cliente  AND rm.factura is Null  Order by created_at desc");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    //===[gabo 17 julio corte fin]===

    //===[gabo 14 julio  corte]===

    public function getALL_Clientes()
    {
        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta  where Cliente in( SELECT DISTINCT(id_cliente) FROM rh_module)");
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }



    //===[gabo 18 julio diario]===
    public function getAllServices_NoPaid_ByCliente()
    {
        $id_cliente = $this->getId_cliente();
        $stmt = $this->db->prepare(" SELECT  rm.days,rm.start_date,rm.id_cliente,rm.factura,rm.id_package,prh.name,rv.cliente,rv.Dias_Credito,rb.status as status_factura,rb.emision_date,rcfg.Promesa_Pago
                FROM rh_module rm INNER JOIN rh_Ventas_Alta rv ON rm.id_cliente=rv.Cliente INNER JOIN packages_RH prh ON prh.id=rm.id_package  LEFT JOIN rh_bills rb ON
				rb.factura=rm.factura LEFT JOIN rh_Candidatos_Facturas_Gestiones rcfg ON  rb.factura=rcfg.Folio_Factura
                WHERE rm.id_cliente=:id_cliente  Order by rm.created_at desc");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }
    //===[gabo 18 julio diario FIN]===

    public function getAllServices_NoBilled_ByCliente()
    {
        $id_cliente = $this->getId_cliente();
        $stmt = $this->db->prepare("SELECT rm.cost as cost_rh, rm.id as id_rh,rm.factura as factura_rh,rm.id_cliente AS id_cliente_rh,rm.status,rm.days,rm.id_package,rm.created_at,rm.cancellation_date,rm.cost_package,rm.start_date,rb.*, CONVERT(DATE, (SELECT top 1 Promesa_pago FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=rb.factura order by Fecha desc)) as Promesa_Pago
FROM rh_module rm LEFT JOIN rh_bills rb ON rm.factura=rb.factura INNER JOIN packages_RH prh 
ON prh.id=rm.id_package  WHERE rm.id_cliente=:id_cliente AND  rb.status is NULL AND rm.status=252 and rm.cost=0  order by rm.created_at DESC");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }


    public function getAllServices_ByCliente()
    {
        $id_cliente = $this->getId_cliente();
        $stmt = $this->db->prepare("SELECT rm.*,rb.*, CONVERT(DATE, (SELECT top 1 Promesa_pago FROM rh_Candidatos_Facturas_Gestiones WHERE Folio_Factura=rb.factura order by Fecha desc)) as Promesa_Pago
FROM rh_module rm LEFT JOIN rh_bills rb ON rm.factura=rb.factura INNER JOIN packages_RH prh 
ON prh.id=rm.id_package  WHERE rm.id_cliente=:id_cliente  order by rm.created_at DESC");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch =  $stmt->fetchAll();
        return $fetch;
    }   //===[gabo 14 julio  corte]===

    //===[gabo 17 julio corte]===
    public function corte()
    {
        $id = $this->getId();
        $cost = $this->getcost();
        $billed_days = $this->getBilled_days();

        $stmt = $this->db->prepare("UPDATE rh_module SET cost=:cost,billed_days=:billed_days WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":cost", $cost, PDO::PARAM_STR);
        $stmt->bindParam(":billed_days", $billed_days, PDO::PARAM_STR);

        $result = $stmt->execute();

        return $result;
    }
    //===[gabo 17 julio corte fin]===



    //===[gabo  7 julio corte fin]===
}
