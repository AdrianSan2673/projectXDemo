<?php

class Kardex extends FPDF{
    public $candidato;
    public $vl;

    function header(){
        $this->SetLineWidth(2);
        $this->SetDrawColor(190, 71, 149);
        $this->Line(20, 16, 20, 206);
        $this->Line(575, 16, 575, 206);
        $this->SetDrawColor(221, 136, 46);
        $this->Line(20, 224, 20, 414);
        $this->Line(575, 224, 575, 414);
        $this->SetDrawColor(70, 125, 185);
        $this->Line(20, 432, 20, 622);
        $this->Line(575, 432, 575, 622);
        $this->SetDrawColor(172, 202, 74);
        $this->Line(20, 640, 20, 830);
        $this->Line(575, 640, 575, 830);
    }

    public function setDatosGenerales($employee, $foto, $department, $position){
		$this->ClippingCircle(113, 125, 78);
		if (!$foto) {
			if ($employee->id_gender == 2) {
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

		$this->Image($foto[0], 35, 47, 156, 0, $foto[1]);
		$this->UnsetClipping();

        $y = 45;
		$this->SetFillColor(70, 125, 185);
		$this->RoundedRect(200, $y, 337, 28, 12, '1234', 'F');
		$this->SetFont('OpenSansExtraBold','B', 14);
        $this->SetTextColor(255, 255, 255);
        $this->setXY(288, 53);
		$this->Write(10, 'DATOS DEL EMPLEADO');

        $this->SetTextColor(0, 0, 0);
        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(215, 98);
		$this->MultiCell(50, 10, 'Nombre', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(215, 110);
		$this->MultiCell(130, 10, utf8_encode($employee->first_name.' '. $employee->surname.' '.$employee->last_name), 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(345, 98);
		$this->MultiCell(100, 10, 'No. Colaborador', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(345, 110);
		$this->MultiCell(130, 10, ($employee->employee_number ? $employee->employee_number : 'Sin asignar'), 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(460, 98);
		$this->MultiCell(100, 10, 'Empresa', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(460, 110);
		$this->MultiCell(130, 10, 'RRHH Ingenia', 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(215, 135);
		$this->MultiCell(100, 10, 'Departamento', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(215, 145);
		$this->MultiCell(130, 10, utf8_encode($department->department), 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(345, 135);
		$this->MultiCell(100, 10, 'Puesto', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(345, 145);
		$this->MultiCell(130, 10, utf8_encode($position->title), 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(460, 135);
		$this->MultiCell(100, 10, 'Jefe Inmediato', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(460, 145);
		$this->MultiCell(130, 10, utf8_encode(isset($employee->id_boss) ? $employee->nameBoss : 'Sin definir'), 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(215, 165);
		$this->MultiCell(100, 10, 'Fecha de Ingreso', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(215, 175);
		$this->MultiCell(130, 10, $employee->start_date ? Utils::getDate($employee->start_date) : 'Desconocida', 0, 'L', false);
	}

    public function setDatosPersonales($employee){
		
        $y = $this->GetY() + 40;
		$this->SetFillColor(70, 125, 185);
		$this->RoundedRect(132, $y, 337, 28, 12, '1234', 'F');
		$this->SetFont('OpenSansExtraBold','B', 14);
        $this->SetTextColor(255, 255, 255);
        $this->setXY(240, $y + 10);
		$this->Write(10, 'DATOS PERSONALES');

        $y = $this->GetY() + 40;

        $this->SetTextColor(0, 0, 0);
        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(60, $y);
		$this->MultiCell(150, 10, 'Fecha de Nacimiento', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(60, $y + 12);
		$this->MultiCell(150, 10, Utils::getDate($employee->date_birth), 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(227, $y);
		$this->MultiCell(150, 10, 'Sexo', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(227, $y + 12);
		$this->MultiCell(150, 10, $employee->id_gender == 1 ? 'Hombre' : 'Mujer' , 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(394, $y);
		$this->MultiCell(150, 10, 'Estado Civil', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(394, $y + 12);
		$this->MultiCell(150, 10, isset($employee->civil_status) ? $employee->civil_status : 'Sin definir', 0, 'L', false);

        $y+=30;


        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(60, $y);
		$this->MultiCell(150, 10, 'CURP', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(60, $y + 12);
		$this->MultiCell(150, 10, $employee->curp, 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(227, $y);
		$this->MultiCell(150, 10, utf8_encode   ('Número de Seguro Social'), 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(227, $y + 12);
		$this->MultiCell(150, 10, $employee->nss, 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(394, $y);
		$this->MultiCell(150, 10, 'RFC', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(394, $y + 12);
		$this->MultiCell(150, 10, $employee->rfc, 0, 'L', false);

        $y+=30;
	}

    public function setDatosContacto($employee_contacts){
		
        $y = $this->GetY() + 40;
		$this->SetFillColor(70, 125, 185);
		$this->RoundedRect(132, $y, 337, 28, 12, '1234', 'F');
		$this->SetFont('OpenSansExtraBold','B', 14);
        $this->SetTextColor(255, 255, 255);
        $this->setXY(220, $y + 10);
		$this->Write(10, 'DATOS DE CONTACTO');

        $y = $this->GetY() + 40;

        $this->SetTextColor(0, 0, 0);
        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(60, $y);
		$this->MultiCell(150, 10, $employee_contacts->phone_number1 && $employee_contacts->phone_number1 != '' && $employee_contacts->label1 ? utf8_encode('Teléfono '.Utils::labelContact($employee_contacts->label1)) : ($employee_contacts->phone_number2 && $employee_contacts->phone_number2 != '' && $employee_contacts->label2 ? utf8_encode('Teléfono '.Utils::labelContact($employee_contacts->label2)) : ''), 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(60, $y + 12);
		$this->MultiCell(150, 10, $employee_contacts->phone_number1 && $employee_contacts->phone_number1 != '' ? $employee_contacts->phone_number1 : ($employee_contacts->phone_number2 && $employee_contacts->phone_number2 != '' ? $employee_contacts->phone_number2 : ''), 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(311, $y);
		$this->MultiCell(150, 10, $employee_contacts->phone_number2 && $employee_contacts->phone_number2 != '' && $employee_contacts->label2 ? utf8_encode('Teléfono '.Utils::labelContact($employee_contacts->label2)) : '', 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(311, $y + 12);
		$this->MultiCell(150, 10, $employee_contacts->phone_number2 && $employee_contacts->phone_number2 != '' ? $employee_contacts->phone_number2 : '', 0, 'L', false);

        $y+=30;


        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(60, $y);
		$this->MultiCell(241, 10, utf8_encode('Correo electrónico personal'), 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(60, $y + 12);
		$this->MultiCell(241, 10, $employee_contacts->email, 0, 'L', false);

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(311, $y);
		$this->MultiCell(241, 10, utf8_encode('Correo electrónico empresarial'), 0, 'L', false);
        $this->SetFont('OpenSansLight','', 10);
        $this->SetXY(311, $y + 12);
		$this->MultiCell(241, 10, $employee_contacts->institutional_email, 0, 'L', false);

	}

    public function setHistorialPuestos($employmentHistory){
		
        $y = $this->GetY() + 40;
		$this->SetFillColor(70, 125, 185);
		$this->RoundedRect(132, $y, 337, 28, 12, '1234', 'F');
		$this->SetFont('OpenSansExtraBold','B', 14);
        $this->SetTextColor(255, 255, 255);
        $this->setXY(220, $y + 10);
		$this->Write(10, 'HISTORIAL DE PUESTOS');

        $y = $this->GetY() + 40;

        $columnWidth = 158;

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(60, $y);

        $this->Cell($columnWidth, 20, 'Nombre de Puesto', 1, 0, 'C', true);
        $this->Cell($columnWidth, 20, 'Departamento', 1, 0, 'C', true);
        $this->Cell($columnWidth, 20, 'Fecha del movimiento', 1, 1, 'C', true);

        $this->SetTextColor(0, 0, 0);
        $this->SetFont('OpenSansLight','', 9);
        for ($i = 0; $i < count($employmentHistory); $i++) {
            $this->Cell($columnWidth, 20, $employmentHistory[$i]['title'], 1, 0, 'C');
            $this->Cell($columnWidth, 20, $employmentHistory[$i]['department'], 1, 0, 'C');
            $this->Cell($columnWidth, 20, Utils::getDate($employmentHistory[$i]['start_date']), 1, 1, 'C');
        }
	}

    public function setCapacitaciones($employeeTrainings){
		
        if ($this->GetY() > 700) {
            $this->AddPage();
        }else
            $y = $this->GetY() + 40;

		$this->SetFillColor(172, 202, 74);
		$this->RoundedRect(132, $y, 337, 28, 12, '1234', 'F');
		$this->SetFont('OpenSansExtraBold','B', 14);
        $this->SetTextColor(255, 255, 255);
        $this->setXY(250, $y + 10);
		$this->Write(10, utf8_encode('CAPACITACIÓN'));

        $y = $this->GetY() + 40;

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(60, $y);

        $this->Cell(205, 20, 'Nombre del Curso', 1, 0, 'C', true);
        $this->Cell(120, 20, 'Fecha', 1, 0, 'C', true);
        $this->Cell(90, 20, 'Horas', 1, 0, 'C', true);
        $this->Cell(60, 20, 'DC3', 1, 1, 'C', true);

        $this->SetTextColor(0, 0, 0);
        $this->SetFont('OpenSansLight','', 9);
        for ($i = 0; $i < count($employeeTrainings); $i++) {
            $this->Cell(205, 20, $employeeTrainings[$i]['title'], 1, 0, 'C');
            $this->Cell(120, 20, Utils::getDate($employeeTrainings[$i]['start_date']), 1, 0, 'C');
            $this->Cell(90, 20, ($employeeTrainings[$i]['hours']), 1, 0, 'C');
            $this->Cell(60, 20, 'Emitida', 1, 1, 'C');
        }
	}

    public function setEvaluaciones($employeeTrainings){
		
        if ($this->GetY() > 700) {
            $this->AddPage();
            $y = $this->GetY();
        }else
            $y = $this->GetY() + 40;

		$this->SetFillColor(221, 136, 46);
		$this->RoundedRect(132, $y, 337, 28, 12, '1234', 'F');
		$this->SetFont('OpenSansExtraBold','B', 14);
        $this->SetTextColor(255, 255, 255);
        $this->setXY(250, $y + 10);
		$this->Write(10, utf8_encode('DESEMPEÑO'));

        $y = $this->GetY() + 40;

        $this->SetFont('OpenSansExtraBold','B', 10);
        $this->SetXY(60, $y);

        $this->Cell(120, 20, 'Fecha', 1, 0, 'C', true);
        $this->Cell(120, 20, 'Evaluación', 1, 0, 'C', true);
        $this->Cell(90, 20, 'Resultado', 1, 0, 'C', true);
        $this->Cell(145, 20, 'Comentarios', 1, 1, 'C', true);

        $this->SetTextColor(0, 0, 0);
        $this->SetFont('OpenSansLight','', 9);
        for ($i = 0; $i < count($employeeTrainings); $i++) {
            $this->Cell(120, 20, $employeeTrainings[$i]['title'], 1, 0, 'C');
            $this->Cell(120, 20, Utils::getDate($employeeTrainings[$i]['start_date']), 1, 0, 'C');
            $this->Cell(90, 20, ($employeeTrainings[$i]['hours']), 1, 0, 'C');
            $this->Cell(145, 20, 'Emitida', 1, 1, 'C');
        }
	}
}