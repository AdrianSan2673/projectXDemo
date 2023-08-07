<?php

require_once 'models/SA/ValidacionLicenciaFederal.php';

class ValidacionLicenciaController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $vlf = new ValidacionLicenciaFederal();
                $vlf->setCandidato($Candidato);
                $data = $vlf->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function updateLicencia(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Tipo_Licencia = Utils::sanitizeNumber($_POST['Tipo_Licencia']);
            $Numero_Licencia = Utils::sanitizeStringBlank($_POST['Numero_Licencia']);
            $CategoriaA = isset($_POST['CategoriaA']) ? 1 : 0;
            $CategoriaB = isset($_POST['CategoriaB']) ? 1 : 0;
            $CategoriaC = isset($_POST['CategoriaC']) ? 1 : 0;
            $CategoriaD = isset($_POST['CategoriaD']) ? 1 : 0;
            $CategoriaE = isset($_POST['CategoriaE']) ? 1 : 0;
            $CategoriaF = isset($_POST['CategoriaF']) ? 1 : 0;
            $Licencia_Vigente_Del = Utils::sanitizeStringBlank($_POST['Licencia_Vigente_Del']);
            $Licencia_Vigente_Hasta = Utils::sanitizeStringBlank($_POST['Licencia_Vigente_Hasta']);
            $Estatus = Utils::sanitizeStringBlank($_POST['Estatus']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $Licencia_Vigente_Del = $Licencia_Vigente_Del ? DateTime::createFromFormat('d/m/Y', $Licencia_Vigente_Del)->format('Y-m-d') : NULL;
                $Licencia_Vigente_Hasta = $Licencia_Vigente_Hasta ? DateTime::createFromFormat('d/m/Y', $Licencia_Vigente_Hasta)->format('Y-m-d') : NULL;

                $vlf = new ValidacionLicenciaFederal();
                $vlf->setCandidato($Candidato);
                $vlf->setTipo_Licencia($Tipo_Licencia);
                $vlf->setNumero_Licencia($Numero_Licencia);
                $vlf->setCategoriaA($CategoriaA);
                $vlf->setCategoriaB($CategoriaB);
                $vlf->setCategoriaC($CategoriaC);
                $vlf->setCategoriaD($CategoriaD);
                $vlf->setCategoriaE ($CategoriaE);
                $vlf->setCategoriaF($CategoriaF);
                $vlf->setLicencia_Vigente_Del($Licencia_Vigente_Del);
                $vlf->setLicencia_Vigente_Hasta($Licencia_Vigente_Hasta);
                $vlf->setEstatus($Estatus);
                
                if ($flag == 1){
                    $save = $vlf->updateLicencia();

                }else {
                    
                    $save = $vlf->create();

                }
                if ($save) {
                    $vlf = $vlf->getOne();
                    $vlf->status = 1;
                    $vlf->display = Utils::getDisplayBotones();
                    echo json_encode($vlf);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function updateExamen(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Numero_Examen = Utils::sanitizeStringBlank($_POST['Numero_Examen']);
            $Tipo_Examen = Utils::sanitizeStringBlank($_POST['Tipo_Examen']);
            $Resultado_Examen = Utils::sanitizeStringBlank($_POST['Resultado_Examen']);
            $Fecha_Dictamen_Examen = Utils::sanitizeStringBlank($_POST['Fecha_Dictamen_Examen']);
            $Vigente_Hasta_Examen = Utils::sanitizeStringBlank($_POST['Vigente_Hasta_Examen']);

            $flag = $_POST['flag'];

            if ($Candidato) {
                $Fecha_Dictamen_Examen = DateTime::createFromFormat('d/m/Y', $Fecha_Dictamen_Examen)->format('Y-m-d');
                $Vigente_Hasta_Examen = DateTime::createFromFormat('d/m/Y', $Vigente_Hasta_Examen)->format('Y-m-d');
                $vlf = new ValidacionLicenciaFederal();
                $vlf->setCandidato($Candidato);
                $vlf->setNumero_Examen($Numero_Examen);
                $vlf->setTipo_Examen($Tipo_Examen);
                $vlf->setResultado_Examen($Resultado_Examen);
                $vlf->setFecha_Dictamen_Examen($Fecha_Dictamen_Examen);
                $vlf->setVigente_Hasta_Examen($Vigente_Hasta_Examen);
                
                if ($flag == 1){
                    
                    $save = $vlf->updateExamen();

                }else {

                    $save = $vlf->create();

                }
                if ($save) {
                    $vlf = $vlf->getOne();
                    $vlf->status = 1;
                    $vlf->display = Utils::getDisplayBotones();
                    echo json_encode($vlf);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function updateResultados(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Caracteristicas = Utils::sanitizeStringBlank($_POST['Caracteristicas']);
            $Resultado = Utils::sanitizeStringBlank($_POST['Resultado']);
            
            $flag = $_POST['flag'];

            if ($Candidato) {
                $vlf = new ValidacionLicenciaFederal();
                $vlf->setCandidato($Candidato);
                $vlf->setCaracteristicas($Caracteristicas);
                $vlf->setResultado($Resultado);
                
                if ($flag == 1){
                    $save = $vlf->updateResultados();

                }else {

                    $save = $vlf->create();

                }
                if ($save) {
                    $vlf = $vlf->getOne();
                    $vlf->status = 1;
                    $vlf->display = Utils::getDisplayBotones();
                    echo json_encode($vlf);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}