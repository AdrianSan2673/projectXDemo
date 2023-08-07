<?php

require_once 'models/SA/CandidatosReferencias.php';
require_once 'models/SA/Progreso.php';

class ReferenciaController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Renglon && $Candidato) {
                $referencia = new CandidatosReferencias();
                $referencia->setRenglon($Renglon);
                $referencia->setCandidato($Candidato);
                $data = $referencia->getOne();

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
            $Tipo = Utils::sanitizeNumber($_POST['Tipo']);
            $Relacion = Utils::sanitizeStringBlank($_POST['Relacion']);
            $Nombre = Utils::sanitizeStringBlank($_POST['Nombre']);
            $Telefono = Utils::sanitizeStringBlank($_POST['Telefono']);
            $Domicilio = Utils::sanitizeStringBlank($_POST['Domicilio']);
            $Domicilio_Candidato = Utils::sanitizeStringBlank($_POST['Domicilio_Candidato']);
            $Tiempo_Viviendo = Utils::sanitizeStringBlank($_POST['Tiempo_Viviendo']);
            $Tiempo_Conocerlo = Utils::sanitizeStringBlank($_POST['Tiempo_Conocerlo']);
            $Tiene_Hijos = Utils::sanitizeStringBlank($_POST['Tiene_Hijos']);
            $Dedicacion = Utils::sanitizeStringBlank($_POST['Dedicacion']);
            $Estado_Civil = Utils::sanitizeStringBlank($_POST['Estado_Civil']);
            $Comentarios = Utils::sanitizeStringBlank($_POST['Comentarios']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $referencia = new CandidatosReferencias();
                $referencia->setRenglon($Renglon);
                $referencia->setCandidato($Candidato);
                $referencia->setTipo($Tipo);
                $referencia->setRelacion($Relacion);
                $referencia->setNombre($Nombre);
                $referencia->setTelefono($Telefono);
                $referencia->setDomicilio($Domicilio);
                $referencia->setDomicilio_Candidato($Domicilio_Candidato);
                $referencia->setTiempo_Viviendo($Tiempo_Viviendo);
                $referencia->setTiempo_Conocerlo($Tiempo_Conocerlo);
                $referencia->setTiene_Hijos($Tiene_Hijos);
                $referencia->setDedicacion($Dedicacion);
                $referencia->setEstado_Civil($Estado_Civil);
                $referencia->setComentarios($Comentarios);
                
                if ($flag == 1){
                    $save = $referencia->update();
                }else {
                    $save = $referencia->create();
                }    
                if ($save) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Ref_Vecinal == 0) {
                            $progreso->setRef_Vecinal(10);
                            $progreso->updateRefVecinal();
                        }
                    }

                    $referencias = $referencia->getReferenciasPorCandidato();
                    array_push($referencias, array('display' => Utils::getDisplayBotones()));
                    array_push($referencias, array('status' => 1));
                    echo json_encode($referencias);
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
                $referencia = new CandidatosReferencias();
                $referencia->setRenglon($Renglon);
                $referencia->setCandidato($Candidato);
                
                $delete = $referencia->delete();

                if ($delete) {
                    $referencias = $referencia->getReferenciasPorCandidato();
                    if (count($referencias) == 0) {
                        $progreso = new Progreso();
                        $progreso->setCandidato($Candidato);
                        $progress = $progreso->getOne();
                        if ($progress->Candidato) {
                            if ($progress->Ref_Vecinal == 10) {
                                $progreso->setRef_Vecinal(0);
                                $progreso->updateRefVecinal();
                            }
                        }
                    }
                    array_push($referencias, array('display' => Utils::getDisplayBotones()));
                    array_push($referencias, array('status' => 1));
                    echo json_encode($referencias);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}