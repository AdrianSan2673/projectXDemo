<?php

class SA extends FPDF
{

	public function setText	($prospecto, $ral, $inv, $ese){
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
		
		$y = $this->GetY() + 15;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Es de gran interés para RRHH INGENIA ser para ustedes el principal aliado en servicios de apoyo en materia de recursos humanos, hoy por hoy somos un referente en servicio, calidad e innovación para nuestros clientes y es de sumo interés para nosotros poder ser un proveedor de valor para su organización.'), 0, 'FJ');
		
		$y = $this->GetY() + 15;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Por lo que hemos integrado a nuestro servicio de línea el REPORTE de ANTECEDENTES LEGALES, lo que resulta un beneficio para usted al ser una herramienta mucho más confiable que una búsqueda en web, innovamos con el uso de la plataforma en beneficio de su proceso y que le permitan optimizar tiempos, esfuerzos y recursos.'), 0, 'L');

		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'Proponemos y ponemos a su consideración lo siguiente:', 0, 1, 'L');

		$y = $this->GetY() + 10;
		$this->setXY($x + 30, $y);
		$this->MultiCellBlt(408, 15, '1.', utf8_encode('Nuestro servicio inicia con la obtención de un reporte de antecedentes legales, un reporte de índole laboral, penal, civil y/o mercantil (demandas por deudas) y toda información del candidato que pueda servir para descartar que sea conflictivo o de riesgo si fuera contratado.'));

		$y = $this->GetY();
		$this->setXY($x + 30, $y);
		$this->MultiCellBlt(408, 15, '2.', utf8_encode('Hacer más completa la parte de investigación laboral, es decir validar empleadores en el periodo de los dos últimos años laborados, incluso si está trabajando solicitar un recibo de nómina reciente.'));

		$y = $this->GetY();
		$this->setXY($x + 30, $y);
		$this->MultiCellBlt(408, 15, '3.', utf8_encode('Asegurarnos que no sea una persona con conflictos laborales, malas notas o faltas de probidad en sus empleos anteriores.'));

		$y = $this->GetY();
		$this->setXY($x + 30, $y);
		$this->MultiCellBlt(408, 15, '4.', utf8_encode('Obtención de empleos no declarados por el candidato y realizar la investigación correspondiente cuando existan dichos empleos ocultos.'));

		$y = $this->GetY();
		$this->setXY($x + 30, $y);
		$this->MultiCellBlt(408, 15, '5.', utf8_encode('En caso de que no se pueda obtener referencias directamente con RH, solicitaremos las constancias correspondientes, mismas que deberán coincidir con las bases de datos de empleos o registros patronales. Así mismo y contando con lo anterior, podremos validar con el jefe inmediato su desempeño, siempre explicando por qué no fue posible que RH nos diera información.'));

		$y = $this->GetY();
		$this->setXY($x + 30, $y);
		$this->MultiCellBlt(408, 15, '6.', utf8_encode('Continuar con la programación de la verificación domiciliaria en caso de detectar que el candidato no es viable para contratación ya sea por registros legales o por referencias laborales, en ese momento se detiene el proceso y se ajusta la tarifa del servicio. Logrando no generar costos innecesarios para ustedes como clientes.'));
		
		$this->addPage();
		$y = $this->getY() + 60;
		$this->setXY($x, $y);
		$this->Cell(0, 15, 'Para tal efecto sugerimos la siguiente tabulación:', 0, 1, 'L');
		$this->SetFillColor(51, 54, 79);
		$this->SetTextColor(255, 255, 255);
		$this->setFont('SinkinSans', 'B', 8);
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(78, 15, utf8_encode('Fases'), 1, 'C', true);
		$this->setXY($x + 78, $y);
		$this->MultiCell(120, 15, utf8_encode('Concepto'), 1, 'C', true);
		$this->setXY($x + 198, $y);
		$this->MultiCell(90, 15, utf8_encode('Precio'), 1, 'C', true);
		$this->setXY($x + 288, $y);
		$this->MultiCell(150, 15, utf8_encode('Descripción'), 1, 'C', true);

		/* $y = $this->GetY();
		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(38, 48, 76);
		$this->setXY($x, $y);
		$this->MultiCell(78, 75, utf8_encode('1er fase'), 1, 'C');

		$this->setFont('SinkinSans', 'B', 8);
		$this->setXY($x + 78, $y);
		$this->MultiCell(120, 75, utf8_encode(''), 1, 'C');
		$this->setXY($x + 78, $y);
		$this->MultiCell(120, 15, utf8_encode('Revisión de antecedentes legales.'), 0, 'L');

		$this->setFont('SinkinSans', '', 8);
		$this->setXY($x + 78, $this->getY());
		$this->MultiCell(120, 15, utf8_encode('Costo cuando el candidato sólo avanza hasta esta fase.'), 0, 'L');

		$this->setXY($x + 198, $y);
		$this->MultiCell(90, 75, utf8_encode('$'.number_format($ral).' + IVA'), 1, 'C');


		$this->setXY($x + 288, $y);
		$this->MultiCell(150, 15, utf8_encode('* Se revisan los antecedentes legales del candidato y se comparten los resultados por correo electrónico.                        * Tiempo de entrega 24 horas.'), 1, 'L'); */


		$y = $this->GetY();
		$this->setFont('SinkinSans', '', 8);
		$this->setTextColor(38, 48, 76);
		$this->setXY($x, $y);
		$this->MultiCell(78, 210, utf8_encode('1er fase'), 1, 'C');

		$this->setFont('SinkinSans', 'B', 8);
		$this->setXY($x + 78, $y);
		$this->MultiCell(120, 210, utf8_encode(''), 1, 'C');
		$this->setXY($x + 78, $y + 60);
		$this->MultiCell(120, 15, utf8_encode('Investigación Laboral.'), 0, 'L');

		$this->setFont('SinkinSans', '', 8);
		$this->setXY($x + 78, $this->getY() + 20);
		$this->MultiCell(120, 15, utf8_encode('Costo total si se obtuvo la investigación laboral se detiene el proceso.'), 0, 'L');

		$this->setXY($x + 198, $y);
		$this->MultiCell(90, 210, utf8_encode('$'.number_format($inv).' + IVA'), 1, 'C');

		$this->setXY($x + 288, $y);
		$this->MultiCell(150, 15, utf8_encode('* Se revisan los antecedentes legales del candidato y se comparten los resultados por medio de la plataforma.               * Investigación de referencias laborales de los dos últimos años. (se puede ampliar el periodo a solicitud del cliente).    * Aseguramos que no sea una persona inestable.                         *  Obtención de empleos no declarados por el candidato y realizar la investigación correspondiente.'), 1, 'L');



		$y = $this->GetY();
		$this->setXY($x, $y);
		$this->MultiCell(78, 195, utf8_encode('2da fase'), 1, 'C');

		$this->setFont('SinkinSans', 'B', 8);
		$this->setXY($x + 78, $y);
		$this->MultiCell(120, 195, utf8_encode(''), 1, 'C');
		$this->setXY($x + 78, $y + 30);
		$this->MultiCell(120, 15, utf8_encode('Verificación domiciliaria.'), 0, 'L');

		$this->setFont('SinkinSans', '', 8);
		$this->setXY($x + 78, $this->getY() + 20);
		$this->MultiCell(120, 15, utf8_encode('Costo total y único si se completa todo el proceso con la verificación domiciliaria.'), 0, 'L');

		$this->setXY($x + 198, $y);
		$this->MultiCell(90, 195, utf8_encode('$'.number_format($ese).' + IVA'), 1, 'C');

		$this->setXY($x + 288, $y);
		$this->MultiCell(150, 15, utf8_encode('* Corroboramos aspectos relacionados con situación del inmueble, cuadro familiar, ingresos y egresos, cotejo de documentación (personal y laboral) y referencias (personales y vecinales).              * Fotografía del interior y exterior del domicilio.                   * Fotografía del candidato.       * Ubicación con geolocalización del domicilio candidato.'), 1, 'L');
		
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(438, 15, utf8_encode('Esperando haber sido claros en el desarrollo de nuestra propuesta, quedamos a sus órdenes para darle continuidad al tema y así poder apoyarlos en el mejor desarrollo de nuestro servicio.                 '), 0, 'FJ');

		$this->setFont('SinkinSans', 'B', 8);
		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(0, 15, utf8_encode(' "Esta propuesta tendrá vigencia de un mes".'), 0, 'L');

		$this->setFont('SinkinSans', '', 8);
		$y = $this->GetY() + 20;
		$this->setXY($x + 30, $y);
		$this->MultiCellBlt(408, 15, '*', utf8_encode('Contacto por parte de RRHH Ingenia:'));

		$y = $this->GetY() + 10;
		$this->setXY($x, $y);
		$this->MultiCell(0, 15, utf8_encode($_SESSION['identity']->first_name.' '.$_SESSION['identity']->last_name.'    |    '.$_SESSION['identity']->user_type.'    |    '.$_SESSION['identity']->email), 0, 'L');

		$y = $this->GetY() + 10;
		$this->setFont('SinkinSans', '', 6);
		$this->setXY($x + 340, $y);
		$this->MultiCellBlt(408, 15, '*', utf8_encode('Precios no incluyen IVA.'));
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
