<?php

require_once 'models/User.php';
require_once 'models/ModelosSigma/usuario.php';

class UsuarioController
{

    public function index()
    {

        if (isset($_SESSION['identity']) && !empty($_SESSION['identity'])) {

            $page_title = 'Bienvenido(a) | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/layout/dashboard.php';
            //if (Utils::isCustomerSA() || Utils::isCustomer()) 
            //require_once 'views/layout/modal-encuesta.php';
            require_once 'views/layout/footer.php';
        } else {

            $page_title = 'Iniciar sesión | RRHH Ingenia';
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
                    switch ($identity->id_tipo_usuario) {
                        case 1:
                            $_SESSION['admin'] = TRUE;
                            break;
                        case 2:
                            $_SESSION['Procura'] = TRUE;
                            $_SESSION['tipo'] = 'Procura';
                            break;
                        case 3:
                            $_SESSION['junior'] = TRUE;
                            break;
                        case 4:
                            $_SESSION['manager'] = TRUE;
                            break;
                        case 5:
                            $_SESSION['salesmanager'] = TRUE;
                            break;
                        case 6:
                            $_SESSION['customer'] = TRUE;
                            break;
                        case 7:
                            $_SESSION['candidate'] = TRUE;
                            break;
                        case 8:
                            $_SESSION['sales'] = TRUE;
                            break;
                        case 9:
                            $_SESSION['recruitmentmanager'] = TRUE;
                            break;
                        case 10:
                            $_SESSION['samanager'] = TRUE;
                        case 11:
                            $_SESSION['operationssupervisor'] = TRUE;
                            break;
                        case 12:
                            $_SESSION['logisticssupervisor'] = TRUE;
                            break;
                        case 13:
                            $_SESSION['account'] = TRUE;
                            break;
                        case 14:
                            $_SESSION['logistics'] = TRUE;
                            break;
                        case 15:
                            $_SESSION['customerSA'] = TRUE;
                            break;
                        case 16:
                            $_SESSION['humanresources'] = TRUE;
                            break;
                    }
                } else {
                    echo 10;
                }
            } else {
                echo 11;
            }
        } else {
            header("location:" . base_url . SID);
        }
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
            $usuario['last_session'] = ($usuario['last_session'] != NULL) ? Utils::getFullDate($usuario['last_session']) : '';
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
            $user = new Usuario();
            $users = $user->getAll();


            $page_title = 'Usuarios | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/user/index.php';
            require_once 'views/user/modal-user.php';

            // require_once 'views/user/create.php';
            // require_once 'views/user/modal-date.php';
            //require_once 'views/user/edit.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }


    public function save()
    {
        if (Utils::isValid($_POST)) {
            $username = isset($_POST['username']) ? trim($_POST['username']) : FALSE;
            $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;
            $password_confirm = isset($_POST['password_confirm']) ? trim($_POST['password_confirm']) : FALSE;
            $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
            $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;
            $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
            $id_user_type = isset($_POST['id_user_type']) ? trim($_POST['id_user_type']) : FALSE;

            if ($username && $password && $password_confirm && $first_name && $last_name && $email && $id_user_type) {
                if ($password == $password_confirm) {
                    $user = new User();
                    $user->setUsername($username);
                    $user->setPassword($password);
                    $user->setFirst_name($first_name);
                    $user->setLast_name($last_name);
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

                            $subject = 'Activar cuenta de usuario';
                            $name = $first_name . ' ' . $last_name;
                            $body = "Estimado(a) {$name}, tu cuenta ha sido creada para que ingreses a nuestra página " . base_url . " con tu nombre de usuario o correo electrónico: <br/><br/> Usuario: {$username} <br/><br/> Contraseña : {$password} <br /> <br /> Para continuar con el proceso de registro, es necesario que actives tu cuenta haciendo click en el siguiente <a href={$url}>enlace</a>";

                            echo 1; //if everything is ok, returns 1
                            Utils::sendEmail($email, $name, $subject, $body);
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

            $page_title = 'Cambiar contraseña | RRHH Ingenia';
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

            $page_title = 'Regístrate | RRHH Ingenia';
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



    public function updateUser()
    {
        $id = $_POST['id'];
        $username = isset($_POST['username']) ? trim($_POST['username']) : FALSE;
        $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
        $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;
        $email = isset($_POST['email']) ? $_POST['email'] : FALSE;
        $password = isset($_POST['password']) ? Utils::encrypt($_POST['password']) : FALSE;
        $id_user_type = isset($_POST['id_user_type']) ? $_POST['id_user_type'] : FALSE;

        if ($id && $username && $email  && $first_name && $last_name && $password && $id_user_type) {
            $userObj = new User();
            $userObj->setId($id);
            $userObj->setUsername($username);
            $userObj->setFirst_name($first_name);
            $userObj->setLast_name($last_name);
            $userObj->setEmail($email);
            $userObj->setPassword($password);
            $userObj->setId_user_type($id_user_type);

            $userExists = $userObj->userExists();
            $emailExists = $userObj->emailExists();

            if (isset($_POST['flag_username']) && !$userExists) {
                $userObj->updateUserName();
            }

            if (isset($_POST['flag_email']) && !$emailExists) {
                $userObj->updateUserEmail();
            }

            if (isset($_POST['flag_desactivate'])) {
                $userObj->setActivation(0);
                $userObj->updateActivation();
            }

            $userObj->updateUser();
            $user = new User();
            $usuarios = $user->getEmployees();
            $usuarios =  UsuarioController::formatear($usuarios);

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
