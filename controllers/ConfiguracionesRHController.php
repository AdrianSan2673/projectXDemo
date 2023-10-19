<?php

require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/User.php';
require_once 'models/RH/AsistenceTypes.php';
require_once 'models/RH/WorkerRepresentative.php';
require_once 'models/RH/VacationPolicy.php';
require_once 'models/RH/HolidaysByYears.php';
require_once 'models/SA/Clientes.php';

class ConfiguracionesRHController
{


    public function index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);

            $clienteObj = new Clientes();
            $clienteObj->setCliente($_SESSION['id_cliente']);
            $cliente = $clienteObj->getOne();

            if ($cliente) {
                $cliente = (array) $cliente;
                $path = 'uploads/cliente/'.$cliente['Cliente'];
                if (file_exists($path)) {
                    $directory = opendir($path);
        
                    while ($file = readdir($directory))
                    {
                        if (!is_dir($file)){
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path."/".$file);
                            $route = base_url.$path.'/'.$file;
                        }
                    }
                }else {
                    $route = false;
                }
                $cliente['logo'] = $route;
            }

            $representative = new WorkerRepresentative();
            $representative->setCliente($_SESSION['id_cliente']);
            $representatives = $representative->getItemsByCliente();

            $policy = new VacationPolicy();
            $policy->setId(1);
            $policyDefault = $policy->getOne();

            $policy->setEmpresa($cliente['Empresa']);
            $policies = $policy->getPoliciesByEmpresa();

            //var_dump($policies);
            array_push($policies, (array) $policyDefault);
            $holiday = new HolidaysByYears();
            foreach ($policies as $key => $pol) {
                $holiday->setId_policy($pol['id']);
                $holidays = $holiday->getHolidaysByIdPolicy();
                if ($holidays)
                    $policies[$key]['holidays'] = $holidays;
                else
                    $policies[$key]['holidays'] = [];
            }

            $workdaysObj = new WorkDays();
            $workdaysObj->setCliente($cliente['Cliente']);
            $workdays = $workdaysObj->getWorkDaysByCliente();
            if (!$workdays) {
                $workdaysObj->setId(1);
                $workdays = $workdaysObj->getOne();
            }


            $dptos = new AsistenceTypes();

            //$dptos->setClient($_SESSION['id_cliente']);
            $types = $dptos->getAll();

            $page_title =  'Configuraciones | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/SettingsRH/index.php';
            require_once 'views/empresa/modal-imagen.php';
            require_once 'views/SettingsRH/modal-legal-representative.php';
            require_once 'views/SettingsRH/modal-workdays.php';
            require_once 'views/holidays/modal-policy.php';
            require_once 'views/SettingsRH/AsistenceTypes/modal-add-type.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function getWorkDays() {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && isset($_POST) && isset($_POST['Cliente'])) {
            $Cliente = Utils::sanitizeNumber(($_POST['Cliente']));
            $workday = new WorkDays();
            $workday->setCliente($Cliente);
            $workdays = $workday->getWorkDaysByCliente();
            if (!$workdays) {
                $workday->setId(1);
                $workdays = $workday->getOne();
            }
            
            echo json_encode(array('status' => 1, 'workdays' => $workdays));
        }else
            echo json_encode(array('status' => 0));
    }

    public function saveWorkdays() {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && isset($_POST) && isset($_POST['Cliente'])) {
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $sunday = isset($_POST['sunday']) ? 1 : 0;
            $monday = isset($_POST['monday']) ? 1 : 0;
            $tuesday = isset($_POST['tuesday']) ? 1 : 0;
            $wednesday = isset($_POST['wednesday']) ? 1 : 0;
            $thursday = isset($_POST['thursday']) ? 1 : 0;
            $friday = isset($_POST['friday']) ? 1 : 0;
            $saturday = isset($_POST['saturday']) ? 1 : 0;

            $workday = new WorkDays();
            $workday->setEmpresa($Empresa);
            $workday->setCliente($Cliente);
            $workday->setSunday($sunday);
            $workday->setMonday($monday);
            $workday->setTuesday($tuesday);
            $workday->setWednesday($wednesday);
            $workday->setThursday($thursday);
            $workday->setFriday($friday);
            $workday->setSaturday($saturday);
            if ($Cliente != 0) {
                $workdays = $workday->getOneByCliente();
                if ($workdays)
                    $workday->update();
                else
                    $workday->save();
            }
            $workdays = $workday->getOneByCliente();

            echo json_encode(array(
                'workdays' => $workdays,
                'status' => 1
            ));

        }else
            echo json_encode(array('status' => 0));
    }

    public function save_type()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA())) {

            $cliente = isset($_POST['client']) ? Encryption::decode(($_POST['client'])) : false;
            $type = isset($_POST['type']) ? Utils::sanitizeString($_POST['type']) : false;
            $flag = isset($_POST['flag']) ? Utils::sanitizeNumber($_POST['flag']) : false;
            $id_type = isset($_POST['id_type']) ? Utils::sanitizeNumber($_POST['id_type']) : false;


            if ($cliente && $type) {

                $Atype = new AsistenceTypes();

                if ($flag == 1) {

                    $Atype->setName($type);
                    $Atype->setClient($cliente);
                    $save = $Atype->save_type();

                    if ($save) {
                        $types = $Atype->getAllByClient();
                        echo json_encode(array('status' => 1, 'types' => $types));
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                } else if ($flag == 2) {

                    $Atype->setName($type);
                    $Atype->setId($id_type);
                    $save = $Atype->update_type();
                    $Atype->setClient($cliente);

                    if ($save) {
                        $types = $Atype->getAllByClient();
                        echo json_encode(array('status' => 1, 'types' => $types));
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function delete_type()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA())) {

            $id_type = isset($_POST['id_type']) ? Utils::sanitizeString($_POST['id_type']) : false;

            if ($id_type) {

                $Atype = new AsistenceTypes();


                $Atype->setId($id_type);
                $save = $Atype->delete_type();

                if ($save) {
                    $Atype->setClient($_SESSION['id_cliente']);
                    $types = $Atype->getAllByClient();
                    echo json_encode(array('status' => 1, 'types' => $types));
                } else {
                    echo json_encode(array('status' => 2));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }
}
