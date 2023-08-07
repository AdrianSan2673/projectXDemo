<?php

class Psicometrias extends FPDF
{

	public function setText	($prospecto, $precio){
		$x = 87;
		$y = 146;

		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(38, 48, 76);
		$this->setXY(360, 120);
		$this->Cell(0, 15, strftime('%d').' '.strftime('%B').' '.strftime('%Y'), 0, 1, 'R');
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'Estimado(a), '.$prospecto->Contacto_RH.'.', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, $prospecto->Puesto.', '.$prospecto->Prospecto.'.', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, 'Presente.', 0, 1, 'L');
		
		$y = $this->GetY() + 30;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Es de gran interés para RRHH INGENIA ser para ustedes el principal aliado en servicios de apoyo en materia de recursos humanos, hoy por hoy somos un referente en servicio, calidad e innovación para nuestros clientes y es de sumo interés para nosotros poder ser un proveedor de valor para su organización.'), 0, 'FJ');
		
		$y = $this->GetY() + 30;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('A continuación, presentamos la propuesta económica referente al servicio de'), 0, 'L');
		$this->setXY($this->GetX() + 438, $this->GetY()-15);
		$this->setFont('SinkinSans', 'B', 8);
		$this->Cell(0, 15, 'Psicometrías. ', 0, 1, 'L');

		$this->setFont('SinkinSans', '', 8);
		$y = $this->GetY() + 30;
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'Beneficios. ', 0, 1, 'L');

		$y = $this->GetY() + 30;
		$this->setXY($x, $y);
		$this->Cell(0, 15, '*  Interpretación de resultados en un lapso de 24 horas. ', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, '*  La batería se conforma de acuerdo al perfil solicitado. ', 0, 1, 'L');
		$this->setX($x);
		$this->Cell(0, 15, '*  Sin anticipos. ', 0, 1, 'L');

		$y = $this->GetY() + 30;
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'El costo único por paquete es de ', 0, 1, 'L');
		$this->setXY($this->GetX() + 235, $this->GetY()-15);
		$this->setFont('SinkinSans', 'B', 8);
		$this->Cell(5, 15, ' $'.number_format($precio), 0, 1, 'L');
		$this->setXY($this->GetX() + 268, $this->GetY()-15);
		$this->setFont('SinkinSans', '', 8);
		$this->Cell(0, 15, ' por persona. El precio no incluye IVA.', 0, 1, 'L');

		$y = $this->GetY() + 20;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Esperando haber sido claros en el desarrollo de nuestra propuesta, quedamos a sus órdenes para darle continuidad al tema y así poder apoyarlos con nuestro servicio.'), 0, 'FJ');

		$this->setFont('SinkinSans', 'B', 8);
		$y = $this->GetY() + 30;
		$this->setXY($x, $y);
		$this->MultiCell(0, 15, utf8_encode(' "Esta propuesta tendrá vigencia de un mes".'), 0, 'L');

		$this->setFont('SinkinSans', '', 8);		
		$y = $this->GetY() + 20;
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
