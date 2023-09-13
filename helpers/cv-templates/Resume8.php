<?php

class Resume8 extends FPDF
{

	public function setAbout($candidato, $route){
		$y =  130;
		$xa = 20;
		$ya = 22;

		$this->SetFillColor(46, 117, 183);
	
		$this->Rect(0, 0,650, 60, 'F');

		$this->SetLineWidth(6);
		$this->SetDrawColor(46, 117, 183);
		$this->ClippingCircle(310,70,45,50,false);
		$this->Image($route, 260, 25, 100,100);
		$this->UnsetClipping();
		$this->SetLineWidth(1);


		$this->setTextColor(38, 48, 76);

		$this->SetDrawColor(255,255,255);
		
		$this->SetDrawColor(204, 204, 255);
		$this->SetLineWidth(3);

		$this->setFont('Lato-Bold', 'B', 20);
		$this->setTextColor(255,255,255);
		$leng=strlen($candidato->first_name)+strlen($candidato->surname)+strlen($candidato->last_name);
		if ($leng>=30) {
			$y= 0;
		$this->setXY(10,10);
		$this->MultiCell(250, 20,mb_strtoupper(utf8_decode($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name)), 0,'C');
	 
		} else if($leng<30){
			$y=10;
		$this->setXY(40,$y);
		$this->MultiCell(180, 20,mb_strtoupper(utf8_decode($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name)), 0,'C');
		}
		
		$this->setFont('Lato-Regular', '', 12);

		$this->setXY(400, 15);
		$leng2=strlen($candidato->job_title);
		if ($leng2<45) {
			$this->setXY(400, 10);
			$this->MultiCell(180, 15, utf8_decode(mb_strtoupper($candidato->job_title)), 0, 'C');
		} else if ($leng2>=45) {
			$this->setXY(380, 0);
			$this->MultiCell(210, 20, utf8_decode(mb_strtoupper($candidato->job_title)), 0, 'C');
		}
		
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			$this->setTextColor(25, 25, 25);
			$this->setFont('Lato-Bold', 'B', 11);
			/* $y = $this->GetY() + 20; */
			$this->setXY(50,130);
			$this->Cell(60, 10, utf8_decode('RESUMEN PROFESIONAL'), 0,0, 'L');
			$this->Image('dist/img/resume-icons/cv8/person.png',40, 130, 10);
			$y=$this->getY()+20;
			$this->setTextColor(38, 48, 76);
			$this->setFont('Lato-Regular', '', 10);
			$this->setXY(50,$y);
			$this->MultiCell(280, 12.5, utf8_decode($candidato->description), 0, 'J');
		}

			$this->setTextColor(38, 48, 76);
			$this->setFont('Lato-Regular', '', 8);
			
			if (!is_null($candidato->telephone) && !empty($candidato->telephone)) {
				$this->setXY(90 ,65);
				$this->Image('dist/img/resume-icons/cv8/phone.png', 80, 65, 8);
				$this->Cell(60, 10, utf8_decode($candidato->telephone),0, 1, 'L');
			}
			
			if (!is_null($candidato->email) && !empty($candidato->email)) {
				$this->setXY(160, 65);
				$this->Image('dist/img/resume-icons/cv8/email3.png', 150, 65, 8);
				$this->MultiCell(100, 10, utf8_decode($candidato->email), 0, 'L');
			}

			if (!is_null($candidato->state) && !empty($candidato->state)) {
				$leng=strlen($candidato->email);
				if ($leng>=25) {
					$y= 85;
				} else{
					$y= 80;
				}
				$this->setXY(110,$y);
				$this->Image('dist/img/resume-icons/cv8/location3.png', 100, $y, 8);
				$this->Cell(80, 10, ($candidato->city.', '.$candidato->state), 0, 1, 'L');	
			}

			if (isset($candidato->linkedinn) && !is_null($candidato->linkedinn) && !empty($candidato->linkedinn)) {
				$this->setXY(380, 65);
				$this->Image('dist/img/resume-icons/cv8/linkedin.png', 370, 65, 8);
				//$this->Cell(80, 10, ($candidato->linkedinn), 0, 1, 'L');
				$this->MultiCell(100, 10, utf8_decode($candidato->linkedinn), 0, 'L');
			}

			if (isset($candidato->facebook) && !is_null($candidato->facebook) && !empty($candidato->facebook)) {
				$this->setXY(490, 65);
				$this->Image('dist/img/resume-icons/cv8/facebook.png', 485, 65, 8);
				//$this->Cell(80, 10, ($candidato->description), 0, 1, 'L');	
				$this->MultiCell(120, 10, utf8_decode($candidato->facebook), 0, 'L');
			}
			if (isset($candidato->instagram) && !is_null($candidato->instagram) && !empty($candidato->instagram)) {
				$leng=strlen($candidato->linkedinn);
				$leng1=strlen($candidato->facebook);
				if (($leng || $leng1) >=26 ) {
					$y= 85;
				} else{
					$y= 80;
				}
				$this->setXY(440, $y);
				$this->Image('dist/img/resume-icons/cv8/instagram.png', 430, $y, 8);
				$this->MultiCell(140, 10, utf8_decode($candidato->instagram), 0, 'L');
			}

		$this->SetY(65);
	}

	public function setExperience($experiencia,$candidato){
		setlocale(LC_TIME, "spanish");
		$this->setX(265);
		
		if (count($experiencia) > 0) {
			$this->SetFont('Lato-Bold','B', 11);
			$this->SetTextColor(0,0,0);

			if (!is_null($candidato->description) && !empty($candidato->description)) {
				if (strlen($candidato->description) <= 200) {
					$this->setY(200);
				}elseif (strlen($candidato->description) > 200 && strlen($candidato->description) < 300) {
					$this->setY(220);
				}else{
					$this->setY(250);
				}
			}
			
 
			$this->setX(50);
			$this->Write(12, 'EXPERIENCIA');
			$y=$this->getY();
			$this->Image('dist/img/resume-icons/cv8/work.png', 35, $y-4,15);

			$x = 50; 
			$y = $this->getY();
			$this->SetXY($x, $y+20);
			$this->setTextColor(38, 48, 76);

			
			foreach ($experiencia as $exp) {
				$this->SetFont('Lato-Bold', 'BU', 8.5);
				$this->MultiCell(307, 15, utf8_decode($exp['position']), 0, 'L', false);
				
				$this->setFont('Lato-Italic', 'I', 8);
				$y = $this->GetY() + 4;
				$this->SetXY($x, $y);
				
				$this->MultiCell(307, 12, utf8_decode($exp['enterprise'].' | '.$exp['city'].' - '.$exp['state'].' | '.strftime("%B %Y", strtotime($exp['start_date'])).' - '. $end_date = ($exp['still_works'] == 1) ? 'Presente' : strftime("%B %Y", strtotime($exp['end_date']))), 0, 'L', false);
				
				$this->setFont('Lato-Regular', '', 8);
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
				
				$y = $this->GetY() + 10;
				$this->SetXY($x, $y);
				

			}
			$this->setY($y);
		}
	}

	public function setAdditionalPreparation($preparations){
		if (count($preparations) > 0) {
			if ($this->GetY() - 10 >= 606) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() +5;
			}
			
			$this->SetFont('Lato-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$this->setXY(50, $y);
			$this->Write(10, 'FORMACION ADICIONAL');
			$this->Image('dist/img/resume-icons/cv8/adieduc.png',30, $y-5,20);

			$x = 50; 
			$y = $this->GetY() + 15;
			$y1 = $y;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$yMax = $y1;
			foreach ($preparations as $value => $ap) {
				if (($value % 3 == 0 || $x >= 473) && $value > 0) {
					$x = 50;
					$y1 = $yMax + 10;
					if ($y1 >= 660) {
						$this->AddPage();
						$y1 = 57;
						$yMax = $y1;
					}
				}elseif($value > 0){
					$x += 105;
					
				}

			
				$this->setTextColor(38, 48, 76);
				$this->SetFont('Lato-Regular', '', 8.5);
				$this->SetXY($x, $y1);
				$this->MultiCell($w, $h, utf8_decode($ap['course']), 0, 'L', false);	
				
				$this->setTextColor(38, 48, 76);
				$this->setFont('Lato-Italic', 'I', 8);
				$this->SetXY($x, $this->GetY() + 4);
				$this->MultiCell($w, $h, utf8_decode($ap['institution']), 0, 'L', false);

				$this->SetXY($x, $this->GetY() + 4);
				$this->MultiCell($w, $h, date("Y", strtotime($ap['start_date'])).' - '.date("Y", strtotime($ap['end_date'])), 0, 'L', false);


				//$yMax = $this->GetY() + 4;

				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY();
				}

			}
			$this->setY($yMax);

			$this->setY($y);

		}
		
	}


	public function setEducation($candidato){
		if (!is_null($candidato->level) && !empty($candidato->level)) {

			$this->SetFont('Lato-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$this->setXY(400, 130);
			$this->Write(10, 'EDUCACION');
			$y=$this->getY();
			$this->Image('dist/img/resume-icons/cv8/educ.png',375, $y-5,30);

			$x = 400; 
			$y = $this->GetY() + 25;
			$y2 = $y;
			$y3 = $y;
			$w = 190;
			$h = 12;
			
			$this->SetXY($x, $y-10);
			$this->setTextColor(38, 48, 76);
			$this->SetFont('Lato-Regular', '', 8.5);
			$this->MultiCell($w, $h, utf8_decode($candidato->title), 0, 'L', false);

			$this->setTextColor(38, 48, 76);
			$this->setFont('Lato-BoldItalic', 'BI', 8);
			$y = $this->GetY() + 4;
			$this->SetXY($x, $y);
			$this->MultiCell($w, $h, utf8_decode($candidato->level), 0, 'L', false);

			$this->setFont('Lato-Italic', 'I', 8);
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
			
			$this->SetFont('Lato-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$this->setXY(400,220);
			$this->Write(10, 'IDIOMAS');
			$y=$this->getY();
			$this->Image('dist/img/resume-icons/cv8/langs.png',385, $y-2,12);

			$x = 400; 
			$y = $this->GetY() + 15;
			$y1 = $y;
			$w = 95;
			$h = 16;
			$this->SetXY($x, $y);
			$yMax = $this->GetY();
			foreach ($languages as $value => $lang) {
				if (($value % 2 == 0 || $x >= 473) && $value > 0) {
					$x = 400;
					$y1 = $yMax + 5;
				}elseif($value > 0){
					$x += 100;
				}
					
				
				$this->setTextColor(38, 48, 76);
				$this->SetFont('Lato-Bold', 'B', 8.5);
				$this->SetXY($x, $y1);
		
				$ln = 0;
				$aux =0;

				if ($lang['language_level']=='Nativo') {
				$this->SetXY($x, $y1);
				$this->Cell($w, $h, utf8_decode($lang['language'].': Idioma nativo'), 0,0, 'L');
				$this->setTextColor(38, 48, 76);
				$this->SetFont('Lato-Regular', '', 8.5);
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
						$this->Image('dist/img/resume-icons/cv8/bsquareB.png', $x + $ln, $this->GetY() , 8);
					

					elseif ($i == 10) :
						$this->Image('dist/img/resume-icons/cv8/squareEnd.png', $x +$ln, $this->GetY() , 8);
		
					else :
						$this->Image('dist/img/resume-icons/cv8/squareMid.png', $x + $ln, $this->GetY() , 8);
					
					endif;
					
					
					$ln += 7;

				}

				$this->setTextColor(38, 48, 76);
				$this->SetFont('Lato-Regular', '', 8.5);
				$this->SetXY($x, $y1+25);
				$this->MultiCell($w, $h, utf8_decode($lang['institution']), 0, 'L', false);
				$this->SetXY($x, $y1+35);
				$this->MultiCell($w, $h, date("Y", strtotime($lang['start_date'])).'-'.date("Y",strtotime($lang['end_date'])),0,'L',FALSE);

			 }


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
			
			$this->SetFont('Lato-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$y += 6;
			$this->setXY(400, $y+250);
			$this->Write(10, 'APTITUDES');
			$this->Image('dist/img/resume-icons/cv8/apti.png',385, $y+248,12);

			$x = 20; 
			$y = $this->GetY() +5;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			
			$this->setTextColor(38, 48, 76);
			$this->SetFont('Lato-Regular', '', 10);
			$yMax = $this->GetY();
			foreach ($aptitudes as $value => $apt) {
				
				if ($value % 1 == 0 || $x >= 473) {
					$x = 400;
					$y = $yMax + 10;
				}else{
					$x += 100;
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
