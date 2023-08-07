<?php

require_once 'models/SA/CandidatosInmuebles.php';
require_once 'models/SA/CandidatosVehiculos.php';

class VehiculoController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Renglon = Utils::sanitizeNumber($_POST['Renglon']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ($Renglon && $Candidato) {
                $vehiculo = new CandidatosVehiculos();
                $vehiculo->setRenglon($Renglon);
                $vehiculo->setCandidato($Candidato);
                $data = $vehiculo->getOne();

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
            $Marca = Utils::sanitizeString($_POST['Marca']);
            $Modelo = Utils::sanitizeString($_POST['Modelo']);
            $Valor = Utils::sanitizeString($_POST['Valor']);
            $Pagado = Utils::sanitizeNumber($_POST['Pagado']);
            $Abono_Mensual = Utils::sanitizeString($_POST['Abono_Mensual']);
            $flag = $_POST['flag'];

            if ($Candidato) {
                $vehiculo = new CandidatosVehiculos();
                $vehiculo->setRenglon($Renglon);
                $vehiculo->setCandidato($Candidato);
                $vehiculo->setMarca($Marca);
                $vehiculo->setModelo($Modelo);
                $vehiculo->setValor($Valor);
                $vehiculo->setPagado($Pagado);
                $vehiculo->setAbono_Mensual($Abono_Mensual);
                
                if ($flag == 1)
                    $save = $vehiculo->update();
                else
                    $save = $vehiculo->create();
                    
                if ($save) {
                    $vehiculos = $vehiculo->getVehiculosPorCandidato();
                    $inmueble = new CandidatosInmuebles();
                    $inmueble->setCandidato($Candidato);
                    $inmuebles = $inmueble->getInmueblesPorCandidato();
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
                $vehiculo = new CandidatosVehiculos();
                $vehiculo->setRenglon($Renglon);
                $vehiculo->setCandidato($Candidato);
                
                $delete = $vehiculo->delete();

                if ($delete) {
                    $vehiculos = $vehiculo->getVehiculosPorCandidato();
                    $inmueble = new CandidatosInmuebles();
                    $inmueble->setCandidato($Candidato);
                    $inmuebles = $inmueble->getInmueblesPorCandidato();
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