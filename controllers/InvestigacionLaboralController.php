<?php

require_once 'models/SA/Investigacion_Laboral.php';

class InvestigacionLaboralController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);

            if ($Folio) {
                $inv = new Investigacion_Laboral();
                $inv->setCandidato($Folio);
                $data = $inv->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else 
                echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Circunstancias_Laborales = Utils::sanitizeString($_POST['Circunstancias_Laborales']);
            $Proporciono_Datos_Empleos = Utils::sanitizeString($_POST['Proporciono_Datos_Empleos']);
            $Motivo_No_Proporciono_Datos = Utils::sanitizeString($_POST['Motivo_No_Proporciono_Datos']);
            $Demanda_Laboral = Utils::sanitizeString($_POST['Demanda_Laboral']);
            $Motivo_Demanda = Utils::sanitizeString($_POST['Motivo_Demanda']);
            $No_Empleos = Utils::sanitizeNumber($_POST['No_Empleos']);

            $Sindicalizado = Utils::sanitizeNumber($_POST['Sindicalizado']);
            $Sindicato = Utils::sanitizeStringBlank($_POST['Sindicato']);
            $Comite_Sindical = Utils::sanitizeNumber($_POST['Comite_Sindical']);
            $Puesto_Sindical = Utils::sanitizeStringBlank($_POST['Puesto_Sindical']);
            $Funciones_Sindicato = Utils::sanitizeStringBlank($_POST['Funciones_Sindicato']);
            $Tiempo_Sindicato = Utils::sanitizeStringBlank($_POST['Tiempo_Sindicato']);
           $Trabajo_Ternium = Utils::sanitizeString($_POST['Trabajo_Ternium']);
            $Alta_Ternium =  $Trabajo_Ternium=='No'? 'No aplica':Utils::sanitizeString($_POST['Alta_Ternium']);
            $Veto_Ternium =  $Trabajo_Ternium=='No'? 'No aplica':Utils::sanitizeString($_POST['Veto_Ternium']);

            $Positivo_Antidoping = Utils::sanitizeString($_POST['Positivo_Antidoping']);
            $Sustancia_Antidoping = Utils::sanitizeString($_POST['Sustancia_Antidoping']);
            $Accidentes_Empresa = Utils::sanitizeString($_POST['Accidentes_Empresa']);
            $Abandono_Unidad = Utils::sanitizeString($_POST['Abandono_Unidad']); 
            $flag = $_POST['flag'];

            if ($Candidato) {
                $investigacion = new Investigacion_Laboral();
                $investigacion->setCandidato($Candidato);
                $investigacion->setCircunstancias_Laborales($Circunstancias_Laborales);
                $investigacion->setProporciono_Datos_Empleos($Proporciono_Datos_Empleos);
                $investigacion->setMotivo_No_Proporciono_Datos($Motivo_No_Proporciono_Datos);
                $investigacion->setDemanda_Laboral($Demanda_Laboral);
                $investigacion->setMotivo_Demanda($Motivo_Demanda);
                $investigacion->setNo_Empleos($No_Empleos);
                $investigacion->setTiempo_Promedio_Empleos('');

                $investigacion->setSindicalizado($Sindicalizado);
                $investigacion->setSindicato($Sindicato);
                $investigacion->setComite_Sindical($Comite_Sindical);
                $investigacion->setPuesto_Sindical($Puesto_Sindical);
                $investigacion->setFunciones_Sindicato($Funciones_Sindicato);
                $investigacion->setTiempo_Sindicato($Tiempo_Sindicato);
                $investigacion->setTrabajo_Ternium($Trabajo_Ternium);
                $investigacion->setAlta_Ternium($Alta_Ternium);
                $investigacion->setVeto_Ternium($Veto_Ternium);

                $investigacion->setPositivo_Antidoping($Positivo_Antidoping);
                $investigacion->setSustancia_Antidoping($Sustancia_Antidoping);
                $investigacion->setAccidentes_Empresa($Accidentes_Empresa);
                $investigacion->setAbandono_Unidad($Abandono_Unidad);
				
                if ($flag == 1)
                    $save = $investigacion->update();
                else
                    $save = $investigacion->create();
                    
                if ($save) {
                    $investigacion = $investigacion->getOne();
                    $investigacion->status = 1;
                    $investigacion->display = Utils::getDisplayBotones();
                    echo json_encode($investigacion);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}