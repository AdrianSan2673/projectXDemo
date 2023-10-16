<?php

require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/ContactosCliente.php';
require_once 'models/User.php';
require_once 'models/SA/Clientes.php';
require_once 'models/CustomerContact.php';
// ===[gabo 16 de mayo duplicate]===
require_once 'models/SA/ContactosClienteSolicitan.php';
// ===[gabo 16 de mayo duplicate fin]===
class ClienteContacto_SAController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isSales() || Utils::isSalesManager())) {
            $contacto = new ContactosEmpresa();
            $contactos = $contacto->getAll();
            for ($i = 0; $i < count($contactos); $i++) {
                $path = $contactos[$i]['id_user'] ? 'uploads/avatar/' . $contactos[$i]['id_user'] : '';
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
                //$img_base64 = chunk_split(base64_encode($img_content));
                $img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
                $contactos[$i]['avatar'] = base_url . $route;
            }


            $page_title = 'Contactos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/cliente/contacts.php';
            //require_once 'views/user/edit.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function getContactosByCliente()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            $Cliente = Utils::sanitizeNumber($_POST['Cliente']);
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            if ($Empresa && $Cliente) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setEmpresa($Empresa);
                $contactosEmpresa = $contactoEmpresa->getContactosPorEmpresa();
                header('Content-Type: text/html; charset=utf-8');

                $contactoCliente = new ContactosCliente();
                $contactoCliente->setID_Cliente($Cliente);
                $contactosCliente = $contactoCliente->getContactosPorCliente();

                echo json_encode(
                    array(
                        'contactosEmpresa' => $contactosEmpresa,
                        'contactosCliente' => $contactosCliente
                    )
                );
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function save()
    {


        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Nombre_Contacto = Utils::sanitizeStringBlank($_POST['Nombre_Contacto']);
            $Apellido_Contacto = Utils::sanitizeStringBlank($_POST['Apellido_Contacto']);
            $Puesto = Utils::sanitizeStringBlank($_POST['Puesto']);
            $Correo = Utils::sanitizeStringBlank($_POST['Correo']);
            $Telefono = Utils::sanitizeStringBlank($_POST['Telefono']);
            $Extension = Utils::sanitizeStringBlank($_POST['Extension']);
            $Celular = Utils::sanitizeStringBlank($_POST['Celular']);
            $Dia = isset($_POST['Dia']) ? str_pad($_POST['Dia'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Mes = isset($_POST['Mes']) ? str_pad($_POST['Mes'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Fecha_Cumpleanos = $Dia && $Mes ? $Dia . '/' . $Mes : '01/01';
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            $ID_Cliente = Utils::sanitizeNumber(Encryption::decode($_POST['ID_Cliente']));
            $ID_Contacto = Utils::sanitizeNumber($_POST['ID_Contacto']);
            $Usuario = Utils::sanitizeString($_POST['Usuario']);
            $Password = isset($_POST['Password']) && !empty($_POST['Password']) ? trim($_POST['Password']) : FALSE;

            $flag = $_POST['flag'];
            $user_flag = $_POST['user_flag'];
			$tipo_usuario = isset($_POST['tipo_usuario']) && !empty($_POST['tipo_usuario']) ? trim($_POST['tipo_usuario']) : 0;




            if ($Nombre_Contacto && $Apellido_Contacto && $Correo && $Usuario) {
                $contacto = new ContactosEmpresa();
                $contacto->setNombre_Contacto($Nombre_Contacto);
                $contacto->setApellido_Contacto($Apellido_Contacto);
                $contacto->setPuesto($Puesto);
                $contacto->setTelefono($Telefono);
                $contacto->setExtension($Extension);
                $contacto->setCelular($Celular);
                $contacto->setFecha_Cumpleaños($Fecha_Cumpleanos);
                $contacto->setEmpresa($Empresa);
                $contacto->setID($ID_Contacto);
				$contacto->setTipo_usuario($tipo_usuario);

                $user = new User();
                $user->setUsername($Usuario);
                $user->setFirst_name($Nombre_Contacto);
                $user->setLast_name($Apellido_Contacto);
                $user->setEmail($Correo);
                $user->setActivation(1);
                $user->setId_user_type(15);
				
                if (!isset($_POST['Password'])) {
                    //gabo 13 sept
                    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz#ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $max = strlen($pattern) - 1;
                    for ($i = 0; $i < 10; $i++) {
                        $Password .= substr($pattern, mt_rand(0, $max), 1);
                    }
                }

                $user->setPassword($Password);


                $userExists = $user->userExists();
                $emailExists = $user->emailExists();




                if ($user_flag == 1) {
                    if ((!$userExists || ($Usuario == $userExists)) && (!$emailExists || ($Correo == $emailExists))) {

                        $save = $user->edit();

                        if ($save) {
                            $contacto->setUsuario($Usuario);
                            $contacto->setCorreo($Correo);


                            if ($flag == 1) {
                                $save_contacto = $contacto->update();

                                //===[gabo 10 agosto usuarios ]===
                                $contactos = ClienteContacto_SAController::formatearContactos($contacto->getContactosPorEmpresa());
                                //===[gabo 10 agosto usuarios fin]===
                                if ($save_contacto) {
                                    if ($ID_Cliente) {
                                        $contact = new ContactosCliente();
                                        $contact->setID_Cliente($ID_Cliente);
                                        $contactos = ClienteContacto_SAController::formatearContactos($contact->getContactosPorCliente());
                                    }

                                    echo json_encode(
                                        array(
                                            'contactos' => $contactos,
                                            'status' => 1,
                                            'flag' => 1
                                        )
                                    );
                                }
                            } else {
                                $save_contacto = $contacto->create();

                                if ($save_contacto) {
                                    $ID_Contacto = $contacto->getID();

                                    if ($ID_Cliente) {
                                        $contact = new ContactosCliente();
                                        $contact->setID_Cliente($ID_Cliente);
                                        $contact->setID_Empresa($Empresa);
                                        $contact->setID_Contacto($ID_Contacto);
                                        $contact->setNombre_Contacto($Nombre_Contacto . ' ' . $Apellido_Contacto);
                                        $exists = $contact->getByContactoYCliente();
                                        $contactos = ClienteContacto_SAController::formatearContactos($contact->getContactosPorCliente());
                                        if (!$exists) {
                                            $contact->create();
                                        }
                                        echo json_encode(
                                            array(
                                                'contactos' => $contactos,
                                                'status' => 1,
                                                'flag' => 2
                                            )
                                        );
                                    } else {
                                        $contactos = ClienteContacto_SAController::formatearContactos($contacto->getContactosPorEmpresa());

                                        echo json_encode(
                                            array(
                                                'contactos' => $contactos,
                                                'status' => 1,
                                                'flag' => 3
                                            )
                                        );
                                    }
                                } else
                                    echo json_encode(array('status' => 2));
                            }
                        } else {
                            echo json_encode(array('status' => 4));
                        }
                    } else
                        echo json_encode(array('status' => 3));
                } else {
                    if (!$userExists && !$emailExists) {
                        $save = $user->save();

                        if ($save) {
                            $contacto->setUsuario($Usuario);
                            $contacto->setCorreo($Correo);

                            if ($flag == 1) {
                                $save_contacto = $contacto->update();
                                if ($save_contacto) {
                                    if ($ID_Cliente) {
                                        $contact = new ContactosCliente();
                                        $contact->setID_Cliente($ID_Cliente);
                                        $contactos = ClienteContacto_SAController::formatearContactos($contact->getContactosPorCliente());
                                    }

                                    echo json_encode(
                                        array(
                                            'contactos' => $contactos,
                                            'status' => 1,
                                            'flag' => 1
                                        )
                                    );
                                }
                            } else {
                                $save_contacto = $contacto->create();

                                if ($save_contacto) {
                                    $ID_Contacto = $contacto->getID();


                                    if ($ID_Cliente) {


                                        $contact = new ContactosCliente();
                                        $contact->setID_Cliente($ID_Cliente);
                                        $contact->setID_Empresa($Empresa);
                                        $contact->setID_Contacto($ID_Contacto);
                                        $contact->setNombre_Contacto($Nombre_Contacto . ' ' . $Apellido_Contacto);
                                        $exists = $contact->getByContactoYCliente();
                                        // $contactos = $contact->getContactosPorCliente();
                                        //===[gabo 10 agosto usuarios]===
                                        if (!$exists) {

                                            $save = $contact->create();

                                            $ID_Contacto = $contacto->getID();

                                            if ($save) {

                                                if ($ID_Cliente) {

                                                    $contactoSolicita = new ContactosClienteSolicitan();
                                                    $contactoCliente = new ContactosCliente();

                                                    $contactoCliente->setID_Contacto($ID_Contacto);
                                                    $objeto = $contactoCliente->getOne();
                                                    $Nombre_contacto = $objeto->Nombre_Contacto;
                                                    $Usuario = $objeto->Usuario;

                                                    $contactoSolicita->setEmpresa($Empresa);
                                                    $contactoSolicita->setCliente($ID_Cliente);
                                                    $contactoSolicita->setNombre($Nombre_contacto);
                                                    $contactoSolicita->setUsuario($Usuario);
                                                    $result = $contactoSolicita->getOne();

                                                    if (!$result) {
                                                        $result = $contactoSolicita->create();
                                                    }
                                                }
                                            }
                                            //===[gabo 10 agosto usuarios fin]===

                                        }

                                        $contactos = ClienteContacto_SAController::formatearContactos($contact->getContactosPorCliente());
                                        echo json_encode(
                                            array(
                                                'contactos' => $contactos,
                                                'status' => 1,
                                                'flag' => 5
                                            )
                                        );
                                    } else {
                                        //===[gabo 10 agosto usuarios]===
                                        $contactos = ClienteContacto_SAController::formatearContactos($contacto->getContactosPorEmpresa());
                                        //===[gabo 10 agosto usuarios fin]===
                                        echo json_encode(
                                            array(
                                                'contactos' => $contactos,
                                                'status' => 1,
                                                'flag' => 6
                                            )
                                        );
                                    }
                                } else
                                    echo json_encode(array('status' => 2));
                            }
                        } else {
                            echo json_encode(array('status' => 2));
                        }
                    } else
                        echo json_encode(array('status' => 3));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header('location:' . base_url);
        }
    }
    //===[gabo 14 agosto usuarios]===
    public function delete()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            $ID_Cliente = Utils::sanitizeNumber(Encryption::decode($_POST['ID_Cliente']));
            $ID_Contacto = Utils::sanitizeNumber($_POST['ID_Contacto']);
            $Usuario = Utils::sanitizeStringBlank($_POST['Usuario']);


            if ($Empresa && $ID_Cliente && $ID_Contacto && $Usuario) { //eliminar desde cliente

                $contact = new ContactosCliente();
                $contact->setID_Cliente($ID_Cliente);
                $contact->setID_Contacto($ID_Contacto);
                $contact->deleteContactosPorContacto();
                $contactos = ClienteContacto_SAController::formatearContactos($contact->getContactosPorCliente());

                echo json_encode(
                    array(
                        'contactos' => $contactos,
                        'status' => 1,
                        'flag' => 1
                    )
                );
            } else  if ($ID_Contacto && $Empresa) { //eliminar desde empresa

                $contacto = new ContactosEmpresa();
                $contacto->setID($ID_Contacto);
                $contacto->setEmpresa($Empresa);
                $contacto->inhabilitar();

                $contactos = ClienteContacto_SAController::formatearContactos($contacto->getContactosPorEmpresa());
                $usuario = $contacto->getOne()->Usuario;

                $user = new User();
                $user->setUsername($usuario);
                $user->userExists();
                $user->setActivation(0);
                $user->updateActivation();

                $contact = new ContactosCliente();
                $contact->setID_Cliente($ID_Cliente);
                $contact->setID_Contacto($ID_Contacto);
                $contact->deleteContactosPorContacto();

                // }

                echo json_encode(
                    array(
                        'contactos' => $contactos,
                        'status' => 1,
                        'flag' => 1
                    )
                );
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header('location:' . base_url);
        }
    }
    //===[gabo 14 agosto usuarios fin]===
    public function save_contactos_cliente()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Cliente = Utils::sanitizeNumber(Encryption::decode($_POST['Cliente']));
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);
            $contactos = isset($_POST['contactos']) && !empty($_POST['contactos']) ? $_POST['contactos'] : false;

            if ($Cliente) {
                // ===[gabo 16 de mayo duplicate]===
                $contact = new ContactosCliente();
                $contactoSolicita = new ContactosClienteSolicitan();
                // ===[gabo 16 de mayo duplicate fin]===

                $contactoCliente = new ContactosCliente();
                $contactoCliente->setID_Cliente($Cliente);
                $contactoCliente->setID_Empresa($Empresa);
                $contactoCliente->deleteContactosPorCliente();

                foreach ($contactos as $contacto) {
                    //===[gabo 14 agosto usuarios ]===
                    $contactoEmpresa = new ContactosEmpresa();
                    $contactoEmpresa->setID($contacto);
                    $nombre = $contactoEmpresa->getOne()->Nombre_Contacto;
                    //===[gabo 14 agosto usuarios fin]===

                    $contactoCliente->setID_Contacto($contacto);
                    $contactoCliente->setNombre_Contacto($nombre);
                    $contactoCliente->create();


                    // ===[gabo 16 de mayo duplicate]===
                    $contactoCliente->setID_Contacto($contacto);
                    $objeto = $contactoCliente->getOne();
                    $Nombre_contacto = $objeto->Nombre_Contacto;
                    $Usuario = $objeto->Usuario;

                    $contactoSolicita->setEmpresa($Empresa);
                    $contactoSolicita->setCliente($Cliente);
                    $contactoSolicita->setNombre($Nombre_contacto);
                    $contactoSolicita->setUsuario($Usuario);
                    $result = $contactoSolicita->getOne();

                    if (!$result) {
                        $result = $contactoSolicita->create();
                    }
                    // ===[gabo 16 de mayo duplicate]===

                }


                $contactos = ClienteContacto_SAController::formatearContactos($contactoCliente->getContactosPorCliente());
                echo json_encode(
                    array(
                        'contactos' => $contactos,
                        'status' => 1
                    )
                );
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function getOne()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isSales() || Utils::isSalesManager()) {
            $ID_Contacto = Utils::sanitizeNumber($_POST['ID_Contacto']);

            if ($ID_Contacto) {
                $contactocliente = new ContactosEmpresa();
                $contactocliente->setID($ID_Contacto);
                $data = $contactocliente->getOne();

                if ($data) {
                    $data_user = array('username' => null, 'password' => null);
                    $user = new User();
                    $user->setUsername($data->Usuario);
                    $usuario = $user->getUserByUsername();
                    if ($usuario) {
                        $data_user['username'] = $usuario->username;
                        $data_user['password'] = Utils::decrypt($usuario->password);
                    }
                    $data = $data;
                    $data->username = $data_user['username'];
                    $data->password = $data_user['password'];
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
            } else echo 0;
        } else
            header('location:' . base_url);
    }

    //=========================[Gabo Marzo 1]==============================================

    public function duplicate_contact()   //gabo 22/02/2022 duplicar
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Nombre_Contacto = Utils::sanitizeStringBlank($_POST['Nombre_Contacto']);
            $Apellido_Contacto = Utils::sanitizeStringBlank($_POST['Apellido_Contacto']);
            $Puesto = Utils::sanitizeStringBlank($_POST['Puesto']);
            $Correo = Utils::sanitizeStringBlank($_POST['Correo']);
            $Telefono = Utils::sanitizeStringBlank($_POST['Telefono']);
            $Extension = Utils::sanitizeStringBlank($_POST['Extension']);
            $Celular = Utils::sanitizeStringBlank($_POST['Celular']);
            $Dia = isset($_POST['Dia']) ? str_pad($_POST['Dia'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Mes = isset($_POST['Mes']) ? str_pad($_POST['Mes'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Fecha_Cumpleanos = $Dia && $Mes ? $Dia . '/' . $Mes : '01/01';

            $Usuario = Utils::sanitizeString($_POST['Usuario']);
            $Password = isset($_POST['Password']) && !empty($_POST['Password']) ? trim($_POST['Password']) : FALSE;
            $cliente_asignado =   isset($_POST['cliente_asignado']) ?  Utils::sanitizeStringBlank($_POST['cliente_asignado']) : false;
            $url_ver_cliente_reclu = base_url . 'cliente/ver&id=' . Encryption::encode($cliente_asignado);

            if ($Nombre_Contacto && $Apellido_Contacto && $Correo && $Telefono  && $Puesto  && $Usuario && $Password && $cliente_asignado) {
                $id_usuario = "";
                $user = new User();
                $user->setUsername($Usuario);
                $usuario = $user->userExists(); //users
                $id_usuario = $user->getId();

                if ($id_usuario != "") {
                    $contacto = new CustomerContact();
                    $contacto->setId_user($id_usuario);
                    $contacto->setId_customer($cliente_asignado);
                    $resultado = $contacto->getCustumerContactByidCustomerAndidUser();

                    if (!$resultado) {      //valida que no se repita
                        $contacto->setFirst_name($Nombre_Contacto);
                        $contacto->setLast_name($Apellido_Contacto);
                        $contacto->setPosition($Puesto);
                        $contacto->setEmail($Correo);
                        $contacto->setTelephone($Telefono);
                        $contacto->setExtension($Extension);
                        $contacto->setCellphone($Celular);
                        $contacto->setBirthday($Fecha_Cumpleanos);

                        $result = $contacto->create();


                        if ($result) {
                            echo json_encode(array('status' => 1, 'url' => $url_ver_cliente_reclu));    //registro exitoso
                        }
                    } else {
                        echo json_encode(array('status' => 2));    //ya existe el usuario 
                    }
                } else {
                    echo json_encode(array('status' => 3));  //usuario no existe
                }
            } else {
                echo json_encode(array('status' => 4));  //validarcampos
            }
        } //end if
    }
    //=========================[Gabo Marzo 1]==============================================
	 static  function formatearContactos($contactos)
    {

        foreach ($contactos as &$contacto) {

            $contacto['password'] = Utils::decrypt($contacto['password']);
        }

        return $contactos;
    }
}
