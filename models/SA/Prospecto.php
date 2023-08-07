<?php

class Prospecto {
    private $ID;
    private $Fecha;
    private $Prospecto;
    private $Giro;
    private $Contacto_RH;
    private $Telefono;
    private $Correo;
    private $Servicio_Que_Utiliza;
    private $Proveedor_Actual;
    private $Acciones_Realizadas;
    private $Fecha_Envio_Propuesta;
    private $Fecha_Prox_Seguimiento;
    private $Estado;
    private $Plaza;
    private $Tipo;
    private $Puesto;
    private $Acciones;
    private $Periodicidad;
    private $Servicio;
    private $Ejecutivo;
    private $Cuota_Reclutamiento;
    private $Precio_Atraccion;
    private $Precio_Psicometria;
    private $Garantia_Renuncia;
    private $Precio_RAL;
    private $Precio_Inv;
    private $Precio_ESE;

    private $Tipo_Vacantes;
    private $Valor_Vacante;
    private $Precio_Ofrecido;
    private $Tiempo_Entrega;
    private $Promedio_Servicios;
    private $Acuerdos;
    private $Comentarios_Acuerdos;
    private $Oferta1;
    private $Precio1;
    private $Tiempo1;
    private $Especificar1;
    private $Garantia1;
    private $Oferta2;
    private $Precio2;
    private $Tiempo2;
    private $Especificar2;
    private $Garantia2;

    private $db;

    public function __construct() {
        $this->db = Connection::connectSA();
    }


    public function getID(){
        return $this->ID;
    }

    public function setID($ID){
        $this->ID = $ID;
    }

    public function getFecha(){
        return $this->Fecha;
    }

    public function setFecha($Fecha){
        $this->Fecha = $Fecha;
    }

    public function getProspecto(){
        return $this->Prospecto;
    }

    public function setProspecto($Prospecto){
        $this->Prospecto = $Prospecto;
    }

    public function getGiro(){
        return $this->Giro;
    }

    public function setGiro($Giro){
        $this->Giro = $Giro;
    }

    public function getContacto_RH(){
        return $this->Contacto_RH;
    }

    public function setContacto_RH($Contacto_RH){
        $this->Contacto_RH = $Contacto_RH;
    }

    public function getTelefono(){
        return $this->Telefono;
    }

    public function setTelefono($Telefono){
        $this->Telefono = $Telefono;
    }

    public function getCorreo(){
        return $this->Correo;
    }

    public function setCorreo($Correo){
        $this->Correo = $Correo;
    }

    public function getServicio_Que_Utiliza(){
        return $this->Servicio_Que_Utiliza;
    }

    public function setServicio_Que_Utiliza($Servicio_Que_Utiliza){
        $this->Servicio_Que_Utiliza = $Servicio_Que_Utiliza;
    }

    public function getProveedor_Actual(){
        return $this->Proveedor_Actual;
    }

    public function setProveedor_Actual($Proveedor_Actual){
        $this->Proveedor_Actual = $Proveedor_Actual;
    }

    public function getAcciones_Realizadas(){
        return $this->Acciones_Realizadas;
    }

    public function setAcciones_Realizadas($Acciones_Realizadas){
        $this->Acciones_Realizadas = $Acciones_Realizadas;
    }

    public function getFecha_Envio_Propuesta(){
        return $this->Fecha_Envio_Propuesta;
    }

    public function setFecha_Envio_Propuesta($Fecha_Envio_Propuesta){
        $this->Fecha_Envio_Propuesta = $Fecha_Envio_Propuesta;
    }

    public function getFecha_Prox_Seguimiento(){
        return $this->Fecha_Prox_Seguimiento;
    }

    public function setFecha_Prox_Seguimiento($Fecha_Prox_Seguimiento){
        $this->Fecha_Prox_Seguimiento = $Fecha_Prox_Seguimiento;
    }

    public function getEstado(){
        return $this->Estado;
    }

    public function setEstado($Estado){
        $this->Estado = $Estado;
    }

    public function getPlaza(){
        return $this->Plaza;
    }

    public function setPlaza($Plaza){
        $this->Plaza = $Plaza;
    }

    public function getTipo(){
        return $this->Tipo;
    }

    public function setTipo($Tipo){
        $this->Tipo = $Tipo;
    }

    public function getPuesto(){
        return $this->Puesto;
    }

    public function setPuesto($Puesto){
        $this->Puesto = $Puesto;
    }

    public function getAcciones(){
        return $this->Acciones;
    }

    public function setAcciones($Acciones){
        $this->Acciones = $Acciones;
    }

    public function getPeriodicidad(){
        return $this->Periodicidad;
    }

    public function setPeriodicidad($Periodicidad){
        $this->Periodicidad = $Periodicidad;
    }

    public function getServicio(){
        return $this->Servicio;
    }

    public function setServicio($Servicio){
        $this->Servicio = $Servicio;
    }

    public function getEjecutivo(){
        return $this->Ejecutivo;
    }

    public function setEjecutivo($Ejecutivo){
        $this->Ejecutivo = $Ejecutivo;
    }

    public function getCuota_Reclutamiento(){
        return $this->Cuota_Reclutamiento;
    }

    public function setCuota_Reclutamiento($Cuota_Reclutamiento){
        $this->Cuota_Reclutamiento = $Cuota_Reclutamiento;
    }

    public function getPrecio_Atraccion(){
        return $this->Precio_Atraccion;
    }

    public function setPrecio_Atraccion($Precio_Atraccion){
        $this->Precio_Atraccion = $Precio_Atraccion;
    }

    public function getPrecio_Psicometria(){
        return $this->Precio_Psicometria;
    }

    public function setPrecio_Psicometria($Precio_Psicometria){
        $this->Precio_Psicometria = $Precio_Psicometria;
    }

    public function getGarantia_Renuncia(){
        return $this->Garantia_Renuncia;
    }

    public function setGarantia_Renuncia($Garantia_Renuncia){
        $this->Garantia_Renuncia = $Garantia_Renuncia;
    }

    public function getPrecio_RAL(){
        return $this->Precio_RAL;
    }

    public function setPrecio_RAL($Precio_RAL){
        $this->Precio_RAL = $Precio_RAL;
    }

    public function getPrecio_Inv(){
        return $this->Precio_Inv;
    }

    public function setPrecio_Inv($Precio_Inv){
        $this->Precio_Inv = $Precio_Inv;
    }

    public function getPrecio_ESE(){
        return $this->Precio_ESE;
    }

    public function setPrecio_ESE($Precio_ESE){
        $this->Precio_ESE = $Precio_ESE;
    }

    public function getTipo_Vacantes(){
		return $this->Tipo_Vacantes;
	}

	public function setTipo_Vacantes($Tipo_Vacantes){
		$this->Tipo_Vacantes = $Tipo_Vacantes;
	}

	public function getValor_Vacante(){
		return $this->Valor_Vacante;
	}

	public function setValor_Vacante($Valor_Vacante){
		$this->Valor_Vacante = $Valor_Vacante;
	}

	public function getPrecio_Ofrecido(){
		return $this->Precio_Ofrecido;
	}

	public function setPrecio_Ofrecido($Precio_Ofrecido){
		$this->Precio_Ofrecido = $Precio_Ofrecido;
	}

	public function getTiempo_Entrega(){
		return $this->Tiempo_Entrega;
	}

	public function setTiempo_Entrega($Tiempo_Entrega){
		$this->Tiempo_Entrega = $Tiempo_Entrega;
	}

	public function getPromedio_Servicios(){
		return $this->Promedio_Servicios;
	}

	public function setPromedio_Servicios($Promedio_Servicios){
		$this->Promedio_Servicios = $Promedio_Servicios;
	}

	public function getAcuerdos(){
		return $this->Acuerdos;
	}

	public function setAcuerdos($Acuerdos){
		$this->Acuerdos = $Acuerdos;
	}

	public function getComentarios_Acuerdos(){
		return $this->Comentarios_Acuerdos;
	}

	public function setComentarios_Acuerdos($Comentarios_Acuerdos){
		$this->Comentarios_Acuerdos = $Comentarios_Acuerdos;
	}

	public function getOferta1(){
		return $this->Oferta1;
	}

	public function setOferta1($Oferta1){
		$this->Oferta1 = $Oferta1;
	}

	public function getPrecio1(){
		return $this->Precio1;
	}

	public function setPrecio1($Precio1){
		$this->Precio1 = $Precio1;
	}

	public function getTiempo1(){
		return $this->Tiempo1;
	}

	public function setTiempo1($Tiempo1){
		$this->Tiempo1 = $Tiempo1;
	}

	public function getEspecificar1(){
		return $this->Especificar1;
	}

	public function setEspecificar1($Especificar1){
		$this->Especificar1 = $Especificar1;
	}

	public function getGarantia1(){
		return $this->Garantia1;
	}

	public function setGarantia1($Garantia1){
		$this->Garantia1 = $Garantia1;
	}

	public function getOferta2(){
		return $this->Oferta2;
	}

	public function setOferta2($Oferta2){
		$this->Oferta2 = $Oferta2;
	}

	public function getPrecio2(){
		return $this->Precio2;
	}

	public function setPrecio2($Precio2){
		$this->Precio2 = $Precio2;
	}

	public function getTiempo2(){
		return $this->Tiempo2;
	}

	public function setTiempo2($Tiempo2){
		$this->Tiempo2 = $Tiempo2;
	}

	public function getEspecificar2(){
		return $this->Especificar2;
	}

	public function setEspecificar2($Especificar2){
		$this->Especificar2 = $Especificar2;
	}

	public function getGarantia2(){
		return $this->Garantia2;
	}

	public function setGarantia2($Garantia2){
		$this->Garantia2 = $Garantia2;
	}

    public function getOne(){
        $id = $this->getID();
        $stmt = $this->db->prepare("SELECT ID, CONVERT(DATE,Fecha) AS Fecha, Prospecto, Giro, ISNULL(Plaza, '') AS Plaza, ISNULL(Tipo,'') AS Tipo, Contacto_RH, ISNULL(Puesto,'') AS Puesto, Telefono, Correo, ISNULL(Servicio_Que_Utiliza, '') AS Servicio_Que_Utiliza, ISNULL(Proveedor_Actual, '') AS Proveedor_Actual, ISNULL(Acciones_Realizadas, '') AS Acciones_Realizadas, ISNULL(Acciones,'') AS Acciones, ISNULL( Fecha_Envio_Propuesta, '') AS Fecha_Envio_Propuesta, ISNULL(Periodicidad,'') AS Periodicidad, ISNULL(CONVERT(DATE,Fecha_Prox_Seguimiento), '') AS Fecha_Prox_Seguimiento, Estado, ISNULL(Servicio, '') AS Servicio, ISNULL(ID_Prospecto, 0) AS ID_Prospecto, ISNULL(Tipo_Vacantes, '') AS Tipo_Vacantes, ISNULL(Valor_Vacante, '') AS Valor_Vacante, ISNULL(Precio_Ofrecido, '') AS Precio_Ofrecido, ISNULL(Tiempo_Entrega, '') AS Tiempo_Entrega, ISNULL(Promedio_Servicios, '') AS Promedio_Servicios, ISNULL(Acuerdos, '') AS Acuerdos, ISNULL(Comentarios_Acuerdos, '') AS Comentarios_Acuerdos, ISNULL(Precio_RAL, '') AS Precio_RAL, ISNULL(Precio_Inv, '') AS Precio_Inv, ISNULL(Precio_ESE, '') AS Precio_ESE, ISNULL(Oferta1, '') AS Oferta1, ISNULL(Precio1, '') AS Precio1, ISNULL(Tiempo1, '') AS Tiempo1, ISNULL(Especificar1, '') AS Especificar1, ISNULL(Garantia1, '') AS Garantia1, ISNULL(Oferta2, '') AS Oferta2, ISNULL(Precio2, '') AS Precio2, ISNULL(Tiempo2, '') AS Tiempo2, ISNULL(Especificar2, '') AS Especificar2, ISNULL(Garantia2, '') AS Garantia2, ISNULL(Cuota_Reclutamiento, '') AS Cuota_Reclutamiento, ISNULL(Precio_Atraccion, '') AS Precio_Atraccion, ISNULL(Precio_Psicometria, '') AS Precio_Psicometria, ISNULL(Garantia_Renuncia, '') AS Garantia_Renuncia 
    FROM rh_Ventas_Prospectos VP LEFT JOIN rh_Ventas_Prospectos_Trabajar VPT ON VP.ID=VPT.ID_Prospecto
    WHERE ID=:id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $fetch = $stmt->fetchObject();
        return $fetch;
    }

    public function getTotalProspectosMesActual(){
        $stmt = $this->db->prepare("SELECT COUNT(Prospecto) AS total FROM rh_Ventas_Prospectos WHERE MONTH(Fecha)=MONTH(GETDATE())");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getTotalProspectosMesesAnteriores(){
        $stmt = $this->db->prepare("SELECT COUNT(Prospecto) AS total FROM rh_Ventas_Prospectos WHERE YEAR(Fecha)=YEAR(GETDATE()) AND MONTH(Fecha) <> MONTH(GETDATE())");
        $stmt->execute();
        $fetch = $stmt->fetchObject();
        return $fetch->total;
    }

    public function getProspectosPorFechadeSeguimiento(){
        $Fecha_Prox_Seguimiento = $this->getFecha_Prox_Seguimiento();
        
        $stmt = $this->db->prepare("SELECT ID, CONVERT(DATE, Fecha) AS Fecha, Prospecto, Giro, Plaza, Ejecutivo, Tipo, Contacto_RH, Puesto, Telefono, Correo, Periodicidad, Proveedor_Actual, CONVERT(DATE, Fecha_Envio_Propuesta) AS Fecha_Envio_Propuesta, CONVERT(DATE, Fecha_Prox_Seguimiento) AS Fecha_Prox_Seguimiento, Estado FROM rh_Ventas_Prospectos WHERE CONVERT(DATE,Fecha_Prox_Seguimiento)=:Fecha_Prox_Seguimiento ORDER BY Fecha DESC");
        $stmt->bindParam(":Fecha_Prox_Seguimiento", $Fecha_Prox_Seguimiento, PDO::PARAM_STR);
        $stmt->execute();
        $prospectos = $stmt->fetchAll();
        return $prospectos;
    }

    public function getProspectosPorFechadeSeguimientoYEjecutivo(){
        $Fecha_Prox_Seguimiento = $this->getFecha_Prox_Seguimiento();
        $Ejecutivo = $this->getEjecutivo();
        
        $stmt = $this->db->prepare("SELECT ID, CONVERT(DATE, Fecha) AS Fecha, Prospecto, Giro, Plaza, Ejecutivo, Tipo, Contacto_RH, Puesto, Telefono, Correo, Periodicidad, Proveedor_Actual, CONVERT(DATE, Fecha_Envio_Propuesta) AS Fecha_Envio_Propuesta, CONVERT(DATE, Fecha_Prox_Seguimiento) AS Fecha_Prox_Seguimiento, Estado FROM rh_Ventas_Prospectos WHERE CONVERT(DATE,Fecha_Prox_Seguimiento)=:Fecha_Prox_Seguimiento AND Ejecutivo=:Ejecutivo ORDER BY Fecha DESC");
        $stmt->bindParam(":Fecha_Prox_Seguimiento", $Fecha_Prox_Seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $prospectos = $stmt->fetchAll();
        return $prospectos;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT ID, Fecha, Prospecto, Giro, Plaza, Ejecutivo, Tipo, Contacto_RH, Puesto, Telefono, Correo, Periodicidad, Proveedor_Actual, Fecha_Envio_Propuesta, CONVERT(DATE, Fecha_Prox_Seguimiento) AS Fecha_Prox_Seguimiento, Estado FROM rh_Ventas_Prospectos ORDER BY Fecha_Prox_Seguimiento DESC, Fecha DESC");
        $stmt->execute();
        $prospectos = $stmt->fetchAll();
        return $prospectos;
    }

    public function getProspectosPorEjecutivo(){
        $Ejecutivo = $this->getEjecutivo();
        $stmt = $this->db->prepare("SELECT ID, Fecha, Prospecto, Giro, Plaza, Ejecutivo, Tipo, Contacto_RH, Puesto, Telefono, Correo, Periodicidad, Proveedor_Actual, Fecha_Envio_Propuesta, Fecha_Prox_Seguimiento, Estado FROM rh_Ventas_Prospectos WHERE Ejecutivo=:Ejecutivo ORDER BY Fecha_Prox_Seguimiento DESC, Fecha DESC");
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        $stmt->execute();
        $prospectos = $stmt->fetchAll();
        return $prospectos;
    }

    public function create() {
        
        $result = false;

        $Prospecto = $this->getProspecto();
        $Giro = $this->getGiro();
        $Plaza = $this->getPlaza();
        $Tipo = $this->getTipo();
        $Contacto_RH = $this->getContacto_RH();
        $Puesto = $this->getPuesto();
        $Telefono = $this->getTelefono();
        $Correo = $this->getCorreo();
        $Acciones = $this->getAcciones();
        $Acciones_Realizadas = $this->getAcciones_Realizadas();
        $Periodicidad = $this->getPeriodicidad();
        $Fecha_Prox_Seguimiento = $this->getFecha_Prox_Seguimiento();
        $Ejecutivo = $this->getEjecutivo();
        
        $stmt = $this->db->prepare("INSERT INTO rh_Ventas_Prospectos(Fecha, Prospecto, Giro, Plaza, Tipo, Contacto_RH, Puesto, Telefono, Correo, Acciones, Acciones_Realizadas, Periodicidad, Fecha_Prox_Seguimiento, Estado, Ejecutivo, Fecha_Envio_Propuesta) VALUES (GETDATE(), :Prospecto, :Giro, :Plaza, :Tipo, :Contacto_RH, :Puesto, :Telefono, :Correo, :Acciones, :Acciones_Realizadas, :Periodicidad, :Fecha_Prox_Seguimiento, 0, :Ejecutivo, GETDATE())");
        $stmt->bindParam(":Prospecto", $Prospecto, PDO::PARAM_STR);
        $stmt->bindParam(":Giro", $Giro, PDO::PARAM_STR);
        $stmt->bindParam(":Plaza", $Plaza, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo", $Tipo, PDO::PARAM_STR);
        $stmt->bindParam(":Contacto_RH", $Contacto_RH, PDO::PARAM_STR);
        $stmt->bindParam(":Puesto", $Puesto, PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $Correo, PDO::PARAM_STR);
        $stmt->bindParam(":Acciones", $Acciones, PDO::PARAM_STR);
        $stmt->bindParam(":Acciones_Realizadas", $Acciones_Realizadas, PDO::PARAM_STR);
        $stmt->bindParam(":Periodicidad", $Periodicidad, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Prox_Seguimiento", $Fecha_Prox_Seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $Ejecutivo, PDO::PARAM_STR);
        
        $flag = $stmt->execute();
		
        if ($flag) {
            $result = true;
        }
        return $result;
    }

    public function update() {
        
        $result = false;

        $id = $this->getID();
        $Prospecto = $this->getProspecto();
        $Giro = $this->getGiro();
        $Plaza = $this->getPlaza();
        $Tipo = $this->getTipo();
        $Contacto_RH = $this->getContacto_RH();
        $Puesto = $this->getPuesto();
        $Telefono = $this->getTelefono();
        $Correo = $this->getCorreo();
        $Acciones = $this->getAcciones();
        $Acciones_Realizadas = $this->getAcciones_Realizadas();
        $Periodicidad = $this->getPeriodicidad();
        $Fecha_Prox_Seguimiento = $this->getFecha_Prox_Seguimiento();
        
        $stmt = $this->db->prepare("UPDATE rh_Ventas_Prospectos SET Prospecto=:Prospecto, Giro=:Giro, Plaza=:Plaza, Tipo=:Tipo, Contacto_RH=:Contacto_RH, Puesto=:Puesto, Telefono=:Telefono, Correo=:Correo, Acciones=:Acciones, Acciones_Realizadas=:Acciones_Realizadas, Periodicidad=:Periodicidad, Fecha_Prox_Seguimiento=:Fecha_Prox_Seguimiento WHERE ID=:ID");
        $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Prospecto", $Prospecto, PDO::PARAM_STR);
        $stmt->bindParam(":Giro", $Giro, PDO::PARAM_STR);
        $stmt->bindParam(":Plaza", $Plaza, PDO::PARAM_STR);
        $stmt->bindParam(":Tipo", $Tipo, PDO::PARAM_STR);
        $stmt->bindParam(":Contacto_RH", $Contacto_RH, PDO::PARAM_STR);
        $stmt->bindParam(":Puesto", $Puesto, PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $Telefono, PDO::PARAM_STR);
        $stmt->bindParam(":Correo", $Correo, PDO::PARAM_STR);
        $stmt->bindParam(":Acciones", $Acciones, PDO::PARAM_STR);
        $stmt->bindParam(":Acciones_Realizadas", $Acciones_Realizadas, PDO::PARAM_STR);
        $stmt->bindParam(":Periodicidad", $Periodicidad, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Prox_Seguimiento", $Fecha_Prox_Seguimiento, PDO::PARAM_STR);
        
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        
        return $result;
    }

    public function create_work() {
        
        $result = false;

        $id = $this->getID();
        $Proveedor_Actual = $this->getProveedor_Actual();
        $Servicio = $this->getServicio();
        $Servicio_Que_Utiliza = $this->getServicio_Que_Utiliza();
        $Tipo_Vacantes = $this->getTipo_Vacantes();
        $Valor_Vacante = $this->getValor_Vacante();
        $Precio_Ofrecido = $this->getPrecio_Ofrecido();
        $Tiempo_Entrega = $this->getTiempo_Entrega();
        $Promedio_Servicios = $this->getPromedio_Servicios();
        $Oferta1 = $this->getOferta1();
        $Precio1 = $this->getPrecio1();
        $Tiempo1 = $this->getTiempo1();
        $Especificar1 = $this->getEspecificar1();
        $Garantia1 = $this->getGarantia1();
        $Oferta2 = $this->getOferta2();
        $Precio2 = $this->getPrecio2();
        $Tiempo2 = $this->getTiempo2();
        $Especificar2 = $this->getEspecificar2();
        $Garantia2 = $this->getGarantia2();
        $Acuerdos = $this->getAcuerdos();
        $Comentarios_Acuerdos = $this->getComentarios_Acuerdos();
        $Acciones = $this->getAcciones();
        $Acciones_Realizadas = $this->getAcciones_Realizadas();
        $Fecha_Prox_Seguimiento = $this->getFecha_Prox_Seguimiento();
        $Periodicidad = $this->getPeriodicidad();
        
        $stmt = $this->db->prepare("INSERT INTO rh_Ventas_Prospectos_Trabajar(ID_Prospecto, Tipo_Vacantes, Valor_Vacante, Precio_Ofrecido, Tiempo_Entrega, Promedio_Servicios, Acuerdos, Comentarios_Acuerdos, Oferta1, Precio1, Tiempo1, Especificar1, Garantia1, Oferta2, Precio2, Tiempo2, Especificar2, Garantia2)
            VALUES (:ID, :Tipo_Vacantes, :Valor_Vacante, :Precio_Ofrecido, :Tiempo_Entrega, :Promedio_Servicios, :Acuerdos, :Comentarios_Acuerdos, :Oferta1, :Precio1, :Tiempo1, :Especificar1, :Garantia1, :Oferta2, :Precio2, :Tiempo2, :Especificar2, :Garantia2)");
        $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Tipo_Vacantes", $Tipo_Vacantes, PDO::PARAM_STR);
        $stmt->bindParam(":Valor_Vacante", $Valor_Vacante, PDO::PARAM_STR);
        $stmt->bindParam(":Precio_Ofrecido", $Precio_Ofrecido, PDO::PARAM_STR);
        $stmt->bindParam(":Tiempo_Entrega", $Tiempo_Entrega, PDO::PARAM_STR);
        $stmt->bindParam(":Promedio_Servicios", $Promedio_Servicios, PDO::PARAM_STR);
        $stmt->bindParam(":Acuerdos", $Acuerdos, PDO::PARAM_STR);
        $stmt->bindParam(":Comentarios_Acuerdos", $Comentarios_Acuerdos, PDO::PARAM_STR);
        $stmt->bindParam(":Oferta1", $Oferta1, PDO::PARAM_STR);
        $stmt->bindParam(":Precio1", $Precio1, PDO::PARAM_STR);
        $stmt->bindParam(":Tiempo1", $Tiempo1, PDO::PARAM_STR);
        $stmt->bindParam(":Especificar1", $Especificar1, PDO::PARAM_STR);
        $stmt->bindParam(":Garantia1", $Garantia1, PDO::PARAM_STR);
        $stmt->bindParam(":Oferta2", $Oferta2, PDO::PARAM_STR);
        $stmt->bindParam(":Precio2", $Precio2, PDO::PARAM_STR);
        $stmt->bindParam(":Tiempo2", $Tiempo2, PDO::PARAM_STR);
        $stmt->bindParam(":Especificar2", $Especificar2, PDO::PARAM_STR);
        $stmt->bindParam(":Garantia2", $Garantia2, PDO::PARAM_STR);
		
		$stmt->execute();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Prospectos SET Proveedor_Actual=:Proveedor_Actual,Servicio=:Servicio, Servicio_Que_Utiliza=:Servicio_Que_Utiliza, Acciones=:Acciones, Acciones_Realizadas=:Acciones_Realizadas, Fecha_Envio_Propuesta=GETDATE(), Fecha_Prox_Seguimiento=:Fecha_Prox_Seguimiento, Periodicidad=:Periodicidad WHERE ID=:ID_Prospecto");
        $stmt->bindParam(":ID_Prospecto", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Proveedor_Actual", $Proveedor_Actual, PDO::PARAM_STR);
        $stmt->bindParam(":Servicio", $Servicio, PDO::PARAM_STR);
        $stmt->bindParam(":Servicio_Que_Utiliza", $Servicio_Que_Utiliza, PDO::PARAM_STR);        
        $stmt->bindParam(":Acciones", $Acciones, PDO::PARAM_STR);
        $stmt->bindParam(":Acciones_Realizadas", $Acciones_Realizadas, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Prox_Seguimiento", $Fecha_Prox_Seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(":Periodicidad", $Periodicidad, PDO::PARAM_STR);
        
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        
        return $result;
    }

    public function update_work() {
        
        $result = false;

        $id = $this->getID();
        $Proveedor_Actual = $this->getProveedor_Actual();
        $Servicio = $this->getServicio();
        $Servicio_Que_Utiliza = $this->getServicio_Que_Utiliza();
        $Tipo_Vacantes = $this->getTipo_Vacantes();
        $Valor_Vacante = $this->getValor_Vacante();
        $Precio_Ofrecido = $this->getPrecio_Ofrecido();
        $Tiempo_Entrega = $this->getTiempo_Entrega();
        $Promedio_Servicios = $this->getPromedio_Servicios();
        $Oferta1 = $this->getOferta1();
        $Precio1 = $this->getPrecio1();
        $Tiempo1 = $this->getTiempo1();
        $Especificar1 = $this->getEspecificar1();
        $Garantia1 = $this->getGarantia1();
        $Oferta2 = $this->getOferta2();
        $Precio2 = $this->getPrecio2();
        $Tiempo2 = $this->getTiempo2();
        $Especificar2 = $this->getEspecificar2();
        $Garantia2 = $this->getGarantia2();
        $Acuerdos = $this->getAcuerdos();
        $Comentarios_Acuerdos = $this->getComentarios_Acuerdos();
        $Acciones = $this->getAcciones();
        $Acciones_Realizadas = $this->getAcciones_Realizadas();
        $Fecha_Prox_Seguimiento = $this->getFecha_Prox_Seguimiento();
        $Periodicidad = $this->getPeriodicidad();
        
        $stmt = $this->db->prepare("UPDATE rh_Ventas_Prospectos_Trabajar SET Tipo_Vacantes=:Tipo_Vacantes,Valor_Vacante=:Valor_Vacante, Precio_Ofrecido=:Precio_Ofrecido,Tiempo_Entrega=:Tiempo_Entrega,Promedio_Servicios=:Promedio_Servicios, Acuerdos=:Acuerdos, Comentarios_Acuerdos=:Comentarios_Acuerdos, Oferta1=:Oferta1, Precio1=:Precio1, Tiempo1=:Tiempo1, Especificar1=:Especificar1, Garantia1=:Garantia1, Oferta2=:Oferta2, Precio2=:Precio2, Tiempo2=:Tiempo2, Especificar2=:Especificar2, Garantia2=:Garantia2 WHERE ID_Prospecto=:ID");
        $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Tipo_Vacantes", $Tipo_Vacantes, PDO::PARAM_STR);
        $stmt->bindParam(":Valor_Vacante", $Valor_Vacante, PDO::PARAM_STR);
        $stmt->bindParam(":Precio_Ofrecido", $Precio_Ofrecido, PDO::PARAM_STR);
        $stmt->bindParam(":Tiempo_Entrega", $Tiempo_Entrega, PDO::PARAM_STR);
        $stmt->bindParam(":Promedio_Servicios", $Promedio_Servicios, PDO::PARAM_STR);
        $stmt->bindParam(":Acuerdos", $Acuerdos, PDO::PARAM_STR);
        $stmt->bindParam(":Comentarios_Acuerdos", $Comentarios_Acuerdos, PDO::PARAM_STR);
        $stmt->bindParam(":Oferta1", $Oferta1, PDO::PARAM_STR);
        $stmt->bindParam(":Precio1", $Precio1, PDO::PARAM_STR);
        $stmt->bindParam(":Tiempo1", $Tiempo1, PDO::PARAM_STR);
        $stmt->bindParam(":Especificar1", $Especificar1, PDO::PARAM_STR);
        $stmt->bindParam(":Garantia1", $Garantia1, PDO::PARAM_STR);
        $stmt->bindParam(":Oferta2", $Oferta2, PDO::PARAM_STR);
        $stmt->bindParam(":Precio2", $Precio2, PDO::PARAM_STR);
        $stmt->bindParam(":Tiempo2", $Tiempo2, PDO::PARAM_STR);
        $stmt->bindParam(":Especificar2", $Especificar2, PDO::PARAM_STR);
        $stmt->bindParam(":Garantia2", $Garantia2, PDO::PARAM_STR);
		
		$stmt->execute();

        $stmt = $this->db->prepare("UPDATE rh_Ventas_Prospectos SET Proveedor_Actual=:Proveedor_Actual,Servicio=:Servicio, Servicio_Que_Utiliza=:Servicio_Que_Utiliza, Acciones=:Acciones, Acciones_Realizadas=:Acciones_Realizadas, Fecha_Envio_Propuesta=GETDATE(), Fecha_Prox_Seguimiento=:Fecha_Prox_Seguimiento, Periodicidad=:Periodicidad WHERE ID=:ID_Prospecto");
        $stmt->bindParam(":ID_Prospecto", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Proveedor_Actual", $Proveedor_Actual, PDO::PARAM_STR);
        $stmt->bindParam(":Servicio", $Servicio, PDO::PARAM_STR);
        $stmt->bindParam(":Servicio_Que_Utiliza", $Servicio_Que_Utiliza, PDO::PARAM_STR);        
        $stmt->bindParam(":Acciones", $Acciones, PDO::PARAM_STR);
        $stmt->bindParam(":Acciones_Realizadas", $Acciones_Realizadas, PDO::PARAM_STR);
        $stmt->bindParam(":Fecha_Prox_Seguimiento", $Fecha_Prox_Seguimiento, PDO::PARAM_STR);
        $stmt->bindParam(":Periodicidad", $Periodicidad, PDO::PARAM_STR);
        
        $flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        
        return $result;
    }

    public function updateCuota_Reclutamiento() {
        
        $result = false;

		$id = $this->getID();
        $cuota = $this->getCuota_Reclutamiento();
        $garantia = $this->getGarantia_Renuncia();
        
		$stmt = $this->db->prepare("UPDATE rh_Ventas_Prospectos_Trabajar SET Cuota_Reclutamiento=:Cuota_Reclutamiento, Garantia_Renuncia=:Garantia_Renuncia WHERE ID_Prospecto=:ID_Prospecto");
		$stmt->bindParam(":ID_Prospecto", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Cuota_Reclutamiento", $cuota, PDO::PARAM_INT);
        $stmt->bindParam(":Garantia_Renuncia", $garantia, PDO::PARAM_STR);
        
		$flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        
        return $result;
    }

    public function updatePrecio_Atraccion() {
        
        $result = false;

		$id = $this->getID();
        $precio = $this->getPrecio_Atraccion();
        
		$stmt = $this->db->prepare("UPDATE rh_Ventas_Prospectos_Trabajar SET Precio_Atraccion=:Precio_Atraccion WHERE ID_Prospecto=:ID_Prospecto");
		$stmt->bindParam(":ID_Prospecto", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Precio_Atraccion", $precio, PDO::PARAM_STR);
        
		$flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        
        return $result;
    }

    public function updatePrecio_Psicometria() {
        
        $result = false;

		$id = $this->getID();
        $precio = $this->getPrecio_Psicometria();
        
		$stmt = $this->db->prepare("UPDATE rh_Ventas_Prospectos_Trabajar SET Precio_Psicometria=:Precio_Psicometria WHERE ID_Prospecto=:ID_Prospecto");
		$stmt->bindParam(":ID_Prospecto", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Precio_Psicometria", $precio, PDO::PARAM_STR);
        
		$flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        
        return $result;
    }

    public function updatePrecios_SA() {
        
        $result = false;

		$id = $this->getID();
        $ral = $this->getPrecio_RAL();
        $inv = $this->getPrecio_Inv();
        $ese = $this->getPrecio_ESE();
        
		$stmt = $this->db->prepare("UPDATE rh_Ventas_Prospectos_Trabajar SET Precio_RAL=:Precio_RAL, Precio_Inv=:Precio_Inv, Precio_ESE=:Precio_ESE WHERE ID_Prospecto=:ID_Prospecto");
		$stmt->bindParam(":ID_Prospecto", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Precio_RAL", $ral, PDO::PARAM_STR);
        $stmt->bindParam(":Precio_Inv", $inv, PDO::PARAM_STR);
        $stmt->bindParam(":Precio_ESE", $ese, PDO::PARAM_STR);
        
		$flag = $stmt->execute();

        if ($flag) {
            $result = true;
        }
        
        return $result;
    }
}