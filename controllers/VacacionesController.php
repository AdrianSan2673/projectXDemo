<?php

require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/RH/EmployeeHolidays.php';

class VacacionesController{

    public function index(){
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $employee = new EmployeeHolidays();
                $employee->setID_Contacto($id_contacto);
                $employees = $employee->getEmployeesHolidaysByContacto();
                $holidays = $employee->getEmployeesHolidaysRequestedByContacto();

            } else {
                //$employee = new Employees();
                //$employees = $employee->getAll();
            }

            $page_title = 'Empleados | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/holidays/index.php';
            require_once 'views/holidays/modal-create.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function save(){
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

                if ($flag == 1)
                    $save = $holiday->update();
                else
                    $save = $holiday->create();

                if ($save) {
                    $employees = $holiday->getEmployeesHolidaysByContacto();
                    $holidays = $holiday->getEmployeesHolidaysRequestedByContacto();
                    $data = array(
                        'employees' => $employees,
                        'holidays' => $holidays,
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