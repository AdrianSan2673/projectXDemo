<?php

require_once 'models/SA/CandidatosUbicacion.php';
require_once 'models/SA/CandidatosVivienda.php';
require_once 'models/SA/Progreso.php';
require_once 'models/SA/Candidatos.php';

class UbicacionController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $ubicacion = new CandidatosUbicacion();
                $ubicacion->setCandidato($Candidato);
                $data_ubicacion = $ubicacion->getOne();

                $vivienda = new CandidatosVivienda();
                $vivienda->setCandidato($Candidato);
                $data_vivienda = $vivienda->getOne();

                $cand = new Candidatos();
                $cand->setCandidato($Candidato);
                $data_comentarios = $cand->getComentarios();

                /* $data_ubicacion = $data_ubicacion ? array_push($data_ubicacion, array('status' => 1)) : ['status' => 0];
                $data_vivienda = $data_vivienda ? array_push($data_vivienda, array('status' => 1)) : ['status' => 0]; */

                //$data_ubicacion->status = $data_ubicacion ? 1 : 0;
                //$data_vivienda->status = $data_vivienda ? 1 : 0;

                if ($data_ubicacion)
                    $data_ubicacion->status = 1;
                else
                    $data_ubicacion = array('status' => 0);

                if ($data_vivienda)
                    $data_vivienda->status = 1;
                else
                    $data_vivienda = array('status' => 0);

                if ($data_comentarios)
                    $data_comentarios->status = 1;
                else
                    $data_comentarios = array('status' => 0);

                $data = array(
                    'ubicacion' => $data_ubicacion,
                    'vivienda' => $data_vivienda,
                    'comentario' => $data_comentarios
                );

                header('Content-Type: text/html; charset=utf-8');
                echo $json_ubicacion = json_encode($data, \JSON_UNESCAPED_UNICODE);
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Tiempo_Viviendo = Utils::sanitizeStringBlank($_POST['Tiempo_Viviendo']);
            $Calle = Utils::sanitizeStringBlank($_POST['Calle']);
            $Exterior = Utils::sanitizeStringBlank($_POST['Exterior']);
            $Interior = Utils::sanitizeStringBlank($_POST['Interior']);
            $Colonia = Utils::sanitizeStringBlank($_POST['Colonia']);
            $Entre_Calles = Utils::sanitizeStringBlank($_POST['Entre_Calles']);
            $Municipio = Utils::sanitizeStringBlank($_POST['Municipio']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);
            $Codigo_Postal = Utils::sanitizeStringBlank($_POST['Codigo_Postal']);
            $Fachada = Utils::sanitizeStringBlank($_POST['Fachada']);
            $Tipo_Vivienda = Utils::sanitizeNumber($_POST['Tipo_Vivienda']);
            $Plantas = Utils::sanitizeNumber($_POST['Plantas']);
            $Sanitarios = Utils::sanitizeNumber($_POST['Sanitarios']);
            $Recamaras = Utils::sanitizeNumber($_POST['Recamaras']);
            $Capacidad_Cochera = Utils::sanitizeNumber($_POST['Capacidad_Cochera']);
            $Domicilio_es = Utils::sanitizeStringBlank($_POST['Domicilio_es']);
            $Propietario = Utils::sanitizeStringBlank($_POST['Propietario']);
            $Parentesco = Utils::sanitizeStringBlank($_POST['Parentesco']);
            $Telefono_Parentesco = Utils::sanitizeStringBlank($_POST['Telefono_Parentesco']);
            $Contrato_Arrendamiento = Utils::sanitizeStringBlank($_POST['Contrato_Arrendamiento']);
            $Tiempo_Contrato = Utils::sanitizeStringBlank($_POST['Tiempo_Contrato']);
            $Maps = Utils::sanitizeString($_POST['Maps']);

            $Comentarios = Utils::sanitizeStringBlank($_POST['Comentarios']);

            $flag_ubicacion = $_POST['flag_ubicacion'];
            $flag_vivienda = $_POST['flag_vivienda'];

            if ($Candidato) {
                $ubicacion = new CandidatosUbicacion();
                $ubicacion->setCandidato($Candidato);
                $ubicacion->setCalle($Calle);
                $ubicacion->setExterior($Exterior);
                $ubicacion->setInterior($Interior);
                $ubicacion->setColonia($Colonia);
                $ubicacion->setEntre_Calles($Entre_Calles);
                $ubicacion->setMunicipio($Municipio);
                $ubicacion->setEstado($Estado);
                $ubicacion->setCodigo_Postal($Codigo_Postal);
                $ubicacion->setVia_acceso('');
                $ubicacion->setFachada($Fachada);
                $ubicacion->setZona('');
                $ubicacion->setMaps($Maps);

                $vivienda = new CandidatosVivienda();
                $vivienda->setCandidato($Candidato);
                $vivienda->setTipo_Vivienda($Tipo_Vivienda);
                $vivienda->setPlantas($Plantas);
                $vivienda->setRecamaras($Recamaras);
                $vivienda->setSanitarios($Sanitarios);
                $vivienda->setCapacidad_Cochera($Capacidad_Cochera);
                $vivienda->setDomicilio_es($Domicilio_es);
                $vivienda->setPropietario($Propietario);
                $vivienda->setTerreno(0);
                $vivienda->setConstruccion(0);
                $vivienda->setValor(0);
                $vivienda->setTiempo_Viviendo($Tiempo_Viviendo);
                $vivienda->setConoce_Valor(0);
                $vivienda->setConoce_Mts(1);
                $vivienda->setConoce_Mts_C(1);
                $vivienda->setTerrenoMts('');
                $vivienda->setConstruccionMts('');
                $vivienda->setParentesco($Parentesco);
                $vivienda->setTelefono_Parentesco($Telefono_Parentesco);
                $vivienda->setContrato_Arrendamiento($Contrato_Arrendamiento);
                $vivienda->setTiempo_Contrato($Tiempo_Contrato);

                $cand = new Candidatos();
                $cand->setCandidato($Candidato);
                $cand->setComentario_Vivienda($Comentarios);
                
                if ($flag_ubicacion == 1)
                    $save_ubicacion = $ubicacion->update();
                else
                    $save_ubicacion = $ubicacion->create();

                if ($flag_vivienda == 1)
                    $save_vivienda = $vivienda->update();
                else
                    $save_vivienda = $vivienda->create();

                $save_comentario = $cand->updateComentario_Vivienda();

                if ($save_comentario) {
                    $comentarios = $cand->getComentarios();
                    $comentarios->status = 1;
                }else
                    $comentarios = array('status' => 2);

                if ($save_ubicacion) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Ubicacion == 0) {
                            $progreso->setUbicacion(5);
                            $progreso->updateUbicacion();
                        }elseif ($progress->Ubicacion == 5) {
                            $progreso->setUbicacion(10);
                            $progreso->updateUbicacion();
                        }
                    }

                    $ubicacion = $ubicacion->getOne();
                    $ubicacion->status = 1;
                }else
                    $ubicacion->status = 2;
                
                if ($save_vivienda) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Estructura == 0) {
                            $progreso->setEstructura(5);
                            $progreso->updateEstructura();
                        }elseif ($progress->Estructura == 5) {
                            $progreso->setEstructura(10);
                            $progreso->updateEstructura();
                        }
                    }

                    $vivienda = $vivienda->getOne();
                    $vivienda->Tipo_Vivienda = Utils::getTipoVivienda($vivienda->Tipo_Vivienda);
                    $vivienda->Domicilio_es = Utils::getDomicilioEs($vivienda->Domicilio_es);
                    $vivienda->status = 1;
                } else
                    $vivienda->status = 2;

                $data = array(
                    'ubicacion' => $ubicacion,
                    'vivienda' => $vivienda,
                    'comentario' => $comentarios
                );
                echo json_encode($data);

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}