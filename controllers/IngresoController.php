<?php

require_once 'models/SA/CandidatosIngresos.php';
require_once 'models/SA/CandidatosEgresos.php';

class IngresoController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Renglon && $Candidato) {
                $ingreso = new CandidatosIngresos();
                $ingreso->setRenglon($Renglon);
                $ingreso->setCandidato($Candidato);
                $data = $ingreso->getOne();

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
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Aporta = Utils::sanitizeString($_POST['Aporta']);
            $Fuente = Utils::sanitizeString($_POST['Fuente']);
            $Monto = Utils::sanitizeFloat($_POST['Monto']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $ingreso = new CandidatosIngresos();
                $ingreso->setRenglon($Renglon);
                $ingreso->setCandidato($Candidato);
                $ingreso->setAporta($Aporta);
                $ingreso->setFuente($Fuente);
                $ingreso->setMonto($Monto);
                
                if ($flag == 1)
                    $save = $ingreso->update();
                else
                    $save = $ingreso->create();
                    
                if ($save) {
                    $ingresos = $ingreso->getIngresosPorCandidato();
                    $egreso = new CandidatosEgresos();
                    $egreso->setCandidato($Candidato);
                    $egresos = $egreso->getEgresosPorCandidato();
                    $data = array(
                        'ingresos' => $ingresos,
                        'egresos' => $egresos,
                        'display' => Utils::getDisplayBotones(),
                        'status' => 1
                    );
                    echo json_encode($data);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function delete(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato && $Renglon) {
                $ingreso = new CandidatosIngresos();
                $ingreso->setRenglon($Renglon);
                $ingreso->setCandidato($Candidato);
                
                $delete = $ingreso->delete();

                if ($delete) {
                    $ingresos = $ingreso->getIngresosPorCandidato();
                    $egreso = new CandidatosEgresos();
                    $egreso->setCandidato($Candidato);
                    $egresos = $egreso->getEgresosPorCandidato();
                    $data = array(
                        'ingresos' => $ingresos,
                        'egresos' => $egresos,
                        'display' => Utils::getDisplayBotones(),
                        'status' => 1
                    );
                    echo json_encode($data);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}