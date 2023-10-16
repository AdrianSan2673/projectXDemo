<?php

require_once 'models/SA/DiasFestivos.php';
require_once 'models/FestiveDays.php';

class DiasInhabilesController{

    public function saveDay()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && $_POST) {
            //$id = Utils::sanitizeNumber($_POST['id']);
            $Fecha = isset($_POST['date'])? Utils::sanitizeString($_POST['date']):null;


            if ($Fecha) {
                $diasFestivos = new Festivos();    
                $diasFestivos->setFecha($Fecha);

                $NotWorkingObj = new Festive();
                $NotWorkingObj->setNdays($Fecha);
                
                $save = $diasFestivos->save();
                $save2 = $NotWorkingObj->save();

                if ( $save &&  $save2) {
                    echo json_encode(array('status' => 1));

            } else {
                echo json_encode(array('status' => 0));
            }
        } else
            echo json_encode(array('status' => 2));
    }
    
}}