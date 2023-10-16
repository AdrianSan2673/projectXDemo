<?php

class Resume extends FPDF
{

	public function setAbout($candidato, $route){
		$this->SetFillColor(244, 249, 252);
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			if (strlen($candidato->description) <= 300) {
				$this->Rect(42, 57, 204, 511, 'F');
			}elseif (strlen($candidato->description) > 300 && strlen($candidato->description) < 400) {
				$this->Rect(42, 57, 204, 590, 'F');
			}else{
				$this->Rect(42, 57, 204, 670, 'F');
			}
		}else{
			$this->Rect(42, 57, 204, 511, 'F');
		}
		
		$this->Rect(42, 57, 204, 511, 'F');
		$this->setTextColor(38, 48, 76);

		$this->ClippingCircle(147, 138, 63, false);
		$this->Image($route, 84, 75, 126, 126);
		$this->UnsetClipping();

		$y = 220;

		$this->setFont('SinkinSans', 'B', 12);
		$this->setXY(48, $y);
		$this->MultiCell(192, 12, utf8_encode($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name), 0,'C');
		
		$this->setFont('SinkinSansLight', '', 9);
		$y = $this->GetY() + 8;
		$this->setXY(48, $y);
		$this->MultiCell(192, 12, utf8_encode(strtoupper($candidato->job_title)), 0, 'C');
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			$this->setTextColor(150, 150, 150);
			$this->setFont('SinkinSans', 'BU', 11);
			$y = $this->GetY() + 20;
			$this->setXY(57, $y);
			$this->Cell(60, 10, 'ACERCA DE MÍ', 0, 1, 'L');
			
			$this->setTextColor(38, 48, 76);
			$this->setFont('SinkinSans', '', 7.5);
			$y = $this->GetY() + 10;
			$this->setXY(57, $y);
			$this->MultiCell(178, 14, utf8_encode($candidato->description), 0, 'L');
		}
		

		if(!Utils::isCustomer()){
			$this->setTextColor(150, 150, 150);
			$this->setFont('SinkinSans', 'BU', 11);
			$y = $this->GetY() + 20;
			$this->setXY(57, $y);
			$this->Cell(60, 10, 'CONTACTO', 0, 1, 'L');
			
			
			$this->setTextColor(38, 48, 76);
			$this->setFont('SinkinSans', '', 7);
			
			if (!is_null($candidato->telephone) && !empty($candidato->telephone)) {
				$y = $this->GetY() + 10;
				$this->setXY(71, $y);
				$this->Image('dist/img/resume-icons/phone.png', 58, $y, 8);
				$this->Cell(80, 10, utf8_encode($candidato->telephone), 0, 1, 'L');
			}
			
			if (!is_null($candidato->email) && !empty($candidato->email)) {
				$y += 15;
				$this->setXY(71, $y);
				$this->Image('dist/img/resume-icons/mail.png', 58, $y, 8);
				$this->MultiCell(140, 10, utf8_encode($candidato->email), 0, 'L');
			}

			if (!is_null($candidato->state) && !empty($candidato->state)) {
				$y = $this->GetY() + 8;
				$this->setXY(71, $y);
				$this->Image('dist/img/resume-icons/location.png', 58, $y, 8);
				$this->Cell(80, 10, ($candidato->city.', '.$candidato->state), 0, 1, 'L');	
			}

			if (!is_null($candidato->linkedinn) && !empty($candidato->linkedinn)) {
				$y += 15;
				$this->setXY(71, $y);
				$this->Image('dist/img/resume-icons/linkedin.png', 58, $y, 8);
				//$this->Cell(80, 10, ($candidato->linkedinn), 0, 1, 'L');
				$this->MultiCell(140, 10, utf8_encode($candidato->linkedinn), 0, 'L');
			}

			if (!is_null($candidato->facebook) && !empty($candidato->facebook)) {
				$y = $this->GetY() + 8;
				$this->setXY(71, $y);
				$this->Image('dist/img/resume-icons/facebook.png', 58, $y, 8);
				//$this->Cell(80, 10, ($candidato->facebook), 0, 1, 'L');	
				$this->MultiCell(140, 10, utf8_encode($candidato->facebook), 0, 'L');
			}

			if (!is_null($candidato->instagram) && !empty($candidato->instagram)) {
				$y = $this->GetY() + 8;
				$this->setXY(71, $y);
				$this->Image('dist/img/resume-icons/instagram.png', 58, $y, 8);
				//$this->Cell(80, 10, ($candidato->instagram), 0, 1, 'L');
				$this->MultiCell(140, 10, utf8_encode($candidato->instagram), 0, 'L');
			}
		}
		$this->SetY(65);
	}

	public function setExperience($experiences){
		$this->setX(265);
		if (count($experiences) > 0) {
			$this->SetFillColor(140, 200, 40);
			$this->Rect(254, 60, 358, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			
			$this->Write(12, 'EXPERIENCIA');

			$x = 263; 
			$y = 90;
			$this->SetXY($x, $y);
			$this->setTextColor(38, 48, 76);
			foreach ($experiences as $exp) {
				$this->SetFont('Sinkinsans', 'BU', 8.5);
				$this->MultiCell(307, 15, utf8_encode($exp['position']), 0, 'L', false);
				
				$this->setFont('Sinkinsans', 'I', 8);
				$y = $this->GetY() + 8;
				$this->SetXY($x, $y);
				
				$this->MultiCell(307, 12, utf8_encode($exp['enterprise'].' | '.$exp['city'].' - '.$exp['state'].' | '.strftime("%B %Y", strtotime($exp['start_date'])).' - '. $end_date = ($exp['still_works'] == 1) ? 'Presente' : strftime("%B %Y", strtotime($exp['end_date']))), 0, 'L', false);
				
				$this->setFont('Sinkinsans', '', 8);
				$y = $this->GetY() + 5;
				$this->SetXY($x, $y);
				$this->Multicell(307, 12, utf8_encode($exp['review']), 0, 'L', false);
				
				$y = $this->GetY() + 8;
				if (!is_null($exp['activity1']) && !empty($exp['activity1'])) {
					$this->SetXY($x, $y);
					$this->Multicell(307, 12, utf8_encode('*  '.$exp['activity1']), 0, 'L', false);
					$y = $this->GetY() + 4;
				}
				if (!is_null($exp['activity2']) && !empty($exp['activity2'])) {
					$this->SetXY($x, $y);
					$this->Multicell(307, 12, utf8_encode('*  '.$exp['activity2']), 0, 'L', false);
					$y = $this->GetY() + 4;	
				}
				if (!is_null($exp['activity3']) && !empty($exp['activity3'])) {
					$this->SetXY($x, $y);
					$this->Multicell(307, 12, utf8_encode('*  '.$exp['activity3']), 0, 'L', false);
					$y = $this->GetY() + 4;
				}
				if (!is_null($exp['activity4']) && !empty($exp['activity4'])) {
					$this->SetXY($x, $y);
					$this->Multicell(307, 12, utf8_encode('*  '.$exp['activity4']), 0, 'L', false);	
				}
				
				$y = $this->GetY() + 16;
				$this->SetXY($x, $y);
				
			}
			$this->setY($y + 10);
		}
	}

	public function setEducation($candidato, $apt_lang){
		if (!is_null($candidato->level) && !empty($candidato->level)) {
			if ($this->GetY() - 10 >= 570) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY();
			}
			$this->SetFillColor(190, 71, 149);
			$this->Rect(254, $y, 358, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(265, $y);
			$this->Write(10, 'EDUCACION');

			$x = 263; 
			$y = $this->GetY() + 25;
			$y2 = $y;
			$y3 = $y;
			$w = 190;
			$h = 12;

		
			$this->SetXY($x, $y);
			$this->setTextColor(127, 127, 127);
			$this->SetFont('Sinkinsans', '', 8.5);
			$this->MultiCell($w, $h, utf8_encode($candidato->title), 0, 'L', false);

			$this->setTextColor(150, 150, 150);
			$this->setFont('Sinkinsans', 'BI', 8);
			$y = $this->GetY() + 4;
			$this->SetXY($x, $y);
			$this->MultiCell($w, $h, utf8_encode($candidato->level), 0, 'L', false);

			$this->setFont('Sinkinsans', 'I', 8);
			$y = $this->GetY() + 4;
			$this->SetXY($x, $y);
			$this->MultiCell($w, $h, utf8_encode($candidato->institution), 0, 'L', false);

			if ($candidato->start_date != NULL) {
				$y = $this->GetY() + 4;
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, strftime("%Y", strtotime($candidato->start_date)).' - '. $end_date = ($candidato->still_studies == 1) ? 'Presente' : strftime("%Y", strtotime($candidato->end_date)), 0, 'L', false);
				$this->setY($y + 10);
			}
			
		}

		/* foreach ($apt_lang as $value => $apl) {
			if ($value == 0) {
				if (isset($apl['course'])) {
					$this->setFont('Arial', 'B', 9);
					$x += 105;
					$this->SetXY($x, $y2);
					$this->MultiCell($w, $h, utf8_encode($apl['course']), 0, 'L', false);	
					
					$this->setFont('Arial', 'I', 9);
					$y2 = $this->GetY() + 4;
					$this->SetXY($x, $y2);
					$this->MultiCell($w, $h, utf8_encode($apl['institution']), 0, 'L', false);

					$y2 = $this->GetY() + 4;
					$this->SetXY($x, $y2);
					$this->MultiCell($w, $h, date("Y", strtotime($apl['start_date'])).' - '.date("Y", strtotime($apl['end_date'])), 0, 'L', false);
				}else{
					$this->setFont('Arial', 'B', 9);
					$x += 105;
					$this->SetXY($x, $y2);
					$this->MultiCell($w, $h, utf8_encode($apl['language'].' / '.$apl['language_level']), 0, 'L', false);	
					
					$this->setFont('Arial', 'I', 9);
					$y2 = $this->GetY() + 4;
					$this->SetXY($x, $y2);
					$this->MultiCell($w, $h, utf8_encode($apl['institution']), 0, 'L', false);

					$y2 = $this->GetY() + 4;
					$this->SetXY($x, $y2);
					$this->MultiCell($w, $h, date("Y", strtotime($apl['start_date'])).' - '.date("Y", strtotime($apl['end_date'])), 0, 'L', false);
				}
			}
			if ($value == 1) {
				if (isset($apl['language'])) {
					$this->setFont('Arial', 'B', 9);
					$x += 105;
					$this->SetXY($x, $y3);
					$this->MultiCell($w, $h, utf8_encode($apl['language'].' / '.$apl['language_level']), 0, 'L', false);	
					
					$this->setFont('Arial', 'I', 9);
					$y3 = $this->GetY() + 4;
					$this->SetXY($x, $y3);
					$this->MultiCell($w, $h, utf8_encode($apl['institution']), 0, 'L', false);

					$y3 = $this->GetY() + 4;
					$this->SetXY($x, $y3);
					$this->MultiCell($w, $h, date("Y", strtotime($apl['start_date'])).' - '.date("Y", strtotime($apl['end_date'])), 0, 'L', false);
				} else {
					$this->setFont('Arial', 'B', 9);
					$x += 105;
					$this->SetXY($x, $y3);
					$this->MultiCell($w, $h, utf8_encode($apl['course']), 0, 'L', false);	
					
					$this->setFont('Arial', 'I', 9);
					$y3 = $this->GetY() + 4;
					$this->SetXY($x, $y3);
					$this->MultiCell($w, $h, utf8_encode($apl['institution']), 0, 'L', false);

					$y3 = $this->GetY() + 4;
					$this->SetXY($x, $y3);
					$this->MultiCell($w, $h, date("Y", strtotime($apl['start_date'])).' - '.date("Y", strtotime($apl['end_date'])), 0, 'L', false);
				}
				
				for ($i=0; $i < 3; $i++) { 
					if ($y2 > $y) {
						$y = $y2;
					}
					if ($y3 > $y) {
						$y = $y3;
					}
				}
				$this->SetY($y);

			}
			if($value > 1){
				$y1 = $y + 18;
				if (($value % 3 == 1 && $value == 2) || ($value % 3 ==2 && $value > 2) || $x >= 473) {
					$x = 263;
				}else{
					$x += 105;
				}
				if (isset($apl['language'])) {
					$this->setFont('Arial', 'B', 9);
					$this->SetXY($x, $y1);
					$this->MultiCell($w, $h, utf8_encode($apl['language'].' / '.$apl['language_level']), 0, 'L', false);	
					
					$this->setFont('Arial', 'I', 9);
					$y1 = $this->GetY() + 4;
					$this->SetXY($x, $y1);
					$this->MultiCell($w, $h, utf8_encode($apl['institution']), 0, 'L', false);

					$y1 = $this->GetY() + 4;
					$this->SetXY($x, $y1);
					$this->MultiCell($w, $h, date("Y", strtotime($apl['start_date'])).' - '.date("Y", strtotime($apl['end_date'])), 0, 'L', false);
				}else{
					$this->setFont('Arial', 'B', 9);
					$this->SetXY($x, $y1);
					$this->MultiCell($w, $h, utf8_encode($apl['course']), 0, 'L', false);	
					
					$this->setFont('Arial', 'I', 9);
					$y1 = $this->GetY() + 4;
					$this->SetXY($x, $y1);
					$this->MultiCell($w, $h, utf8_encode($apl['institution']), 0, 'L', false);

					$y1 = $this->GetY() + 4;
					$this->SetXY($x, $y1);
					$this->MultiCell($w, $h, date("Y", strtotime($apl['start_date'])).' - '.date("Y", strtotime($apl['end_date'])), 0, 'L', false);
				}
				

				$yMax = $y1;

				if ($y1 > $yMax) {
					$yMax = $y1;
				}
				$this->SetY($yMax);
			}

		} */
		
	}

	public function setAdditionalPreparation($preparations){
		if (count($preparations) > 0) {
			if ($this->GetY() - 10 >= 606) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() + 30;
			}
			
			$this->SetFillColor(255, 137, 0);
			$this->Rect(254, $y, 358, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(265, $y);
			$this->Write(10, 'FORMACION ADICIONAL');

			$x = 263; 
			$y = $this->GetY() + 25;
			$y1 = $y;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$yMax = $y1;
			foreach ($preparations as $value => $ap) {
				if (($value % 3 == 0 || $x >= 473) && $value > 0) {
					$x = 263;
					$y1 = $yMax + 15;
					if ($y1 >= 660) {
						$this->AddPage();
						$y1 = 57;
						$yMax = $y1;
					}
				}elseif($value > 0){
					$x += 105;
				}
				$this->setTextColor(127, 127, 127);
				$this->SetFont('Sinkinsans', '', 8.5);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_encode($ap['course']), 0, 'L', false);	
				
				$this->setTextColor(150, 150, 150);
				$this->setFont('Sinkinsans', 'I', 8);
				$this->SetXY($x, $this->GetY() + 4);
				$this->MultiCell($w, $h, utf8_encode($ap['institution']), 0, 'L', false);

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
			if ($this->GetY() - 10 >= 606) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() + 30;
			}
			
			$this->SetFillColor(0, 126, 188);
			$this->Rect(254, $y, 358, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(265, $y);
			$this->Write(10, 'IDIOMAS');

			$x = 263; 
			$y = $this->GetY() + 25;
			$y1 = $y;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$yMax = $this->GetY();
			foreach ($languages as $value => $lang) {
				if (($value % 3 == 0 || $x >= 473) && $value > 0) {
					$x = 263;
					$y1 = $yMax + 15;
					if ($y1 >= 660) {
						$this->AddPage();
						$y1 = 57;
						$yMax = $y1;
					}
				}elseif($value > 0){
					$x += 105;
				}
				$this->setTextColor(127, 127, 127);
				$this->SetFont('Sinkinsans', '', 8.5);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_encode($lang['language'].' / '.$lang['language_level']), 0, 'L', false);	
				
				$this->setTextColor(150, 150, 150);
				$this->SetFont('Sinkinsans', 'I', 8);
				$this->SetXY($x, $this->GetY() + 4);
				$this->MultiCell($w, $h, utf8_encode($lang['institution']), 0, 'L', false);

				$this->SetXY($x, $this->GetY() + 4);
				$this->MultiCell($w, $h, date("Y", strtotime($lang['start_date'])).' - '.date("Y", strtotime($lang['end_date'])), 0, 'L', false);


				//$yMax = $this->GetY() + 4;

				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY() + 4;
				}
			
			}
			$this->setY($yMax);
		}
		
	}

	public function setAptitude($aptitudes){
		if (count($aptitudes) > 0) {
			if ($this->GetY() - 10 >= 606) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() + 30;
			}
			
			$this->SetFillColor(140, 200, 40);
			$this->Rect(254, $y, 358, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(265, $y);
			$this->Write(10, 'APTITUDES');

			$x = 263; 
			$y = $this->GetY() - 5;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$this->setTextColor(38, 48, 76);
			$this->SetFont('Sinkinsans', '', 8);
			$yMax = $this->GetY();
			foreach ($aptitudes as $value => $apt) {
				
				if ($value % 3 == 0 || $x >= 473) {
					$x = 263;
					$y = $yMax + 30;
				}else{
					$x += 105;
				}
							
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, utf8_encode($apt['aptitude']), 0, 'L', false);
				$ln = 0;
				for ($i=1; $i <=10 ; $i++) {
					if ($i <= $apt['level']) {
						$this->Image('dist/img/resume-icons/value.png', $x + $ln, $this->GetY() + 8, 8);
					} else {
						$this->Image('dist/img/resume-icons/empty.png', $x + $ln, $this->GetY() + 8, 8);
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
		$this->SetY(-55);
		$this->SetFillColor(51, 54, 79);
		$this->Rect(0, 737, 612, 55, 'F');
		$this->Image('dist/img/RRHHIngenia-Website2020_LogoFooter.png', 40, 754, 111);
	}
}
