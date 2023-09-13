<?php

require_once 'models/SA/Prospecto.php';

class ProspectoController{

    public function index(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSales() || Utils::isSalesManager())) {
            $prospecto = new Prospecto();
            $pros = [];
            if (Utils::isSales()) {
                $prospecto->setEjecutivo(strtoupper($_SESSION['identity']->username));
                $prospectos = $prospecto->getProspectosPorEjecutivo();
            }else{
                $prospectos = $prospecto->getAll();
            }
            $prospectoshoy = [];
            for ($i=0; $i < count($prospectos); $i++) { 
                if ($prospectos[$i]['Fecha_Prox_Seguimiento'] == date('Y-m-d')) {
                    $aux = $prospectos[$i];
                    unset($prospectos[$i]);
                    array_push($prospectoshoy, $aux);
                }
            }
            $prospectos = array_merge($prospectoshoy, $prospectos);
            

            $page_title = 'Prospectos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/prospecto/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:'.base_url);
        }
    }

    public function crear(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSales() || Utils::isSalesManager())) {

            $page_title = 'Nuevo prospecto | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/prospecto/crear.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:'.base_url);
        }
    }

    public function create(){
        if (Utils::isValid($_POST) && !Utils::isCandidate() && !Utils::isCustomer()) {
            $Prospecto = isset($_POST['Prospecto']) ? trim($_POST['Prospecto']) : FALSE;
            $Giro = isset($_POST['Giro']) ? trim($_POST['Giro']) : FALSE;
            $Plaza = isset($_POST['Plaza']) ? trim($_POST['Plaza']) : FALSE;
            $Tipo = isset($_POST['Tipo']) ? trim($_POST['Tipo']) : FALSE;
            $Contacto_RH = isset($_POST['Contacto_RH']) ? trim($_POST['Contacto_RH']) : FALSE;
            $Puesto = isset($_POST['Puesto']) ? trim($_POST['Puesto']) : FALSE;
            $Telefono = isset($_POST['Telefono']) ? trim($_POST['Telefono']) : FALSE;
            $Correo = isset($_POST['Correo']) ? trim($_POST['Correo']) : FALSE;
            $Acciones = isset($_POST['Acciones']) ? trim($_POST['Acciones']) : FALSE;
            $Acciones_Realizadas = isset($_POST['Acciones_Realizadas']) ? trim($_POST['Acciones_Realizadas']) : FALSE;
            $Periodicidad = isset($_POST['Periodicidad']) ? trim($_POST['Periodicidad']) : FALSE;
            $Fecha_Prox_Seguimiento = isset($_POST['Fecha_Prox_Seguimiento']) ? trim($_POST['Fecha_Prox_Seguimiento']) : FALSE;
            $Ejecutivo = isset($_SESSION['identity']) ? strtoupper($_SESSION['identity']->username) : NULL;
            
            $pros = new Prospecto();
            $pros->setProspecto($Prospecto);
            $pros->setGiro($Giro);
            $pros->setPlaza($Plaza);
            $pros->setTipo($Tipo);
            $pros->setContacto_RH($Contacto_RH);
            $pros->setPuesto($Puesto);
            $pros->setTelefono($Telefono);
            $pros->setCorreo($Correo);
            $pros->setAcciones($Acciones);
            $pros->setAcciones_Realizadas($Acciones_Realizadas);
            $pros->setPeriodicidad($Periodicidad);
            $pros->setFecha_Prox_Seguimiento($Fecha_Prox_Seguimiento);
            $pros->setEjecutivo($Ejecutivo);
            $create = $pros->create();
            if ($create) {
                echo 1;
            }else{
                echo 2;
            }
            
        }else{
            header("location:".base_url); 
        }
    }

    public function editar(){
        if (Utils::isValid($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer()) {
            if (isset($_GET['id'])) {
                $id = ($_GET['id']);
                $pros = new Prospecto();
                $pros->setID($id);
                $prospecto = $pros->getOne();
                $page_title = $prospecto->Prospecto.' | RRHH Ingenia';

                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/prospecto/crear.php';
                require_once 'views/layout/footer.php';
            }else {
                header('location:'.base_url.'prospecto/index');
            }
        }else {
            header('location:'.base_url);
        }
    }

    public function update(){
        if (Utils::isValid($_POST) && !Utils::isCandidate() && !Utils::isCustomer()) {
            $id = isset($_POST['id']) ? trim($_POST['id']) : FALSE;
            $Prospecto = isset($_POST['Prospecto']) ? trim($_POST['Prospecto']) : FALSE;
            $Giro = isset($_POST['Giro']) ? trim($_POST['Giro']) : FALSE;
            $Plaza = isset($_POST['Plaza']) ? trim($_POST['Plaza']) : FALSE;
            $Tipo = isset($_POST['Tipo']) ? trim($_POST['Tipo']) : FALSE;
            $Contacto_RH = isset($_POST['Contacto_RH']) ? trim($_POST['Contacto_RH']) : FALSE;
            $Puesto = isset($_POST['Puesto']) ? trim($_POST['Puesto']) : FALSE;
            $Telefono = isset($_POST['Telefono']) ? trim($_POST['Telefono']) : FALSE;
            $Correo = isset($_POST['Correo']) ? trim($_POST['Correo']) : FALSE;
            $Acciones = isset($_POST['Acciones']) ? trim($_POST['Acciones']) : FALSE;
            $Acciones_Realizadas = isset($_POST['Acciones_Realizadas']) ? trim($_POST['Acciones_Realizadas']) : FALSE;
            $Periodicidad = isset($_POST['Periodicidad']) ? trim($_POST['Periodicidad']) : FALSE;
            $Fecha_Prox_Seguimiento = isset($_POST['Fecha_Prox_Seguimiento']) ? trim($_POST['Fecha_Prox_Seguimiento']) : FALSE;
            
            $pros = new Prospecto();
            $pros->setID($id);
            $pros->setProspecto($Prospecto);
            $pros->setGiro($Giro);
            $pros->setPlaza($Plaza);
            $pros->setTipo($Tipo);
            $pros->setContacto_RH($Contacto_RH);
            $pros->setPuesto($Puesto);
            $pros->setTelefono($Telefono);
            $pros->setCorreo($Correo);
            $pros->setAcciones($Acciones);
            $pros->setAcciones_Realizadas($Acciones_Realizadas);
            $pros->setPeriodicidad($Periodicidad);
            $pros->setFecha_Prox_Seguimiento($Fecha_Prox_Seguimiento);
            $update = $pros->update();
            if ($update) {
                echo 1;
            }else{
                echo 2;
            }
            
        }else{
            header("location:".base_url); 
        }
    }

    public function trabajar(){
        if (Utils::isValid($_SESSION['identity']) && !Utils::isCandidate()) {
            if (isset($_GET['id'])) {
                $id = ($_GET['id']);
                $pros = new Prospecto();
                $pros->setID($id);
                $prospecto = $pros->getOne();
                $page_title = $prospecto->Prospecto.' | RRHH Ingenia';

                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/prospecto/trabajar.php';
                require_once 'views/layout/footer.php';
            }else {
                header('location:'.base_url.'prospecto/index');
            }
        }else {
            header('location:'.base_url);
        }
    }

    public function create_work(){
        if (Utils::isValid($_POST) && !Utils::isCandidate() && !Utils::isCustomer()) {
            $ID = isset($_POST['ID']) ? trim($_POST['ID']) : FALSE;
            $Proveedor_Actual = isset($_POST['Proveedor_Actual']) ? trim($_POST['Proveedor_Actual']) : FALSE;
            $Servicio = isset($_POST['Servicio']) ? trim($_POST['Servicio']) : FALSE;
            $Servicio_Que_Utiliza = isset($_POST['Servicio_Que_Utiliza']) ? trim($_POST['Servicio_Que_Utiliza']) : FALSE;
            $Tipo_Vacantes = isset($_POST['Tipo_Vacantes']) ? trim($_POST['Tipo_Vacantes']) : FALSE;
            $Valor_Vacante = isset($_POST['Valor_Vacante']) ? trim($_POST['Valor_Vacante']) : FALSE;
            $Precio_Ofrecido = isset($_POST['Precio_Ofrecido']) ? trim($_POST['Precio_Ofrecido']) : FALSE;
            $Tiempo_Entrega = isset($_POST['Tiempo_Entrega']) ? trim($_POST['Tiempo_Entrega']) : FALSE;
            $Promedio_Servicios = isset($_POST['Promedio_Servicios']) ? trim($_POST['Promedio_Servicios']) : FALSE;
            $Oferta1 = isset($_POST['Oferta1']) ? trim($_POST['Oferta1']) : FALSE;
            $Precio1 = isset($_POST['Precio1']) ? trim($_POST['Precio1']) : FALSE;
            $Tiempo1 = isset($_POST['Tiempo1']) ? trim($_POST['Tiempo1']) : FALSE;
            $Especificar1 = isset($_POST['Especificar1']) ? trim($_POST['Especificar1']) : FALSE;
            $Garantia1 = isset($_POST['Garantia1']) ? trim($_POST['Garantia1']) : FALSE;
            
            $Oferta2 = isset($_POST['Oferta2']) ? trim($_POST['Oferta2']) : FALSE;
            $Precio2 = isset($_POST['Precio2']) ? trim($_POST['Precio2']) : FALSE;
            $Tiempo2 = isset($_POST['Tiempo2']) ? trim($_POST['Tiempo2']) : FALSE;
            $Especificar2 = isset($_POST['Especificar2']) ? trim($_POST['Especificar2']) : FALSE;
            $Garantia2 = isset($_POST['Garantia2']) ? trim($_POST['Garantia2']) : FALSE;

            $Acuerdos = isset($_POST['Acuerdos']) ? trim($_POST['Acuerdos']) : FALSE;
            $Comentarios_Acuerdos = isset($_POST['Comentarios_Acuerdos']) ? trim($_POST['Comentarios_Acuerdos']) : FALSE;
            $Acciones = isset($_POST['Acciones']) ? trim($_POST['Acciones']) : FALSE;
            $Acciones_Realizadas = isset($_POST['Acciones_Realizadas']) ? trim($_POST['Acciones_Realizadas']) : FALSE;
            $Fecha_Prox_Seguimiento = isset($_POST['Fecha_Prox_Seguimiento']) ? trim($_POST['Fecha_Prox_Seguimiento']) : FALSE;
            $Periodicidad = isset($_POST['Periodicidad']) ? trim($_POST['Periodicidad']) : FALSE;

            $pros = new Prospecto();
            $pros->setID($ID);
            $pros->setProveedor_Actual($Proveedor_Actual);
            $pros->setServicio($Servicio);
            $pros->setServicio_Que_Utiliza($Servicio_Que_Utiliza);
            $pros->setTipo_Vacantes($Tipo_Vacantes);
            $pros->setValor_Vacante($Valor_Vacante);
            $pros->setPrecio_Ofrecido($Precio_Ofrecido);
            $pros->setTiempo_Entrega($Tiempo_Entrega);
            $pros->setPromedio_Servicios($Promedio_Servicios);
            $pros->setOferta1($Oferta1);
            $pros->setPrecio1($Precio1);
            $pros->setTiempo1($Tiempo1);
            $pros->setEspecificar1($Especificar1);
            $pros->setGarantia1($Garantia1);
            $pros->setOferta2($Oferta2);
            $pros->setPrecio2($Precio2);
            $pros->setTiempo2($Tiempo2);
            $pros->setEspecificar2($Especificar2);
            $pros->setGarantia2($Garantia2);
            $pros->setAcuerdos($Acuerdos);
            $pros->setComentarios_Acuerdos($Comentarios_Acuerdos);
            $pros->setAcciones($Acciones);
            $pros->setAcciones_Realizadas($Acciones_Realizadas);
            $pros->setFecha_Prox_Seguimiento($Fecha_Prox_Seguimiento);
            $pros->setPeriodicidad($Periodicidad);
            $save = $pros->create_work();
            if ($save) {
                echo 1;
            }else{
                echo 2;
            }
            
        }else{
            header("location:".base_url); 
        }
    }

    public function update_work(){
        if (Utils::isValid($_POST) && !Utils::isCandidate() && !Utils::isCustomer()) {
            $ID = isset($_POST['ID']) ? trim($_POST['ID']) : FALSE;
            $Proveedor_Actual = isset($_POST['Proveedor_Actual']) ? trim($_POST['Proveedor_Actual']) : FALSE;
            $Servicio = isset($_POST['Servicio']) ? trim($_POST['Servicio']) : FALSE;
            $Servicio_Que_Utiliza = isset($_POST['Servicio_Que_Utiliza']) ? trim($_POST['Servicio_Que_Utiliza']) : FALSE;
            $Tipo_Vacantes = isset($_POST['Tipo_Vacantes']) ? trim($_POST['Tipo_Vacantes']) : FALSE;
            $Valor_Vacante = isset($_POST['Valor_Vacante']) ? trim($_POST['Valor_Vacante']) : FALSE;
            $Precio_Ofrecido = isset($_POST['Precio_Ofrecido']) ? trim($_POST['Precio_Ofrecido']) : FALSE;
            $Tiempo_Entrega = isset($_POST['Tiempo_Entrega']) ? trim($_POST['Tiempo_Entrega']) : FALSE;
            $Promedio_Servicios = isset($_POST['Promedio_Servicios']) ? trim($_POST['Promedio_Servicios']) : FALSE;
            $Oferta1 = isset($_POST['Oferta1']) ? trim($_POST['Oferta1']) : FALSE;
            $Precio1 = isset($_POST['Precio1']) ? trim($_POST['Precio1']) : FALSE;
            $Tiempo1 = isset($_POST['Tiempo1']) ? trim($_POST['Tiempo1']) : FALSE;
            $Especificar1 = isset($_POST['Especificar1']) ? trim($_POST['Especificar1']) : FALSE;
            $Garantia1 = isset($_POST['Garantia1']) ? trim($_POST['Garantia1']) : FALSE;
            
            $Oferta2 = isset($_POST['Oferta2']) ? trim($_POST['Oferta2']) : FALSE;
            $Precio2 = isset($_POST['Precio2']) ? trim($_POST['Precio2']) : FALSE;
            $Tiempo2 = isset($_POST['Tiempo2']) ? trim($_POST['Tiempo2']) : FALSE;
            $Especificar2 = isset($_POST['Especificar2']) ? trim($_POST['Especificar2']) : FALSE;
            $Garantia2 = isset($_POST['Garantia2']) ? trim($_POST['Garantia2']) : FALSE;

            $Acuerdos = isset($_POST['Acuerdos']) ? trim($_POST['Acuerdos']) : FALSE;
            $Comentarios_Acuerdos = isset($_POST['Comentarios_Acuerdos']) ? trim($_POST['Comentarios_Acuerdos']) : FALSE;
            $Acciones = isset($_POST['Acciones']) ? trim($_POST['Acciones']) : FALSE;
            $Acciones_Realizadas = isset($_POST['Acciones_Realizadas']) ? trim($_POST['Acciones_Realizadas']) : FALSE;
            $Fecha_Prox_Seguimiento = isset($_POST['Fecha_Prox_Seguimiento']) ? trim($_POST['Fecha_Prox_Seguimiento']) : FALSE;
            $Periodicidad = isset($_POST['Periodicidad']) ? trim($_POST['Periodicidad']) : FALSE;

            $pros = new Prospecto();
            $pros->setID($ID);
            $pros->setProveedor_Actual($Proveedor_Actual);
            $pros->setServicio($Servicio);
            $pros->setServicio_Que_Utiliza($Servicio_Que_Utiliza);
            $pros->setTipo_Vacantes($Tipo_Vacantes);
            $pros->setValor_Vacante($Valor_Vacante);
            $pros->setPrecio_Ofrecido($Precio_Ofrecido);
            $pros->setTiempo_Entrega($Tiempo_Entrega);
            $pros->setPromedio_Servicios($Promedio_Servicios);
            $pros->setOferta1($Oferta1);
            $pros->setPrecio1($Precio1);
            $pros->setTiempo1($Tiempo1);
            $pros->setEspecificar1($Especificar1);
            $pros->setGarantia1($Garantia1);
            $pros->setOferta2($Oferta2);
            $pros->setPrecio2($Precio2);
            $pros->setTiempo2($Tiempo2);
            $pros->setEspecificar2($Especificar2);
            $pros->setGarantia2($Garantia2);
            $pros->setAcuerdos($Acuerdos);
            $pros->setComentarios_Acuerdos($Comentarios_Acuerdos);
            $pros->setAcciones($Acciones);
            $pros->setAcciones_Realizadas($Acciones_Realizadas);
            $pros->setFecha_Prox_Seguimiento($Fecha_Prox_Seguimiento);
            $pros->setPeriodicidad($Periodicidad);
            $update = $pros->update_work();
            if ($update) {
                echo 1;
            }else{
                echo 2;
            }
            
        }else{
            header("location:".base_url); 
        }
    }

    public function propuesta_reclutamiento(){
        if (isset($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer() && isset($_POST['id_prospecto'])) {
            require_once 'libraries/fpdf/fpdf.php';
            require_once 'helpers/Propuestas/Reclutamiento.php';

            $id = ($_POST['id_prospecto']);
            $cuota = $_POST['Cuota_Reclutamiento'];
            $garantia = $_POST['Garantia_Renuncia'];
            $pros = new Prospecto();
            $pros->setID($id);
            $pros->setCuota_Reclutamiento($cuota);
            $pros->setGarantia_Renuncia($garantia);
            $prospecto = $pros->getOne();
            if (!$prospecto) {
                header("location:".base_url."prospecto/index");
            }

            $pros->updateCuota_Reclutamiento();
            
            $pdf = new Reclutamiento("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->SetTitle("Propuesta Reclutamiento", true);
            $pdf->SetFont('Times');
            $pdf->SetMargins(0, 55, 87, 0);
            $pdf->AddPage();
            $pdf->setText($prospecto, $cuota, $garantia);
            $pdf->Output('I', 'Propuesta Reclutamiento '.$prospecto->Prospecto.'.pdf', true);
        }else{
            header("location:".base_url);
        }
    }

    public function propuesta_atraccion_talento(){
        if (isset($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer() && isset($_POST['id_prospecto'])) {
            require_once 'libraries/fpdf/fpdf.php';
            require_once 'helpers/Propuestas/Atraccion_Talento.php';

            $id = ($_POST['id_prospecto']);
            $precio = $_POST['Precio_Atraccion'];
            $pros = new Prospecto();
            $pros->setID($id);
            $pros->setPrecio_Atraccion($precio);
            $prospecto = $pros->getOne();
            if (!$prospecto) {
                header("location:".base_url."prospecto/index");
            }

            $pros->updatePrecio_Atraccion();

            $pdf = new Atraccion_Talento("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->SetTitle("Propuesta Atraccion de Talento", true);
            $pdf->SetFont('Times');
            $pdf->SetMargins(0, 55, 87, 0);
            $pdf->AddPage();
            $pdf->setText($prospecto, $precio);
            $pdf->Output('I', 'Propuesta Atraccion de Talento '.$prospecto->Prospecto.'.pdf', true);
        }else{
            header("location:".base_url);
        }
    }

    public function propuesta_psicometrias(){
        if (isset($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer() && isset($_POST['id_prospecto'])) {
            require_once 'libraries/fpdf/fpdf.php';
            require_once 'helpers/Propuestas/Psicometrias.php';

            $id = ($_POST['id_prospecto']);
            $precio = $_POST['Precio_Psicometria'];
            $pros = new Prospecto();
            $pros->setID($id);
            $pros->setPrecio_Psicometria($precio);
            $prospecto = $pros->getOne();
            if (!$prospecto) {
                header("location:".base_url."prospecto/index");
            }

            $pros->updatePrecio_Psicometria();

            $pdf = new Psicometrias("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AddFont('SinkinSansLight','', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans','', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans','I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans','B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans','BI', 'SinkinSans-700BoldItalic.php');
            $pdf->SetTitle("Propuesta Psicometrias", true);
            $pdf->SetFont('Times');
            $pdf->SetMargins(0, 55, 87, 0);
            $pdf->AddPage();
            $pdf->setText($prospecto, $precio);
            $pdf->Output('I', 'Propuesta Psicometrias '.$prospecto->Prospecto.'.pdf', true);
        }else{
            header("location:".base_url);
        }
    }

   public function propuesta_sa()
    {
        if (isset($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer() && isset($_POST['id_prospecto'])) {
            require_once 'libraries/fpdf/fpdf.php';
            require_once 'helpers/Propuestas/SA.php';

            $id = ($_POST['id_prospecto']);
            $ral = $_POST['Precio_RAL'];
            $inv = $_POST['Precio_Inv'];
            $ese = $_POST['Precio_ESE'];
            $pros = new Prospecto();
            $pros->setID($id);
            $pros->setPrecio_RAL($ral);
            $pros->setPrecio_Inv($inv);
            $pros->setPrecio_ESE($ese);
            $prospecto = $pros->getOne();
            if (!$prospecto) {
                header("location:" . base_url . "prospecto/index");
            }

            $pros->updatePrecios_SA();

            $propuestas = array('Nuestro servicio inicia con la obtención de un reporte de antecedentes legales, un reporte de índole laboral, penal, civil y/o mercantil (demandas por deudas) y toda información del candidato que pueda servir para descartar que sea conflictivo o de riesgo si fuera contratado.', 'Hacer más completa la parte de investigación laboral, es decir validar empleadores anteriores, incluso si está trabajando solicitar un recibo de nómina reciente.', 'Asegurarnos que no sea una persona con conflictos laborales, malas notas o faltas de probidad en sus empleos anteriores.', 'Obtención de empleos no declarados por el candidato y realizar la investigación correspondiente cuando existan dichos empleos ocultos.', 'En caso de que no se pueda obtener referencias directamente con RH, solicitaremos las constancias correspondientes, mismas que deberán coincidir con las bases de datos de empleos o registros patronales. Así mismo y contando con lo anterior, podremos validar con el jefe inmediato su desempeño, siempre explicando por qué no fue posible que RH nos diera información.', 'Continuar con la programación de la verificación domiciliaria en caso de detectar que el candidato no es viable para contratación ya sea por registros legales o por referencias laborales, en ese momento se detiene el proceso y se ajusta la tarifa del servicio. Logrando no generar costos innecesarios para ustedes como clientes.');

            $concepto = array("Revisión de antecedentes legales.\n
Costo total único cuando  el cliente solo solicite el RAL, o el proceso se interrumpa en esta fase.
", 'Investigación Laboral

Costo total único, cuando  el cliente solicite hasta la  investigación laboral o el proceso se interrumpa en esta fase, este precio ya incluye el RAL.
', 'Verificación domiciliaria

Costo total y único si completa todo el proceso, este precio ya incluye el RAL y la Investigación laboral.
');


            $descripcion = array('-Se revisan los antecedentes legales del candidato y se comparten los resultados por medio de la plataforma.

-Tiempo de entrega, inmediata.
', '-Investigación de referencias laborales del 2022 a la fecha.

-Aseguramos que no sea una persona inestable.

-Obtención de empleos no declarados por el candidato y realizar la investigación correspondiente.
', '-Corroboramos aspectos relacionados con situación del inmueble, cuadro familiar, ingresos y egresos, cotejo de documentación (personal y laboral) y referencias (personales y vecinales).

-Fotografía del interior y exterior del domicilio.

-Fotografía del candidato.

-Ubicación por geolocalización del domicilio del candidato.

-Tiempo de entrega 72 horas.');

            $pdf = new SA("P", "pt", "Letter");
            require('./libraries/fpdf/makefont/makefont.php');
            $pdf->AddFont('SinkinSansLight', '', 'SinkinSans-300Light.php');
            $pdf->AddFont('SinkinSans', '', 'SinkinSans-400Regular.php');
            $pdf->AddFont('SinkinSans', 'I', 'SinkinSans-400Italic.php');
            $pdf->AddFont('SinkinSans', 'B', 'SinkinSans-700Bold.php');
            $pdf->AddFont('SinkinSans', 'BI', 'SinkinSans-700BoldItalic.php');
            $pdf->SetTitle("Propuesta SA", true);
            $pdf->SetFont('Times');
            $pdf->SetMargins(0, 55, 87, 0);
            $pdf->AddPage();


            $pdf->setText($prospecto, $ral, $inv, $ese, $propuestas,   $concepto, $descripcion);
            $pdf->Output('I', 'Propuesta SA ' . $prospecto->Prospecto . '.pdf', true);
        } else {
            header("location:" . base_url);
        }
    }
}
