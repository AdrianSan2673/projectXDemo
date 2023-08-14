<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/Positions.php';
require_once 'models/RH/Trainings.php';
require_once 'models/RH/Employee_trainings.php';


class CapacitacionesController
{
    public function index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $employee = new Employees();
                $employee->setCliente($_SESSION['id_cliente']);
                $employee->setStatus(1);
                $employees = $employee->getAllEmployeesByCliente();

                $trainingsObj = new Trainings();
                $trainingsObj->setCliente($_SESSION['id_cliente']);
                $trainingsObj->setID_Contacto($id_contacto);
                $trainingsObj->setStatus(1);
                $trainings = $trainingsObj->getAllByIdCliente();
            } else {
                $employee = new Employees();
                $employees = $employee->getAll();
            }

            $page_title = 'Capacitaciones | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/trainings/index.php';
            require_once 'views/trainings/modal-creat-trainig.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $title = Utils::sanitizeStringBlank($_POST['title']);
            $description = isset($_POST['description']) ? Utils::sanitizeString($_POST['description']) : '';
            $hours = isset($_POST['hours']) ? Utils::sanitizeNumber($_POST['hours']) : null;
            $start_date = Utils::sanitizeString($_POST['start_date']);
            $end_date = isset($_POST['end_date'])? Utils::sanitizeString($_POST['end_date']):null;
            $clave_area_tematica = isset($_POST['clave_area_tematica']) ? Utils::sanitizeStringBlank($_POST['clave_area_tematica']) : null;
            $training_agent = Utils::sanitizeStringBlank($_POST['training_agent']);
            $instructor = Utils::sanitizeStringBlank($_POST['instructor']);

            $cliente = $_SESSION['id_cliente'];
            $employeesArray = $_POST['employees'];
            $flag = $_POST['flag'];
            $id_training = Encryption::decode($_POST['id']);

            if ($title && $hours && $cliente && $start_date && $end_date && $employeesArray && $flag) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

                //FALTA IF DE QUE LA FECHA INICIO SEA MENOR QUE LA FECHA FINAL
                if ($start_date <= $end_date) {

                    $trainingsObj = new Trainings();
                    $trainingsObj->setTitle($title);
                    $trainingsObj->setDescription($description);
                    $trainingsObj->setStart_date($start_date);
                    $trainingsObj->setEnd_date($end_date);
                    $trainingsObj->setHours($hours);
                    $trainingsObj->setCliente($cliente);
                    $trainingsObj->setID_Contacto($id_contacto);
                    $trainingsObj->setClave_area_tematica($clave_area_tematica);
                    $trainingsObj->setTraining_agent($training_agent);
                    $trainingsObj->setInstructor($instructor);

                    if ($flag == 1) {
                        $flagTraining = $trainingsObj->save();
                        if ($flagTraining == true) {
                            $id_training = $trainingsObj->getId();
                            foreach ($employeesArray as $emp) {
                                $employee_trainingsObj = new Employee_trainings();
                                $employee_trainingsObj->setId_training($id_training);
                                $employee_trainingsObj->setId_employee($emp);
                                $employee_trainingsObj->save();
                            }
                        }
                    } elseif ($flag == 2) {
                        $trainingsObj->setId($id_training);
                        $flagTraining = $trainingsObj->update();
                        if ($flagTraining == true) {
                            $employee_trainingsObj = new Employee_trainings();
                            $employee_trainingsObj->setId_training($id_training);
                            $employee_trainingsObj->deleteByIdTraing();

                            foreach ($employeesArray as $emp) {
                                $employee_trainingsObj = new Employee_trainings();
                                $employee_trainingsObj->setId_training($id_training);
                                $employee_trainingsObj->setId_employee($emp);
                                $employee_trainingsObj->save();
                            }
                        }
                    } else {
                        echo json_encode(array('status' => 3));
                        die();
                    }

                    $trainingsObj->setCliente($_SESSION['id_cliente']);
                    $trainingsObj->setStatus(1);
                    $trainings = $trainingsObj->getAllByIdCliente();
                    for ($i = 0; $i < count($trainings); $i++) {
                        $trainings[$i]['start_date'] = Utils::getDate($trainings[$i]['start_date']);
                        $trainings[$i]['end_date'] = Utils::getDate($trainings[$i]['end_date']);
                        $trainings[$i]['modified_at'] = Utils::getFullDate($trainings[$i]['modified_at']);
                        $trainings[$i]['id'] = Encryption::encode($trainings[$i]['id']);
                        $trainings[$i]['clave_area_tematica'] = Utils::showAreasTematicas($trainings[$i]['clave_area_tematica']);
                        $trainings[$i]['description'] = isset($trainings[$i]['description']) && $trainings[$i]['description'] != null ? $trainings[$i]['description'] : '';
                        $trainings[$i]['url'] = base_url.'capacitaciones/ver&id='. $trainings[$i]['id'];
                    }
                    echo json_encode(array('status' => 1, 'trainings' => $trainings));
                } else
                    echo json_encode(array('status' => 3));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function ver()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
                $id = Encryption::decode($_GET['id']);
                $trainingsObj = new Trainings();
                $trainingsObj->setId($id);
                $training = $trainingsObj->getOne();

                $employee_trainingsObj = new Employee_trainings();
                $employee_trainingsObj->setId_training($id);
                $employee_trainings = $employee_trainingsObj->getAllByidTraing();

                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $page_title = $training->title . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/trainings/read.php';
                require_once 'views/layout/footer.php';
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function getOne()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

            $employee = new Employees();
            $employee->setCliente($_SESSION['id_cliente']);
            $employee->setStatus(1);
            $employees = $employee->getAllEmployeesByCliente();

            $id = Encryption::decode($_POST['id']);
            $trainingsObj = new Trainings();
            $trainingsObj->setId($id);
            $trainings = $trainingsObj->getOne();

            $trainings->id = Encryption::encode($trainings->id);
            $trainings->start_date =  date("Y-m-d", strtotime($trainings->start_date));
            $trainings->end_date =  date("Y-m-d", strtotime($trainings->end_date));

            $employee_trainingsObj = new Employee_trainings();
            $employee_trainingsObj->setId_training($id);
            $employee_trainings = $employee_trainingsObj->getAllByidTraing();
            $areaTematica = Utils::getCatalogoAreasTematicas();

            echo json_encode(array(
                'status' => 1,
                'trainings' => $trainings,
                'employee_trainings' => $employee_trainings,
                'employees' => $employees,
                'areaTematica' => $areaTematica
            ));
        } else
            echo json_encode(array('status' => 2));
    }

    public function deleteTraing()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_traing = Encryption::decode($_POST['id']);

            if ($id_traing) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

                $trainingObj = new Trainings();
                $trainingObj->setId($id_traing);
                $trainingObj->setStatus(0);
                $trainingObj->updateDelete();

                $trainingObj->setCliente($_SESSION['id_cliente']);
                $trainingObj->setStatus(1);
                $trainings = $trainingObj->getAllByIdCliente();


                for ($i = 0; $i < count($trainings); $i++) {
                    $trainings[$i]['start_date'] = Utils::getDate($trainings[$i]['start_date']);
                    $trainings[$i]['end_date'] = Utils::getDate($trainings[$i]['end_date']);
                    $trainings[$i]['modified_at'] = Utils::getFullDate($trainings[$i]['modified_at']);
                    $trainings[$i]['id'] = Encryption::encode($trainings[$i]['id']);
                    $trainings[$i]['clave_area_tematica'] = Utils::showAreasTematicas($trainings[$i]['clave_area_tematica']);
                    $trainings[$i]['description'] = isset($trainings[$i]['description']) && $trainings[$i]['description'] != null ? $trainings[$i]['description'] : '';
                    $trainings[$i]['url'] = base_url.'capacitaciones/ver&id='. $trainings[$i]['id'];
                }

                echo json_encode(array(
                    'status' => 1,
                    'trainings' => $trainings
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 2));
    }

    public function deleteTrainingEmployee()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $arryaPOST = explode(",", $_POST['id']);
            $id = Encryption::decode($arryaPOST[0]);
            $id_empployee = Encryption::decode($arryaPOST[1]);

            $trainingEmployeeObj = new Employee_trainings();
            $trainingEmployeeObj->setId($id);
            $trainingEmployeeObj->delete();

            $trainingEmployeeObj->setId_employee($id_empployee);
            $trainings = $trainingEmployeeObj->getAllByIdEmployee();

            for ($i = 0; $i < count($trainings); $i++) {
                $trainings[$i]['start_date'] = Utils::getDate($trainings[$i]['start_date']);
                $trainings[$i]['end_date'] = Utils::getDate($trainings[$i]['end_date']);
                $trainings[$i]['modified_at'] = Utils::getFullDate($trainings[$i]['modified_at']);
                $trainings[$i]['id'] = Encryption::encode($trainings[$i]['id']);
            }

            echo json_encode(array(
                'status' => 1,
                'trainings' => $trainings
            ));
        } else
            echo json_encode(array('status' => 2));
    }
}
