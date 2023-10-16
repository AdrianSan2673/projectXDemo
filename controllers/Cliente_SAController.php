<?php

require_once 'models/SA/Clientes.php';
require_once 'models/SA/CandidatosReferencias.php';
require_once 'models/SA/ContactosCliente.php';
require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/ClientesNotas.php';
require_once 'models/SA/Prospecto.php';
require_once 'models/SA/Candidatos.php';
require_once 'models/SA/ContactosClienteCobranza.php';

class Cliente_SAController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {
            $cliente = new Clientes();
            if ($_SESSION['identity']->id == 9396) {
                $cliente->setCreado_por($_SESSION['identity']->username);
                $clientes = $cliente->getAllClientesCreadoPor();
            } else {
                $clientes = $cliente->getAllClientes();
            }
            $page_title = 'Nuestros clientes SA | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/cliente/index.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function crear()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager())) {

            if (isset($_GET['prospecto'])) {
                $id = Encryption::decode($_GET['prospecto']);
                $prospecto = new Prospecto();
                $prospecto->setID($id);
                $prospecto = $prospecto->getOne();
            }

            $page_title = 'Nuevo cliente | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/cliente/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function ver()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $cliente = new Clientes();
                $cliente->setCliente($id);
                $cliente = $cliente->getOne();

                $contacto = new ContactosCliente();
                $contacto->setID_Cliente($id);
                $contactos = $contacto->getContactosPorCliente();

                $contactoCobranzaObj = new ContactosClienteCobranza();
                $contactoCobranzaObj->setId_cliente($id);
                $contactoCobranza = $contactoCobranzaObj->getALLById_cliente();

                $razon = new RazonesSociales();
                $razon->setID_Cliente($id);
                $razones = $razon->getRazonesSocialesPorCliente();

                for ($i = 0; $i < count($razones); $i++) {
                    $path = 'uploads/situacionesfiscales/' . $cliente->Empresa . '/' . $razones[$i]['RFC'];
                    if (file_exists($path)) {
                        $directory = opendir($path);
                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $route = $path . '/' . $file;
                            }
                        }
                        $razones[$i]['archivo'] = base_url . $route;
                    }
                }

                $nota = new ClientesNotas();
                $nota->setID_Cliente($id);
                $notas = $nota->getNotasPorCliente();
                for ($i = 0; $i < count($notas); $i++) {
                    $path = 'uploads/avatar/' . $notas[$i]['id_user'];
                    if (file_exists($path)) {
                        $directory = opendir($path);

                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $img_content = file_get_contents($path . "/" . $file);
                                $route = $path . '/' . $file;
                            }
                        }
                    } else {
                        $route = "dist/img/user-icon.png";
                        $type = pathinfo($route, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($route);
                    }
                    $notas[$i]['avatar'] = base_url . $route;
                }

                $page_title = $cliente->Nombre_Cliente . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/cliente/read.php';
                require_once 'views/cliente/modal-cliente.php';
                require_once 'views/cliente/modal-servicios.php';
                require_once 'views/cliente/modal-condiciones.php';
                require_once 'views/cliente/modal-facturacion.php';
                require_once 'views/cliente/modal-cuentas.php';
                require_once 'views/cliente/modal-comentario.php';
                require_once 'views/empresa/modal-contacto.php';
                require_once 'views/empresa/modal-razon.php';
                require_once 'views/cliente/modal-contactos.php';
                require_once 'views/cliente/modal-razones.php';
                require_once 'views/cliente/modal-nota.php';
                require_once 'views/layout/footer.php';
            } else
                header('location:' . base_url . 'cliente/index');
        } else
            header('location:' . base_url);
    }

    public function getOne()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isSales() || Utils::isSalesManager()) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);

            if ($Cliente) {
                $customer = new Clientes();
                $customer->setCliente($Cliente);
                $data = $customer->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
            } else echo 0;
        } else
            header('location:' . base_url);
    }

    public function base_contactos()
    {
        if (Utils::isValid($_SESSION['identity']) && (!Utils::isCandidate() && !Utils::isCustomer())) {
            $referencia = new CandidatosReferencias();
            $base_contactos = $referencia->getBaseContactos();

            $page_title = 'Base de contactos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/cliente/base.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }
    
    public function save()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            $Nombre_Cliente = Utils::sanitizeString($_POST['Nombre_Cliente']);
            $ESE = Utils::sanitizeNumber($_POST['ESE']);
            $RAL = Utils::sanitizeNumber($_POST['RAL']);
            $Investigacion_L = Utils::sanitizeNumber($_POST['Investigacion_L']);
            $Validacion_Licencia = Utils::sanitizeNumber($_POST['Validacion_Licencia']);
            $ESE_Visita = Utils::sanitizeNumber($_POST['ESE_Visita']);
            $Paquetes = Utils::sanitizeStringBlank($_POST['Paquetes']);
            $Plazo_Credito = Utils::sanitizeStringBlank($_POST['Plazo_Credito']);
            $Corte_Servicio = Utils::sanitizeNumber($_POST['Corte_Servicio']);
            //$Fechas_Especificas = Utils::sanitizeStringBlank($_POST['Fechas_Especificas']);
            $OC_NP = Utils::sanitizeStringBlank($_POST['OC_NP']);
            $Recepcion_Facturas = Utils::sanitizeStringBlank($_POST['Recepcion_Facturas']);
            $Uso_Portal = Utils::sanitizeNumber($_POST['Uso_Portal']);
            $Portal_Direccion = Utils::sanitizeStringBlank($_POST['Portal_Direccion']);
            $Portal_Usuario = Utils::sanitizeStringBlank($_POST['Portal_Usuario']);
            $Portal_Contraseña = $_POST['Portal_Contraseña'];
            $Centro_Costos = Utils::sanitizeStringBlank($_POST['Centro_Costos']);
            $Cuentas_Contacto = Utils::sanitizeStringBlank($_POST['Cuentas_Contacto']);
            $Cuentas_Correo = Utils::sanitizeStringBlank($_POST['Cuentas_Correo']);
            $Cuentas_Telefono = Utils::sanitizeStringBlank($_POST['Cuentas_Telefono']);
            $Cuentas_Extension = Utils::sanitizeStringBlank($_POST['Cuentas_Extension']);
            $Comentario = Utils::sanitizeStringBlank($_POST['Comentario']);
            $Dias_Credito = Utils::sanitizeNumber($_POST['Dias_Credito']);

            $Corte_Semanal = isset($_POST['Corte_Semanal']) ? $_POST['Corte_Semanal'] : '--Sin Asignar--';
            $Corte_Quincenal = isset($_POST['Corte_Q1']) && isset($_POST['Corte_Q2']) ? str_pad($_POST['Corte_Q1'], 2, "0", STR_PAD_LEFT) . '.' . str_pad($_POST['Corte_Q2'], 2, "0", STR_PAD_LEFT) : '--Sin Asignar--.--Sin Asignar--';
            $Corte_Mensual = isset($_POST['Corte_Mensual']) ? str_pad($_POST['Corte_Mensual'], 2, "0", STR_PAD_LEFT) : '--Sin Asignar--';

            $Fechas_Especificas = $Corte_Servicio == 1 ? 'Contraentrega' : ($Corte_Servicio == 2 ? $Corte_Semanal : ($Corte_Servicio == 3 ? $Corte_Quincenal : ($Corte_Servicio == 4 ? $Corte_Mensual : '')));

            if ($Empresa && $Nombre_Cliente && $Corte_Servicio && $Centro_Costos && $Dias_Credito) {
                $ESE = $ESE ? $ESE : 0;
                $Investigacion_L = $Investigacion_L ? $Investigacion_L : 0;
                $RAL = $RAL ? $RAL : 0;
                $Validacion_Licencia = $Validacion_Licencia ? $Validacion_Licencia : 0;
                $cliente = new Clientes();
                $cliente->setEmpresa($Empresa);
                $cliente->setNombre_Cliente($Nombre_Cliente);
                $cliente->setESE($ESE);
                $cliente->setRAL($RAL);
                $cliente->setInvestigacion_L($Investigacion_L);
                $cliente->setValidacion_Licencia($Validacion_Licencia);
                $cliente->setESE_Visita($ESE_Visita);
                $cliente->setPaquetes($Paquetes);
                $cliente->setPlazo_Credito($Plazo_Credito);
                $cliente->setCorte_Servicio($Corte_Servicio);
                $cliente->setFechas_Especificas($Fechas_Especificas);
                $cliente->setOC_NP($OC_NP);
                $cliente->setRecepcion_Facturas($Recepcion_Facturas);
                $cliente->setUso_Portal($Uso_Portal);
                $cliente->setPortal_Direccion($Portal_Direccion);
                $cliente->setPortal_Usuario($Portal_Usuario);
                $cliente->setPortal_Contraseña($Portal_Contraseña);
                $cliente->setCentro_Costos($Centro_Costos);
                $cliente->setCuentas_Contacto($Cuentas_Contacto);
                $cliente->setCuentas_Correo($Cuentas_Correo);
                $cliente->setCuentas_Telefono($Cuentas_Telefono);
                $cliente->setCuentas_Extension($Cuentas_Extension);
                $cliente->setComentario($Comentario);
                $cliente->setDias_Credito($Dias_Credito);
                //===[gabo 7 agosto creado por ]===
                $cliente->setCreado_por($_SESSION['identity']->username);
                //===[gabo 7 agosto creado por fin===
                $save = $cliente->create();
                if ($save) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'id' => Encryption::encode($cliente->getCliente())
                        )
                    );
                } else echo json_encode(array('status' => 2));
            } else echo json_encode(array('status' => 0));
        } else {
            header('location:' . base_url);
        }
    }

    public function updateNombreCliente()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            $Nombre_Cliente = Utils::sanitizeString($_POST['Nombre_Cliente']);
            //===[gabo 8 agosto creado por ]===
            $creado_por = isset($_POST['creado_por']) ? Utils::sanitizeStringBlank($_POST['creado_por']) : false;
            //===[gabo 8 agosto creado por fin===


            if ($Empresa && $Nombre_Cliente && $Cliente) {
                $cliente = new Clientes();
                $cliente->setCliente($Cliente);
                $cliente->setEmpresa($Empresa);
                $cliente->setNombre_Cliente($Nombre_Cliente);
                //===[gabo 8 agosto creado por ]===
                $cliente->setCreado_por($creado_por);
                //===[gabo 8 agosto creado por fin===
                $save = $cliente->updateNombreCliente();


                if ($save) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'cliente' => $cliente->getOne()
                        )
                    );
                } else echo json_encode(array('status' => 2));
            } else echo json_encode(array('status' => 0));
        } else {
            header('location:' . base_url);
        }
    }

    public function updateServicios(){
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager()|| Utils::isSales()||Utils::isSalesManager())) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Tiene_IL = isset($_POST['Tiene_IL']) ? 1 : 0;
            $Tiene_ESE = isset($_POST['Tiene_ESE']) ? 1 : 0;
            $Tiene_SOI = isset($_POST['Tiene_SOI']) ? 1 : 0;
            $Tiene_SMART = isset($_POST['Tiene_SMART']) ? 1 : 0;

            if ($Cliente) {
                $cliente = new Clientes();
                $cliente->setCliente($Cliente);
                $cliente->setTiene_IL($Tiene_IL);
                $cliente->setTiene_ESE($Tiene_ESE);
                $cliente->setTiene_SOI($Tiene_SOI);
                $cliente->setTiene_SMART($Tiene_SMART);
                
                $save = $cliente->updateServicios();
                if ($save) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'cliente' => $cliente->getOne()
                        )
                    );
                }else echo json_encode(array('status' => 2));

            }else echo json_encode(array('status' => 0));
        }else{
            header('location:'.base_url);
        }
    }

    public function updateCondiciones()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager())) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $ESE = Utils::sanitizeString($_POST['ESE']);
            $RAL = Utils::sanitizeString($_POST['RAL']);
            $Investigacion_L = Utils::sanitizeString($_POST['Investigacion_L']);
            $Validacion_Licencia = Utils::sanitizeString($_POST['Validacion_Licencia']);
            $ESE_Visita =  isset($_POST['ESE_Visita'])? Utils::sanitizeString($_POST['ESE_Visita']):0.00;
            $Paquetes = Utils::sanitizeStringBlank($_POST['Paquetes']);
            $Plazo_Credito = Utils::sanitizeStringBlank($_POST['Plazo_Credito']);
            $Dias_Credito = Utils::sanitizeNumber($_POST['Dias_Credito']);
            $SMART = Utils::sanitizeNumber($_POST['SMART']);

            if ($Cliente && $Dias_Credito) {
                $ESE = $ESE ? $ESE : 0;
                $Investigacion_L = $Investigacion_L ? $Investigacion_L : 0;
                $RAL = $RAL ? $RAL : 0;
                $Validacion_Licencia = $Validacion_Licencia ? $Validacion_Licencia : 0;
                $cliente = new Clientes();
                $cliente->setCliente($Cliente);
                $cliente->setESE($ESE);
                $cliente->setRAL($RAL);
                $cliente->setInvestigacion_L($Investigacion_L);
                $cliente->setValidacion_Licencia($Validacion_Licencia);
                $cliente->setESE_Visita($ESE_Visita);
                $cliente->setPaquetes($Paquetes);
                $cliente->setPlazo_Credito($Plazo_Credito);
                $cliente->setDias_Credito($Dias_Credito);
                $cliente->setSMART($SMART);

                $customer = $cliente->getOne();
                $precioRAL = $customer->RAL;
                $precioIL = $customer->Investigacion_L;
                $precioESE = $customer->ESE;
                $precioESE_SMART = $customer->SMART;
                $precioESE_Visita = $customer->ESE_Visita;
                $precioVL = $customer->Validacion_Licencia;
                $Nombre_Cliente = $customer->Nombre_Cliente;

                $save = $cliente->updateCondicionesCliente();
                if ($save) {
                    if (($precioRAL != $RAL) || ($precioIL != $Investigacion_L) || ($precioESE != $ESE) || ($precioVL != $Validacion_Licencia) || ($precioESE_Visita != $ESE_Visita)|| ($precioESE_SMART != $SMART)) {
                        $email = 'facturacion@rrhhingenia.com';
                        $email1 = 'yadira.villanueva@rrhhingenia.com';
                        $name = 'Marisa Vallejo';
                        $name1 = 'Yadira Villanueva';
                        $subject = 'Cambio de Precios de ' . $Nombre_Cliente;
                        $changed_by = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;
                        $greetings = date('G') < 6 || date('G') > 19 ? 'Buenas noches' : (date('G') >= 6 && date('G') < 12 ? 'Buenos días' : 'Buenas tardes');

                        $flag_RAL = ($precioRAL != $RAL ? '<li><b>RAL</b> Precio Anterior: $' . number_format($precioRAL, 2) . '. | Precio Actual: $' . number_format($RAL, 2) . '</li>' : '');
                        $flag_IL = ($precioIL != $Investigacion_L ? '<li><b>Investigación Laboral</b> Precio Anterior: $' . number_format($precioIL, 2) . '. | Precio Actual: $' . number_format($Investigacion_L, 2) . '</li>' : '');
                        $flag_ESE = ($precioESE != $ESE ? '<li><b>Verificación Domiciliaria</b> Precio Anterior: $' . number_format($precioESE, 2) . '. | Precio Actual: $' . number_format($ESE, 2) . '</li>' : '');
                        $flag_ESE_SMART = ($precioESE_SMART != $SMART ? '<li><b>SMART</b> Precio Anterior: $' . number_format($precioESE_SMART, 2) . '. | Precio Actual: $' . number_format($SMART, 2) . '</li>' : '');
                        $flag_ESE_Visita = ($precioESE_Visita != $ESE_Visita ? '<li><b>Estudio Socioeconómico + Visita Presencial</b> Precio Anterior: $' . number_format($precioESE_Visita, 2) . '. | Precio Actual: $' . number_format($ESE_Visita, 2) . '</li>' : '');
                        $flag_VL = ($precioVL != $Validacion_Licencia ? '<li><b>RAL</b> Precio Anterior: $' . number_format($precioVL, 2) . '. | Precio Actual: $' . number_format($Validacion_Licencia, 2) . '</li>' : '');
                        $body = "{$greetings}, Lic. {$name}<br><br>Se le informa que hubo un cambio de precios del cliente <u>{$Nombre_Cliente}</u> realizado por {$changed_by}.<br><br><ul>{$flag_RAL}{$flag_IL}{$flag_ESE}{$flag_ESE_Visita}{$flag_ESE_SMART}{$flag_VL}</ul>";
                        $body1 = "{$greetings}, Lic. {$name1}<br><br>Se le informa que hubo un cambio de precios del cliente <u>{$Nombre_Cliente}</u> realizado por {$changed_by}.<br><br><ul>{$flag_RAL}{$flag_IL}{$flag_ESE}{$flag_ESE_Visita}{$flag_ESE_SMART}{$flag_VL}</ul>";
                        Utils::sendEmail($email, $name, $subject, $body);
                        Utils::sendEmail($email1, $name1, $subject, $body1);
                    }
                	$cliente=$cliente->getOne();
                    $cliente->Validacion_Licencia=number_format($cliente->Validacion_Licencia, 2);
                    $cliente->RAL=number_format($cliente->RAL, 2);
                    $cliente->Investigacion_L=number_format($cliente->Investigacion_L, 2);
                    $cliente->ESE=number_format($cliente->ESE, 2);
                    $cliente->ESE_Visita=number_format($cliente->ESE_Visita, 2);
                    $cliente->SMART=number_format($cliente->SMART, 2);


                    echo json_encode(
                        array(
                            'status' => 1,
                            'cliente' => $cliente
                        )
                    );
                } else echo json_encode(array('status' => 2));
            } else echo json_encode(array('status' => 0));
        } else {
           echo json_encode(array('status' => 0));
        }
    }

    public function updateFacturacion()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Corte_Servicio = Utils::sanitizeNumber($_POST['Corte_Servicio']);
            //$Fechas_Especificas = Utils::sanitizeStringBlank($_POST['Fechas_Especificas']);
            $OC_NP = Utils::sanitizeStringBlank($_POST['OC_NP']);
            $Recepcion_Facturas = Utils::sanitizeStringBlank($_POST['Recepcion_Facturas']);
            $Uso_Portal = Utils::sanitizeNumber($_POST['Uso_Portal']);
            $Portal_Direccion = Utils::sanitizeStringBlank($_POST['Portal_Direccion']);
            $Portal_Usuario = Utils::sanitizeStringBlank($_POST['Portal_Usuario']);
            $Portal_Contraseña = $_POST['Portal_Contraseña'];
            $Centro_Costos = Utils::sanitizeStringBlank($_POST['Centro_Costos']);

            $Corte_Semanal = isset($_POST['Corte_Semanal']) ? $_POST['Corte_Semanal'] : '--Sin Asignar--';
            $Corte_Quincenal = isset($_POST['Corte_Q1']) && isset($_POST['Corte_Q2']) ? str_pad($_POST['Corte_Q1'], 2, "0", STR_PAD_LEFT) . ',' . str_pad($_POST['Corte_Q2'], 2, "0", STR_PAD_LEFT) : '--Sin Asignar--.--Sin Asignar--';
            $Corte_Mensual = isset($_POST['Corte_Mensual']) ? str_pad($_POST['Corte_Mensual'], 2, "0", STR_PAD_LEFT) : '--Sin Asignar--';

            $Fechas_Especificas = $Corte_Servicio == 1 ? 'Contraentrega' : ($Corte_Servicio == 2 ? $Corte_Semanal : ($Corte_Servicio == 3 ? $Corte_Quincenal : ($Corte_Servicio == 4 ? $Corte_Mensual : '')));

            if ($Cliente && $Corte_Servicio && $Centro_Costos) {
                $cliente = new Clientes();
                $cliente->setCliente($Cliente);
                $cliente->setCorte_Servicio($Corte_Servicio);
                $cliente->setFechas_Especificas($Fechas_Especificas);
                $cliente->setOC_NP($OC_NP);
                $cliente->setRecepcion_Facturas($Recepcion_Facturas);
                $cliente->setUso_Portal($Uso_Portal);
                $cliente->setPortal_Direccion($Portal_Direccion);
                $cliente->setPortal_Usuario($Portal_Usuario);
                $cliente->setPortal_Contraseña($Portal_Contraseña);
                $cliente->setCentro_Costos($Centro_Costos);
                $save = $cliente->updateFacturacionCliente();
                if ($save) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'cliente' => $cliente->getOne()
                        )
                    );
                } else echo json_encode(array('status' => 2));
            } else echo json_encode(array('status' => 0));
        } else {
            header('location:' . base_url);
        }
    }

    public function updateCuentas()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Cuentas_Contacto = Utils::sanitizeStringBlank($_POST['Cuentas_Contacto']);
            $Cuentas_Correo = Utils::sanitizeStringBlank($_POST['Cuentas_Correo']);
            $Cuentas_Telefono = Utils::sanitizeStringBlank($_POST['Cuentas_Telefono']);
            $Cuentas_Extension = Utils::sanitizeStringBlank($_POST['Cuentas_Extension']);

            if ($Cliente) {
                $cliente = new Clientes();
                $cliente->setCliente($Cliente);
                $cliente->setCuentas_Contacto($Cuentas_Contacto);
                $cliente->setCuentas_Correo($Cuentas_Correo);
                $cliente->setCuentas_Telefono($Cuentas_Telefono);
                $cliente->setCuentas_Extension($Cuentas_Extension);
                $save = $cliente->updateCuentasCliente();
                if ($save) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'cliente' => $cliente->getOne()
                        )
                    );
                } else echo json_encode(array('status' => 2));
            } else echo json_encode(array('status' => 0));
        } else {
            header('location:' . base_url);
        }
    }

    public function updateComentario()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Comentario = Utils::sanitizeStringBlank($_POST['Comentario']);


            if ($Cliente) {
                $cliente = new Clientes();
                $cliente->setCliente($Cliente);
                $cliente->setComentario($Comentario);
                $save = $cliente->updateComentarioCliente();
                if ($save) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'cliente' => $cliente->getOne()
                        )
                    );
                } else echo json_encode(array('status' => 2));
            } else echo json_encode(array('status' => 0));
        } else {
            header('location:' . base_url);
        }
    }

    public function detallado()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSAManager())) {
            $Anio = isset($_GET['anio']) ? $_GET['anio'] : date('Y');
            $candidato = new Candidatos();
            $candidato->setFecha_solicitud($Anio);
            $clientes = $candidato->getDetallePorAnio();

            $total_RAL = array('Ene' => 0, 'Feb' => 0, 'Mar' => 0, 'Abr' => 0, 'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Ago' => 0, 'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dic' => 0);
            $total_IL = array('Ene' => 0, 'Feb' => 0, 'Mar' => 0, 'Abr' => 0, 'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Ago' => 0, 'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dic' => 0);
            $total_ESE = array('Ene' => 0, 'Feb' => 0, 'Mar' => 0, 'Abr' => 0, 'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Ago' => 0, 'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dic' => 0);

            $page_title = 'Detallado de clientes | RRHH Ingenia';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/cliente/detail.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }
	
	
    public function eliminarCliente()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin())) {
            $id = Encryption::decode($_POST['Cliente']);

            if ($id) {
                $cliente = new Clientes();
                $cliente->setCliente($id);
                $client = $cliente->getOne();

                $Candidatos = new Candidatos();
                $Candidatos->setCliente($id);
                $Candidatos = $Candidatos->countCandidatosPorCliente()->Total;

                $contacto = new ContactosCliente();
                $contacto->setID_Cliente($id);
                $contactos = $contacto->getContactosPorCliente();

                $contactoCobranzaObj = new ContactosClienteCobranza();
                $contactoCobranzaObj->setId_cliente($id);
                $contactoCobranza = $contactoCobranzaObj->getALLById_cliente();

                $razon = new RazonesSociales();
                $razon->setID_Cliente($id);
                $razones = $razon->getRazonesSocialesPorCliente();

                $nota = new ClientesNotas();
                $nota->setID_Cliente($id);
                $notas = $nota->getNotasPorCliente();

                $eliminar = true;
                $aviso = [];

                if ($Candidatos > 0) {
                    $texto = 'Contiene ' . $Candidatos . " candidatos";
                    array_push($aviso, $texto);
                    $eliminar = false;
                }

                if (count($contactos) > 0) {
                    array_push($aviso, 'Contiene ' . count($contactos) . " contactos.");
                    $eliminar = false;
                }

                if (count($contactoCobranza) > 0) {
                    array_push($aviso, 'Contiene ' . count($contactoCobranza) . " contacto de cobranza.");
                    $eliminar = false;
                }

                if (count($razones) > 0) {
                    array_push($aviso, 'Contiene ' . count($razones) . " razones.");
                    $eliminar = false;
                }

                if (count($notas) > 0) {
                    array_push($aviso, 'Contiene ' . count($notas) . ' notas.');
                    $eliminar = false;
                }

                if ($eliminar == true) {
                    $clienteObj = new Clientes();
                    $clienteObj->setCliente($id);
                    $clienteObj->setEliminado_por($_SESSION['identity']->username);
                    $duplicado = $clienteObj->saveClienteeliminado();

                    $duplicado == true ? $eliminado = $clienteObj->eliminarCliente() : $eliminado = false;

                    if ($eliminado) {
                        $clientes = $cliente->getAllClientes();
                        foreach ($clientes as &$cliente) {

                            $cliente['Fecha_Registro'] = Utils::getShortDate($cliente['Fecha_Registro']);
                            $cliente['Facturacion_Mes'] = number_format($cliente['Facturacion_Mes'], 2);
                            $cliente['Prom_Fact'] = number_format($cliente['Prom_Fact'], 2);
                            $cliente['Anual_Fact'] = number_format($cliente['Anual_Fact']);
                            $cliente['Fecha_Ultima_Evaluacion'] = $cliente['Fecha_Ultima_Evaluacion'] ? Utils::getShortDate($cliente['Fecha_Ultima_Evaluacion']) : '';
                            $cliente['Calificacion'] = $cliente['Calificacion'] ? number_format($cliente['Calificacion'], 2) : 'Sin evaluar';
                            $cliente['Cliente_incriptado'] = Encryption::encode($cliente['Cliente']);
                            $cliente['creado_por'] = $cliente['creado_por'] == null ? '' : $cliente['creado_por'];
                            $cliente['url'] = base_url . 'cliente_SA/ver&id=' . $cliente['Cliente_incriptado'];
                        }
                        echo json_encode(array('status' => 1, 'clientes' => $clientes));
                    } else {
                        echo json_encode(array('status' => 0));
                    }
                } else {
                    echo json_encode(array('status' => 2, 'aviso' => $aviso));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    
}
