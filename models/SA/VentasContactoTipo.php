<?php

class VentasContactoTipo
{
    private $id;
    private $nombre_tipo;
    private $status;
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

    public function getNombre_tipo()
    {
        return $this->nombre_tipo;
    }

    public function setNombre_tipo($nombre_tipo)
    {
        $this->nombre_tipo = $nombre_tipo;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    //===[gabo 28 julio modulo areas]===
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM rh_ventaS_Contacto_tipo WHERE status=1 ORDER BY id ASC;");
        $stmt->execute();
        $subareas = $stmt->fetchAll();
        return $subareas;
    }
}
