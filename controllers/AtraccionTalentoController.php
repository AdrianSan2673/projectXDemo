<?php

require_once 'models/Customer.php';
require_once 'models/TalentAttraction.php';

class AtraccionTalentoController{

    public function index(){
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            
            $talent_attraction = new TalentAttraction();
            $attractions = $talent_attraction->getAll();

            $page_title = 'Atracción de Talento | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/talentattraction/index.php';
            require_once 'views/talentattraction/modal-create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:'.base_url);
        }
    }

    public function getOne(){
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            $id = Utils::sanitizeNumber($_POST['id']);
            
            if ($id) {
                $talent_attraction = new TalentAttraction();
                $talent_attraction->setId($id);
                $data = $talent_attraction->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            $id = Utils::sanitizeNumber($_POST['id']);
            $job_title = Utils::sanitizeStringBlank($_POST['job_title']);
            $request_date = Utils::sanitizeString($_POST['request_date']);
            $end_date = Utils::sanitizeString($_POST['end_date']);
            $id_state = Utils::sanitizeNumber($_POST['id_state']);
            $id_city = Utils::sanitizeNumber($_POST['id_city']);
            $salary = Utils::sanitizeNumber($_POST['salary']);
            $id_customer = Utils::sanitizeNumber($_POST['id_customer']);
            $id_business_name = Utils::sanitizeNumber($_POST['id_business_name']);
            $flag = $_POST['flag'];

            if ($job_title && $request_date && $id_state && $id_city && $id_customer) {
                $talent_attraction = new TalentAttraction();
                $talent_attraction->setId($id);
                $talent_attraction->setJob_title($job_title);
                $talent_attraction->setRequest_date($request_date);
                $talent_attraction->setEnd_date($end_date);
                $talent_attraction->setId_state($id_state);
                $talent_attraction->setId_city($id_city);
                $talent_attraction->setSalary($salary);
                $talent_attraction->setId_customer($id_customer);
                $talent_attraction->setId_business_name($id_business_name);
                $talent_attraction->setStatus(1);

                if ($flag == 1)
                    $save = $talent_attraction->update();
                else
                    $save = $talent_attraction->create();

                if ($save) {
                    if ($flag != 0) {
                        $cust = new Customer();
                        $cust->setId($id_customer);
                        $cliente = $cust->getOne()->customer;
                        
                         /*  $email = 'cindy.luna@rrhhingenia.com';
                        $name = 'Cindy Luna'; */
                        $email = 'iveth.gomez@rrhhingenia.com';
                        $name = 'Iveth Gómez ';

                        $subject = 'Nueva atracción de talento de '.$cliente;
                        $created_by = $_SESSION['identity']->first_name.' '.$_SESSION['identity']->last_name;
                        $body = "Se ha registrado una nueva atracción de talento de <b>{$cliente}</b> para el puesto de <b>{$job_title}</b> la cual fue creada por {$created_by}.";

                        Utils::sendEmail($email, $name, $subject, $body);
                    }

                    $attractions = $talent_attraction->getAll();
                    $data = array(
                        'attractions' => $attractions,
                        'status' => 1
                    );
                    echo json_encode($data);
                }else
                    echo json_encode(array('status' => 2));
                
            }else
                echo json_encode(array('status' => 0));
        }else
            header('location:'.base_url);
    }
    
}