<?php

require_once 'models/SA/CandidatosIngresos.php';
require_once 'models/SA/CandidatosEgresos.php';
require_once 'models/SA/Candidatos.php';
require_once 'models/SA/Progreso.php';

class EgresoController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Egreso = Utils::sanitizeNumber($_POST['Egreso']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Egreso && $Candidato) {
                $egreso = new CandidatosEgresos();
                $egreso->setEgreso($Egreso);
                $egreso->setCandidato($Candidato);
                $data = $egreso->getOne();

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
            $Egreso = Utils::sanitizeNumber($_POST['Egreso']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Monto = Utils::sanitizeFloat($_POST['Monto']);
            $flag = $_POST['flag'];
            
            if ($Candidato) {
                $ingreso = new CandidatosEgresos();
                $ingreso->setEgreso($Egreso);
                $ingreso->setCandidato($Candidato);
                $ingreso->setMonto($Monto);
                
                if ($flag == 1)
                    $save = $ingreso->update();
                else
                    $save = $ingreso->create();
                    
                if ($save) {
                    $egresos = $ingreso->getEgresosPorCandidato();
                    $ingreso = new CandidatosIngresos();
                    $ingreso->setCandidato($Candidato);
                    $ingresos = $ingreso->getIngresosPorCandidato();
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
            $Egreso = Utils::sanitizeNumber($_POST['Egreso']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato && $Egreso) {
                $ingreso = new CandidatosEgresos();
                $ingreso->setEgreso($Egreso);
                $ingreso->setCandidato($Candidato);
                
                $delete = $ingreso->delete();

                if ($delete) {
                    $egresos = $ingreso->getEgresosPorCandidato();
                    $ingreso = new CandidatosIngresos();
                    $ingreso->setCandidato($Candidato);
                    $ingresos = $ingreso->getIngresosPorCandidato();
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

    public function getEgresosPorCompletarCandidato(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Candidato) {
                $egreso = new CandidatosEgresos();
                $egreso->setCandidato($Candidato);
                $data = $egreso->getEgresosFaltantesPorCandidato();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function getComentario(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Candidato) {
                $candidato = new Candidatos();
                $candidato->setCandidato($Candidato);
                $data = $candidato->getComentarios()->Comentario_Economia;

                $ingreso = new CandidatosIngresos();
                $ingreso->setCandidato($Candidato);
                $Total_Ingresos = $ingreso->getTotalIngresos();

                $egreso = new CandidatosEgresos();
                $egreso->setCandidato($Candidato);
                $Total_Egresos = $egreso->getTotalEgresos();

                if ($data) {
                    if ($Total_Ingresos >= $Total_Egresos) {
                        echo $data;
                    }else {
                        echo 2;
                    }
                    
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save_comentario(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Comentario_Economia = Utils::sanitizeString($_POST['Comentario_Economia']);

            if ($Candidato) {
                $cohabitante = new Candidatos();
                $cohabitante->setCandidato($Candidato);
                $cohabitante->setComentario_Economia($Comentario_Economia);
                
                $save = $cohabitante->updateComentarioEconomia();
                    
                if ($save) {
					$progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Salud == 0) {
                            $progreso->setSalud(10);
                            $progreso->updateSalud();
                        }
                    }
					
                    $egreso = new CandidatosEgresos();
                    $egreso->setCandidato($Candidato);
                    $egresos = $egreso->getEgresosPorCandidato();
                    $ingreso = new CandidatosIngresos();
                    $ingreso->setCandidato($Candidato);
                    $ingresos = $ingreso->getIngresosPorCandidato();
                    $candidato = new Candidatos();
                    $candidato->setCandidato($Candidato);
                    $Comentario_Economia = $candidato->getComentarios()->Comentario_Economia;
                    $data = array(
                        'ingresos' => $ingresos,
                        'egresos' => $egresos,
                        'Comentario_Economia' => $Comentario_Economia,
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