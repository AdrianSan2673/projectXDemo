<?php


require_once 'models/User.php';
require_once 'models/RH/Rh_Bills.php';
require_once 'models/RH/Rh_Module.php';
require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/OrdenesCompra.php';
require_once 'models/SA/Facturas.php';
require_once 'models/SA/FacturasGestiones.php';
require_once 'models/RH/PackagesRH.php';
require_once 'models/SA/Clientes.php';

class Administracion_RhController
{



    public function facturacion()
    {
        if (Utils::isAdmin() || Utils::isManager()) {

            $servicios_rh = new RH_Module();
            $servicios_rh->getALL();
            $servicios = $servicios_rh->getAll();

            $page_title = 'Facturación RH | SIGMA';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion_RH/modal-editRH.php';
            require_once 'views/administracion_RH/facturacion.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function cobranza()
    {
        if (Utils::isAdmin() || Utils::isManager()) {
            $factura = new RH_Bills();


            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            } else {
                $facturas_pendientes = $factura->getFacturasPendientes();
                $facturas_pagadas = $factura->getFacturasPagadas();
            }


            $page_title = 'Cobranza RH | SIGMA';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            // require_once 'views/administracion/modal_afectar_facturas_cobranza.php';
            // require_once 'views/administracion/modal_gestion_facturas_cobranza.php';
            // require_once 'views/administracion/modal_vetar_cliente.php';
            require_once 'views/administracion_RH/cobranza.php';
            require_once 'views/layout/footer.php';
            require_once 'views/administracion_RH/modal-factura.php';
        } else {
            header("location:" . base_url);
        }
    }


    public function getServicio()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager()) {
            $id = isset($_POST['id']) ? trim($_POST['id']) : FALSE;


            if ($id) {

                $servicios_rh = new RH_Module();
                $servicios_rh->setId($id);
                $servicio = $servicios_rh->getOne();

                $razon = new RazonesSociales();
                $razon->setID_Cliente($servicio->cliente);
                $razones = $razon->getRazonesSocialesPorCliente();

                $all_info = array(
                    'servicio' => $servicio,
                    'razones' => $razones,
                    'status' => 1
                );


                echo json_encode($all_info);
            } else
                echo json_encode(array('status' => 0));
        } else
            header('location:' . base_url);
    }


    public function update_folio()
    {

        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager()) {
            $id = Utils::sanitizeNumber($_POST['id']);
            $ID_Cliente = Utils::sanitizeNumber($_POST['id_cliente']);
            $Factura = Utils::sanitizeString($_POST['factura']);
            $Razon_Social = Utils::sanitizeString($_POST['Razon_Social']);


            if ($id && $ID_Cliente) {
                $Factura = strtoupper($Factura);
                if (substr($Factura, 0, 2) == 'F-') {
                    $fact = new RH_Bills();
                    $fact->setFactura($Factura);
                    $Folio_Factura = $fact->facturaExiste();
                    $Estado = 'Facturado';


                    if ($Folio_Factura) {
                        $cdto = new RH_Module();
                        $cdto->setId($id);
                        $cdto->setFactura($Factura);
                        $cdto->setStatus(254);
                        $cdto->update();
                    } else {
                        $fact->setID_Cliente($ID_Cliente);
                        $fact->setRazon_Social($Razon_Social);
                        //1 = Pendiente de pago
                        $fact->setStatus('Pendiente de pago');
                        $fact->save();


                        $Factura =  $fact->getOne()->factura;

                        $cdto = new RH_Module();
                        $cdto->setId($id);
                        $cdto->setFactura($Factura);
                        $cdto->setStatus(254);
                        $cdto->update();
                        //254
                    }
                } else {
                    $orden = new OrdenesCompra();
                    $orden->setFolio_Factura($Factura);
                    $orden_compra = $orden->ordenExiste();
                    $Estado = 'Finalizado';
                    if ($orden_compra) {
                        $cdto = new RH_Module();
                        $cdto->setId($id);
                        $cdto->setFactura($Factura);
                        $cdto->setStatus(252);
                        $cdto->update();
                    } else {
                        $orden->save();
                        //$orden_compra = $orden->getFolio_Factura();
                        $cdto = new RH_Module();
                        $cdto->setId($id);
                        $cdto->setFactura($Factura);
                        $cdto->setStatus(252);
                        $cdto->update();
                        //252
                    }
                }

                echo json_encode(
                    array('id' => $id, 'factura' => $Factura, 'razon' => $Razon_Social, 'estado' => $Estado, 'status' => 1)
                );
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }



    public function getFactura()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $id = Utils::sanitizeString($_POST['id']);

            if ($id) {
                $facturas = new RH_Bills();
                $facturas->setId($id);
                $factura_datos = $facturas->getOne();

                $razon = new RazonesSociales();
                $razon->setID_Cliente($factura_datos->id_cliente);
                $razones = $razon->getRazonesSocialesPorCliente();

                $factura_datos->cost = number_format($factura_datos->cost, 2);
                $factura_datos->id = Encryption::encode($factura_datos->id);

                $all_info = array(
                    'factura_datos' => $factura_datos,
                    'razones' => $razones,
                    'status' => 1
                );

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($all_info);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }



    public function UpdateFactura()
    {

        if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id'])  ? Encryption::decode($_POST['id']) : NULL;
            $Folio_Factura = Utils::sanitizeStringBlank($_POST['Folio_Factura']);
            $factura_anterior = Utils::sanitizeStringBlank($_POST['Folio']);
            $Fecha_Emision = isset($_POST['emision_Date']) ? $_POST['emision_Date'] : FALSE;
            $Razon_Social = isset($_POST['Razon_Social']) && !empty($_POST['Razon_Social']) ? $_POST['Razon_Social'] : 'Pendiente';
            $Estado = isset($_POST['Estado']) ? $_POST['Estado'] : FALSE;
            $Monto = isset($_POST['Monto']) && !empty($_POST['Monto']) ? trim($_POST['Monto']) : 0;
            $Fecha_de_Pago = isset($_POST['Fecha_de_Pago']) && !empty($_POST['Fecha_de_Pago']) ? trim($_POST['Fecha_de_Pago']) : NULL;


            if ($id && $Folio_Factura && $Fecha_Emision  && $Razon_Social && $Estado) {
                $factura = new RH_Bills;
                $factura->setId($id);
                $factura->setFactura_Anterior($factura_anterior);
                $factura->setFactura($Folio_Factura);
                $factura->setEmision_date($Fecha_Emision);
                $factura->setRazon_Social($Razon_Social);
                $factura->setStatus($Estado);
                // $factura->setPromesa_Pago($Promesa_Pago);
                $factura->setCost($Monto);
                $factura->setPayment_date($Fecha_de_Pago);
                $update = $factura->update();

                $Factura = $factura->getOne();


                $Factura->emision_date = ($Factura->emision_date != '') ? Utils::getShortDate($Factura->emision_date) : $Factura->emision_date;
                $Factura->payment_date =  ($Factura->payment_date != '') ? Utils::getShortDate($Factura->payment_date) : $Factura->payment_date;
                $Factura->Proxima_Gestion = ($Factura->Proxima_Gestion != '') ? Utils::getShortDate($Factura->Proxima_Gestion) : $Factura->Proxima_Gestion;
                $Factura->Promesa_Pago = ($Factura->Promesa_Pago != '') ? Utils::getShortDate($Factura->Promesa_Pago) : $Factura->Promesa_Pago;


                if ($update) {
                    $factura->updateFolioYRazonDeServiciosPorFolio();
                    $factura->updateSeguimientosPorFolio();
                    echo json_encode(array(
                        'Factura' => $Factura,
                        'status' => 1
                    ));
                } else {
                    echo json_encode(array('status' => 2));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }




    public function bill_follow_up()
    {


        if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id'])  ? Encryption::decode($_POST['id']) : NULL;
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;
            $Folio_Factura = isset($_POST['Folio_Factura']) ? trim($_POST['Folio_Factura']) : FALSE;
            $Promesa_Pago = isset($_POST['Promesa_Pago']) && !empty($_POST['Promesa_Pago']) ? trim($_POST['Promesa_Pago']) : NULL;
            $Contacto_Con = isset($_POST['Contacto_Con']) && !empty($_POST['Contacto_Con']) ? trim($_POST['Contacto_Con']) : NULL;
            $Comentarios = isset($_POST['Comentarios']) && !empty($_POST['Comentarios']) ? trim($_POST['Comentarios']) : NULL;
            $Usuario = isset($_SESSION['identity']) ? strtoupper($_SESSION['identity']->username) : NULL;
            $Proxima_Gestion = Utils::sanitizeString($_POST['Proxima_Gestion']);

            if ($Folio && $Folio_Factura  && $Contacto_Con && $Comentarios) {

                $factura = new RH_Bills;
                $factura->setId($id);
                $factura->setFactura($Folio_Factura);
                $factura->setProxima_Gestion($Proxima_Gestion);
                $update = $factura->updateFollowUp();



                if ($update) {
                    $gestion = new FacturasGestiones();
                    $gestion->setFolio_Factura($Folio_Factura);
                    $gestion->setPromesa_Pago($Promesa_Pago);
                    $gestion->setContacto_Con($Contacto_Con);
                    $gestion->setComentarios($Comentarios);
                    $gestion->setUsuario($Usuario);
                    $gestion->setProxima_Gestion($Proxima_Gestion);
                    $creado = $gestion->create();


                    $factura = $factura->getOne();
                    $factura->Fecha_Ultima_Gestion = ($factura->Fecha_Ultima_Gestion != '') ? Utils::getShortDate($factura->Fecha_Ultima_Gestion) : $factura->Fecha_Ultima_Gestion;
                    $factura->payment_date =  ($factura->payment_date != '') ? Utils::getShortDate($factura->payment_date) : $factura->payment_date;
                    $factura->Proxima_Gestion = ($factura->Proxima_Gestion != '') ? Utils::getShortDate($factura->Proxima_Gestion) : $factura->Proxima_Gestion;
                    $factura->Promesa_Pago = ($factura->Promesa_Pago != '') ? Utils::getShortDate($factura->Promesa_Pago) : $factura->Promesa_Pago;


                    if ($creado) {
                        echo json_encode(array('status' => 1, 'Factura' => $factura));
                    } else {
                        echo json_encode(array('status' => 0));
                    }
                } else {
                    echo json_encode(array('status' => 2));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }



    public function editar_factura()
    {
        if (Utils::isAdmin() || Utils::isManager()) {
            if (isset($_GET['id'])) {
                $id_factura = Encryption::decode($_GET['id']);
                $factura = Encryption::decode($_GET['factura']);
                $facturas = new RH_Bills();
                $facturas->setId($id_factura);

                $servicios = $facturas->getServiciosPorIDFactura();

                $facturas->setFactura($factura);
                $seguimientos = $facturas->getSeguimientosPorFolio();
                $factura = $facturas->getOne();
            } else {
                header("location:" . base_url . "administracion_SA/cobranza");
            }


            $page_title = "{$factura->factura} Factura | SIGMA";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/administracion_RH/editar_factura.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    
    //===[gabo 12 julio  corte]===


    public function corte() //cada fin de mes
    {

        //sacar todos los clientes que tinen el serivico
        $module = new RH_Module();
        $clientes = $module->getALL_Clientes();
        $hoy = date("d-m-Y");
        $hoy = date("2023-10-31");

        $anioActual = date("Y");
        $mesActual = date("n");
        $cantidadDias = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);
        $cantidadDias = 31;

        $rh_module = new RH_Module();

        for ($i = 0; $i < count($clientes); $i++) {


            $module->setId_cliente($clientes[$i]['Cliente']);
            $servicios = $module->getAllServices_NoBilled_ByCliente();
            $total_servicios = count($servicios);
            $ultimo_corte = false;
            $costo_proporcional = 0;

            for ($k = 0; $k < count($servicios); $k++) {

                //ccompara con el servicio anterior para sacar los costos con la diferiencia de fechas entre dos servicios
                if (isset($servicios[$k - 1]['start_date'])) {
                    $fecha_inicial = new DateTime($servicios[$k]['start_date']);

                    //si hay fecha de cancelacion en este servicio la toma en lugar de la fecha del servicio anterior
                    if ($servicios[$k]['cancellation_date'] != "") {
                        $fecha_corte = new DateTime($servicios[$k]['cancellation_date']);
                        $diferiencia = $fecha_inicial->diff($fecha_corte);
                        $total_dias_ocupados = intval($diferiencia->format('%a'));
                    } else {
                        $fecha_corte = new DateTime($servicios[$k - 1]['start_date']);
                        $diferiencia = $fecha_inicial->diff($fecha_corte);
                        $total_dias_ocupados = intval($diferiencia->format('%a'));
                    }


                    $costo_proporcional =  ($servicios[$k]['cost_package'] / $cantidadDias) * $total_dias_ocupados;

                    $rh_module->setId($servicios[$k]['id_rh']);
                    $rh_module->setCost(number_format($costo_proporcional, 2));
                    $rh_module->setBilled_days($total_dias_ocupados);

                    $save = $rh_module->corte();
                } else { //cuando es el ultimo movimiento del mes saca el costo con el ultimo dis del mes

                    $fecha_inicial = new DateTime($servicios[$k]['start_date']);

                    //si hay fecha de cancelacion se utiliza para saar el costo hasta ese dia
                    if ($servicios[$k]['cancellation_date'] != "") {
                        $fecha_corte = new DateTime($servicios[$k]['cancellation_date']);
                        $diferiencia = $fecha_inicial->diff($fecha_corte);
                        $total_dias_ocupados = intval($diferiencia->format('%a'));
                        $ultimo_corte = true;
                    } else {
                        $fecha_corte = new DateTime($hoy);
                        $diferiencia = $fecha_inicial->diff($fecha_corte);
                        $total_dias_ocupados = intval($diferiencia->format('%a')) + 1;
                    }



                    $costo_proporcional =  ($servicios[$k]['cost_package'] / $cantidadDias) * $total_dias_ocupados;

                    $rh_module->setId($servicios[$k]['id_rh']);
                    $rh_module->setBilled_days($total_dias_ocupados);
                    $rh_module->setCost(number_format($costo_proporcional, 2));

                    $save =   $rh_module->corte();

                    $id_paquete_actual = $servicios[$k]['id_package'];
                    $id_cliente = $servicios[$k]['id_cliente_rh'];
                }
            }
            //si tiene servicios activos inserta la renoviacion mensual y si no esta cancelado el servicio
            if ($total_servicios != 0 && !$ultimo_corte) {
                // Administracion_RhController::InsertarServicio($id_paquete_actual, $id_cliente);

                $paquete = new PackagesRH();
                $paquete->setId($id_paquete_actual);
                $paquete = $paquete->getOne();
                $precioPaquete = $paquete->cost;
                $id_package = $paquete->id;

                $servicio = new RH_Module(); //insertamos el nuevo ciclo
                $servicio->setCost(0);
                $servicio->setCost_package($precioPaquete);
                $servicio->setId_cliente($id_cliente);
                $servicio->setId_package($id_package);
                $servicio->setDays(0);
                $servicio->setStatus(252);
                //fecha de incicio el primer dia de cada mes
                $mañana =  date("Y-m-d", strtotime($hoy  . "+ 1 days"));
                $servicio->setStart_date($mañana);

                $save = $servicio->save();
            }
        }
    }

    
    //===[gabo 18 julio diario]===
    public function diario()
    {

        //sacar todos los clientes que tinen el serivico
        $module = new RH_Module();
        $clientes = $module->getALL_Clientes();
        $hoy = date("d-m-Y");
        $hoy = '2023-08-12';


        for ($i = 0; $i < count($clientes); $i++) {

            $dias_credito_cliente = $clientes[$i]['Dias_Credito'];

            //si tiene el paquete de prueba y ya se le vencio
            //sacar los servicios que tiene con su factura si es que tiene
            $module->setId_cliente($clientes[$i]['Cliente']);
            $servicios = $module->getAllServices_NoPaid_ByCliente();

            //ingresamos a los servicios que no tienen facturas pagadas
            for ($j = 0; $j < count($servicios); $j++) {

                //cuando tiene el periodo de prueba
                if ($servicios[$j]['id_package'] == 1 && count($servicios) == 1) {

                    //sumo los dias que tiene de prueba ala fecha inicial
                    $fecha_desactivacion = date("Y-m-d", strtotime($servicios[$j]['start_date']  . "+ " . $servicios[$j]['days'] . " days"));

                    if ($fecha_desactivacion == $hoy) {
                        $cliente = new Clientes();
                        $cliente->setCliente($servicios[$j]['id_cliente']);
                        $cliente->setActivo(0);
                        $cliente->updateClienteActivoRH();
                        echo "desactivo  con dias gratis";
                    }
                }

                //si tiene otro paquete pero no tiene factura no entra pero si ya tiene factura si entra para validar que este vigente
                if ($servicios[$j]['id_package'] != 1 && $servicios[$j]['status_factura'] == 'Pendiente de pago') {
                    //si ya tiene factura entra y verifica paraa desactuivar en caso de que ya este vencida

                    $fecha_desactivacion = date("Y-m-d", strtotime($servicios[$j]['emision_date']  . "+ " . $dias_credito_cliente . " days"));

                    //si la fecha de promesa de pago es mayor ala fecha de desactivacion entonces se respeta la fecha de promesa de pago
                    if (strtotime($servicios[$j]['Promesa_Pago']) > strtotime($fecha_desactivacion)) {
                        $fecha_desactivacion = $servicios[$j]['Promesa_Pago'];
                    }

                    if ($fecha_desactivacion == $hoy) {
                        $cliente = new Clientes();
                        $cliente->setCliente($servicios[$j]['id_cliente']);
                        $cliente->setActivo(0);
                        $cliente->updateClienteActivoRH();
                        echo "desactivo con promesa de pago";
                    }
                }
            }
        }

        // //===[gabo  12 julio corte fin]===
        // echo "hola mundo";
    }
}
