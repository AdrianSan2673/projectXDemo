<?php

require_once 'models/SA/ConociendoCandidato.php';
require_once 'models/SA/Progreso.php';

class ConociendoCandidatoController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;
            
            if ($Folio) {
                $estudio = new ConociendoCandidato();
                $estudio->setCandidato($Folio);
                $data = $estudio->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo $json_conociendo = json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Interes_Puesto = Utils::sanitizeString($_POST['Interes_Puesto']);
            $Que_Esperas_Lograr = Utils::sanitizeString($_POST['Que_Esperas_Lograr']);
            $Caracteristicas_Empleo = Utils::sanitizeString($_POST['Caracteristicas_Empleo']);
            $Objetivo_Laboral = Utils::sanitizeString($_POST['Objetivo_Laboral']);
            $Que_Esperas_Empresa = Utils::sanitizeString($_POST['Que_Esperas_Empresa']);
            $Cualidades = Utils::sanitizeString($_POST['Cualidades']);
            $Trabajo_Equipo = Utils::sanitizeString($_POST['Trabajo_Equipo']);
            $Ultimos_Jefes = Utils::sanitizeString($_POST['Ultimos_Jefes']);
            $Que_Esperas_Aportar = Utils::sanitizeString($_POST['Que_Esperas_Aportar']);
            $Jornada_Laboral = Utils::sanitizeString($_POST['Jornada_Laboral']);
            $Motivacion = Utils::sanitizeString($_POST['Motivacion']);
            $Que_Dirian_Jefes_Anteriores = Utils::sanitizeString($_POST['Que_Dirian_Jefes_Anteriores']);
            $Orgullo_Trayectoria_Laboral = Utils::sanitizeString($_POST['Orgullo_Trayectoria_Laboral']);
            $No_Te_Gusto_Empleos_Anteriores = Utils::sanitizeString($_POST['No_Te_Gusto_Empleos_Anteriores']);
            $Estas_Otros_Procesos = Utils::sanitizeString($_POST['Estas_Otros_Procesos']);
            $flag = $_POST['conociendo'];

            //if ($Candidato && $Interes_Puesto && $Que_Esperas_Lograr && $Caracteristicas_Empleo && $Objetivo_Laboral && $Que_Esperas_Empresa && $Cualidades && $Trabajo_Equipo && $Ultimos_Jefes && $Que_Esperas_Aportar && $Jornada_Laboral && $Motivacion && $Que_Dirian_Jefes_Anteriores && $Orgullo_Trayectoria_Laboral && $No_Te_Gusto_Empleos_Anteriores && $Estas_Otros_Procesos) {
            if ($Candidato) {
                $conociendo = new ConociendoCandidato();
                $conociendo->setCandidato($Candidato);
                $conociendo->setInteres_Puesto($Interes_Puesto);
                $conociendo->setQue_Esperas_Lograr($Que_Esperas_Lograr);
                $conociendo->setCaracteristicas_Empleo($Caracteristicas_Empleo);
                $conociendo->setObjetivo_Laboral($Objetivo_Laboral);
                $conociendo->setQue_Esperas_Empresa($Que_Esperas_Empresa);
                $conociendo->setCualidades($Cualidades);
                $conociendo->setTrabajo_Equipo($Trabajo_Equipo);
                $conociendo->setUltimos_Jefes($Ultimos_Jefes);
                $conociendo->setQue_Esperas_Aportar($Que_Esperas_Aportar);
                $conociendo->setJornada_Laboral($Jornada_Laboral);
                $conociendo->setMotivacion($Motivacion);
                $conociendo->setQue_Dirian_Jefes_Anteriores($Que_Dirian_Jefes_Anteriores);
                $conociendo->setOrgullo_Trayectoria_Laboral($Orgullo_Trayectoria_Laboral);
                $conociendo->setNo_Te_Gusto_Empleos_Anteriores($No_Te_Gusto_Empleos_Anteriores);
                $conociendo->setEstas_Otros_Procesos($Estas_Otros_Procesos);

                if ($flag == 1)
                    $save = $conociendo->update();
                else
                    $save = $conociendo->create();
                    
                if ($save) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Datos_Adicionales == 0) {
                            $progreso->setDatos_Adicionales(10);
                            $progreso->updateDatosAdicionales();
                        }
                    }
                    $conociendo = $conociendo->getOne();
                    $conociendo->status = 1;
                    $conociendo->display = Utils::getDisplayBotones();
                    echo json_encode($conociendo);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}