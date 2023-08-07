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
require_once 'models/RH/EvaluationOpenQuestionsEmployee.php';

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

            //===[gabo 12 junio excel evaluaciones pt2]===
            $contacto =  $contactoEmpresa->getContactoPorUsuario();
            $Empresa = $contacto->Empresa;
            $ID_Contacto = $contacto->ID;
            //===[gabo 12 junio excel evaluaciones fin pt2]===

            $evaluationsObj = new Evaluations();
            $evaluationsObj->setID_Empresa($Empresa);
            $evaluationsObj->setStatus(1);
            //===[gabo 12 junio excel evaluaciones pt2]===


            //===[gabo 19 julio cliente session]===
            $evaluationsObj->setID_Cliente($_SESSION['id_cliente']);
            $evaluationsIndex = $evaluationsObj->getAllByID_Cliente();
            //===[gabo 19 julio cliente session fin]===

            //===[gabo 12 junio excel evaluaciones fin pt2]=== 

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
            //===[gabo 12 junio excel evaluaciones pt2]===
            $evaluationsAll = $evaluationsObj->getAll($id_contacto);
            //===[gabo 12 junio excel evaluaciones fin pt2]===

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

            //===[gabo 19 julio cliente session]===
            $employeeObj = new Employees();
            $employeeObj->setCliente($_SESSION['id_cliente']);
            $employeeObj->setStatus(1);
            $employees = $employeeObj->getAllEmployeesByIDCliente();
            //===[gabo 19 julio cliente session fin]===


            //   ===[gabo 11 junio excel evaluaciones pt2]===
            $evaluationsObj = new Evaluations();
            $evaluationsObj->setStatus(1);
            //  ===[gabo 11 junio excel evaluaciones fin pt2]===

            //===[gabo 19 julio cliente session]===
            $evaluationsObj->setID_Cliente($_SESSION['id_cliente']);
            $evaluationsAll = $evaluationsObj->getALLEvaluationsByID_Cliente();

            $evaluationsAllExcel = $evaluationsObj->getAllAvaiableEvaluationsByID_Cliente();


            $groups_evaluation = new GroupEvaluation;
            $groups_evaluation->setID_Cliente($_SESSION['id_cliente']);
            $groups = $groups_evaluation->getAllGroupsEvaluationByID_Cliente();


            $positionObj2 = new Positions();
            $positionObj2->setID_Cliente($_SESSION['id_cliente']);
            $positionObj2->setStatus(1);
            $type_positions = $positionObj2->getAllPositionByID_Cliente();
            //===[gabo 19 julio cliente session fin]===

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

    // ===[gabo 8 junio excel evaluaciones ]===
    public function creat()
    {


        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {

                $id = Encryption::decode($_POST['id']);
                $name = isset($_POST['name']) ? Utils::sanitizeStringBlank($_POST['name']) : null;
                $type = isset($_POST['type']) ? Encryption::decode($_POST['type']) : '0';
                $level = isset($_POST['level']) ? Utils::sanitizeNumber($_POST['level']) : null;
                $flag = $_POST['flag'];
                //===[gabo 11 junio excel evaluaciones pt2]===
                $id_cliente = isset($_POST['id_cliente_plantilla']) ? Utils::sanitizeNumber($_POST['id_cliente_plantilla']) : null;
                //===[gabo 11 junio excel evaluaciones fin pt2]===


                if ($flag && $name && $level && Utils::isValid($_SESSION['identity'])) {

                    $contactoEmpresa = new ContactosEmpresa();
                    $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                    //===[gabo 12 junio excel evaluaciones pt2]===
                    $contacto =  $contactoEmpresa->getContactoPorUsuario();
                    $Empresa = $contacto->Empresa;
                    $ID_Contacto = $contacto->ID;
                    //===[gabo 12 junio excel evaluaciones fin pt2]===

                    $evaluationsObj = new Evaluations();
                    $evaluationsObj->setId($id);
                    $evaluationsObj->setName($name);
                    $evaluationsObj->setLevel($level);
                    $evaluationsObj->setStatus(1);
                    $evaluationsObj->setType($type);
                    $evaluationsObj->setID_Empresa($Empresa);
                    //===[gabo 11 junio excel evaluaciones pt2]===
                    $evaluationsObj->setID_Cliente($id_cliente);
                    //===[gabo 11 junio excel evaluaciones fin pt2]===
                    $evaluationsObj->setCreated_by($_SESSION['identity']->id);

                    if ($flag == 1) {

                        $save = $evaluationsObj->save();
                        if ($type == 1 && $save) {
                            $openQuestionsObj = new OpenQuestions();
                            $openQuestionsObj->setId_evaluation($id);
                            $openQuestionsObj->setQuestion('Compromisos y acuerdos con el colaborador.');
                            $openQuestionsObj->setStatus(2);
                            $save = $openQuestionsObj->save();
                        }
                    } else if ($flag == 2) {
                        $openQuestionsObj = new OpenQuestions();
                        $openQuestionsObj->setId_evaluation($id);
                        $openQuestionsObj->setStatus(2);
                        $openQuestions = $openQuestionsObj->getAllByIdEvalaution();
                        if (count($openQuestions) == 0) {
                            $openQuestionsObj->setQuestion('Compromisos y acuerdos con el colaborador.');
                            $openQuestionsObj->save();
                        }


                        $save = $evaluationsObj->update();
                    }

                    if ($save) {

                        //===[gabo 19 julio cliente session]===
                        $evaluationsObj->setID_Cliente($_SESSION['id_cliente']);
                        $evaluationsIndex = $evaluationsObj->getAllByID_Cliente();
                        //===[gabo 19 julio cliente session fin]===

                        for ($i = 0; $i < count($evaluationsIndex); $i++) {
                            $evaluationsIndex[$i]['modified_at'] = substr(Utils::getDate($evaluationsIndex[$i]['modified_at']), 5);
                            $evaluationsIndex[$i]['id'] = Encryption::encode($evaluationsIndex[$i]['id']);
                            $evaluationsIndex[$i]['url'] = base_url . 'evaluaciones/ver&id=' . $evaluationsIndex[$i]['id'];
                        }

                        echo json_encode(array('status' => 2, 'evaluations' => $evaluationsIndex));
                    } else {
                        echo json_encode(array('status' => 0));
                    }
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
    // ===[gabo junio mayo excel evaluaciones fin ]===
    public function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);

                //===[gabo 12 junio excel evaluaciones pt2]===
                $contacto =  $contactoEmpresa->getContactoPorUsuario();
                $Empresa = $contacto->Empresa;
                $ID_Contacto = $contacto->ID;
                //===[gabo 12 junio excel evaluaciones fin pt2]===

                $evaluationsObj = new Evaluations();
                $evaluationsObj->setId($id);
                $evaluationsObj->setStatus(0);
                $evaluationsObj->setID_Empresa($Empresa);
                $evaluationsObj->setCreated_by($_SESSION['identity']->id);

                $flag = $evaluationsObj->updateDelete();

                if ($flag) {
                    $evaluationsObj->setID_Empresa($Empresa);
                    $evaluationsObj->setStatus(1);
                    //===[gabo 19 julio cliente session]===
                    $evaluationsObj->setID_Cliente($_SESSION['id_cliente']);
                    $evaluationsIndex = $evaluationsObj->getAllByID_Cliente();
                    //===[gabo 19 julio cliente session fin]===

                    for ($i = 0; $i < count($evaluationsIndex); $i++) {
                        $evaluationsIndex[$i]['modified_at'] = substr(Utils::getDate($evaluationsIndex[$i]['modified_at']), 5);
                        $evaluationsIndex[$i]['id'] = Encryption::encode($evaluationsIndex[$i]['id']);
                    }

                    echo json_encode(array('status' => 1, 'evaluations' => $evaluationsIndex, 'url' => base_url));
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


            //===[gabo 6 junio evaluaciones]===
            $id_cliente = isset($_POST['id_cliente_evalua']) ? Utils::sanitizeNumber($_POST['id_cliente_evalua']) : null;
            //===[gabo 6 junio evaluaciones fin]===

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
                //===[gabo 5 de junio evaluaciones]===
                $group->setID_Cliente($id_cliente);
                //===[gabo 5 de junio evaluaciones fin]===
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



                //===[gabo 19 julio cliente session]===
                $group->setID_Cliente($_SESSION['id_cliente']);
                $groups = $group->getAllGroupsEvaluationByID_Cliente();
                //===[gabo 19 julio cliente session fin]===


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

    public function table()
    {
        $id_evaluation = ($_POST['id_evaluation'] ? Utils::sanitizeNumber($_POST['id_evaluation']) : 'false');
        $id_group_evaluation = ($_POST['id_group_evaluation'] ? Utils::sanitizeNumber($_POST['id_group_evaluation']) : 'false');

        if ($id_group_evaluation) {
            $evaluationEmployeeObj = new EvaluationEmployee();
            $evaluationEmployeeObj->setId_group_evaluation($id_group_evaluation);

            $arryaEvaluationEmployee = $evaluationEmployeeObj->getValuequestionForEmployee();


            $EvaluationOpenQuestionsEmployeeObj = new EvaluationOpenQuestionsEmployee();

            $categoriesObj = new EvaluationCategory();
            $categoriesObj->setId_evaluation($id_evaluation);
            $categoriesObj->setStatus(1);
            $categories =  $categoriesObj->getAllByIdEvaluation();
            $total_categories = count($categories);
            $total_por_category = 100 / $total_categories;
            $questions =  $categoriesObj->getAllQuestionsByIdEvalaution();

            $columnas_por_categoria = [];
            foreach ($categories as $categorie) {
                $conteo = 0;
                foreach ($questions as $i => $pregunta) {
                    if ($categorie["id"] == $pregunta['id_category']) {
                        $conteo++;
                    }
                }
                $columnas_por_categoria[] = $conteo;
            }

            $i = 0;

            $openQuestionsObj = new OpenQuestions();
            $openQuestionsObj->setId_evaluation($id_evaluation);
            $openQuestionsObj->setStatus(1);
            $openQuestions = $openQuestionsObj->getAllByIdEvalaution();
            $total_questions = count($questions);
            $total_openQuestions = count($openQuestions);


            $openQuestionsObj = new OpenQuestions();
            $openQuestionsObj->setId_evaluation($id_evaluation);
            $openQuestionsObj->setStatus(2);
            $feedback = $openQuestionsObj->getAllByIdEvalaution();
            $total_feedback = count($feedback);
            $total_open_questionsfeedback = $total_openQuestions + $total_feedback;


            $group = new GroupEvaluation();
            $group->setId_group($id_group_evaluation);
            $grupo = $group->getOne();
            $titulo = $grupo->group_name . "  (" . Utils::getDate($grupo->start_date) . " al " . Utils::getDate($grupo->end_date) . ")";

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/evaluations/table.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }
}
