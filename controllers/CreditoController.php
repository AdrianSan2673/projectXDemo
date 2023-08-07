<?php

require_once 'models/SA/CandidatosCreditos.php';
require_once 'models/SA/CandidatosBancarias.php';
require_once 'models/SA/CandidatosSeguros.php';
require_once 'models/SA/Candidatos.php';

class CreditoController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Renglon && $Candidato) {
                $credito = new CandidatosCreditos();
                $credito->setRenglon($Renglon);
                $credito->setCandidato($Candidato);
                $data = $credito->getOne();

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
            $Institucion = Utils::sanitizeString($_POST['Institucion']);
            $Limite_Credito = Utils::sanitizeString($_POST['Limite_Credito']);
            $Saldo_Actual = Utils::sanitizeString($_POST['Saldo_Actual']);
            $Vencimiento = Utils::sanitizeString($_POST['Vencimiento']);
            $Abono_Mensual = Utils::sanitizeString($_POST['Abono_Mensual']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $credito = new CandidatosCreditos();
                $credito->setRenglon($Renglon);
                $credito->setCandidato($Candidato);
                $credito->setInstitucion($Institucion);
                $credito->setLimite_Credito($Limite_Credito);
                $credito->setSaldo_Actual($Saldo_Actual);
                $credito->setVencimiento($Vencimiento);
                $credito->setAbono_Mensual($Abono_Mensual);
                
                if ($flag == 1)
                    $save = $credito->update();
                else
                    $save = $credito->create();
                    
                if ($save) {
                    $creditos = $credito->getCreditosPorCandidato();
                    $bancaria = new CandidatosBancarias();
                    $bancaria->setCandidato($Candidato);
                    $bancarias = $bancaria->getCuentasPorCandidato();
                    $seguro = new CandidatosSeguros();
                    $seguro->setCandidato($Candidato);
                    $seguros = $seguro->getSegurosPorCandidato();
                    $candidato = new Candidatos();
                    $candidato->setCandidato($Candidato);
                    $comentarios = $candidato->getComentarios();
                    $data = array(
                        'creditos' => $creditos,
                        'cuentas' => $bancarias,
                        'seguros' => $seguros,
                        'INFONAVIT' => $comentarios->INFONAVIT,
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
                $credito = new CandidatosCreditos();
                $credito->setRenglon($Renglon);
                $credito->setCandidato($Candidato);
                
                $delete = $credito->delete();

                if ($delete) {
                    $creditos = $credito->getCreditosPorCandidato();
                    $bancaria = new CandidatosBancarias();
                    $bancaria->setCandidato($Candidato);
                    $bancarias = $bancaria->getCuentasPorCandidato();
                    $seguro = new CandidatosSeguros();
                    $seguro->setCandidato($Candidato);
                    $seguros = $seguro->getSegurosPorCandidato();
                    $candidato = new Candidatos();
                    $candidato->setCandidato($Candidato);
                    $comentarios = $candidato->getComentarios();
                    $data = array(
                        'creditos' => $creditos,
                        'cuentas' => $bancarias,
                        'seguros' => $seguros,
                        'INFONAVIT' => $comentarios->INFONAVIT,
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

    public function getINFONAVIT(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Candidato) {
                $candidato = new Candidatos();
                $candidato->setCandidato($Candidato);
                $comentarios = $candidato->getComentarios();

                if ($comentarios) {
                    $credito = new CandidatosCreditos();
                    $credito->setCandidato($Candidato);
                    $creditos = $credito->getCreditosPorCandidato();

                    $bancaria = new CandidatosBancarias();
                    $bancaria->setCandidato($Candidato);
                    $bancarias = $bancaria->getCuentasPorCandidato();
                    
                    $seguro = new CandidatosSeguros();
                    $seguro->setCandidato($Candidato);
                    $seguros = $seguro->getSegurosPorCandidato();

                    $data = array(
                        'creditos' => $creditos,
                        'cuentas' => $bancarias,
                        'seguros' => $seguros,
                        'INFONAVIT' => $comentarios->INFONAVIT,
                        'display' => Utils::getDisplayBotones(),
                        'status' => 1
                    );
                    echo json_encode($data);
                }
                else echo json_encode(array('status' => 2));
                
            }echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function save_INFONAVIT(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $INFONAVIT = Utils::sanitizeNumber($_POST['INFONAVIT']);

            if ($Candidato) {
                $candidato = new Candidatos();
                $candidato->setCandidato($Candidato);
                $candidato->setINFONAVIT($INFONAVIT);
                
                $save = $candidato->updateINFONAVIT();
                    
                if ($save) {
                    $credito = new CandidatosCreditos();
                    $credito->setCandidato($Candidato);
                    $creditos = $credito->getCreditosPorCandidato();

                    $bancaria = new CandidatosBancarias();
                    $bancaria->setCandidato($Candidato);
                    $bancarias = $bancaria->getCuentasPorCandidato();
                    
                    $seguro = new CandidatosSeguros();
                    $seguro->setCandidato($Candidato);
                    $seguros = $seguro->getSegurosPorCandidato();

                    $candidato = new Candidatos();
                    $candidato->setCandidato($Candidato);
                    $comentarios = $candidato->getComentarios();
                    $data = array(
                        'creditos' => $creditos,
                        'cuentas' => $bancarias,
                        'seguros' => $seguros,
                        'INFONAVIT' => $comentarios->INFONAVIT,
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