<?php

class RazonesSociales
{
    private $ID;
    private $ID_Cliente;
    private $ID_Empresa;
    private $ID_Razon;
    private $Nombre_Razon;
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

    public function getID_Razon()
    {
        return $this->ID_Razon;
    }

    public function setID_Razon($ID_Razon)
    {
        $this->ID_Razon = $ID_Razon;
    }

    public function getNombre_Razon()
    {
        return $this->Nombre_Razon;
    }

    public function setNombre_Razon($Nombre_Razon)
    {
        $this->Nombre_Razon = $Nombre_Razon;
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
        $ID_Razon = $this->getID_Razon();
        $stmt = $this->db->prepare("SELECT rc.*, r.Razon, r.RFC, r.Contacto, r.Otro, r.Direccion_Fiscal, r.Forma_Pago, r.Regimen_Fiscal, r.Uso_CFDI FROM rh_Ventas_Cliente_Razones rc INNER JOIN rh_Ventas_Alta_Razones r ON rc.ID_Razon=r.ID WHERE ID_Razon=:ID_Razon;");
        $stmt->bindParam(":ID_Razon", $ID_Razon, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getByRazonYCliente()
    {
        $ID_Razon = $this->getID_Razon();
        $ID_Cliente = $this->getID_Cliente();
        $stmt = $this->db->prepare("SELECT rc.*, r.Razon, r.RFC, r.Contacto, r.Otro, r.Direccion_Fiscal, r.Forma_Pago, r.Regimen_Fiscal, r.Uso_CFDI FROM rh_Ventas_Cliente_Razones rc INNER JOIN rh_Ventas_Alta_Razones r ON rc.ID_Razon=r.ID WHERE ID_Razon=:ID_Razon AND ID_Cliente=:ID_Cliente");
        $stmt->bindParam(":ID_Razon", $ID_Razon, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getRazonesSocialesPorCliente()
    {
        $ID_Cliente = $this->getID_Cliente();
        $stmt = $this->db->prepare("SELECT rc.*, r.Razon, r.RFC, r.Contacto, r.Otro, r.Direccion_Fiscal, r.Forma_Pago, r.Regimen_Fiscal, r.Uso_CFDI FROM rh_Ventas_Cliente_Razones rc INNER JOIN rh_Ventas_Alta_Razones r ON rc.ID_Razon=r.ID WHERE ID_Cliente=:ID_Cliente;");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_STR);
        $stmt->execute();
        $business_names = $stmt->fetchAll();
        return $business_names;
    }

    public function create()
    {
        $result = false;

        $ID_Cliente = $this->getID_Cliente();
        $ID_Empresa = $this->getID_Empresa();
        $ID_Razon = $this->getID_Razon();
        $Nombre_Razon = $this->getNombre_Razon();

        $stmt = $this->db->prepare("INSERT INTO rh_Ventas_Cliente_Razones(ID_Cliente, ID_Empresa, ID_Razon, Nombre_Razon, Fecha) VALUES (:ID_Cliente, :ID_Empresa, :ID_Razon, :Nombre_Razon, GETDATE())");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Empresa", $ID_Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Razon", $ID_Razon, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre_Razon", $Nombre_Razon, PDO::PARAM_STR);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function update()
    {
        $result = false;

        $ID = $this->getID();
        $ID_Empresa = $this->getID_Empresa();
        $ID_Razon = $this->getID_Razon();
        $Nombre_Razon = $this->getNombre_Razon();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Cliente_Razones SET ID_Cliente=:ID_Cliente, ID_Empresa=:ID_Empresa, ID_Razon=:ID_Razon, Nombre_Razon=:Nombre_Razon WHERE ID=:ID");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Empresa", $ID_Empresa, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Razon", $ID_Razon, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre_Razon", $Nombre_Razon, PDO::PARAM_STR);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);

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

        $stmt = $this->db->prepare("DELETE FROM rh_Ventas_Cliente_Razones WHERE ID=:ID");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function deleteRazonesPorCliente()
    {
        $result = false;

        $ID_Cliente = $this->getID_Cliente();

        $stmt = $this->db->prepare("DELETE FROM rh_Ventas_Cliente_Razones WHERE ID_Cliente=:ID_Cliente");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);

        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }


    //21 sept


    public function getRazonesSocialesPorEmpresa()
    {
        $empresa = $this->getID_Empresa();
        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Cliente_Razones WHERE ID_Empresa=:empresa");
        $stmt->bindParam(":empresa", $empresa, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
