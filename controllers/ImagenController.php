<?php

require_once 'models/SA/CfgImagenes.php';
require_once 'models/SA/CandidatosDocumentos.php';
require_once 'models/SA/CandidatosUbicacion.php';
require_once 'models/SA/CandidatosVivienda.php';
require_once 'models/SA/Candidatos.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/SA/Progreso.php';
require_once 'models/SA/CandidatosFolioDocumentos.php';

class ImagenController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager() || Utils::isManager())) {
            $Imagen = isset($_POST['Imagen']) ? Utils::sanitizeNumber($_POST['Imagen']) : Utils::sanitizeNumber($_GET['Imagen']);
            if ($Imagen) {
                $image = new CfgImagenes();
                $image->setImagen($Imagen);
                $data = $image->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function ver(){
        if (isset($_GET['Imagen']) && !empty($_GET['Imagen'])) {
            $Imagen = Utils::sanitizeNumber($_GET['Imagen']);
            
            if ($Imagen) {
                $image = new CfgImagenes();
                $image->setImagen($Imagen);
                $data = $image->getOneToDownload();

                if ($data) {
                    echo "<img src='{$data}'>";
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics())) {
            $Imagen = Utils::sanitizeNumber($_POST['Imagen']);
            $Tabla = Utils::sanitizeString($_POST['Tabla']);
            $Folio_Origen = Utils::sanitizeNumber($_POST['Folio_Origen']);
            $Archivo = Utils::sanitizeString($_POST['Archivo']);
            $Objeto = $_POST['Objeto'];
            $Candidato = Utils::sanitizeNumber($_POST['Candidato']);
            $Folio = Utils::sanitizeString($_POST['Folio']);
            $flag = $_POST['flag'];
            
            $Objeto = explode(';', $Objeto);
            $Objeto = explode(',', $Objeto[1]);
            $Objeto = str_replace(' ', '+', $Objeto);
            $Objeto = (base64_decode($Objeto[1]));
            $Archivo = strlen($Archivo) < 50 ? $Archivo : substr($Archivo, -50);
            if ($Tabla) {
                $image = new CfgImagenes();
                $image->setImagen($Imagen);
                $image->setTabla($Tabla);
                $image->setFolio_Origen($Folio_Origen);
                $image->setArchivo($Archivo);
                $image->setObjeto($Objeto);
                $image->setCandidato($Candidato);
                $image->setFolio($Folio);
                
                if ($flag == 1)
                    $save = $image->update();
                else{
                    if ($Tabla == 'Candidatos')
                        $image->deleteProfile();

                    if ($Tabla == 'Candidatos_Ubicacion') {
                        if ($Folio_Origen == 115) {
                            $image->deleteNumeroExteriorDomicilio();
                        }else{
                            $image->deleteExteriorDomicilio();
                        }
                    }
                    if ($Tabla == 'Candidatos_Vivienda') {
                        $image->deleteExteriorDomicilio();
                    }

                    $save = $image->create();
                }
                    
                    
                if ($save) {
                    if ($Tabla == 'RAL') {
                        $capturas_ral = $image->getCapturasRALByCandidato();
                        $display = Utils::getDisplayBotones();
                        $data = array(
                            'capturas_ral' => $capturas_ral,
                            'display' => $display,
                            'status' => 1
                        );
                    }elseif ($Tabla == 'Documentos') {
                        $foto = $image->getImagen();
                        $documento = new CandidatosDocumentos();
                        $documento->setCandidato($Candidato);
                        if ($flag == 1) {
                            $documento->setDocumento($Folio_Origen);
                            $documento->setImagen($foto);
                            //$documento->update();
                        }else{
                            $documento->setDocumento($Folio_Origen);
                            $documento->setImagen($foto);
                            $documento->create();
                        }
                        $documentos = $documento->getDocumentosByCandidato();
                        $display = Utils::getDisplayBotones();
                        $data = array(
                            'documentos' => $documentos,
                            'display' => $display,
                            'status' => 1
                        );
                    }elseif ($Tabla == 'Candidatos_Ubicacion') {
                        if ($flag == 0) {
                            if ($Folio_Origen != 115) {
                                $Foto = $image->getExteriorDomicilioID();
                                $candidate = new CandidatosUbicacion();
                                $candidate->setCandidato($Candidato);
                                $candidate->setFoto($Foto);
                                $candidate->updateFoto();
                            }else{
                                $Foto = $image->getExteriorNoDomicilioID();
                                $candidate = new CandidatosUbicacion();
                                $candidate->setCandidato($Candidato);
                                $candidate->setFoto1($Foto);
                                $candidate->updateFotoNo();
                            }
                                
                        }

                        $progreso = new Progreso();
                        $progreso->setCandidato($Candidato);
                        $progress = $progreso->getOne();
                        if ($progress->Candidato) {
                            if ($progress->Ubicacion == 5) {
                                $progreso->setUbicacion(10);
                                $progreso->updateUbicacion();
                            }
                        }

                        $vivienda = new CandidatosVivienda();
                        $vivienda->setCandidato($Candidato);
                        $vivienda = $vivienda->getOne();
                        if ($vivienda) {
                            $vivienda->Tipo_Vivienda = Utils::getTipoVivienda($vivienda->Tipo_Vivienda);
                            $vivienda->Domicilio_es = Utils::getDomicilioEs($vivienda->Domicilio_es);
                        }
                        
                        $ubicacion = new CandidatosUbicacion();
                        $ubicacion->setCandidato($Candidato);
                        $ubicacion = $ubicacion->getOne();

                        $display = Utils::getDisplayBotones();

                        $ubicacion_exterior = new CfgImagenes();
                        $ubicacion_exterior->setFolio_Origen($Candidato);
                        $ubicacion_exterior = $ubicacion_exterior->getExteriorDomicilio();//$ubicacion_exterior->getExteriorDomicilio() ? $ubicacion_exterior->getExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $ubicacion_no_exterior = new CfgImagenes();
                        $ubicacion_no_exterior->setCandidato($Candidato);
                        $ubicacion_no_exterior = $ubicacion_no_exterior->getNumeroExteriorDomicilio();//$ubicacion_no_exterior->getNumeroExteriorDomicilio() ? $ubicacion_no_exterior->getNumeroExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $ubicacion_interior = new CfgImagenes();
                        $ubicacion_interior->setFolio_Origen($Candidato);
                        $ubicacion_interior = $ubicacion_interior->getInteriorDomicilio();//$ubicacion_interior->getInteriorDomicilio() ? $ubicacion_interior->getInteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $data = array(
                            'ubicacion_exterior' => $ubicacion_exterior,
                            'ubicacion_no_exterior' => $ubicacion_no_exterior,
                            'ubicacion_interior' => $ubicacion_interior,
                            'ubicacion' => $ubicacion,
                            'vivienda' => $vivienda,
                            'display' => $display,
                            'status' => 1
                        );
                    }elseif ($Tabla == 'Candidatos_Vivienda') {
                        if ($flag == 0) {
                            $Foto = $image->getExteriorDomicilioID();
                            $candidate = new CandidatosVivienda();
                            $candidate->setCandidato($Candidato);
                            $candidate->setFoto($Foto);
                            $candidate->updateFoto();
                                
                        }

                        $progreso = new Progreso();
                        $progreso->setCandidato($Candidato);
                        $progress = $progreso->getOne();
                        if ($progress->Candidato) {
                            if ($progress->Estructura == 5) {
                                $progreso->setEstructura(10);
                                $progreso->updateEstructura();
                            }
                        }

                        $vivienda = new CandidatosVivienda();
                        $vivienda->setCandidato($Candidato);
                        $vivienda = $vivienda->getOne();
                        if ($vivienda) {
                            $vivienda->Tipo_Vivienda = Utils::getTipoVivienda($vivienda->Tipo_Vivienda);
                            $vivienda->Domicilio_es = Utils::getDomicilioEs($vivienda->Domicilio_es);
                        }
                        
                        $ubicacion = new CandidatosUbicacion();
                        $ubicacion->setCandidato($Candidato);
                        $ubicacion = $ubicacion->getOne();

                        $display = Utils::getDisplayBotones();

                        $ubicacion_exterior = new CfgImagenes();
                        $ubicacion_exterior->setFolio_Origen($Candidato);
                        $ubicacion_exterior = $ubicacion_exterior->getExteriorDomicilio();//$ubicacion_exterior->getExteriorDomicilio() ? $ubicacion_exterior->getExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $ubicacion_no_exterior = new CfgImagenes();
                        $ubicacion_no_exterior->setCandidato($Candidato);
                        $ubicacion_no_exterior = $ubicacion_no_exterior->getNumeroExteriorDomicilio();//$ubicacion_no_exterior->getNumeroExteriorDomicilio() ? $ubicacion_no_exterior->getNumeroExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $ubicacion_interior = new CfgImagenes();
                        $ubicacion_interior->setFolio_Origen($Candidato);
                        $ubicacion_interior = $ubicacion_interior->getInteriorDomicilio();//$ubicacion_interior->getInteriorDomicilio() ? $ubicacion_interior->getInteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $data = array(
                            'ubicacion_exterior' => $ubicacion_exterior,
                            'ubicacion_no_exterior' => $ubicacion_no_exterior,
                            'ubicacion_interior' => $ubicacion_interior,
                            'ubicacion' => $ubicacion,
                            'vivienda' => $vivienda,
                            'display' => $display,
                            'status' => 1
                        );
                    }elseif ($Tabla == 'Candidatos') {
                        $Candidato = $Folio_Origen;
                        if ($flag == 0) {
                            $Foto = $image->getProfileID();
                            $candidate = new Candidatos();
                            $candidate->setCandidato($Candidato);
                            $candidate->setFoto($Foto);
                            $candidate->updateFoto();
                        }

                        $candidato = new CandidatosDatos();
                        $candidato->setCandidato($Candidato);
                        $candidato_datos = $candidato->getOne();

                        $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                        $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                        $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                        $perfil = new CfgImagenes();
                        $perfil->setFolio_Origen($Folio_Origen);
                        $perfil->setTabla('Candidatos');
                        $perfil = $perfil->getProfile();

                        if (!$perfil) {
                            if ($candidato_datos->Sexo == 99)
                                $perfil = array('../dist/img/user-icon-rose.png', 'png');
                            else
                                $perfil = array('../dist/img/user-icon.png', 'png');
                        }
                        $display = Utils::getDisplayBotones();
                        $data = array(
                            'candidato_datos' => $candidato_datos,
                            'perfil' => $perfil,
                            'status' => 1,
                            'display' => $display
                        );
                    }
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
            $Imagen = Utils::sanitizeNumber($_POST['Imagen']);
            $Tabla = Utils::sanitizeString($_POST['Tabla']);
            $Candidato = Utils::sanitizeNumber($_POST['Candidato']);
            $Folio_Origen = Utils::sanitizeNumber($_POST['Folio_Origen']);

            if ($Imagen) {
                $image = new CfgImagenes();
                $image->setImagen($Imagen);
                $image->setTabla($Tabla);
                $image->setCandidato($Candidato);
                
                $delete = $image->delete();

                if ($delete) {
                    if ($Tabla == 'RAL') {
                        $capturas_ral = $image->getCapturasRALByCandidato();
                        $display = Utils::getDisplayBotones();
                        $data = array(
                            'capturas_ral' => $capturas_ral,
                            'tabla' => $Tabla,
                            'display' => $display,
                            'status' => 1
                        );
                    }elseif ($Tabla == 'Documentos') {
                        $documento = new CandidatosDocumentos();
                        $documento->setCandidato($Candidato);
                        $documento->setImagen($Imagen);
                        $documento->delete();
                        $documentos = $documento->getDocumentosByCandidato();
                        $display = Utils::getDisplayBotones();
                        $data = array(
                            'documentos' => $documentos,
                            'display' => $display,
                            'status' => 1
                        );
                    }elseif ($Tabla == 'Candidatos_Ubicacion') {
                        $ubicacion = new CandidatosUbicacion();
                        $ubicacion->setCandidato($Candidato);
                        
                        if ($Folio_Origen != 115) {
                            $ubicacion->setFoto(0);
                            $ubicacion->updateFoto();
                        }else{
                            $ubicacion->setFoto1(0);
                            $ubicacion->updateFotoNo();
                        }

                        $ubicacion = $ubicacion->getOne();

                        $vivienda = new CandidatosVivienda();
                        $vivienda->setCandidato($Candidato);
                        $vivienda = $vivienda->getOne();
                        if ($vivienda) {
                            $vivienda->Tipo_Vivienda = Utils::getTipoVivienda($vivienda->Tipo_Vivienda);
                            $vivienda->Domicilio_es = Utils::getDomicilioEs($vivienda->Domicilio_es);
                        }
                        

                        $display = Utils::getDisplayBotones();

                        $ubicacion_exterior = new CfgImagenes();
                        $ubicacion_exterior->setFolio_Origen($Candidato);
                        $ubicacion_exterior = $ubicacion_exterior->getExteriorDomicilio();//$ubicacion_exterior->getExteriorDomicilio() ? $ubicacion_exterior->getExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $ubicacion_no_exterior = new CfgImagenes();
                        $ubicacion_no_exterior->setCandidato($Candidato);
                        $ubicacion_no_exterior = $ubicacion_no_exterior->getNumeroExteriorDomicilio();//$ubicacion_no_exterior->getNumeroExteriorDomicilio() ? $ubicacion_no_exterior->getNumeroExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $ubicacion_interior = new CfgImagenes();
                        $ubicacion_interior->setFolio_Origen($Candidato);
                        $ubicacion_interior = $ubicacion_interior->getInteriorDomicilio();//$ubicacion_interior->getInteriorDomicilio() ? $ubicacion_interior->getInteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $data = array(
                            'ubicacion_exterior' => $ubicacion_exterior,
                            'ubicacion_no_exterior' => $ubicacion_no_exterior,
                            'ubicacion_interior' => $ubicacion_interior,
                            'ubicacion' => $ubicacion,
                            'vivienda' => $vivienda,
                            'display' => $display,
                            'status' => 1
                        );

                    }elseif ($Tabla == 'Candidatos_Vivienda') {
                        $vivienda = new CandidatosVivienda();
                        $vivienda->setCandidato($Candidato);
                        $vivienda->setFoto(0);
                        $vivienda->updateFoto();
                        $vivienda = $vivienda->getOne();

                        if ($vivienda) {
                            $vivienda->Tipo_Vivienda = Utils::getTipoVivienda($vivienda->Tipo_Vivienda);
                            $vivienda->Domicilio_es = Utils::getDomicilioEs($vivienda->Domicilio_es);
                        }

                        $ubicacion = new CandidatosUbicacion();
                        $ubicacion->setCandidato($Candidato);
                        $ubicacion = $ubicacion->getOne();
                        
                        $display = Utils::getDisplayBotones();

                        $ubicacion_exterior = new CfgImagenes();
                        $ubicacion_exterior->setFolio_Origen($Candidato);
                        $ubicacion_exterior = $ubicacion_exterior->getExteriorDomicilio();//$ubicacion_exterior->getExteriorDomicilio() ? $ubicacion_exterior->getExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $ubicacion_no_exterior = new CfgImagenes();
                        $ubicacion_no_exterior->setCandidato($Candidato);
                        $ubicacion_no_exterior = $ubicacion_no_exterior->getNumeroExteriorDomicilio();//$ubicacion_no_exterior->getNumeroExteriorDomicilio() ? $ubicacion_no_exterior->getNumeroExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $ubicacion_interior = new CfgImagenes();
                        $ubicacion_interior->setFolio_Origen($Candidato);
                        $ubicacion_interior = $ubicacion_interior->getInteriorDomicilio();//$ubicacion_interior->getInteriorDomicilio() ? $ubicacion_interior->getInteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                        $data = array(
                            'ubicacion_exterior' => $ubicacion_exterior,
                            'ubicacion_no_exterior' => $ubicacion_no_exterior,
                            'ubicacion_interior' => $ubicacion_interior,
                            'ubicacion' => $ubicacion,
                            'vivienda' => $vivienda,
                            'display' => $display,
                            'status' => 1
                        );

                    }elseif ($Tabla == 'Candidatos') {
                        $candidate = new Candidatos();
                        $candidate->setCandidato($Candidato);
                        $candidate->setFoto(0);
                        $candidate->updateFoto();

                        $candidato = new CandidatosDatos();
                        $candidato->setCandidato($Candidato);
                        $candidato_datos = $candidato->getOne();

                        $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                        $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                        $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                        $perfil = new CfgImagenes();
                        $perfil->setFolio_Origen($Candidato);
                        $perfil->setTabla('Candidatos');
                        $perfil = $perfil->getProfile();

                        if (!$perfil) {
                            if ($candidato_datos->Sexo == 99)
                                $perfil = array('../dist/img/user-icon-rose.png', 'png');
                            else
                                $perfil = array('../dist/img/user-icon.png', 'png');
                        }
                        $display = Utils::getDisplayBotones();
                        $data = array(
                            'candidato_datos' => $candidato_datos,
                            'perfil' => $perfil,
                            'status' => 1,
                            'display' => $display
                        );
                    }
                    echo json_encode($data);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function getDocumentosPorCompletar(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $image = new CfgImagenes();
                $image->setCandidato($Candidato);
                $data = $image->getDocumentosFaltantesPorCandidato();
                $data = array_values($data);

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function getComentario(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            
            if ( $Candidato) {
                $candidato = new Candidatos();
                $candidato->setCandidato($Candidato);
                $doc = new CandidatosFolioDocumentos();
                $doc->setCandidato($Candidato);
                $data = array(
                    'Comentario_Documentos' => $candidato->getComentarios()->Comentario_Documentos,
                    'Redes_Sociales' => $doc->getOne()->Redes_Sociales
                );

                if ($data) {
                    echo json_encode($data);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save_comentario(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Comentario_Documentos = Utils::sanitizeString($_POST['Comentario_Documentos']);
            $Redes_Sociales = Utils::sanitizeString($_POST['Redes_Sociales']);

            if ($Candidato) {
                $candidate = new Candidatos();
                $candidate->setCandidato($Candidato);
                $candidate->setComentario_Documentos($Comentario_Documentos);
                
                $save = $candidate->updateComentarioDocumentos();

                $doc = new CandidatosFolioDocumentos();
                $doc->setCandidato($Candidato);
                $doc->setRedes_Sociales($Redes_Sociales);

                $savee = $doc->updateRedesSociales();
                    
                if ($save || $savee) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Documentos == 0) {
                            $progreso->setDocumentos(10);
                            $progreso->updateDocumentos();
                        }
                    }

                    $documento = new CandidatosDocumentos();
                    $documento->setCandidato($Candidato);
                    $documentos = $documento->getDocumentosByCandidato();

                    $candidato = new Candidatos();
                    $candidato->setCandidato($Candidato);
                    $comentarios = $candidato->getComentarios()->Comentario_Documentos;

                    $doc = new CandidatosFolioDocumentos();
                    $doc->setCandidato($Candidato);
                    $Redes_Sociales = $doc->getOne()->Redes_Sociales;

                    $display = Utils::getDisplayBotones();
                    $data = array(
                        'documentos' => $documentos,
                        'Comentario_Documentos' => $comentarios,
                        'Redes_Sociales' => $Redes_Sociales,
                        'display' => $display,
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