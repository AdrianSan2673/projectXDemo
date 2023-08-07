<?php

require_once 'models/SA/CandidatosCreditos.php';
require_once 'models/SA/CandidatosBancarias.php';
require_once 'models/SA/CandidatosSeguros.php';
require_once 'models/SA/Candidatos.php';

class CuentaBancariaController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Renglon && $Candidato) {
                $bancaria = new CandidatosBancarias();
                $bancaria->setRenglon($Renglon);
                $bancaria->setCandidato($Candidato);
                $data = $bancaria->getOne();

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
            $Tipo_Cuenta = Utils::sanitizeString($_POST['Tipo_Cuenta']);
            $Objetivo = Utils::sanitizeString($_POST['Objetivo']);
            $Deposito_Mensual = Utils::sanitizeString($_POST['Deposito_Mensual']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $bancaria = new CandidatosBancarias();
                $bancaria->setRenglon($Renglon);
                $bancaria->setCandidato($Candidato);
                $bancaria->setInstitucion($Institucion);
                $bancaria->setTipo_Cuenta($Tipo_Cuenta);
                $bancaria->setObjetivo($Objetivo);
                $bancaria->setDeposito_Mensual($Deposito_Mensual);
                
                if ($flag == 1)
                    $save = $bancaria->update();
                else
                    $save = $bancaria->create();
                    
                if ($save) {
                    $bancarias = $bancaria->getCuentasPorCandidato();

                    $credito = new CandidatosCreditos();
                    $credito->setCandidato($Candidato);
                    $creditos = $credito->getCreditosPorCandidato();
                    
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
                $bancaria = new CandidatosBancarias();
                $bancaria->setRenglon($Renglon);
                $bancaria->setCandidato($Candidato);
                
                $delete = $bancaria->delete();

                if ($delete) {
                    $bancarias = $bancaria->getCuentasPorCandidato();

                    $credito = new CandidatosCreditos();
                    $credito->setCandidato($Candidato);
                    $creditos = $credito->getCreditosPorCandidato();
                    
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