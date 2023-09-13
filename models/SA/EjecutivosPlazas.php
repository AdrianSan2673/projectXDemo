<?php

class EjecutivosPlazas
{
    private $ID;
    private $ID_Cliente;
    private $ID_Empresa;
    private $ID_Ejecutivo;
    private $Fecha;

    private $db;

    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getID_Cliente()
    {
        return $this->ID_Cliente;
    }

    public function setID_Cliente($ID_Cliente)
    {
        $this->ID_Cliente = $ID_Cliente;
    }

    public function getID_Empresa()
    {
        return $this->ID_Empresa;
    }

    public function setID_Empresa($ID_Empresa)
    {
        $this->ID_Empresa = $ID_Empresa;
    }

    public function getID_Ejecutivo()
    {
        return $this->ID_Ejecutivo;
    }

    public function setID_Ejecutivo($ID_Ejecutivo)
    {
        $this->ID_Ejecutivo = $ID_Ejecutivo;
    }

    public function getFecha()
    {
        return $this->Fecha;
    }

    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }


    public function getOne()
    {
        $ID = $this->getID();
        $stmt = $this->db->prepare("SELECT * FROM rh_Candidatos_Ejecutivos_Plazas WHERE ID=:ID");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_STR);

        $stmt->execute();
        $result  = $stmt->fetchObject();


        return $result;
    }

    public function getOneByIdEjecutivo()
    {
        $ID_Ejecutivo = $this->getID();
        $stmt = $this->db->prepare("SELECT * FROM rh_Candidatos_Ejecutivos_Plazas WHERE ID_Ejecutivo=:ID_Ejecutivo");
        $stmt->bindParam(":ID_Ejecutivo", $ID_Ejecutivo, PDO::PARAM_STR);

        $stmt->execute();
        $result  = $stmt->fetchObject();


        return $result;
    }

    public function getClientesSinAsignar()
    {
        $ID_Ejecutivo = $this->getID_Ejecutivo();
        $stmt = $this->db->prepare("SELECT c.* FROM rh_Ventas_Alta c WHERE Cliente NOT IN ( SELECT p.ID_Cliente FROM rh_Candidatos_Ejecutivos_Plazas p WHERE p.ID_Ejecutivo=:ID_Ejecutivo) ORDER BY Nombre_Cliente");
        $stmt->bindParam(":ID_Ejecutivo", $ID_Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
    }

    public function getClientesPorEjecutivo()
    {
        $ID_Ejecutivo = $this->getID_Ejecutivo();

        $stmt = $this->db->prepare("SELECT c.*,p.ID FROM rh_Ventas_Alta c INNER JOIN rh_Candidatos_Ejecutivos_Plazas p ON c.Cliente=p.ID_Cliente WHERE p.ID_Ejecutivo=:ID_Ejecutivo ORDER BY Nombre_Cliente 
        ");
        $stmt->bindParam(":ID_Ejecutivo", $ID_Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $customers = $stmt->fetchAll();
        return $customers;
    }

    public function getEjecutivosPorCliente()
    {
        $ID_Cliente = $this->getID_Cliente();

        $stmt = $this->db->prepare("SELECT s.* FROM rh_Ventas_Alta c INNER JOIN rh_Candidatos_Ejecutivos_Plazas p ON c.Cliente=p.ID_Cliente INNER JOIN reclutamiento.dbo.users s ON p.ID_Ejecutivo=s.username WHERE c.Cliente=:Cliente AND id_user_type=13 ORDER BY s.username");
        $stmt->bindParam(":Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $ejecutivos = $stmt->fetchAll();
        return $ejecutivos;
    }

    public function getEjecutivosPorClienteLogistica()
    {
        $ID_Cliente = $this->getID_Cliente();

        $stmt = $this->db->prepare("SELECT TOP 1 s.* FROM rh_Ventas_Alta c INNER JOIN rh_Candidatos_Ejecutivos_Plazas p ON c.Cliente=p.ID_Cliente INNER JOIN reclutamiento.dbo.users s ON p.ID_Ejecutivo=s.username WHERE c.Cliente=:Cliente AND id_user_type=14 ORDER BY s.username");
        $stmt->bindParam(":Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function create()
    {
        $result = false;

        $ID_Ejecutivo = $this->getID_Ejecutivo();
        $ID_Empresa = $this->getID_Empresa();
        $ID_Cliente = $this->getID_Cliente();

        $stmt = $this->db->prepare("INSERT INTO rh_Candidatos_Ejecutivos_Plazas(ID_Ejecutivo, ID_Empresa, ID_Cliente, Fecha) VALUES (:ID_Ejecutivo, :ID_Empresa,  :ID_Cliente, GETDATE())");
        $stmt->bindParam(":ID_Ejecutivo", $ID_Ejecutivo, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Empresa", $ID_Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);

        $flag = $stmt->execute();
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $result = false;
        $ID = $this->getID();
        $ID_Ejecutivo = $this->getID_Ejecutivo();

        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Ejecutivos_Plazas WHERE ID=:ID and ID_Ejecutivo=:ID_Ejecutivo");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Ejecutivo", $ID_Ejecutivo, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function deleteAll()
    {
        $result = false;
        $ID_Ejecutivo = $this->getID_Ejecutivo();

        $stmt = $this->db->prepare("DELETE FROM rh_Candidatos_Ejecutivos_Plazas WHERE ID_Ejecutivo=:ID_Ejecutivo");
        $stmt->bindParam(":ID_Ejecutivo", $ID_Ejecutivo, PDO::PARAM_STR);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }


  public function getEjecutivoPorCliente()
    {
        $ID_Cliente = $this->getID_Cliente();

        $stmt = $this->db->prepare("SELECT * FROM rh_Candidatos_Ejecutivos_Plazas WHERE ID_Cliente=:Cliente");
        $stmt->bindParam(":Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $ejecutivos = $stmt->fetchAll();
        return $ejecutivos;
    }


}
