<?php

require_once 'models/SA/CandidatosRAL.php';

class RALController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;
            
            if ($Folio) {
                $ral = new CandidatosRAL();
                $ral->setCandidato($Folio);
                $data = $ral->getOne();

                if ($data) {
                    $data->status = 1;
                    header('Content-Type: text/html; charset=utf-8');
                    echo $json_conociendo = json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo json_encode(array('status' => 0));
                
            }else echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Nombre = Utils::sanitizeString($_POST['Nombre']);
            $Demandas = Utils::sanitizeString($_POST['Demandas']);
            $Estado = Utils::sanitizeString($_POST['Estado_RAL']);
            $Total_Demandas = Utils::sanitizeString($_POST['Total_Demandas']);
            $Total_Acuerdos = Utils::sanitizeString($_POST['Total_Acuerdos']);
            $Tipo_Juicio = Utils::sanitizeString($_POST['Tipo_Juicio']);
            $flag = $_POST['ral_flag'];

            if ($Candidato) {
                $Total_Demandas = $Total_Demandas ? $Total_Demandas : '';
                $Total_Acuerdos = $Total_Acuerdos ? $Total_Acuerdos : '';
                $Tipo_Juicio = $Tipo_Juicio ? $Tipo_Juicio : '';
                $ral = new CandidatosRAL();
                $ral->setCandidato($Candidato);
                $ral->setNombre($Nombre);
                $ral->setDemandas($Demandas);
                $ral->setEstado($Estado);
                $ral->setTotal_Demandas($Total_Demandas);
                $ral->setTotal_Acuerdos($Total_Acuerdos);
                $ral->setTipo_Juicio($Tipo_Juicio);
            
                if ($flag == 1)
                    $save = $ral->update();
                else
                    $save = $ral->create();
                    
                if ($save) {
                    $ral = $ral->getOne();
                    $ral->status = 1;
                    $ral->display = Utils::getDisplayBotones();
                    echo json_encode($ral);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function update_comentarios(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Comentarios = $_POST['Comentarios'];
            $flag = $_POST['flag'];

            if ($Candidato) {
                $ral = new CandidatosRAL();
                $ral->setCandidato($Candidato);
                $ral->setComentarios($Comentarios);
            
                if ($flag == 1)
                    $save = $ral->updateComentarios();
                else {
                    $ral->setNombre('');
                    $ral->setDemandas('');
                    $ral->setEstado('');
                    $ral->setTotal_Demandas('');
                    $ral->setTotal_Acuerdos('');
                    $ral->setTipo_Juicio('');
                    $ral->create();
                    $save = $ral->updateComentarios();
                }
                    
                if ($save) {
                    $ral = $ral->getOne();
                    $ral->status = 1;
                    $ral->display = Utils::getDisplayBotones();
                    echo json_encode($ral);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}