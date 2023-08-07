<?php

require_once 'models/SA/CandidatosCreditos.php';
require_once 'models/SA/CandidatosBancarias.php';
require_once 'models/SA/CandidatosSeguros.php';
require_once 'models/SA/Candidatos.php';

class SeguroController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Renglon && $Candidato) {
                $seguro = new CandidatosSeguros();
                $seguro->setRenglon($Renglon);
                $seguro->setCandidato($Candidato);
                $data = $seguro->getOne();

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
            $Institucion = Utils::sanitizeStringBlank($_POST['Institucion']);
            $Tipo_Seguro = Utils::sanitizeStringBlank($_POST['Tipo_Seguro']);
            $Forma_Pago = Utils::sanitizeStringBlank($_POST['Forma_Pago']);
            $Prima = Utils::sanitizeStringBlank($_POST['Prima']);
            $Vigencia = Utils::sanitizeStringBlank($_POST['Vigencia']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $seguro = new CandidatosSeguros();
                $seguro->setRenglon($Renglon);
                $seguro->setCandidato($Candidato);
                $seguro->setInstitucion($Institucion);
                $seguro->setTipo_Seguro($Tipo_Seguro);
                $seguro->setForma_Pago($Forma_Pago);
                $seguro->setPrima($Prima);
                $seguro->setVigencia($Vigencia);
                
                if ($flag == 1)
                    $save = $seguro->update();
                else
                    $save = $seguro->create();
                    
                if ($save) {
                    $seguros = $seguro->getSegurosPorCandidato();
                    $credito = new CandidatosCreditos();
                    $credito->setCandidato($Candidato);
                    $creditos = $credito->getCreditosPorCandidato();
                    $bancaria = new CandidatosBancarias();
                    $bancaria->setCandidato($Candidato);
                    $bancarias = $bancaria->getCuentasPorCandidato();
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
                $seguro = new CandidatosSeguros();
                $seguro->setRenglon($Renglon);
                $seguro->setCandidato($Candidato);
                
                $delete = $seguro->delete();

                if ($delete) {
                    $seguros = $seguro->getSegurosPorCandidato();
                    $credito = new CandidatosCreditos();
                    $credito->setCandidato($Candidato);
                    $creditos = $credito->getCreditosPorCandidato();
                    $bancaria = new CandidatosBancarias();
                    $bancaria->setCandidato($Candidato);
                    $bancarias = $bancaria->getCuentasPorCandidato();
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