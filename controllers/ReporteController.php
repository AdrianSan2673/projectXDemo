<?php

require_once 'models/SA/Candidatos.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/SA/Facturas.php';
require_once 'libraries/PhpSpreadsheet/vendor/autoload.php';
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/EmployeeContract.php';
require_once 'models/RH/Positions.php';
require_once 'models/RH/EmployeeContact.php';
require_once 'models/SA/RazonesSocialesEmpresa.php';
require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/EjecutivosPlazas.php';
// //===[gabo 9 junio excel evaluaciones]===
require_once 'models/RH/GroupEvaluation.php';
// //===[gabo 9 junio excel evaluaciones fin]===
//===[gabo 14 junio excel pt3]===
require_once 'models/RH/EvaluationEmployee.php';
require_once 'models/RH/EvaluationOpenQuestionsEmployee.php';
require_once 'models/RH/EvaluationCategory.php';
require_once 'models/RH/OpenQuestions.php';
// //===[gabo 14 junio excel pt3]===
require_once 'models/RH/Evaluations.php';



use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReporteController
{

    /* public function operaciones_SA(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA()) {

            $estudio = new Candidatos();
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                if ($_POST['start_date'] > $_POST['end_date']) {
                    $aux = $_POST['start_date'];
                    $_POST['start_date'] = $_POST['end_date'];
                    $_POST['end_date'] = $aux;
                }
                $estudio->setFecha_solicitud($_POST['start_date']);
                $estudio->setFecha_Entregado($_POST['end_date']);
                $estudios = $estudio->getServiciosPorRangoDeFechaConCancelados();
            }
            else
                $estudios = $estudio->getServiciosUltimos30();
            
            
        } else
            header('location:'.base_url);
    } */


    public function operaciones_SA()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager()) {
            /* $estudio = new Candidatos();
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                if ($_POST['start_date'] > $_POST['end_date']) {
                    $aux = $_POST['start_date'];
                    $_POST['start_date'] = $_POST['end_date'];
                    $_POST['end_date'] = $aux;
                }
                $estudio->setFecha_solicitud($_POST['start_date']);
                $estudio->setFecha_Entregado($_POST['end_date']);
                $estudios = $estudio->getServiciosPorRangoDeFechaConCancelados();

                $_SESSION['start_date_excel'] = $_POST['start_date'];
                $_SESSION['end_date_excel'] = $_POST['end_date'];
                $_SESSION['estudios_excel'] = $estudios;

                $page_title = 'Reporte de Operaciones | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/ese/search.php';
                require_once 'views/layout/footer.php';

                echo "<script>document.addEventListener('DOMContentLoaded', e => { location.href='".base_url."reporte/excel'; })</script>"; 
            }else{
                $estudios = $estudio->getServiciosHoyConCancelados(); */
            $page_title = 'Reporte de Operaciones | RRHH Ingenia';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/search.php';
            require_once 'views/layout/footer.php';
            /* } */
        } else
            header('location:' . base_url);
    }



    public function excel()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isCustomerSA() || Utils::isSales() || Utils::isSalesManager() && (isset($_POST['start_date']) && isset($_POST['end_date']))) {
            //set_time_limit(480);

            ini_set('max_execution_time', 480);
            $estudio = new Candidatos();
            if ($_POST['start_date'] > $_POST['end_date']) {
                $aux = $_POST['start_date'];
                $_POST['start_date'] = $_POST['end_date'];
                $_POST['end_date'] = $aux;
            }
            $estudio->setFecha_solicitud($_POST['start_date']);
            $estudio->setFecha_Entregado($_POST['end_date']);
            $estudios = $estudio->getServiciosPorRangoDeFechaConCancelados();

            $rales = $estudio->getServiciosRALPorRangoDeFechaConCancelados();

            $Ejecutivos_Cuenta = $estudio->getServiciosFasePorEjecutivoRangoFechas();
            $Ejecutivos_Logistica = $estudio->getServiciosSolicitadosPorLogisticaRangoFechas();

            $Clientes_Servicios = $estudio->getServiciosPorClienteRangoFechas();

            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            /* $start_date = $_SESSION['start_date'];
            $end_date = $_SESSION['end_date_excel'];
            $estudios = $_SESSION['estudios_excel']; */


            $documento = new Spreadsheet();
            $documento
                ->getProperties()
                ->setCreator('RRHH Ingenia')
                ->setLastModifiedBy($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name)
                ->setTitle('Reporte de Operaciones')
                ->setDescription('RRHH Ingenia | Reporte de Operaciones');

            $hoja = $documento->getActiveSheet();
            $hoja->setTitle('Reporte SA');

            $estiloTituloReporte = array(
                'font' => array(
                    'bold'      => true,
                    'italic'    => false,
                    'strike'    => false,
                    'size' => 13
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => Border::BORDER_NONE
                    )
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'bold'  => true,
                    'size' => 12,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('rgb' => 'A6C44A')
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );

            $estiloInformacion = array(
                'font' => array(
                    'size' => 8
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            );

            $izquierda = array(
                'aligment' => array(
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $centrado = array(
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );

            $derecha = array(
                'aligment' => array(
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $azulFuerte = array(
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '33364F'
                    ),
                    'endColor' => array(
                        'rgb' => 'FFFFFF'
                    )
                )

            );
            $rojo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'B80C09'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $amarillo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'F8C630'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $beige = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'FFEEBA'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $gris = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '6C757D'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $azul = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '007BFF'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $azulBajo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'BEE5EB'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $verde = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'A6C44A'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $naranja = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'F28322'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );

            $morado = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '6F42C1'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );

            //$hoja->setCellValue('A1', 'REPORTE DE OPERACIONES DE SA');
            //$hoja->mergeCells('A1:S1');

            $hoja->getColumnDimension('A')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(1, 1, 'Folio');

            $hoja->getColumnDimension('B')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(2, 1, 'Días');

            $hoja->getColumnDimension('C')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(3, 1, 'CC RHI');

            $hoja->getColumnDimension('D')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(4, 1, 'Solicitud');

            $hoja->getColumnDimension('E')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(5, 1, 'Empresa');

            $hoja->getColumnDimension('F')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(6, 1, 'Cliente');

            $hoja->getColumnDimension('G')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(7, 1, 'Candidato');

            $hoja->getColumnDimension('H')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(8, 1, 'Puesto');

            $hoja->getColumnDimension('I')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(9, 1, 'Servicio Solicitado');

            $hoja->getColumnDimension('J')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(10, 1, 'Fase');

            $hoja->getColumnDimension('K')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(11, 1, 'Agenda');

            $hoja->getColumnDimension('L')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(12, 1, 'Entrega');

            $hoja->getColumnDimension('M')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(13, 1, 'Tiempo');
            $hoja->getColumnDimension('N')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(14, 1, 'Tiempo IL');

            $hoja->getColumnDimension('O')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(15, 1, 'Tiempo ESE');

            $hoja->getColumnDimension('P')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(16, 1, 'Estatus');

            $hoja->getColumnDimension('Q')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(17, 1, 'CC Clientes');

            $hoja->getColumnDimension('R')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(18, 1, 'Factura');

            $hoja->getColumnDimension('S')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(19, 1, 'Razón social');

            $hoja->getColumnDimension('T')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(20, 1, 'Solicita');

            $hoja->getColumnDimension('U')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(21, 1, 'Ciudad');

            $hoja->getColumnDimension('V')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(22, 1, 'Estado');

            $hoja->getColumnDimension('W')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(23, 1, 'Ejecutivo de Cuenta');

            $hoja->getColumnDimension('X')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(24, 1, 'Ejecutivo de Logística');

            $hoja->getColumnDimension('Y')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(25, 1, 'Comentarios del Cliente');

            $hoja->getColumnDimension('Z')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(26, 1, 'Comentarios de Cancelación');

            $hoja->getColumnDimension('AA')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(27, 1, 'Comentarios de Finalización');

            $hoja->getColumnDimension('AB')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(28, 1, 'Viabilidad');

            $hoja->getColumnDimension('AC')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(29, 1, 'Folio IL');

            $hoja->getColumnDimension('AD')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(30, 1, 'Folio ESE');

            $fila = 2;
            $fila1 = $fila;
            $No_IL = [];
            $No_ESE = [];

            foreach ($estudios as $estudio) {
                if ($estudio['id_empresa'] == 413 && $estudio['replicado'] == 2) {
                } else {
                    $hoja->setCellValueByColumnAndRow(1, $fila, $estudio['Folio']);
                    $hoja->setCellValueByColumnAndRow(2, $fila, $estudio['Dias']);
                    $hoja->setCellValueByColumnAndRow(3, $fila, $estudio['Centro_C']);
                    $hoja->setCellValueByColumnAndRow(4, $fila, date_format(date_create($estudio['Solicitud']), 'd/m/Y'));
                    $hoja->setCellValueByColumnAndRow(5, $fila, $estudio['Empresa']);
                    $hoja->setCellValueByColumnAndRow(6, $fila, $estudio['Cliente']);
                    $hoja->setCellValueByColumnAndRow(7, $fila, $estudio['Nombre_Candidato']);
                    $hoja->setCellValueByColumnAndRow(8, $fila, $estudio['Puesto'] == '' ? 'NO APLICA' : $estudio['Puesto']);
                    $hoja->setCellValueByColumnAndRow(9, $fila, $estudio['Servicio_Solicitado']);
                    $hoja->setCellValueByColumnAndRow(10, $fila, $estudio['Fase']);
                    $hoja->setCellValueByColumnAndRow(11, $fila, $estudio['Aplicacion'] ? date_format(date_create($estudio['Aplicacion']), 'd/m/Y') : '');
                    $hoja->setCellValueByColumnAndRow(12, $fila, $estudio['Fecha_Entregado'] ? date_format(date_create($estudio['Fecha_Entregado']), 'd/m/Y') : '');
                    $hoja->setCellValueByColumnAndRow(13, $fila, $estudio['Tiempo']);
                    $hoja->setCellValueByColumnAndRow(14, $fila, $estudio['Tiempo_IL']);
                    $hoja->setCellValueByColumnAndRow(15, $fila, $estudio['Tiempo_ESE']);
                    $hoja->setCellValueByColumnAndRow(16, $fila, strtoupper($estudio['Estatus'] == 'RAL Consultado' ? 'Finalizado' : $estudio['Estatus']));
                    $hoja->setCellValueByColumnAndRow(17, $fila, $estudio['CC_Cliente']);
                    $hoja->setCellValueByColumnAndRow(18, $fila, $estudio['Factura']);
                    $hoja->setCellValueByColumnAndRow(19, $fila, $estudio['Razon']);
                    $hoja->setCellValueByColumnAndRow(20, $fila, $estudio['Solicita']);
                    $hoja->setCellValueByColumnAndRow(21, $fila, $estudio['Ciudad']);
                    $hoja->setCellValueByColumnAndRow(22, $fila, $estudio['Estado_MX']);
                    $hoja->setCellValueByColumnAndRow(23, $fila, $estudio['Ejecutivo']);
                    $hoja->setCellValueByColumnAndRow(24, $fila, $estudio['HO']);
                    $hoja->setCellValueByColumnAndRow(25, $fila, $estudio['Comentario_Cliente']);
                    $hoja->setCellValueByColumnAndRow(26, $fila, $estudio['Comentario_Cancelado']);
                    $hoja->setCellValueByColumnAndRow(27, $fila, $estudio['Comentario_Finalizado']);
                    $hoja->setCellValueByColumnAndRow(28, $fila, $estudio['Viable'] == '0' && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable' : ($estudio['Viable'] == 1 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'No viable' : ($estudio['Viable'] == 2 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable con Reservas' : ($estudio['Viable'] == 5 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable con observaciones' : '-'))));
                    $hoja->setCellValueByColumnAndRow(29, $fila, $estudio['IL']);
                    $hoja->setCellValueByColumnAndRow(30, $fila, $estudio['ESE']);


                    if ($estudio['Solicitud_De'] > 0)
                        $hoja->getStyle('F' . $fila)->applyFromArray($beige);

                    if ($estudio['Repetidos'] > 1)
                        $hoja->getStyle('G' . $fila)->applyFromArray($rojo);

                    if ($estudio['Servicio_Solicitado'] == 'RAL')
                        $hoja->getStyle('I' . $fila)->applyFromArray($amarillo);
                    if ($estudio['Servicio_Solicitado'] == 'INV. LABORAL')
                        $hoja->getStyle('I' . $fila)->applyFromArray($rojo);
                    if ($estudio['Servicio_Solicitado'] == 'ESE')
                        $hoja->getStyle('I' . $fila)->applyFromArray($azulFuerte);
                    if ($estudio['Servicio_Solicitado'] == 'ESE + VISITA')
                        $hoja->getStyle('I' . $fila)->applyFromArray($morado);

                    if ($estudio['Fase'] == 'RAL')
                        $hoja->getStyle('J' . $fila)->applyFromArray($amarillo);
                    if ($estudio['Fase'] == 'INV. LABORAL' || $estudio['Fase'] == 'RAL + INV.LAB')
                        $hoja->getStyle('J' . $fila)->applyFromArray($rojo);
                    if ($estudio['Fase'] == 'ESE' || $estudio['Fase'] == 'RAL + INV.LAB + ESE')
                        $hoja->getStyle('J' . $fila)->applyFromArray($azulFuerte);
                    if ($estudio['Fase'] == 'RAL + INV.LAB + ESE + Visita')
                        $hoja->getStyle('J' . $fila)->applyFromArray($morado);

                    if ($estudio['Dias'] < 2 && $estudio['Dias'] > -1)
                        $hoja->getStyle('M' . $fila)->applyFromArray($verde);
                    elseif ($estudio['Dias'] > 2)
                        $hoja->getStyle('M' . $fila)->applyFromArray($rojo);
                    elseif ($estudio['Dias'] == 2)
                        $hoja->getStyle('M' . $fila)->applyFromArray($naranja);

                    if ($estudio['Tiempo_IL'] < 2 && $estudio['Tiempo_IL'] > -1)
                        $hoja->getStyle('N' . $fila)->applyFromArray($verde);
                    elseif ($estudio['Tiempo_IL'] > 2)
                        $hoja->getStyle('N' . $fila)->applyFromArray($rojo);
                    elseif ($estudio['Tiempo_IL'] == 2)
                        $hoja->getStyle('N' . $fila)->applyFromArray($naranja);

                    if ($estudio['Tiempo_ESE'] < 2 && $estudio['Tiempo_ESE'] > -1)
                        $hoja->getStyle('O' . $fila)->applyFromArray($verde);
                    elseif ($estudio['Tiempo_ESE'] > 2)
                        $hoja->getStyle('O' . $fila)->applyFromArray($rojo);
                    elseif ($estudio['Tiempo_ESE'] == 2)
                        $hoja->getStyle('O' . $fila)->applyFromArray($naranja);

                    if ($estudio['Estatus'] == 'Ral en Proceso')
                        $hoja->getStyle('p' . $fila)->applyFromArray($amarillo);
                    if ($estudio['Estatus'] == 'Investigación en Proceso')
                        $hoja->getStyle('p' . $fila)->applyFromArray($gris);
                    if ($estudio['Estatus'] == 'Visita en Proceso')
                        $hoja->getStyle('p' . $fila)->applyFromArray($azulFuerte);
                    if ($estudio['Estatus'] == 'Finalizado' || $estudio['Estatus'] == 'RAL Consultado')
                        $hoja->getStyle('p' . $fila)->applyFromArray($azul);
                    if ($estudio['Estatus'] == 'Cancelado')
                        $hoja->getStyle('p' . $fila)->applyFromArray($rojo);
                    if ($estudio['Estatus'] == 'Facturado')
                        $hoja->getStyle('p' . $fila)->applyFromArray($azulBajo);
                    if ($estudio['Estatus'] == 'Visita Presencial en Proceso')
                        $hoja->getStyle('p' . $fila)->applyFromArray($morado);

                    if ($estudio['Viable'] == '0')
                        $hoja->getStyle('Z' . $fila)->applyFromArray($verde);
                    if ($estudio['Viable'] == 1)
                        $hoja->getStyle('Z' . $fila)->applyFromArray($rojo);
                    if ($estudio['Viable'] == 2)
                        $hoja->getStyle('Z' . $fila)->applyFromArray($naranja);
                    if ($estudio['Viable'] == 5)
                        $hoja->getStyle('Z' . $fila)->applyFromArray($azul);

                    if ($estudio['ESE'] != NULL && $estudio['ESE'] > 0) {
                        $hoja->getStyle('G' . $fila)->applyFromArray($azulFuerte);
                        array_push($No_ESE, $estudio['ESE']);
                    }
                    if ($estudio['IL'] != NULL && $estudio['IL'] > 0) {
                        $hoja->getStyle('G' . $fila)->applyFromArray($gris);
                        array_push($No_IL, $estudio['IL']);
                    }

                    $fila++;
                }
            }
            foreach ($estudios as $estudio) {
                if (in_array($estudio['Folio'], $No_ESE) || in_array($estudio['Folio'], $No_IL))
                    $hoja->getStyle('G' . $fila1)->applyFromArray($amarillo);
                $fila1++;
            }

            $fila = $fila - 1;

            $hoja->getStyle('A2:AB' . $fila)->applyFromArray($estiloInformacion);
            $hoja->getStyle('A2:C' . $fila)->applyFromArray($centrado);
            $hoja->getStyle('K2:K' . $fila)->applyFromArray($centrado);
            $hoja->getStyle('L2:N' . $fila)->applyFromArray($centrado);
            //$hoja->getStyle('A1:AB1')->applyFromArray($estiloTituloReporte);
            $hoja->getStyle('A1:AB1')->applyFromArray($estiloTituloColumnas);
            //$hoja->getStyle('D2:D'.$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

            $hoja1 = $documento->createSheet();
            $hoja1->setTitle('RAL');

            $hoja1->getColumnDimension('A')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(1, 1, 'Folio');

            $hoja1->getColumnDimension('B')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(2, 1, 'Días');

            $hoja1->getColumnDimension('C')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(3, 1, 'CC RHI');

            $hoja1->getColumnDimension('D')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(4, 1, 'Solicitud');

            $hoja1->getColumnDimension('E')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(5, 1, 'Empresa');

            $hoja1->getColumnDimension('F')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(6, 1, 'Cliente');

            $hoja1->getColumnDimension('G')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(7, 1, 'Candidato');

            $hoja1->getColumnDimension('H')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(8, 1, 'Puesto');

            $hoja1->getColumnDimension('I')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(9, 1, 'Servicio Solicitado');

            $hoja1->getColumnDimension('J')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(10, 1, 'Fase');

            $hoja1->getColumnDimension('K')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(11, 1, 'Agenda');

            $hoja1->getColumnDimension('L')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(12, 1, 'Entrega');

            $hoja1->getColumnDimension('M')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(13, 1, 'Tiempo');

            $hoja1->getColumnDimension('N')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(14, 1, 'Estatus');

            $hoja1->getColumnDimension('O')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(15, 1, 'CC Clientes');

            $hoja1->getColumnDimension('P')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(16, 1, 'Factura');

            $hoja1->getColumnDimension('Q')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(17, 1, 'Razón social');

            $hoja1->getColumnDimension('R')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(18, 1, 'Solicita');

            $hoja1->getColumnDimension('S')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(19, 1, 'Ciudad');

            $hoja1->getColumnDimension('T')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(20, 1, 'Estado');

            $hoja1->getColumnDimension('U')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(21, 1, 'Ejecutivo de Cuenta');

            $hoja1->getColumnDimension('V')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(22, 1, 'Ejecutivo de Logística');

            $hoja1->getColumnDimension('W')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(23, 1, 'Comentarios del Cliente');

            $hoja1->getColumnDimension('X')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(24, 1, 'Comentarios de Cancelación');

            $hoja1->getColumnDimension('Y')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(25, 1, 'Comentarios de Finalización');

            $hoja1->getColumnDimension('Z')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(26, 1, 'Viabilidad');

            $hoja1->getColumnDimension('AA')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(27, 1, 'Folio IL');

            $hoja1->getColumnDimension('AB')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(28, 1, 'Folio ESE');

            $fila = 2;
            $fila1 = $fila;
            /* $ejecutivos = [];
            $Clientes = []; */
            $No_IL = [];
            $No_ESE = [];
            foreach ($rales as $estudio) {
                $hoja1->setCellValueByColumnAndRow(1, $fila, $estudio['Folio']);
                $hoja1->setCellValueByColumnAndRow(2, $fila, $estudio['Dias']);
                $hoja1->setCellValueByColumnAndRow(3, $fila, $estudio['Centro_C']);
                $hoja1->setCellValueByColumnAndRow(4, $fila, date_format(date_create($estudio['Solicitud']), 'd/m/Y'));
                $hoja1->setCellValueByColumnAndRow(5, $fila, $estudio['Empresa']);
                $hoja1->setCellValueByColumnAndRow(6, $fila, $estudio['Cliente']);
                $hoja1->setCellValueByColumnAndRow(7, $fila, $estudio['Nombre_Candidato']);
                $hoja1->setCellValueByColumnAndRow(8, $fila, $estudio['Puesto']);
                $hoja1->setCellValueByColumnAndRow(9, $fila, $estudio['Servicio_Solicitado']);
                $hoja1->setCellValueByColumnAndRow(10, $fila, $estudio['Fase']);
                $hoja1->setCellValueByColumnAndRow(11, $fila, $estudio['Aplicacion'] ? date_format(date_create($estudio['Aplicacion']), 'd/m/Y') : '');
                $hoja1->setCellValueByColumnAndRow(12, $fila, $estudio['Fecha_Entregado'] ? date_format(date_create($estudio['Fecha_Entregado']), 'd/m/Y') : '');
                $hoja1->setCellValueByColumnAndRow(13, $fila, $estudio['Tiempo']);
                $hoja1->setCellValueByColumnAndRow(14, $fila, strtoupper($estudio['Estatus']));
                $hoja1->setCellValueByColumnAndRow(15, $fila, $estudio['CC_Cliente']);
                $hoja1->setCellValueByColumnAndRow(16, $fila, $estudio['Factura']);
                $hoja1->setCellValueByColumnAndRow(17, $fila, $estudio['Razon']);
                $hoja1->setCellValueByColumnAndRow(18, $fila, $estudio['Solicita']);
                $hoja1->setCellValueByColumnAndRow(19, $fila, $estudio['Ciudad']);
                $hoja1->setCellValueByColumnAndRow(20, $fila, $estudio['Estado_MX']);
                $hoja1->setCellValueByColumnAndRow(21, $fila, $estudio['Ejecutivo']);
                $hoja1->setCellValueByColumnAndRow(22, $fila, $estudio['HO']);
                $hoja1->setCellValueByColumnAndRow(23, $fila, $estudio['Comentario_Cliente']);
                $hoja1->setCellValueByColumnAndRow(24, $fila, $estudio['Comentario_Cancelado']);
                $hoja1->setCellValueByColumnAndRow(25, $fila, $estudio['Comentario_Finalizado']);
                $hoja1->setCellValueByColumnAndRow(26, $fila, $estudio['Viable'] == '0' && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable' : ($estudio['Viable'] == 1 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'No viable' : ($estudio['Viable'] == 2 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable con Reservas' : ($estudio['Viable'] == 5 && ($estudio['Estado'] == 252 || $estudio['Estado'] == 254) ? 'Viable con observaciones' : '-'))));
                $hoja1->setCellValueByColumnAndRow(27, $fila, $estudio['IL']);
                $hoja1->setCellValueByColumnAndRow(28, $fila, $estudio['ESE']);

                if ($estudio['Solicitud_De'] > 0)
                    $hoja1->getStyle('F' . $fila)->applyFromArray($beige);

                if ($estudio['Repetidos'] > 1)
                    $hoja1->getStyle('G' . $fila)->applyFromArray($rojo);

                if ($estudio['Servicio_Solicitado'] == 'RAL')
                    $hoja1->getStyle('I' . $fila)->applyFromArray($amarillo);
                if ($estudio['Servicio_Solicitado'] == 'INV. LABORAL')
                    $hoja1->getStyle('I' . $fila)->applyFromArray($rojo);
                if ($estudio['Servicio_Solicitado'] == 'ESE')
                    $hoja1->getStyle('I' . $fila)->applyFromArray($azulFuerte);
                if ($estudio['Servicio_Solicitado'] == 'ESE + VISITA')
                    $hoja1->getStyle('I' . $fila)->applyFromArray($morado);

                if ($estudio['Fase'] == 'RAL')
                    $hoja1->getStyle('J' . $fila)->applyFromArray($amarillo);
                if ($estudio['Fase'] == 'INV. LABORAL' || $estudio['Fase'] == 'RAL + INV.LAB')
                    $hoja1->getStyle('J' . $fila)->applyFromArray($rojo);
                if ($estudio['Fase'] == 'ESE' || $estudio['Fase'] == 'RAL + INV.LAB + ESE')
                    $hoja1->getStyle('J' . $fila)->applyFromArray($azulFuerte);
                if ($estudio['Fase'] == 'RAL + INV.LAB + ESE + Visita')
                    $hoja1->getStyle('J' . $fila)->applyFromArray($morado);

                if ($estudio['Dias'] < 2 && $estudio['Dias'] > -1)
                    $hoja1->getStyle('M' . $fila)->applyFromArray($verde);
                elseif ($estudio['Dias'] > 2)
                    $hoja1->getStyle('M' . $fila)->applyFromArray($rojo);
                elseif ($estudio['Dias'] == 2)
                    $hoja1->getStyle('M' . $fila)->applyFromArray($naranja);


                if ($estudio['Estatus'] == 'Ral en Proceso')
                    $hoja1->getStyle('N' . $fila)->applyFromArray($amarillo);
                if ($estudio['Estatus'] == 'Investigación en Proceso')
                    $hoja1->getStyle('N' . $fila)->applyFromArray($gris);
                if ($estudio['Estatus'] == 'Visita en Proceso')
                    $hoja1->getStyle('N' . $fila)->applyFromArray($azulFuerte);
                if ($estudio['Estatus'] == 'Finalizado')
                    $hoja1->getStyle('N' . $fila)->applyFromArray($azul);
                if ($estudio['Estatus'] == 'Cancelado')
                    $hoja1->getStyle('N' . $fila)->applyFromArray($rojo);
                if ($estudio['Estatus'] == 'Facturado')
                    $hoja1->getStyle('N' . $fila)->applyFromArray($azulBajo);
                if ($estudio['Estatus'] == 'Visita Presencial en Proceso')
                    $hoja1->getStyle('N' . $fila)->applyFromArray($morado);

                if ($estudio['Viable'] == '0')
                    $hoja1->getStyle('Z' . $fila)->applyFromArray($verde);
                if ($estudio['Viable'] == 1)
                    $hoja1->getStyle('Z' . $fila)->applyFromArray($rojo);
                if ($estudio['Viable'] == 2)
                    $hoja1->getStyle('Z' . $fila)->applyFromArray($naranja);
                if ($estudio['Viable'] == 5)
                    $hoja1->getStyle('Z' . $fila)->applyFromArray($azul);

                if ($estudio['ESE'] != NULL && $estudio['ESE'] > 0) {
                    $hoja1->getStyle('G' . $fila)->applyFromArray($azulFuerte);
                    array_push($No_ESE, $estudio['ESE']);
                }
                if ($estudio['IL'] != NULL && $estudio['IL'] > 0) {
                    $hoja1->getStyle('G' . $fila)->applyFromArray($rojo);
                    array_push($No_IL, $estudio['IL']);
                }


                $fila++;
            }

            foreach ($rales as $estudio) {
                if (in_array($estudio['Folio'], $No_ESE) || in_array($estudio['Folio'], $No_IL))
                    $hoja1->getStyle('G' . $fila1)->applyFromArray($amarillo);
                $fila1++;
            }
            $fila = $fila - 1;

            $hoja1->getStyle('A2:AB' . $fila)->applyFromArray($estiloInformacion);
            $hoja1->getStyle('A2:C' . $fila)->applyFromArray($centrado);
            $hoja1->getStyle('K2:K' . $fila)->applyFromArray($centrado);
            $hoja1->getStyle('L2:N' . $fila)->applyFromArray($centrado);
            $hoja1->getStyle('A1:AB1')->applyFromArray($estiloTituloColumnas);
            ///////////////////////////////////////////////////////////

            $hoja2 = $documento->createSheet();
            $hoja2->setTitle('Ej. Cuenta');

            $hoja2->getColumnDimension('A')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(1, 1, 'Ejecutivo');

            $hoja2->getColumnDimension('B')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(2, 1, '# IL Finalizadas');

            $hoja2->getColumnDimension('C')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(3, 1, '# ESE Finalizados');

            $hoja2->getColumnDimension('D')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(4, 1, '# IL En Proceso');

            $hoja2->getColumnDimension('E')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(5, 1, '# ESE En Proceso');

            $hoja2->getColumnDimension('F')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(6, 1, '# IL TOTALES');

            $hoja2->getColumnDimension('G')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(7, 1, '# ESE TOTALES');

            $hoja2->getColumnDimension('H')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(8, 1, '# Servicios TOTALES');

            $fila = 2;
            foreach ($Ejecutivos_Cuenta as $ejecutivo) {
                $hoja2->setCellValueByColumnAndRow(1, $fila, $ejecutivo['Nombre']);
                $hoja2->setCellValueByColumnAndRow(2, $fila, $ejecutivo['No_INV_FIN']);
                $hoja2->setCellValueByColumnAndRow(3, $fila, $ejecutivo['No_ESE_FIN']);
                $hoja2->setCellValueByColumnAndRow(4, $fila, $ejecutivo['No_INV_Proc']);
                $hoja2->setCellValueByColumnAndRow(5, $fila, $ejecutivo['No_ESE_Proc']);
                $hoja2->setCellValueByColumnAndRow(6, $fila, $ejecutivo['No_INV_Total']);
                $hoja2->setCellValueByColumnAndRow(7, $fila, $ejecutivo['No_ESE_Total']);
                $hoja2->setCellValueByColumnAndRow(8, $fila, $ejecutivo['No_Total']);

                $fila++;
            }

            $fila = $fila - 1;

            $hoja2->getStyle('A1:H' . $fila)->applyFromArray($estiloInformacion);
            $hoja2->getStyle('A1:A' . $fila)->applyFromArray($izquierda);
            $hoja2->getStyle('B1:B' . $fila)->applyFromArray($derecha);
            $hoja2->getStyle('C1:C' . $fila)->applyFromArray($derecha);
            $hoja2->getStyle('D1:D' . $fila)->applyFromArray($derecha);
            $hoja2->getStyle('E1:E' . $fila)->applyFromArray($derecha);;
            $hoja2->getStyle('A1:H1')->applyFromArray($estiloTituloColumnas);


            $hoja3 = $documento->createSheet();
            $hoja3->setTitle('Ej. Logística');

            $hoja3->getColumnDimension('A')->setAutoSize(true);
            $hoja3->setCellValueByColumnAndRow(1, 1, 'Ejecutivo');

            $hoja3->getColumnDimension('B')->setAutoSize(true);
            $hoja3->setCellValueByColumnAndRow(2, 1, '# ESE Finalizados');

            $fila = 2;
            foreach ($Ejecutivos_Logistica as $ejecutivo) {
                $hoja3->setCellValueByColumnAndRow(1, $fila, $ejecutivo['Nombre']);
                $hoja3->setCellValueByColumnAndRow(2, $fila, $ejecutivo['No_ESE_FIN']);

                $fila++;
            }

            $fila = $fila - 1;

            $hoja3->getStyle('A1:B' . $fila)->applyFromArray($estiloInformacion);
            $hoja3->getStyle('A1:A' . $fila)->applyFromArray($izquierda);
            $hoja3->getStyle('B1:B' . $fila)->applyFromArray($derecha);
            $hoja3->getStyle('A1:B1')->applyFromArray($estiloTituloColumnas);


            $hoja4 = $documento->createSheet();
            $hoja4->setTitle('Clientes');

            $hoja4->getColumnDimension('A')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(1, 1, 'Cliente');

            $hoja4->getColumnDimension('B')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(2, 1, '# RAL Solicitados');

            $hoja4->getColumnDimension('C')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(3, 1, '# RAL Avanzados');

            $hoja4->getColumnDimension('D')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(4, 1, '# RAL Netos');

            $hoja4->getColumnDimension('E')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(5, 1, '# IL Finalizadas');

            $hoja4->getColumnDimension('F')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(6, 1, '# ESE Finalizados');

            $hoja4->getColumnDimension('G')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(7, 1, '# IL En Proceso');

            $hoja4->getColumnDimension('H')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(8, 1, '# ESE En Proceso');

            $hoja4->getColumnDimension('I')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(9, 1, '# IL TOTALES');

            $hoja4->getColumnDimension('J')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(10, 1, '# ESE TOTALES');

            $hoja4->getColumnDimension('K')->setAutoSize(true);
            $hoja4->setCellValueByColumnAndRow(11, 1, '# Servicios TOTALES');

            $fila = 2;
            foreach ($Clientes_Servicios as $cliente) {
                $hoja4->setCellValueByColumnAndRow(1, $fila, $cliente['Nombre_Cliente']);
                $hoja4->setCellValueByColumnAndRow(2, $fila, $cliente['No_RAL_Brutos']);
                $hoja4->setCellValueByColumnAndRow(3, $fila, $cliente['No_RAL_Avanzados']);
                $hoja4->setCellValueByColumnAndRow(4, $fila, $cliente['No_RAL_Netos']);
                $hoja4->setCellValueByColumnAndRow(5, $fila, $cliente['No_INV_FIN']);
                $hoja4->setCellValueByColumnAndRow(6, $fila, $cliente['No_ESE_FIN']);
                $hoja4->setCellValueByColumnAndRow(7, $fila, $cliente['No_INV_Proc']);
                $hoja4->setCellValueByColumnAndRow(8, $fila, $cliente['No_ESE_Proc']);
                $hoja4->setCellValueByColumnAndRow(9, $fila, $cliente['No_INV_Total']);
                $hoja4->setCellValueByColumnAndRow(10, $fila, $cliente['No_ESE_Total']);
                $hoja4->setCellValueByColumnAndRow(11, $fila, $cliente['No_Servicios']);

                $fila++;
            }

            $fila = $fila - 1;

            $hoja4->getStyle('A1:K' . $fila)->applyFromArray($estiloInformacion);
            $hoja4->getStyle('A1:A' . $fila)->applyFromArray($izquierda);
            $hoja4->getStyle('B1:B' . $fila)->applyFromArray($derecha);
            $hoja4->getStyle('C1:C' . $fila)->applyFromArray($derecha);
            $hoja4->getStyle('D1:D' . $fila)->applyFromArray($derecha);
            $hoja4->getStyle('E1:E' . $fila)->applyFromArray($derecha);
            $hoja4->getStyle('A1:K1')->applyFromArray($estiloTituloColumnas);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Reporte de Operaciones del ' . $start_date . ' al ' . $end_date . '.xlsx"');
            header('Cache-Control: max-age=0');

            unset($_SESSION['start_date_excel']);
            unset($_SESSION['end_date_excel']);
            unset($_SESSION['estudios_excel']);

            $writer = new WriterXlsx($documento);

            $writer->save('php://output');
            exit();
        }
    }

    public function detallado_anual()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager())) {
            $Anio = isset($_GET['anio']) ? $_GET['anio'] : date('Y');
            $candidato = new Candidatos();
            $candidato->setFecha_solicitud($Anio);

            $clientes = $candidato->getDetallePorAnio();

            $documento = new Spreadsheet();
            $documento
                ->getProperties()
                ->setCreator('RRHH Ingenia')
                ->setLastModifiedBy($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name)
                ->setTitle('Detallado anual SA')
                ->setDescription('RRHH Ingenia | Detallado anual SA');

            $hoja = $documento->getActiveSheet();
            $hoja->setTitle($Anio);

            $estiloTituloReporte = array(
                'font' => array(
                    'bold'      => true,
                    'italic'    => false,
                    'strike'    => false,
                    'size' => 13
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => Border::BORDER_NONE
                    )
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'bold'  => true,
                    'size' => 13,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('rgb' => 'A6C44A')
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );

            $estiloInformacion = array(
                'font' => array(
                    'size' => 10
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            );

            $estiloContornoRemarcado = array(
                'borders' => array(
                    'outline' => array(
                        'borderStyle' => Border::BORDER_THICK,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            );

            $izquierda = array(
                'aligment' => array(
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $centrado = array(
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );

            $derecha = array(
                'aligment' => array(
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $azulFuerte = array(
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '33364F'
                    ),
                    'endColor' => array(
                        'rgb' => 'FFFFFF'
                    )
                )

            );
            $rojo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'B80C09'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $amarillo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'F8C630'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $beige = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'FFEEBA'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $gris = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '6C757D'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $azul = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '007BFF'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $azulBajo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'BEE5EB'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $verde = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'A6C44A'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $naranja = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'F28322'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $morado = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '6F42C1'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );

            $hoja->getColumnDimension('A')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(1, 1, 'Cliente');

            $hoja->getColumnDimension('B')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(2, 1, 'Plaza');

            $hoja->getColumnDimension('C')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(3, 1, '$ RAL');

            $hoja->getColumnDimension('D')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(4, 1, '$ IL');

            $hoja->getColumnDimension('E')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(5, 1, '$ ESE');

            $hoja->getColumnDimension('F')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(6, 1, 'ENE');

            $hoja->getColumnDimension('K')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(11, 1, 'FEB');

            $hoja->getColumnDimension('P')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(16, 1, 'Marzo');

            $hoja->getColumnDimension('U')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(21, 1, 'Abril');

            $hoja->getColumnDimension('Z')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(26, 1, 'Mayo');

            $hoja->getColumnDimension('AE')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(31, 1, 'Junio');

            $hoja->getColumnDimension('AJ')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(36, 1, 'Julio');

            $hoja->getColumnDimension('AO')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(41, 1, 'Agosto');

            $hoja->getColumnDimension('AT')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(46, 1, 'Septiembre');

            $hoja->getColumnDimension('AY')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(51, 1, 'Octubre');

            $hoja->getColumnDimension('BD')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(56, 1, 'Noviembre');

            $hoja->getColumnDimension('BI')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(61, 1, 'Diciembre');

            /** ENERO */
            $hoja->getColumnDimension('F')->setAutoSize(false);
            $hoja->getColumnDimension('F')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(6, 2, '  RS');

            $hoja->getColumnDimension('G')->setAutoSize(false);
            $hoja->getColumnDimension('G')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(7, 2, '  RA');

            $hoja->getColumnDimension('H')->setAutoSize(false);
            $hoja->getColumnDimension('H')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(8, 2, '  RN');

            $hoja->getColumnDimension('I')->setAutoSize(false);
            $hoja->getColumnDimension('I')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(9, 2, '  IL');

            $hoja->getColumnDimension('J')->setAutoSize(false);
            $hoja->getColumnDimension('J')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(10, 2, '  ESE ');

            /** FEBRERO */
            $hoja->getColumnDimension('K')->setAutoSize(false);
            $hoja->getColumnDimension('K')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(11, 2, '  RS');

            $hoja->getColumnDimension('L')->setAutoSize(false);
            $hoja->getColumnDimension('L')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(12, 2, '  RA');

            $hoja->getColumnDimension('M')->setAutoSize(false);
            $hoja->getColumnDimension('M')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(13, 2, '  RN');

            $hoja->getColumnDimension('N')->setAutoSize(false);
            $hoja->getColumnDimension('N')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(14, 2, '  IL');

            $hoja->getColumnDimension('O')->setAutoSize(false);
            $hoja->getColumnDimension('O')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(15, 2, '  ESE ');

            /** MARZO */
            $hoja->getColumnDimension('P')->setAutoSize(false);
            $hoja->getColumnDimension('P')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(16, 2, '  RS');

            $hoja->getColumnDimension('Q')->setAutoSize(false);
            $hoja->getColumnDimension('Q')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(17, 2, '  RA');

            $hoja->getColumnDimension('R')->setAutoSize(false);
            $hoja->getColumnDimension('R')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(18, 2, '  RN');

            $hoja->getColumnDimension('S')->setAutoSize(false);
            $hoja->getColumnDimension('S')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(19, 2, '  IL');

            $hoja->getColumnDimension('T')->setAutoSize(false);
            $hoja->getColumnDimension('T')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(20, 2, '  ESE ');

            /** ABRIL */
            $hoja->getColumnDimension('U')->setAutoSize(false);
            $hoja->getColumnDimension('U')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(21, 2, '  RS');

            $hoja->getColumnDimension('V')->setAutoSize(false);
            $hoja->getColumnDimension('V')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(22, 2, '  RA');

            $hoja->getColumnDimension('W')->setAutoSize(false);
            $hoja->getColumnDimension('W')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(23, 2, '  RN');

            $hoja->getColumnDimension('X')->setAutoSize(false);
            $hoja->getColumnDimension('X')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(24, 2, '  IL');

            $hoja->getColumnDimension('Y')->setAutoSize(false);
            $hoja->getColumnDimension('Y')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(25, 2, '  ESE ');

            /** MAYO */
            $hoja->getColumnDimension('Z')->setAutoSize(false);
            $hoja->getColumnDimension('Z')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(26, 2, '  RS');

            $hoja->getColumnDimension('AA')->setAutoSize(false);
            $hoja->getColumnDimension('AA')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(27, 2, '  RA');

            $hoja->getColumnDimension('AB')->setAutoSize(false);
            $hoja->getColumnDimension('AB')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(28, 2, '  RN');

            $hoja->getColumnDimension('AC')->setAutoSize(false);
            $hoja->getColumnDimension('AC')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(29, 2, '  IL');

            $hoja->getColumnDimension('AD')->setAutoSize(false);
            $hoja->getColumnDimension('AD')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(30, 2, '  ESE ');

            /** JUNIO */
            $hoja->getColumnDimension('AE')->setAutoSize(false);
            $hoja->getColumnDimension('AE')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(31, 2, '  RS');

            $hoja->getColumnDimension('AF')->setAutoSize(false);
            $hoja->getColumnDimension('AF')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(32, 2, '  RA');

            $hoja->getColumnDimension('AG')->setAutoSize(false);
            $hoja->getColumnDimension('AG')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(33, 2, '  RN');

            $hoja->getColumnDimension('AH')->setAutoSize(false);
            $hoja->getColumnDimension('AH')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(34, 2, '  IL');

            $hoja->getColumnDimension('AI')->setAutoSize(false);
            $hoja->getColumnDimension('AI')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(35, 2, '  ESE ');

            /** JULIO */
            $hoja->getColumnDimension('AJ')->setAutoSize(false);
            $hoja->getColumnDimension('AJ')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(36, 2, '  RS');

            $hoja->getColumnDimension('AK')->setAutoSize(false);
            $hoja->getColumnDimension('AK')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(37, 2, '  RA');

            $hoja->getColumnDimension('AL')->setAutoSize(false);
            $hoja->getColumnDimension('AL')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(38, 2, '  RN');

            $hoja->getColumnDimension('AM')->setAutoSize(false);
            $hoja->getColumnDimension('AM')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(39, 2, '  IL');

            $hoja->getColumnDimension('AN')->setAutoSize(false);
            $hoja->getColumnDimension('AN')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(40, 2, '  ESE ');

            /** AGOSTO */
            $hoja->getColumnDimension('AO')->setAutoSize(false);
            $hoja->getColumnDimension('AO')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(41, 2, '  RS');

            $hoja->getColumnDimension('AP')->setAutoSize(false);
            $hoja->getColumnDimension('AP')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(42, 2, '  RA');

            $hoja->getColumnDimension('AQ')->setAutoSize(false);
            $hoja->getColumnDimension('AQ')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(43, 2, '  RN');

            $hoja->getColumnDimension('AR')->setAutoSize(false);
            $hoja->getColumnDimension('AR')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(44, 2, '  IL');

            $hoja->getColumnDimension('AS')->setAutoSize(false);
            $hoja->getColumnDimension('AS')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(45, 2, '  ESE ');

            /** SEPTIEMBRE */
            $hoja->getColumnDimension('AT')->setAutoSize(false);
            $hoja->getColumnDimension('AT')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(46, 2, '  RS');

            $hoja->getColumnDimension('AU')->setAutoSize(false);
            $hoja->getColumnDimension('AU')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(47, 2, '  RA');

            $hoja->getColumnDimension('AV')->setAutoSize(false);
            $hoja->getColumnDimension('AV')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(48, 2, '  RN');

            $hoja->getColumnDimension('AW')->setAutoSize(false);
            $hoja->getColumnDimension('AW')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(49, 2, '  IL');

            $hoja->getColumnDimension('AX')->setAutoSize(false);
            $hoja->getColumnDimension('AX')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(50, 2, '  ESE ');

            /** OCTUBRE */
            $hoja->getColumnDimension('AY')->setAutoSize(false);
            $hoja->getColumnDimension('AY')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(51, 2, '  RS');

            $hoja->getColumnDimension('AZ')->setAutoSize(false);
            $hoja->getColumnDimension('AZ')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(52, 2, '  RA');

            $hoja->getColumnDimension('BA')->setAutoSize(false);
            $hoja->getColumnDimension('BA')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(53, 2, '  RN');

            $hoja->getColumnDimension('BB')->setAutoSize(false);
            $hoja->getColumnDimension('BB')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(54, 2, '  IL');

            $hoja->getColumnDimension('BC')->setAutoSize(false);
            $hoja->getColumnDimension('BC')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(55, 2, '  ESE ');

            /** NOVIEMBRE */
            $hoja->getColumnDimension('BD')->setAutoSize(false);
            $hoja->getColumnDimension('BD')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(56, 2, '  RS');

            $hoja->getColumnDimension('BE')->setAutoSize(false);
            $hoja->getColumnDimension('BE')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(57, 2, '  RA');

            $hoja->getColumnDimension('BF')->setAutoSize(false);
            $hoja->getColumnDimension('BF')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(58, 2, '  RN');

            $hoja->getColumnDimension('BG')->setAutoSize(false);
            $hoja->getColumnDimension('BG')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(59, 2, '  IL');

            $hoja->getColumnDimension('BH')->setAutoSize(false);
            $hoja->getColumnDimension('BH')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(60, 2, '  ESE ');

            /** DICIEMBRE */
            $hoja->getColumnDimension('BI')->setAutoSize(false);
            $hoja->getColumnDimension('BI')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(61, 2, '  RS');

            $hoja->getColumnDimension('BJ')->setAutoSize(false);
            $hoja->getColumnDimension('BJ')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(62, 2, '  RA');

            $hoja->getColumnDimension('BK')->setAutoSize(false);
            $hoja->getColumnDimension('BK')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(63, 2, '  RN');

            $hoja->getColumnDimension('BL')->setAutoSize(false);
            $hoja->getColumnDimension('BL')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(64, 2, '  IL');

            $hoja->getColumnDimension('BM')->setAutoSize(false);
            $hoja->getColumnDimension('BM')->setWidth(5);
            $hoja->setCellValueByColumnAndRow(65, 2, '  ESE ');

            $fila = 3;
            $fila1 = $fila;
            /* $ejecutivos = [];
            $Clientes = []; */
            $No_IL = [];
            $No_ESE = [];
            foreach ($clientes as $cliente) {
                $hoja->setCellValueByColumnAndRow(1, $fila, $cliente['Nombre_Cliente']);
                $hoja->setCellValueByColumnAndRow(2, $fila, $cliente['Centro_Costos']);
                $hoja->setCellValueByColumnAndRow(3, $fila, $cliente['RAL']);
                $hoja->setCellValueByColumnAndRow(4, $fila, $cliente['Investigacion_L']);
                $hoja->setCellValueByColumnAndRow(5, $fila, $cliente['ESE']);
                $hoja->setCellValueByColumnAndRow(6, $fila, $cliente['No_RAL_Brutos_Ene']);
                $hoja->setCellValueByColumnAndRow(7, $fila, $cliente['No_RAL_Avanzados_Ene']);
                $hoja->setCellValueByColumnAndRow(8, $fila, $cliente['No_RAL_Netos_Ene']);
                $hoja->setCellValueByColumnAndRow(9, $fila, $cliente['No_INV_FIN_Ene']);
                $hoja->setCellValueByColumnAndRow(10, $fila, $cliente['No_ESE_FIN_Ene']);

                $hoja->setCellValueByColumnAndRow(11, $fila, $cliente['No_RAL_Brutos_Feb']);
                $hoja->setCellValueByColumnAndRow(12, $fila, $cliente['No_RAL_Avanzados_Feb']);
                $hoja->setCellValueByColumnAndRow(13, $fila, $cliente['No_RAL_Netos_Feb']);
                $hoja->setCellValueByColumnAndRow(14, $fila, $cliente['No_INV_FIN_Feb']);
                $hoja->setCellValueByColumnAndRow(15, $fila, $cliente['No_ESE_FIN_Feb']);

                $hoja->setCellValueByColumnAndRow(16, $fila, $cliente['No_RAL_Brutos_Mar']);
                $hoja->setCellValueByColumnAndRow(17, $fila, $cliente['No_RAL_Avanzados_Mar']);
                $hoja->setCellValueByColumnAndRow(18, $fila, $cliente['No_RAL_Netos_Mar']);
                $hoja->setCellValueByColumnAndRow(19, $fila, $cliente['No_INV_FIN_Mar']);
                $hoja->setCellValueByColumnAndRow(20, $fila, $cliente['No_ESE_FIN_Mar']);

                $hoja->setCellValueByColumnAndRow(21, $fila, $cliente['No_RAL_Brutos_Abr']);
                $hoja->setCellValueByColumnAndRow(22, $fila, $cliente['No_RAL_Avanzados_Abr']);
                $hoja->setCellValueByColumnAndRow(23, $fila, $cliente['No_RAL_Netos_Abr']);
                $hoja->setCellValueByColumnAndRow(24, $fila, $cliente['No_INV_FIN_Abr']);
                $hoja->setCellValueByColumnAndRow(25, $fila, $cliente['No_ESE_FIN_Abr']);

                $hoja->setCellValueByColumnAndRow(26, $fila, $cliente['No_RAL_Brutos_May']);
                $hoja->setCellValueByColumnAndRow(27, $fila, $cliente['No_RAL_Avanzados_May']);
                $hoja->setCellValueByColumnAndRow(28, $fila, $cliente['No_RAL_Netos_May']);
                $hoja->setCellValueByColumnAndRow(29, $fila, $cliente['No_INV_FIN_May']);
                $hoja->setCellValueByColumnAndRow(30, $fila, $cliente['No_ESE_FIN_May']);

                $hoja->setCellValueByColumnAndRow(31, $fila, $cliente['No_RAL_Brutos_Jun']);
                $hoja->setCellValueByColumnAndRow(32, $fila, $cliente['No_RAL_Avanzados_Jun']);
                $hoja->setCellValueByColumnAndRow(33, $fila, $cliente['No_RAL_Netos_Jun']);
                $hoja->setCellValueByColumnAndRow(34, $fila, $cliente['No_INV_FIN_Jun']);
                $hoja->setCellValueByColumnAndRow(35, $fila, $cliente['No_ESE_FIN_Jun']);

                $hoja->setCellValueByColumnAndRow(36, $fila, $cliente['No_RAL_Brutos_Jul']);
                $hoja->setCellValueByColumnAndRow(37, $fila, $cliente['No_RAL_Avanzados_Jul']);
                $hoja->setCellValueByColumnAndRow(38, $fila, $cliente['No_RAL_Netos_Jul']);
                $hoja->setCellValueByColumnAndRow(39, $fila, $cliente['No_INV_FIN_Jul']);
                $hoja->setCellValueByColumnAndRow(40, $fila, $cliente['No_ESE_FIN_Jul']);

                $hoja->setCellValueByColumnAndRow(41, $fila, $cliente['No_RAL_Brutos_Ago']);
                $hoja->setCellValueByColumnAndRow(42, $fila, $cliente['No_RAL_Avanzados_Ago']);
                $hoja->setCellValueByColumnAndRow(43, $fila, $cliente['No_RAL_Netos_Ago']);
                $hoja->setCellValueByColumnAndRow(44, $fila, $cliente['No_INV_FIN_Ago']);
                $hoja->setCellValueByColumnAndRow(45, $fila, $cliente['No_ESE_FIN_Ago']);

                $hoja->setCellValueByColumnAndRow(46, $fila, $cliente['No_RAL_Brutos_Sep']);
                $hoja->setCellValueByColumnAndRow(47, $fila, $cliente['No_RAL_Avanzados_Sep']);
                $hoja->setCellValueByColumnAndRow(48, $fila, $cliente['No_RAL_Netos_Sep']);
                $hoja->setCellValueByColumnAndRow(49, $fila, $cliente['No_INV_FIN_Sep']);
                $hoja->setCellValueByColumnAndRow(50, $fila, $cliente['No_ESE_FIN_Sep']);

                $hoja->setCellValueByColumnAndRow(51, $fila, $cliente['No_RAL_Brutos_Oct']);
                $hoja->setCellValueByColumnAndRow(52, $fila, $cliente['No_RAL_Avanzados_Oct']);
                $hoja->setCellValueByColumnAndRow(53, $fila, $cliente['No_RAL_Netos_Oct']);
                $hoja->setCellValueByColumnAndRow(54, $fila, $cliente['No_INV_FIN_Oct']);
                $hoja->setCellValueByColumnAndRow(55, $fila, $cliente['No_ESE_FIN_Oct']);

                $hoja->setCellValueByColumnAndRow(56, $fila, $cliente['No_RAL_Brutos_Nov']);
                $hoja->setCellValueByColumnAndRow(57, $fila, $cliente['No_RAL_Avanzados_Nov']);
                $hoja->setCellValueByColumnAndRow(58, $fila, $cliente['No_RAL_Netos_Nov']);
                $hoja->setCellValueByColumnAndRow(59, $fila, $cliente['No_INV_FIN_Nov']);
                $hoja->setCellValueByColumnAndRow(60, $fila, $cliente['No_ESE_FIN_Nov']);

                $hoja->setCellValueByColumnAndRow(61, $fila, $cliente['No_RAL_Brutos_Dic']);
                $hoja->setCellValueByColumnAndRow(62, $fila, $cliente['No_RAL_Avanzados_Dic']);
                $hoja->setCellValueByColumnAndRow(63, $fila, $cliente['No_RAL_Netos_Dic']);
                $hoja->setCellValueByColumnAndRow(64, $fila, $cliente['No_INV_FIN_Dic']);
                $hoja->setCellValueByColumnAndRow(65, $fila, $cliente['No_ESE_FIN_Dic']);

                $fila++;
            }

            $fila = $fila - 1;

            $hoja->mergeCells('A1:A2');
            $hoja->mergeCells('B1:B2');
            $hoja->mergeCells('C1:C2');
            $hoja->mergeCells('D1:D2');
            $hoja->mergeCells('E1:E2');
            $hoja->mergeCells('F1:J1');
            $hoja->mergeCells('K1:O1');
            $hoja->mergeCells('P1:T1');
            $hoja->mergeCells('U1:Y1');
            $hoja->mergeCells('Z1:AD1');
            $hoja->mergeCells('AE1:AI1');
            $hoja->mergeCells('AJ1:AN1');
            $hoja->mergeCells('AO1:AS1');
            $hoja->mergeCells('AT1:AX1');
            $hoja->mergeCells('AY1:BC1');
            $hoja->mergeCells('BD1:BH1');
            $hoja->mergeCells('BI1:BM1');

            $hoja->freezePane('F1');

            $hoja->getStyle('A3:BM' . $fila)->applyFromArray($estiloInformacion);
            $hoja->getStyle('B3:B' . $fila)->applyFromArray($centrado);
            $hoja->getStyle('C3:BM' . $fila)->applyFromArray($derecha);
            $hoja->getStyle('A1:E2')->applyFromArray($estiloTituloReporte);
            $hoja->getStyle('F1:BM1')->applyFromArray($estiloTituloReporte);
            $hoja->getStyle('F2:BM2')->applyFromArray($estiloTituloColumnas);
            $hoja->getStyle('F1:J' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('K1:O' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('P1:T' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('U1:Y' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('Z1:AD' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('AE1:AI' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('AJ1:AN' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('AO1:AS' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('AT1:AX' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('AY1:BC' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('BD1:BH' . $fila)->applyFromArray($estiloContornoRemarcado);
            $hoja->getStyle('BI1:BM' . $fila)->applyFromArray($estiloContornoRemarcado);

            $hoja2 = $documento->createSheet();
            $hoja2->setTitle('Clientes Sin servicios');

            $hoja2->getColumnDimension('A')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(1, 1, 'Cliente');


            $candidato = new Candidatos();
            $candidato->setFecha_solicitud($Anio);
            $clientes = $candidato->getDetallePorAnioClienteSinServicio();
            $fila = 2;

            foreach ($clientes as $cliente) {
                $hoja2->setCellValueByColumnAndRow(1, $fila, $cliente['Nombre_Cliente']);
                $fila++;
            }

            $hoja3 = $documento->createSheet();
            $hoja3->setTitle('Clientes de cortesia');

            $hoja3->getColumnDimension('A')->setAutoSize(true);
            $hoja3->setCellValueByColumnAndRow(1, 1, 'Cliente');


            $candidato = new Candidatos();
            $candidato->setFecha_solicitud($Anio);
            $clientes = $candidato->getDetallePorAnioCortesias();
            $fila = 2;

            foreach ($clientes as $cliente) {
                $hoja3->setCellValueByColumnAndRow(1, $fila, $cliente['Nombre_Cliente']);
                $fila++;
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Detallado de Operaciones ' . $Anio . '.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new WriterXlsx($documento);

            $writer->save('php://output');
            exit();
        }
    }



    public function layout_candidatos()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomerSA())) {

            $documento = new Spreadsheet();
            $documento
                ->getProperties()
                ->setCreator('RRHH Ingenia')
                ->setTitle('Layout SA')
                ->setDescription('RRHH Ingenia | Layout SA');

            $hoja = $documento->getActiveSheet();
            $hoja->setTitle('Layout');

            $estiloTituloReporte = array(
                'font' => array(
                    'bold'      => true,
                    'italic'    => false,
                    'strike'    => false,
                    'size' => 13
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => Border::BORDER_NONE
                    )
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'bold'  => true,
                    'size' => 12,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('rgb' => 'A6C44A')
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );

            $estiloInformacion = array(
                'font' => array(
                    'size' => 8
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            );

            $izquierda = array(
                'aligment' => array(
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $centrado = array(
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );

            $derecha = array(
                'aligment' => array(
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $azulFuerte = array(
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '33364F'
                    ),
                    'endColor' => array(
                        'rgb' => 'FFFFFF'
                    )
                )

            );
            $rojo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'B80C09'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $amarillo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'F8C630'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $beige = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'FFEEBA'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $gris = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '6C757D'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $azul = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '007BFF'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $azulBajo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'BEE5EB'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $verde = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'A6C44A'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $naranja = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'F28322'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $morado = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '6F42C1'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );

            $estadosMX = Utils::showEstadosMX();
            $clientes = !Utils::isCustomerSA() ? Utils::showClientes() : Utils::showClientesPorUsuario();

            $hoja1 = $documento->createSheet();
            $hoja1->setTitle('Valores');

            for ($i = 0; $i < count($estadosMX); $i++) {
                $hoja1->setCellValue('A' . ($i + 1), $estadosMX[$i]['Descripcion']);
            }

            //$razon = new RazonesSociales();
            $razon = new RazonesSocialesEmpresa();
            $razones = !Utils::isCustomerSA() ? $razon->getAll() : Utils::showRazonesPorUsuario();
            //$razonColumn = array();
            //$count = 1;
            /* $formulaRazon = '';
            for ($i=0; $i < count($clientes); $i++) { 
                
                $razon->setID_Cliente($clientes[$i]['Cliente']);
                $razones = $razon->getRazonesSocialesPorCliente();
                $clientes[$i]['razones'] = array_column($razones, 'Razon');
                $hoja1->setCellValue('B'.($i + 1), $clientes[$i]['Nombre_Cliente']);

                if ($i == 0)
                    $formulaRazon = '=SI(' . $clientes[$i]['Nombre_Cliente'] . ',{"' . implode('","', $clientes[$i]['razones']) . '"}';
                else
                    $formulaRazon .= ',SI(' . $clientes[$i]['Nombre_Cliente'] . ',{"' . implode('","', $clientes[$i]['razones']) . '"},"")';

            }
            $formulaRazon .= ')'; */


            //$formula = "=IF(A2=\"";
            foreach ($clientes as $i => $cliente) {
                //$razon->setID_Cliente($cliente['Cliente']);
                //$razones = array_column($razon->getRazonesSocialesPorCliente(), 'Razon');
                $hoja1->setCellValue('B' . ($i + 1), $clientes[$i]['Nombre_Cliente']);

                /* $aux = $count;
                for ($j=0; $j < count($razones); $j++) { 
                    $hoja1->setCellValue('C'.($count), $razones[$j]);
                    $count++;
                }

                $formula .= $cliente['Nombre_Cliente'] . "\",\"";
                $formula .= "\",\"". 'C'.$aux.':C' . $count . "\"";
                if ($i < count($clientes) - 1) {
                    $formula .= ",";
                } else {
                    $formula .= ",";
                    $formula .= "\"\"";
                }
                $formula .= ",IF(A2=\""; */
            }

            /* for ($i = 0; $i < count($clientes); $i++) {
                $formula .= ")";
            } */
            foreach ($razones as $i => $razon) {
                $hoja1->setCellValue('C' . ($i + 1), $razones[$i]['Razon']);
            }
            $hoja1->setCellValue('D1', 'LABORAL (RAL + IL)');
            $hoja1->setCellValue('D2', 'Estudio Socioeconómico (RAL + IL + VD)');

            $hoja1->setCellValue('E1', 'Operativo');
            $hoja1->setCellValue('E2', 'Administrativo');
            $hoja1->setCellValue('E3', 'Gerencial');

            $hoja1->setSheetState(Worksheet::SHEETSTATE_HIDDEN);


            //$lista = new \PhpOffice\PhpSpreadsheet\Cell\DataValidation();
            for ($j = 2; $j < 100; $j++) {
                $listaServicio = $hoja->getDataValidation('D' . $j);
                $listaServicio->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                $listaServicio->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
                $listaServicio->setAllowBlank(false);
                $listaServicio->setShowInputMessage(true);
                $listaServicio->setShowErrorMessage(true);
                $listaServicio->setShowDropDown(true);
                $listaServicio->setErrorTitle('Error');
                $listaServicio->setError('El servicio no está en la lista.');
                $listaServicio->setPromptTitle('Seleccione un servicio');
                $listaServicio->setPrompt('Seleccione un servicio de la lista.');
                $listaServicio->setFormula1('\'Valores\'!$D$1:$D$2');

                $listaEdo = $hoja->getDataValidation('E' . $j);
                $listaEdo->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                $listaEdo->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
                $listaEdo->setAllowBlank(false);
                $listaEdo->setShowInputMessage(true);
                $listaEdo->setShowErrorMessage(true);
                $listaEdo->setShowDropDown(true);
                $listaEdo->setErrorTitle('Error');
                $listaEdo->setError('El estado no está en la lista.');
                $listaEdo->setPromptTitle('Seleccione un estado');
                $listaEdo->setPrompt('Seleccione un estado de la lista.');
                $listaEdo->setFormula1('\'Valores\'!$A$1:$A$' . count($estadosMX));

                $listaCliente = $hoja->getDataValidation('M' . $j);
                $listaCliente->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                $listaCliente->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
                $listaCliente->setAllowBlank(false);
                $listaCliente->setShowInputMessage(true);
                $listaCliente->setShowErrorMessage(true);
                $listaCliente->setShowDropDown(true);
                $listaCliente->setErrorTitle('Error');
                $listaCliente->setError('El nombre comercial no está en la lista.');
                $listaCliente->setPromptTitle('Seleccione un nombre comercial');
                $listaCliente->setPrompt('Seleccione un nombre comercial de la lista.');
                $listaCliente->setFormula1('\'Valores\'!$B$1:$B$' . count($clientes));

                $listaRazon = $hoja->getDataValidation('N' . $j);
                $listaRazon->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                $listaRazon->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
                $listaRazon->setAllowBlank(false);
                $listaRazon->setShowInputMessage(true);
                $listaRazon->setShowErrorMessage(true);
                $listaRazon->setShowDropDown(true);
                $listaRazon->setErrorTitle('Error');
                $listaRazon->setError('La razón social no está en la lista.');
                $listaRazon->setPromptTitle('Seleccione una razón social');
                $listaRazon->setPrompt('Seleccione una razón social de la lista.');
                $listaRazon->setFormula1('\'Valores\'!$C$1:$C$' . count($razones));

                $listaNivel = $hoja->getDataValidation('P' . $j);
                $listaNivel->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
                $listaNivel->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
                $listaNivel->setAllowBlank(false);
                $listaNivel->setShowInputMessage(true);
                $listaNivel->setShowErrorMessage(true);
                $listaNivel->setShowDropDown(true);
                $listaNivel->setErrorTitle('Error');
                $listaNivel->setError('El nivel no está en la lista.');
                $listaNivel->setPromptTitle('Seleccione un nivel');
                $listaNivel->setPrompt('Seleccione un nivel de la lista.');
                $listaNivel->setFormula1('\'Valores\'!$E$1:$E$3');

                $hoja->getStyle('I' . $j)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
            }


            $hoja->getColumnDimension('A')->setWidth(20);
            $hoja->setCellValueByColumnAndRow(1, 1, 'Nombres');

            $hoja->getColumnDimension('B')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(2, 1, 'Apellido Paterno');

            $hoja->getColumnDimension('C')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(3, 1, 'Apellido Materno');

            $hoja->getColumnDimension('D')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(4, 1, 'Servicio Solicitado');

            $hoja->getColumnDimension('E')->setWidth(25);
            $hoja->setCellValueByColumnAndRow(5, 1, 'Estado MX');

            $hoja->getColumnDimension('F')->setWidth(20);
            $hoja->setCellValueByColumnAndRow(6, 1, 'Municipio');

            $hoja->getColumnDimension('G')->setWidth(20);
            $hoja->setCellValueByColumnAndRow(7, 1, 'CURP');

            $hoja->getColumnDimension('H')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(8, 1, 'Numero Seguridad Social');

            $hoja->getColumnDimension('I')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(9, 1, 'Fecha de Nacimiento');

            $hoja->getColumnDimension('J')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(10, 1, 'Lugar de Nacimiento');

            $hoja->getColumnDimension('K')->setWidth(15);
            $hoja->setCellValueByColumnAndRow(11, 1, 'Telefono');

            $hoja->getColumnDimension('L')->setWidth(30);
            $hoja->setCellValueByColumnAndRow(12, 1, 'Puesto');

            $hoja->getColumnDimension('M')->setWidth(30);
            $hoja->setCellValueByColumnAndRow(13, 1, 'Nombre Comercial');

            $hoja->getColumnDimension('N')->setWidth(50);
            $hoja->setCellValueByColumnAndRow(14, 1, 'Razón Social');

            $hoja->getColumnDimension('O')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(15, 1, 'Centro Costos');

            $hoja->getColumnDimension('P')->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow(16, 1, 'Nivel Organizacional');

            $hoja->getColumnDimension('Q')->setWidth(60);
            $hoja->setCellValueByColumnAndRow(17, 1, 'Comentarios');

            $fila = 2;

            $hoja->getStyle('A1:Q1')->applyFromArray($estiloTituloColumnas);

            header('Content-Type:  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Layout SA.xlsx"');
            header('Cache-Control: max-age=0');

            /* unset($_SESSION['start_date_excel']);
            unset($_SESSION['end_date_excel']);
            unset($_SESSION['estudios_excel']); */

            $writer = new WriterXlsx($documento);

            $writer->save('php://output');
            exit();
        }
    }

    public function cargaSA()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isCustomer() || Utils::isCustomerSA() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager())) {
            $excel = isset($_FILES['excel']) && $_FILES['excel']['tmp_name'] != '' ? $_FILES['excel']['tmp_name'] : FALSE;

            $spreadsheet = IOFactory::load($excel);
            $worksheet = $spreadsheet->getActiveSheet();

            $numRows = $worksheet->getHighestRow();
            $numCols = $worksheet->getHighestColumn();

            $columnNames = array();
            $sendData = array();
            for ($row = 1; $row <= $numRows; $row++) {
                $data = array();
                $i = 0;
                for ($col = 'A'; $col <= $numCols; $col++) {
                    if ($row > 1)
                        $data[$columnNames[$i]] = $worksheet->getCell($col . $row)->getValue() != null ? $worksheet->getCell($col . $row)->getValue() : '';
                    else
                        $columnNames[] = str_replace(' ', '_', $worksheet->getCell($col . $row)->getValue());
                    $i++;
                }
                if ($row > 1 && $data['Nombres'] != null)
                    $sendData[] = $data;
            }

            $estadosMX = Utils::showEstadosMX();
            $clientes = !Utils::isCustomerSA() ? Utils::showClientes() : Utils::showClientesPorUsuario();
            $Servicios_Solicitados = array(array('Servicio' => 'LABORAL (RAL + IL)', 'id' => 231), array('Servicio' => 'Estudio Socioeconómico (RAL + IL + VD)', 'id' => 230));
            $Nivel = array(array('Nivel' => 'Operativo', 'id' => 1), array('Nivel' => 'Administrativo', 'id' => 2), array('Nivel' => 'Gerencial', 'id' => 3));

            $razon = new RazonesSociales();
            for ($i = 0; $i < count($sendData); $i++) {
                for ($j = 0; $j < count($clientes); $j++) {
                    if ($sendData[$i]['Nombre_Comercial'] == $clientes[$j]['Nombre_Cliente']) {
                        $razon->setID_Cliente($clientes[$j]['Cliente']);
                        $razones = array_column($razon->getRazonesSocialesPorCliente(), 'Razon');
                        $sendData[$i]['Razones'] = $razones;

                        $ejecutivo = new EjecutivosPlazas();
                        $ejecutivo->setID_Cliente($clientes[$j]['Cliente']);
                        $ejecutivos = array_column($ejecutivo->getEjecutivosPorCliente(), 'username');
                        $sendData[$i]['Ejecutivos'] = $ejecutivos;
                    }
                }
            }

            echo json_encode(array(
                "data" => ($sendData),
                'EstadosMX' => $estadosMX,
                'Clientes' => $clientes,
                'Servicio_Solicitado' => $Servicios_Solicitados,
                'Nivel' => $Nivel
            ),  \JSON_UNESCAPED_UNICODE);
        }
    }

    //RH
    public function employeesinformation()
    {
        $status = Encryption::decode($_GET['status']) ? Encryption::decode($_GET['status']) : 0;
        $title = $status == 0 ? 'Reporte De Exmpleados' : 'Reporte De Empleados';

        $contactoEmpresa = new ContactosEmpresa();
        $contactoEmpresa->setUsuario($_SESSION['identity']->username);
        $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
        $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

        $employee = new Employees();
        $employee->setCliente($_SESSION['id_cliente']);
        $employee->setStatus($status);
        $employees = $employee->getEmployeesAllInformationByCliente();

        //var_dump($employees);die();


        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator('RRHH Ingenia')
            ->setLastModifiedBy($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name)
            ->setTitle($title)
            ->setDescription('RRHH Ingenia | Reporte de empleados');
        $hoja = $documento->getActiveSheet();

        $estiloTituloReporte = array(
            'font' => array(
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' => 13
            ),
            'fill' => array(
                'fillType'  => Fill::FILL_SOLID
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => Border::BORDER_NONE
                )
            ),
            'alignment' => array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            )
        );


        //$hoja->getStyle('A1:A1')->applyFromArray($estiloTituloReporte);

        $hoja->setTitle($title);

        $row = 1;
        $arrayColumns = array(
            array('pColumn' => 'A', 'row' => $row, 'value' => 'No.Empleado'),
            array('pColumn' => 'B', 'row' => $row, 'value' => 'Nombre'),
            array('pColumn' => 'C', 'row' => $row, 'value' => 'Puesto'),
            array('pColumn' => 'D', 'row' => $row, 'value' => 'Puesto a reportar'),
            array('pColumn' => 'E', 'row' => $row, 'value' => 'Departamento'),
            array('pColumn' => 'F', 'row' => $row, 'value' => 'Sexo'),
            array('pColumn' => 'G', 'row' => $row, 'value' => 'Fecha de ingreso'),
            array('pColumn' => 'H', 'row' => $row, 'value' => 'Antigüedad años'),
            array('pColumn' => 'I', 'row' => $row, 'value' => 'Fecha último movimiento'),
            array('pColumn' => 'J', 'row' => $row, 'value' => 'Fecha último ajuste salarial'),
            array('pColumn' => 'K', 'row' => $row, 'value' => 'Último ajuste salarial'),
            array('pColumn' => 'L', 'row' => $row, 'value' => 'Fecha de nacimiento'),
            array('pColumn' => 'M', 'row' => $row, 'value' => 'Edad'),
            array('pColumn' => 'N', 'row' => $row, 'value' => 'NSS'),
            array('pColumn' => 'O', 'row' => $row, 'value' => 'RFC'),
            array('pColumn' => 'P', 'row' => $row, 'value' => 'CURP'),
            array('pColumn' => 'W', 'row' => $row, 'value' => 'Correo electrónico personal'),
            array('pColumn' => 'R', 'row' => $row, 'value' => 'Correo electrónico empresarial'),
            array('pColumn' => 'S', 'row' => $row, 'value' => 'Telefono 1'),
            array('pColumn' => 'T', 'row' => $row, 'value' => 'Telefono 2'),
            array('pColumn' => 'U', 'row' => $row, 'value' => 'Estado civíl'),
            array('pColumn' => 'V', 'row' => $row, 'value' => 'Conyugue'),
            array('pColumn' => 'W', 'row' => $row, 'value' => 'Hijos'),
            array('pColumn' => 'X', 'row' => $row, 'value' => 'Padre'),
            array('pColumn' => 'Y', 'row' => $row, 'value' => 'Madre'),
            array('pColumn' => 'Z', 'row' => 2, 'value' => 'Periodo de prueba'),
            array('pColumn' => 'AA', 'row' => 2, 'value' => 'Capacitación inicial'),
            array('pColumn' => 'AB', 'row' => 2, 'value' => 'Tiempo determinado'),
            array('pColumn' => 'AC', 'row' => 2, 'value' => 'Tiempo indeterminado'),
            //array('pColumn'=>'','row'=>1,'value'=>''),
        );


        //PARA CENTRAR
        /*
        $hoja->getStyle('A:Y')->getAlignment()->setHorizontal('center');
        $hoja->getStyle('A:Y')->getAlignment()->setVertical('center');  
        */

        $columnIndex = 1;
        foreach ($arrayColumns as $data) {
            if (($data['pColumn'] == 'Z' || $data['pColumn'] == 'AA' || $data['pColumn'] == 'AB' || $data['pColumn'] == 'AC') && $data['row'] == 2) {
                $hoja->getColumnDimension($data['pColumn'])->setAutoSize(true);
                $hoja->setCellValueByColumnAndRow($columnIndex, $data['row'], $data['value']);
            } else {
                $hoja->mergeCells($data['pColumn'] . '1:' . $data['pColumn'] . '2');
                $hoja->getColumnDimension($data['pColumn'])->setAutoSize(true);
                $hoja->setCellValueByColumnAndRow($columnIndex, $data['row'], $data['value']);
            }
            $columnIndex++;
        }
        $hoja->mergeCells('Z1:AC1');
        $hoja->getColumnDimension('Z')->setAutoSize(true);
        $hoja->setCellValueByColumnAndRow(26, 1, 'Contratos');


        $row = $row + 2; // PARA QUE SE SALTEN DOS FILAS PARA ESTABLECER LOS DATOS
        $employeeContactObj = new EmployeeContact();

        foreach ($employees as $emp) {
            $col = 1;
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['employee_number']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['fullName']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['title']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['boss_title_position']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['department']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['id_gender'] == 1 ? 'Hombre' : 'Mujer');
            $hoja->setCellValueByColumnAndRow($col++, $row, Utils::getDate($emp['start_date']));
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['antiquity'] . ' Años');
            $hoja->setCellValueByColumnAndRow($col++, $row, isset($emp['history_position_date']) ? Utils::getDate($emp['history_position_date']) : '');
            $hoja->setCellValueByColumnAndRow($col++, $row, isset($emp['employee_payroll']) ? Utils::getDate($emp['employee_payroll']) : '');
            $hoja->setCellValueByColumnAndRow($col++, $row, isset($emp['employee_payroll']) ? $emp['employee_payroll'] : '');
            $hoja->setCellValueByColumnAndRow($col++, $row,  isset($emp['date_birth']) ? Utils::getDate($emp['date_birth']) : '');
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['age'] . ' Años');
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['nss']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['rfc']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['curp']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['email']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['institutional_email']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['phone1']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['phone2']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['civil_status']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['daughter'] + $emp['son']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['father']);
            $hoja->setCellValueByColumnAndRow($col++, $row, $emp['mother']);
            $hoja->setCellValueByColumnAndRow($col++, $row, isset($emp['contract_start1']) ? Utils::getDate($emp['contract_start1']) . ' - ' . Utils::getDate($emp['contract_end1']) : '');
            $hoja->setCellValueByColumnAndRow($col++, $row, isset($emp['contract_start2']) ? Utils::getDate($emp['contract_start2']) . ' - ' . Utils::getDate($emp['contract_end2']) : '');
            $hoja->setCellValueByColumnAndRow($col++, $row, isset($emp['contract_start4']) ? Utils::getDate($emp['contract_start4']) . ' - ' . Utils::getDate($emp['contract_end4']) : '');
            $hoja->setCellValueByColumnAndRow($col++, $row, isset($emp['contract_start5']) ? Utils::getDate($emp['contract_start5']) : '');

            $row++;
            //$hoja->setCellValueByColumnAndRow(, $row, $emp['']);
        }


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new WriterXlsx($documento);
        $writer->save('php://output');
        exit();
    }

    public function excelcobranza()
    {
        if ((Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isManager())) {
            $factura = new Facturas();
            $facturas_pendientes = $factura->getFacturasPendientes();
            $facturas_pagadas = $factura->getFacturasPagadas();

            $documento = new Spreadsheet();
            $documento
                ->getProperties()
                ->setCreator('RRHH Ingenia')
                ->setLastModifiedBy($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name)
                ->setTitle('')
                ->setDescription('RRHH Ingenia | Reporte de Cuentas por Cobrar');

            $hoja1 = $documento->getActiveSheet();
            $hoja1->setTitle('Facturas Pendientes');

            $estiloTituloReporte = array(
                'font' => array(
                    'bold'      => true,
                    'italic'    => false,
                    'strike'    => false,
                    'size' => 13
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => Border::BORDER_NONE
                    )
                ),
                'alignment' => array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'bold'  => true,
                    'size' => 12,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('rgb' => 'A6C44A')
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );

            $estiloInformacion = array(
                'font' => array(
                    'size' => 8
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            );

            $izquierda = array(
                'aligment' => array(
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $centrado = array(
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );

            $derecha = array(
                'aligment' => array(
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    'vertical' => Alignment::VERTICAL_CENTER
                )
            );

            $azulFuerte = array(
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '33364F'
                    ),
                    'endColor' => array(
                        'rgb' => 'FFFFFF'
                    )
                )

            );
            $rojo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'B80C09'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $amarillo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'F8C630'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $beige = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'FFEEBA'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $gris = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '6C757D'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $azul = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '007BFF'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $azulBajo = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'BEE5EB'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            );
            $verde = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'A6C44A'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );
            $naranja = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => 'F28322'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );

            $morado = array(
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array(
                        'rgb' => '6F42C1'
                    )
                ),
                'font' => array(
                    'bold'  => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )
            );


            $hoja1->setCellValue('A1', 'REPORTE DE FACTURAS CON PENDIENTE DE PAGO SA');
            $hoja1->mergeCells('A1:N1');

            $hoja1->getColumnDimension('A')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(1, 3, 'Factura');

            $hoja1->getColumnDimension('B')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(2, 3, 'Fecha');

            $hoja1->getColumnDimension('C')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(3, 3, 'Días de crédito');

            $hoja1->getColumnDimension('D')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(4, 3, 'Días transcurridos');

            $hoja1->getColumnDimension('E')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(5, 3, 'Empresa');

            $hoja1->getColumnDimension('F')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(6, 3, 'Cliente');

            $hoja1->getColumnDimension('G')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(7, 3, 'Razon social');

            $hoja1->getColumnDimension('H')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(8, 3, 'Monto');

            $hoja1->getColumnDimension('I')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(9, 3, 'Monto + IVA');

            $hoja1->getColumnDimension('J')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(10, 3, 'Fecha de pago');

            $hoja1->getColumnDimension('K')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(11, 3, 'Estado');

            $hoja1->getColumnDimension('L')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(12, 3, 'Fecha última gestión');

            $hoja1->getColumnDimension('M')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(13, 3, 'Próxima gestión');

            $hoja1->getColumnDimension('N')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(14, 3, 'Promesa de pago');

            $hoja1->getColumnDimension('O')->setAutoSize(true);
            $hoja1->setCellValueByColumnAndRow(15, 3, 'Última gestión');

            $fila = 4;
            foreach ($facturas_pendientes as $factura) {
                $hoja1->setCellValueByColumnAndRow(1, $fila, $factura['Folio_Factura']);
                $hoja1->setCellValueByColumnAndRow(2, $fila, date_format(date_create($factura['Fecha_Emision']), 'd/m/Y'));
                $hoja1->setCellValueByColumnAndRow(3, $fila, $factura['Plazo_Credito']);
                $hoja1->setCellValueByColumnAndRow(4, $fila, $factura['Dias_Transcurridos']);
                $hoja1->setCellValueByColumnAndRow(5, $fila, $factura['Nombre_Empresa']);
                $hoja1->setCellValueByColumnAndRow(6, $fila, $factura['Cliente']);
                $hoja1->setCellValueByColumnAndRow(7, $fila, $factura['Razon_Social']);
                $hoja1->setCellValueByColumnAndRow(8, $fila, $factura['Monto']);
                $hoja1->setCellValueByColumnAndRow(9, $fila, $factura['Monto_IVA']);
                $hoja1->setCellValueByColumnAndRow(10, $fila, !is_null($factura['Fecha_de_Pago']) ? date_format(date_create($factura['Fecha_de_Pago']), 'd/m/Y') : '');
                $hoja1->setCellValueByColumnAndRow(11, $fila, $factura['Estado']);
                $hoja1->setCellValueByColumnAndRow(12, $fila, !is_null($factura['Fecha_Ultima_Gestion']) ? date_format(date_create($factura['Fecha_Ultima_Gestion']), 'd/m/Y') : '');
                $hoja1->setCellValueByColumnAndRow(13, $fila, !is_null($factura['Proxima_Gestion']) ? date_format(date_create($factura['Proxima_Gestion']), 'd/m/Y') : '');
                $hoja1->setCellValueByColumnAndRow(14, $fila, !is_null($factura['Promesa_Pago']) ? date_format(date_create($factura['Promesa_Pago']), 'd/m/Y') : '');
                $hoja1->setCellValueByColumnAndRow(15, $fila, $factura['Ultima_Gestion']);


                if ($factura['Estado'] == 'Pendiente de pago')
                    $hoja1->getStyle('K' . $fila)->applyFromArray($naranja);
                if ($factura['Estado'] == 'Pagada')
                    $hoja1->getStyle('K' . $fila)->applyFromArray($verde);

                if ($factura['Dias_Transcurridos'] > $factura['Plazo_Credito'])
                    $hoja1->getStyle('D' . $fila)->applyFromArray($rojo);
                if ($factura['Dias_Transcurridos'] == $factura['Plazo_Credito'])
                    $hoja1->getStyle('D' . $fila)->applyFromArray($naranja);

                $fila++;
            }
            $fila = $fila - 1;

            $hoja1->getStyle('A4:N' . $fila)->applyFromArray($estiloInformacion);
            $hoja1->getStyle('A4:F' . $fila)->applyFromArray($centrado);
            $hoja1->getStyle('G4:G' . $fila)->applyFromArray($izquierda);
            $hoja1->getStyle('H4:I' . $fila)->applyFromArray($derecha);
            $hoja1->getStyle('J4:M' . $fila)->applyFromArray($centrado);
            $hoja1->getStyle('N4:N' . $fila)->applyFromArray($izquierda);
            $hoja1->getStyle('A1:N1')->applyFromArray($estiloTituloReporte);
            $hoja1->getStyle('A3:N3')->applyFromArray($estiloTituloColumnas);
            $hoja1->getStyle('B4:B' . $fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

            $hoja2 = $documento->createSheet();
            $hoja2->setTitle('Facturas Pagadas');

            $hoja2->setCellValue('A1', 'REPORTE DE FACTURAS PAGADAS SA');
            $hoja2->mergeCells('A1:N1');

            $hoja2->getColumnDimension('A')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(1, 3, 'Factura');

            $hoja2->getColumnDimension('B')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(2, 3, 'Fecha');

            $hoja2->getColumnDimension('C')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(3, 3, 'Días de crédito');

            $hoja2->getColumnDimension('D')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(4, 3, 'Días transcurridos');

            $hoja2->getColumnDimension('E')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(5, 3, 'Empresa');

            $hoja2->getColumnDimension('F')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(6, 3, 'Cliente');

            $hoja2->getColumnDimension('G')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(7, 3, 'Razon social');

            $hoja2->getColumnDimension('H')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(8, 3, 'Monto');

            $hoja2->getColumnDimension('I')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(9, 3, 'Monto + IVA');

            $hoja2->getColumnDimension('J')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(10, 3, 'Fecha de pago');

            $hoja2->getColumnDimension('K')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(11, 3, 'Estado');

            $hoja2->getColumnDimension('L')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(12, 3, 'Fecha última gestión');

            $hoja2->getColumnDimension('M')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(13, 3, 'Próxima gestión');

            $hoja2->getColumnDimension('N')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(12, 3, 'Promesa de pago');

            $hoja2->getColumnDimension('O')->setAutoSize(true);
            $hoja2->setCellValueByColumnAndRow(14, 3, 'Última gestión');

            $fila = 4;
            foreach ($facturas_pagadas as $factura) {
                $hoja2->setCellValueByColumnAndRow(1, $fila, $factura['Folio_Factura']);
                $hoja2->setCellValueByColumnAndRow(2, $fila, date_format(date_create($factura['Fecha_Emision']), 'd/m/Y'));
                $hoja2->setCellValueByColumnAndRow(3, $fila, $factura['Plazo_Credito']);
                $hoja2->setCellValueByColumnAndRow(4, $fila, $factura['Dias_Transcurridos']);
                $hoja2->setCellValueByColumnAndRow(5, $fila, $factura['Nombre_Empresa']);
                $hoja2->setCellValueByColumnAndRow(6, $fila, $factura['Cliente']);
                $hoja2->setCellValueByColumnAndRow(7, $fila, $factura['Razon_Social']);
                $hoja2->setCellValueByColumnAndRow(8, $fila, $factura['Monto']);
                $hoja2->setCellValueByColumnAndRow(9, $fila, $factura['Monto_IVA']);
                $hoja2->setCellValueByColumnAndRow(10, $fila, !is_null($factura['Fecha_de_Pago']) ? date_format(date_create($factura['Fecha_de_Pago']), 'd/m/Y') : '');
                $hoja2->setCellValueByColumnAndRow(11, $fila, $factura['Estado']);
                $hoja2->setCellValueByColumnAndRow(12, $fila, !is_null($factura['Fecha_Ultima_Gestion']) ? date_format(date_create($factura['Fecha_Ultima_Gestion']), 'd/m/Y') : '');
                $hoja2->setCellValueByColumnAndRow(13, $fila, !is_null($factura['Proxima_Gestion']) ? date_format(date_create($factura['Proxima_Gestion']), 'd/m/Y') : '');
                $hoja2->setCellValueByColumnAndRow(14, $fila, !is_null($factura['Promesa_Pago']) ? date_format(date_create($factura['Promesa_Pago']), 'd/m/Y') : '');
                $hoja2->setCellValueByColumnAndRow(15, $fila, $factura['Ultima_Gestion']);


                if ($factura['Estado'] == 'Pendiente de pago')
                    $hoja2->getStyle('K' . $fila)->applyFromArray($naranja);
                if ($factura['Estado'] == 'Pagada')
                    $hoja2->getStyle('K' . $fila)->applyFromArray($verde);

                if ($factura['Dias_Transcurridos'] > $factura['Plazo_Credito'])
                    $hoja2->getStyle('D' . $fila)->applyFromArray($rojo);
                if ($factura['Dias_Transcurridos'] == $factura['Plazo_Credito'])
                    $hoja2->getStyle('D' . $fila)->applyFromArray($naranja);

                $fila++;
            }
            $fila = $fila - 1;

            $hoja2->getStyle('A4:O' . $fila)->applyFromArray($estiloInformacion);
            $hoja2->getStyle('A4:F' . $fila)->applyFromArray($centrado);
            $hoja2->getStyle('G4:G' . $fila)->applyFromArray($izquierda);
            $hoja2->getStyle('H4:I' . $fila)->applyFromArray($derecha);
            $hoja2->getStyle('J4:N' . $fila)->applyFromArray($centrado);
            $hoja2->getStyle('O4:O' . $fila)->applyFromArray($izquierda);
            $hoja2->getStyle('A1:O1')->applyFromArray($estiloTituloReporte);
            $hoja2->getStyle('A3:O3')->applyFromArray($estiloTituloColumnas);
            $hoja2->getStyle('B4:B' . $fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);


            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Reporte de Cuentas por Cobrar ' . (date('Y-m-d')) . '.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new WriterXlsx($documento);

            $writer->save('php://output');
            exit();
        }
    }

    //===[gabo 7 junio incidencias]=== 
    public function incidentes()
    {

        if ($_POST['start_date'] > $_POST['end_date']) {
            $aux = $_POST['start_date'];
            $_POST['start_date'] = $_POST['end_date'];
            $_POST['end_date'] = $aux;
        }

        $start_date = isset($_POST['start_date']) ? Utils::sanitizeString($_POST['start_date']) : date('Y-m-d', strtotime('-30 days'));
        $end_date = isset($_POST['end_date']) ? Utils::sanitizeString($_POST['end_date']) : date('Y-m-d');

        $contactoEmpresa = new ContactosEmpresa();
        $contactoEmpresa->setUsuario($_SESSION['identity']->username);
        $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

        $employeeObj = new Employees();
        $employeeObj->setID_Contacto($ID_Contacto);
        $employeeObj->setStart_date($start_date);
        $employeeObj->setEnd_date($end_date);
        $employeeObj->setStatus(1);
        $employees = $employeeObj->getAllEmployeesByIDcontacto();

        $incidens = $employeeObj->getAllEmployeesIncidenceByIDcontactoAndFecha();

        $title = "Reporte de Incidencias";
        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator('RRHH Ingenia')
            ->setLastModifiedBy($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name)
            ->setTitle($title)
            ->setDescription('RRHH Ingenia | Reporte de Incidencias');
        $hoja = $documento->getActiveSheet();

        $hoja->setTitle($title);

        $row = 2;
        $arrayColumns = array(
            array('pColumn' => 'A', 'row' => $row, 'value' => 'Incidencia'),
            array('pColumn' => 'B', 'row' => $row, 'value' => 'Movimientos'),
            array('pColumn' => 'C', 'row' => $row, 'value' => 'Comentario'),
            array('pColumn' => 'D', 'row' => $row, 'value' => 'Empleado'),
            array('pColumn' => 'E', 'row' => $row, 'value' => 'Puesto'),
            array('pColumn' => 'F', 'row' => $row, 'value' => 'Departamento'),
            array('pColumn' => 'G', 'row' => $row, 'value' => 'Fecha Inicial'),
            array('pColumn' => 'H', 'row' => $row, 'value' => 'Fecha Final'),

        );


        $columnIndex = 1;
        foreach ($arrayColumns as $data) {

            $hoja->getColumnDimension($data['pColumn'])->setAutoSize(true);
            $hoja->setCellValueByColumnAndRow($columnIndex, $data['row'], $data['value']);

            $columnIndex++;
        }


        $estiloFilas = array(

            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('rgb' => 'C5E5FA')
            ),

        );

        $estiloFilasBorder = array(
            'borders' => array(
                'inside' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'outline' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            ),
        );


        $row = $row + 2; // PARA QUE SE SALTEN DOS FILAS PARA ESTABLECER LOS DATOS
        $employeeContactObj = new EmployeeContact();

        foreach ($incidens as $inc) {
            $hoja->setCellValueByColumnAndRow(1, $row, $inc['type']);
            if ($inc['type'] == 'Retraso' || $inc['type'] == 'Horas extras') {
                $mov = $inc['hours'] . ' hrs';
            } else if ($inc['type'] == 'Faltas') {
                $mov = $inc['type_of_foul'];
            } else if ($inc['type'] == 'Incapacidades') {
                $mov = $inc['type_of_incapacity'];
            } else if ($inc['type'] == 'Bonos') {
                $mov = '$' . number_format($inc['amount'], 2);
            } else if ($inc['type'] == 'Permiso') {
                $mov = $inc['permission'];
            }

            $hoja->setCellValueByColumnAndRow(2, $row, $mov);
            $hoja->setCellValueByColumnAndRow(3, $row, $inc['comments']);
            $hoja->setCellValueByColumnAndRow(4, $row, $inc['employeFullName']);
            $hoja->setCellValueByColumnAndRow(5, $row, $inc['title']);
            $hoja->setCellValueByColumnAndRow(6, $row, $inc['department']);
            $hoja->setCellValueByColumnAndRow(7, $row, Utils::getDate($inc['created_at']));
            $hoja->setCellValueByColumnAndRow(8, $row, Utils::getDate($inc['end_date']));

            if ($row % 2 != 0) {
                $hoja->getStyle('A' . $row . ":" . 'H' . $row)->applyFromArray($estiloFilas);
            } else {
                $hoja->getStyle('A' . $row . ":" . 'H' . $row)->applyFromArray($estiloFilasBorder);
            }

            $row++;
        }


        $estiloTituloColumnas = array(
            'font' => array(
                'bold'  => true,
                'size' => 14,
                'color' => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('rgb' => 'A6C44A')
            ),
            'borders' => array(
                'inside' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ), 'outline' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )

            ),
            'alignment' =>  array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'  => Alignment::VERTICAL_CENTER
            )
        );

        $estiloInformacion = array(
            'font' => array(
                'size' => 8
            ),
            'fill' => array(
                'fillType'  => Fill::FILL_SOLID
            ),
            'borders' => array(
                'inside' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'outline' => array(
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            )
        );

        $centrado = array(
            'alignment' =>  array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'  => Alignment::VERTICAL_CENTER
            )
        );

        $hoja->getStyle('A2:H2')->applyFromArray($estiloInformacion);
        $hoja->getStyle('A:H')->applyFromArray($centrado);
        $hoja->getStyle('A2:H2')->applyFromArray($estiloTituloColumnas);
        $hoja->mergeCells('C1:E1');
        $hoja->setCellValueByColumnAndRow(3, 1, "Reporte de Incidencias");

        $hoja->getStyle('C1')->applyFromArray(
            array(
                'font' => array(
                    'bold'  => true,
                    'size' => 18,

                )
            )
        );


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new WriterXlsx($documento);
        $writer->save('php://output');
        exit();
    }
    //===[gabo 7 junio incidencias fin]=== 
    public function ExcelGroupEvaluation()
    {
        $id_evaluation = ($_POST['id_evaluation'] ? Utils::sanitizeNumber($_POST['id_evaluation']) : 'false');
        $fechas = ($_POST['fechas'] ? Utils::sanitizeString($_POST['fechas']) : 'false');


        if ($fechas) {
            $evaluationEmployeeObj = new EvaluationEmployee();

            //===[gabo 27 julio excel]===
            $fecha = explode(':', $fechas);
            $evaluationEmployeeObj->setStart_date(date('Y-m-d', strtotime($fecha[0])));
            $evaluationEmployeeObj->setEnd_date(date('Y-m-d', strtotime($fecha[1])));
            $arryaEvaluationEmployee = $evaluationEmployeeObj->getValuequestionForEmployeeBYStartAndEndDate();
            //===[gabo 27 julio excel fin]===



            $EvaluationOpenQuestionsEmployeeObj = new EvaluationOpenQuestionsEmployee();



            $categoriesObj = new EvaluationCategory();
            $categoriesObj->setId_evaluation($id_evaluation);
            $categoriesObj->setStatus(1);
            $categories =  $categoriesObj->getAllByIdEvaluation();
            $total_categories = count($categories);
            $total_por_category = 100 / $total_categories;
            $questions =  $categoriesObj->getAllQuestionsByIdEvalaution();

            $columnas_por_categoria = [];
            foreach ($categories as $categorie) {
                $conteo = 0;
                foreach ($questions as $i => $pregunta) {
                    if ($categorie["id"] == $pregunta['id_category']) {
                        $conteo++;
                    }
                }
                $columnas_por_categoria[] = $conteo;
            }

            $i = 0;


            $openQuestionsObj = new OpenQuestions();
            $openQuestionsObj->setId_evaluation($id_evaluation);
            $openQuestionsObj->setStatus(1);
            $openQuestions = $openQuestionsObj->getAllByIdEvalaution();
            $total_questions = count($questions);
            $total_openQuestions = count($openQuestions);



            $openQuestionsObj = new OpenQuestions();
            $openQuestionsObj->setId_evaluation($id_evaluation);
            $openQuestionsObj->setStatus(2);
            $feedback = $openQuestionsObj->getAllByIdEvalaution();
            $total_feedback = count($feedback);
            $total_open_questionsfeedback = $total_openQuestions + $total_feedback;


            //===[gabo 27 julio excel]===
            $group = new Evaluations();
            $group->setId($id_evaluation);
            $grupo = $group->getOne();
            $title = $grupo->name . "  (" . Utils::getDate($fecha[0]) . " al " . Utils::getDate($fecha[1]) . ")";
            //===[gabo 27 julio excel fin]===
            $documento = new Spreadsheet();
            $documento
                ->getProperties()
                ->setCreator('RRHH Ingenia')
                ->setLastModifiedBy($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name)
                ->setDescription('RRHH Ingenia | Reporte ');
            $hoja = $documento->getActiveSheet();


            $row = 2;
            $hoja->setCellValueByColumnAndRow(1, $row, 'Nombre del colaborador');
            $hoja->setCellValueByColumnAndRow(2, $row, 'Puesto');
            $hoja->setCellValueByColumnAndRow(3, $row, 'Jefe Inmediato');

            $columna = 3;
            foreach ($categories as $category) :

                $hoja->setCellValueByColumnAndRow(++$columna, $row, $category['category']);

                for ($j = 0; $j < ($columnas_por_categoria[$i] - 1); $j++) :
                    $hoja->setCellValueByColumnAndRow(++$columna, $row, "-");
                endfor;

                $i++;
            endforeach;

            $hoja->setCellValueByColumnAndRow(++$columna, $row, "Preguntas");


            for ($i = 0; $i < $total_openQuestions - 1; $i++) :

                $hoja->setCellValueByColumnAndRow(++$columna, $row, "-");

            endfor;

            $hoja->setCellValueByColumnAndRow(++$columna, $row, "Retroalimentación");

            for ($i = 0; $i < $total_feedback - 1; $i++) :
                $hoja->setCellValueByColumnAndRow(++$columna, $row, "-");
            endfor;

            $hoja->setCellValueByColumnAndRow(++$columna, $row, "Calificación");

            foreach ($hoja->getColumnIterator() as $column) {
                $hoja->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
            }

            $row++;
            $columna = 0;
            $hoja->setCellValueByColumnAndRow(++$columna, $row, "-");
            $hoja->setCellValueByColumnAndRow(++$columna, $row, "-");
            $hoja->setCellValueByColumnAndRow(++$columna, $row, "-");


            foreach ($questions as $question) :
                $hoja->setCellValueByColumnAndRow(++$columna, $row, $question['question']);

            endforeach;

            foreach ($openQuestions as $openquestion) :
                $hoja->setCellValueByColumnAndRow(++$columna, $row,  $openquestion['question']);
            endforeach;

            foreach ($feedback as $feed) :
                $hoja->setCellValueByColumnAndRow(++$columna, $row, $feed['question']);
            endforeach;

            $hoja->setCellValueByColumnAndRow(++$columna, $row, "-");


            $estiloFilas = array(

                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('rgb' => 'C5E5FA')
                ),

            );

            $estiloFilasBorder = array(
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
            );

            //stilos
            $estiloTituloColumnas = array(
                'font' => array(
                    'bold'  => true,
                    'size' => 14,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('rgb' => 'A6C44A')
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ), 'outline' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )

                ),
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );


            foreach (range('A', $hoja->getHighestColumn()) as $col) {
                $hoja->getStyle($col . "2")->applyFromArray($estiloTituloColumnas);
            }

            //llenar tabla
            $row++;
            foreach ($arryaEvaluationEmployee as $evalua) :
                $columna = 0;
                $row++;
                $hoja->setCellValueByColumnAndRow(++$columna, $row, $evalua['employeeName']);
                $hoja->setCellValueByColumnAndRow(++$columna, $row, $evalua['title']);
                $hoja->setCellValueByColumnAndRow(++$columna, $row, $evalua['BossName']);


                $evaluationEmployeeObj->setId($evalua['id']);
                $valore = $evaluationEmployeeObj->getValuequestionByIdEmployee();
                $total_answers_employee = count($valore);



                for ($i = 0; $i < $total_answers_employee; $i++) :
                    $hoja->setCellValueByColumnAndRow(++$columna, $row, $valore[$i]['value_question_employee']);
                    $id = $valore[$i]['id_evaluation_employe'];
                endfor;

                for ($i = 0; $i < ($total_questions - $total_answers_employee); $i++) :
                    $hoja->setCellValueByColumnAndRow(++$columna, $row, '-');
                endfor;



                $EvaluationOpenQuestionsEmployeeObj->setId_evaluation_employee($evalua['id']);
                $EvaluationOpenQuestionsEmployee = $EvaluationOpenQuestionsEmployeeObj->getAllByIdEvvalautionEmployee();
                $total_questions_employee = count($EvaluationOpenQuestionsEmployee);



                foreach ($EvaluationOpenQuestionsEmployee as $evaquestion) :
                    $hoja->setCellValueByColumnAndRow(++$columna, $row, $evaquestion['answer']);
                endforeach;

                for ($i = 0; $i < ($total_open_questionsfeedback - $total_questions_employee); $i++) :

                    $hoja->setCellValueByColumnAndRow(++$columna, $row, '-');

                endfor;


                $parts = explode("/", $evalua['score']);
                $total = 0;
                if (count($parts) == 1) {
                    $total = "-";
                } else {

                    foreach ($parts as $part) {
                        $partes = explode(":", $part);

                        $total += $partes[1];
                    }
                    $total = ceil($total);
                }

                $hoja->setCellValueByColumnAndRow(++$columna, $row, $total);

                //stilos en las filas
                if ($row % 2 != 0) {
                    $hoja->getStyle('A' . $row . ":" . $col . $row)->applyFromArray($estiloFilasBorder);
                } else {
                    $hoja->getStyle('A' . $row . ":" . $col . $row)->applyFromArray($estiloFilas);
                }

            endforeach;

            //estilos
            $estiloInformacion = array(
                'font' => array(
                    'size' => 8
                ),
                'fill' => array(
                    'fillType'  => Fill::FILL_SOLID
                ),
                'borders' => array(
                    'inside' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    ),
                    'outline' => array(
                        'borderStyle' => Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            );

            $centrado = array(
                'alignment' =>  array(
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'  => Alignment::VERTICAL_CENTER
                )
            );


            $hoja->getStyle('A2:' . $col . "2")->applyFromArray($estiloInformacion);
            $hoja->getStyle('A:' . $col)->applyFromArray($centrado);
            $hoja->getStyle('A2:' . $col . "2")->applyFromArray($estiloTituloColumnas);
            $hoja->mergeCells('A1:' . $col . "1");
            $hoja->setCellValueByColumnAndRow(1, 1, $title);

            $hoja->getStyle('A3:' . $col . "3")->applyFromArray(
                array(
                    'font' => array(
                        'bold'  => true,
                        'size' => 13,

                    )
                )
            );;

            $hoja->getStyle('A1')->applyFromArray(
                array(
                    'font' => array(
                        'bold'  => true,
                        'size' => 18,

                    )
                )
            );
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new WriterXlsx($documento);
            $writer->save('php://output');
            exit();
        } else {
            header("location:" . base_url);
        }
    }


    //===[gabo 7 junio incidencias fin]=== 
    public function ExcelPAsswords()
    {
        require_once 'models/RH/UsuariosRH.php';

        $users_rh = new UsuariosRH();
        $users_rh = $users_rh->getUsersInfo();


        $title = "Usuarios RH";
        //===[gabo 27 julio excel fin]===
        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator('RRHH Ingenia')
            ->setLastModifiedBy($_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name)
            ->setDescription('RRHH Ingenia | Reporte ');
        $hoja = $documento->getActiveSheet();


        $row = 2;
        $hoja->setCellValueByColumnAndRow(1, $row, 'Nombre del colaborador');
        $hoja->setCellValueByColumnAndRow(2, $row, 'usuario');
        $hoja->setCellValueByColumnAndRow(3, $row, 'contraseña');




        $estiloFilas = array(

            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('rgb' => 'C5E5FA')
            ),

        );

        $estiloFilasBorder = array(
            'borders' => array(
                'inside' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'outline' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            ),
        );

        //stilos
        $estiloTituloColumnas = array(
            'font' => array(
                'bold'  => true,
                'size' => 14,
                'color' => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('rgb' => 'A6C44A')
            ),
            'borders' => array(
                'inside' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ), 'outline' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )

            ),
            'alignment' =>  array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'  => Alignment::VERTICAL_CENTER
            )
        );


        foreach (range('A', $hoja->getHighestColumn()) as $col) {
            $hoja->getStyle($col . "2")->applyFromArray($estiloTituloColumnas);
            $hoja->getColumnDimension($col)->setAutoSize(true);
        }

        //llenar tabla
        $row++;
        foreach ($users_rh as $user) :


            $columna = 0;
            $row++;
            $hoja->setCellValueByColumnAndRow(++$columna, $row, $user['first_name'] . " " . $user['surname'] . $user['last_name']);
            $hoja->setCellValueByColumnAndRow(++$columna, $row, $user['username']);
            $hoja->setCellValueByColumnAndRow(++$columna, $row, Encryption::decode($user['password']));



        endforeach;

        //estilos
        $estiloInformacion = array(
            'font' => array(
                'size' => 8
            ),
            'fill' => array(
                'fillType'  => Fill::FILL_SOLID
            ),
            'borders' => array(
                'inside' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'outline' => array(
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            )
        );

        $centrado = array(
            'alignment' =>  array(
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'  => Alignment::VERTICAL_CENTER
            )
        );


        $hoja->getStyle('A2:' . $col . "2")->applyFromArray($estiloInformacion);
        $hoja->getStyle('A1:' . $col . "3")->applyFromArray($centrado);
        $hoja->getStyle('A2:' . $col . "2")->applyFromArray($estiloTituloColumnas);
        $hoja->mergeCells('A1:' . $col . "1");
        $hoja->setCellValueByColumnAndRow(1, 1, $title);

        $hoja->getStyle('A3:' . $col . "3")->applyFromArray(
            array(
                'font' => array(
                    'bold'  => true,
                    'size' => 13,

                )
            )
        );;

        $hoja->getStyle('A1')->applyFromArray(
            array(
                'font' => array(
                    'bold'  => true,
                    'size' => 18,

                )
            )
        );
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new WriterXlsx($documento);
        $writer->save('php://output');
        exit();
    }
}
