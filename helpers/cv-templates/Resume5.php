<?php

class Resume5 extends FPDF
{

	public function setAbout($candidato, $route){
		$y =  20;
		$xa = 180;
		$ya = 22;
		
		$this->SetFillColor(1,14, 111);

		$this->SetDrawColor(0,181,213);
		$this->SetLineWidth(150);
		$this->Line(0,20, 600 , 20);

		$this->SetLineWidth(1);
		$this->SetDrawColor(255,255,255);
		$this->setFont('SinkinSans', 'B', 35 );
		$this->setTextColor(255,255,255);
		$this->SetXY(20,10);
		$this->Cell(70, 70, substr($candidato->first_name,0,1).''.substr($candidato->last_name,0,1), 1,0, 'C');

		$this->SetXY(70,70);
		$this->SetDrawColor(0,77, 102);
		
		$this->setFont('SinkinSans', 'B', 18);
		$this->setTextColor(255,255,255);
		$leng=strlen($candidato->first_name)+strlen($candidato->surname)+strlen($candidato->last_name);
		if ($leng>=30) {
			$y= 10;
		} if($leng<30){
			$y= 25;
		}
		$this->setXY(100, $y);
		$this->MultiCell(500, 20, utf8_decode(mb_strtoupper($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name)), 0,'C');
		
		$this->setFont('SinkinSans', '', 12) ;
		 $y = $this->GetY() + 3; 
	 	$this->setXY(170, $y);
		$this->MultiCell(350, 12, utf8_decode(mb_strtoupper($candidato->job_title)), 0, 'L'); 
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			$this->setTextColor(0,181,213);
			$this->setFont('SinkinSans', 'B', 10);
			/* $y = $this->GetY() + 20; */
			$this->setXY(10,105);
			$this->Cell(60, 10, utf8_decode('RESUMEN PROFESIONAL'), 0,0, 'L');
			
			$this->setTextColor(38, 48, 76);
			$this->setFont('SinkinSans', '', 9);
			$y = $this->GetY() + 10;
			$this->setXY(10,120);
			$this->MultiCell(500, 12, utf8_decode($candidato->description), 0, 'J');
		}

			$this->setTextColor(25, 25, 25);
			$this->setFont('SinkinSans', 'B', 11);
			
			$this->setXY($xa,65);
			$this->setTextColor(38, 48, 76);
			$this->setFont('SinkinSans', '', 7);
			
			if (!is_null($candidato->telephone) && !empty($candidato->telephone)) {
				$xa = $this->GetX();
				$y = $this->GetY();
				$this->setXY($xa, $y);
				$this->Image('dist/img/resume-icons/cv5/phone.png', $xa-10, $y, 8);
				$this->Cell(60, 10, utf8_decode($candidato->telephone),0, 1, 'L');
			}
			
			if (!is_null($candidato->email) && !empty($candidato->email)) {
				$xa += 70;
				$this->setXY($xa, $y);
				$this->Image('dist/img/resume-icons/cv5/email3.png', $xa-10, $y, 8);
				$this->MultiCell(100, 10, utf8_decode($candidato->email), 0, 'L');
			}
			if (!is_null($candidato->state) && !empty($candidato->state)) {
				/* $xa = $this->GetX() + 7; */
				$xa += 110;
				$this->setXY($xa, $y);
				$this->Image('dist/img/resume-icons/cv5/location3.png', $xa-10, $y, 8);
				$this->Cell(170, 10, utf8_decode($candidato->city.', '.$candidato->state), 0, 1, 'L');	
			}

			if (isset($candidato->linkedinn) && !is_null($candidato->linkedinn) && !empty($candidato->linkedinn)) {

				$xa += 70 ;
				$y += 20;
				$this->setXY($xa, $y);
				$this->Image('dist/img/resume-icons/cv5/linkedin.png', $xa-10, $y, 8);

				$this->MultiCell(120, 10, utf8_decode($candidato->linkedinn), 0, 'L');
			}
			
			if (isset($candidato->facebook) && !is_null($candidato->facebook) && !empty($candidato->facebook)) {
				$xa -= 130;
				$this->setXY($xa, $y);
				$this->Image('dist/img/resume-icons/cv5/facebook.png', $xa-5, $y, 8);
				//$this->Cell(80, 10, ($candidato->description), 0, 1, 'L');	
				$this->MultiCell(120, 10, utf8_decode($candidato->facebook), 0, 'L');
			}

			if (isset($candidato->instagram) && !is_null($candidato->instagram) && !empty($candidato->instagram)) {
				$xa -= 120;
				
				$this->setXY($xa, $y);
				$this->Image('dist/img/resume-icons/cv5/instagram.png', $xa-10, $y, 8);
				//$this->Cell(80, 10, ($candidato->instagram), 0, 1, 'L');
				$this->MultiCell(115, 10, utf8_decode($candidato->instagram), 0, 'L');
			}
		/* 	echo strlen($candidato->instagram']); */
		$this->SetX(170);
	}

	public function setExperience($experiencia,$candidato){
		setlocale(LC_TIME, "spanish");
		$this->setX(265);

		if (count($experiencia) > 0) {
			
			$this->SetFont('SinkinSans','B', 10);
			$this->SetTextColor(0,181,213);

			if (!is_null($candidato->description) && !empty($candidato->description)) {
				if (strlen($candidato->description) <= 300) {
					$this->setY(160);
				}elseif (strlen($candidato->description) > 300 && strlen($candidato->description) < 400) {
					$this->setY(175);
				}else{
					$this->setY(185);
				}
			}

			$this->setX(10);
			$this->Write(12, 'EXPERIENCIA');

		$x = 10; 
		$y = $this->GetY() + 15;
		$y1 = $y;
		$this->SetXY($x, $y);
		$yMax = $y1;

		foreach ($experiencia as $value => $exp) {
			if (($value % 2 == 0 || $x >= 400) && $value > 0) {
				$x = 10;
				$y1 = $yMax + 10;
			}elseif($value > 0){
				$x += 300;
			}
	

			/* $x = 20; 
			$y = 130; */
			$this->SetXY($x, $y1);
			$this->setTextColor(38, 48, 76);
		 {
			
				$this->SetFont('SinkinSans', 'BU', 8);
				$this->MultiCell(307, 15, utf8_decode($exp['position']), 0, 'L', false);
				
				$this->setFont('SinkinSans', 'I', 7);
				$y = $this->GetY() + 8;
				$this->SetXY($x, $y);
				
				$this->MultiCell(307, 12, utf8_decode($exp['enterprise'].' | '.$exp['city'].' - '.$exp['state'].' | '.strftime("%B %Y", strtotime($exp['start_date'])).' - '. $end_date = ($exp['still_works'] == 1) ? 'Presente' : strftime("%B %Y", strtotime($exp['end_date']))), 0, 'L', false);
				
				$this->setFont('SinkinSans', '', 7);
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
				
			/* 	$y = $this->GetY() -110;
				$x = $this->GetX() + 350;
				$this->SetXY($x, $y); */
				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY();
				}

			}
		/* 	$this->setY($y + 100); */
				$this->setY($yMax);
			

		}
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
			$this->SetTextColor(0,181,213);
			$y += 6;
			$this->setXY(10, $y+5);
			$this->Write(10, 'EDUCACION');

			$x = 10; 
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
			$this->SetTextColor(0,181,213);
			$y += 6;
			$this->setXY(10, $y-25);
			$this->Write(10, 'FORMACION ADICIONAL');

			$x = 10; 
			$y = $this->GetY() + 15;
			$y1 = $y;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$yMax = $y1;
			foreach ($preparations as $value => $ap) {
				if (($value % 4 == 0 || $x >= 473) && $value > 0) {
					$x = 20;
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

	public function setLanguages($languages){
		if (count($languages) > 0) {
			if ($this->GetY() - 10 >= 706) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() + 30;
			}
			
			$this->SetFont('SinkinSans','B', 10);
			$this->SetTextColor(0,181,213);
			$this->setXY(10,$y-20);
			$this->Write(10, 'IDIOMAS');
				

			$x = 10; 
			$y = $this->GetY() + 15;
			$y1 = $y;
			$w = 95;
			$h = 16;
			$this->SetXY($x, $y);
			$yMax = $this->GetY();
			foreach ($languages as $value => $lang) {
				if (($value % 3 == 0 || $x >= 473) && $value > 0) {
					$x = 10;
					$y1 = $yMax;
				}elseif($value > 0){
					$x += 105;
				}
					
				
				$this->setTextColor(38, 48, 76);
				$this->SetFont('SinkinSans', 'B', 7);
				$this->SetXY($x, $y1);
		
				$ln = 0;
				$aux =0;

				if ($lang['language_level']=='Nativo') {
				$this->SetXY($x, $y1);
				$this->Cell($w, $h, utf8_decode($lang['language'].': Idioma nativo'), 0,0, 'L');
				$this->setTextColor(38, 48, 76);
				$this->SetFont('SinkinSans', '', 7);
				$this->SetXY($x, $y1+10);
				$this->MultiCell($w, $h, utf8_decode($lang['institution']), 0, 'L', false);
				$this->SetXY($x, $y1+20);
				$this->MultiCell($w, $h, date("Y", strtotime($lang['start_date'])).'-'.date("Y",strtotime($lang['end_date'])),0,'L',FALSE);	
				 }
				 else{
				
				$this->MultiCell($w, $h, utf8_decode($lang['language'].': '.$lang['language_level']), 0, 'L', false);

				if ($lang['language_level']=='Básico') 
					$aux = 2;
				if ($lang['language_level']=='Intermedio') 
					$aux = 6;
				if ($lang['language_level']=='Avanzado') 
					$aux = 8;

				for ($i=1; $i <=10 ; $i++) {
					if ($i <= $aux) :
						$this->Image('dist/img/resume-icons/cv5/bsquareB.png', $x + $ln, $this->GetY() , 8);
					

					elseif ($i == 10) :
						$this->Image('dist/img/resume-icons/cv5/squareEnd.png', $x +$ln, $this->GetY() , 8);
		
					else :
						$this->Image('dist/img/resume-icons/cv5/squareMid.png', $x + $ln, $this->GetY() , 8);
					
					endif;
					
					
					$ln += 7;

				}
		

				$this->setTextColor(38, 48, 76);
				$this->SetFont('SinkinSans', '', 8.5);
				$this->SetXY($x, $y1+25);
				$this->MultiCell($w, $h, utf8_decode($lang['institution']), 0, 'L', false);
				$this->SetXY($x, $y1+35);
				$this->MultiCell($w, $h, date("Y", strtotime($lang['start_date'])).'-'.date("Y",strtotime($lang['end_date'])),0,'L',FALSE);

			 }


				$yMax = $this->GetY() + 4;

				/* if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY() + 4;

				
				} */
	

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
			
			/* $this->SetFillColor(1,14, 111);
			$this->Rect(20, $y, 200, 20, 'F'); */
			$this->SetFont('SinkinSans','B', 10);
			$this->SetTextColor(0,181,213);
			
			$this->setXY(360, $y-100);
			$this->Write(10, 'APTITUDES');

			$x = 10; 
			$y = $this->GetY() - 15;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$this->setTextColor(38, 48, 76);
			$this->SetFont('SinkinSans', '', 7);
			$yMax = $this->GetY();
			foreach ($aptitudes as $value => $apt) {
				
				if ($value % 2 == 0 || $x >= 473) {
					$x = 360;
					$y = $yMax + 30;
				}else{
					$x += 105;
				}
							
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, utf8_decode($apt['aptitude']), 0, 'L', false);
				$ln = 0;
				for ($i=1; $i <=10 ; $i++) {
					if ($i <= $apt['level']) {
						$this->Image('dist/img/resume-icons/cv5/circleB.png', $x + $ln, $this->GetY() + 8, 8);
					} else {
						$this->Image('dist/img/resume-icons/cv5/circleemptyB.png', $x + $ln, $this->GetY() + 8, 8);
					}
					$ln += 9.5;
				}
				$yMax = $this->GetY() + 4;
				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY() + 4;

				
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
