<?php

require_once 'models/SA/CandidatosDatos.php';
require_once 'models/SA/CandidatosFolioDocumentos.php';
require_once 'models/SA/Progreso.php';
class DatosController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            
            if ($Candidato) {
                $candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $data = $candidato->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save_contacto(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Telefono_fijo = Utils::sanitizeStringBlank($_POST['Telefono_fijo']);
            $Celular = Utils::sanitizeStringBlank($_POST['Celular']);
            $Otro_Contacto = Utils::sanitizeStringBlank($_POST['Otro_Contacto']);
            $Correos = Utils::sanitizeStringBlank($_POST['Correos']);
            $Linkedin = Utils::sanitizeStringBlank($_POST['Linkedin']);
            $Facebook = Utils::sanitizeStringBlank($_POST['Facebook']);
            $Domicilio = Utils::sanitizeStringBlank($_POST['Domicilio']);
            $Numero_Licencia =isset($_POST['Numero_Licencia'])? Utils::sanitizeStringBlank($_POST['Numero_Licencia']):null;

            if ($Candidato) {
                $candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato->setTelefono_fijo($Telefono_fijo);
                $candidato->setCelular($Celular);
                $candidato->setOtro_Contacto($Otro_Contacto);
                $candidato->setCorreos($Correos);
                $candidato->setLinkedin($Linkedin);
                $candidato->setFacebook($Facebook);
                $candidato->setDomicilio($Domicilio);
				$candidato->setNumero_Licencia($Numero_Licencia);

                $save = $candidato->updateContacto();
               
                if ($save) {
                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Datos_Generales == 0) {
                            $progreso->setDatos_Generales(10);
                            $progreso->updateDatosGenerales();
                        }elseif ($progress->Datos_Generales == 10) {
                            $progreso->setDatos_Generales(20);
                            $progreso->updateDatosGenerales();
                        }
                    }
                    $data = $candidato->getOne();
                    $data->status = 1;
                    $data->display = Utils::getDisplayBotones();
                    echo json_encode($data);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function save_datos_personales(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);
            $Nacimiento = Utils::sanitizeStringBlank($_POST['Nacimiento']);
            $Edad = Utils::sanitizeStringBlank($_POST['Edad']);
            $Sexo = Utils::sanitizeNumber($_POST['Sexo']);
            $Lugar_Nacimiento = Utils::sanitizeStringBlank($_POST['Lugar_Nacimiento']);
            $Estado_Civil = Utils::sanitizeNumber($_POST['Estado_Civil']);
            $Fecha_Matrimonio = Utils::sanitizeStringBlank($_POST['Fecha_Matrimonio']);
            $Hijos = Utils::sanitizeNumber($_POST['Hijos']);
            $Nacionalidad = Utils::sanitizeStringBlank($_POST['Nacionalidad']);
            $Vive_con = Utils::sanitizeStringBlank($_POST['Vive_con']);
            $CURP = Utils::sanitizeStringBlank($_POST['CURP']);
            $IMSS = Utils::sanitizeStringBlank($_POST['IMSS']);
            $RFC = Utils::sanitizeStringBlank($_POST['RFC']);
            $Numero_Licencia =isset($_POST['Numero_Licencia'])? Utils::sanitizeStringBlank($_POST['Numero_Licencia']):null;

            if ($Candidato) {
                $candidato = new CandidatosDatos();
                $candidato->setCandidato($Candidato);
                $candidato->setNacimiento($Nacimiento);
                $candidato->setEdad($Edad);
                $candidato->setSexo($Sexo);
                $candidato->setLugar_Nacimiento($Lugar_Nacimiento);
                $candidato->setEstado_Civil($Estado_Civil);
                $candidato->setFecha_Matrimonio($Fecha_Matrimonio);
                $candidato->setHijos($Hijos);
                $candidato->setNacionalidad($Nacionalidad);
                $candidato->setVive_con($Vive_con);
                $candidato->setCURP($CURP);
                $candidato->setIMSS($IMSS);
                $candidato->setRFC($RFC);
                $candidato->setNumero_Licencia($Numero_Licencia);
                
                $save = $candidato->updateDatosPersonales();
               
                if ($save) {
                    $folio_doc = new CandidatosFolioDocumentos();
                    $folio_doc->setCandidato($Candidato);
                    $folio_doc->setCURP($CURP);
                    $folio_doc->setNSS($IMSS);
                    $folio_doc->setRFC($RFC);

                    $folio_doc->updateFolios();

                    $progreso = new Progreso();
                    $progreso->setCandidato($Candidato);
                    $progress = $progreso->getOne();
                    if ($progress->Candidato) {
                        if ($progress->Datos_Generales == 0) {
                            $progreso->setDatos_Generales(10);
                            $progreso->updateDatosGenerales();
                        }
                    }
                    $data = $candidato->getOne();
                    $data->Estado_Civil = Utils::getEstadoCivil($data->Estado_Civil);
                    $data->Sexo = Utils::getSexo($data->Sexo);
                    $data->status = 1;
                    $data->display = Utils::getDisplayBotones();
					
                    echo json_encode($data);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
	
	public function checkCURP(){
        if (Utils::isValid($_POST['curp'])) {
            $candidato = new CandidatosDatos();
            $candidato->setCURP($_POST['curp']);
            $curp = $candidato->getOneCurpForDuplicate();
            if ($curp) 
                echo json_encode(array('status' => 1, 'Nombre' => $curp->Nombres.' '.$curp->Apellido_Paterno.' '.$curp->Apellido_Materno, 'Candidato' => $curp->Candidato));
            else
                echo json_encode(array('status' => 0));
        } else {
            header("location:".base_url);
        }
    }

}