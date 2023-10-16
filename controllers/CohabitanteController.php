<?php

require_once 'models/SA/Candidatos.php';
require_once 'models/SA/CandidatosCohabitan.php';
require_once 'models/SA/CandidatosDatos.php';

class CohabitanteController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Candidato) {
                $candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato_datos = $candidato->getOne();

                if ($Renglon) {
                    $cohabitante = new CandidatosCohabitan();
                    $cohabitante->setRenglon($Renglon);
                    $cohabitante->setCandidato($Candidato);
                    $data = $cohabitante->getOne();
                    
                    if ($data) {
                        header('Content-Type: text/html; charset=utf-8');
                        echo json_encode(array('data' => $data, 'candidato_datos' => $candidato_datos, 'status' => 1), \JSON_UNESCAPED_UNICODE);
                    } else echo json_encode(array('candidato_datos' => $candidato_datos, 'status' => 2), \JSON_UNESCAPED_UNICODE);
                }else echo json_encode(array('candidato_datos' => $candidato_datos, 'status' => 2), \JSON_UNESCAPED_UNICODE);
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Nombre = Utils::sanitizeStringBlank($_POST['Nombre']);
            $Parentesco = Utils::sanitizeNumber($_POST['Parentesco']);
            $Edad = Utils::sanitizeNumber($_POST['Edad']);
            $Edad_2 = Utils::sanitizeString($_POST['Edad_2']);
            $Estado_Civil = Utils::sanitizeNumber($_POST['Estado_Civil']);
            $Ocupacion = Utils::sanitizeStringBlank($_POST['Ocupacion']);
            $Empresa = Utils::sanitizeStringBlank($_POST['Empresa']);
            $Dependiente = @Utils::sanitizeNumber($_POST['Dependiente']);
            $Telefono = Utils::sanitizeStringBlank($_POST['Telefono']);
            $Es_Mayor_Edad = @Utils::sanitizeNumber($_POST['Es_Mayor_Edad']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $cohabitante = new CandidatosCohabitan();
                $cohabitante->setRenglon($Renglon);
                $cohabitante->setCandidato($Candidato);
                $cohabitante->setNombre($Nombre);
                $cohabitante->setParentesco($Parentesco);
                $cohabitante->setEdad($Edad);
                $cohabitante->setEdad_2($Edad_2);
                $cohabitante->setEstado_Civil($Estado_Civil);
                $cohabitante->setOcupacion($Ocupacion);
                $cohabitante->setEmpresa($Empresa);
                $cohabitante->setDependiente($Dependiente);
                $cohabitante->setTelefono($Telefono);
                $cohabitante->setEs_Mayor_Edad($Es_Mayor_Edad);
                
                if ($flag == 1)
                    $save = $cohabitante->update();
                else
                    $save = $cohabitante->create();
                    
                if ($save) {
                    $cohabitantes = $cohabitante->getCohabitantesPorCandidato();
                    for ($i=0; $i < count($cohabitantes); $i++) { 
                        $cohabitantes[$i]['Parentesco'] = Utils::getParentesco($cohabitantes[$i]['Parentesco']);
                        $cohabitantes[$i]['Estado_Civil'] = Utils::getEstadoCivil($cohabitantes[$i]['Estado_Civil']);
                    }
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Candidato);
                    $candidato_datos = $candidato->getOne();

                    echo json_encode(array('data' => $cohabitantes, 'candidato_datos' => $candidato_datos, 'status' => 1, 'display' => Utils::getDisplayBotones()), \JSON_UNESCAPED_UNICODE);
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
                $cohabitante = new CandidatosCohabitan();
                $cohabitante->setRenglon($Renglon);
                $cohabitante->setCandidato($Candidato);
                
                $delete = $cohabitante->delete();

                $candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato_datos = $candidato->getOne();

                if ($delete) {
                    $cohabitantes = $cohabitante->getCohabitantesPorCandidato();
                    for ($i=0; $i < count($cohabitantes); $i++) { 
                        $cohabitantes[$i]['Parentesco'] = Utils::getParentesco($cohabitantes[$i]['Parentesco']);
                        $cohabitantes[$i]['Estado_Civil'] = Utils::getEstadoCivil($cohabitantes[$i]['Estado_Civil']);
                    }
                    echo json_encode(array('data' => $cohabitantes, 'candidato_datos' => $candidato_datos, 'status' => 1, 'display' => Utils::getDisplayBotones()), \JSON_UNESCAPED_UNICODE);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function getComentario(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ( $Candidato) {
                $candidato = new Candidatos();
                $candidato->setCandidato($Candidato);
                $data = $candidato->getComentarios()->Comentario_Cohabitan;

                if ($data) {
                    echo $data;
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save_comentario(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Comentario_Cohabitan = Utils::sanitizeString($_POST['Comentario_Cohabitan']);

            if ($Candidato) {
                $cohabitante = new Candidatos();
                $cohabitante->setCandidato($Candidato);
                $cohabitante->setComentario_Cohabitan($Comentario_Cohabitan);
                
                $save = $cohabitante->updateComentarioCohabitan();
                    
                if ($save) {
                    $cohabitante = new CandidatosCohabitan();
                    $cohabitante->setCandidato($Candidato);
                    $cohabitantes = $cohabitante->getCohabitantesPorCandidato();
                    for ($i=0; $i < count($cohabitantes); $i++) { 
                        $cohabitantes[$i]['Parentesco'] = Utils::getParentesco($cohabitantes[$i]['Parentesco']);
                        $cohabitantes[$i]['Estado_Civil'] = Utils::getEstadoCivil($cohabitantes[$i]['Estado_Civil']);
                    }
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Candidato);
                    $candidato_datos = $candidato->getOne();

                    echo json_encode(array('data' => $cohabitantes, 
										   'candidato_datos' => $candidato_datos, 
										   'status' => 1, 
										   'display' => Utils::getDisplayBotones()), \JSON_UNESCAPED_UNICODE);
                    
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}