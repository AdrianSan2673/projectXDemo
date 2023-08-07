<?php

require_once 'models/SA/CirculoFamiliar.php';
require_once 'models/SA/Progreso.php';

class CirculoFamiliarController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics())) {
            $Id = isset($_POST['Id']) ? trim($_POST['Id']) : FALSE;
            
            if ($Id) {
                $circulo = new CirculoFamiliar();
                $circulo->setId($Id);
                $data = $circulo->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo $json_conociendo = json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics())) {
            $Id = Utils::sanitizeNumber($_POST['Id']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Nombre_Parentesco = Utils::sanitizeString($_POST['Nombre_Parentesco']);
            $Parentesco = Utils::sanitizeNumber($_POST['Parentesco']);
            $Telefono_Parentesco = Utils::sanitizeString($_POST['Telefono_Parentesco']);
            $Estatus = Utils::sanitizeString($_POST['Estatus']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $familiar = new CirculoFamiliar();
                $familiar->setId($Id);
                $familiar->setCandidato($Candidato);
                $familiar->setNombre_Parentesco($Nombre_Parentesco);
                $familiar->setParentesco($Parentesco);
                $familiar->setTelefono_Parentesco($Telefono_Parentesco);
                $familiar->setEstatus($Estatus);
                
                if ($flag == 1)
                    $save = $familiar->update();
                else
                    $save = $familiar->create();
                    
                if ($save) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Sociales == 0) {
                            $progreso->setSociales(10);
                            $progreso->updateSociales();
                        }
                    }

                    $familiares = $familiar->getFamiliaresPorCandidato();
                    for ($i=0; $i < count($familiares); $i++) { 
                        $familiares[$i]['Parentesco'] = Utils::getParentesco($familiares[$i]['Parentesco']);
                    }
                    array_push($familiares, array('display' => Utils::getDisplayBotones()));
                    array_push($familiares, array('status' => 1));
                    echo json_encode($familiares);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function delete(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics())) {
            $Id = Utils::sanitizeNumber($_POST['Id']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $familiar = new CirculoFamiliar();
                $familiar->setId($Id);
                $familiar->setCandidato($Candidato);
                
                $delete = $familiar->delete();

                if ($delete) {
                    $familiares = $familiar->getFamiliaresPorCandidato();
                    if (count($familiares) == 0) {
                        $progreso = new Progreso();
                        $progreso->setCandidato($Candidato);
                        $progress = $progreso->getOne();
                        if ($progress->Candidato) {
                            if ($progress->Sociales == 10) {
                                $progreso->setSociales(0);
                                $progreso->updateSociales();
                            }
                        }
                    }
                    for ($i=0; $i < count($familiares); $i++) { 
                        $familiares[$i]['Parentesco'] = Utils::getParentesco($familiares[$i]['Parentesco']);
                    }
                    array_push($familiares, array('display' => Utils::getDisplayBotones()));
                    array_push($familiares, array('status' => 1));
                    echo json_encode($familiares);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}