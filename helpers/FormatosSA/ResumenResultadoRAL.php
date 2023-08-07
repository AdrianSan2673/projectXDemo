<?php

class ResumenResultadoRAL extends FPDF
{

	public function setExpedientes($busqueda, $expedientes){
		$this->AddPage();
		$x = 25;
		$y = 85;

		$this->setFont('SinkinSans', 'B', 13);
		$this->SetTextColor(0, 0, 0);
		$this->setXY(25, $y);
		$this->MultiCell(487, 20, (utf8_encode('Búsqueda de RAL de '.$busqueda->Nombres.' '.$busqueda->Apellidos)), 0, 'L', false);
		
		foreach ($expedientes as $expediente) {
			if ($this->GetY() >= 540) {
				$this->AddPage();
				$y = 100;
			}else
				$y = $this->GetY() + 20;

			$this->SetFillColor(240, 240, 240);
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(0, 0, 0);
			$y += 6;
			$this->setXY(25, $y);
			$this->MultiCell(562, 20, utf8_encode($expediente['Actor'].' | '.$expediente['Demandado'].' | Expediente '.$expediente['Toca']), 1, 'L', true, $expediente['PDF_RAL']);
			
			$x = 25;
			$y = $this->GetY() + 5;

			$this->setFont('SinkinSans', '', 8);
			$this->SetTextColor(78, 82, 105);
			$this->setXY(25, $y);
			$this->MultiCell(487, 20, utf8_encode($expediente['Estado'].' > '.$expediente['Ciudad'].' > '.$expediente['Juzgado']), 0, 'L', false);

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
			$this->MultiCell(487, 20, utf8_encode($expediente['Actor']), 1, 'L', false);

			$y = $this->GetY();

			$this->setXY($x, $y);
			$this->setFont('SinkinSans', 'B', 8);
			$this->setTextColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(75, 20, utf8_encode('Demandado'), 1, 'L', true);

			$this->setFont('SinkinSans', '', 7);
			$this->SetTextColor(78, 82, 105);
			$this->setXY(100, $y);
			$this->MultiCell(487, 20, utf8_encode($expediente['Demandado']), 1, 'L', false);

			$y = $this->GetY();
			
			$this->setXY($x, $y);
			$this->setFont('SinkinSans', 'B', 8);
			$this->setTextColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(75, 20, utf8_encode('Tipo'), 1, 'L', true);

			$this->setFont('SinkinSans', '', 7.5);
			$this->SetTextColor(78, 82, 105);
			$this->setXY(100, $y);
			$this->MultiCell(487, 20, utf8_encode($expediente['Tipo']), 1, 'L', false);

			$y = $this->GetY() + 18;
			$this->setXY($x, $y);
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
