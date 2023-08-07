<?php

class ContactosCliente
{

    private $ID;
    private $ID_Cliente;
    private $ID_Empresa;
    private $ID_Contacto;
    private $Nombre_Contacto;
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

    public function getID_Contacto()
    {
        return $this->ID_Contacto;
    }

    public function setID_Contacto($ID_Contacto)
    {
        $this->ID_Contacto = $ID_Contacto;
    }

    public function getNombre_Contacto()
    {
        return $this->Nombre_Contacto;
    }

    public function setNombre_Contacto($Nombre_Contacto)
    {
        $this->Nombre_Contacto = $Nombre_Contacto;
    }

    public function getFecha()
    {
        return $this->Fecha;
    }

    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    public function getContactosPorCliente()
    {
        $ID_Cliente = $this->getID_Cliente();

        $stmt = $this->db->prepare("SELECT *, ce.Nombre_Contacto FROM rh_Ventas_Alta_Contactos ce INNER JOIN rh_Ventas_Cliente_Contactos cc ON ce.ID=cc.ID_Contacto WHERE ID_Cliente=:ID_Cliente AND ce.Activo=1 ORDER BY ce.Nombre_Contacto");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getByContactoYCliente()
    {
        $ID_Cliente = $this->getID_Cliente();
        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare("SELECT *, ce.Nombre_Contacto FROM rh_Ventas_Alta_Contactos ce INNER JOIN rh_Ventas_Cliente_Contactos cc ON ce.ID=cc.ID_Contacto WHERE ID_Cliente=:ID_Cliente AND ID_Contacto=:ID_Contacto");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam("ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getOne()
    {
        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare("SELECT ce.*, cc.*, dbo.fn_Seg_Desencriptar(u.Clave) AS Contrasena, ce.Nombre_Contacto FROM rh_Ventas_Alta_Contactos ce INNER JOIN rh_Ventas_Cliente_Contactos cc ON ce.ID=cc.ID_Contacto LEFT JOIN Seguridad_Usuarios u ON ce.Usuario=u.Usuario WHERE ID_Contacto=:ID_Contacto");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function create()
    {
        $result = false;

        $ID_Cliente = $this->getID_Cliente();
        $ID_Empresa = $this->getID_Empresa();
        $ID_Contacto = $this->getID_Contacto();
        $Nombre_Contacto = $this->getNombre_Contacto();

        $stmt = $this->db->prepare("INSERT INTO rh_Ventas_Cliente_Contactos(ID_Cliente, ID_Empresa, ID_Contacto, Nombre_Contacto, Fecha) VALUES (:ID_Cliente, :ID_Empresa, :ID_Contacto, :Nombre_Contacto, GETDATE())");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $stmt->bindParam(":ID_Empresa", $ID_Empresa, PDO::PARAM_STR);
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_STR);
        $stmt->bindParam(":Nombre_Contacto", $Nombre_Contacto, PDO::PARAM_STR);
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

        $stmt = $this->db->prepare("DELETE FROM rh_Ventas_Cliente_Contactos WHERE ID=:ID");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function deleteContactosPorCliente()
    {
        $result = false;

        $ID_Cliente = $this->getID_Cliente();

        $stmt = $this->db->prepare("DELETE FROM rh_Ventas_Cliente_Contactos WHERE ID_Cliente=:ID_Cliente");
        $stmt->bindParam(":ID_Cliente", $ID_Cliente, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function deleteContactosPorContacto()
    {
        $result = false;

        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare("DELETE FROM rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function getPrimerCliente()
    {
        $ID = $this->getID();

        $stmt = $this->db->prepare("SELECT TOP(1) v.* FROM rh_Ventas_Alta_Contactos ce INNER JOIN rh_Ventas_Cliente_Contactos cc ON ce.ID=cc.ID_Contacto INNER JOIN rh_Ventas_Alta v ON cc.ID_Cliente=v.Cliente WHERE ce.ID=:ID");
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getClientesByContacto()
    {

        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta
         WHERE Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto)");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }




    // ===[gabo 5 junio  departamento]===


    public function GetID_ClientesPorID_Contacto()
    {
        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare("SELECT DISTINCT(R1.ID_Cliente) from rh_Ventas_Cliente_Contactos  R1 INNER JOIN rh_Ventas_Cliente_Contactos R2 ON R1.ID_Cliente=R2.ID_Cliente where R1.ID_Contacto=:ID_Contacto ORDER BY R1.ID_Cliente DESC ");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchALL();


        return $fetch;
    }



    public function getDepartmentsByID_Clientes()
    {
        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare("SELECT DISTINCT(R1.ID_Cliente) from rh_Ventas_Cliente_Contactos  R1 INNER JOIN rh_Ventas_Cliente_Contactos R2 ON R1.ID_Cliente=R2.ID_Cliente where R1.ID_Contacto=:ID_Contacto");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchALL();


        return $fetch;
    }

    // ===[gabo 5 junio  departamento fin]===
	  public function getClientesByContactoAcriveRH()
    {

        $ID_Contacto = $this->getID_Contacto();

        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta
         WHERE Cliente IN (SELECT ID_Cliente FROM rrhhinge_Candidatos.dbo.rh_Ventas_Cliente_Contactos WHERE ID_Contacto=:ID_Contacto) and Modulo_RH=1");
        $stmt->bindParam(":ID_Contacto", $ID_Contacto, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchAll();
        return $fetch;
    }

    public function getContactoByUsername()
    {

        $id = $this->getID();

        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta_Contactos
         WHERE Usuario = (select username from  reclutamiento.dbo.users  where id=:id)");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch;
    }


}
