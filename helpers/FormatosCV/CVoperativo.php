<?php
require_once 'libraries/fpdf/mc_table.php';

class CVoperativo extends PDF_MC_Table
{

    public function datosGenerales($datos)
    {
        $x = 50;
        $y = 130;

        /*  $this->Rect(50,130,510,600,'D'); Contenedor */

        /* Vacante */
        $this->setDrawColor(1, 1, 1);
        $this->setFillColor(141, 180, 226);
        $this->setFont('Arial', 'B', 20);
        $this->setXY($x, $y);
        $this->MultiCell(510, 30, ($datos['tvacante']), 1, 'C', true);
        /* Fin Vacante */

        /* Nombre */
        $this->setFont('Arial', 'B', 15);
        $y = $this->getY();
        $this->setXY($x, $y);
        $this->Cell(170, 20, 'Nombre del candidato:', 1, 0, 'C');

        $this->setFont('Arial', '', 13);
        $x = $this->getX();
        $this->setXY($x, $y);
        $this->Cell(340, 20, ($datos['nombre']), 1, 0, 'L');
        /* Fin nombre */

        /* Edad */
        $this->setFont('Arial', 'B', 15);
        $x = 50;
        $y += 20;
        $this->setXY($x, $y);
        $this->Cell(170, 20, 'Edad:', 1, 0, 'C');

        $this->setFont('Arial', '', 13);
        $x = $this->getX();
        $this->setXY($x, $y);
        $this->Cell(70, 20, ($datos['edad'].' Años'), 1, 0, 'C');
        /* Fin edad */

        /* Telefono */
        # code...
            $this->setFont('Arial', 'B', 15);
            $x = 290;
            $y = $this->getY();
            $this->setXY($x, $y);
            $this->Cell(140, 20, ('Teléfono:'), 1, 0, 'C');

            $this->setFont('Arial', '', 13);
            $x = $this->getX();
            $this->setXY($x, $y);
            $this->Cell(130, 20, ($datos['telefono']?$datos['telefono']:'Sin numero'  ), 1, 0, 'C');
        
        /* Fin telefono */

        /* Escolaridad */
        $this->setFont('Arial', 'B', 15);
        $x = 50;
        $y += 20;
        $this->setXY($x, $y);
        $this->Cell(170, 20, ('Escolaridad:'), 1, 0, 'C');

        $this->setFont('Arial', '', 13);
        $x = $this->getX();
        $this->setXY($x, $y);
        $this->Cell(340, 20, ($datos['escolaridad']), 1, 0, 'L');
        /* Fin escolaridad */

        /* Estado de residencia */

        $this->setFont('Arial', 'B', 15);
        $x = 50;
        $y += 20;
        $this->setXY($x, $y);
        $this->Cell(170, 20, ('Estado de residencia:'), 1, 0, 'C');

        $this->setFont('Arial', '', 13);
        $x = $this->getX();
        $this->setXY($x, $y);
        $this->Cell(340, 20, ($datos['estadores']), 1, 0, 'L');

        /* Fin Estado de residencia */

        /*  $distancia = $this->getY(); echo( $distancia); */ /* Como calcular la ditancia */
    }

    public function expLaborales($laboral, $entrevista)
    {
        $x = 50;
        $y = 220;
        $w = 170;
        $h = 50;

        $this->setFont('Arial', 'B', 20);
        $y += 20;
        $x = 50;
        $this->setXY($x, $y);
        $this->Cell(510, 30, 'EXPERIENCIA LABORAL', 1, 0, 'C');

        $this->setFont('Arial', 'B', 15);
        $x = 50;
        $y += 30;
        $this->setXY($x, $y);
        $this->Cell(170, 20, ('Empresa o negocio'), 1, 0, 'C');

        $this->setFont('Arial', 'B', 15);

        $x = $this->getX();
        $this->setXY($x, $y);
        $this->Cell(340, 20, ('Puesto desempeñado'), 1, 0, 'C');

        $x1 = 50;
        $y1 = $y + 20;
        $this->setFont('Arial', '', 13);
        $this->SetWidths(array(170, 340));
        $this->setXY($x1, $y1);
        for ($i = 0; $i < count($laboral); $i++) {
            $this->Row(array(($laboral[$i]['enterprise']), ($laboral[$i]['position'])));
            $this->setX($x1);
        }


        /* Entrevistador */

        if ($entrevista['entrevistador']) {
            $this->setFont('Arial', 'B', 13);
            $y = $this->getY();
            $this->setXY($x1, $y);
            $this->MultiCell($w, 20, ('Entrevistado por:'), 1, 'C');

            $this->setFont('Arial', '', 13);
            $this->setXY($x1 + 170, $y);
            $this->MultiCell(340, 20, ('pedro'), 1, 'C');
            /* Fin entrevistador */
        }
        /* Comentarios  */

        $this->setFillColor(255, 255, 255);
        $this->setFont('Arial', '', 13);
        $this->SetWidths(array(170, 340));
        $y = $this->getY();
        $this->setXY($x1, $y);

        $this->Row(array("\n\n Comentarios del entrevistador", $entrevista['comentarios']));

        /* Fin comentarios */
    }


    public function Header()
    {
        $this->Image('dist/img/imagotipo-colores.png', 198, 42, 217);
    }
}
