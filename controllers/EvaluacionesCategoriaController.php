<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/Evaluations.php';
require_once 'models/RH/EvaluationCategory.php';
require_once 'models/RH/CategoryCriterion.php';
require_once 'models/RH/CriterionScore.php';


class EvaluacionesCategoriaController
{

    function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : null;
            $id_evaluation = Encryption::decode($_POST['id_evaluation']);
            $category = isset($_POST['category']) ? Utils::sanitizeStringBlank($_POST['category']) : null;
            $description = isset($_POST['description']) ? Utils::sanitizeStringBlank($_POST['description']) : '';
            $flag = $_POST['flag'];


            if ($id_evaluation && $category) {
                $evaluationCategoryObj = new EvaluationCategory();
                $evaluationCategoryObj->setId($id);
                $evaluationCategoryObj->setId_evaluation($id_evaluation);
                $evaluationCategoryObj->setStatus(1);
                $evaluationCategoryObj->setCategory($category);
                $evaluationCategoryObj->setDescription($description);

                if ($flag == 1) {

                    $fetch =  $evaluationCategoryObj->save();

                    $id_category = $evaluationCategoryObj->getId();

                    $categoryCriterionObj = new CategoryCriterion();
                    $categoryCriterionObj->setCriterion('Criterio');
                    $categoryCriterionObj->setId_category($id_category);
                    $categoryCriterionObj->save();

                    //$criterionScoreArray = array('Nunca', 'Algunas veces', 'Cumple expectativas', 'Sobresaliente');
                      $criterionScoreArray = array('NUNCA', 'ALGUNAS VECES', 'CUMPLE EXPECTATIVAS', 'SOBRESALIENTE');

                    for ($i = 0; $i < count($criterionScoreArray); $i++) {
                        $criterionScoreObj = new CriterionScore();
                        $criterionScoreObj->setId($id);
                        $criterionScoreObj->setId_criterion($categoryCriterionObj->getId());
                        $criterionScoreObj->setName($criterionScoreArray[$i]);
                        $criterionScoreObj->setValue($i + 1);
                        $criterionScoreObj->setStatus(1);
                        $criterionScoreObj->save();
                    }
 
                } else {
                    $id_category = $id;
                    $fetch = $evaluationCategoryObj->update();
                }

                if ($fetch) {
                    //$evaluationCategory = $this->formatHTML($evaluationCategoryObj->getAllByIdEvaluation());
                    $evaluationCategory = $this->formatHTML2($id_evaluation);

                    echo json_encode(array(
                        'status' => 1,
                        'evaluationCategory' => $evaluationCategory
                    ));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_category = Encryption::decode($_POST['id']);
            if ($id_category) {
                $evaluationCategoryObj = new EvaluationCategory();
                $evaluationCategoryObj->setId($id_category);
                $evaluationCategoryObj->setStatus(0);

                $id_evaluation = $evaluationCategoryObj->getOne()->id_evaluation;
                $evaluationCategoryObj->setId_evaluation($id_evaluation);

                $fetch = $evaluationCategoryObj->updateDeleteCategory();

                $evaluationCategoryObj->setStatus(1);

                if ($fetch) {
                    //$evaluationCategory = $this->formatHTML($evaluationCategoryObj->getAllByIdEvaluation());

                    $evaluationCategory = $this->formatHTML2($id_evaluation);

                    echo json_encode(array(
                        'status' => 1,
                        'evaluationCategory' => $evaluationCategory
                    ));
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
                $evaluationCategoryObj = new EvaluationCategory();
                $evaluationCategoryObj->setId($id);
                $evaluationCategory = $evaluationCategoryObj->getOne();

                $evaluationCategory->id = Encryption::encode($evaluationCategory->id);

                echo json_encode(array(
                    'status' => 1,
                    'evaluationCategory' => $evaluationCategory
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public  function formatHTML($evaluationCategoryObj)
    {

        $evaluationCategory = $evaluationCategoryObj;

        for ($i = 0; $i < count($evaluationCategory); $i++) {
            $evaluationCategory[$i]['created_at'] = Utils::getDate($evaluationCategory[$i]['created_at']);
            $evaluationCategory[$i]['modified_at'] = Utils::getDate($evaluationCategory[$i]['modified_at']);
            $evaluationCategory[$i]['id_criterion_encryption'] = Encryption::encode($evaluationCategory[$i]['id_criterion']);
            $evaluationCategory[$i]['id_category_encryption'] = Encryption::encode($evaluationCategory[$i]['id']);
            $evaluationCategory[$i]['criterionScoreColums'] = '';
            $evaluationCategory[$i]['th'] = '';
            $evaluationCategory[$i]['questionsRows'] = '';
            $evaluationCategory[$i]['tr'] = '';
            $td = '';

            if (isset($evaluationCategory[$i]['id_criterion'])) {
                $evaluationCategory[$i]['criterionScoreColums'] = Utils::getCriterionScoreByIdCriterion($evaluationCategory[$i]['id_criterion']);

                for ($j = 0; $j < count($evaluationCategory[$i]['criterionScoreColums']); $j++) {
                    $evaluationCategory[$i]['criterionScoreColums'][$j]['id'] = Encryption::encode($evaluationCategory[$i]['criterionScoreColums'][$j]['id']);

                    $evaluationCategory[$i]['th'] .= "
                    <th>
                        {$evaluationCategory[$i]['criterionScoreColums'][$j]['name']}
                        <div class='row float-right'>
                          <div class='col-6'>
                            <button class='btn btn-info btn_update_criterion_score' value='" . $evaluationCategory[$i]['criterionScoreColums'][$j]['id'] . "'><i class='fas fa-edit'></i></button>
                          </div>

                          <div class='col-6'>
                            <button class='btn btn-danger text-bold btn_delete_criterion_score' value='" . $evaluationCategory[$i]['criterionScoreColums'][$j]['id'] . "'>X</button>
                          </div>
                        </div>
                    </th>";
                }


                if (count($evaluationCategory[$i]['criterionScoreColums']) > 0) {
                    for ($j = 0; $j < count($evaluationCategory[$i]['criterionScoreColums']); $j++) {
                        $td .= '<td></td>';
                    }
                }

                $evaluationCategory[$i]['questionsRows'] = Utils::getQuestionsCriterionByIdCriterion($evaluationCategory[$i]['id_criterion']);
                for ($j = 0; $j < count($evaluationCategory[$i]['questionsRows']); $j++) {

                    $evaluationCategory[$i]['questionsRows'][$j]['id'] = Encryption::encode($evaluationCategory[$i]['questionsRows'][$j]['id']);
                    $hidden = $evaluationCategory[$i]['questionsRows'][$j]['definition'] == '' ? 'hidden' : '';

                    $evaluationCategory[$i]['tr'] .= "
                    <tr>
                        <th>
                            {$evaluationCategory[$i]['questionsRows'][$j]['question']}
                            <small class='badge badge-dark' data-toggle='tooltip' data-placement='top' title='{$evaluationCategory[$i]['questionsRows'][$j]['definition']}' {$hidden}>
                              <i class='fas fa-question'></i>
                            </small>

                            <div class='row float-right'>
                              <div class='col-6'>
                                <button class='btn btn-info btn_update_question' value='{$evaluationCategory[$i]['questionsRows'][$j]['id']}'><i class='fas fa-edit'></i></button>
                              </div>

                              <div class='col-6'>
                                <button class=' btn btn-danger text-bold btn_delete_question' value='{$evaluationCategory[$i]['questionsRows'][$j]['id']}'>X</button>
                              </div>
                            </div>
                        </th>
                        {$td}
                    </tr>";
                }
            }
        }

        return   $evaluationCategory;
    }

    public  function formatHTML2($id_evaluation)
    {
        $evaluationCategoryObj = new EvaluationCategory();
        $evaluationCategoryObj->setId_evaluation($id_evaluation);
        $evaluationCategoryObj->setStatus(1);
        $evaluationAll = $evaluationCategoryObj->getAllByIdEvaluation();

        for ($u = 0; $u < count($evaluationAll); $u++) {

            $evaluationAll[$u]['getCriterionsCategory']  = Utils::getAllCriterionsByIdCategory($evaluationAll[$u]['id']);
            $evaluationAll[$u]['id_category_encryption']=Encryption::encode($evaluationAll[$u]['id']);


            for ($i = 0; $i < count($evaluationAll[$u]['getCriterionsCategory']); $i++) {
                $evaluationAll[$u]['getCriterionsCategory'][$i]['id_criterion_encryption'] = Encryption::encode($evaluationAll[$u]['getCriterionsCategory'][$i]['id']);
                $evaluationAll[$u]['getCriterionsCategory'][$i]['id_category_encryption'] = Encryption::encode($evaluationAll[$u]['getCriterionsCategory'][$i]['id_category']);
                $evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums'] = '';
                $evaluationAll[$u]['getCriterionsCategory'][$i]['th'] = '';
                $evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'] = '';
                $evaluationAll[$u]['getCriterionsCategory'][$i]['tr'] = '';
                $td = '';

                if (isset($evaluationAll[$u]['getCriterionsCategory'][$i]['id'])) {
                    $evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums'] = Utils::getCriterionScoreByIdCriterion($evaluationAll[$u]['getCriterionsCategory'][$i]['id']);

                    for ($j = 0; $j < count($evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums']); $j++) {
                        $evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums'][$j]['id'] = Encryption::encode($evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums'][$j]['id']);

                        $evaluationAll[$u]['getCriterionsCategory'][$i]['th'] .= "                      
                         <th>
                         {$evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums'][$j]['name']}
                         <div class='row float-right'>
                           <div class='col-6'>
                           <button class='btn btn-info btn_update_criterion_score' value='" . $evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums'][$j]['id'] . "'><i class='fas fa-edit'></i></button>
                           </div>

                           <div class='col-6'>
                           <button class='btn btn-danger text-bold btn_delete_criterion_score' value='" . $evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums'][$j]['id'] . "'>X</button>
                           </div>
                         </div>
                       </th>";
                    }


                    if (count($evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums']) > 0) {
                        for ($j = 0; $j < count($evaluationAll[$u]['getCriterionsCategory'][$i]['criterionScoreColums']); $j++) {
                            $td .= '<td></td>';
                        }
                    }

                    $evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'] = Utils::getQuestionsCriterionByIdCriterion($evaluationAll[$u]['getCriterionsCategory'][$i]['id']);

                    for ($j = 0; $j < count($evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows']); $j++) {

                        $evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'][$j]['id'] = Encryption::encode($evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'][$j]['id']);
                        $hidden = $evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'][$j]['definition'] == '' ? 'hidden' : '';

                        $evaluationAll[$u]['getCriterionsCategory'][$i]['tr'] .= "
                     <tr>
                         <th>
                             {$evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'][$j]['question']}
                             <small class='badge badge-dark' data-toggle='tooltip' data-placement='top' title='{$evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'][$j]['definition']}' {$hidden}>
                               <i class='fas fa-question'></i>
                             </small>

                             <div class='row float-right'>
                               <div class='col-6'>
                                 <button class='btn btn-info btn_update_question' value='{$evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'][$j]['id']}'><i class='fas fa-edit'></i></button>
                               </div>

                               <div class='col-6'>
                                 <button class=' btn btn-danger text-bold btn_delete_question' value='{$evaluationAll[$u]['getCriterionsCategory'][$i]['questionsRows'][$j]['id']}'>X</button>
                               </div>
                             </div>
                         </th>
                         {$td}
                     </tr>";
                    }
                }
            }
        }


        return   $evaluationAll;
    }
}
