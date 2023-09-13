<?php

class Resume11 extends FPDF
{


	public function setAbout($candidato, $route){
		$y = 180;
		$xa = 20;
		$ya = 22;
		$this->SetFillColor(204,205, 215);
		$this->Rect(0,0, 240, 800, 'F');
		
		$this->setTextColor(38, 48, 76);

		$this->SetFillColor(41, 148, 164);
		$this->Rect(215,40,170,20, 'F');
								
		$this->Image($route, 40, 15, 140, 160);
	
		$this->setFont('NotoSans-Bold', 'B', 13);
		$this->setTextColor(1,1,1);
		$this->setXY(0, $y);
		$this->MultiCell(230, 15, utf8_decode(strtoupper($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name)), 0,'C');
		
		$this->setFont('NotoSans-Regular', '', 12);
		$y = $this->GetY() + 5;
		$this->setXY(20, $y);
		$this->MultiCell(192, 12, utf8_decode(strtoupper($candidato->job_title)), 0, 'C');
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			$this->setTextColor(25, 25, 25);
			$this->setFont('NotoSans-Bold', 'B', 11);
			$this->setXY(215,40);
			$this->Cell(170, 20, utf8_decode('RESUMEN PROFESIONAL'), 1,0, 'R');
			
			$this->setTextColor(38, 48, 76);
			$this->setFont('NotoSans-Regular', '', 10);
			$y = $this->GetY() + 30;
			$this->setXY(245,$y);
			$this->MultiCell(350, 11.5, utf8_decode($candidato->description), 0, 'J');
		}
	
			$this->setTextColor(25, 25, 25);
			$this->setFont('NotoSans-Bold', 'B', 11);

			$this->setXY($xa+2, 250);
			$this->Cell(60, 10, 'CONTACTO', 0, 1, 'L');
			
			$this->setTextColor(38, 48, 76);
			$this->setFont('NotoSans-Regular', '', 8);
			
			if (!is_null($candidato->telephone) && !empty($candidato->telephone)) {
				$y = $this->GetY() + 5;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv11/phone.png', $xa+5, $y, 8);
				$this->Cell(60, 10, utf8_decode($candidato->telephone), 0, 1, 'L');
			}
			
			if (!is_null($candidato->email) && !empty($candidato->email)) {
				$y += 15;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv11/email3.png', $xa+5, $y, 8);
				$this->MultiCell(170, 10, utf8_decode($candidato->email), 0, 'L');
			}

			if (!is_null($candidato->state) && !empty($candidato->state)) {
				$y = $this->GetY() + 6;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv11/location3.png', $xa+5, $y, 8);
				$this->MultiCell(170, 10, utf8_decode($candidato->city.', '.$candidato->state), 0, 'L');	
			}

			if (isset($candidato->linkedinn) && !is_null($candidato->linkedinn) && !empty($candidato->linkedinn)) {
				$location=strlen($candidato->state)+strlen($candidato->city);
				if ($location<=30) {
					$y += 15;
				} else{
					$y += 25;
				}
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv11/linkedin.png', $xa+5, $y, 8);
				//$this->Cell(80, 10, ($candidato->linkedinn), 0, 1, 'L');
				$this->MultiCell(170, 10, utf8_decode($candidato->linkedinn), 0, 'L');
			}

			if (isset($candidato->facebook) && !is_null($candidato->facebook) && !empty($candidato->facebook)) {
				$y = $this->GetY() + 6;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv11/facebook.png', $xa+5, $y, 8);
				//$this->Cell(80, 10, ($candidato->description), 0, 1, 'L');	
				$this->MultiCell(170, 10, utf8_decode($candidato->facebook), 0, 'L');
			}

			if (isset($candidato->instagram) && !is_null($candidato->instagram) && !empty($candidato->instagram)) {
				$y = $this->GetY() + 6;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv11/instagram.png', $xa+5, $y, 8);
				//$this->Cell(80, 10, ($candidato->instagram), 0, 1, 'L');
				$this->MultiCell(170, 10, utf8_decode($candidato->instagram), 0, 'L');
			}

		$this->SetY(65);
	}

	public function setExperience($experiencia){
		setlocale(LC_TIME, "spanish");
		$this->setX(265);
		
		if (count($experiencia) > 0) {
		$this->SetFillColor(41, 148, 164);
		$this->Rect(215,145,170,20, 'F');
			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(0,0,0);

			$y = $this->getY()+80;
			$this->setXY(215,$y);

			$this->Cell(170, 20, utf8_decode('EXPERIENCIA'), 1,0, 'R');

			
			$x = 245; 
			$y = 150;
			$this->SetXY($x, $y+25);
			$this->setTextColor(38, 48, 76);

			
			foreach ($experiencia as $exp) {
				$this->SetFont('NotoSans-Bold', 'BU', 8.5);
				$this->MultiCell(307, 15, utf8_decode($exp['position']), 0, 'L', false);
				
				$this->setFont('NotoSans-Italic', 'I', 8);
				$y = $this->GetY() + 4;
				$this->SetXY($x, $y);
				
				$this->MultiCell(307, 12, utf8_decode($exp['enterprise'].' | '.$exp['city'].' - '.$exp['state'].' | '.strftime("%B %Y", strtotime($exp['start_date'])).' - '. $end_date = ($exp['still_works'] == 1) ? 'Presente' : strftime("%B %Y", strtotime($exp['end_date']))), 0, 'L', false);
				
				$this->setFont('NotoSans-Regular', '', 8);
				$y = $this->GetY() + 5;
				$this->SetXY($x, $y);
				$this->Multicell(307, 12, utf8_decode($exp['review']), 0, 'L', false);
				
				$y = $this->GetY() + 8;
				if (!is_null($exp['activity1']) && !empty($exp['activity1'])) {
					$this->SetXY($x+10, $y);
					$this->Multicell(307, 12, utf8_decode('º  '.$exp['activity1']), 0, 'L', false);
					$y = $this->GetY() + 1;
				}
				if (!is_null($exp['activity2']) && !empty($exp['activity2'])) {
					$this->SetXY($x+10, $y);
					$this->Multicell(307, 12, utf8_decode('º  '.$exp['activity2']), 0, 'L', false);
					$y = $this->GetY() + 1;	
				}
				if (!is_null($exp['activity3']) && !empty($exp['activity3'])) {
					$this->SetXY($x+10, $y);
					$this->Multicell(307, 12, utf8_decode('º  '.$exp['activity3']), 0, 'L', false);
					$y = $this->GetY() + 1;
				}
				if (!is_null($exp['activity4']) && !empty($exp['activity4'])) {
					$this->SetXY($x+10, $y);
					$this->Multicell(307, 12, utf8_decode('º  '.$exp['activity4']), 0, 'L', false);	
				}
				
				$y = $this->GetY() + 8;
				$this->SetXY($x, $y);
				
			}
			$this->setY($y + 10);
		}
	}

	public function setEducation($candidato){
		if (!is_null($candidato->level) && !empty($candidato->level)) {
			if ($this->GetY() - 10 >= 570) {
				$this->AddPage();
				$y = 57;
				$this->SetFillColor(204,205, 215);
				$this->Rect(215, $y, 225, 800, 'F');
			}else{
				$y = $this->GetY();
				$this->SetFillColor(41, 148, 164);
				$this->Rect(215,$y,170,20, 'F');
			}
			/* $this->SetFillColor(1,14, 111);
			$this->Rect(254, $y, 358, 20, 'F'); */
			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$y += 6;
			$this->setXY(215, $y-6);
			$this->Cell(170, 20, utf8_decode('EDUCACION'), 1,0, 'R');

			$x = 245; 
			$y = $this->GetY() + 45;
			$y2 = $y;
			$y3 = $y;
			$w = 190;
			$h = 12;

			$this->SetXY($x, $y-10);
			$this->setTextColor(38, 48, 76);
			$this->SetFont('NotoSans-Regular', '', 8.5);
			$this->MultiCell($w, $h, utf8_decode($candidato->title), 0, 'L', false);

			$this->setTextColor(38, 48, 76);
			$this->setFont('NotoSans-BoldItalic', 'BI', 8);
			$y = $this->GetY() + 4;
			$this->SetXY($x, $y);
			$this->MultiCell($w, $h, utf8_decode($candidato->level), 0, 'L', false);

			$this->setFont('NotoSans-Italic', 'I', 8);
			$y = $this->GetY() + 4;
			$this->SetXY($x, $y);
			$this->MultiCell($w, $h, utf8_decode($candidato->institution), 0, 'L', false);

			if ($candidato->start_date != NULL) {
				$y = $this->GetY() + 4;
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, strftime("%Y", strtotime($candidato->start_date)).' - '. $end_date = ($candidato->still_studies == 1) ? 'Presente' : strftime("%Y", strtotime($candidato->end_date)), 0, 'L', false);
				$this->setY($y + 10);
			}
			
		}
	
	}

	public function setAdditionalPreparation($preparations){
		if (count($preparations) > 0) {
			if ($this->GetY() - 10 >= 606) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() + 30;
				$this->SetFillColor(41, 148, 164);
				$this->Rect(215,$y,170,20, 'F');
			}
			
			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$y += 6;
			$this->setXY(215, $y-6);
			$this->Cell(170, 20, utf8_decode('FORMACION ADICIONAL'), 1,0, 'R');

			$x = 245; 
			$y = $this->GetY() + 35;
			$y1 = $y;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$yMax = $y1;
			foreach ($preparations as $value => $ap) {
				if (($value % 4== 0 || $x >= 473) && $value > 0) {
					$x = 245;
					$y1 = $yMax + 5;
					if ($y1 >= 660) {
						$this->AddPage();
						$y1 = 57;
						$yMax = $y1;
						$this->SetFillColor(204,205, 215);
						$this->Rect(0, $y1-55, 225, 800, 'F');
					}
				}elseif($value > 0){
					$x += 90;
					
				}
				
				$this->setTextColor(38, 48, 76);
				$this->SetFont('NotoSans-Regular', '', 8.5);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_decode($ap['course']), 0, 'L', false);	
				
				$this->setTextColor(38, 48, 76);
				$this->setFont('NotoSans-Italic', 'I', 8);
				$this->SetXY($x, $this->GetY() + 4);
				$this->MultiCell($w, $h, utf8_decode($ap['institution']), 0, 'L', false);

				$this->SetXY($x, $this->GetY() + 4);
				$this->MultiCell($w, $h, date("Y", strtotime($ap['start_date'])).' - '.date("Y", strtotime($ap['end_date'])), 0, 'L', false);


				//$yMax = $this->GetY() + 4;

				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY() + 4;
				}

			}
			$this->setY($yMax);
		}
		
	}

	public function setLanguages($languages){
		if (count($languages) > 0) {
		
			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			/* $y += 6; */
			$this->setXY(20,375);
			$this->Write(10, 'IDIOMAS');

			$x = 20; 
			$y = $this->GetY() + 15;
			$y1 = $y;
			$w = 95;
			$h = 16;
			$this->SetXY($x, $y);
			$yMax = $this->GetY();
			foreach ($languages as $value => $lang) {
				if (($value % 2 == 0 || $x >= 473) && $value > 0) {
					$x = 20;
					$y1 = $yMax + 5;
				}elseif($value > 0){
					$x += 105;
				}

				$this->setTextColor(38, 48, 76);
				$this->SetFont('NotoSans-Regular', '', 8.5);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_decode($lang['language'].': '.$lang['language_level']), 0, 'L', false);	
				
				$this->setTextColor(38, 48, 76);
				$this->SetFont('NotoSans-Italic', 'I', 8);
				$this->SetXY($x, $this->GetY() -3);
				$this->MultiCell($w, $h, utf8_decode($lang['institution']), 0, 'L', false);

				$this->SetXY($x, $this->GetY() -3);
				$this->MultiCell($w, $h, date("Y", strtotime($lang['start_date'])).' - '.date("Y", strtotime($lang['end_date'])), 0, 'L', false);


				$yMax = $this->GetY() + 4;

				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY() + 4;
				}

			}
		}
		
	}

	public function setAptitude($aptitudes){

		if (count($aptitudes) > 0) {
			if ($this->GetY() - 10 >= 606) {
				$this->AddPage();
				$y = 60;
			}else{
				$y = $this->GetY() + 40;
			}
			
			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$y += 6;
			$this->setXY(20, $y-35);
			$this->Write(10, 'APTITUDES');

			$x = 20; 
			$y = $this->GetY() - 15;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			
			$this->setTextColor(38, 48, 76);
			$this->SetFont('NotoSans-Regular', '', 9);
			$yMax = $this->GetY();
			foreach ($aptitudes as $value => $apt) {
				
				if ($value % 1 == 0 || $x >= 473) {
					$x = 20;
					$y = $yMax + 30;
				}else{
					$x += 105;
				}
							
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, utf8_decode($apt['aptitude']), 0, 'L', false);
				$ln = 0;
				for ($i=1; $i <=10 ; $i++) {
					if ($i <= $apt['level']) {
						$this->Image('dist/img/resume-icons/cv11/bsquareB.png', $x + $ln, $this->GetY() + 8, 8);
					} else {
						$this->Image('dist/img/resume-icons/cv11/wsquareB.png', $x + $ln, $this->GetY() + 8, 8);
					}
					$ln += 9.5;
				}

				if ($this->GetY() > $yMax) {
					$yMax = $this->GetY();
				}
			}
		}
		
	}

	function Footer(){
		/* $this->SetY(-55);
		$this->SetFillColor(51, 54, 79);
		$this->Rect(0, 737, 612, 55, 'F');
		 */
	}
}
