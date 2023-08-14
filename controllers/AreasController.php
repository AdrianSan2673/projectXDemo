<?php

require_once 'models/Area.php';
require_once 'models/Subarea.php';

class AreasController
{

    public function saveArea()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && $_POST) {
            $area = isset($_POST['area']) ? Utils::sanitizeString($_POST['area']) : null;
            $subarea = isset($_POST['subarea']) ? Utils::sanitizeString($_POST['subarea']) : null;

            if ($area) {

                $AreaPru =  new Area();
                $AreaPru->setArea($area);
                $existe = $AreaPru->getAreasByArea();
                if (!$existe) {

                    $Area = new Area();
                    $Area->setArea($area);
                    $save = $Area->save();
                    $id_area = $Area->getId();


                    if ($save && $subarea) {
                        $subareaObj = new Subarea();
                        $subareaObj->setId_area($id_area);
                        $subareaObj->setSubarea($subarea);
                        $subareaObj->save();
                    }

                    $areas = $Area->getAllAreasAvaiable();
                    foreach ($areas as &$area) {
                        $area['id'] = Encryption::encode($area['id']);
                    }

                     //$save = $subareaObj->save();

                    if ($save) {
                        echo json_encode(array('areas' => $areas, 'status' => 1));
                    } else {
                        echo json_encode(array('status' => 0));
                    }
                } else {
                    echo json_encode(array('status' => 3));
                }
            } else
                echo json_encode(array('status' => 2));
        }
    }

    //===[gabo 31 julio modulo area]===
    public function HideArea()
    {
        if (isset($_POST) && $_POST != FALSE) {

            $id_area = isset($_POST['id_area']) ?  Encryption::decode(trim($_POST['id_area'])) : FALSE;

            if ($id_area) {
                $area = new Area();
                $area->setId($id_area);
                $hide = $area->HideArea();
                $subar = $area->getAreaByIdArea();

                if ($hide) {
                    $areas = $area->getAllAreasAvaiable();
                    foreach ($areas as &$area) {
                        $area['id'] = Encryption::encode($area['id']);
                    }
                    echo json_encode(
                        array('status' => 1, 'areas' => $areas)
                    );
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
    //===[gabo 31 julio modulo area fin]===




}
