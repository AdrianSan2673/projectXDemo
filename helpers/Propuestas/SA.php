<?php

require_once 'libraries/fpdf/mc_table.php';


class SA extends PDF_MC_Table
{

	public function setText($prospecto, $ral, $inv, $ese, $propuestas,   $concepto, $descripcion)
	{

		$this->Image('dist/img/Portada2.png', 0, 0, 620, 500);

		$this->setXY(87, 475);
		$this->setFont('SinkinSans', '', 10);
		$this->MultiCell(450, 15, $prospecto->Prospecto, 0);

		$this->AddPage();
		setlocale(LC_TIME, "spanish");
		$x = 87;
		$y = 110;


		$this->setFont('SinkinSans', '', 9);
		$this->setTextColor(38, 48, 76);
		$this->setXY(360, 120);
		$this->Cell(0, 15, strftime('%d') . ' ' . strftime('%B') . ' ' . strftime('%Y'), 0, 1, 'R');
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'Estimado(a), ' . utf8_decode($prospecto->Contacto_RH) . '.', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, utf8_decode($prospecto->Puesto) . ', ' . utf8_decode($prospecto->Prospecto) . '.', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, 'Presente.', 0, 1, 'L');

		$y = $this->GetY() + 5;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode("Es de gran interés para RRHH INGENIA ser para ustedes el principal aliado en servicios de apoyo en materia de recursos humanos, hoy por hoy somos un referente en servicio, calidad e innovación para nuestros clientes y es de sumo interés para nosotros poder ser un proveedor de valor para su organización.\n
Por lo que hemos integrado a nuestro servicio de línea el REPORTE de ANTECEDENTES LEGALES, lo que resulta un beneficio para usted al ser una herramienta mucho más confiable que una búsqueda en web, innovamos con el uso de la plataforma en beneficio de su proceso y que le permitan optimizar tiempos, esfuerzos y recursos."), 0, 'FJ');




		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'Proponemos y ponemos a su consideración lo siguiente:', 0, 1, 'L');


		$this->setXY($this->GetX() + 360, $this->GetY() - 15);
		$this->setFont('SinkinSans', 'B', 8);
		$this->SetFillColor(255, 255, 255);
		$this->MultiCell(170, 10, utf8_decode(''), 0, 1, 'L');

		$y = 345;
		$x = 75;
		$xn = 92;
		$this->setFont('SinkinSans', '', 10);
		$this->SetTextColor(255, 255, 255);
		$this->SetFillColor(55, 58, 79);
		$this->Rect($x, $y, 35, 60, 'FD');
		$this->Text($xn, $y + 25, '1');/* 1 */
		$this->SetFillColor(80, 84, 104);
		$this->Rect($x, $y + 60, 35, 30, 'FD');
		$this->Text($xn, $y + 75, '2');/* 2 */
		$this->SetFillColor(169, 199, 74);
		$this->Rect($x, $y + 90, 35, 30, 'FD');
		$this->Text($xn, $y + 110, '3');/* 3 */
		$this->SetFillColor(219, 134, 46);
		$this->Rect($x, $y + 120, 35, 30, 'FD');
		$this->Text($xn, $y + 140, '4');/* 4 */
		$this->SetFillColor(70, 124, 180);
		$this->Rect($x, $y + 150, 35, 80, 'FD');
		$this->Text($xn, $y + 190, '5');/* 5 */
		$this->SetFillColor(187, 69, 146);
		$this->Rect($x, $y + 225, 35, 60, 'FD');
		$this->Text($xn, $y + 255, '6');/* 6 */
		$this->SetFillColor(244, 247, 249);
		$this->setFont('SinkinSans', '', 8);
		$this->SetTextColor(1, 1, 1);
		$y = $this->getY() + 15;
		$x = 110;
		$this->setY($y);
		$this->SetWidths(array(420));
		for ($i = 0; $i < 6; $i++) {
			$this->setX($x);
			$this->SetLineWidth(0);
			$this->Row(array(utf8_encode($propuestas[$i])));
		}

		$x = 92;

		$this->AddPage();
		$this->SetFillColor(155, 199, 59);
		$this->SetTextColor(255, 255, 255);
		$this->setFont('SinkinSans', 'B', 12);
		$this->setXY(92, 120);
		$this->Cell(140, 20, 'Concepto', 1, 1, 'C', true);
		$this->setXY(232, 120);
		$this->Cell(150, 20, 'Precio', 1, 1, 'C', true);
		$this->setXY(382, 120);
		$this->Cell(160, 20, 'Descripcion', 1, 1, 'C', true);
		$this->SetWidths(array(140, 150, 160));
		$this->setX($x);
		$this->SetFillColor(242, 246, 249);
		$this->setFont('SinkinSans', '', 7);
		$this->SetTextColor(1, 1, 1);
		$this->Row(array(utf8_encode($concepto[0]), utf8_encode("\n\n\n            $" . number_format($ral,2) . " más IVA."), utf8_encode($descripcion[0])));
		$this->setX($x);
		$this->Row(array(utf8_encode($concepto[1]), utf8_encode("\n\n\n           $" . number_format($inv,2) . " más IVA."), utf8_encode($descripcion[1])));
		$this->setX($x);
		$this->Row(array(utf8_encode($concepto[2]), utf8_encode("\n\n\n            $" . number_format($ese,2) . " más IVA."), utf8_encode($descripcion[2])));


		$this->setFont('SinkinSans', '', 8);
		$y = $this->GetY() + 10;
		$this->setXY(210, $y);
		$this->Cell(0, 15, ('Agradeciendo su atención quedamos de usted.'), 0, 1, 'L');
		$this->setFont('SinkinSans', '', 8);
		$y = $this->GetY();
		$this->setXY(260, $y);
		$this->Cell(0, 15, utf8_encode('Saludos cordiales.'), 0, 1, 'L');
		$this->setFont('SinkinSans', '', 8);
		$y = $this->GetY() + 10;
		$this->setXY(242, $y);
		$this->Cell(0, 15, ($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name), 0, 1, 'L');
		$this->setFont('SinkinSans', 'B', 8);
		$y = $this->GetY() - 5;
		$this->setXY(260, $y);
		$this->Cell(0, 15, utf8_encode('Saludos cordiales.'), 0, 1, 'L');


	}

	function Header()
	{
		$this->Image('dist/img/imagotipo-colores.png', 198, 42, 217);
	}

 	function Footer()
	{
		$this->SetFillColor(51, 54, 79);
		$this->Rect(0, 730, 612, 62, 'F');
		$this->Image('dist/img/facebook.png', 268, 736, 10);
		$x = 87;
		$y = -55;
		$this->setXY($x, $y);
		$this->setTextColor(255, 255, 255);
		$this->setFont('SinkinSans', '', 6);
		$this->Cell(0, 10, 'RRHH Ingenia', 0, 1, 'C');

		$y = $this->GetY() + 4;
		$this->setXY($x + 15, $y);
		$this->Cell(0, 10, 'Mty. 812 036 2228', 0, 1, 'L');
		$this->Image('dist/img/WhatsApp.png', 87, 750, 10);

		$this->setXY($x, $y);
		$this->Cell(0, 10, 'SLP. 444 303 9491', 0, 1, 'C');
		$this->Image('dist/img/WhatsApp.png', 257, 750, 10);

		$this->setY($y);
		$this->Cell(0, 10, 'Tam. 833 155 8508', 0, 1, 'R');
		$this->Image('dist/img/WhatsApp.png', 440, 750, 10);

		$y = $this->GetY() + 4;
		$this->setXY($x, $y);
		$this->Cell(0, 10, $_SESSION['identity']->email.'                                                  wwww.rrhh-ingenia.com', 0, 1, 'C');
	} 
}
