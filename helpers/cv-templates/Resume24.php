<?php

class Resume24 extends FPDF
{

	public function setAbout($candidato, $route){
		$y =  20;
		$xa = 20;
		$ya = 22;
		

		$this->SetFillColor(1,14, 111);
	


		$this->SetDrawColor(209,224,224);
		$this->SetLineWidth(80);
		$this->Line(0,20, 600 , 20);

		$this->SetDrawColor(0,77, 102);
		$this->SetLineWidth(40);
		$this->Line(10,75, 600 , 75);


		$this->SetLineWidth(10);
		$this->ClippingCircle(70,70,45,50,false);
		$this->Image($route, 25, 25, 90, 90);
		$this->UnsetClipping();

		$this->SetLineWidth(1);
			
		$this->SetXY(70,70);
		$this->SetDrawColor(0,77, 102);
	
		$this->setFont('Lato-Bold', 'B', 16);
		$this->setTextColor(255,255,255);
		$this->setXY(125, $y+40);
		$this->MultiCell(500, 15, utf8_decode(mb_strtoupper($candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name)), 0,'L');
		
		$this->setFont('Lato-Regular', '', 12) ;
		 $y = $this->GetY() + 8; 
	 	$this->setXY(125, $y-5);
		$this->MultiCell(350, 12, utf8_decode(mb_strtoupper($candidato->job_title)), 0, 'L'); 
		if (!is_null($candidato->description) && !empty($candidato->description)) {
			$this->setTextColor(25, 25, 25);
			$this->setFont('Lato-Bold', 'B', 11);
			/* $y = $this->GetY() + 20; */
			$this->setXY(20,130);
			$this->Cell(60, 10, utf8_decode('RESUMEN PROFESIONAL'), 0,0, 'L');
			
			$this->setTextColor(38, 48, 76);
			$this->setFont('Lato-Regular', '', 10);
			$y = $this->GetY() + 10;
			$this->setXY(180,130);
			$this->MultiCell(350, 12, utf8_decode($candidato->description), 0, 'J');
		}
	
			$this->setTextColor(25, 25, 25);
			$this->setFont('Lato-Bold', 'B', 11);
			/* $y = $this->GetY() + 20; */
			$this->setXY($xa+385, 10);
		/* 	$this->Cell(60, 10, 'CONTACTO', 0, 'L'); */
			

			
			$this->setTextColor(38, 48, 76);
			$this->setFont('Lato-Regular', '', 8);
			
			if (!is_null($candidato->telephone) && !empty($candidato->telephone)) {
				$y = $this->GetY();
				$this->setXY($xa+120, $y);
				$this->Image('dist/img/resume-icons/cv24/phone.png', $xa+110, $y, 8);
				$this->Cell(80, 10, utf8_decode($candidato->telephone), 0, 1, 'L');
			}
			
			if (!is_null($candidato->email) && !empty($candidato->email)) {
				$y += 15;
				$this->setXY($xa+120, $y);
				$this->Image('dist/img/resume-icons/cv24/email3.png', $xa+110, $y, 8);
				$this->MultiCell(100, 10, utf8_decode($candidato->email), 0, 'L');
			}

			if (!is_null($candidato->state) && !empty($candidato->state)) {
				$y = $this->GetY() -30;
				$this->setXY($xa+250, $y);
				$this->Image('dist/img/resume-icons/cv24/location3.png', $xa+240, $y, 8);
				$this->MultiCell(100, 10, utf8_decode($candidato->city.', '.$candidato->state), 0,'L');	
			}

			if (isset($candidato->linkedinn) && !is_null($candidato->linkedinn) && !empty($candidato->linkedinn)) {
				$y += 15;
				$this->setXY($xa+250, $y+5);
				$this->Image('dist/img/resume-icons/cv24/linkedin.png', $xa+240, $y+5, 8);
				//$this->Cell(80, 10, ($candidato->linkedinn), 0, 1, 'L');
				$this->MultiCell(100, 10, utf8_decode($candidato->linkedinn), 0, 'L');
			}

			if (isset($candidato->facebook) && !is_null($candidato->facebook) && !empty($candidato->facebook)) {
				$y = $this->GetY()-30;
				$this->setXY($xa+365, $y);
				$this->Image('dist/img/resume-icons/cv24/facebook.png', $xa+355, $y, 8);
				//$this->Cell(80, 10, ($candidato->description), 0, 1, 'L');	
				$this->MultiCell(160, 10, utf8_decode($candidato->facebook), 0, 'L');
			}

			if (isset($candidato->instagram) && !is_null($candidato->instagram) && !empty($candidato->instagram)) {
				$y = $this->GetY() + 8;
				$this->setXY($xa+365, $y);
				$this->Image('dist/img/resume-icons/cv24/instagram.png', $xa+355, $y, 8);
				//$this->Cell(80, 10, ($candidato->instagram), 0, 1, 'L');
				$this->MultiCell(160, 10, utf8_decode($candidato->instagram), 0, 'L');
			}

		$this->SetY(65);
	}

	public function setExperience($experiencia){
		setlocale(LC_TIME, "spanish");
		$this->setX(265);

		if (count($experiencia) > 0) {
			
			$this->SetFont('Lato-Bold','B', 11);
			$this->SetTextColor(0,0,0);

			$this->setY(215);
			$this->setX(20);
			$this->Write(12, 'EXPERIENCIA');

		$x = 20; 
		$y = $this->GetY() + 20;
		$y1 = $y;
		$this->SetXY($x, $y);
		$yMax = $y1;

		foreach ($experiencia as $value => $exp) {
			if (($value % 2 == 0 || $x >= 400) && $value > 0) {
				$x = 20;
				$y1 = $yMax ;
			}elseif($value > 0){
				$x += 300;
			}
	

			/* $x = 20; 
			$y = 130; */
			$this->SetXY($x, $y1);
			$this->setTextColor(38, 48, 76);
		 {
			
				$this->SetFont('Lato-Bold', 'BU', 8.5);
				$this->MultiCell(307, 15, utf8_decode($exp['position']), 0, 'L', false);
				
				$this->setFont('Lato-Italic', 'I', 8);
				$y = $this->GetY() + 8;
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
				
			/* 	$y = $this->GetY() -110;
				$x = $this->GetX() + 350;
				$this->SetXY($x, $y); */
				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY()+10;
				}

			}
		/* 	$this->setY($y + 100); */
				$this->setY($yMax);
			

		}
	}

}
	
public function setEducation($candidato){
	if (!is_null($candidato->level) && !empty($candidato->level)) {
		if ($this->GetY() <= 450) {
			$y =$this->GetY();

		} 
		
		elseif ($this->GetY()>450) {
			$y = $this->GetY();
		}
		
		

		

		$this->SetFont('Lato-Bold','B', 11);
		$this->SetTextColor(0,0,0);
		$y += 6;
		$this->setXY(20, $y);
		$this->Write(10, 'EDUCACION');

		$x = 20; 
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


public function setLanguages($languages,$experiencia){
	
	if (count($languages) > 0) {
	
		if ($this->GetY()-100<= 550) {
			$y = 365;

			if(count($experiencia)>=5){
				$y = 45;
			}

		}

		else if ($this->GetY()>=550 & $this->GetY()<=760) {
			$y = 475;
		
		}
		
	
			
		$this->SetFont('Lato-Bold','B', 11);
		$this->SetTextColor(0,0,0);

		$this->setXY(320,$y);
		$this->Write(10, 'IDIOMAS');

		$x = 320; 
		$y = $this->GetY() + 15;
		$y1 = $y;
		$w = 95;
		$h = 16;
		$this->SetXY($x, $y);
		$yMax = $this->GetY();
		foreach ($languages as $value => $lang) {
			if (($value % 2 == 0 || $x >= 473) && $value > 0) {
				$x = 320;
				$y1 = $yMax + 5;
			}elseif($value > 0){
				$x += 105;
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
					$this->Image('dist/img/resume-icons/cv24/bsquareB.png', $x + $ln, $this->GetY() , 8);
				

				elseif ($i == 10) :
					$this->Image('dist/img/resume-icons/cv24/squareEnd.png', $x +$ln, $this->GetY() , 8);
	
				else :
					$this->Image('dist/img/resume-icons/cv24/squareMid.png', $x + $ln, $this->GetY() , 8);
				
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

	public function setAdditionalPreparation($preparations){
		if (count($preparations) > 0) {
			if ($this->GetY()>= 606) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() + 30;
			}
			
			$this->SetFont('Lato-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$y += 6;
			$this->setXY(20, $y-20);
			$this->Write(10, 'FORMACION ADICIONAL');

			$x = 20; 
			$y = $this->GetY() + 20;
			$y1 = $y;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			$yMax = $y1;
			foreach ($preparations as $value => $ap) {
				if (($value % 3 == 0 || $x >= 473) && $value > 0) {
					$x = 20;
					$y1 = $yMax + 5;
					if ($y1 >= 660) {
						$this->AddPage();
						$y1 = 57;
						$yMax = $y1;
					}
				}elseif($value > 0){
					$x += 90;
					
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


				if ($this->GetY() + 4 > $yMax) {
					$yMax = $this->GetY() + 4;
				}

			}
			$this->setY($yMax);

		}
		
	}

	
	public function setAptitude($aptitudes){

		if (count($aptitudes) > 0) {
			if ($this->GetY() >= 700) {
				$this->AddPage();
				$y = 57;
			}else{
				$y = $this->GetY() + 20 ;
			}
			

			$this->SetFont('Lato-Bold','B', 11);
			$this->SetTextColor(0,0,0);
			$y += 6;
			$this->setXY(405, $y);
			$this->Write(10, 'APTITUDES');

			$x = 20; 
			$y = $this->GetY() - 15;
			$w = 95;
			$h = 12;
			$this->SetXY($x, $y);
			
			$this->setTextColor(38, 48, 76);
			$this->SetFont('Lato-Regular', '', 8);
			$yMax = $this->GetY();
			foreach ($aptitudes as $value => $apt) {
				
				if ($value % 2 == 0 || $x >= 473) {
					$x = 405;
					$y = $yMax + 30;
				}else{
					$x += 105;
				}
							
				$this->SetXY($x, $y);
				$this->MultiCell($w, $h, utf8_decode($apt['aptitude']), 0, 'L', false);
				$ln = 0;
				for ($i=1; $i <=10 ; $i++) {
					if ($i <= $apt['level']) {
						$this->Image('dist/img/resume-icons/cv24/circleB.png', $x + $ln, $this->GetY() + 8, 8);
					} else {
						$this->Image('dist/img/resume-icons/cv24/circleemptyB.png', $x + $ln, $this->GetY() + 8, 8);
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
		
	}
}
