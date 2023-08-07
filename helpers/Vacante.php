<?php
class Vacante extends FPDF
{

	public function setText	($vacante){
		setlocale(LC_TIME, "spanish");
        $x = 87;
		$y = 130;

		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(38, 48, 76);
		$this->setXY(360, 120);
		$this->Cell(0, 15, strftime("%e de %B del %Y"), 0, 1, 'R');
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'Estimado(a), '.$vacante->customer_contact.'.', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, $vacante->position .', '.$vacante->customer.'.', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, 'Presente.', 0, 1, 'L');
		
		$y = $this->GetY() + 5;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Es de gran interés para RRHH INGENIA ser para ustedes el principal aliado en el servicio de reclutamiento, hoy por hoy somos un referente en servicio, calidad e innovación para nuestros clientes y es de sumo interés para nosotros poder ser un proveedor de valor para su organización'), 'FJ');
		
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('A continuación, presentamos la propuesta económica referente al servicio de: '. strtoupper($vacante->vacancy)), 0, 'L');
		
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->SetFillColor(156,194,228);
		$this->MultiCell(150,15,utf8_encode('Concepto'),1,'C','R');

		$this->setXY($x+140,$y);
		$this->MultiCell(150,15,utf8_encode(''),1,1,'C');
		
		$this->setXY($x+290,$y);
		$this->MultiCell(150,15,utf8_encode('Descripcion'),1,'C','C');

		$this->SetFillColor(255,255,255);
		$this->setXY($x,$y+15);
		$this->MultiCell(140, 110, utf8_encode('Servicio de reclutamiento'), 1, 'C', 'L');
		$this->setXY($x+140,$y+15);
		$this->MultiCell(150, 10, utf8_encode("\n\n\nEl precio a cubrir será el  ".number_format($vacante->recruitment_service_cost)."% de un mes de sueldo bruto de la posición a reclutar. \n\n\n\n\n\n"), 1, 'C');

		$this->setXY($x+290,$y+15);
		$this->MultiCell(150, 10, utf8_encode("º Los candidatos enviados por RRHH Ingenia, serán filtrados y entrevistados previo a su presentación con el cliente.\n\n"), 1, 1, 'L');
		
		$this->setXY($x+290,$y+60);
		$this->MultiCell(150, 10, utf8_encode("º Candidatos ya filtrados y apegados al puesto en cuestión de experiencia.\n\n"), 'LR', 1, 'L');
		
		$this->setXY($x+290,$y+95);
		$this->MultiCell(150, 10, $vacante->type==1?"\n\n\n":  utf8_encode("º Se realizará un primer envío de al menos 5 candidatos.\n\n\n"), 'LR', 1, 'L');



		$this->setXY($x,$y+125);
		$this->MultiCell(140, 40, utf8_encode('Garantias'), 1, 'C', 'C');

		$this->setXY($x+140,$y+125);
		$this->Cell(150, 40,$vacante->warranty_time." Dias" , 'B', 0, 'C');

		$this->setXY($x+290,$y+125);
		$this->MultiCell(150, 10, utf8_encode("\nAplica sólo en una reposición por renuncia del candidato.\n\n"), 1, 1, 'L');

		$this->setXY($x,$y+165);
		$this->MultiCell(140, 40, utf8_encode('Anticipo'), 1, 'C', 'L');

		$this->setXY($x+140,$y+165);
		$this->MultiCell(150, 10, utf8_encode("\n $".number_format($vacante->advance_payment,2 ) .' pesos del valor de la posicion'), 'LT', 'C');
		$this->setXY($x+290,$y+165);
		$this->MultiCell(150, 10, utf8_encode("Esto derivado de la complejidad del requerimiento especial de CI de 120. \n "), 1, 1, 'L');
		$this->setXY($x,$y+205);

		$this->MultiCell(140, 40, utf8_encode('Gastos administravos'), 1, 'C', 'L');
		$this->setXY($x+140,$y+205);
		$this->MultiCell(150, 13.34,utf8_encode('$'.number_format($vacante->payment_amount,2 ) .' pesos del valor de posicion')."\n\n", 'LTB', 'C');
		

 		$this->setXY($x+290,$y+205);
		$this->MultiCell(150, 10, utf8_encode("En caso de cancelación una vez presentados candidatos y entrevistados por el cliente.\n\n"), 1, 1, 'L'); 
	
		/*  ---------------------- */
       
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'La factura será emitida y enviada al cliente para su respectivo pago una vez seleccionado el candidato.', 0, 1, 'L');

		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'El precio no incluye IVA.', 0, 1, 'L');

		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Esperando haber sido claros en el desarrollo de nuestra propuesta, quedamos a sus órdenes para darle continuidad al tema y así poder apoyarlos con nuestro servicio.'), 0, 'FJ');

		$this->setFont('SinkinSans', 'B', 8);
		$y = $this->GetY() + 15;
		$this->setXY($x, $y);
		$this->MultiCell(0, 15, utf8_encode(' "Esta propuesta tendrá vigencia de un mes".'), 0, 'L');

		$this->setFont('SinkinSans', '', 8);
		$y = $this->GetY() + 40;
		$this->setXY($x, $y);
		$this->MultiCell(0, 15, utf8_encode($_SESSION['identity']->first_name.' '.$_SESSION['identity']->last_name.'    |    '.$_SESSION['identity']->user_type.'    |    '.$_SESSION['identity']->email), 0, 'C');
	}

	
	function Header(){
		$this->Image('dist/img/imagotipo-colores.png', 198, 42, 217);
	}

	function Footer(){
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
		$this->Cell(0, 10, 'clientes@rrhhingenia.com                                                  wwww.rrhh-ingenia.com', 0, 1, 'C');
	}
}
