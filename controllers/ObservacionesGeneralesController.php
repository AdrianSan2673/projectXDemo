<?php

require_once 'models/SA/CandidatosObsGenerales.php';
require_once 'models/SA/Progreso.php';
require_once 'models/SA/CandidatosDatos.php';

class ObservacionesGeneralesController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $obs = new CandidatosObsGenerales();
                $obs->setCandidato($Candidato);
                $data = $obs->getObservacionesPorCandidato();

                $candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato_datos = $candidato->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode(array('data' => $data, 'candidato_datos' => $candidato_datos, 'status' => 1), \JSON_UNESCAPED_UNICODE);
                } else echo json_encode(array('data' => $data, 'candidato_datos' => $candidato_datos, 'status' => 2));
                
            }else echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function save_conclusiones(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Sobre_Candidato = Utils::sanitizeString($_POST['Sobre_Candidato']);
            $Sobre_Casa = Utils::sanitizeString($_POST['Sobre_Casa']);
            $Conclusiones_Entrevistador = Utils::sanitizeString($_POST['Conclusiones_Entrevistador']);
            $Participacion_Candidato = Utils::sanitizeNumber($_POST['Participacion_Candidato']);
            $Entorno_Familiar = Utils::sanitizeNumber($_POST['Entorno_Familiar']);
            $Referencias_Vecinales = Utils::sanitizeNumber($_POST['Referencias_Vecinales']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $obs = new CandidatosObsGenerales();
                $obs->setCandidato($Candidato);
                $obs->setSobre_Candidato($Sobre_Candidato);
                $obs->setSobre_Casa($Sobre_Casa);
                $obs->setConclusiones_Entrevistador($Conclusiones_Entrevistador);
                $obs->setParticipacion_Candidato($Participacion_Candidato);
                $obs->setEntorno_Familiar($Entorno_Familiar);
                $obs->setReferencias_Vecinales($Referencias_Vecinales);

                if ($flag == 1)
                    $save = $obs->updateConclusiones();
                else
                    $save = $obs->createConclusiones();
				
				$candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato_datos = $candidato->getOne();
                    
                if ($save) {
                    $obs = $obs->getObservacionesPorCandidato();
                    $obs->status = 1;
                    $obs->display = Utils::getDisplayBotones();
                    echo json_encode(array('data' => $obs, 'candidato_datos' => $candidato_datos, 'status' => 1, 'display' => Utils::getDisplayBotones()));
                }
                else echo json_encode(array('candidato_datos' => $candidato_datos, 'status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function save_comentarios_generales_inv(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Info_Proporcionada_Candidato = @Utils::sanitizeNumber($_POST['Info_Proporcionada_Candidato']);
            $Referencias_Laborales = @Utils::sanitizeNumber($_POST['Referencias_Laborales']);
            $Info_Confiable = @Utils::sanitizeNumber($_POST['Info_Confiable']);
            $Comentario_General_il = @Utils::sanitizeStringBlank($_POST['Comentario_General_il']);
            $Viable = @Utils::sanitizeNumber($_POST['Viable']);
            $Proporciona_Contacto = @Utils::sanitizeNumber($_POST['Proporciona_Contacto']);
            $Informacion_Congruente = @Utils::sanitizeNumber($_POST['Informacion_Congruente']);
            $Factor_Riesgo = @Utils::sanitizeNumber($_POST['Factor_Riesgo']);
            $Cual_Factor_Riesgo = @Utils::sanitizeStringBlank($_POST['Cual_Factor_Riesgo']);
            $Estabilidad_Laboral = @Utils::sanitizeNumber($_POST['Estabilidad_Laboral']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $obs = new CandidatosObsGenerales();
                $obs->setCandidato($Candidato);
                $obs->setInfo_Proporcionada($Info_Proporcionada_Candidato);
                $obs->setReferencias_Laborales($Referencias_Laborales);
                $obs->setInfo_Confiable($Info_Confiable);
                $obs->setComentario_General_il($Comentario_General_il);
                $obs->setViable($Viable);
                $obs->setProporciona_Contacto($Proporciona_Contacto);
                $obs->setInformacion_Congruente($Informacion_Congruente);
                $obs->setFactor_Riesgo($Factor_Riesgo);
                $obs->setCual_Factor_Riesgo($Cual_Factor_Riesgo);
                $obs->setEstabilidad_Laboral($Estabilidad_Laboral);

                if ($flag == 1)
                    $save = $obs->updateComentariosGeneralesInv();
                else
                    $save = $obs->createComentariosGeneralesInv();
				
				$candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato_datos = $candidato->getOne();
                    
                if ($save) {
                    $obs = $obs->getObservacionesPorCandidato();
                    //$obs->status = 1;
                    //$obs->display = Utils::getDisplayBotones();
                    echo json_encode(array('data' => $obs, 'candidato_datos' => $candidato_datos, 'status' => 1, 'display' => Utils::getDisplayBotones()));
                }
                else echo json_encode(array('candidato_datos' => $candidato_datos, 'status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function save_comentarios_generales(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Comentarios_Generales = Utils::sanitizeStringBlank($_POST['Comentarios_Generales']);
            $Califica_como = Utils::sanitizeStringBlank($_POST['Califica_como']);
            $Viabilidad = Utils::sanitizeStringBlank($_POST['Viabilidad']);
			
			$Puntualidad =  @Utils::sanitizeNumber($_POST['Puntualidad']);
			$Documentacion =  @Utils::sanitizeNumber($_POST['Documentacion']);
			$Naturalidad =  @Utils::sanitizeNumber($_POST['Naturalidad']);
			$Respuestas_Claras =  @Utils::sanitizeNumber($_POST['Respuestas_Claras']);


            $flag = $_POST['flag'];

            if ($Candidato) {
                $obs = new CandidatosObsGenerales();
                $obs->setCandidato($Candidato);
                $obs->setComentarios_Generales($Comentarios_Generales);
                $obs->setCalifica_como($Califica_como);
                $obs->setViabilidad($Viabilidad);
                $obs->setPuntualidad($Puntualidad);
                $obs->setDocumentacion($Documentacion);
                $obs->setNaturalidad($Naturalidad);
                $obs->setRespuestas_Claras($Respuestas_Claras);


                if ($flag == 1)
                    $save = $obs->updateComentariosGenerales();
                else
                    $save = $obs->createComentariosGenerales();
				
				$candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato_datos = $candidato->getOne();
                    
                if ($save) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Obs_Generales == 0) {
                            $progreso->setObs_Generales(10);
                            $progreso->updateObsGenerales();
                        }
                    }

                    $obs = $obs->getObservacionesPorCandidato();
                    //$obs->status = 1;
                    //$obs->display = Utils::getDisplayBotones();
                    echo json_encode(array('data' => $obs, 'candidato_datos' => $candidato_datos, 'status' => 1, 'display' => Utils::getDisplayBotones()));
                }
                else echo json_encode(array('candidato_datos' => $candidato_datos, 'status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}