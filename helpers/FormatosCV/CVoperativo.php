<?php
require_once 'libraries/fpdf/atributos.php';

class CVoperativo extends atributos
{

    public function datosGenerales($datos, $entrevista)
    {
        /* Añadidos */
        $x1 = 190;
        $y = 50;

        $this->ClippingRect(0, 0, 170, 800, true);
        $this->Image('dist/img/isotipo-colores.png',-210, 150, 417);
        $this->UnsetClipping();
        $this->Image('dist/img/imagotipo-colores-4.png', 20, 30, 117);
        /* Fin Añadidos */

        /* Entrevistador */
		if($entrevista['entrevistador']){
        $this->setTextColor(255, 255, 255);
        $this->setFont('SinkinSans', 'B', 8);
        $this->setXY(35, 600);
        $this->MultiCell(100, 20, utf8_encode('Entrevistado por:'), 0, 'C');

        $this->setFont('SinkinSans', 'B', 12);
        $this->setXY(35, 620);
        $this->MultiCell(100, 20, utf8_encode($entrevista['entrevistador']), 0, 'C');
		}
        /* Fin entrevistador */


        /* Vacante */
        $this->setTextColor(0,0,0);
        $this->setFillColor(255, 255, 255);
        $this->setFont('SinkinSans', 'B', 12);
        $this->setXY($x1, $y);
        $this->MultiCell(400, 20, utf8_encode($datos['tvacante']), 'TB', 'C', true);
        /* Fin Vacante */

        /* Nombre */
        $this->setFont('SinkinSans', 'B', 8);
        $y = $this->getY() + 20;
        $this->setXY($x1, $y);
        $this->Cell(120, 20, 'Nombre del candidato:', 0, 'L');

        $this->setFont('SinkinSans', '', 8);
        $x = $this->getX();
        $this->setXY(310, $y);
        $this->Cell(250, 20, ($datos['nombre']), 0, 0, 'L');
        $this->SetFillColor(168, 197, 074); /* Verde */
        $this->Rect(590, $y-15, 10, 40, 'F');
        /* Fin nombre */

        /* Edad */
        $this->setFont('SinkinSans', 'B', 8);
        $y += 20;
        $this->setXY($x1, $y);
        $this->Cell(60, 20, 'Edad:', 0, 0, 'L');

        $this->setFont('SinkinSans', '', 8);
        $x = $this->getX();
        $this->setXY($x, $y);
        $this->Cell(40, 20, utf8_encode($datos['edad']).' Años', 0, 0, 'L');
        $this->SetFillColor(186, 69, 144); /* Rosa */
        $this->Rect(360, $y+5, 10, 40, 'F');
        
        /* Fin edad */

        /* Telefono */
        $this->setFont('SinkinSans', 'B', 8);
        $x = 380;
        $y = $this->getY();
        $this->setXY($x, $y);
        $this->Cell(60, 20,$datos['telephoneCheck']==1? utf8_encode('Telefono:'):'', 0, 0, 'L');
        

        $this->setFont('SinkinSans', '', 8);
        $x = $this->getX();
        $this->setXY($x, $y);
        $this->Cell(100, 20,$datos['telephoneCheck']==1?(isset($datos['telefono']))? utf8_encode($datos['telefono']):'Sin telefono':'', 0, 0, 'L');
        
        $this->SetFillColor(71, 124, 179); /* Azul */
        $this->Rect(590, $y+5, 10, 40, 'F');

        /* Fin telefono */

        /* Escolaridad */
        $this->setFont('SinkinSans', 'B', 8);
        $y += 20;
        $this->setXY($x1, $y);
        $this->Cell(70, 20, utf8_encode('Escolaridad:'), 0, 0, 'L');
        

        $this->setFont('SinkinSans', '', 8);
        $x = $this->getX();
        $this->setXY($x, $y);
        $this->MultiCell(100, 20, utf8_encode($datos['escolaridad']), 0, 'L');
        
        /* Fin escolaridad */

        /* Estado de residencia */

        $this->setFont('SinkinSans', 'B', 8);
        $x = 380;
        $this->setXY($x, $y);
        $this->Cell(120, 20, utf8_encode('Estado de residencia:'), 0, 0, 'L');


        $this->setFont('SinkinSans', '', 8);
        $x = $this->getX();
        $this->setY($y + 5);
        $this->setX($x);

        $this->MultiCell(90, 10, utf8_encode($datos['estadores']), 0, 'L');

        /* Fin Estado de residencia */

        /*  $distancia = $this->getY(); echo( $distancia); */ /* Como calcular la ditancia */
    }

    public function expLaborales($laboral, $entrevista)
    {
        $x = 50;
        $y = $this->getY();
        $w = 170;
        $h = 50;

        $this->setFont('SinkinSans', 'B', 20);
        $y += 20;
        $x = 190;
        $this->setXY($x, $y);
        $this->Cell(400, 30, 'EXPERIENCIA LABORAL', 'TB', 0, 'C');

        $this->setFont('SinkinSans', 'B', 10);
        /*  $x = 50; */
        $y += 30;
        $this->setXY($x, $y);
        $this->Cell(180, 20, utf8_encode('Empresa o negocio'), 'TB', 0, 'C');

        $this->setFont('SinkinSans', 'B', 10);

        $x = $this->getX();
        $this->setXY($x, $y);
        $this->Cell(220, 20,utf8_encode( utf8_decode('Puesto desempeñado')), 'TB', 0, 'C');

        $x1 = 190;
        $y1 = $y + 20;
        $this->setFont('SinkinSans', '', 8);
        $this->SetWidths(array(180, 220));

        $this->setXY($x1, $y1);
        for ($i = 0; $i < count($laboral); $i++) {
            $this->Row(array(utf8_encode($laboral[$i]['enterprise']), utf8_encode($laboral[$i]['review'])));
            $this->setX($x1);
            if ($this->getY() > 500) {
                $this->AddPage();
                $y = 45;
                $x1 = 190;
            } else {
                $y = $this->getY();
                $x1 = 190;
            }
            $this->setX($x1);
        }

        /* Comentarios  */
		//if($entrevista['comentarios']){
        $this->SetWidths(array(180, 220));
        $y = $this->getY();
		$this->setY($y);
        $this->setX(190);
		$this->Row(array("Comentarios del entrevistador", utf8_encode($entrevista['comentarios'])));
		//}

        /* Fin comentarios */
    }

    public function Header()
    {

        $this->SetFillColor(52, 56, 79);
        $this->Rect(0, 0, 170, 800, 'DF');
    }
}
