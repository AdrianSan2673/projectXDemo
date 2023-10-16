
<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/RH/Department.php';
require_once 'models/RH/EffectivenessIndicatiors.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/InterpersonalSkills.php';
require_once 'models/RH/Positions.php';
require_once 'models/RH/PositionsToAspire.php';
require_once 'models/RH/RequiredKnowledge.php';
require_once 'models/RH/SpecificResponsabilities.php';
require_once 'models/RH/SupervisingPositions.php';
require_once 'models/RH/EmployeeContact.php';
require_once 'models/RH/EmployeePayroll.php';
require_once 'models/RH/EmployeeIncidence.php';


class IncidenciasController
{

    public function index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

                $employeeObj = new Employees();
                $employeeObj->setID_Contacto($ID_Contacto);
                $employeeObj->setStatus(1);
                $incidens = $employeeObj->getAllEmployeesIncidenceByIDcontacto();
                $employees = $employeeObj->getAllEmployeesByIDcontacto();
            }

            $page_title = 'Incidencias | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/incidence/modal-create.php';
            require_once 'views/incidence/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }


    public function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (isset($_POST['created_at']) && isset($_POST['end_date'])) {
                if ($_POST['created_at'] > $_POST['end_date']) {
                    $aux = $_POST['created_at'];
                    $_POST['created_at'] = $_POST['end_date'];
                    $_POST['end_date'] = $aux;
                }
            }

            $id_employee = Encryption::decode($_POST['id_employee']);
            $created_at = isset($_POST['created_at']) ? Utils::sanitizeString($_POST['created_at']) : null;
            $end_date = isset($_POST['end_date']) ? Utils::sanitizeString($_POST['end_date']) : null;
            $type = Utils::sanitizeString($_POST['type']);

            $hours = isset($_POST['hours']) && ($type == 'Retraso' || $type == 'Horas extras') ? utils::sanitizeStringBlank($_POST['hours']) : null;
            $type_of_foul = isset($_POST['type_of_foul']) && $type == 'Faltas' ? utils::sanitizeStringBlank($_POST['type_of_foul']) : null;
            $type_of_incapacity = isset($_POST['type_of_incapacity']) && $type == 'Incapacidades' ? utils::sanitizeStringBlank($_POST['type_of_incapacity']) : null;
            $amount = isset($_POST['amount']) && $type == 'Bonos' ? utils::sanitizeStringBlank($_POST['amount']) : null;
            $permission = isset($_POST['permission']) && $type == 'Permiso' ? utils::sanitizeStringBlank($_POST['permission']) : null;
            $comments = isset($_POST['comments']) ? utils::sanitizeStringBlank($_POST['comments']) : null;

            if ($id_employee && $created_at && $type && $end_date && ($hours || $type_of_foul || $type_of_incapacity || $amount || $permission)) {
                $employeeIncidenceObj = new EmployeeIncidence();
                $employeeIncidenceObj->setId_employee($id_employee);
                $employeeIncidenceObj->setCreated_at($created_at);
                $employeeIncidenceObj->settype($type);
                $employeeIncidenceObj->setHours($hours);
                $employeeIncidenceObj->setType_of_foul($type_of_foul);
                $employeeIncidenceObj->setType_of_incapacity($type_of_incapacity);
                $employeeIncidenceObj->setAmount($amount);
                $employeeIncidenceObj->setPermission($permission);
                $employeeIncidenceObj->setComments($comments);
                $employeeIncidenceObj->setEnd_date($end_date);
                $employeeIncidenceObj->save();
                $employeeIncidence = $employeeIncidenceObj->getAllByIdEmployee();

                for ($i = 0; $i < count($employeeIncidence); $i++) {

                    for ($i = 0; $i < count($employeeIncidence); $i++) {
                        $employeeIncidence[$i]['id'] = Encryption::encode($employeeIncidence[$i]['id']);
                        $employeeIncidence[$i]['created_at'] = Utils::getDate($employeeIncidence[$i]['created_at']);
                        $employeeIncidence[$i]['end_date'] = Utils::getDate($employeeIncidence[$i]['end_date']);
                        $employeeIncidence[$i]['modified_at'] = Utils::getFullDate($employeeIncidence[$i]['modified_at']);

                        if ($employeeIncidence[$i]['type'] == 'Retraso' || $employeeIncidence[$i]['type'] == 'Horas extras') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['hours'] . ' hrs';
                        } else if ($employeeIncidence[$i]['type'] == 'Faltas') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['type_of_foul'];
                        } else if ($employeeIncidence[$i]['type'] == 'Incapacidades') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['type_of_incapacity'];
                        } else if ($employeeIncidence[$i]['type'] == 'Bonos') {
                            $employeeIncidence[$i]['type_incident'] = '$' . number_format($employeeIncidence[$i]['amount'], 2);
                        } else if ($employeeIncidence[$i]['type'] == 'Permiso') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['permission'];
                        }
                    }
                }

                echo json_encode(array(
                    'status' => 1,
                    'employeeIncidence' => $employeeIncidence
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function save_index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
          
            if (isset($_POST['created_at']) && isset($_POST['end_date'])) {
                if ($_POST['created_at'] > $_POST['end_date']) {
                    $aux = $_POST['created_at'];
                    $_POST['created_at'] = $_POST['end_date'];
                    $_POST['end_date'] = $aux;
                }
            }
            $arrayEmployees = $_POST['id_employees'];
            $created_at = isset($_POST['created_at']) ? Utils::sanitizeString($_POST['created_at']) : null;
            $end_date = isset($_POST['end_date']) ? Utils::sanitizeString($_POST['end_date']) : null;
            $type = Utils::sanitizeString($_POST['type']);

            $hours = isset($_POST['hours']) && ($type == 'Retraso' || $type == 'Horas extras') ? utils::sanitizeStringBlank($_POST['hours']) : null;
            $type_of_foul = isset($_POST['type_of_foul']) && $type == 'Faltas' ? utils::sanitizeStringBlank($_POST['type_of_foul']) : null;
            $type_of_incapacity = isset($_POST['type_of_incapacity']) && $type == 'Incapacidades' ? utils::sanitizeStringBlank($_POST['type_of_incapacity']) : null;
            $amount = isset($_POST['amount']) && $type == 'Bonos' ? utils::sanitizeStringBlank($_POST['amount']) : null;
            $permission = isset($_POST['permission']) && $type == 'Permiso' ? utils::sanitizeStringBlank($_POST['permission']) : null;
            $comments = isset($_POST['comments']) ? utils::sanitizeStringBlank($_POST['comments']) : null;
            if (isset($arrayEmployees) && $created_at && $type && ($hours || $type_of_foul || $type_of_incapacity || $amount || $permission)) {

                $employeeIncidenceObj = new EmployeeIncidence();
                $employeeIncidenceObj->setCreated_at($created_at);
                $employeeIncidenceObj->settype($type);
                $employeeIncidenceObj->setHours($hours);
                $employeeIncidenceObj->setType_of_foul($type_of_foul);
                $employeeIncidenceObj->setType_of_incapacity($type_of_incapacity);
                $employeeIncidenceObj->setAmount($amount);
                $employeeIncidenceObj->setPermission($permission);
                $employeeIncidenceObj->setComments($comments);
                $employeeIncidenceObj->setEnd_date($end_date);

                for ($i = 0; $i < count($arrayEmployees); $i++) {
                    $id_employee = Encryption::decode($arrayEmployees[$i]);
                    $employeeIncidenceObj->setId_employee($id_employee);
                    $employeeIncidenceObj->save();
                }

                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $employeeObj = new Employees();
                $employeeObj->setID_Contacto($ID_Contacto);
                $employeeObj->setStatus(1);

                $employeeIncidence = $employeeObj->getAllEmployeesIncidenceByIDcontacto();

                for ($i = 0; $i < count($employeeIncidence); $i++) {
                    $employeeIncidence[$i]['id_employe'] = base_url . 'empleado/ver&id=' . Encryption::encode($employeeIncidence[$i]['id_employe']);
                    $employeeIncidence[$i]['id_incident'] = Encryption::encode($employeeIncidence[$i]['id_incident']);
                    $employeeIncidence[$i]['created_at'] = Utils::getDate($employeeIncidence[$i]['created_at']);
                    $employeeIncidence[$i]['end_date'] = Utils::getDate($employeeIncidence[$i]['end_date']);
                    $employeeIncidence[$i]['modified_at'] = Utils::getFullDate($employeeIncidence[$i]['modified_at']);

                    if ($employeeIncidence[$i]['type'] == 'Retraso' || $employeeIncidence[$i]['type'] == 'Horas extras') {
                        $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['hours'] . ' hrs';
                    } else if ($employeeIncidence[$i]['type'] == 'Faltas') {
                        $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['type_of_foul'];
                    } else if ($employeeIncidence[$i]['type'] == 'Incapacidades') {
                        $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['type_of_incapacity'];
                    } else if ($employeeIncidence[$i]['type'] == 'Bonos') {
                        $employeeIncidence[$i]['type_incident'] = '$' . number_format($employeeIncidence[$i]['amount'], 2);
                    } else if ($employeeIncidence[$i]['type'] == 'Permiso') {
                        $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['permission'];
                    }
                }

                echo json_encode(array(
                    'status' => 1,
                    'employeeIncidence' => $employeeIncidence
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function getOne()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $employeeIncidenceObj = new EmployeeIncidence();
                $employeeIncidenceObj->setId($id);
                $incidentes = $employeeIncidenceObj->getOneById();

                echo json_encode(array(
                    'status' => 1,
                    'type' => $incidentes->type,
                    'employee' => $incidentes->id_employe,
                    'comments' => $incidentes->comments
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }




    public function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

            $employeeObj = new Employees();
            $employeeObj->setID_Contacto($ID_Contacto);
            $employeeObj->setStatus(1);

            $id = Encryption::decode($_POST['id']);
            $flag = $_POST['flag'];

            if ($id) {
                $employeeIncidenceObj = new EmployeeIncidence();
                $employeeIncidenceObj->setId($id);
                if ($flag == 1) {
                    $employeeIncidenceObj->delete();
                    $employeeIncidence = $employeeObj->getAllEmployeesIncidenceByIDcontacto();

                    for ($i = 0; $i < count($employeeIncidence); $i++) {
                        $employeeIncidence[$i]['id_employe'] = base_url . 'empleado/ver&id=' . Encryption::encode($employeeIncidence[$i]['id_employe']);
                        $employeeIncidence[$i]['id_incident'] = Encryption::encode($employeeIncidence[$i]['id_incident']);
                        $employeeIncidence[$i]['created_at'] = Utils::getDate($employeeIncidence[$i]['created_at']);
                        $employeeIncidence[$i]['end_date'] = Utils::getDate($employeeIncidence[$i]['end_date']);
                        $employeeIncidence[$i]['modified_at'] = Utils::getFullDate($employeeIncidence[$i]['modified_at']);

                        if ($employeeIncidence[$i]['type'] == 'Retraso' || $employeeIncidence[$i]['type'] == 'Horas extras') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['hours'] . ' hrs';
                        } else if ($employeeIncidence[$i]['type'] == 'Faltas') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['type_of_foul'];
                        } else if ($employeeIncidence[$i]['type'] == 'Incapacidades') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['type_of_incapacity'];
                        } else if ($employeeIncidence[$i]['type'] == 'Bonos') {
                            $employeeIncidence[$i]['type_incident'] = '$' . number_format($employeeIncidence[$i]['amount'], 2);
                        }
                    }

                    echo json_encode(array(
                        'status' => 1,
                        'employeeIncidence' => $employeeIncidence,
                        'flag' => 2,
                    ));
                } elseif ($flag == 2) {
                    $incidentes = $employeeIncidenceObj->getOne();
                    $employeeObj->setId($incidentes->id_employee);
                    $employeeIncidenceObj->delete();

                    $employeeIncidenceObj->setId_employee($incidentes->id_employee);
                    $employeeIncidence = $employeeIncidenceObj->getAllByIdEmployee();

                    for ($i = 0; $i < count($employeeIncidence); $i++) {
                        $employeeIncidence[$i]['id'] = Encryption::encode($employeeIncidence[$i]['id']);
                        $employeeIncidence[$i]['created_at'] = Utils::getDate($employeeIncidence[$i]['created_at']);
                        $employeeIncidence[$i]['end_date'] = Utils::getDate($employeeIncidence[$i]['end_date']);
                        $employeeIncidence[$i]['modified_at'] = Utils::getFullDate($employeeIncidence[$i]['modified_at']);

                        if ($employeeIncidence[$i]['type'] == 'Retraso' || $employeeIncidence[$i]['type'] == 'Horas extras') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['hours'] . ' hrs';
                        } else if ($employeeIncidence[$i]['type'] == 'Faltas') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['type_of_foul'];
                        } else if ($employeeIncidence[$i]['type'] == 'Incapacidades') {
                            $employeeIncidence[$i]['type_incident'] = $employeeIncidence[$i]['type_of_incapacity'];
                        } else if ($employeeIncidence[$i]['type'] == 'Bonos') {
                            $employeeIncidence[$i]['type_incident'] = '$' . number_format($employeeIncidence[$i]['amount'], 2);
                        }
                    }

                    echo json_encode(array(
                        'status' => 1,
                        'employeeIncidence' => $employeeIncidence
                    ));
                }
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
