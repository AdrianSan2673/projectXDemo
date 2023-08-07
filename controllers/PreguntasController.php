<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/EvaluationCategory.php';
require_once 'models/RH/Questions.php';
require_once 'models/RH/CategoryCriterion.php';
require_once 'models/RH/CriterionScore.php';


class PreguntasController
{
    function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : '';

            $id_criterion = Encryption::decode($_POST['id_criterion'])!=false?Encryption::decode($_POST['id_criterion']):'0';
            $question = isset($_POST['question']) ? Utils::sanitizeStringBlank($_POST['question']) : null;
            $definition = isset($_POST['definition']) ? Utils::sanitizeStringBlank($_POST['definition']) : null;

            $flag = $_POST['flag'];
            
            if ($question && $flag) {

                $questionsObj = new Questions();
                $questionsObj->setId($id);
                $questionsObj->setId_criterion($id_criterion);
                $questionsObj->setQuestion($question);
                $questionsObj->setDefinition($definition);
                $questionsObj->setStatus(1);


                if ($flag == 1) {
                    $questionsObj->save();
                } else {
                    $questionsObj->update();
                    $id_criterion = $questionsObj->getOne()->id_criterion;
                    $questionsObj->setId_criterion($id_criterion);
                }

                $categoryCriterionObj = new CategoryCriterion();
                $categoryCriterionObj->setId($id_criterion);
                $id_category = $categoryCriterionObj->getOne()->id_category;

                $CriterionScoreObj = new CriterionScore();
                $CriterionScoreObj->setId_criterion($id_criterion);
                $CriterionScoreObj->setStatus(1);
                $counCriterion = $CriterionScoreObj->getAllByIdCriterion();

                $td = '';
                if (count($counCriterion) > 0) {
                    for ($i = 0; $i < count($counCriterion); $i++) {
                        $td .= '<td></td>';
                    }
                }

                $questions = $questionsObj->getAllByIdCriterion();

                for ($i = 0; $i < count($questions); $i++) {
                    $questions[$i]['id'] = Encryption::encode($questions[$i]['id']);
                }

                echo json_encode(array(
                    'status' => 1,
                    'questions' => $questions,
                    'id_criterion' => $id_criterion,
                    'id_category' => $id_category,
                    'td' => $td,
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
                $questionObj = new Questions();
                $questionObj->setId($id);
                $question = $questionObj->getOne();
                $question->id = Encryption::encode($question->id);

                echo json_encode(array(
                    'status' => 1,
                    'question' => $question
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $questionObj = new Questions();
                $questionObj->setId($id);
                $questionObj->setStatus(0);

                $id_criterion = $questionObj->getOne()->id_criterion;

                $questionObj->updateDelete();

                $questionObj->setId_criterion($id_criterion);
                $questionObj->setStatus(1);

                $categoryCriterionObj = new CategoryCriterion();
                $categoryCriterionObj->setId($id_criterion);
                $id_category = $categoryCriterionObj->getOne()->id_category;

                $CriterionScoreObj = new CriterionScore();
                $CriterionScoreObj->setId_criterion($id_criterion);
                $CriterionScoreObj->setStatus(1);
                $counCriterion = $CriterionScoreObj->getAllByIdCriterion();

                $td = '';
                if (count($counCriterion) > 0) {
                    for ($i = 0; $i < count($counCriterion); $i++) {
                        $td .= '<td></td>';
                    }
                }

                $questions = $questionObj->getAllByIdCriterion();

                for ($i = 0; $i < count($questions); $i++) {
                    $questions[$i]['id'] = Encryption::encode($questions[$i]['id']);
                }


                echo json_encode(array(
                    'status' => 1,
                    'questions' => $questions,
                    'id_criterion' => $id_criterion,
                    'id_category' => $id_category,
                    'td' => $td,
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
