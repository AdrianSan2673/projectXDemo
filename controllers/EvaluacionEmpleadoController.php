<?php
// GABO 11 MAYO
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
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
require_once 'models/RH/Employee_trainings.php';
require_once 'models/RH/HistoryPositions.php';
require_once 'models/RH/EmployeeContract.php';
require_once 'models/RH/EmployeeAvatar.php';
require_once 'models/RH/EmployeeFamily.php';
require_once 'models/RH/Evaluations.php';
require_once 'models/RH/EvaluationCategory.php';
require_once 'models/RH/EvaluationEmployee.php';
require_once 'models/RH/EvaluationQuestionsEmployee.php';
require_once 'models/RH/OpenQuestions.php';
require_once 'models/RH/EvaluationOpenQuestionsEmployee.php';
require_once 'models/RH/EffectivenessIndicatiors.php';
//  ===[gabo 12 mayo evaluaciones]===
require_once 'models/RH/GroupEvaluation.php';
//  ===[gabo 12 mayo evaluaciones fin]===

class EvaluacionEmpleadoController
{

    public function index()
    {
        if (isset($_GET['id_boss']) || (Utils::isAdmin() || Utils::isCustomerSA())) {
            if (isset($_GET['id_boss']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {
                $id_boss = Encryption::decode($_GET['id_boss']);
                $start_date = Encryption::decode($_GET['start_date']);
                $end_date = Encryption::decode($_GET['end_date']);

                $employee = new EvaluationEmployee();
                $employee->setId_boss($id_boss);
                $employee->setStart_date($start_date);
                $employee->setEnd_date($end_date);
                $evaluations = $employee->getEvaluationByIdBossByDates();
            } elseif (isset($_GET['id_boss'])) {
                $id_boss = Encryption::decode($_GET['id_boss']);

                $employee = new EvaluationEmployee();
                $employee->setId_boss($id_boss);
                $evaluations = $employee->getEvaluationByIdBoss();
            } elseif (Utils::isAdmin() || Utils::isCustomerSA()) {
                if (Utils::isCustomerSA()) {
                    $contactoEmpresa = new ContactosEmpresa();
                    $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                    $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                    $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                    $employee = new EvaluationEmployee();
                    $employee->setID_Contacto($id_contacto);
                    $evaluations = $employee->getEvaluationByID_Contacto();
                }
            }
            $page_title = 'Evaluaciones de Empleados | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/evaluations/list.php';
            require_once 'views/evaluations/modal-create.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }

    public function ver()
    {
        //if (Utils::isAdmin() || Utils::isCustomerSA()) {
        if (isset($_GET['id'])) {
            $id = Encryption::decode($_GET['id']);

            $evaluation_employee = new EvaluationEmployee();
            $evaluation_employee->setId($id);
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                $evaluation_employee->setToken_sign($token);
                $evaluation_employee->validateIdToken();
            }
            $evaluation_employee = $evaluation_employee->getOne();

            $id_employee = $evaluation_employee->id_employee;
            $id_evaluation = $evaluation_employee->id_evaluation;

            $employeeObj = new Employees();
            $employeeObj->setId($id_employee);
            $employee = $employeeObj->getOne();


            $employeeContactObj = new EmployeeContact();
            $employeeContactObj->setId_employee($id_employee);
            $email_Employee =  $employeeContactObj->getEmailsByIdEmployee();

            $evaluationsObj = new Evaluations();
            $evaluationsObj->setId($id_evaluation);
            $evaluation = $evaluationsObj->getOne();

            $evaluationCategoryObj = new EvaluationCategory();
            $evaluationCategoryObj->setId_evaluation($id_evaluation);
            $evaluationCategoryObj->setStatus(1);
            $evaluationCategory = $evaluationCategoryObj->getAllByIdEvaluation();

            $openQuestion = new OpenQuestions();
            $openQuestion->setId_evaluation($id_evaluation);
            $openQuestion->setStatus($evaluation_employee->status);
            $openQuestions = $openQuestion->getQuestionsByIdEvaluationAndStatus();

            $openQuestion->setStatus(1);
            $employeeOpenQuestion = new EvaluationOpenQuestionsEmployee();
            $employeeOpenQuestion->setId_evaluation_employee($id);
            $open_questions_answered = $employeeOpenQuestion->getOpenQuestionByIdAndStatus($openQuestion);
            $openQuestion->setStatus(2);
            $open_questions_feedback = $employeeOpenQuestion->getOpenQuestionByIdAndStatus($openQuestion);


            $employeeContractObj = new EmployeeContract();
            $employeeContractObj->setId_employee($id_employee);
            $employeeContract = $employeeContractObj->getOneByIdEmployee();
            $employeeContractAll = $employeeContractObj->getAllByIdEmployee();

            $positionObj = new Positions();
            $positionObj->setId($employee->id_position);
            $position = $positionObj->getOne();

            $effectivenessIndicatiors = new EffectivenessIndicatiors();
            $effectivenessIndicatiors->setId_position($employee->id_position);
            $effectivenessIndicatiors = $effectivenessIndicatiors->getAllByIdPosition();

            $avatar = new EmployeeAvatar();
            $avatar->setId_employee($id_employee);
            $avatar = $avatar->getOneByIdEmployee();

            $evaluationQuestionEmployee = new EvaluationQuestionsEmployee();
            $evaluationQuestionEmployee->setId_evaluation_employee($id);
            $answers = $evaluationQuestionEmployee->getAnswersById();


            // ===[gabo 11 mayo calificaciones] ===
            if ($evaluation_employee->score != '') {
                $scores = explode("/", $evaluation_employee->score);
                $calificacion = [];
                foreach ($scores as $score) {
                    $desglose = explode(":", $score);

                    $calificacion[$desglose[0]] = round($desglose[1], 0);
                }
            }

            $nacimiento = new DateTime($employee->date_birth);
            $ahora = new DateTime(date("Y-m-d"));
            $diferencia = $ahora->diff($nacimiento);
            $employee->date_birth = $diferencia->format("%y");


            $fechaInicio = new DateTime($employee->start_date);
            $fecha = new DateTime(date("Y-m-d"));
            $diferencia = $fecha->diff($fechaInicio);
            $employee->antiquity = $diferencia->format("%y");


            // ===[gabo 11 mayo calificaciones fin] ===

            if (!$avatar) {
                $avatar = new stdClass();
                if ($employee->id_gender == 2)
                    $avatar->image = array('../dist/img/user-icon-rose.png', 'png', false);
                else
                    $avatar->image = array('../dist/img/user-icon.png', 'png', false);
            } else
                $avatar->image[2] = true;

            //Label para 
            $arrayLabel = array(
                ['id'  => '0', "label"  => "Movil"],
                ['id'  => '1', "label"  => "Casa"],
                ['id'  => '2', "label"  => "Personal"],
                ['id'  => '3', "label"  => "Trabajo"],
                ['id'  => '4', "label"  => "Otros"]
            );

            $lbl_executives = "";
            $page_title = $employee->first_name . ' ' . $employee->surname . ' | RRHH Ingenia';

            require_once 'views/layout/header.php';
            if (isset($_SESSION['identity']))
                require_once 'views/layout/sidebar.php';
            else
                require_once 'views/layout/navbar.php';
            if ($evaluation_employee->status >= 2)
                require_once 'views/evaluations/evaluation-complete.php';
            else
                require_once 'views/evaluations/evaluate.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }

    public function evaluate()
    {
        if ($_POST['id_evaluation_employee']) {


            $questions = array();
            $open_questions = array();
            foreach ($_POST as $key => $value) {
                if (strstr($key, 'question'))
                    array_push($questions, array('id_question' => str_replace('question', '', $key), 'value' => Utils::sanitizeNumber($value)));

                if (strstr($key, 'open'))
                    array_push($open_questions, array('id_open_question' => str_replace('open', '', $key), 'answer' => Utils::sanitizeStringBlank($value)));
            }

            $id_evaluation_employee = Utils::sanitizeNumber($_POST['id_evaluation_employee']);

            for ($i = 0; $i < count($questions); $i++) {

                $employeeQuestion[$i] = new EvaluationQuestionsEmployee();
                $employeeQuestion[$i]->setId_question($questions[$i]['id_question']);
                $employeeQuestion[$i]->setValue($questions[$i]['value']);
                $employeeQuestion[$i]->setId_evaluation_employee($id_evaluation_employee);
                $employeeQuestion[$i]->save();
            }

            for ($j = 0; $j < count($open_questions); $j++) {

                $employeeOpenQuestion[$j] = new EvaluationOpenQuestionsEmployee();
                $employeeOpenQuestion[$j]->setId_open_question($open_questions[$j]['id_open_question']);
                $employeeOpenQuestion[$j]->setAnswer($open_questions[$j]['answer']);
                $employeeOpenQuestion[$j]->setId_evaluation_employee($id_evaluation_employee);
                $employeeOpenQuestion[$j]->save();
            }


            $evaluationEmployee = new EvaluationEmployee();
            $evaluationEmployee->setId($id_evaluation_employee);
            $evaluationEmployee->setStatus(2);
            $complete = $evaluationEmployee->evaluationComplete();



            // ===[gabo 11 mayo calificaciones] ===
            $id_evaluation_employee = $_POST['id_evaluation_employee'];

            $evaluation_employee = new EvaluationEmployee();
            $evaluation_employee->setId($id_evaluation_employee);
            $evaluation_employee = $evaluation_employee->getOne();

            $id_evaluation = $evaluation_employee->id_evaluation;

            $evaluationQuestionEmployee = new EvaluationQuestionsEmployee();
            $evaluationQuestionEmployee->setId_evaluation_employee($id_evaluation_employee);
            $answers = $evaluationQuestionEmployee->getAnswersById();

            $evaluationCategoryObj = new EvaluationCategory();
            $evaluationCategoryObj->setId_evaluation($id_evaluation);
            $evaluationCategoryObj->setStatus(1);
            $evaluationCategory = $evaluationCategoryObj->getAllByIdEvaluation();

            $total_categorias = 0;
            $total_criterios = 0;
            $total_preguntas = 0;
            $total_columnas = 0;
            $resultados_x_categoria = [];
            $total_answer = 0;

            $total_categorias = count($evaluationCategory);
            $valor_categoria = round(100 / $total_categorias, 2);


            foreach ($evaluationCategory as $evaluacionCat) {

                $resultados_x_criterio = [];
                $getCriterionsCategory = Utils::getAllCriterionsByIdCategory($evaluacionCat['id']);

                $total_criterios = count($getCriterionsCategory);
                $valor_criterio = round($valor_categoria / $total_criterios, 3);
                $total_puntuaje_x_categoria = 0;
                $puntuaje_criterio_para_mas_de_uno = 0;
                foreach ($getCriterionsCategory as $criterionCategory) {

                    $maximo_puntuaje = 0;
                    $valor_mayor = 0;
                    $puntuaje_criterio = 0;
                    $total_answer = 0;
                    $total_preguntas = 0;

                    $criterionScoreColums = Utils::getCriterionScoreByIdCriterion($criterionCategory['id']);
                    foreach ($criterionScoreColums as $criterionscoreCol) {

                        $total_columnas++;
                        if ($criterionscoreCol['value'] > $valor_mayor) {
                            $valor_mayor = $criterionscoreCol['value'];
                        }
                    }

                    $questionsRows = Utils::getQuestionsCriterionByIdCriterion($criterionCategory['id']);
                    foreach ($questionsRows as $questRow) {
                        $total_preguntas++;
                        $total_answer = $total_answer +  $answers[array_search($questRow['id'], array_column($answers, 'id_question'))][2];
                    }

                    $maximo_puntuaje = $valor_mayor * $total_preguntas;
                    $puntuaje_criterio = ($total_answer * 100) / $maximo_puntuaje;
                    $total_puntuaje_x_categoria += $puntuaje_criterio;

                    if ($total_criterios > 1) {

                        $puntuaje_criterio_para_mas_de_uno = $puntuaje_criterio_para_mas_de_uno + (($total_answer * 1) / $maximo_puntuaje) * ($valor_criterio);
                    } else {
                        $resultados_x_criterio[] = $puntuaje_criterio;
                        $resultados_x_criterio[] = $maximo_puntuaje;
                        $resultados_x_criterio[] = $evaluacionCat['id'];
                        $resultados_x_criterio[] = $valor_criterio;
                        $resultados_x_criterio[] = (($total_answer * 1) / $maximo_puntuaje) * ($valor_criterio);
                    }
                }
                if ($total_criterios > 1) {
                    $resultados_x_criterio[] = 0;
                    $resultados_x_criterio[] = 0;
                    $resultados_x_criterio[] = $evaluacionCat['id'];
                    $resultados_x_criterio[] = 0;
                    $resultados_x_criterio[] = $puntuaje_criterio_para_mas_de_uno;
                }

                $resultados_x_categoria[] = $resultados_x_criterio;
            }
            $scores = '';
            $bandera = true;
            foreach ($resultados_x_categoria as $categoria) {
                if ($bandera) {
                    $scores .= $categoria[2] . ":" . $categoria[4];
                    $bandera = false;
                } else {
                    $scores .= "/" . $categoria[2] . ":" . $categoria[4];
                }
            }

            if ($scores == '') {
                $scores = '0';
            }

            $evaluationEmployee->setScore($scores);
            $score   = $evaluationEmployee->updateScore();

            // ===[gabo 11 mayo calificaciones fin] ===

            if ($score)
                echo json_encode(array('status' => 1));
            else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    //aqui va index,ver,evaluar

    public function index2()
    {
        if (isset($_GET['id_group']) || (Utils::isAdmin() || Utils::isCustomerSA())) {

            //===[gabo 12 mayo evaluaciones]===
            if (isset($_GET['id_group'])) {
                $employee = new GroupEvaluation();
                $employee->setId_group(Encryption::decode($_GET['id_group']));
                $evaluations = $employee->getEvaluationsByIdGroup();
            }


            //===[gabo 12 mayo evaluaciones fin]===

            $page_title = 'Evaluaciones de Empleados | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/evaluations2/list.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }

    public function ver2()
    {
        //if (Utils::isAdmin() || Utils::isCustomerSA()) {

        if (isset($_GET['id'])) {
            $id = Encryption::decode($_GET['id']);

            $evaluation_employee = new EvaluationEmployee();
            $evaluation_employee->setId($id);
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                $evaluation_employee->setToken_sign($token);
                $evaluation_employee->validateIdToken();
            }
            $evaluation_employee = $evaluation_employee->getOne();


            $id_employee = $evaluation_employee->id_employee;
            $id_evaluation = $evaluation_employee->id_evaluation;

            $employeeObj = new Employees();
            $employeeObj->setId($id_employee);
            $employee = $employeeObj->getOne();


            $employeeContactObj = new EmployeeContact();
            $employeeContactObj->setId_employee($id_employee);
            $email_Employee =  $employeeContactObj->getEmailsByIdEmployee();

            $evaluationsObj = new Evaluations();
            $evaluationsObj->setId($id_evaluation);
            $evaluation = $evaluationsObj->getOne();

            $evaluationCategoryObj = new EvaluationCategory();
            $evaluationCategoryObj->setId_evaluation($id_evaluation);
            $evaluationCategoryObj->setStatus(1);
            $evaluationCategory = $evaluationCategoryObj->getAllByIdEvaluation();

            $openQuestion = new OpenQuestions();
            $openQuestion->setId_evaluation($id_evaluation);
            $openQuestion->setStatus($evaluation_employee->status);
            $openQuestions = $openQuestion->getQuestionsByIdEvaluationAndStatus();

            $openQuestion->setStatus(1);
            $employeeOpenQuestion = new EvaluationOpenQuestionsEmployee();
            $employeeOpenQuestion->setId_evaluation_employee($id);
            $open_questions_answered = $employeeOpenQuestion->getOpenQuestionByIdAndStatus($openQuestion);
            $openQuestion->setStatus(2);
            $open_questions_feedback = $employeeOpenQuestion->getOpenQuestionByIdAndStatus($openQuestion);


            $employeeContractObj = new EmployeeContract();
            $employeeContractObj->setId_employee($id_employee);
            $employeeContract = $employeeContractObj->getOneByIdEmployee();
            $employeeContractAll = $employeeContractObj->getAllByIdEmployee();

            $positionObj = new Positions();
            $positionObj->setId($employee->id_position);
            $position = $positionObj->getOne();

            $effectivenessIndicatiors = new EffectivenessIndicatiors();
            $effectivenessIndicatiors->setId_position($employee->id_position);
            $effectivenessIndicatiors = $effectivenessIndicatiors->getAllByIdPosition();

            $avatar = new EmployeeAvatar();
            $avatar->setId_employee($id_employee);
            $avatar = $avatar->getOneByIdEmployee();

            $evaluationQuestionEmployee = new EvaluationQuestionsEmployee();
            $evaluationQuestionEmployee->setId_evaluation_employee($id);
            $answers = $evaluationQuestionEmployee->getAnswersById();


            // ===[gabo 11 mayo calificaciones] ===
            if ($evaluation_employee->score != '') {
                $scores = explode("/", $evaluation_employee->score);
                $calificacion = [];
                foreach ($scores as $score) {
                    $desglose = explode(":", $score);

                    $calificacion[$desglose[0]] = round($desglose[1], 0);
                }
            }

            $nacimiento = new DateTime($employee->date_birth);
            $ahora = new DateTime(date("Y-m-d"));
            $diferencia = $ahora->diff($nacimiento);
            $employee->date_birth = $diferencia->format("%y");


            $fechaInicio = new DateTime($employee->start_date);
            $fecha = new DateTime(date("Y-m-d"));
            $diferencia = $fecha->diff($fechaInicio);
            $employee->antiquity = $diferencia->format("%y");


            // ===[gabo 11 mayo calificaciones fin] ===

            if (!$avatar) {
                $avatar = new stdClass();
                if ($employee->id_gender == 2)
                    $avatar->image = array('../dist/img/user-icon-rose.png', 'png', false);
                else
                    $avatar->image = array('../dist/img/user-icon.png', 'png', false);
            } else
                $avatar->image[2] = true;

            //Label para 
            $arrayLabel = array(
                ['id'  => '0', "label"  => "Movil"],
                ['id'  => '1', "label"  => "Casa"],
                ['id'  => '2', "label"  => "Personal"],
                ['id'  => '3', "label"  => "Trabajo"],
                ['id'  => '4', "label"  => "Otros"]
            );

            $lbl_executives = "";
            $page_title = $employee->first_name . ' ' . $employee->surname . ' | RRHH Ingenia';

            require_once 'views/layout/header.php';
            if (isset($_SESSION['identity']))
                require_once 'views/layout/sidebar.php';
            else
                require_once 'views/layout/navbar.php';
            if ($evaluation_employee->status >= 2)
                require_once 'views/evaluations2/evaluation-complete.php';
            else
                require_once 'views/evaluations2/evaluate.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }

    public function evaluate2()
    {
        if ($_POST['id_evaluation_employee']) {


            $questions = array();
            $open_questions = array();
            foreach ($_POST as $key => $value) {
                if (strstr($key, 'question'))
                    array_push($questions, array('id_question' => str_replace('question', '', $key), 'value' => Utils::sanitizeNumber($value)));

                if (strstr($key, 'open'))
                    array_push($open_questions, array('id_open_question' => str_replace('open', '', $key), 'answer' => Utils::sanitizeStringBlank($value)));
            }

            $id_evaluation_employee = Utils::sanitizeNumber($_POST['id_evaluation_employee']);

            for ($i = 0; $i < count($questions); $i++) {

                $employeeQuestion[$i] = new EvaluationQuestionsEmployee();
                $employeeQuestion[$i]->setId_question($questions[$i]['id_question']);
                $employeeQuestion[$i]->setValue($questions[$i]['value']);
                $employeeQuestion[$i]->setId_evaluation_employee($id_evaluation_employee);
                $employeeQuestion[$i]->save();
            }

            for ($j = 0; $j < count($open_questions); $j++) {

                $employeeOpenQuestion[$j] = new EvaluationOpenQuestionsEmployee();
                $employeeOpenQuestion[$j]->setId_open_question($open_questions[$j]['id_open_question']);
                $employeeOpenQuestion[$j]->setAnswer($open_questions[$j]['answer']);
                $employeeOpenQuestion[$j]->setId_evaluation_employee($id_evaluation_employee);
                $employeeOpenQuestion[$j]->save();
            }


            $evaluationEmployee = new EvaluationEmployee();
            $evaluationEmployee->setId($id_evaluation_employee);
            $evaluationEmployee->setStatus(2);
            $complete = $evaluationEmployee->evaluationComplete();

            // ===[gabo 11 mayo calificaciones] ===
            $id_evaluation_employee = $_POST['id_evaluation_employee'];

            $evaluation_employee = new EvaluationEmployee();
            $evaluation_employee->setId($id_evaluation_employee);
            $evaluation_employee = $evaluation_employee->getOne();

            $id_group_evaluation = Encryption::encode($evaluation_employee->id_group_evaluation);
            $id_evaluation = $evaluation_employee->id_evaluation;

            $evaluationQuestionEmployee = new EvaluationQuestionsEmployee();
            $evaluationQuestionEmployee->setId_evaluation_employee($id_evaluation_employee);
            $answers = $evaluationQuestionEmployee->getAnswersById();

            $evaluationCategoryObj = new EvaluationCategory();
            $evaluationCategoryObj->setId_evaluation($id_evaluation);
            $evaluationCategoryObj->setStatus(1);
            $evaluationCategory = $evaluationCategoryObj->getAllByIdEvaluation();

            $total_categorias = 0;
            $total_criterios = 0;
            $total_preguntas = 0;
            $total_columnas = 0;
            $resultados_x_categoria = [];
            $total_answer = 0;

            $total_categorias = count($evaluationCategory);
            $valor_categoria = round(100 / $total_categorias, 2);


            foreach ($evaluationCategory as $evaluacionCat) {

                $resultados_x_criterio = [];
                $getCriterionsCategory = Utils::getAllCriterionsByIdCategory($evaluacionCat['id']);

                $total_criterios = count($getCriterionsCategory);
                $valor_criterio = round($valor_categoria / $total_criterios, 3);
                $total_puntuaje_x_categoria = 0;
                $puntuaje_criterio_para_mas_de_uno = 0;
                foreach ($getCriterionsCategory as $criterionCategory) {

                    $maximo_puntuaje = 0;
                    $valor_mayor = 0;
                    $puntuaje_criterio = 0;
                    $total_answer = 0;
                    $total_preguntas = 0;

                    $criterionScoreColums = Utils::getCriterionScoreByIdCriterion($criterionCategory['id']);
                    foreach ($criterionScoreColums as $criterionscoreCol) {

                        $total_columnas++;
                        if ($criterionscoreCol['value'] > $valor_mayor) {
                            $valor_mayor = $criterionscoreCol['value'];
                        }
                    }

                    $questionsRows = Utils::getQuestionsCriterionByIdCriterion($criterionCategory['id']);
                    foreach ($questionsRows as $questRow) {
                        $total_preguntas++;
                        $total_answer = $total_answer +  $answers[array_search($questRow['id'], array_column($answers, 'id_question'))][2];
                    }

                    $maximo_puntuaje = $valor_mayor * $total_preguntas;
                    $puntuaje_criterio = ($total_answer * 100) / $maximo_puntuaje;
                    $total_puntuaje_x_categoria += $puntuaje_criterio;

                    if ($total_criterios > 1) {

                        $puntuaje_criterio_para_mas_de_uno = $puntuaje_criterio_para_mas_de_uno + (($total_answer * 1) / $maximo_puntuaje) * ($valor_criterio);
                    } else {
                        $resultados_x_criterio[] = $puntuaje_criterio;
                        $resultados_x_criterio[] = $maximo_puntuaje;
                        $resultados_x_criterio[] = $evaluacionCat['id'];
                        $resultados_x_criterio[] = $valor_criterio;
                        $resultados_x_criterio[] = (($total_answer * 1) / $maximo_puntuaje) * ($valor_criterio);
                    }
                }
                if ($total_criterios > 1) {
                    $resultados_x_criterio[] = 0;
                    $resultados_x_criterio[] = 0;
                    $resultados_x_criterio[] = $evaluacionCat['id'];
                    $resultados_x_criterio[] = 0;
                    $resultados_x_criterio[] = $puntuaje_criterio_para_mas_de_uno;
                }

                $resultados_x_categoria[] = $resultados_x_criterio;
            }
            $scores = '';
            $bandera = true;
            foreach ($resultados_x_categoria as $categoria) {
                if ($bandera) {
                    $scores .= $categoria[2] . ":" . $categoria[4];
                    $bandera = false;
                } else {
                    $scores .= "/" . $categoria[2] . ":" . $categoria[4];
                }
            }

            if ($scores == '') {
                $scores = '0';
            }

            $evaluationEmployee->setScore($scores);
            $score   = $evaluationEmployee->updateScore();
            $url =   base_url . "evaluacionempleado/index2&id_group={$id_group_evaluation}";

            // ===[gabo 11 mayo calificaciones fin] ===

            if ($score)
                echo json_encode(array('status' => 1, 'url' => $url));
            else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function feedback()
    {
        if ($_POST['id_evaluation_employee']) {

            $open_questions = array();
            foreach ($_POST as $key => $value) {
                /* if (strstr($key, 'open'))
                    array_push($open_questions, array('id_open_question' => str_replace('open', '', $key), 'answer' => Utils::sanitizeStringBlank($value))); */

                // ===[gabo 29 de mayo feedback ]===
                if (strstr($key, 'question'))
                    array_push($open_questions, array('id_open_question' => str_replace('question', '', $key), 'answer' => Utils::sanitizeStringBlank($value)));
                // ===[gabo 29 de mayo feedback fin]===
            }

            $id_evaluation_employee = Utils::sanitizeNumber(Encryption::decode($_POST['id_evaluation_employee']));
            $email = $_POST['email_boss'] != '' ? Utils::sanitizeEmail($_POST['email_boss']) : Utils::sanitizeEmail($_POST['email_input']);

            for ($j = 0; $j < count($open_questions); $j++) {
                $employeeOpenQuestion[$j] = new EvaluationOpenQuestionsEmployee();
                $employeeOpenQuestion[$j]->setId_open_question($open_questions[$j]['id_open_question']);
                $employeeOpenQuestion[$j]->setAnswer($open_questions[$j]['answer']);
                $employeeOpenQuestion[$j]->setId_evaluation_employee($id_evaluation_employee);
                $employeeOpenQuestion[$j]->save();
            }

            $evaluationEmployee = new EvaluationEmployee();
            $evaluationEmployee->setId($id_evaluation_employee);
            $evaluationEmployee->setStatus(3);
            $evaluationEmployee->setEmployee_email($email);
            $complete = $evaluationEmployee->evaluationFeedback();
            $token = $evaluationEmployee->getToken_sign();
            $evaluation_employee = $evaluationEmployee->getOne();
            if ($complete) {
                $openQuestion = new OpenQuestions();
                $openQuestion->setStatus(2);
                $employeeOpenQuestion = new EvaluationOpenQuestionsEmployee();
                $employeeOpenQuestion->setId_evaluation_employee($id_evaluation_employee);
                $open_questions_feedback = $employeeOpenQuestion->getOpenQuestionByIdAndStatus($openQuestion);
                $opf = '';
                foreach ($open_questions_feedback as $op)
                    $opf .= "<b>" . $op['question'] . "</b><p>" . $op['answer'] . "</p><br>";

                $url = base_url . 'evaluacionempleado/ver&id=' . Encryption::encode($id_evaluation_employee) . '&token=' . $token;

                $body = "<p>Se anexa lo visto en la retroalimentación.</p>" . $opf . "<p>Para consultar tu evaluación e indicar de enterado, da clic en el botón</p><a href='" . $url . "' style='background-color: #4CAF50;
                border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;'>Ver evaluación<a/>";
                //  ===[16 de mayo gabo evaluaciones]=== 
                Utils::sendEmail($email, $evaluation_employee->first_name . ' ' . $evaluation_employee->surname, 'Retroalimentación ' . $evaluation_employee->name, $body);
                //  ===[16 de mayo gabo evaluaciones]=== 
                echo json_encode(array('status' => 1));
            } else
                echo json_encode(array('status' => 2));
        } else
            echo json_encode(array('status' => 0));
    }

    public function notify()
    {
        if ((Utils::isCustomerSA() || Utils::isCustomer()) && isset($_POST['id_evaluation_employee'])) {
            $id_evaluation_employee = Utils::sanitizeNumber(($_POST['id_evaluation_employee']));

            $evaluationEmployee = new EvaluationEmployee();
            $evaluationEmployee->setId($id_evaluation_employee);
            $evaluation_employee = $evaluationEmployee->getOne();
            if ($evaluation_employee) {
                $body = '';
                $saludo = date('G') < 6 || date('G') > 19 ? 'Buenas noches' : (date('G') >= 6 && date('G') < 12 ? 'Buenos días' : 'Buenas tardes');
                $email = '';
                $subject = '';
                $name = '';
                if ($evaluation_employee->status == 1) {
                    $url = base_url . 'evaluacionempleado/ver&id=' . Encryption::encode($id_evaluation_employee);
                    $body = "<p>" . $saludo . ", " . $evaluation_employee->first_name_boss . " " . $evaluation_employee->surname_boss . "</p><p>Se le invita a realizar la evaluación " . $evaluation_employee->name . " de " . $evaluation_employee->first_name . " " . $evaluation_employee->surname . ". Puede acceder a la evaluacion con el siguiente enlace</p><a href='" . $url . "' style='background-color: #4CAF50;
                    border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;'>Realizar evaluación<a/>";
                    $email = $evaluation_employee->boss_email;
                    $subject = 'Realización de la evaluación ' . $evaluation_employee->name . ' de ' . $evaluation_employee->first_name . ' ' . $evaluation_employee->surname;
                    $name = $evaluation_employee->first_name_boss . ' ' . $evaluation_employee->surname_boss;
                } elseif ($evaluation_employee->status == 2) {
                    $url = base_url . 'evaluacionempleado/ver&id=' . Encryption::encode($id_evaluation_employee);
                    $body = "<p>" . $saludo . ", " . $evaluation_employee->first_name_boss . " " . $evaluation_employee->surname_boss . "</p><p>Se le invita a realizar la retroalimentación de la evaluación " . $evaluation_employee->name . " de " . $evaluation_employee->first_name . " " . $evaluation_employee->surname . ". Puede acceder a ella con el siguiente enlace</p><a href='" . $url . "' style='background-color: #4CAF50;
                        border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;'>Realizar retroalimentación<a/>";
                    $email = $evaluation_employee->boss_email;
                    $subject = 'Retroalimentación de la evaluación ' . $evaluation_employee->name . ' de ' . $evaluation_employee->first_name . ' ' . $evaluation_employee->surname;
                    $name = $evaluation_employee->first_name_boss . ' ' . $evaluation_employee->surname_boss;
                } elseif ($evaluation_employee->status == 3) {
                    $url = base_url . 'evaluacionempleado/ver&id=' . Encryption::encode($id_evaluation_employee);
                    $body = "<p>" . $saludo . ", " . $evaluation_employee->first_name . " " . $evaluation_employee->surname . "</p><p>Se le invita a consultar su evaluación " . $evaluation_employee->name . ". Puede acceder a ella con el siguiente enlace</p><a href='" . $url . "' style='background-color: #4CAF50;
                        border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;'>Ver evaluación<a/>";
                    $email = $evaluation_employee->employee_email;
                    $subject = 'Consulta tu evaluación ' . $evaluation_employee->name;
                    $name = $evaluation_employee->first_name . ' ' . $evaluation_employee->surname;
                }

                Utils::sendEmail($email, $name, $subject, $body);

                echo json_encode(array('status' => 1));
            } else
                echo json_encode(array('status' => 2));
        } else
            echo json_encode(array('status' => 0));
    }



    // ===[gabo 15 mayo evaluaciones]===

    public function delete_group()
    {
        if (isset($_POST['id_group'])) {
            $id_group = Encryption::decode($_POST['id_group']);
            if ($id_group) {
                $group = new GroupEvaluation();
                $group->setId_group($id_group);
                $id_contact = $group->getOne()->id_contact;

                $deleted = $group->delete();
                $deleted = true;


                if ($deleted) {

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
        } else
            echo json_encode(array('status' => 0));
    }




    public function delete_evaluation()
    {
        if ($_POST['id_evaluation']) {
            $id = Encryption::decode($_POST['id_evaluation']);
            if ($id) {

                $evaluation = new EvaluationEmployee();
                $evaluation->setId($id);
                $evaluacion = $evaluation->getOne();
                $flag = $evaluation->delete_evaluation();

                if ($flag) {

                    $employee = new GroupEvaluation();
                    $employee->setId_group($evaluacion->id_group_evaluation);
                    $evaluations = $employee->getEvaluationsByIdGroup();

                    for ($i = 0; $i < count($evaluations); $i++) {
                        $evaluations[$i]['id'] =   Encryption::encode($evaluations[$i]['id']);
                        $evaluations[$i]['start_date'] = Utils::getDate($evaluations[$i]['start_date']);
                        $evaluations[$i]['end_date']  = Utils::getDate($evaluations[$i]['end_date']);
                        $evaluations[$i]['date_of_realization']  = ($evaluations[$i]['date_of_realization'] != "") ? Utils::getDate($evaluations[$i]['date_of_realization']) : '';

                        $evaluations[$i]['status'] = $evaluations[$i]['status'] == 1 ? 'Enviada' : ($evaluations[$i]['status'] == 2 ? 'Contestada' : ($evaluations[$i]['status'] == 3 ? 'Retroalimentada' : 'Firmada'));
                        $evaluations[$i]['url'] =  base_url . "evaluacionempleado/ver2&id={$evaluations[$i]['id']}";
                    }

                    echo json_encode(array('status' => 1, 'evaluations' => $evaluations));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    // ===[gabo 15 mayo evaluaciones ]===
    public function feedback2()
    {
        if ($_POST['id_evaluation_employee']) {

            $open_questions = array();
            foreach ($_POST as $key => $value) {
                /*   if (strstr($key, 'open'))
                    array_push($open_questions, array('id_open_question' => str_replace('open', '', $key), 'answer' => Utils::sanitizeStringBlank($value))); */
                // ===[gabo 29 de mayo feedback ]===
                if (strstr($key, 'question'))
                    array_push($open_questions, array('id_open_question' => str_replace('question', '', $key), 'answer' => Utils::sanitizeStringBlank($value)));
                // ===[gabo 29 de mayo feedback fin]===
            }

            $id_evaluation_employee = Utils::sanitizeNumber(Encryption::decode($_POST['id_evaluation_employee']));
            $email = $_POST['email_boss'] != '' ? Utils::sanitizeEmail($_POST['email_boss']) : Utils::sanitizeEmail($_POST['email_input']);

            for ($j = 0; $j < count($open_questions); $j++) {
                $employeeOpenQuestion[$j] = new EvaluationOpenQuestionsEmployee();
                $employeeOpenQuestion[$j]->setId_open_question($open_questions[$j]['id_open_question']);
                $employeeOpenQuestion[$j]->setAnswer($open_questions[$j]['answer']);
                $employeeOpenQuestion[$j]->setId_evaluation_employee($id_evaluation_employee);
                $employeeOpenQuestion[$j]->save();
            }

            $evaluationEmployee = new EvaluationEmployee();
            $evaluationEmployee->setId($id_evaluation_employee);
            $evaluationEmployee->setStatus(3);
            $evaluationEmployee->setEmployee_email($email);
            $complete = $evaluationEmployee->evaluationFeedback();
            $token = $evaluationEmployee->getToken_sign();
            $evaluation_employee = $evaluationEmployee->getOne();
            if ($complete) {
                $openQuestion = new OpenQuestions();
                $openQuestion->setStatus(2);
                $employeeOpenQuestion = new EvaluationOpenQuestionsEmployee();
                $employeeOpenQuestion->setId_evaluation_employee($id_evaluation_employee);
                $open_questions_feedback = $employeeOpenQuestion->getOpenQuestionByIdAndStatus($openQuestion);
                $opf = '';
                foreach ($open_questions_feedback as $op)
                    $opf .= "<b>" . $op['question'] . "</b><p>" . $op['answer'] . "</p><br>";

                $url = base_url . 'evaluacionempleado/ver2&id=' . Encryption::encode($id_evaluation_employee) . '&token=' . $token;

                $body = "<p>Se anexa lo visto en la retroalimentación.</p>" . $opf . "<p>Para consultar tu evaluación e indicar de enterado, da clic en el botón</p><a href='" . $url . "' style='background-color: #4CAF50;
                border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;'>Ver evaluación<a/>";

                Utils::sendEmail($email, $evaluation_employee->first_name . ' ' . $evaluation_employee->surname, 'Retroalimentación ' . $evaluation_employee->name, $body);

                echo json_encode(array('status' => 1));
            } else
                echo json_encode(array('status' => 2));
        } else
            echo json_encode(array('status' => 0));
    }


    // // ===[gabo 15 junio excel evaluaciones pt3]=== ULISES TIENE QUE ACTUALIZAR
    public function getDatesGroupsEvaluation()
    {
        if (isset($_POST['id_evaluation'])) {
            $id_evaluation = Utils::sanitizeNumber($_POST['id_evaluation']);

            if ($id_evaluation) {

                $evaluation = new EvaluationEmployee();
                $evaluation->setId_evaluation($id_evaluation);
                //===[gabo 9 junio excel evaluaciones]===

                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

                //===[gabo 19 julio cliente session]===
                $evaluation->setID_Cliente($_SESSION['id_cliente']);
                $groups = $evaluation->getGroupsByID_Cliente();
                //===[gabo 19 julio cliente session fin]===

                //===[gabo 15 junio excel evaluaciones pt3]===

                for ($i = 0; $i < count($groups); $i++) {
					$groups[$i]['start_date_noformat'] = date('Y-m-d', strtotime($groups[$i]['start_date']));
                    $groups[$i]['end_date_noformat']  = date('Y-m-d', strtotime($groups[$i]['end_date']));
                    $groups[$i]['start_date'] = Utils::getDate($groups[$i]['start_date']);
                    $groups[$i]['end_date']  = Utils::getDate($groups[$i]['end_date']);
                }

                echo json_encode(array('status' => 1, 'groups' => $groups));
            } else
                echo json_encode(array('status' => 2));
        } else
            echo json_encode(array('status' => 2));
    }
}
