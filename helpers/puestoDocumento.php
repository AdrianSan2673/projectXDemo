<?php
require_once 'libraries\fpdf\mc_table2.php';

class puestoDocumento  extends PDF_MC_Table
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
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(47.5, $x, utf8_encode($position->title), 1, 'C', true);
		$this->setXY(104, $y);
		$this->setFont('SinkinSans', 'B', 6);
		$this->MultiCell(48, $x, utf8_encode('Fecha de última actualización:'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(48, $x, utf8_encode(Utils::getDate($position->modified_at)), 1, 'C', true);

		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->setFont('SinkinSans', 'B', 6);
		$this->MultiCell(47.5, $x, utf8_encode('Puesto al que reporta:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(47.5, $x, utf8_encode($positionName), 1, 'C', true);
		$this->setXY(104, $y);
		$this->setFont('SinkinSans', 'B', 6);
		$this->MultiCell(48, $x, utf8_encode('Departamento:'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(48, $x, utf8_encode($position->department), 1, 'C', true);
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->setFont('SinkinSans', 'B', 6);
		$this->MultiCell(47.5, $x, utf8_encode('Puesto (s) que supervisa:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(143, $x, utf8_encode($supervisingText), 1, 'L', true);

		$this->SetY($y + 10);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('OBJETIVO DEL PUESTO'), 1, 'C', true);

		$this->setFont('SinkinSans', '', 6);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(190, $x, utf8_encode(isset($position->objective) ? $position->objective : 'Sin Objetivos'), 1, 'L', true);

		$this->SetY($y + 15);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('AUTORIDAD'), 1, 'C', true);
		$this->setFont('SinkinSans', '', 6);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(190, $x, utf8_encode(isset($position->authority) ? $position->authority : 'Sin asignar'), 1, 'L', true);
	}

	function setResponsabilidades($responsabilityEspec)
	{
		$y = $this->getY();
		$x = 9;
		$this->SetY($y + 5);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('RESPONSABILIDADES ESPECÍFICAS'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(0,0,0);
		$y = $this->getY();
		$this->setY($y);
		$this->MultiCell(70, 8, utf8_encode('Responsabilidades'), 1, 'C', false);
		$x = 80;
		$this->setY($y);
		$this->setX($x);
		$this->MultiCell(120, 8, utf8_encode('Actividades'), 1, 'C', false);

	
		$this->setTextColor(0, 0, 0);
		$this->SetWidths(array(70, 120));
		
		
		$this->setFont('SinkinSans', '', 6);
		for ($i = 0; $i < count($responsabilityEspec); $i++) {
			$this->Row(array(utf8_encode($responsabilityEspec[$i]['responsability']), utf8_encode($responsabilityEspec[$i]['activities'])));
		}
	}

	function setIndicadores($effectivenessIndicatiors)
	{
		$y = $this->getY();
		$x = 9;
		$this->SetY($y + 5);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('INDICADORES DE EFECTIVIDAD DEL PUESTO'), 1, 'C', true);

		$this->setFont('SinkinSans', '',6);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);
		$y = $this->GetY();
	

		$inidciador = '';
		foreach ($effectivenessIndicatiors as $ef) {
			$inidciador .= $ef['indicator'] . "\n";
		}
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(190, 5, utf8_encode($inidciador), 1, 'C', true);
	}

	function setPerfil($position)
	{

		$this->AddPage();

		$y = 150;
		$x = 9;

		$this->GetY();
		$this->setXY(25, $this->GetY() - 10);
		$this->SetFont('Sinkinsans', '', 10);
		$this->MultiCell(160, 8, utf8_encode('Perfil de Puesto'), 0, 'C', false);


		$this->SetY($this->GetY() + 5);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('PERFIL'), 1, 'C', true);

		$y = $this->GetY();
		$this->setFont('SinkinSans', '', 6);
		$this->setTextColor(0, 0, 0);

		$this->SetWidths(array(47, 47, 48, 48));
		$this->Row(array(
			"Escolaridad:", utf8_encode(isset($position->scholarship) ? $position->scholarship : ' Sin asignar'), "Experiencia:", utf8_encode(isset($position->experience) || $position->experience != '' ? $position->experience : ' Sin asignar')
		));

		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(47, $x, utf8_encode('Estudio Adicionales:'), 1, 'L', false);
		$this->setXY(57, $y);
		$this->MultiCell(47, $x, utf8_encode(isset($position->additional_studies) || $position->additional_studies!=''? $position->additional_studies : ' Sin asignar'), 1, 'C', false);
		$this->setXY(104, $y);
		$this->MultiCell(48, $x, utf8_encode('Años de Experiencia:'), 1, 'L', false);
		$this->setXY(152, $y);
		$this->MultiCell(48, $x, utf8_encode(isset($position->experience_years) ? $position->experience_years : ' Sin asignar'), 1, 'C', false);
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->MultiCell(47, $x, utf8_encode('Idioma:'), 1, 'L', false);
		$this->setXY(57, $y);
		$this->MultiCell(143, $x, utf8_encode(isset($position->language) ? $position->language : ' Sin asignar'), 1, 'C', false);
	}

	function setCompetencia($requiredKnowledgetex, $interpersonalSkillstex)
	{
		$y = $this->getY();
		$x = 7;


		$this->SetY($y + 5);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 8, utf8_encode('COMPETENCIA'), 1, 'C', true);

		$this->setFont('SinkinSans', '', 6);
		$this->setTextColor(0, 0, 0);

		$y = $this->GetY();
		$this->SetFillColor(255, 255, 255);
		$this->setXY(10, $y);
		$this->SetWidths(array(70, 120));
		$this->Row(array(" Conocimientos requeridos por el puesto",utf8_encode($requiredKnowledgetex)));
		$this->Row(array('Habilidades interpersonales', utf8_encode($interpersonalSkillstex)));
	}


	function setPlanCarrera($employe_approved_by, $employe_reviewed_by, $positions_to_aspiretex)
	{
		$y = $this->getY();
		$x = 7;

		//$y = $this->GetY()+50;
		$this->setY($y + 5);
		$this->setFont('SinkinSans', 'B', 10);
		$this->setTextColor(255, 255, 255);
		$this->SetFillColor(79, 129, 188);
		$this->MultiCell(190, 10, utf8_encode('PLAN DE CARRERA '), 1, 'C', true);

		$this->setFont('SinkinSans', '', 6);
		$this->setTextColor(0, 0, 0);
		$this->SetFillColor(255, 255, 255);

		if($positions_to_aspiretex){
		$this->SetWidths(array(47,143));
		$this->Row(array(utf8_encode('Puesto(s) a aspirar en la empresa:'),utf8_encode($positions_to_aspiretex)));
		}
		
		if($employe_reviewed_by){
		$y = $this->GetY();
		$this->setXY(10, $y);$this->setFont('SinkinSans', 'B', 6);
		$this->MultiCell(48, $x, utf8_encode('REVISADO POR:'), 1, 'L', true);
		$this->setXY(57, $y);
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(80, $x, utf8_encode($employe_reviewed_by), 1, 'L', true);
		$this->setXY(137, $y);
		$this->setFont('SinkinSans', 'B', 6);
		$this->MultiCell(15, $x, utf8_encode('Firma'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(48, $x, utf8_encode(''), 1, 'L', true);
		}

		if($employe_approved_by){
		$y = $this->GetY();
		$this->setXY(10, $y);
		$this->setFont('SinkinSans', 'B', 6);
		$this->MultiCell(47.5, $x, utf8_encode('APROBADO POR: '), 1, 'L', true);
		$this->setXY(57, $y);
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(143, $x, utf8_encode($employe_approved_by), 1, 'L', true);
		$this->setXY(137, $y);
		$this->setFont('SinkinSans', 'B', 6);
		$this->MultiCell(15, $x, utf8_encode('Firma'), 1, 'L', true);
		$this->setXY(152, $y);
		$this->setFont('SinkinSans', '', 6);
		$this->MultiCell(48, $x, utf8_encode(''), 1, 'L', true);
		}
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
/* 		$this->SetTextColor(255,0,0);
		$this->SetXY(15, 270);
		$this->SetFont('Sinkinsans', '', 7);
		$this->Cell(0, 5, ('Todos los datos arrojados en este reporte derivan de fuentes gubernamentales y por lo tanto, se trata de información pública.'), 0, 0, 'L');
		$this->SetFont('Sinkinsans', '', 4);
		$this->SetTextColor(130, 130, 130);
		$this->SetXY(555, 770);
		$this->Cell(0, 5, ('Página ' . $this->PageNo() . ' de {nb}'), 0, 0, 'L'); */
	}
}
