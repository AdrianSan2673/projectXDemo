<?php

class AvisoClientes
{

    private $id;
    private $titulo;
    private $subtitulo;
    private $descripcion;
    private $fecha_creacion;
    private $url;
    private $estado;
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

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getFecha_creacion()
    {
        return $this->fecha_creacion;
    }

    public function setFecha_creacion($fecha_creacion)
    {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }



    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM root.rh_Avisos_Clientes WHERE estado=2 OR estado=3 ORDER BY fecha_creacion DESC ");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }

    public function getAllSA()
    {
        $stmt = $this->db->prepare("SELECT * FROM root.rh_Avisos_Clientes  WHERE estado=2 ORDER BY fecha_creacion DESC ");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
    public function getAllReclu()
    {
        $stmt = $this->db->prepare("SELECT * FROM root.rh_Avisos_Clientes  WHERE estado=3 ORDER BY fecha_creacion DESC ");
        $stmt->execute();
        $servicios = $stmt->fetchAll();
        return $servicios;
    }
}


