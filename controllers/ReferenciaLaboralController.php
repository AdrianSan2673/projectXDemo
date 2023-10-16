<?php

require_once 'models/SA/CandidatosLaborales.php';
require_once 'models/SA/CandidatosLaboraleConceptos.php';
require_once 'models/SA/CandidatosDatos.php';

class ReferenciaLaboralController{
	
	

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato_datos = $candidato->getOne();

                if ($Renglon) {
                    $laboral = new CandidatosLaborales();
                    $laboral->setRenglon($Renglon);
                    $laboral->setCandidato($Candidato);
                    $data = $laboral->getOne();

                    if ($data) {
                        header('Content-Type: text/html; charset=utf-8');
                        echo json_encode(array(
                            'data' => $data,
                            'candidato_datos' => $candidato_datos,
                            'status' => 1
                        ), \JSON_UNESCAPED_UNICODE);
                    }else echo json_encode(array('status' => 2, 'candidato_datos' => $candidato_datos));
                }else {
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'status' => 3
                    ), \JSON_UNESCAPED_UNICODE);
                }
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Empresa = Utils::sanitizeStringBlank($_POST['Empresa']);
            $Giro = @Utils::sanitizeStringBlank($_POST['Giro']);
            $Domicilio = Utils::sanitizeStringBlank($_POST['Domicilio']);
            $Telefono = Utils::sanitizeStringBlank($_POST['Telefono']);
            $Fecha_Ingreso = Utils::sanitizeStringBlank($_POST['Fecha_Ingreso']);
            $Fecha_Baja = Utils::sanitizeStringBlank($_POST['Fecha_Baja']);
            $Puesto_Inicial = Utils::sanitizeStringBlank($_POST['Puesto_Inicial']);
            $Puesto_Final = @Utils::sanitizeStringBlank($_POST['Puesto_Final']);
            $Jefe = Utils::sanitizeStringBlank($_POST['Jefe']);
            $Puesto_Jefe = Utils::sanitizeStringBlank($_POST['Puesto_Jefe']);
            $Motivo_Separacion = Utils::sanitizeStringBlank($_POST['Motivo_Separacion']);
            $Recontratable = Utils::sanitizeNumber($_POST['Recontratable']);
            $Recontratable_PorQue = Utils::sanitizeStringBlank($_POST['Recontratable_PorQue']);
            $Informante = Utils::sanitizeStringBlank($_POST['Informante']);
            $Comentarios = Utils::sanitizeStringBlank($_POST['Comentarios']);
            $Calif = Utils::sanitizeNumber($_POST['Calif']);
            $Dopaje = Utils::sanitizeNumber($_POST['Dopaje']);
            $Desempeno = Utils::sanitizeNumber($_POST['Desempeno']);
            $Honradez = Utils::sanitizeNumber($_POST['Honradez']);
            $Puntualidad = Utils::sanitizeNumber($_POST['Puntualidad']);
            $Relacion = Utils::sanitizeNumber($_POST['Relacion']);
            $Responsabilidad = Utils::sanitizeNumber($_POST['Responsabilidad']);
            $Adaptacion = Utils::sanitizeNumber($_POST['Adaptacion']);

            $Sindicalizado = Utils::sanitizeNumber($_POST['Sindicalizado']);
            $Sindicato = Utils::sanitizeStringBlank($_POST['Sindicato']);
            $Comite_Sindical = Utils::sanitizeNumber($_POST['Comite_Sindical']);
            $Puesto_Sindical = Utils::sanitizeStringBlank($_POST['Puesto_Sindical']);
            $Funciones_Sindicato = Utils::sanitizeStringBlank($_POST['Funciones_Sindicato']);
            $Tiempo_Sindicato = Utils::sanitizeStringBlank($_POST['Tiempo_Sindicato']);
            /* $Tipo_Unidad = Utils::sanitizeStringBlank($_POST['Tipo_Unidad']);
            $Robos_Perdidas = Utils::sanitizeNumber($_POST['Robos_Perdidas']);
            $Accidentes_Graves = Utils::sanitizeNumber($_POST['Accidentes_Graves']);
            $Cuidado_Unidad = Utils::sanitizeNumber($_POST['Cuidado_Unidad']);
            $Problemas_Unidad = Utils::sanitizeNumber($_POST['Problemas_Unidad']);
            $Gastos_Viaje = Utils::sanitizeNumber($_POST['Gastos_Viaje']);
            $Presentaba_Faltantes = Utils::sanitizeNumber($_POST['Presentaba_Faltantes']);
            $Problemas_Diesel = Utils::sanitizeNumber($_POST['Problemas_Diesel']); */

            $Sitio_Web = @Utils::sanitizeStringBlank($_POST['Sitio_Web']);
            $Correo = @Utils::sanitizeStringBlank($_POST['Correo']);
            $Puesto_Informante = @Utils::sanitizeStringBlank($_POST['Puesto_Informante']);
            $Razon_Social = @Utils::sanitizeStringBlank($_POST['Razon_Social']);

            $flag = $_POST['flag'];

            if ($Candidato) {
                $laboral = new CandidatosLaborales();
                $laboral->setRenglon($Renglon);
                $laboral->setCandidato($Candidato);
                $laboral->setEmpresa($Empresa);
                $laboral->setGiro($Giro);
                $laboral->setDomicilio($Domicilio);
                $laboral->setTelefono($Telefono);
                $laboral->setFecha_Ingreso($Fecha_Ingreso);
                $laboral->setFecha_Baja($Fecha_Baja);
                $laboral->setPuesto_Inicial($Puesto_Inicial);
                $laboral->setPuesto_Final($Puesto_Final);
                $laboral->setJefe($Jefe);
                $laboral->setPuesto_Jefe($Puesto_Jefe);
                $laboral->setMotivo_Separacion($Motivo_Separacion);
                $laboral->setRecontratable($Recontratable);
                $laboral->setRecontratable_PorQue($Recontratable_PorQue);
                $laboral->setInformante($Informante);
                $laboral->setComentarios($Comentarios);
                $laboral->setCalif($Calif);
                $laboral->setDopaje($Dopaje);

                $laboral->setSindicalizado($Sindicalizado);
                $laboral->setSindicato($Sindicato);
                $laboral->setComite_Sindical($Comite_Sindical);
                $laboral->setPuesto_Sindical($Puesto_Sindical);
                $laboral->setFunciones_Sindicato($Funciones_Sindicato);
                $laboral->setTiempo_Sindicato($Tiempo_Sindicato);

                $laboral->setSitio_Web($Sitio_Web);
                $laboral->setCorreo($Correo);
                $laboral->setPuesto_Informante($Puesto_Informante);
                $laboral->setRazon_Social($Razon_Social);

                $concepto = new CandidatosLaboralesConceptos();
                $concepto->setCandidato($Candidato);
                $concepto->setRenglon($Renglon);
                $concepto->setDesempeno($Desempeno);
                $concepto->setHonradez($Honradez);
                $concepto->setPuntualidad($Puntualidad);
                $concepto->setRelacion($Relacion);
                $concepto->setResponsabilidad($Responsabilidad);
                $concepto->setAdaptacion($Adaptacion);

                /* $transportista = new CandidatosLaboralesTransportistas();
                $transportista->setCandidato($Candidato);
                $transportista->setRenglon($Renglon);
                $transportista->setTipo_Unidad($Tipo_Unidad);
                $transportista->setRobos_Perdidas($Robos_Perdidas);
                $transportista->setAccidentes_Graves($Accidentes_Graves);
                $transportista->setCuidado_Unidad($Cuidado_Unidad);
                $transportista->setProblemas_Unidad($Problemas_Unidad);
                $transportista->setGastos_Viaje($Gastos_Viaje);
                $transportista->setPresentaba_Faltantes($Presentaba_Faltantes);
                $transportista->setProblemas_Diesel($Problemas_Diesel); */
                
                if ($flag == 1){
                    $save = $laboral->update();
                    if ($save)
                        $concepto->update();
                }else {
                    $save = $laboral->create();
                    if ($save){
                        $concepto->setRenglon($laboral->getRenglon());
                        $concepto->create();
                    }
                }

                /* $transport = $transportista->getOne();
                if ($transport)
                    $transportista->update();
                else
                    $transportista->create(); */

                if ($save) {
                    $laborals = $laboral->getLaboralesPorCandidato();
                    array_push($laborals, array('display' => Utils::getDisplayBotones()));
                    array_push($laborals, array('status' => 1));
                    echo json_encode($laborals);
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
                $laboral = new CandidatosLaborales();
                $laboral->setRenglon($Renglon);
                $laboral->setCandidato($Candidato);

                $concepto = new CandidatosLaboralesConceptos();
                $concepto->setCandidato($Candidato);
                $concepto->setRenglon($Renglon);
                
                $delete = $laboral->delete();

                if ($delete) {
                    $concepto->delete();
                    $laborales = $laboral->getLaboralesPorCandidato();
                    array_push($laborales, array('display' => Utils::getDisplayBotones()));
                    array_push($laborales, array('status' => 1));
                    echo json_encode($laborales);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
	
	public function updateRenglon()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {

            $arrayRenglon = explode(',', $_POST['arrayRenglon']);

            $Candidato = Utils::sanitizeNumber($_POST['candidato']);
            if ($Candidato && $arrayRenglon) {
                for ($i = 0; $i < count($arrayRenglon); $i++) {
                    $laboral = new CandidatosLaborales();
                    $laboral->setRenglon($arrayRenglon[$i]);
                    $laboral->setCandidato($Candidato);
                    $laboral->updateRenglon($i + 11);

                    $concepto = new CandidatosLaboralesConceptos();
                    $concepto->setRenglon($arrayRenglon[$i]);
                    $concepto->setCandidato($Candidato);
                    $concepto->updateRenglon($i + 11);
                } 

                $laboral = new CandidatosLaborales();
                $laboral->setCandidato($Candidato);
                $laborales = $laboral->getAll();

                $i = 1;
                foreach ($laborales as $lab) {
                    $laboral = new CandidatosLaborales();
                    $laboral->setRenglon($lab['Renglon']);
                    $laboral->setCandidato($Candidato);
                    $laboral->updateRenglon($lab['Renglon'] - 10);

                    $concepto = new CandidatosLaboralesConceptos();
                    $concepto->setRenglon($lab['Renglon']);
                    $concepto->setCandidato($Candidato);
                    $concepto->updateRenglon($lab['Renglon'] - 10);
                    $aux2 = $lab['Renglon'] - 10;
                }

                $laborales = $laboral->getAll();
                echo json_encode(array('status' => 1, 'laborales' => $laborales));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
    
	
}