<?php

class Resume18 extends FPDF
{
	public function setAbout($candidato, $route){
		$y = 20;
		$xa = 20;
		$ya = 22;
		
		
		$this->SetFillColor(64, 64, 64);
		$this->Rect(0, 0, 650, 800, 'F');
		
		
		$this->SetFillColor(7, 155, 182);
		$this->Rect(35, 0,150, 110, 'F');


		$this->setTextColor(38, 48, 76);

		$this->SetFillColor(255,255, 255);

		
		$this->Rect(225,0, 400, 800, 'F');

		$this->SetDrawColor(7, 155, 182);
		$this->SetLineWidth(3);
		
		$this->SetLineWidth(5);
		
		$this->ClippingCircle(110,95,75,75,false);
		$this->Image($route, 30, 10, 160,160);
		$this->UnsetClipping();

		$this->SetLineWidth(1);
	
		$this->setFont('NotoSans-Bold', 'B', 18);
		$this->setTextColor(7, 160, 189);
		$leng=strlen($candidato->first_name)+strlen($candidato->surname)+strlen($candidato->last_name);
		if ($leng>=30) {
			$y= 10;
		} if($leng<30){
			$y= 25;
		}
		$this->setXY(230, $y);
		$this->MultiCell(350, 15, utf8_decode(mb_strtoupper($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name)),0,'C');
		
		$this->setFont('NotoSans-Regular', '', 12);
		$y = $this->GetY() + 8;
		$this->setXY(230, $y);
		$this->MultiCell(350, 12, utf8_decode(mb_strtoupper($candidato->job_title)),0, 'C');
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			$this->setTextColor(25, 25, 25);
			$this->setFont('NotoSans-Bold', 'B', 11);
			/* $y = $this->GetY() + 20; */
			$this->setXY($xa+215,75);
			$this->Cell(60, 10, utf8_decode('RESUMEN PROFESIONAL'), 0,0, 'L');

			$this->setTextColor(38, 48, 76);
			$this->setFont('NotoSans-Regular', '', 10);
			$y = $this->GetY() + 15;
			$this->setXY($xa+215,$y);
			$this->MultiCell(350, 12.5, utf8_decode($candidato->description), 0, 'J');
		}
		

			$this->setTextColor(255, 255, 255);
			$this->setFont('NotoSans-Bold', 'B', 11);
			$this->setXY($xa+2,190);
			$this->Cell(60, 10, 'CONTACTO', 0, 1, 'L');
			
			
			$this->setTextColor(255, 255, 255);
			$this->setFont('NotoSans-Regular', '', 8);
			
			if (!is_null($candidato->telephone) && !empty($candidato->telephone)) {
				$y = $this->GetY() + 5;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv18/phoneInv.png', $xa+5, $y, 8);
				$this->Cell(80, 10, utf8_decode($candidato->telephone), 0, 1, 'L');
			}
			
			if (!is_null($candidato->email) && !empty($candidato->email)) {
				$y += 15;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv18/emailInv.png', $xa+5, $y, 8);
				$this->MultiCell(140, 10, utf8_decode($candidato->email), 0, 'L');
			}

			if (!is_null($candidato->state) && !empty($candidato->state)) {
				$y = $this->GetY() + 8;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv18/locationInv.png', $xa+5, $y, 8);
				$this->MultiCell(160, 10, utf8_decode($candidato->city.', '.$candidato->state),0, 'L');	
			}

			if (isset($candidato->linkedinn) && !is_null($candidato->linkedinn) && !empty($candidato->linkedinn)) {
				$leng=strlen($candidato->city)+strlen($candidato->state);
				if ($leng>=40) {
					$y += 25;
				} if($leng<40){
					$y += 15;
				}
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv18/linkedinInv.png', $xa+5, $y, 8);
				//$this->Cell(80, 10, ($candidato->linkedinn), 0, 1, 'L');
				$this->MultiCell(140, 10, utf8_decode($candidato->linkedinn),0, 'L');
			}

			if (isset($candidato->facebook) && !is_null($candidato->facebook) && !empty($candidato->facebook)) {
				$y = $this->GetY() + 8;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv18/facebookInv.png', $xa+5, $y, 8);
				//$this->Cell(80, 10, ($candidato->description), 0, 1, 'L');	
				$this->MultiCell(140, 10, utf8_decode($candidato->facebook),0, 'L');
			}

			if (isset($candidato->instagram) && !is_null($candidato->instagram) && !empty($candidato->instagram)) {
				$y = $this->GetY() + 8;
				$this->setXY($xa+15, $y);
				$this->Image('dist/img/resume-icons/cv18/instagramInv.png', $xa+5, $y, 8);
				//$this->Cell(80, 10, ($candidato->instagram), 0, 1, 'L');
				$this->MultiCell(140, 10, utf8_decode($candidato->instagram),0, 'L');
			}

		$this->SetY(65);
	}

	public function setExperience($experiencia,$candidato){
		setlocale(LC_TIME, "spanish");
		$this->setX(265);
		
		if (count($experiencia) > 0) {

			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			if (strlen($candidato->description) <= 200) {
				$this->setY(130);
			}elseif (strlen($candidato->description) > 200 && strlen($candidato->description) <= 350) {
				$this->setY(155);
			}else{
				$this->setY(175);
			}

			$this->setX(235);
			$this->Write(12, 'EXPERIENCIA');

			$x = 235; 
			$y = $this->getY()+10;
			$this->SetXY($x, $y);
			$this->setTextColor(38, 48, 76);

			foreach ($experiencia as $exp) {
				$this->SetFont('NotoSans-Bold', 'BU', 8.5);
				$this->MultiCell(307, 15, utf8_decode($exp['position']), 0, 'L', false);
				
				$this->setFont('NotoSans-Italic', 'I', 8);
				$y = $this->GetY() + 2;
				$this->SetXY($x, $y);
				$this->MultiCell(307, 12, utf8_decode($exp['enterprise'].' | '.$exp['city'].' - '.$exp['state'].' | '.strftime("%B %Y", strtotime($exp['start_date'])).' - '. $end_date = ($exp['still_works'] == 1) ? 'Presente' : strftime("%B %Y", strtotime($exp['end_date']))), 0, 'L', false);
				
				$this->setFont('NotoSans-Regular', '', 8);
				$y = $this->GetY() + 2;
				$this->SetXY($x, $y);
				$this->Multicell(307, 12, utf8_decode($exp['review']), 0, 'L', false);
				
				$y = $this->GetY() + 3;
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
				$this->Rect(0, $y-55, 225, 800, 'F');
			}else{
				$y = $this->GetY();
			}
			/* $this->SetFillColor(1,14, 111);
			$this->Rect(254, $y, 358, 20, 'F'); */
			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$y += 6;
			$this->setXY(235, $y-15);
			$this->Write(10, 'EDUCACION');

			$x = 235; 
			$y = $this->GetY() + 25;
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
			}
			
			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$y += 6;
			$this->setXY(235, $y-25);
			$this->Write(10, 'FORMACION ADICIONAL');

			$x = 235; 
			$y = $this->GetY() + 15;
			$y1 = $y;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$yMax = $y1;
			foreach ($preparations as $value => $ap) {
				if (($value % 3 == 0 || $x >= 473) && $value > 0) {
					$x = 235;
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
			$this->SetTextColor(255, 255, 255);
			/* $y += 6; */
			$this->setXY(20,320);
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
					
				$this->setTextColor(255, 255, 255);
				$this->SetFont('NotoSans-Regular', '', 8.5);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_decode($lang['language'].' / '.$lang['language_level']), 0, 'L', false);	
				
				$this->setTextColor(255, 255, 255);
				$this->SetFont('NotoSans-Italic', 'I', 8);
				$this->SetXY($x, $this->GetY()- 2);
				$this->MultiCell($w, $h, utf8_decode($lang['institution']), 0, 'L', false);

				$this->SetXY($x, $this->GetY()- 2);
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
			
/* 			$this->SetFillColor(1,14, 111);
			$this->Rect(20, $y, 200, 20, 'F'); */
			$this->SetFont('NotoSans-Bold','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(20, $y-35);
			$this->Write(10, 'APTITUDES');

			$x = 20; 
			$y = $this->GetY() +10;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			
			$this->setTextColor(255, 255, 255);
			$this->SetFont('NotoSans-Regular', '',10);
			$yMax = $this->GetY();
			foreach ($aptitudes as $value => $apt) {
				
				if ($value % 1 == 0 || $x >= 473) {
					$x = 20;
					$y = $yMax + 10;
				}else{
					$x += 105;
				}
							
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, utf8_decode('º '.$apt['aptitude']), 0, 'L', false);
				$ln = 0;

				if ($this->GetY() > $yMax) {
					$yMax = $this->GetY();
				}
			}
		}
		
	}

	function Footer(){
		
	}
}
