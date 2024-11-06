<?php

require_once 'models/User.php';
require_once 'models/ModelosSigma/usuario.php';

class UsuarioController
{

    public function index()
    {

        if (isset($_SESSION['identity']) && !empty($_SESSION['identity'])) {

            $page_title = 'Bienvenido(a) | SIGMA';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/layout/dashboard.php';
            //if (Utils::isCustomerSA() || Utils::isCustomer()) 
            //require_once 'views/layout/modal-encuesta.php';
            require_once 'views/layout/footer.php';
        } else {

            $page_title = 'Iniciar sesión | SIGMA';
            require_once 'views/user/header.php';
            require_once 'views/user/login.php';
            require_once 'views/user/footer.php';
        }
    }



    public function login()
    {
        if (Utils::isValid($_POST)) {

            $username = isset($_POST['username']) ? trim($_POST['username']) : FALSE;
            $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;
            if ($username && $password) {
                $user = new User();
                $user->setUsername($username);
                //$user->setEmail($username);
                $user->setPassword($password);

                $identity = $user->login();


                if ($identity && is_object($identity)) {
                    $_SESSION['identity'] = $identity;
                    $user->lastSession($identity->id);
                    echo 1;
                    $_SESSION['dark_mode'] = $_SESSION['identity']->dark_mode;
                    switch ($identity->tipo_usuario) {
                        case "logistica":
                            $_SESSION['logistica'] = TRUE;
                            break;
                        case "procura":
                            $_SESSION['procura'] = TRUE;
                            $_SESSION['tipo'] = 'procura';
                            break;
                        case "calidad":
                            $_SESSION['calidad'] = TRUE;
                            $_SESSION['tipo'] = 'calidad';
                            break;
                        case "gerente de logistica":
                            $_SESSION['gerente de logistica'] = TRUE;
                            $_SESSION['tipo'] = 'gerente de logistica';
                            break;
                        case "superviso":
                            $_SESSION['superviso'] = TRUE;
                            $_SESSION['tipo'] = 'superviso';
                            break;
                    }
                } else {
                    echo 0;
                }
            } else {
                echo 11;
            }
        } else {
            header("location:" . base_url . SID);
        }
        var_dump($_SESSION);
        die();
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION)) {
            unset($_SESSION);
        }
        session_destroy();
        header("location:" . base_url . "usuario/index");
    }



    public static function formatear($usuarios)
    {

        foreach ($usuarios as &$usuario) {
            // $usuario['password'] = Utils::decrypt($usuario['password']);
            //$usuario['last_session'] = ($usuario['last_session'] != NULL) ? Utils::getFullDate($usuario['last_session']) : '';
            $usuario['id'] = Encryption::encode($usuario['id']);

            $path = 'uploads/avatar/' . $usuario['id'];
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
            $usuario['avatar'] = base_url . $route;
        }
        return $usuarios;
    }
    public function all()
    {
        // && Utils::isAdmin()
        if (Utils::isValid($_SESSION['identity'])) {
        if (Utils::isValid($_SESSION['identity'])) {
            $user = new Usuario();
            $users = $user->getAll();
            foreach ($users as &$usuario) {

                $path = 'uploads/avatar/' . $usuario['id'];
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
                $usuario['avatar'] = base_url . $route;
            }



            $page_title = 'Usuarios | SIGMA';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/user/index.php';
            require_once 'views/user/create.php';
            require_once 'views/user/modal-user.php';


            // require_once 'views/user/modal-date.php';
            //require_once 'views/user/edit.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }
}

    public function desactivar_usuario()
    {

        if (isset($_SESSION['identity']) && !empty($_SESSION['identity'])) {
            $id_usuario = isset($_POST['id_usuario']) ? Encryption::decode(trim($_POST['id_usuario'])) : '';


         
            $user = new Usuario();
            $user->setId($id_usuario);
            $user->setActivation(0);
            $save = $user->desactivar_usuario();

          
            $user = new Usuario();
            $usuarios = UsuarioController::formatear($user->getAll());

            if ($save) {
                echo json_encode(array('status' => 1, 'usuarios' => $usuarios));
            } else {
                echo json_encode(array('status' => 2));
            }
        } else {
            header("location:" . base_url . SID);
        }
    }



    public function save()
    {
        if (Utils::isValid($_POST)) {

            $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : FALSE;
            $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;
            $Nombres = isset($_POST['Nombres']) ? trim($_POST['Nombres']) : FALSE;
            $Apellidos = isset($_POST['Apellidos']) ? trim($_POST['Apellidos']) : FALSE;
            $Correo = isset($_POST['Correo']) ? trim($_POST['Correo']) : FALSE;
            $id_tipo_usuario = isset($_POST['id_tipo_usuario']) ? trim($_POST['id_tipo_usuario']) : FALSE;


            if ($usuario && $password  && $Nombres && $Apellidos && $Correo && $id_tipo_usuario) {

                $user = new Usuario();
                $user->setUsuario($usuario);
                $user->setPassword($password);
                $user->setNombres($Nombres);
                $user->setApellidos($Apellidos);
                $user->setCorreo($Correo);
                $user->setActivation(1);
                $user->setId_tipo_usuario($id_tipo_usuario);

                $userExists = $user->userExists();
                // $emailExists = $user->emailExists();

                if (!$userExists) {
                    $save = $user->save();

                    if ($save) {

                        $user = new Usuario();
                        $usuarios = UsuarioController::formatear($user->getAll());

                        echo json_encode(array('status' => 1, 'usuarios' => $usuarios));
                    } else {
                        echo json_encode(array('status' => 4));
                    }
                } else {
                    echo json_encode(array('status' => 3)); //si existe l usuario marca 3
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }



    public function cambiar_contrasenia()
    {
        if (isset($_GET['id']) && isset($_GET['token'])) {
            $user = new User();
            $user->setId(Encryption::decode($_GET['id']));
            $user->setToken_password($_GET['token']);
            $flag = $user->verifyToken_password();

            $page_title = 'Cambiar contraseña | SIGMA';
            require_once 'views/user/header.php';
            require_once 'views/user/new_password.php';
            require_once 'views/user/footer.php';
        } else {
            header("location:./recuperar_cuenta");
        }
    }

    public function new_password()
    {
        if (Utils::isValid($_POST)) {
            $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : FALSE;
            $confirm_new_password = isset($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : FALSE;
            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : FALSE;
            $token = isset($_POST['token']) ? $_POST['token'] : FALSE;

            if ($new_password && $confirm_new_password && $id && $token && ($new_password == $confirm_new_password)) {
                $user = new User();
                $user->setId($id);
                $user->setPassword($new_password);
                $user->setToken_password($token);
                $user->changePassword();
            }
        } else {
            header("location:./recuperar_cuenta");
        }
    }

    public function user_exists()
    {
        if (Utils::isValid($_POST['username'])) {
            $user = new User();
            $user->setUsername($_POST['username']);
            if ($user->userExists()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function email_exists()
    {
        if (Utils::isValid($_POST['email'])) {
            $user = new User();
            $user->setEmail($_POST['email']);
            if ($user->emailExists()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function registrar()
    {
        if (!isset($_SESSION['identity'])) {

            $page_title = 'Regístrate | SIGMA';
            require_once 'views/user/header.php';
            require_once 'views/user/create_candidate copy.php';
            require_once 'views/user/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function create()
    {
        $username = isset($_POST['username']) ? trim($_POST['username']) : FALSE;
        $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;
        $password_confirm = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : FALSE;
        $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
        $id_user_type = 7;

        if ($username && $password && $password_confirm && $email && $id_user_type) {
            if ($password == $password_confirm) {
                $user = new User();
                $user->setUsername($username);
                $user->setPassword($password);
                $user->setFirst_name('');
                $user->setLast_name('');
                $user->setEmail($email);
                $user->setActivation(0);
                $user->setId_user_type($id_user_type);

                $userExists = $user->userExists();
                $emailExists = $user->emailExists();

                if (!$userExists && !$emailExists) {
                    $save = $user->save();

                    if ($save) {
                        $id = Encryption::encode($user->getId());
                        $token = $user->getToken();

                        $url = base_url . 'usuario/activar_cuenta&id=' . $id . '&val=' . $token;

                        $subject = 'Activación de cuenta de usuario';
                        $body = "Gracias por registrarte en RRHH Ingenia, tu cuenta ha sido creada para que ingreses a nuestra página " . base_url . " con tu nombre de usuario o correo electrónico: <br/><br/> Usuario: {$username} <br/><br/> Contraseña : {$password} <br /> <br /> Para continuar, es necesario que actives tu cuenta dando click en el siguiente <a href={$url}>enlace</a>";

                        echo 1; //if everything is ok, returns 1
                        Utils::sendEmail($email, '', $subject, $body);
                    } else {
                        echo 4;
                    }
                } else {
                    echo 3; //if the user or email already exists, returns 3
                }
            } else {
                echo 2; //if the passwords do not match, returns 2
            }
        } else {
            echo 0; //if any data is missing, returns 0
        }
    }



    public function upload_image()
    {
        if (isset($_SESSION['identity'])) {
            if ($_FILES['avatar']['error'] > 0) {
                echo 0; //Error loading file
            } else {
                $id = ($_SESSION['identity']->id);
                if (file_exists('uploads/avatar/' . $id)) {
                    Utils::deleteDir('uploads/avatar/' . $id);
                }

                $allowed_formats = array("image/gif", "image/png", "image/jpeg", "image/jpg");
                $limit_kb = 6000;

                if (in_array($_FILES["avatar"]["type"], $allowed_formats) && $_FILES["avatar"]["size"] <= $limit_kb * 1024) {

                    $route = 'uploads/avatar/' . $id . '/';
                    $avatar = $route . $_FILES["avatar"]["name"];

                    if (!file_exists($route)) {
                        mkdir($route);
                    }

                    if (!file_exists($avatar)) {

                        $result = @move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar);

                        if ($result) {
                            Utils::showProfilePicture();
                            echo 1; //saved file
                        } else {
                            echo 2; //Error saving file
                        }
                    } else {
                        echo 3; //File already exists
                    }
                } else {
                    echo 4; //File not allowed or exceeds size
                }
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function upload_image64()
    {
        if (isset($_SESSION['identity']) && isset($_POST['avatar'])) {
            $img = $_POST['avatar'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $id = $_SESSION['identity']->id;
            $route = 'uploads/avatar/' . $id . '/';

            if (file_exists($route)) {
                Utils::deleteDir('uploads/avatar/' . $id);
            }

            if (!file_exists($route)) {
                mkdir($route);
            }

            $file = $route . uniqid() . '.png';
            $success = file_put_contents($file, $data);

            if (Utils::isCandidate()) {
                $candidate = new Candidate();
                $candidate->setId_user($_SESSION['identity']->id);
                $candidato = $candidate->getCandidateByUsername();

                $route_candidate = 'uploads/candidate/' . $candidato->id . '/';

                if (file_exists($route_candidate)) {
                    Utils::deleteDir('uploads/candidate/' . $candidato->id . '/');
                }

                if (!file_exists($route_candidate)) {
                    mkdir($route_candidate);
                }

                $file = $route_candidate . uniqid() . '.png';
                $success = file_put_contents($file, $data);
            }

            if ($success) {
                Utils::showProfilePicture();
                echo 1;
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }

    //en proceso
    public function change_password()
    {
        if (Utils::isValid($_POST)) {
            $password = isset($_POST['password']) ? $_POST['password'] : FALSE;
            $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : FALSE;
            $confirm_new_password = isset($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : FALSE;

            if ($new_password && $confirm_new_password) {
                if ($new_password == $confirm_new_password) {
                    if ($password == Utils::decrypt($_SESSION['identity']->password)) {
                        $user = new User();
                        $user->setId($_SESSION['identity']->id);
                        $user->setPassword($new_password);
                        $user->updatePassword();

                        $_SESSION['identity']->password = Utils::encrypt($new_password);
                        echo 1;
                    } else {
                        echo 3;
                    }
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }



    public function updateUser() // el formulario se recive por post
    {
        $id = $_POST['id'];
        $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : FALSE;
        $Nombres = isset($_POST['Nombres']) ? trim($_POST['Nombres']) : FALSE;
        $Apellidos = isset($_POST['Apellidos']) ? trim($_POST['Apellidos']) : FALSE;
        $Correo = isset($_POST['Correo']) ? $_POST['Correo'] : FALSE;
        // $password = isset($_POST['password']) ? Utils::encrypt($_POST['password']) : FALSE;
        $password = isset($_POST['password']) ? $_POST['password'] : FALSE;
        $id_tipo_usuario = isset($_POST['id_tipo_usuario']) ? $_POST['id_tipo_usuario'] : FALSE;



        if ($id && $usuario && $Nombres  && $Apellidos && $Correo && $password && $id_tipo_usuario) {
            $userObj = new Usuario();
            $userObj->setId($id);
            $userObj->setUsuario($usuario);
            $userObj->setNombres($Nombres);
            $userObj->setApellidos($Apellidos);
            $userObj->setCorreo($Correo);
            $userObj->setPassword($password);
            $userObj->setId_tipo_usuario($id_tipo_usuario);

            $userExists = $userObj->userExists();


            $userObj->updateUser();

            $user = new Usuario();
            $usuarios = UsuarioController::formatear($user->getAll());

            echo json_encode(array('status' => 1, 'usuarios' => $usuarios));
        } else
            echo json_encode(array('status' => 0));
    }

    public function dark_mode()
    {
        if (isset($_SESSION['identity']) & !empty($_SESSION['identity'])) {

            $mode = isset($_POST['mode']) && !empty($_POST['mode']) ? $_POST['mode'] : 0;
            $_SESSION['dark_mode'] = $mode;

            $user = new User();
            $user->setId($_SESSION['identity']->id);
            $user->setDark_mode($mode);
            $user->darkMode();
        }
    }


    public function getOne()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $UserObj = new User();
                $UserObj->setId($id);
                $user = $UserObj->getOne();
                // $user->password = Utils::decrypt($user->password);
                // $user->password = Utils::decrypt($user->password);
                echo json_encode(array(
                    'status' => 1,
                    'user' => $user
                ));
            } else
                echo json_encode(array('status' => 0));
        } else {
        
            echo json_encode(array('status' => 0));
        }
    }
    public function getOneByUsername()
    {
        if (Utils::isValid($_POST['username'])) {
            $user = new User();
            $user->setUsername($_POST['username']);
            $user = $user->getOneByUsername();

            $contacto = new ContactosEmpresa();
            $contacto->setUsuario($_POST['username']);
            $info = $contacto->getEmpresayClienteByUsername();

            if ($user) {
                echo json_encode(array('status' => 1, 'user' => $user, 'info' => $info));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function getOneByEmail()
    {
        if (Utils::isValid($_POST['email'])) {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user = $user->getOneByEmail();

            $contacto = new ContactosEmpresa();
            $contacto->setCorreo($_POST['email']);
            $info = $contacto->getEmpresayClienteByUsername();

            if ($user) {
                echo json_encode(array('status' => 1, 'user' => $user, 'info' => $info));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }


    function Send_email()
    {
        if (Utils::isValid($_POST)) {


            $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : FALSE;

            $user = new User();
            $user->setUsername($usuario);
            $objectuser = $user->getOneByUsername();
            $contrasena = Utils::decrypt($objectuser->password);
            $email = $objectuser->email;
            $nombre = $objectuser->first_name . " " . $objectuser->last_name;


            $subject = 'Envio de Usuario de RRHH Ingenia';
            $body = "Se envía el usuario de la plataforma, para acceder presione <a href='" . base_url . "usuario/index' target='_blank'>Aqui</a>";
            $body .= " : <br> username:" . $objectuser->username;
            $body .= " <br> contraseña:" . $contrasena;

            if (Utils::sendEmail($email, $nombre, $subject, $body)) {
                $subject = 'Copia a ' . $_SESSION['identity']->first_name . " " . $_SESSION['identity']->last_name;
                Utils::sendEmail($_SESSION['identity']->email, $_SESSION['identity']->first_name . " " . $_SESSION['identity']->last_name, $subject, $body);
                echo json_encode(array('status' => 1));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 2));
        }
    }
}
