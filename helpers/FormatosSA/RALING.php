<?php

class RALING extends FPDF
{

	public $nombre;

	public function setDatosGenerales($ral){
		$this->AddPage();
		$y = 85;

		$this->SetFillColor(240, 240, 240);
		$this->Rect(25, $y, 562, 20, 'DF');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(0, 0, 0);
		$y += 6;
		$this->setXY(180, $y);
		$this->Write(10, 'LEGAL BACKGROUND REPORT');


		$this->setFont('SinkinSans', 'B', 8);
		$this->setTextColor(255, 255, 255);
		$x = 25;
		$y = $this->GetY() + 25;
		$this->SetFillColor(23, 55, 94);
		$this->setXY($x, $y);
		$this->MultiCell(63, 15, utf8_encode('Date'), 1, 'C', true);
		$this->setXY(88, $y);
		$this->MultiCell(63, 15, utf8_encode('Time'), 1, 'C', true);
		$this->setXY(151, $y);
		$this->MultiCell(189, 15, utf8_encode('Search criteria'), 1, 'C', true);
		$this->setXY(340, $y);
		$this->MultiCell(126, 15, utf8_encode('Type of search'), 1, 'C', true);
		$this->setXY(466, $y);
		$this->MultiCell(126, 15, utf8_encode('State or National'), 1, 'C', true);


		$y = $this->GetY();

		$this->setFont('SinkinSans', '', 7);
		$this->setTextColor(0, 0, 0); 
		$this->setXY($x, $y);
		$this->MultiCell(63, 15, utf8_encode(date('Y-m-d', strtotime($ral->Fecha))), 1, 'C', false);

		$this->setXY(88, $y);
		$this->MultiCell(63, 15, utf8_encode(date('G:i', strtotime($ral->Fecha)).' hrs'), 1, 'C', false);
		$this->setXY(151, $y);
		$this->MultiCell(189, 15, utf8_encode(strtoupper($this->nombre)), 1, 'C', false);

		$this->SetXY(340, $y);
		$this->MultiCell(126, 15, 'Exact', 1, 'C', false);
		$this->SetXY(466, $y);
		$this->MultiCell(126, 15, utf8_encode($ral->Estado), 1, 'C', false);

		
		if ($this->GetY() >= 715) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 10;
		}
		$this->SetY($y);
	}

	public function setResultados($resultados){
		if ($resultados) {
			if ($this->GetY() >= 400) {
				$this->AddPage();
				$y = 80;
			}else{
				$y = $this->GetY() + 25;
			}

			$this->SetFillColor(240, 240, 240);
			$this->Rect(100, $y, 412, 23, 'FD');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(0, 0, 0);
			$y += 6;
			$this->setXY(270, $y);
			$this->Write(14, 'RESULTADOS');

			$this->setFont('SinkinSans', 'B', 8);
			$this->setTextColor(0, 0, 0);
			$x = 100;
			$y = $this->GetY() + 17;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(206, 20, utf8_encode('Total number of lawsuits'), 1, 'L', false);

			$this->setFont('SinkinSans', '', 8);
			$this->setTextColor(0, 0, 0);
			$this->setXY(306, $y);
			$this->MultiCell(206, 20, utf8_encode($resultados->Demandas == 2 ? $resultados->Total_Demandas : 'No record'), 1, 'C', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY();
			}

			$this->setFont('SinkinSans', 'B', 8);
			$this->setTextColor(0, 0, 0);
			$this->SetXY($x, $y);
			$this->MultiCell(206, 20, utf8_encode('Total number of agreements'), 1, 'L', false);

			$this->setFont('SinkinSans', '', 8);
			$this->setTextColor(0, 0, 0);
			$this->setXY(306, $y);
			$this->MultiCell(206, 20, utf8_encode($resultados->Demandas == 2 ? $resultados->Total_Acuerdos : 'No record'), 1, 'C', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY();
			}

			$this->setFont('SinkinSans', 'B', 8);
			$this->setTextColor(0, 0, 0);
			$this->SetXY($x, $y);
			$this->MultiCell(206, 20, utf8_encode('Periods of located records'), 1, 'L');

			$this->setFont('SinkinSans', '', 8);
			$this->setTextColor(0, 0, 0);
			$this->setXY(306, $y);
			$this->MultiCell(206, 20, utf8_encode('1996 to present'), 1, 'C', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY();
			}

			$this->setFont('SinkinSans', 'B', 8);
			$this->setTextColor(0, 0, 0);
			$this->SetXY($x, $y);
			$this->MultiCell(206, 20, utf8_encode('Type of trial'), 1, 'L');

			$this->setFont('SinkinSans', '', 8);
			$this->setTextColor(0, 0, 0);
			$this->setXY(306, $y);
			$this->MultiCell(206, 20, utf8_encode($resultados->Demandas == 2 ? $resultados->Tipo_Juicio: 'No record'), 1, 'C', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY();
			}

		}	
	}


	public function setCapturas($r_capturas){
		foreach ($r_capturas as $captura) {
			//$captura = array("uploads/".md5(time().uniqid()).".jpg", "jpg");
			//if (file_put_contents($captura[0], $captura_file) !== false) {
				$foto_ral = getimagesize($captura[0]);
				if ($foto_ral[2] != 2)
					$captura[1] = 'png';
				else
					$captura[1] = 'jpg';

				$w_foto_ral = $foto_ral[0];
				$h_foto_ral = $foto_ral[1];

				if ($this->GetY() >= 400) {
					$this->AddPage();
					$y = 80;
				}else{
					$y = $this->GetY() + 5;
				}
				$this->SetY($y);
				$max_width = 562;
				$max_heigth = 300;
				$x = 25;

				if ($w_foto_ral > $h_foto_ral) {
					$h_foto_ral = $h_foto_ral * $max_width / $w_foto_ral;
					$w_foto_ral = $max_width;
					if ($h_foto_ral > $max_heigth) {
						$w_foto_ral = $w_foto_ral * $max_heigth / $h_foto_ral;
						$h_foto_ral = $max_heigth;
						$x = (612 - $w_foto_ral) / 2;
					}
					$this->Image($captura[0], $x, $this->GetY(), $w_foto_ral, $h_foto_ral, $captura[1]);
				} else {
					$w_foto_ral = $w_foto_ral * $max_heigth / $h_foto_ral;
					$h_foto_ral = $max_heigth;
					$x = (612 - $w_foto_ral) / 2;
					$this->Image($captura[0], $x, $this->GetY(), $w_foto_ral, $h_foto_ral, $captura[1]);
					
				}
				$y = $this->GetY() + $h_foto_ral + 10;
				$this->SetY($y);
			//}	
		}	
	}

	public function setMarcoLegal(){
		if ($this->GetY() >= 500) {
			$this->AddPage();
			$y = 80;
			$this->SetY($y);
		}elseif ($this->GetY() <= 100){
			$y = 80;
			$this->SetY($y);
		}else{
			$y = $this->GetY() + 20;
		}

		$this->SetFillColor(240, 240, 240);
		$this->Rect(50, $y, 512, 30, 'FD');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(0, 0, 0);
		$y += 6;
		$this->setXY(270, $y);
		$this->Write(20, utf8_encode('MARCO LEGAL'));

		$this->setFont('SinkinSans', 'B', 7);
		$this->setTextColor(140, 140, 140);
		$x = 50;
		$y = $this->GetY() + 24;
		$this->SetFillColor(255, 255, 255);
		
		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(0, 0, 0);
		$this->SetXY($x, $y);
		$this->MultiCell(512, 14, (utf8_encode("The information held by this website regarding lists of agreements or judicial bulletins comes from the daily Lists of Agreements or Judicial Bulletin issued by the Federal and Common Jurisdiction Judicial Power, Administrative Courts, and therefore the agreements issued for each of the files filed in the courts or tribunals (Art. 10 Frac. II of the LFPDPPP).

		The purpose of publishing this information is (Art. 16, Frac. II of the LFPDPPP):.
     a. For lawyers: To be informed in real-time, either by checking the website or through a specific notification (via email), of all the agreements that are issued in their cases, even if they are located in a different state than where the lawyer resides. This represents an important work tool that allows saving time, effort, and money without having to leave the office.
     b. Parties in lawsuits: To be aware of the progress of their case in real-time, either by checking the website or through a specific notification (via email). It also represents a way to supervise their lawyer's work to prevent fraud.
     c.Companies: To check if the person to hire or the candidate to grant credit to has been subject to a legal process, which will allow making a better decision.")), 1, 'L', true);
		
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
		$this->Cell(0, 5 , ('All the data provided in this report comes from government sources, and therefore, it is considered public information.'), 0, 0,'L');
		$this->SetFont('Sinkinsans','', 4);
		$this->SetTextColor(130, 130, 130);
		$this->SetXY(555, 770);
		$this->Cell(0, 5 ,('Página '.$this->PageNo().' de {nb}'), 0, 0,'L');
	}
}
