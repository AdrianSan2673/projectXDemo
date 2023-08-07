<?php
require_once 'libraries/fpdf/mc_table.php';

class Entregable extends PDF_MC_Table
{

    public function expLaborales( $vacante)
    {
        $x = 50;
        $y = 140;
        $w = 170;
        $h = 50;

        $this->setFont('Arial', 'B', 18);
        $this->setXY(200, 110);
        $this->SetTextColor(51, 54, 79);
        $this->Write(15, 'Entregable Levantamiento');
        $this->setFont('Arial', '', 13);
        $this->SetWidths(array(170, 340));
        $this->setY($y);
        $this->setX($x);


        $this->Row(array('Fecha de documento: ', Utils::getDate(date('Y-m-d'))));
        $this->setX($x);
        $this->Row(array('Vacante: ', utf8_decode($vacante->vacancy)));
        $this->setX($x);
        $this->Row(array('Empresa: ', utf8_decode($vacante->customer)));
        $this->setX($x);
        $this->Row(array('Experiencia en:', utf8_decode($vacante->requirements)));
        $this->setX($x);
        $this->Row(array('Puestos que pudo haber ocupado:', $vacante->functions));
        $this->SetWidths(array(170, 340));
        $y = $this->getY();
        $this->setXY($x, $y);
        $this->Row(array('Idiomas y Nivel: ', $vacante->language==null?  'No aplica':$vacante->language.' /  '.$vacante->language_level));
        $y = $this->getY();
    /*     $this->setXY($x, $y);
        $this->Row(array('Salario negociable: ', ($datos['salNeg']))); */
        $y = $this->getY();
        $this->setXY($x, $y);
        $this->Row(array('Rango salarial a ofertar:', '$' . number_format($vacante->salary_min, 2).' - $' . number_format($vacante->salary_max, 2)));
        $this->SetWidths(array(170, 340));
        $y = $this->getY();
        $this->setXY($x, $y);
        $this->Row(array('Comentarios o acuerdos entre el cliente y RHI:', utf8_decode($vacante->comments)));

    }

    public function Header()
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
        $this->Cell(0, 10, 'clientes@rrhhingenia.com                                                  wwww.rrhh-ingenia.com', 0, 1, 'C');
    }
}
