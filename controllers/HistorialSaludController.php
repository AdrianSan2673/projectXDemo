<?php

require_once 'models/SA/CandidatosSalud.php';
require_once 'models/SA/CandidatosSaludSeguros.php';
require_once 'models/SA/Progreso.php';

class HistorialSaludController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $historial_salud = new CandidatosSalud();
                $historial_salud->setCandidato($Candidato);
                $data_historial_salud = $historial_salud->getOne();

                $seguros = new CandidatosSaludSeguros();
                $seguros->setCandidato($Candidato);
                $data_seguros = $seguros->getSaludSegurosPorCandidato();

                if ($data_historial_salud)
                    $data_historial_salud->status = 1;
                else
                    $data_historial_salud = array('status' => 0);

                if ($data_seguros)
                    //$data_seguros->status = 1;
                    array_push($data_seguros, array('status' => 1));
                else
                    $data_seguros = array('status' => 0);
                //$data_historial_salud->status = $data_historial_salud ? 1 : 0;
                //$data_seguros->status = $data_seguros ? 1 : 0;

                $data = array(
                    'historial_salud' => $data_historial_salud,
                    'seguros' => $data_seguros
                );

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Diabetes = Utils::sanitizeString($_POST['Diabetes']);
            $Diabetes_Familiar = Utils::sanitizeString($_POST['Diabetes_Familiar']);
            $Cancer = Utils::sanitizeString($_POST['Cancer']);
            $Cancer_Familiar = Utils::sanitizeString($_POST['Cancer_Familiar']);
            $Hipertension = Utils::sanitizeString($_POST['Hipertension']);
            $Hipertension_Familiar = Utils::sanitizeString($_POST['Hipertension_Familiar']);
            $Disfuncion_Renal = Utils::sanitizeString($_POST['Disfuncion_Renal']);
            $Disfuncion_Renal_Familiar = Utils::sanitizeString($_POST['Disfuncion_Renal_Familiar']);
            $Fibrosis_Quistica = Utils::sanitizeString($_POST['Fibrosis_Quistica']);
            $Fibrosis_Quistica_Familiar = Utils::sanitizeString($_POST['Fibrosis_Quistica_Familiar']);
            $Miopia = Utils::sanitizeString($_POST['Miopia']);
            $Miopia_Familiar = Utils::sanitizeString($_POST['Miopia_Familiar']);
            $Asma = Utils::sanitizeString($_POST['Asma']);
            $Asma_Familiar = Utils::sanitizeString($_POST['Asma_Familiar']);
            $Migranas = Utils::sanitizeString($_POST['Migranas']);
            $Migranas_Familiar = Utils::sanitizeString($_POST['Migranas_Familiar']);
            $Esclerosis_Multiple = Utils::sanitizeString($_POST['Esclerosis_Multiple']);
            $Esclerosis_Multiple_Familiar = Utils::sanitizeString($_POST['Esclerosis_Multiple_Familiar']);
            $Fuma = Utils::sanitizeNumber($_POST['Fuma']);
            $Fuma_Cuanto = Utils::sanitizeString($_POST['Fuma_Cuanto']);
            $Bebe = Utils::sanitizeNumber($_POST['Bebe']);
            $Bebe_Frecuencia = Utils::sanitizeString($_POST['Bebe_Frecuencia']);
            $Consume_Droga = Utils::sanitizeString($_POST['Consume_Droga']);
            $Cual_Droga = Utils::sanitizeString($_POST['Cual_Droga']);
            $Deportes = Utils::sanitizeNumber($_POST['Deportes']);
            $Deportes_Frecuencia = Utils::sanitizeStringBlank($_POST['Deportes_Frecuencia']);
            $Servicios_Medicos = isset($_POST['Servicio_Medico']) && !empty($_POST['Servicio_Medico']) ? $_POST['Servicio_Medico'] : false;

            $flag_salud = $_POST['flag_salud'];

            if ($Candidato) {
                $salud = new CandidatosSalud();
                $salud->setCandidato($Candidato);
                $salud->setDiabetes($Diabetes);
                $salud->setDiabetes_Familiar($Diabetes_Familiar);
                $salud->setCancer($Cancer);
                $salud->setCancer_Familiar($Cancer_Familiar);
                $salud->setHipertension($Hipertension);
                $salud->setHipertension_Familiar($Hipertension_Familiar);
                $salud->setDisfuncion_Renal($Disfuncion_Renal);
                $salud->setDisfuncion_Renal_Familiar($Disfuncion_Renal_Familiar);
                $salud->setFibrosis_Quistica($Fibrosis_Quistica);
                $salud->setFibrosis_Quistica_Familiar($Fibrosis_Quistica_Familiar);
                $salud->setMiopia($Miopia);
                $salud->setMiopia_Familiar($Miopia_Familiar);
                $salud->setAsma($Asma);
                $salud->setAsma_Familiar($Asma_Familiar);
                $salud->setMigranas($Migranas);
                $salud->setMigranas_Familiar($Migranas_Familiar);
                $salud->setEsclerosis_Multiple($Esclerosis_Multiple);
                $salud->setEsclerosis_Multiple_Familiar($Esclerosis_Multiple_Familiar);
                $salud->setFuma($Fuma);
                $salud->setFuma_Cuanto($Fuma_Cuanto);
                $salud->setBebe($Bebe);
                $salud->setBebe_Frecuencia($Bebe_Frecuencia);
                $salud->setConsume_Droga($Consume_Droga);
                $salud->setCual_Droga($Cual_Droga);
                $salud->setDeportes($Deportes);
                $salud->setDeportes_Frecuencia($Deportes_Frecuencia);

                $seguros = new CandidatosSaludSeguros();
                $seguros->setCandidato($Candidato);
                $seguros->deleteSegurosPorCandidato();
                
                if ($Servicios_Medicos) {
                    foreach ($Servicios_Medicos as $Servicio_Medico) {
                        $seguros->setServicio_Medico($Servicio_Medico);
                        $seguros->create();
                    }
                }
                
                $seguros = Utils::getSaludSeguros($seguros->getSaludSegurosPorCandidato());
                
                if ($flag_salud == 1)
                    $save_salud = $salud->update();
                else
                    $save_salud = $salud->create();

                if ($save_salud) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Salud == 0) {
                            $progreso->setSalud(10);
                            $progreso->updateSalud();
                        }
                    }

                    $salud = $salud->getOne();
                    $salud->status = 1;
                }else
                    $salud->status = 2;


                $data = array(
                    'salud' => $salud,
                    'seguros' => $seguros
                );
                echo json_encode($data);

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}