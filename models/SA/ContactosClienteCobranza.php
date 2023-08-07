<?php

class ContactosClienteCobranza
{

    private $id;
    private $id_cliente;
    private $Nombre;
    private $Correo;
    private $Telefono;
    private $Extension;
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


    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    public function getCorreo()
    {
        return $this->Correo;
    }

    public function setCorreo($Correo)
    {
        $this->Correo = $Correo;
    }

    public function getTelefono()
    {
        return $this->Telefono;
    }

    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }

    public function getExtension()
    {
        return $this->Extension;
    }

    public function setExtension($Extension)
    {
        $this->Extension = $Extension;
    }

    public function save()
    {
        $result = false;

        $id_cliente = $this->getId_cliente();
        $Nombre = $this->getNombre();
        $Correo = $this->getCorreo();
        $Telefono = $this->getTelefono();
        $Extension = $this->getExtension();

        $stmt = $this->db->prepare("INSERT INTO rh_Ventas_Alta_Contactos_Cobranza(id_cliente,Nombre,Correo,Telefono,Extension) VALUES (:id_cliente,:Nombre,:Correo,:Telefono,:Extension)");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_INT);
        $stmt->bindParam(":Correo", $Correo, PDO::PARAM_INT);
        $stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_INT);
        $stmt->bindParam(":Extension", $Extension, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    public function update()
    {
        $result = false;

        $id = $this->getId();
        $Nombre = $this->getNombre();
        $Correo = $this->getCorreo();
        $Telefono = $this->getTelefono();
        $Extension = $this->getExtension();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Alta_Contactos_Cobranza SET  Nombre=:Nombre,Correo=:Correo,Telefono=:Telefono,Extension=:Extension WHERE id=:id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Nombre", $Nombre, PDO::PARAM_INT);
        $stmt->bindParam(":Correo", $Correo, PDO::PARAM_INT);
        $stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_INT);
        $stmt->bindParam(":Extension", $Extension, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }


    public function delete()
    {
        $id = $this->getId();

        $stmt = $this->db->prepare("DELETE TOP(1) rh_Ventas_Alta_Contactos_Cobranza WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $fetch = $stmt->execute();
        return $fetch;
    }

    public function getOne()
    {
        $id = $this->getId();

        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta_Contactos_Cobranza WHERE id=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchObject();
        return $fetch;
    }




    public function getALLById_cliente()
    {
        $id_cliente = $this->getId_cliente();

        $stmt = $this->db->prepare("SELECT * FROM rh_Ventas_Alta_Contactos_Cobranza WHERE id_cliente=:id_cliente ORDER BY Nombre");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();

        $fetch = $stmt->fetchAll();
        return $fetch;
    }
}
