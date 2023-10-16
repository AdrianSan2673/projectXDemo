<?php

class InvestigacionLaboraling extends ESEINGE
{

	public function setPortadaInvestigacion($candidato, $viabilidad)
	{
		$this->Image('dist/img/isotipo-gris.jpg', 395, -130, 350, 0);
		$this->Image('dist/img/imagotipo-colores-3.png', 28, 203, 235, 0);

		$this->setTextColor(51, 54, 79);

		$x = 32;
		$y = 308;

		$this->setFont('SinkinSansBold', 'B', 45);
		$this->setXY($x, $y);

		//$this->MultiCell(370, 44, 'REPORTE DE ESTUDIO', 0,'L');
		$this->Write(48, 'REPORT OF ');

		$y = $this->GetY() + 53;
		$this->SetXY($x, $y);
		$this->Write(48, utf8_encode('INVESTIGATION'));

		$this->setTextColor(158, 198, 58);
		$y = $this->GetY() + 53;
		$this->SetXY($x, $y);
		$this->Write(48, 'LABORAL');

		$this->setFont('SinkinSans', 'B', 12);
		$this->setTextColor(51, 54, 79);
		$y = $this->GetY() + 70;
		$this->SetXY($x, $y);
		$this->Write(15, 'PARA:');

		$x1 = $this->GetX() + 20;
		$this->SetX($x1);
		$this->MultiCell(200, 20, utf8_encode($candidato->Razon == 'GRUPO JANFREX S.A. DE C.V.' ? 'GRUPO JANFREX' : ($candidato->Razon == 'INNOVACIÓN HORUS S.A DE C.V' ? 'INNOVACIÓN HORUS' : ($candidato->Empresa == 'La Casa de Cementín' ? $candidato->Nombre_Cliente : ($candidato->ID_Empresa == 315 ? $candidato->Nombre_Cliente : $candidato->Empresa)))), 1, 'L');

		$x1 = 306;
		$this->SetXY($x1, $y);
		$this->Write(15, 'DE:');

		$x1 = $this->GetX() + 20;
		$this->SetX($x1);
		$this->MultiCell(200, 20, $this->nombre, 1, 'L');

		//if ($candidato->Empresa != 'APYMSA') {
		$this->setFont('SinkinSans', 'B', 11);
		$y = $this->GetY() + 50;
		$x1 = $x + 25;
		$this->SetXY($x1, $y);
		$this->Circle($x1 - 15, $y + 4, 8, 'D');
		if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
			$this->Write(15, 'Cubre perfil');
		} else {
			$this->Write(15, 'Viable');
		}

		if ($viabilidad == '0') {
			$this->SetFillColor(43, 179, 73);
			$this->Circle($x1 - 15, $y + 4, 6, 'F');
		}

		$x1 = $this->GetX() + 100;
		$this->SetXY($x1, $y);
		$this->Circle($x1 - 15, $y + 4, 8, 'D');
		if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
			$this->Write(15, 'No cubre perfil');
		} else {
			$this->Write(15, 'No viable');
		}

		if ($viabilidad == 1) {
			$this->SetFillColor(255, 16, 16);
			$this->Circle($x1 - 15, $y + 4, 6, 'F');
		}

		$x1 = $this->GetX() + 100;
		$this->SetXY($x1, $y);
		$this->Circle($x1 - 15, $y + 4, 8, 'D');
		if ($candidato->Empresa == 'COMERCIALIZADORA FARMACÉUTICA') {
			$this->Write(15, 'A reserva del perfil');
		} else {
			$this->Write(15, 'Viable with reservations');
		}


		if ($viabilidad == 2) {
			$this->SetFillColor(243, 238, 82);
			$this->Circle($x1 - 15, $y + 4, 6, 'F');
		}

		if ($candidato->Empresa == 'RADEC') {
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

		if (!empty($candidato->Analista) && ($candidato->Analista) <> ' ') {
			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(32, 685);
			$this->MultiCell(250, 10, utf8_encode('Analyst: '), 0, 'L', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setXY(117, 685);
			$this->MultiCell(250, 10, utf8_encode($candidato->Analista), 0, 'L', true);
		}
	}

	public function setDatosGeneralesInvComp($candidato, $foto)
	{
		$this->seccionHeader = 1;
		$this->AddPage();
		$this->seccionHeader = false;
		$this->tieneFooter = true;
		$y = 72;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans', 'B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'GENERAL DATA');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(160, 160, 160);
		$x = 25;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(46, 15, 'Name', 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);

		if ($candidato->Cliente == 139) { //Grupo FH
			$this->MultiCell(410, 18, strtoupper(Utils::eliminarAcentos($candidato->Apellido_Paterno . ' ' . $candidato->Apellido_Materno . ' ' . $candidato->Nombres)), 0, 'C', true);
		} else {
			$this->MultiCell(410, 18, utf8_encode($candidato->Nombres . ' ' . $candidato->Apellido_Paterno . ' ' . $candidato->Apellido_Materno), 0, 'C', true);
		}


		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(160, 160, 160);
		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(46, 15, 'Empresa', 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);
		$this->MultiCell(410, 18, utf8_encode($candidato->Razon == 'GRUPO JANFREX S.A. DE C.V.' ? 'GRUPO JANFREX' : ($candidato->Razon == 'INNOVACIÓN HORUS S.A DE C.V' ? 'INNOVACIÓN HORUS' : ($candidato->Empresa == 'La Casa de Cementín' ? $candidato->Nombre_Cliente : ($candidato->ID_Empresa == 315 ? $candidato->Nombre_Cliente : $candidato->Empresa)))), 0, 'C', true);


		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(160, 160, 160);
		$y = $this->GetY() + 5;
		$this->SetXY($x, $y);
		$this->MultiCell(52, 8, utf8_encode('Position'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);
		$this->MultiCell(410, 18, utf8_encode($candidato->Puesto ? $candidato->Puesto : ''), 0, 'C', true);

		$this->ClippingCircle(537, 147, 45);
		if (!$foto) {
			if ($candidato->Sexo == 99) {
				$foto = array('dist/img/user-icon-rose.png', 'png');
			} else {
				$foto = array('dist/img/user-icon.png', 'png');
			}
		}
		$pic = getimagesize($foto[0]);
		if ($pic[2] != 2)
			$foto[1] = 'png';
		else
			$foto[1] = 'jpg';
		$this->Image($foto[0], 492, 102, 90, 0, $foto[1]);
		$this->UnsetClipping();
	}

	public function setDatosPersonalesInvComp($candidato)
	{
		$y = $this->GetY() + 25;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans', 'B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'PERSONAL INFORMATION');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$x1 = 315;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Birthdate'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(123, $y);
		$this->MultiCell(182, 18, $candidato->Nacimiento ? substr(date('r', strtotime($candidato->Nacimiento)), 0, 16)  : '', 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('Age'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 60, $y);
		$this->MultiCell(55, 18, utf8_encode($candidato->Edad . ' years'), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1 + 126, $y);
		$this->MultiCell(50, 18, utf8_encode('Sex'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 165, $y);
		$this->MultiCell(115, 18, Utils::getSexo($candidato->Sexo) == 'Hombre' ? 'Male' : 'Female', 0, 'C', true);

		$y = $this->GetY() + 5;

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Birth place'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(123, $y);
		$this->MultiCell(182, 18, utf8_encode($candidato->Lugar_Nacimiento), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('Civil status'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 60, $y);
		$this->MultiCell(220, 18, utf8_encode(Utils::getEstadoCivilIng($candidato->Estado_Civil)), 0, 'C', true);

		$y = $this->GetY() + 5;

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(50, 18, utf8_encode('NSS'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(75, $y);
		$this->MultiCell(138, 18, utf8_encode($candidato->IMSS), 0, 'R', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY(217, $y);
		$this->MultiCell(48, 18, utf8_encode('CURP'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(267, $y);
		$this->MultiCell(138, 18, utf8_encode($candidato->CURP), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY(409, $y);
		$this->MultiCell(48, 18, utf8_encode('RFC'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(457, $y);
		$this->MultiCell(138, 18, utf8_encode($candidato->RFC), 0, 'C', true);
	}

	public function setDatosPersonalesInvOrd($candidato)
	{
		$y = $this->GetY() + 25;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans', 'B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'PERSONAL DATA');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$x1 = 270;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Date of birth'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(123, $y);
		$this->MultiCell(142, 18, utf8_encode($candidato->Nacimiento), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1, $y);
		$this->MultiCell(96, 18, utf8_encode('Place of birth'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 90, $y);
		$this->MultiCell(235, 18, utf8_encode($candidato->Lugar_Nacimiento), 0, 'C', true);

		$y = $this->GetY() + 5;
		$x1 = 315;
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('CURP'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(123, $y);
		$this->MultiCell(182, 18, utf8_encode($candidato->CURP), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x1, $y);
		$this->MultiCell(56, 18, utf8_encode('NSS'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY($x1 + 60, $y);
		$this->MultiCell(220, 18, utf8_encode($candidato->IMSS), 0, 'C', true);
	}

	public function setDatosContactoInv($candidato, $domicilio)
	{
		$y = $this->GetY() + 18;

		$this->SetFillColor(78, 82, 105);
		$this->Rect(10, $y, 592, 20, 'F');
		$this->SetFont('Sinkinsans', 'B', 11);
		$this->SetTextColor(255, 255, 255);
		$y += 6;
		$this->setXY(237, $y);
		$this->Write(10, 'CONTACT INFORMATION');

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$x = 25;
		$x1 = 290;
		$y = $this->GetY() + 35;
		$this->SetFillColor(255, 255, 255);
		$this->SetXY($x, $y);
		$this->MultiCell(50, 15, 'Address', 0, 'L', false);

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
			$this->MultiCell(60, 18, utf8_encode('Cell phone'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY($x1 + 45, $y);
			$this->MultiCell(90, 18, utf8_encode($candidato->Celular), 0, 'C', true);

			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x1 + 150, $y);
			$this->MultiCell(50, 18, utf8_encode('Phone'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY($x1 + 190, $y);
			$this->MultiCell(110, 18, utf8_encode($candidato->Telefono_fijo), 0, 'C', true);
		} else {
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY(315, $y);
			$this->MultiCell(60, 18, utf8_encode('Cell phone'), 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(360, $y);
			$this->MultiCell(230, 18, utf8_encode($candidato->Celular), 0, 'C', true);
		}

		$y = $this->GetY() + 5;
		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY($x, $y);
		$this->MultiCell(123, 18, utf8_encode('Other contact'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(123, $y);
		$this->MultiCell(182, 18, utf8_encode($candidato->Otro_Contacto), 0, 'C', true);

		$this->setFont('SinkinSans', 'B', 6.5);
		$this->setTextColor(140, 140, 140);
		$this->SetXY(315, $y);
		$this->MultiCell(56, 18, utf8_encode('Email'), 0, 'L', false);

		$this->setFont('SinkinSans', '', 6.5);
		$this->setTextColor(0, 0, 0);
		$this->setXY(315 + 60, $y);
		$this->MultiCell(220, 18, utf8_encode($candidato->Correos), 0, 'C', true);

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
		if (!empty($candidato->Facebook)) {
			$y = $this->GetY() + 5;
			$this->setFont('SinkinSans', 'B', 6.5);
			$this->setTextColor(140, 140, 140);
			$this->SetXY($x, $y);
			$this->MultiCell(50, 15, 'Facebook', 0, 'L', false);

			$this->setFont('SinkinSans', '', 6.5);
			$this->setTextColor(0, 0, 0);
			$this->setXY(75, $y);
			$this->MultiCell(515, 18, utf8_encode($candidato->Facebook), 0, 'L', true);
		}
	}

	public function setFotoAnexo($r_foto_anexo, $i, $nombre = 'attachment')
	{
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
			} else {
				$this->AddPage();
			}

			$y = 72;

			$this->SetFillColor(226, 110, 176);
			$this->Rect(10, $y, 592, 20, 'F');
			$this->SetFont('Sinkinsans', 'B', 11);
			$this->SetTextColor(255, 255, 255);
			$y += 6;
			$this->setXY(270, $y);


			$this->Write(10, utf8_encode($nombre == 'attachment' ? $nombre . $i : $nombre));

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
}
