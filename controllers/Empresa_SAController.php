<?php

require_once 'models/SA/Empresas.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/RazonesSocialesEmpresa.php';
require_once 'models/SA/Clientes.php';
require_once 'models/SA/Prospecto.php';
//19 SEPT
require_once 'models/SA/Candidatos.php';

require_once 'models/SA/ContactosCliente.php';
require_once 'models/SA/ContactosClienteCobranza.php';
require_once 'models/SA/RazonesSociales.php';
require_once 'models/SA/ClientesNotas.php';









class Empresa_SAController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager())) {
            $empresa = new Empresas();

            if ($_SESSION['identity']->id == 9396) {
                $empresa->setCreado_por($_SESSION['identity']->username);
                $empresas = $empresa->getAllByCreate();
            } else {
                $empresas = $empresa->getAll();
            }

            $page_title = 'Empresas SA | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/empresa/index.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function crear()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {

            $page_title = 'Nueva empresa | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/empresa/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function ver()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $empresa = new Empresas();
                $empresa->setEmpresa($id);
                $empresa = $empresa->getOne();

                $contacto = new ContactosEmpresa();
                $contacto->setEmpresa($id);
                $contactos = $contacto->getContactosPorEmpresa();

                $razon = new RazonesSocialesEmpresa();
                $razon->setEmpresa($id);
                $razones = $razon->getRazonesSocialesPorEmpresa();

                for ($i = 0; $i < count($razones); $i++) {
                    $path = 'uploads/situacionesfiscales/' . $id . '/' . $razones[$i]['RFC'];
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

                $cliente = new Clientes();
                $cliente->setEmpresa($id);
                $clientes = $cliente->getClientesPorEmpresa();


                $page_title = $empresa->Nombre_Empresa . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/empresa/read.php';
                require_once 'views/empresa/modal-empresa.php';
                require_once 'views/empresa/modal-contacto.php';
                require_once 'views/empresa/modal-razon.php';
                require_once 'views/layout/footer.php';
            } else
                header('location:' . base_url . 'empresa/index');
        } else
            header('location:' . base_url);
    }

    public function getOne()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isSales() || Utils::isSalesManager()) {
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);

            if ($Empresa) {
                $enterprise = new Empresas();
                $enterprise->setEmpresa($Empresa);
                $data = $enterprise->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
            } else echo 0;
        } else
            header('location:' . base_url);
    }

    public function save()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isSales() || Utils::isSalesManager()) {
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            $Nombre_Empresa = Utils::sanitizeStringBlank($_POST['Nombre_Empresa']);
            $Alias = Utils::sanitizeStringBlank($_POST['Alias']);
            $Especificaciones = isset($_POST['Especificaciones']) ? Utils::sanitizeStringBlank($_POST['Especificaciones']) : null;
            //===[gabo 7 agosto creado por ]===
            $creado_por = isset($_POST['creado_por']) ? Utils::sanitizeStringBlank($_POST['creado_por']) : false;
            //===[gabo 7 agosto creado por fin===
            $flag = $_POST['flag'];

            if ($Nombre_Empresa && $Alias) {
                $empresa = new Empresas();
                $empresa->setEmpresa($Empresa);
                $empresa->setNombre_Empresa($Nombre_Empresa);
                $empresa->setAlias($Alias);
                $empresa->setNuevo_Procedimiento(1);


                if ($flag == 1) {
                    //===[gabo 7 agosto creado por ]===
                    $empresa->setCreado_por($creado_por);
                    //===[gabo 7 agosto creado por fin===
                    $empresa->setEspecificaciones($Especificaciones);
                    $save = $empresa->update();
                } else {
                    //===[gabo 7 agosto creado por ]===
                    $empresa->setCreado_por($_SESSION['identity']->username);
                    //===[gabo 7 agosto creado por fin===
                    $save = $empresa->create();
                }

                if ($save) {
                    $id = Encryption::encode($empresa->getEmpresa());
                    echo json_encode(
                        array(
                            'status' => 1,
                            'id' => $id
                        )
                    );
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header('location:' . base_url);
    }

    public function save_prospecto()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isSales() || Utils::isSalesManager()) && isset($_GET['prospecto'])) {

            $id = Encryption::decode($_GET['prospecto']);

            $pros = new Prospecto();
            $pros->setID($id);
            $prospecto = $pros->getOne();

            $Nombre_Empresa = Utils::sanitizeStringBlank($prospecto->Prospecto);
            $Alias = Utils::sanitizeStringBlank($prospecto->Prospecto);

            if ($Nombre_Empresa && $Alias) {
                $empresa = new Empresas();
                $empresa->setNombre_Empresa($Nombre_Empresa);
                $empresa->setAlias($Alias);
                $empresa->setNuevo_Procedimiento(1);

                $save = $empresa->create();

                if ($save) {
                    $id = Encryption::encode($empresa->getEmpresa());
                    header('location:' . base_url . 'cliente_SA/crear&prospecto=' . Encryption::encode($prospecto->ID) . '&empresa=' . $id);
                } else
                    header('location:' . base_url . 'prospecto/index');
            } else
                header('location:' . base_url . 'empresa_SA/index');
        } else
            header('location:' . base_url);
    }

    public function inicio()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isCustomerSA())) {
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $ID_Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $empresa = new Empresas();
            $empresa->setEmpresa($ID_Empresa);
            $empresa = $empresa->getOne();

            $cliente = new Clientes();
            $cliente->setEmpresa($ID_Empresa);
            $clientes = $cliente->getClientesPorEmpresa();

            $path = 'uploads/empresa/' . $ID_Empresa;
            if (file_exists($path)) {
                $directory = opendir($path);

                while ($file = readdir($directory)) {
                    if (!is_dir($file)) {
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($path . "/" . $file);
                        $route = base_url . $path . '/' . $file;
                    }
                }
            } else
                $route = false;

            $empresa->logo = $route;

            for ($i = 0; $i < count($clientes); $i++) {
                $path = 'uploads/cliente/' . $clientes[$i]['Cliente'];
                if (file_exists($path)) {
                    $directory = opendir($path);

                    while ($file = readdir($directory)) {
                        if (!is_dir($file)) {
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path . "/" . $file);
                            $route = base_url . $path . '/' . $file;
                        }
                    }
                } else {
                    $route = false;
                }
                $clientes[$i]['logo'] = $route;
            }

            $page_title = 'Empresas SA | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/empresa/inicio.php';
            require_once 'views/empresa/modal-imagen.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function upload_image64()
    {
        if (isset($_SESSION['identity']) && isset($_POST['logo'])) {
            $img = $_POST['logo'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $ID_Empresa = Utils::sanitizeNumber($_POST['ID_Empresa']);
            $ID_Cliente = Utils::sanitizeNumber($_POST['ID_Cliente']);

            if ($ID_Cliente && $ID_Cliente > 0) {
                $route = 'uploads/cliente/' . $ID_Cliente . '/';

                if (file_exists($route)) {
                    Utils::deleteDir('uploads/cliente/' . $ID_Cliente);
                }
            } elseif ($ID_Empresa && $ID_Empresa > 0) {
                $route = 'uploads/empresa/' . $ID_Empresa . '/';

                if (file_exists($route)) {
                    Utils::deleteDir('uploads/empresa/' . $ID_Empresa);
                }
            }

            if (!file_exists($route)) {
                mkdir($route);
            }

            $file = $route . uniqid() . '.png';
            $success = file_put_contents($file, $data);

            if ($success) {
                echo json_encode(
                    array(
                        'status' => 1,
                        'logo' => base_url . $file
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'status' => 0
                    )
                );
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function delete_image64()
    {
        if (isset($_SESSION['identity'])) {
            $ID_Empresa = Utils::sanitizeNumber($_POST['ID_Empresa']);
            $ID_Cliente = Utils::sanitizeNumber($_POST['ID_Cliente']);

            if ($ID_Cliente && $ID_Cliente > 0) {
                $route = 'uploads/cliente/' . $ID_Cliente . '/';

                if (file_exists($route)) {
                    Utils::deleteDir('uploads/cliente/' . $ID_Cliente);
                }
            } elseif ($ID_Empresa && $ID_Empresa > 0) {
                $route = 'uploads/empresa/' . $ID_Empresa . '/';

                if (file_exists($route)) {
                    Utils::deleteDir('uploads/empresa/' . $ID_Empresa);
                }
            }

            echo json_encode(
                array(
                    'status' => 1,
                    'logo' => base_url . 'dist/img/image_unavailable.jpg'
                )
            );
        } else {
            header("location:" . base_url);
        }
    }

    //19

    public function eliminarEmpresa()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin())) {
            $id = Encryption::decode($_POST['Empresa']);

            if ($id) {
                $cliente = new Clientes();
                $cliente->setEmpresa($id);
                $clientes = $cliente->getClientesPorEmpresa();

                $Candidatos = new Candidatos();
                $Candidatos->setEmpresa($id);
                $Candidatos = $Candidatos->countCandidatosPorEmpresa()->Total;

                $contacto = new ContactosEmpresa();
                $contacto->setID($id);
                $contactos = $contacto->getContactosPorEmpresa();

                $contactoCobranzaObj = new ContactosClienteCobranza();
                $contactoCobranzaObj->setEmpresa($id);
                $contactoCobranza = $contactoCobranzaObj->getALLByEmpresa();

                $razon = new RazonesSociales();
                $razon->setID_Empresa($id);
                $razones = $razon->getRazonesSocialesPorEmpresa();


                $cliente->setEmpresa($id);
                $notas = $cliente->getNotasPorEmpresa();





                $eliminar = true;
                $aviso = [];

                if (count($clientes) > 0) {
                    $texto = 'Contiene ' . count($clientes) . " clientes";
                    array_push($aviso, $texto);
                    $eliminar = false;
                }

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
                    $empresaObj = new Empresas();
                    $empresaObj->setEmpresa($id);
                    $empresaObj->setEliminado_por($_SESSION['identity']->username);
                    $duplicado = $empresaObj->saveEmpresaeliminada();

                    $duplicado == true ? $eliminado = $empresaObj->eliminarEmpresa() : $eliminado = false;



                    if ($eliminado) {
                        $empresas = $empresaObj->getAll();
                        foreach ($empresas as &$empresa) {
                            $empresa['Empresa'] = Encryption::encode($empresa['Empresa']);
                            $empresa['creado_por'] = $empresa['creado_por'] == null ? '' : $empresa['creado_por'];
                            $empresa['baseurl'] = base_url . 'empresa_SA/ver&id=' . $empresa['Empresa'];
                        }

                        echo json_encode(array('status' => 1, 'empresas' => $empresas));
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
