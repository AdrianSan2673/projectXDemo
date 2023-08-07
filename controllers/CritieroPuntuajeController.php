<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/Evaluations.php';
require_once 'models/RH/EvaluationCategory.php';
require_once 'models/RH/CategoryCriterion.php';
require_once 'models/RH/CriterionScore.php';
require_once 'models/RH/Questions.php';


class CritieroPuntuajeController
{

    function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : '';
            $id_criterion =  Encryption::decode($_POST['id_criterion']) ;
            $name = isset($_POST['name']) ? Utils::sanitizeStringBlank($_POST['name']) : null;
            $value = isset($_POST['value']) ? Utils::sanitizeNumber($_POST['value']) : null;
            $flag = $_POST['flag'];

            if ($name && ($value||$value==0) && $flag) {
                   
                    $criterionScoreObj = new CriterionScore();
                    $criterionScoreObj->setId($id);
                    $criterionScoreObj->setId_criterion($id_criterion);
                    $criterionScoreObj->setName($name);
                    $criterionScoreObj->setValue($value);
                    $criterionScoreObj->setStatus(1);

                    if ($flag == 1) {
                        $criterionScoreObj->save();
                    } else {
                        $criterionScoreObj->update();
                        $id_criterion =  $criterionScoreObj->getOne()->id_criterion;
                        $criterionScoreObj->setId_criterion($id_criterion);
                    }

                    $categoryCriterionObj = new CategoryCriterion();
                    $categoryCriterionObj->setId($id_criterion);
                    $id_category = $categoryCriterionObj->getOne()->id_category;
                    $criterion = $categoryCriterionObj->getOne();
                    $criterion->id = Encryption::encode($criterion->id);

                    $criterionScoreObj->setId_criterion($id_criterion);
                    $criterionsScore = $criterionScoreObj->getAllByIdCriterion();


                    for ($i = 0; $i < count($criterionsScore); $i++) {
                        $criterionsScore[$i]['id'] = Encryption::encode($criterionsScore[$i]['id']);
                    }
                    $questionsObj = new Questions();
                    $questionsObj->setId_criterion($id_criterion);
                    $questionsObj->setStatus(1);

                    $td = '';
                    if (count($criterionsScore) > 0) {
                        for ($i = 0; $i < count($criterionsScore); $i++) {
                            $td .= '<td></td>';
                        }
                    }

                    $questions = $questionsObj->getAllByIdCriterion();
                    for ($i = 0; $i < count($questions); $i++) {
                        $questions[$i]['id'] = Encryption::encode($questions[$i]['id']);
                    }

                    echo json_encode(array(
                        'status' => 1,
                        'criterionsScore' => $criterionsScore,
                        'questions' => $questions,
                        'td' => $td,
                        'criterion' => $criterion,
                        'id_category' => $id_category,
                        'id_criterion' => $id_criterion
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
                $criterionScoreObj = new CriterionScore();
                $criterionScoreObj->setId($id);
                $criterionScore = $criterionScoreObj->getOne();
                $criterionScore->id = Encryption::encode($criterionScore->id);

                echo json_encode(array(
                    'status' => 1,
                    'criterionScore' => $criterionScore
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
                $criterionScoreObj = new CriterionScore();
                $criterionScoreObj->setId($id);
                $criterionScoreObj->setStatus(0);

                $id_criterion = $criterionScoreObj->getOne()->id_criterion;

                $criterionScoreObj->updateDelete();

                $criterionScoreObj->setId_criterion($id_criterion);
                $criterionScoreObj->setStatus(1);


                $categoryCriterionObj = new CategoryCriterion();
                $categoryCriterionObj->setId($id_criterion);
                $id_category = $categoryCriterionObj->getOne()->id_category;
                $criterion = $categoryCriterionObj->getOne();
                $criterion->id = Encryption::encode($criterion->id);


                $criterionScoreObj->setId_criterion($id_criterion);
                $criterionsScore = $criterionScoreObj->getAllByIdCriterion();


                for ($i = 0; $i < count($criterionsScore); $i++) {
                    $criterionsScore[$i]['id'] = Encryption::encode($criterionsScore[$i]['id']);
                }
                $questionsObj = new Questions();
                $questionsObj->setId_criterion($id_criterion);
                $questionsObj->setStatus(1);


                $td = '';
                if (count($criterionsScore) > 0) {
                    for ($i = 0; $i < count($criterionsScore); $i++) {
                        $td .= '<td></td>';
                    }
                }

                $questions = $questionsObj->getAllByIdCriterion();

                for ($i = 0; $i < count($questions); $i++) {
                    $questions[$i]['id'] = Encryption::encode($questions[$i]['id']);
                }



                echo json_encode(array(
                    'status' => 1,
                    'criterionsScore' => $criterionsScore,
                    'questions' => $questions,
                    'td' => $td,
                    'criterion' => $criterion,
                    'id_category' => $id_category,
                    'id_criterion' => $id_criterion
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
