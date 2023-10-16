<?php

class DC3 extends FPDF
{


	public function setDatosTrabajador($data){
		$this->AddPage();
		$x = 25;
		$y = 72;

		$this->setFont('ArialMT', '', 11);
		$this->setXY($x, $y);
		$this->MultiCell(562, 12, 'FORMATO DC-3', 0, 'C', false);

		$y = $this->GetY();

		$this->setFont('Arial', 'B', 11.5);
		$this->setXY(192, $y);
		$this->MultiCell(226, 12, 'CONSTANCIA DE COMPETENCIAS O DE HABILIDADES LABORALES', 0, 'C', false);

		$this->SetFillColor(0, 0, 0);
		$this->setTextColor(255, 255, 255);

		$y = $this->GetY() + 6;

		$this->setFont('Arial', 'B', 10);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, 'DATOS DEL TRABAJADOR', 0, 'C', true);

		$y = $this->GetY();

		$this->SetFillColor(255, 255, 255);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(562, 33, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 7.5);
		$this->setXY($x, $y);
		$this->MultiCell(240, 12, 'Nombre (Anotar apellido paterno, apellido materno y nombre (s))', 0, 'L', false);

		$y = $this->GetY() + 4;

		$this->setFont('Arial', '', 8);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, strtoupper(utf8_encode(Utils::removeAccents($data->first_name.' '.$data->surname.' '.$data->last_name))), 0, 'L', false);

		$y = $this->GetY() - 3;

		$this->setXY($x, $y);
		$this->MultiCell(281, 27, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 7.5);
		$this->setXY($x, $y);
		$this->MultiCell(240, 12, utf8_encode('Clave Única de Registro de Población'), 0, 'L', false);

		$this->setXY($x + 281, $y);
		$this->MultiCell(281, 27, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 7.5);
		$this->setXY($x + 281, $y);
		$this->MultiCell(240, 12, utf8_encode('Ocupación específica (Catálogo Nacional de Ocupaciones)'), 0, 'L', false);

		$this->setFont('ArialMT-Light', '', 5);
		$this->setXY(504, $y);
		$this->MultiCell(10, 10, utf8_encode('1/'), 0, 'L', false);

		$y = $this->GetY() + 1;

		$curp = str_split(strtoupper($data->curp));

		$this->setFont('Arial', '', 8);
		$this->setXY($x, $y);
		$this->MultiCell(20, 8, " ".$curp[0]."\n ", 'R', 'C', false);
		$x = $x + 20;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[1]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[2]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[3]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[4]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[5]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[6]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[7]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[8]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[9]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[10]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[11]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[12]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(20, 8, $curp[13]." \n ", 'R', 'C', false);
		$x = $x + 20;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[14]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[15]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[16]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $curp[17]." \n ", 0, 'C', false);
		$x = $x + 22;
		$this->setXY($x, $y);
		$this->MultiCell(30, 8, $data->clave_ocupacion."\n ", 0, 'L', false);

		$x = 25;
		$y = $this->GetY();

		$this->SetFillColor(255, 255, 255);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(562, 27, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 9);
		$this->setXY($x, $y);
		$this->MultiCell(240, 12, 'Puesto*', 0, 'L', false);

		$y = $this->GetY() - 5;

		$this->setFont('Arial', '', 8);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, strtoupper(utf8_encode(Utils::removeAccents($data->title))), 0, 'L', false);

		$this->SetY($this->GetY() + 6);
	}

	public function setDatosEmpresa($data){
		$this->SetFillColor(0, 0, 0);
		$this->setTextColor(255, 255, 255);
		$x = 25;
		$y = $this->GetY();

		$this->setFont('Arial', 'B', 10);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, 'DATOS DE LA EMPRESA', 0, 'C', true);

		$y = $this->GetY();

		$this->SetFillColor(255, 255, 255);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(562, 33, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 7.5);
		$this->setXY($x, $y);
		$this->MultiCell(562, 12, utf8_encode('Nombre o razón social (En caso de persona física, anotar apellido paterno, apellido materno y nombre(s))'), 0, 'L', false);

		$y = $this->GetY() + 4;

		$this->setFont('Arial', '', 8);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, strtoupper(utf8_encode(Utils::removeAccents($data->Razon))), 0, 'L', false);

		$y = $this->GetY() - 3;

		$this->setXY($x, $y);
		$this->MultiCell(562, 27, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 7.5);
		$this->setXY($x, $y);
		$this->MultiCell(562, 12, utf8_encode('Registro Federal de Contribuyentes con homoclave (SHCP)'), 0, 'L', false);

		$y = $this->GetY() - 1;

		$rfc = $data->RFC;

		$this->setFont('Arial', '', 8);
		$this->setXY($x, $y);
		$this->MultiCell(20, 8, "  \n ", 'R', 'C', false);
		$x = $x + 20;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[0]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[1]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[2]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, "-\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[3]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[4]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[5]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[6]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[7]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[8]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, "-\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[9]."\n ", 'R', 'C', false);
		$x = $x + 14.7;
		$this->setXY($x, $y);
		$this->MultiCell(20, 8, $rfc[10]." \n ", 'R', 'C', false);
		$x = $x + 20;
		$this->setXY($x, $y);
		$this->MultiCell(14.7, 8, $rfc[11]."\n ", 'R', 'C', false);
		
		$this->SetY($this->GetY() + 6);
	}

	public function setDatosCapacitacion($data){
		$this->SetFillColor(0, 0, 0);
		$this->setTextColor(255, 255, 255);
		$x = 25;
		$y = $this->GetY();

		$this->setFont('Arial', 'B', 10);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, utf8_encode('DATOS DEL PROGRAMA DE CAPACITACIÓN, ADIESTRAMIENTO Y PRODUCTIVIDAD'), 0, 'C', true);

		$y = $this->GetY();

		$this->SetFillColor(255, 255, 255);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(562, 33, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 9);
		$this->setXY($x, $y);
		$this->MultiCell(562, 12, 'Nombre del curso', 0, 'L', false);

		$y = $this->GetY() + 4;

		$this->setFont('Arial', '', 8);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, strtoupper(utf8_encode(Utils::removeAccents($data->training))), 0, 'L', false);

		$y = $this->GetY() - 3;

		$this->setXY($x, $y);
		$this->MultiCell(562, 27, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 7);
		$this->setXY($x, $y);
		$this->MultiCell(156, 12, utf8_encode('DURACIÓN EN HORAS'), 0, 'L', false);

		$this->setXY($x, $y);
		$this->MultiCell(156, 27, '', 1, 'C', false);

		$this->setFont('Arial', '', 7);
		$this->setXY($x + 156, $y);
		$this->MultiCell(40, 7, utf8_encode(" \nPeriodo de ejecución\n "), 0, 'L', false);

		$this->setXY($x + 156, $y);
		$this->MultiCell(72, 27, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 7);
		$this->setXY($x + 228, $y);
		$this->MultiCell(64, 12, utf8_encode('Año'), 0, 'C', false);

		$this->setXY($x + 228, $y);
		$this->MultiCell(64, 27, '', 1, 'C', false);

		$this->setXY($x + 292, $y);
		$this->MultiCell(42, 12, utf8_encode('Mes'), 0, 'C', false);

		$this->setXY($x + 292, $y);
		$this->MultiCell(42, 27, '', 1, 'C', false);

		$this->setXY($x + 334, $y);
		$this->MultiCell(42, 12, utf8_encode('Día'), 0, 'C', false);

		$this->setXY($x + 334, $y);
		$this->MultiCell(42, 27, '', 1, 'C', false);

		$this->setXY($x + 376, $y);
		$this->MultiCell(21, 27, '', 1, 'C', false);

		

		$this->setXY($x + 397, $y);
		$this->MultiCell(78, 12, utf8_encode('Año'), 0, 'C', false);

		$this->setXY($x + 397, $y);
		$this->MultiCell(78, 27, '', 1, 'C', false);

		$this->setXY($x + 475, $y);
		$this->MultiCell(43, 12, utf8_encode('Mes'), 0, 'C', false);

		$this->setXY($x + 475, $y);
		$this->MultiCell(43, 27, '', 1, 'C', false);

		$this->setXY($x + 518, $y);
		$this->MultiCell(44, 12, utf8_encode('Día'), 0, 'C', false);

		$this->setXY($x + 518, $y);
		$this->MultiCell(44, 27, '', 1, 'C', false);

		$y = $this->GetY() - 12;

		$this->setFont('Arial', '', 7);
		$x = 236;
		$this->setXY($x, $y);
		$this->MultiCell(15, 8, "De\n ", '', 'L', false);

		$y = $this->GetY() - 20;

		$start_date = date_format(date_create($data->start_date), 'Ymd');
		$end_date = date_format(date_create($data->end_date), 'Ymd');

		$this->setFont('Arial', '', 8);
		$x = 253;
		$this->setXY($x, $y);
		$this->MultiCell(16, 8, $start_date[0]."\n ", 'R', 'C', false);
		$x = $x + 16;
		$this->setXY($x, $y);
		$this->MultiCell(16, 8, $start_date[1]."\n ", 'R', 'C', false);
		$x = $x + 16;
		$this->setXY($x, $y);
		$this->MultiCell(16, 8, $start_date[2]."\n ", 'R', 'C', false);
		$x = $x + 16;
		$this->setXY($x, $y);
		$this->MultiCell(16, 8, $start_date[3]."\n ", 'R', 'C', false);
		$x = $x + 16;
		$this->setXY($x, $y);
		$this->MultiCell(21, 8, $start_date[4]."\n ", 'R', 'C', false);
		$x = $x + 21;
		$this->setXY($x, $y);
		$this->MultiCell(21, 8, $start_date[5]."\n ", 'R', 'C', false);
		$x = $x + 21;
		$this->setXY($x, $y);
		$this->MultiCell(21, 8, $start_date[6]."\n ", 'R', 'C', false);
		$x = $x + 21;
		$this->setXY($x, $y);
		$this->MultiCell(21, 8, $start_date[7]."\n ", 'R', 'C', false);
		$x = $x + 21;
		$this->setXY($x, $y);
		$this->MultiCell(21, 8, "A\n ", 'R', 'C', false);
		$x = $x + 21;
		$this->setXY($x, $y);
		$this->MultiCell(19.5, 8, $end_date[0]."\n ", 'R', 'C', false);
		$x = $x + 19.5;
		$this->setXY($x, $y);
		$this->MultiCell(19.5, 8, $end_date[1]."\n ", 'R', 'C', false);
		$x = $x + 19.5;
		$this->setXY($x, $y);
		$this->MultiCell(19.5, 8, $end_date[2]."\n ", 'R', 'C', false);
		$x = $x + 19.5;
		$this->setXY($x, $y);
		$this->MultiCell(19.5, 8, $end_date[3]."\n ", 'R', 'C', false);
		$x = $x + 19.5;
		$this->setXY($x, $y);
		$this->MultiCell(21.75, 8, $end_date[4]."\n ", 'R', 'C', false);
		$x = $x + 21.75;
		$this->setXY($x, $y);
		$this->MultiCell(21.75, 8, $end_date[5]."\n ", '', 'C', false);
		$x = $x + 21.75;
		$this->setXY($x, $y);
		$this->MultiCell(22, 8, $end_date[6]."\n ", 'R', 'C', false);
		$x = $x + 22;
		$this->setXY($x, $y);
		$this->MultiCell(22, 8, $end_date[7]."\n ", '', 'C', false);
		
		$this->SetY($this->GetY() + 6);

		$x = 25;
		$this->setXY($x, $y);
		$this->MultiCell(156, 16, $data->hours, 0, 'C', false);

		$y = $this->GetY();

		$this->setXY($x, $y);
		$this->MultiCell(562, 25, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 9);
		$this->setXY($x, $y);
		$this->MultiCell(562, 12, utf8_encode('Área temática del curso'), 0, 'L', false);

		$this->setFont('ArialMT-Light', '', 5);
		$this->setXY(122, $y);
		$this->MultiCell(10, 10, utf8_encode('2/'), 0, 'L', false);

		$y = $this->GetY() - 3;

		$this->setFont('Arial', '', 8);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, strtoupper(utf8_encode(str_replace('-', '. ', $data->area_tematica))), 0, 'L', false);

		$y = $this->GetY() - 2;

		$this->setXY($x, $y);
		$this->MultiCell(562, 30, '', 1, 'C', false);

		$this->setFont('ArialMT', '', 7);
		$this->setXY($x, $y);
		$this->MultiCell(156, 12, utf8_encode('Nombre del agente capacitador o STPS'), 0, 'L', false);

		$this->setFont('ArialMT-Light', '', 5);
		$this->setXY(150, $y);
		$this->MultiCell(10, 10, utf8_encode('3/'), 0, 'L', false);

		$y = $this->GetY() + 2;

		$this->setFont('Arial', '', 8);
		$this->setXY($x, $y);
		$this->MultiCell(562, 20, strtoupper(utf8_encode($data->training_agent)), 0, 'L', false);
	}

	public function setDatosFirmas($data){
		$x = 25;
		$y = $this->GetY() + 7;

		$this->SetFillColor(255, 255, 255);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(562, 126, '', 1, 'C', false);

		$this->setFont('Arial', 'B', 8);
		$this->setXY($x + 25, $y + 2);
		$this->MultiCell(512, 11, 'Los datos se asientan en esta constancia bajo protesta de decir verdad, apercibidos de la responsabilidad en que incurre todo aquel que no se conduce con verdad.', 0, 'C', false);

		$y = $this->GetY() + 18;

		$this->setFont('Arial', '', 8);
		$this->setXY(78, $y);
		$this->MultiCell(64, 13, 'Instructor o tutor', 0, 'L', false);

		$this->setXY(256, $y);
		$this->MultiCell(115, 13, utf8_encode('Patrón o Representante legal'), 0, 'L', false);

		$this->setXY(430, $y);
		$this->MultiCell(130, 13, utf8_encode('Representante de los trabajadores'), 0, 'L', false);

		$this->Line(53, 548, 185, 548);
		$this->Line(253, 548, 383, 548);
		$this->Line(433, 548, 573, 548);

		$x = 25;
		$y = 565;

		$this->setFont('Arial', '', 7);
		$this->setXY($x, $y);
		$this->MultiCell(170, 13, utf8_encode($data->instructor), 0, 'C', false);

		$this->setXY(230, $y);
		$this->MultiCell(170, 13, utf8_encode('EDGAR IVAN OLVERA BETANZOS'), 0, 'C', false);

		$this->setXY(420, $y);
		$this->MultiCell(170, 13, utf8_encode('ACELA FABIOLA ESPINOSA ZAVALA'), 0, 'C', false);
	}

	public function setInstrucciones(){
		$x = 84;
		$y = $this->GetY() + 12;

		$this->setTextColor(0, 0, 0);

		$this->setFont('Arial', 'B', 9);
		$this->setXY($x, $y);
		$this->MultiCell(462, 11, 'INSTRUCCIONES', 0, 'L', false);

		$x = 90;
		$y = $this->GetY();

		$this->setFont('ArialMT', '', 6.5);
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('    -  Llenar a máquina o con letra de molde.'), 0, 'L', false);

		$y = $this->GetY();
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('    -  Deberá entregarse al trabajador dentro de los veinte días hábiles siguientes al término del curso de capacitación aprobado.'), 0, 'L', false);

		$y = $this->GetY();
		$this->setFont('ArialMT-Light', '', 5);
		$this->setXY($x, $y);
		$this->MultiCell(10, 8, utf8_encode('1/'), 0, 'L', false);
		$this->setFont('ArialMT', '', 6.5);
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('     Las áreas y subáreas ocupacionales del Catálogo Nacional de Ocupaciones se encuentran disponibles en el reverso de este formato y en la página'), 0, 'L', false);
		
		$this->setFont('ArialMT', 'U', 6.5);
		$y = $this->GetY();
		$this->setTextColor(0, 0, 255);
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('www.stps.gob.mx'), 0, 'L', false);

		$y = $this->GetY();
		$this->setFont('ArialMT-Light', '', 5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(10, 8, utf8_encode('2/'), 0, 'L', false);
		$this->setFont('ArialMT', '', 6.5);
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('     Las áreas temáticas de los cursos se encuentran disponibles en el reverso de este formato y en la página'), 0, 'L', false);
		$this->setFont('ArialMT', 'U', 6.5);
		$this->setTextColor(0, 0, 255);
		$this->setXY(405, $y);
		$this->MultiCell(462, 10, utf8_encode('www.stps.gob.mx'), 0, 'L', false);

		$y = $this->GetY();
		$this->setFont('ArialMT-Light', '', 5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(10, 8, utf8_encode('3/'), 0, 'L', false);
		$this->setFont('ArialMT', '', 6.5);
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('     Cursos impartidos por el área competente de la Secretaria del Trabajo y Previsión Social.'), 0, 'L', false);

		$y = $this->GetY();
		$this->setFont('ArialMT-Light', '', 5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(10, 8, utf8_encode('4/'), 0, 'L', false);
		$this->setFont('ArialMT', '', 6.5);
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('     Para empresas con menos de 51 trabajadores. Para empresas con más de 50 trabajadores firmaría el representante del patrón ante la '), 0, 'L', false);

		$y = $this->GetY();
		$this->setXY($x + 30, $y);
		$this->MultiCell(462, 10, utf8_encode('    Comisión mixta de capacitación, adiestramiento y productividad.'), 0, 'L', false);

		$y = $this->GetY();
		$this->setFont('ArialMT-Light', '', 5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x, $y);
		$this->MultiCell(10, 8, utf8_encode('5/'), 0, 'L', false);
		$this->setFont('ArialMT', '', 6.5);
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('     Solo para empresas con más de 50 trabajadores'), 0, 'L', false);

		$y = $this->GetY();
		$this->setXY($x, $y);
		$this->MultiCell(462, 10, utf8_encode('*Dato no obligatorio'), 0, 'L', false);
	}
}
