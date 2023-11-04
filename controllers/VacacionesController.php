<?php

require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/RH/EmployeeHolidays.php';
require_once 'models/RH/VacationPolicy.php';
require_once 'models/RH/HolidaysByYears.php';
require_once 'models/RH/Employees.php';
require_once 'models/SA/ContactosCliente.php';
//gabo 18 oct
require_once 'models/RH/VacationPolicy.php';
require_once 'models/SA/WorkDays.php';
class VacacionesController
{

    public function index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;
                $employee = new EmployeeHolidays();
                /*
				$employee->setID_Contacto($id_contacto);
                $employees = $employee->getEmployeesHolidaysByContacto();*/
                //$holidays = $employee->getEmployeesHolidaysRequestedByContacto();

                $employee->setID_Contacto($_SESSION['id_cliente']);
                $employee->setStatus('1');
                $employees = $employee->getEmployeesHolidaysByCliente();
                $employees =  VacacionesController::Format_employees($employees);

                //gabo 18 oct
                //   $solicitudes = $employee->getEmployeesHolidaysRequestedByID_User($_SESSION['identity']->id);

                $empleado = new Employees();
                $empleado->setCliente($_SESSION['id_cliente']);
                //verfiicar si es adminisrador
                $solicitudes_pendientes = $empleado->getEmployeesAllHolidaysRequested();
                $solicitudes_pendientes =  VacacionesController::Format_requests($solicitudes_pendientes);
            }


            //gabo 18 oct


            $page_title = 'Empleados | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/holidays/index.php';
            require_once 'views/holidays/modal-create.php';
            require_once 'views/holidays/modal-responder-solicitudes-admin.php';
            require_once 'views/holidays/modal-update-holidays.php';

            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }




    public function save()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            $id = Utils::sanitizeNumber($_POST['id']);
            $id_employee = Utils::sanitizeNumber($_POST['id_employee']);
            $start_date = Utils::sanitizeString($_POST['start_date']);
            $end_date = Utils::sanitizeString($_POST['end_date']);
            $comments = Utils::sanitizeStringBlank($_POST['comments']);
            $id_contacto = Utils::sanitizeNumber($_POST['id_contacto']);
            $flag = $_POST['flag'];

            if ($id_employee && $start_date && $end_date) {
                if ($start_date > $end_date) {
                    $aux = $start_date;
                    $start_date = $end_date;
                    $end_date = $aux;
                }
                $holiday = new EmployeeHolidays();
                $holiday->setId($id);
                $holiday->setId_employee($id_employee);
                $holiday->setStart_date($start_date);
                $holiday->setEnd_date($end_date);
                $holiday->setComments($comments);
                $holiday->setID_Contacto($id_contacto);
                $holiday->setStatus('En revisión');

                if ($flag == 1)
                    $save = $holiday->update();
                else
                    $save = $holiday->create();

                if ($save) {
                    //Ernestesto es del vijeo, ahora el id de cliente lo tiene al inciar sesion si tiene activo el servicio
                    //$employees = $holiday->getEmployeesHolidaysByContacto();
                    //$holidays = $holiday->getEmployeesHolidaysRequestedByContacto();

                    $holiday->setID_Contacto($_SESSION['id_cliente']);
                    $employees = $holiday->getEmployeesHolidaysByCliente();
                    $holidays = $holiday->getEmployeesHolidaysRequestedByCliente();

                    foreach ($employees as &$emplo) {
                        $emplo['start_date'] = Utils::getDate($emplo['start_date']);
                        $emplo['due_date'] = Utils::getDate($emplo['due_date']);
                        $emplo['rest_vacation'] = $emplo['holidays_by_year'] - $emplo['taken_holidays'];
                    }

                    $empleado = new Employees();
                    $empleado->setCliente($_SESSION['id_cliente']);
                    // AQUI verfiicar si es adminisrador

                    $empleado = new Employees();
                    $empleado->setCliente($_SESSION['id_cliente']);
                    $holidays = $empleado->getEmployeesAllHolidaysRequested();

                    foreach ($holidays as &$holiday) {
                        $holiday['start_date'] = Utils::getDate($holiday['start_date']);
                        $holiday['end_date'] = Utils::getDate($holiday['end_date']);
                        $holiday['rest_vacation'] = $holiday['holidays_by_year'] - $holiday['taken_holidays'];
                        $holiday['id'] = Encryption::encode($holiday['id']);
                        $holiday['created_at'] = Utils::getDate($holiday['created_at']);
                    }


                    $data = array(
                        'employees' => $employees,
                        'holidays' => $holidays,
                        'solicitudes' => $holidays,
                        'status' => 1
                    );
                    echo json_encode($data);
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function politicas()
    {
        if (Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $policy = new VacationPolicy();
                $policy->setId(1);
                $policyDefault = $policy->getOne();

                $policy->setEmpresa($Empresa);
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
            } else {
                //$employee = new Employees();
                //$employees = $employee->getAll();
            }

            $page_title = 'Políticas de vacaciones | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/holidays/policy.php';
            require_once 'views/holidays/modal-policy.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function getOnePolicy()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && isset($_POST) && isset($_POST['id'])) {
            $id = Utils::sanitizeNumber(($_POST['id']));
            $policy = new VacationPolicy();
            $policy->setId($id);
            $vacationPolicy = $policy->getOne();
            if ($vacationPolicy) {
                $holiday = new HolidaysByYears();
                $holiday->setId_policy($vacationPolicy->id);
                $holidays = $holiday->getHolidaysByIdPolicy();
                echo json_encode(array('status' => 1, 'policy' => $vacationPolicy, 'holidays' => $holidays));
            } else
                echo json_encode(array('status' => 2));
        } else
            echo json_encode(array('status' => 0));
    }

    public function savePolicy()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && isset($_POST) && isset($_POST['id_policy'])) {
            $id_policy = Utils::sanitizeNumber($_POST['id_policy']);
            $name = Utils::sanitizeStringBlank($_POST['name']);

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $holiday = new HolidaysByYears();
            $holiday->setId_policy($id_policy);

            $policy = new VacationPolicy();
            $policy->setId($id_policy);
            $policy->setName($name);
            $policy->setEmpresa($Empresa);
            $policy->setID_Contacto($id_contacto);
            $policy->setCliente(0);
            $policy->setStatus(1);
            if ($id_policy == 1) {
                $save = $policy->save();
                $id_policy = $policy->getId();
                $holiday->setId_policy($id_policy);
                $holidays = $holiday->getHolidaysByIdPolicy();
            } else {
                $save = $policy->update();
                $holidays = $holiday->getHolidaysByIdPolicy();
            }
            if ($save) {
                $holiday->getHolidaysByIdPolicy();
                foreach ($_POST as $nombre => $valor) {
                    if (strpos($nombre, 'holiday') !== false) {
                        $years = str_replace('holiday', '', $nombre);
                        $holiday->setYears($years);
                        $holiday->setHolidays($valor);
                        if (array_search($years, array_column($holidays, 'years')))
                            $holiday->update();
                        else
                            $holiday->save();
                    }
                }
                echo json_encode(array('status' => 1));
            } else
                json_encode(array('status' => 2));
        } else
            echo json_encode(array('status' => 0));
    }

    public function delete()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            $id = Utils::sanitizeNumber(Encryption::decode($_POST['id']));
            if ($id) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $holidaysObj = new EmployeeHolidays();
                $holidaysObj->setId($id);
                $holidaysObj->delete();

                $holidaysObj->setID_Contacto($_SESSION['id_cliente']);
                $employees = $holidaysObj->getEmployeesHolidaysByCliente();
                $employees =  VacacionesController::Format_employees($employees);


                $employee = new Employees();
                $employee->setCliente($_SESSION['id_cliente']);
                //GABO 18
                $employee_holidays = $employee->getEmployeesAllHolidaysRequested();
                $employee_holidays =  VacacionesController::Format_requests($employee_holidays);


                echo json_encode(array(
                    'employees' => $employees,
                    'solicitudes' => $employee_holidays,
                    'status' => 1
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function save_solicitud_rh()
    {

        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {

            $id_employee =  Utils::sanitizeNumber($_SESSION['identity']->id_empleado);
            $start_date = Utils::sanitizeString($_POST['start_date']);
            $end_date = Utils::sanitizeString($_POST['end_date']);
            $id_contacto = Utils::sanitizeNumber($_SESSION['id_contacto']);

            if ($id_employee && $start_date && $end_date) {
                if ($start_date > $end_date) {
                    $aux = $start_date;
                    $start_date = $end_date;
                    $end_date = $aux;
                }
                $holiday = new EmployeeHolidays();
                $holiday->setId_employee($id_employee);
                $holiday->setStart_date($start_date);
                $holiday->setEnd_date($end_date);
                $holiday->setID_Contacto($id_contacto);
                $holiday->setStatus('En revisión');
                //===[gabo 20 julio movil-responsive]===
                $holiday->setComments('');
                //===[gabo 20 julio movil-responsive fin]===
                $save = $holiday->create();


                //gabo 6 sep
                $start_date = Utils::getShortDate($start_date);
                $end_date = Utils::getShortDate($end_date);

                $holidays = new EmployeeHolidays();
                $holidays->setId_employee($id_employee);
                $holidays = $holidays->getEmployeeHoliday();

                $url = base_url . 'vacaciones/index';

                $subject = 'Solicitud de vacaciones';
                $body = "El empleado {$holidays->first_name} {$holidays->surname} {$holidays->last_name} solicitó  vacaciones del periodo {$start_date} al {$end_date} <br/> <br /> Para aceptar o denegar la solicitud favor de hacer lick en el enlace| <a href={$url}>enlace</a>";

                Utils::sendEmail('nelson.gonzalez@rrhhingenia.com', $holidays->first_name . ' ' . $holidays->surname, $subject, $body);

                $employee = new Employees();
                $employee->setId($holidays->id_boss);
                $empleado = $employee->getOne();

                if ($empleado->email != '' && $empleado->email != NULL) {
                    //   Utils::sendEmail($empleado->email, $holidays->first_name . ' ' . $holidays->surname, $subject, $body);
                }








                if ($save) {
                    $solicitudes = $holiday->getEmployeesHolidaysRequestedByID_User($_SESSION['identity']->id);


                    for ($i = 0; $i < count($solicitudes); $i++) {
                        $solicitudes[$i]['start_date'] = Utils::getFullDate12($solicitudes[$i]['start_date']);
                        $solicitudes[$i]['created_at'] = Utils::getDate($solicitudes[$i]['created_at']);
                        $solicitudes[$i]['end_date'] = Utils::getDate($solicitudes[$i]['end_date']);
                        $solicitudes[$i]['days'] = $solicitudes[$i]['days'] == 1 ? $solicitudes[$i]['days'] . ' Dia' : $solicitudes[$i]['days'] . ' Dias';
                    }

                    $data = array(
                        'solicitudes' => $solicitudes,
                        'status' => 1
                    );
                    echo json_encode($data);
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            header('location:' . base_url);
    }


    public function responder_solicitud_rh()
    {

        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {

            $id_solicitud = (isset($_POST['id_solicitud'])) ? Encryption::decode($_POST['id_solicitud'])  : FALSE;
            $accion = (isset($_POST['accion'])) ? Utils::sanitizeNumber($_POST['accion'])  : FALSE;
            $comments = (isset($_POST['comments'])) ? Utils::sanitizeStringBlank($_POST['comments'])  :  '';


            $holiday = new EmployeeHolidays();
            $holiday->setId($id_solicitud);

            if ($id_solicitud) {

                if ($accion == 1) {  //aceptada

                    $holiday->setStatus('Aceptada');
                    $save = $holiday->approved_vacation();
                } else { //rechazada
                    $holiday->setComments($comments);
                    $holiday->setStatus('Declinada');
                    $save = $holiday->declined_vacation();
                }

                if ($save) {

                    $holiday->setId_employee($_SESSION['identity']->id_empleado);
                    $solicitudes = $holiday->getEmployeesHolidaysRequested();


                    for ($i = 0; $i < count($solicitudes); $i++) {
                        $solicitudes[$i]['id'] =   Encryption::encode($solicitudes[$i]['id']);
                        $solicitudes[$i]['start_date'] = Utils::getFullDate12($solicitudes[$i]['start_date']);
                        $solicitudes[$i]['created_at'] = Utils::getDate($solicitudes[$i]['created_at']);
                        $solicitudes[$i]['end_date'] = Utils::getDate($solicitudes[$i]['end_date']);
                        $solicitudes[$i]['days'] = $solicitudes[$i]['days'] == 1 ? $solicitudes[$i]['days'] . ' Dia' : $solicitudes[$i]['days'] . ' Dias';
                    }

                    $data = array(
                        'solicitudes' => $solicitudes,
                        'status' => 1
                    );
                    echo json_encode($data);
                } else
                    echo json_encode(array('status' => 4));
            } else
                echo json_encode(array('status' => 0));
        } else
            header('location:' . base_url);
    }

    public function responder_solicitud_admin()
    {

        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            $id_solicitud = (isset($_POST['id_solicitud'])) ? Encryption::decode($_POST['id_solicitud'])  : FALSE;
            $accion = (isset($_POST['accion'])) ? Utils::sanitizeNumber($_POST['accion'])  : FALSE;
            $comments = (isset($_POST['comments'])) ? Utils::sanitizeStringBlank($_POST['comments'])  :  '';


            $holiday = new EmployeeHolidays();
            $holiday->setId($id_solicitud);

            $contacto = new ContactosCliente();
            $contacto->setID($_SESSION['identity']->id);
            $contacto = $contacto->getContactoByUsername();


            if ($id_solicitud) {

                if ($accion == 1) {  //aceptada

                    $holiday->setStatus('Aceptada');
                    $holiday->setID_Admin($contacto->ID);
                    $save = $holiday->approved_vacation();
                } else { //rechazada
                    $holiday->setComments($comments);
                    $holiday->setStatus('Declinada');
                    $holiday->setID_Admin($contacto->ID);
                    $save = $holiday->declined_vacation();
                }

                if ($save) {



                    //gabo 20 oct
                    $holidaysObj = new EmployeeHolidays();
                    $holidaysObj->setID_Contacto($_SESSION['id_cliente']);
                    $employees = $holidaysObj->getEmployeesHolidaysByCliente();
                    $employees =  VacacionesController::Format_employees($employees);


                    $employee = new Employees();
                    $employee->setCliente($_SESSION['id_cliente']);
                    //GABO 18
                    $employee_holidays = $employee->getEmployeesAllHolidaysRequested();
                    $employee_holidays =  VacacionesController::Format_requests($employee_holidays);


                    // $holidaysObj = new EmployeeHolidays();
                    // $holidaysObj->setID_Contacto($_SESSION['id_cliente']);
                    // $employees = $holidaysObj->getEmployeesHolidaysByCliente();
                    // foreach ($employees as &$emplo) {
                    //     $emplo['start_date'] = Utils::getDate($emplo['start_date']);
                    //     $emplo['due_date'] = Utils::getDate($emplo['due_date']);
                    //     $emplo['rest_vacation'] = $emplo['holidays_by_year'] - $emplo['taken_holidays'];
                    // }

                    // $empleado = new Employees();
                    // $empleado->setCliente($_SESSION['id_cliente']);
                    // $solicitudes = $empleado->getEmployeesAllHolidaysRequested();

                    // for ($i = 0; $i < count($solicitudes); $i++) {

                    //     $solicitudes[$i]['id'] =   Encryption::encode($solicitudes[$i]['id']);
                    //     $solicitudes[$i]['start_date'] = Utils::getDate($solicitudes[$i]['start_date']);
                    //     $solicitudes[$i]['end_date'] =  Utils::getDate($solicitudes[$i]['end_date']);
                    //     $solicitudes[$i]['created_at'] = Utils::getDate($solicitudes[$i]['created_at']);
                    // }

                    $data = array(
                        'employees' => $employees,
                        'solicitudes' => $employee_holidays,
                        'status' => 1
                    );
                    echo json_encode($data);
                } else
                    echo json_encode(array('status' => 4));
            } else
                echo json_encode(array('status' => 0));
        } else
            header('location:' . base_url);
    }




    //gabo 20 oct
    public function update_holiday()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {


            $id =  isset($_POST['id']) && $_POST['id'] != '' ? Encryption::decode($_POST['id']) : '';
            $start_date =  isset($_POST['start_date']) && $_POST['start_date'] != '' ? Utils::sanitizeString($_POST['start_date']) : '';
            $end_date =  isset($_POST['end_date']) && $_POST['end_date'] != '' ? Utils::sanitizeString($_POST['end_date']) : '';



            if ($id && $start_date && $end_date) {
                if ($start_date > $end_date) {
                    $aux = $start_date;
                    $start_date = $end_date;
                    $end_date = $aux;
                }
                $holiday = new EmployeeHolidays();
                $holiday->setId($id);
                $holiday->setStart_date($start_date);
                $holiday->setEnd_date($end_date);
                $save = $holiday->update_dates();

                if ($save) {

                    //gabo 20 oct
                    $holidaysObj = new EmployeeHolidays();
                    $holidaysObj->setID_Contacto($_SESSION['id_cliente']);
                    $employees = $holidaysObj->getEmployeesHolidaysByCliente();
                    $employees =  VacacionesController::Format_employees($employees);


                    $employee = new Employees();
                    $employee->setCliente($_SESSION['id_cliente']);
                    //GABO 18
                    $employee_holidays = $employee->getEmployeesAllHolidaysRequested();
                    $employee_holidays =  VacacionesController::Format_requests($employee_holidays);




                    $data = array(
                        'employees' => $employees,
                        'solicitudes' => $employee_holidays,
                        'status' => 1
                    );
                    echo json_encode($data);
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 3));
        } else
            echo json_encode(array('status' => 4));
    }
    public function fill_modal_update()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            $id =  isset($_POST['id']) && $_POST['id'] != '' ? Encryption::decode($_POST['id']) : '';

            if ($id) {
                $holiday = new EmployeeHolidays();
                $holiday->setId($id);
                $holiday = $holiday->getOne();
                $holiday->id = Encryption::encode($holiday->id);

                if ($holiday) {

                    echo json_encode(array(
                        'holiday' => $holiday,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        }
    }




    public function Format_requests($solicitudes)
    {
        $work_days = new WorkDays();
        $work_days->setCliente($_SESSION['id_cliente']);
        $work_days = $work_days->getOne();

        $work_days = array(
            'Sun' => $work_days->sunday,
            'Mon' => $work_days->monday,
            'Tue' => $work_days->tuesday,
            'Wed' => $work_days->wednesday,
            'Thu' => $work_days->thursday,
            'Fri' => $work_days->friday,
            'Sat' => $work_days->saturday
        );
        for ($i = 0; $i < count($solicitudes); $i++) {

            $start = new DateTime($solicitudes[$i]['start_date']);
            $end = new DateTime(date("d-m-Y", strtotime($solicitudes[$i]['end_date'] . "+ 1 days")));

            $interval = $start->diff($end);
            $days = $interval->days;

            $period = new DatePeriod($start, new DateInterval('P1D'), $end);
            //  $holidays = array();

            foreach ($period as $dt) {

                $curr = $dt->format('D');
                foreach ($work_days as $dia => $valor) {
                    if ($valor == 0 && $curr == $dia) {
                        $days--;
                    }
                }
            }
            $solicitudes[$i]['requested_days'] = $days;


            $solicitudes[$i]['id'] = Encryption::encode($solicitudes[$i]['id']);
            $solicitudes[$i]['created_at'] = Utils::getDate($solicitudes[$i]['created_at']);
            $solicitudes[$i]['start_date'] = Utils::getDate($solicitudes[$i]['start_date']);
            $solicitudes[$i]['end_date'] = Utils::getDate($solicitudes[$i]['end_date']);
        }
        return $solicitudes;
    }



    public function Format_employees($employees)
    {

        $emplo = new EmployeeHolidays();

        $work_days = new WorkDays();
        $work_days->setCliente($_SESSION['id_cliente']);
        $work_days = $work_days->getOne();

        $work_days = array(
            'Sun' => $work_days->sunday,
            'Mon' => $work_days->monday,
            'Tue' => $work_days->tuesday,
            'Wed' => $work_days->wednesday,
            'Thu' => $work_days->thursday,
            'Fri' => $work_days->friday,
            'Sat' => $work_days->saturday
        );

        foreach ($employees as &$employe) {


            $solicitudes = $emplo->getEmployeesHolidaysRequestedByID_User($employe['usuario_rh']);

            //gabo 18 oct

            $emplo->setId_employee($employe['id']);
            $holidays = $emplo->getEmployeeHoliday();
            $years = $holidays->years;

            $vacation_policy = new VacationPolicy();
            $vacation_policy->setCliente($_SESSION['id_cliente']);
            $vacation_policy->setYears($years);
            $vacation_days = $vacation_policy->getPoliciesById_Cliente();

            if ($vacation_days) {

                $total_days =   $vacation_days->holidays;
                $taken_holidays = 0;

                for ($i = 0; $i < count($solicitudes); $i++) {

                    $start = new DateTime($solicitudes[$i]['start_date']);
                    $end = new DateTime(date("d-m-Y", strtotime($solicitudes[$i]['end_date'] . "+ 1 days")));

                    $interval = $start->diff($end);
                    $days = $interval->days;

                    $period = new DatePeriod($start, new DateInterval('P1D'), $end);
                    $holidays = array();

                    foreach ($period as $dt) {

                        $curr = $dt->format('D');
                        foreach ($work_days as $dia => $valor) {
                            if ($valor == 0 && $curr == $dia) {
                                $days--;
                            }
                        }
                    }


                    if ($solicitudes[$i]['status'] == 'Aceptada') {
                        $total_days = $total_days - $days;
                        $taken_holidays = $taken_holidays + $days;
                    }
                }

                $employe['taken_holidays'] = $taken_holidays;
            } else {

                $employe['taken_holidays'] = 0;
            }

            $employe['start_date'] = Utils::getDate($employe['start_date']);
            $employe['due_date'] = Utils::getDate($employe['due_date']);
        }
        return $employees;
    }
}
