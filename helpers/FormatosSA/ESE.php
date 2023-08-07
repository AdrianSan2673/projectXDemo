<?php

class ESE extends FPDF
{

	public $tieneHeader;
	public $tieneFooter = false;
	public $seccionHeader;
	public $headerDocumento = true;
	public $headerEconomia = true;
	public $nombre;
	
	public $id_empresa;
	public $id_cliente;


	public $qr;
	public $Enlace_Drive;

	public function setPortada($candidato, $viabilidad){
		$this->Image('dist/img/isotipo-colores.png', 395, -130, 350, 0);
		$this->Image('dist/img/imagotipo-colores-3.png', 28, 203, 235, 0);

		$this->setTextColor(51, 54, 79);

		$x = 32;
		$y = 308;

		$this->setFont('SinkinSansBold', 'B', 45);
		$this->setXY($x, $y);

		//$this->MultiCell(370, 44, 'REPORTE DE ESTUDIO', 0,'L');
		$this->Write(48,$this->id_cliente==662?'ESTUDIO':'REPORTE');//Formato RADEC
		
		$y = $this->GetY() + 53;
		$this->SetXY($x, $y);
		$this->Write(48, utf8_encode($this->id_cliente==662?'SOCIOECONOMICO':'VERIFICACIÓN'));//Formato RADEC

		$this->setTextColor(158, 198, 58);
		$y = $this->GetY() + 53;
		$this->SetXY($x, $y);
		$this->Write(48, $this->id_cliente==662?'BECAS':'DOMICILIARIA');//Formato RADEC

		$this->setFont('SinkinSans', 'B', 12);
		$this->setTextColor(51, 54, 79);
		$y = $this->GetY() + 70;
		$this->SetXY($x, $y);
	
		if ($this->id_cliente == 662) { //Formato RADEC
			$this->Write(15, 'INSTITUTO:');
			$x1 = $this->GetX() + 10;
			$this->SetX($x1);
		} else {
			$this->Write(15, 'PARA:');
			$x1 = $this->GetX() + 10;
			$this->SetX($x1);
		}
		
		
	if ($this->id_cliente == 662 || $this->id_cliente == 668 ) { //Formato RADEC
			$this->MultiCell(180, 20, utf8_encode($candidato->Nombre_Cliente), 1, 'L');
		} else if ($candidato->Cliente == 366 || $this->id_cliente == 673 || $this->id_cliente == 598 || $this->id_cliente == 593 || $this->id_cliente == 599|| $this->id_cliente == 668|| $this->id_cliente == 660|| $this->id_cliente == 708) {
			$this->MultiCell(200, 20, utf8_encode($candidato->Nombre_Cliente), 1, 'L');
		} else {
			$this->MultiCell(200, 20, utf8_encode($candidato->Razon == 'GRUPO JANFREX S.A. DE C.V.' ? 'GRUPO JANFREX' : ($candidato->Razon == 'INNOVACIÓN HORUS S.A DE C.V' ? 'INNOVACIÓN HORUS' : ($candidato->Empresa == 'La Casa de Cementín' || $candidato->Empresa == 'DUCTOS DEL ALTIPLANO SA DE CV' ? $candidato->Nombre_Cliente : ($candidato->ID_Empresa == 315 ? $candidato->Nombre_Cliente : $candidato->Empresa)))), 1, 'L');
		}

		$x1 = 306;
		$this->SetXY($x1, $y);
		$this->Write(15, $this->id_cliente == 662 ? 'SOLICITANTE:' : 'DE:');

		if ($this->id_cliente == 662) { //Formato RADEC
			$x1 = $this->GetX() + 10;
			$this->SetX($x1);
			$this->MultiCell(180, 20, $this->nombre, 1, 'L');
		} else {
			$x1 = $this->GetX() + 10;
			$this->SetX($x1);
			$this->MultiCell(200, 20, $this->nombre, 1, 'L');
		}

		//if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA' || $candidato->ID_Empresa == 137) {
			$this->setFont('SinkinSans', 'B', 11);
			$y = $this->GetY() + 50;
			$x1 = $x + 25;
			$this->SetXY($x1, $y);
			$this->Circle($x1 - 15, $y + 4, 8, 'D');
			if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
				$this->Write(15, 'Cubre perfil');
			}else{
				$this->Write(15, $this->id_cliente == 662 ? 'Candidato a apoyo' : 'Viable'); //Formato RADEC
			}

			if ($viabilidad == '0') {
				$this->SetFillColor(43, 179, 73);
				$this->Circle($x1 - 15, $y + 4, 6, 'F');
			}

			if ($this->id_cliente != 662) { //Formato RADEC
			$x1 = $this->GetX() + 100;
			$this->SetXY($x1, $y);
			$this->Circle($x1 - 15, $y + 4, 8, 'D');
			if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
				$this->Write(15, 'No cubre perfil');
			} else {
				$this->Write(15, 'No viable');
			}
		}

			if($viabilidad == 1){
				$this->SetFillColor(255, 16, 16);
				$this->Circle($x1 - 15, $y + 4, 6, 'F');
			}

			$x1 = $this->GetX() + 100;
			$this->SetXY($x1, $y);
			$this->Circle($x1 - 15, $y + 4, 8, 'D');
			if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
				$this->Write(15, 'A reserva del perfil');
			}else{
				$this->Write(15, $this->id_cliente == 662 ? 'No es candidato a apoyo' : 'Viable con reservas'); //Formato RADEC
			}
			
			if($viabilidad == 2){
				$this->SetFillColor(243, 238, 82);
				$this->Circle($x1 - 15, $y + 4, 6, 'F');
			}

			if ($this->id_empresa == 35 && $this->id_cliente != 662) {
				$x1 = $x + 25;
				$y = $this->GetY() + 40;
				$this->SetXY($x1, $y);
				$this->Circle($x1 - 15, $y + 4, 8, 'D');
				$this->Write(15, 'Viable con observaciones');

				if ($viabilidad == 5) {
					$this->SetFillColor(244, 134, 30);
					$this->Circle($x1 - 15, $y + 4, 6, 'F');
				}
			}
		//}

			

		$this->SetFillColor(255, 255, 255);
		if (!empty($candidato->Verificador) && ($candidato->Verificador) <>' ' && $this->id_cliente != 662) //Formato RADEC
		{
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			//$this->setXY(32, 685);
			$this->setXY(32, 650);
			$this->MultiCell(250, 10, utf8_encode('Verificador Domiciliar: '), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			//$this->setXY(117, 685);
			$this->setXY(117, 650);
			$this->MultiCell(250, 10, utf8_encode($candidato->Verificador), 0, 'L', true);
		}

		if (!empty($candidato->Analista) && ($candidato->Analista) <> ' ') {
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			//$this->setXY(338, 685);
			$this->setXY(32, 685);
			$this->MultiCell(250, 10, utf8_encode('Analista: '), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			//$this->setXY(378, 685);
			$this->setXY(72, 685);
			$this->MultiCell(250, 10, utf8_encode($candidato->Analista), 0, 'L', true);
		}	
	}

	public function setDatosGenerales($candidato, $foto){
		$this->seccionHeader = 1;
		$this->AddPage();
		$this->seccionHeader = false;
		$this->tieneFooter = true;
		$y = 72;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'DATOS GENERALES');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(160, 160, 160);
		$x = 25;
		$y = $this->GetY() + 25;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(46, 15, 'Nombre', 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);
		
		if ($candidato->Cliente==139) {//Grupo FH
			$this->MultiCell(410, 18, strtoupper(Utils::eliminarAcentos($candidato->Apellido_Paterno . ' ' . $candidato->Apellido_Materno . ' ' . $candidato->Nombres)), 0, 'C', true);
		}else{
			$this->MultiCell(410, 18, utf8_encode($candidato->Nombres . ' ' . $candidato->Apellido_Paterno . ' ' . $candidato->Apellido_Materno), 0, 'C', true);
		}
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(160, 160, 160);
		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(46, 8, $this->id_cliente == 662 ? 'Organizacion' : 'Empresa', 0, 'L', false); //Formato RADEC

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);
		
		if($candidato->Cliente ==366||$candidato->Cliente ==626  || $candidato->Cliente ==668  || $this->id_cliente == 673  || $this->id_cliente == 598 || $this->id_cliente == 593 || $this->id_cliente == 599|| $this->id_cliente == 668|| $this->id_cliente == 660|| $this->id_cliente == 708){

			$this->MultiCell(410, 18, utf8_encode( $candidato->Nombre_Cliente), 0, 'C', true);
		}else{
			$this->MultiCell(410, 18, utf8_encode($candidato->Razon == 'GRUPO JANFREX S.A. DE C.V.' ? 'GRUPO JANFREX' : ($candidato->Razon == 'INNOVACIÓN HORUS S.A DE C.V' ? 'INNOVACIÓN HORUS' : ($candidato->Empresa == 'La Casa de Cementín' || $candidato->Empresa == 'DUCTOS DEL ALTIPLANO SA DE CV' ? $candidato->Nombre_Cliente : ($candidato->ID_Empresa == 315 ? $candidato->Nombre_Cliente : $candidato->Empresa)))), 0, 'C', true);
		}
		
		
		//$this->MultiCell(410, 18, utf8_encode($candidato->Razon == 'GRUPO JANFREX S.A. DE C.V.' ? 'GRUPO JANFREX' : ($candidato->Razon == 'INNOVACIÓN HORUS S.A DE C.V' ? 'INNOVACIÓN HORUS' : ($candidato->Empresa == 'La Casa de Cementín' || $candidato->Empresa == 'DUCTOS DEL ALTIPLANO SA DE CV' ? $candidato->Nombre_Cliente : ($candidato->ID_Empresa == 315 ? $candidato->Nombre_Cliente : $candidato->Empresa)))), 0, 'C', true);


		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(160, 160, 160);
		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(52, 8, utf8_encode('Fecha de aplicación'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);
		$this->MultiCell(410, 18, $candidato->Fecha_Aplicacion ? Utils::getDate($candidato->Fecha_Aplicacion) : '', 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(160, 160, 160);
		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(52, 8, utf8_encode('Puesto'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);
		$this->MultiCell(410, 18, $candidato->Puesto ? utf8_encode($candidato->Puesto) : '', 0, 'C', true);

        $this->ClippingCircle(545, 153, 50);
		if (!$foto) {
			if ($candidato->Sexo == 99) {
				$foto = array('dist/img/user-icon-rose.png', 'png');
			}else{
				$foto = array('dist/img/user-icon.png', 'png');
			}
			
		}
		$pic = getimagesize($foto[0]);
		if ($pic[2] != 2)
			$foto[1] = 'png';
		else
			$foto[1] = 'jpg';

	        $this->Image($foto[0], 495, 98, 100, 0, $foto[1]);

		$this->UnsetClipping();
	}

	public function setDatosPersonales($candidato){
		$y = $this->GetY() + 25;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'DATOS PERSONALES');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$x1 = 315;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Fecha de nacimiento'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(123, $y);
		$this->MultiCell(182, 18, ($candidato->Nacimiento), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('Edad'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 60, $y);
		$this->MultiCell(55, 18, utf8_encode($candidato->Edad.' años'), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1 + 126, $y);
		$this->MultiCell(50, 18, utf8_encode('Sexo'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 165, $y);
		$this->MultiCell(115, 18, Utils::getSexo($candidato->Sexo), 0, 'C', true);

		$y = $this->GetY() + 5;

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Lugar de nacimiento'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(123, $y);
		$this->MultiCell(182, 18, utf8_encode($candidato->Lugar_Nacimiento), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('Estado civil'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 60, $y);
		$this->MultiCell(55, 18, utf8_encode(Utils::getEstadoCivil($candidato->Estado_Civil)), 0, 'C', true);

		/*$y = $this->GetY() + 5;

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Fecha de matrimonio'), 0, 'L', false);

		$this->setXY(123, $y);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$resultadoMatrimonio = empty($candidato->Fecha_Matrimonio)|| $candidato->Fecha_Matrimonio==NULL ? 'No Aplica' : $candidato->Fecha_Matrimonio;
		$this->MultiCell(182, 18, utf8_encode($resultadoMatrimonio), 0, 'C', true);*/
		
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1+126, $y);
		$this->MultiCell(200, 18, utf8_encode('No. de hijos'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 200, $y);
		$this->MultiCell(80, 18, $candidato->Hijos, 0, 'C', true);

		$y = $this->GetY() + 5;

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Nacionalidad'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(123, $y);
		$this->MultiCell(182, 18, utf8_encode($candidato->Nacionalidad), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('Vive con'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 60, $y);
		$this->MultiCell(220, 18, utf8_encode($candidato->Vive_con), 0, 'C', true);

		$y = $this->GetY() + 5;
		$x1 = 315;
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(93, 18, utf8_encode('CURP'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(70, $y);
		$this->MultiCell(102, 18, utf8_encode($candidato->CURP), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY(211, $y);
		$this->MultiCell(93, 18, utf8_encode('NSS'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(250, $y);
		$this->MultiCell(93, 18, utf8_encode($candidato->IMSS), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY(397, $y);
		$this->MultiCell(93, 18, utf8_encode('RFC'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(435, $y);
		$this->MultiCell(93, 18, utf8_encode($candidato->RFC), 0, 'C', true);
		
			if ($candidato->Numero_Licencia != null || $candidato->Numero_Licencia != '') {

			$y = $this->GetY() + 5;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(150, $y);
			$this->MultiCell(93, 18, utf8_encode('Numero de Licencia'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(250, $y);
			$this->MultiCell(93, 18, utf8_encode($candidato->Numero_Licencia), 0, 'C', true);
		}
	}

	public function setDatosContacto($candidato, $domicilio){
		$y = $this->GetY() + 18;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'DATOS DE CONTACTO');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$x1 = 290;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(50, 15, 'Domicilio', 0, 'L', false);

		$this->setXY(75, $y);
		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		if (strlen($domicilio) <= 45) {
			$this->MultiCell(205, 18, utf8_encode($domicilio), 0, 'L', true);
		} else {
			$this->MultiCell(205, 9, utf8_encode($domicilio), 0, 'L', true);
		}
		
		if ($candidato->Telefono_fijo) {
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x1, $y);
			$this->MultiCell(60, 18, utf8_encode('Celular'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY($x1 + 45, $y);
			$this->MultiCell(90, 18, utf8_encode($candidato->Celular), 0, 'C', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x1 + 150, $y);
			$this->MultiCell(50, 18, utf8_encode('Tel fijo'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY($x1 + 190, $y);
			$this->MultiCell(110, 18, utf8_encode($candidato->Telefono_fijo), 0, 'C', true);
		} else if($candidato->Celular&&$candidato->Otro_Contacto){
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x1, $y);
			$this->MultiCell(60, 18, utf8_encode('Celular'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY($x1 + 45, $y);
			$this->MultiCell(90, 18, utf8_encode($candidato->Celular), 0, 'C', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x1 + 150, $y);
			$this->MultiCell(50, 18, utf8_encode('Otro contacto'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY($x1 + 190, $y);
			$this->MultiCell(110, 18, utf8_encode($candidato->Otro_Contacto), 0, 'C', true);
			
		}else {
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(315, $y);
			$this->MultiCell(60, 18, utf8_encode('Celular'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(360, $y);
			$this->MultiCell(230, 18, utf8_encode($candidato->Celular), 0, 'C', true);
		}

		$y = $this->GetY() + 5;
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(50, 15, 'Correo', 0, 'C', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);
		$this->MultiCell(515, 18, utf8_encode($candidato->Correos), 0, 'L', true);
	/*
		if (!empty($candidato->Linkedin)) {
			$y = $this->GetY() + 5;
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(50, 15, 'Linkedin', 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(75, $y);
			$this->MultiCell(515, 18, utf8_encode($candidato->Linkedin), 0, 'L', true);
		}
		if(!empty($candidato->Facebook)){
			$y = $this->GetY() + 5;
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(50, 15, 'Facebook', 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(75, $y);
			$this->MultiCell(515, 18, utf8_encode($candidato->Facebook), 0, 'L', true);
		}*/
	}

	public function setConociendoCandidato($conociendo){
		if ($conociendo) {
			$y = $this->GetY() + 25;

			$this->SetFillColor(78, 82, 105);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, 'CONOCIENDO AL CANDIDATO');

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 35;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 10, utf8_encode('¿Por qué te interesó el puesto para el que estás postulándote?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Interes_Puesto), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 15, utf8_encode('¿Qué esperas lograr en caso de ingresar a este empleo?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Que_Esperas_Lograr), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Cuáles son para ti las características más importantes que debe tener un empleo?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Caracteristicas_Empleo), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 17;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Cuál es tu objetivo laboral / profesional?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Objetivo_Laboral), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Qué esperas de una empresa que te contrate?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Que_Esperas_Empresa), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Describe tus principales cualidades'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Cualidades), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué piensas del trabajo en equipo?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Trabajo_Equipo), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué nos dirías de tus últimos 2 jefes?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Ultimos_Jefes), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué vas a aportar a esta empresa en caso de ser contratado?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Que_Esperas_Aportar), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué tan importante es para ti apegarse a la jornada laboral?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Jornada_Laboral), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Cuál es tu principal motivación para trabajar?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Motivacion), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Si platicamos con tus jefes anteriores ¿Qué crees que nos dirían?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Que_Dirian_Jefes_Anteriores), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('De toda tu trayectoria laboral / profesional ¿De qué te sientes más orgulloso?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Orgullo_Trayectoria_Laboral), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 16;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué es lo que no te llegó a gustar de tus empleos anteriores?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->No_Te_Gusto_Empleos_Anteriores), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Actualmente estás en otros procesos?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($conociendo->Estas_Otros_Procesos), 0, 'L', true);

			if ($this->GetY() >= 705) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 8;
			}
		}	
	}

	public function setDatosAdicionales($candidato){
		if (!empty($candidato->Aspiracion) && !empty($candidato->Espera_Empresa)) {
			$y = $this->GetY() + 25;

			$this->SetFillColor(78, 82, 105);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(160, $y);
			$this->Write(10, 'DATOS ADICIONALES DEL CONTACTO');

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 35;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 10, utf8_encode('Tiempo requerido para desplazarse al empleo solicitado'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode(Utils::getTiempoDesplazamiento($candidato->Desplazamiento)), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 15, utf8_encode('¿Tiene alguna actividad adicional que le represente ingreso?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Actividad_Adicional == 1 ? 'Sí. '.$candidato->Cual_Actividad : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Le gustaría continuar estudiando?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Continuar_estudios == 1 ? 'Sí. '.$candidato->Cual_Estudio : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Pertenece o ha pertenecido a algún sindicato?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Sindicato == 1 ? 'Sí. '.$candidato->Cual_Sindicato : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 10, utf8_encode('¿Se ha visto en la necesidad de demandar laboralmente a alguna empresa por falta de pago o injusticia contra usted?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Demanda_Laboral == 1 ? 'Sí.' : 'No.'), 0, 'L', true);

			if ($candidato->Demanda_Laboral == 1) {
				if ($this->GetY() >= 715) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y + 4);
				$this->MultiCell(290, 10, utf8_encode('¿A quién o a qué empresa ha demandado?'), 0, 'L');

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(300, $y);
				$this->MultiCell(295, 18, utf8_encode($candidato->Comentario_Demanda), 0, 'L', true);
			}	
		}	
	}

	public function setDocumentacionPresentada($doc_adjuntos, $Comentario){
		if ($this->GetY() >= 600) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 30;
		}

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('DOCUMENTACIÓN PRESENTADA'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;

		$y = $this->GetY() + 20;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY(455, $y);
		$this->MultiCell(150, 15, utf8_encode('Presentó documento original'), 0, 'C', false);

		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->Write(15, utf8_encode('Documento'));

		$y = $this->GetY() + 5;
		$this->SetXY(455, $y-4);
		$this->MultiCell(70, 15, utf8_encode('Sí'), 0, 'C', false);

		$this->SetXY(528, $y-4);
		$this->MultiCell(70, 15, 'No', 0, 'C', false);

		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('INE por ambos lados'), 0, 'L');

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		if (in_array(269, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}
		
		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Comprobante de Domicilio'), 0, 'L');

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		if (in_array(278, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}

		if ($this->id_cliente != 662) {

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Acta de Nacimiento'), 0, 'L');

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		if (in_array(271, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}
		}
		

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode($this->id_cliente == 662 ? 'Comprobantes de ingreso' : 'Cartas Laborales'), 0, 'L');

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		if (in_array(283, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}

		if ($this->id_cliente != 662) {

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Aviso de Retención o Liberación INFONAVIT'), 0, 'L');

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		if (in_array(285, $doc_adjuntos) || in_array(295, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}

		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}
		}
/*
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(425, 10, utf8_encode('Captura de pantalla redes sociales'), 0, 'L');

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		if (in_array(282, $doc_adjuntos)) {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);
		} else {
			$this->SetXY(455, $y);
			$this->MultiCell(70, 15, '', 0, 'C', true);

			$this->SetXY(528, $y);
			$this->MultiCell(70, 15, 'X', 0, 'C', true);
		}*/


		if ($this->GetY() >= 712) {
			$this->AddPage();
			$y = 100;
		}else{
			$y = $this->GetY() + 5;
		}

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(65, 10, utf8_encode('Comentarios'), 0, 'L');

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->SetXY(97, $y);
		$this->MultiCell(500, 10,  utf8_encode($Comentario), 0, 'L', true);

	}
public function setEstudios($escolaridad, $comentarios)
	{
		if ($this->GetY() >= 630) {
			$this->AddPage();
			$y = 72;
		} else {
			$y = $this->GetY() + 20;
		}

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans', 'B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(235, $y);
		$this->Write(10, utf8_encode('ÚLTIMOS ESTUDIOS'));



		foreach ($escolaridad as $estudio) {

			if ($estudio['Grado'] == 336) {
			$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$x = 25;
				$y = $this->GetY() + 30;
				$this->SetFillColor(255, 255, 255);
				$this->setXY($x, $y);
				$this->MultiCell(80, 15, utf8_encode('Grado'), 0, 'C', false);
				$this->setXY($x + 290, $y);
				$this->MultiCell(80, 15, utf8_encode('Comentarios'), 0, 'C', false);
				
				$y = $this->GetY() + 5;
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);

				$this->setXY(18, $y);
				$this->MultiCell(104, 28, '', 0, 'C', true);
				
				$this->setXY($x + 99, $y);
				$this->MultiCell(475, 28, '', 0, 'C', true);

				$y += 4;

				$this->setXY(22, $y);
				$this->MultiCell(90, 15, utf8_encode(Utils::getGradoEstudio($estudio['Grado'])), 0, 'C', true);
				
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->SetXY($x + 99, $y);
				$this->MultiCell(474, 15, utf8_encode($comentarios), 0, 'C', true);
				
			} else {
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$x = 25;
				$y = $this->GetY() + 30;
				$this->SetFillColor(255, 255, 255);
				$this->setXY($x, $y);
				$this->MultiCell(97, 15, utf8_encode('Grado'), 0, 'L', false);
				$this->setXY($x + 99, $y);
				$this->MultiCell(136, 15, utf8_encode('Nombre de la Institución'), 0, 'C', false);
				$this->setXY($x + 238, $y);
				$this->MultiCell(70, 15, utf8_encode('Lugar'), 0, 'C', false);
				$this->setXY($x + 310, $y);
				$this->MultiCell(80, 15, utf8_encode('Periodo'), 0, 'C', false);
				$this->setXY($x + 392, $y);
				$this->MultiCell(80, 15, utf8_encode('Documento'), 0, 'C', false);
				$this->setXY($x + 475, $y);
				$this->MultiCell(98, 15, utf8_encode('Folio'), 0, 'C', false);

				$y = $this->GetY() + 5;
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);

				$this->setXY(12, $y);
				$this->MultiCell(110, 28, '', 0, 'C', true);
				$this->setXY($x + 99, $y);
				$this->MultiCell(136, 28, '', 0, 'C', true);
				$this->setXY($x + 238, $y);
				$this->MultiCell(70, 28, '', 0, 'C', true);
				$this->setXY($x + 310, $y);
				$this->MultiCell(80, 28, '', 0, 'C', true);
				$this->setXY($x + 392, $y);
				$this->MultiCell(80, 28, '', 0, 'C', true);
				$this->setXY($x + 475, $y);
				$this->MultiCell(98, 28, '', 0, 'C', true);

				$y += 4;

				$this->setXY(12, $y);
				$this->MultiCell(110, 8, utf8_encode(Utils::getGradoEstudio($estudio['Grado'])), 0, 'C', true);
				$this->setXY($x + 99, $y);
				$this->MultiCell(136, 8, utf8_encode($estudio['Institucion']), 0, 'C', true);
				$this->setXY($x + 238, $y);
				$this->MultiCell(70, 8, utf8_encode($estudio['Localidad']), 0, 'C', true);
				$this->setXY($x + 310, $y);
				$this->MultiCell(80, 8, utf8_encode($estudio['Periodo']), 0, 'C', true);
				$this->setXY($x + 392, $y);
				$this->MultiCell(80, 8, utf8_encode(Utils::getDocumentoEscolar($estudio['Documento'])), 0, 'C', true);
				$this->setXY($x + 475, $y);
				$this->MultiCell(98, 8, utf8_encode($estudio['Folio']), 0, 'C', true);

				if ($y >= 680) {
					$this->AddPage();
					$y = 100;
				} else {
					$y = $this->GetY() + 18;
				}

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(97, 10, utf8_encode('Comentarios'), 0, 'L');

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->SetXY($x + 99, $y);
				$this->MultiCell(474, 15, utf8_encode($comentarios), 0, 'L', true);
			}
		}
	}
	
	public function setEstudios2($escolaridad, $comentarios){
		if ($escolaridad) {
			if ($this->GetY() >= 630) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 20;
			}

			$this->SetFillColor(78, 82, 105);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('ÚLTIMOS ESTUDIOS'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 30;
			$this->SetFillColor(255, 255, 255);
			$this->setXY($x, $y);
			$this->MultiCell(97, 15, utf8_encode('Grado'), 0, 'L', false);
			$this->setXY($x + 99, $y);
			$this->MultiCell(136, 15, utf8_encode('Nombre de la Institución'), 0, 'C', false);
			$this->setXY($x + 238, $y);
			$this->MultiCell(70, 15, utf8_encode('Lugar'), 0, 'C', false);
			$this->setXY($x + 310, $y);
			$this->MultiCell(80, 15, utf8_encode('Periodo'), 0, 'C', false);
			$this->setXY($x + 392, $y);
			$this->MultiCell(80, 15, utf8_encode('Documento'), 0, 'C', false);
			$this->setXY($x + 475, $y);
			$this->MultiCell(98, 15, utf8_encode('Folio'), 0, 'C', false);

			$y = $this->GetY() + 5;
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			foreach($escolaridad as $estudio){
				$this->setXY(12, $y);
				$this->MultiCell(110, 28, '', 0, 'C', true);
				$this->setXY($x + 99, $y);
				$this->MultiCell(136, 28, '', 0, 'C', true);
				$this->setXY($x + 238, $y);
				$this->MultiCell(70, 28, '', 0, 'C', true);
				$this->setXY($x + 310, $y);
				$this->MultiCell(80, 28, '', 0, 'C', true);
				$this->setXY($x + 392, $y);
				$this->MultiCell(80, 28, '', 0, 'C', true);
				$this->setXY($x + 475, $y);
				$this->MultiCell(98, 28, '', 0, 'C', true);

				$y += 4;

				$this->setXY(12, $y);
				$this->MultiCell(110, 8, utf8_encode(Utils::getGradoEstudio($estudio['Grado'])), 0, 'C', true);
				$this->setXY($x + 99, $y);
				$this->MultiCell(136, 8, utf8_encode($estudio['Institucion']), 0, 'C', true);
				$this->setXY($x + 238, $y);
				$this->MultiCell(70, 8, utf8_encode($estudio['Localidad']), 0, 'C', true);
				$this->setXY($x + 310, $y);
				$this->MultiCell(80, 8, utf8_encode($estudio['Periodo']), 0, 'C', true);
				$this->setXY($x + 392, $y);
				$this->MultiCell(80, 8, utf8_encode(Utils::getDocumentoEscolar($estudio['Documento'])), 0, 'C', true);
				$this->setXY($x + 475, $y);
				$this->MultiCell(98, 8, utf8_encode($estudio['Folio']), 0, 'C', true);

				if ($y >= 680) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 18;
				}
			}
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(97, 10, utf8_encode('Comentarios'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->SetXY($x + 99, $y);
			$this->MultiCell(474, 15, utf8_encode($comentarios), 0, 'L', true);
		}
	}

	public function setHistorialSalud($historial_salud, $seguros){
		if (!empty($historial_salud->Diabetes)) {
			if ($this->GetY() > 580) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 20;
			}
			
			$this->SetFillColor(78, 82, 105);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, utf8_encode('HISTORIAL DE SALUD'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 30;
			$this->setXY($x, $y);
			$this->MultiCell(592, 15, utf8_encode('¿Padece usted o un familiar directo alguna de las siguientes enfermedades?'), 0, 'C', false);
			$y = $this->GetY() + 5;

			/* $this->setXY(158, $y);
			$this->MultiCell(147, 15, utf8_encode('Usted'), 0, 'C', false);
			$this->setXY(308, $y);
			$this->MultiCell(147, 15, utf8_encode('Padre'), 0, 'C', false);
			$this->setXY(458, $y);
			$this->MultiCell(140, 15, utf8_encode('Madre'), 0, 'C', false);

			$y = $this->GetY() + 2; */

			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Diabetes'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			/* $this->MultiCell(147, 22, utf8_encode(''), 0, 'C', true);
			$this->setXY(308, $y);
			$this->MultiCell(147, 22, utf8_encode(''), 0, 'C', true);
			$this->setXY(458, $y);
			$this->MultiCell(140, 22, utf8_encode(''), 0, 'C', true); */
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Diabetes), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Diabetes == 'Si' ? $historial_salud->Diabetes_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Cáncer'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Cancer), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Cancer == 'Si' ? $historial_salud->Cancer_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Hipertensión'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Hipertension), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Hipertension == 'Si' ? $historial_salud->Hipertension_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Insuficiencia renal'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Disfuncion_Renal), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Disfuncion_Renal == 'Si' ? $historial_salud->Disfuncion_Renal_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Fibrosis quística'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Fibrosis_Quistica), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Fibrosis_Quistica == 'Si' ? $historial_salud->Fibrosis_Quistica_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Miopía'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Miopia), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Miopia == 'Si' ? $historial_salud->Miopia_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Asma'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Asma), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Asma == 'Si' ? $historial_salud->Asma_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Migrañas'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Migranas), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Migranas == 'Si' ? $historial_salud->Migranas_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(130, 22, utf8_encode('Esclerosis múltiple'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Esclerosis_Multiple), 0, 'C', true);
			$this->setXY(379, $y);
			$this->MultiCell(219, 22, utf8_encode($historial_salud->Esclerosis_Multiple == 'Si' ? $historial_salud->Esclerosis_Multiple_Familiar : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(281, 22, utf8_encode('¿Fuma?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			if ($historial_salud->Fuma == 1) {
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
			}elseif ($historial_salud->Fuma == 0){
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(382, $y);
			$this->MultiCell(125, 22, utf8_encode('¿Cuántos cigarros al día?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(507, $y);
			$this->MultiCell(92, 22, utf8_encode($historial_salud->Fuma == 1 ? $historial_salud->Fuma_Cuanto : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(288, 22, utf8_encode('¿Bebe?'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			if ($historial_salud->Bebe == 1) {
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
			}elseif ($historial_salud->Bebe == 0){
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(382, $y);
			$this->MultiCell(125, 22, utf8_encode('¿Con qué frecuencia?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(507, $y);
			$this->MultiCell(92, 22, utf8_encode($historial_salud->Bebe == 1 ? $historial_salud->Bebe_Frecuencia : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(288, 22, utf8_encode('¿Consume alguna droga?'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			if ($historial_salud->Consume_Droga == 'Si') {
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
			} elseif ($historial_salud->Consume_Droga == 'No') {
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(382, $y);
			$this->MultiCell(125, 22, utf8_encode('¿Cuál?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(507, $y);
			$this->MultiCell(92, 22, utf8_encode($historial_salud->Consume_Droga == 'Si' ?  $historial_salud->Cual_Droga : 'No aplica'), 0, 'C', true);

			if ($this->GetY() >= 712){
				$this->AddPage();
				$y = 100;
			}else {
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(288, 22, utf8_encode('¿Cuenta con servicio médico?'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			if ($seguros) {
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
			} else {
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, utf8_encode('No'), 0, 'C', true);
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(382, $y);
			$this->MultiCell(125, 22, utf8_encode('¿Cuál?'), 0, 'L', false);
			$this->setXY(507, $y);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			if ($seguros) {
				$this->MultiCell(92, 22, utf8_encode(Utils::getSaludSeguros($seguros)), 0, 'C', true);
			}else{
				$this->MultiCell(92, 22, 'No aplica', 0, 'C', true);
			}
			

			$y = $this->GetY() + 6;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(288, 22, utf8_encode('¿Practica algún deporte?'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			if ($historial_salud->Deportes == 1) {
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, utf8_encode('Sí'), 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
			}elseif($historial_salud->Deportes == 0){
				$this->setXY(301, $y);
				$this->MultiCell(37, 22, '', 0, 'C', true);
				$this->setXY(340, $y);
				$this->MultiCell(37, 22, 'No', 0, 'C', true);
			}
				
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(382, $y);
			$this->MultiCell(125, 10, utf8_encode('¿Cuál?                                       ¿Con qué frecuencia?'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(507, $y);
			$this->MultiCell(92, 10, utf8_encode($historial_salud->Deportes == 1 ? $historial_salud->Deportes_Cual.' '.$historial_salud->Deportes_Frecuencia : 'No aplica'), 0, 'C', true);
		}
		
	}

	public function setSalud($salud, $seguros){
		if (!empty($salud->Enfermedad_Cronica_Cual) && !empty($salud->Enfermedad_Hereditaria_Cual) && !empty($salud->Otro_Seguro)) {
			if ($this->GetY() > 580) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 20;
			}

			$this->SetFillColor(78, 82, 105);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(290, $y);
			$this->Write(10, 'SALUD');

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 35;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 15, utf8_encode('¿Padece o ha padecido alguna enfermedad seria o crónica?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($salud->Enfermedad_Cronica == 1 ? 'Sí. '.$salud->Enfermedad_Cronica_Cual : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 15, utf8_encode('¿Existe entre su familia alguna enfermedad hereditaria?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($salud->Enfermedad_Hereditaria == 1 ? 'Sí. '.$salud->Enfermedad_Hereditaria_Cual : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Qué tipo de servicio médico utiliza usted y su familia?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode(Utils::getSaludSeguros($seguros)), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Otro'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($salud->Otro_Seguro), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Fuma?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($salud->Fuma == 1 ? 'Sí. '.$salud->Fuma_Cuanto : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('¿Bebe?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($salud->Bebe == 1 ? 'Sí. '.$salud->Bebe_Frecuencia : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Practica algún deporte?'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($salud->Deportes == 1 ? 'Sí. '.$salud->Deportes_Cual.'. '.$salud->Deportes_Frecuencia : 'No.'), 0, 'L', true);
		}	
	}

	public function setCohabitantes($cohabitantes, $comentarios){
		if ($this->GetY() > 570) {
			$this->seccionHeader = 2;
			$this->AddPage();
			$this->seccionHeader = false;
			$y = 72;
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
		}else{
			$y = $this->GetY() + 30;
			$this->SetFillColor(157, 199, 58);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(150, $y);
			$this->Write(10, utf8_encode('INFORMACIÓN ACERCA DEL ENTORNO Y FAMILIA'));

			$y = $this->GetY() + 30;
		}
		
		$this->SetFillColor(177, 194, 126);
		$this->Rect(10, $y, 592, 20, 'F');
		$y += 6;
		$this->setXY(150, $y);
		$this->Write(10, utf8_encode($this->id_cliente == 662 ? 'PERSONAS QUE COHABITAN CON EL SOLICITANTE' : 'PERSONAS QUE COHABITAN CON EL CANDIDATO'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 18;
		$y = $this->GetY() + 25;
		$this->SetFillColor(255, 255, 255);

		$this->setXY($x, $y);
		$this->MultiCell(57, 20, utf8_encode('Parentesco'), 0, 'L', false);
		$this->setXY(77, $y);
		$this->MultiCell(160, 20, utf8_encode('Nombre'), 0, 'C', false);
		$this->setXY(239, $y);
		$this->MultiCell(50, 20, utf8_encode('Edad'), 0, 'C', false);
		$this->setXY(291, $y);
		/* $this->MultiCell(50, 20, utf8_encode('Edo Civil'), 0, 'C', false);
		$this->setXY(293, $y); */
		$this->MultiCell(110, 20, utf8_encode('Ocupación'), 0, 'C', false);
		$this->setXY(403, $y+5);
		$this->MultiCell(110, 10, utf8_encode('Empresa / Escuela'), 0, 'C', false);
		$this->setXY(515, $y);
		$this->MultiCell(87, 10, utf8_encode('¿Es dependiente económico?'), 0, 'C', false);
		/* $this->setXY(522, $y);
		$this->MultiCell(78, 20, utf8_encode('Teléfono'), 0, 'C', false); */

		
		$y = $this->GetY() + 4;
		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		foreach ($cohabitantes as $cohabitante) { 
			

			$this->setXY($x, $y);
			$this->MultiCell(57, 28, '', 0, 'C', true);
			$this->setXY(77, $y);
			$this->MultiCell(160, 28, '', 0, 'C', true);
			$this->setXY(239, $y);
			$this->MultiCell(50, 28, '', 0, 'C', true);
			$this->setXY(291, $y);
			/* $this->MultiCell(50, 28, '', 0, 'C', true);
			$this->setXY(293, $y); */
			$this->MultiCell(110, 28, '', 0, 'C', true);
			$this->setXY(403, $y);
			$this->MultiCell(110, 28, '', 0, 'C', true);
			$this->setXY(515, $y);
			$this->MultiCell(84, 28, '', 0, 'C', true);
			/* $this->setXY(522, $y);
			$this->MultiCell(78, 28, '', 0, 'C', true); */

			$y += 4;
			$this->setXY($x, $y);
			$id_parentesco = $cohabitante['Parentesco'];
			$Parentesco = Utils::getParentesco($id_parentesco);
			$this->MultiCell(57, 8, utf8_encode($Parentesco), 0, 'L', false);
			$this->setXY(77, $y);
			$this->MultiCell(160, 8, utf8_encode($cohabitante['Nombre']), 0, 'C', false);
			$this->setXY(239, $y);
			$this->MultiCell(50, 8, utf8_encode($cohabitante['Edad'].' '.$cohabitante['Edad_2']), 0, 'C', false);
			$this->setXY(291, $y);
			/* $id_estado_civil = $cohabitante['Estado_Civil'];
			$Estado_Civil = Utils::getEstadoCivil($id_estado_civil);
			$this->MultiCell(50, 8, utf8_encode($Estado_Civil), 0, 'C', false);
			$this->setXY(293, $y); */
			$this->MultiCell(110, 8, utf8_encode($cohabitante['Edad_2'] == 'Años' && $cohabitante['Edad'] > 2 ? $cohabitante['Ocupacion'] : 'No aplica'), 0, 'C', false);
			$this->setXY(403, $y);
			$this->MultiCell(110, 8, utf8_encode($cohabitante['Edad_2'] == 'Años' && $cohabitante['Edad'] > 2 ? $cohabitante['Empresa'] : 'No aplica'), 0, 'C', false);
			$this->setXY(515, $y);
			$dependiente_economico = $cohabitante['Dependiente'] == 1 ? 'Sí' : 'No';
			$this->MultiCell(83, 8, utf8_encode($dependiente_economico), 0, 'C', false);
			/* $this->setXY(522, $y);
			$this->MultiCell(78, 8, utf8_encode($cohabitante['Edad_2'] == 'Años' && $cohabitante['Edad'] >= 18 ? $cohabitante['Telefono'] : 'No aplica'), 0, 'C', false); */
			
			if ($y >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 18;
			}
		}
		
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(97, 15, utf8_encode('Comentarios'), 0, 'L');

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->SetXY($x + 99, $y);
		$this->MultiCell(482, 15, utf8_encode($comentarios), 0, 'L', true);
	}

	public function setSociales($candidato){
		if (!empty($candidato->Religion) && !empty($candidato->Pasatiempos) && !empty($candidato->Cualidades) && !empty($candidato->Habilidades)) {
			$y = $this->GetY() + 25;

			$this->SetFillColor(78, 82, 105);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(280, $y);
			$this->Write(10, 'SOCIALES');

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 35;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 15, utf8_encode('Religión'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Religion), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(275, 15, utf8_encode('Afiliación a algún partido político'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Afiliacion_politica == 0 ? 'Sí.' : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Afiliación a algún club social'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Afiliacion_Club == 0 ? 'Sí.' : 'No.'), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Pasatiempos'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Pasatiempos), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Cualidades'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Cualidades), 0, 'L', true);

			if ($this->GetY() >= 715) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(290, 15, utf8_encode('Habilidades'), 0, 'L');

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(300, $y);
			$this->MultiCell(295, 18, utf8_encode($candidato->Habilidades), 0, 'L', true);

		}	
	}

	public function setCirculoFamiliar($circulo_familiar){
		if ($circulo_familiar) {
			if ($this->GetY() >= 620) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 30;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('PRIMER CÍRCULO FAMILIAR'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 30;

			
			$this->setXY($x, $y);
			$this->MultiCell(63, 15, utf8_encode('Parentesco'), 0, 'L', false);
			$this->setXY(90, $y);
			$this->MultiCell(285, 15, utf8_encode('Nombre'), 0, 'C', false);
			$this->setXY(375, $y);
			$this->MultiCell(110, 15, utf8_encode('Teléfono'), 0, 'C', false);
			$this->setXY(487, $y);
			$this->MultiCell(56, 15, utf8_encode('Vive'), 0, 'C', false);
			$this->setXY(544, $y);
			$this->MultiCell(56, 15, utf8_encode('Finado'), 0, 'C', false);


			$y = $this->GetY() + 2;

			$this->SetFillColor(255, 255, 255);

			foreach ($circulo_familiar as $familiar) {
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140); 
				$this->setXY($x, $y);
				$this->MultiCell(63, 15, utf8_encode(Utils::getParentesco($familiar['Parentesco'])), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(90, $y);
				$this->MultiCell(285, 15, utf8_encode($familiar['Nombre_Parentesco']), 0, 'C', true);
				$this->setXY(377, $y);
				$this->MultiCell(110, 15, utf8_encode($familiar['Telefono_Parentesco']), 0, 'C', true);

				$this->SetXY(489, $y);
				$this->MultiCell(55, 15, '', 0, 'C', true);
				$this->SetXY(545, $y);
				$this->MultiCell(55, 15, '', 0, 'C', true);

				if ($familiar['Estatus'] == 'Vive') {
					$this->SetXY(489, $y);
					$this->MultiCell(55, 15, 'X', 0, 'C', false);
				}
				if ($familiar['Estatus'] == 'Finado') {
					$this->SetXY(545, $y);
					$this->MultiCell(55, 15, 'X', 0, 'C', false);
				}

				if ($this->GetY() >= 715) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}
			}
		}
	}

	public function setVivienda($vivienda, $ubicacion, $comentarios){
		if ($vivienda && $ubicacion) {
			if ($this->GetY() >= 620) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 30;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('ACERCA DE LA VIVIENDA'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 18;
			$y = $this->GetY() + 30;
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('Tiempo de vivir en el domicilio'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(148, 15, utf8_encode($vivienda->Tiempo_Viviendo), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('Calle'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(148, 15, utf8_encode($ubicacion->Calle), 0, 'L', true);
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(310, $y);
			$this->MultiCell(62, 15, utf8_encode('No.'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(374, $y);
			$this->MultiCell(76, 15, utf8_encode($ubicacion->Exterior), 0, 'C', true);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(452, $y);
			$this->MultiCell(46, 15, utf8_encode('Interior'), 0, 'C', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(500, $y);
			$this->MultiCell(100, 15, utf8_encode($ubicacion->Interior), 0, 'C', true);

			if ($this->GetY() >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('Colonia'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(148, 15, utf8_encode($ubicacion->Colonia), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(310, $y);
			$this->MultiCell(62, 15, utf8_encode('Entre'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(374, $y);
			$this->MultiCell(226, 15, utf8_encode($ubicacion->Entre_Calles), 0, 'C', true);

			if ($this->GetY() >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('Delegación o municipio'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(148, 15, utf8_encode($ubicacion->Municipio), 0, 'L', true);

			if ($_GET['candidato'] == 47740) {
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY(310, $y);
				$this->MultiCell(62, 15, utf8_encode('País'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6);
				$this->setTextColor(0, 0, 0);
				$this->setXY(374, $y);
				$this->MultiCell(76, 15, 'Alemania', 0, 'C', true);
			}else{
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY(310, $y);
				$this->MultiCell(62, 15, utf8_encode('Estado'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6);
				$this->setTextColor(0, 0, 0);
				$this->setXY(374, $y);
				$this->MultiCell(76, 15, utf8_encode($ubicacion->Estado), 0, 'C', true);
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(452, $y);
			$this->MultiCell(46, 15, utf8_encode('CP'), 0, 'C', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(500, $y);
			$this->MultiCell(100, 15, utf8_encode($ubicacion->Codigo_Postal), 0, 'C', true);

			if ($this->GetY() >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 8, utf8_encode('Color y descripción de la fachada'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(442, 15, utf8_encode($ubicacion->Fachada), 0, 'L', true);

			if ($this->GetY() >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('Tipo de vivienda'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$Tipo_Vivienda = Utils::getTipoVivienda($vivienda->Tipo_Vivienda);
			$this->MultiCell(442, 15, utf8_encode($Tipo_Vivienda), 0, 'L', true);

			if ($this->GetY() >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('Número de plantas o niveles'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(148, 15, utf8_encode($vivienda->Plantas), 0, 'C', true);
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(310, $y);
			$this->MultiCell(140, 15, utf8_encode('Número de baños:'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(452, $y);
			$this->MultiCell(148, 15, utf8_encode($vivienda->Sanitarios), 0, 'C', true);

			if ($this->GetY() >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('Número de recámaras'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(148, 15, utf8_encode($vivienda->Recamaras), 0, 'C', true);
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(310, $y);
			$this->MultiCell(140, 15, utf8_encode('Capacidad de autos en cochera'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(452, $y);
			$this->MultiCell(148, 15, utf8_encode($vivienda->Capacidad_Cochera), 0, 'C', true);

			if ($this->GetY() >= 680) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('El domicilio donde vive es'), 0, 'L', false);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$Domicilio_es = Utils::getDomicilioEs($vivienda->Domicilio_es);
			$this->MultiCell(148, 15, utf8_encode($Domicilio_es), 0, 'L', true);

			if ($vivienda->Domicilio_es != 160) {
				if ($this->GetY() >= 680) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY($x, $y);
				$this->MultiCell(138, 8, utf8_encode('En caso de no ser propio, nombre del propietario'), 0, 'L', false);
				
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(158, $y);
				$this->MultiCell(442, 15, utf8_encode($vivienda->Propietario), 0, 'L', true);
			
				if ($this->GetY() >= 680) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY($x, $y);
				$this->MultiCell(138, 15, utf8_encode('Parentesco'), 0, 'L', false);
				
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(158, $y);
				$this->MultiCell(148, 15, utf8_encode($vivienda->Parentesco), 0, 'L', true);
				
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY(310, $y);
				$this->MultiCell(140, 15, utf8_encode('Teléfono'), 0, 'L', false);
				
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(452, $y);
				$this->MultiCell(148, 15, utf8_encode($vivienda->Telefono_Parentesco), 0, 'L', true);
			}

			if ($vivienda->Domicilio_es == 161) {
				if ($this->GetY() >= 680) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY($x, $y);
				$this->MultiCell(138, 8, utf8_encode('En caso de arrendamiento. ¿Cuenta con el contrato?'), 0, 'L', false);
				
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(158, $y);
				$this->MultiCell(148, 15, utf8_encode($vivienda->Contrato_Arrendamiento), 0, 'L', true);
				
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY(310, $y);
				$this->MultiCell(140, 15, utf8_encode('Tiempo del contrato'), 0, 'L', false);
				
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(452, $y);
				$this->MultiCell(148, 15, utf8_encode($vivienda->Tiempo_Contrato), 0, 'L', true);
			}
			
			if ($this->GetY() >= 680) {
				$this->AddPage();
				$y = 100;
			}else
				$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(138, 15, utf8_encode('Comentarios'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(158, $y);
			$this->MultiCell(442, 15, utf8_encode($comentarios), 0, 'L', true);

			if ($ubicacion->Maps) {
				if ($this->GetY() >= 680) {
					$this->AddPage();
					$y = 100;
				}else
					$y = $this->GetY() + 2;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY($x, $y);
				$this->MultiCell(138, 15, utf8_encode('Ubicación Geográfica'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(158, $y);
				$this->MultiCell(442, 15, utf8_encode($ubicacion->Maps), 0, 'L', true);
			}
		}
	}

	public function setEnseres($enseres){
		if ($enseres) {
			if ($this->GetY() >= 650) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 30;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(280, $y);
			$this->Write(10, utf8_encode('ENSERES'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 30;
			$this->SetFillColor(255, 255, 255);
			
			$this->setXY($x, $y);
			$this->MultiCell(183, 15, utf8_encode('Electrónicos'), 0, 'L', false);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Computadoras'), 0, 'C', true);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Computadoras, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Pantallas'), 0, 'C', true);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Pantallas, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Laptop'), 0, 'C', true);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Laptop, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Impresoras'), 0, 'C', true);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Impresoras, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setXY(210, $y);
			$this->MultiCell(190, 15, '', 0, 'C', true);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, '', 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(183, 15, utf8_encode('Línea blanca'), 0, 'L', false);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Refrigerador'), 0, 'C', true);
			
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Refrigerador, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Estufa'), 0, 'C', true);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Estufa, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Aire acondicionado'), 0, 'C', true);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Aire_Acondicionado, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Lavadora'), 0, 'C', true);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Lavadora, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Secadora'), 0, 'C', true);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, $enseres->Secadora, 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY(210, $y);
			$this->MultiCell(190, 15, utf8_encode('Otros'), 0, 'C', true);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(402, $y);
			$this->MultiCell(190, 15, utf8_encode($enseres->Otros), 0, 'C', true);

			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(183, 15, utf8_encode('¿Se observa mobiliario de uso cotidiano?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			if ($enseres->Mobiliario == 1) {
				$this->setXY(210, $y);
				$this->MultiCell(190, 15, utf8_encode('Sí'), 0, 'C', true);
				$this->setXY(402, $y);
				$this->MultiCell(190, 15, '', 0, 'C', true);
			} elseif($enseres->Mobiliario == 0) {
				$this->setXY(210, $y);
				$this->MultiCell(190, 15, '', 0, 'C', true);
				$this->setXY(402, $y);
				$this->MultiCell(190, 15, ('No'), 0, 'C', true);
			}
			
			if ($this->GetY() > 712) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->setXY($x, $y);
			$this->MultiCell(183, 15, utf8_encode('Comentarios'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(210, $y);
			$this->MultiCell(390, 15, utf8_encode($enseres->Comentarios), 0, 'L', true);
		}
			
	}

	public function setFotoExteriorDomicilio($r_foto_exterior){
		if (!$r_foto_exterior) {
			$r_foto_exterior = array('dist/img/Sin_foto.png', 'png');
		}
		$foto_exterior = getimagesize($r_foto_exterior[0]);
		if ($foto_exterior[2] != 2)
			$r_foto_exterior[1] = 'png';
		else
			$r_foto_exterior[1] = 'jpg';
		$w_foto_exterior = $foto_exterior[0];
		$h_foto_exterior = $foto_exterior[1];

		if ($this->GetY() >= 400) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 30;
		}

		$this->SetFillColor(177, 194, 126);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(210, $y);
		$this->Write(10, utf8_encode('FOTO EXTERIOR DE LA CASA'));

		$y = $this->GetY() + 30;
		$this->SetXY(25, $y);

		$max_width = 488;
		$max_heigth = 280;
		$x = 62;

		if ($w_foto_exterior > $h_foto_exterior) {
			$h_foto_exterior = $h_foto_exterior * $max_width / $w_foto_exterior;
			$w_foto_exterior = $max_width;
			if ($h_foto_exterior > $max_heigth) {
				$w_foto_exterior = $w_foto_exterior * $max_heigth / $h_foto_exterior;
				$h_foto_exterior = $max_heigth;
				$x = (612 - $w_foto_exterior) / 2;
			}
			$this->Image($r_foto_exterior[0], $x, $this->GetY(), $w_foto_exterior, $h_foto_exterior, $r_foto_exterior[1]);
		} else {
			$w_foto_exterior = $w_foto_exterior * $max_heigth / $h_foto_exterior;
			$h_foto_exterior = $max_heigth;
			$x = (612 - $w_foto_exterior) / 2;
			$this->Image($r_foto_exterior[0], $x, $this->GetY(), $w_foto_exterior, $h_foto_exterior, $r_foto_exterior[1]);
			
		}

		$y = $this->GetY() + $h_foto_exterior;
		$this->SetY($y);
		
	}

	public function setFotoNoExteriorDomicilio($r_foto_exterior){
		if ($r_foto_exterior) {
			$foto_exterior = getimagesize($r_foto_exterior[0]);
			if ($foto_exterior[2] != 2)
				$r_foto_exterior[1] = 'png';
			else
				$r_foto_exterior[1] = 'jpg';
			$w_foto_exterior = $foto_exterior[0];
			$h_foto_exterior = $foto_exterior[1];

			if ($this->GetY() >= 400) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 30;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(180, $y);
			$this->Write(10, utf8_encode('FOTO DEL NÚMERO DEL DOMICILIO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			$max_width = 488;
			$max_heigth = 280;
			$x = 62;

			if ($w_foto_exterior > $h_foto_exterior) {
				$h_foto_exterior = $h_foto_exterior * $max_width / $w_foto_exterior;
				$w_foto_exterior = $max_width;
				if ($h_foto_exterior > $max_heigth) {
					$w_foto_exterior = $w_foto_exterior * $max_heigth / $h_foto_exterior;
					$h_foto_exterior = $max_heigth;
					$x = (612 - $w_foto_exterior) / 2;
				}
				$this->Image($r_foto_exterior[0], $x, $this->GetY(), $w_foto_exterior, $h_foto_exterior, $r_foto_exterior[1]);
			} else {
				$w_foto_exterior = $w_foto_exterior * $max_heigth / $h_foto_exterior;
				$h_foto_exterior = $max_heigth;
				$x = (612 - $w_foto_exterior) / 2;
				$this->Image($r_foto_exterior[0], $x, $this->GetY(), $w_foto_exterior, $h_foto_exterior, $r_foto_exterior[1]);
				
			}

			$y = $this->GetY() + $h_foto_exterior;
			$this->SetY($y);
		}
	}

	public function setFotoInteriorDomicilio($r_foto_interior){
		if (!$r_foto_interior) {
			$r_foto_interior = array('dist/img/Sin_foto.png', 'png');
		}
		$foto_interior = getimagesize($r_foto_interior[0]);
		if ($foto_interior[2] != 2)
			$r_foto_interior[1] = 'png';
		else
			$r_foto_interior[1] = 'jpg';
		$w_foto_interior = $foto_interior[0];
		$h_foto_interior = $foto_interior[1];

		if ($this->GetY() >= 400) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 20;
		}

		$this->SetFillColor(177, 194, 126);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(220, $y);
		$this->Write(10, utf8_encode('FOTO INTERIOR DE LA CASA'));

		$y = $this->GetY() + 30;
		$this->SetXY(25, $y);

		$max_width = 488;
		$max_heigth = 280;
		$x = 62;

		if ($w_foto_interior > $h_foto_interior) {
			$h_foto_interior = $h_foto_interior * $max_width / $w_foto_interior;
			$w_foto_interior = $max_width;
			if ($h_foto_interior > $max_heigth) {
				$w_foto_interior = $w_foto_interior * $max_heigth / $h_foto_interior;
				$h_foto_interior = $max_heigth;
				$x = (612 - $w_foto_interior) / 2;
			}
			$this->Image($r_foto_interior[0], $x, $this->GetY(), $w_foto_interior, $h_foto_interior, $r_foto_interior[1]);
		} else {
			$w_foto_interior = $w_foto_interior * $max_heigth / $h_foto_interior;
			$h_foto_interior = $max_heigth;
			$x = (612 - $w_foto_interior) / 2;
			$this->Image($r_foto_interior[0], $x, $this->GetY(), $w_foto_interior, $h_foto_interior, $r_foto_interior[1]);
		}

		$y = $this->GetY() + $h_foto_interior;
		$this->SetY($y);
	}

	public function setFotoUbicacionGeografica($r_ubicacion_geografica){
		if ($r_ubicacion_geografica) {
			$foto_ubicacion_geografica = getimagesize($r_ubicacion_geografica[0]);
			if ($foto_ubicacion_geografica[2] != 2)
				$r_ubicacion_geografica[1] = 'png';
			else
				$r_ubicacion_geografica[1] = 'jpg';
			$w_foto_ubicacion_geografica = $foto_ubicacion_geografica[0];
			$h_foto_ubicacion_geografica = $foto_ubicacion_geografica[1];

			if ($this->GetY() >= 400) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 20;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(170, $y);
			$this->Write(10, utf8_encode('UBICACIÓN GEOGRÁFICA DEL DOMICILIO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);
			
			$max_width = 488;
			$max_heigth = 280;
			$x = 62;

			if ($w_foto_ubicacion_geografica > $h_foto_ubicacion_geografica) {
				$h_foto_ubicacion_geografica = $h_foto_ubicacion_geografica * $max_width / $w_foto_ubicacion_geografica;
				$w_foto_ubicacion_geografica = $max_width;
				if ($h_foto_ubicacion_geografica > $max_heigth) {
					$w_foto_ubicacion_geografica = $w_foto_ubicacion_geografica * $max_heigth / $h_foto_ubicacion_geografica;
					$h_foto_ubicacion_geografica = $max_heigth;
					$x = (612 - $w_foto_ubicacion_geografica) / 2;
				}
				$this->Image($r_ubicacion_geografica[0], $x, $this->GetY(), $w_foto_ubicacion_geografica, $h_foto_ubicacion_geografica, $r_ubicacion_geografica[1]);
			} else {
				$w_foto_ubicacion_geografica = $w_foto_ubicacion_geografica * $max_heigth / $h_foto_ubicacion_geografica;
				$h_foto_ubicacion_geografica = $max_heigth;
				$x = (612 - $w_foto_ubicacion_geografica) / 2;
				$this->Image($r_ubicacion_geografica[0], $x, $this->GetY(), $w_foto_ubicacion_geografica, $h_foto_ubicacion_geografica, $r_ubicacion_geografica[1]);
			}
			$y = $this->GetY() + $h_foto_ubicacion_geografica;
			$this->SetY($y);
		}
		
	}
	
	public function setFotoUbicacionCalle($r_ubicacion_calle){
		if ($r_ubicacion_calle) {
			$foto_ubicacion_calle = getimagesize($r_ubicacion_calle[0]);
			if ($foto_ubicacion_calle[2] != 2)
				$r_ubicacion_calle[1] = 'png';
			else
				$r_ubicacion_calle[1] = 'jpg';
			$w_foto_ubicacion_calle = $foto_ubicacion_calle[0];
			$h_foto_ubicacion_calle = $foto_ubicacion_calle[1];

			if ($this->GetY() >= 400) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 20;
			}

			$this->SetFillColor(177, 194, 126);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(170, $y);
			$this->Write(10, utf8_encode('UBICACIÓN CALLE DEL DOMICILIO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);
			
			$max_width = 488;
			$max_heigth = 280;
			$x = 62;

			if ($w_foto_ubicacion_calle > $h_foto_ubicacion_calle) {
				$h_foto_ubicacion_calle = $h_foto_ubicacion_calle * $max_width / $w_foto_ubicacion_calle;
				$w_foto_ubicacion_calle = $max_width;
				if ($h_foto_ubicacion_calle > $max_heigth) {
					$w_foto_ubicacion_calle = $w_foto_ubicacion_calle * $max_heigth / $h_foto_ubicacion_calle;
					$h_foto_ubicacion_calle = $max_heigth;
					$x = (612 - $w_foto_ubicacion_calle) / 2;
				}
				$this->Image($r_ubicacion_calle[0], $x, $this->GetY(), $w_foto_ubicacion_calle, $h_foto_ubicacion_calle, $r_ubicacion_calle[1]);
			} else {
				$w_foto_ubicacion_calle = $w_foto_ubicacion_calle * $max_heigth / $h_foto_ubicacion_calle;
				$h_foto_ubicacion_calle = $max_heigth;
				$x = (612 - $w_foto_ubicacion_calle) / 2;
				$this->Image($r_ubicacion_calle[0], $x, $this->GetY(), $w_foto_ubicacion_calle, $h_foto_ubicacion_calle, $r_ubicacion_calle[1]);
			}
			$y = $this->GetY() + $h_foto_ubicacion_calle;
			$this->SetY($y);
		}
		
	}

	public function setReferencias($referencias){
		if ($referencias) {
			if ($this->headerEconomia) {
				$this->seccionHeader = 3;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerEconomia = false;
			}
			
			foreach ($referencias as $key => $referencia) { 
				if ($this->GetY() >= 400) {
					$this->AddPage();
					$y = 72;
				}elseif ($key == 0){
					$y = 72;
				}else{
					$y = $this->GetY() + 25;
				}

				$this->SetFillColor(248, 152, 80);
				$this->Rect(10, $y, 592, 20, 'F');
				$this->SetFont('Sinkinsans','B', 11);
				$this->SetTextColor(255, 255, 255);
				
				$y += 6;
				$this->setXY(265, $y);
				$this->Write(10, 'REFERENCIA '.($key + 1));

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$x = 25;
				$y = $this->GetY() + 25;
				$this->SetFillColor(255, 255, 255);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('Tipo de referencia'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode(Utils::getTipoReferencia($referencia['Tipo'])), 0, 'L', true);

				$y = $this->GetY() + 2;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('Relación con el candidato'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Relacion']), 0, 'L', true);

				$y = $this->GetY() + 2;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('Nombre'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Nombre']), 0, 'L', true);

				$y = $this->GetY() + 2;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('Teléfono'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Telefono']), 0, 'L', true);

				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('Domicilio de la referencia'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Domicilio']), 0, 'L', true);

				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('¿Cuál es el domicilio del candidato?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Domicilio_Candidato']), 0, 'L', true);

				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('¿Cuánto tiempo tiene el candidato viviendo ahí?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Tiempo_Viviendo']), 0, 'L', true);

				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('¿Cuánto tiempo tiene de conocerlo?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Tiempo_Conocerlo']), 0, 'L', true);

				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('¿Sabe si tiene hijos?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Tiene_Hijos']), 0, 'L', true);

				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('¿Sabe a qué se dedica?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Dedicacion']), 0, 'L', true);

				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('¿Sabe sobre su estado civil?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 18, utf8_encode($referencia['Estado_Civil']), 0, 'L', true);

				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(223, 10, utf8_encode('Comentarios sobre el candidato'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(250, $y);
				$this->MultiCell(350, 10, utf8_encode($referencia['Comentarios']), 0, 'L', true);

			}	
		}
			
	}

	public function setEconomiaFamiliar($ingresos, $egresos, $comentarios){
		if ($this->headerEconomia) {
			$this->seccionHeader = 3;
			$this->AddPage();
			$this->seccionHeader = false;
			$this->headerEconomia = false;
		}else{
			$this->AddPage();
		}
		$y = 72;

		$this->SetFillColor(248, 152, 80);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(240, $y);
		$this->Write(10, utf8_encode('ECONOMÍA FAMILIAR'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 10;
		$y = $this->GetY() + 20;
		$this->SetFillColor(255, 255, 255);

		$this->setXY($x, $y);
		$this->MultiCell(117, 15, utf8_encode('¿Quién aporta?'), 0, 'C', false);
		$this->setXY(129, $y);
		$this->MultiCell(117, 15, utf8_encode('Fuente de ingreso'), 0, 'C', false);
		$this->setXY(248, $y);
		$this->MultiCell(117, 15, utf8_encode('Monto mensual'), 0, 'C', false);
		$this->setXY(372, $y);
		$this->MultiCell(112, 15, utf8_encode('Egreso'), 0, 'L', false);
		$this->setXY(486, $y);
		$this->MultiCell(114, 15, utf8_encode('Monto mensual'), 0, 'R', false);

		$y = $this->GetY() + 2;
		$y1 = $y;
		$y2 = $y;
		$total_ingresos = 0;
		$total_egresos = 0;

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0); 
		foreach ($ingresos as $key => $ingreso) {
			$this->setXY($x, $y1);
			$this->MultiCell(117, 16, utf8_encode($ingreso['Aporta']), 0, 'C', true);
			$this->setXY(129, $y1);
			$this->MultiCell(117, 16, utf8_encode($ingreso['Fuente']), 0, 'C', true);
			$this->setXY(248, $y1);
			$this->MultiCell(117, 16, '$'.number_format($ingreso['Monto'], 2), 0, 'R', true);
			$y1 = $this->GetY() + 2;
			$total_ingresos += $ingreso['Monto'];
		}
		foreach ($egresos as $key => $egreso) { 
			if ($egreso['Monto'] <> 0) {
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->setXY(372, $y2);
				$this->MultiCell(112, 16, utf8_encode($egreso['Descripcion']), 0, 'L', false);
				
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(486, $y2);
				$this->MultiCell(114, 16, '$'.number_format($egreso['Monto'], 2), 0, 'R', true);
				$y2 = $this->GetY() + 2;
				$total_egresos += $egreso['Monto'];
			}
			
		}
		$x = 24;
		$y = $this->GetY() + 2;
		
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->setXY($x, $y);
		$this->MultiCell(103, 15, utf8_encode('TOTAL MENSUAL'), 0, 'L', false);
		
		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(129, $y);
		$this->MultiCell(236, 15, '$'.number_format($total_ingresos, 2), 0, 'R', true);
		
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->setXY(372, $y);
		$this->MultiCell(112, 15, utf8_encode('TOTAL MENSUAL'), 0, 'L', false);
		
		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(486, $y);
		$this->MultiCell(114, 15, '$'.number_format($total_egresos, 2), 0, 'R', true);

		$y = $this->GetY() + 2;
		
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->setXY($x, $y);
		$this->MultiCell(103, 15, utf8_encode('DIFERENCIA'), 0, 'L', false);
		
		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(129, $y);
		$diferencia = $total_ingresos - $total_egresos;
		if ($diferencia < 0) {
			$this->SetTextColor(255, 16, 16);
		}
		$this->MultiCell(471, 15, '$'.number_format($diferencia, 2), 0, 'C', true);
		$this->SetTextColor(140, 140, 140);

		$y = $this->GetY() + 2;
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->setXY($x, $y);
		$this->MultiCell(103, 15, utf8_encode('COMENTARIOS'), 0, 'L', false);
		
		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(129, $y);
		$this->MultiCell(471, 15, utf8_encode($comentarios), 0, 'L', true);
	}

	public function setInformacionFinanciera($creditos, $cuentas, $seguros, $INFONAVIT){
		if ($creditos || $cuentas || $seguros || $INFONAVIT) {
			$y = $this->GetY() + 20;

			$this->SetFillColor(248, 152, 80);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('INFORMACIÓN FINANCIERA'));
			
			$x = 12;
			$y = $this->GetY() + 20;
		}
		
		if ($INFONAVIT) {
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('¿El candidato cuenta con crédito INFONAVIT?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($INFONAVIT == 1 ? 'Sí' : ($INFONAVIT == 2 ? 'No' : '')), 0, 'L', true);

			$y = $this->GetY() + 10;
		}
		
		if (count($creditos) > 0) {
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setXY($x, $y);
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('CRÉDITOS AL CONSUMO O TDC'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(115, 15, utf8_encode('Institución'), 0, 'C', false);
			$this->setXY(129, $y);
			$this->MultiCell(117, 15, utf8_encode('Límite de crédito'), 0, 'C', false);
			$this->setXY(248, $y);
			$this->MultiCell(117, 15, utf8_encode('Saldo actual aprox.'), 0, 'C', false);
			$this->setXY(372, $y);
			$this->MultiCell(112, 15, utf8_encode('Vencimiento'), 0, 'C', false);
			$this->setXY(486, $y);
			$this->MultiCell(114, 15, utf8_encode('Abono mensual'), 0, 'C', false);

			$y = $this->GetY() + 2;
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			foreach ($creditos as $key => $credito) { 
				$this->setXY($x, $y);
				$this->MultiCell(115, 16, utf8_encode($credito['Institucion']), 0, 'C', true);
				$this->setXY(129, $y);
				$this->MultiCell(117, 16, utf8_encode($credito['Limite_Credito']), 0, 'C', true);
				$this->setXY(248, $y);
				$this->MultiCell(117, 16, utf8_encode($credito['Saldo_Actual']), 0, 'C', true);
				$this->setXY(367, $y);
				$this->MultiCell(117, 16, utf8_encode($credito['Vencimiento']), 0, 'C', true);
				$this->setXY(486, $y);
				$this->MultiCell(114, 16, utf8_encode($credito['Abono_Mensual']), 0, 'C', true);
				$y = $this->GetY() + 2;
			}

			$y = $this->GetY() + 8;
		}
		
		if (count($cuentas) > 0) {
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setXY($x, $y);
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('CUENTAS BANCARIAS Y DE INVERSIÓN'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(145, 15, utf8_encode('Institución'), 0, 'C', false);
			$this->setXY(159, $y);
			$this->MultiCell(145, 15, utf8_encode('Tipos de cuenta'), 0, 'C', false);
			$this->setXY(306, $y);
			$this->MultiCell(145, 15, utf8_encode('Objetivo del ahorro'), 0, 'C', false);
			$this->setXY(451, $y);
			$this->MultiCell(145, 15, utf8_encode('Depósito mensual'), 0, 'C', false);

			$y = $this->GetY() + 2;
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			foreach ($cuentas as $key => $cuenta) { 
				$this->setXY($x, $y);
				$this->MultiCell(145, 16, utf8_encode($cuenta['Institucion']), 0, 'C', true);
				$this->setXY(159, $y);
				$this->MultiCell(145, 16, utf8_encode($cuenta['Tipo_Cuenta']), 0, 'C', true);
				$this->setXY(306, $y);
				$this->MultiCell(145, 16, utf8_encode($cuenta['Objetivo']), 0, 'C', true);
				$this->setXY(451, $y);
				$this->MultiCell(145, 16, utf8_encode($cuenta['Deposito_Mensual']), 0, 'C', true);
				$y = $this->GetY() + 2;
			}

			$y = $this->GetY() + 8;
		}

		if (count($seguros) > 0) {
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setXY($x, $y);
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('SEGUROS (VIDA, AUTO, VIVIENDA, GMM)'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(115, 15, utf8_encode('Institución'), 0, 'C', false);
			$this->setXY(129, $y);
			$this->MultiCell(117, 15, utf8_encode('Tipo de seguro'), 0, 'C', false);
			$this->setXY(248, $y);
			$this->MultiCell(117, 15, utf8_encode('Forma de pago'), 0, 'C', false);
			$this->setXY(372, $y);
			$this->MultiCell(112, 15, utf8_encode('Prima'), 0, 'C', false);
			$this->setXY(486, $y);
			$this->MultiCell(114, 15, utf8_encode('Vigencia'), 0, 'C', false);

			$y = $this->GetY() + 2;
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			foreach ($seguros as $key => $seguro) { 
				$this->setXY($x, $y);
				$this->MultiCell(115, 16, utf8_encode($seguro['Institucion']), 0, 'C', true);
				$this->setXY(129, $y);
				$this->MultiCell(117, 16, utf8_encode($seguro['Tipo_Seguro']), 0, 'C', true);
				$this->setXY(248, $y);
				$this->MultiCell(117, 16, utf8_encode($seguro['Forma_Pago']), 0, 'C', true);
				$this->setXY(367, $y);
				$this->MultiCell(117, 16, utf8_encode($seguro['Prima']), 0, 'C', true);
				$this->setXY(486, $y);
				$this->MultiCell(114, 16, utf8_encode($seguro['Vigencia']), 0, 'C', true);
				$y = $this->GetY() + 2;
			}
		}
		
		
	}

	public function setInformacionPatrimonial($inmuebles, $vehiculos){
		if ($inmuebles || $vehiculos) {
			if ($this->GetY() >= 640) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 20;
			}

			$this->SetFillColor(248, 152, 80);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('INFORMACIÓN PATRIMONIAL'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$x = 12;
			$y = $this->GetY() + 20;
			$this->setXY($x, $y);
		}
		if (count($inmuebles) > 0) {
			
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('BIENES INMUEBLES'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);
		
			$this->setXY($x, $y);
			$this->MultiCell(115, 15, utf8_encode('Tipo'), 0, 'C', false);
			$this->setXY(170, $y);
			$this->MultiCell(117, 15, utf8_encode('Ubicación'), 0, 'C', false);
			$this->setXY(317, $y);
			$this->MultiCell(117, 15, utf8_encode('Valor'), 0, 'C', false);
			$this->setXY(437, $y);
			$this->MultiCell(80, 15, utf8_encode('Pagado'), 0, 'C', false);
			$this->setXY(520, $y);
			$this->MultiCell(80, 15, utf8_encode('Abono mensual'), 0, 'C', false);

			$y = $this->GetY() + 2;
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			foreach ($inmuebles as $key => $inmueble) { 
				$this->setXY($x, $y);
				$this->MultiCell(115, 16, utf8_encode($inmueble['Tipo_Inmueble']), 0, 'C', true);
				$this->setXY(129, $y);
				$this->MultiCell(185, 8, utf8_encode($inmueble['Ubicacion']), 0, 'C', true);
				$this->setXY(317, $y);
				$this->MultiCell(117, 16, utf8_encode($this->id_cliente == 512?'No requerido':$inmueble['Valor']), 0, 'C', true);
				$this->setXY(437, $y);
				$this->MultiCell(80, 16, utf8_encode($inmueble['Pagado'] == 1 ? 'Sí' : 'No'), 0, 'C', true);
				$this->setXY(520, $y);
				$this->MultiCell(80, 16, utf8_encode($inmueble['Abono_Mensual']), 0, 'C', true);
				
				if ($this->GetY() >= 660) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}
			}

		}

		if (count($vehiculos) > 0) {
			if ($this->GetY() >= 660) {
				$this->AddPage();
				$y = 100;
			}else{
				$y = $this->GetY() + 2;
			}
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setXY($x, $y);
			$this->SetFillColor(140, 140, 140);
			$this->setTextColor(255, 255, 255);
			$this->MultiCell(592, 15, utf8_encode('VEHÍCULOS'), 0, 'C', true);

			$y = $this->GetY() + 2;

			$this->setTextColor(140, 140, 140);
			$this->SetFillColor(255, 255, 255);

			$this->setXY($x, $y);
			$this->MultiCell(115, 15, utf8_encode('Marca'), 0, 'C', false);
			$this->setXY(129, $y);
			$this->MultiCell(117, 15, utf8_encode('Modelo'), 0, 'C', false);
			$this->setXY(248, $y);
			$this->MultiCell(117, 15, utf8_encode('Valor'), 0, 'C', false);
			$this->setXY(372, $y);
			$this->MultiCell(112, 15, utf8_encode('Pagado'), 0, 'C', false);
			$this->setXY(486, $y);
			$this->MultiCell(114, 15, utf8_encode('Abono mensual'), 0, 'C', false);

			$y = $this->GetY() + 2;
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			foreach ($vehiculos as $key => $vehiculo) { 
				$this->setXY($x, $y);
				$this->MultiCell(115, 16, utf8_encode($vehiculo['Marca']), 0, 'C', true);
				$this->setXY(129, $y);
				$this->MultiCell(117, 16, utf8_encode($vehiculo['Modelo']), 0, 'C', true);
				$this->setXY(248, $y);
				$this->MultiCell(117, 16, utf8_encode($this->id_cliente == 512?'No requerido':$vehiculo['Valor']), 0, 'C', true);
				$this->setXY(367, $y);
				$this->MultiCell(117, 16, utf8_encode($vehiculo['Pagado'] == 1 ? 'Sí' : 'No'), 0, 'C', true);
				$this->setXY(486, $y);
				$this->MultiCell(114, 16, utf8_encode($vehiculo['Abono_Mensual']), 0, 'C', true);
				if ($this->GetY() >= 660) {
					$this->AddPage();
					$y = 100;
				}else{
					$y = $this->GetY() + 2;
				}
			}
		}
		
		
	}

	public function setConclusiones($observaciones){
		if ($this->GetY() >= 500) {
			$this->AddPage();
			$y = 72;
			$this->SetY($y);
		}elseif ($this->GetY() <= 100){
			$y = 72;
			$this->SetY($y);
		}else{
			$y = $this->GetY() + 20;
		}

		$this->SetFillColor(248, 152, 80);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(250, $y);
		$this->Write(10, 'CONCLUSIONES');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(100, 18, utf8_encode('Acerca del candidato'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(127, $y);
		$this->MultiCell(473, 18, utf8_encode($observaciones->Sobre_Candidato), 0, 'L', true);

		$y = $this->GetY() + 2;
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(100, 8, utf8_encode('Acerca de su familia y entorno'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(127, $y);
		$this->MultiCell(473, 18, utf8_encode($observaciones->Sobre_Casa), 0, 'L', true);

		$y = $this->GetY() + 2;
		
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(100, 8, utf8_encode('Conclusiones del entrevistador'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(127, $y);
		$this->MultiCell(473, 18, utf8_encode($observaciones->Conclusiones_Entrevistador), 0, 'L', true);

		$y = $this->gety() + 25;

		$this->SetFillColor(234, 234, 234);
		$this->Rect(11, $y, 590, 72, 'F');

		$this->SetFillColor(239, 246, 248);
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY(10, $y);
		$this->MultiCell(148, 18, '', 0, 'L', true);
		$this->SetXY(158, $y);
		$this->MultiCell(148, 18, utf8_encode('Bueno'), 0, 'C', true);
		$this->SetXY(306, $y);
		$this->MultiCell(148, 18, utf8_encode('Regular'), 0, 'C', true);
		$this->SetXY(454, $y);
		$this->MultiCell(148, 18, utf8_encode('No aceptable'), 0, 'C', true);

		$y = $this->GetY();

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Participación del candidato'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$participacion = $observaciones->Participacion_Candidato;
		if ($participacion == 243 || $participacion == 242) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($participacion == 241){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($participacion == 240) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		$this->SetFillColor(239, 246, 248);

		$y = $this->GetY() + 2;

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Entorno familiar'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 8, 6, 'F');
		$this->Circle(380, $y + 8, 6, 'F');
		$this->Circle(528, $y + 8, 6, 'F');

		$entorno_familiar = $observaciones->Entorno_Familiar;
		if ($entorno_familiar == 243 || $entorno_familiar == 242) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 8, 4, 'F');
		}elseif ($entorno_familiar == 241){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 8, 4, 'F');
		}elseif($entorno_familiar == 240) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 8, 4, 'F');
		}
		$this->SetFillColor(239, 246, 248);

		$y = $this->GetY() + 2;

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Referencias personales'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$referencias_vecinales = $observaciones->Referencias_Vecinales;
		if ($referencias_vecinales == 243 || $referencias_vecinales == 242) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($referencias_vecinales == 241){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($referencias_vecinales == 240) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		
		if ($y >= 550) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 18;
		}

		$this->SetFillColor(248, 152, 80);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(140, $y);
		$this->Write(10, utf8_encode('COMENTARIOS GENERALES DE LA VERIFICACIÓN'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 25;
		$this->SetFillColor(255, 255, 255);
		
		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->SetXY($x, $y);
		$this->MultiCell(562, 14, (utf8_encode($observaciones->Comentarios_Generales)), 0, 'L', true);
		
		
		if($observaciones->Viabilidad!='' || $observaciones->Viabilidad!=null){
		if ($y >= 550) {
			$this->AddPage();
			$y = 72;
		}else{
			$y = $this->GetY() + 18;
		}

		$this->SetFillColor(248, 152, 80);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(195, $y);
		$this->Write(10, utf8_encode('ANÁLISIS DE LA VERIFICACIÓN'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 25;
		$this->SetFillColor(255, 255, 255);
		
		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->SetXY($x, $y);
		$this->MultiCell(562, 14, (utf8_encode($observaciones->Viabilidad)), 0, 'L', true);
		}
		
	}

	public function setInvestigacionLaboral($investigacion, $Empresa){
		if ($investigacion) {
			if ($this->GetY() >= 500) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 7;
			}

			$this->SetFillColor(4, 124, 183);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			
			$y += 6;
			$this->setXY(227, $y);
			$this->Write(10, utf8_encode('INVESTIGACIÓN LABORAL'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 25;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('¿El candidato cuenta con constancias laborales?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Circunstancias_Laborales), 0, 'L', true);

			$y = $this->GetY() + 2;
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('¿Proporcionó los datos de contacto de sus empleos?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Proporciono_Datos_Empleos), 0, 'L', true);

			$y = $this->GetY() + 4;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 8, utf8_encode('En caso de que no, ¿cuál fue el motivo por que no los proporcionó?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(308, $y-2);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Motivo_No_Proporciono_Datos), 0, 'L', true);

			$y = $this->GetY() + 4;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('¿Ha demandado alguna empresa?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(308, $y-2);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Demanda_Laboral), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('En caso afirmativo, ¿cuál fue el motivo?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Motivo_Demanda), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 18, utf8_encode('Número de empleos registrados en los últimos 3 años'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->No_Empleos), 0, 'L', true);

			/* $y = $this->GetY() + 5;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(281, 8, utf8_encode('Tiempo promedio de duración en sus empleos considerando los últimos 3 años'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(308, $y);
			$this->MultiCell(292, 18, utf8_encode($investigacion->Tiempo_Promedio_Empleos), 0, 'L', true); */

			$y = $this->GetY() + 2;
			if (($investigacion->Sindicalizado == 1 || $investigacion->Sindicalizado == '0') && $Empresa == 190) {
				$y = $this->GetY() + 6;

				$this->setXY(12, $y);
				$this->MultiCell(213, 27, '', 0, 'L', true);

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(200, 12, utf8_encode('En las empresas en las que ha trabajado, ¿ha estado como personal sindicalizado?'), 0, 'L', true);

				$this->Circle(247, $y + 18, 6, 'F');
				$this->Circle(287, $y + 18, 6, 'F');

				if ($investigacion->Sindicalizado == 1) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(247, $y + 18, 4, 'F');
				}elseif ($investigacion->Sindicalizado == '0'){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(287, $y + 18, 4, 'F');
				}

				$this->SetFillColor(239, 246, 248);

				$this->SetXY(229, $y - 8);
				$this->MultiCell(77, 27, utf8_encode('Sí               No'), 0, 'C', false);


				$this->SetFillColor(255, 255, 255);
				if ($investigacion->Sindicalizado == 1) {
					$this->SetXY(321, $y);
					$this->MultiCell(103, 12, utf8_encode('¿En cuál(es)?'), 0, 'L', false);

					$this->setFont('SinkinSans', '', 6.5);
					$this->setTextColor(0, 0, 0);
					$this->setXY(426, $y);
					$this->MultiCell(176, 27, utf8_encode($investigacion->Sindicato), 0, 'L', true);		
					
					
					$y = $this->GetY() + 2;

					$this->setXY(12, $y);
					$this->MultiCell(213, 27, '', 0, 'L', true);

					$this->setFont('SinkinSans', 'B', 6.5);
					$this->setTextColor(140, 140, 140);
					$this->SetXY($x, $y);
					$this->MultiCell(200, 14, utf8_encode('¿Tuvo un puesto en el comité sindical?'), 0, 'L', true);

					$this->Circle(247, $y + 18, 6, 'F');
					$this->Circle(287, $y + 18, 6, 'F');

					if ($investigacion->Comite_Sindical == 1) {
						$this->SetFillColor(43, 179, 73);
						$this->Circle(247, $y + 18, 4, 'F');
					}elseif ($investigacion->Comite_Sindical == '0'){
						$this->SetFillColor(255, 16, 16);
						$this->Circle(287, $y + 18, 4, 'F');
					}
					$this->SetFillColor(239, 246, 248);

					$this->SetXY(229, $y - 8);
					$this->MultiCell(77, 27, utf8_encode('Sí               No'), 0, 'C', false);

					$this->SetFillColor(255, 255, 255);
					if ($investigacion->Comite_Sindical == 1) {
						$this->SetXY(321, $y);
						$this->MultiCell(103, 27, utf8_encode('¿Cuál fue el puesto?'), 0, 'L', false);

						$this->setFont('SinkinSans', '', 6.5);
						$this->setTextColor(0, 0, 0);
						$this->setXY(426, $y);
						$this->MultiCell(176, 27, utf8_encode($investigacion->Puesto_Sindical), 0, 'L', true);
						
						
						$y = $this->GetY() + 2;

						$this->setFont('SinkinSans', 'B', 6.5);
						$this->setTextColor(140, 140, 140);
						$this->SetXY($x, $y);
						$this->MultiCell(103, 10, utf8_encode('¿Cuáles eran sus funciones?'), 0, 'L', false);

						$this->setFont('SinkinSans', '', 6.5);
						$this->setTextColor(0, 0, 0);
						$this->setXY(130, $y);
						$this->MultiCell(176, 10, utf8_encode($investigacion->Funciones_Sindicato), 0, 'L', true);

						$this->setFont('SinkinSans', 'B', 6.5);
						$this->setTextColor(140, 140, 140);
						$this->SetXY(321, $y);
						$this->MultiCell(103, 10, utf8_encode('¿Durante cuánto tiempo?'), 0, 'L', false);

						$this->setFont('SinkinSans', '', 6.5);
						$this->setTextColor(0, 0, 0);
						$this->setXY(426, $y);
						$this->MultiCell(176, 20, utf8_encode($investigacion->Tiempo_Sindicato), 0, 'L', true);

					}
				}
					
				
			}
			if ($Empresa == 130 && $investigacion->Trabajo_Ternium) {
				$y = $this->GetY() + 2;
			
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(281, 18, utf8_encode('¿Ha trabajado para Ternium?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(308, $y);
				$this->MultiCell(292, 18, utf8_encode($investigacion->Trabajo_Ternium), 0, 'L', true);
				
				if ($investigacion->Trabajo_Ternium == 'Sí') {
				$y = $this->GetY() + 4;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(281, 8, utf8_encode('¿Qué empresa lo dio de alta y cuándo fue su último acceso a una planta Ternium?'), 0, 'L', false);
	
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(308, $y);
				$this->MultiCell(292, 18, utf8_encode($investigacion->Alta_Ternium), 0, 'L', true);
	

				$y = $this->GetY() + 3;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(281, 18, utf8_encode('¿Tiene algún veto o sanción con Ternium?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(308, $y);
				$this->MultiCell(292, 18, utf8_encode($investigacion->Veto_Ternium), 0, 'L', true);
				}
			}
			if ($Empresa == 167 && $investigacion->Positivo_Antidoping) {
				$y = $this->GetY() + 2;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(281, 18, utf8_encode('¿Alguna vez salió positivo en una prueba antidoping?'), 0, 'L', false);
	
				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(308, $y);
				$this->MultiCell(292, 18, utf8_encode($investigacion->Positivo_Antidoping), 0, 'L', true);

				if ($investigacion->Positivo_Antidoping == 'Si') {
					$y = $this->GetY() + 2;

					$this->setFont('SinkinSans', 'B', 6.5);
					$this->setTextColor(140, 140, 140);
					$this->SetXY($x, $y);
					$this->MultiCell(281, 18, utf8_encode('Especificar la sustancia'), 0, 'L', false);

					$this->setFont('SinkinSans', '', 6.5);
					$this->setTextColor(0, 0, 0);
					$this->setXY(308, $y);
					$this->MultiCell(292, 18, utf8_encode($investigacion->Sustancia_Antidoping), 0, 'L', true);	
				}

				$y = $this->GetY() + 2;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(281, 18, utf8_encode('¿Cuenta con accidentes en su historia con la empresa?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(308, $y);
				$this->MultiCell(292, 18, utf8_encode($investigacion->Accidentes_Empresa), 0, 'L', true);

				$y = $this->GetY() + 2;

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(281, 18, utf8_encode('¿Tuvo abandono de unidad?'), 0, 'L', false);

				$this->setFont('SinkinSans', '', 6.5);
				$this->setTextColor(0, 0, 0);
				$this->setXY(308, $y);
				$this->MultiCell(292, 18, utf8_encode($investigacion->Abandono_Unidad), 0, 'L', true);
			}
		}
		
	}

	public function setReferenciasLaborales($referencias_laborales, $Cliente, $Empresa){
		foreach ($referencias_laborales as $key => $referencia) { 
			$this->AddPage();
			$y = 72;

			$this->SetFillColor(73, 142, 180);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, 'REFERENCIA LABORAL '.($key + 1));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 25;
			$this->SetFillColor(255, 255, 255);
			$this->SetXY($x, $y+3);
			$this->MultiCell(103, 18, utf8_encode('Empresa'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			//$this->MultiCell(176, 9, utf8_encode($referencia['Empresa']), 0, 'L', true);
 			if(strlen($referencia['Empresa'])<50){
				 $h = 10; $this->setXY(130, $y-1); 
			 }
                 else { $h = 10; $this->setXY(130, $y-2); }
			 $this->MultiCell(176, $h, utf8_encode($referencia['Empresa']), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y+3);
			$this->MultiCell(103, 18, utf8_encode('Giro'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y+2);
			$this->MultiCell(173, 18, utf8_encode($referencia['Giro']), 0, 'L', true);

			$y = $this->GetY() + 3;
			
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Domicilio'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6);
			$this->setTextColor(0, 0, 0);
			if(strlen($referencia['Domicilio'])<50){$h = 18; $this->setXY(130, $y-1); }
			else { $h = 10;  }
			$this->setXY(130, $y-2);
			$this->MultiCell(176, $h, utf8_encode($referencia['Domicilio']), 0, 'J', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Teléfono'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y);
			$this->MultiCell(173, 18, utf8_encode($referencia['Telefono']), 0, 'L', true);

			$y = $this->GetY() + 3;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Fecha de Ingreso'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Fecha_Ingreso']), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Fecha de Baja'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y);
			$this->MultiCell(173, 18, utf8_encode($referencia['Fecha_Baja']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Puesto inicial'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Puesto_Inicial']), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Puesto final'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y);
			$this->MultiCell(173, 18, utf8_encode($referencia['Puesto_Final']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Jefe inmediato'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Jefe']), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Puesto del jefe'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y);
			$this->MultiCell(173, 18, utf8_encode($referencia['Puesto_Jefe']), 0, 'L', true);




			/* $y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Tipo de Unidad'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Tipo_Unidad']), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Robos / pérdidas'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Robos_Perdidas'] == 1 ? 'Sí' : 'No'), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('¿Accidentes graves?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Accidentes_Graves'] == 1 ? 'Sí' : 'No'), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 18, utf8_encode('Cuidado a la Unidad'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Cuidado_Unidad'] == 1 ? 'Sí' : 'No'), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Problemas con Unidad'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Problemas_Unidad'] == 1 ? 'Sí' : 'No'), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 9, utf8_encode('¿Manejaba gastos de viaje?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Gastos_Viaje'] == 1 ? 'Sí' : 'No'), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 9, utf8_encode('¿Presentaba constantemente faltantes?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Presentaba_Faltantes'] == 1 ? 'Sí' : 'No'), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 9, utf8_encode('¿Problemas con diésel?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(426, $y);
			$this->MultiCell(176, 18, utf8_encode($referencia['Problemas_Diesel'] == 1 ? 'Sí' : 'No'), 0, 'L', true);*/


			$y = $this->GetY() + 2; 

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 27, utf8_encode('Motivo de separación'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(469, 27, utf8_encode($referencia['Motivo_Separacion']), 0, 'L', true);

			$this->setXY(308, $y);
			$this->MultiCell(213, 27, '', 0, 'L', true);

			if ($Cliente == 314) {
				$y = $this->GetY() + 2;
				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(300, 14, utf8_encode('¿Sabe si el candidato consume estupefacientes o medicamentos controlados?'), 0, 'L', false);

				$this->Circle(247 + 100, $y + 18, 6, 'F');
				$this->Circle(287 + 100, $y + 18, 6, 'F');

				if ($referencia['Dopaje'] == 1) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(247 + 100, $y + 18, 4, 'F');
				}elseif ($referencia['Dopaje'] == 0){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(287 + 100, $y + 18, 4, 'F');
				}
				$this->SetFillColor(239, 246, 248);

				$this->SetXY(229 + 100, $y - 8);
				$this->MultiCell(77, 27, utf8_encode('Sí               No'), 0, 'C', false);

				$this->SetFillColor(255, 255, 255);
				$this->SetY($this->gety() + 6);
			}

			$y = $this->GetY() + 2;
			$this->SetFillColor(239, 246, 248);
			$this->setXY(12, $y);
			$this->MultiCell(213, 27, '', 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			
			$this->SetXY($x, $y+6);
			$this->MultiCell(200, 14, utf8_encode('¿Es el candidato una persona recontratable?'), 0, 'L', true);
  			$this->SetFillColor(255,255,255);
			$this->Circle(247, $y + 18, 6, 'F');
			$this->Circle(287, $y + 18, 6, 'F');

			if ($referencia['Recontratable'] == 1) {
				$this->SetFillColor(43, 179, 73);
				$this->Circle(247, $y + 18, 4, 'F');
			}elseif ($referencia['Recontratable'] == 0){
				$this->SetFillColor(255, 16, 16);
				$this->Circle(287, $y + 18, 4, 'F');
			}
			$this->SetFillColor(239, 246, 248);

			$this->SetXY(229, $y - 8);
			$this->MultiCell(77, 27, utf8_encode('Sí               No'), 0, 'C', false);

			$this->SetFillColor(255, 255, 255);
			$this->SetXY(321, $y);
			$this->MultiCell(103, 27, utf8_encode('¿Por qué?'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(423, $y);
			$this->MultiCell(176, 27, utf8_encode($referencia['Recontratable_PorQue']), 0, 'L', true);

			$y = $this->GetY() + 2;
			if (($referencia['Sindicalizado'] == 1 || $referencia['Sindicalizado'] == '0') && $Empresa == 190) {
				///////////////////////////////////////////////////CEMENTIN///////////////////////////////////////
				$y = $this->GetY() + 6;

				$this->setXY(12, $y);
				$this->MultiCell(213, 27, '', 0, 'L', true);

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$this->SetXY($x, $y);
				$this->MultiCell(200, 14, utf8_encode('¿El candidato estuvo sindicalizado?'), 0, 'L', true);

				$this->Circle(247, $y + 18, 6, 'F');
				$this->Circle(287, $y + 18, 6, 'F');

				if ($referencia['Sindicalizado'] == 1) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(247, $y + 18, 4, 'F');
				}elseif ($referencia['Sindicalizado'] == '0'){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(287, $y + 18, 4, 'F');
				}

				$this->SetFillColor(239, 246, 248);

				$this->SetXY(229, $y - 8);
				$this->MultiCell(77, 27, utf8_encode('Sí               No'), 0, 'C', false);

				$this->SetFillColor(255, 255, 255);
				if ($referencia['Sindicalizado'] == 1) {
					$this->SetXY(321, $y);
					$this->MultiCell(103, 12, utf8_encode('¿En cuál(es) sindicato(s) estuvo?'), 0, 'L', false);

					$this->setFont('SinkinSans', '', 6.5);
					$this->setTextColor(0, 0, 0);
					$this->setXY(426, $y);
					$this->MultiCell(176, 27, utf8_encode($referencia['Sindicato']), 0, 'L', true);


					$y = $this->GetY() + 2;

					$this->setXY(12, $y);
					$this->MultiCell(213, 27, '', 0, 'L', true);

					$this->setFont('SinkinSans', 'B', 6.5);
					$this->setTextColor(140, 140, 140);
					$this->SetXY($x, $y);
					$this->MultiCell(200, 14, utf8_encode('¿Tuvo un puesto en el comité sindical?'), 0, 'L', true);

					$this->Circle(247, $y + 18, 6, 'F');
					$this->Circle(287, $y + 18, 6, 'F');

					if ($referencia['Comite_Sindical'] == 1) {
						$this->SetFillColor(43, 179, 73);
						$this->Circle(247, $y + 18, 4, 'F');
					}elseif ($referencia['Comite_Sindical'] == '0'){
						$this->SetFillColor(255, 16, 16);
						$this->Circle(287, $y + 18, 4, 'F');
					}
					$this->SetFillColor(239, 246, 248);

					$this->SetXY(229, $y - 8);
					$this->MultiCell(77, 27, utf8_encode('Sí               No'), 0, 'C', false);

					$this->SetFillColor(255, 255, 255);
					if ($referencia['Comite_Sindical'] == 1) {
						$this->SetXY(321, $y);
						$this->MultiCell(103, 27, utf8_encode('¿Cuál fue el puesto?'), 0, 'L', false);

						$this->setFont('SinkinSans', '', 6.5);
						$this->setTextColor(0, 0, 0);
						$this->setXY(426, $y);
						$this->MultiCell(176, 27, utf8_encode($referencia['Puesto_Sindical']), 0, 'L', true);


						$y = $this->GetY() + 2;

						$this->setFont('SinkinSans', 'B', 6.5);
						$this->setTextColor(140, 140, 140);
						$this->SetXY($x, $y);
						$this->MultiCell(103, 10, utf8_encode('¿Cuáles eran sus funciones?'), 0, 'L', false);

						$this->setFont('SinkinSans', '', 6.5);
						$this->setTextColor(0, 0, 0);
						$this->setXY(130, $y);
						$this->MultiCell(176, 10, utf8_encode($referencia['Funciones_Sindicato']), 0, 'L', true);

						$this->setFont('SinkinSans', 'B', 6.5);
						$this->setTextColor(140, 140, 140);
						$this->SetXY(321, $y);
						$this->MultiCell(103, 10, utf8_encode('¿Durante cuánto tiempo?'), 0, 'L', false);

						$this->setFont('SinkinSans', '', 6.5);
						$this->setTextColor(0, 0, 0);
						$this->setXY(426, $y);
						$this->MultiCell(176, 20, utf8_encode($referencia['Tiempo_Sindicato']), 0, 'L', true);

						$y = $this->GetY() + 10;
					}else
						$y = $this->GetY() + 14;
					
					////////////////////////////////////////////////CEMENTIN//////////////////////////////////////////////
				}else 
					$y = $this->GetY() + 14;
					
				
			}
			
			

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 9, utf8_encode('Nombre y puesto de quien proporciona la información'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(469, 27, utf8_encode($referencia['Informante']), 0, 'L', true);

			$y = $this->GetY() + 2;

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(103, 18, utf8_encode('Comentarios'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(130, $y);
			$this->MultiCell(469, 14, utf8_encode($referencia['Comentarios']), 0, 'L', true);

			if ($referencia['Calif'] == 0) {
				if ($this->GetY() > 590) {
					$this->AddPage();
					$y = 72;
				} else {
					$y = $this->GetY() + 25;
				}
				
				$this->SetFillColor(73, 142, 180);
				$this->Rect(10, $y, 592, 20, 'F');
				$this->SetFont('Sinkinsans','B', 11);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(260, $y);
				$this->Write(10, 'CONCEPTOS');

				$this->setFont('SinkinSans', 'B', 6.5);
				$this->setTextColor(140, 140, 140);
				$x = 25;
				$y = $this->GetY() + 15;
				
				$this->SetFillColor(234, 234, 234);
				$this->Rect(11, $y, 590, 110, 'F');

				$this->SetFillColor(239, 246, 248);
				$this->SetXY(10, $y);
				$this->MultiCell(148, 18, '', 0, 'L', true);
				$this->SetXY(158, $y);
				$this->MultiCell(111, 18, utf8_encode('Excelente'), 0, 'C', true);
				$this->SetXY(269, $y);
				$this->MultiCell(111, 18, utf8_encode('Apropiada'), 0, 'C', true);
				$this->SetXY(380, $y);
				$this->MultiCell(111, 18, utf8_encode('Regular'), 0, 'C', true);
				$this->SetXY(491, $y);
				$this->MultiCell(111, 18, utf8_encode('Malo'), 0, 'C', true);

				$y = $this->GetY();

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Desempeño laboral'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$desempenio = $referencia['Desempeno'];
				if ($desempenio == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($desempenio == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($desempenio == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($desempenio == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}
				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Honradez'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$honradez = $referencia['Honradez'];
				if ($honradez == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($honradez == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($honradez == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($honradez == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}
				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Asistencia y puntualidad'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$asistencia = $referencia['Puntualidad'];
				if ($asistencia == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($asistencia == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($asistencia == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($asistencia == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}

				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Relación con superiores y compañeros'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$relacion = $referencia['Relacion'];
				if ($relacion == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($relacion == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($relacion == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($relacion == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}

				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Responsabilidad'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$responsabilidad = $referencia['Responsabilidad'];
				if ($responsabilidad == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($responsabilidad == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($responsabilidad == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($responsabilidad == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}
				
				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;

				$this->SetXY(10, $y);
				$this->MultiCell(591, 16, utf8_encode('Adaptación al ambiente de trabajo'), 0, 'L', true);
				$this->SetFillColor(255, 255, 255);
				$this->Circle(213, $y + 7, 6, 'F');
				$this->Circle(324, $y + 7, 6, 'F');
				$this->Circle(435, $y + 7, 6, 'F');
				$this->Circle(546, $y + 7, 6, 'F');

				$adaptacion = $referencia['Adaptacion'];
				if ($adaptacion == 260) {
					$this->SetFillColor(43, 179, 73);
					$this->Circle(213, $y + 7, 4, 'F');
				}elseif ($adaptacion == 261){
					$this->SetFillColor(43, 157, 247);
					$this->Circle(324, $y + 7, 4, 'F');
				}elseif ($adaptacion == 262) {
					$this->SetFillColor(243, 238, 82);
					$this->Circle(435, $y + 7, 4, 'F');
				}elseif ($adaptacion == 263){
					$this->SetFillColor(255, 16, 16);
					$this->Circle(546, $y + 7, 4, 'F');
				}
				
				$this->SetFillColor(239, 246, 248);

				$y = $this->GetY() + 2;
			}else{
				$y = $this->GetY();
				$this->SetXY(130, $y);
				$this->MultiCell(469, 18, utf8_encode('La empresa no proporcionó datos del desempeño del candidato.'), 0, 'L', true);
			}

		}
	}

	public function setResultadoInvestigacionLaboral($observaciones, $Empresa){
		$this->AddPage();
		$y = 72;
		$this->SetFillColor(73, 142, 180);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		
		$y += 6;
		$this->setXY(150, $y);
		$this->Write(10, utf8_encode('RESULTADO DE LA INVESTIGACIÓN LABORAL'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 25;
		
		$this->SetFillColor(234, 234, 234);
		$this->Rect(11, $y, 590, 72, 'F');

		$this->SetFillColor(239, 246, 248);
		$this->SetXY(10, $y);
		$this->MultiCell(148, 18, '', 0, 'L', true);
		$this->SetXY(158, $y);
		$this->MultiCell(148, 18, utf8_encode('Bueno'), 0, 'C', true);
		$this->SetXY(306, $y);
		$this->MultiCell(148, 18, utf8_encode('Regular'), 0, 'C', true);
		$this->SetXY(454, $y);
		$this->MultiCell(148, 18, utf8_encode('Malo'), 0, 'C', true);

		$y = $this->GetY();

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Información proporcionada por el candidato'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$info_proporcionada_candidato = $observaciones->Info_Proporcionada_Candidato;
		if ($info_proporcionada_candidato == 243 || $info_proporcionada_candidato == 242) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($info_proporcionada_candidato == 241){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($info_proporcionada_candidato == 240) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		$this->SetFillColor(239, 246, 248);

		$y = $this->GetY() + 2;

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Referencias laborales obtenidas'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$referencias_laborales = $observaciones->Referencias_Laborales;
		if ($referencias_laborales == 243 || $referencias_laborales == 242) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($referencias_laborales == 241){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($referencias_laborales == 240) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}
		$this->SetFillColor(239, 246, 248);

		$y = $this->GetY() + 2;

		$this->SetXY(10, $y);
		$this->MultiCell(591, 16, utf8_encode('Información confiable y verificable'), 0, 'L', true);
		$this->SetFillColor(255, 255, 255);
		$this->Circle(232, $y + 7, 6, 'F');
		$this->Circle(380, $y + 7, 6, 'F');
		$this->Circle(528, $y + 7, 6, 'F');

		$info_confiable = $observaciones->Info_Confiable;
		if ($info_confiable == 243 || $info_confiable == 242) {
			$this->SetFillColor(43, 179, 73);
			$this->Circle(232, $y + 7, 4, 'F');
		}elseif ($info_confiable == 241){
			$this->SetFillColor(243, 238, 82);
			$this->Circle(380, $y + 7, 4, 'F');
		}elseif ($info_confiable == 240) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle(528, $y + 7, 4, 'F');
		}

		$y = $this->GetY() + 20;
		$this->SetFillColor(73, 142, 180);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans','B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(100, $y);
		$this->Write(10, utf8_encode('COMENTARIOS GENERALES DE LA INVESTIGACIÓN LABORAL'));

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$y = $this->GetY() + 25;
		$this->SetFillColor(255, 255, 255);
		
		$this->setFont('SinkinSans', '', 6);
		$this->setTextColor(0, 0, 0);
		$this->SetXY($x, $y);
		$this->MultiCell(562, 10, (utf8_encode($observaciones->Comentario_General_il)), 0, 'L', true);

		if (strlen($observaciones->Califica_como) > 0 && $observaciones->Viable == NULL) {
			$y = $this->GetY();
			$this->SetXY($x, $y);
			$this->setFont('SinkinSans', 'B', 7);
			$this->MultiCell(562, 25, (utf8_encode('El candidato califica como '.$observaciones->Califica_como)), 0, 'L', true);
		}

		if ($observaciones->Viable != NULL) {
			$y = $this->GetY();
			$this->SetXY($x, $y);
			$this->setFont('SinkinSans', 'B', 7);
			if ($Empresa != 87) {
				
					$this->MultiCell(562, 25, (utf8_encode('El candidato ' . ($observaciones->Viable == '0' ? 'es viable para su contratación' : ($observaciones->Viable == 1 ? 'No viable para su contratación' : ($observaciones->Viable == 2 ? 'califica como reserva  para su contratación' : ($observaciones->Viable == 4 ? 'Sin viabilidad' : ($observaciones->Viable == 5 ? 'Viable con observaciones' : ''))))))), 0, 'L', true);
			} else {
				
			
				$this->MultiCell(562, 25, (utf8_encode('El candidato califica como ' . ($observaciones->Viable == '0' ? 'Viable para su permanencia dentro de la organización' : ($observaciones->Viable == 1 ? 'No viable para su permanencia dentro de la organización' : ($observaciones->Viable == 2 ? 'Viable con reservas para su permanencia dentro de la organización' : ($observaciones->Viable == 4 ? 'Sin viabilidad' : ($observaciones->Viable == 5 ? 'Viable con observaciones' : ''))))))), 0, 'L', true);
				
			}
		}
	}
	
	public function setNotasLegales($ral){
		if ($ral->Comentarios) {
			if ($this->GetY() > 720) {
				$this->AddPage();
				$y = 72;
			}else{
				$y = $this->GetY() + 15;
			}
			$this->SetFillColor(73, 142, 180);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(250, $y);
			$this->Write(10, utf8_encode('NOTAS LEGALES'));

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$x = 25;
			$y = $this->GetY() + 25;
			$this->SetFillColor(255, 255, 255);
			
			$this->setFont('SinkinSans', '', 6);
			$this->setTextColor(0, 0, 0);
			$this->SetXY($x, $y);
			$this->MultiCell(562, 10, (utf8_encode($ral->Comentarios)), 0, 'L', true);
		}
	}

	public function setFotoCredencial($r_foto_credencial_frente, $r_foto_credencial_atras){
		if ($r_foto_credencial_frente) {
			$foto_credencial_frente = getimagesize($r_foto_credencial_frente[0]);
			if ($foto_credencial_frente[2] != 2)
				$r_foto_credencial_frente[1] = 'png';
			else
				$r_foto_credencial_frente[1] = 'jpg';
			$w_foto_credencial_frente = $foto_credencial_frente[0];
			$h_foto_credencial_frente = $foto_credencial_frente[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('CREDENCIAL DE ELECTOR'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_credencial_frente > $h_foto_credencial_frente) {
				$h_foto_credencial_frente = $h_foto_credencial_frente * 400 / $w_foto_credencial_frente;
				$w_foto_credencial_frente = 400;
				$this->Image($r_foto_credencial_frente[0], 106, $this->GetY(), $w_foto_credencial_frente, $h_foto_credencial_frente, $r_foto_credencial_frente[1]);
			} else {
				$w_foto_credencial_frente = $w_foto_credencial_frente * 300 / $h_foto_credencial_frente;
				$h_foto_credencial_frente = 300;
				$this->Image($r_foto_credencial_frente[0], (612 - $w_foto_credencial_frente) / 2, $this->GetY(), $w_foto_credencial_frente, $h_foto_credencial_frente, $r_foto_credencial_frente[1]);
				
			}

			$y = $this->GetY() + $h_foto_credencial_frente + 15;
			$this->SetY($y);
		}
		
		
		if ($r_foto_credencial_atras) {
			$foto_credencial_atras = getimagesize($r_foto_credencial_atras[0]);
			if ($foto_credencial_atras[2] != 2)
				$r_foto_credencial_atras[1] = 'png';
			else
				$r_foto_credencial_atras[1] = 'jpg';
			$w_foto_credencial_atras = $foto_credencial_atras[0];
			$h_foto_credencial_atras = $foto_credencial_atras[1];

			if ($w_foto_credencial_atras > $h_foto_credencial_atras) {
				$h_foto_credencial_atras = $h_foto_credencial_atras * 400 / $w_foto_credencial_atras;
				$w_foto_credencial_atras = 400;
				$this->Image($r_foto_credencial_atras[0], 106, $this->GetY(), $w_foto_credencial_atras, $h_foto_credencial_atras, $r_foto_credencial_atras[1]);
			} else {
				$w_foto_credencial_atras = $w_foto_credencial_atras * 300 / $h_foto_credencial_atras;
				$h_foto_credencial_atras = 300;
				$this->Image($r_foto_credencial_atras[0], (612 - $w_foto_credencial_atras) / 2, $this->GetY(), $w_foto_credencial_atras, $h_foto_credencial_atras, $r_foto_credencial_atras[1]);
				
			}
		}
	}

	public function setFotoActaNacimiento($r_foto_acta){
		if ($r_foto_acta) {
			$foto_acta = getimagesize($r_foto_acta[0]);
			if ($foto_acta[2] != 2)
				$r_foto_acta[1] = 'png';
			else
				$r_foto_acta[1] = 'jpg';
			$w_foto_acta = $foto_acta[0];
			$h_foto_acta = $foto_acta[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, utf8_encode('ACTA DE NACIMIENTO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_acta > $h_foto_acta) {
				$h_foto_acta = $h_foto_acta * 488 / $w_foto_acta;
				$w_foto_acta = 488;
				$this->Image($r_foto_acta[0], 62, $this->GetY(), $w_foto_acta, $h_foto_acta, $r_foto_acta[1]);
			} else {
				$w_foto_acta = $w_foto_acta * 560 / $h_foto_acta;
				$h_foto_acta = 560;
				$this->Image($r_foto_acta[0], (612 - $w_foto_acta) / 2, $this->GetY(), $w_foto_acta, $h_foto_acta, $r_foto_acta[1]);
				
			}
		}
		

	}

	public function setFotoLicenciaConducir($r_foto_licencia){
		if ($r_foto_licencia) {
			$foto_licencia = getimagesize($r_foto_licencia[0]);
			if ($foto_licencia[2] != 2)
				$r_foto_licencia[1] = 'png';
			else
				$r_foto_licencia[1] = 'jpg';
			$w_foto_licencia = $foto_licencia[0];
			$h_foto_licencia = $foto_licencia[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('LICENCIA DE CONDUCIR'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_licencia > $h_foto_licencia) {
				$h_foto_licencia = $h_foto_licencia * 400 / $w_foto_licencia;
				$w_foto_licencia = 400;
				$this->Image($r_foto_licencia[0], 106, $this->GetY(), $w_foto_licencia, $h_foto_licencia, $r_foto_licencia[1]);
			} else {
				$w_foto_licencia = $w_foto_licencia * 300 / $h_foto_licencia;
				$h_foto_licencia = 300;
				$this->Image($r_foto_licencia[0], (612 - $w_foto_licencia) / 2, $this->GetY(), $w_foto_licencia, $h_foto_licencia, $r_foto_licencia[1]);
				
			}
		}
	}

	public function setFotoCartillaMilitar($r_foto_cartilla_militar){
		if ($r_foto_cartilla_militar) {
			$foto_cartilla_militar = getimagesize($r_foto_cartilla_militar[0]);
			if ($foto_cartilla_militar[2] != 2)
				$r_foto_cartilla_militar[1] = 'png';
			else
				$r_foto_cartilla_militar[1] = 'jpg';
			$w_foto_cartilla_militar = $foto_cartilla_militar[0];
			$h_foto_cartilla_militar = $foto_cartilla_militar[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('CARTILLA MILITAR'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_cartilla_militar > $h_foto_cartilla_militar) {
				$h_foto_cartilla_militar = $h_foto_cartilla_militar * 400 / $w_foto_cartilla_militar;
				$w_foto_cartilla_militar = 400;
				$this->Image($r_foto_cartilla_militar[0], 106, $this->GetY(), $w_foto_cartilla_militar, $h_foto_cartilla_militar, $r_foto_cartilla_militar[1]);
			} else {
				$w_foto_cartilla_militar = $w_foto_cartilla_militar * 300 / $h_foto_cartilla_militar;
				$h_foto_cartilla_militar = 300;
				$this->Image($r_foto_cartilla_militar[0], (612 - $w_foto_cartilla_militar) / 2, $this->GetY(), $w_foto_cartilla_militar, $h_foto_cartilla_militar, $r_foto_cartilla_militar[1]);
				
			}
		}
	}

	public function setFotoCURP($r_foto_curp){
		if ($r_foto_curp) {
			$foto_curp = getimagesize($r_foto_curp[0]);
			if ($foto_curp[2] != 2)
				$r_foto_curp[1] = 'png';
			else
				$r_foto_curp[1] = 'jpg';
			$w_foto_curp = $foto_curp[0];
			$h_foto_curp = $foto_curp[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(300, $y);
			$this->Write(10, utf8_encode('CURP'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_curp > $h_foto_curp) {
				$h_foto_curp = $h_foto_curp * 488 / $w_foto_curp;
				$w_foto_curp = 488;
				$this->Image($r_foto_curp[0], 62, $this->GetY(), $w_foto_curp, $h_foto_curp, $r_foto_curp[1]);
			} else {
				$w_foto_curp = $w_foto_curp * 560 / $h_foto_curp;
				$h_foto_curp = 560;
				$this->Image($r_foto_curp[0], (612 - $w_foto_curp) / 2, $this->GetY(), $w_foto_curp, $h_foto_curp, $r_foto_curp[1]);
				
			}
		}
		

	}

	public function setFotoRFC($r_foto_rfc){
		if ($r_foto_rfc) {
			$foto_rfc = getimagesize($r_foto_rfc[0]);
			if ($foto_rfc[2] != 2)
				$r_foto_rfc[1] = 'png';
			else
				$r_foto_rfc[1] = 'jpg';
			$w_foto_rfc = $foto_rfc[0];
			$h_foto_rfc = $foto_rfc[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(300, $y);
			$this->Write(10, utf8_encode('RFC'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_rfc > $h_foto_rfc) {
				$h_foto_rfc = $h_foto_rfc * 488 / $w_foto_rfc;
				$w_foto_rfc = 488;
				$this->Image($r_foto_rfc[0], 62, $this->GetY(), $w_foto_rfc, $h_foto_rfc, $r_foto_rfc[1]);
			} else {
				$w_foto_rfc = $w_foto_rfc * 560 / $h_foto_rfc;
				$h_foto_rfc = 560;
				$this->Image($r_foto_rfc[0], (612 - $w_foto_rfc) / 2, $this->GetY(), $w_foto_rfc, $h_foto_rfc, $r_foto_rfc[1]);
				
			}
		}
		

	}
	
	public function setFotoNSS($r_foto_nss){
		if ($r_foto_nss) {
			$foto_nss = getimagesize($r_foto_nss[0]);
			if ($foto_nss[2] != 2)
				$r_foto_nss[1] = 'png';
			else
				$r_foto_nss[1] = 'jpg';
			$w_foto_nss = $foto_nss[0];
			$h_foto_nss = $foto_nss[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(210, $y);
			$this->Write(10, utf8_encode('Número de seguridad social'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_nss > $h_foto_nss) {
				$h_foto_nss = $h_foto_nss * 488 / $w_foto_nss;
				$w_foto_nss = 488;
				$this->Image($r_foto_nss[0], 62, $this->GetY(), $w_foto_nss, $h_foto_nss, $r_foto_nss[1]);
			} else {
				$w_foto_nss = $w_foto_nss * 560 / $h_foto_nss;
				$h_foto_nss = 560;
				$this->Image($r_foto_nss[0], (612 - $w_foto_nss) / 2, $this->GetY(), $w_foto_nss, $h_foto_nss, $r_foto_nss[1]);
				
			}
		}
		

	}

	public function setFotoAfore($r_foto_afore){
		if ($r_foto_afore) {
			$foto_afore = getimagesize($r_foto_afore[0]);
			if ($foto_afore[2] != 2)
				$r_foto_afore[1] = 'png';
			else
				$r_foto_afore[1] = 'jpg';
			$w_foto_afore = $foto_afore[0];
			$h_foto_afore = $foto_afore[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(250, $y);
			$this->Write(10, utf8_encode('AFORE'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_afore > $h_foto_afore) {
				$h_foto_afore = $h_foto_afore * 488 / $w_foto_afore;
				$w_foto_afore = 488;
				$this->Image($r_foto_afore[0], 62, $this->GetY(), $w_foto_afore, $h_foto_afore, $r_foto_afore[1]);
			} else {
				$w_foto_afore = $w_foto_afore * 560 / $h_foto_afore;
				$h_foto_afore = 560;
				$this->Image($r_foto_afore[0], (612 - $w_foto_afore) / 2, $this->GetY(), $w_foto_afore, $h_foto_afore, $r_foto_afore[1]);
				
			}
		}
		

	}

	public function setFotoComprobanteDomicilio($r_foto_comprobante_domicilio){
		if ($r_foto_comprobante_domicilio) {
			$foto_comprobante_domicilio = getimagesize($r_foto_comprobante_domicilio[0]);
			if ($foto_comprobante_domicilio[2] != 2)
				$r_foto_comprobante_domicilio[1] = 'png';
			else
				$r_foto_comprobante_domicilio[1] = 'jpg';
			$w_foto_comprobante_domicilio = $foto_comprobante_domicilio[0];
			$h_foto_comprobante_domicilio = $foto_comprobante_domicilio[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('COMPROBANTE DE DOMICILIO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_comprobante_domicilio > $h_foto_comprobante_domicilio) {
				$h_foto_comprobante_domicilio = $h_foto_comprobante_domicilio * 488 / $w_foto_comprobante_domicilio;
				$w_foto_comprobante_domicilio = 488;
				$this->Image($r_foto_comprobante_domicilio[0], 62, $this->GetY(), $w_foto_comprobante_domicilio, $h_foto_comprobante_domicilio, $r_foto_comprobante_domicilio[1]);
			} else {
				$w_foto_comprobante_domicilio = $w_foto_comprobante_domicilio * 560 / $h_foto_comprobante_domicilio;
				$h_foto_comprobante_domicilio = 560;
				$this->Image($r_foto_comprobante_domicilio[0], (612 - $w_foto_comprobante_domicilio) / 2, $this->GetY(), $w_foto_comprobante_domicilio, $h_foto_comprobante_domicilio, $r_foto_comprobante_domicilio[1]);
				
			}
		}
		

	}

	public function setFotoComprobanteEstudios($r_foto_comprobante_estudios){
		if ($r_foto_comprobante_estudios) {
			$foto_comprobante_estudios = getimagesize($r_foto_comprobante_estudios[0]);
			if ($foto_comprobante_estudios[2] != 2)
				$r_foto_comprobante_estudios[1] = 'png';
			else
				$r_foto_comprobante_estudios[1] = 'jpg';
			$w_foto_comprobante_estudios = $foto_comprobante_estudios[0];
			$h_foto_comprobante_estudios = $foto_comprobante_estudios[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, utf8_encode('Comprobante de Estudios'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_comprobante_estudios > $h_foto_comprobante_estudios) {
				$h_foto_comprobante_estudios = $h_foto_comprobante_estudios * 488 / $w_foto_comprobante_estudios;
				$w_foto_comprobante_estudios = 488;
				$this->Image($r_foto_comprobante_estudios[0], 62, $this->GetY(), $w_foto_comprobante_estudios, $h_foto_comprobante_estudios, $r_foto_comprobante_estudios[1]);
			} else {
				$w_foto_comprobante_estudios = $w_foto_comprobante_estudios * 560 / $h_foto_comprobante_estudios;
				$h_foto_comprobante_estudios = 560;
				$this->Image($r_foto_comprobante_estudios[0], (612 - $w_foto_comprobante_estudios) / 2, $this->GetY(), $w_foto_comprobante_estudios, $h_foto_comprobante_estudios, $r_foto_comprobante_estudios[1]);
				
			}
		}
		

	}

	public function setFotoRegistroPatronal($r_foto_registro_patronal, $i){
		if ($r_foto_registro_patronal) {
			$foto_registro_patronal = getimagesize($r_foto_registro_patronal[0]);
			if ($foto_registro_patronal[2] != 2)
					$r_foto_registro_patronal[1] = 'png';
				else
					$r_foto_registro_patronal[1] = 'jpg';
			$w_foto_registro_patronal = $foto_registro_patronal[0];
			$h_foto_registro_patronal = $foto_registro_patronal[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(230, $y);
			$this->Write(10, utf8_encode('REGISTRO PATRONAL '.$i));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_registro_patronal > $h_foto_registro_patronal) {
				$h_foto_registro_patronal = $h_foto_registro_patronal * 488 / $w_foto_registro_patronal;
				$w_foto_registro_patronal = 488;
				$this->Image($r_foto_registro_patronal[0], 62, $this->GetY(), $w_foto_registro_patronal, $h_foto_registro_patronal, $r_foto_registro_patronal[1]);
			} else {
				$w_foto_registro_patronal = $w_foto_registro_patronal * 560 / $h_foto_registro_patronal;
				$h_foto_registro_patronal = 560;
				$this->Image($r_foto_registro_patronal[0], (612 - $w_foto_registro_patronal) / 2, $this->GetY(), $w_foto_registro_patronal, $h_foto_registro_patronal, $r_foto_registro_patronal[1]);
				
			}
		}
		

	}

	public function setFotoRedesSociales($r_foto_redes_sociales, $comentario){
		if ($r_foto_redes_sociales) {
			$foto_redes_sociales = getimagesize($r_foto_redes_sociales[0]);
			if ($foto_redes_sociales[2] != 2)
				$r_foto_redes_sociales[1] = 'png';
			else
				$r_foto_redes_sociales[1] = 'jpg';
			$w_foto_redes_sociales = $foto_redes_sociales[0];
			$h_foto_redes_sociales = $foto_redes_sociales[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(250, $y);
			$this->Write(10, utf8_encode('REDES SOCIALES'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			$this->SetFont('Sinkinsans','B', 9);
			$this->SetTextColor(140, 140, 140);
			$this->MultiCell(562, 15, utf8_encode($comentario), 0, 'C');

			$y = $this->GetY() + 10;
			$this->SetXY(25, $y);

			if ($w_foto_redes_sociales > $h_foto_redes_sociales) {
				$h_foto_redes_sociales = $h_foto_redes_sociales * 488 / $w_foto_redes_sociales;
				$w_foto_redes_sociales = 488;
				$this->Image($r_foto_redes_sociales[0], 62, $this->GetY(), $w_foto_redes_sociales, $h_foto_redes_sociales, $r_foto_redes_sociales[1]);
			} else {
				$w_foto_redes_sociales = $w_foto_redes_sociales * 560 / $h_foto_redes_sociales;
				$h_foto_redes_sociales = 560;
				$this->Image($r_foto_redes_sociales[0], (612 - $w_foto_redes_sociales) / 2, $this->GetY(), $w_foto_redes_sociales, $h_foto_redes_sociales, $r_foto_redes_sociales[1]);
				
			}
		}
	}

	public function setFotoCartaLaboral($r_foto_carta_laboral, $i){
		if ($r_foto_carta_laboral) {
			$foto_carta_laboral = getimagesize($r_foto_carta_laboral[0]);
			if ($foto_carta_laboral[2] != 2)
				$r_foto_carta_laboral[1] = 'png';
			else
				$r_foto_carta_laboral[1] = 'jpg';
			$w_foto_carta_laboral = $foto_carta_laboral[0];
			$h_foto_carta_laboral = $foto_carta_laboral[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(250, $y);
			$this->Write(10, utf8_encode('CARTA LABORAL '.$i));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_carta_laboral > $h_foto_carta_laboral) {
				$h_foto_carta_laboral = $h_foto_carta_laboral * 488 / $w_foto_carta_laboral;
				$w_foto_carta_laboral = 488;
				$this->Image($r_foto_carta_laboral[0], 62, $this->GetY(), $w_foto_carta_laboral, $h_foto_carta_laboral, $r_foto_carta_laboral[1]);
			} else {
				$w_foto_carta_laboral = $w_foto_carta_laboral * 560 / $h_foto_carta_laboral;
				$h_foto_carta_laboral = 560;
				$this->Image($r_foto_carta_laboral[0], (612 - $w_foto_carta_laboral) / 2, $this->GetY(), $w_foto_carta_laboral, $h_foto_carta_laboral, $r_foto_carta_laboral[1]);
				
			}
		}
	}

	public function setFotoCartaLiberacionInfonavit($r_foto_infonavit){
		if ($r_foto_infonavit) {
			$foto_infonavit = getimagesize($r_foto_infonavit[0]);
			if ($foto_infonavit[2] != 2)
				$r_foto_infonavit[1] = 'png';
			else
				$r_foto_infonavit[1] = 'jpg';
			$w_foto_infonavit = $foto_infonavit[0];
			$h_foto_infonavit = $foto_infonavit[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(180, $y);
			$this->Write(10, utf8_encode('CARTA DE LIBERACIÓN INFONAVIT'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_infonavit > $h_foto_infonavit) {
				$h_foto_infonavit = $h_foto_infonavit * 488 / $w_foto_infonavit;
				$w_foto_infonavit = 488;
				$this->Image($r_foto_infonavit[0], 62, $this->GetY(), $w_foto_infonavit, $h_foto_infonavit, $r_foto_infonavit[1]);
			} else {
				$w_foto_infonavit = $w_foto_infonavit * 560 / $h_foto_infonavit;
				$h_foto_infonavit = 560;
				$this->Image($r_foto_infonavit[0], (612 - $w_foto_infonavit) / 2, $this->GetY(), $w_foto_infonavit, $h_foto_infonavit, $r_foto_infonavit[1]);
				
			}
		}
	}

	public function setFotoCartaInfonavitSi($r_foto_infonavit){
		if ($r_foto_infonavit) {
			$foto_infonavit = getimagesize($r_foto_infonavit[0]);
			if ($foto_infonavit[2] != 2)
				$r_foto_infonavit[1] = 'png';
			else
				$r_foto_infonavit[1] = 'jpg';
			$w_foto_infonavit = $foto_infonavit[0];
			$h_foto_infonavit = $foto_infonavit[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(180, $y);
			$this->Write(10, utf8_encode('COMPROBANTE DE INFONAVIT (Sí)'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_infonavit > $h_foto_infonavit) {
				$h_foto_infonavit = $h_foto_infonavit * 488 / $w_foto_infonavit;
				$w_foto_infonavit = 488;
				$this->Image($r_foto_infonavit[0], 62, $this->GetY(), $w_foto_infonavit, $h_foto_infonavit, $r_foto_infonavit[1]);
			} else {
				$w_foto_infonavit = $w_foto_infonavit * 560 / $h_foto_infonavit;
				$h_foto_infonavit = 560;
				$this->Image($r_foto_infonavit[0], (612 - $w_foto_infonavit) / 2, $this->GetY(), $w_foto_infonavit, $h_foto_infonavit, $r_foto_infonavit[1]);
				
			}
		}
	}

	public function setFotoCartaInfonavitNo($r_foto_infonavit){
		if ($r_foto_infonavit) {
			$foto_infonavit = getimagesize($r_foto_infonavit[0]);
			if ($foto_infonavit[2] != 2)
				$r_foto_infonavit[1] = 'png';
			else
				$r_foto_infonavit[1] = 'jpg';
			$w_foto_infonavit = $foto_infonavit[0];
			$h_foto_infonavit = $foto_infonavit[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(180, $y);
			$this->Write(10, utf8_encode('COMPROBANTE DE INFONAVIT (No)'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_infonavit > $h_foto_infonavit) {
				$h_foto_infonavit = $h_foto_infonavit * 488 / $w_foto_infonavit;
				$w_foto_infonavit = 488;
				$this->Image($r_foto_infonavit[0], 62, $this->GetY(), $w_foto_infonavit, $h_foto_infonavit, $r_foto_infonavit[1]);
			} else {
				$w_foto_infonavit = $w_foto_infonavit * 560 / $h_foto_infonavit;
				$h_foto_infonavit = 560;
				$this->Image($r_foto_infonavit[0], (612 - $w_foto_infonavit) / 2, $this->GetY(), $w_foto_infonavit, $h_foto_infonavit, $r_foto_infonavit[1]);
				
			}
		}
	}
	
	public function setFotoContratoArrendamiento($r_foto_contrato_arrendamiento){
		if ($r_foto_contrato_arrendamiento) {
			$foto_contrato_arrendamiento = getimagesize($r_foto_contrato_arrendamiento[0]);
			if ($foto_contrato_arrendamiento[2] != 2)
				$r_foto_contrato_arrendamiento[1] = 'png';
			else
				$r_foto_contrato_arrendamiento[1] = 'jpg';
			$w_foto_contrato_arrendamiento = $foto_contrato_arrendamiento[0];
			$h_foto_contrato_arrendamiento = $foto_contrato_arrendamiento[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(180, $y);
			$this->Write(10, utf8_encode('CONTRATO DE ARRENDAMIENTO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_contrato_arrendamiento > $h_foto_contrato_arrendamiento) {
				$h_foto_contrato_arrendamiento = $h_foto_contrato_arrendamiento * 488 / $w_foto_contrato_arrendamiento;
				$w_foto_contrato_arrendamiento = 488;
				$this->Image($r_foto_contrato_arrendamiento[0], 62, $this->GetY(), $w_foto_contrato_arrendamiento, $h_foto_contrato_arrendamiento, $r_foto_contrato_arrendamiento[1]);
			} else {
				$w_foto_contrato_arrendamiento = $w_foto_contrato_arrendamiento * 560 / $h_foto_contrato_arrendamiento;
				$h_foto_contrato_arrendamiento = 560;
				$this->Image($r_foto_contrato_arrendamiento[0], (612 - $w_foto_contrato_arrendamiento) / 2, $this->GetY(), $w_foto_contrato_arrendamiento, $h_foto_contrato_arrendamiento, $r_foto_contrato_arrendamiento[1]);
				
			}
		}
	}

	public function setFotoAvisoPrivacidad($r_foto_aviso_privacidad){
		if ($r_foto_aviso_privacidad) {
			$foto_aviso_privacidad = getimagesize($r_foto_aviso_privacidad[0]);
			if ($foto_aviso_privacidad[2] != 2)
				$r_foto_aviso_privacidad[1] = 'png';
			else
				$r_foto_aviso_privacidad[1] = 'jpg';
			$w_foto_aviso_privacidad = $foto_aviso_privacidad[0];
			$h_foto_aviso_privacidad = $foto_aviso_privacidad[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(160, $y);
			$this->Write(10, utf8_encode('AVISO DE PRIVACIDAD'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_aviso_privacidad > $h_foto_aviso_privacidad) {
				$h_foto_aviso_privacidad = $h_foto_aviso_privacidad * 488 / $w_foto_aviso_privacidad;
				$w_foto_aviso_privacidad = 488;
				$this->Image($r_foto_aviso_privacidad[0], 62, $this->GetY(), $w_foto_aviso_privacidad, $h_foto_aviso_privacidad, $r_foto_aviso_privacidad[1]);
			} else {
				$w_foto_aviso_privacidad = $w_foto_aviso_privacidad * 560 / $h_foto_aviso_privacidad;
				$h_foto_aviso_privacidad = 560;
				$this->Image($r_foto_aviso_privacidad[0], (612 - $w_foto_aviso_privacidad) / 2, $this->GetY(), $w_foto_aviso_privacidad, $h_foto_aviso_privacidad, $r_foto_aviso_privacidad[1]);
				
			}
		}
		

	}

	public function setFotoCartaVD($r_foto_carta_vd){
		if ($r_foto_carta_vd) {
			$foto_carta_vd = getimagesize($r_foto_carta_vd[0]);
			if ($foto_carta_vd[2] != 2)
				$r_foto_carta_vd[1] = 'png';
			else
				$r_foto_carta_vd[1] = 'jpg';
			$w_foto_carta_vd = $foto_carta_vd[0];
			$h_foto_carta_vd = $foto_carta_vd[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(160, $y);
			$this->Write(10, utf8_encode('CARTA DE VISITA DOMICILIARIA'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_carta_vd > $h_foto_carta_vd) {
				$h_foto_carta_vd = $h_foto_carta_vd * 488 / $w_foto_carta_vd;
				$w_foto_carta_vd = 488;
				$this->Image($r_foto_carta_vd[0], 62, $this->GetY(), $w_foto_carta_vd, $h_foto_carta_vd, $r_foto_carta_vd[1]);
			} else {
				$w_foto_carta_vd = $w_foto_carta_vd * 560 / $h_foto_carta_vd;
				$h_foto_carta_vd = 560;
				$this->Image($r_foto_carta_vd[0], (612 - $w_foto_carta_vd) / 2, $this->GetY(), $w_foto_carta_vd, $h_foto_carta_vd, $r_foto_carta_vd[1]);
				
			}
		}
		

	}

	public function setFotoBuroCredito($r_foto_buro_credito){
		if ($r_foto_buro_credito) {
			$foto_buro_credito = getimagesize($r_foto_buro_credito[0]);
			if ($foto_buro_credito[2] != 2)
				$r_foto_buro_credito[1] = 'png';
			else
				$r_foto_buro_credito[1] = 'jpg';
			$w_foto_buro_credito = $foto_buro_credito[0];
			$h_foto_buro_credito = $foto_buro_credito[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(200, $y);
			$this->Write(10, utf8_encode('BURÓ DE CRÉDITO'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_buro_credito > $h_foto_buro_credito) {
				$h_foto_buro_credito = $h_foto_buro_credito * 488 / $w_foto_buro_credito;
				$w_foto_buro_credito = 488;
				$this->Image($r_foto_buro_credito[0], 62, $this->GetY(), $w_foto_buro_credito, $h_foto_buro_credito, $r_foto_buro_credito[1]);
			} else {
				$w_foto_buro_credito = $w_foto_buro_credito * 560 / $h_foto_buro_credito;
				$h_foto_buro_credito = 560;
				$this->Image($r_foto_buro_credito[0], (612 - $w_foto_buro_credito) / 2, $this->GetY(), $w_foto_buro_credito, $h_foto_buro_credito, $r_foto_buro_credito[1]);
				
			}
		}
		

	}
	
	public function setFotoExteriorDomicilioGestor($r_foto_foto_exterior_gestor){
		if ($r_foto_foto_exterior_gestor) {
			$foto_foto_exterior_gestor = getimagesize($r_foto_foto_exterior_gestor[0]);
			if ($foto_foto_exterior_gestor[2] != 2)
				$r_foto_foto_exterior_gestor[1] = 'png';
			else
				$r_foto_foto_exterior_gestor[1] = 'jpg';
			$w_foto_foto_exterior_gestor = $foto_foto_exterior_gestor[0];
			$h_foto_foto_exterior_gestor = $foto_foto_exterior_gestor[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(105, $y);
			$this->Write(10, utf8_encode('FOTO DEL EXTERIOR DEL DOMICILIO (VISITA PRESENCIAL)'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_foto_exterior_gestor > $h_foto_foto_exterior_gestor) {
				$h_foto_foto_exterior_gestor = $h_foto_foto_exterior_gestor * 488 / $w_foto_foto_exterior_gestor;
				$w_foto_foto_exterior_gestor = 488;
				$this->Image($r_foto_foto_exterior_gestor[0], 62, $this->GetY(), $w_foto_foto_exterior_gestor, $h_foto_foto_exterior_gestor, $r_foto_foto_exterior_gestor[1]);
			} else {
				$w_foto_foto_exterior_gestor = $w_foto_foto_exterior_gestor * 560 / $h_foto_foto_exterior_gestor;
				$h_foto_foto_exterior_gestor = 560;
				$this->Image($r_foto_foto_exterior_gestor[0], (612 - $w_foto_foto_exterior_gestor) / 2, $this->GetY(), $w_foto_foto_exterior_gestor, $h_foto_foto_exterior_gestor, $r_foto_foto_exterior_gestor[1]);
				
			}
		}
		

	}

	public function setFotoCredencialGestor($r_foto_credencial_frente, $r_foto_credencial_atras){
		if ($r_foto_credencial_frente) {
			$foto_credencial_frente = getimagesize($r_foto_credencial_frente[0]);
			if ($foto_credencial_frente[2] != 2)
				$r_foto_credencial_frente[1] = 'png';
			else
				$r_foto_credencial_frente[1] = 'jpg';
			$w_foto_credencial_frente = $foto_credencial_frente[0];
			$h_foto_credencial_frente = $foto_credencial_frente[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(180, $y);
			$this->Write(10, utf8_encode('FOTOS DEL INE (VISITA PRESENCIAL)'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_credencial_frente > $h_foto_credencial_frente) {
				$h_foto_credencial_frente = $h_foto_credencial_frente * 400 / $w_foto_credencial_frente;
				$w_foto_credencial_frente = 400;
				$this->Image($r_foto_credencial_frente[0], 106, $this->GetY(), $w_foto_credencial_frente, $h_foto_credencial_frente, $r_foto_credencial_frente[1]);
			} else {
				$w_foto_credencial_frente = $w_foto_credencial_frente * 300 / $h_foto_credencial_frente;
				$h_foto_credencial_frente = 300;
				$this->Image($r_foto_credencial_frente[0], (612 - $w_foto_credencial_frente) / 2, $this->GetY(), $w_foto_credencial_frente, $h_foto_credencial_frente, $r_foto_credencial_frente[1]);
				
			}

			$y = $this->GetY() + $h_foto_credencial_frente + 15;
			$this->SetY($y);
		}
		
		
		if ($r_foto_credencial_atras) {
			$foto_credencial_atras = getimagesize($r_foto_credencial_atras[0]);
			if ($foto_credencial_atras[2] != 2)
				$r_foto_credencial_atras[1] = 'png';
			else
				$r_foto_credencial_atras[1] = 'jpg';
			$w_foto_credencial_atras = $foto_credencial_atras[0];
			$h_foto_credencial_atras = $foto_credencial_atras[1];

			if ($w_foto_credencial_atras > $h_foto_credencial_atras) {
				$h_foto_credencial_atras = $h_foto_credencial_atras * 400 / $w_foto_credencial_atras;
				$w_foto_credencial_atras = 400;
				$this->Image($r_foto_credencial_atras[0], 106, $this->GetY(), $w_foto_credencial_atras, $h_foto_credencial_atras, $r_foto_credencial_atras[1]);
			} else {
				$w_foto_credencial_atras = $w_foto_credencial_atras * 300 / $h_foto_credencial_atras;
				$h_foto_credencial_atras = 300;
				$this->Image($r_foto_credencial_atras[0], (612 - $w_foto_credencial_atras) / 2, $this->GetY(), $w_foto_credencial_atras, $h_foto_credencial_atras, $r_foto_credencial_atras[1]);
				
			}
		}
	}

	public function setFotoCandidatoGestor($r_foto_candidato_gestor){
		if ($r_foto_candidato_gestor) {
			$foto_candidato_gestor = getimagesize($r_foto_candidato_gestor[0]);
			if ($foto_candidato_gestor[2] != 2)
				$r_foto_candidato_gestor[1] = 'png';
			else
				$r_foto_candidato_gestor[1] = 'jpg';
			$w_foto_candidato_gestor = $foto_candidato_gestor[0];
			$h_foto_candidato_gestor = $foto_candidato_gestor[1];

			/* if ($this->GetY() >= 400) { */
				$this->AddPage();
				$y = 72;
			/* }else{
				$y = $this->GetY() + 30;
			} */

			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(220, $y);
			$this->Write(10, utf8_encode('FOTO CON EL GESTOR'));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			$max_width = 488;
			$max_heigth = 280;
			$x = 62;

			if ($w_foto_candidato_gestor > $h_foto_candidato_gestor) {
				$h_foto_candidato_gestor = $h_foto_candidato_gestor * $max_width / $w_foto_candidato_gestor;
				$w_foto_candidato_gestor = $max_width;
				if ($h_foto_candidato_gestor > $max_heigth) {
					$w_foto_candidato_gestor = $w_foto_candidato_gestor * $max_heigth / $h_foto_candidato_gestor;
					$h_foto_candidato_gestor = $max_heigth;
					$x = (612 - $w_foto_candidato_gestor) / 2;
				}
				$this->Image($r_foto_candidato_gestor[0], $x, $this->GetY(), $w_foto_candidato_gestor, $h_foto_candidato_gestor, $r_foto_candidato_gestor[1]);
			} else {
				$w_foto_candidato_gestor = $w_foto_candidato_gestor * $max_heigth / $h_foto_candidato_gestor;
				$h_foto_candidato_gestor = $max_heigth;
				$x = (612 - $w_foto_candidato_gestor) / 2;
				$this->Image($r_foto_candidato_gestor[0], $x, $this->GetY(), $w_foto_candidato_gestor, $h_foto_candidato_gestor, $r_foto_candidato_gestor[1]);
				
			}

			$y = $this->GetY() + $h_foto_candidato_gestor;
			$this->SetY($y);
		}
	}

	public function setFotoAnexo($r_foto_anexo, $i, $nombre='ANEXO'){
		if ($r_foto_anexo) {
			$foto_anexo = getimagesize($r_foto_anexo[0]);
			if ($foto_anexo[2] != 2)
				$r_foto_anexo[1] = 'png';
			else
				$r_foto_anexo[1] = 'jpg';
			$w_foto_anexo = $foto_anexo[0];
			$h_foto_anexo = $foto_anexo[1];

			if ($this->headerDocumento) {
				$this->seccionHeader = 5;
				$this->AddPage();
				$this->seccionHeader = false;
				$this->headerDocumento = false;
			}else{
				$this->AddPage();
			}

			$y = 72;
			
			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans','B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(270, $y);
			
			
			$this->Write(10, utf8_encode($nombre=='ANEXO'?$nombre.$i:$nombre));

			$y = $this->GetY() + 30;
			$this->SetXY(25, $y);

			if ($w_foto_anexo > $h_foto_anexo) {
				$h_foto_anexo = $h_foto_anexo * 488 / $w_foto_anexo;
				$w_foto_anexo = 488;
				$this->Image($r_foto_anexo[0], 62, $this->GetY(), $w_foto_anexo, $h_foto_anexo, $r_foto_anexo[1]);
			} else {
				$w_foto_anexo = $w_foto_anexo * 560 / $h_foto_anexo;
				$h_foto_anexo = 560;
				$this->Image($r_foto_anexo[0], (612 - $w_foto_anexo) / 2, $this->GetY(), $w_foto_anexo, $h_foto_anexo, $r_foto_anexo[1]);
				
			}
		}
	}
	
	function header(){
		 if ($this->tieneHeader) {
			if ($this->seccionHeader == 1) {
				$y = 30;
				$this->SetFillColor(51, 54, 79);
				$this->Rect(10, $y, 444, 20, 'F');
				$this->SetFont('Sinkinsans','B', 11);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(30, $y);
				$this->Write(10, utf8_encode($this->id_cliente == 662 ? 'INFORMACIÓN ACERCA DEL SOLICITANTE' : 'INFORMACIÓN ACERCA DEL CANDIDATO')); //Formato RADEC

			}elseif ($this->seccionHeader == 2){
				$y = 30;
				$this->SetFillColor(157, 199, 58);
				$this->Rect(10, $y, 444, 20, 'F');
				$this->SetFont('Sinkinsans','B', 10);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(20, $y);
				$this->Write(10, utf8_encode('INFORMACIÓN ACERCA DEL ENTORNO Y FAMILIA'));
			}elseif ($this->seccionHeader == 3){
				$y = 30;
				$this->SetFillColor(244, 134, 30);
				$this->Rect(10, $y, 444, 20, 'F');
				$this->SetFont('Sinkinsans','B', 10);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(20, $y);
				$this->Write(10, utf8_encode('INFORMACIÓN ACERCA DE LA ECONOMÍA Y PATRIMONIO FAMILIAR'));
			}elseif ($this->seccionHeader == 5){
				$y = 30;
				$this->SetFillColor(215, 67, 150);
				$this->Rect(10, $y, 444, 20, 'F');
				$this->SetFont('Sinkinsans','B', 10);
				$this->SetTextColor(255, 255, 255);
				$y += 6;
				$this->setXY(20, $y);
				$this->Write(10, utf8_encode('EVIDENCIAS DOCUMENTALES'));
			}else{
				$this->SetFont('Sinkinsans','', 13);
				$this->SetTextColor(140, 140, 140);
				$y = 33;
				$this->setXY(27, $y);
				$this->Write(10, $this->nombre);
				$this->sety(100);
			}
			$this->Image('dist/img/imagotipo-colores-3.png', 465, 28, 123, 0);
			$this->SetFillColor(239, 246, 248);
			$this->Rect(10, 72, 592, 680, 'F');
		}
	}

	function Footer(){
		if ($this->tieneFooter) {
			$this->Line(25, 772, 545, 772);
			$this->SetFont('Sinkinsans','', 4);
			$this->SetTextColor(130, 130, 130);
			$this->SetXY(555, 770);
			$this->Cell(0, 5 ,('Página '.$this->PageNo().' de {nb}'), 0, 0,'L');
		}else{
			$this->SetFillColor(240, 240, 240);
			$this->Rect(0, 700, 612, 92, 'F');
			
			if ($this->qr){
				$this->Image($this->qr, 410, 620, 140, 0, '', $this->Enlace_Drive);
				unlink($this->qr);
			}
		}
	}
}
