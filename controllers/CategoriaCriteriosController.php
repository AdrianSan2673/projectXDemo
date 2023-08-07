<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/Evaluations.php';
require_once 'models/RH/EvaluationCategory.php';
require_once 'models/RH/CategoryCriterion.php';
require_once 'models/RH/CriterionScore.php';


class CategoriaCriteriosController
{

    function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id_criterion']);
            $id_category = Encryption::decode($_POST['id_category']);
            $criterion = isset($_POST['criterion']) ? Utils::sanitizeStringBlank($_POST['criterion']) : null;
            $flag = $_POST['flag'];

            if ($id_category && $criterion) {
                $categoryCriterionObj = new CategoryCriterion();
                $categoryCriterionObj->setId($id);
                $categoryCriterionObj->setId_category($id_category);
                $categoryCriterionObj->setCriterion($criterion);


                if ($flag == 2) {
                    $exist = $categoryCriterionObj->getOne();
                    $categoryCriterionObj->setId($exist->id);
                    $categoryCriterionObj->update();

                    $categoryCriterion = $categoryCriterionObj->getOne();
                    //$categoryCriterion->id = Encryption::encode($categoryCriterion->id);
                    $categoryCriterion->id_cirtierion_encryption = Encryption::encode($categoryCriterion->id);
                    $categoryCriterion->id_category_encryption = Encryption::encode($categoryCriterion->id_category);
                    echo json_encode(array('status' => 1, 'categoryCriterion' => $categoryCriterion));
                } else if ($flag == 1) {
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

                    $getCriterionsCategory =  $this->formatHTML($id_category);

                    echo json_encode(array('status' => 3, 'getCriterionsCategory' => $getCriterionsCategory, 'id_category' => $id_category));
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
                $categoryCriterionObj = new CategoryCriterion();
                $categoryCriterionObj->setId($id);
                $categoryCriterion = $categoryCriterionObj->getOne();
                $categoryCriterion->id = Encryption::encode($categoryCriterion->id);
                $categoryCriterion->id_category = Encryption::encode($categoryCriterion->id_category);

                echo json_encode(array(
                    'status' => 1,
                    'categoryCriterion' => $categoryCriterion
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
                $categoryCriterionObj = new CategoryCriterion();
                $categoryCriterionObj->setId($id);
                $categoryCriterionObj->setStatus(0);

                $id_category = $categoryCriterionObj->getOne()->id_category;

                $fetch = $categoryCriterionObj->updateDeleteCriterion();
                $categoryCriterionObj->setStatus(1);

                if ($fetch) {
                    $getCriterionsCategory = $this->formatHTML($id_category);
                    echo json_encode(array(
                        'status' => 1,
                        'getCriterionsCategory' => $getCriterionsCategory
                    ));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }




    public  function formatHTML($id_category)
    {
        $getCriterionsCategory = Utils::getAllCriterionsByIdCategory($id_category);
        for ($i = 0; $i < count($getCriterionsCategory); $i++) {
            $getCriterionsCategory[$i]['id_criterion_encryption'] = Encryption::encode($getCriterionsCategory[$i]['id']);
            $getCriterionsCategory[$i]['id_category_encryption'] = Encryption::encode($getCriterionsCategory[$i]['id_category']);
            $getCriterionsCategory[$i]['criterionScoreColums'] = '';
            $getCriterionsCategory[$i]['th'] = '';
            $getCriterionsCategory[$i]['questionsRows'] = '';
            $getCriterionsCategory[$i]['tr'] = '';
            $td = '';

            if (isset($getCriterionsCategory[$i]['id'])) {
                $getCriterionsCategory[$i]['criterionScoreColums'] = Utils::getCriterionScoreByIdCriterion($getCriterionsCategory[$i]['id']);

                for ($j = 0; $j < count($getCriterionsCategory[$i]['criterionScoreColums']); $j++) {
                    $getCriterionsCategory[$i]['criterionScoreColums'][$j]['id'] = Encryption::encode($getCriterionsCategory[$i]['criterionScoreColums'][$j]['id']);

                    $getCriterionsCategory[$i]['th'] .= "                      
                         <th>
                         {$getCriterionsCategory[$i]['criterionScoreColums'][$j]['name']}
                         <div class='row float-right'>
                           <div class='col-6'>
                           <button class='btn btn-info btn_update_criterion_score' value='" . $getCriterionsCategory[$i]['criterionScoreColums'][$j]['id'] . "'><i class='fas fa-edit'></i></button>
                           </div>

                           <div class='col-6'>
                           <button class='btn btn-danger text-bold btn_delete_criterion_score' value='" . $getCriterionsCategory[$i]['criterionScoreColums'][$j]['id'] . "'>X</button>
                           </div>
                         </div>
                       </th>";
                }


                if (count($getCriterionsCategory[$i]['criterionScoreColums']) > 0) {
                    for ($j = 0; $j < count($getCriterionsCategory[$i]['criterionScoreColums']); $j++) {
                        $td .= '<td></td>';
                    }
                }

                $getCriterionsCategory[$i]['questionsRows'] = Utils::getQuestionsCriterionByIdCriterion($getCriterionsCategory[$i]['id']);

                for ($j = 0; $j < count($getCriterionsCategory[$i]['questionsRows']); $j++) {

                    $getCriterionsCategory[$i]['questionsRows'][$j]['id'] = Encryption::encode($getCriterionsCategory[$i]['questionsRows'][$j]['id']);
                    $hidden = $getCriterionsCategory[$i]['questionsRows'][$j]['definition'] == '' ? 'hidden' : '';

                    $getCriterionsCategory[$i]['tr'] .= "
                     <tr>
                         <th>
                             {$getCriterionsCategory[$i]['questionsRows'][$j]['question']}
                             <small class='badge badge-dark' data-toggle='tooltip' data-placement='top' title='{$getCriterionsCategory[$i]['questionsRows'][$j]['definition']}' {$hidden}>
                               <i class='fas fa-question'></i>
                             </small>

                             <div class='row float-right'>
                               <div class='col-6'>
                                 <button class='btn btn-info btn_update_question' value='{$getCriterionsCategory[$i]['questionsRows'][$j]['id']}'><i class='fas fa-edit'></i></button>
                               </div>

                               <div class='col-6'>
                                 <button class=' btn btn-danger text-bold btn_delete_question' value='{$getCriterionsCategory[$i]['questionsRows'][$j]['id']}'>X</button>
                               </div>
                             </div>
                         </th>
                         {$td}
                     </tr>";
                }
            }
        }


        return   $getCriterionsCategory;
    }
}
