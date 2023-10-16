<?php

require_once 'models/SA/CfgImagenes.php';
require_once 'models/SA/Candidatos.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/ContactosCliente.php';
require_once 'models/SA/ContactosClienteSolicitan.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/ValidacionLicenciaFederal.php';
require_once 'models/SA/CandidatosRAL.php';
require_once 'models/SA/CandidatosFolioDocumentos.php';
require_once 'models/SA/ConociendoCandidato.php';
require_once 'models/SA/CandidatosEscolaridad.php';
require_once 'models/SA/CandidatosSalud.php';
require_once 'models/SA/CandidatosSaludSeguros.php';
require_once 'models/SA/CandidatosCohabitan.php';
require_once 'models/SA/CirculoFamiliar.php';
require_once 'models/SA/CandidatosVivienda.php';
require_once 'models/SA/CandidatosUbicacion.php';
require_once 'models/SA/Enseres.php';
require_once 'models/SA/CandidatosReferencias.php';
require_once 'models/SA/CandidatosIngresos.php';
require_once 'models/SA/CandidatosEgresos.php';
require_once 'models/SA/CandidatosCreditos.php';
require_once 'models/SA/CandidatosBancarias.php';
require_once 'models/SA/CandidatosSeguros.php';
require_once 'models/SA/CandidatosInmuebles.php';
require_once 'models/SA/CandidatosVehiculos.php';
require_once 'models/SA/Investigacion_Laboral.php';
require_once 'models/SA/CandidatosDocumentos.php';
require_once 'models/SA/CandidatosLaborales.php';
require_once 'models/SA/CandidatosLaboraleConceptos.php';
require_once 'models/SA/CandidatosObsGenerales.php';
require_once 'models/SA/EjecutivosPlazas.php';
require_once 'models/SA/Clientes.php';
require_once 'models/SA/Progreso.php';
require_once 'models/RAL/Busqueda_RAL.php';
require_once 'models/RAL/Expediente_RAL.php';
require_once 'models/RAL/Acuerdos_RAL.php';
require_once 'models/User.php';
require_once 'models/RAL/EstadosMX/Tamaulipas.php';
require_once 'models/RAL/EstadosMX/SanLuisPotosi.php';
require_once 'models/SA/NotasEjecutivo.php';
require_once 'models/SA/SOI.php';
require_once 'helpers/FormatosSA/SOIQR.php';

class ServicioApoyoController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager() || Utils::isLogistics()) {

            if (!Utils::isCustomerSA()) {
                if (Utils::isAccount()) {
                    $estudio = new Candidatos();
                    $estudio->setEjecutivo($_SESSION['identity']->username);
                    $estudios = $estudio->getServiciosPorEjecutivo();
                } elseif (Utils::isLogistics()) {
                    $estudio = new Candidatos();
                    $estudio->setLogistica($_SESSION['identity']->username);
                    $estudios = $estudio->getServiciosPorLogistica();
                } else {
                    $estudio = new Candidatos();
                    if (isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['Empresa']) && $_POST['Empresa'] != 0) {

                        if ($_POST['start_date'] > $_POST['end_date']) {
                            $aux = $_POST['start_date'];
                            $_POST['start_date'] = $_POST['end_date'];
                            $_POST['end_date'] = $aux;
                        }

                        $estudio->setFecha_solicitud($_POST['start_date']);
                        $estudio->setFecha_Entregado($_POST['end_date']);
                        $estudios = $estudio->getServiciosPorRangoDeFechaConCanceladosEmpresa($_POST['Empresa']);
                    } elseif (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                        if ($_POST['start_date'] > $_POST['end_date']) {
                            $aux = $_POST['start_date'];
                            $_POST['start_date'] = $_POST['end_date'];
                            $_POST['end_date'] = $aux;
                        }
                        $estudio->setFecha_solicitud($_POST['start_date']);
                        $estudio->setFecha_Entregado($_POST['end_date']);
                        $estudios = $estudio->getServiciosPorRangoDeFechaConCancelados();
                    } else
                        $estudios = $estudio->getServiciosUltimos30();
                }

                $page_title = 'Estudios SocioEconómicos | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/ese/index.php';
                require_once 'views/ese/modal-config.php';
                require_once 'views/ese/modal-schedule.php';
                require_once 'views/layout/footer.php';
            } else {

                //esto es para los clientes
                //Para usuarios que tienen mas de una empresa
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $contactos = $contactoEmpresa->getContactoPorUsuario2();

                $id = $_SESSION['identity']->id;
                $estudios = [];
                $estudioObj = new Candidatos();

                foreach ($contactos as $contacto) {
                    $id_contacto = $contacto['ID'];
                    $id_empresa = $contacto['Empresa'];

                    $estudioObj->setContacto($id_contacto);
                    if ($contacto['tipo_usuario'] != 0) {
                        $ContactosClienteSolicitanObj = new ContactosClienteSolicitan();
                        $ContactosClienteSolicitanObj->setUsuario($_SESSION['identity']->username);
                        $ContactosClienteSolicitan = $ContactosClienteSolicitanObj->getAllContactoPorUsuario();
                        $estudio1 = [];

                        foreach ($ContactosClienteSolicitan as $cliente) {
                            $estudioObj->setCliente($cliente['Cliente']);
                            $estudioObj->setContacto($_SESSION['identity']->username);
                            $estudio2 = $estudioObj->getServiciosPorUsuario();
                            $estudio1 = array_merge($estudio1, $estudio2);
                        }
                    } else if ($id_empresa == 45) { //Para transpais del 2022 a actual
                        $estudio1 = $estudioObj->getServiciosPorContactoTranspais();
                    } else {
                        $estudio1 = $estudioObj->getServiciosPorContacto();
                    }

                    $estudios = array_merge($estudios, $estudio1);
                }

                $page_title = 'Estudios SocioEconómicos | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                if ($id_empresa == 413) //charger
                {
                    require_once 'views/ese/index_clientes/index_clientes_charger.php';
                } else if ($id_empresa == 525 && ($id != 9517 && $id != 9518 && $id != 9510 && $id != 9511 && $id != 9512 && $id != 9513)) //prudentia
                {
                    require_once 'views/ese/index_clientes/index_clientes_prudential.php';
                } else {
                    require_once 'views/ese/index_clientes.php';
                }
                require_once 'views/layout/modal-encuesta.php';
                require_once 'views/layout/footer.php';
            }
        } else
            header('location:' . base_url);
    }


    public function crear()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
            }

            $page_title = 'Nuevo servicio de apoyo | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/create.php';
            if (Utils::isCustomerSA())
                require_once 'views/layout/modal-encuesta.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function create()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            $Nombres = Utils::sanitizeStringBlank($_POST['Nombres']);
            $Apellido_Paterno = Utils::sanitizeStringBlank($_POST['Apellido_Paterno']);
            $Apellido_Materno = Utils::sanitizeStringBlank($_POST['Apellido_Materno']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);
            $Ciudad = Utils::sanitizeString($_POST['Ciudad']);
            $Cuenta_con = $_POST['Cuenta_con'];
            $CURP = Utils::sanitizeStringBlank($_POST['CURP']);
            $NSS = Utils::sanitizeStringBlank($_POST['NSS']);
            $Fecha_Nacimiento = Utils::sanitizeStringBlank($_POST['Fecha_Nacimiento']);
            $Lugar_Nacimiento = Utils::sanitizeStringBlank($_POST['Lugar_Nacimiento']);
            $Telefono = Utils::sanitizeStringBlank($_POST['Telefono']);
            $Puesto = Utils::sanitizeStringBlank($_POST['Puesto']);
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Servicio_Solicitado = Utils::sanitizeNumber($_POST['Servicio_Solicitado']);
            $Ejecutivo = Utils::sanitizeStringBlank($_POST['Ejecutivo']);
            $Razon = Utils::sanitizeStringBlank($_POST['Razon']);
            $CC_Cliente = Utils::sanitizeStringBlank($_POST['CC_Cliente']);
            $Comentarios_Cliente = Utils::sanitizeStringBlank($_POST['Comentarios_Cliente']);
            $Plaza_Cliente = Utils::sanitizeStringBlank($_POST['Plaza_Cliente']);

            $Nivel = Utils::sanitizeNumber($_POST['Nivel']);

            $Folio = Utils::sanitizeNumber($_POST['Folio']);

            $Tipo_Licencia = Utils::sanitizeNumber($_POST['Tipo_Licencia']);
            $Numero_Licencia = Utils::sanitizeStringBlank($_POST['Numero_Licencia']);
            $Numero_Examen = Utils::sanitizeStringBlank($_POST['Numero_Examen']);

            $resume = isset($_FILES['resume']) && $_FILES['resume']['name'] != '' ? $_FILES['resume'] : FALSE;

            $duplicar = isset($_POST['duplicar']) && $_POST['duplicar'] != 0 ? $_POST['duplicar'] : false;

            if ($Nombres && $Apellido_Paterno && $Estado && $Ciudad && $Cliente && $Servicio_Solicitado) {

                $Fase = $Servicio_Solicitado == 299 ? 231 : ($Servicio_Solicitado == 300 ? 230 : ($Servicio_Solicitado == 311 || $Servicio_Solicitado == 310 ? 310 : ($Servicio_Solicitado == 291 ? 291 : 298)));

                $Servicio_Solicitado = $Servicio_Solicitado == 299 ? 231 : ($Servicio_Solicitado == 300 ? 230 : ($Servicio_Solicitado));

                if (Utils::isCustomerSA()) {
                    $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
                    $persona_solicitan = new ContactosClienteSolicitan();
                    $persona_solicitan->setUsuario($_SESSION['identity']->username);
                    $persona_solicitan->setCliente($Cliente);
                    $Nombre_Cliente = $persona_solicitan->getOne();
                    if ($Nombre_Cliente)
                        $Nombre_Cliente = $Nombre_Cliente->ID;
                    else {
                        $persona_solicitan->setEmpresa($Empresa);
                        $persona_solicitan->setNombre($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name);
                        if ($persona_solicitan->create())
                            $Nombre_Cliente = $persona_solicitan->getID();
                        else
                            $Nombre_Cliente = 0;
                    }
                } else {
                    //$Nombre_Cliente = 0;
                    $Nombre_Cliente = Utils::sanitizeNumber($_POST['Nombre_Cliente']);
                }
                $Ejecutivo = $Ejecutivo && !empty($Ejecutivo) ? $Ejecutivo : 'angelesdelacruz';
                $estudio = new Candidatos();
                if (Utils::isAdmin() && ($Cliente == 584 || $Cliente == 670 || $Cliente == 598 || $Cliente == 593 || $Cliente == 599 || $Cliente == 669)) {
                    // ===[19 de mayo 2023 estudios]===
                    $duplicado = $estudio->GetOnePorCurp($Cliente, $CURP);
                    $duplicado = $duplicado->total + 1;
                    $estudio->setReplicado($duplicado);
                    // ===[19 de mayo 2023 estudios fin]===
                } else
                    $estudio->setReplicado(Null);

                $estudio->setFecha_solicitud(Utils::getFechaIngresoSA($Cliente));
                $estudio->setPuesto($Puesto);
                $estudio->setCiudad($Ciudad);
                $estudio->setEjecutivo($Ejecutivo);
                $estudio->setRazon($Razon);
                $estudio->setEstado(250);
                $estudio->setServicio_Solicitado($Servicio_Solicitado);
                //$estudio->setFase(($Nivel == 4 || $Nivel == 1) && ($Cliente == 264 || $Cliente == 265 || $Cliente == 297 || $Cliente == 301 || $Cliente == 302 || $Cliente == 303 || $Cliente == 315 || $Cliente == 316) ? 310 : 298);
                $estudio->setFase($Fase);
                $estudio->setCliente($Cliente);
                $estudio->setNombre_Cliente($Nombre_Cliente);
                $estudio->setComentario_Cliente($Comentarios_Cliente);
                $estudio->setCC_Cliente($CC_Cliente);
                $estudio->setPlaza_cliente($Plaza_Cliente);
                $estudio->setNivel($Nivel);

                if ($Servicio_Solicitado == 291) {
                    $estudio->setFecha_solicitud(date('Y-m-d H:i:s', time()));
                    $estudio->setFase(291);
                    $estudio->setEjecutivo('');
                    $estudio->setEstado(250);
                    $estudio->setNivel(1);
                }



                $save = $estudio->create();
                if ($save) {
                    $Candidato = $estudio->getCandidato();

                    if ($Folio != 0) {
                        $cdto = new Candidatos();
                        if ($Servicio_Solicitado == 231 || $Servicio_Solicitado == 299) {
                            $cdto->setIL($Candidato);
                            $cdto->setCandidato($Folio);
                            $cdto->updateIL();
                        } elseif ($Servicio_Solicitado == 230 || $Servicio_Solicitado == 300) {
                            $cdto->setESE($Candidato);
                            $cdto->setCandidato($Folio);
                            $cdto->updateESE();
                        }
                        $cdto->setFase(291);
                        $cdto->setEstado(252);
                        $cdto->setComentario_Finalizacion('');
                        $cdto->saveFinalizacion();
                    }

                    if ($Servicio_Solicitado == 5) {
                        $estudio->setServicio_Solicitado(230);
                        $estudio->setFase(230);
                        $estudio->create();
                        $Candidato2 = $estudio->getCandidato();
                    }

                    /* if ($Servicio_Solicitado == 230 && $Nivel == 4) {
                        $estudio->setServicio_Solicitado(230);
                        $estudio->setFase(230);
                        $estudio->create();
                        $Candidato2 = $estudio->getCandidato();
                    } */

                    $candidato_datos = new CandidatosDatos();
                    $candidato_datos->setCandidato($Candidato);
                    $candidato_datos->setNombres($Nombres);
                    $candidato_datos->setApellido_Paterno($Apellido_Paterno);
                    $candidato_datos->setApellido_Materno($Apellido_Materno);
                    $candidato_datos->setNacimiento($Fecha_Nacimiento);
                    $candidato_datos->setLugar_Nacimiento($Lugar_Nacimiento);
                    $candidato_datos->setSexo(0);
                    $candidato_datos->setEstado_Civil(0);
                    $candidato_datos->setFecha_Matrimonio('');
                    $candidato_datos->setHijos(0);
                    $candidato_datos->setVive_con('');
                    $candidato_datos->setTelefono_fijo('');
                    $candidato_datos->setCelular($Telefono);
                    $candidato_datos->setOtro_Contacto('');
                    $candidato_datos->setCorreos('');
                    $candidato_datos->setCURP($CURP);
                    $candidato_datos->setIMSS($NSS);
                    $save_datos = $candidato_datos->create();

                    if ($Servicio_Solicitado == 5) {
                        $candidato_datos->setCandidato($Candidato2);
                        $candidato_datos->create();
                    }

                    /* if ($Servicio_Solicitado == 230 && $Nivel == 4) {
                        $candidato_datos->setCandidato($Candidato2);
                        $candidato_datos->create();
                    } */

                    /*if (($Nivel == 4 || $Nivel == 1) && ($Cliente == 264 || $Cliente == 265 || $Cliente == 297 || $Cliente == 301 || $Cliente == 302 || $Cliente == 303 || $Cliente == 315 || $Cliente == 316)) {
                        $vlf = new ValidacionLicenciaFederal();
                        $vlf->setCandidato($Candidato);
                        $vlf->setNumero_Licencia($Numero_Licencia);
                        $vlf->setNumero_Examen($Numero_Examen);
                        $vlf->create();
                    }*/

                    if ($Servicio_Solicitado == 310) {
                        $vlf = new ValidacionLicenciaFederal();
                        $vlf->setCandidato($Candidato);
                        $vlf->setTipo_Licencia($Tipo_Licencia);
                        $vlf->setNumero_Licencia($Numero_Licencia);
                        $vlf->setNumero_Examen($Numero_Examen);
                        $vlf->create();
                    }

                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progreso->create();
                    if ($Nivel == 1) {
                        $progreso->setDatos_Adicionales(10);
                        $progreso->updateDatosAdicionales();
                    }

                    if ($Servicio_Solicitado == 5) {
                        $progreso->setCandidato($Candidato2);
                        $progreso->create();

                        if ($Nivel == 1) {
                            $progreso->setDatos_Adicionales(10);
                            $progreso->updateDatosAdicionales();
                        }
                    }

                    /* if ($Servicio_Solicitado == 230 && $Nivel == 4) {
                        $progreso->setCandidato($Candidato2);
                        $progreso->create();

                        $progreso->setDatos_Adicionales(10);
                        $progreso->updateDatosAdicionales();
                    } */

                    if ($save_datos) {
                        $folio_docs = new CandidatosFolioDocumentos();
                        $folio_docs->setCandidato($Candidato);
                        $folio_docs->setActa_Nacimiento('');
                        $folio_docs->setLicencia('');
                        $folio_docs->setINE('');
                        $folio_docs->setCartilla_Militar('');
                        $folio_docs->setCURP($CURP);
                        $folio_docs->setRFC('');
                        $folio_docs->setNSS($NSS);
                        $folio_docs->setAfore('');
                        $folio_docs->setComprobante_domicilio('');
                        $folio_docs->setP_Acta(0);
                        $folio_docs->setP_Licencia(0);
                        $folio_docs->setP_INE(0);
                        $folio_docs->setP_Cartilla_Militar(0);
                        $folio_docs->setP_CURP(0);
                        $folio_docs->setP_RFC(0);
                        $folio_docs->setP_NSS(0);
                        $folio_docs->setP_Afore(0);
                        $folio_docs->setP_ComprobanteD(0);
                        $folio_docs->setRedes_Sociales('');
                        $folio_docs->create();

                        if ($Servicio_Solicitado == 5) {
                            $folio_docs->setCandidato($Candidato2);
                            $folio_docs->create();
                        }

                        /* if ($Servicio_Solicitado == 230 && $Nivel == 4) {
                            $folio_docs->setCandidato($Candidato2);
                            $folio_docs->create();
                        } */

                        $ubicacion = new CandidatosUbicacion();
                        $ubicacion->setCandidato($Candidato);
                        $ubicacion->setCalle('');
                        $ubicacion->setExterior('');
                        $ubicacion->setInterior('');
                        $ubicacion->setColonia('');
                        $ubicacion->setEntre_Calles('');
                        $ubicacion->setMunicipio($Ciudad);
                        $ubicacion->setEstado($Estado);
                        $ubicacion->setCodigo_Postal('');
                        $ubicacion->setVia_acceso('');
                        $ubicacion->setFachada('');
                        $ubicacion->setZona('');
                        $ubicacion->create();

                        if ($Servicio_Solicitado == 5) {
                            $ubicacion->setCandidato($Candidato2);
                            $ubicacion->create();
                        }

                        /* if ($Servicio_Solicitado == 230 && $Nivel == 4) {
                            $ubicacion->setCandidato($Candidato2);
                            $ubicacion->create();
                        } */

                        if ($resume) {
                            $allowed_formats = array("application/pdf");
                            $limit_kb = 20000;
                            if (!in_array($_FILES["resume"]["type"], $allowed_formats) || $_FILES["resume"]["size"] > $limit_kb * 1024) {
                                //echo 4;
                            } else {

                                $route = './curriculums/';
                                $resume = $route . $Candidato . '.pdf';

                                //if(!file_exists($resume)){
                                $result = move_uploaded_file($_FILES["resume"]["tmp_name"], $resume);
                                //}
                            }
                        }

                        if ($duplicar) {
                            $estudio->copiarInfo($duplicar);

                            $candidato_datos->copiarInfo($duplicar);

                            if (!$folio_docs->getOne())
                                $folio_docs->duplicate($estudio);
                            else
                                $folio_docs->copiarInfo($duplicar);

                            $ubicacion = new CandidatosUbicacion();
                            $ubicacion->setCandidato($Candidato);
                            if (!$ubicacion->getOne())
                                $ubicacion->duplicate($duplicar);
                            else
                                $ubicacion->copiarInfo($duplicar);

                            $vivienda = new CandidatosVivienda();
                            $vivienda->setCandidato($Candidato);
                            $vivienda->duplicate($duplicar);

                            $escolaridad = new CandidatosEscolaridad();
                            $escolaridad->setCandidato($Candidato);
                            $escolaridad->duplicate($duplicar);

                            /*$salud = new CandidatosSalud();
                            $salud->setCandidato($Candidato);
                            $salud->duplicate($duplicar);*/

                            /*$s_seguro = new CandidatosSaludSeguros();
                            $s_seguro->setCandidato($Candidato);
                            $s_seguro->duplicate($duplicar);*/

                            $cohabitan = new CandidatosCohabitan();
                            $cohabitan->setCandidato($Candidato);
                            $cohabitan->duplicate($duplicar);

                            $referencia = new CandidatosReferencias();
                            $referencia->setCandidato($Candidato);
                            $referencia->duplicate($duplicar);

                            $laboral = new CandidatosLaborales();
                            $laboral->setCandidato($Candidato);
                            $laboral->duplicate($duplicar);

                            $laboral_concepto = new CandidatosLaboralesConceptos();
                            $laboral_concepto->setCandidato($Candidato);
                            $laboral_concepto->duplicate($duplicar);

                            $ingreso = new CandidatosIngresos();
                            $ingreso->setCandidato($Candidato);
                            $ingreso->duplicate($duplicar);

                            $egreso = new CandidatosEgresos();
                            $egreso->setCandidato($Candidato);
                            $egreso->duplicate($duplicar);

                            $credito = new CandidatosCreditos();
                            $credito->setCandidato($Candidato);
                            $credito->duplicate($duplicar);

                            $bancaria = new CandidatosBancarias();
                            $bancaria->setCandidato($Candidato);
                            $bancaria->duplicate($duplicar);

                            $seguro = new CandidatosSeguros();
                            $seguro->setCandidato($Candidato);
                            $seguro->duplicate($duplicar);

                            $inmueble = new CandidatosInmuebles();
                            $inmueble->setCandidato($Candidato);
                            $inmueble->duplicate($duplicar);

                            $vehiculo = new CandidatosVehiculos();
                            $vehiculo->setCandidato($Candidato);
                            $vehiculo->duplicate($duplicar);

                            $investigacion = new Investigacion_Laboral;
                            $investigacion->setCandidato($Candidato);
                            $investigacion->duplicate($duplicar);

                            /*$conociendo_candidato = new ConociendoCandidato();
                            $conociendo_candidato->setCandidato($Candidato);
                            $conociendo_candidato->duplicate($duplicar);*/
                        }

                        $customer = new Clientes();
                        $customer->setCliente($Cliente);
                        $clientee = $customer->getOne();
                        $Nombre_Cliente = $clientee->Nombre_Cliente;
                        $id_cliente = $clientee->Cliente;

                        $Asunto = 'Nueva solicitud registrada de ' . $Nombre_Cliente;
                        $Reclutador = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;

                        $usuario_ejecutivo = Utils::getUserByUsername($Ejecutivo);
                        $Correo_Ejecutivo = $usuario_ejecutivo->email;
                        $id_user = $usuario_ejecutivo->id;
                        $Tipo_Solicitud = $Servicio_Solicitado == 230 ? 'Estudio Socioeconómico' : ($Servicio_Solicitado == 231 ? 'Investigación Laboral' : ($Servicio_Solicitado == 298 || $Servicio_Solicitado == 291 ? 'Reporte de Antecedentes Legales' : ($Servicio_Solicitado == 5 ? 'Reporte de Antecedentes Legales y Estudio Socioeconómico' : ($Servicio_Solicitado == 300 ? 'Verificación domiciliaria' : ($Servicio_Solicitado == 5 ? 'Reporte de Antecedentes Legales y Estudio Socioeconómico' : ($Servicio_Solicitado == 323 ? 'Estudio Socioeconómico con Visita Presencial' : ''))))));
                        $Nombre_Candidato = $Nombres . ' ' . $Apellido_Paterno . ' ' . $Apellido_Materno;
                        $Enlace = "https://rrhh-ingenia.com.mx/ServicioApoyo/ver&candidato=" . Encryption::encode($Candidato);

                        $auto_ral = 0;

                        if ($Servicio_Solicitado != 291) {
                            if ($Servicio_Solicitado == 5) {
                                $Enlace2 = "https://rrhh-ingenia.com.mx/ServicioApoyo/ver&candidato=" . Encryption::encode($Candidato2);
                                $body = "
                                <!DOCTYPE html>
                                <html>
                                    <head>
                                        <title>Nueva Solicitud</title> 
                                    </head>
                                    <body>
                                        <label>Nueva solicitud de <b>${Tipo_Solicitud}</b> registrado por <b>${Reclutador}</b>.</label>
                                        <br/><br/>
                                        <label>Candidato: <b>${Nombre_Candidato}</b></label><br/>
                                        <label>Telefono: <b>${Telefono}</b></label><br/>
                                        ${Comentarios_Cliente}
                                        <br></br>
                                        <label>Para mas detalles del RAL hacer clic </label>
                                        <a href='${Enlace}'>aqui!</a>
                                        <br/>
                                        <label>Para mas detalles del ESE hacer clic </label>
                                        <a href='${Enlace2}'>aqui!</a>
                                        <br/>
                                        <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>                                </body>
                                </html> ";
                            } else {
                                $body = "
                                <!DOCTYPE html>
                                <html>
                                    <head>
                                        <title>Nueva Solicitud</title> 
                                    </head>
                                    <body>
                                        <label>Nueva solicitud de <b>${Tipo_Solicitud}</b> registrado por <b>${Reclutador}</b>.</label>
                                        <br/><br/>
                                        <label>Candidato: <b>${Nombre_Candidato}</b></label><br/>
                                        <label>Telefono: <b>${Telefono}</b></label><br/>
                                        ${Comentarios_Cliente}
                                        <br></br>
                                        <label>Para mas detalles hacer clic </label>
                                        <a href='${Enlace}'>aqui!</a>
                                        <br/>
                                        <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>                                </body>
                                </html>";
                            }

                            Utils::newNotification($Reclutador . ' de ' . $Nombre_Cliente . ' solicita ' . $Tipo_Solicitud, $Enlace, 1, $Servicio_Solicitado == 231 || $Servicio_Solicitado == 299 ? 1 : ($Servicio_Solicitado == 230 || $Servicio_Solicitado == 300 ? 2 : ($Servicio_Solicitado == 328 ? 3 : 16)), $id_user, $_SESSION['identity']->id, $id_cliente);
                            Utils::sendEmail($Correo_Ejecutivo, $Reclutador, $Asunto, $body);

                            if ($Servicio_Solicitado == 300 || $Servicio_Solicitado == 230) {
                                $ejecutivo = new EjecutivosPlazas();
                                $ejecutivo->setID_Cliente($Cliente);
                                $Logistica = $ejecutivo->getEjecutivosPorClienteLogistica();
                                $id_logistica = $Logistica->id;
                                if ($Logistica) {
                                    $estudio->setLogistica(strtoupper($Logistica->username));
                                    $estudio->setFecha_aplicacion(NULL);
                                    $estudio->updateSchedule();
                                    Utils::sendEmail($Logistica->email, $Logistica->first_name . ' ' . $Logistica->last_name, $Asunto, $body);
                                    Utils::newNotification($Reclutador . ' de ' . $Nombre_Cliente . ' solicita ' . $Tipo_Solicitud, $Enlace, 1, $Servicio_Solicitado == 231 || $Servicio_Solicitado == 299 ? 1 : ($Servicio_Solicitado == 230 || $Servicio_Solicitado == 300 ? 2 : ($Servicio_Solicitado == 328 ? 3 : 16)), $id_logistica, $_SESSION['identity']->id, $id_cliente);
                                }
                            }


                            $Asunto2 = 'Confirmación de solicitud de ' . $Tipo_Solicitud . ' para ' . $Nombre_Candidato;
                            $body2 = "
                            <!DOCTYPE html>
                            <html>
                                <head>
                                    <title>Nueva Solicitud</title> 
                                </head>
                                <body>
                                    <label>Estimado(a) <b>${Reclutador}</b>, se ha registrado con éxito su nueva solicitud de <b>${Tipo_Solicitud}</b>.</label><br/><br/>
                                    <label>Candidato: <b>${Nombre_Candidato}</b></label><br/>
                                    <label>Telefono: <b>${Telefono}</b></label><br/>${Comentarios_Cliente}<br/><br><br/>
                                    <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>                                </body>
                            </html>";
                            Utils::sendEmail($Correo, $Reclutador, $Asunto2, $body2);
                        } else {
                            /***
                             * SOLICITUD DE RAL PODER JUDICIAL VIRTUAL
                             */
                            $Apellidos = $Apellido_Paterno . ' ' . $Apellido_Materno;
                            $Nombres_URL = urlencode($Nombres);
                            $Apellidos_URL = urlencode($Apellidos);

                            $api_url = "https://www.poderjudicialvirtual.com/api/v1/search/{$Nombres_URL}/{$Apellidos_URL}";

                            $curl = curl_init($api_url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                                'apikey: ' . ral_api_key,
                                'Content-Type: application/json'
                            ]);

                            $response = curl_exec($curl);

                            $url = base_url . "registroantecedenteslegales/resultado&Nombres={$Nombres}&Apellidos={$Apellidos}";

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
                                }
                            }

                            /** */


                            $Asunto2 = 'Confirmación de solicitud de Consulta de ' . $Tipo_Solicitud . ' para ' . $Nombre_Candidato;
                            $body2 = "
                            <!DOCTYPE html>
                            <html>
                                <head>
                                    <title>Nueva Solicitud</title> 
                                </head>
                                <body>
                                    <label>Estimado(a) <b>${Reclutador}</b>, se ha registrado con éxito su nueva solicitud de Consulta de <b>${Tipo_Solicitud}</b>.</label><br/><br/>
                                    <label>Candidato: <b>${Nombre_Candidato}</b></label><br/><br><br/>
                                    <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>                                </body>
                            </html>";
                            Utils::sendEmail($Correo, $Reclutador, $Asunto2, $body2);
                            $auto_ral = 1;
                        }


                        echo json_encode(array(
                            'status' => 1,
                            'ral' => $auto_ral,
                            'redireccion' => base_url . 'ServicioApoyo/ver&candidato=' . Encryption::encode($Candidato)
                        ));
                    } else
                        echo json_encode(array('status' => 2));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header('location:' . base_url);
    }

    public function en_proceso()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager()) {
            $estudio = new Candidatos();
            if (Utils::isAccount()) {
                $estudio->setEjecutivo($_SESSION['identity']->username);
                $estudios = $estudio->getServiciosEnProcesoPorEjecutivo();
            } elseif (Utils::isLogistics()) {
                $estudio->setLogistica($_SESSION['identity']->username);
                $estudios = $estudio->getServiciosEnProcesoPorEjecutivoLogistica();
            } else {
                $estudios = $estudio->getServiciosEnProceso();
            }


            $page_title = 'Estudios SocioEconómicos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/index.php';
            require_once 'views/ese/modal-config.php';
            require_once 'views/ese/modal-schedule.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function agendados()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isLogisticsSupervisor() || Utils::isLogistics() || Utils::isManager()) {
            $estudio = new Candidatos();
            if (Utils::isLogistics()) {
                $estudio->setLogistica($_SESSION['identity']->username);
                $estudios = $estudio->getServiciosAgendadosPorEjecutivoLogistica();
            } else {
                $estudios = $estudio->getServiciosAgendados();
            }


            $page_title = 'Estudios SocioEconómicos agendados | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/index.php';
            require_once 'views/ese/modal-config.php';
            require_once 'views/ese/modal-schedule.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function certificadosSOI()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager()) {
            $estudio = new Candidatos();
            $estudios = $estudio->getServiciosSOI();

            $page_title = 'Certificados SOI | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/soi-index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function ver()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            $folio = Encryption::decode($_GET['candidato']);

            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            // Utils::isClienteVetado($candidato->getOne()->Cliente);

            $page_title = 'Estudio | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/read.php';

            require_once 'views/ese/modal-datos_generales.php';
            require_once 'views/ese/modal-config.php';
            require_once 'views/ese/modal-cancelacion.php';
            require_once 'views/ese/modal-schedule.php';
            require_once 'views/ese/modal-service.php';
            require_once 'views/ese/modal-enlace.php';
            require_once 'views/ese/modal-ral.php';
            require_once 'views/ese/modal-datos_personales.php';
            require_once 'views/ese/modal-contacto.php';
            require_once 'views/ese/modal-imagen.php';
            require_once 'views/investigacion/modal-referencia_laboral.php';
            require_once 'views/investigacion/modal-investigacion.php';
            require_once 'views/ese/modal-comentarios_generales_inv.php';
            require_once 'views/ese/modal-conociendo.php';
            require_once 'views/ese/modal-escolaridad.php';
            require_once 'views/ese/modal-cohabitante.php';
            require_once 'views/ese/modal-circulo_familiar.php';
            require_once 'views/ese/modal-historial_salud.php';
            require_once 'views/ese/modal-ubicacion.php';
            require_once 'views/ese/modal-enseres.php';
            require_once 'views/ese/modal-referencia.php';
            require_once 'views/ese/modal-ingreso.php';
            require_once 'views/ese/modal-egreso.php';
            require_once 'views/ese/modal-credito.php';
            require_once 'views/ese/modal-bancaria.php';
            require_once 'views/ese/modal-seguro.php';
            require_once 'views/ese/modal-inmueble.php';
            require_once 'views/ese/modal-vehiculo.php';
            require_once 'views/ese/modal-conclusiones.php';
            require_once 'views/ese/modal-comentarios_generales.php';
            require_once 'views/ese/modal-licencia.php';
            require_once 'views/ese/modal-examen_medico.php';
            require_once 'views/ese/modal-resultado_licencia.php';
            require_once 'views/ese/modal-continuar_servicio.php';
            require_once 'views/ese/modal-nota.php';
            require_once 'views/ese/modal-contactar.php';
            require_once 'views/ese/modal-soi.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function signos()
    {
        require_once 'views/layout/header.php';
        require_once 'views/layout/sidebar.php';
        require_once 'views/layout/signos.php';
        require_once 'views/layout/footer.php';
    }

    public function datos()
    {
        if (Utils::isValid($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer()) {

            $page_title = 'Estudios SocioEconómicos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/edit.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function getOne()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isManager())) {
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;

            if ($Folio) {
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $data = $estudio->getOne();

                header('Content-Type: text/html; charset=utf-8');
                echo $json_vacancy = json_encode($data, \JSON_UNESCAPED_UNICODE);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function getOneService()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager())) {
            $folio = ($_GET['candidato']);

            if ($folio) {
                $candidato = new CandidatosDatos();
                $candidato->setCandidato($folio);
                $candidato_datos = $candidato->getOne();

                $candidato_datos->Especificacion_cliente = Utils::lineBreak($candidato_datos->Especificacion_cliente);
                $candidato_datos->Especificaciones = Utils::lineBreak($candidato_datos->Especificaciones);

                $candidato->setCURP($candidato_datos->CURP);
                $candidato->setIMSS($candidato_datos->IMSS);
                $historial_candidato = $candidato->getCandidatosPorCURPoIMSS();
                for ($i = 0; $i < count($historial_candidato); $i++) {
                    $historial_candidato[$i]['Fecha'] = Utils::getFullDate($historial_candidato[$i]['Fecha']);
                    $historial_candidato[$i]['Candidato'] = Encryption::encode($historial_candidato[$i]['Candidato']);
                }
                $nombre = utf8_encode($candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno);

                $candidato_datos->Estado_Civil = Utils::getEstadoCivil($candidato_datos->Estado_Civil);
                $candidato_datos->Sexo = Utils::getSexo($candidato_datos->Sexo);
                $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                $perfil = new CfgImagenes();
                $perfil->setFolio_Origen($folio);
                $perfil->setTabla('Candidatos');
                $perfil = $perfil->getProfile();

                if (!$perfil) {
                    if ($candidato_datos->Sexo == 99)
                        $perfil = array('../dist/img/user-icon-rose.png', 'png');
                    else
                        $perfil = array('../dist/img/user-icon.png', 'png');
                }

                $vlf = new ValidacionLicenciaFederal();
                $vlf->setCandidato($folio);
                $vlf = $vlf->getOne();

                $ral = new CandidatosRAL();
                $ral->setCandidato($folio);
                $ral = $ral->getOne();

                $capturaral = new CfgImagenes();
                $capturaral->setCandidato($folio);
                $capturas_RAL = $capturaral->getCapturasRALByCandidato();

                $folio_docs = new CandidatosFolioDocumentos();
                $folio_docs->setCandidato($folio);
                $docs = $folio_docs->getOne();

                $conociendo = new ConociendoCandidato();
                $conociendo->setCandidato($folio);
                $conociendo_candidato = $conociendo->getOne();

                $candidato = new Candidatos();
                $candidato->setCandidato($folio);
                $comentarios = $candidato->getComentarios();

                $estudios = new CandidatosEscolaridad();
                $estudios->setCandidato($folio);
                $escolaridad = $estudios->getEscolaridadPorCandidato();
                for ($i = 0; $i < count($escolaridad); $i++) {
                    $escolaridad[$i]['Grado'] = Utils::getGradoEstudio($escolaridad[$i]['Grado']);
                    $escolaridad[$i]['Documento'] = Utils::getDocumentoEscolar($escolaridad[$i]['Documento']);
                }

                $salud = new CandidatosSalud();
                $salud->setCandidato($folio);
                $historial_salud = $salud->getOne();

                $s_seguro = new CandidatosSaludSeguros();
                $s_seguro->setCandidato($folio);
                $salud_seguros = Utils::getSaludSeguros($s_seguro->getSaludSegurosPorCandidato());

                $cohabitan = new CandidatosCohabitan();
                $cohabitan->setCandidato($folio);
                $cohabitantes = $cohabitan->getCohabitantesPorCandidato($folio);

                for ($i = 0; $i < count($cohabitantes); $i++) {
                    $cohabitantes[$i]['Parentesco'] = Utils::getParentesco($cohabitantes[$i]['Parentesco']);
                    $cohabitantes[$i]['Estado_Civil'] = Utils::getEstadoCivil($cohabitantes[$i]['Estado_Civil']);
                }

                $circulo = new CirculoFamiliar();
                $circulo->setCandidato($folio);
                $circulo_familiar = $circulo->getFamiliaresPorCandidato();

                for ($i = 0; $i < count($circulo_familiar); $i++) {
                    $circulo_familiar[$i]['Parentesco'] = Utils::getParentesco($circulo_familiar[$i]['Parentesco']);
                }

                $vivienda = new CandidatosVivienda();
                $vivienda->setCandidato($folio);
                $vivienda = $vivienda->getOne();
                if ($vivienda) {
                    $vivienda->Tipo_Vivienda = Utils::getTipoVivienda($vivienda->Tipo_Vivienda);
                    $vivienda->Domicilio_es = Utils::getDomicilioEs($vivienda->Domicilio_es);
                }

                $ubicacion = new CandidatosUbicacion();
                $ubicacion->setCandidato($folio);
                $domicilio = $ubicacion->getDomicilioCompleto();
                $ubicacion = $ubicacion->getOne();

                $enser = new Enseres();
                $enser->setCandidato($folio);
                $enseres = $enser->getOne();

                $referencia = new CandidatosReferencias();
                $referencia->setCandidato($folio);
                $referencias = $referencia->getReferenciasPorCandidato();

                $ingreso = new CandidatosIngresos();
                $ingreso->setCandidato($folio);
                $ingresos = $ingreso->getIngresosPorCandidato();

                $egreso = new CandidatosEgresos();
                $egreso->setCandidato($folio);
                $egresos = $egreso->getEgresosPorCandidato();

                $credito = new CandidatosCreditos();
                $credito->setCandidato($folio);
                $creditos = $credito->getCreditosPorCandidato();

                $bancaria = new CandidatosBancarias();
                $bancaria->setCandidato($folio);
                $cuentas = $bancaria->getCuentasPorCandidato();

                $seguro = new CandidatosSeguros();
                $seguro->setCandidato($folio);
                $seguros = $seguro->getSegurosPorCandidato();

                $inmueble = new CandidatosInmuebles();
                $inmueble->setCandidato($folio);
                $inmuebles = $inmueble->getInmueblesPorCandidato();

                $vehiculo = new CandidatosVehiculos();
                $vehiculo->setCandidato($folio);
                $vehiculos = $vehiculo->getVehiculosPorCandidato();

                $investigacion = new Investigacion_Laboral;
                $investigacion->setCandidato($folio);
                $investigacion = $investigacion->getOne();

                $laboral = new CandidatosLaborales();
                $laboral->setCandidato($folio);
                $referencias_laborales = $laboral->getLaboralesPorCandidato();

                $documento = new CandidatosDocumentos();
                $documento->setCandidato($folio);
                $documentos = $documento->getDocumentosByCandidato();

                $obs = new CandidatosObsGenerales();
                $obs->setCandidato($folio);
                $observaciones = $obs->getObservacionesPorCandidato();

                $display = Utils::getDisplayBotones();

                $ubicacion_exterior = new CfgImagenes();
                $ubicacion_exterior->setFolio_Origen($folio);
                $ubicacion_exterior = $ubicacion_exterior->getExteriorDomicilio(); //$ubicacion_exterior->getExteriorDomicilio() ? $ubicacion_exterior->getExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                $ubicacion_no_exterior = new CfgImagenes();
                $ubicacion_no_exterior->setCandidato($folio);
                $ubicacion_no_exterior = $ubicacion_no_exterior->getNumeroExteriorDomicilio(); //$ubicacion_no_exterior->getNumeroExteriorDomicilio() ? $ubicacion_no_exterior->getNumeroExteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                $ubicacion_interior = new CfgImagenes();
                $ubicacion_interior->setFolio_Origen($folio);
                $ubicacion_interior = $ubicacion_interior->getInteriorDomicilio(); //$ubicacion_interior->getInteriorDomicilio() ? $ubicacion_interior->getInteriorDomicilio() : '../dist/img/image_unavailable.jpg';

                $busq_RAL = new Busqueda_RAL();
                $busqueda_RAL = $busq_RAL->getOneByCandidato($candidato);
                if ($busqueda_RAL) {
                    $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                    $busqueda_RAL->PDF_RAL = base_url . 'formato/resumen_resultado_RAL&busqueda=' . Encryption::encode($busqueda_RAL->ID);
                    $exp_RAL = new Expediente_RAL();
                    $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                    $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();

                    if ($expedientes_RAL) {
                        for ($i = 0; $i < count($expedientes_RAL); $i++) {
                            $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);

                            $expedientes_RAL[$i]['PDF_RAL'] = base_url . 'formato/resultado_RAL&expediente=' . Encryption::encode($expedientes_RAL[$i]['ID']);
                            $acuerdo_RAL = new Acuerdos_RAL();
                            $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                            $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                            for ($j = 0; $j < count($acuerdos); $j++)
                                $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                            //array_push($expediente, array('acuerdos' => $acuerdos));
                            $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                        }

                        //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                        $busqueda_RAL->expedientes = $expedientes_RAL;
                    } else {
                        $busqueda_RAL->expedientes = [];
                        if (!$ral) {
                            $ral = new CandidatosRAL();
                            $ral->setCandidato($folio);
                            $ral->setNombre($nombre);
                            $ral->setDemandas('0');
                            $ral->setEstado($candidato_datos->EstadoMX);
                            $ral->setTotal_Demandas('0');
                            $ral->setTotal_Acuerdos('0');
                            $ral->setTipo_Juicio('');
                            $ral->create();
                            $ral = $ral->getOne();
                        }
                    }
                    //array_push($busqueda_RAL, array('status' => 1));
                    $busqueda_RAL->status = 1;
                } else {
                    $busq_RAL->setCURP($candidato_datos->CURP);
                    $busqueda_RAL = $busq_RAL->getOneByCURP();
                    if ($busqueda_RAL) {
                        $user = new User();
                        $user->setUsername($busqueda_RAL->Creado);
                        $Usuario = $user->getUserByUsername();

                        $busqueda_RAL->PDF_RAL = base_url . 'formato/resumen_resultado_RAL&busqueda=' . Encryption::encode($busqueda_RAL->ID);
                        $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                        $busqueda_RAL->Creado = $Usuario->first_name . ' ' . $Usuario->last_name;
                        $exp_RAL = new Expediente_RAL();
                        $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                        $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();
                        if ($expedientes_RAL) {
                            for ($i = 0; $i < count($expedientes_RAL); $i++) {
                                $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);

                                $expedientes_RAL[$i]['PDF_RAL'] = base_url . 'formato/resultado_RAL&expediente=' . Encryption::encode($expedientes_RAL[$i]['ID']);
                                $acuerdo_RAL = new Acuerdos_RAL();
                                $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                                $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                                for ($j = 0; $j < count($acuerdos); $j++)
                                    $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                                //array_push($expediente, array('acuerdos' => $acuerdos));
                                $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                            }
                            //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                            $busqueda_RAL->expedientes = $expedientes_RAL;
                        } else
                            $busqueda_RAL->expedientes = [];
                        //array_push($busqueda_RAL, array('status' => 1));
                        $busqueda_RAL->status = 3;
                    } else {
                        $candidato->setIL($folio);
                        $candidato->setESE($folio);
                        $busqueda_RAL = $busq_RAL->getOneByILOrESE($candidato);
                        if ($busqueda_RAL) {
                            $user = new User();
                            $user->setUsername($busqueda_RAL->Creado);
                            $Usuario = $user->getUserByUsername();

                            $busqueda_RAL->PDF_RAL = base_url . 'formato/resumen_resultado_RAL&busqueda=' . Encryption::encode($busqueda_RAL->ID);
                            $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                            $busqueda_RAL->Creado = $Usuario->first_name . ' ' . $Usuario->last_name;
                            $exp_RAL = new Expediente_RAL();
                            $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                            $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();
                            if ($expedientes_RAL) {
                                for ($i = 0; $i < count($expedientes_RAL); $i++) {
                                    $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);

                                    $expedientes_RAL[$i]['PDF_RAL'] = base_url . 'formato/resultado_RAL&expediente=' . Encryption::encode($expedientes_RAL[$i]['ID']);
                                    $acuerdo_RAL = new Acuerdos_RAL();
                                    $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                                    $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                                    for ($j = 0; $j < count($acuerdos); $j++)
                                        $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                                    //array_push($expediente, array('acuerdos' => $acuerdos));
                                    $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                                }
                                //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                                $busqueda_RAL->expedientes = $expedientes_RAL;
                            } else
                                $busqueda_RAL->expedientes = [];
                            //array_push($busqueda_RAL, array('status' => 1));
                            $busqueda_RAL->status = 4;
                        } else {
                            $busqueda_RAL = (object)array('status' => 0);
                        }
                    }
                }


                $Nombre_RAL = strtoupper(str_replace(" ", " AND ", (Utils::removeAccents(Utils::removeSpaces($candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno)))));

                //=========================RAL PROPIO=========================
                $ral_tamaulipas = new Tamaulipas();
                $ral_tamaulipas->setResumen($Nombre_RAL);
                $ral_tamaulipas = $ral_tamaulipas->getExpedientesPorNombre();

                $ral_sanLuis = new SanLuisPotosi();
                $ral_sanLuis->setActor($Nombre_RAL);
                $ral_sanLuis->setDemandado($Nombre_RAL);
                $ral_sanLuis = $ral_sanLuis->getExpedientesPorNombre();

                $arrya_ral_estados_obj = array($ral_tamaulipas, $ral_sanLuis);

                $expedientes_RAL = [];
                $expedientes_RAL = $this->formatExpedientes_RAL($expedientes_RAL, $arrya_ral_estados_obj);
                //=========================RAL PROPIO=========================

                $Nota_Ejecutivo = new NotasEjecutivo();
                $Nota_Ejecutivo->setCandidato($folio);
                $notas = $Nota_Ejecutivo->getNotasPorCandidato();

                for ($i = 0; $i < count($notas); $i++) {
                    $path = 'uploads/avatar/' . $notas[$i]['id_user'];
                    if (file_exists($path)) {
                        $directory = opendir($path);

                        while ($file = readdir($directory)) {
                            if (!is_dir($file))
                                $route = $path . '/' . $file;
                        }
                    } else
                        $route = "dist/img/user-icon.png";

                    $notas[$i]['avatar'] = base_url . $route;
                }

                $cv_ruta = 0;
                if (get_headers(base_url . 'curriculums/' . $folio . '.pdf')[0] != 'HTTP/1.1 404 Not Found') {
                    $cv_ruta = base_url . 'curriculums/' . $folio . '.pdf';
                } elseif (get_headers('http://reclutamiento.rrhh-ingenia.com/curriculums/' . $folio . '.pdf')[0] != 'HTTP/1.1 404 Not Found') {
                    $cv_ruta = 'http://reclutamiento.rrhh-ingenia.com/curriculums/' . $folio . '.pdf';
                }

                $soiCer = new SOI();
                $soiCer->setCandidato($folio);
                $soiCer = $soiCer->getOne();

                $soi = 0;
                if (get_headers(base_url . 'uploads/soi/' . $folio . '.png')[0] != 'HTTP/1.1 404 Not Found')
                    $soi = base_url . 'uploads/soi/' . $folio . '.png';

                $google_search = 0;
                if (get_headers(base_url . 'uploads/google_search/' . $folio . '.pdf')[0] != 'HTTP/1.1 404 Not Found')
                    $google_search = base_url . 'uploads/google_search/' . $folio . '.pdf';

                $candidato_datos->folio = Encryption::encode($folio);
                $all_info = array(
                    'candidato_datos' => $candidato_datos,
                    'historial_candidato' => $historial_candidato,
                    'perfil' => $perfil,
                    'vlf' => $vlf,
                    'ral' => $ral,
                    'capturas_ral' => $capturas_RAL,
                    'docs' => $docs,
                    'conociendo_candidato' => $conociendo_candidato,
                    'escolaridad' => $escolaridad,
                    'historial_salud' => $historial_salud,
                    'salud_seguros' => $salud_seguros,
                    'cohabitantes' => $cohabitantes,
                    'circulo_familiar' => $circulo_familiar,
                    'vivienda' => $vivienda,
                    'domicilio' => $domicilio,
                    'ubicacion' => $ubicacion,
                    'ubicacion_exterior' => $ubicacion_exterior,
                    'ubicacion_no_exterior' => $ubicacion_no_exterior,
                    'ubicacion_interior' => $ubicacion_interior,
                    'enseres' => $enseres,
                    'referencias' => $referencias,
                    'ingresos' => $ingresos,
                    'egresos' => $egresos,
                    'creditos' => $creditos,
                    'cuentas' => $cuentas,
                    'seguros' => $seguros,
                    'inmuebles' => $inmuebles,
                    'vehiculos' => $vehiculos,
                    'investigacion' => $investigacion,
                    'referencias_laborales' => $referencias_laborales,
                    'documentos' => $documentos,
                    'observaciones' => $observaciones,
                    'comentarios' => $comentarios,
                    'cv_ruta' => $cv_ruta,
                    'display' => $display,
                    'busqueda_RAL' => $busqueda_RAL,
                    'expedientes_RAL' => $expedientes_RAL,
                    'soi' => $soi,
                    'soiCer' => $soiCer,
                    'notas' => $notas,
                    'google_search' => $google_search
                );
                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($all_info);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }


    function formatExpedientes_RAL($expedientes_RAL, $arrya_ral_estados)
    {
        $arrayEstados = array('Tamaulipas', 'San Luis Potosi');

        for ($j = 0; $j < count($arrya_ral_estados); $j++) {
            if (count($arrya_ral_estados[$j]) > 0) { //Si el ral del estado no tiene estados 
                for ($i = 0; $i < count($arrya_ral_estados[$j]); $i++) {
                    if ($i == 0) {
                        array_push($expedientes_RAL, array(
                            'Expediente' => $arrya_ral_estados[$j][$i]['Expediente'],
                            'Estado' => $arrayEstados[$j],
                            'Municipio' => isset($arrya_ral_estados[$j][$i]['Municipio']) ? $arrya_ral_estados[$j][$i]['Municipio'] : '',
                            'id' => $arrya_ral_estados[$j][$i]['id'],
                            'Fecha' => $arrya_ral_estados[$j][$i]['Fecha'],
                            'Resumen' => $arrya_ral_estados[$j][$i]['Resumen'],
                            'Juzgado' => $arrya_ral_estados[$j][$i]['Juzgado'],
                            'Actor' => isset($arrya_ral_estados[$j][$i]['Actor']) ? $arrya_ral_estados[$j][$i]['Actor'] : '', //San luis
                            'Demandado' => isset($arrya_ral_estados[$j][$i]['Demandado']) ? $arrya_ral_estados[$j][$i]['Demandado'] : '', //San luis
                            'Acuerdos' => array($arrya_ral_estados[$j][$i]),
                            'id_estado' => $j
                        ));
                    } else {
                        if (!in_array($arrya_ral_estados[$j][$i]['Expediente'], array_column($expedientes_RAL, 'Expediente')) && !in_array($arrya_ral_estados[$j][$i]['Resumen'], array_column($expedientes_RAL, 'Resumen'))) {
                            array_push($expedientes_RAL, array(
                                'Expediente' => $arrya_ral_estados[$j][$i]['Expediente'],
                                'Estado' => $arrayEstados[$j],                                'Municipio' => isset($arrya_ral_estados[$j][$i]['Municipio']) ? $arrya_ral_estados[$j][$i]['Municipio'] : '',
                                'Municipio' => isset($arrya_ral_estados[$j][$i]['Municipio']) ? $arrya_ral_estados[$j][$i]['Municipio'] : '',
                                'id' => $arrya_ral_estados[$j][$i]['id'],
                                'Fecha' => $arrya_ral_estados[$j][$i]['Fecha'],
                                'Resumen' => $arrya_ral_estados[$j][$i]['Resumen'],
                                'Juzgado' => $arrya_ral_estados[$j][$i]['Juzgado'],
                                'Actor' => isset($arrya_ral_estados[$j][$i]['Actor']) ? $arrya_ral_estados[$j][$i]['Actor'] : '', //San luis
                                'Demandado' => isset($arrya_ral_estados[$j][$i]['Demandado']) ? $arrya_ral_estados[$j][$i]['Demandado'] : '', //San luis
                                'Acuerdos' => array($arrya_ral_estados[$j][$i]),
                                'id_estado' => $j

                            ));
                        } else {
                            array_push($expedientes_RAL[(array_search($arrya_ral_estados[$j][$i]['Expediente'], array_column($expedientes_RAL, 'Expediente')))]['Acuerdos'], $arrya_ral_estados[$j][$i]);
                        }
                    }
                }
            }
        }

        return $expedientes_RAL;
    }


    public function update_config()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor())) {
            $Folio = isset($_POST['Folio']) && !empty($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;
            $Ejecutivo = isset($_POST['Ejecutivo']) && !empty($_POST['Ejecutivo']) ? trim($_POST['Ejecutivo']) : '';

            /* $Dia_Solicitud = isset($_POST['Dia_Solicitud']) ? $_POST['Dia_Solicitud'] : FALSE;
            $Mes_Solicitud = isset($_POST['Mes_Solicitud']) ? str_pad($_POST['Mes_Solicitud'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Anio_Solicitud = isset($_POST['Anio_Solicitud']) ? str_pad($_POST['Anio_Solicitud'], 2, "0", STR_PAD_LEFT) : FALSE; */
            $Fecha_Solicitud = isset($_POST['Fecha_Solicitud']) && !empty($_POST['Fecha_Solicitud']) ? $_POST['Fecha_Solicitud'] : FALSE;
            $Hora_Solicitud = isset($_POST['Hora_Solicitud']) ? str_pad($_POST['Hora_Solicitud'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Minuto_Solicitud = isset($_POST['Minuto_Solicitud']) ? str_pad($_POST['Minuto_Solicitud'], 2, "0", STR_PAD_LEFT) : FALSE;

            /* $Dia_Entrega = isset($_POST['Dia_Entrega']) ? $_POST['Dia_Entrega'] : FALSE;
            $Mes_Entrega = isset($_POST['Mes_Entrega']) ? str_pad($_POST['Mes_Entrega'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Anio_Entrega = isset($_POST['Anio_Entrega']) ? str_pad($_POST['Anio_Entrega'], 2, "0", STR_PAD_LEFT) : FALSE; */
            $Fecha_Entrega = isset($_POST['Fecha_Entrega']) && !empty($_POST['Fecha_Entrega']) ? $_POST['Fecha_Entrega'] : FALSE;
            $Hora_Entrega = isset($_POST['Hora_Entrega']) ? str_pad($_POST['Hora_Entrega'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Minuto_Entrega = isset($_POST['Minuto_Entrega']) ? str_pad($_POST['Minuto_Entrega'], 2, "0", STR_PAD_LEFT) : FALSE;
            $flag = Utils::sanitizeNumber($_POST['flag']);

            if ($Folio && $Ejecutivo && $Fecha_Solicitud && $Hora_Solicitud && $Minuto_Solicitud) {
                $Solicitud = DateTime::createFromFormat('Y-m-d H:i', "{$Fecha_Solicitud} {$Hora_Solicitud}:{$Minuto_Solicitud}");
                $Solicitud = $Solicitud->format('Y-m-d H:i');


                if ($Fecha_Entrega && $Minuto_Entrega) {
                    $Entrega = DateTime::createFromFormat('Y-m-d H:i', "{$Fecha_Entrega} {$Hora_Entrega}:{$Minuto_Entrega}");
                    $Entrega = $Entrega->format('Y-m-d H:i');
                } else {
                    $Entrega = NULL;
                }

                $nombre_usuario = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                $estudioE = new Candidatos();
                $estudioE->setCandidato($Folio);
                $candidato = $estudioE->getOne();

                $Nombre_Candidato = $candidato->Nombre_Candidato;
                $Nombre_Cliente = $_POST['Cliente'];
                $Solicitud_actual = Utils::getFullDate($candidato->Fecha);
                $Entrega_actual = isset($candidato->Entrega) && $candidato->Entrega != null ?  Utils::getFullDate($candidato->Entrega) : 'No cuenta con fecha de entrega';
                $ejecutivo_actual = $candidato->Ejecutivo;

                $Solicitud_nueva = Utils::getFullDate($Solicitud);
                $Entrega_nueva = isset($Entrega) && $Entrega != null ? Utils::getFullDate($Entrega) : 'No cuenta con fecha de entrega';
                $ejecutivo_nueva = $Ejecutivo;

                $folio = Encryption::encode($Folio);
                $url = base_url . 'ServicioApoyo/ver&candidato=' . $folio;

                $body = "
                        <!DOCTYPE html>
                        <html>
                            <head>
                                <title>Agenda</title> 
                            </head>
                            <body>
                                <p>El estudio del candidato <b>$Nombre_Candidato</b> del cliente <b>$Nombre_Cliente</b> ha sido modificado por <b>$nombre_usuario</b>.</p>
                                <p>Solicitud actual: <b>$Solicitud_actual</b></p>
                                <p>Entrega actual: <b>$Entrega_actual</b></p>
                                <p>Ejecutivo actual: <b>$ejecutivo_actual</b></p>
                                <br/>
                                <p>Solicitud nueva: <b>$Solicitud_nueva</b></p>
                                <p>Entrega nueva: <b>$Entrega_nueva</b></p>
                                <p>Ejecutivo nueva: <b>$ejecutivo_nueva</b></p>
                                <br/>
                                <p>Para ver al candidato por favor presiona <b>
                                <a href='$url' target='_blank' >aqui</a>
                                </b></p><br/>

                                <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>                        </body>
                    </html>
                    ";

                if (!Utils::isAdmin()) {
                    Utils::sendEmail('calidad@rrhhingenia.com', 'Calidad', 'Modificacion de ' . $Nombre_Candidato, $body);
                }

                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFecha_solicitud($Solicitud);
                $estudio->setFecha_entregado($Entrega);
                $estudio->setEjecutivo($Ejecutivo);
                $cambio = $estudio->getModificacionEjecutivoGestor();
                if ($cambio->Ejecutivo_modificacion == 0 || $cambio->Ejecutivo_modificacion == NULL) {
                    $estudio->updateModificacionEjecutivo();
                }
                $update = $estudio->updateConfig();


                if ($update) {
                    if ($flag == 1) {
                        $candidato = new CandidatosDatos();
                        $candidato->setCandidato($Folio);
                        $candidato_datos = $candidato->getOne();
                        $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                        $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                        $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                        $perfil = new CfgImagenes();
                        $perfil->setFolio_Origen($Folio);
                        $perfil->setTabla('Candidatos');
                        $perfil = $perfil->getProfile();

                        if (!$perfil) {
                            if ($candidato_datos->Sexo == 99)
                                $perfil = array('../dist/img/user-icon-rose.png', 'png');
                            else
                                $perfil = array('../dist/img/user-icon.png', 'png');
                        }
                        $display = Utils::getDisplayBotones();
                        echo json_encode(array(
                            'candidato_datos' => $candidato_datos,
                            'perfil' => $perfil,
                            'status' => 1,
                            'display' => $display
                        ));
                    } else {
                        $time = $estudio->getTime();
                        echo json_encode(array('folio' => $Folio, 'solicitud' => Utils::getFullDate($Solicitud), 'ejecutivo' => $Ejecutivo, 'entregado' => $Entrega ? Utils::getFullDate($Entrega) : '', 'dias' => $time->Dias, 'tiempo' => $time->Tiempo, 'status' => 1));
                    }
                } else
                    echo json_encode(array('status' => 2));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function update_schedule()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isAccount() || Utils::isLogistics() || Utils::isLogisticsSupervisor())) {
            $Folio = isset($_POST['Folio_Candidato']) && !empty($_POST['Folio_Candidato']) ? trim($_POST['Folio_Candidato']) : FALSE;
            $Ejecutivo = isset($_POST['Logistica']) && !empty($_POST['Logistica']) ? trim($_POST['Logistica']) : '';

            /* $Dia_Aplicacion = isset($_POST['Dia_Aplicacion']) ? $_POST['Dia_Aplicacion'] : FALSE;
            $Mes_Aplicacion = isset($_POST['Mes_Aplicacion']) ? str_pad($_POST['Mes_Aplicacion'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Anio_Aplicacion = isset($_POST['Anio_Aplicacion']) ? str_pad($_POST['Anio_Aplicacion'], 2, "0", STR_PAD_LEFT) : FALSE; */
            $Fecha_Aplicacion = isset($_POST['Fecha_Aplicacion']) && !empty($_POST['Fecha_Aplicacion']) ? $_POST['Fecha_Aplicacion'] : FALSE;
            $Hora_Aplicacion = isset($_POST['Hora_Aplicacion']) ? str_pad($_POST['Hora_Aplicacion'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Minuto_Aplicacion = isset($_POST['Minuto_Aplicacion']) ? str_pad($_POST['Minuto_Aplicacion'], 2, "0", STR_PAD_LEFT) : FALSE;

            $flag = Utils::sanitizeNumber($_POST['flag']);

            if ($Folio && $Ejecutivo) {
                if ($Fecha_Aplicacion && $Hora_Aplicacion && $Minuto_Aplicacion) {
                    $Aplicacion = DateTime::createFromFormat('Y-m-d H:i', "{$Fecha_Aplicacion} {$Hora_Aplicacion}:{$Minuto_Aplicacion}");
                    $Aplicacion = $Aplicacion->format('Y-m-d H:i');
                } else
                    $Aplicacion = NULL;


                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFecha_aplicacion($Aplicacion);
                $estudio->setLogistica($Ejecutivo);
                $cambio = $estudio->getModificacionEjecutivoGestor();
                if ($cambio->Gestor_modificacion == 0 || $cambio->Gestor_modificacion == NULL) {
                    $estudio->updateModificacionGestor();
                }

                $update = $estudio->updateSchedule();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();

                    $Nombre_Candidato = "$candidato_datos->Nombres $candidato_datos->Apellido_Paterno $candidato_datos->Apellido_Materno";

                    $Ejecutivo_Cuenta = $candidato_datos->Ejecutivo;
                    $Analista = $candidato_datos->Quien_Solicita;
                    $Correo_Analista = $candidato_datos->Correo_Cliente;

                    $Logistica = $candidato_datos->Verificador;
                    $Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $identity = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;

                    $Nombre_Cliente = $candidato_datos->Nombre_Cliente;

                    $body = "
                        <!DOCTYPE html>
                        <html>
                            <head>
                                <title>Agenda</title> 
                            </head>
                            <body>
                                <p>El estudio del candidato <b>$Nombre_Candidato</b> de <b>$Nombre_Cliente</b> ha sido agendado por <b>$identity</b>.</p>
                                <br/><br/>
                                <p>Ejecutivo de logística: <b>$Logistica</b></p><br/>
                                <p>Fecha y Hora: <b>$Fecha_Aplicacion</b></p><br/>
                                <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>                        </body>
                    </html>
                    ";

                    if ($candidato_datos->Fecha_Aplicacion && $candidato_datos->Cliente != 408 && !Utils::isAdmin()) {
                        Utils::sendEmail($Correo_Analista, $Analista, 'Agenda de ' . $Nombre_Candidato, $body);
                        Utils::sendEmail('calidad@rrhhingenia.com', $Analista, 'Agenda de ' . $Nombre_Candidato, $body);
                    }

                    if ($flag == 1) {

                        $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                        $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                        $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                        $perfil = new CfgImagenes();
                        $perfil->setFolio_Origen($Folio);
                        $perfil->setTabla('Candidatos');
                        $perfil = $perfil->getProfile();

                        if (!$perfil) {
                            if ($candidato_datos->Sexo == 99)
                                $perfil = array('../dist/img/user-icon-rose.png', 'png');
                            else
                                $perfil = array('../dist/img/user-icon.png', 'png');
                        }

                        $display = Utils::getDisplayBotones();
                        echo json_encode(array(
                            'candidato_datos' => $candidato_datos,
                            'perfil' => $perfil,
                            'status' => 1,
                            'display' => $display
                        ));
                    } else {
                        $Aplicacion = $Aplicacion ? Utils::getFullDate($Aplicacion) : '';
                        echo json_encode(array('folio' => $Folio, 'aplicacion' => $Aplicacion, 'logistica' => $Ejecutivo, 'status' => 1));
                    }
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function update_type()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Tipo_Investigacion = Utils::sanitizeNumber($_POST['Tipo_Investigacion']);

            if ($Candidato) {
                $investigacion = new Candidatos();
                $investigacion->setCandidato($Candidato);
                $investigacion->setTipo_Investigacion($Tipo_Investigacion);
                $update = $investigacion->updateTipoInvestigacion();

                if ($update)
                    echo $Tipo_Investigacion;
                else
                    echo 0;
            } else
                echo 0;
        } else
            header('location:' . base_url);
    }

    public function getTipoServicio()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;

            if ($Folio) {
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $data = $estudio->getTipoServicio();

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($data, \JSON_UNESCAPED_UNICODE);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function getDatosGenerales()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isCustomerSA()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato) {
                $estudio = new Candidatos();

                $candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato_datos = $candidato->getOne();

                $razon = new RazonesSociales();
                $razon->setID_Cliente($candidato_datos->Cliente);
                $razones = $razon->getRazonesSocialesPorCliente();

                $ejecutivo = new EjecutivosPlazas();
                $ejecutivo->setID_Cliente($candidato_datos->Cliente);
                $ejecutivos = $ejecutivo->getEjecutivosPorCliente();

                $contacto = new ContactosClienteSolicitan();
                $contacto->setCliente($candidato_datos->Cliente);
                $contactos = $contacto->getContactosPorCliente();

                $contactoCliente = new ContactosCliente();
                $contactoCliente->setID_Cliente($candidato_datos->Cliente);
                $contactosCliente = $contactoCliente->getContactosPorCliente();

                $busq_RAL = new Busqueda_RAL();
                $busqueda_RAL = $busq_RAL->getOneByCandidato($estudio);
                if ($busqueda_RAL) {
                    $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                    $busqueda_RAL->PDF_RAL = base_url . 'formato/resumen_resultado_RAL&busqueda=' . Encryption::encode($busqueda_RAL->ID);
                    $exp_RAL = new Expediente_RAL();
                    $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                    $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();

                    if ($expedientes_RAL) {
                        for ($i = 0; $i < count($expedientes_RAL); $i++) {
                            $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);

                            $expedientes_RAL[$i]['PDF_RAL'] = base_url . 'formato/resultado_RAL&expediente=' . Encryption::encode($expedientes_RAL[$i]['ID']);
                            $acuerdo_RAL = new Acuerdos_RAL();
                            $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                            $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                            for ($j = 0; $j < count($acuerdos); $j++)
                                $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                            //array_push($expediente, array('acuerdos' => $acuerdos));
                            $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                        }

                        //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                        $busqueda_RAL->expedientes = $expedientes_RAL;
                    } else
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

                        $busqueda_RAL->PDF_RAL = base_url . 'formato/resumen_resultado_RAL&busqueda=' . Encryption::encode($busqueda_RAL->ID);
                        $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                        $busqueda_RAL->Creado = $Usuario->first_name . ' ' . $Usuario->last_name;
                        $exp_RAL = new Expediente_RAL();
                        $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                        $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();
                        if ($expedientes_RAL) {
                            for ($i = 0; $i < count($expedientes_RAL); $i++) {
                                $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);

                                $expedientes_RAL[$i]['PDF_RAL'] = base_url . 'formato/resultado_RAL&expediente=' . Encryption::encode($expedientes_RAL[$i]['ID']);
                                $acuerdo_RAL = new Acuerdos_RAL();
                                $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                                $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                                for ($j = 0; $j < count($acuerdos); $j++)
                                    $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                                //array_push($expediente, array('acuerdos' => $acuerdos));
                                $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                            }
                            //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                            $busqueda_RAL->expedientes = $expedientes_RAL;
                        } else
                            $busqueda_RAL->expedientes = [];
                        //array_push($busqueda_RAL, array('status' => 1));
                        $busqueda_RAL->status = 3;
                    } else {
                        $busqueda_RAL = (object)array('status' => 0);
                    }
                }

                $all_info = array(
                    'candidato_datos' => $candidato_datos,
                    'razones' => $razones,
                    'contactos' => $contactos,
                    'contactosCliente' => $contactosCliente,
                    'busqueda_RAL' => $busqueda_RAL,
                    'ejecutivos' => $ejecutivos,
                    'usuario' => $_SESSION['identity']->id
                );

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($all_info);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function getContactosYRazonesPorCliente()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);

            if ($Cliente) {

                $razon = new RazonesSociales();
                $razon->setID_Cliente($Cliente);
                $razones = $razon->getRazonesSocialesPorCliente();

                $contacto = new ContactosClienteSolicitan();
                $contacto->setCliente($Cliente);
                $contactos = $contacto->getContactosPorCliente();

                $all_info = array(
                    'razones' => $razones,
                    'contactos' => $contactos
                );

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($all_info);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function getEjecutivosYRazonesPorCliente()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isCustomerSA()) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);

            if ($Cliente) {

                $razon = new RazonesSociales();
                $razon->setID_Cliente($Cliente);
                $razones = $razon->getRazonesSocialesPorCliente();

                $ejecutivo = new EjecutivosPlazas();
                $ejecutivo->setID_Cliente($Cliente);
                $ejecutivos = $ejecutivo->getEjecutivosPorCliente();

                /* if ($Cliente == 68) {
                    $ejecutivos_transpais = [];
                    foreach ($ejecutivos as $ejecutivo) {
                        if ($_SESSION['identity']->username == 'cristinacastellanos' || $_SESSION['identity']->username == 'karlamartinez' || $_SESSION['identity']->username == 'anareyes' || $_SESSION['identity']->username == 'yoshiramarcos') {
                            if ($ejecutivo['Usuario'] == 'edithsanchez') {
                                array_push($ejecutivos_transpais, $ejecutivo);
                            }
                        }elseif ($_SESSION['identity']->username == 'adelamoreno' || $_SESSION['identity']->username == 'anuarrivera' || $_SESSION['identity']->username == 'marisolcastillo' || $_SESSION['identity']->username == 'josegarcia' || $_SESSION['identity']->username == 'brendacastillo') {
                            if ($ejecutivo['Usuario'] == 'brenda') {
                                array_push($ejecutivos_transpais, $ejecutivo);
                            }
                        }
                    }
                    $ejecutivos = $ejecutivos_transpais;
                } */

                $all_info = array(
                    'razones' => $razones,
                    'ejecutivos' => $ejecutivos
                );

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($all_info);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function update_service()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Servicio_Solicitado = Utils::sanitizeNumber(($_POST['Servicio_Solicitado']));
            $Fase = Utils::sanitizeNumber($_POST['Fase']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);


            if ($Folio && $Servicio_Solicitado && $Fase) {
				  //gbao 3 oct

                $candidato_actual = new CandidatosDatos();
                $candidato_actual->setCandidato($Folio);
                $candidato_actual = $candidato_actual->getOne();
				  //gbao 3 oct

				
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setServicio_Solicitado($Servicio_Solicitado);
                $estudio->setFase($Fase);
                $estudio->setEstado($Estado);
                $update = $estudio->updateService();


                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
					
					
//gabo 3 oct
                    $nombre_usuario = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                    $nombre = $candidato_datos->Nombres . " " . $candidato_datos->Apellido_Paterno . " " . $candidato_datos->Apellido_Materno;

                    $folio = Encryption::encode($Folio);
                    $url = base_url . 'ServicioApoyo/ver&candidato=' . $folio;

                    $body = "
        <!DOCTYPE html>
        <html>
            <head>
                <title>Agenda</title> 
            </head>
            <body>
                <p>El estudio del candidato <b>$nombre</b> del cliente <b>$candidato_datos->Nombre_Cliente</b> ha sido modificado por <b>$nombre_usuario</b>.</p>
                <p>Servicio Solicitado actual: <b>$candidato_actual->Servicio_Solicitado</b></p>
                <p>Fase actual: <b>$candidato_actual->Fase</b></p>
                <p>Estatus: <b>$candidato_actual->Estatus</b></p>
                <br/>
                <p>Servicio Solicitado nuevo: <b>$candidato_datos->Servicio_Solicitado</b></p>
                <p>Fase nueva: <b>$candidato_datos->Fase</b></p>
                <p>Estatus nuevo: <b>$candidato_datos->Estatus</b></p>
                <br/>
                <p>Para ver al candidato por favor presiona <b>
                <a href='$url' target='_blank' >aqui</a>
                </b></p><br/>

                <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>  </body>
    </html>
    ";

                    if (!Utils::isAdmin()) {
                        Utils::sendEmail('calidad@rrhhingenia.com', 'Calidad', 'Modificacion de ' . $nombre, $body);
                    }

                    //gabo 3 oct
					


					




					
					
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function update_datos_generales()
    {
        if (Utils::isValid($_POST) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Nombres = Utils::sanitizeStringBlank($_POST['Nombres']);
            $Apellido_Paterno = Utils::sanitizeStringBlank($_POST['Apellido_Paterno']);
            $Apellido_Materno = Utils::sanitizeStringBlank($_POST['Apellido_Materno']);
            $Cliente = Utils::sanitizeNumber(($_POST['Cliente']));
            $Contacto = Utils::sanitizeNumber($_POST['Contacto']);
            $Razon = Utils::sanitizeString($_POST['Razon']);
            $Puesto = Utils::sanitizeString($_POST['Puesto']);
            // 19 sept
            $centro_costos = $_POST['centro_costos'] != '' ? Utils::sanitizeString($_POST['centro_costos']) : '';

            if ($Folio && $Cliente && $Razon && $Puesto) {
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setCliente($Cliente);
                $estudio->setContacto($Contacto);
                $estudio->setRazon($Razon);
                $estudio->setPuesto($Puesto);
                $estudio->setCC_Cliente($centro_costos);
                $update = $estudio->updateDatosEmpresa();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato->setNombres($Nombres);
                    $candidato->setApellido_Paterno($Apellido_Paterno);
                    $candidato->setApellido_Materno($Apellido_Materno);
                    $candidato->updateName();
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }

                    $busq_RAL = new Busqueda_RAL();
                    $busqueda_RAL = $busq_RAL->getOneByCandidato($estudio);
                    if ($busqueda_RAL) {
                        $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                        $busqueda_RAL->PDF_RAL = base_url . 'formato/resumen_resultado_RAL&busqueda=' . Encryption::encode($busqueda_RAL->ID);
                        $exp_RAL = new Expediente_RAL();
                        $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                        $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();

                        if ($expedientes_RAL) {
                            for ($i = 0; $i < count($expedientes_RAL); $i++) {
                                $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);

                                $expedientes_RAL[$i]['PDF_RAL'] = base_url . 'formato/resultado_RAL&expediente=' . Encryption::encode($expedientes_RAL[$i]['ID']);
                                $acuerdo_RAL = new Acuerdos_RAL();
                                $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                                $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                                for ($j = 0; $j < count($acuerdos); $j++)
                                    $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                                //array_push($expediente, array('acuerdos' => $acuerdos));
                                $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                            }

                            //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                            $busqueda_RAL->expedientes = $expedientes_RAL;
                        } else
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

                            $busqueda_RAL->PDF_RAL = base_url . 'formato/resumen_resultado_RAL&busqueda=' . Encryption::encode($busqueda_RAL->ID);
                            $busqueda_RAL->Fecha = Utils::getDate($busqueda_RAL->Fecha);
                            $busqueda_RAL->Creado = $Usuario->first_name . ' ' . $Usuario->last_name;
                            $exp_RAL = new Expediente_RAL();
                            $exp_RAL->setID_Busqueda_RAL($busqueda_RAL->ID);
                            $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();
                            if ($expedientes_RAL) {
                                for ($i = 0; $i < count($expedientes_RAL); $i++) {
                                    $expedientes_RAL[$i]['Fecha'] = Utils::getDate($expedientes_RAL[$i]['Fecha']);

                                    $expedientes_RAL[$i]['PDF_RAL'] = base_url . 'formato/resultado_RAL&expediente=' . Encryption::encode($expedientes_RAL[$i]['ID']);
                                    $acuerdo_RAL = new Acuerdos_RAL();
                                    $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL[$i]['ID']);
                                    $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
                                    for ($j = 0; $j < count($acuerdos); $j++)
                                        $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
                                    //array_push($expediente, array('acuerdos' => $acuerdos));
                                    $expedientes_RAL[$i]['acuerdos'] = $acuerdos;
                                }
                                //array_push($busqueda_RAL, array('expedientes' => $expedientes_RAL));
                                $busqueda_RAL->expedientes = $expedientes_RAL;
                            } else
                                $busqueda_RAL->expedientes = [];
                            //array_push($busqueda_RAL, array('status' => 1));
                            $busqueda_RAL->status = 3;
                        } else {
                            $busqueda_RAL = (object)array('status' => 0);
                        }
                    }

                    $display = Utils::getDisplayBotones();

                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display,
                        'busqueda_RAL' => $busqueda_RAL
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function save_enlace()
    {
        if (Utils::isValid($_POST) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Enlace_Drive = Utils::sanitizeString(($_POST['Enlace_Drive']));


            if ($Folio && $Enlace_Drive) {
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setEnlace_Drive($Enlace_Drive);
                $update = $estudio->updateEnlaceDrive();


                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function save_cancelacion()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Servicio_Solicitado = Utils::sanitizeNumber($_POST['Servicio_Solicitado']);
            $Fase = Utils::sanitizeNumber($_POST['Fase']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);
            $Comentario_Cancelacion = Utils::sanitizeString(($_POST['Comentario_Cancelacion']));
            $Finalizado = $_POST['Finalizado'];

            if ($Folio && $Comentario_Cancelacion && ($Estado == 250 || $Estado == 251)) {
                if ($Fase == 230 || $Fase == 231 || $Fase == 298)
                    $Estado = 258;
                if ($Servicio_Solicitado == 230 || $Servicio_Solicitado == 231 || $Servicio_Solicitado == 323 || $Servicio_Solicitado == 340|| $Servicio_Solicitado == 341) {
                    if ($Finalizado == 1)
                        $Estado = 252;
                    else {
                        if ($Fase == 299) {
                            $Fase = 298;
                            $Estado = 252;
                        } elseif ($Fase == 300) {
                            $Fase = 299;
                            $Estado = 252;
                        }
                    }
                }
                if ($Servicio_Solicitado == 323) {
                    if ($Fase == 324) {
                        $Fase = 300;
                        $Estado = 252;
                    }
                }
                /* $update = FALSE;
                if (($Fase == 300 || $Fase == 230) && $Estado == 252) {
                    $observaciones = new CandidatosObsGenerales();
                    $observaciones->setCandidato($Folio);
                    $obs = $observaciones->getObservacionesPorCandidato();

                    if (($obs->Viable == $obs->Viabilidad) || trim($obs->Califica_como) != '') {
                        $estudio = new Candidatos();
                        $estudio->setCandidato($Folio);
                        $estudio->setFase($Fase);
                        $estudio->setEstado($Estado);
                        $estudio->setComentario_Cancelado($Comentario_Cancelacion);
                        $update = $estudio->saveCancelacion();
                    }else{
                        echo json_encode(array('status' => 3));
                        die();
                    }
                }else{ */
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFase($Fase);
                $estudio->setEstado($Estado);
                $estudio->setComentario_Cancelado($Comentario_Cancelacion);
                $update = $estudio->saveCancelacion();
                //}

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    if ($Finalizado == 1) {
                        $Nombre_Candidato = $candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno;

                        $subject = $Fase == 298 ? 'RAL de ' . $Nombre_Candidato . ' disponible' : ($Fase == 299 ? 'Investigación Laboral de ' . $Nombre_Candidato . ' disponible' : ($Fase == 310 ? 'Validación de Licencia de ' . $Nombre_Candidato . ' disponible' : ($Fase == 300 ? 'Verificación Domiciliaria de ' . $Nombre_Candidato . ' disponible' : '')));

                        $saludo = date('G') < 6 || date('G') > 19 ? 'Buenas noches' : (date('G') >= 6 && date('G') < 12 ? 'Buenos días' : 'Buenas tardes');

                        $body = $Fase == 298 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga el <b>RAL</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 299 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Investigación Laboral</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 310 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Validación de Licencia</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 300 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Verificación Domiciliaria</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 324 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Verificación Domiciliaria con Visita Presencial</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ''))));

                        Utils::sendEmail($candidato_datos->Correo_Cliente, $candidato_datos->Quien_Solicita, $subject, $body);
                    }

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function save_finalizacion()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isCustomerSA())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Servicio_Solicitado = Utils::sanitizeNumber($_POST['Servicio_Solicitado']);
            $Fase = Utils::sanitizeNumber($_POST['Fase']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);
            $Comentario_Finalizacion = Utils::sanitizeString(($_POST['Comentario_Finalizacion']));

            if ($Folio && $Comentario_Finalizacion && ($Fase == 230 || $Fase == 231 || $Fase == 298 || ($Servicio_Solicitado == 231 && $Fase == 231) || ($Servicio_Solicitado == 291 && $Fase == 291) || ($Servicio_Solicitado == 230 && $Fase == 230) || ($Servicio_Solicitado == 230 && $Fase == 300) || ($Servicio_Solicitado == 231 && $Fase == 299) || ($Servicio_Solicitado == 323 && $Fase == 324) || ($Servicio_Solicitado == 230 && $Fase == 299) || ($Servicio_Solicitado == 230 && $Fase == 231) || ($Servicio_Solicitado == 328 && $Fase == 328) || ($Servicio_Solicitado == 340 && $Fase == 300) || ($Servicio_Solicitado == 340 && $Fase == 299) || ($Servicio_Solicitado == 341 && $Fase == 300) || ($Servicio_Solicitado == 341 && $Fase == 299)) && ($Estado == 250 || $Estado == 251 || $Estado == 249)) {

                $Estado = 252;

                /* $update = FALSE;
                if ($Fase == 230 || $Fase == 300) {
                    $observaciones = new CandidatosObsGenerales();
                    $observaciones->setCandidato($Folio);
                    $obs = $observaciones->getObservacionesPorCandidato();

                    if (($obs->Viable == $obs->Viabilidad) || trim($obs->Califica_como) != '') {
                        $estudio = new Candidatos();
                        $estudio->setCandidato($Folio);
                        $estudio->setFase($Fase);
                        $estudio->setEstado($Estado);
                        $estudio->setComentario_Finalizacion($Comentario_Finalizacion);
                        $update = $estudio->saveFinalizacion();
                    }else {
                        echo json_encode(array('status' => 3));
                        die();
                    }
                }else{ */
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFase($Fase);
                $estudio->setEstado($Estado);
                $estudio->setComentario_Finalizacion($Comentario_Finalizacion);
                $Candidato = $estudio->getOne();

                if (($Servicio_Solicitado == 230 || $Servicio_Solicitado == 340 || $Servicio_Solicitado == 341) && ($Fase == 230 || $Fase == 300)) {
                    $Fase2 = $Fase == 230 ? 230 : ($Fase == 300 ? 299 : $Fase);
                    $estudio->setFase($Fase2);
                    if ($Candidato->Fecha_Entregado_INV == NULL) {

                        $update = $estudio->saveTerminado();
                    } else {
                        $update = $estudio->saveFinalizacion();
                        if ($Servicio_Solicitado == 340) {
                            $Enlace = "https://rrhh-ingenia.com.mx/ServicioApoyo/ver&candidato=" . Encryption::encode($Folio);
                            $id_user = 1207; //Juanita
                            Utils::newNotification($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name . ' solicita aprobación de SOI', $Enlace, 1, 9, $id_user, $_SESSION['identity']->id, $Candidato->ID_Cliente);
                        }
                    }
                } elseif (($Servicio_Solicitado == 230 || $Servicio_Solicitado == 340 || $Servicio_Solicitado == 341) && ($Fase == 231 || $Fase == 299)) {
                    $Fase2 = $Fase == 231 ? 232 : ($Fase == 299 ? 300 : $Fase);
                    $estudio->setFase($Fase2);
                    if ($Candidato->Fecha_Entregado_ESE == NULL) {
                        $update = $estudio->saveTerminado();
                    } else {
                        $update = $estudio->saveFinalizacion();
                    }
                } else {
                    $update = $estudio->saveFinalizacion();
                }
                //}

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $Nombre_Candidato = $candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno;

                    $subject = $Fase == 298 ? 'RAL de ' . $Nombre_Candidato . ' disponible' : (($Fase == 299 || $Fase == 231) ? 'Investigación Laboral de ' . $Nombre_Candidato . ' disponible' : ($Fase == 310 ? 'Validación de Licencia de ' . $Nombre_Candidato . ' disponible' : (($Fase == 300 || $Fase == 230) ? 'Verificación Domiciliaria de ' . $Nombre_Candidato . ' disponible' : ($Fase == 324 ? 'Verificación Domiciliaria con Visita Presencial de ' . $Nombre_Candidato . ' disponible' : ($Fase == 328 ? 'Análisis de RAL de ' . $Nombre_Candidato . ' disponible' : '')))));

                    $saludo = date('G') < 6 || date('G') > 19 ? 'Buenas noches' : (date('G') >= 6 && date('G') < 12 ? 'Buenos días' : 'Buenas tardes');

                    $body = $Fase == 298 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga el <b>RAL</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 299 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Investigación Laboral</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 310 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Validación de Licencia</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 300 || $Fase == 230 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Verificación Domiciliaria</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 324 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Verificación Domiciliaria con Visita Presencial</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 328 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que se ha concluído con el <b>Análisis de RAL</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : '')))));

                    if ($candidato_datos->Cliente != 408 && !Utils::isAdmin())
                        Utils::sendEmail($candidato_datos->Correo_Cliente, $candidato_datos->Quien_Solicita, $subject, $body);

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function save_avanzar()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Servicio_Solicitado = Utils::sanitizeNumber($_POST['Servicio_Solicitado']);
            $Fase = Utils::sanitizeNumber($_POST['Fase']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);

            if ($Folio && ($Servicio_Solicitado == 230 || $Servicio_Solicitado == 231 || $Servicio_Solicitado == 323 || $Servicio_Solicitado == 340 || $Servicio_Solicitado == 341) && ($Estado == 250 || $Estado == 251)) {

                /* if ($Fase == 298)
                    $Fase = 299;
                elseif ($Fase == 299)
                    $Fase = 300; */

                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFase($Fase);
                $estudio->setEstado($Estado);
                $update = $estudio->saveAvanzar();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $Nombre_Candidato = $candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno;

                    $subject = $Fase == 298 ? 'RAL de ' . $Nombre_Candidato . ' disponible' : ($Fase == 299 ? 'Investigación Laboral de ' . $Nombre_Candidato . ' disponible' : ($Fase == 310 ? 'Validación de Licencia de ' . $Nombre_Candidato : ($Fase == 300 ? 'Verificación Domiciliaria de ' . $Nombre_Candidato . ' disponible' : '')));

                    $saludo = date('G') < 6 || date('G') > 19 ? 'Buenas noches' : (date('G') >= 6 && date('G') < 12 ? 'Buenos días' : 'Buenas tardes');

                    $body = $Fase == 298 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga el <b>RAL</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 299 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Investigación Laboral</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 310 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Validación de Licencia</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : ($Fase == 300 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que ya se encuentra disponible para su descarga la <b>Verificación Domiciliaria</b> de <b>' . $Nombre_Candidato . '</b> en nuestra plataforma.<br><br><br>No es necesario responder a este correo.' : '')));

                    if ($Fase != 298 && $candidato_datos->Cliente != 408 && !Utils::isAdmin())
                        Utils::sendEmail($candidato_datos->Correo_Cliente, $candidato_datos->Quien_Solicita, $subject, $body);

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function reactivar()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Factura = Utils::sanitizeString($_POST['Factura']);
            $Fase = Utils::sanitizeNumber($_POST['Fase']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);

            if ($Folio && $Estado != 254 && !strpos($Factura, 'F-')) {
                if ($Fase == 298)
                    $Fase = 299;
                elseif ($Fase == 299)
                    $Fase = 300;
                elseif ($Fase == 298 && $Estado == 258)
                    $Fase = 298;

                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFase($Fase);
                $update = $estudio->reactivar();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function eliminar()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Factura = Utils::sanitizeString($_POST['Factura']);
            $Fase = Utils::sanitizeNumber($_POST['Fase']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);

            if ($Folio && $Estado != 254 && $Factura == '') {
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $update = $estudio->eliminar();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
					
					
   //gabo 3 oct
                    $nombre_usuario = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                    $nombre = $candidato_datos->Nombres . " " . $candidato_datos->Apellido_Paterno . " " . $candidato_datos->Apellido_Materno;

                    $folio = Encryption::encode($Folio);
                    $url = base_url . 'ServicioApoyo/ver&candidato=' . $folio;

                    $body = "
<!DOCTYPE html>
<html>
<head>
  <title>Eliminación</title> 
</head>
<body>
  <p>El estudio del candidato <b>$nombre</b> del cliente <b>$candidato_datos->Nombre_Cliente</b> ha sido eliminado por <b>$nombre_usuario</b>.</p>
  <p>Servicio Solicitado : <b>$candidato_datos->Servicio_Solicitado</b></p>
  <p>Fase : <b>$candidato_datos->Fase</b></p>
  <p>Estatus: <b>$candidato_datos->Estatus</b></p>
  <br/>
  <a href='$url' target='_blank' >aqui</a>
  </b></p><br/>

  <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>  </body>
</html>
";

                    if (!Utils::isAdmin()) {
                        Utils::sendEmail('calidad@rrhhingenia.com', 'Calidad', 'Modificacion de ' . $nombre, $body);
                    }

                    //gabo 3 oct


                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function getOneData()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isManager())) {
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;

            if ($Folio) {
                $estudio = new CandidatosDatos();
                $estudio->setCandidato($Folio);
                $data = $estudio->getOne();

                header('Content-Type: text/html; charset=utf-8');
                echo json_encode($data, \JSON_UNESCAPED_UNICODE);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function save_localizacion()
    {
        if (Utils::isValid($_POST) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Municipio = Utils::sanitizeString(($_POST['Municipio']));
            $Estado = Utils::sanitizeNumber($_POST['Estado']);

            if ($Folio && $Municipio) {
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setCiudad($Municipio);
                $update = $estudio->updateCiudad();

                $ubicacion = new CandidatosUbicacion();
                $ubicacion->setCandidato($Folio);
                $ubicacion->setMunicipio($Municipio);
                $ubicacion->setEstado($Estado);
                $ubicacion->updateCiudadEstado();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function continuar_servicio()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isCustomerSA())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);
            $CURP = Utils::sanitizeStringBlank($_POST['CURP']);
            $NSS = Utils::sanitizeStringBlank($_POST['NSS']);
            $Fecha_Nacimiento = Utils::sanitizeStringBlank($_POST['Fecha_Nacimiento']);
            $Lugar_Nacimiento = Utils::sanitizeStringBlank($_POST['Lugar_Nacimiento']);
            $Telefono = Utils::sanitizeStringBlank($_POST['Telefono']);
            $Puesto = Utils::sanitizeStringBlank($_POST['Puesto']);
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Servicio_Solicitado = Utils::sanitizeNumber($_POST['Servicio_Solicitado']);
            $Ejecutivo = Utils::sanitizeStringBlank($_POST['Ejecutivo']);
            $Comentarios_Cliente = Utils::sanitizeStringBlank($_POST['Comentarios_Cliente']);
            $resume = isset($_FILES['resume']) && $_FILES['resume']['name'] != '' ? $_FILES['resume'] : FALSE;
            //$duplicar = isset($_POST['duplicar']) && $_POST['duplicar'] != 0 ? $_POST['duplicar'] : false;

            if ($Folio && ($Servicio_Solicitado == 231 || $Servicio_Solicitado == 230 || $Servicio_Solicitado == 328 || $Servicio_Solicitado == 340 || $Servicio_Solicitado == 341)) {
                $candidato_datos = new CandidatosDatos();
                $candidato_datos->setCandidato($Folio);
                $candidato_datos->setNacimiento($Fecha_Nacimiento);
                $candidato_datos->setLugar_Nacimiento($Lugar_Nacimiento);
                $candidato_datos->setCelular($Telefono);
                $candidato_datos->setCURP($CURP);
                $candidato_datos->setIMSS($NSS);
                $save_datos = $candidato_datos->updateDatosBasicos();
                $duplicar = $CURP && $CURP != '' && !empty($CURP) ? $candidato_datos->getOneCurpForDuplicate() : FALSE;

                $folio_docs = new CandidatosFolioDocumentos();
                $folio_docs->setCandidato($Folio);
                $folio_docs->setCURP($CURP);
                $folio_docs->setNSS($NSS);
                $folio_docs->setRFC('');
                $save_folio = $folio_docs->updateFolios();
                $Fase = $Servicio_Solicitado == 328 ? 328 : 299;

                if ($save_datos) {

                    $Ejecutivo = $Ejecutivo && !empty($Ejecutivo) ? $Ejecutivo : 'angelesdelacruz';
                    $estudio = new Candidatos();
                    $estudio->setCandidato($Folio);
                    $estudio->setFecha_solicitud(Utils::getFechaIngresoSA($Cliente));
                    $estudio->setPuesto($Puesto);
                    $estudio->setEjecutivo($Ejecutivo);
                    $estudio->setServicio_Solicitado($Servicio_Solicitado);
                    $estudio->setFase($Fase);
                    $estudio->setEstado($Estado);
                    $estudio->setComentario_Cliente($Comentarios_Cliente);

                    $servicio = $estudio->getOne();

                    $Fecha_Actual = date('Y-m-d H:i:s');
                    $fecha_ingreso_ral = date_format(date_create($servicio->Fecha), 'Y-m-d H:i:s');
                    $Fecha_mas72 = date('Y-m-d H:i:s', strtotime('+168 hour', strtotime($fecha_ingreso_ral)));

                    if ($Fecha_Actual < $Fecha_mas72) {
                        $update = $estudio->saveServicioSiguienteRAL();

                        if ($update) {
                            if ($resume) {
                                $allowed_formats = array("application/pdf");
                                $limit_kb = 20000;
                                if (!in_array($_FILES["resume"]["type"], $allowed_formats) || $_FILES["resume"]["size"] > $limit_kb * 1024) {
                                    //echo 4;
                                } else {

                                    $route = './curriculums/';
                                    $resume = $route . $Folio . '.pdf';

                                    //if(!file_exists($resume)){
                                    $result = move_uploaded_file($_FILES["resume"]["tmp_name"], $resume);
                                    //}
                                }
                            }

                            if ($duplicar) {
                                $duplicar = $duplicar->Candidato;
                                $estudio->copiarInfo($duplicar);

                                $candidato_datos->copiarInfo($duplicar);

                                if (!$folio_docs->getOne())
                                    $folio_docs->duplicate($duplicar);
                                else
                                    $folio_docs->copiarInfo($duplicar);

                                $ubicacion = new CandidatosUbicacion();
                                $ubicacion->setCandidato($Folio);
                                if (!$ubicacion->getOne())
                                    $ubicacion->duplicate($duplicar);
                                else
                                    $ubicacion->copiarInfo($duplicar);

                                $vivienda = new CandidatosVivienda();
                                $vivienda->setCandidato($Folio);
                                $vivienda->duplicate($duplicar);

                                $escolaridad = new CandidatosEscolaridad();
                                $escolaridad->setCandidato($Folio);
                                $escolaridad->duplicate($duplicar);

                                /*$salud = new CandidatosSalud();
                                $salud->setCandidato($Folio);
                                $salud->duplicate($duplicar);*/

                                /*$s_seguro = new CandidatosSaludSeguros();
                                $s_seguro->setCandidato($Folio);
                                $s_seguro->duplicate($duplicar);*/

                                $cohabitan = new CandidatosCohabitan();
                                $cohabitan->setCandidato($Folio);
                                $cohabitan->duplicate($duplicar);

                                $referencia = new CandidatosReferencias();
                                $referencia->setCandidato($Folio);
                                $referencia->duplicate($duplicar);

                                $laboral = new CandidatosLaborales();
                                $laboral->setCandidato($Folio);
                                $laboral->duplicate($duplicar);

                                $laboral_concepto = new CandidatosLaboralesConceptos();
                                $laboral_concepto->setCandidato($Folio);
                                $laboral_concepto->duplicate($duplicar);

                                $ingreso = new CandidatosIngresos();
                                $ingreso->setCandidato($Folio);
                                $ingreso->duplicate($duplicar);

                                $egreso = new CandidatosEgresos();
                                $egreso->setCandidato($Folio);
                                $egreso->duplicate($duplicar);

                                $credito = new CandidatosCreditos();
                                $credito->setCandidato($Folio);
                                $credito->duplicate($duplicar);

                                $bancaria = new CandidatosBancarias();
                                $bancaria->setCandidato($Folio);
                                $bancaria->duplicate($duplicar);

                                $seguro = new CandidatosSeguros();
                                $seguro->setCandidato($Folio);
                                $seguro->duplicate($duplicar);

                                $inmueble = new CandidatosInmuebles();
                                $inmueble->setCandidato($Folio);
                                $inmueble->duplicate($duplicar);

                                $vehiculo = new CandidatosVehiculos();
                                $vehiculo->setCandidato($Folio);
                                $vehiculo->duplicate($duplicar);

                                $investigacion = new Investigacion_Laboral;
                                $investigacion->setCandidato($Folio);
                                $investigacion->duplicate($duplicar);

                                /*$conociendo_candidato = new ConociendoCandidato();
                                $conociendo_candidato->setCandidato($Folio);
                                $conociendo_candidato->duplicate($duplicar);*/
                            }

                            $customer = new Clientes();
                            $customer->setCliente($Cliente);
                            $clientee = $customer->getOne();
                            $Nombre_Cliente = $clientee->Nombre_Cliente;
                            $id_cliente = $clientee->Cliente;

                            $Asunto = 'Nueva solicitud registrada de ' . $Nombre_Cliente;
                            $Reclutador = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                            $Correo = $_SESSION['identity']->email;
                            $usuario_ejecutivo = Utils::getUserByUsername($Ejecutivo);
                            $Correo_Ejecutivo = $usuario_ejecutivo->email;
                            $id_user = $usuario_ejecutivo->id;
                            $Tipo_Solicitud = $Servicio_Solicitado == 230 ? 'Estudio Socioeconómico' : ($Servicio_Solicitado == 231 || $Servicio_Solicitado == 299 ? 'Investigación Laboral' : ($Servicio_Solicitado == 300 ? 'Verificación domiciliaria' : ''));
                            $Nombre_Candidato = $servicio->Nombre_Candidato;
                            $Enlace = "https://rrhh-ingenia.com.mx/ServicioApoyo/ver&candidato=" . Encryption::encode($Folio);

                            if ($Servicio_Solicitado != 291) {

                                $body = "
                                    <!DOCTYPE html>
                                    <html>
                                        <head>
                                            <title>Nueva Solicitud</title> 
                                        </head>
                                        <body>
                                            <label>Nueva solicitud de <b>${Tipo_Solicitud}</b> registrado por <b>${Reclutador}</b>.</label>
                                            <br/><br/>
                                            <label>Candidato: <b>${Nombre_Candidato}</b></label><br/>
                                            <label>Telefono: <b>${Telefono}</b></label><br/>
                                            ${Comentarios_Cliente}
                                            <br></br>
                                            <label>Para mas detalles hacer clic </label>
                                            <a href='${Enlace}'>aqui!</a>
                                            <br/>
                                            <img style='align-content: center;' src='https://rrhh-ingenia.com/Imagenes/rrhh-ingenia.png' height='auto' width='550' ></img>
                                    </body>
                                    </html>";

                                Utils::newNotification($Reclutador . ' de ' . $Nombre_Cliente . ' solicita ' . $Tipo_Solicitud, $Enlace, 1, $Servicio_Solicitado == 231 || $Servicio_Solicitado == 299 ? 1 : ($Servicio_Solicitado == 230 || $Servicio_Solicitado == 300 ? 2 : ($Servicio_Solicitado == 328 ? 3 : 16)), $id_user, $_SESSION['identity']->id, $id_cliente);
                               
                                if (!Utils::isAdmin()) {
                                    Utils::sendEmail($Correo_Ejecutivo, $Reclutador, $Asunto, $body);
                                }


                                if ($Servicio_Solicitado == 300 || $Servicio_Solicitado == 230) {
                                    $ejecutivo = new EjecutivosPlazas();
                                    $ejecutivo->setID_Cliente($Cliente);
                                    $Logistica = $ejecutivo->getEjecutivosPorClienteLogistica();
                                    $id_logistica = $Logistica->id;
                                    if ($Logistica) {
                                        $estudio->setLogistica(strtoupper($Logistica->username));
                                        $estudio->setFecha_aplicacion(NULL);
                                        $estudio->updateSchedule();
                                        Utils::sendEmail($Logistica->email, $Logistica->first_name . ' ' . $Logistica->last_name, $Asunto, $body);
                                        Utils::newNotification($Reclutador . ' de ' . $Nombre_Cliente . ' solicita ' . $Tipo_Solicitud, $Enlace, 1, $Servicio_Solicitado == 231 || $Servicio_Solicitado == 299 ? 1 : ($Servicio_Solicitado == 230 || $Servicio_Solicitado == 300 ? 2 : ($Servicio_Solicitado == 328 ? 3 : 16)), $id_logistica, $_SESSION['identity']->id, $id_cliente);
                                    }
                                }

                                if ($Servicio_Solicitado == 328) {
                                    $estudio->setA_RAL(1);
                                    $estudio->updateARAL();
                                }

                                $Asunto2 = 'Confirmación de solicitud de ' . $Tipo_Solicitud . ' para ' . $Nombre_Candidato;
                                $body2 = "
                                <!DOCTYPE html>
                                <html>
                                    <head>
                                        <title>Nueva Solicitud</title> 
                                    </head>
                                    <body>
                                        <label>Estimado(a) <b>${Reclutador}</b>, se ha registrado con éxito su nueva solicitud de <b>${Tipo_Solicitud}</b>.</label><br/><br/>
                                        <label>Candidato: <b>${Nombre_Candidato}</b></label><br/>
                                        <label>Telefono: <b>${Telefono}</b></label><br/>${Comentarios_Cliente}<br/><br><br/>
                                        <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>                                    </body>
                                </html>";

                                if ($Cliente != 408 && !Utils::isAdmin())
                                    Utils::sendEmail($Correo, $Reclutador, $Asunto2, $body2);

                                echo json_encode(array('status' => 1));
                            }
                        } else
                            echo json_encode(array('status' => 2));
                    } else
                        echo json_encode(array('status' => 3));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function seguimiento()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();

            $perfil = new CfgImagenes();
            $perfil->setFolio_Origen($folio);
            $perfil->setTabla('Candidatos');
            $perfil = $perfil->getProfile();

            if (!$perfil) {
                if ($candidato_datos->Sexo == 99)
                    $perfil = array('../dist/img/user-icon-rose.png', 'png');
                else
                    $perfil = array('../dist/img/user-icon.png', 'png');
            }

            $referencia = new CandidatosReferencias();
            $referencia->setCandidato($folio);
            $referencias = $referencia->getReferenciasPorCandidato();

            $laboral = new CandidatosLaborales();
            $laboral->setCandidato($folio);
            $referencias_laborales = $laboral->getLaboralesPorCandidato();

            $investigacion = new Investigacion_Laboral;
            $investigacion->setCandidato($folio);
            $investigacion = $investigacion->getOne();

            $obs = new CandidatosObsGenerales();
            $obs->setCandidato($folio);
            $observaciones = $obs->getObservacionesPorCandidato();


            $estudios = new CandidatosEscolaridad();
            $estudios->setCandidato($folio);
            $escolaridad = $estudios->getEscolaridadPorCandidato();

            $cohabitan = new CandidatosCohabitan();
            $cohabitan->setCandidato($folio);
            $cohabitantes = $cohabitan->getCohabitantesPorCandidato($folio);

            $ubicacion = new CandidatosUbicacion();
            $ubicacion->setCandidato($folio);
            $ubicacion = $ubicacion->getOne();

            $vivienda = new CandidatosVivienda();
            $vivienda->setCandidato($folio);
            $vivienda = $vivienda->getOne();

            $ingreso = new CandidatosIngresos();
            $ingreso->setCandidato($folio);
            $ingresos = $ingreso->getIngresosPorCandidato();

            $egreso = new CandidatosEgresos();
            $egreso->setCandidato($folio);
            $egresos = $egreso->getEgresosPorCandidato();

            $credito = new CandidatosCreditos();
            $credito->setCandidato($folio);
            $creditos = $credito->getCreditosPorCandidato();

            $bancaria = new CandidatosBancarias();
            $bancaria->setCandidato($folio);
            $cuentas = $bancaria->getCuentasPorCandidato();

            $seguro = new CandidatosSeguros();
            $seguro->setCandidato($folio);
            $seguros = $seguro->getSegurosPorCandidato();

            $inmueble = new CandidatosInmuebles();
            $inmueble->setCandidato($folio);
            $inmuebles = $inmueble->getInmueblesPorCandidato();

            $vehiculo = new CandidatosVehiculos();
            $vehiculo->setCandidato($folio);
            $vehiculos = $vehiculo->getVehiculosPorCandidato();

            $busq_RAL = new Busqueda_RAL();
            $busq_RAL->setID($candidato_datos->ID_Busqueda_RAL);
            $busqueda_RAL = $busq_RAL->getOne();

            $fechas = array('Fecha_RAL' => $busqueda_RAL ? $busqueda_RAL->Fecha : NULL, 'Fecha' => $candidato_datos->Fecha, 'Fecha_Contactado' => $candidato_datos->Fecha_Contactado, 'Fecha_Entregado_INV' => $candidato_datos->Fecha_Entregado_INV, 'Fecha_Aplicacion' => $candidato_datos->Fecha_Aplicacion);

            asort($fechas);
            $fechas_nulas = [];
            foreach ($fechas as $key => $fecha) {
                if (!$fecha) {
                    $fechas_nulas[$key] = $fecha;
                    unset($fechas[$key]);
                }
            }
            $fechas = array_merge($fechas, $fechas_nulas);

            $page_title = $candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/follow-up.php';
            require_once 'views/layout/footer.php';
        }
    }

    public function previa()
    {
        if (Utils::isValid($_GET['candidato'])) {
            $folio = Encryption::decode(Encryption::decode($_GET['candidato']));
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();

            $perfil = new CfgImagenes();
            $perfil->setFolio_Origen($folio);
            $perfil->setTabla('Candidatos');
            $perfil = $perfil->getProfile();

            if (!$perfil) {
                if ($candidato_datos->Sexo == 99)
                    $perfil = array('../dist/img/user-icon-rose.png', 'png');
                else
                    $perfil = array('../dist/img/user-icon.png', 'png');
            }

            $obs = new CandidatosObsGenerales();
            $obs->setCandidato($folio);
            $observaciones = $obs->getObservacionesPorCandidato();

            $page_title = $candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/navbar.php';
            require_once 'views/ese/preview.php';
            require_once 'views/layout/footer.php';
        }
    }

    public function contact()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isLogisticsSupervisor())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Correos = ($_POST['Correos']);
            $Mensaje = Utils::sanitizeStringBlank($_POST['Mensaje']);

            $flag = Utils::sanitizeNumber($_POST['flag']);

            if ($Folio) {
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setContactado(1);
                $update = $estudio->updateContact();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();

                    $Nombre_Candidato = "$candidato_datos->Nombres $candidato_datos->Apellido_Paterno $candidato_datos->Apellido_Materno";

                    $Quien_Solicita = $candidato_datos->Quien_Solicita;

                    $body = "
                        <!DOCTYPE html>
                        <html>
                            <head>
                                <title>Agenda</title> 
                            </head>
                            <body>
                                <p>$Mensaje</p>
                                <img style='align-content: center;' src='https://rrhh-ingenia.com.mx/dist/img/rrhh-ingenia.png' height='auto' width='550' ></img>                            </body>
                        </html>
                        ";
                    $cc = array('email' => $_SESSION['identity']->email, 'name' => $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name);

                    if ($Correos) {
                        Utils::sendMultipleEmail($Correos, 'Se contactó a ' . $Nombre_Candidato, $body, $cc);
                    }

                    if ($flag == 1) {

                        $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                        $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                        $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';

                        $perfil = new CfgImagenes();
                        $perfil->setFolio_Origen($Folio);
                        $perfil->setTabla('Candidatos');
                        $perfil = $perfil->getProfile();

                        if (!$perfil) {
                            if ($candidato_datos->Sexo == 99)
                                $perfil = array('../dist/img/user-icon-rose.png', 'png');
                            else
                                $perfil = array('../dist/img/user-icon.png', 'png');
                        }

                        $display = Utils::getDisplayBotones();
                        echo json_encode(array(
                            'candidato_datos' => $candidato_datos,
                            'perfil' => $perfil,
                            'status' => 1,
                            'display' => $display
                        ));
                    }
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function save_pausar()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isCustomerSA())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Servicio_Solicitado = Utils::sanitizeNumber($_POST['Servicio_Solicitado']);
            $Fase = Utils::sanitizeNumber($_POST['Fase']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);
            $Comentario_Pausa = Utils::sanitizeString(($_POST['Comentario_Pausa']));

            if ($Folio && $Comentario_Pausa && ($Fase == 230 || $Fase == 231 || $Fase == 298 || $Fase == 291 || ($Servicio_Solicitado == 231 && $Fase == 231) || ($Servicio_Solicitado == 230 && $Fase == 230) || ($Servicio_Solicitado == 230 && $Fase == 300) || ($Servicio_Solicitado == 231 && $Fase == 299) || ($Servicio_Solicitado == 323 && $Fase == 324) || ($Servicio_Solicitado == 230 && $Fase == 299) || ($Servicio_Solicitado == 230 && $Fase == 231) || ($Servicio_Solicitado == 340 && $Fase == 300) || ($Servicio_Solicitado == 340 && $Fase == 299) || ($Servicio_Solicitado == 341 && $Fase == 300) || ($Servicio_Solicitado == 341 && $Fase == 299)) && ($Estado == 250 || $Estado == 251)) {


                $Estado = 249;

                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFase($Fase);
                $estudio->setEstado($Estado);
                $estudio->setComentario_Pausa($Comentario_Pausa);

                $update = $estudio->savePausa();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';
                    $candidato_datos->Fecha_Entregado_INV = $candidato_datos->Fecha_Entregado_INV ? Utils::getFullDate($candidato_datos->Fecha_Entregado_INV) : '';
                    $candidato_datos->Fecha_Entregado_ESE = $candidato_datos->Fecha_Entregado_ESE ? Utils::getFullDate($candidato_datos->Fecha_Entregado_ESE) : '';

                    $Nombre_Candidato = $candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno;

                    $subject = $Fase == 298 ? 'RAL de ' . $Nombre_Candidato . ' pausado' : (($Fase == 299 || $Fase == 231) ? 'Investigación Laboral de ' . $Nombre_Candidato . ' pausado' : ($Fase == 310 ? 'Validación de Licencia de ' . $Nombre_Candidato . ' pausado' : (($Fase == 300 || $Fase == 230) ? 'Verificación Domiciliaria de ' . $Nombre_Candidato . ' pausado' : ($Fase == 324 ? 'Verificación Domiciliaria con Visita Presencial de ' . $Nombre_Candidato . ' pausado' : ''))));

                    $saludo = date('G') < 6 || date('G') > 19 ? 'Buenas noches' : (date('G') >= 6 && date('G') < 12 ? 'Buenos días' : 'Buenas tardes');

                    $body = $Fase == 298 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que el <b>RAL</b> de <b>' . $Nombre_Candidato . '</b> ha quedado temporalmente pausado.<br><br><br>No es necesario responder a este correo.' : ($Fase == 299 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que la <b>Investigación Laboral</b> de <b>' . $Nombre_Candidato . '</b> ha quedado temporalmente pausado.<br><br><br>No es necesario responder a este correo.' : ($Fase == 310 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que la <b>Validación de Licencia</b> de <b>' . $Nombre_Candidato . '</b> ha quedado temporalmente pausado.<br><br><br>No es necesario responder a este correo.' : ($Fase == 300 || $Fase == 230 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que la <b>Verificación Domiciliaria</b> de <b>' . $Nombre_Candidato . '</b> ha quedado temporalmente pausado.<br><br><br>No es necesario responder a este correo.' : ($Fase == 324 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que la <b>Verificación Domiciliaria con Visita Presencial</b> de <b>' . $Nombre_Candidato . '</b> ha quedado temporalmente pausado.<br><br><br>No es necesario responder a este correo.' : ''))));

                    if (!Utils::isAdmin()) 
                    Utils::sendEmail($candidato_datos->Correo_Cliente, $candidato_datos->Quien_Solicita, $subject, $body);

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function save_reanudar()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics())) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $Servicio_Solicitado = Utils::sanitizeNumber($_POST['Servicio_Solicitado']);
            $Fase = Utils::sanitizeNumber($_POST['Fase']);
            $Estado = Utils::sanitizeNumber($_POST['Estado']);

            if ($Folio && ($Fase == 230 || $Fase == 231 || $Fase == 298 || ($Servicio_Solicitado == 231 && $Fase == 231) || ($Servicio_Solicitado == 230 && $Fase == 230) || ($Servicio_Solicitado == 230 && $Fase == 300) || ($Servicio_Solicitado == 231 && $Fase == 299) || ($Servicio_Solicitado == 323 && $Fase == 324) || ($Servicio_Solicitado == 230 && $Fase == 299) || ($Servicio_Solicitado == 230 && $Fase == 231) || ($Servicio_Solicitado == 340 && $Fase == 300) || ($Servicio_Solicitado == 340 && $Fase == 299) || ($Servicio_Solicitado == 341 && $Fase == 300) || ($Servicio_Solicitado == 341 && $Fase == 299)) && ($Estado == 249)) {

                $Estado = 250;

                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFase($Fase);
                $estudio->setEstado($Estado);

                $update = $estudio->saveReanudar();

                if ($update) {
                    $candidato = new CandidatosDatos();
                    $candidato->setCandidato($Folio);
                    $candidato_datos = $candidato->getOne();
                    $candidato_datos->Fecha = Utils::getFullDate($candidato_datos->Fecha);
                    $candidato_datos->Fecha_Entregado = $candidato_datos->Fecha_Entregado ? Utils::getFullDate($candidato_datos->Fecha_Entregado) : '';
                    $candidato_datos->Fecha_Aplicacion = $candidato_datos->Fecha_Aplicacion ? Utils::getFullDate($candidato_datos->Fecha_Aplicacion) : '';
                    $candidato_datos->Fecha_Entregado_INV = $candidato_datos->Fecha_Entregado_INV ? Utils::getFullDate($candidato_datos->Fecha_Entregado_INV) : '';
                    $candidato_datos->Fecha_Entregado_ESE = $candidato_datos->Fecha_Entregado_ESE ? Utils::getFullDate($candidato_datos->Fecha_Entregado_ESE) : '';

                    $Nombre_Candidato = $candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno;

                    $subject = $Fase == 298 ? 'RAL de ' . $Nombre_Candidato . ' reanudado' : (($Fase == 299 || $Fase == 231) ? 'Investigación Laboral de ' . $Nombre_Candidato . ' reanudado' : ($Fase == 310 ? 'Validación de Licencia de ' . $Nombre_Candidato . ' reanudado' : (($Fase == 300 || $Fase == 230) ? 'Verificación Domiciliaria de ' . $Nombre_Candidato . ' reanudado' : ($Fase == 324 ? 'Verificación Domiciliaria con Visita Presencial de ' . $Nombre_Candidato . ' reanudado' : ''))));

                    $saludo = date('G') < 6 || date('G') > 19 ? 'Buenas noches' : (date('G') >= 6 && date('G') < 12 ? 'Buenos días' : 'Buenas tardes');

                    $body = $Fase == 298 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que el <b>RAL</b> de <b>' . $Nombre_Candidato . '</b> se reanudará.<br><br><br>No es necesario responder a este correo.' : ($Fase == 299 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que la <b>Investigación Laboral</b> de <b>' . $Nombre_Candidato . '</b> se reanudará.<br><br><br>No es necesario responder a este correo.' : ($Fase == 310 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que la <b>Validación de Licencia</b> de <b>' . $Nombre_Candidato . '</b> se reanudará.<br><br><br>No es necesario responder a este correo.' : ($Fase == 300 || $Fase == 230 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que la <b>Verificación Domiciliaria</b> de <b>' . $Nombre_Candidato . '</b> se reanudará.<br><br><br>No es necesario responder a este correo.' : ($Fase == 324 ? $saludo . ', ' . $candidato_datos->Quien_Solicita . '<br><br>Se le informa que la <b>Verificación Domiciliaria con Visita Presencial</b> de <b>' . $Nombre_Candidato . '</b> se reanudará.<br><br><br>No es necesario responder a este correo.' : ''))));

                    if (!Utils::isAdmin()) 
                    Utils::sendEmail($candidato_datos->Correo_Cliente, $candidato_datos->Quien_Solicita, $subject, $body);

                    $perfil = new CfgImagenes();
                    $perfil->setFolio_Origen($Folio);
                    $perfil->setTabla('Candidatos');
                    $perfil = $perfil->getProfile();

                    if (!$perfil) {
                        if ($candidato_datos->Sexo == 99)
                            $perfil = array('../dist/img/user-icon-rose.png', 'png');
                        else
                            $perfil = array('../dist/img/user-icon.png', 'png');
                    }
                    $display = Utils::getDisplayBotones();
                    echo json_encode(array(
                        'candidato_datos' => $candidato_datos,
                        'perfil' => $perfil,
                        'status' => 1,
                        'display' => $display
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header("location:" . base_url);
    }

    public function carga_masiva()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {

            $page_title = 'Solicitud de múltiples servicio de apoyo | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/mass-create.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function create_multiple()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST) && isset($_POST['Nombres']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            if ($_POST['Nombres']) {
                for ($i = 0; $i < count($_POST['Nombres']); $i++) {
                    $Nombres = Utils::sanitizeStringBlank($_POST['Nombres'][$i]);
                    $Apellido_Paterno = Utils::sanitizeStringBlank($_POST['Apellido_Paterno'][$i]);
                    $Apellido_Materno = Utils::sanitizeStringBlank($_POST['Apellido_Materno'][$i]);
                    $Estado = Utils::sanitizeNumber($_POST['Estado'][$i]);
                    $Ciudad = Utils::sanitizeString($_POST['Ciudad'][$i]);
                    $CURP = Utils::sanitizeStringBlank($_POST['CURP'][$i]);
                    $NSS = Utils::sanitizeStringBlank($_POST['NSS'][$i]);
                    $Fecha_Nacimiento = Utils::sanitizeStringBlank($_POST['Fecha_Nacimiento'][$i]);
                    $Lugar_Nacimiento = Utils::sanitizeStringBlank($_POST['Lugar_Nacimiento'][$i]);
                    $Telefono = Utils::sanitizeStringBlank($_POST['Telefono'][$i]);
                    $Puesto = Utils::sanitizeStringBlank($_POST['Puesto'][$i]);
                    $Cliente = Utils::sanitizeNumber($_POST['Cliente'][$i]);
                    $Servicio_Solicitado = Utils::sanitizeNumber($_POST['Servicio_Solicitado'][$i]);
                    $Ejecutivo = Utils::sanitizeStringBlank($_POST['Ejecutivo'][$i]);
                    $Razon = Utils::sanitizeStringBlank($_POST['Razon'][$i]);
                    $CC_Cliente = Utils::sanitizeStringBlank($_POST['CC_Cliente'][$i]);
                    $Comentarios_Cliente = Utils::sanitizeStringBlank($_POST['Comentarios_Cliente'][$i]);

                    $Nivel = Utils::sanitizeNumber($_POST['Nivel'][$i]);

                    if ($Nombres && $Apellido_Paterno && $Apellido_Materno && $Estado && $Ciudad && $Cliente && $Servicio_Solicitado) {

                        $Fase = $Servicio_Solicitado == 299 ? 231 : ($Servicio_Solicitado == 300 ? 230 : ($Servicio_Solicitado == 311 || $Servicio_Solicitado == 310 ? 310 : ($Servicio_Solicitado == 291 ? 291 : 298)));

                        $Servicio_Solicitado = $Servicio_Solicitado == 299 ? 231 : ($Servicio_Solicitado == 300 ? 230 : ($Servicio_Solicitado));


                        if (Utils::isCustomerSA()) {
                            $persona_solicitan = new ContactosClienteSolicitan();
                            $persona_solicitan->setUsuario($_SESSION['identity']->username);
                            $persona_solicitan->setCliente($Cliente);
                            $Nombre_Cliente = $persona_solicitan->getOne();
                            if ($Nombre_Cliente)
                                $Nombre_Cliente = $Nombre_Cliente->ID;
                            else {
                                $contactoEmpresa = new ContactosEmpresa();
                                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                                $id_contacto = $contactoEmpresa->getContactoPorUsuario();
                                $Empresa = $id_contacto->Empresa;
                                $persona_solicitan->setEmpresa($Empresa);
                                $persona_solicitan->setNombre($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name);
                                if ($persona_solicitan->create())
                                    $Nombre_Cliente = $persona_solicitan->getID();
                                else
                                    $Nombre_Cliente = 0;
                            }
                        }
                        $Ejecutivo = $Ejecutivo && !empty($Ejecutivo) ? $Ejecutivo : 'angelesdelacruz';
                        $estudio = new Candidatos();
                        $estudio->setFecha_solicitud(Utils::getFechaIngresoSA($Cliente));
                        $estudio->setPuesto($Puesto);
                        $estudio->setCiudad($Ciudad);
                        $estudio->setEjecutivo($Ejecutivo);
                        $estudio->setRazon($Razon);
                        $estudio->setEstado(250);
                        $estudio->setServicio_Solicitado($Servicio_Solicitado);
                        $estudio->setFase($Fase);
                        $estudio->setCliente($Cliente);
                        $estudio->setNombre_Cliente($Nombre_Cliente);
                        $estudio->setComentario_Cliente($Comentarios_Cliente);
                        $estudio->setCC_Cliente($CC_Cliente);
                        $estudio->setPlaza_cliente('');
                        $estudio->setNivel($Nivel);
                        $estudio->setContactado(0);



                        $save = $estudio->create();
                        if ($save) {
                            $Candidato = $estudio->getCandidato();

                            $candidato_datos = new CandidatosDatos();
                            $candidato_datos->setCandidato($Candidato);
                            $candidato_datos->setNombres($Nombres);
                            $candidato_datos->setApellido_Paterno($Apellido_Paterno);
                            $candidato_datos->setApellido_Materno($Apellido_Materno);
                            $candidato_datos->setNacimiento($Fecha_Nacimiento);
                            $candidato_datos->setLugar_Nacimiento($Lugar_Nacimiento);
                            $candidato_datos->setSexo(0);
                            $candidato_datos->setEstado_Civil(0);
                            $candidato_datos->setFecha_Matrimonio('');
                            $candidato_datos->setHijos(0);
                            $candidato_datos->setVive_con('');
                            $candidato_datos->setTelefono_fijo('');
                            $candidato_datos->setCelular($Telefono);
                            $candidato_datos->setOtro_Contacto('');
                            $candidato_datos->setCorreos('');
                            $candidato_datos->setCURP($CURP);
                            $candidato_datos->setIMSS($NSS);
                            $save_datos = $candidato_datos->create();

                            $progreso = new Progreso();
                            $progreso->setCandidato($Candidato);
                            $progreso->create();
                            if ($Nivel == 1) {
                                $progreso->setDatos_Adicionales(10);
                                $progreso->updateDatosAdicionales();
                            }

                            if ($save_datos) {
                                $folio_docs = new CandidatosFolioDocumentos();
                                $folio_docs->setCandidato($Candidato);
                                $folio_docs->setActa_Nacimiento('');
                                $folio_docs->setLicencia('');
                                $folio_docs->setINE('');
                                $folio_docs->setCartilla_Militar('');
                                $folio_docs->setCURP($CURP);
                                $folio_docs->setRFC('');
                                $folio_docs->setNSS($NSS);
                                $folio_docs->setAfore('');
                                $folio_docs->setComprobante_domicilio('');
                                $folio_docs->setP_Acta(0);
                                $folio_docs->setP_Licencia(0);
                                $folio_docs->setP_INE(0);
                                $folio_docs->setP_Cartilla_Militar(0);
                                $folio_docs->setP_CURP(0);
                                $folio_docs->setP_RFC(0);
                                $folio_docs->setP_NSS(0);
                                $folio_docs->setP_Afore(0);
                                $folio_docs->setP_ComprobanteD(0);
                                $folio_docs->setRedes_Sociales('');
                                $folio_docs->create();

                                $ubicacion = new CandidatosUbicacion();
                                $ubicacion->setCandidato($Candidato);
                                $ubicacion->setCalle('');
                                $ubicacion->setExterior('');
                                $ubicacion->setInterior('');
                                $ubicacion->setColonia('');
                                $ubicacion->setEntre_Calles('');
                                $ubicacion->setMunicipio($Ciudad);
                                $ubicacion->setEstado($Estado);
                                $ubicacion->setCodigo_Postal('');
                                $ubicacion->setVia_acceso('');
                                $ubicacion->setFachada('');
                                $ubicacion->setZona('');
                                $ubicacion->create();

                                $customer = new Clientes();
                                $customer->setCliente($Cliente);
                                $clientee = $customer->getOne();
                                $Nombre_Cliente = $clientee->Nombre_Cliente;
                                $id_cliente = $clientee->Cliente;

                                $Asunto = 'Nueva solicitud registrada de ' . $Nombre_Cliente;
                                $Reclutador = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                                $Correo = $_SESSION['identity']->email;
                                $usuario_ejecutivo = Utils::getUserByUsername($Ejecutivo);
                                $Correo_Ejecutivo = $usuario_ejecutivo->email;
                                $id_user = $usuario_ejecutivo->id;
                                $Tipo_Solicitud = $Servicio_Solicitado == 230 ? 'Estudio Socioeconómico' : ($Servicio_Solicitado == 231 ? 'Investigación Laboral' : ($Servicio_Solicitado == 298 || $Servicio_Solicitado == 291 ? 'Reporte de Antecedentes Legales' : ($Servicio_Solicitado == 5 ? 'Reporte de Antecedentes Legales y Estudio Socioeconómico' : ($Servicio_Solicitado == 300 ? 'Verificación domiciliaria' : ($Servicio_Solicitado == 5 ? 'Reporte de Antecedentes Legales y Estudio Socioeconómico' : ($Servicio_Solicitado == 323 ? 'Estudio Socioeconómico con Visita Presencial' : ''))))));
                                $Nombre_Candidato = $Nombres . ' ' . $Apellido_Paterno . ' ' . $Apellido_Materno;
                                $Enlace = "https://rrhh-ingenia.com.mx/ServicioApoyo/ver&candidato=" . Encryption::encode($Candidato);

                                if ($Servicio_Solicitado == 300 || $Servicio_Solicitado == 230) {
                                    $ejecutivo = new EjecutivosPlazas();
                                    $ejecutivo->setID_Cliente($Cliente);
                                    $Logistica = $ejecutivo->getEjecutivosPorClienteLogistica();
                                    //$id_logistica = $Logistica->id;
                                    if ($Logistica) {
                                        $estudio->setLogistica(strtoupper($Logistica->username));
                                        $estudio->setFecha_aplicacion(NULL);
                                        $estudio->updateSchedule();
                                    }
                                }

                                if ($i == count($_POST['Nombres']) - 1) {
                                    echo json_encode(array(
                                        'status' => 1
                                    ));
                                }
                            } else
                                echo json_encode(array('status' => 2));
                        } else
                            echo json_encode(array('status' => 2));
                    } else
                        echo json_encode(array('status' => 0));
                }
            }
        } else
            header('location:' . base_url);
    }

    public function soi()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager())) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Estatus = Utils::sanitizeNumber($_POST['Estatus']);

            if ($Candidato) {
                $estudio = new CandidatosDatos();
                $estudio->setCandidato($Candidato);
                $candidato_datos = $estudio->getOne();
                if ($candidato_datos->Servicio_Solicitado == 'SOI' || $candidato_datos->Servicio == 300) {
                    $soi = new SOI();
                    $soi->setCandidato($Candidato);
                    $soi->setAutorizado_Por($_SESSION['identity']->id);
                    $soi->setActivo($Estatus);
                    $save = $soi->create();
                    if ($save && $Estatus == 1) {
                        $soiCer = $soi->getOne();
                        $vl = new ValidacionLicenciaFederal();
                        $vl->setCandidato($Candidato);
                        $vl = $vl->getOne();

                        $perfil = new CfgImagenes();
                        $perfil->setFolio_Origen($Candidato);
                        $perfil->setTabla('Candidatos');
                        $perfil = $perfil->getProfile();

                        $soiImage = new SOIQR();
                        $soiImage->credencial($candidato_datos, $vl, $perfil);

                        $soi = 0;
                        if (file_exists('uploads/soi/' . $Candidato . '.png'))
                            $soi = base_url . 'uploads/soi/' . $Candidato . '.png';

                        $display = Utils::getDisplayBotones();
                        echo json_encode(array(
                            'candidato_datos' => $candidato_datos,
                            'soiCer' => $soiCer,
                            'soi' => $soi,
                            'status' => 1,
                            'display' => $display
                        ));
                    }
                }
            } else
                echo 0;
        } else
            header('location:' . base_url);
    }

    public function upload_google_search()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            $Folio = Utils::sanitizeNumber($_POST['Folio']);
            $search = isset($_FILES['search']) && $_FILES['search']['name'] != '' ? $_FILES['search'] : FALSE;
            if ($search && $Folio) {
                if (file_exists('uploads/google_search/' . $Folio . '.pdf')) {
                    Utils::deleteDir('uploads/google_search/' . $Folio . '.pdf');
                }

                $allowed_formats = array("application/pdf");
                $limit_kb = 16000;

                if (in_array($_FILES["search"]["type"], $allowed_formats) && $_FILES["search"]["size"] <= $limit_kb * 1024) {
                    $route = 'uploads/google_search/';
                    $search = $route . $Folio . '.pdf';

                    mkdir($route);

                    $result = @move_uploaded_file($_FILES["search"]["tmp_name"], $search);

                    if ($result) {
                        echo json_encode(['status' => 1, 'google_search' => base_url . 'uploads/google_search/' . $Folio . '.pdf']);
                    } else {
                        echo json_encode(['status' => 2]);
                    }
                }
            } else {
                echo json_encode(['status' => 0]);
            }
        }
    }
}
