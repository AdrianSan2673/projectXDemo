<?php

require_once 'models/RH/Positions.php';
require_once 'models/RH/RequiredKnowledge.php';
class ConocimientosRequeridosController
{
    public function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
        $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
        $knowledge = Utils::sanitizeStringBlank($_POST['knowledge']);
        $flag = $_POST['flag'];


            if ($knowledge) {
                $requiredKnowledge = new RequiredKnowledge();
                $requiredKnowledge->setId_position($id_position);
                $requiredKnowledge->setKnowledge($knowledge);

                if ($flag == 1) {
                    $requiredKnowledge->save();
                } else {
                    $requiredKnowledge->setId(Encryption::decode($_POST['id_knowledge']));
                    $requiredKnowledge->update();
                }
                $knowledges =  $requiredKnowledge->getAllByIdPosition();

                for ($i = 0; $i < count($knowledges); $i++) {
                    $knowledges[$i]['id'] = Encryption::encode($knowledges[$i]['id']);
                    $knowledges[$i]['id_position'] = Encryption::encode($knowledges[$i]['id_position']);
                }

                echo json_encode(array(
                    'conocimientos' => $knowledges,
                    'status' => 1
                ));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }


    public function getOne()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $requiredKnowledge = new RequiredKnowledge();
                $requiredKnowledge->setId($id);
                $requiredKnowledge = $requiredKnowledge->getOne();
                $requiredKnowledge->id = Encryption::encode($requiredKnowledge->id);
                echo json_encode($requiredKnowledge);
            } else echo 0;
        } else echo 0;
    }




    public function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));

            if ($id) {
                $requiredKnowledge = new RequiredKnowledge();
                $requiredKnowledge->setId($id);
                $requiredKnowledge->delete();

                $requiredKnowledge->setId_position($id_position);
                $requiredKnowledge = $requiredKnowledge->getAllByIdPosition();

                for ($i = 0; $i < count($requiredKnowledge); $i++) {
                    $requiredKnowledge[$i]['id'] = Encryption::encode($requiredKnowledge[$i]['id']);
                }

                echo json_encode(array(
                    'conocimientos' => $requiredKnowledge,
                    'id_position' => $id_position,
                    'status' => 1
                ));
            } else  echo json_encode(array('status' => 0));
        } else echo json_encode(array('status' => 0));
    }
}
