<?php

class Resume9 extends FPDF
{

	public function setAbout($candidato, $route){
		$y =  90;
		$xa = 20;
		$ya = 22;
		

		$this->SetFillColor(1,14, 111);
	
		$this->SetFillColor(210, 62, 62);
		$this->Rect(50,0, 80 , 120,'F');
		$this->Rect(0,140, 230 , 550,'F');
	
		$this->setFont('SinkinSans', 'B', 30 );
		$this->setTextColor(255,255,255);
		$this->SetXY(50,40);
		$this->Cell(70, 70, substr($candidato->first_name,0,1).''.substr($candidato->last_name,0,1), 0,0, 'C');


		$this->SetXY(70,70);
		$this->SetDrawColor(0,77, 102);
		
		$this->setFont('SinkinSans', 'B', 20);
		$this->setTextColor(210, 62, 62);
		$leng=strlen($candidato->first_name)+strlen($candidato->surname)+strlen($candidato->last_name);
		if ($leng>=30) {
			$y= 45;
		} if($leng<30){
			$y= 60;
		}
		$this->setXY(130, $y);
		$this->MultiCell(250, 20, utf8_decode(mb_strtoupper($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name)), 0,'C');
		
		$this->setFont('SinkinSans', '', 15) ; 
	 	$this->setXY(380, $y);
		$this->MultiCell(240, 20, utf8_decode(mb_strtoupper($candidato->job_title)), 0, 'C'); 
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			$this->setTextColor(255,255,255);
			$this->setFont('SinkinSans', 'B', 10);
			/* $y = $this->GetY() + 20; */
			$this->setXY(10,155);
			$this->Cell(60, 10, utf8_decode('RESUMEN PROFESIONAL'), 0,0, 'L');
			
			$this->setTextColor(255,255,255);
			$this->setFont('SinkinSans', '', 9);
			$y = $this->GetY() + 10;
			$this->setXY(10,170);
			$this->MultiCell(190, 15, utf8_decode($candidato->description), 0, 'J');
		}
		
			$this->setTextColor(25, 25, 25);
			$this->setFont('SinkinSans', 'B', 11);

			$this->setXY($xa+385, 60);
		
					
			$this->setTextColor(210, 62, 62);
			$this->setFont('SinkinSans', '', 7);
			
			if (!is_null($candidato->telephone) && !empty($candidato->telephone)) {
				
				$this->setXY(150, 10);
				$this->Image('dist/img/resume-icons/cv9/phone.png', 140, 10, 8);
				$this->Cell(60, 10, utf8_decode($candidato->telephone),0, 1, 'L');
			}
			
			if (!is_null($candidato->email) && !empty($candidato->email)) {
				
				$this->setXY(150, 30);
				$this->Image('dist/img/resume-icons/cv9/email3.png',140, 30, 8);
				$this->MultiCell(100, 10, utf8_decode($candidato->email),0, 'L');
			}

			if (!is_null($candidato->state) && !empty($candidato->state)) {
				
				$this->setXY(220, 10);
				$this->Image('dist/img/resume-icons/cv9/location3.png',210, 10, 8);
				$this->MultiCell(120, 10, utf8_decode($candidato->city.', '.$candidato->state),0, 'L');	
			}

			if (isset($candidato->linkedinn) && !is_null($candidato->linkedinn) && !empty($candidato->linkedinn)) {
				
				$this->setXY(260, 30);
				$this->Image('dist/img/resume-icons/cv9/linkedin.png', 250, 30, 8);
				//$this->Cell(80, 10, ($candidato->linkedinn), 0, 1, 'L');
				$this->MultiCell(110, 10, utf8_decode($candidato->linkedinn),0, 'L');
			}

			if (isset($candidato->facebook) && !is_null($candidato->facebook) && !empty($candidato->facebook)) {
				
				$this->setXY(350, 10);
				$this->Image('dist/img/resume-icons/cv9/facebook.png', 340, 10, 8);
				//$this->Cell(80, 10, ($candidato->description), 0, 1, 'L');	
				$this->MultiCell(140, 10, utf8_decode($candidato->facebook),0, 'L');
			}

			if (isset($candidato->instagram) && !is_null($candidato->instagram) && !empty($candidato->instagram)) {
				
				$this->setXY(380, 30);
				$this->Image('dist/img/resume-icons/cv9/instagram.png', 370, 30, 8);
				//$this->Cell(80, 10, ($candidato->instagram), 0, 1, 'L');
				$this->MultiCell(140, 10, utf8_decode($candidato->instagram),0, 'L');
			}

		$this->SetY(65);
	}


	public function setExperience($experiencia){
		setlocale(LC_TIME, "spanish");
		$this->setX(265);
		
		if (count($experiencia) > 0) {
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(210, 62, 62);

			$this->setY(155);
			$this->setX(245);
			$this->Write(12, 'EXPERIENCIA');

			$x = 245; 
			$y = 90;
			$this->SetXY($x, $y+80);
			$this->setTextColor(38, 48, 76);

			
			foreach ($experiencia as $exp) {
				$this->SetFont('Sinkinsans', 'BU', 8.5);
				$this->MultiCell(307, 15, utf8_decode($exp['position']), 0, 'L', false);
				
				$this->setFont('Sinkinsans', 'I', 8);
				$y = $this->GetY() + 8;
				$this->SetXY($x, $y);
				
				$this->MultiCell(307, 12, utf8_decode($exp['enterprise'].' | '.$exp['city'].' - '.$exp['state'].' | '.strftime("%B %Y", strtotime($exp['start_date'])).' - '. $end_date = ($exp['still_works'] == 1) ? 'Presente' : strftime("%B %Y", strtotime($exp['end_date']))), 0, 'L', false);
				
				$this->setFont('Sinkinsans', '', 8);
				$y = $this->GetY() + 5;
				$this->SetXY($x, $y);
				$this->Multicell(307, 12, utf8_decode($exp['review']),0, 'J', false);
				
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
				
				$y = $this->GetY() + 16;
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
			}else{
				$y = $this->GetY();
			}
			
			$this->SetFont('SinkinSans','B', 10);
			$this->SetTextColor(210, 62, 62);
			$y += 6;
			$this->setXY(245, $y-20);
			$this->Write(10, 'EDUCACION');

			$x = 245; 
			$y = $this->GetY() + 25;
			$y2 = $y;
			$y3 = $y;
			$w = 190;
			$h = 12;

			$this->SetXY($x, $y-10);
			$this->setTextColor(38, 48, 76);
			$this->SetFont('SinkinSans', '', 8);
			$this->MultiCell($w, $h, utf8_decode($candidato->title), 0, 'L', false);

			$this->setTextColor(38, 48, 76);
			$this->setFont('SinkinSans', 'BI', 7);
			$y = $this->GetY() + 4;
			$this->SetXY($x, $y);
			$this->MultiCell($w, $h, utf8_decode($candidato->level), 0, 'L', false);

			$this->setFont('SinkinSans', 'I', 7);
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
			if ($this->GetY()  >= 606) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() + 30;
			}
			
			$this->SetFont('SinkinSans','B', 10);
			$this->SetTextColor(210, 62, 62);
			$y += 6;
			$this->setXY(245, $y-10);
			$this->Write(10, 'FORMACION ADICIONAL');

			$x = 245; 
			$y = $this->GetY() + 15;
			$y1 = $y;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$yMax = $y1;
			foreach ($preparations as $value => $ap) {
				if (($value % 2 == 0 || $x >= 473) && $value > 0) {
					$x = 245;
					$y1 = $yMax + 15;
					if ($y1 >= 660) {
						$this->AddPage();
						$y1 = 57;
						$yMax = $y1;
					}
				}elseif($value > 0){
					$x += 105;
					
				}

			
				$this->setTextColor(38, 48, 76);
				$this->SetFont('SinkinSans', '', 8);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_decode($ap['course']), 0, 'L', false);	
				
				$this->setTextColor(38, 48, 76);
				$this->setFont('SinkinSans', 'I',7);
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

	public function setLanguages($languages,$candidato){
		if (count($languages) > 0) {
			
			$this->SetFont('SinkinSans','B', 11);
			$this->SetTextColor(255, 255, 255);

			if (!is_null($candidato->description) && !empty($candidato->description)) {
				if (strlen($candidato->description) <= 200) {
					$this->setY(290);
				}elseif (strlen($candidato->description) > 200 && strlen($candidato->description) < 300) {
					$this->setY(310);
				}else{
					$this->setY(380);
				}
			}
			
			
			$this->setX(10);
			$this->Write(10, 'IDIOMAS');

			$x = 15; 
			$y = $this->GetY() + 15;
			$y1 = $y;
			$w = 105;
			$h = 16;
			$this->SetXY($x, $y);
			$yMax = $this->GetY();
			foreach ($languages as $value => $lang) {
				if (($value % 2 == 0 || $x >= 473) && $value > 0) {
					$x = 15;
					$y1 = $yMax + 10 ;
				}elseif($value > 0){
					$x += 105;
				}
					
				
				$this->setTextColor(255, 255, 255);
				$this->SetFont('SinkinSans', '', 8.5);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_decode($lang['language'].': '.$lang['language_level']), 0, 'L', false);	
				
				$this->setTextColor(255, 255, 255);
				$this->SetFont('SinkinSans', 'I', 8);
				$this->SetXY($x, $this->GetY() - 2);
				$this->MultiCell($w, $h, utf8_decode($lang['institution']), 0, 'L', false);

				$this->SetXY($x, $this->GetY() - 2);
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
			if ($this->GetY() -10 >= 706) {
				$y = 730;
			}else{
				$y = $this->GetY() ;
			}
			
			$this->SetFont('SinkinSans','B', 10);
			$this->SetTextColor(255,255,255);
			
			$this->setXY(10, $y+15);
			$this->Write(10, 'APTITUDES');

			$x = 10; 
			$y = $this->GetY();
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$this->setTextColor(255,255,255);
			$this->SetFont('SinkinSans', '', 9);
			$yMax = $this->GetY();
			foreach ($aptitudes as $value => $apt) {
				
				if ($value % 2 == 0 || $x >= 473) {
					$x = 10;
					$y = $yMax +15;
				}else{
					$x += 105;
				}
							
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, utf8_decode($apt['aptitude']), 0, 'L', false);
				$ln = 0;
			/* 	for ($i=1; $i <=10 ; $i++) {
					if ($i <= $apt['level']) {
						$this->Image('dist/img/resume-icons/cv9/circleB.png', $x + $ln, $this->GetY() + 8, 8);
					} else {
						$this->Image('dist/img/resume-icons/cv9/circleemptyB.png', $x + $ln, $this->GetY() + 8, 8);
					}
					$ln += 9.5;
				} */
				$yMax = $this->GetY() + 4;
				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY() + 4;

				
				}
				
			}	
	
		}
		
	}

	function Footer(){
	}
}
