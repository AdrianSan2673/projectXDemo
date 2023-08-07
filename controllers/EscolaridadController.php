<?php

require_once 'models/SA/CandidatosEscolaridad.php';
require_once 'models/SA/Candidatos.php';

class EscolaridadController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Renglon && $Candidato) {
                $escolaridad = new CandidatosEscolaridad();
                $escolaridad->setRenglon($Renglon);
                $escolaridad->setCandidato($Candidato);
                $data = $escolaridad->getOne();

                if ($data) {
                    $candidato = new Candidatos();
                    $candidato->setCandidato($Candidato);
                    $comentario = $candidato->getComentarios()->Comentario_Escolaridad;
                    $data->Comentario_Escolaridad = $comentario;
                    
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
            $Grado = Utils::sanitizeNumber($_POST['Grado']);
            $Institucion = Utils::sanitizeStringBlank($_POST['Institucion']);
            $Localidad = Utils::sanitizeStringBlank($_POST['Localidad']);
            $Periodo = Utils::sanitizeStringBlank($_POST['Periodo']);
            $Documento = Utils::sanitizeNumber($_POST['Documento']);
            $Folio = Utils::sanitizeStringBlank($_POST['Folioo']);
            $Comentario_Escolaridad = Utils::sanitizeStringBlank($_POST['Comentario_Escolaridad']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $escolaridad = new CandidatosEscolaridad();
                $escolaridad->setRenglon($Renglon);
                $escolaridad->setCandidato($Candidato);
                $escolaridad->setGrado($Grado);
                $escolaridad->setInstitucion($Institucion);
                $escolaridad->setLocalidad($Localidad);
                $escolaridad->setPeriodo($Periodo);
                $escolaridad->setDocumento($Documento);
                $escolaridad->setFolio($Folio);
                
                if ($flag == 1)
                    $save = $escolaridad->update();
                else
                    $save = $escolaridad->create();
                    
                if ($save) {
                    $escolaridad = $escolaridad->getEscolaridadPorCandidato();

                    $candidato = new Candidatos();
                    $candidato->setCandidato($Candidato);
                    $candidato->setComentario_Escolaridad($Comentario_Escolaridad);
                    $candidato->updateComentarioEscolaridad();

                    for ($i=0; $i < count($escolaridad); $i++) { 
                        $escolaridad[$i]['Grado'] = Utils::getGradoEstudio($escolaridad[$i]['Grado']);
                        $escolaridad[$i]['Documento'] = Utils::getDocumentoEscolar($escolaridad[$i]['Documento']);
                    }
                    //array_push($escolaridad, array('display' => Utils::getDisplayBotones()));
                    $comentario = $candidato->getComentarios()->Comentario_Escolaridad;
                    array_push($escolaridad, array('Comentario_Escolaridad' => $comentario));

                    array_push($escolaridad, array('status' => 1));
                    echo json_encode($escolaridad);
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
                $escolaridad = new CandidatosEscolaridad();
                $escolaridad->setRenglon($Renglon);
                $escolaridad->setCandidato($Candidato);
                
                $delete = $escolaridad->delete();

                if ($delete) {
                    $escolaridad = $escolaridad->getEscolaridadPorCandidato();
                    for ($i=0; $i < count($escolaridad); $i++) { 
                        $escolaridad[$i]['Grado'] = Utils::getGradoEstudio($escolaridad[$i]['Grado']);
                        $escolaridad[$i]['Documento'] = Utils::getDocumentoEscolar($escolaridad[$i]['Documento']);
                    }
                    array_push($escolaridad, array('display' => Utils::getDisplayBotones()));
                    array_push($escolaridad, array('status' => 1));
                    echo json_encode($escolaridad);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}