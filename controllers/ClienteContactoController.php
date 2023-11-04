<?php

require_once 'models/CustomerContact.php';
require_once 'models/User.php';
require_once 'models/Customer.php';

require_once 'models/SA/ContactosEmpresa.php';   //gabo 02/02/2023
require_once 'models/SA/ContactosCliente.php';    //gabo

class ClienteContactoController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isManager()) {
            $customerContact = new CustomerContact();
            $users = $customerContact->getAll();
            for ($i = 0; $i < count($users); $i++) {
                $path = $users[$i]['id_user'] ? 'uploads/avatar/' . $users[$i]['id_user'] : '';
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
                $users[$i]['avatar'] = base_url . $route;
            }


            $page_title = 'Contactos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/customer/contacts.php';
            //require_once 'views/user/edit.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function getContactsByCustomer()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            $customer = isset($_POST['customer']) ? trim($_POST['customer']) : FALSE;
            if ($customer) {
                $customerContact = new CustomerContact();
                $customerContact->setId_Customer($customer);
                $contacts = $customerContact->getContactsByCustomer();
                header('Content-Type: text/html; charset=utf-8');
                echo $json_customer_contacts = json_encode($contacts, \JSON_UNESCAPED_UNICODE);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function create()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $first_name = (isset($_POST['first_name'])) ? trim($_POST['first_name']) : FALSE;
            $last_name = (isset($_POST['last_name'])) ? trim($_POST['last_name']) : FALSE;
            $position = (isset($_POST['position'])) ? trim($_POST['position']) : NULL;
            $email = (isset($_POST['email'])) ? trim($_POST['email']) : NULL;
            $telephone = (isset($_POST['telephone'])) ? trim($_POST['telephone']) : NULL;
            $extension = (isset($_POST['extension'])) ? trim($_POST['extension']) : NULL;
            $cellphone = (isset($_POST['cellphone'])) ? trim($_POST['cellphone']) : NULL;
            $day = isset($_POST['day']) ? str_pad($_POST['day'], 2, "0", STR_PAD_LEFT) : FALSE;
            $month = isset($_POST['month']) ? str_pad($_POST['month'], 2, "0", STR_PAD_LEFT) : FALSE;
            $birthday = $day && $month ? $day . '/' . $month : '01/01';
            $id_customer = (isset($_POST['id_customer'])) ? Encryption::decode($_POST['id_customer']) : FALSE;
            if ($first_name && $last_name && $email) {
                $contacto = new CustomerContact();
                $contacto->setFirst_name($first_name);
                $contacto->setLast_name($last_name);
                $contacto->setPosition($position);
                $contacto->setEmail($email);
                $contacto->setTelephone($telephone);
                $contacto->setExtension($extension);
                $contacto->setCellphone($cellphone);
                $contacto->setBirthday($birthday);
                $contacto->setId_customer($id_customer);

                $username = isset($_POST['username']) && !empty($_POST['username']) ? trim($_POST['username']) : FALSE;
                $password = isset($_POST['password']) && !empty($_POST['password']) ? trim($_POST['password']) : FALSE;

                if ($username) {
                    $user = new User();
                    $user->setUsername($username);
                    $user->setPassword($password);
                    $user->setFirst_name($first_name);
                    $user->setLast_name($last_name);
                    $user->setEmail($email);
                    $user->setActivation(1);
                    $user->setId_user_type(6);


                    if (!isset($_POST['Password'])) {
                        //gabo 13 sept
                        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz#ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $max = strlen($pattern) - 1;
                        for ($i = 0; $i < 10; $i++) {
                            $password .= substr($pattern, mt_rand(0, $max), 1);
                        }
                    }
                    $user->setPassword($password);



                    $userExists = $user->userExists();
                    $emailExists = $user->emailExists();
                    if (!$userExists && !$emailExists) {
                        $save = $user->save();
                        if ($save) {
                            $id = $user->getId();
                            /* $token = $user->getToken();
                            
                            $url = base_url.'usuario/activar_cuenta&id='.$id.'&val='.$token;
                            
                            $subject = 'Activar de cuenta de usuario';
                            $name = $first_name.' '.$last_name;
                            $body = "Estimado(a) {$name}, tu cuenta ha sido creada para que ingreses a nuestra página ".base_url." con tu nombre de usuario o correo electrónico: <br/><br/> Usuario: {$username} <br/><br/> Contraseña : {$password} <br /> <br /> Para continuar con el proceso de registro, es necesario que actives tu cuenta haciendo click en el siguiente <a href={$url}>enlace</a>";
                             */
                            //echo 1; //if everything is ok, returns 1
                            /*Utils::sendEmail($email, $name, $subject, $body);*/

                            $contacto->setId_user($id);

                            $save = $contacto->create();
                            if ($save) {
                                echo 1;
                            } else {
                                echo 2;
                            }
                        } else {
                            echo 4;
                        }
                    } else {
                        echo 3; //if the user or email already exists, returns 3
                    }
                } else {
                    $contacto->setId_user(NULL);

                    $save = $contacto->create();
                    if ($save) {
                        echo 1;
                    } else {
                        echo 2;
                    }
                }
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function crear()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            if (isset($_GET['id']) || Utils::isCandidate()) {
                $id = Encryption::decode($_GET['id']);
                $customer = new Customer();
                $customer->setId($id);
                $cliente = $customer->getOne();

                $page_title = $cliente->alias . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/contact.php';
                require_once 'views/layout/footer.php';
            } else {
                header("location:" . base_url . "cliente/index");
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function editar()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $contact = new CustomerContact();
                $contact->setId($id);
                $contacto = $contact->getOne();

                if ($contacto) {
                    $birthday = $contacto->birthday ? explode('/', $contacto->birthday) : array('01', '01');
                }

                $customer = new Customer();
                $customer->setId($contacto->id_customer);
                $cliente = $customer->getOne();

                $page_title = $cliente->alias . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/contact.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'cliente/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function update()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSenior())) {
            $id = (isset($_POST['id'])) ? Encryption::decode($_POST['id']) : FALSE;
            $first_name = (isset($_POST['first_name'])) ? trim($_POST['first_name']) : FALSE;
            $last_name = (isset($_POST['last_name'])) ? trim($_POST['last_name']) : FALSE;
            $position = (isset($_POST['position'])) ? trim($_POST['position']) : NULL;
            $email = (isset($_POST['email'])) ? trim($_POST['email']) : NULL;
            $telephone = (isset($_POST['telephone'])) ? trim($_POST['telephone']) : NULL;
            $extension = (isset($_POST['extension'])) ? trim($_POST['extension']) : NULL;
            $cellphone = (isset($_POST['cellphone'])) ? trim($_POST['cellphone']) : NULL;
            $day = isset($_POST['day']) ? str_pad($_POST['day'], 2, "0", STR_PAD_LEFT) : FALSE;
            $month = isset($_POST['month']) ? str_pad($_POST['month'], 2, "0", STR_PAD_LEFT) : FALSE;
            $birthday = $day && $month ? $day . '/' . $month : '01/01';
            $id_user = (isset($_POST['id_user']) && !empty($_POST['id_user'])) ? Encryption::decode($_POST['id_user']) : NULL;

            if ($first_name && $last_name && $email) {
                $contacto = new CustomerContact();
                $contacto->setId($id);
                $contacto->setFirst_name($first_name);
                $contacto->setLast_name($last_name);
                $contacto->setPosition($position);
                $contacto->setEmail($email);
                $contacto->setTelephone($telephone);
                $contacto->setExtension($extension);
                $contacto->setCellphone($cellphone);
                $contacto->setBirthday($birthday);
                $contacto->setId_user($id_user);

                $username = isset($_POST['username']) && !empty($_POST['username']) ? trim($_POST['username']) : FALSE;
                $password = isset($_POST['password']) && !empty($_POST['password']) ? trim($_POST['password']) : FALSE;

                if ($username && $password) {
                    if (!is_null($id_user)) { //cuando el contacto tenga cuenta de usuario
                        $user = new User();
                        $user->setId($id_user);
                        $user->setUsername($username);
                        $user->setPassword($password);
                        $user->setFirst_name($first_name);
                        $user->setLast_name($last_name);
                        $user->setEmail($email);
                        $user->setId_user_type(6);

                        $userExists = $user->userExists();
                        $emailExists = $user->emailExists();
                        if ((!$userExists || ($username == $userExists)) && (!$emailExists || ($email == $emailExists))) {
                            $update = $user->edit();
                            if ($update) {
                                $id_user = $user->getId();

                                $contacto->setId_user($id_user);

                                $update = $contacto->update();
                                if ($update) {
                                    echo 1;
                                } else {
                                    echo 2;
                                }
                            } else {
                                echo 4;
                            }
                        } else {
                            echo 3; //if the user or email already exists, returns 3
                        }
                    } else {
                        $user = new User();
                        $user->setUsername($username);
                        $user->setPassword($password);
                        $user->setFirst_name($first_name);
                        $user->setLast_name($last_name);
                        $user->setEmail($email);
                        $user->setActivation(1);
                        $user->setId_user_type(6);


                        $userExists = $user->userExists();
                        $emailExists = $user->emailExists();
                        if (!$userExists && !$emailExists) {
                            $save = $user->save();
                            if ($save) {
                                $id_user = $user->getId();
                                $contacto->setId_user($id_user);
                                $update = $contacto->update();
                                if ($update) {
                                    echo 1;
                                } else {
                                    echo 2;
                                }
                            } else {
                                echo 4;
                            }
                        } else {
                            echo 3; //if the user or email already exists, returns 3
                        }
                    }
                } else {
                    $update = $contacto->update();
                    if ($update) {
                        echo 1;
                    } else {
                        echo 2;
                    }
                }
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }


    ///////////////////////////////////////////// INIICO GABO  ////////////////////////////////////////////////////////////
    public function getContacto()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $id = Utils::sanitizeString(Encryption::decode($_POST['id']));
            if (isset($_POST['id'])) {
                $contact = new CustomerContact();
                $contact->setId($id);
                $contacto = $contact->getOne();
                $contacto->password = Utils::decrypt($contacto->password);
                $contacto->birthday =  ($contacto->birthday != null) ? $contacto->birthday : "";
                $contacto->id =  Encryption::encode($contacto->id);

                if ($contacto) {
                    echo json_encode(array(
                        'contacto' => $contacto,
                        'status' => 1,
                    ));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 1));
        } else
            echo json_encode(array('status' => 0));
    }

    public function create_gabotest()  //gabo prueba  24
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $first_name = (isset($_POST['first_name'])) ? trim($_POST['first_name']) : FALSE;
            $last_name = (isset($_POST['last_name'])) ? trim($_POST['last_name']) : FALSE;
            $position = (isset($_POST['position'])) ? trim($_POST['position']) : NULL;
            $email = (isset($_POST['email'])) ? trim($_POST['email']) : NULL;
            $telephone = (isset($_POST['telephone'])) ? trim($_POST['telephone']) : NULL;
            $extension = (isset($_POST['extension'])) ? trim($_POST['extension']) : NULL;
            $cellphone = (isset($_POST['cellphone'])) ? trim($_POST['cellphone']) : NULL;
            $day = isset($_POST['day']) ? str_pad($_POST['day'], 2, "0", STR_PAD_LEFT) : FALSE;
            $month = isset($_POST['month']) ? str_pad($_POST['month'], 2, "0", STR_PAD_LEFT) : FALSE;
            $birthday = $day && $month ? $day . '/' . $month : '01/01';
            $id_customer = (isset($_POST['id_customer'])) ? Encryption::decode($_POST['id_customer']) : FALSE;


            if ($first_name && $last_name && $email) {
                $contacto = new CustomerContact();
                $contacto->setFirst_name($first_name);
                $contacto->setLast_name($last_name);
                $contacto->setPosition($position);
                $contacto->setEmail($email);
                $contacto->setTelephone($telephone);
                $contacto->setExtension($extension);
                $contacto->setCellphone($cellphone);
                $contacto->setBirthday($birthday);
                $contacto->setId_customer($id_customer);
                $username = isset($_POST['username']) && !empty($_POST['username']) ? trim($_POST['username']) : FALSE;
                $password = isset($_POST['password']) && !empty($_POST['password']) ? trim($_POST['password']) : FALSE;
                if ($username && $password) {
                    $user = new User();
                    $user->setUsername($username);
                    $user->setPassword($password);
                    $user->setFirst_name($first_name);
                    $user->setLast_name($last_name);
                    $user->setEmail($email);
                    $user->setActivation(1);
                    $user->setId_user_type(6);

                    $userExists = $user->userExists();
                    $emailExists = $user->emailExists();
                    if (!$userExists && !$emailExists) {
                        $save = $user->save();
                        if ($save) {
                            $id = $user->getId();
                            $contacto->setId_user($id);

                            $save = $contacto->create();
                            if ($save) {
                                $contactos = $contacto->getContactsByCustomer();
                                for ($i = 0; $i < count($contactos); $i++) {
                                    $contactos[$i]['idE'] = Encryption::encode($contactos[$i]['id']);
                                    $contactos[$i]['url_editar_contacto'] = base_url . 'clientecontacto/editar&id=' . $contactos[$i]['idE'];
                                    $contactos[$i]['username'] =  ($contactos[$i]['username'] != null) ? $contactos[$i]['username'] : "";
                                    $contactos[$i]['birthday'] =  ($contactos[$i]['birthday'] != null) ? $contactos[$i]['birthday'] : "";
                                }
                                echo json_encode(array('contactos' => $contactos, 'status' => 1));
                            } else
                                echo json_encode(array('status' => 2)); //ni se creo el contacto
                        } else
                            echo json_encode(array('status' => 2)); //ni se creo el contacto
                    } else
                        echo json_encode(array('status' => 3));
                } else {
                    $contacto->setId_user(NULL);
                    $save = $contacto->create();
                    if ($save) {
                        $contactos = $contacto->getContactsByCustomer();
                        for ($i = 0; $i < count($contactos); $i++) {
                            $contactos[$i]['idE'] = Encryption::encode($contactos[$i]['id']);
                            $contactos[$i]['url_editar_contacto'] = base_url . 'clientecontacto/editar&id=' . $contactos[$i]['idE'];
                            $contactos[$i]['username'] =  ($contactos[$i]['username'] != null) ? $contactos[$i]['username'] : "";
                            $contactos[$i]['birthday'] =  ($contactos[$i]['birthday'] != null) ? $contactos[$i]['birthday'] : "";
                        }
                        echo json_encode(array('contactos' => $contactos, 'status' => 1));
                    } else {
                        echo json_encode(array('status' => 2)); //ni se creo el contacto
                    }
                }
            } else
                echo json_encode(array('status' => 0)); //faltan datos

        } else
            echo json_encode(array('status' => 0));
    }


    public function update_modal()    //gabo 24/02/23
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSenior())) {
            $id = (isset($_POST['id_contact'])) ? Encryption::decode($_POST['id_contact']) : FALSE;
            $first_name = (isset($_POST['first_name'])) ? trim($_POST['first_name']) : FALSE;
            $last_name = (isset($_POST['last_name'])) ? trim($_POST['last_name']) : FALSE;
            $position = (isset($_POST['position'])) ? trim($_POST['position']) : NULL;
            $email = (isset($_POST['email'])) ? trim($_POST['email']) : NULL;
            $telephone = (isset($_POST['telephone'])) ? trim($_POST['telephone']) : NULL;
            $extension = (isset($_POST['extension'])) ? trim($_POST['extension']) : NULL;
            $cellphone = (isset($_POST['cellphone'])) ? trim($_POST['cellphone']) : NULL;
            $day = isset($_POST['Dia']) ? str_pad($_POST['Dia'], 2, "0", STR_PAD_LEFT) : FALSE;
            $month = isset($_POST['Mes']) ? str_pad($_POST['Mes'], 2, "0", STR_PAD_LEFT) : FALSE;
            $birthday = $day && $month ? $day . '/' . $month : '01/01';
            $id_user = (isset($_POST['id_user']) && !empty($_POST['id_user'])) ? Encryption::decode($_POST['id_user']) : NULL;
            $id_customer = (isset($_POST['id_customer'])) ? $_POST['id_customer'] : FALSE;

            if ($first_name && $last_name && $email) {
                $contacto = new CustomerContact();
                $contacto->setId($id);
                $contacto->setFirst_name($first_name);
                $contacto->setLast_name($last_name);
                $contacto->setPosition($position);
                $contacto->setEmail($email);
                $contacto->setTelephone($telephone);
                $contacto->setExtension($extension);
                $contacto->setCellphone($cellphone);
                $contacto->setBirthday($birthday);
                $contacto->setId_user($id_user);
                $contacto->setId_customer($id_customer);

                $username = isset($_POST['username']) && !empty($_POST['username']) ? trim($_POST['username']) : FALSE;
                $password = isset($_POST['password']) && !empty($_POST['password']) ? trim($_POST['password']) : FALSE;

                if ($username && $password) {
                    if (!is_null($id_user)) { //cuando el contacto tenga cuenta de usuario
                        $user = new User();
                        $user->setId($id_user);
                        $user->setUsername($username);
                        $user->setPassword($password);
                        $user->setFirst_name($first_name);
                        $user->setLast_name($last_name);
                        $user->setEmail($email);
                        $user->setId_user_type(6);

                        $userExists = $user->userExists();
                        $emailExists = $user->emailExists();
                        if ((!$userExists || ($username == $userExists)) && (!$emailExists || ($email == $emailExists))) {
                            $update = $user->edit();

                            if ($update) {
                                $id_user = $user->getId();
                                $contacto->setId_user($id_user);
                                $update = $contacto->update();

                                if ($update) {
                                    $contactos = $contacto->getContactsByCustomer();
                                    for ($i = 0; $i < count($contactos); $i++) {
                                        $contactos[$i]['idE'] = Encryption::encode($contactos[$i]['id']);
                                        $contactos[$i]['url_editar_contacto'] = base_url . 'clientecontacto/editar&id=' . $contactos[$i]['idE'];
                                    }

                                    echo json_encode(
                                        array(
                                            'contactos' => $contactos,
                                            'status' => 1
                                        )
                                    );
                                } else
                                    echo json_encode(array('status' => 2));
                            } else  ///no se actualizó el usuario
                                echo json_encode(array('status' => 4));
                        } else
                            echo json_encode(array('status' => 3)); //if the user or email already exists, returns 3
                    }
                }
            } else {   //faltan datos
                echo json_encode(array('status' => 0));
            }
        } else {
            header('location:' . base_url);
        }
    }


    public function delete_modal()  //gabo 27/feb
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {

            $id_customer = Utils::sanitizeNumber($_POST['id_customer']);
            $id = Encryption::decode($_POST['id']);

            if ($id && $id_customer) {
                $contacto = new CustomerContact();
                $contacto->setId($id);

                if ($id_customer) {
                    $contacto->setId_customer($id_customer);
                    $result = $contacto->deleteContact_modal();
                    $contactos = $contacto->getContactsByCustomer();
                }


                if ($result) {

                    for ($i = 0; $i < count($contactos); $i++) {
                        $contactos[$i]['idE'] = Encryption::encode($contactos[$i]['id']);
                        $contactos[$i]['url_editar_contacto'] = base_url . 'clientecontacto/editar&id=' . $contactos[$i]['idE'];
                    }

                    echo json_encode(array(
                        'contactos' => $contactos,
                        'status' => 1,
                        'flag' => 1
                    ));
                }
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function duplicate_Contact()   //gabo 01/03/2022  reclu a sa
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor())) {
            $Nombre_Contacto = Utils::sanitizeStringBlank($_POST['first_name']);
            $Apellido_Contacto = Utils::sanitizeStringBlank($_POST['last_name']);
            $Puesto = Utils::sanitizeStringBlank($_POST['position']);
            $Correo = Utils::sanitizeStringBlank($_POST['email']);
            $Telefono = Utils::sanitizeStringBlank($_POST['telephone']);
            $Extension = Utils::sanitizeStringBlank($_POST['extension']);
            $Celular = Utils::sanitizeStringBlank($_POST['cellphone']);
            $Dia = isset($_POST['Dia']) ? str_pad($_POST['Dia'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Mes = isset($_POST['Mes']) ? str_pad($_POST['Mes'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Fecha_Cumpleanos = $Dia && $Mes ? $Dia . '/' . $Mes : '01/01';

            $Usuario = Utils::sanitizeString($_POST['username']);
            $Password = isset($_POST['password']) && !empty($_POST['password']) ? trim($_POST['password']) : FALSE;
            $cliente_asignado =   isset($_POST['cliente_asignado']) ?  Utils::sanitizeStringBlank($_POST['cliente_asignado']) : false;

            if ($Nombre_Contacto && $Apellido_Contacto && $Correo && $Telefono  && $Puesto  && $Usuario && $Password && $cliente_asignado) {
                $id_usuario = "";
                $user = new User();
                $user->setUsername($Usuario);
                $usuario = $user->userExists(); //users
                $id_usuario = $user->getId();

                if ($id_usuario != "") {

                    $contacto = new ContactosEmpresa();
                    $contacto->setNombre_Contacto($Nombre_Contacto);
                    $contacto->setApellido_Contacto($Apellido_Contacto);
                    $contacto->setPuesto($Puesto);
                    $contacto->setTelefono($Telefono);
                    $contacto->setExtension($Extension);
                    $contacto->setCelular($Celular);
                    $contacto->setFecha_Cumpleaños($Fecha_Cumpleanos);
                    $contacto->setTipo_usuario(0);
                    $contacto->setEmpresa($cliente_asignado);
                    $contacto->setUsuario($Usuario);
                    $contacto->setCorreo($Correo);
                    $resultado = $contacto->getContactoPorUsuarioYEmpresa();

                    if (!$resultado) {
                        $save_contacto = $contacto->create();
                        if ($save_contacto)
                            echo json_encode(array('status' => 1));
                        else
                            echo json_encode(array('status' => 5));
                    } else
                        echo json_encode(array('status' => 2)); //ya existe el usuario 
                } else
                    echo json_encode(array('status' => 3)); //usuario no existe
            } else
                echo json_encode(array('status' => 4)); //validarcampos
        } //end if
    }
    ///////////////////////////////////////////// FINN GABO  ////////////////////////////////////////////////////////////
}
