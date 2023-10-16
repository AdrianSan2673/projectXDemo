<?php

require_once 'models/Subarea.php';
require_once 'models/Area.php';

class SubareaController
{

    public function getSubareasByArea()
    {
        if (isset($_POST) && $_POST != FALSE) {
            $area = isset($_POST['area']) ? trim($_POST['area']) : FALSE;
            if ($area) {
                $subarea = new Subarea();
                $subarea->setId_area($area);
                $subareas = $subarea->getSubareasByArea();
                header('Content-Type: text/html; charset=utf-8');
                echo $json_subareas = json_encode($subareas, \JSON_UNESCAPED_UNICODE);
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    //===[gabo 28 julio modulo area]===
    public function getSubareasByIdArea()
    {
        if (isset($_POST) && $_POST != FALSE) {

            $id_area = isset($_POST['id_area']) ?  Encryption::decode(trim($_POST['id_area'])) : FALSE;

            if ($id_area) {
                $subarea = new Subarea();
                $subarea->setId_area($id_area);
                $subareas = $subarea->getSubareasByArea();

                $area = new Area();
                $area->setId($id_area);
                $area = $area->getAreaByIdArea();

                $area->id = Encryption::encode($area->id);

                foreach ($subareas as &$subarea) {
                    $subarea['id'] = Encryption::encode($subarea['id']);
                }

                echo json_encode(
                    array('status' => 1, 'subareas' => $subareas, 'area' => $area)
                );
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }


    public function HideSubarea()
    {
        if (isset($_POST) && $_POST != FALSE) {

            $id_subarea = isset($_POST['id_subarea']) ?  Encryption::decode(trim($_POST['id_subarea'])) : FALSE;

            if ($id_subarea) {
                $subarea = new Subarea();
                $subarea->setId($id_subarea);
                $hide = $subarea->HideSubarea();
                $subar = $subarea->getOne();

                if ($hide) {
                    $subarea->setId_area($subar->id_area);
                    $subareas = $subarea->getSubareasByArea();
                    foreach ($subareas as &$subarea) {
                        $subarea['id'] = Encryption::encode($subarea['id']);
                    }
                    echo json_encode(
                        array('status' => 1, 'subareas' => $subareas)
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

    public function save_subarea()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && $_POST) {
            //$id = Utils::sanitizeNumber($_POST['id']);

            $id_area = isset($_POST['id_area']) ? Encryption::decode(Utils::sanitizeString($_POST['id_area'])) : null;
            $subarea = isset($_POST['subarea']) ? Utils::sanitizeString($_POST['subarea']) : null;

            if ($id_area && $subarea) {
                $Subarea =  new Subarea();
                $Subarea->setSubarea($subarea);
                $Subarea->setId_area($id_area);

                $existe = $Subarea->getSubareasBySubarea();

                if (!$existe) {
                    $save = $Subarea->save();
                    $subareas = $Subarea->getSubareasByArea();
                    foreach ($subareas as &$subarea) {
                        $subarea['id'] = Encryption::encode($subarea['id']);
                    }

                    if ($save) {
                        echo json_encode(array('status' => 1, 'subareas' => $subareas));
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

    //===[gabo 28 julio modulo area]===





}
