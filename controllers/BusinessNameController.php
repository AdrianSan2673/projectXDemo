<?php

require_once 'models/BusinessName.php';
require_once 'models/Customer.php';

class BusinessNameController{

    public function getBNByCustomer(){
        if (Utils::isValid($_SESSION['identity'])) {
            $customer = isset($_POST['customer']) ? trim($_POST['customer']) : FALSE;
            if ($customer) {
                $business = new BusinessName();
                $business->setId_Customer($customer);
                $business_names = $business->getBNByCustomer();
                header('Content-Type: text/html; charset=utf-8');
                echo $json_customer_bn = json_encode($business_names, \JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
    }

    public function create(){
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $business_name = (isset($_POST['business_name'])) ? trim($_POST['business_name']) : FALSE;
            $RFC = (isset($_POST['RFC'])) ? trim($_POST['RFC']) : FALSE;
            $fiscal_address = Utils::sanitizeString($_POST['fiscal_address']);
            $method_of_payment = Utils::sanitizeString($_POST['method_of_payment']);
            $fiscal_regime = Utils::sanitizeString($_POST['fiscal_regime']);
            $use_of_CFDI = Utils::sanitizeString($_POST['use_of_CFDI']);
            $id_customer = (isset($_POST['id_customer'])) ? Encryption::decode($_POST['id_customer']) : FALSE;
            $fiscal_situation = isset($_FILES['fiscal_situation']) && $_FILES['fiscal_situation']['name'] != '' ? $_FILES['fiscal_situation'] : FALSE;

            if ($business_name && $RFC && $id_customer) {
                $razon = new BusinessName();
                $razon->setBusiness_name($business_name);
                $razon->setRFC($RFC);
                $razon->setFiscal_address($fiscal_address);
                $razon->setMethod_of_payment($method_of_payment);
                $razon->setFiscal_regime($fiscal_regime);
                $razon->setUse_of_CFDI($use_of_CFDI);
                $razon->setId_customer($id_customer);
                
                $save = $razon->create();

                if ($fiscal_situation) {
                    $allowed_formats = array("application/pdf");
                    $limit_kb = 12000;
                    if(!in_array($_FILES["fiscal_situation"]["type"], $allowed_formats) || $_FILES["fiscal_situation"]["size"] > $limit_kb * 1024){
                        //echo 4;
                    }else{
                        
                        $route = './uploads/fiscalsituations/'.$id_customer;
                        if(!file_exists($route)){
                            mkdir($route);
                        }

                        $route2 = './uploads/fiscalsituations/'.$id_customer.'/'.$RFC;
                        if(!file_exists($route2)){
                            mkdir($route2);
                        }

                        $fiscal_situation = $route2.'/'.$_FILES["fiscal_situation"]["name"];
                        
                        //if(!file_exists($fiscal_situation)){
                            $result = move_uploaded_file($_FILES["fiscal_situation"]["tmp_name"], $fiscal_situation);
                        //}
                    }
                }
                
                if ($save) {echo 1;}
                else{echo 2;}
                
                
            }else{
                echo 0;
            }
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

    public function update(){
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : FALSE;
            $business_name = (isset($_POST['business_name'])) ? trim($_POST['business_name']) : FALSE;
            $fiscal_address = Utils::sanitizeString($_POST['fiscal_address']);
            $method_of_payment = Utils::sanitizeString($_POST['method_of_payment']);
            $fiscal_regime = Utils::sanitizeString($_POST['fiscal_regime']);
            $use_of_CFDI = Utils::sanitizeString($_POST['use_of_CFDI']);
            $RFC = (isset($_POST['rfc'])) ? trim($_POST['rfc']) : FALSE;
            $fiscal_situation = isset($_FILES['fiscal_situation']) && $_FILES['fiscal_situation']['name'] != '' ? $_FILES['fiscal_situation'] : FALSE;
            $id_customer = (isset($_POST['id_customer'])) ? Encryption::decode($_POST['id_customer']) : FALSE;

            if ($id && $business_name && $RFC) {
                $razon = new BusinessName();
                $razon->setId($id);
                $razon->setBusiness_name($business_name);
                $razon->setRFC($RFC);
                $razon->setFiscal_address($fiscal_address);
                $razon->setMethod_of_payment($method_of_payment);
                $razon->setFiscal_regime($fiscal_regime);
                $razon->setUse_of_CFDI($use_of_CFDI);
                
                $update = $razon->update();

                if ($fiscal_situation) {
                    $allowed_formats = array("application/pdf");
                    $limit_kb = 12000;
                    if(!in_array($_FILES["fiscal_situation"]["type"], $allowed_formats) || $_FILES["fiscal_situation"]["size"] > $limit_kb * 1024){
                        //echo 4;
                    }else{
                        
                        $route = './uploads/fiscalsituations/'.$id_customer;
                        if(!file_exists($route)){
                            mkdir($route);
                        }

                        $route2 = './uploads/fiscalsituations/'.$id_customer.'/'.$RFC;
                        if(!file_exists($route2)){
                            mkdir($route2);
                        }

                        $fiscal_situation = $route2.'/'.$_FILES["fiscal_situation"]["name"];
                        
                        //if(!file_exists($fiscal_situation)){
                            $result = move_uploaded_file($_FILES["fiscal_situation"]["tmp_name"], $fiscal_situation);
                        //}
                    }
                }
                
                if ($update) {echo 1;}
                else{echo 2;}
            }else{
                echo 0;
            }

            
        }else{
            header("location:".base_url); 
        }
    }
}