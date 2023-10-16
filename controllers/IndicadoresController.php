<?php
require_once 'models/RH/Positions.php';
require_once 'models/RH/EffectivenessIndicatiors.php';

class IndicadoresController
{
    public function save()
    {
        $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
        $indicator = Utils::sanitizeStringBlank($_POST['indicator']);
        $flag = $_POST['flag'];

        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if ($id_position) {
                $effectivenessIndicatiors = new EffectivenessIndicatiors();
                $effectivenessIndicatiors->setId_position($id_position);
                $effectivenessIndicatiors->setIndicator($indicator);

                if ($flag == 1) {
                    $effectivenessIndicatiors->save();
                } else {
                    $effectivenessIndicatiors->setId(Encryption::decode($_POST['id_indicator']));
                    $effectivenessIndicatiors->update();
                }
                $indications =  $effectivenessIndicatiors->getAllByIdPosition();

                for ($i = 0; $i < count($indications); $i++) {
                    $indications[$i]['id'] = Encryption::encode($indications[$i]['id']);
                    $indications[$i]['id_position'] = Encryption::encode($indications[$i]['id_position']);
                }

                echo json_encode(array(
                    'indications' => $indications,
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
                $effectivenessIndicatiors = new EffectivenessIndicatiors();
                $effectivenessIndicatiors->setId($id);
                $effectivenessIndicatiors = $effectivenessIndicatiors->getOne();
                $effectivenessIndicatiors->id = Encryption::encode($effectivenessIndicatiors->id);
                echo json_encode($effectivenessIndicatiors);
            } else echo 0;
        } else echo 0;
    }



    public function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
            if ($id&&$id_position) {
                $effectivenessIndicatiors = new EffectivenessIndicatiors();
                $effectivenessIndicatiors->setId($id);
                $effectivenessIndicatiors->delete();

                $effectivenessIndicatiors->setId_position($id_position);
                $effectivenessIndicatiors = $effectivenessIndicatiors->getAllByIdPosition();

                for ($i = 0; $i < count($effectivenessIndicatiors); $i++) {
                    $effectivenessIndicatiors[$i]['id'] = Encryption::encode($effectivenessIndicatiors[$i]['id']);
                }

                echo json_encode(array(
                    'indications' => $effectivenessIndicatiors,
                    'id_position' => Encryption::encode($id_position),
                    'status' => 1
                ));
            } else  echo json_encode(array('status' => 0));
        } else echo json_encode(array('status' => 0));
    }





}
