<?php

require_once 'models/SA/CandidatosRAL.php';
require_once 'models/RAL/Busqueda_RAL.php';
require_once 'models/RAL/Expediente_RAL.php';
require_once 'models/RAL/Acuerdos_RAL.php';
require_once 'models/SA/Candidatos.php';
require_once 'models/SA/CandidatosDatos.php';

class RegistroAntecedentesLegalesController{

    public function busqueda(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
    
            if (isset($_GET['Nombres']) && isset($_GET['Apellidos'])) {
                $Nombres = Utils::sanitizeStringBlank($_GET['Nombres']);
                $Apellidos = Utils::sanitizeStringBlank($_GET['Apellidos']);

                $Nombres = urlencode($Nombres);
                $Apellidos = urlencode($Apellidos);

                $api_url = "https://www.poderjudicialvirtual.com/api/v1/search/{$Nombres}/{$Apellidos}";

                //$json_data = file_get_contents($api_url);

                $curl = curl_init($api_url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                    'apikey: '.ral_api_key,
                    'Content-Type: application/json'
                ]);

                $ral = json_decode(curl_exec($curl));
                array_push($ral, array('api_url' => $api_url));
            }

            $page_title = 'Búsqueda de RAL | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ral/index.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:'.base_url);
    }

    public function search_for(){
        if (Utils::isValid($_SESSION['identity'] && isset($_POST)) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            $Nombres = Utils::sanitizeStringBlank($_POST['Nombres']);
            $Apellidos = Utils::sanitizeStringBlank($_POST['Apellidos']);

            $Nombres = urlencode($Nombres);
            $Apellidos = urlencode($Apellidos);

            $api_url = "https://www.poderjudicialvirtual.com/api/v1/search/{$Nombres}/{$Apellidos}";

            //$json_data = file_get_contents($api_url);

            $curl = curl_init($api_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'apikey: '.ral_api_key,
                'Content-Type: application/json'
            ]);

            $response = curl_exec($curl);

            $url = base_url."registroantecedenteslegales/resultado&Nombres={$Nombres}&Apellidos={$Apellidos}";

            if ($response) 
                $data = array(
                    'ral' => json_decode($response),
                    'api_url' => $url, 
                    'status' => 1
                );
            else
                $data = array('status' => 0);
            
            echo json_encode($data);

        } else
            header('location:'.base_url);
    }

    public function resultado(){
        if (Utils::isValid($_SESSION['identity'] && isset($_GET)) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            $Nombres = Utils::sanitizeStringBlank($_GET['Nombres']);
            $Apellidos = Utils::sanitizeStringBlank($_GET['Apellidos']);
            $i = Utils::sanitizeNumber($_GET['i']);

            $Nombres = urlencode($Nombres);
            $Apellidos = urlencode($Apellidos);

            $api_url = "https://www.poderjudicialvirtual.com/api/v1/search/{$Nombres}/{$Apellidos}";

            //$json_data = file_get_contents($api_url);

            $curl = curl_init($api_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'apikey: '.ral_api_key,
                'Content-Type: application/json'
            ]);

            $response = json_decode(curl_exec($curl));

            $ral = $response->results[$i];

            $expediente = $ral->objExpediente;
            $acuerdos = $ral->objAcuerdos;

            $page_title = 'Búsqueda de RAL | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ral/read.php';
            require_once 'views/layout/footer.php';

        } else
            header('location:'.base_url);
    }

    public function search_for_by_candidato(){
        if (Utils::isValid($_SESSION['identity'] && isset($_POST)) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            $Nombres = Utils::sanitizeStringBlank($_POST['Nombres']);
            $Apellidos = Utils::sanitizeStringBlank($_POST['Apellidos']);
            $CURP = Utils::sanitizeStringBlank($_POST['CURP']);
            $Candidato = Utils::sanitizeNumber($_POST['Candidato']);

            if ($Candidato && $Nombres && $Apellidos) {
                if ($CURP) {
                    $Nombres_URL = urlencode($Nombres);
                    $Apellidos_URL = urlencode($Apellidos);

                    $api_url = "https://www.poderjudicialvirtual.com/api/v1/search/{$Nombres_URL}/{$Apellidos_URL}";

                    //$json_data = file_get_contents($api_url);

                    $curl = curl_init($api_url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, [
                        'apikey: '.ral_api_key,
                        'Content-Type: application/json'
                    ]);

                    $response = curl_exec($curl);

                    $url = base_url."registroantecedenteslegales/resultado&Nombres={$Nombres}&Apellidos={$Apellidos}";

                    $ral = json_decode($response);

                    if ($response) {
                        $busqueda_RAL = new Busqueda_RAL();
                        $busqueda_RAL->setNombres($Nombres);
                        $busqueda_RAL->setApellidos($Apellidos);
                        $busqueda_RAL->setCURP($CURP);
                        $busqueda_RAL->setCreado($_SESSION['identity']->username);
                        $save_busqueda = $busqueda_RAL->create();
                        if ($save_busqueda) {
                            $ID_Busqueda_RAL = $busqueda_RAL->getID();
                            foreach ($ral->results as $resultado) {
                                $expediente = $resultado->objExpediente;
                                $expediente_RAL = new Expediente_RAL();
                                $expediente_RAL->setFecha(isset($expediente->exp_fecha) ? ($expediente->exp_fecha) : NULL);
                                $expediente_RAL->setNum_Expediente(isset($expediente->exp_num_expediente) ? ($expediente->exp_num_expediente) : '');
                                $expediente_RAL->setAnio(isset($expediente->exp_anio) ? ($expediente->exp_anio) : '');
                                $expediente_RAL->setEstado(isset($expediente->exp_estado) ? ($expediente->exp_estado) : '');
                                $expediente_RAL->setCiudad(isset($expediente->exp_ciudad) ? ($expediente->exp_ciudad) : '');
                                $expediente_RAL->setJuzgado(isset($expediente->exp_juzgado) ? ($expediente->exp_juzgado) : '');
                                $expediente_RAL->setOp(isset($expediente->exp_op) ? ($expediente->exp_op) : '');
                                $expediente_RAL->setToca(isset($expediente->exp_toca) ? ($expediente->exp_toca) : '');
                                $expediente_RAL->setActor(isset($expediente->exp_actor) ? ($expediente->exp_actor) : '');
                                $expediente_RAL->setDemandado(isset($expediente->exp_demandado) ? ($expediente->exp_demandado) : '');
                                $expediente_RAL->setTipo(isset($expediente->exp_tipo) ? ($expediente->exp_tipo) : '');
                                $expediente_RAL->setID_Busqueda_RAL($ID_Busqueda_RAL);
                                $save_expediente = $expediente_RAL->create();

                                if ($save_expediente) {
                                    $ID_Expediente_RAL = $expediente_RAL->getID();
                                    foreach ($resultado->objAcuerdos as $acuerdo) {
                                        $acuerdo_RAL = new Acuerdos_RAL();
                                        $acuerdo_RAL->setFecha(isset($acuerdo->acu_fecha) ? $acuerdo->acu_fecha : '');
                                        $acuerdo_RAL->setAcuerdo(isset($acuerdo->acu_acuerdo) ? ($acuerdo->acu_acuerdo) : '');
                                        $acuerdo_RAL->setTipo(isset($acuerdo->acu_actor) ? ($acuerdo->acu_actor) : '');
										$acuerdo_RAL->setActor(isset($acuerdo->acu_tipo) ? ($acuerdo->acu_tipo) : '');
                                        $acuerdo_RAL->setDemandado(isset($acuerdo->acu_demandado) ? ($acuerdo->acu_demandado) : '');
                                        $acuerdo_RAL->setID_Expediente_RAL($ID_Expediente_RAL);
                                        $acuerdo_RAL->create();
                                    }
                                }
                            }
                            
                            $estudio = new Candidatos();
                            $estudio->setCandidato($Candidato);
                            $estudio->setID_Busqueda_RAL($ID_Busqueda_RAL);
                            $estudio->updateBusquedaRAL();

                            $candidato = new CandidatosDatos();
                            $candidato->setCandidato($Candidato);
                            $candidato_datos = $candidato->getOne();

                            $busq_RAL = new Busqueda_RAL();
                            $busqueda_RAL = $busq_RAL->getOneByCandidato($estudio);
                            if ($busqueda_RAL) {
                                $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                                $busqueda_RAL->PDF_RAL = base_url.'formato/resumen_resultado_RAL&busqueda='.Encryption::encode($busqueda_RAL->ID);
                                $exp_RAL = new Expediente_RAL();
                                $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                                $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();
                                
                                if ($expedientes_RAL) {
                                    for ($i=0; $i < count($expedientes_RAL); $i++) { 
                                        $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);
                                        
                                        $expedientes_RAL[$i]['PDF_RAL'] = base_url.'formato/resultado_RAL&expediente='.Encryption::encode($expedientes_RAL[$i]['ID']);
                                        $acuerdo_RAL = new Acuerdos_RAL();
                                        $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                                        $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                                        for ($j=0; $j < count($acuerdos); $j++) 
                                            $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                                        //array_push($expediente, array('acuerdos' => $acuerdos));
                                        $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                                    }

                                    //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                                    $busqueda_RAL->expedientes = $expedientes_RAL;
                                }else
                                    $busqueda_RAL->expedientes = [];
                                //array_push($busqueda_RAL, array('status' => 1));
                                $busqueda_RAL->status = 1;
                            } else {
                                $busq_RAL->setCURP($candidato_datos->CURP);
                                $busqueda_RAL = $busq_RAL->getOneByCURP();
                                if ($busqueda_RAL) {
                                    $user = new User();
                                    $user->setUsername($busqueda_RAL->Creado);
                                    $Usuario = $user->getUserByUsername();

                                    $busqueda_RAL->PDF_RAL = base_url.'formato/resumen_resultado_RAL&busqueda='.Encryption::encode($busqueda_RAL->ID);
                                    $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                                    $busqueda_RAL->Creado = $Usuario->first_name.' '.$Usuario->last_name;
                                    $exp_RAL = new Expediente_RAL();
                                    $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                                    $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();
                                    if ($expedientes_RAL) {
                                        for ($i=0; $i < count($expedientes_RAL); $i++) { 
                                            $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);

                                            $expedientes_RAL[$i]['PDF_RAL'] = base_url.'formato/resultado_RAL&expediente='.Encryption::encode($expedientes_RAL[$i]['ID']);
                                            $acuerdo_RAL = new Acuerdos_RAL();
                                            $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                                            $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                                            for ($j=0; $j < count($acuerdos); $j++) 
                                                $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                                            //array_push($expediente, array('acuerdos' => $acuerdos));
                                            $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                                        }
                                        //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                                        $busqueda_RAL->expedientes = $expedientes_RAL;
                                    }else
                                        $busqueda_RAL->expedientes = [];
                                    //array_push($busqueda_RAL, array('status' => 1));
                                    $busqueda_RAL->status = 3;
                                }else {
                                    $busqueda_RAL = (object)array('status' => 0);
                                }
                                    
                            }
                        }

                        $data = array(
                            'candidato_datos' => $candidato_datos,
                            'busqueda_RAL' => $busqueda_RAL,
                            'api_url' => $url, 
                            'status' => 1
                        );
                    }else
                        $data = array('status' => 0);
                    
                    echo json_encode($data);
                }else {
                    $data = array('status' => 5);
					echo json_encode($data);
                }
                    
            }

                

        } else
            header('location:'.base_url);
    }
}