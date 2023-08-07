<?php

class ResultadoRAL extends FPDF
{

	public $nombre;

	public function setExpediente($expediente){
		$this->AddPage();
		$y = 85;

		$this->SetFillColor(240, 240, 240);
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(0, 0, 0);
		$y += 6;
		$this->setXY(25, $y);
		$this->MultiCell(562, 20, utf8_encode($expediente->Actor.' | '.$expediente->Demandado.' | Expediente '.$expediente->Toca), 1, 'L', true);
		
		$x = 25;
		$y = $this->GetY() + 25;

		$this->setFont('SinkinSans', '', 8);
		$this->SetTextColor(78, 82, 105);
		$this->setXY(25, $y);
		$this->MultiCell(487, 20, utf8_encode($expediente->Estado.' > '.$expediente->Ciudad.' > '.$expediente->Juzgado), 0, 'L', false);

		$y = $this->GetY();

		$this->SetFillColor(23, 55, 94);
		$this->setXY($x, $y);
		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(75, 20, utf8_encode('Actor'), 1, 'L', true);

		$this->setFont('SinkinSans', '', 7.5);
		$this->SetTextColor(78, 82, 105);
		$this->setXY(100, $y);
		$this->MultiCell(487, 20, utf8_encode($expediente->Actor), 1, 'L', false);

		$y = $this->GetY();

		$this->setXY($x, $y);
		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(75, 20, utf8_encode('Demandado'), 1, 'L', true);

		$this->setFont('SinkinSans', '', 7);
		$this->SetTextColor(78, 82, 105);
		$this->setXY(100, $y);
		$this->MultiCell(487, 20, utf8_encode($expediente->Demandado), 1, 'L', false);

		$y = $this->GetY();
		
		$this->setXY($x, $y);
		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(75, 20, utf8_encode('Tipo'), 1, 'L', true);

		$this->setFont('SinkinSans', '', 7.5);
		$this->SetTextColor(78, 82, 105);
		$this->setXY(100, $y);
		$this->MultiCell(487, 20, utf8_encode($expediente->Tipo), 1, 'L', false);

		$y = $this->GetY() + 18;

		$this->setXY(25, $y);
		$this->MultiCell(562, 15, utf8_encode('RESUMEN: El expediente '.$expediente->Toca.' '.$expediente->Tipo.' fue promovido por '.$expediente->Actor.' en contra de '.$expediente->Demandado.' en el '.$expediente->Juzgado.' en '.$expediente->Ciudad.', '.$expediente->Estado.'. El proceso inició el '.$expediente->Fecha.' y cuenta con '.count($expediente->acuerdos).' notificaciones.'), 0, 'L', false);
	}

	public function setAcuerdos($expediente){
		$x = 25;
		$y = $this->GetY() + 25;
		$this->SetFillColor(23, 55, 94);
		$this->setXY($x, $y);
		$this->setFont('SinkinSans', 'B', 9);
		$this->setTextColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(562, 30, utf8_encode('Notificaciones del Expediente '.$expediente->Toca), 1, 'L', true);

		$x = 40;
		
		$acuerdos = $expediente->acuerdos;

		foreach ($acuerdos as $acuerdo) { 
			if ($this->GetY() >= 650) {
				$this->AddPage();
				$y = 100;
			}else
				$y = $this->GetY() + 20;

			$this->SetFillColor(240, 240, 240);
			
			$this->setFont('SinkinSans', 'B', 8);
			$this->setTextColor(40, 40, 40);
			$this->SetXY($x, $y);
			$this->MultiCell(532, 22, utf8_encode($acuerdo['Fecha']), 0, 'L', true);

			$y = $this->GetY();

			$this->setFont('SinkinSans', '', 7.5);
			$this->setXY($x, $y);
			$this->MultiCell(532, 18, utf8_encode($acuerdo['Acuerdo']), 0, 'L', true);
			
			
		}
	}

	function header(){
		$this->SetFillColor(23, 55, 94);
		$this->Rect(0, 0, 612, 72, 'F');
		$this->SetFont('Sinkinsans','', 13);
		$this->SetTextColor(255, 255, 255);
		$y = 33;
		$this->Image('dist/img/imagotipo-blanco.png', 221, 18, 170, 0);
		//$this->setXY(280, $y);
		//$this->Write(10, $this->nombre);
		$this->SetY(100);
	}

	function Footer(){
		$this->SetXY(25, 770);
		$this->SetFont('Sinkinsans','', 7);
		$this->SetTextColor(78, 82, 105);
		$this->Cell(0, 5 , ('Todos los datos arrojados en este reporte derivan de fuentes gubernamentales y por lo tanto, se trata de información pública.'), 0, 0,'L');
		$this->SetFont('Sinkinsans','', 4);
		$this->SetTextColor(130, 130, 130);
		$this->SetXY(555, 770);
		$this->Cell(0, 5 ,('Página '.$this->PageNo().' de {nb}'), 0, 0,'L');
	}
}
