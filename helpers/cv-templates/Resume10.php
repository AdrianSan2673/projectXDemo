<?php

class Resume10 extends FPDF
{


	public function setAbout($candidato, $route){
		$y = 20;
		$xa = 20;
		$ya = 22;
		$this->SetFillColor(204,205, 215);

		$this->setTextColor(38, 48, 76);

		$this->SetFillColor(255,255, 255);
	
		$this->Image($route, 20, 15, 80, 100);

		$this->SetFillColor(153, 134, 115);
		$this->Rect(20,130,600,30,'F');
		$this->Rect(20,240,600,30,'F');

		$this->setFont('NotoSans-Bold', 'B', 22);
		$this->setTextColor(1,1,1);
		$leng=strlen($candidato->first_name)+strlen($candidato->surname)+strlen($candidato->last_name);
		if ($leng>=30) {
			$y= 20;
		} if($leng<30){
			$y= 40;
		}
		$this->setXY(100, $y);
		$this->MultiCell(350, 25, utf8_decode(mb_strtoupper($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name)), 0,'C');
		
		$this->setFont('NotoSans-Regular', '', 15);
		$y = $this->getY()+5;
		$this->setXY(100, $y);
		$this->MultiCell(350, 12, utf8_decode(mb_strtoupper($candidato->job_title)), 0, 'C');
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			$this->setTextColor(255, 255, 255);
			$this->setFont('NotoSans-Bold', 'B', 14);
			$this->setXY($xa,130);
			$this->Cell(600,30, utf8_decode('RESUMEN PROFESIONAL'), 1,0, 'C');
			
			$this->setTextColor(38, 48, 76);
			$this->setFont('NotoSans-Regular', '', 10);
			$y = $this->GetY() + 30;
			$this->setXY($xa,$y);
			$this->MultiCell(590, 15, utf8_decode($candidato->description), 0, 'J');
		}
				
			$this->setTextColor(38, 48, 76);
			$this->setFont('NotoSans-Regular', '', 8);
			$xa= 450;
			$y= 20;
			if (!is_null($candidato->telephone) && !empty($candidato->telephone)) {
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv10/phone.png', $xa+5, $y, 8);
				$this->Cell(50, 10, utf8_decode($candidato->telephone), 0, 1, 'L');
			}
			
			if (!is_null($candidato->email) && !empty($candidato->email)) {
				$y += 15;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv10/email3.png', $xa+5, $y, 8);
				$this->MultiCell(140, 10, utf8_decode($candidato->email), 0, 'L');
			}

			if (!is_null($candidato->state) && !empty($candidato->state)) {
				$y = $this->GetY() + 8;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv10/location3.png', $xa+5, $y, 8);
				$this->MultiCell(140, 10, utf8_decode($candidato->city.', '.$candidato->state), 0, 'L');	
			}

			if (isset($candidato->linkedinn) && !is_null($candidato->linkedinn) && !empty($candidato->linkedinn)) {
				$location=strlen($candidato->state)+strlen($candidato->city);
				if ($location<=30) {
					$y += 15;
				} else{
					$y += 25;
				}
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv10/linkedin.png', $xa+5, $y, 8);
				$this->MultiCell(140, 10, utf8_decode($candidato->linkedinn), 0, 'L');
			}
		
			if (isset($candidato->facebook) && !is_null($candidato->facebook) && !empty($candidato->facebook)) {
				$y = $this->GetY() + 8;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv10/facebook.png', $xa+5, $y, 8);
				$this->MultiCell(140, 10, utf8_decode($candidato->facebook), 0, 'L');
			}

			if (isset($candidato->instagram) && !is_null($candidato->instagram) && !empty($candidato->instagram)) {
				$y = $this->GetY() + 8;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv10/instagram.png', $xa+5, $y, 8);
				$this->MultiCell(140, 10, utf8_decode($candidato->instagram), 0, 'L');
			}

		$this->SetY(65);
	}

	public function setExperience($experiencia){
		setlocale(LC_TIME, "spanish");
		$this->setX(265);

		if (count($experiencia) > 0) {			
			$this->SetFont('NotoSans-Bold','B', 14);
			$this->SetTextColor(255,255,255);

			$this->setY(240);
			$this->setX(20);
			$this->Cell(600,30, utf8_decode('EXPERIENCIA'), 1,0, 'C');

		$x = 20; 
		$y = $this->GetY() + 35;
		$y1 = $y;
		$this->SetXY($x, $y);
		$yMax = $y1;

		foreach ($experiencia as $value => $exp) {
			if (($value % 2 == 0 || $x >= 400) && $value > 0) {
				$x = 20;
				$y1 = $yMax + 10;
			}elseif($value > 0){
				$x += 300;
			}
	
			$this->SetXY($x, $y1);
			$this->setTextColor(38, 48, 76);
		 {
			
				$this->SetFont('NotoSans-Bold', 'BU', 9);
				$this->MultiCell(307, 15, utf8_decode($exp['position']), 0, 'L', false);
				
				$this->setFont('NotoSans-Italic', 'I', 9);
				$y = $this->GetY() + 8;
				$this->SetXY($x, $y);
				
				$this->MultiCell(307, 12, utf8_decode($exp['enterprise'].' | '.$exp['city'].' - '.$exp['state'].' | '.strftime("%B %Y", strtotime($exp['start_date'])).' - '. $end_date = ($exp['still_works'] == 1) ? 'Presente' : strftime("%B %Y", strtotime($exp['end_date']))), 0, 'L', false);
				
				$this->setFont('NotoSans-Regular', '', 9);
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
				
				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY();
				}

			}

				$this->setY($yMax);
			

		}
	}

	

}

public function setAdditionalPreparation($preparations){
	if (count($preparations) > 0) {
		if ($this->GetY() - 10 >= 606) {
			$this->AddPage();
			$y = 57;
			$this->SetFillColor(153, 134, 115);
			$this->Rect(20,$y+7,600,30,'F');
		
		}else{
			$y = $this->GetY();
			$this->SetFillColor(153, 134, 115);
			$this->Rect(20,$y+7,600,30,'F');
		
		}
		$this->SetFont('NotoSans-Bold','B', 14);
		$this->SetTextColor(255,255,255);
		$y += 6;
		$this->setXY(20, $y);
		$this->Cell(600,30, utf8_decode('FORMACION ADICIONAL'), 1,0, 'C');

		$x = 20; 
		$y = $this->GetY() + 45;
		$y1 = $y;
		$w = 95;
		$h = 12;
		$this->SetXY($x, $y);
		$yMax = $y1;
		foreach ($preparations as $value => $ap) {
			if (($value % 6 == 0 || $x >= 473) && $value > 0) {
				$x = 20;
				$y1 = $yMax + 5;
				if ($y1 >= 680) {
					$this->AddPage();
					$y1 = 57;
					$yMax = $y1;
					
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


			if ($this->GetY() + 4 > $yMax) {
				$yMax = $this->GetY() + 4;
			}

		}
		$this->setY($yMax);
	}

}
	public function setEducation($candidato){
		if (!is_null($candidato->level) && !empty($candidato->level)) {
			if ($this->GetY() - 10 >= 570) {
				$this->AddPage();
				$y = 57;
				$this->SetFillColor(153, 134, 115);
				$this->Rect(20,$y+20,600,30,'F');
			}else{
				$y = $this->GetY();
				$this->SetFillColor(153, 134, 115);
				$this->Rect(20,$y+20,600,30,'F');
			}
			/* $this->SetFillColor(1,14, 111);
			$this->Rect(254, $y, 358, 20, 'F'); */
			$this->SetFont('NotoSans-Bold','B', 14);
			$this->SetTextColor(255,255,255);
			$y += 6;
			$this->setXY(20, $y+15);
			$this->Cell(600,30, utf8_decode('EDUCACION'), 1,0, 'C');

			$x = 20; 
			$y = $this->GetY() + 50;
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



	public function setLanguages($languages){
		if (count($languages) > 0) {
			if ($this->GetY() - 10 >= 606) {
				$this->AddPage();
				$y = 60;
				$this->SetFillColor(153, 134, 115);
				$this->Rect(20,$y+15,600,30,'F');
			}else{
				$y = $this->GetY() + 40;
				$this->SetFillColor(153, 134, 115);
				$this->Rect(20,$y-20,600,30,'F');
			}
			
			$this->SetFont('NotoSans-Bold','B', 14);
			$this->SetTextColor(255,255,255);
			/* $y += 6; */
			$y= $this->getY();
			$this->setXY(20,$y+20);
			$this->Cell(600,30, utf8_decode('IDIOMAS'), 1,0, 'C');

			$x = 20; 
			$y = $this->GetY() + 50;
			$y1 = $y;
			$w = 95;
			$h = 16;
			$this->SetXY($x, $y);
			$yMax = $this->GetY();
			foreach ($languages as $value => $lang) {
				if (($value % 6 == 0 || $x >= 473) && $value > 0) {
					$x = 20;
					$y1 = $yMax + 5;
				}elseif($value > 0){
					$x += 105;
				}
					
				
				$this->setTextColor(38, 48, 76);
				$this->SetFont('NotoSans-Regular', '', 9.5);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_decode($lang['language'].' / '.$lang['language_level']), 0, 'L', false);	
				
				$this->setTextColor(38, 48, 76);
				$this->SetFont('NotoSans-Italic', 'I', 9);
				$this->SetXY($x, $this->GetY() + 4);
				$this->MultiCell($w, $h, utf8_decode($lang['institution']), 0, 'L', false);

				$this->SetXY($x, $this->GetY() + 4);
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
			$this->SetFillColor(153, 134, 115);
			$this->Rect(20,$y-20,600,30,'F');
			}else{
				$y = $this->GetY() + 40;
				$this->SetFillColor(153, 134, 115);
				$this->Rect(20,$y-20,600,30,'F');
			}

			$this->SetFont('NotoSans-Bold','B', 14);
			$this->SetTextColor(255,255,255);
			$y += 6;
			$this->setXY(20, $y-26);
			$this->Cell(600,30, utf8_decode('APTITUDES'), 1,0, 'C');

			$x = 20; 
			$y = $this->GetY() +30;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			
			$this->setTextColor(38, 48, 76);
			$this->SetFont('NotoSans-Regular', '', 10);
			$yMax = $this->GetY();
			foreach ($aptitudes as $value => $apt) {
				
				if ($value % 6 == 0 || $x >= 473) {
					$x = 20;
					$y = $yMax + 30;
				}else{
					$x += 105;
				}
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, utf8_decode('º '.$apt['aptitude']), 0, 'L', false);
				
				if ($this->GetY() > $yMax) {
					$yMax = $this->GetY();
				}
				
			}
		}
		
	}

	function Footer(){
	
	}
}
