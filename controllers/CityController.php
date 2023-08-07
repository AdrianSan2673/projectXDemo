<?php

require_once 'models/City.php';

class CityController{
    
    public function getCitiesByState(){
        if (isset($_POST) && $_POST != FALSE) {
            $state = isset($_POST['state']) ? trim($_POST['state']) : FALSE;
            if ($state) {
                $city = new City();
                $city->setId_State($state);
                $cities = $city->getCitiesByState();
                header('Content-Type: text/html; charset=utf-8');
                echo $json_cities = json_encode($cities, \JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
    }
}