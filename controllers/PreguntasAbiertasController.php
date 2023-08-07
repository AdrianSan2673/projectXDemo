<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/EvaluationCategory.php';
require_once 'models/RH/Questions.php';
require_once 'models/RH/CategoryCriterion.php';
require_once 'models/RH/CriterionScore.php';
require_once 'models/RH/OpenQuestions.php';


class PreguntasAbiertasController
{
    function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : null;
            $id_evaluation = isset($_POST['id_evaluation']) ? Encryption::decode($_POST['id_evaluation']) : '';
            $question = isset($_POST['question']) && $_POST['question'] != '' ? Utils::sanitizeStringBlank($_POST['question']) : '';
            $status = isset($_POST['status']) && $_POST['status'] != '' ? Utils::sanitizeStringBlank($_POST['status']) : '';

            $flag = $_POST['flag'];
            if ($id_evaluation && $question && $flag) {
                $openQuestionsObj = new OpenQuestions();
                $openQuestionsObj->setId_evaluation($id_evaluation);
                $openQuestionsObj->setQuestion($question);
                $openQuestionsObj->setStatus($status);


                $result = '';
                if ($flag == 1)
                    $result = $openQuestionsObj->save();
                else if ($flag == 2) {
                    $openQuestionsObj->setId($id);
                    $result = $openQuestionsObj->update();
                }

                if ($result) {
                    $openQuestions = $openQuestionsObj->getAllByIdEvalaution();
                    for ($i = 0; $i < count($openQuestions); $i++) {
                        $openQuestions[$i]['id'] = Encryption::encode($openQuestions[$i]['id']);
                    }

                    $id_question_js = $status == 1 ? 'all_open_questions' : 'all_open_questions_feedback';

                    echo json_encode(array(
                        'status' => 1,
                        'openQuestions' => $openQuestions,
                        'id_question_js' => $id_question_js
                    ));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    function dalete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_question = isset($_POST['id']) ? Encryption::decode($_POST['id']) : null;
            if ($id_question) {

                $openQuestionsObj = new OpenQuestions();
                $openQuestionsObj->setId($id_question);
                $openQuestionsObj->setStatus(0);

                $id_evaluation = $openQuestionsObj->getOne()->id_evaluation;
                $status = $openQuestionsObj->getOne()->status;

                $openQuestionsObj->setId_evaluation($id_evaluation);

                $openQuestionsObj->updateDelete();
                $openQuestionsObj->setStatus($status);

                $id_question_js = $status == 1 ? 'all_open_questions' : 'all_open_questions_feedback';


                $openQuestions = $openQuestionsObj->getAllByIdEvalaution();
                for ($i = 0; $i < count($openQuestions); $i++) {
                    $openQuestions[$i]['id'] = Encryption::encode($openQuestions[$i]['id']);
                }
                echo json_encode(array(
                    'status' => 1,
                    'openQuestions' => $openQuestions,
                    'id_question_js' => $id_question_js
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    function getOne()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_question = isset($_POST['id']) ? Encryption::decode($_POST['id']) : null;
            if ($id_question) {
                $openQuestionsObj = new OpenQuestions();
                $openQuestionsObj->setId($id_question);
                $openQuestion = $openQuestionsObj->getOne();


                echo json_encode(array(
                    'status' => 1,
                    'openQuestion' => $openQuestion
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
