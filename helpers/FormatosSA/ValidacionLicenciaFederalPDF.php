<?php

class ValidacionLicenciaFederalPDF extends FPDF
{

	public $nombre;

	public function setDatosGenerales($vlf, $r_foto){
		$this->AddPage();
		$y = 85;

		$this->SetFillColor(240, 240, 240);
		$this->Rect(25, $y, 562, 20, 'DF');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(0, 0, 0);
		$y += 6;
		$this->setXY(180, $y);
		if ($vlf->Tipo_Licencia == 1)
			$this->Write(10, utf8_encode('VALIDACIÓN DE LICENCIA FEDERAL'));

		if ($vlf->Tipo_Licencia == 2)
			$this->Write(10, utf8_encode('VALIDACIÓN DE LICENCIA ESTATAL'));
		

		if ($r_foto) {
			$foto = getimagesize($r_foto[0]);
			if ($foto[2] != 2)
				$r_foto[1] = 'png';
			else
				$r_foto[1] = 'jpg';
			$w_foto = $foto[0];
			$h_foto = $foto[1];

			$y = $this->GetY() + 25;
			$this->setY($y);

			if ($w_foto > $h_foto) {
				$h_foto = $h_foto * 150 / $w_foto;
				$w_foto = 150;
				$this->Image($r_foto[0], 62, $this->GetY(), $w_foto, $h_foto, $r_foto[1]);
			} else {
				$w_foto = $w_foto * 160 / $h_foto;
				$h_foto = 160;
				$this->Image($r_foto[0], (612 - $w_foto) / 2, $this->GetY(), $w_foto, $h_foto, $r_foto[1]);
				
			}
			$y = $this->GetY() + $h_foto;
			$this->SetY($y);
		}


		$this->setFont('SinkinSans', 'B', 9);
		$this->setTextColor(255, 255, 255);
		$x = 25;
		$y = $this->GetY() + 25;
		$this->SetFillColor(157, 199, 58);
		$this->setXY($x, $y);
		$this->MultiCell(562, 15, utf8_encode('Nombre del Conductor'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(0, 0, 0);
		$y = $this->GetY();
		$this->setXY($x, $y);
		$this->MultiCell(562, 15, ($this->nombre), 1, 'C', false);

		$this->setFont('SinkinSans', 'B', 9);
		$this->setTextColor(255, 255, 255);
		$y = $this->GetY() + 25;
		$this->SetFillColor(157, 199, 58);
		$this->setXY($x, $y);
		$this->MultiCell(562, 15, utf8_encode('Licencia'), 1, 'C', true);

		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(255, 255, 255);
		$y = $this->GetY();
		$this->SetFillColor(177, 194, 126);
		$this->setXY($x, $y);
		$this->MultiCell(140, 15, utf8_encode('Número'), 1, 'C', true);
		$this->setXY(165, $y);
		$this->MultiCell(140, 15, utf8_encode('Categoría'), 1, 'C', true);
		$this->setXY(305, $y);
		$this->MultiCell(140, 15, utf8_encode('Vigente del'), 1, 'C', true);
		$this->setXY(445, $y);
		$this->MultiCell(142, 15, utf8_encode('Hasta'), 1, 'C', true);


		$y = $this->GetY();

		$this->setFont('SinkinSans', '', 7);
		$this->setTextColor(0, 0, 0); 
		$this->setXY($x, $y);
		$this->MultiCell(140, 15, utf8_encode($vlf->Numero_Licencia), 1, 'C', false);

		$this->setXY(165, $y);
		$this->MultiCell(140, 15, substr(($vlf->CategoriaA == 1 ? 'A, ' : '').($vlf->CategoriaB == 1 ? 'B, ' : '').($vlf->CategoriaC == 1 ? 'C, ' : '').($vlf->CategoriaD == 1 ? 'D, ' : '').($vlf->CategoriaE == 1 ? 'E, ' : '').($vlf->CategoriaF == 1 ? 'F, ' : ''), 0, -2), 1, 'C', false);
		$this->setXY(305, $y);
		$this->MultiCell(140, 15, utf8_encode($vlf->Licencia_Vigente_Del), 1, 'C', false);

		$this->SetXY(445, $y);
		$this->MultiCell(142, 15, utf8_encode($vlf->Licencia_Vigente_Hasta), 1, 'C', false);

		$y = $this->GetY() + 25;
		
		if ($vlf->Tipo_Licencia == 1) {
				///////////
			$this->setFont('SinkinSans', 'B', 9);
			$this->setTextColor(255, 255, 255);
			
			$this->SetFillColor(157, 199, 58);
			$this->setXY($x, $y);
			$this->MultiCell(562, 15, utf8_encode('Exámen Médico'), 1, 'C', true);

			$this->setFont('SinkinSans', 'B', 8);
			$this->setTextColor(255, 255, 255);
			$y = $this->GetY();
			$this->SetFillColor(177, 194, 126);
			$this->setXY($x, $y);
			$this->MultiCell(112, 15, utf8_encode('Número'), 1, 'C', true);
			$this->setXY(137, $y);
			$this->MultiCell(112, 15, utf8_encode('Tipo'), 1, 'C', true);
			$this->setXY(249, $y);
			$this->MultiCell(112, 15, utf8_encode('Resultado'), 1, 'C', true);
			$this->setXY(361, $y);
			$this->MultiCell(112, 15, utf8_encode('Fecha de Dictamen'), 1, 'C', true);
			$this->setXY(473, $y);
			$this->MultiCell(114, 15, utf8_encode('Vigente hasta'), 1, 'C', true);

			$y = $this->GetY();

			$this->setFont('SinkinSans', '', 7);
			$this->setTextColor(0, 0, 0); 
			
			$this->setXY($x, $y);
			$this->MultiCell(112, 45, '', 1, 'C', false);

			$this->setXY(137, $y);
			$this->MultiCell(112, 45, '', 1, 'C', false);
			$this->setXY(249, $y);
			$this->MultiCell(112, 45, '', 1, 'C', false);

			$this->SetXY(361, $y);
			$this->MultiCell(112, 45, '', 1, 'C', false);
			$this->SetXY(473, $y);
			$this->MultiCell(114, 45, '', 1, 'C', false);

			////////
			$y += 3;

			$this->setXY($x, $y);
			$this->MultiCell(112, 12, utf8_encode($vlf->Numero_Examen), 0, 'C', false);

			$this->setXY(137, $y);
			$this->MultiCell(112, 12, utf8_encode($vlf->Tipo_Examen), 0, 'C', false);
			$this->setXY(249, $y);
			$this->MultiCell(112, 12, utf8_encode($vlf->Resultado_Examen), 0, 'C', false);

			$this->SetXY(361, $y);
			$this->MultiCell(112, 12, utf8_encode($vlf->Fecha_Dictamen_Examen), 0, 'C', false);
			$this->SetXY(473, $y);
			$this->MultiCell(114, 12, utf8_encode($vlf->Vigente_Hasta_Examen), 0, 'C', false);

			$y = $this->GetY() + 58;
		}
		
		$this->setFont('SinkinSans', 'B', 9);
		$this->setTextColor(255, 255, 255);
		
		$this->SetFillColor(157, 199, 58);
		$this->setXY($x, $y);
		$this->MultiCell(562, 15, utf8_encode('Características'), 1, 'C', true);

		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(0, 0, 0);
		$y = $this->GetY();
		$this->setXY($x, $y);
		$this->MultiCell(562, 60, '', 1, 'L', false);
		$y += 3;
		$this->SetXY($x, $y);

		$this->MultiCell(562, 12, utf8_encode($vlf->Caracteristicas), 0, 'L', false);


		$this->setFont('SinkinSans', 'B', 9);
		$this->setTextColor(255, 255, 255);
		$y = $this->GetY() + 73;
		$this->SetFillColor(157, 199, 58);
		$this->setXY($x, $y);
		$this->MultiCell(562, 15, utf8_encode('Resultado'), 1, 'C', true);

		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(0, 0, 0);
		$y = $this->GetY();
		$this->setXY($x, $y);
		$this->MultiCell(562, 60, '', 1, 'L', false);
		$y += 3;
		$this->SetXY($x, $y);

		$this->MultiCell(562, 12, utf8_encode($vlf->Resultado), 0, 'L', false);		

	}

	function header(){
		$this->SetFillColor(157, 199, 58);
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
