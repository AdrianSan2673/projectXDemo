<?php

class puestoDocumento  extends FPDF
{
	public $title;
	public $y = 0;

	public function setDatosGenerales($position, $positionName, $supervisingText)
	{
		$y = 30;
		$x = 6;
		$this->AddPage();

		$this->setXY(25, $y);
		$this->SetFont('Sinkinsans', '', 10);
		$this->MultiCell(160, 8, utf8_encode('Descripción de Puesto'), 0, 'C', false);

		$this->SetY($y + 12);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('DATOS GENERALES'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 6);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);
		$y = $this->GetY();

		$this->setXY(10, $y);
		$this->MultiCell(47.5, $x, utf8_encode('Titulo del puesto:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(47.5, $x, utf8_encode($position->title), 1, 'C', true);
		$this->setXY(104, $y);
		$this->MultiCell(48, $x, utf8_encode('Fecha de última actualización:'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->MultiCell(48, $x, utf8_encode(Utils::getDate($position->modified_at)), 1, 'C', true);

		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(47.5, $x, utf8_encode('Puesto al que reporta:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(47.5, $x, utf8_encode($positionName), 1, 'C', true);
		$this->setXY(104, $y);
		$this->MultiCell(48, $x, utf8_encode('Departamento:'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->MultiCell(48, $x, utf8_encode($position->department), 1, 'C', true);
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(47.5, $x, utf8_encode('Puesto (s) que supervisa:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(143, $x, utf8_encode($supervisingText), 1, 'L', true);

		$this->SetY($y + 12);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('OBJETIVO DEL PUESTO'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 6);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(190, $x, utf8_encode(isset($position->objective)?$position->objective :'Sin Objetivos'), 1, 'L', true);

		$this->SetY($y + 18);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('AUTORIDAD'), 1, 'C', true);
		$this->setFont('SinkinSans', 'B', 6);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(190, $x, utf8_encode(isset($position->authority)?$position->authority :'Sin asignar'), 1, 'L', true);

	}

	function setResponsabilidades($responsabilityEspec)
	{
		$y = 86;
		$x = 9;
		$this->SetY($y + 35);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('RESPONSABILIDADES ESPECÍFICAS'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);

		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(80, $x, utf8_encode('Responsabilidades'), 1, 'C', true);
		$this->setXY(80, $y);
		$this->MultiCell(120, $x, utf8_encode('Actividades'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 6);

		if (isset($responsabilityEspec)==false) {
			$y = $this->GetY();
			$this->setXY(10, $y);
			$this->MultiCell(70, 20, utf8_encode(''), 1, 'L', true);

			$this->setXY(80, $y);
			$this->MultiCell(120, 5, utf8_encode(''), 1, 'L', true);
		}

		foreach ($responsabilityEspec as $resp) {
			$y = $this->GetY();
			$this->setXY(10, $y);
			$this->MultiCell(70, 5, utf8_encode($resp['responsability']), 0, 'L', true);

			$y1 = $this->GetY();

			$this->setXY(80, $y);
			$this->MultiCell(120, 5, utf8_encode($resp['activities']), 1, 'L', true);

			$y2 = $this->GetY();

			$y3 = $y2 > $y1 ? $y2 : $y1;
			$h = $y3 - $y;
			
			$this->SetXY(10, $y);
			$this->MultiCell(70, $h, '', 1, 'L', false);
		}



	}

	function setIndicadores($effectivenessIndicatiors)
	{
		$y = 150;
		$x = 9;
		$this->SetY($this->GetY() + 15);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('INDICADORES DE EFECTIVIDAD DEL PUESTO'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);

		$y = $this->GetY();
		$this->setFont('SinkinSans', 'B', 6);

		$inidciador = '';
		foreach ($effectivenessIndicatiors as $ef) {
			$inidciador .= $ef['indicator'] . "\n";
		}
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(190, 5, utf8_encode($inidciador), 1, 'L', true);
	}

	function setPerfil($position)
	{

		$this->AddPage();

		$y = 150;
		$x = 9;

		$this->GetY();
		$this->setXY(25, $this->GetY()-10);
		$this->SetFont('Sinkinsans', '', 10);
		$this->MultiCell(160, 8, utf8_encode('Perfil de Puesto'), 0, 'C', false);


		$this->SetY($this->GetY()+5);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('PERFIL'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);

		$y = $this->GetY();
		$this->setFont('SinkinSans', 'B', 6);

		$this->setFont('SinkinSans', 'B', 6);
		$this->setTextColor(0, 0, 0);
		$y = $this->GetY();
		$this->SetFillColor(255, 255, 255);

		$this->setXY(10, $y);
		$this->MultiCell(47.5, $x, utf8_encode('Escolaridad:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(47.5, $x, utf8_encode(isset($position->scholarship) ? $position->scholarship : ' Sin asignar'), 1, 'C', true);
		$this->setXY(104, $y);
		$this->MultiCell(48, $x, utf8_encode('Experiencia:'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->MultiCell(48, $x, utf8_encode(isset($position->experience) ? $position->experience : ' Sin asignar'), 1, 'C', true);

		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(47.5, $x, utf8_encode('Estudio Adicionales:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(47.5, $x, utf8_encode(isset($position->additional_studies) ? $position->additional_studies : ' Sin asignar'), 1, 'C', true);
		$this->setXY(104, $y);
		$this->MultiCell(48, $x, utf8_encode('Años de Experiencia:'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->MultiCell(48, $x, utf8_encode(isset($position->experience_years) ? $position->experience_years : ' Sin asignar'), 1, 'C', true);
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(47.5, $x, utf8_encode('Idioma:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(143, $x, utf8_encode(isset($position->language) ? $position->language : ' Sin asignar'), 1, 'C', true);
	}

	function setCompetencia($requiredKnowledgetex, $interpersonalSkillstex)
	{
		$y = 70;
		$x = 7;


		$this->SetY($y + 15);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('COMPETENCIA'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 6);
		$this->setTextColor(0, 0, 0);
		
		$y = $this->GetY();
		$this->SetFillColor(255, 255, 255);
		$this->setXY(10, $y);
		$this->MultiCell(70, $x, utf8_encode('Conocimientos requeridos por el puesto'), 0, 'L', true);
		$this->setXY(80, $y);
		$this->MultiCell(120, $x, utf8_encode($requiredKnowledgetex), 1, 'L', true);

		$y1 = $this->GetY();
		$h = $y1 - $y;

		$this->SetY($y);

		$this->MultiCell(70, $h, '', 1, 'L', false);
	
		$y = $y1;
		$this->setXY(10, $y);
		$this->MultiCell(70, $x, utf8_encode('Habilidades interpersonales'), 0, 'L', true);
		$this->setXY(80, $y);
		$this->MultiCell(120, $x, utf8_encode($interpersonalSkillstex), 1, 'L', true);

		$y1 = $this->GetY();
		$h = $y1 - $y;

		$this->SetY($y);

		$this->MultiCell(70, $h, '', 1, 'L', false);
	}


	function setPlanCarrera($employe_approved_by,$employe_reviewed_by,$positions_to_aspiretex)
	{
		$y = 70;
		$x = 7;

		//$y = $this->GetY()+50;
		$this->setY($this->GetY()+8);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 10, utf8_encode('PLAN DE CARRERA'), 1, 'C', true);
		
		$this->setFont('SinkinSans', 'B', 6);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);

		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(47.5, $x, utf8_encode('Puesto(s) a aspirar en la empresa:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(143, $x, utf8_encode($positions_to_aspiretex), 1, 'L', true);

		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(48, $x, utf8_encode('REVISADO POR:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(80, $x, utf8_encode($employe_reviewed_by), 1, 'L', true);
		$this->setXY(137, $y);
		$this->MultiCell(15, $x, utf8_encode('Firma'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->MultiCell(48, $x, utf8_encode(''), 1, 'L', true);
	

		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(47.5, $x, utf8_encode('APROBADO POR: '), 1, 'L', true);
		$this->setXY(57, $y);
		$this->MultiCell(143, $x, utf8_encode($employe_approved_by), 1, 'L', true);
		$this->setXY(137, $y);
		$this->MultiCell(15, $x, utf8_encode('Firma'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->MultiCell(48, $x, utf8_encode(''), 1, 'L', true);
	}
	function header()
	{
		$this->SetFillColor(79, 129, 188);
		$this->Rect(0, 0, 612, 30, 'F');
		$this->SetFont('Sinkinsans', '', 13);
		$this->SetTextColor(255, 255, 255);
		$y = 30;
		$this->Image('dist/img/imagotipo-blanco.png', 221, 18, 170, 0);
		//$this->setXY(280, $y);
		//$this->Write(10, $this->nombre);
		$this->SetY(40);
	}

	function Footer()
	{
		$this->SetXY(25, 770);
		$this->SetFont('Sinkinsans', '', 7);
		$this->SetTextColor(78, 82, 105);
		$this->Cell(0, 5, ('Todos los datos arrojados en este reporte derivan de fuentes gubernamentales y por lo tanto, se trata de información pública.'), 0, 0, 'L');
		$this->SetFont('Sinkinsans', '', 4);
		$this->SetTextColor(130, 130, 130);
		$this->SetXY(555, 770);
		$this->Cell(0, 5, ('Página ' . $this->PageNo() . ' de {nb}'), 0, 0, 'L');
	}
}
