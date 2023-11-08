<?php

use ParagonIE\Sodium\Core\Util;

require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/User.php';
require_once 'models/RH/AsistenceTypes.php';
//require_once 'models/RH/WorkerRepresentative.php';
require_once 'models/RH/VacationPolicy.php';
require_once 'models/RH/HolidaysByYears.php';
require_once 'models/SA/Clientes.php';

//gabo 23 oct
require_once 'models/RH/TemplateHolidays.php';
require_once 'models/RH/Holidays.php';
require_once 'models/RH/EmployeeHolidays.php';

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

            $dptos = new AsistenceTypes();
            //$dptos->setClient($_SESSION['id_cliente']);
            $types = $dptos->getAll();

            //dias festivos


            $plantilla = new TemplateHolidays();
            $plantilla->setCliente($_SESSION['id_cliente']);
            $templates = $plantilla->getAllByClient();
            $holidays =  $plantilla->getAllHolidays();


            $page_title =  'Configuraciones | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/SettingsRH/index.php';
            require_once 'views/empresa/modal-imagen.php';
            require_once 'views/SettingsRH/modal-legal-representative.php';
            require_once 'views/SettingsRH/modal-workdays.php';
            require_once 'views/holidays/modal-policy.php';
            require_once 'views/SettingsRH/AsistenceTypes/modal-add-type.php';
            //gabo 23 oct
            require_once 'views/SettingsRH/Holidays/modal-add-template.php';
            require_once 'views/SettingsRH/Holidays/modal-add-holiday.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    // public function getWorkDays()
    // {
    //     if ((Utils::isAdmin() || Utils::isCustomerSA()) && isset($_POST) && isset($_POST['Cliente'])) {
    //         $Cliente = Utils::sanitizeNumber(($_POST['Cliente']));
    //         $workday = new WorkDays();
    //         $workday->setCliente($Cliente);
    //         $workdays = $workday->getWorkDaysByCliente();
    //         if (!$workdays) {
    //             $workday->setId(1);
    //             $workdays = $workday->getOne();
    //         }

    //         echo json_encode(array('status' => 1, 'workdays' => $workdays));
    //     } else
    //         echo json_encode(array('status' => 0));
    // }

    // public function saveWorkdays()
    // {
    //     if ((Utils::isAdmin() || Utils::isCustomerSA()) && isset($_POST) && isset($_POST['Cliente'])) {
    //         $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
    //         $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
    //         $sunday = isset($_POST['sunday']) ? 1 : 0;
    //         $monday = isset($_POST['monday']) ? 1 : 0;
    //         $tuesday = isset($_POST['tuesday']) ? 1 : 0;
    //         $wednesday = isset($_POST['wednesday']) ? 1 : 0;
    //         $thursday = isset($_POST['thursday']) ? 1 : 0;
    //         $friday = isset($_POST['friday']) ? 1 : 0;
    //         $saturday = isset($_POST['saturday']) ? 1 : 0;

    //         $workday = new WorkDays();
    //         $workday->setEmpresa($Empresa);
    //         $workday->setCliente($Cliente);
    //         $workday->setSunday($sunday);
    //         $workday->setMonday($monday);
    //         $workday->setTuesday($tuesday);
    //         $workday->setWednesday($wednesday);
    //         $workday->setThursday($thursday);
    //         $workday->setFriday($friday);
    //         $workday->setSaturday($saturday);
    //         if ($Cliente != 0) {
    //             $workdays = $workday->getOneByCliente();
    //             if ($workdays)
    //                 $workday->update();
    //             else
    //                 $workday->save();
    //         }
    //         $workdays = $workday->getOneByCliente();

    //         echo json_encode(array(
    //             'workdays' => $workdays,
    //             'status' => 1
    //         ));
    //     } else
    //         echo json_encode(array('status' => 0));
    // }

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


    //gabo 23 oct




    public function save_template()
    {
        if ((Utils::isValid($_POST))) {

            $name = isset($_POST['name']) ? Utils::sanitizeString($_POST['name']) : false;

            if ($name) {

                $cliente = new Clientes();
                $cliente->setCliente($_SESSION['id_cliente']);
                $cliente = $cliente->getOne();

                $empresa = $cliente->Empresa;

                $plantilla = new TemplateHolidays();
                $plantilla->setName($name);
                $plantilla->setCliente($_SESSION['id_cliente']);
                $plantilla->setEmpresa($empresa);
                $plantilla->setStatus(0);
                $ultimaPlantilla = $plantilla->getLastHolidays();

                $save = $plantilla->save();


                if (isset($_POST['duplicate'])) {


                    $holiday = new Holidays();

                    foreach ($ultimaPlantilla as &$dates) {

                        $holiday->setName($dates['name']);
                        $holiday->setId_template($plantilla->getId());
                        $holiday->setStatus($dates['status']);
                        $holiday->setDay($dates['day']);
                        $holiday->setMonth($dates['month']);
                        $holiday->save();
                    }
                }




                if ($save) {
                    $templates = $plantilla->getAllByClient();

                    foreach ($templates as &$template) {
                        $template['id_encrypted'] = Encryption::encode($template['id']);
                    }

                    $dates =  $plantilla->getAllHolidays();

                    $dates = ConfiguracionesRHController::format_dates($dates);

                    echo json_encode(array('status' => 1, 'templates' => $templates, 'dates' => $dates));
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


    public function save_holiday()
    {
        if ((Utils::isValid($_POST))) {

            $name = isset($_POST['name']) && $_POST['name'] != '' ? Utils::sanitizeString($_POST['name']) : false;
            // $holiday = isset($_POST['holiday']) && $_POST['holiday'] != '' ? Utils::sanitizeString($_POST['holiday']) : false;
            $day = isset($_POST['day']) && $_POST['day'] != '' ? Utils::sanitizeString($_POST['day']) : false;
            $month = isset($_POST['month']) && $_POST['month'] != '' ? Utils::sanitizeString($_POST['month']) : false;

            $id_template = isset($_POST['id_template']) && $_POST['id_template'] != '' ? Encryption::decode($_POST['id_template']) : false;
            $id_holiday = isset($_POST['id_holiday']) && $_POST['id_holiday'] != '' ? Encryption::decode($_POST['id_holiday']) : false;


            //valida que no esten ocupados
            $template = new EmployeeHolidays();
            $template->setId_Template($id_template);
            $ocupado = $template->getOneByIdTemplate();
            if ($ocupado) {
                echo json_encode(array('status' => 3));
                die();
            }


            if ($name && $id_template && $day && $month) {

                $holidays = new Holidays();
                $holidays->setName($name);
                $holidays->setDay($day);
                $holidays->setMonth($month);
                $holidays->setId_template($id_template);
                $holidays->setStatus(1);

                if ($id_holiday) {
                    $holidays->setId($id_holiday);

                    $save = $holidays->update();
                } else {
                    $save = $holidays->save();
                }



                if ($save) {
                    $dates = $holidays->getAllByIdTemplate();
                    $dates = ConfiguracionesRHController::format_dates($dates);

                    $template = new TemplateHolidays();
                    $template->setId($id_template);
                    $active = $template->getStatusTemplate();


                    echo json_encode(array('active' =>  $active, 'status' => 1, 'dates' => $dates, 'id_template' => $id_template, 'id_template_encrypted' => Encryption::encode($id_template)));
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

    //gabo 25 oct

    public function activate_template()
    {
        if ((Utils::isValid($_POST))) {

            $id_template = isset($_POST['id_template']) ? Encryption::decode($_POST['id_template']) : false;

            if ($id_template) {

                $plantilla = new TemplateHolidays();
                $plantilla->setCliente($_SESSION['id_cliente']);
                $activada = $plantilla->getActivatedTemplate();

                $plantilla->setId($id_template);
                $plantilla->setStatus(1);
                $save = $plantilla->update_status();


                if ($save) {
                    if ($activada) {
                        $plantilla->setId($activada->id);
                        $plantilla->setStatus(0);
                        $plantilla->update_status();
                    }
                    $templates = $plantilla->getAllByClient();

                    foreach ($templates as &$template) {
                        $template['id_encrypted'] = Encryption::encode($template['id']);
                    }

                    $dates =  $plantilla->getAllHolidays();

                    $dates = ConfiguracionesRHController::format_dates($dates);

                    echo json_encode(array('status' => 1, 'templates' => $templates, 'dates' => $dates));
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


    public function delete_holiday()
    {
        if ((Utils::isValid($_POST))) {

            $id = isset($_POST['id']) && $_POST['id'] != '' ? Encryption::decode($_POST['id']) : false;
            $id_template = isset($_POST['id_template']) && $_POST['id_template'] != '' ? Encryption::decode($_POST['id_template']) : false;
            if ($id_template && $id) {

                //valida que no esten ocupados
                $template = new EmployeeHolidays();
                $template->setId_Template($id_template);
                $ocupado = $template->getOneByIdTemplate();
                if ($ocupado) {
                    echo json_encode(array('status' => 3));
                    die();
                }

                $holidays = new Holidays();
                $holidays->setId_template($id_template);
                $holidays->setId($id);
                $holidays->setStatus(0);
                $save = $holidays->delete_holiday();

                if ($save) {
                    $dates = $holidays->getAllByIdTemplate();
                    $dates = ConfiguracionesRHController::format_dates($dates);

                    $template = new TemplateHolidays();
                    $template->setId($id_template);
                    $active = $template->getStatusTemplate();

                    echo json_encode(array('active' => $active, 'status' => 1, 'dates' => $dates, 'id_template' => $id_template, 'id_template_encrypted' => Encryption::encode($id_template)));
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

    public static function format_dates($dates)
    {
        $month = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        foreach ($dates as &$date) {
            $date['id_encrypted'] = Encryption::encode($date['id']);
            $date['converted_month'] = $month[$date['month'] - 1];
        }

        return $dates;
    }



    public function delete_template()
    {
        if ((Utils::isValid($_POST))) {

            $id_template = isset($_POST['id_template']) ? Encryption::decode($_POST['id_template']) : false;

            if ($id_template) {

                $plantilla = new TemplateHolidays();
                $plantilla->setCliente($_SESSION['id_cliente']);
                $activada = $plantilla->getActivatedTemplate();


                if ($id_template == $activada->id) {
                    echo json_encode(array('status' => 3));
                    die();
                }

                $plantilla->setId($id_template);
                $plantilla->setStatus(2);
                $save = $plantilla->update_status();

                if ($save) {

                    $templates = $plantilla->getAllByClient();

                    foreach ($templates as &$template) {
                        $template['id_encrypted'] = Encryption::encode($template['id']);
                    }

                    $dates =  $plantilla->getAllHolidays();

                    $dates = ConfiguracionesRHController::format_dates($dates);

                    echo json_encode(array('status' => 1, 'templates' => $templates, 'dates' => $dates));
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
