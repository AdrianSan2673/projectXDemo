<?php


require_once 'models/User.php';
require_once 'models/SA/Candidatos.php';
require_once 'models/SA/Facturas.php';
require_once 'models/SA/FacturasGestiones.php';
require_once 'models/SA/OrdenesCompra.php';
require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/RazonesSocialesEmpresa.php';
require_once 'models/SA/Clientes.php';

class Administracion_SAController{

    public function ordenes_de_compra(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $orden = new OrdenesCompra();
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                
            }
            else {
                $ordenes_pendientes = $orden->getOrdenesPendientes();
                $ordenes_liberadas = $orden->getOrdenesLiberadas();
            }

			$page_title = 'Ordenes de compra | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion/ordenes.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function gestion_orden_de_compra(){
		if (Utils::isAdmin() || Utils::isManager()) {
            if (isset($_GET['folio'])) {
                $folio = Encryption::decode($_GET['folio']);
                $orden = new OrdenesCompra();
                $orden->setFolio_Factura($folio);
                $orden_de_compra = $orden->getOne();
            }
            else {
                header("location:".base_url."administracion_SA/ordenes_de_compra");
            }

            $page_title = "{$folio} OC | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion/gestion_orden.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

       public function purchase_order_follow_up(){
		if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;
            $Folio_Factura = isset($_POST['Folio_Factura']) ? trim($_POST['Folio_Factura']) : FALSE;
            $Fecha_Emision = isset($_POST['Fecha_Emision']) ? $_POST['Fecha_Emision'] : FALSE;
            $Hora_Emision = isset($_POST['Hora_Emision']) ? $_POST['Hora_Emision'] : FALSE;
            $Razon_Social = isset($_POST['Razon_Social']) && !empty($_POST['Razon_Social']) ? $_POST['Razon_Social'] : 'Pendiente';
            $Estado_OC = isset($_POST['Estado_OC']) ? $_POST['Estado_OC'] : FALSE;
            $Comentarios = isset($_POST['Comentarios']) && !empty($_POST['Comentarios']) ? trim($_POST['Comentarios']) : '';
            $Fecha_Prox_Gestion = isset($_POST['Fecha_Prox_Gestion']) && !empty($_POST['Fecha_Prox_Gestion']) ? trim($_POST['Fecha_Prox_Gestion']) : NULL;
            
            if ($Folio && $Folio_Factura && $Fecha_Emision && $Hora_Emision && $Razon_Social && $Estado_OC && $Comentarios) {
                $Fecha_Emision = DateTime::createFromFormat('Y-m-d H:i:s', "{$Fecha_Emision} {$Hora_Emision}");
                $Fecha_Emision = $Fecha_Emision->format('Y-m-d H:i:s');

                $orden = new OrdenesCompra;
                $orden->setFolio($Folio);
                $orden->setFolio_Factura($Folio_Factura);
                $orden->setFecha_Emision($Fecha_Emision);
                $orden->setRazon_Social($Razon_Social);
                $orden->setEstado_OC($Estado_OC);
                $orden->setComentarios($Comentarios);
                $orden->setFecha_Prox_Gestion($Fecha_Prox_Gestion);
                $update = $orden->update();
                if ($update) {
                    $orden->getEstado_OC(substr($Folio, 0, 2) == 'F-'?254:252);    
                    $orden->updateFolioYRazonDeServiciosPorFolio();
                    echo 1;
                } else {
                    echo 2;
                }
            }
            else {
                echo 0;
            }
		} else {
            echo 0;
		}	
    }

    public function detalle_orden_de_compra(){
		if (Utils::isAdmin() || Utils::isManager()) {
            if (isset($_GET['folio'])) {
                $folio = Encryption::decode($_GET['folio']);
                $orden = new OrdenesCompra();
                $orden->setFolio_Factura($folio);
                $orders = $orden->getDetalleOrdenPorFolio();
            }
            else {
                header("location:".base_url."administracion_SA/ordenes_de_compra");
            }

			$page_title = "{$folio} OC | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion/detalle_orden.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function listado_orden_de_compra(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $orden = new OrdenesCompra();
            if (isset($_GET['folio'])) {
                $folio = Encryption::decode($_GET['folio']);
                $orden = new OrdenesCompra();
                $orden->setFolio_Factura($folio);
                $orders = $orden->getListadoOrdenPorFolio();
            }
            else {
                header("location:".base_url."administracion_SA/ordenes_de_compra");
            }

			$page_title = "{$folio} OC | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion/listado_orden.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

 

       public function facturacion()
    {
        if (Utils::isAdmin() || Utils::isManager()) {
            $candidato = new Candidatos();

            if (isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['Empresa']) && $_POST['Empresa'] != 0) {
                $candidato->setFecha_solicitud($_POST['start_date']);
                $candidato->setFecha_Entregado($_POST['end_date']);
                $servicios = $candidato->getServiciosPorRangoDeFechaEmpresa($_POST['Empresa']);
            } elseif (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                $candidato->setFecha_solicitud($_POST['start_date']);
                $candidato->setFecha_Entregado($_POST['end_date']);
                $servicios = $candidato->getServiciosPorRangoDeFechaConCancelados();
            } elseif (isset($_POST['submit'])) {
                foreach ($_POST['folio'] as $f) {
                    echo $f;
                }
            } else {
                $servicios = $candidato->getServiciosDeHoy();
            }

            $page_title = 'Facturación SA | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion/modal_afectar_facturas.php';
            require_once 'views/administracion/modal_afectar_Prefacturas.php';
            require_once 'views/administracion/facturacion.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function cobranza(){
		if (Utils::isAdmin() || Utils::isManager()) {
            $factura = new Facturas();
            
            $total_facturado_mensual = $factura->getTotalFacturadoMensual();
            $total_cobrado_mensual = $factura->getTotalCobradoMensual();
            $totalOperacionesFacturadasMes = $factura->getTotalOperacionesFacturadasMensual();

            if (strftime('%m') == '01') {
                $total_facturado_mes_anterior = $factura->getTotalFacturadoDiciembre();
                $total_cobrado_mes_anterior = $factura->getTotalCobradoDiciembre();

                $total_facturado_mes_tras_anterior = $factura->getTotalFacturadoNoviembre();
                $total_cobrado_mes_tras_anterior = $factura->getTotalCobradoNoviembre();

            }elseif(strftime('%m') == '02'){
                $total_facturado_mes_anterior = $factura->getTotalFacturadoMesAnterior();
                $total_cobrado_mes_anterior = $factura->getTotalCobradoMesAnterior();

                $total_facturado_mes_tras_anterior = $factura->getTotalFacturadoDiciembre();
                $total_cobrado_mes_tras_anterior = $factura->getTotalCobradoDiciembre();


                $total_operaciones_facturadas_mes_anterior = $factura->getTotalOperacionesFacturadasMesAnterior();
                $total_operaciones_facturadas_mes_tras_anterior = $factura->getTotalOperacionesFacturadasMesTrasAnterior();
            }
            else{
                $total_facturado_mes_anterior = $factura->getTotalFacturadoMesAnterior();
                $total_cobrado_mes_anterior = $factura->getTotalCobradoMesAnterior();
                $total_operaciones_facturadas_mes_anterior = $factura->getTotalOperacionesFacturadasMesAnterior();
                $total_facturado_mes_tras_anterior = $factura->getTotalFacturadoMesTrasAnterior();
                $total_cobrado_mes_tras_anterior = $factura->getTotalCobradoMesTrasAnterior();
                $total_operaciones_facturadas_mes_tras_anterior = $factura->getTotalOperacionesFacturadasMesTrasAnterior();
            }

            $total_facturado_anual = $factura->getTotalFacturadoAnual();
            $total_cobrado_anual = $factura->getTotalCobradoAnual();
            $total_operaciones_facturadas_anual = $factura->getTotalOperacionesFacturadasAnual();

            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                
            }
            else {
            $facturas_pendientes = $factura->getFacturasPendientes();
                if (isset($_POST['search'])) {
                    $factura->setFecha_inicio($_POST['fecha_inicio']);
                    $factura->setFecha_fin($_POST['fecha_fin']);
                    $facturas_pagadas = $factura->getFacturasPagadasPorFecha();
                } else {
                    $facturas_pagadas = $factura->getFacturasPagadas();
                }

                $facturas_canceladas = $factura->getFacturasCanceladas();
				$facturas_incobrables = $factura->getFacturasIncobrables();

            }

			$page_title = 'Cobranza SA | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion/modal_afectar_facturas_cobranza.php';
            require_once 'views/administracion/modal_gestion_facturas_cobranza.php';
			require_once 'views/administracion/modal_vetar_cliente.php';
			require_once 'views/administracion/modal_info_cancelados.php';
            require_once 'views/administracion/cobranza.php';
            require_once 'views/layout/footer.php';
            require_once 'views/administracion/modal-factura.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function editar_factura(){
		if (Utils::isAdmin() || Utils::isManager()) {
            if (isset($_GET['folio'])) {
                $folio = Encryption::decode($_GET['folio']);
                $facturas = new Facturas();
                $facturas->setFolio_Factura($folio);
                $servicios = $facturas->getServiciosPorFactura();
                $seguimientos = $facturas->getSeguimientosPorFolio();
                $factura = $facturas->getOne();
            }
            else {
                header("location:".base_url."administracion_SA/cobranza");
            }

			$page_title = "{$folio} Factura | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion/editar_factura.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function update_bill(){
		if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $Folio = Utils::sanitizeStringBlank($_POST['Folio']);
            $Folio_Factura = Utils::sanitizeStringBlank($_POST['Folio_Factura']);
            $Fecha_Emision = isset($_POST['Fecha_Emision']) ? $_POST['Fecha_Emision'] : FALSE;
            $Hora_Emision = isset($_POST['Hora_Emision']) ? $_POST['Hora_Emision'] : FALSE;
            $Razon_Social = isset($_POST['Razon_Social']) && !empty($_POST['Razon_Social']) ? $_POST['Razon_Social'] : 'Pendiente';
            $Estado = isset($_POST['Estado']) ? $_POST['Estado'] : FALSE;
            $Promesa_Pago = isset($_POST['Promesa_Pago']) && !empty($_POST['Promesa_Pago']) ? trim($_POST['Promesa_Pago']) : NULL;
            $Monto = isset($_POST['Monto']) && !empty($_POST['Monto']) ? trim($_POST['Monto']) : 0;
            $Monto_IVA = isset($_POST['iva']) && !empty($_POST['iva']) ? ($Monto * $_POST['iva']) : 0;
            $Fecha_de_Pago = isset($_POST['Fecha_de_Pago']) && !empty($_POST['Fecha_de_Pago']) ? trim($_POST['Fecha_de_Pago']) : NULL;
            $Tipo = isset($_POST['Tipo']) && !empty($_POST['Tipo']) ? ($_POST['Tipo']==1?'1':'0') : '0';

            if ($Folio && $Folio_Factura && $Fecha_Emision && $Hora_Emision && $Razon_Social && $Estado) {
                $Fecha_Emision = DateTime::createFromFormat('Y-m-d H:i:s', "{$Fecha_Emision} {$Hora_Emision}");
                $Fecha_Emision = $Fecha_Emision->format('Y-m-d H:i:s');

                $factura = new Facturas;
                $factura->setFolio($Folio);
                $factura->setFolio_Factura($Folio_Factura);
                $factura->setFecha_Emision($Fecha_Emision);
                $factura->setRazon_Social($Razon_Social);
                $factura->setEstado($Estado);
                $factura->setPromesa_Pago($Promesa_Pago);
                $factura->setMonto($Monto);
                $factura->setMonto_IVA($Monto_IVA);
                $factura->setFecha_de_Pago($Fecha_de_Pago);
                $factura->setTipo($Tipo);
				($Estado == 'Cancelada') ? $factura->setFecha_cancelacion(date('Y-m-d')) : $factura->setFecha_cancelacion(NULL);
                $update = $factura->update();
                $Factura = $factura->getOne();
				
				$facturas_pendientes = Administracion_SAController::formatear($factura->getFacturasPendientes());
                $facturas_pagadas = Administracion_SAController::formatear($factura->getFacturasPagadas());
                $facturas_canceladas = Administracion_SAController::formatear($factura->getFacturasCanceladas());
                $facturas_incobrables = Administracion_SAController::formatear($factura->getFacturasIncobrables());

                if ($update) {
                    $factura->updateFolioYRazonDeServiciosPorFolio();
                    $factura->updateSeguimientosPorFolio();
                     echo json_encode(array(
                        'Factura' => $Factura,
                        'status' => 1,
                        'facturas_pendientes' => $facturas_pendientes,
                        'facturas_pagadas' => $facturas_pagadas,
                        'facturas_canceladas' => $facturas_canceladas,
                        'facturas_incobrables' => $facturas_incobrables,
                    ));
                }else{
                    echo json_encode(array('status' => 2));
                }
            }
            else {
                echo json_encode(array('status' => 0));
            }
		} else {
			header("location:".base_url);
		}	
    }
	
    public function gestion_factura(){
		if (Utils::isAdmin() || Utils::isManager()) {

            if (isset($_GET['folio'])) {
                $folio = Encryption::decode($_GET['folio']);
                $facturas = new Facturas();
                $facturas->setFolio_Factura($folio);
                $seguimientos = $facturas->getSeguimientosPorFolio();
                $factura = $facturas->getOne();
            }
            else {
                header("location:".base_url."administracion_SA/cobranza");
            }

			$page_title = "{$folio} Factura | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion/gestion_factura.php';
            require_once 'views/layout/footer.php';
		} else {
			header("location:".base_url);
		}	
    }

    public function bill_follow_up(){
        //var_dump($_POST);die();
		if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;
            $Folio_Factura = isset($_POST['Folio_Factura']) ? trim($_POST['Folio_Factura']) : FALSE;
            $Estado = isset($_POST['Estado']) ? $_POST['Estado'] : FALSE;
            $Promesa_Pago = isset($_POST['Promesa_Pago']) && !empty($_POST['Promesa_Pago']) ? trim($_POST['Promesa_Pago']) : NULL;
            $Contacto_Con = isset($_POST['Contacto_Con']) && !empty($_POST['Contacto_Con']) ? trim($_POST['Contacto_Con']) : '';
            $Comentarios = isset($_POST['Comentarios']) && !empty($_POST['Comentarios']) ? trim($_POST['Comentarios']) : '';
            $Usuario = isset($_SESSION['identity']) ? strtoupper($_SESSION['identity']->username) : NULL;
            $Proxima_Gestion = Utils::sanitizeString($_POST['Proxima_Gestion']);

            if ($Folio && $Folio_Factura && $Estado && $Contacto_Con && $Comentarios) {

                $factura = new Facturas;
                $factura->setFolio_Factura($Folio_Factura);
                $factura->setEstado($Estado);
                $factura->setPromesa_Pago($Promesa_Pago);
                $factura->setProxima_Gestion($Proxima_Gestion);
				($Estado == 'Cancelada') ? $factura->setFecha_cancelacion(date('Y-m-d')) : $factura->setFecha_cancelacion(NULL);
                $update = $factura->updateFollowUp();
                $factura = $factura->getOne();

                if ($update) {
                    $gestion = new FacturasGestiones();
                    $gestion->setFolio_Factura($Folio_Factura);
                    $gestion->setPromesa_Pago($Promesa_Pago);
                    $gestion->setContacto_Con($Contacto_Con);
                    $gestion->setComentarios($Comentarios);
                    $gestion->setUsuario($Usuario);
                    $gestion->setProxima_Gestion($Proxima_Gestion);
                    $gestion->create();
					
					$facturas_pendientes = Administracion_SAController::formatear($factura->getFacturasPendientes());
                    $facturas_pagadas = Administracion_SAController::formatear($factura->getFacturasPagadas());
                    $facturas_canceladas = Administracion_SAController::formatear($factura->getFacturasCanceladas());
					
                    echo json_encode(array(
                        'status' => 1, 'Factura' => $factura2, 'facturas_pendientes' => $facturas_pendientes,
                        'facturas_pagadas' => $facturas_pagadas,
                        'facturas_canceladas' => $facturas_canceladas,
                    ));
                }else{
                    echo json_encode(array('status' => 2));
                }
            }
            else {
                echo json_encode(array('status' => 0));
            }
		} else {
			header("location:".base_url);
		}	
    }

    public function getServicio(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager()) {
            $folio = isset($_POST['folio']) ? trim($_POST['folio']) : FALSE;
            if ($folio) {
                $candidato = new Candidatos();
                $candidato->setCandidato($folio);
                $candidato_datos = $candidato->getOne();

                $razon = new RazonesSociales();
                $razon->setID_Cliente($candidato_datos->ID_Cliente);
                $razones = $razon->getRazonesSocialesPorCliente();

                $all_info = array(
                    'candidato_datos' => $candidato_datos,
                    'razones' => $razones
                );

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($all_info, \JSON_UNESCAPED_UNICODE);
            }else
                echo 0;
        } else
            header('location:'.base_url);
    }

    public function update_folio(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager()) {
            $Candidato = Utils::sanitizeNumber($_POST['Candidato']);
            $Cliente = Utils::sanitizeString($_POST['Cliente']);
            $ID_Cliente = Utils::sanitizeNumber($_POST['ID_Cliente']);
            $Razon_Social = Utils::sanitizeStringBlank($_POST['Razon_Social']);
            $Factura = Utils::sanitizeString($_POST['Factura']);
            
            if ($Candidato && $ID_Cliente) {
                $Factura = strtoupper($Factura);
                if (substr($Factura, 0, 2) == 'F-') {
                    $Factura = str_replace(' ', '', $Factura);
                    $fact = new Facturas();
                    $fact->setFolio_Factura($Factura);
                    $Folio_Factura = $fact->facturaExiste();
                    $Estado = 'Facturado';
                    if ($Folio_Factura) {
                        $cdto = new Candidatos();
                        $cdto->setCandidato($Candidato);
                        $cdto->setEstado(254);
                        $cdto->setFactura($Factura);
                        $cdto->updateFactura();
                    } else {
                        $fact->setCliente($Cliente);
                        $fact->setID_Cliente($ID_Cliente);
                        $fact->setRazon_Social($Razon_Social);
                        $fact->save();
                        //$Folio_Factura = $fact->getFolio_Factura();

                        $cdto = new Candidatos();
                        $cdto->setCandidato($Candidato);
                        $cdto->setEstado(254);
                        $cdto->setFactura($Factura);
                        $cdto->updateFactura();
                    }
                }else{
                    $orden = new OrdenesCompra();
                    $orden->setFolio_Factura($Factura);
                    $orden_compra = $orden->ordenExiste();
                    $Estado = 'Finalizado';
                    if ($orden_compra) {
                        $cdto = new Candidatos();
                        $cdto->setCandidato($Candidato);
                        $cdto->setEstado(252);
                        $cdto->setFactura($Factura);
                        $cdto->updateFactura();
                    }else{
                        $orden->save();
                        //$orden_compra = $orden->getFolio_Factura();

                        $cdto = new Candidatos();
                        $cdto->setCandidato($Candidato);
                        $cdto->setEstado(252);
                        $cdto->setFactura($Factura);
                        $cdto->updateFactura();
                    }
                }
                echo json_encode(
                    array('factura' => $Factura, 'razon' => $Razon_Social, 'estado' => $Estado)
                );
            }else{
                echo 0;
            }

            
        }else{
            header("location:".base_url); 
        }
    }


    public function getFactura(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $Folio_Factura = Utils::sanitizeString($_POST['Folio_Factura']);
            
            if ($Folio_Factura) {
                $facturas = new Facturas();
                $facturas->setFolio_Factura($Folio_Factura);
                $factura_datos = $facturas->getOne();

                $razon = new RazonesSociales();
                $razon->setID_Cliente($factura_datos->ID_Cliente);
                $razones = $razon->getRazonesSocialesPorCliente();

                $all_info = array(
                    'factura_datos' => $factura_datos,
                    'razones' => $razones
                );

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($all_info, JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }            
    }
	
	   //============================[Ulises Febrero 17]=========================================
    public function getFacturaPendienteEmpresaPorEstatus()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $Empresa = isset($_POST['Empresa']) ? Utils::sanitizeStringBlank($_POST['Empresa']) : NULL;
            if ($Empresa) {
                $facturas = new Facturas();
                $facturas->setEstado('Pendiente de pago');
                $facturas_totales_Empresa = $facturas->getFacturaPendienteEmpresaPorEstatus($Empresa);
                for ($i = 0; $i <  count($facturas_totales_Empresa); $i++) {
                    $facturas_totales_Empresa[$i]['Monto_IVA'] = number_format($facturas_totales_Empresa[$i]['Monto_IVA'], 2);
                }

                $razonSocialEmpresaObj = new RazonesSocialesEmpresa();
                $razonSocialEmpresaObj->setEmpresa($Empresa);
                $razonSocialEmpresa = $razonSocialEmpresaObj->getRazonesSocialesPorEmpresa();

                echo json_encode(array('status' => 1, 'facturas_totales_Empresa' => $facturas_totales_Empresa, 'razonSocialEmpresa' => $razonSocialEmpresa));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function getFacturasRazonPorCliente()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $ID_Cliente = $_POST['ID_Cliente'];
            if ($ID_Cliente) {
                $razon = new RazonesSociales();
                $razon->setID_Cliente($ID_Cliente);
                $razones = $razon->getRazonesSocialesPorCliente();

                $facturas = new Facturas();
                $facturas->setID_Cliente($ID_Cliente);
                $facturas = $facturas->getFolioPendienteIdCliente();

                for ($i = 0; $i <  count($facturas); $i++) {
                    $facturas[$i]['Monto_IVA'] = number_format($facturas[$i]['Monto_IVA'], 2);
                }

                echo json_encode(array('status' => 1, 'razones' => $razones, 'facturas' => $facturas));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function updateEstadoFacturas()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $arrayFacturas = $_POST['facturas'];
            $Estado = isset($_POST['Estado']) ? Utils::sanitizeStringBlank($_POST['Estado']) : null;
            $Fecha_de_Pago = isset($_POST['Fecha_de_Pago']) ? Utils::sanitizeStringBlank($_POST['Fecha_de_Pago']) : null;
            $ID_Cliente = isset($_POST['ID_Cliente']) ? Utils::sanitizeStringBlank($_POST['ID_Cliente']) : null;
            $Razon_Social = isset($_POST['Razon_Social']) ? Utils::sanitizeStringBlank($_POST['Razon_Social']) : null;

            if ($ID_Cliente && $Razon_Social && count($arrayFacturas) > 0 && $Estado && $Fecha_de_Pago) {

                for ($i = 0; $i < count($arrayFacturas); $i++) {
                    $facturaObj = new Facturas;
                    $facturaObj->setFolio_Factura($arrayFacturas[$i]);
                    $facturaObj->setEstado($Estado);
                    $facturaObj->setFecha_de_Pago($Fecha_de_Pago);
                    //$facturaObj->setID_Cliente($ID_Cliente);
                    $facturaObj->setRazon_Social($Razon_Social);
                    $facturaObj->updateEstadoFacturasSinCliente();
                }

                $facturaObj = new Facturas;
                $facturas_pendientes = $facturaObj->getFacturasPendientes();
                for ($i = 0; $i < count($facturas_pendientes); $i++) {
                    switch ($facturas_pendientes[$i]['Estado']) {
                        case 'Pendiente de pago':
                            $class_color = 'bg-orange';
                            break;
                        case 'Pagada':
                            $class_color = 'bg-success';
                            break;
                        default:
                            $class_color = '';
                            break;
                    }
                    $facturas_pendientes[$i]['class_color'] = $class_color;
                    $facturas_pendientes[$i]['class_color_days'] = $facturas_pendientes[$i]['Dias_Transcurridos'] > $facturas_pendientes[$i]['Plazo_Credito'] ? ' bg-danger' : '';
                    $facturas_pendientes[$i]['Fecha_Emision'] = Utils::getShortDate($facturas_pendientes[$i]['Fecha_Emision']);
                    $facturas_pendientes[$i]['Monto'] = number_format($facturas_pendientes[$i]['Monto'], 2);
                    $facturas_pendientes[$i]['Monto_IVA'] = number_format($facturas_pendientes[$i]['Monto_IVA'], 2);
                    $facturas_pendientes[$i]['Fecha_de_Pago'] = !is_null($facturas_pendientes[$i]['Fecha_de_Pago']) ? Utils::getShortDate($facturas_pendientes[$i]['Fecha_de_Pago']) : '';
                    $facturas_pendientes[$i]['Fecha_Ultima_Gestion'] = !is_null($facturas_pendientes[$i]['Fecha_Ultima_Gestion']) ? Utils::getShortDate($facturas_pendientes[$i]['Fecha_Ultima_Gestion']) : '';
                    $facturas_pendientes[$i]['Proxima_Gestion'] = !is_null($facturas_pendientes[$i]['Proxima_Gestion']) ? Utils::getShortDate($facturas_pendientes[$i]['Proxima_Gestion']) : '';
                    $facturas_pendientes[$i]['Promesa_Pago'] = !is_null($facturas_pendientes[$i]['Promesa_Pago']) ? Utils::getShortDate($facturas_pendientes[$i]['Promesa_Pago']) : '';
                    $facturas_pendientes[$i]['url_editar'] = base_url . 'administracion_SA/editar_factura&folio=' . Encryption::encode($facturas_pendientes[$i]['Folio_Factura']);
                }

                echo json_encode(array(
                    'status' => 1,
                    'facturas_pendientes' => $facturas_pendientes
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function updateProximaGestionFacturas()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $ID_Cliente = isset($_POST['ID_Cliente']) ? Utils::sanitizeStringBlank($_POST['ID_Cliente']) : null;
            $Razon_Social = isset($_POST['Razon_Social']) ? Utils::sanitizeStringBlank($_POST['Razon_Social']) : null;
            $arrayFacturas = $_POST['facturas'];
            $Estado = isset($_POST['Estado']) ? Utils::sanitizeStringBlank($_POST['Estado']) : null;
            $Promesa_Pago = isset($_POST['Promesa_Pago']) && !empty($_POST['Promesa_Pago']) ? trim($_POST['Promesa_Pago']) : NULL;
            $Contacto_Con = isset($_POST['Contacto_Con']) && !empty($_POST['Contacto_Con']) ? trim($_POST['Contacto_Con']) : '';
            $Comentarios = isset($_POST['Comentarios']) && !empty($_POST['Comentarios']) ? trim($_POST['Comentarios']) : '';
            $Proxima_Gestion = Utils::sanitizeString($_POST['Proxima_Gestion']);
            $Usuario = isset($_SESSION['identity']) ? strtoupper($_SESSION['identity']->username) : NULL;

            if (count($arrayFacturas) > 0 && $Estado && $Contacto_Con && $Comentarios && $Comentarios && $Proxima_Gestion && $Usuario) {
                for ($i = 0; $i < count($arrayFacturas); $i++) {
                    $factura = new Facturas;
                    $factura->setFolio_Factura($arrayFacturas[$i]);
                    $factura->setEstado($Estado);
                    $factura->setPromesa_Pago($Promesa_Pago);
                    $factura->setProxima_Gestion($Proxima_Gestion);
                    $update = $factura->updateFollowUp();
                    if ($update) {
                        $gestion = new FacturasGestiones();
                        $gestion->setFolio_Factura($arrayFacturas[$i]);
                        $gestion->setPromesa_Pago($Promesa_Pago);
                        $gestion->setContacto_Con($Contacto_Con);
                        $gestion->setComentarios($Comentarios);
                        $gestion->setUsuario($Usuario);
                        $gestion->setProxima_Gestion($Proxima_Gestion);
                        $gestion->create();
                    }
                }

                $facturaObj = new Facturas;
                $facturas_pendientes = $facturaObj->getFacturasPendientes();
                for ($i = 0; $i < count($facturas_pendientes); $i++) {
                    switch ($facturas_pendientes[$i]['Estado']) {
                        case 'Pendiente de pago':
                            $class_color = 'bg-orange';
                            break;
                        case 'Pagada':
                            $class_color = 'bg-success';
                            break;
                        default:
                            $class_color = '';
                            break;
                    }
                    $facturas_pendientes[$i]['class_color'] = $class_color;
                    $facturas_pendientes[$i]['class_color_days'] = $facturas_pendientes[$i]['Dias_Transcurridos'] > $facturas_pendientes[$i]['Plazo_Credito'] ? ' bg-danger' : '';
                    $facturas_pendientes[$i]['Fecha_Emision'] = Utils::getShortDate($facturas_pendientes[$i]['Fecha_Emision']);
                    $facturas_pendientes[$i]['Monto'] = number_format($facturas_pendientes[$i]['Monto'], 2);
                    $facturas_pendientes[$i]['Monto_IVA'] = number_format($facturas_pendientes[$i]['Monto_IVA'], 2);
                    $facturas_pendientes[$i]['Fecha_de_Pago'] = !is_null($facturas_pendientes[$i]['Fecha_de_Pago']) ? Utils::getShortDate($facturas_pendientes[$i]['Fecha_de_Pago']) : '';
                    $facturas_pendientes[$i]['Fecha_Ultima_Gestion'] = !is_null($facturas_pendientes[$i]['Fecha_Ultima_Gestion']) ? Utils::getShortDate($facturas_pendientes[$i]['Fecha_Ultima_Gestion']) : '';
                    $facturas_pendientes[$i]['Proxima_Gestion'] = !is_null($facturas_pendientes[$i]['Proxima_Gestion']) ? Utils::getShortDate($facturas_pendientes[$i]['Proxima_Gestion']) : '';
                    $facturas_pendientes[$i]['Promesa_Pago'] = !is_null($facturas_pendientes[$i]['Promesa_Pago']) ? Utils::getShortDate($facturas_pendientes[$i]['Promesa_Pago']) : '';
                    $facturas_pendientes[$i]['url_editar'] = base_url . 'administracion_SA/editar_factura&folio=' . Encryption::encode($facturas_pendientes[$i]['Folio_Factura']);
                }
                echo json_encode(array(
                    'status' => 1,
                    'facturas_pendientes' => $facturas_pendientes,
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
    //=======================================================================================

    //============================[Ulises Marzo 07]==========================================
    public function getTotalEmpresaConPorPrefacturar()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $flag = isset($_POST['flag']) ? $_POST['flag'] : null;
            if ($flag) {
                $facturas = new Facturas();
                if ($flag == 1) {
                    $factura_empresa = $facturas->getEmpresaConPorPrefacturar();
                } elseif ($flag == 2) {
                    $factura_empresa = $facturas->getEmpresaSinfacturar();
                }
                echo json_encode(array('status' => 1, 'factura_empresa' => $factura_empresa));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function getTotalClienteByEmpresaConPorPrefacturar()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $Empresa = isset($_POST['Empresa']) ? $_POST['Empresa'] : null;
            $flag = isset($_POST['flag']) ? $_POST['flag'] : null;

            if ($Empresa && $flag) {
                $clientesObj = new Clientes();
                $clientesObj->setEmpresa($Empresa);

                if ($flag == 1) {
                    $clientes = $clientesObj->getClienteByEmpresaConPorPrefacturar();
                } elseif ($flag == 2) {
                    $clientes = $clientesObj->getClienteByEmpresaSinPrefacturar();
                } elseif ($flag == 3) {
                    $clientes = $clientesObj->getFacturaPendienteClientePorEstatus('Pendiente de pago');
                }
                echo json_encode(array('status' => 1, 'clientes' => $clientes));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function getPrefacturaPorCliente()
    {
        $ID_Cliente = $_POST['ID_Cliente'];
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $clientesObj = new Clientes();
            $clientesObj->setCliente($ID_Cliente);
            $preFactura = $clientesObj->getPrefacutraPorCliente();
            echo json_encode(array('status' => 1, 'preFactura' => $preFactura));
        } else
            echo json_encode(array('status' => 0));
    }

   
    public function updatePrefolioAFolio()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $Empresa = isset($_POST['Empresa']) ? Utils::sanitizeStringBlank($_POST['Empresa']) : Null;
            $ID_Cliente = isset($_POST['ID_Cliente']) ? Utils::sanitizeStringBlank($_POST['ID_Cliente']) : Null;
            $Prefactura = isset($_POST['Prefactura']) ? Utils::sanitizeStringBlank($_POST['Prefactura']) : Null;
            $Razon_Social = isset($_POST['Razon_Social']) ? Utils::sanitizeStringBlank($_POST['Razon_Social']) : Null;
            $Factura = isset($_POST['Factura']) ? Utils::sanitizeStringBlank(strtoupper($_POST['Factura'])) : Null;

            if ($Empresa && $ID_Cliente && $Prefactura) {

                $cdto = new Candidatos();
                $cdto->setFactura($Prefactura);
                $candidatos = $cdto->getAllCandidatosPorPrefactura();

                $clienteObj = new Clientes();
                $clienteObj->setCliente($ID_Cliente);
                $Cliente = $clienteObj->getOne()->Nombre_Cliente;

                foreach ($candidatos as $candidato) {
                     if (substr($Factura, 0, 2) == 'F-') {
                        $Factura = str_replace(' ', '', $Factura);

                        $fact = new Facturas();
                        $fact->setFolio_Factura($Factura);
                        $Folio_Factura = $fact->facturaExiste();
                        $Estado = 'Facturado';
                        if ($Folio_Factura) {
                            $cdto = new Candidatos();
                            $cdto->setCandidato($candidato['Candidato']);
                            $cdto->setEstado(254);
                            $cdto->setFactura($Factura);
                            $cdto->updateFactura();
                        } else {
                            $fact->setCliente($Cliente);
                            $fact->setID_Cliente($ID_Cliente);
                            $fact->setRazon_Social($candidato['Razon']);
                            $fact->save();
                            //$Folio_Factura = $fact->getFolio_Factura();

                            $cdto = new Candidatos();
                            $cdto->setCandidato($candidato['Candidato']);
                            $cdto->setEstado(254);
                            $cdto->setFactura($Factura);
                            $cdto->updateFactura();
                        }
                    } else {
                        $orden = new OrdenesCompra();
                        $orden->setFolio_Factura($Factura);
                        $orden_compra = $orden->ordenExiste();
                        $Estado = 'Finalizado';

                        if ($orden_compra) {
                            $cdto = new Candidatos();
                            $cdto->setCandidato($candidato['Candidato']);
                            $cdto->setEstado(252);
                            $cdto->setFactura($Factura);
                            $cdto->updateFactura();
                        } else {
                            $orden->save();
                            //$orden_compra = $orden->getFolio_Factura();

                            $cdto = new Candidatos();
                            $cdto->setCandidato($candidato['Candidato']);
                            $cdto->setEstado(252);
                            $cdto->setFactura($Factura);
                            $cdto->updateFactura();
                        }
                    } 
                }  

                echo json_encode(array('status' => 1));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function getCandidatosSinPrefacturaPorCliente()
    {
        $Cliente = isset($_POST['Cliente']) ? Utils::sanitizeStringBlank($_POST['Cliente']) : Null;

        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            if ($Cliente) {
                $candidatosObj = new Candidatos();
                $candidatosObj->setCliente($Cliente);
                $candidatos = $candidatosObj->getCandidatosSinprefacutraPorCliente();
                echo json_encode(array('status' => 1, 'candidatos' => $candidatos));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function updateSinFolioAPrefolio()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {

            $arrayCandidatos = count($_POST['Candidatos']) > 0 ? $_POST['Candidatos'] : null;
            $ID_Cliente = isset($_POST['ID_Cliente']) ? Utils::sanitizeStringBlank($_POST['ID_Cliente']) : Null;
            $Prefactura = isset($_POST['Prefactura']) ? Utils::sanitizeStringBlank($_POST['Prefactura']) : Null;
            //$Razon_Social = isset($_POST['Razon_Social']) ? Utils::sanitizeStringBlank($_POST['Razon_Social']) : Null;

            if (count($arrayCandidatos)>0 && $ID_Cliente && $Prefactura) {

                for ($i = 0; $i < count($arrayCandidatos); $i++) {
                    $cdto = new Candidatos();
                    $cdto->setCandidato($arrayCandidatos[$i]);
                    $Razon_Social=$cdto->getOne()->Razon;

                    $clienteObj = new Clientes();
                    $clienteObj->setCliente($ID_Cliente);
                    $Cliente = $clienteObj->getOne()->Nombre_Cliente;


                     if (substr($Prefactura, 0, 2) == 'F-') {
                        $Factura = str_replace(' ', '', $Prefactura);

                        $fact = new Facturas();
                        $fact->setFolio_Factura($Prefactura);
                        $Folio_Factura = $fact->facturaExiste();
                        $Estado = 'Facturado';
                        if ($Folio_Factura) {
                            $cdto = new Candidatos();
                            $cdto->setCandidato($arrayCandidatos[$i]);
                            $cdto->setEstado(254);
                            $cdto->setFactura($Prefactura);
                            $cdto->updateFactura();
                        } else {
                            $fact->setCliente($Cliente);
                            $fact->setID_Cliente($ID_Cliente);
                            $fact->setRazon_Social($Razon_Social);
                            $fact->save();
                            //$Folio_Factura = $fact->getFolio_Factura();

                            $cdto = new Candidatos();
                            $cdto->setCandidato($arrayCandidatos[$i]);
                            $cdto->setEstado(254);
                            $cdto->setFactura($Prefactura);
                            $cdto->updateFactura();
                        }
                    } else {
                        $orden = new OrdenesCompra();
                        $orden->setFolio_Factura($Prefactura);
                        $orden_compra = $orden->ordenExiste();
                        $Estado = 'Finalizado';
                        if ($orden_compra) {
                            $cdto = new Candidatos();
                            $cdto->setCandidato($arrayCandidatos[$i]);
                            $cdto->setEstado(252);
                            $cdto->setFactura($Prefactura);
                            $cdto->updateFactura();
                        } else {
                            $orden->save();
                            //$orden_compra = $orden->getFolio_Factura();
                            $cdto = new Candidatos();
                            $cdto->setCandidato($arrayCandidatos[$i]);
                            $cdto->setEstado(252);
                            $cdto->setFactura($Prefactura);
                            $cdto->updateFactura();
                        }
                    } 
                } 

                echo json_encode(array('status' => 1));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
    //==========================================================================================
	 //============================[Ulises Marzo 31 Vetar cliente]===============================
    public function updateVetarcliente()
    {
        if (Utils::isValid($_SESSION['identity']) && ($_SESSION['identity']->id == 1144 || $_SESSION['identity']->id == 539)) {
            $ClienteArray = isset($_POST['Clientes'])  ? $_POST['Clientes'] : Null;

            $clienteObj = new Clientes();
            
            if (count($ClienteArray)>0) {
                $clienteObj->updateClientesActivosAll();
                for ($i = 0; $i < count($ClienteArray); $i++) {
                    $clienteObj->setCliente($ClienteArray[$i]);
                    $clienteObj->setActivo(0);
                    $clienteObj->updateClienteActivo();
                }

                echo json_encode(array('status' => 1));
            } else {
                $clienteObj->updateClientesActivosAll();
                echo json_encode(array('status' => 1));
            }
        } else
            echo json_encode(array('status' => 0));
    }
	//==========================================================================================
  public static function formatear($facturas)
    {
        foreach ($facturas as &$factura) {
            $factura['Fecha_Emision'] =   Utils::getShortDate($factura['Fecha_Emision']);
            $factura['Monto'] = number_format($factura['Monto'], 2);
            $factura['Monto_IVA'] = number_format($factura['Monto_IVA'], 2);
            $factura['Fecha_de_Pago'] = (!is_null($factura['Fecha_de_Pago'])) ? Utils::getShortDate($factura['Fecha_de_Pago']) : '';
            $factura['Fecha_Ultima_Gestion'] = (!is_null($factura['Fecha_Ultima_Gestion'])) ? Utils::getShortDate($factura['Fecha_Ultima_Gestion']) : '';
            $factura['Proxima_Gestion'] = (!is_null($factura['Proxima_Gestion'])) ? Utils::getShortDate($factura['Proxima_Gestion']) : '';
            $factura['Promesa_Pago'] = (!is_null($factura['Promesa_Pago'])) ? Utils::getShortDate($factura['Promesa_Pago']) : '';
            $factura['Ultima_Gestion'] = (!is_null($factura['Ultima_Gestion'])) ? $factura['Ultima_Gestion'] : '';
            $factura['Folio_Factura_Encrypytado'] = Encryption::encode($factura['Folio_Factura']);
            $factura['fecha_cancelacion'] = (!is_null($factura['fecha_cancelacion'])) ? Utils::getShortDate($factura['fecha_cancelacion']) : '';
            $factura['comentarios'] = (!is_null($factura['comentarios'])) ? $factura['comentarios'] : '';
        }
        return $facturas;
    }
	
	  public function getInfoCancel()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST)) {
            $folio_factura = isset($_POST['factura'])  ? Encryption::decode($_POST['factura']) : Null;

            if ($folio_factura) {
                $factura = new Facturas;
                $factura->setFolio_Factura($folio_factura);
                $factura = $factura->getOne();
                $factura->Folio_Factura_encryptado = Encryption::encode($factura->Folio_Factura);
            }



            echo json_encode(array('status' => 1, 'factura' => $factura));
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function updateInfoCancelados()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST)) {

            $folio_factura = isset($_POST['factura'])  ? Encryption::decode($_POST['factura']) : Null;
            $comentarios = isset($_POST['comentarios'])  ? Utils::sanitizeString($_POST['comentarios']) : Null;
            $fecha_cancelacion = isset($_POST['fecha_cancelacion'])  ? Utils::sanitizeString($_POST['fecha_cancelacion']) : Null;

            if ($folio_factura) {
                $factura = new Facturas;
                $factura->setFolio_Factura($folio_factura);
                $factura->setComentarios($comentarios);
                $factura->setFecha_cancelacion($fecha_cancelacion);
                $update = $factura->updateInfoCancelados();

                $facturas_canceladas = Administracion_SAController::formatear($factura->getFacturasCanceladas());

                echo json_encode(array('status' => 1, 'factura' => $factura, 'facturas_canceladas' => $facturas_canceladas,));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

	  public function chagueCliente()
    {
        if (Utils::isValid($_SESSION['identity'])  && isset($_POST)) {
            $Cliente = isset($_POST['Cliente'])? Utils::sanitizeNumber($_POST['Cliente']):   Null;
            if ($Cliente ) {
                
                $clienteObj = new Clientes();
                $clienteObj->setCliente($Cliente);
                $cliente=$clienteObj->getOne();
                
                $razon = new RazonesSociales();
                $razon->setID_Cliente($Cliente);
                $razones = $razon->getRazonesSocialesPorCliente();
                echo json_encode(array('status' => 1, 'razones' => $razones,'cliente'=> $cliente));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }
}