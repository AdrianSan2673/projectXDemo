<?php

class ESE extends FPDF
{

	public $tieneHeader;
	public $seccionHeader;
	public $headerDocumento = true;
	public $nombre;

	public function setPortada($candidato, $viabilidad){
		$this->Image('dist/img/isotipo-colores.png', 395, -130, 350, 0);
		$this->Image('dist/img/imagotipo-colores-3.png', 28, 203, 235, 0);

		$this->setTextColor(51, 54, 79);

		$x = 32;
		$y = 308;

		$this->setFont('SinkinSansBold', 'B', 45);
		$this->setXY($x, $y);

		//$this->MultiCell(370, 44, 'REPORTE DE ESTUDIO', 0,'L');
		$this->Write(48, 'REPORTE DE');
		
		$y = $this->GetY() + 53;
		$this->SetXY($x, $y);
		$this->Write(48, 'ESTUDIO');

		$this->setTextColor(158, 198, 58);
		$y = $this->GetY() + 53;
		$this->SetXY($x, $y);
		$this->Write(48, 'SOCIO LABORAL');

		$this->setFont('SinkinSans', 'B', 12);
		$this->setTextColor(51, 54, 79);
		$y = $this->GetY() + 70;
		$this->SetXY($x, $y);
		$this->Write(15, 'PARA:');
		
		$x1 = $this->GetX() + 20;
		$this->SetX($x1);
		$this->MultiCell(200, 20, utf8_encode($candidato->Empresa), 1,'L');

		$x1 = 306;
		$this->SetXY($x1, $y);
		$this->Write(15, 'DE:');

		$x1 = $this->GetX() + 20;
		$this->SetX($x1);
		$this->MultiCell(200, 20, $this->nombre, 1,'L');

		$this->setFont('SinkinSans', 'B', 11);
		$y = $this->GetY() + 50;
		$x1 = $x + 25;
		$this->SetXY($x1, $y);
		$this->Circle($x1 - 15, $y + 4, 8, 'D');
		if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
			$this->Write(15, 'Cubre perfil');
		}else{
			$this->Write(15, 'Viable');
		}

		if ($viabilidad == 0) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle($x1 - 15, $y + 4, 6, 'F');
		}

		$x1 = $this->GetX() + 100;
		$this->SetXY($x1, $y);
		$this->Circle($x1 - 15, $y + 4, 8, 'D');
		if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
			$this->Write(15, 'No cubre perfil');
		}else{
			$this->Write(15, 'No viable');
		}

		if($viabilidad == 1){
			$this->SetFillColor(255, 16, 16);
			$this->Circle($x1 - 15, $y + 4, 6, 'F');
		}

		$x1 = $this->GetX() + 100;
		$this->SetXY($x1, $y);
		$this->Circle($x1 - 15, $y + 4, 8, 'D');
		if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
			$this->Write(15, 'A reserva del perfil');
		}else{
			$this->Write(15, 'Viable con reservas');
		}
		

		if($viabilidad == 2){
			$this->SetFillColor(243, 238, 82);
			$this->Circle($x1 - 15, $y + 4, 6, 'F');
		}
	}

	public function setDatosGenerales($candidato, $foto){
		$this->seccionHeader = 1;
		$this->AddPage();
		$this->seccionHeader = false;
		$y = 72;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'DATOS GENERALES');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(160, 160, 160);
		$x = 25;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(46, 15, 'Nombre', 0, 'L', false);

		$this->setXY(75, $y);
		$this->MultiCell(410, 18, utf8_encode($candidato->Nombres.' '.$candidato->Apellido_Paterno.' '.$candidato->Apellido_Materno), 0, 'C', true);

		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(46, 15, 'Empresa', 0, 'L', false);

		$this->setXY(75, $y);
		$this->MultiCell(410, 18, utf8_encode($candidato->Empresa), 0, 'C', true);

		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(52, 8, utf8_encode('Fecha de aplicación'), 0, 'L', false);

		$this->setXY(75, $y);
		$this->MultiCell(410, 18, Utils::getShortDate($candidato->Fecha_Aplicacion), 0, 'C', true);

		$this->ClippingCircle(537, 147, 45);
		if (!$foto) {
			if ($candidato->Sexo == 99) {
				$foto = array('dist/img/user-icon-rose.png', 'png');
			}else{
				$foto = array('dist/img/user-icon.png', 'png');
			}
			
		}
		$this->Image($foto[0], 492, 102, 90, 0, $foto[1]);
		$this->UnsetClipping();
	}

	public function setDatosPersonales($candidato){
		$y = $this->GetY() + 25;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'DATOS PERSONALES');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$x1 = 315;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Fecha de nacimiento'), 0, 'L', false);

		$this->setXY(123, $y);
		$this->MultiCell(182, 18, Utils::getShortDate($candidato->Nacimiento), 0, 'C', true);

		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('Edad'), 0, 'L', false);

		$this->setXY($x1 + 60, $y);
		$this->MultiCell(55, 18, $candidato->Edad, 0, 'C', true);

		$this->SetXY($x1 + 126, $y);
		$this->MultiCell(50, 18, utf8_encode('Sexo'), 0, 'L', false);

		$this->setXY($x1 + 165, $y);
		$this->MultiCell(115, 18, Utils::getSexo($candidato->Sexo), 0, 'C', true);

		$y = $this->GetY() + 5;

		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Lugar de nacimiento'), 0, 'L', false);

		$this->setXY(123, $y);
		$this->MultiCell(182, 18, utf8_encode($candidato->Lugar_Nacimiento), 0, 'C', true);

		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('Estado civil'), 0, 'L', false);

		$this->setXY($x1 + 60, $y);
		$this->MultiCell(220, 18, Utils::getEstadoCivil($candidato->Estado_Civil), 0, 'C', true);

		$y = $this->GetY() + 5;

		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Fecha de matrimonio'), 0, 'L', false);

		$this->setXY(123, $y);

		$resultadoMatrimonio = empty($candidato->Fecha_Matrimonio)|| $candidato->Fecha_Matrimonio==NULL ? 'No Aplica' : $candidato->Fecha_Matrimonio;
		$this->MultiCell(182, 18, utf8_encode($resultadoMatrimonio), 0, 'C', true);
		
		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('No. de hijos'), 0, 'L', false);

		$this->setXY($x1 + 60, $y);
		$this->MultiCell(220, 18, $candidato->Hijos, 0, 'C', true);

		$y = $this->GetY() + 5;

		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Nacionalidad'), 0, 'L', false);

		$this->setXY(123, $y);
		$this->MultiCell(182, 18, utf8_encode($candidato->Nacionalidad), 0, 'C', true);

		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('Vive con'), 0, 'L', false);

		$this->setXY($x1 + 60, $y);
		$this->MultiCell(220, 18, utf8_encode($candidato->Vive_con), 0, 'C', true);

		
	}

	public function setDatosContacto($candidato, $domicilio){
		$y = $this->GetY() + 18;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'DATOS DE CONTACTO');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$x1 = 290;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(50, 15, 'Domicilio', 0, 'L', false);

		$this->setXY(75, $y);
		
		if (strlen($domicilio) <= 45) {
			$this->MultiCell(205, 18, utf8_encode($domicilio), 0, 'L', true);
		} else {
			$this->MultiCell(205, 9, utf8_encode($domicilio), 0, 'L', true);
		}
		
		$this->SetXY($x1, $y);
		$this->MultiCell(60, 18, utf8_encode('Celular'), 0, 'L', false);

		$this->setXY($x1 + 45, $y);
		$this->MultiCell(90, 18, utf8_encode($candidato->Celular), 0, 'C', true);

		$this->SetXY($x1 + 150, $y);
		$this->MultiCell(50, 18, utf8_encode('Tel fijo'), 0, 'L', false);

		$this->setXY($x1 + 190, $y);
		$this->MultiCell(110, 18, utf8_encode($candidato->Telefono_fijo), 0, 'C', true);

		$y = $this->GetY() + 5;

		$this->SetXY($x, $y);
		$this->MultiCell(50, 15, 'Correo', 0, 'C', false);

		$this->setXY(75, $y);
		$this->MultiCell(515, 18, utf8_encode($candidato->Correos), 0, 'L', true);

		$y = $this->GetY() + 5;

		$this->SetXY($x, $y);
		$this->MultiCell(50, 15, 'Linkedin', 0, 'L', false);

		$this->setXY(75, $y);
		$this->MultiCell(515, 18, utf8_encode($candidato->Linkedin), 0, 'L', true);

		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(50, 15, 'Facebook', 0, 'L', false);

		$this->setXY(75, $y);
		$this->MultiCell(515, 18, utf8_encode($candidato->Facebook), 0, 'L', true);
	}

	public function setConociendoCandidato($conociendo){
		if ($conociendo) {
			$y = $this->GetY() + 25;

			$this->SetFillColor(78, 82, 105);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, 'CONOCIENDO AL CANDIDATO');

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 35;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 10, utf8_encode('¿Por qué te interesó el puesto para el que estás postulándote?'), 0, 'L', false);

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Interes_Puesto), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->SetXY($x, $y);

			$this->MultiCell(275, 15, utf8_encode('¿Qué esperas lograr en caso de ingresar a este empleo?'), 0, 'L', false);

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Que_Esperas_Lograr), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Cuáles son para ti las características más importantes que debe tener un empleo?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Caracteristicas_Empleo), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 17;
			}
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Cuál es tu objetivo laboral / profesional?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Objetivo_Laboral), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Qué esperas de una empresa que te contrate?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Que_Esperas_Empresa), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Describe tus principales cualidades'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Cualidades), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué piensas del trabajo en equipo?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Trabajo_Equipo), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué nos dirías de tus últimos 2 jefes?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Ultimos_Jefes), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué vas a aportar a esta empresa en caso de ser contratado?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Que_Esperas_Aportar), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué tan importante es para ti apegarse a la jornada laboral?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Jornada_Laboral), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Cuál es tu principal motivación para trabajar?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Motivacion), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Si platicamos con tus jefes anteriores ¿Qué crees que nos dirían?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Que_Dirian_Jefes_Anteriores), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('De toda tu trayectoria laboral / profesional ¿De qué te sientes más orgulloso?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Orgullo_Trayectoria_Laboral), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 16;
			}
			
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué es lo que no te llegó a gustar de tu empleos anteriores?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->No_Te_Gusto_Empleos_Anteriores), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Actualmentes estás en otros procesos?'), 0, 'L');

			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Estas_Otros_Procesos), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
		}	
	}

	public function setDocumentacionPresentada($doc_adjuntos, $Comentario){
		$y = $this->GetY() + 30;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('DOCUMENTACIÓN PRESENTADA'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;

		$y = $this->GetY() + 20;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY(455, $y);
		$this->MultiCell(150, 15, utf8_encode('Presentó documento original'), 0, 'C', false);

		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->Write(15, utf8_encode('Documento'));

		$y = $this->GetY() + 5;
		$this->SetXY(455, $y);
		$this->MultiCell(70, 15, utf8_encode('Sí'), 0, 'C', false);

		$this->SetXY(528, $y);
		$this->MultiCell(70, 15, 'No', 0, 'C', false);

		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('INE por ambos lados'), 0, 'L');

		if (in_array(269, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}
		
		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Comprobante de Domicilio'), 0, 'L');

		if (in_array(278, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Acta de Nacimiento'), 0, 'L');

		if (in_array(271, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Cartas Laborales'), 0, 'L');

		if (in_array(283, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Aviso de Retención o Liberación INFONAVIT'), 0, 'L');

		if (in_array(285, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Captura de pantalla redes sociales'), 0, 'L');

		if (in_array(282, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}
		$this->SetXY($x, $y);
		$this->MultiCell(65, 10, utf8_encode('Comentarios'), 0, 'L');

		$this->SetXY(97, $y);
		$this->MultiCell(500, 10,  utf8_encode($Comentario), 0, 'L', true);

	}

	public function setEstudios($escolaridad, $comentarios){
		if ($this->GetY() >= 630) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 20;
		}

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('ÚLTIMOS ESTUDIOS'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 30;
		$this->SetFillColor(255, 255, 255);
		$this->setXY($x, $y);
		$this->MultiCell(97, 15, utf8_encode('Grado'), 0, 'L', false);
		$this->setXY($x + 99, $y);
		$this->MultiCell(136, 15, utf8_encode('Nombre de la Institución'), 0, 'C', false);
		$this->setXY($x + 238, $y);
		$this->MultiCell(70, 15, utf8_encode('Lugar'), 0, 'C', false);
		$this->setXY($x + 310, $y);
		$this->MultiCell(80, 15, utf8_encode('Periodo'), 0, 'C', false);
		$this->setXY($x + 392, $y);
		$this->MultiCell(80, 15, utf8_encode('Documento'), 0, 'C', false);
		$this->setXY($x + 475, $y);
		$this->MultiCell(98, 15, utf8_encode('Folio'), 0, 'C', false);

		$y = $this->GetY() + 5;
		foreach($escolaridad as $estudio){
			$this->setXY(12, $y);
			$this->MultiCell(110, 28, '', 0, 'C', true);
			$this->setXY($x + 99, $y);
			$this->MultiCell(136, 28, '', 0, 'C', true);
			$this->setXY($x + 238, $y);
			$this->MultiCell(70, 28, '', 0, 'C', true);
			$this->setXY($x + 310, $y);
			$this->MultiCell(80, 28, '', 0, 'C', true);
			$this->setXY($x + 392, $y);
			$this->MultiCell(80, 28, '', 0, 'C', true);
			$this->setXY($x + 475, $y);
			$this->MultiCell(98, 28, '', 0, 'C', true);

			$y += 4;

			$this->setXY(12, $y);
			$this->MultiCell(110, 8, utf8_encode(Utils::getGradoEstudio($estudio['Grado'])), 0, 'C', true);
			$this->setXY($x + 99, $y);
			$this->MultiCell(136, 8, utf8_encode($estudio['Institucion']), 0, 'C', true);
			$this->setXY($x + 238, $y);
			$this->MultiCell(70, 8, utf8_encode($estudio['Localidad']), 0, 'C', true);
			$this->setXY($x + 310, $y);
			$this->MultiCell(80, 8, utf8_encode($estudio['Periodo']), 0, 'C', true);
			$this->setXY($x + 392, $y);
			$this->MultiCell(80, 8, utf8_encode(Utils::getDocumentoEscolar($estudio['Documento'])), 0, 'C', true);
			$this->setXY($x + 475, $y);
			$this->MultiCell(98, 8, utf8_encode($estudio['Folio']), 0, 'C', true);

			if ($y >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 18;
			}
		}
		$this->SetXY($x, $y);
		$this->MultiCell(97, 10, utf8_encode('Comentarios'), 0, 'L');

		$this->SetXY($x + 99, $y);
		$this->MultiCell(474, 15, utf8_encode($comentarios), 0, 'L', true);
	}

	public function setHistorialSalud($historial_salud){
		if ($this->GetY() > 580) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 20;
		}
		
		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('HISTORIAL DE SALUD'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 30;
		$this->setXY($x, $y);
		$this->MultiCell(592, 15, utf8_encode('¿Padece usted o un familiar directo alguna de las siguientes enfermedades?'), 0, 'C', false);
		$y = $this->GetY() + 5;

		/* $this->setXY(158, $y);
		$this->MultiCell(147, 15, utf8_encode('Usted'), 0, 'C', false);
		$this->setXY(308, $y);
		$this->MultiCell(147, 15, utf8_encode('Padre'), 0, 'C', false);
		$this->setXY(458, $y);
		$this->MultiCell(140, 15, utf8_encode('Madre'), 0, 'C', false);

		$y = $this->GetY() + 2; */

		$this->SetFillColor(255, 255, 255);

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Diabetes'), 0, 'L', false);
		$this->setXY(158, $y);
		/* $this->MultiCell(147, 22, utf8_encode(''), 0, 'C', true);
		$this->setXY(308, $y);
		$this->MultiCell(147, 22, utf8_encode(''), 0, 'C', true);
		$this->setXY(458, $y);
		$this->MultiCell(140, 22, utf8_encode(''), 0, 'C', true); */
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Diabetes), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Diabetes_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Cáncer'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Cancer), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Cancer_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Hipertensión'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Hipertension), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Hipertension_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Insuficiencia renal'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Disfuncion_Renal), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Disfuncion_Renal_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Fibrosis quística'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Fibrosis_Quistica), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Fibrosis_Quistica_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Miopía'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Miopia), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Miopia_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Asma'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Asma), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Asma_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Migrañas'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Migranas), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Migranas_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(130, 22, utf8_encode('Esclerosis múltiple'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Esclerosis_Multiple), 0, 'C', true);
		$this->setXY(379, $y);
		$this->MultiCell(219, 22, utf8_encode($historial_salud->Esclerosis_Multiple_Familiar), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(288, 22, utf8_encode('¿Fuma?'), 0, 'L', false);
		if ($historial_salud->Fuma == 1) {
			$this->setXY(308, $y);
			$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
			$this->setXY(347, $y);
			$this->MultiCell(37, 22, '', 0, 'C', true);
		}elseif ($historial_salud->Fuma == 0){
			$this->setXY(308, $y);
			$this->MultiCell(37, 22, '', 0, 'C', true);
			$this->setXY(347, $y);
			$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
		}
		
		$this->setXY(385, $y);
		$this->MultiCell(144, 22, utf8_encode('¿Cuántos cigarros al día?'), 0, 'L', false);
		$this->setXY(532, $y);
		$this->MultiCell(67, 22, utf8_encode($historial_salud->Fuma_Cuanto), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(288, 22, utf8_encode('¿Bebe?'), 0, 'L', false);
		
		if ($historial_salud->Bebe == 1) {
			$this->setXY(308, $y);
			$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
			$this->setXY(347, $y);
			$this->MultiCell(37, 22, '', 0, 'C', true);
		}elseif ($historial_salud->Bebe == 0){
			$this->setXY(308, $y);
			$this->MultiCell(37, 22, '', 0, 'C', true);
			$this->setXY(347, $y);
			$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
		}
		
		$this->setXY(385, $y);
		$this->MultiCell(144, 22, utf8_encode('¿Con qué frecuencia?'), 0, 'L', false);
		$this->setXY(532, $y);
		$this->MultiCell(67, 22, utf8_encode($historial_salud->Bebe_Frecuencia), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(288, 22, utf8_encode('¿Cousume alguna droga?'), 0, 'L', false);
		
		if ($historial_salud->Consume_Droga == 'Si') {
			$this->setXY(308, $y);
			$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
			$this->setXY(347, $y);
			$this->MultiCell(37, 22, '', 0, 'C', true);
		} elseif ($historial_salud->Consume_Droga == 'No') {
			$this->setXY(308, $y);
			$this->MultiCell(37, 22, '', 0, 'C', true);
			$this->setXY(347, $y);
			$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
		}
		
		
		$this->setXY(385, $y);
		$this->MultiCell(144, 22, utf8_encode('¿Cuál?'), 0, 'L', false);
		$this->setXY(532, $y);
		$this->MultiCell(67, 22, utf8_encode($historial_salud->Cual_Droga), 0, 'C', true);

		if ($this->GetY() >= 712){
			$this->AddPage();
			$y = 100;
		}else {
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(288, 22, utf8_encode('¿Cuenta con servicio médico?'), 0, 'L', false);
		
		$this->setXY(308, $y);
		$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
		$this->setXY(347, $y);
		$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
		$this->setXY(385, $y);
		$this->MultiCell(144, 22, utf8_encode('¿Cuál?'), 0, 'L', false);
		$this->setXY(532, $y);
		$this->MultiCell(67, 22, utf8_encode(''), 0, 'C', true);

		$y = $this->GetY() + 6;

		$this->setXY($x, $y);
		$this->MultiCell(288, 22, utf8_encode('¿Practica algún deporte?'), 0, 'L', false);
		
		$this->setXY(308, $y);
		$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
		$this->setXY(347, $y);
		$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
		$this->setXY(385, $y);
		$this->MultiCell(144, 10, utf8_encode('¿Cuál?                                       ¿Con qué frecuencia?'), 0, 'L', false);
		$this->setXY(532, $y);
		$this->MultiCell(67, 22, utf8_encode(''), 0, 'C', true);
	}

	public function setCohabitantes($cohabitantes, $comentarios){
		$y = $this->GetY() + 25;

		$this->SetFillColor(157, 199, 58);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(150, $y);
		$this->Write(10, utf8_encode('INFORMACIÓN ACERCA DEL ENTORNO Y FAMILIA'));

		$y = $this->GetY() + 40;

		$this->SetFillColor(177, 194, 126);
		$this->Rect(10, $y, 592, 20, 'F');
		$y += 6;
		$this->setXY(150, $y);
		$this->Write(10, utf8_encode('PERSONAS QUE COHABITAN CON EL CANDIDATO'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 18;
		$y = $this->GetY() + 30;
		$this->SetFillColor(255, 255, 255);

		$this->setXY($x, $y);
		$this->MultiCell(57, 20, utf8_encode('Parentesco'), 0, 'L', false);
		$this->setXY(77, $y);
		$this->MultiCell(120, 20, utf8_encode('Nombre'), 0, 'C', false);
		$this->setXY(199, $y);
		$this->MultiCell(40, 20, utf8_encode('Edad'), 0, 'C', false);
		$this->setXY(241, $y);
		$this->MultiCell(50, 20, utf8_encode('Edo Civil'), 0, 'C', false);
		$this->setXY(293, $y);
		$this->MultiCell(70, 20, utf8_encode('Ocupación'), 0, 'C', false);
		$this->setXY(365, $y);
		$this->MultiCell(70, 10, utf8_encode('Empresa / Escuela'), 0, 'C', false);
		$this->setXY(437, $y);
		$this->MultiCell(83, 10, utf8_encode('¿Es dependiente económico'), 0, 'C', false);
		$this->setXY(522, $y);
		$this->MultiCell(78, 20, utf8_encode('Teléfono'), 0, 'C', false);

		
		$y = $this->GetY() + 4;
		foreach ($cohabitantes as $cohabitante) { 
			

			$this->setXY($x, $y);
			$this->MultiCell(57, 28, '', 0, 'C', true);
			$this->setXY(77, $y);
			$this->MultiCell(120, 28, '', 0, 'C', true);
			$this->setXY(199, $y);
			$this->MultiCell(40, 28, '', 0, 'C', true);
			$this->setXY(241, $y);
			$this->MultiCell(50, 28, '', 0, 'C', true);
			$this->setXY(293, $y);
			$this->MultiCell(70, 28, '', 0, 'C', true);
			$this->setXY(365, $y);
			$this->MultiCell(70, 28, '', 0, 'C', true);
			$this->setXY(437, $y);
			$this->MultiCell(83, 28, '', 0, 'C', true);
			$this->setXY(522, $y);
			$this->MultiCell(78, 28, '', 0, 'C', true);

			$y += 4;
			$this->setXY($x, $y);
			$id_parentesco = $cohabitante['Parentesco'];
			$Parentesco = Utils::getParentesco($id_parentesco);
			$this->MultiCell(57, 8, utf8_encode($Parentesco), 0, 'L', false);
			$this->setXY(77, $y);
			$this->MultiCell(120, 8, utf8_encode($cohabitante['Nombre']), 0, 'C', false);
			$this->setXY(199, $y);
			$this->MultiCell(40, 8, $cohabitante['Edad'], 0, 'C', false);
			$this->setXY(241, $y);
			$id_estado_civil = $cohabitante['Estado_Civil'];
			$Estado_Civil = Utils::getEstadoCivil($id_estado_civil);
			$this->MultiCell(50, 8, utf8_encode($Estado_Civil), 0, 'C', false);
			$this->setXY(293, $y);
			$this->MultiCell(70, 8, utf8_encode($cohabitante['Ocupacion']), 0, 'C', false);
			$this->setXY(365, $y);
			$this->MultiCell(70, 8, utf8_encode($cohabitante['Empresa']), 0, 'C', false);
			$this->setXY(437, $y);
			$dependiente_economico = $cohabitante['Dependiente'] == 1 ? 'Sí' : 'No';
			$this->MultiCell(83, 8, utf8_encode($dependiente_economico), 0, 'C', false);
			$this->setXY(522, $y);
			$this->MultiCell(78, 8, utf8_encode($cohabitante['Telefono']), 0, 'C', false);
			
			if ($y >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 18;
			}
		}
		
		$this->SetXY($x, $y);
		$this->MultiCell(97, 15, utf8_encode('Comentarios'), 0, 'L');

		$this->SetXY($x + 99, $y);
		$this->MultiCell(483, 15, utf8_encode($comentarios), 0, 'L', true);
	}

	public function setCirculoFamiliar($circulo_familiar){
		if ($circulo_familiar) {
			if ($this->GetY() >= 650) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 30;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('PRIMER CÍRCULO FAMILIAR'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 30;

			
			$this->setXY($x, $y);
			$this->MultiCell(63, 15, utf8_encode('Parentesco'), 0, 'L', false);
			$this->setXY(90, $y);
			$this->MultiCell(380, 15, utf8_encode('Nombre'), 0, 'C', false);
			$this->setXY(472, $y);
			$this->MultiCell(128, 15, utf8_encode('Teléfono'), 0, 'C', false);

			$y = $this->GetY() + 2;

			$this->SetFillColor(255, 255, 255);

			foreach ($circulo_familiar as $familiar) { 
				$this->setXY($x, $y);
				$this->MultiCell(63, 15, utf8_encode(Utils::getParentesco($familiar['Parentesco'])), 0, 'L', false);
				$this->setXY(90, $y);
				$this->MultiCell(380, 15, utf8_encode($familiar['Nombre_Parentesco']), 0, 'C', true);
				$this->setXY(472, $y);
				$this->MultiCell(128, 15, utf8_encode($familiar['Telefono_Parentesco']), 0, 'C', true);

				if ($this->GetY() >= 715) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}
			}
		}
		
		
	}

	public function setVivienda($vivienda, $ubicacion){
		if ($this->GetY() >= 650) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 30;
		}

		$this->SetFillColor(177, 194, 126);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('ACERCA DE LA VIVIENDA'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 18;
		$y = $this->GetY() + 30;
		$this->SetFillColor(255, 255, 255);

		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('Tiempo de vivir en el domicilio'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Tiempo_Viviendo), 0, 'L', true);

		$y = $this->GetY() + 2;

		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('Calle'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(148, 15, utf8_encode($ubicacion->Calle), 0, 'L', true);
		$this->setXY(310, $y);
		$this->MultiCell(62, 15, utf8_encode('No.'), 0, 'L', false);
		$this->setXY(374, $y);
		$this->MultiCell(76, 15, utf8_encode($ubicacion->Exterior), 0, 'C', true);
		$this->setXY(452, $y);
		$this->MultiCell(46, 15, utf8_encode('Interior'), 0, 'C', false);
		$this->setXY(500, $y);
		$this->MultiCell(100, 15, utf8_encode($ubicacion->Interior), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('Colonia'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(148, 15, utf8_encode($ubicacion->Colonia), 0, 'L', true);
		$this->setXY(310, $y);
		$this->MultiCell(62, 15, utf8_encode('Entre:'), 0, 'L', false);
		$this->setXY(374, $y);
		$this->MultiCell(226, 15, utf8_encode($ubicacion->Entre_Calles), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}
		
		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('Delegación o municipio'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(148, 15, utf8_encode($ubicacion->Municipio), 0, 'L', true);
		$this->setXY(310, $y);
		$this->MultiCell(62, 15, utf8_encode('Estado'), 0, 'L', false);
		$this->setXY(374, $y);
		$this->MultiCell(76, 15, utf8_encode($ubicacion->Estado), 0, 'C', true);
		$this->setXY(452, $y);
		$this->MultiCell(46, 15, utf8_encode('CP'), 0, 'C', false);
		$this->setXY(500, $y);
		$this->MultiCell(100, 15, utf8_encode($ubicacion->Codigo_Postal), 0, 'C', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 8, utf8_encode('Color y descripción de la fachada:'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(442, 15, utf8_encode($ubicacion->Fachada), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('Tipo de vivienda'), 0, 'L', false);
		$this->setXY(158, $y);
		$Tipo_Vivienda = $vivienda->Tipo_Vivienda == 150 ? 'Casa individual' : ($vivienda->Tipo_Vivienda == 151 ? 'Departamento' : ($vivienda->Tipo_Vivienda == 152 ? 'Dúplex' : ($vivienda->Tipo_Vivienda == 153 ? 'Cuádruplex' : '')));
		$this->MultiCell(442, 15, utf8_encode($Tipo_Vivienda), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('Número de plantas o niveles'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Plantas), 0, 'L', true);
		$this->setXY(310, $y);
		$this->MultiCell(140, 15, utf8_encode('Número de baños:'), 0, 'L', false);
		$this->setXY(452, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Sanitarios), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('Número de recámaras'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Recamaras), 0, 'L', true);
		$this->setXY(310, $y);
		$this->MultiCell(140, 15, utf8_encode('Capacidad de autos en cochera'), 0, 'L', false);
		$this->setXY(452, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Capacidad_Cochera), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('El domicilio donve vive es:'), 0, 'L', false);
		$this->setXY(158, $y);
		$Domicilio_es = $vivienda->Domicilio_es == 160 ? 'Propio' : ($vivienda->Domicilio_es == 161 ? 'Rentado' : ($vivienda->Domicilio_es == 162 ? 'Prestado' : ($vivienda->Domicilio_es == 163 ? 'De sus padres' : ($vivienda->Domicilio_es == 164 ? 'Otros' : ''))));
		$this->MultiCell(148, 15, utf8_encode($Domicilio_es), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 8, utf8_encode('En caso de no ser propio, nombre del propietario'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(442, 15, utf8_encode($vivienda->Propietario), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 15, utf8_encode('Parentesco'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Parentesco), 0, 'L', true);
		$this->setXY(310, $y);
		$this->MultiCell(140, 15, utf8_encode('Teléfono'), 0, 'L', false);
		$this->setXY(452, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Telefono_Parentesco), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}

		$this->setXY($x, $y);
		$this->MultiCell(138, 8, utf8_encode('En caso de arrendamiento. ¿Cuenta con el contrato?'), 0, 'L', false);
		$this->setXY(158, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Contrato_Arrendamiento), 0, 'L', true);
		$this->setXY(310, $y);
		$this->MultiCell(140, 15, utf8_encode('Tiempo del contrato'), 0, 'L', false);
		$this->setXY(452, $y);
		$this->MultiCell(148, 15, utf8_encode($vivienda->Tiempo_Contrato), 0, 'L', true);

		if ($this->GetY() >= 680) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 2;
		}
	}

	public function setEnseres($enseres){
		if ($enseres) {
			if ($this->GetY() >= 650) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 30;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(250, $y);
			$this->Write(10, utf8_encode('ENSERES'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 30;
			$this->SetFillColor(255, 255, 255);
			
			$this->setXY($x, $y);
			$this->MultiCell(183, 15, utf8_encode('Electrónicos'), 0, 'L', false);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Computadoras'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Computadoras, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Pantallas'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Pantallas, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}
			
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Laptop'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Laptop, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Impresoras'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Impresoras, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY(210, $y);
			$this->MultiCell(190, 15, '', 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, '', 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY($x, $y);
			$this->MultiCell(183, 15, utf8_encode('Línea blanca'), 0, 'L', false);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Refrigerador'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Refrigerador, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Estufa'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Estufa, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}
			
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Aire acondicionado'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Aire_Acondicionado, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Lavadora'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Lavadora, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY($x, $y);
			$this->MultiCell(183, 15, utf8_encode('¿Se observa mobiliario de uso cotidiano?'), 0, 'L', false);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Sí'), 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, utf8_encode('No'), 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY($x, $y);
			$this->MultiCell(183, 15, utf8_encode('Comentarios'), 0, 'L', false);
			$this->setXY(210, $y);
			$this->MultiCell(390, 15, utf8_encode(''), 0, 'L', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}
		}
			
	}

	public function setFotoExteriorDomicilio($r_foto_exterior){
		if (!$r_foto_exterior) {
			$r_foto_exterior = array('dist/img/Sin_foto.png', 'png');
		}
		$foto_exterior = getimagesize($r_foto_exterior[0]);
		$w_foto_exterior = $foto_exterior[0];
		$h_foto_exterior = $foto_exterior[1];

		if ($this->GetY() >= 250 || ($w_foto_exterior < $h_foto_exterior)) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 30;
		}

		$this->SetFillColor(177, 194, 126);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('FOTO EXTERIOR DE LA CASA'));

		$y = $this->GetY() + 30;
		$this->SetXY(25, $y);

		if ($w_foto_exterior > $h_foto_exterior) {
			$h_foto_exterior = $h_foto_exterior * 488 / $w_foto_exterior;
			$w_foto_exterior = 488;
			$this->Image($r_foto_exterior[0], 62, $this->GetY(), $w_foto_exterior, $h_foto_exterior, $r_foto_exterior[1]);
		} else {
			$w_foto_exterior = $w_foto_exterior * 300 / $h_foto_exterior;
			$h_foto_exterior = 300;
			$this->Image($r_foto_exterior[0], (612 - $w_foto_exterior) / 2, $this->GetY(), $w_foto_exterior, $h_foto_exterior, $r_foto_exterior[1]);
			
		}

		$y = $this->GetY() + $h_foto_exterior;
		$this->SetY($y);
		
	}

	public function setFotoInteriorDomicilio($r_foto_interior){
		if (!$r_foto_interior) {
			$r_foto_interior = array('dist/img/Sin_foto.png', 'png');
		}
		$foto_interior = getimagesize($r_foto_interior[0]);
		$w_foto_interior = $foto_interior[0];
		$h_foto_interior = $foto_interior[1];

		if ($this->GetY() >= 300 || ($w_foto_interior < $h_foto_interior)) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 20;
		}

		$this->SetFillColor(177, 194, 126);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('FOTO INTERIOR DE LA CASA'));

		$y = $this->GetY() + 30;
		$this->SetXY(25, $y);

		if ($w_foto_interior > $h_foto_interior) {
			$h_foto_interior = $h_foto_interior * 488 / $w_foto_interior;
			$w_foto_interior = 488;
			$this->Image($r_foto_interior[0], 62, $this->GetY(), 488, 0, $r_foto_interior[1]);
		} else {
			$w_foto_interior = $w_foto_interior * 300 / $h_foto_interior;
			$h_foto_interior = 300;
			$this->Image($r_foto_interior[0], (612 - $w_foto_interior) / 2, $this->GetY(), $w_foto_interior, $h_foto_interior, $r_foto_interior[1]);
		}

		$y = $this->GetY() + $h_foto_interior;
		$this->SetY($y);
	}

	public function setFotoUbicacionGeografica($r_ubicacion_geografica){
		if ($r_ubicacion_geografica) {
			$foto_ubicacion_geografica = getimagesize($r_ubicacion_geografica[0]);
			$w_foto_ubicacion_geografica = $foto_ubicacion_geografica[0];
			$h_foto_ubicacion_geografica = $foto_ubicacion_geografica[1];

			if ($this->GetY() >= 300 || ($w_foto_ubicacion_geografica < $h_foto_ubicacion_geografica)) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 20;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(200, $y);
			$this->Write(10, utf8_encode('UBICACIÓN GEOGRÁFICA DEL DOMICILIO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_ubicacion_geografica > $h_foto_ubicacion_geografica) {
				$h_foto_ubicacion_geografica = $h_foto_ubicacion_geografica * 488 / $w_foto_ubicacion_geografica;
				$w_foto_ubicacion_geografica = 488;
				$this->Image($r_ubicacion_geografica[0], 62, $this->GetY(), 488, 0, $r_ubicacion_geografica[1]);
			} else {
				$w_foto_ubicacion_geografica = $w_foto_ubicacion_geografica * 300 / $h_foto_ubicacion_geografica;
				$h_foto_ubicacion_geografica = 300;
				$this->Image($r_ubicacion_geografica[0], (612 - $w_foto_ubicacion_geografica) / 2, $this->GetY(), 0, $h_foto_ubicacion_geografica, $r_ubicacion_geografica[1]);
			}
			$y = $this->GetY() + $h_foto_ubicacion_geografica;
			$this->SetY($y);
		}
		
	}

	public function setReferencias($referencias){
		$this->seccionHeader = 3;
		$this->AddPage();
		$this->seccionHeader = false;
		
		foreach ($referencias as $key => $referencia) { 
			if ($this->GetY() >= 350) {
				$this->AddPage();
				$y = 72;
			}elseif ($key == 0){
				$y = 72;
			}else{
				$y = $this->GetY() + 25;
			}

			$this->SetFillColor(248, 152, 80);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			
			$y += 6;
			$this->setXY(237, $y);
			$this->Write(10, 'REFERENCIA '.($key + 1));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 25;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('Tipo de referencia'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode(Utils::getTipoReferencia($referencia['Tipo'])), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('Relación con el candidato'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Relacion']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('Nombre'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Nombre']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('Teléfono'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Telefono']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('Domicilio de la referencia'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Domicilio']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('¿Cuál es el domicilio del candidato?'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Domicilio_Candidato']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('¿Cuánto tiempo tiene el candidato viviendo ahí?'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Tiempo_Viviendo']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('¿Cuánto tiempo tiene de conocerlo?'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Tiempo_Conocerlo']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('¿Sabe si tiene hijos?'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Tiene_Hijos']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('¿Sabe a qué se dedica?'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Dedicacion']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('¿Sabe sobre su estado civil?'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Estado_Civil']), 0, 'L', true);

			$y = $this->GetY() + 2;
			$this->SetXY($x, $y);
			$this->MultiCell(223, 10, utf8_encode('Comentarios sobre el candidato'), 0, 'L', false);

			$this->setXY(250, $y);
			$this->MultiCell(350, 18, utf8_encode($referencia['Comentarios']), 0, 'L', true);

		}
	}

	public function setEconomiaFamiliar($ingresos, $egresos, $comentarios){
		$this->AddPage();
		$y = 72;

		$this->SetFillColor(248, 152, 80);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('ECONOMÍA FAMILIAR'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 10;
		$y = $this->GetY() + 20;
		$this->SetFillColor(255, 255, 255);

		$this->setXY($x, $y);
		$this->MultiCell(117, 15, utf8_encode('¿Quién aporta?'), 0, 'C', false);
		$this->setXY(129, $y);
		$this->MultiCell(117, 15, utf8_encode('Fuente de ingreso'), 0, 'C', false);
		$this->setXY(248, $y);
		$this->MultiCell(117, 15, utf8_encode('Monto mensual'), 0, 'C', false);
		$this->setXY(372, $y);
		$this->MultiCell(112, 15, utf8_encode('Egreso'), 0, 'L', false);
		$this->setXY(486, $y);
		$this->MultiCell(114, 15, utf8_encode('Monto mensual'), 0, 'R', false);

		$y = $this->GetY() + 2;
		$y1 = $y;
		$y2 = $y;
		$total_ingresos = 0;
		$total_egresos = 0;
		foreach ($ingresos as $key => $ingreso) { 
			$this->setXY($x, $y1);
			$this->MultiCell(117, 16, utf8_encode($ingreso['Aporta']), 0, 'C', true);
			$this->setXY(129, $y1);
			$this->MultiCell(117, 16, utf8_encode($ingreso['Fuente']), 0, 'C', true);
			$this->setXY(248, $y1);
			$this->MultiCell(117, 16, '$'.number_format($ingreso['Monto'], 2), 0, 'R', true);
			$y1 = $this->GetY() + 2;
			$total_ingresos += $ingreso['Monto'];
		}
		foreach ($egresos as $key => $egreso) { 
			$this->setXY(372, $y2);
			$this->MultiCell(112, 16, utf8_encode($egreso['Descripcion']), 0, 'L', false);
			$this->setXY(486, $y2);
			$this->MultiCell(114, 16, '$'.number_format($egreso['Monto'], 2), 0, 'R', true);
			$y2 = $this->GetY() + 2;
			$total_egresos += $egreso['Monto'];
		}
		$x = 24;
		$y = $this->GetY() + 2;
		$this->setXY($x, $y);
		$this->MultiCell(103, 15, utf8_encode('TOTAL MENSUAL'), 0, 'L', false);
		$this->setXY(129, $y);
		$this->MultiCell(236, 15, '$'.number_format($total_ingresos, 2), 0, 'R', true);
		$this->setXY(372, $y);
		$this->MultiCell(112, 15, utf8_encode('TOTAL MENSUAL'), 0, 'L', false);
		$this->setXY(486, $y);
		$this->MultiCell(114, 15, '$'.number_format($total_egresos, 2), 0, 'R', true);

		$y = $this->GetY() + 2;
		$this->setXY($x, $y);
		$this->MultiCell(103, 15, utf8_encode('DIFERENCIA'), 0, 'L', false);
		$this->setXY(129, $y);
		$diferencia = $total_ingresos - $total_egresos;
		if ($diferencia < 0) {
			$this->SetTextColor(255, 16, 16);
		}
		$this->MultiCell(471, 15, '$'.number_format($diferencia, 2), 0, 'C', true);
		$this->SetTextColor(140, 140, 140);

		$y = $this->GetY() + 2;
		$this->setXY($x, $y);
		$this->MultiCell(103, 15, utf8_encode('COMENTARIOS'), 0, 'L', false);
		$this->setXY(129, $y);
		$this->MultiCell(471, 15, utf8_encode($comentarios), 0, 'L', true);
	}

	public function setInformacionFamiliar($creditos, $cuentas, $seguros){
		if ($creditos || $cuentas || $seguros) {
			$y = $this->GetY() + 20;

			$this->SetFillColor(248, 152, 80);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('INFORMACIÓN FAMILIAR'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$x = 12;
			$y = $this->GetY() + 20;
		}
			
		if (count($creditos) > 0) {
			
			$this->setXY($x, $y);
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('CRÉDITOS AL CONSUMO O TDC'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(115, 15, utf8_encode('Institución'), 0, 'C', false);
			$this->setXY(129, $y);
			$this->MultiCell(117, 15, utf8_encode('Límite de crédito'), 0, 'C', false);
			$this->setXY(248, $y);
			$this->MultiCell(117, 15, utf8_encode('Saldo actual aprox.'), 0, 'C', false);
			$this->setXY(372, $y);
			$this->MultiCell(112, 15, utf8_encode('Vencimiento'), 0, 'C', false);
			$this->setXY(486, $y);
			$this->MultiCell(114, 15, utf8_encode('Abono mensual'), 0, 'C', false);

			$y = $this->GetY() + 2;
			foreach ($creditos as $key => $credito) { 
				$this->setXY($x, $y);
				$this->MultiCell(115, 16, utf8_encode($credito['Institucion']), 0, 'C', true);
				$this->setXY(129, $y);
				$this->MultiCell(117, 16, utf8_encode($credito['Limite_Credito']), 0, 'C', true);
				$this->setXY(248, $y);
				$this->MultiCell(117, 16, utf8_encode($credito['Saldo_Actual']), 0, 'C', true);
				$this->setXY(367, $y);
				$this->MultiCell(117, 16, utf8_encode($credito['Vencimiento']), 0, 'C', true);
				$this->setXY(486, $y);
				$this->MultiCell(114, 16, utf8_encode($credito['Abono_Mensual']), 0, 'C', true);
				$y = $this->GetY() + 2;
			}

			$y = $this->GetY() + 8;
		}
		
		if (count($cuentas) > 0) {
			$this->setXY($x, $y);
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('CUENTAS BANCARIAS Y DE INVERSIÓN'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(145, 15, utf8_encode('Institución'), 0, 'C', false);
			$this->setXY(159, $y);
			$this->MultiCell(145, 15, utf8_encode('Tipos de cuenta'), 0, 'C', false);
			$this->setXY(306, $y);
			$this->MultiCell(145, 15, utf8_encode('Objetivo del ahorro'), 0, 'C', false);
			$this->setXY(451, $y);
			$this->MultiCell(145, 15, utf8_encode('Depósito mensual'), 0, 'C', false);

			$y = $this->GetY() + 2;
			foreach ($cuentas as $key => $cuenta) { 
				$this->setXY($x, $y);
				$this->MultiCell(145, 16, utf8_encode($cuenta['Institucion']), 0, 'C', true);
				$this->setXY(159, $y);
				$this->MultiCell(145, 16, utf8_encode($cuenta['Tipo_Cuenta']), 0, 'C', true);
				$this->setXY(306, $y);
				$this->MultiCell(145, 16, utf8_encode($cuenta['Objetivo']), 0, 'C', true);
				$this->setXY(451, $y);
				$this->MultiCell(145, 16, utf8_encode($cuenta['Deposito_Mensual']), 0, 'C', true);
				$y = $this->GetY() + 2;
			}

			$y = $this->GetY() + 8;
		}

		if (count($seguros) > 0) {
			$this->setXY($x, $y);
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('SEGUROS (VIDA, AUTO, VIVIENDA, GMM)'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(115, 15, utf8_encode('Institución'), 0, 'C', false);
			$this->setXY(129, $y);
			$this->MultiCell(117, 15, utf8_encode('Tipo de seguro'), 0, 'C', false);
			$this->setXY(248, $y);
			$this->MultiCell(117, 15, utf8_encode('Forma de pago'), 0, 'C', false);
			$this->setXY(372, $y);
			$this->MultiCell(112, 15, utf8_encode('Prima'), 0, 'C', false);
			$this->setXY(486, $y);
			$this->MultiCell(114, 15, utf8_encode('Vigencia'), 0, 'C', false);

			$y = $this->GetY() + 2;
			foreach ($seguros as $key => $seguro) { 
				$this->setXY($x, $y);
				$this->MultiCell(115, 16, utf8_encode($seguro['Institucion']), 0, 'C', true);
				$this->setXY(129, $y);
				$this->MultiCell(117, 16, utf8_encode($seguro['Tipo_Seguro']), 0, 'C', true);
				$this->setXY(248, $y);
				$this->MultiCell(117, 16, utf8_encode($seguro['Forma_Pago']), 0, 'C', true);
				$this->setXY(367, $y);
				$this->MultiCell(117, 16, utf8_encode($seguro['Prima']), 0, 'C', true);
				$this->setXY(486, $y);
				$this->MultiCell(114, 16, utf8_encode($seguro['Vigencia']), 0, 'C', true);
				$y = $this->GetY() + 2;
			}
		}
		
		
	}

	public function setInformacionPatrimonial($inmuebles, $vehiculos){
		if ($inmuebles || $vehiculos) {
			if ($this->GetY() >= 660) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 20;
			}

			$this->SetFillColor(248, 152, 80);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('INFORMACIÓN PATRIMONIAL'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$x = 12;
			$y = $this->GetY() + 20;
			$this->setXY($x, $y);
		}
		if (count($inmuebles) > 0) {
			
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('BIENES INMUEBLES'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);
		
			$this->setXY($x, $y);
			$this->MultiCell(115, 15, utf8_encode('Tipo'), 0, 'C', false);
			$this->setXY(129, $y);
			$this->MultiCell(117, 15, utf8_encode('Ubicación'), 0, 'C', false);
			$this->setXY(248, $y);
			$this->MultiCell(117, 15, utf8_encode('Valor'), 0, 'C', false);
			$this->setXY(372, $y);
			$this->MultiCell(112, 15, utf8_encode('Pagado'), 0, 'C', false);
			$this->setXY(486, $y);
			$this->MultiCell(114, 15, utf8_encode('Abono mensual'), 0, 'C', false);

			$y = $this->GetY() + 2;
			foreach ($inmuebles as $key => $inmueble) { 
				$this->setXY($x, $y);
				$this->MultiCell(115, 16, utf8_encode($inmueble['Tipo_Inmueble']), 0, 'C', true);
				$this->setXY(129, $y);
				$this->MultiCell(117, 16, utf8_encode($inmueble['Ubicacion']), 0, 'C', true);
				$this->setXY(248, $y);
				$this->MultiCell(117, 16, utf8_encode($inmueble['Valor']), 0, 'C', true);
				$this->setXY(367, $y);
				$this->MultiCell(117, 16, utf8_encode($inmueble['Pagado']), 0, 'C', true);
				$this->setXY(486, $y);
				$this->MultiCell(114, 16, utf8_encode($inmueble['Abono_Mensual']), 0, 'C', true);
				
				if ($this->GetY() >= 660) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}
			}

		}

		if (count($vehiculos) > 0) {
			if ($this->GetY() >= 660) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}
			$this->setXY($x, $y);
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('VEHÍCULOS'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(115, 15, utf8_encode('Marca'), 0, 'C', false);
			$this->setXY(129, $y);
			$this->MultiCell(117, 15, utf8_encode('Modelo'), 0, 'C', false);
			$this->setXY(248, $y);
			$this->MultiCell(117, 15, utf8_encode('Valor'), 0, 'C', false);
			$this->setXY(372, $y);
			$this->MultiCell(112, 15, utf8_encode('Pagado'), 0, 'C', false);
			$this->setXY(486, $y);
			$this->MultiCell(114, 15, utf8_encode('Abono mensual'), 0, 'C', false);

			$y = $this->GetY() + 2;
			foreach ($vehiculos as $key => $vehiculo) { 
				$this->setXY($x, $y);
				$this->MultiCell(115, 16, utf8_encode($vehiculo['Marca']), 0, 'C', true);
				$this->setXY(129, $y);
				$this->MultiCell(117, 16, utf8_encode($vehiculo['Modelo']), 0, 'C', true);
				$this->setXY(248, $y);
				$this->MultiCell(117, 16, utf8_encode($vehiculo['Valor']), 0, 'C', true);
				$this->setXY(367, $y);
				$this->MultiCell(117, 16, utf8_encode($vehiculo['Pagado']), 0, 'C', true);
				$this->setXY(486, $y);
				$this->MultiCell(114, 16, utf8_encode($vehiculo['Abono_Mensual']), 0, 'C', true);
				if ($this->GetY() >= 660) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}
			}
		}
		
		
	}

	public function setConclusiones($observaciones){
		if ($this->GetY() >= 500) {
			$this->AddPage();
			$y = 72;
			$this->SetY($y);
		}elseif ($this->GetY() <= 100){
			$y = 72;
			$this->SetY($y);
		}else{
			$y = $this->GetY() + 20;
		}

		$this->SetFillColor(248, 152, 80);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(250, $y);
		$this->Write(10, 'CONCLUSIONES');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(100, 18, utf8_encode('Acerca del candidato'), 0, 'L', false);

		$this->setXY(127, $y);
		$this->MultiCell(473, 18, utf8_encode($observaciones->Sobre_Candidato), 0, 'L', true);

		$y = $this->GetY() + 2;
		$this->SetXY($x, $y);
		$this->MultiCell(100, 8, utf8_encode('Acerca de su familia y entorno'), 0, 'L', false);

		$this->setXY(127, $y);
		$this->MultiCell(473, 18, utf8_encode($observaciones->Sobre_Familia), 0, 'L', true);

		$y = $this->GetY() + 2;
		
		$this->SetXY($x, $y);
		$this->MultiCell(100, 8, utf8_encode('Conclusiones del entrevistador'), 0, 'L', false);

		$this->setXY(127, $y);
		$this->MultiCell(473, 18, utf8_encode(''), 0, 'L', true);

		$y = $this->gety() + 25;

		$this->SetFillColor(234, 234, 234);
		$this->Rect(11, $y, 590, 72, 'F');

		$this->SetFillColor(239, 246, 248);
		$this->SetXY(10, $y);
		$this->MultiCell(148, 18, '', 0, 'L', true);
		$this->SetXY(158, $y);
		$this->MultiCell(148, 18, utf8_encode('Bueno'), 0, 'C', true);
		$this->SetXY(306, $y);
		$this->MultiCell(148, 18, utf8_encode('Regular'), 0, 'C', true);
		$this->SetXY(454, $y);
		$this->MultiCell(148, 18, utf8_encode('No aceptable'), 0, 'C', true);

		$y = $this->GetY();

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Participación del candidato'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$participacion = 0;
		if ($participacion == 3) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($participacion == 2){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($participacion == 1) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		$this->SetFillColor(239, 246, 248);

		$y = $this->GetY() + 2;

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Entorno familiar'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$participacion = 0;
		if ($participacion == 3) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($participacion == 2){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif($participacion == 1) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		$this->SetFillColor(239, 246, 248);

		$y = $this->GetY() + 2;

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Referencias vecinales'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$participacion = 0;
		if ($participacion == 3) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($participacion == 2){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($participacion == 1) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		
		if ($y >= 650) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 18;
		}

		$this->SetFillColor(248, 152, 80);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(160, $y);
		$this->Write(10, utf8_encode('COMENTARIOS GENERALES DE LA VERIFICACIÓN'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(562, 14, (utf8_encode($observaciones->Comentarios_Generales)), 0, 'L', true);

	}

	public function setInvestigacionLaboral($investigacion){
		if ($investigacion) {
			if ($this->GetY() >= 400) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 30;
			}

			$this->SetFillColor(4, 124, 183);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			
			$y += 6;
			$this->setXY(237, $y);
			$this->Write(10, utf8_encode('INVESTIGACIÓN LABORAL'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 35;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('¿El candidato cuenta con circunstancias laborales?'), 0, 'L', false);

			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Circunstancias_Laborales), 0, 'L', true);

			$y = $this->GetY() + 2;
			
			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('¿Proporcionó los datos de contacto de sus empleos?'), 0, 'L', false);

			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Proporciono_Datos_Empleos), 0, 'L', true);

			$y = $this->GetY() + 4;

			$this->SetXY($x, $y);
			$this->MultiCell(281, 8, utf8_encode('En caso de que no, ¿cuál fue el motivo por que no los proporcionó?'), 0, 'L', false);

			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Motivo_No_Proporciono_Datos), 0, 'L', true);

			$y = $this->GetY() + 4;

			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('¿Ha demandado alguna empresa?'), 0, 'L', false);

			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Demanda_Laboral), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('En caso afirmativo, ¿cuál fue el motivo?'), 0, 'L', false);

			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Motivo_Demanda), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('Número de empleos registrados en los últimos 3 años'), 0, 'L', false);

			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->No_Empleos), 0, 'L', true);

			$y = $this->GetY() + 5;

			$this->SetXY($x, $y);
			$this->MultiCell(281, 8, utf8_encode('Tiempo promedio de duración en sus empleos considerando los últimos 3 años'), 0, 'L', false);

			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Tiempo_Promedio_Empleos), 0, 'L', true);

			$y = $this->GetY() + 2;
		}
		
	}

	public function setReferenciasLaborales($referencias_laborales){
		foreach ($referencias_laborales as $key => $referencia) { 
			$this->AddPage();
			$y = 72;

			$this->SetFillColor(73, 142, 180);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, 'REFERENCIA LABORAL '.($key + 1));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 25;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Empresa'), 0, 'L', false);

			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Empresa']), 0, 'L', true);

			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Giro'), 0, 'L', false);

			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Giro']), 0, 'L', true);

			$y = $this->GetY() + 2;
			
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Domicilio'), 0, 'L', false);

			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Domicilio']), 0, 'L', true);

			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Teléfono'), 0, 'L', false);

			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Telefono']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Fecha de Ingreso'), 0, 'L', false);

			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Fecha_Ingreso']), 0, 'L', true);

			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Fecha de Baja'), 0, 'L', false);

			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Fecha_Baja']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Puesto inicial'), 0, 'L', false);

			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Puesto_Inicial']), 0, 'L', true);

			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Puesto final'), 0, 'L', false);

			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Puesto_Final']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Jefe inmediato'), 0, 'L', false);

			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Jefe']), 0, 'L', true);

			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Puesto del jefe'), 0, 'L', false);

			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Puesto_Jefe']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->SetXY($x, $y);
			$this->MultiCell(103, 27, utf8_encode('Motivo de separación'), 0, 'L', false);

			$this->setXY(130, $y);
			$this->MultiCell(472, 27, utf8_encode($referencia['Motivo_Separacion']), 0, 'L', true);

			$this->setXY(308, $y);
			$this->MultiCell(213, 27, '', 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setXY(12, $y);
			$this->MultiCell(213, 27, '', 0, 'L', true);

			$this->SetXY($x, $y);
			$this->MultiCell(200, 14, utf8_encode('¿Es el candidato una persona recontratable?'), 0, 'L', true);

			$this->Circle(247, $y + 18, 6, 'F');
			$this->Circle(287, $y + 18, 6, 'F');

			if ($referencia['Recontratable'] == 1) {
				$this->SetFillColor(43, 179, 73);
				$this->Circle(247, $y + 18, 4, 'F');
			}elseif ($referencia['Recontratable'] == 0){
				$this->SetFillColor(255, 16, 16);
				$this->Circle(287, $y + 18, 4, 'F');
			}
			$this->SetFillColor(239, 246, 248);

			$this->SetXY(229, $y - 8);
			$this->MultiCell(77, 27, utf8_encode('Sí               No'), 0, 'C', false);

			$this->SetFillColor(255, 255, 255);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 27, utf8_encode('¿Por qué?'), 0, 'L', false);

			$this->setXY(426, $y);
			$this->MultiCell(176, 27, utf8_encode($referencia['Recontratable_PorQue']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->SetXY($x, $y);
			$this->MultiCell(103, 9, utf8_encode('Nombre y puesto de quien proporciona la información'), 0, 'L', false);

			$this->setXY(130, $y);
			$this->MultiCell(472, 27, utf8_encode($referencia['Informante']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Comentarios'), 0, 'L', false);

			$this->setXY(130, $y);
			$this->MultiCell(472, 14, utf8_encode($referencia['Comentarios']), 0, 'L', true);

			if ($referencia['Calif'] == 0) {
				if ($this->GetY() > 590) {
					$this->AddPage();
					$y = 72;
				} else {
					$y = $this->GetY() + 25;
				}
				
				$this->SetFillColor(73, 142, 180);
				$this->Rect(10, $y, 592, 20, 'F');
				$this->SetFont('Sinkinsans','B', 11);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(220, $y);
				$this->Write(10, 'CONCEPTOS');

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$x = 25;
				$y = $this->GetY() + 15;
				
				$this->SetFillColor(234, 234, 234);
				$this->Rect(11, $y, 590, 110, 'F');

				$this->SetFillColor(239, 246, 248);
				$this->SetXY(10, $y);
				$this->MultiCell(148, 18, '', 0, 'L', true);
				$this->SetXY(158, $y);
				$this->MultiCell(111, 18, utf8_encode('Excelente'), 0, 'C', true);
				$this->SetXY(269, $y);
				$this->MultiCell(111, 18, utf8_encode('Apropiada'), 0, 'C', true);
				$this->SetXY(380, $y);
				$this->MultiCell(111, 18, utf8_encode('Regular'), 0, 'C', true);
				$this->SetXY(491, $y);
				$this->MultiCell(111, 18, utf8_encode('Malo'), 0, 'C', true);

				$y = $this->GetY();

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Desempeño laboral'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$desempenio = $referencia['Desempeno'];
				if ($desempenio == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($desempenio == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($desempenio == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($desempenio == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}
				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Honradez'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$honradez = $referencia['Honradez'];
				if ($honradez == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($honradez == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($honradez == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($honradez == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}
				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Asistencia y puntualidad'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$asistencia = $referencia['Puntualidad'];
				if ($asistencia == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($asistencia == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($asistencia == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($asistencia == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}

				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Relación con superiores y compañeros'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$relacion = $referencia['Relacion'];
				if ($relacion == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($relacion == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($relacion == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($relacion == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}

				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Responsabilidad'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$responsabilidad = $referencia['Responsabilidad'];
				if ($responsabilidad == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($responsabilidad == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($responsabilidad == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($responsabilidad == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}
				
				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Adaptación al ambiente de trabajo'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$adaptacion = $referencia['Adaptacion'];
				if ($adaptacion == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($adaptacion == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($adaptacion == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($adaptacion == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}
				
				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;
			}else{
				$y = $this->GetY() + 25;
				$this->SetXY($x, $y);
				$this->MultiCell(0, 18, utf8_encode('La empresa no proporcionó datos del desempeño del candidato.'), 0);
			}

		}
	}

	public function setResultadoInvestigacionLaboral($observaciones){
		$this->AddPage();
		$y = 72;
		$this->SetFillColor(73, 142, 180);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		
		$y += 6;
		$this->setXY(130, $y);
		$this->Write(10, utf8_encode('RESULTADO DE LA INVESTIGACIÓN LABORAL'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 25;
		
		$this->SetFillColor(234, 234, 234);
		$this->Rect(11, $y, 590, 72, 'F');

		$this->SetFillColor(239, 246, 248);
		$this->SetXY(10, $y);
		$this->MultiCell(148, 18, '', 0, 'L', true);
		$this->SetXY(158, $y);
		$this->MultiCell(148, 18, utf8_encode('Bueno'), 0, 'C', true);
		$this->SetXY(306, $y);
		$this->MultiCell(148, 18, utf8_encode('Regular'), 0, 'C', true);
		$this->SetXY(454, $y);
		$this->MultiCell(148, 18, utf8_encode('Malo'), 0, 'C', true);

		$y = $this->GetY();

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Información proporcionada por el candidato'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$participacion = 0;
		if ($participacion == 3) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($participacion == 2){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($participacion == 1) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		$this->SetFillColor(239, 246, 248);

		$y = $this->GetY() + 2;

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Referencias laborales obtenidas'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$participacion = 0;
		if ($participacion == 3) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($participacion == 2){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($participacion == 1) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		$this->SetFillColor(239, 246, 248);

		$y = $this->GetY() + 2;

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Información confiable y verificable'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$participacion = 0;
		if ($participacion == 3) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($participacion == 2){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($participacion == 1) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}

		$y = $this->GetY() + 20;
		$this->SetFillColor(73, 142, 180);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(100, $y);
		$this->Write(10, utf8_encode('COMENTARIOS GENERALES DE LA INVESTIGACIÓN LABORAL'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(562, 14, (utf8_encode($observaciones->Comentario_General_il)), 0, 'L', true);

	}

	public function setFotoCredencial($r_foto_credencial_frente, $r_foto_credencial_atras){
		if ($r_foto_credencial_frente) {
			$foto_credencial_frente = getimagesize($r_foto_credencial_frente[0]);
			$w_foto_credencial_frente = $foto_credencial_frente[0];
			$h_foto_credencial_frente = $foto_credencial_frente[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('CREDENCIAL DE ELECTOR'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_credencial_frente > $h_foto_credencial_frente) {
				$h_foto_credencial_frente = $h_foto_credencial_frente * 400 / $w_foto_credencial_frente;
				$w_foto_credencial_frente = 400;
				$this->Image($r_foto_credencial_frente[0], 106, $this->GetY(), $w_foto_credencial_frente, $h_foto_credencial_frente, $r_foto_credencial_frente[1]);
			} else {
				$w_foto_credencial_frente = $w_foto_credencial_frente * 300 / $h_foto_credencial_frente;
				$h_foto_credencial_frente = 300;
				$this->Image($r_foto_credencial_frente[0], (612 - $w_foto_credencial_frente) / 2, $this->GetY(), $w_foto_credencial_frente, $h_foto_credencial_frente, $r_foto_credencial_frente[1]);
				
			}

			$y = $this->GetY() + $h_foto_credencial_frente + 15;
			$this->SetY($y);
		}
		
		
		if ($r_foto_credencial_atras) {
			$foto_credencial_atras = getimagesize($r_foto_credencial_atras[0]);
			$w_foto_credencial_atras = $foto_credencial_atras[0];
			$h_foto_credencial_atras = $foto_credencial_atras[1];

			if ($w_foto_credencial_atras > $h_foto_credencial_atras) {
				$h_foto_credencial_atras = $h_foto_credencial_atras * 400 / $w_foto_credencial_atras;
				$w_foto_credencial_atras = 400;
				$this->Image($r_foto_credencial_atras[0], 106, $this->GetY(), $w_foto_credencial_atras, $h_foto_credencial_atras, $r_foto_credencial_atras[1]);
			} else {
				$w_foto_credencial_atras = $w_foto_credencial_atras * 300 / $h_foto_credencial_atras;
				$h_foto_credencial_atras = 300;
				$this->Image($r_foto_credencial_atras[0], (612 - $w_foto_credencial_atras) / 2, $this->GetY(), $w_foto_credencial_atras, $h_foto_credencial_atras, $r_foto_credencial_atras[1]);
				
			}
		}
	}

	public function setFotoActaNacimiento($r_foto_acta){
		if ($r_foto_acta) {
			$foto_acta = getimagesize($r_foto_acta[0]);
			$w_foto_acta = $foto_acta[0];
			$h_foto_acta = $foto_acta[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('ACTA DE NACIMIENTO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_acta > $h_foto_acta) {
				$h_foto_acta = $h_foto_acta * 488 / $w_foto_acta;
				$w_foto_acta = 488;
				$this->Image($r_foto_acta[0], 62, $this->GetY(), $w_foto_acta, $h_foto_acta, $r_foto_acta[1]);
			} else {
				$w_foto_acta = $w_foto_acta * 560 / $h_foto_acta;
				$h_foto_acta = 560;
				$this->Image($r_foto_acta[0], (612 - $w_foto_acta) / 2, $this->GetY(), $w_foto_acta, $h_foto_acta, $r_foto_acta[1]);
				
			}
		}
		

	}

	public function setFotoLicenciaConducir($r_foto_licencia){
		if ($r_foto_licencia) {
			$foto_licencia = getimagesize($r_foto_licencia[0]);
			$w_foto_licencia = $foto_licencia[0];
			$h_foto_licencia = $foto_licencia[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('LICENCIA DE CONDUCIR'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_licencia > $h_foto_licencia) {
				$h_foto_licencia = $h_foto_licencia * 400 / $w_foto_licencia;
				$w_foto_licencia = 400;
				$this->Image($r_foto_licencia[0], 106, $this->GetY(), $w_foto_licencia, $h_foto_licencia, $r_foto_licencia[1]);
			} else {
				$w_foto_licencia = $w_foto_licencia * 300 / $h_foto_licencia;
				$h_foto_licencia = 300;
				$this->Image($r_foto_licencia[0], (612 - $w_foto_licencia) / 2, $this->GetY(), $w_foto_licencia, $h_foto_licencia, $r_foto_licencia[1]);
				
			}
		}
	}

	public function setFotoCartillaMilitar($r_foto_cartilla_militar){
		if ($r_foto_cartilla_militar) {
			$foto_cartilla_militar = getimagesize($r_foto_cartilla_militar[0]);
			$w_foto_cartilla_militar = $foto_cartilla_militar[0];
			$h_foto_cartilla_militar = $foto_cartilla_militar[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('CARTILLA MILITAR'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_cartilla_militar > $h_foto_cartilla_militar) {
				$h_foto_cartilla_militar = $h_foto_cartilla_militar * 400 / $w_foto_cartilla_militar;
				$w_foto_cartilla_militar = 400;
				$this->Image($r_foto_cartilla_militar[0], 106, $this->GetY(), $w_foto_cartilla_militar, $h_foto_cartilla_militar, $r_foto_cartilla_militar[1]);
			} else {
				$w_foto_cartilla_militar = $w_foto_cartilla_militar * 300 / $h_foto_cartilla_militar;
				$h_foto_cartilla_militar = 300;
				$this->Image($r_foto_cartilla_militar[0], (612 - $w_foto_cartilla_militar) / 2, $this->GetY(), $w_foto_cartilla_militar, $h_foto_cartilla_militar, $r_foto_cartilla_militar[1]);
				
			}
		}
	}

	public function setFotoCURP($r_foto_curp){
		if ($r_foto_curp) {
			$foto_curp = getimagesize($r_foto_curp[0]);
			$w_foto_curp = $foto_curp[0];
			$h_foto_curp = $foto_curp[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(300, $y);
			$this->Write(10, utf8_encode('CURP'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_curp > $h_foto_curp) {
				$h_foto_curp = $h_foto_curp * 488 / $w_foto_curp;
				$w_foto_curp = 488;
				$this->Image($r_foto_curp[0], 62, $this->GetY(), $w_foto_curp, $h_foto_curp, $r_foto_curp[1]);
			} else {
				$w_foto_curp = $w_foto_curp * 560 / $h_foto_curp;
				$h_foto_curp = 560;
				$this->Image($r_foto_curp[0], (612 - $w_foto_curp) / 2, $this->GetY(), $w_foto_curp, $h_foto_curp, $r_foto_curp[1]);
				
			}
		}
		

	}

	public function setFotoRFC($r_foto_rfc){
		if ($r_foto_rfc) {
			$foto_rfc = getimagesize($r_foto_rfc[0]);
			$w_foto_rfc = $foto_rfc[0];
			$h_foto_rfc = $foto_rfc[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(300, $y);
			$this->Write(10, utf8_encode('RFC'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_rfc > $h_foto_rfc) {
				$h_foto_rfc = $h_foto_rfc * 488 / $w_foto_rfc;
				$w_foto_rfc = 488;
				$this->Image($r_foto_rfc[0], 62, $this->GetY(), $w_foto_rfc, $h_foto_rfc, $r_foto_rfc[1]);
			} else {
				$w_foto_rfc = $w_foto_rfc * 560 / $h_foto_rfc;
				$h_foto_rfc = 560;
				$this->Image($r_foto_rfc[0], (612 - $w_foto_rfc) / 2, $this->GetY(), $w_foto_rfc, $h_foto_rfc, $r_foto_rfc[1]);
				
			}
		}
		

	}
	
	public function setFotoNSS($r_foto_nss){
		if ($r_foto_nss) {
			$foto_nss = getimagesize($r_foto_nss[0]);
			$w_foto_nss = $foto_nss[0];
			$h_foto_nss = $foto_nss[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(210, $y);
			$this->Write(10, utf8_encode('Número de seguridad social'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_nss > $h_foto_nss) {
				$h_foto_nss = $h_foto_nss * 488 / $w_foto_nss;
				$w_foto_nss = 488;
				$this->Image($r_foto_nss[0], 62, $this->GetY(), $w_foto_nss, $h_foto_nss, $r_foto_nss[1]);
			} else {
				$w_foto_nss = $w_foto_nss * 560 / $h_foto_nss;
				$h_foto_nss = 560;
				$this->Image($r_foto_nss[0], (612 - $w_foto_nss) / 2, $this->GetY(), $w_foto_nss, $h_foto_nss, $r_foto_nss[1]);
				
			}
		}
		

	}

	public function setFotoAfore($r_foto_afore){
		if ($r_foto_afore) {
			$foto_afore = getimagesize($r_foto_afore[0]);
			$w_foto_afore = $foto_afore[0];
			$h_foto_afore = $foto_afore[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(250, $y);
			$this->Write(10, utf8_encode('AFORE'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_afore > $h_foto_afore) {
				$h_foto_afore = $h_foto_afore * 488 / $w_foto_afore;
				$w_foto_afore = 488;
				$this->Image($r_foto_afore[0], 62, $this->GetY(), $w_foto_afore, $h_foto_afore, $r_foto_afore[1]);
			} else {
				$w_foto_afore = $w_foto_afore * 560 / $h_foto_afore;
				$h_foto_afore = 560;
				$this->Image($r_foto_afore[0], (612 - $w_foto_afore) / 2, $this->GetY(), $w_foto_afore, $h_foto_afore, $r_foto_afore[1]);
				
			}
		}
		

	}

	public function setFotoComprobanteDomicilio($r_foto_comprobante_domicilio){
		if ($r_foto_comprobante_domicilio) {
			$foto_comprobante_domicilio = getimagesize($r_foto_comprobante_domicilio[0]);
			$w_foto_comprobante_domicilio = $foto_comprobante_domicilio[0];
			$h_foto_comprobante_domicilio = $foto_comprobante_domicilio[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(240, $y);
			$this->Write(10, utf8_encode('Comprobante Domicilio'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_comprobante_domicilio > $h_foto_comprobante_domicilio) {
				$h_foto_comprobante_domicilio = $h_foto_comprobante_domicilio * 488 / $w_foto_comprobante_domicilio;
				$w_foto_comprobante_domicilio = 488;
				$this->Image($r_foto_comprobante_domicilio[0], 62, $this->GetY(), $w_foto_comprobante_domicilio, $h_foto_comprobante_domicilio, $r_foto_comprobante_domicilio[1]);
			} else {
				$w_foto_comprobante_domicilio = $w_foto_comprobante_domicilio * 560 / $h_foto_comprobante_domicilio;
				$h_foto_comprobante_domicilio = 560;
				$this->Image($r_foto_comprobante_domicilio[0], (612 - $w_foto_comprobante_domicilio) / 2, $this->GetY(), $w_foto_comprobante_domicilio, $h_foto_comprobante_domicilio, $r_foto_comprobante_domicilio[1]);
				
			}
		}
		

	}

	public function setFotoComprobanteEstudios($r_foto_comprobante_estudios){
		if ($r_foto_comprobante_estudios) {
			$foto_comprobante_estudios = getimagesize($r_foto_comprobante_estudios[0]);
			$w_foto_comprobante_estudios = $foto_comprobante_estudios[0];
			$h_foto_comprobante_estudios = $foto_comprobante_estudios[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, utf8_encode('Comprobante de Estudios'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_comprobante_estudios > $h_foto_comprobante_estudios) {
				$h_foto_comprobante_estudios = $h_foto_comprobante_estudios * 488 / $w_foto_comprobante_estudios;
				$w_foto_comprobante_estudios = 488;
				$this->Image($r_foto_comprobante_estudios[0], 62, $this->GetY(), $w_foto_comprobante_estudios, $h_foto_comprobante_estudios, $r_foto_comprobante_estudios[1]);
			} else {
				$w_foto_comprobante_estudios = $w_foto_comprobante_estudios * 560 / $h_foto_comprobante_estudios;
				$h_foto_comprobante_estudios = 560;
				$this->Image($r_foto_comprobante_estudios[0], (612 - $w_foto_comprobante_estudios) / 2, $this->GetY(), $w_foto_comprobante_estudios, $h_foto_comprobante_estudios, $r_foto_comprobante_estudios[1]);
				
			}
		}
		

	}

	public function setFotoRegistroPatronal($r_foto_registro_patronal, $i){
		if ($r_foto_registro_patronal) {
			$foto_registro_patronal = getimagesize($r_foto_registro_patronal[0]);
			$w_foto_registro_patronal = $foto_registro_patronal[0];
			$h_foto_registro_patronal = $foto_registro_patronal[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, utf8_encode('Registro patronal '.$i));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_registro_patronal > $h_foto_registro_patronal) {
				$h_foto_registro_patronal = $h_foto_registro_patronal * 488 / $w_foto_registro_patronal;
				$w_foto_registro_patronal = 488;
				$this->Image($r_foto_registro_patronal[0], 62, $this->GetY(), $w_foto_registro_patronal, $h_foto_registro_patronal, $r_foto_registro_patronal[1]);
			} else {
				$w_foto_registro_patronal = $w_foto_registro_patronal * 560 / $h_foto_registro_patronal;
				$h_foto_registro_patronal = 560;
				$this->Image($r_foto_registro_patronal[0], (612 - $w_foto_registro_patronal) / 2, $this->GetY(), $w_foto_registro_patronal, $h_foto_registro_patronal, $r_foto_registro_patronal[1]);
				
			}
		}
		

	}

	public function setFotoRedesSociales($r_foto_redes_sociales, $comentario){
		if ($r_foto_redes_sociales) {
			$foto_redes_sociales = getimagesize($r_foto_redes_sociales[0]);
			$w_foto_redes_sociales = $foto_redes_sociales[0];
			$h_foto_redes_sociales = $foto_redes_sociales[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(235, $y);
			$this->Write(10, utf8_encode('Redes sociales'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			$this->SetFont('Sinkinsans','B', 9);
			$this->SetTextColor(140, 140, 140);
			$this->MultiCell(562, 15, utf8_encode($comentario), 0, 'C');

			$y = $this->GetY() + 10;
			$this->SetXY(25, $y);

			if ($w_foto_redes_sociales > $h_foto_redes_sociales) {
				$h_foto_redes_sociales = $h_foto_redes_sociales * 488 / $w_foto_redes_sociales;
				$w_foto_redes_sociales = 488;
				$this->Image($r_foto_redes_sociales[0], 62, $this->GetY(), $w_foto_redes_sociales, $h_foto_redes_sociales, $r_foto_redes_sociales[1]);
			} else {
				$w_foto_redes_sociales = $w_foto_redes_sociales * 560 / $h_foto_redes_sociales;
				$h_foto_redes_sociales = 560;
				$this->Image($r_foto_redes_sociales[0], (612 - $w_foto_redes_sociales) / 2, $this->GetY(), $w_foto_redes_sociales, $h_foto_redes_sociales, $r_foto_redes_sociales[1]);
				
			}
		}
		

	}

	public function setFotoCartaLaboral($r_foto_carta_laboral, $i){
		if ($r_foto_carta_laboral) {
			$foto_carta_laboral = getimagesize($r_foto_carta_laboral[0]);
			$w_foto_carta_laboral = $foto_carta_laboral[0];
			$h_foto_carta_laboral = $foto_carta_laboral[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, utf8_encode('Carta laboral '.$i));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_carta_laboral > $h_foto_carta_laboral) {
				$h_foto_carta_laboral = $h_foto_carta_laboral * 488 / $w_foto_carta_laboral;
				$w_foto_carta_laboral = 488;
				$this->Image($r_foto_carta_laboral[0], 62, $this->GetY(), $w_foto_carta_laboral, $h_foto_carta_laboral, $r_foto_carta_laboral[1]);
			} else {
				$w_foto_carta_laboral = $w_foto_carta_laboral * 560 / $h_foto_carta_laboral;
				$h_foto_carta_laboral = 560;
				$this->Image($r_foto_carta_laboral[0], (612 - $w_foto_carta_laboral) / 2, $this->GetY(), $w_foto_carta_laboral, $h_foto_carta_laboral, $r_foto_carta_laboral[1]);
				
			}
		}
	}

	public function setFotoCartaLiberacionInfonavit($r_foto_infonavit){
		if ($r_foto_infonavit) {
			$foto_infonavit = getimagesize($r_foto_infonavit[0]);
			$w_foto_infonavit = $foto_infonavit[0];
			$h_foto_infonavit = $foto_infonavit[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(160, $y);
			$this->Write(10, utf8_encode('CARTA DE LIBERACIÓN INFONAVIT'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_infonavit > $h_foto_infonavit) {
				$h_foto_infonavit = $h_foto_infonavit * 488 / $w_foto_infonavit;
				$w_foto_infonavit = 488;
				$this->Image($r_foto_infonavit[0], 62, $this->GetY(), $w_foto_infonavit, $h_foto_infonavit, $r_foto_infonavit[1]);
			} else {
				$w_foto_infonavit = $w_foto_infonavit * 560 / $h_foto_infonavit;
				$h_foto_infonavit = 560;
				$this->Image($r_foto_infonavit[0], (612 - $w_foto_infonavit) / 2, $this->GetY(), $w_foto_infonavit, $h_foto_infonavit, $r_foto_infonavit[1]);
				
			}
		}
		

	}

	public function setFotoAvisoPrivacidad($r_foto_aviso_privacidad){
		if ($r_foto_aviso_privacidad) {
			$foto_aviso_privacidad = getimagesize($r_foto_aviso_privacidad[0]);
			$w_foto_aviso_privacidad = $foto_aviso_privacidad[0];
			$h_foto_aviso_privacidad = $foto_aviso_privacidad[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(160, $y);
			$this->Write(10, utf8_encode('AVISO DE PRIVACIDAD'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_aviso_privacidad > $h_foto_aviso_privacidad) {
				$h_foto_aviso_privacidad = $h_foto_aviso_privacidad * 488 / $w_foto_aviso_privacidad;
				$w_foto_aviso_privacidad = 488;
				$this->Image($r_foto_aviso_privacidad[0], 62, $this->GetY(), $w_foto_aviso_privacidad, $h_foto_aviso_privacidad, $r_foto_aviso_privacidad[1]);
			} else {
				$w_foto_aviso_privacidad = $w_foto_aviso_privacidad * 560 / $h_foto_aviso_privacidad;
				$h_foto_aviso_privacidad = 560;
				$this->Image($r_foto_aviso_privacidad[0], (612 - $w_foto_aviso_privacidad) / 2, $this->GetY(), $w_foto_aviso_privacidad, $h_foto_aviso_privacidad, $r_foto_aviso_privacidad[1]);
				
			}
		}
		

	}

	public function setFotoCartaVD($r_foto_carta_vd){
		if ($r_foto_carta_vd) {
			$foto_carta_vd = getimagesize($r_foto_carta_vd[0]);
			$w_foto_carta_vd = $foto_carta_vd[0];
			$h_foto_carta_vd = $foto_carta_vd[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(160, $y);
			$this->Write(10, utf8_encode('CARTA DE VISITA DOMICILIARIA'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_carta_vd > $h_foto_carta_vd) {
				$h_foto_carta_vd = $h_foto_carta_vd * 488 / $w_foto_carta_vd;
				$w_foto_carta_vd = 488;
				$this->Image($r_foto_carta_vd[0], 62, $this->GetY(), $w_foto_carta_vd, $h_foto_carta_vd, $r_foto_carta_vd[1]);
			} else {
				$w_foto_carta_vd = $w_foto_carta_vd * 560 / $h_foto_carta_vd;
				$h_foto_carta_vd = 560;
				$this->Image($r_foto_carta_vd[0], (612 - $w_foto_carta_vd) / 2, $this->GetY(), $w_foto_carta_vd, $h_foto_carta_vd, $r_foto_carta_vd[1]);
				
			}
		}
		

	}

	public function setFotoBuroCredito($r_foto_buro_credito){
		if ($r_foto_buro_credito) {
			$foto_buro_credito = getimagesize($r_foto_buro_credito[0]);
			$w_foto_buro_credito = $foto_buro_credito[0];
			$h_foto_buro_credito = $foto_buro_credito[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(200, $y);
			$this->Write(10, utf8_encode('BURÓ DE CRÉDITO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_buro_credito > $h_foto_buro_credito) {
				$h_foto_buro_credito = $h_foto_buro_credito * 488 / $w_foto_buro_credito;
				$w_foto_buro_credito = 488;
				$this->Image($r_foto_buro_credito[0], 62, $this->GetY(), $w_foto_buro_credito, $h_foto_buro_credito, $r_foto_buro_credito[1]);
			} else {
				$w_foto_buro_credito = $w_foto_buro_credito * 560 / $h_foto_buro_credito;
				$h_foto_buro_credito = 560;
				$this->Image($r_foto_buro_credito[0], (612 - $w_foto_buro_credito) / 2, $this->GetY(), $w_foto_buro_credito, $h_foto_buro_credito, $r_foto_buro_credito[1]);
				
			}
		}
		

	}

	function header(){
		 if ($this->tieneHeader) {
			if ($this->seccionHeader == 1) {
				$y = 30;
				$this->SetFillColor(51, 54, 79);
				$this->Rect(10, $y, 444, 20, 'F');
				$this->SetFont('Sinkinsans','B', 11);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(30, $y);
				$this->Write(10, utf8_encode('INFORMACIÓN ACERCA DEL CANDIDATO'));

			}elseif ($this->seccionHeader == 3){
				$y = 30;
				$this->SetFillColor(244, 134, 30);
				$this->Rect(10, $y, 444, 20, 'F');
				$this->SetFont('Sinkinsans','B', 10);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(20, $y);
				$this->Write(10, utf8_encode('INFORMACIÓN ACERCA DE LA ECONOMÍA Y PATRIMONIO FAMILIAR'));
			}elseif ($this->seccionHeader == 5){
				$y = 30;
				$this->SetFillColor(215, 67, 150);
				$this->Rect(10, $y, 444, 20, 'F');
				$this->SetFont('Sinkinsans','B', 10);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(20, $y);
				$this->Write(10, utf8_encode('EVIDENCIAS DOCUMENTALES'));
			}else{
				$this->SetFont('Sinkinsans','', 13);
				$this->SetTextColor(140, 140, 140);
				$y = 33;
				$this->setXY(27, $y);
				$this->Write(10, $this->nombre);
				$this->sety(100);
			}
			$this->Image('dist/img/imagotipo-colores-3.png', 465, 28, 123, 0);
			$this->SetFillColor(239, 246, 248);
			$this->Rect(10, 72, 592, 680, 'F');
		}
	}

	/* function Footer(){
		$this->SetY(-55);
		$this->SetFillColor(51, 54, 79);
		$this->Rect(0, 737, 612, 55, 'F');
		$this->Image('dist/img/RRHHIngenia-Website2020_LogoFooter.png', 40, 754, 111);
	} */
}
