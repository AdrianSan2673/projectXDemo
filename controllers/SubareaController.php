<?php

require_once 'models/Subarea.php';

class SubareaController{
    
    public function getSubareasByArea(){
        if (isset($_POST) && $_POST != FALSE) {
            $area = isset($_POST['area']) ? trim($_POST['area']) : FALSE;
            if ($area) {
                $subarea = new Subarea();
                $subarea->setId_area($area);
                $subareas = $subarea->getSubareasByArea();
                header('Content-Type: text/html; charset=utf-8');
                echo $json_subareas = json_encode($subareas, \JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
    }
}