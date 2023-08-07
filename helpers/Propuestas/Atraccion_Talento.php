<?php

class Atraccion_Talento extends FPDF
{

	public function setText	($prospecto, $precio){
		$x = 87;
		$y = 146;

		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(38, 48, 76);
		$this->setXY(360, 120);
		$this->Cell(0, 15, strftime('%d').' '.strftime('%B').' '.strftime('%Y'), 0, 1, 'R');
		$this->setXY($x, $y);
		$this->Cell(0, 12, 'Estimado(a), '.$prospecto->Contacto_RH.'.', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, $prospecto->Puesto.', '.$prospecto->Prospecto.'.', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 12, 'Presente.', 0, 1, 'L');
		
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Es de gran interés para RRHH INGENIA ser para ustedes el principal aliado en servicios de apoyo en materia de recursos humanos, hoy por hoy somos un referente en servicio, calidad e innovación para nuestros clientes y es de sumo interés para nosotros poder ser un proveedor de valor para su organización.'), 0, 'FJ');
		
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Ponemos a su disposición el siguiente servicio:'), 0, 'L');

		$y = $this->GetY() + 8;
		$this->setXY($x + 20, $y);
		$this->Cell(0, 15, '*   Atracción de talento 3.0 el cual consiste en lo siguiente:', 0, 1, 'L');

		$this->SetFillColor(51, 54, 79);
		$this->SetTextColor(255, 255, 255);
		$this->setFont('SinkinSans', 'B', 8);
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(146, 15, utf8_encode('Concepto'), 1, 'C', true);
		$this->setXY($x + 146, $y);
		$this->MultiCell(146, 15, utf8_encode('Costo'), 1, 'C', true);
		$this->setXY($x + 292, $y);
		$this->MultiCell(146, 15, utf8_encode('Descripción'), 1, 'C', true);

		$y = $this->GetY();
		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(38, 48, 76);
		$this->setXY($x, $y);
		$this->MultiCell(146, 270, utf8_encode('Atracción de candidatos'), 1, 'C');

		$this->setXY($x + 146, $y);
		$this->MultiCell(146, 270, utf8_encode('$'.number_format($precio).' más IVA'), 1, 'C');

		$this->setXY($x + 292, $y);
		$this->MultiCell(146, 15, utf8_encode('*  Diseñamos un post atractivo que capte la atención de los candidatos.    *  Brindamos la información que requiere el candidato para postularse, atendiendo dudas e inquietudes y vendiendo la vacante como una oportunidad atractiva.                *  Le ahorramos a usted horas de atención a posibles interesados.                                  *  Identificamos candidatos reales de solo aquellos curiosos.                                        *  Le permitimos optimizar su tiempo en tareas más relevantes.'), 1, 'L');


		$y = $this->GetY();
		$this->setXY($x, $y);
		$this->MultiCell(146, 30, utf8_encode('Tiempo de difusión'), 1, 'C');

		$this->setXY($x + 146, $y);
		$this->MultiCell(146, 30, utf8_encode('Sin costo adicional'), 1, 'C');

		$this->setXY($x + 292, $y);
		$this->MultiCell(146, 15, utf8_encode('*  30 días de constante movimiento de la publicación.'), 1, 'FJ');
		
		$y = $this->GetY() + 5;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Esperando haber sido claros en el desarrollo de nuestra propuesta, quedamos a sus órdenes para darle continuidad al tema y así poder apoyarlos con nuestro servicio.'), 0, 'FJ');

		$this->setFont('SinkinSans', 'B', 8);
		$y = $this->GetY() + 15;
		$this->setXY($x, $y);
		$this->MultiCell(0, 15, utf8_encode(' "Esta propuesta tendrá vigencia de un mes".'), 0, 'L');

		$this->setFont('SinkinSans', '', 8);
		$y = $this->GetY() + 15;
		$this->setXY($x, $y);
		$this->MultiCell(0, 15, utf8_encode($_SESSION['identity']->first_name.' '.$_SESSION['identity']->last_name.'    |    '.$_SESSION['identity']->user_type.'    |    '.$_SESSION['identity']->email), 0, 'L');

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
