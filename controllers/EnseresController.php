<?php

require_once 'models/SA/Enseres.php';

class EnseresController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $enseres = new Enseres();
                $enseres->setCandidato($Candidato);
                $data = $enseres->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Computadoras = Utils::sanitizeNumber($_POST['Computadoras']);
            $Pantallas = Utils::sanitizeNumber($_POST['Pantallas']);
            $Laptop = Utils::sanitizeNumber($_POST['Laptop']);
            $Impresoras = Utils::sanitizeNumber($_POST['Impresoras']);
            $Refrigerador = Utils::sanitizeNumber($_POST['Refrigerador']);
            $Estufa = Utils::sanitizeNumber($_POST['Estufa']);
            $Aire_Acondicionado = Utils::sanitizeNumber($_POST['Aire_Acondicionado']);
            $Lavadora = Utils::sanitizeNumber($_POST['Lavadora']);
            $Secadora = Utils::sanitizeNumber($_POST['Secadora']);
            $Otros = Utils::sanitizeStringBlank($_POST['Otros']);
            $Mobiliario = Utils::sanitizeNumber($_POST['Mobiliario']);
            $Comentarios = Utils::sanitizeStringBlank($_POST['Comentarios']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $enseres = new Enseres();
                $enseres->setCandidato($Candidato);
                $enseres->setComputadoras($Computadoras);
                $enseres->setPantallas($Pantallas);
                $enseres->setLaptop($Laptop);
                $enseres->setImpresoras($Impresoras);
                $enseres->setRefrigerador($Refrigerador);
                $enseres->setEstufa($Estufa);
                $enseres->setAire_Acondicionado($Aire_Acondicionado);
                $enseres->setLavadora($Lavadora);
                $enseres->setSecadora($Secadora);
                $enseres->setOtros($Otros);
                $enseres->setMobiliario($Mobiliario);
                $enseres->setComentarios($Comentarios);
                
                if ($flag == 1)
                    $save = $enseres->update();
                else
                    $save = $enseres->create();
                    
                if ($save) {
                    $enseres = $enseres->getOne();
                    $enseres->status = 1;
                    echo json_encode($enseres);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}