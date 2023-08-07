<?php 

class Candidatos{ 
//rh_Candidatos
private $Candidato;
private $Creado;
private $Modificado;
private $Comentario_Escolaridad;
private $Fecha;
private $Ejecutivo;
private $Foto;
private $Puesto;
private $Servicio;
private $Ciudad;
private $Gestor;
private $Estado;
private $Comentario_Docuemntos;
private $Fecha_Entregado;
private $Factura;
private $Comentario_Economia;
private $Cliente;
private $Nombre_Cliente;
private $CC_Cliente;
private $Razon;
private $Plaza_cliente;
private $Solicitud_De;
private $Fecha_Entregado_RAL;
private $Fecha_Entregado_INV;
private $Servicio_Solicitado;
private $Tipo_Investigacion;
private $Comentario_Cliente;
private $Comentario_Cancelado;
private $Comentario_Cohabitan;
private $Comentario_Vivienda;
private $Enlace_Drive;


public function __construct() {
    $this->db = Connection::connectSA();
}


public function getCandidato(){
    return $this->Candidato;
}

public function setCandidato($Candidato){
    $this->Candidato = $Candidato;
}

public function getCreado(){
    return $this->Creado;
}

public function setCreado($Creado){
    $this->Creado = $Creado;
}

public function getModificado(){
    return $this->Modificado;
}

public function setModificado($Modificado){
    $this->Modificado = $Modificado;
}

public function getComentario_Escolaridad(){
    return $this->Comentario_Escolaridad;
}

public function setComentario_Escolaridad($Comentario_Escolaridad){
    $this->Comentario_Escolaridad = $Comentario_Escolaridad;
}

public function getFecha(){
    return $this->Fecha;
}

public function setFecha($Fecha){
    $this->Fecha = $Fecha;
}

public function getEjecutivo(){
    return $this->Ejecutivo;
}

public function setEjecutivo($Ejecutivo){
    $this->Ejecutivo = $Ejecutivo;
}

public function getFoto(){
    return $this->Foto;
}

public function setFoto($Foto){
    $this->Foto = $Foto;
}

public function getPuesto(){
    return $this->Puesto;
}

public function setPuesto($Puesto){
    $this->Puesto = $Puesto;
}

public function getServicio(){
    return $this->Servicio;
}

public function setServicio($Servicio){
    $this->Servicio = $Servicio;
}

public function getCiudad(){
    return $this->Ciudad;
}

public function setCiudad($Ciudad){
    $this->Ciudad = $Ciudad;
}

public function getGestor(){
    return $this->Gestor;
}

public function setGestor($Gestor){
    $this->Gestor = $Gestor;
}

public function getEstado(){
    return $this->Estado;
}

public function setEstado($Estado){
    $this->Estado = $Estado;
}

public function getComentario_Docuemntos(){
    return $this->Comentario_Docuemntos;
}

public function setComentario_Docuemntos($Comentario_Docuemntos){
    $this->Comentario_Docuemntos = $Comentario_Docuemntos;
}

public function getFecha_Entregado(){
    return $this->Fecha_Entregado;
}

public function setFecha_Entregado($Fecha_Entregado){
    $this->Fecha_Entregado = $Fecha_Entregado;
}

public function getFactura(){
    return $this->Factura;
}

public function setFactura($Factura){
    $this->Factura = $Factura;
}

public function getComentario_Economia(){
    return $this->Comentario_Economia;
}

public function setComentario_Economia($Comentario_Economia){
    $this->Comentario_Economia = $Comentario_Economia;
}

public function getCliente(){
    return $this->Cliente;
}

public function setCliente($Cliente){
    $this->Cliente = $Cliente;
}

public function getNombre_Cliente(){
    return $this->Nombre_Cliente;
}

public function setNombre_Cliente($Nombre_Cliente){
    $this->Nombre_Cliente = $Nombre_Cliente;
}

public function getCC_Cliente(){
    return $this->CC_Cliente;
}

public function setCC_Cliente($CC_Cliente){
    $this->CC_Cliente = $CC_Cliente;
}

public function getRazon(){
    return $this->Razon;
}

public function setRazon($Razon){
    $this->Razon = $Razon;
}

public function getPlaza_cliente(){
    return $this->Plaza_cliente;
}

public function setPlaza_cliente($Plaza_cliente){
    $this->Plaza_cliente = $Plaza_cliente;
}

public function getSolicitud_De(){
    return $this->Solicitud_De;
}

public function setSolicitud_De($Solicitud_De){
    $this->Solicitud_De = $Solicitud_De;
}

public function getFecha_Entregado_RAL(){
    return $this->Fecha_Entregado_RAL;
}

public function setFecha_Entregado_RAL($Fecha_Entregado_RAL){
    $this->Fecha_Entregado_RAL = $Fecha_Entregado_RAL;
}

public function getFecha_Entregado_INV(){
    return $this->Fecha_Entregado_INV;
}

public function setFecha_Entregado_INV($Fecha_Entregado_INV){
    $this->Fecha_Entregado_INV = $Fecha_Entregado_INV;
}

public function getServicio_Solicitado(){
    return $this->Servicio_Solicitado;
}

public function setServicio_Solicitado($Servicio_Solicitado){
    $this->Servicio_Solicitado = $Servicio_Solicitado;
}

public function getTipo_Investigacion(){
    return $this->Tipo_Investigacion;
}

public function setTipo_Investigacion($Tipo_Investigacion){
    $this->Tipo_Investigacion = $Tipo_Investigacion;
}

public function getComentario_Cliente(){
    return $this->Comentario_Cliente;
}

public function setComentario_Cliente($Comentario_Cliente){
    $this->Comentario_Cliente = $Comentario_Cliente;
}

public function getComentario_Cancelado(){
    return $this->Comentario_Cancelado;
}

public function setComentario_Cancelado($Comentario_Cancelado){
    $this->Comentario_Cancelado = $Comentario_Cancelado;
}

public function getComentario_Cohabitan(){
    return $this->Comentario_Cohabitan;
}

public function setComentario_Cohabitan($Comentario_Cohabitan){
    $this->Comentario_Cohabitan = $Comentario_Cohabitan;
}

public function getComentario_Vivienda(){
    return $this->Comentario_Vivienda;
}

public function setComentario_Vivienda($Comentario_Vivienda){
    $this->Comentario_Vivienda = $Comentario_Vivienda;
}

public function getEnlace_Drive(){
    return $this->Enlace_Drive;
}

public function setEnlace_Drive($Enlace_Drive){
    $this->Enlace_Drive = $Enlace_Drive;
}


public function getAll(){
    $Candidato=$this->getCandidato();
    $stmt = $this->db->prepare(
        "SELECT * FROM rh_Candidatos_Vivienda"
    );
    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
    $stmt->execute();
    $servicios = $stmt->fetchAll();
    return $servicios;
}

public function getOne(){
    $Candidato=$this->getCandidato();
    $stmt = $this->db->prepare(
        "SELECT * FROM rh_Candidatos_Vivienda WHERE Candidato=:Candidato"
    );
    $stmt->bindParam(":Candidato", $Candidato, PDO::PARAM_INT);
    $stmt->execute();
    $fetch = $stmt->fetchObject();
    return $fetch;
}


 }