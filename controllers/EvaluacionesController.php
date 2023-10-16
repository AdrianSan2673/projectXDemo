<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/Evaluations.php';
require_once 'models/RH/Department.php';
require_once 'models/RH/EvaluationCategory.php';
require_once 'models/RH/Positions.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/EvaluationEmployee.php';
require_once 'models/RH/OpenQuestions.php';
//  ===[gabo 12 mayo evaluaciones]===
require_once 'models/RH/GroupEvaluation.php';
//  ===[gabo 12 mayo evaluaciones fin]===


class EvaluacionesController
{

    public function index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $page_title = 'Evlauaciones | RRHH Ingenia';
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $evaluationsObj = new Evaluations();
            $evaluationsObj->setID_Empresa($Empresa);
            $evaluationsObj->setStatus(1);
            $evaluationsIndex = $evaluationsObj->getAll();

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/evaluations/index.php';
            require_once 'views/evaluations/modal-create.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }

    public function ver()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA() && $_GET['id']) {
            $id = Encryption::decode($_GET['id']);
            $evaluationsObj = new Evaluations();
            $evaluationsObj->setId($id);
            $evaluation = $evaluationsObj->getOne();

            $evaluationCategoryObj = new EvaluationCategory();
            $evaluationCategoryObj->setId_evaluation($id);
            $evaluationCategoryObj->setStatus(1);
            $evaluationCategory = $evaluationCategoryObj->getAllByIdEvaluation();

            $openQuestionsObj = new OpenQuestions();
            $openQuestionsObj->setId_evaluation($id);
            $openQuestionsObj->setStatus(1);
            $openQuestionsAll = $openQuestionsObj->getAllByIdEvalaution();
            $openQuestionsObj->setStatus(2);
            $openQuestionsFeedback = $openQuestionsObj->getQuestionsByIdEvaluationAndStatus();

            $page_title = 'Evaluacion | RRHH Ingenia';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/evaluations/modal-category.php';
            require_once 'views/evaluations/modal-categoryCriterion.php';
            require_once 'views/evaluations/modal-question.php';
            require_once 'views/evaluations/modal-openQuestion.php';
            require_once 'views/evaluations/modal-criterionScore.php';
            require_once 'views/evaluations/read.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }


    public function enviar()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $page_title = 'Evaluacion | RRHH Ingenia';

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $employeeObj = new Employees();
            $employeeObj->setID_Contacto($id_contacto);
            $employeeObj->setStatus(1);
            $employees = $employeeObj->getAllEmployeesByIDcontacto();

            $evaluationsObj = new Evaluations();
            $evaluationsObj->setID_Empresa($Empresa);
            $evaluationsObj->setStatus(1);
            $evaluationsAll = $evaluationsObj->getAll();


            $evaluationEmployeeObj = new EvaluationEmployee();
            $evaluationEmployeeObj->setID_Contacto($id_contacto);
            $evaluations_employees = $evaluationEmployeeObj->getEvaluationByIdBoss();
            $evaluations_employees_index = $evaluationEmployeeObj->getAllEvaluationEmployeeBIdBoss();


            $positionObj2 = new Positions();
            $positionObj2->setID_Contacto($id_contacto);
            $positionObj2->setStatus(1);
            $positionObj2->setType_position(5);
            $type_positions = $positionObj2->getAllPositionByTypePosition();

            $deparment = new Department();
            $deparment->setEmpresa($Empresa);
            $deparment = $deparment->getDepartmentsByEmpresa();

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/evaluations/modal-sendEvaluation.php';
            require_once 'views/evaluations/sendEvalaution.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }


    // ===[gabo 15 mayo evaluaciones fin]===


    public function enviar_grupo()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $page_title = 'Evaluacion | RRHH Ingenia';

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $employeeObj = new Employees();
            $employeeObj->setID_Contacto($id_contacto);
            $employeeObj->setStatus(1);
            $employees = $employeeObj->getAllEmployeesByIDcontacto();

            $evaluationsObj = new Evaluations();
            $evaluationsObj->setID_Empresa($Empresa);
            $evaluationsObj->setStatus(1);
            $evaluationsAll = $evaluationsObj->getAll();


            $evaluationEmployeeObj = new EvaluationEmployee();
            $evaluationEmployeeObj->setID_Contacto($id_contacto);
            $evaluations_employees = $evaluationEmployeeObj->getEvaluationByIdBoss();
            $groups_evaluation = new GroupEvaluation;
         
            $groups_evaluation->setId_contact($id_contacto);
            $groups = $groups_evaluation->getAllGroupsEvaluationBIdBoss();

            $positionObj2 = new Positions();
            $positionObj2->setID_Contacto($id_contacto);
            $positionObj2->setStatus(1);
            $positionObj2->setType_position(5);
            $type_positions = $positionObj2->getAllPositionByTypePosition();

            $deparment = new Department();
            $deparment->setEmpresa($Empresa);
            $deparment = $deparment->getDepartmentsByEmpresa();

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/evaluations/modal-sendEvaluation.php';
            require_once 'views/evaluations2/sendEvalaution.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }

    // ===[gabo 15 mayo evaluaciones fin]===
    public function creat()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {

                $id = Encryption::decode($_POST['id']);
                $name = isset($_POST['name']) ? Utils::sanitizeStringBlank($_POST['name']) : null;
                $level = isset($_POST['level']) ? Utils::sanitizeNumber($_POST['level']) : null;
                $flag = $_POST['flag'];

                if ($flag && $name && $level && Utils::isValid($_SESSION['identity'])) {

                    $contactoEmpresa = new ContactosEmpresa();
                    $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                    $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                    $evaluationsObj = new Evaluations();
                    $evaluationsObj->setId($id);
                    $evaluationsObj->setName($name);
                    $evaluationsObj->setLevel($level);
                    $evaluationsObj->setStatus(1);
                    $evaluationsObj->setID_Empresa($Empresa);
                    $evaluationsObj->setCreated_by($_SESSION['identity']->id);

                    if ($flag == 1) {
                        $save = $evaluationsObj->save();
                        $id = $evaluationsObj->getId();
                        echo json_encode(array('status' => 1, 'url' => base_url . 'evaluaciones/ver&id=' . Encryption::encode($id)));
                    } else if ($flag == 2) {
                        $save = $evaluationsObj->update();
                        $evaluationsIndex = $evaluationsObj->getAll();

                        for ($i = 0; $i < count($evaluationsIndex); $i++) {
                            $evaluationsIndex[$i]['modified_at'] = substr(Utils::getDate($evaluationsIndex[$i]['modified_at']), 5);
                            $evaluationsIndex[$i]['id'] = Encryption::encode($evaluationsIndex[$i]['id']);
                            $evaluationsIndex[$i]['url'] = base_url . 'evaluaciones/ver&id=' . $evaluationsIndex[$i]['id'];
                        }

                        echo json_encode(array('status' => 2, 'evaluations' => $evaluationsIndex));
                    } else
                        echo json_encode(array('status' => 0));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $evaluationsObj = new Evaluations();
                $evaluationsObj->setId($id);
                $evaluationsObj->setStatus(1);
                $evaluationsObj->setID_Empresa($Empresa);
                $evaluationsObj->setCreated_by($_SESSION['identity']->id);

                $flag = $evaluationsObj->delete();

                if ($flag) {
                    $evaluationsIndex = $evaluationsObj->getAll();

                    for ($i = 0; $i < count($evaluationsIndex); $i++) {
                        $evaluationsIndex[$i]['modified_at'] = substr(Utils::getDate($evaluationsIndex[$i]['modified_at']), 5);
                        $evaluationsIndex[$i]['id'] = Encryption::encode($evaluationsIndex[$i]['id']);
                    }

                    echo json_encode(array('status' => 1, 'evaluations' => $evaluationsIndex));
                } else
                    echo json_encode(array('status' => 0));
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
                $evaluationsObj = new Evaluations();
                $evaluationsObj->setId($id);
                $evaluations = $evaluationsObj->getOne();

                $evaluations->id = Encryption::encode($evaluations->id);

                echo json_encode(array(
                    'status' => 1,
                    'evaluations' => $evaluations
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function saveEalaucionEmpleado()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                if ($_POST['start_date'] > $_POST['end_date']) {
                    $aux = $_POST['start_date'];
                    $_POST['start_date'] = $_POST['end_date'];
                    $_POST['end_date'] = $aux;
                }
            }

            $id_evaluation = isset($_POST['id_evaluation']) ? Encryption::decode($_POST['id_evaluation']) : null;
            $id_boss = isset($_POST['id_boss']) ? Encryption::decode($_POST['id_boss']) : null;
            $email = $_POST['email_boss'] != '' ? Utils::sanitizeEmail($_POST['email_boss']) : Utils::sanitizeEmail($_POST['email_input']);
            $start_date = isset($_POST['start_date']) ? Utils::sanitizeString($_POST['start_date']) : null;
            $end_date = isset($_POST['end_date']) ? Utils::sanitizeString($_POST['end_date']) : null;
            $cuerpo_email = $_POST['cuerpo_email'];
            $employees = count($_POST['employees']) > 0 ? $_POST['employees'] : null;

            if ($id_boss && $id_evaluation && $email && $cuerpo_email && $start_date && $end_date && $employees) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

                $tr = '';

                for ($i = 0; $i < count($employees); $i++) {
                    $employeeObj = new Employees();
                    $employeeObj->setId($employees[$i]);
                    $employee = $employeeObj->getOne();

                    $id_employee = $employee->id;
                    $id_position = $employee->id_position;
                    $nameEmployee = $employee->first_name . ' ' . $employee->last_name . ' ' . $employee->surname;

                    $positionObj = new Positions();
                    $positionObj->setId($id_position);
                    $title_position = $positionObj->getOne()->title;
                    $deparment = $positionObj->getOne()->department;

                    $evaluationEmployeeObj = new EvaluationEmployee;
                    $evaluationEmployeeObj->setId_evaluation($id_evaluation);
                    $evaluationEmployeeObj->setId_employee($id_employee);
                    $evaluationEmployeeObj->setId_position($id_position);
                    $evaluationEmployeeObj->setId_boss($id_boss);
                    $evaluationEmployeeObj->setStart_date($start_date);
                    $evaluationEmployeeObj->setEnd_date($end_date);
                    $evaluationEmployeeObj->setStatus(1);
                    $evaluationEmployeeObj->setDate_of_realization(null);
                    $evaluationEmployeeObj->setID_Contacto($id_contacto);
                    $save = $evaluationEmployeeObj->save();

                    $id_evaluationemployee = $evaluationEmployeeObj->getId();

                    if ($save) {
                        $tr .= " 
                    <tr>
                        <td>{$nameEmployee}</td>
                        <td>{$title_position}</td>
                        <td>{$deparment}</td>
                        <td> <a href=" . base_url . 'evaluacionempleado/ver&id=' . Encryption::encode($id_evaluationemployee) . " class='boton-personalizado-4'><span>Ver</span></a></td>
                    </tr>";
                    }
                }

                //name
                $employeeObjBoss = new Employees();
                $employeeObjBoss->setId($id_boss);
                $employeeBoss = $employeeObjBoss->getOne();
                $name = $employeeBoss->first_name . ' ' . $employeeBoss->surname . ' ' . $employeeBoss->last_name;

                //subject
                $evaluationObj = new Evaluations();
                $evaluationObj->setId($id_evaluation);
                $evaluationName = $evaluationObj->getOne()->name;
                $subject = $evaluationName;

                //body
                $body = $cuerpo_email . "
                <!DOCTYPE html>
                        <html>

                        <head>
                            <style>
                                table {
                                    font-family: arial, sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                }
                            
                                td,
                                th {
                                    border: 1px solid #dddddd;
                                    text-align: left;
                                    padding: 8px;
                                }
                            
                                tr:nth-child(even) {
                                    background-color: #dddddd;
                                }
                             
                                .boton-personalizado-4 {
                                    margin: 1em;
                                    text-decoration:none;
                                    font-weight: 600;
                                    font-size: 16px;
                                    color:#FFF;
                                    padding-top:8px;
                                    padding-bottom:8px;
                                    padding-left:25px;
                                    padding-right:25px;
                                    background-color:#28a745;
                                    border-color: #d8d8d8;
                                    border-width: 3px;
                                    border-style: solid;
                                    border-radius:8px;
                                    }
                            </style>
                        </head>
                            
                        <body>
                            
                            <h2>Tabla de evaluacion </h2>
                            
                            <table>
                                <tr>
                                    <th>Nombre de empleado</th>
                                    <th>Puesto</th>
                                    <th>Departamento</th>
                                    <th>Ver evaluacion</th>
                                </tr>
                                   {$tr}
                            </table>
                            

                            <tfoot>
                              <tr>
                                Se puede ver toda la evalaucion dando click<a href=" . base_url . '/evaluacionempleado/index&id_boss=' . Encryption::encode($id_boss) . '&start_date=' . Encryption::encode($start_date) . '&end_date=' . Encryption::encode($end_date) . " ><span>aqui</span></a>.
                              </tr>
                            </tfoot>
                        </body>
                            
                        </html>";

                Utils::sendEmail($email, $name, $subject, $body);
                echo json_encode(array('status' => 1));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    // ===[gabo 15 mayo evaluaciones]===

    public function saveEalaucionEmpleado2()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {


            $id_evaluation = isset($_POST['id_evaluation']) ? Encryption::decode($_POST['id_evaluation']) : null;
            $id_boss = isset($_POST['id_boss']) ? Encryption::decode($_POST['id_boss']) : null;
            $email = $_POST['email_boss'] != '' ? Utils::sanitizeEmail($_POST['email_boss']) : Utils::sanitizeEmail($_POST['email_input']);
            $start_date = isset($_POST['start_date']) ? Utils::sanitizeString($_POST['start_date']) : null;
            $end_date = isset($_POST['end_date']) ? Utils::sanitizeString($_POST['end_date']) : null;
            $cuerpo_email = $_POST['cuerpo_email'];
            $employees = count($_POST['employees']) > 0 ? $_POST['employees'] : null;

            if ($id_boss && $id_evaluation && $email && $cuerpo_email && $start_date && $end_date && $employees) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

                $tr = '';

                $evaluationObj = new Evaluations();
                $evaluationObj->setId($id_evaluation);
                $evaluationName = $evaluationObj->getOne()->name;
                $subject = $evaluationName;


                $group = new GroupEvaluation;
                $group->setGroup_name($evaluationName);
                $group->setId_boss($id_boss);
                $group->setStart_date($start_date);
                $group->setEnd_date($end_date);
                $group->setId_contact($id_contacto);
                $group->save();
                $id_group_evaluation = $group->getId_group();

                for ($i = 0; $i < count($employees); $i++) {
                    $employeeObj = new Employees();
                    $employeeObj->setId($employees[$i]);
                    $employee = $employeeObj->getOne();

                    $id_employee = $employee->id;
                    $id_position = $employee->id_position;
                    $nameEmployee = $employee->first_name . ' ' . $employee->last_name . ' ' . $employee->surname;

                    $positionObj = new Positions();
                    $positionObj->setId($id_position);
                    $title_position = $positionObj->getOne()->title;
                    $deparment = $positionObj->getOne()->department;

                    $evaluationEmployeeObj = new EvaluationEmployee;
                    $evaluationEmployeeObj->setId_evaluation($id_evaluation);
                    $evaluationEmployeeObj->setId_employee($id_employee);
                    $evaluationEmployeeObj->setId_position($id_position);
                    $evaluationEmployeeObj->setId_boss($id_boss);
                    $evaluationEmployeeObj->setStart_date('');
                    $evaluationEmployeeObj->setEnd_date('');
                    $evaluationEmployeeObj->setStatus(1);
                    $evaluationEmployeeObj->setDate_of_realization(null);
                    $evaluationEmployeeObj->setID_Contacto($id_contacto);
                    $evaluationEmployeeObj->setId_group_evaluation($id_group_evaluation);
                    $save = $evaluationEmployeeObj->save();

                    $id_evaluationemployee = $evaluationEmployeeObj->getId();

                    if ($save) {
                        $tr .= " 
                    <tr>
                        <td>{$nameEmployee}</td>
                        <td>{$title_position}</td>
                        <td>{$deparment}</td>
                        <td> <a href=" . base_url . 'evaluacionempleado/ver2&id=' . Encryption::encode($id_evaluationemployee) . " class='boton-personalizado-4'><span>Ver</span></a></td>
                    </tr>";
                    }
                }

                $employeeObjBoss = new Employees();
                $employeeObjBoss->setId($id_boss);
                $employeeBoss = $employeeObjBoss->getOne();
                $name = $employeeBoss->first_name . ' ' . $employeeBoss->surname . ' ' . $employeeBoss->last_name;



                $body = $cuerpo_email . "
                <!DOCTYPE html>
                        <html>

                        <head>
                            <style>
                                table {
                                    font-family: arial, sans-serif;
                                    border-collapse: collapse;
                                    width: 100%;
                                }
                            
                                td,
                                th {
                                    border: 1px solid #dddddd;
                                    text-align: left;
                                    padding: 8px;
                                }
                            
                                tr:nth-child(even) {
                                    background-color: #dddddd;
                                }
                             
                                .boton-personalizado-4 {
                                    margin: 1em;
                                    text-decoration:none;
                                    font-weight: 600;
                                    font-size: 16px;
                                    color:#FFF;
                                    padding-top:8px;
                                    padding-bottom:8px;
                                    padding-left:25px;
                                    padding-right:25px;
                                    background-color:#28a745;
                                    border-color: #d8d8d8;
                                    border-width: 3px;
                                    border-style: solid;
                                    border-radius:8px;
                                    }
                            </style>
                        </head>
                            
                        <body>
                            
                            <h2>Tabla de evaluacion </h2>
                            
                            <table>
                                <tr>
                                    <th>Nombre de empleado</th>
                                    <th>Puesto</th>
                                    <th>Departamento</th>
                                    <th>Ver evaluacion</th>
                                </tr>
                                   {$tr}
                            </table>
                            

                            <tfoot>
                              <tr>
                                Se puede ver toda la evalaucion dando click<a href=" . base_url . '/evaluacionempleado/index2&id_group=' . Encryption::encode($id_group_evaluation) . " ><span>aqui</span></a>.
                              </tr>
                            </tfoot>
                        </body>
                            
                        </html>";

                Utils::sendEmail($email, $name, $subject, $body);


                $group->setId_contact($id_contacto);
                $groups = $group->getAllGroupsEvaluationBIdBoss();

                for ($i = 0; $i < count($groups); $i++) {
                    $groups[$i]['id_group'] =   Encryption::encode($groups[$i]['id_group']);
                    $groups[$i]['created_at'] = Utils::getDate($groups[$i]['created_at']);
                    $groups[$i]['start_date'] = Utils::getDate($groups[$i]['start_date']);
                    $groups[$i]['end_date']  = Utils::getDate($groups[$i]['end_date']);
                    $groups[$i]['url'] =  base_url . "evaluacionempleado/index2&id_group={$groups[$i]['id_group']}";
                }

                echo json_encode(array('status' => 1, 'groups' => $groups));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
