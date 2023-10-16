<?php

use \setasign\Fpdi\Fpdi;
use \setasign\Fpdi\PdfReader;

require('./libraries/fpdi/src/autoload.php');
require_once('./libraries/fpdf/fpdf.php');
class Psicometria extends FPDI
{


	public $tieneHeader;
	public $tieneFooter = false;
	public $seccionHeader;
	public $headerDocumento = true;
	public $headerEconomia = true;

	public function setPortada($psycho)
	{
		$this->Image('dist/img/isotipo-colores.png', 395, -130, 350, 0);
		$this->Image('dist/img/imagotipo-colores-3.png', 28, 203, 235, 0);
		$this->setTextColor(51, 54, 79);

		$x = 32;
		$y = 308;
		$this->setFont('SinkinSansBold', 'B', 45);
		$this->setXY($x, $y);
		$this->Write(48, 'REPORTE');

		$y = $this->GetY() + 53;
		$this->SetXY($x, $y);
		$this->Write(48, utf8_encode('EVALUACIÓN'));

		$this->setTextColor(158, 198, 58);
		$y = $this->GetY() + 53;
		$this->SetXY($x, $y);
		$this->Write(48, utf8_encode('PSICOMÉTRICAS'));

		$this->setFont('SinkinSans', 'B', 12);
		$this->setTextColor(51, 54, 79);
		$y = $this->GetY() + 70;
		$this->SetXY($x, $y);

		$this->Write(19, 'EMPRESA:');
		$x1 = $this->GetX() + 10;
		$this->SetX($x1);
		$this->MultiCell(400, 18, utf8_encode($psycho->customer), 1, 'L');

		$y = $this->GetY() + 25;

		$x1 = $this->GetX() + 32;
		$this->SetXY($x1, $y);
		$this->Write(15, 'NOMBRE DEL CANDIDATO:');

		$x1 = $this->GetX() + 10;
		$this->SetX($x1);
		$this->MultiCell(300, 18, utf8_encode($psycho->candidate), 1, 'L');

		$this->setFont('SinkinSans', 'B', 12);
		$this->setTextColor(51, 54, 79);
		$y = $this->GetY() + 25;
		$this->SetXY($x, $y);

		$this->Write(19, 'PUESTO:');
		$x1 = $this->GetX() + 10;
		$this->SetX($x1);
		$this->MultiCell(200, 18, utf8_encode($psycho->job_title), 1, 'L');
	}



	public function setInterpretation($psycho)
	{
		$this->AddPage();
		$y = $this->GetY() + 30;

		$templateId1 = $this->beginTemplate();
		$this->SetFont('SinkinSans', '', 15);
		$this->SetTextColor(255, 255, 255);
		$this->SetXY(0, 18);
		$this->SetFillColor(66, 133, 244);
		$this->Multicell(400, 25, utf8_encode($psycho->candidate), 0, "C", true);
		$this->Image('dist/img/imagotipo-colores-3.png', 420, 19, 130);
		$this->SetFillColor(255, 255, 255);
		$this->Rect(0, 50, 380, 15, "F");
		$this->endTemplate();

		$this->useTemplate($templateId1);
		$this->SetFillColor(73, 142, 180);
		$this->Rect(60, $y, 490, 20, 'F');
		$this->SetFont('Sinkinsans', 'B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(268, $y);
		$this->Write(10, utf8_encode('RESUMEN'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 25;
		$this->SetFillColor(241, 242, 243);

		$this->setFont('SinkinSans', '', 9);
		$this->setTextColor(0, 0, 0);
		$this->SetXY($x + 35, $y);
		$this->MultiCell(490, 13, (utf8_encode($psycho->interpretation)), 0, 'J', true);
	}




	function AddPagesFromPDF($pdfFilePath, $psycho)
	{
		if (file_exists($pdfFilePath)) {
			$this->setSourceFile($pdfFilePath);
			$pageCount = $this->setSourceFile($pdfFilePath);
			$this->AddPage();

			$templateId1 = $this->beginTemplate();
			$this->SetFont('SinkinSans', '', 15);
			$this->SetFillColor(255, 255, 255);
			$this->Rect(0, 70, 600, 42, "F");
			$this->SetFillColor(249, 241, 160);
			$this->Rect(28, 120, 40, 40, "F");
			$this->SetTextColor(255, 255, 255);
			$this->SetXY(0, 18);
			$this->SetFillColor(66, 133, 244);
			$this->Multicell(400, 25, utf8_encode($psycho->candidate), 0, "C", true);
			$this->Image('dist/img/imagotipo-colores-3.png', 420, 19, 130);
			$this->endTemplate();


			for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
				$this->header();
				$template = $this->importPage($pageNumber, PdfReader\PageBoundaries::MEDIA_BOX);
				$this->useImportedPage($template, 0, 40);


				$arregloPagi = explode(",", $psycho->page);
				end($arregloPagi);
				$z = prev($arregloPagi);
				for ($i = 0; $i < count($arregloPagi); $i++) {
					if ($pageNumber == $arregloPagi[$i]) {
						$this->useTemplate($templateId1);
					}if ($pageNumber == $z && count($arregloPagi)>4) {
						$this->SetFillColor(255,255,255);
						$this->Rect(0,106,250,10,"F");
						$this->SetFillColor(249, 241, 160);
						$this->Rect(31,147,33,26,"F");
					  } else if ($pageNumber== end($arregloPagi) && count($arregloPagi)== 6){
						$this->SetFillColor(255,255,255);
						$this->Rect(0,100,250,10,"F");
						$this->SetFillColor(249, 241, 160);
						$this->Rect(18,120,50,35,"F");
					}	else if ($pageNumber== end($arregloPagi)) {
						$this->SetFillColor(255,255,255);
						$this->Rect(0,120,250,10,"F");
						$this->SetFillColor(249, 241, 160);
						$this->Rect(18,138,50,35,"F");
 					 } 
				}

				//$this->useTemplate($templateId1);
				//$this->SetFillColor(255,255,255);
				//$this->Rect(0,0,380,65,"F");
				//$this->Rect(0,768,420,25,"F");
				if ($pageCount != $pageNumber)
					$this->AddPage();
			}
		} else {
			// El archivo PDF no existe en la ruta especificada
			// Puedes agregar aquí cualquier manejo de error o simplemente no hacer nada
		}
	}
}
