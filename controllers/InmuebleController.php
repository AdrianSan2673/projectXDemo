<?php

require_once 'models/SA/CandidatosInmuebles.php';
require_once 'models/SA/CandidatosVehiculos.php';

class InmuebleController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Renglon && $Candidato) {
                $inmueble = new CandidatosInmuebles();
                $inmueble->setRenglon($Renglon);
                $inmueble->setCandidato($Candidato);
                $data = $inmueble->getOne();

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
            $Tipo_Inmueble = Utils::sanitizeStringBlank($_POST['Tipo_Inmueble']);
            $Ubicacion = Utils::sanitizeStringBlank($_POST['Ubicacion']);
            $Valor = Utils::sanitizeStringBlank($_POST['Valor']);
            $Pagado = Utils::sanitizeNumber($_POST['Pagado']);
            $Abono_Mensual = Utils::sanitizeStringBlank($_POST['Abono_Mensual']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $inmueble = new CandidatosInmuebles();
                $inmueble->setRenglon($Renglon);
                $inmueble->setCandidato($Candidato);
                $inmueble->setTipo_Inmueble($Tipo_Inmueble);
                $inmueble->setUbicacion($Ubicacion);
                $inmueble->setValor($Valor);
                $inmueble->setPagado($Pagado);
                $inmueble->setAbono_Mensual($Abono_Mensual);
                
                if ($flag == 1)
                    $save = $inmueble->update();
                else
                    $save = $inmueble->create();
                    
                if ($save) {
                    $inmuebles = $inmueble->getInmueblesPorCandidato();
                    $vehiculo = new CandidatosVehiculos();
                    $vehiculo->setCandidato($Candidato);
                    $vehiculos = $vehiculo->getVehiculosPorCandidato();
                    $data = array(
                        'inmuebles' => $inmuebles,
                        'vehiculos' => $vehiculos,
                        'display' => Utils::getDisplayBotones(),
                        'status' => 1
                    );
                    echo json_encode($data);
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
                $inmueble = new CandidatosInmuebles();
                $inmueble->setRenglon($Renglon);
                $inmueble->setCandidato($Candidato);
                
                $delete = $inmueble->delete();

                if ($delete) {
                    $inmuebles = $inmueble->getInmueblesPorCandidato();
                    $vehiculo = new CandidatosVehiculos();
                    $vehiculo->setCandidato($Candidato);
                    $vehiculos = $vehiculo->getVehiculosPorCandidato();
                    $data = array(
                        'inmuebles' => $inmuebles,
                        'vehiculos' => $vehiculos,
                        'display' => Utils::getDisplayBotones(),
                        'status' => 1
                    );
                    echo json_encode($data);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}