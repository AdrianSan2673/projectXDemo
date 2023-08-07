<?php

class SOI extends FPDF{
    public $candidato;
    public $vl;

    function header(){
        $this->Image('dist/img/soi/screen.png', -123, 0, 841.9, 0);
        $this->Image('dist/img/soi/lateral.png', 0, 0, 0, 841.9);
        $this->Image('dist/img/soi/abajo.png', 297.6, 717.2, 297.6, 0);
        $this->Image('dist/img/imagotipo-colores.png', 250, 48, 320, 0);

        $x = 230;
        $y = 122;
        $this->setFont('JosefinSans', '', 15.6);
		$this->setTextColor(51, 54, 79);
		$this->setXY($x, $y);
		$this->MultiCell(340, 16, 'SOI (SAFE OPERATOR BY INGENIA)', 0, 'FJ', false);

        $x = 210;
        $y = 173;
        $this->setFont('Antic', '', 20);
		$this->setXY($x, $y);
		$this->MultiCell(300, 25, 'Certifica que', 0, 'C', false);

        $x = 160;
        $y = 230;
        $this->setFont('AmsterdamOne', '', 40);
		$this->setXY($x, $y);
		$this->MultiCell(400, 60, (utf8_encode(ucwords(mb_strtolower($this->candidato->Nombres.' '.$this->candidato->Apellido_Paterno.' '.$this->candidato->Apellido_Materno)))), 0, 'C', false);

        $x = 96;
        $y = 388;
        $this->setFont('Antic', '', 23.5);
		$this->setXY($x, $y);
		$this->MultiCell(470, 30, utf8_encode('Completó satisfactoriamente el proceso de validación de su récord laboral y los requisitos requeridos por lo que se le cualifica como    '), 0, 'FJ', false);

        $x = 270;
        $y = 478;
        $this->setFont('Helvetica', 'B', 23.5);
		$this->setXY($x, $y);
		$this->MultiCell(295, 30, utf8_encode('Operador Seguro.'), 0, 'FJ', false);

        $x = 0;
        $y = 536;
        $this->SetFont('JosefinSans', '', 16);
        $this->SetXY($x, $y);
        $this->MultiCell(595.2, 20, utf8_encode('DATOS GENERALES'), 0, 'C', false);

        $x = 96;
        $y = 587;
        $this->SetFont('Sukar', 'B', 15.8);
        $this->SetXY($x, $y);
        $this->MultiCell(95, 20, utf8_encode('CURP:'), 0, 'L', false);

        $this->SetXY($x, $y + 20);
        $this->MultiCell(95, 20, utf8_encode('Licencia:'), 0, 'L', false);

        $this->SetXY($x, $y + 40);
        $this->MultiCell(95, 20, utf8_encode('Vencimiento:'), 0, 'L', false);

        $x = 196;
        $y = 587;
        $this->SetFont('Sukar', '', 15.8);
        $this->SetXY($x, $y);
        $this->MultiCell(170, 20, utf8_encode($this->candidato->CURP), 0, 'L', false);

        if ($this->vl) {
            $this->SetXY($x, $y + 20);
            $this->MultiCell(170, 20, utf8_encode($this->vl->Numero_Licencia), 0, 'L', false);

            $this->SetXY($x, $y + 40);
            $this->MultiCell(170, 20, utf8_encode($this->vl->Licencia_Vigente_Del.' - '.$this->vl->Licencia_Vigente_Hasta), 0, 'L', false);    
        }

        $x = 418;
        $y = 616;
        $this->SetFont('JosefinSans', '', 16);
        $this->SetXY($x, $y);
        $this->MultiCell(150, 20, utf8_encode('Folio  '. $this->candidato->Candidato), 0, 'L', false);

        $this->Line(135, 744, 298, 744);

        $x = 95;
        $y = 760;
        $this->SetFont('JosefinSans', '', 16);
        $this->SetXY($x, $y);
        $this->MultiCell(298, 20, utf8_encode('Juanita Hernández Medrano'), 0, 'C', false);

        $this->SetFont('JosefinSans', 'B', 13);
        $this->SetXY($x, $y + 20);
        $this->MultiCell(298, 20, utf8_encode('Gerente de Operaciones'), 0, 'C', false);

        $this->Image('dist/img/soi/firma_juanita.png', 170, 660, 110, 0);
    }
}