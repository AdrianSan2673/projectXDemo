<?php

class SysCampo
{
    private $Campo;
    private $Descripcion;
    private $Tabla;
    private $Usuario;
    private $Activo;
    private $Pais;

    private $db;


    public function __construct()
    {
        $this->db = Connection::connectSA();
    }

    public function getCampo()
    {
        return $this->Campo;
    }

    public function setCampo($Campo)
    {
        $this->Campo = $Campo;
    }

    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }

    public function getTabla()
    {
        return $this->Tabla;
    }

    public function setTabla($Tabla)
    {
        $this->Tabla = $Tabla;
    }

    public function getUsuario()
    {
        return $this->Usuario;
    }

    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    public function getActivo()
    {
        return $this->Activo;
    }

    public function setActivo($Activo)
    {
        $this->Activo = $Activo;
    }


    public function getPais()
    {
        return $this->Pais;
    }

    public function setPais($Pais)
    {
        $this->Pais = $Pais;
    }



    public function getCamposByTabla()
    {
        $Tabla = $this->getTabla();
        $stmt = $this->db->prepare("SELECT * FROM sys_Campos WHERE Tabla=:Tabla ORDER BY Campo");
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_INT);
        $stmt->execute();
        $campos = $stmt->fetchAll();
        return $campos;
    }

    public function getEstadosPorPais()
    {
        $Pais = $this->getPais();
        $stmt = $this->db->prepare("SELECT * FROM General_Estados WHERE Modo=:Pais ORDER BY Descripcion");
        $stmt->bindParam(":Pais", $Pais, PDO::PARAM_INT);
        $stmt->execute();
        $estados = $stmt->fetchAll();
        return $estados;
    }

    public function getEstados()
    {
        $stmt = $this->db->prepare("SELECT * FROM General_Estados ORDER BY Descripcion");
        $stmt->execute();
        $estados = $stmt->fetchAll();
        return $estados;
    }


    public function getCampoById()
    {
        $Tabla = $this->getTabla();
        $Campo = $this->getCampo();
        $stmt = $this->db->prepare("SELECT * FROM sys_Campos WHERE Tabla=:Tabla and Campo=:Campo ");
        $stmt->bindParam(":Tabla", $Tabla, PDO::PARAM_INT);
        $stmt->bindParam(":Campo", $Campo, PDO::PARAM_INT);

        $stmt->execute();
        $campo = $stmt->fetchObject();
        return $campo;
    }
}
