<?php

require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/RazonesSocialesEmpresa.php';

class RazonesSocialesController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity'])) {
            $ID_Razon = isset($_POST['ID_Razon']) ? trim($_POST['ID_Razon']) : FALSE;
            if ($ID_Razon) {
                $business = new RazonesSocialesEmpresa();
                $business->setID($ID_Razon);
                $business_names = $business->getOne();
                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($business_names, \JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
    }

    public function getRazonesByCliente(){
        if (Utils::isValid($_SESSION['identity'])) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            if ($Empresa && $Cliente) {
                $razonEmpresa = new RazonesSocialesEmpresa();
                $razonEmpresa->setEmpresa($Empresa);
                $razonesEmpresa = $razonEmpresa->getRazonesSocialesPorEmpresa();
                header('Content-Type: text/html; charset=utf-8');

                $razonCliente = new RazonesSociales();
                $razonCliente->setID_Cliente($Cliente);
                $razonesCliente = $razonCliente->getRazonesSocialesPorCliente();

                echo json_encode(
                    array(
                        'razonesEmpresa' => $razonesEmpresa,
                        'razonesCliente' => $razonesCliente
                    )
                );
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
    }

    public function save(){
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $ID = Utils::sanitizeNumber($_POST['ID']);
            $Empresa = Utils::sanitizeStringBlank($_POST['Empresa']);
            $Nombre_Empresa = Utils::sanitizeStringBlank($_POST['Nombre_Empresa']);
            $Razon = Utils::sanitizeStringBlank($_POST['Razon']);
            $RFC = Utils::sanitizeStringBlank($_POST['RFC']);

            $Direccion_Fiscal = Utils::sanitizeStringBlank($_POST['Direccion_Fiscal']);
            $Forma_Pago = Utils::sanitizeStringBlank($_POST['Forma_Pago']);
            $Regimen_Fiscal = Utils::sanitizeStringBlank($_POST['Regimen_Fiscal']);
            $Uso_CFDI = Utils::sanitizeStringBlank($_POST['Uso_CFDI']);
            $Situacion_Fiscal = isset($_FILES['Situacion_Fiscal']) && $_FILES['Situacion_Fiscal']['name'] != '' ? $_FILES['Situacion_Fiscal'] : FALSE;
            $Contacto = Utils::sanitizeStringBlank($_POST['Contacto']);
            $Otro = Utils::sanitizeStringBlank($_POST['Otro']);
            $ID_Cliente = Utils::sanitizeNumber(Encryption::decode($_POST['ID_Cliente']));
            $flag = $_POST['flag'];
            if ($Razon && $RFC && $Empresa) {
                $razonempresa = new RazonesSocialesEmpresa();
                $razonempresa->setID($ID);
                $razonempresa->setEmpresa($Empresa);
                $razonempresa->setNombre_Empresa($Nombre_Empresa);
                $razonempresa->setRazon($Razon);
                $razonempresa->setRFC($RFC);
                $razonempresa->setDireccion_Fiscal($Direccion_Fiscal);
                $razonempresa->setForma_Pago($Forma_Pago);
                $razonempresa->setRegimen_Fiscal($Regimen_Fiscal);
                $razonempresa->setUso_CFDI($Uso_CFDI);
                $razonempresa->setContacto($Contacto);
                $razonempresa->setOtro($Otro);

                if ($flag == 1) 
                    $save = $razonempresa->update();
                else                
                    $save = $razonempresa->create();

                if ($save) {
                    $ID = $razonempresa->getID();
                    $razones = $razonempresa->getRazonesSocialesPorEmpresa();

                    if ($Situacion_Fiscal) {
                        $allowed_formats = array("application/pdf");
                        $limit_kb = 12000;
                        if(!in_array($_FILES["Situacion_Fiscal"]["type"], $allowed_formats) || $_FILES["Situacion_Fiscal"]["size"] > $limit_kb * 1024){
                            //echo 4;
                        }else{
                            
                            $route = './uploads/situacionesfiscales/'.$Empresa;
                            if(!file_exists($route)){
                                mkdir($route);
                            }

                            $route2 = './uploads/situacionesfiscales/'.$Empresa.'/'.$RFC;
                            if(!file_exists($route2)){
                                mkdir($route2);
                            }

                            $Situacion_Fiscal = $route2.'/'.$_FILES["Situacion_Fiscal"]["name"];
                            
                            //if(!file_exists($Situacion_Fiscal)){
                                $result = move_uploaded_file($_FILES["Situacion_Fiscal"]["tmp_name"], $Situacion_Fiscal);
                            //}
                        }
                    }

                    for ($i=0; $i < count($razones); $i++) { 
                        $path = 'uploads/situacionesfiscales/'.$razones[$i]['Empresa'].'/'.$razones[$i]['RFC'];
                        if (file_exists($path)) {
                            $directory = opendir($path);
                            while ($file = readdir($directory)) {
                                if (!is_dir($file)) {
                                    $route = $path.'/'.$file;
                                }
                            }
                            $razones[$i]['archivo'] = base_url.$route;
                        }
                    }

                    if ($ID_Cliente) {
                        $razoncliente = new RazonesSociales();
                        $razoncliente->setID_Cliente($ID_Cliente);
                        $razoncliente->setID_Empresa($Empresa);
                        $razoncliente->setID_Razon($ID);
                        $razoncliente->setNombre_Razon($Razon);
                        $exists = $razoncliente->getByRazonYCliente();
                        $razones = $razoncliente->getRazonesSocialesPorCliente();

                        for ($i=0; $i < count($razones); $i++) { 
                            $path = 'uploads/situacionesfiscales/'.$razones[$i]['ID_Empresa'].'/'.$razones[$i]['RFC'];
                            if (file_exists($path)) {
                                $directory = opendir($path);
                                while ($file = readdir($directory)) {
                                    if (!is_dir($file)) {
                                        $route = $path.'/'.$file;
                                    }
                                }
                                $razones[$i]['archivo'] = base_url.$route;
                            }
                        }
                        if (!$exists) {
                            $razoncliente->create();
                            echo json_encode(
                                array(
                                    'razones' => $razones,
                                    'status' => 1
                                )
                            );
                        }else 
                            echo json_encode(
                                array(
                                    'razones' => $razones,
                                    'status' => 1
                                )
                            );
                        
                    }else {
                        echo json_encode(
                            array(
                                'razones' => $razones,
                                'status' => 1
                            )
                        );
                    }
                }else echo json_encode(array('status' => 2));
                
            }else
                echo json_encode(array('status' => 0));
        }else{
            header('location:'.base_url);
        }
    }

    public function crear(){
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            if (isset($_GET['id']) || Utils::isCandidate()) {
                $id = Encryption::decode($_GET['id']);
                $customer = new Customer();
                $customer->setId($id);
                $cliente = $customer->getOne();

                $page_title = $cliente->alias.' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/business_name.php';
                require_once 'views/layout/footer.php'; 
            } else {
                header("location:".base_url."cliente/index");
            }
        } else {
            header('location:'.base_url);
        }
    }

    public function editar(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $bn = new BusinessName();
                $bn->setId($id);
                $business = $bn->getOne();

                $customer = new Customer();
                $customer->setId($business->id_customer);
                $cliente = $customer->getOne();

                $page_title = $cliente->alias.' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/business_name.php';
                require_once 'views/layout/footer.php';
            }else {
                header('location:'.base_url.'cliente/index');
            }
        }else {
            header('location:'.base_url);
        }
    }

    public function save_razones_cliente(){
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Cliente = Utils::sanitizeNumber(Encryption::decode($_POST['Cliente']));
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            $razones = isset($_POST['razones']) && !empty($_POST['razones']) ? $_POST['razones'] : false;
            
            if ($Cliente) {
                $razonCliente = new RazonesSociales();
                $razonCliente->setID_Cliente($Cliente);
                $razonCliente->setID_Empresa($Empresa);
                $razonCliente->deleteRazonesPorCliente();
                if ($razones) {
                    foreach ($razones as $razon) {
                        $razonCliente->setID_Razon($razon);
                        $razonCliente->setNombre_Razon('');
                        $razonCliente->create();
                    }
                    $razones = $razonCliente->getRazonesSocialesPorCliente();
                } else
                    $razones = [];
                
                echo json_encode(
                    array(
                        'razones' => $razones,
                        'status' => 1
                    )
                );
            }else {
                echo json_encode(array('status' => 0));
            }
        }else{
            header('location:'.base_url);
        }
    }
}