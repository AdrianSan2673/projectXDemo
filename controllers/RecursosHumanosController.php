<?php

require_once 'models/SA/Clientes.php';
require_once 'models/SA/CandidatosReferencias.php';
require_once 'models/SA/ContactosCliente.php';
require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/ClientesNotas.php';
require_once 'models/SA/Prospecto.php';
require_once 'models/SA/Candidatos.php';
require_once 'models/SA/ContactosClienteCobranza.php';
require_once 'models/SA/Clientes.php';
require_once 'models/RH/PackagesRH.php';
require_once 'models/RH/Rh_Module.php';


class RecursosHumanosController
{

    public function index()
    {


        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {
            $cliente = new Clientes();
            $clientes = $cliente->getAllClientesRH();

            $page_title = 'Nuestros clientes SA | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/cliente/index_RH.php';
            require_once 'views/layout/footer.php';
            require_once 'views/cliente/modal-RH.php';
        } else
            header('location:' . base_url);
    }

    public function getOne()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager() || Utils::isSAManager() || Utils::isSales() || Utils::isSalesManager()) {
            $Cliente = isset($_POST['Cliente']) ? Utils::sanitizeNumber(Encryption::decode($_POST['Cliente'])) : null;

            if ($Cliente) {
                $customer = new Clientes();
                $customer->setCliente($Cliente);
                $customer = $customer->getOne();
                $customer->Cliente = Encryption::encode($customer->Cliente);

                $moduleObj = new Rh_Module();
                $moduleObj->setId_cliente($Cliente);
                $module = $moduleObj->getOneByIdCliente();
                if ($module != '') {
                    $module->id = Encryption::encode($module->id);
                    //$module->cancellation_date = $module->cancellation_date != null ?  substr($module->cancellation_date, 0, 10) : null;
                }

                if ($customer) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode(array('status' => 1, 'customer' => $customer, 'module' => $module));
                } else {

                    echo json_encode(array('status' => 1));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else
            echo json_encode(array('status' => 0));
    }


    public function save()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager() || Utils::isSAManager() || Utils::isSales() || Utils::isSalesManager()) {
            $Cliente = isset($_POST['Cliente']) ? Utils::sanitizeNumber(Encryption::decode($_POST['Cliente'])) : null;


            $id_package = isset($_POST['id_package']) ? Utils::sanitizeNumber($_POST['id_package']) : null;
            $cancellation_date = isset($_POST['cancellation_date']) ? Utils::sanitizeStringBlank($_POST['cancellation_date']) : null;
            $comment = isset($_POST['comment']) ? Utils::sanitizeStringBlank($_POST['comment']) : null;
            $id_moduel = isset($_POST['id_moduel']) ? Utils::sanitizeNumber(Encryption::decode($_POST['id_moduel'])) : null;


            if ($Cliente && $id_package) {

                $packagesRHObj = new PackagesRH();
                $packagesRHObj->setId($id_package);
                $cost = $packagesRHObj->getOne()->cost;

                $customer = new Clientes();
                $customer->setCliente($Cliente);

                $moduleObj = new Rh_Module();
                $moduleObj->setId_cliente($Cliente);

                if ($cancellation_date && $id_moduel) {

                    $module = $moduleObj->getOneByIdClienteSinFactura();
                    foreach ($module as $mod) {
                        $moduleObj->setId($mod['id']);
                        $moduleObj->setCancellation_date($cancellation_date);
                        $moduleObj->setComment($comment);
                        $moduleObj->updateCancel();
                    }

                    $customer->setActivo(0);
                    $customer->updateClienteActivoRH();
                    // else if(Si tiene mas de 1 servicio sin factura )
                    //
                } else {
                    $moduleObj->setId_package($id_package);
                    //===[gabo 17 julio corte]===
                    $moduleObj->setCost(0); //aquii
                    $moduleObj->setCost_package(number_format($cost, 2)); //aquii
                    //===[gabo 17 julio corte fin]===
                    $moduleObj->setDays(30);

                    // ===[gabo 27 junio perfil]==

                    //===[gabo 17 julio corte]===
                    //si es paquete de prueba  es 254 para que se ignoren en los procesos
                    if ($id_package == 1) {
                        $status = 254;
                    } else {
                        $status = 252;
                    }
                    $moduleObj->setStatus($status);
                    //===[gabo 17 julio corte fin]===

                    $moduleObj->setStart_date(date("Y-m-d"));
                    // ===[gabo 27 junio perfil fin]==

                    //gabo 4 nov
                    $moduleObj->save();

                    $customer->setActivo(1);
                    $customer->updateClienteActivoRH();



                   $module_rh= $moduleObj->getOne();

                     
                    $template = new TemplateHolidays;
                    $cliente = new Clientes();
                    $cliente->setCliente($Cliente);
                    $cliente = $cliente->getOne();
                    $empresa = $cliente->Empresa;

                    $template->setName('Dias Festivos' . GETDATE('Y'));
                    $template->setCliente($Cliente);
                    $template->setEmpresa($empresa);
                    $template->setStatus(0);
                    $save = $template->save();

                    $holidays = Utils::getDefaultHolidays();

                    foreach ($holidays as &$holiday) {
                        var_dump($holiday);
                        die();
                    }


                }

                $clientes = $customer->getAllClientesRH();
                foreach ($clientes as &$cliente) {
                    $cliente['Id_cliente'] = $cliente['Cliente'];
                    $cliente['Cliente'] = Encryption::encode($cliente['Cliente']);
                    $cliente['hidden'] = Utils::isAdmin() == true ? '' : 'hidden';
                    $cliente['Fecha_Registro'] = Utils::getShortDate($cliente['Fecha_Registro']);
                    $cliente['Fecha_cancelacion'] = $cliente['Fecha_cancelacion'] == '' ? 'Sin cancelacion' : Utils::getDate($cliente['Fecha_cancelacion']);
                    $cliente['url'] = base_url . 'cliente_SA/ver&id=' . $cliente['Cliente'];
                }

                if ($customer) {
                    echo json_encode(array(
                        'status' => 1,
                        'clientes' => $clientes
                    ));
                } else {
                    echo json_encode(array('status' => 0));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else
            echo json_encode(array('status' => 0));
    }
}