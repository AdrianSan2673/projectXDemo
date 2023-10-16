<?php

require_once 'libraries/fpdf/fpdf.php';
require_once 'helpers/FormatosSA/ESE.php';
require_once 'helpers/FormatosSA/ESEP.php';
require_once 'helpers/FormatosSA/ESEING.php';
require_once 'helpers/FormatosSA/InvestigacionLaboral.php';
require_once 'helpers/FormatosSA/InvestigacionLaboraling.php';
require_once 'helpers/FormatosSA/RAL.php';
require_once 'helpers/FormatosSA/RALING.php';
require_once 'helpers/FormatosSA/ValidacionLicenciaFederalPDF.php';
require_once 'helpers/FormatosSA/ResultadoRAL.php';
require_once 'helpers/FormatosSA/ResumenResultadoRAL.php';
require_once 'helpers/FormatosSA/SOI.php';
require_once 'helpers/DC3.php';
require_once 'models/SA/CfgImagenes.php';
require_once 'models/SA/CandidatosDatos.php';
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
require_once 'models/SA/CandidatosLaborales.php';
require_once 'models/SA/CandidatosObsGenerales.php';
require_once 'models/SA/CandidatosRAL.php';
require_once 'models/SA/ValidacionLicenciaFederal.php';
require_once 'models/RH/Employee_trainings.php';
require_once 'models/RAL/Busqueda_RAL.php';
require_once 'models/RAL/Expediente_RAL.php';
require_once 'models/RAL/Acuerdos_RAL.php';

class FormatoController{
	
		

	
	public function ese(){
		if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();
			
			//Cliente Vetado
			//Utils::isClienteVetado($candidato_datos->Cliente);
			 if ($candidato_datos->Cliente==139) {//Grupo FH
                $nombre=strtoupper(Utils::eliminarAcentos($candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno.' '.$candidato_datos->Nombres));
            }else{
                $nombre = utf8_encode($candidato_datos->Nombres.' '.$candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno);
            }
			
			
            $perfil = new CfgImagenes();
            $perfil->setFolio_Origen($folio);
            $perfil->setTabla('Candidatos');
            $perfil = $perfil->getProfile();

            $doc = new CfgImagenes();
            $doc->setCandidato($folio);
            $doc_adjuntos = $doc->getDocumentosAdjuntos();

            $folio_docs = new CandidatosFolioDocumentos();
            $folio_docs->setCandidato($folio);
            $docs = $folio_docs->getOne();

            $conociendo = new ConociendoCandidato();
            $conociendo->setCandidato($folio);
            $conociendo_candidato = $conociendo->getOne();

            $estudios = new CandidatosEscolaridad();
            $estudios->setCandidato($folio);
            $escolaridad = $estudios->getEscolaridadPorCandidato();

            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $salud = new CandidatosSalud();
                $salud->setCandidato($folio);
                $historial_salud = $salud->getOne();

                $s_seguro = new CandidatosSaludSeguros();
                $s_seguro->setCandidato($folio);
                $salud_seguros = $s_seguro->getSaludSegurosPorCandidato();
            //}

            $cohabitan = new CandidatosCohabitan();
            $cohabitan->setCandidato($folio);
            $cohabitantes = $cohabitan->getCohabitantesPorCandidato($folio);

            $circulo = new CirculoFamiliar();
            $circulo->setCandidato($folio);
            $circulo_familiar = $circulo->getFamiliaresPorCandidato();

            $vivienda = new CandidatosVivienda();
            $vivienda->setCandidato($folio);
            $vivienda = $vivienda->getOne();

            $ubicacion = new CandidatosUbicacion();
            $ubicacion->setCandidato($folio);
            $domicilio = $ubicacion->getDomicilioCompleto();
            $ubicacion = $ubicacion->getOne();
            
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $enser = new Enseres();
                $enser->setCandidato($folio);
                $enseres = $enser->getOne();
            //}

            $ubicacion_exterior = new CfgImagenes();
            $ubicacion_exterior->setFolio_Origen($folio);
            $ubicacion_exterior = $ubicacion_exterior->getExteriorDomicilio();

            $ubicacion_no_exterior = new CfgImagenes();
            $ubicacion_no_exterior->setCandidato($folio);
            $ubicacion_no_exterior = $ubicacion_no_exterior->getNumeroExteriorDomicilio();

            $ubicacion_interior = new CfgImagenes();
            $ubicacion_interior->setFolio_Origen($folio);
            $ubicacion_interior = $ubicacion_interior->getInteriorDomicilio();

            $ubicacion_geografica = new CfgImagenes();
            $ubicacion_geografica->setCandidato($folio);
            $ubicacion_geografica->setFolio_Origen(289);
            $ubicacion_geografica = $ubicacion_geografica->getDocumento();
			
			$ubicacion_calle = new CfgImagenes();
            $ubicacion_calle->setCandidato($folio);
            $ubicacion_calle->setFolio_Origen(321);
            $ubicacion_calle = $ubicacion_calle->getDocumento();

            $referencia = new CandidatosReferencias();
            $referencia->setCandidato($folio);
            $referencias = $referencia->getReferenciasPorCandidato();

            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
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
            //}
            
            //if ($candidato_datos->ID_Empresa == 137){
                $investigacion = new Investigacion_Laboral;
                $investigacion->setCandidato($folio);
                $investigacion = $investigacion->getOne();

                $laboral = new CandidatosLaborales();
                $laboral->setCandidato($folio);
                $referencias_laborales = $laboral->getLaboralesPorCandidato();
            //}

            $obs = new CandidatosObsGenerales();
            $obs->setCandidato($folio);
            $observaciones = $obs->getObservacionesPorCandidato();

            $ral = new CandidatosRAL();
            $ral->setCandidato($folio);
            $ral = $ral->getOne();

            $documento = new CfgImagenes();
            $documento->setCandidato($folio);
            $documento->setFolio_Origen(269);
            $credencial_frente = $documento->getDocumento();
            $documento->setFolio_Origen(270);
            $credencial_atras = $documento->getDocumento();
            $documento->setFolio_Origen(271);
            $acta_nacimiento = $documento->getDocumento();
            $documento->setFolio_Origen(272);
            $licencia = $documento->getDocumento();
            $documento->setFolio_Origen(273);
            $cartilla_militar = $documento->getDocumento();
            $documento->setFolio_Origen(274);
            $curp = $documento->getDocumento();
            $documento->setFolio_Origen(275);
            $rfc = $documento->getDocumento();
            $documento->setFolio_Origen(276);
            $nss = $documento->getDocumento();
            $documento->setFolio_Origen(277);
            $afore = $documento->getDocumento();
            $documento->setFolio_Origen(278);
            $comprobante_domicilio = $documento->getDocumento();
            $documento->setFolio_Origen(279);
            $comprobante_estudios = $documento->getDocumento();
            $documento->setFolio_Origen(280);
            $registro_patronal_1 = $documento->getDocumento();
            $documento->setFolio_Origen(281);
            $registro_patronal_2 = $documento->getDocumento();
            $documento->setFolio_Origen(296);
            $registro_patronal_3 = $documento->getDocumento();
            $documento->setFolio_Origen(301);
            $registro_patronal_4 = $documento->getDocumento();
            $documento->setFolio_Origen(302);
            $registro_patronal_5 = $documento->getDocumento();
            $documento->setFolio_Origen(307);
            $registro_patronal_6 = $documento->getDocumento();
            $documento->setFolio_Origen(308);
            $registro_patronal_7 = $documento->getDocumento();
            $documento->setFolio_Origen(282);
            $redes_sociales = $documento->getDocumento();
            $documento->setFolio_Origen(283);
            $carta_laboral_1 = $documento->getDocumento();
            $documento->setFolio_Origen(284);
            $carta_laboral_2 = $documento->getDocumento();
            $documento->setFolio_Origen(303);
            $carta_laboral_3 = $documento->getDocumento();
            $documento->setFolio_Origen(305);
            $carta_laboral_4 = $documento->getDocumento();
            $documento->setFolio_Origen(306);
            $carta_laboral_5 = $documento->getDocumento();
            $documento->setFolio_Origen(285);
            $infonavit = $documento->getDocumento();
            $documento->setFolio_Origen(295);
            $infonavitSI = $documento->getDocumento();
            $documento->setFolio_Origen(294);
            $infonavitNO = $documento->getDocumento();
			
			$documento->setFolio_Origen(322);
            $contrato_arrendamiento = $documento->getDocumento();
			
            $documento->setFolio_Origen(286);
            $aviso_privacidad = $documento->getDocumento();
            $documento->setFolio_Origen(287);
            $carta_visita_domiciliaria = $documento->getDocumento();
            $documento->setFolio_Origen(304);
            $buro_credito = $documento->getDocumento();
			
			$documento->setFolio_Origen(325);
            $foto_exterior_vp = $documento->getDocumento();
            $documento->setFolio_Origen(326);
            $foto_ine_frente_vp = $documento->getDocumento();
            $documento->setFolio_Origen(327);
            $foto_ine_detras_vp = $documento->getDocumento();
            $documento->setFolio_Origen(290);
            $foto_gestor = $documento->getDocumento();
			
			$documento->setFolio_Origen(329);
            $anexo_1 = $documento->getDocumento();
            $documento->setFolio_Origen(330);
            $anexo_2 = $documento->getDocumento();
            $documento->setFolio_Origen(331);
            $anexo_3 = $documento->getDocumento();
            $documento->setFolio_Origen(332);
            $anexo_4 = $documento->getDocumento();
            $documento->setFolio_Origen(333);
            $anexo_5 = $documento->getDocumento();

			
            $pdf = new ESE("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->qr = false;
            if ($candidato_datos->Enlace_Drive) {
                require_once './libraries/phpqrcode/qrlib.php';

                $dir = './libraries/phpqrcode/tmp/';
                if (!file_exists($dir))
                    mkdir($dir);
                $qrFile = 'qr'. uniqid() .'.png';
                $videollamada = $candidato_datos->Enlace_Drive;

                QRcode::png($videollamada, $dir.$qrFile, 'M', 8, 6);
                $pdf->qr = $dir.$qrFile;
                $pdf->Enlace_Drive = $candidato_datos->Enlace_Drive;
            }
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold','B', 'SinkinSans-800Black.php');
			$pdf->SetTitle("Verificación Domiciliaria ".utf8_decode($nombre), true);
			$pdf->SetMargins(0, 55, 0, 0);
            $pdf->tieneHeader = false;
            $pdf->AddPage();
            $pdf->nombre = $nombre;
       
            
			$pdf->setPortada($candidato_datos, $observaciones->Viable);
            $pdf->SetMargins(10, 100, 10);
            $pdf->tieneHeader = true;
            $pdf->setDatosGenerales($candidato_datos, $perfil);
            $pdf->setDatosPersonales($candidato_datos, $docs);
            $pdf->setDatosContacto($candidato_datos, $domicilio);
            if (!$conociendo_candidato) {
                $pdf->setDatosAdicionales($candidato_datos);
            }
            $pdf->setConociendoCandidato($conociendo_candidato);
            $pdf->setDocumentacionPresentada($doc_adjuntos, $candidato_datos->Comentario_Documentos);
            $pdf->setEstudios($escolaridad, $candidato_datos->Comentario_Escolaridad);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $pdf->setHistorialSalud($historial_salud, $salud_seguros);
                $pdf->setSalud($historial_salud, $salud_seguros);
            //}   
            $pdf->setSociales($candidato_datos);
            $pdf->setCohabitantes($cohabitantes, $candidato_datos->Comentario_Cohabitan);
            $pdf->setCirculoFamiliar($circulo_familiar);
            $pdf->setVivienda($vivienda, $ubicacion, $candidato_datos->Comentario_Vivienda);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $pdf->setEnseres($enseres);
            //}
         if ($ubicacion_exterior) {
                $pdf->setFotoExteriorDomicilio($ubicacion_exterior);
            }
            if ($ubicacion_no_exterior) {
                $pdf->setFotoNoExteriorDomicilio($ubicacion_no_exterior);
            }
            if ($ubicacion_interior) {
                $pdf->setFotoInteriorDomicilio($ubicacion_interior);
            }
			
			
            $pdf->setFotoUbicacionGeografica($ubicacion_geografica);
            $pdf->setFotoUbicacionCalle($ubicacion_calle);
            $pdf->setReferencias($referencias);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $pdf->setEconomiaFamiliar($ingresos, $egresos, $candidato_datos->Comentario_Economia);
                $pdf->setInformacionFinanciera($creditos, $cuentas, $seguros, $candidato_datos->INFONAVIT);
                $pdf->setInformacionPatrimonial($inmuebles, $vehiculos);
            //}
            $pdf->setConclusiones($observaciones);
            //if ($candidato_datos->ID_Empresa == 137) {
                $pdf->setInvestigacionLaboral($investigacion, $candidato_datos->ID_Empresa);
                $pdf->setReferenciasLaborales($referencias_laborales, $candidato_datos->Cliente, $candidato_datos->ID_Empresa);
                $pdf->setResultadoInvestigacionLaboral($observaciones, $candidato_datos->ID_Empresa); 
                $pdf->setNotasLegales($ral);
            //}
            $pdf->setFotoCredencial($credencial_frente, $credencial_atras);
            $pdf->setFotoActaNacimiento($acta_nacimiento);
            $pdf->setFotoLicenciaConducir($licencia);
            $pdf->setFotoCartillaMilitar($cartilla_militar);
            $pdf->setFotoCURP($curp);
            $pdf->setFotoRFC($rfc);
            $pdf->setFotoNSS($nss);
            $pdf->setFotoAfore($afore);
            $pdf->setFotoComprobanteDomicilio($comprobante_domicilio);
            $pdf->setFotoComprobanteEstudios($comprobante_estudios);
            $pdf->setFotoRegistroPatronal($registro_patronal_1, 1);
            $pdf->setFotoRegistroPatronal($registro_patronal_2, 2);
            $pdf->setFotoRegistroPatronal($registro_patronal_3, 3);
            $pdf->setFotoRegistroPatronal($registro_patronal_4, 4);
            $pdf->setFotoRegistroPatronal($registro_patronal_5, 5);
            $pdf->setFotoRegistroPatronal($registro_patronal_6, 6);
            $pdf->setFotoRegistroPatronal($registro_patronal_7, 7);
            $pdf->setFotoRedesSociales($redes_sociales, $docs->Redes_Sociales);
            $pdf->setFotoCartaLaboral($carta_laboral_1, 1);
            $pdf->setFotoCartaLaboral($carta_laboral_2, 2);
            $pdf->setFotoCartaLaboral($carta_laboral_3, 3);
            $pdf->setFotoCartaLaboral($carta_laboral_4, 4);
            $pdf->setFotoCartaLaboral($carta_laboral_5, 5);
            $pdf->setFotoCartaLiberacionInfonavit($infonavit);
            $pdf->setFotoCartaInfonavitSi($infonavitSI);
            $pdf->setFotoCartaInfonavitNo($infonavitNO);
            $pdf->setFotoContratoArrendamiento($contrato_arrendamiento);
            $pdf->setFotoAvisoPrivacidad($aviso_privacidad);
            $pdf->setFotoCartaVD($carta_visita_domiciliaria);
            $pdf->setFotoBuroCredito($buro_credito);
            $pdf->setFotoExteriorDomicilioGestor($foto_exterior_vp);
            $pdf->setFotoCredencialGestor($foto_ine_frente_vp, $foto_ine_detras_vp);
            $pdf->setFotoCandidatoGestor($foto_gestor);
			$pdf->setFotoAnexo($anexo_1, 1);
          
			if($candidato_datos->ID_Empresa=='167'){
			$pdf->setFotoAnexo($anexo_2, 2,'FOTO EXTERIOR DE LA CASA');
			 $pdf->setFotoAnexo($anexo_3, 3,'FOTO DEL NÚMERO DEL DOMICILIO');
			 $pdf->setFotoAnexo($anexo_4, 4,'FOTO INTERIOR DE LA CASA 1');
			 $pdf->setFotoAnexo($anexo_5, 5,'FOTO INTERIOR DE LA CASA 2');
			}else{
			 $pdf->setFotoAnexo($anexo_2, 2);
			 $pdf->setFotoAnexo($anexo_3, 3);
			 $pdf->setFotoAnexo($anexo_4, 4);
			 $pdf->setFotoAnexo($anexo_5, 5);
			}
            $pdf->Output('I', 'VD '.utf8_decode($nombre).'.pdf', true); 
		}else{
			header("location:".base_url);
		}
	}
	
		


    public function investigacion_laboral(){
		if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();
          
		    //Cliente Vetado
			//Utils::isClienteVetado($candidato_datos->Cliente);
			
            if ($candidato_datos->Cliente==139) {//Grupo FH
                $nombre=strtoupper(Utils::eliminarAcentos($candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno.' '.$candidato_datos->Nombres));
            }else{
                $nombre = utf8_encode($candidato_datos->Nombres.' '.$candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno);
            }

            $folio_docs = new CandidatosFolioDocumentos();
            $folio_docs->setCandidato($folio);
            $docs = $folio_docs->getOne();
			
			$ubicacion_geografica = new CfgImagenes();
            $ubicacion_geografica->setCandidato($folio);
            $ubicacion_geografica->setFolio_Origen(289);
            $ubicacion_geografica = $ubicacion_geografica->getDocumento();

            $ubicacion_calle = new CfgImagenes();
            $ubicacion_calle->setCandidato($folio);
            $ubicacion_calle->setFolio_Origen(321);
            $ubicacion_calle = $ubicacion_calle->getDocumento();

			$perfil = new CfgImagenes();
			$perfil->setFolio_Origen($folio);
			$perfil->setTabla('Candidatos');
			$perfil = $perfil->getProfile();
			
			if ($candidato_datos->Tipo_Investigacion != 1) {
                $estudios = new CandidatosEscolaridad();
                $estudios->setCandidato($folio);
                $escolaridad = $estudios->getEscolaridadPorCandidato();

                
                $cohabitan = new CandidatosCohabitan();
                $cohabitan->setCandidato($folio);
                $cohabitantes = $cohabitan->getCohabitantesPorCandidato($folio);
				
				//aqui iba la referencia 
               
            }
				$referencia = new CandidatosReferencias();
				$referencia->setCandidato($folio);
				$referencias = $referencia->getReferenciasPorCandidato();
			
            $domicilio = $candidato_datos->Domicilio;        

            $investigacion = new Investigacion_Laboral;
            $investigacion->setCandidato($folio);
            $investigacion = $investigacion->getOne();

            $laboral = new CandidatosLaborales();
            $laboral->setCandidato($folio);
            $referencias_laborales = $laboral->getLaboralesPorCandidato();

            $obs = new CandidatosObsGenerales();
            $obs->setCandidato($folio);
            $observaciones = $obs->getObservacionesPorCandidato();
			
			$ral = new CandidatosRAL();
            $ral->setCandidato($folio);
            $ral = $ral->getOne();

            $documento = new CfgImagenes();
            $documento->setCandidato($folio);
            //if ($candidato_datos->Tipo_Investigacion != 1) {
                $documento->setFolio_Origen(269);
                $credencial_frente = $documento->getDocumento();
                $documento->setFolio_Origen(270);
                $credencial_atras = $documento->getDocumento();
                $documento->setFolio_Origen(271);
                $acta_nacimiento = $documento->getDocumento();
				$documento->setFolio_Origen(275);
            	$rfc = $documento->getDocumento();
                $documento->setFolio_Origen(278);
                $comprobante_domicilio = $documento->getDocumento();
				$documento->setFolio_Origen(279);
            	$comprobante_estudios = $documento->getDocumento();
            //}
            
            
            $documento->setFolio_Origen(280);
            $registro_patronal_1 = $documento->getDocumento();
            $documento->setFolio_Origen(281);
            $registro_patronal_2 = $documento->getDocumento();
            $documento->setFolio_Origen(296);
            $registro_patronal_3 = $documento->getDocumento();
            $documento->setFolio_Origen(301);
            $registro_patronal_4 = $documento->getDocumento();
            $documento->setFolio_Origen(302);
            $registro_patronal_5 = $documento->getDocumento();
			$documento->setFolio_Origen(307);
            $registro_patronal_6 = $documento->getDocumento();
            $documento->setFolio_Origen(308);
            $registro_patronal_7 = $documento->getDocumento();
            $documento->setFolio_Origen(282);
            $redes_sociales = $documento->getDocumento();
            $documento->setFolio_Origen(283);
            $carta_laboral_1 = $documento->getDocumento();
            $documento->setFolio_Origen(284);
            $carta_laboral_2 = $documento->getDocumento();
            $documento->setFolio_Origen(303);
            $carta_laboral_3 = $documento->getDocumento();
            $documento->setFolio_Origen(305);
            $carta_laboral_4 = $documento->getDocumento();
			$documento->setFolio_Origen(306);
            $carta_laboral_5 = $documento->getDocumento();
            $documento->setFolio_Origen(304);
            $buro_credito = $documento->getDocumento();
			
			$documento->setFolio_Origen(329);
            $anexo_1 = $documento->getDocumento();
            $documento->setFolio_Origen(330);
            $anexo_2 = $documento->getDocumento();
            $documento->setFolio_Origen(331);
            $anexo_3 = $documento->getDocumento();
            $documento->setFolio_Origen(332);
            $anexo_4 = $documento->getDocumento();
            $documento->setFolio_Origen(333);
            $anexo_5 = $documento->getDocumento();


            $pdf = new InvestigacionLaboral("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold','B', 'SinkinSans-800Black.php');
			$pdf->SetTitle("Investigación laboral ".utf8_decode($nombre), true);
			$pdf->SetMargins(0, 55, 0, 0);
            $pdf->tieneHeader = false;
            $pdf->AddPage();
            $pdf->nombre = $nombre;
			$pdf->setPortadaInvestigacion($candidato_datos, $observaciones->Viable);
            $pdf->SetMargins(10, 100, 10);
            $pdf->tieneHeader = true;
            $pdf->setDatosGeneralesInvComp($candidato_datos, $perfil);
            if ($candidato_datos->Tipo_Investigacion != 1){
                $pdf->setDatosPersonalesInvComp($candidato_datos);
                $pdf->setDatosContacto($candidato_datos, $domicilio);
            }else{
                $pdf->setDatosPersonalesInvOrd($candidato_datos);
                $pdf->setDatosContactoInv($candidato_datos, $domicilio);
            }
            if ($candidato_datos->ID_Empresa == 137) {
                if ($candidato_datos->Tipo_Investigacion != 1) {
                    $pdf->setEstudios($escolaridad, $candidato_datos->Comentario_Escolaridad);
                    $pdf->setCohabitantes($cohabitantes, $candidato_datos->Comentario_Cohabitan);
                    $pdf->setFotoUbicacionGeografica($ubicacion_geografica);
                    $pdf->setFotoUbicacionCalle($ubicacion_calle);
					//aqui iba referencia
                }
				

            }
				                    $pdf->setReferencias($referencias);

            if ($candidato_datos->ID_Empresa == 35) {
                $pdf->setFotoUbicacionGeografica($ubicacion_geografica);
                $pdf->setFotoUbicacionCalle($ubicacion_calle);
            }
            $pdf->setInvestigacionLaboral($investigacion, $candidato_datos->ID_Empresa);
            $pdf->setReferenciasLaborales($referencias_laborales, $candidato_datos->Cliente, $candidato_datos->ID_Empresa);
            if ($observaciones)
                $pdf->setResultadoInvestigacionLaboral($observaciones, $candidato_datos->ID_Empresa);
			$pdf->setNotasLegales($ral);
            //if ($candidato_datos->Tipo_Investigacion != 1) {
                $pdf->setFotoCredencial($credencial_frente, $credencial_atras);
                $pdf->setFotoActaNacimiento($acta_nacimiento);
				$pdf->setFotoRFC($rfc);
                $pdf->setFotoComprobanteDomicilio($comprobante_domicilio);
				$pdf->setFotoComprobanteEstudios($comprobante_estudios);
            //}
            $pdf->setFotoRegistroPatronal($registro_patronal_1, 1);
            $pdf->setFotoRegistroPatronal($registro_patronal_2, 2);
            $pdf->setFotoRegistroPatronal($registro_patronal_3, 3);
            $pdf->setFotoRegistroPatronal($registro_patronal_4, 4);
            $pdf->setFotoRegistroPatronal($registro_patronal_5, 5);
			$pdf->setFotoRegistroPatronal($registro_patronal_6, 6);
            $pdf->setFotoRegistroPatronal($registro_patronal_7, 7);
            $pdf->setFotoRedesSociales($redes_sociales, $docs->Redes_Sociales);
            $pdf->setFotoCartaLaboral($carta_laboral_1, 1);
            $pdf->setFotoCartaLaboral($carta_laboral_2, 2);
            $pdf->setFotoCartaLaboral($carta_laboral_3, 3);
            $pdf->setFotoCartaLaboral($carta_laboral_4, 4);
			$pdf->setFotoCartaLaboral($carta_laboral_5, 5);
            $pdf->setFotoBuroCredito($buro_credito);
			$pdf->setFotoAnexo($anexo_1, 1);
            $pdf->setFotoAnexo($anexo_2, 2);
			$pdf->setFotoAnexo($anexo_3, 3);
            $pdf->setFotoAnexo($anexo_4, 4);
            $pdf->setFotoAnexo($anexo_5, 5);
            $pdf->Output('I', 'IL '.utf8_decode($nombre).'.pdf', true);
		}else{
			header("location:".base_url);
		}
	}

    public function ral(){
		if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();
			
          if ($candidato_datos->Cliente==139) {//Grupo FH
                $nombre=strtoupper(Utils::eliminarAcentos($candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno.' '.$candidato_datos->Nombres));
            }else{
                $nombre = utf8_encode($candidato_datos->Nombres.' '.$candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno);
            }
            $ral = new CandidatosRAL();
            $ral->setCandidato($folio);
            $ral = $ral->getOne();

            $capturaral = new CfgImagenes();
            $capturaral->setCandidato($folio);
            $capturas_RAL = $capturaral->getCapturasRALObjetoByCandidato();
            
            $pdf = new RAL("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold','B', 'SinkinSans-800Black.php');
			$pdf->SetTitle("Registro de Antecedentes Legales ".utf8_decode($nombre), true);
			$pdf->SetMargins(0, 55, 0, 0);
            $pdf->nombre = $nombre;
            $pdf->SetMargins(10, 100, 10);
            $pdf->tieneHeader = true;
            $pdf->setDatosGenerales($ral, $nombre);
            if ($ral->Demandas == 2) {
                $pdf->setCapturas($capturas_RAL);
            }
            $pdf->setResultados($ral);
            $pdf->setMarcoLegal();
            $pdf->Output('I', 'RAL '.utf8_decode($nombre).'.pdf', true);
		}else{
			header("location:".base_url);
		}
	}

    public function validacion_licencia_federal(){
		if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();
            $nombre = utf8_encode($candidato_datos->Nombres.' '.$candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno);

            $perfil = new CfgImagenes();
            $perfil->setFolio_Origen($folio);
            $perfil->setTabla('Candidatos');
            $perfil = $perfil->getProfile();

            $vlf = new ValidacionLicenciaFederal();
            $vlf->setCandidato($folio);
            $vlf = $vlf->getOne();
            
            $pdf = new ValidacionLicenciaFederalPDF("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold','B', 'SinkinSans-800Black.php');
			$pdf->SetTitle("Validación Licencia Federal ".utf8_decode($nombre), true);
			$pdf->SetMargins(0, 55, 0, 0);
            $pdf->nombre = $nombre;
            $pdf->SetMargins(10, 100, 10);
            $pdf->tieneHeader = true;
            $pdf->setDatosGenerales($vlf, $perfil);
            $pdf->Output('I', 'VLF '.utf8_decode($nombre).'.pdf', true);
		}else{
			header("location:".base_url);
		}
	}
	
	public function resultado_RAL(){
		if (isset($_GET['expediente']) && !empty($_GET['expediente'])) {
            $ID = Encryption::decode($_GET['expediente']);

            $exp_RAL = new Expediente_RAL();
            $exp_RAL->setID($ID);
            $expedientes_RAL = $exp_RAL->getOne();

            $expedientes_RAL->Fecha = Utils::getDate($expedientes_RAL->Fecha);
            
            $acuerdo_RAL = new Acuerdos_RAL();
            $acuerdo_RAL->setID_Expediente_RAL($expedientes_RAL->ID);
            $acuerdos = $acuerdo_RAL->getAcuerdosPorExpediente();
            for ($j=0; $j < count($acuerdos); $j++) 
                $acuerdos[$j]['Fecha'] = $acuerdos[$j]['Fecha'] ? Utils::getDate($acuerdos[$j]['Fecha']) : '';
            //array_push($expediente, array('acuerdos' => $acuerdos));
            $expedientes_RAL->acuerdos = $acuerdos;
               
            $pdf = new ResultadoRAL("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold','B', 'SinkinSans-800Black.php');
			$pdf->SetTitle(utf8_encode(utf8_decode($expedientes_RAL->Actor.' | Exp '.$expedientes_RAL->Toca)), true);
            $pdf->SetMargins(10, 100, 10);

            $pdf->setExpediente($expedientes_RAL);
            $pdf->setAcuerdos($expedientes_RAL);
            $pdf->Output('I', utf8_decode($expedientes_RAL->Actor.' | Exp '.$expedientes_RAL->Toca).'.pdf', true);
		}else{
			header("location:".base_url);
		}
	}
	
	public function resumen_resultado_RAL(){
		if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
            $ID = Encryption::decode($_GET['busqueda']);

            $busq_RAL = new Busqueda_RAL();
            $busq_RAL->setID($ID);
            $busqueda_RAL = $busq_RAL->getOne();

            $exp_RAL = new Expediente_RAL();
            $exp_RAL->setID_Busqueda_RAL($ID);
            $expedientes_RAL = $exp_RAL->getExpedientesPorBusqueda();

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
            
               
            $pdf = new ResumenResultadoRAL("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold','B', 'SinkinSans-800Black.php');
			$pdf->SetTitle(utf8_encode(utf8_decode('Búsqueda de RAL de '.$busqueda_RAL->Nombres.' '.$busqueda_RAL->Apellidos)), true);
            $pdf->SetMargins(10, 100, 10);

            $pdf->setExpedientes($busqueda_RAL, $expedientes_RAL);
            $pdf->Output('I', (utf8_decode('Búsqueda de RAL de ').utf8_decode($busqueda_RAL->Nombres).' '.utf8_decode($busqueda_RAL->Apellidos).'.pdf'), true);
		}else{
			header("location:".base_url);
		}
	}
	
	public function soi(){
        if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);

            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato = $candidato->getOne();

            $vl = new ValidacionLicenciaFederal();
            $vl->setCandidato($folio);
            $vl = $vl->getOne();

            $pdf = new SOI("P", "pt", "A4");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->candidato = $candidato;
            $pdf->vl = $vl;
            $pdf->AliasNbPages();
            $pdf->AddFont('JosefinSans','', 'JosefinSans-Regular.php');
            $pdf->AddFont('JosefinSans','B', 'JosefinSans-Bold.php');
            $pdf->AddFont('AmsterdamOne','', 'AmsterdamOne-eZ12l.php');
            $pdf->AddFont('Antic', '', 'Antic-Regular.php');
            $pdf->AddFont('Sukar', '', 'Sukar Regular.php');
            $pdf->AddFont('Sukar', 'B', 'Sukar Bold.php');
            $pdf->SetTitle("SOI ".utf8_decode($candidato->Nombres.' '.$candidato->Apellido_Paterno.' '.$candidato->Apellido_Materno), true);
            $pdf->Output('I', 'SOI '.utf8_decode($candidato->Nombres.' '.$candidato->Apellido_Paterno.' '.$candidato->Apellido_Materno).'.pdf', true);
        } else
            header("location:".base_url);
            
    }

    public function dc3(){
		if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = Encryption::decode($_GET['id']);
            $employee_training = new Employee_trainings();
            $employee_training->setId($id);
            $data = $employee_training->getOne();
            
            $pdf = new DC3("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('Arial','', 'arial.php');
            $pdf->AddFont('Arial','B', 'arialbd.php');
            $pdf->AddFont('ArialMT','', 'arialmt.php');
            $pdf->AddFont('ArialMT-Light', '', 'arialmtlight.php');
			$pdf->SetTitle("DC3 ".utf8_encode(utf8_decode($data->first_name.' '.$data->surname)), true);
			$pdf->SetMargins(0, 55, 0, 0);
            $pdf->SetMargins(10, 100, 10);
            $pdf->setDatosTrabajador($data);
            $pdf->setDatosEmpresa($data);
            $pdf->setDatosCapacitacion($data);
            $pdf->setDatosFirmas($data);
            $pdf->setInstrucciones();
            $pdf->Output('I', 'DC3.pdf', true);
		}else{
			header("location:".base_url);
		} 
	}
	
	public function soiqr(){
        if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();
            $nombre = ($candidato_datos->Nombres.' '.$candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno);

            $vl = new ValidacionLicenciaFederal();
            $vl->setCandidato($folio);
            $vl = $vl->getOne();

            $perfil = new CfgImagenes();
            $perfil->setFolio_Origen($folio);
            $perfil->setTabla('Candidatos');
            $perfil = $perfil->getProfile();

            if (!$perfil) {
                if ($candidato_datos->Sexo == 99)
                    $perfil = dirname(__FILE__).'\..\dist\img\user-icon-rose.png';
                else
                    $perfil = dirname(__FILE__).'\..\dist\img\user-icon.png';
                
                $foto = imagecreatefrompng($perfil);
            }else{
                $perfil = base64_decode(str_replace('data://text/plain;base64, ', '', $perfil[0]));
                $foto = imagecreatefromstring($perfil);
            }
            
            require_once './libraries/phpqrcode/qrlib.php';

            $dir = './libraries/phpqrcode/tmp/';
            if (!file_exists($dir))
                mkdir($dir);
            $qrFile = 'qr.png';
            $urlSOI = 'https://rrhh-ingenia.com.mx/formato/soi&candidato='.Encryption::encode($folio);

            QRcode::png($urlSOI, $dir.$qrFile, 'M', 8, 2);

            $image = imagecreatetruecolor(1011, 639);

            $black = imagecolorallocate($image, 0, 0, 0);
            $white = imagecolorallocate($image, 255, 255, 255);
            $gray = imagecolorallocate($image, 84, 84, 84);
            $navy = imagecolorallocate($image, 25, 25, 46);
            $orange = imagecolorallocate($image, 221, 136, 46);
            $green = imagecolorallocate($image, 172, 202, 74);
            $pink = imagecolorallocate($image, 190, 71, 149);
            $blue = imagecolorallocate($image, 70, 125, 185);
            
            $dirLogo = dirname(__FILE__).'\..\dist\img\imagotipo-colores-2.png';
            $logo = imagescale(imagecreatefrompng($dirLogo), 400);
            
            $dirBanner = dirname(__FILE__).'\..\dist\img\s.png';
            $banner = imagescale(imagecreatefrompng($dirBanner), 631);

            $fontJosefina = dirname(__FILE__).'\..\dist\fonts\JosefinSans-Regular.TTF';
            $fontJosefinaBold = dirname(__FILE__).'\..\dist\fonts\JosefinSans-Bold.TTF';
            $fontAbhaya = dirname(__FILE__).'\..\dist\fonts\AbhayaLibre-Regular.TTF';
            $fontLeague = dirname(__FILE__).'\..\dist\fonts\LeagueSpartan-Bold.TTF';
            
            $dirQR = dirname(__FILE__).'\..\libraries\phpqrcode\tmp\\'.$qrFile;
            $qr = imagescale(imagecreatefrompng($dirQR), 165);

            $navyPolygon = array(
                0, 0,
                420, 0,
                490, 160,
                0, 160
            );
            $orangePolygon = array(
                0, 575,
                730, 575,
                800, 610,
                0, 610
            );
            $greenPolygon = array(
                760, 575,
                1011, 575,
                1011, 610,
                830, 610
            );
            $blueRectangle = array(
                690, 50,
                940, 50,
                940, 300,
                690, 300
            );

            imagefill($image, 0, 0, $white);
            imagecopy($image, $banner, 400, -125, 0, 0, imagesx($banner), 280);
            imagefilledpolygon($image, $navyPolygon, 4, $navy);
            imagefilledpolygon($image, $orangePolygon, 4, $orange);
            imagefilledpolygon($image, $greenPolygon, 4, $green);
            imagecopy($image, $logo, 20, 30, 0, 0, imagesx($logo), imagesy($logo));

            imagettftext($image, 18.6, 0, 60, 200, $black, $fontJosefinaBold, 'CURP');
            imagettftext($image, 18.6, 0, 60, 240, $black, $fontJosefinaBold, 'NSS ');
            if ($vl) {
                imagettftext($image, 18.6, 0, 60, 280, $black, $fontJosefinaBold, 'Emisión');
                imagettftext($image, 18.6, 0, 60, 320, $black, $fontJosefinaBold, 'Vence');
                imagettftext($image, 18.6, 0, 60, 360, $black, $fontJosefinaBold, 'No. Licencia');
            }

            imagettftext($image, 18.6, 0, 250, 200, $black, $fontJosefina, ': '.$candidato_datos->CURP);
            imagettftext($image, 18.6, 0, 250, 240, $black, $fontJosefina, ': '.$candidato_datos->IMSS);
            if ($vl) {
                imagettftext($image, 18.6, 0, 250, 280, $black, $fontJosefina, ': '.$vl->Licencia_Vigente_Del);
                imagettftext($image, 18.6, 0, 250, 320, $black, $fontJosefina, ': '.$vl->Licencia_Vigente_Hasta);
                imagettftext($image, 18.6, 0, 250, 360, $black, $fontJosefina, ': '.$vl->Numero_Licencia);
            }
                
            if ($vl) {
                imagettftext($image, 18.6, 0, 230, 480, $black, $fontJosefinaBold, 'Tipo:');
                imagettftext($image, 33.36, 0, 330, 485, $pink, $fontLeague, (($vl->CategoriaA == 1 ? 'A ' : '').($vl->CategoriaB == 1 ? 'B ' : '').($vl->CategoriaC == 1 ? 'C ' : '').($vl->CategoriaD == 1 ? 'D ' : '').($vl->CategoriaE == 1 ? 'E ' : '').($vl->CategoriaF == 1 ? 'F ' : '')));
            }
                
            imagecopy($image, $qr, 25, 440, 0, 0, imagesx($qr), imagesy($qr));
            unlink($dir.$qrFile);

            imagettftext($image, 14.7, 0, 780, 565, $black, $fontJosefinaBold, 'FOLIO');

            imagettftext($image, 22.2, 0, 830, 600, $black, $fontJosefinaBold, $folio);

            imagefilledpolygon($image, $blueRectangle, 4, $blue);

            if (imagesx($foto) > imagesy($foto)) {
                $foto = imagescale($foto, imagesx($foto) * 230 / imagesy($foto), 230);
                imagecopy($image, $foto, 700, 60, (imagesx($foto) - 230) / 2, 0, 230, imagesy($foto));
            }else{
                $foto = imagescale($foto, 230);
                imagecopy($image, $foto, 700, 60, 0, 0, imagesx($foto), 230);
            }

            

            $bbox = imageftbbox(26.09, 0, $fontJosefinaBold, $nombre);
            $x = (505 - abs($bbox[2] - $bbox[0])) / 2 + 495;
            $y = 340;
            imagettftext($image, 26.09, 0, $x, $y, $black, $fontJosefinaBold, $nombre);

            imagettftext($image, 18.6, 0, 750, 375, $black, $fontJosefina, 'Operador');

            imagettftext($image, 22.2, 0, 550, 445, $gray, $fontAbhaya, 'SOI (Safe Operator By Ingenia)');

            imagettftext($image, 20, 0, 220, 600, $white, $fontJosefina, 'www.rrhh-ingenia.com.mx');
            
            header('Content-Type: image/png');
            imagepng($image, './uploads/soi/'.$folio.'.png');
            imagepng($image);
            imagedestroy($image);
        } else
            header("location:".base_url);
        
    }
	
	public function ese_ing(){
		if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            //$folio = $_GET['candidato'];
			$folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();
            $nombre = utf8_encode($candidato_datos->Nombres.' '.$candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno);
            $perfil = new CfgImagenes();
            $perfil->setFolio_Origen($folio);
            $perfil->setTabla('Candidatos');
            $perfil = $perfil->getProfile();

            $doc = new CfgImagenes();
            $doc->setCandidato($folio);
            $doc_adjuntos = $doc->getDocumentosAdjuntos();

            $folio_docs = new CandidatosFolioDocumentos();
            $folio_docs->setCandidato($folio);
            $docs = $folio_docs->getOne();

            $conociendo = new ConociendoCandidato();
            $conociendo->setCandidato($folio);
            $conociendo_candidato = $conociendo->getOne();

            $estudios = new CandidatosEscolaridad();
            $estudios->setCandidato($folio);
            $escolaridad = $estudios->getEscolaridadPorCandidato();

            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $salud = new CandidatosSalud();
                $salud->setCandidato($folio);
                $historial_salud = $salud->getOne();

                $s_seguro = new CandidatosSaludSeguros();
                $s_seguro->setCandidato($folio);
                $salud_seguros = $s_seguro->getSaludSegurosPorCandidato();
            //}

            $cohabitan = new CandidatosCohabitan();
            $cohabitan->setCandidato($folio);
            $cohabitantes = $cohabitan->getCohabitantesPorCandidato($folio);

            $circulo = new CirculoFamiliar();
            $circulo->setCandidato($folio);
            $circulo_familiar = $circulo->getFamiliaresPorCandidato();

            $vivienda = new CandidatosVivienda();
            $vivienda->setCandidato($folio);
            $vivienda = $vivienda->getOne();

            $ubicacion = new CandidatosUbicacion();
            $ubicacion->setCandidato($folio);
            $domicilio = $ubicacion->getDomicilioCompleto();
            $ubicacion = $ubicacion->getOne();
            
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $enser = new Enseres();
                $enser->setCandidato($folio);
                $enseres = $enser->getOne();
            //}

            $ubicacion_exterior = new CfgImagenes();
            $ubicacion_exterior->setFolio_Origen($folio);
            $ubicacion_exterior = $ubicacion_exterior->getExteriorDomicilio();

            $ubicacion_no_exterior = new CfgImagenes();
            $ubicacion_no_exterior->setCandidato($folio);
            $ubicacion_no_exterior = $ubicacion_no_exterior->getNumeroExteriorDomicilio();

            $ubicacion_interior = new CfgImagenes();
            $ubicacion_interior->setFolio_Origen($folio);
            $ubicacion_interior = $ubicacion_interior->getInteriorDomicilio();

            $ubicacion_geografica = new CfgImagenes();
            $ubicacion_geografica->setCandidato($folio);
            $ubicacion_geografica->setFolio_Origen(289);
            $ubicacion_geografica = $ubicacion_geografica->getDocumento();

            $ubicacion_calle = new CfgImagenes();
            $ubicacion_calle->setCandidato($folio);
            $ubicacion_calle->setFolio_Origen(321);
            $ubicacion_calle = $ubicacion_calle->getDocumento();

            $referencia = new CandidatosReferencias();
            $referencia->setCandidato($folio);
            $referencias = $referencia->getReferenciasPorCandidato();

            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
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
            //}
            
            //if ($candidato_datos->ID_Empresa == 137){
                $investigacion = new Investigacion_Laboral;
                $investigacion->setCandidato($folio);
                $investigacion = $investigacion->getOne();

                $laboral = new CandidatosLaborales();
                $laboral->setCandidato($folio);
                $referencias_laborales = $laboral->getLaboralesPorCandidato();
            //}
                

            $obs = new CandidatosObsGenerales();
            $obs->setCandidato($folio);
            $observaciones = $obs->getObservacionesPorCandidato();

            $ral = new CandidatosRAL();
            $ral->setCandidato($folio);
            $ral = $ral->getOne();

            $documento = new CfgImagenes();
            $documento->setCandidato($folio);
            $documento->setFolio_Origen(269);
            $credencial_frente = $documento->getDocumento();
            $documento->setFolio_Origen(270);
            $credencial_atras = $documento->getDocumento();
            $documento->setFolio_Origen(271);
            $acta_nacimiento = $documento->getDocumento();
            $documento->setFolio_Origen(272);
            $licencia = $documento->getDocumento();
            $documento->setFolio_Origen(273);
            $cartilla_militar = $documento->getDocumento();
            $documento->setFolio_Origen(274);
            $curp = $documento->getDocumento();
            $documento->setFolio_Origen(275);
            $rfc = $documento->getDocumento();
            $documento->setFolio_Origen(276);
            $nss = $documento->getDocumento();
            $documento->setFolio_Origen(277);
            $afore = $documento->getDocumento();
            $documento->setFolio_Origen(278);
            $comprobante_domicilio = $documento->getDocumento();
            $documento->setFolio_Origen(279);
            $comprobante_estudios = $documento->getDocumento();
            $documento->setFolio_Origen(280);
            $registro_patronal_1 = $documento->getDocumento();
            $documento->setFolio_Origen(281);
            $registro_patronal_2 = $documento->getDocumento();
            $documento->setFolio_Origen(296);
            $registro_patronal_3 = $documento->getDocumento();
            $documento->setFolio_Origen(301);
            $registro_patronal_4 = $documento->getDocumento();
            $documento->setFolio_Origen(302);
            $registro_patronal_5 = $documento->getDocumento();
            $documento->setFolio_Origen(307);
            $registro_patronal_6 = $documento->getDocumento();
            $documento->setFolio_Origen(308);
            $registro_patronal_7 = $documento->getDocumento();
            $documento->setFolio_Origen(282);
            $redes_sociales = $documento->getDocumento();
            $documento->setFolio_Origen(283);
            $carta_laboral_1 = $documento->getDocumento();
            $documento->setFolio_Origen(284);
            $carta_laboral_2 = $documento->getDocumento();
            $documento->setFolio_Origen(303);
            $carta_laboral_3 = $documento->getDocumento();
            $documento->setFolio_Origen(305);
            $carta_laboral_4 = $documento->getDocumento();
            $documento->setFolio_Origen(306);
            $carta_laboral_5 = $documento->getDocumento();
            $documento->setFolio_Origen(285);
            $infonavit = $documento->getDocumento();
            $documento->setFolio_Origen(295);
            $infonavitSI = $documento->getDocumento();
            $documento->setFolio_Origen(294);
            $infonavitNO = $documento->getDocumento();

            $documento->setFolio_Origen(322);
            $contrato_arrendamiento = $documento->getDocumento();

            $documento->setFolio_Origen(286);
            $aviso_privacidad = $documento->getDocumento();
            $documento->setFolio_Origen(287);
            $carta_visita_domiciliaria = $documento->getDocumento();
            $documento->setFolio_Origen(304);
            $buro_credito = $documento->getDocumento();

            $documento->setFolio_Origen(325);
            $foto_exterior_vp = $documento->getDocumento();
            $documento->setFolio_Origen(326);
            $foto_ine_frente_vp = $documento->getDocumento();
            $documento->setFolio_Origen(327);
            $foto_ine_detras_vp = $documento->getDocumento();
            $documento->setFolio_Origen(290);
            $foto_gestor = $documento->getDocumento();

             $pdf = new ESEINGE("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold','B', 'SinkinSans-800Black.php');
			$pdf->SetTitle("Verificación Domiciliaria ".utf8_decode($nombre), true);
			$pdf->SetMargins(0, 55, 0, 0);
            $pdf->tieneHeader = false;
            $pdf->AddPage();
            $pdf->nombre = $nombre;
			$pdf->setPortada($candidato_datos, $observaciones->Viable);
            $pdf->SetMargins(10, 100, 10);
            $pdf->tieneHeader = true;
            $pdf->setDatosGenerales($candidato_datos, $perfil);
            $pdf->setDatosPersonales($candidato_datos, $docs);
            $pdf->setDatosContacto($candidato_datos, $domicilio);
            if (!$conociendo_candidato) {
                $pdf->setDatosAdicionales($candidato_datos);
            }
            $pdf->setConociendoCandidato($conociendo_candidato);
            $pdf->setDocumentacionPresentada($doc_adjuntos, $candidato_datos->Comentario_Documentos);
            $pdf->setEstudios($escolaridad, $candidato_datos->Comentario_Escolaridad);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $pdf->setHistorialSalud($historial_salud, $salud_seguros);
                $pdf->setSalud($historial_salud, $salud_seguros);
            //}   
            $pdf->setSociales($candidato_datos);
            $pdf->setCohabitantes($cohabitantes, $candidato_datos->Comentario_Cohabitan);
            $pdf->setCirculoFamiliar($circulo_familiar);
            $pdf->setVivienda($vivienda, $ubicacion, $candidato_datos->Comentario_Vivienda);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $pdf->setEnseres($enseres);
            //}
			if($ubicacion_exterior)
            $pdf->setFotoExteriorDomicilio($ubicacion_exterior);
	     	if($ubicacion_no_exterior)
            $pdf->setFotoNoExteriorDomicilio($ubicacion_no_exterior);
			if($ubicacion_interior)
            $pdf->setFotoInteriorDomicilio($ubicacion_interior);
			
            $pdf->setFotoUbicacionGeografica($ubicacion_geografica);
            $pdf->setFotoUbicacionCalle($ubicacion_calle);
            $pdf->setReferencias($referencias);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
                $pdf->setEconomiaFamiliar($ingresos, $egresos, $candidato_datos->Comentario_Economia);
                $pdf->setInformacionFinanciera($creditos, $cuentas, $seguros, $candidato_datos->INFONAVIT);
                $pdf->setInformacionPatrimonial($inmuebles, $vehiculos);
            //}
            $pdf->setConclusiones($observaciones);
            //if ($candidato_datos->ID_Empresa == 137) {
            $pdf->setInvestigacionLaboral($investigacion, $candidato_datos->ID_Empresa,$candidato_datos->Sexo);
                $pdf->setReferenciasLaborales($referencias_laborales, $candidato_datos->Cliente, $candidato_datos->ID_Empresa);
                $pdf->setResultadoInvestigacionLaboral($observaciones, $candidato_datos->ID_Empresa); 
                $pdf->setNotasLegales($ral);
            //}
            $pdf->setFotoCredencial($credencial_frente, $credencial_atras);
            $pdf->setFotoActaNacimiento($acta_nacimiento);
            $pdf->setFotoLicenciaConducir($licencia);
            $pdf->setFotoCartillaMilitar($cartilla_militar);
            $pdf->setFotoCURP($curp);
            $pdf->setFotoRFC($rfc);
            $pdf->setFotoNSS($nss);
            $pdf->setFotoAfore($afore);
            $pdf->setFotoComprobanteDomicilio($comprobante_domicilio);
            $pdf->setFotoComprobanteEstudios($comprobante_estudios);
            $pdf->setFotoRegistroPatronal($registro_patronal_1, 1);
            $pdf->setFotoRegistroPatronal($registro_patronal_2, 2);
            $pdf->setFotoRegistroPatronal($registro_patronal_3, 3);
            $pdf->setFotoRegistroPatronal($registro_patronal_4, 4);
            $pdf->setFotoRegistroPatronal($registro_patronal_5, 5);
            $pdf->setFotoRegistroPatronal($registro_patronal_6, 6);
            $pdf->setFotoRegistroPatronal($registro_patronal_7, 7);
            $pdf->setFotoRedesSociales($redes_sociales, $docs->Redes_Sociales);
            $pdf->setFotoCartaLaboral($carta_laboral_1, 1);
            $pdf->setFotoCartaLaboral($carta_laboral_2, 2);
            $pdf->setFotoCartaLaboral($carta_laboral_3, 3);
            $pdf->setFotoCartaLaboral($carta_laboral_4, 4);
            $pdf->setFotoCartaLaboral($carta_laboral_5, 5);
            $pdf->setFotoCartaLiberacionInfonavit($infonavit);
            $pdf->setFotoCartaInfonavitSi($infonavitSI);
            $pdf->setFotoCartaInfonavitNo($infonavitNO);
            $pdf->setFotoContratoArrendamiento($contrato_arrendamiento);
            $pdf->setFotoAvisoPrivacidad($aviso_privacidad);
            $pdf->setFotoCartaVD($carta_visita_domiciliaria);
            $pdf->setFotoBuroCredito($buro_credito);
            $pdf->setFotoExteriorDomicilioGestor($foto_exterior_vp);
            $pdf->setFotoCredencialGestor($foto_ine_frente_vp, $foto_ine_detras_vp);
            $pdf->setFotoCandidatoGestor($foto_gestor);
            $pdf->Output('I', 'VD '.utf8_decode($nombre).'.pdf', true); 
		}else{
			header("location:".base_url);
		}
	}

	
    //===================================[Ulises 28/04/2023]========================
    public function ral_ing()
    {
        if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();

            $nombre = utf8_encode($candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno);
$nombre=strtoupper(Utils::eliminarAcentos($candidato_datos->Apellido_Paterno.' '.$candidato_datos->Apellido_Materno.' '.$candidato_datos->Nombres));
            $ral = new CandidatosRAL();
            $ral->setCandidato($folio);
            $ral = $ral->getOne();

            $capturaral = new CfgImagenes();
            $capturaral->setCandidato($folio);
            $capturas_RAL = $capturaral->getCapturasRALObjetoByCandidato();

            $pdf = new RALING("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight', '', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans', '', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans', 'I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans', 'B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans', 'BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold', 'B', 'SinkinSans-800Black.php');
            $pdf->SetTitle("Registro de Antecedentes Legales " . utf8_decode($nombre), true);
            $pdf->SetMargins(0, 55, 0, 0);
            $pdf->nombre = $nombre;
            $pdf->SetMargins(10, 100, 10);
            //$pdf->tieneHeader = true;
            $pdf->setDatosGenerales($ral, $nombre);
            if ($ral->Demandas == 2) {
                $pdf->setCapturas($capturas_RAL);
            }
            $pdf->setResultados($ral);
            $pdf->setMarcoLegal();
            $pdf->Output('I', 'RAL ' . utf8_decode($nombre) . '.pdf', true);
        } else {
            header("location:" . base_url);
        }
    }
	
	   public function investigacion_laboral_ing()
    {
        if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();

            //Cliente Vetado
            //Utils::isClienteVetado($candidato_datos->Cliente);

            if ($candidato_datos->Cliente == 139) { //Grupo FH
                $nombre = strtoupper(Utils::eliminarAcentos($candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno . ' ' . $candidato_datos->Nombres));
            } else {
                $nombre = utf8_encode($candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno);
            }

            $folio_docs = new CandidatosFolioDocumentos();
            $folio_docs->setCandidato($folio);
            $docs = $folio_docs->getOne();

            $ubicacion_geografica = new CfgImagenes();
            $ubicacion_geografica->setCandidato($folio);
            $ubicacion_geografica->setFolio_Origen(289);
            $ubicacion_geografica = $ubicacion_geografica->getDocumento();

            $ubicacion_calle = new CfgImagenes();
            $ubicacion_calle->setCandidato($folio);
            $ubicacion_calle->setFolio_Origen(321);
            $ubicacion_calle = $ubicacion_calle->getDocumento();

            $perfil = new CfgImagenes();
            $perfil->setFolio_Origen($folio);
            $perfil->setTabla('Candidatos');
            $perfil = $perfil->getProfile();

            if ($candidato_datos->Tipo_Investigacion != 1) {
                $estudios = new CandidatosEscolaridad();
                $estudios->setCandidato($folio);
                $escolaridad = $estudios->getEscolaridadPorCandidato();


                $cohabitan = new CandidatosCohabitan();
                $cohabitan->setCandidato($folio);
                $cohabitantes = $cohabitan->getCohabitantesPorCandidato($folio);

                //aqui iba la referencia 

            }
            $referencia = new CandidatosReferencias();
            $referencia->setCandidato($folio);
            $referencias = $referencia->getReferenciasPorCandidato();

            $domicilio = $candidato_datos->Domicilio;

            $investigacion = new Investigacion_Laboral;
            $investigacion->setCandidato($folio);
            $investigacion = $investigacion->getOne();

            $laboral = new CandidatosLaborales();
            $laboral->setCandidato($folio);
            $referencias_laborales = $laboral->getLaboralesPorCandidato();

            $obs = new CandidatosObsGenerales();
            $obs->setCandidato($folio);
            $observaciones = $obs->getObservacionesPorCandidato();

            $ral = new CandidatosRAL();
            $ral->setCandidato($folio);
            $ral = $ral->getOne();

            $documento = new CfgImagenes();
            $documento->setCandidato($folio);
            //if ($candidato_datos->Tipo_Investigacion != 1) {
            $documento->setFolio_Origen(269);
            $credencial_frente = $documento->getDocumento();
            $documento->setFolio_Origen(270);
            $credencial_atras = $documento->getDocumento();
            $documento->setFolio_Origen(271);
            $acta_nacimiento = $documento->getDocumento();
            $documento->setFolio_Origen(275);
            $rfc = $documento->getDocumento();
            $documento->setFolio_Origen(278);
            $comprobante_domicilio = $documento->getDocumento();
            $documento->setFolio_Origen(279);
            $comprobante_estudios = $documento->getDocumento();
            //}


            $documento->setFolio_Origen(280);
            $registro_patronal_1 = $documento->getDocumento();
            $documento->setFolio_Origen(281);
            $registro_patronal_2 = $documento->getDocumento();
            $documento->setFolio_Origen(296);
            $registro_patronal_3 = $documento->getDocumento();
            $documento->setFolio_Origen(301);
            $registro_patronal_4 = $documento->getDocumento();
            $documento->setFolio_Origen(302);
            $registro_patronal_5 = $documento->getDocumento();
            $documento->setFolio_Origen(307);
            $registro_patronal_6 = $documento->getDocumento();
            $documento->setFolio_Origen(308);
            $registro_patronal_7 = $documento->getDocumento();
            $documento->setFolio_Origen(282);
            $redes_sociales = $documento->getDocumento();
            $documento->setFolio_Origen(283);
            $carta_laboral_1 = $documento->getDocumento();
            $documento->setFolio_Origen(284);
            $carta_laboral_2 = $documento->getDocumento();
            $documento->setFolio_Origen(303);
            $carta_laboral_3 = $documento->getDocumento();
            $documento->setFolio_Origen(305);
            $carta_laboral_4 = $documento->getDocumento();
            $documento->setFolio_Origen(306);
            $carta_laboral_5 = $documento->getDocumento();
            $documento->setFolio_Origen(304);
            $buro_credito = $documento->getDocumento();

            $documento->setFolio_Origen(329);
            $anexo_1 = $documento->getDocumento();
            $documento->setFolio_Origen(330);
            $anexo_2 = $documento->getDocumento();
            $documento->setFolio_Origen(331);
            $anexo_3 = $documento->getDocumento();
            $documento->setFolio_Origen(332);
            $anexo_4 = $documento->getDocumento();
            $documento->setFolio_Origen(333);
            $anexo_5 = $documento->getDocumento();


            $pdf = new InvestigacionLaboraling("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight', '', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans', '', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans', 'I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans', 'B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans', 'BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold', 'B', 'SinkinSans-800Black.php');
            $pdf->SetTitle("Investigación laboral " . utf8_decode($nombre), true);
            $pdf->SetMargins(0, 55, 0, 0);
            $pdf->tieneHeader = false;
            $pdf->AddPage();
            $pdf->nombre = $nombre;
            $pdf->setPortadaInvestigacion($candidato_datos, $observaciones->Viable);
            $pdf->SetMargins(10, 100, 10);
            $pdf->tieneHeader = true;
            $pdf->setDatosGeneralesInvComp($candidato_datos, $perfil);
            if ($candidato_datos->Tipo_Investigacion != 1) {
                $pdf->setDatosPersonalesInvComp($candidato_datos);
                $pdf->setDatosContacto($candidato_datos, $domicilio);
            } else {
                $pdf->setDatosPersonalesInvOrd($candidato_datos);
                $pdf->setDatosContactoInv($candidato_datos, $domicilio);
            }
            if ($candidato_datos->ID_Empresa == 137) {
                if ($candidato_datos->Tipo_Investigacion != 1) {
                    $pdf->setEstudios($escolaridad, $candidato_datos->Comentario_Escolaridad);
                    $pdf->setCohabitantes($cohabitantes, $candidato_datos->Comentario_Cohabitan);
                    $pdf->setFotoUbicacionGeografica($ubicacion_geografica);
                    $pdf->setFotoUbicacionCalle($ubicacion_calle);
                    //aqui iba referencia
                }
            }
            $pdf->setReferencias($referencias);

            if ($candidato_datos->ID_Empresa == 35) {
                $pdf->setFotoUbicacionGeografica($ubicacion_geografica);
                $pdf->setFotoUbicacionCalle($ubicacion_calle);
            }
            $pdf->setInvestigacionLaboral($investigacion, $candidato_datos->ID_Empresa, $candidato_datos->sexo);
            $pdf->setReferenciasLaborales($referencias_laborales, $candidato_datos->Cliente, $candidato_datos->ID_Empresa);
            if ($observaciones)
                $pdf->setResultadoInvestigacionLaboral($observaciones, $candidato_datos->ID_Empresa);
            $pdf->setNotasLegales($ral);
            //if ($candidato_datos->Tipo_Investigacion != 1) {
            $pdf->setFotoCredencial($credencial_frente, $credencial_atras);
            $pdf->setFotoActaNacimiento($acta_nacimiento);
            $pdf->setFotoRFC($rfc);
            $pdf->setFotoComprobanteDomicilio($comprobante_domicilio);
            $pdf->setFotoComprobanteEstudios($comprobante_estudios);
            //}
            $pdf->setFotoRegistroPatronal($registro_patronal_1, 1);
            $pdf->setFotoRegistroPatronal($registro_patronal_2, 2);
            $pdf->setFotoRegistroPatronal($registro_patronal_3, 3);
            $pdf->setFotoRegistroPatronal($registro_patronal_4, 4);
            $pdf->setFotoRegistroPatronal($registro_patronal_5, 5);
            $pdf->setFotoRegistroPatronal($registro_patronal_6, 6);
            $pdf->setFotoRegistroPatronal($registro_patronal_7, 7);
            $pdf->setFotoRedesSociales($redes_sociales, $docs->Redes_Sociales);
            $pdf->setFotoCartaLaboral($carta_laboral_1, 1);
            $pdf->setFotoCartaLaboral($carta_laboral_2, 2);
            $pdf->setFotoCartaLaboral($carta_laboral_3, 3);
            $pdf->setFotoCartaLaboral($carta_laboral_4, 4);
            $pdf->setFotoCartaLaboral($carta_laboral_5, 5);
            $pdf->setFotoBuroCredito($buro_credito);
            $pdf->setFotoAnexo($anexo_1, 1);
            $pdf->setFotoAnexo($anexo_2, 2);
            $pdf->setFotoAnexo($anexo_3, 3);
            $pdf->setFotoAnexo($anexo_4, 4);
            $pdf->setFotoAnexo($anexo_5, 5);
            $pdf->Output('I', 'IL ' . utf8_decode($nombre) . '.pdf', true);
        } else {
            header("location:" . base_url);
        }
    }
	
	 public function ese_p()
    {
        if (isset($_GET['candidato']) && !empty($_GET['candidato'])) {
            $folio = Encryption::decode($_GET['candidato']);
            $candidato = new CandidatosDatos();
            $candidato->setCandidato($folio);
            $candidato_datos = $candidato->getOne();

            //Cliente Vetado
            //Utils::isClienteVetado($candidato_datos->Cliente);
            if ($candidato_datos->Cliente == 139) { //Grupo FH
                $nombre = strtoupper(Utils::eliminarAcentos($candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno . ' ' . $candidato_datos->Nombres));
            } else {
                $nombre = utf8_encode($candidato_datos->Nombres . ' ' . $candidato_datos->Apellido_Paterno . ' ' . $candidato_datos->Apellido_Materno);
            }


            $perfil = new CfgImagenes();
            $perfil->setFolio_Origen($folio);
            $perfil->setTabla('Candidatos');
            $perfil = $perfil->getProfile();

            $doc = new CfgImagenes();
            $doc->setCandidato($folio);
            $doc_adjuntos = $doc->getDocumentosAdjuntos();

            $folio_docs = new CandidatosFolioDocumentos();
            $folio_docs->setCandidato($folio);
            $docs = $folio_docs->getOne();

            $conociendo = new ConociendoCandidato();
            $conociendo->setCandidato($folio);
            $conociendo_candidato = $conociendo->getOne();

            $estudios = new CandidatosEscolaridad();
            $estudios->setCandidato($folio);
            $escolaridad = $estudios->getEscolaridadPorCandidato();

            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
            $salud = new CandidatosSalud();
            $salud->setCandidato($folio);
            $historial_salud = $salud->getOne();

            $s_seguro = new CandidatosSaludSeguros();
            $s_seguro->setCandidato($folio);
            $salud_seguros = $s_seguro->getSaludSegurosPorCandidato();
            //}

            $cohabitan = new CandidatosCohabitan();
            $cohabitan->setCandidato($folio);
            $cohabitantes = $cohabitan->getCohabitantesPorCandidato($folio);

            $circulo = new CirculoFamiliar();
            $circulo->setCandidato($folio);
            $circulo_familiar = $circulo->getFamiliaresPorCandidato();

            $vivienda = new CandidatosVivienda();
            $vivienda->setCandidato($folio);
            $vivienda = $vivienda->getOne();

            $ubicacion = new CandidatosUbicacion();
            $ubicacion->setCandidato($folio);
            $domicilio = $ubicacion->getDomicilioCompleto();
            $ubicacion = $ubicacion->getOne();

            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
            $enser = new Enseres();
            $enser->setCandidato($folio);
            $enseres = $enser->getOne();
            //}

            $ubicacion_exterior = new CfgImagenes();
            $ubicacion_exterior->setFolio_Origen($folio);
            $ubicacion_exterior = $ubicacion_exterior->getExteriorDomicilio();

            $ubicacion_no_exterior = new CfgImagenes();
            $ubicacion_no_exterior->setCandidato($folio);
            $ubicacion_no_exterior = $ubicacion_no_exterior->getNumeroExteriorDomicilio();

            $ubicacion_interior = new CfgImagenes();
            $ubicacion_interior->setFolio_Origen($folio);
            $ubicacion_interior = $ubicacion_interior->getInteriorDomicilio();

            $ubicacion_geografica = new CfgImagenes();
            $ubicacion_geografica->setCandidato($folio);
            $ubicacion_geografica->setFolio_Origen(289);
            $ubicacion_geografica = $ubicacion_geografica->getDocumento();

            $ubicacion_calle = new CfgImagenes();
            $ubicacion_calle->setCandidato($folio);
            $ubicacion_calle->setFolio_Origen(321);
            $ubicacion_calle = $ubicacion_calle->getDocumento();

            $referencia = new CandidatosReferencias();
            $referencia->setCandidato($folio);
            $referencias = $referencia->getReferenciasPorCandidato();

            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
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
            //}

            //if ($candidato_datos->ID_Empresa == 137){
            $investigacion = new Investigacion_Laboral;
            $investigacion->setCandidato($folio);
            $investigacion = $investigacion->getOne();

            $laboral = new CandidatosLaborales();
            $laboral->setCandidato($folio);
            $referencias_laborales = $laboral->getLaboralesPorCandidato();
            //}

            $obs = new CandidatosObsGenerales();
            $obs->setCandidato($folio);
            $observaciones = $obs->getObservacionesPorCandidato();

            $ral = new CandidatosRAL();
            $ral->setCandidato($folio);
            $ral = $ral->getOne();

            $documento = new CfgImagenes();
            $documento->setCandidato($folio);
            $documento->setFolio_Origen(269);
            $credencial_frente = $documento->getDocumento();
            $documento->setFolio_Origen(270);
            $credencial_atras = $documento->getDocumento();
            $documento->setFolio_Origen(271);
            $acta_nacimiento = $documento->getDocumento();
            $documento->setFolio_Origen(272);
            $licencia = $documento->getDocumento();
            $documento->setFolio_Origen(273);
            $cartilla_militar = $documento->getDocumento();
            $documento->setFolio_Origen(274);
            $curp = $documento->getDocumento();
            $documento->setFolio_Origen(275);
            $rfc = $documento->getDocumento();
            $documento->setFolio_Origen(276);
            $nss = $documento->getDocumento();
            $documento->setFolio_Origen(277);
            $afore = $documento->getDocumento();
            $documento->setFolio_Origen(278);
            $comprobante_domicilio = $documento->getDocumento();
            $documento->setFolio_Origen(279);
            $comprobante_estudios = $documento->getDocumento();
            $documento->setFolio_Origen(280);
            $registro_patronal_1 = $documento->getDocumento();
            $documento->setFolio_Origen(281);
            $registro_patronal_2 = $documento->getDocumento();
            $documento->setFolio_Origen(296);
            $registro_patronal_3 = $documento->getDocumento();
            $documento->setFolio_Origen(301);
            $registro_patronal_4 = $documento->getDocumento();
            $documento->setFolio_Origen(302);
            $registro_patronal_5 = $documento->getDocumento();
            $documento->setFolio_Origen(307);
            $registro_patronal_6 = $documento->getDocumento();
            $documento->setFolio_Origen(308);
            $registro_patronal_7 = $documento->getDocumento();
            $documento->setFolio_Origen(282);
            $redes_sociales = $documento->getDocumento();
            $documento->setFolio_Origen(283);
            $carta_laboral_1 = $documento->getDocumento();
            $documento->setFolio_Origen(284);
            $carta_laboral_2 = $documento->getDocumento();
            $documento->setFolio_Origen(303);
            $carta_laboral_3 = $documento->getDocumento();
            $documento->setFolio_Origen(305);
            $carta_laboral_4 = $documento->getDocumento();
            $documento->setFolio_Origen(306);
            $carta_laboral_5 = $documento->getDocumento();
            $documento->setFolio_Origen(285);
            $infonavit = $documento->getDocumento();
            $documento->setFolio_Origen(295);
            $infonavitSI = $documento->getDocumento();
            $documento->setFolio_Origen(294);
            $infonavitNO = $documento->getDocumento();

            $documento->setFolio_Origen(322);
            $contrato_arrendamiento = $documento->getDocumento();

            $documento->setFolio_Origen(286);
            $aviso_privacidad = $documento->getDocumento();
            $documento->setFolio_Origen(287);
            $carta_visita_domiciliaria = $documento->getDocumento();
            $documento->setFolio_Origen(304);
            $buro_credito = $documento->getDocumento();

            $documento->setFolio_Origen(325);
            $foto_exterior_vp = $documento->getDocumento();
            $documento->setFolio_Origen(326);
            $foto_ine_frente_vp = $documento->getDocumento();
            $documento->setFolio_Origen(327);
            $foto_ine_detras_vp = $documento->getDocumento();
            $documento->setFolio_Origen(290);
            $foto_gestor = $documento->getDocumento();

            $documento->setFolio_Origen(329);
            $anexo_1 = $documento->getDocumento();
            $documento->setFolio_Origen(330);
            $anexo_2 = $documento->getDocumento();
            $documento->setFolio_Origen(331);
            $anexo_3 = $documento->getDocumento();
            $documento->setFolio_Origen(332);
            $anexo_4 = $documento->getDocumento();
            $documento->setFolio_Origen(333);
            $anexo_5 = $documento->getDocumento();


            $pdf = new ESEP("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AliasNbPages();
            $pdf->AddFont('SinkinSansLight', '', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans', '', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans', 'I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans', 'B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans', 'BI', 'SinkinSans-700BoldItalic.php');
            $pdf->AddFont('SinkinSansBold', 'B', 'SinkinSans-800Black.php');
            $pdf->SetTitle("Verificación Domiciliaria " . utf8_decode($nombre), true);
            $pdf->SetMargins(0, 55, 0, 0);
            $pdf->tieneHeader = false;
            $pdf->AddPage();
            $pdf->nombre = $nombre;
            $pdf->setPortada($candidato_datos, $observaciones->Viable);
            $pdf->SetMargins(10, 100, 10);
            $pdf->tieneHeader = true;
            $pdf->setDatosGenerales($candidato_datos, $perfil);
            $pdf->setDatosPersonales($candidato_datos, $docs);
            $pdf->setDatosContacto($candidato_datos, $domicilio);
            if (!$conociendo_candidato) {
                $pdf->setDatosAdicionales($candidato_datos);
            }
            $pdf->setConociendoCandidato($conociendo_candidato);
            $pdf->setDocumentacionPresentada($doc_adjuntos, $candidato_datos->Comentario_Documentos);
            $pdf->setEstudios($escolaridad, $candidato_datos->Comentario_Escolaridad);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
            $pdf->setHistorialSalud($historial_salud, $salud_seguros);
            $pdf->setSalud($historial_salud, $salud_seguros);
            //}   
            $pdf->setSociales($candidato_datos);
            $pdf->setCohabitantes($cohabitantes, $candidato_datos->Comentario_Cohabitan);
            $pdf->setCirculoFamiliar($circulo_familiar);
            $pdf->setVivienda($vivienda, $ubicacion, $candidato_datos->Comentario_Vivienda);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
            $pdf->setEnseres($enseres);
            //}
            if ($ubicacion_exterior) {
                $pdf->setFotoExteriorDomicilio($ubicacion_exterior);
            }
            if ($ubicacion_no_exterior) {
                $pdf->setFotoNoExteriorDomicilio($ubicacion_no_exterior);
            }
            if ($ubicacion_interior) {
                $pdf->setFotoInteriorDomicilio($ubicacion_interior);
            }


            $pdf->setFotoUbicacionGeografica($ubicacion_geografica);
            $pdf->setFotoUbicacionCalle($ubicacion_calle);
            $pdf->setReferencias($referencias);
            //if ($candidato_datos->Empresa != 'QUÁLITAS') {
            $pdf->setEconomiaFamiliar($ingresos, $egresos, $candidato_datos->Comentario_Economia);
            $pdf->setInformacionFinanciera($creditos, $cuentas, $seguros, $candidato_datos->INFONAVIT);
            $pdf->setInformacionPatrimonial($inmuebles, $vehiculos);
            //}
            $pdf->setConclusiones($observaciones);
            //if ($candidato_datos->ID_Empresa == 137) {
            $pdf->setInvestigacionLaboral($investigacion, $candidato_datos->ID_Empresa);
            $pdf->setReferenciasLaborales($referencias_laborales, $candidato_datos->Cliente, $candidato_datos->ID_Empresa);
            $pdf->setResultadoInvestigacionLaboral($observaciones, $candidato_datos->ID_Empresa);
            $pdf->setNotasLegales($ral);
            //}
            $pdf->setFotoCredencial($credencial_frente, $credencial_atras);
            $pdf->setFotoActaNacimiento($acta_nacimiento);
            $pdf->setFotoLicenciaConducir($licencia);
            $pdf->setFotoCartillaMilitar($cartilla_militar);
            $pdf->setFotoCURP($curp);
            $pdf->setFotoRFC($rfc);
            $pdf->setFotoNSS($nss);
            $pdf->setFotoAfore($afore);
            $pdf->setFotoComprobanteDomicilio($comprobante_domicilio);
            $pdf->setFotoComprobanteEstudios($comprobante_estudios);
            $pdf->setFotoRegistroPatronal($registro_patronal_1, 1);
            $pdf->setFotoRegistroPatronal($registro_patronal_2, 2);
            $pdf->setFotoRegistroPatronal($registro_patronal_3, 3);
            $pdf->setFotoRegistroPatronal($registro_patronal_4, 4);
            $pdf->setFotoRegistroPatronal($registro_patronal_5, 5);
            $pdf->setFotoRegistroPatronal($registro_patronal_6, 6);
            $pdf->setFotoRegistroPatronal($registro_patronal_7, 7);
            $pdf->setFotoRedesSociales($redes_sociales, $docs->Redes_Sociales);
            $pdf->setFotoCartaLaboral($carta_laboral_1, 1);
            $pdf->setFotoCartaLaboral($carta_laboral_2, 2);
            $pdf->setFotoCartaLaboral($carta_laboral_3, 3);
            $pdf->setFotoCartaLaboral($carta_laboral_4, 4);
            $pdf->setFotoCartaLaboral($carta_laboral_5, 5);
            $pdf->setFotoCartaLiberacionInfonavit($infonavit);
            $pdf->setFotoCartaInfonavitSi($infonavitSI);
            $pdf->setFotoCartaInfonavitNo($infonavitNO);
            $pdf->setFotoContratoArrendamiento($contrato_arrendamiento);
            $pdf->setFotoAvisoPrivacidad($aviso_privacidad);
            $pdf->setFotoCartaVD($carta_visita_domiciliaria);
            $pdf->setFotoBuroCredito($buro_credito);
            $pdf->setFotoExteriorDomicilioGestor($foto_exterior_vp);
            $pdf->setFotoCredencialGestor($foto_ine_frente_vp, $foto_ine_detras_vp);
            $pdf->setFotoCandidatoGestor($foto_gestor);
            $pdf->setFotoAnexo($anexo_1, 1);

            if ($candidato_datos->ID_Empresa == '167') {
                $pdf->setFotoAnexo($anexo_2, 2, 'FOTO EXTERIOR DE LA CASA');
                $pdf->setFotoAnexo($anexo_3, 3, 'FOTO DEL NÚMERO DEL DOMICILIO');
                $pdf->setFotoAnexo($anexo_4, 4, 'FOTO INTERIOR DE LA CASA 1');
                $pdf->setFotoAnexo($anexo_5, 5, 'FOTO INTERIOR DE LA CASA 2');
            } else {
                $pdf->setFotoAnexo($anexo_2, 2);
                $pdf->setFotoAnexo($anexo_3, 3);
                $pdf->setFotoAnexo($anexo_4, 4);
                $pdf->setFotoAnexo($anexo_5, 5);
            }
            $pdf->Output('I', 'VD ' . utf8_decode($nombre) . '.pdf', true);
        } else {
            header("location:" . base_url);
        }
    }
}