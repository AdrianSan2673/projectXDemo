<?php

require_once 'models/User.php';
require_once 'models/Candidate.php';
require_once 'models/CandidateEducation.php';
require_once 'models/Vacancy.php';
require_once 'models/VacancyApplicant.php';
require_once 'models/CustomerContact.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/ContactosCliente.php';
require_once 'models/SA/EncuestaCliente.php';
require_once 'models/RH/Employees.php';

class UsuarioController {

    public function index() {
        if (isset($_SESSION['identity']) && !empty($_SESSION['identity'])) {

            Utils::showProfilePicture();
            
            if (Utils::isCandidate()) {
                $candidate = new Candidate();
                $candidate->setId_user($_SESSION['identity']->id);
                $candidato = $candidate->getCandidateByUsername();
                if (!$candidato) {
                    header('location:'.base_url.'candidato/crear');
                }else{
                    if ($candidato->job_title == NUll || $candidato->description == NULL || $candidato->id_state == NULL || $candidato->id_city == NULL || $candidato->id_civil_status == NULL || $candidato->id_area == NULL || ($candidato->telephone == NULL && $candidato->cellphone == NULL)) {
                        header('location:'.base_url.'candidato/editar');
                    }
                    if (isset($_GET['vacante'])) {
                        header('location:'.base_url.'postulaciones/postulate&id_candidate='.Encryption::encode($_SESSION['identity']->id).'&id_vacancy='.$_GET['vacante']);
                    }
                }
            }

            if (Utils::isCustomer()) {
                $contact = new CustomerContact();
                $contact->setId_user($_SESSION['identity']->id);
                $contacto = $contact->getContactByUser();

                if (date('j') <= 0) {
                    if ($contacto) {
                        $evaluation = new EncuestaCliente();
                        $evaluation->setUsuario($_SESSION['identity']->username);
                        $evaluation->setID_Cliente_Reclu($contacto->id_customer);
                        $evaluation->setFecha(date('Y-m-d'));
                        $calificacionCliente = $evaluation->getOneReclu();
                        if (!$calificacionCliente) {
                            $_SESSION['Encuesta'] = (object)array(
                                'ID_Cliente_Reclu' => $contacto->id_customer,
                                'Usuario' => $_SESSION['identity']->username,
                                'ID_Empresa' => NULL,
                                'ID_Cliente' => NULL,
                            );
                        }
                    }
                }
				
				$contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id = $contactoEmpresa->getContactoPorUsuario();
                if ($id){
                    $id = $id->ID;
                    $_SESSION['customerSA'] = TRUE;
                }
            }

            
            /* if (Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
                header('location:'.base_url.'ServicioApoyo/en_proceso');
            } */
            if (Utils::isLogistics()) {
                header('location:'.base_url.'ServicioApoyo/en_proceso');
            }

            if (Utils::isCustomerSA()){
                if (date('j') <= 0) {
                    $contactoEmpresa = new ContactosEmpresa();
                    $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                    $id = $contactoEmpresa->getContactoPorUsuario()->ID;

                    $clienteContacto = new ContactosCliente();
                    $clienteContacto->setID($id);
                    $clienteconta = $clienteContacto->getPrimerCliente();
                    if ($clienteconta) {
                        $calificacion = new EncuestaCliente();
                        $calificacion->setUsuario($_SESSION['identity']->username);
                        $calificacion->setID_Cliente($clienteconta->Cliente);
                        $calificacion->setID_Empresa($clienteconta->Empresa);
                        $calificacion->setFecha(date('Y-m-d'));
                        $calificacionCliente = $calificacion->getOneSA();
                        if (!$calificacionCliente) {
                            $_SESSION['Encuesta'] = (object)array(
                                'ID_Empresa' => $clienteconta->Empresa,
                                'ID_Cliente' => $clienteconta->Cliente,
                                'Usuario' => $_SESSION['identity']->username,
                                'ID_Cliente_Reclu' => NULL
                            );
                        }
                    }
                }
				$contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;
            

                $employeeObj = new Employees();
                $employeeObj->setStatus(1);
                $employeeObj->setID_Contacto($id_contacto);
                $employeeBirthday= $employeeObj->getEmployeesBirthdayCurrentMonth();
                $employeeBirthdayNextMonth = $employeeObj->getEmployeesBirthdayNextMonth();
                $employeeContract= $employeeObj->getFinishContracEmployee();
				
                
                $contact = new CustomerContact();
                $contact->setId_user($_SESSION['identity']->id);
                $contacto = $contact->getContactByUser();
                if ($contacto)
                    $_SESSION['customer'] = TRUE;
            }
			
			if ($_SESSION['identity']->username == 'salmaperez' && date('Y-m-d') == '2022-08-26') {
                if (!isset($_SESSION['salma_fest'])) {
                    $_SESSION['salma_fest'] = 1;
                    header('location:'.base_url.'usuario/salma_fest');
                }
            }
			
			//if ($_SESSION['identity']->username == 'miroslavagarcia')
                //$_SESSION['customerSA'] = TRUE;

            $page_title = 'Bienvenido(a) | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/layout/dashboard.php';
            if (Utils::isCustomerSA() || Utils::isCustomer()) 
                require_once 'views/layout/modal-encuesta.php';
            require_once 'views/layout/footer.php';
        } else {

            $page_title = 'Iniciar sesión | RRHH Ingenia';
            require_once 'views/user/header.php';
            require_once 'views/user/login.php';
            require_once 'views/user/footer.php';
        }
        
    }

    public function opciones(){
        if (isset($_SESSION['identity']) && !empty($_SESSION['identity'])) {
            header("location:".base_url."usuario/index");
        }else{
            $page_title = 'Reclutamiento | RRHH Ingenia';
            require_once 'views/user/header.php';
            require_once 'views/user/options.php';
            require_once 'views/user/footer.php';
        }
        
    }


    public function login() {
        if (Utils::isValid($_POST)) {
            $username = isset($_POST['username']) ? trim($_POST['username']) : FALSE;
            $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;
            if ($username && $password) {
                $user = new User();
                $user->setUsername($username);
                $user->setEmail($username);
                $user->setPassword($password);
                $identity = $user->login();
                
                if ($identity && is_object($identity)) {
                    $_SESSION['identity'] = $identity;
                    $user->lastSession($identity->id);
                    echo 1;
                    $_SESSION['dark_mode'] = $_SESSION['identity']->dark_mode;
                    switch ($identity->id_user_type) {
                        case 1:
                            $_SESSION['admin'] = TRUE;
                            break;
                        case 2:
                            $_SESSION['senior'] = TRUE;
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

                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        }else {
            header("location:".base_url.SID);
        }
        
    }

    public function logout(){
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION)) {
            unset($_SESSION);
        }
        session_destroy();
        header("location:".base_url."usuario/index");
    }

    public function all(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin()) {
            $user = new User();
            $users = $user->getEmployees();
            for($i=0; $i < count($users); $i++){
                $path = 'uploads/avatar/'.$users[$i]['id'];
                if (file_exists($path)) {
                    $directory = opendir($path);
        
                    while ($file = readdir($directory))
                    {
                        if (!is_dir($file)){
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path."/".$file);
                            $route = $path.'/'.$file;
                        }
                    }
                }else{
                    $route = "dist/img/user-icon.png";
                    $type = pathinfo($route, PATHINFO_EXTENSION);
                    $img_content = file_get_contents($route);
                }
                //$img_base64 = chunk_split(base64_encode($img_content));
                $img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
                $users[$i]['avatar'] = base_url.$route;
                
            }

            $page_title = 'Usuarios | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
			require_once 'views/user/modal-user.php';
            require_once 'views/user/index.php';
            require_once 'views/user/create.php';
            //require_once 'views/user/edit.php';
            require_once 'views/layout/footer.php';
        }else {
            header("location:".base_url);
        }
    }

    public function save(){
        if (Utils::isValid($_POST) && Utils::isAdmin()) {
            $username = isset($_POST['username']) ? trim($_POST['username']) : FALSE;
            $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;
            $password_confirm = isset($_POST['password_confirm']) ? trim($_POST['password_confirm']) : FALSE;
            $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
            $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;
            $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
            $id_user_type = isset($_POST['id_user_type']) ? trim($_POST['id_user_type']) : FALSE;

            if ($username && $password && $password_confirm && $first_name && $last_name && $email && $id_user_type) {
                if ($password==$password_confirm) {
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
                            
                            $url = base_url.'usuario/activar_cuenta&id='.$id.'&val='.$token;
                            
                            $subject = 'Activar cuenta de usuario';
                            $name = $first_name.' '.$last_name;
                            $body = "Estimado(a) {$name}, tu cuenta ha sido creada para que ingreses a nuestra página ".base_url." con tu nombre de usuario o correo electrónico: <br/><br/> Usuario: {$username} <br/><br/> Contraseña : {$password} <br /> <br /> Para continuar con el proceso de registro, es necesario que actives tu cuenta haciendo click en el siguiente <a href={$url}>enlace</a>";
                            
                            echo 1; //if everything is ok, returns 1
                            Utils::sendEmail($email, $name, $subject, $body);
                        }else{
                            echo 4;
                        }
                    }else{
                        echo 3; //if the user or email already exists, returns 3
                    }
                }else{
                    echo 2; //if the passwords do not match, returns 2
                }
                    
            }else{
                echo 0; //if any data is missing, returns 0
            }
        }else{
            header("location:".base_url);
        }
    }

    public function activar_cuenta(){
        if(isset($_GET["id"]) && isset($_GET['val'])){	
            $id = Encryption::decode($_GET['id']);
            $token = $_GET['val'];
            $user = new User();
        
            $case = $user->validateIdToken($id, $token);
            
            switch($case){
                case 1:
                    $msg = "La cuenta ya había sido activada.";
                    $color = "orange";
                    break;
                case 2:
                    $msg = "Cuenta activada.";
                    $color = "success";
                    break;
                case 3:
                    $msg = "Activación de cuenta fallida";
                    $color = "danger";
                    break;
                default:
                    $msg = "No hay cuenta que activar.";
                    $color = "danger";
            }

            $page_title = 'Activar cuenta | RRHH Ingenia';
            require_once 'views/user/header.php';
            require_once 'views/user/activate.php';
            require_once 'views/user/footer.php';
        }else{
            header("location:".base_url);
        }
    }

    public function recuperar_cuenta(){
        $page_title = 'Recuperar cuenta | RRHH Ingenia';
        require_once 'views/user/header.php';
        require_once 'views/user/recover.php';
        require_once 'views/user/footer.php';
    }

    public function recover(){
        if (isset($_POST['email'])) {
            $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
            if ($email) {
                $user = new User();
                $user->setEmail($email);
                $id = $user->getIdWithEmail();
                $name = $user->getNameWithEmail();
                $user->setId($id);
                $token = $user->generateToken_password();
                $id = Encryption::encode($id);
                
                $url = base_url."usuario/cambiar_contrasenia&id={$id}&token={$token}";
                $subject = 'Recuperación de cuenta';
                $body = "Se ha solicitado un reinicio de contraseña. Haga click en el siguiente <a href='{$url}'> enlace</a> para recuperar su cuenta";
                if(Utils::sendEmail($email, $name, $subject, $body)){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        } else {
            header("location:./recuperar_cuenta");
        }
        
    }

    public function cambiar_contrasenia(){
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

    public function new_password(){
        if (Utils::isValid($_POST)) {
            $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : FALSE;
            $confirm_new_password = isset($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : FALSE;
            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : FALSE;
            $token = isset($_POST['token']) ? $_POST['token'] : FALSE;

            if($new_password && $confirm_new_password && $id && $token && ($new_password == $confirm_new_password)){
                $user = new User();
                $user->setId($id);
                $user->setPassword($new_password);
                $user->setToken_password($token);
                $user->changePassword();
            }
            
        }else {
            header("location:./recuperar_cuenta");
        }
    }

    public function user_exists(){
        if(Utils::isValid($_POST['username'])){
            $user = new User();
            $user->setUsername($_POST['username']);
            if($user->userExists()){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            header("location:".base_url);
        }
        
    }

    public function email_exists(){
        if (Utils::isValid($_POST['email'])) {
            $user = new User();
            $user->setEmail($_POST['email']);
            if ($user->emailExists()) {
                echo 1;
            }else{
                echo 0;
            }
        } else {
            header("location:".base_url);
        }
    }

    public function registrar(){
        if (!isset($_SESSION['identity'])) {

            $page_title = 'Regístrate | RRHH Ingenia';
            require_once 'views/user/header.php';
            require_once 'views/user/create_candidate copy.php';
            require_once 'views/user/footer.php';
        } else {
            header("location:".base_url);
        }            
    }

    public function create(){
        $username = isset($_POST['username']) ? trim($_POST['username']) : FALSE;
        $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;
        $password_confirm = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : FALSE;
        $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
        $id_user_type = 7;

        if ($username && $password && $password_confirm && $email && $id_user_type) {
            if ($password==$password_confirm) {
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
                        
                        $url = base_url.'usuario/activar_cuenta&id='.$id.'&val='.$token;
                        
                        $subject = 'Activación de cuenta de usuario';
                        $body = "Gracias por registrarte en RRHH Ingenia, tu cuenta ha sido creada para que ingreses a nuestra página ".base_url." con tu nombre de usuario o correo electrónico: <br/><br/> Usuario: {$username} <br/><br/> Contraseña : {$password} <br /> <br /> Para continuar, es necesario que actives tu cuenta dando click en el siguiente <a href={$url}>enlace</a>";
                        
                        echo 1; //if everything is ok, returns 1
                        Utils::sendEmail($email, '', $subject, $body);
                    }else{
                        echo 4;
                    }
                }else{
                    echo 3; //if the user or email already exists, returns 3
                }
            }else{
                echo 2; //if the passwords do not match, returns 2
            }
                
        }else{
            echo 0; //if any data is missing, returns 0
        }
    }

    public function register(){
        $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
        $surname = isset($_POST['surname']) ? trim($_POST['surname']) : FALSE;
        $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;

        $day = isset($_POST['day']) ? trim($_POST['day']) : FALSE;
        $month = isset($_POST['month']) ? trim($_POST['month']) : FALSE;
        $year = isset($_POST['year']) ? trim($_POST['year']) : FALSE;
        
        $gender = isset($_POST['gender']) ? trim($_POST['gender']) : FALSE;
        $state = isset($_POST['state']) ? trim($_POST['state']) : FALSE;
        $city = isset($_POST['city']) ? trim($_POST['city']) : FALSE;
        $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;
        $job_title = isset($_POST['job_title']) ? trim($_POST['job_title']) : FALSE;
        $description = isset($_POST['description']) ? trim($_POST['description']) : FALSE;
        $area = isset($_POST['area']) ? trim($_POST['area']) : FALSE;
        $subarea = isset($_POST['subarea']) ? trim($_POST['subarea']) : FALSE;

        $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : FALSE;
        $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
        $password = isset($_POST['password']) ? trim($_POST['password']) : FALSE;
        $id_user_type = 7;
        $resume = isset($_FILES['resume']) && $_FILES['resume']['name'] != '' ? $_FILES['resume'] : FALSE;
        $id_vacancy = isset($_POST['id_vacancy']) && !empty($_POST['id_vacancy']) ? Encryption::decode($_POST['id_vacancy']) : FALSE;

        if ($resume) {
            $allowed_formats = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf");
            $limit_kb = 6000;
            if(!in_array($_FILES["resume"]["type"], $allowed_formats) || $_FILES["resume"]["size"] > $limit_kb * 1024){
                echo 4;
            }else{
                if ($first_name && $surname && $last_name && $day && $month && $year && $gender && $state && $city && $level && $job_title && $description && $area && $subarea && $password && $email && $telephone && $id_user_type) {
                    $user = new User();
                    $user->setUsername(NULL);
                    $user->setPassword($password);
                    $user->setFirst_name($first_name);
                    $user->setLast_name($surname.' '.$last_name);
                    $user->setEmail($email);
                    $user->setActivation(0);
                    $user->setId_user_type($id_user_type);
    
                    $userExists = $user->userExists();
                    $emailExists = $user->emailExists();
    
                    if (!$userExists && !$emailExists) {
                        $save = $user->save();
    
                        if ($save) {
                            $date = new DateTime();
                            $date->setDate($year, $month, $day);
                            $date_birth = $date->format('Y-m-d');
    
                            $candidate = new Candidate();
                            $candidate->setFirst_name($first_name);
                            $candidate->setSurname($surname);
                            $candidate->setLast_name($last_name);
                            $candidate->setDate_birth($date_birth);
                            $candidate->setAge(NULL);
                            $candidate->setId_gender($gender);
                            $candidate->setId_state($state);
                            $candidate->setEmail($email);
    
                            $candidate->setId_civil_status(NULL);
                            $candidate->setJob_title($job_title);
                            $candidate->setDescription($description);
                            $candidate->setTelephone($telephone);
                            $candidate->setCellphone('');
                            $candidate->setId_city($city);
                            $candidate->setId_area($area);
                            $candidate->setId_subarea($subarea);
                            $candidate->setLinkedinn('');
                            $candidate->setFacebook('');
                            $candidate->setInstagram('');
                            $candidate->setId_user($user->getId());
                            $candidate->setCreated_by(NULL);
    
                            $created = $candidate->save();
                            if ($created) {
                                $id = $candidate->getId();
                                $studies = new CandidateEducation();
                                $studies->setId_candidate($id);
                                $studies->setTitle(NULL);
                                $studies->setInstitution(NULL);
                                $studies->setStart_date(NULL);
                                $studies->setEnd_date(NULL);
                                $studies->setStill_studies(NULL);
                                $studies->setId_level($level);
    
                                $save_edu = $studies->save();
    
                                if ($save_edu) {
                                    
                                    if (file_exists('uploads/resume/'.$id)) {
                                        Utils::deleteDir('uploads/resume/'. $id);
                                    }
                                    
                                    $route = 'uploads/resume/'.$id.'/';
                                    $resume = $route.$_FILES["resume"]["name"];
                                    
                                    if(!file_exists($route)){
                                        mkdir($route);
                                    }
                                    
                                    if(!file_exists($resume)){
                                        $result = @move_uploaded_file($_FILES["resume"]["tmp_name"], $resume);
                                    }
                

                                    $id_user = Encryption::encode($user->getId());
                                    $token = $user->getToken();
                                    
                                    $url = base_url.'usuario/activar_cuenta&id='.$id_user.'&val='.$token;
                                    
                                    $subject = 'Verificación de correo electrónico';
                                    $body = "Gracias por registrarte en RRHH Ingenia, {$first_name}, ingresa a nuestra página e inicia sesión con tu correo electrónico.<br/><br/> Contraseña : {$password} <br /> <br /> Para continuar, es necesario que verifiques tu correo dando clic en el siguiente <a href={$url}>enlace</a>";
                                    
                                    echo 1; //if everything is ok, returns 1
                                    Utils::sendEmail($email, $first_name.' '.$surname, $subject, $body);

                                    $identity = $user->getOne();
                
                                    /* if ($identity && is_object($identity)) {
                                        $_SESSION['identity'] = $identity;
                                    } */
                                    if ($id_vacancy && is_numeric($id_vacancy)) {
                                        $vacancy = new Vacancy();
                                        $vacancy->setId($id_vacancy);
                                        $vacante = $vacancy->getOne();
                                        if ($vacante) {
                                            $applicant = new VacancyApplicant();
                                            $applicant->setId_vacancy($id_vacancy);
                                            $applicant->setId_candidate($id);

                                            if ($applicant->getTotal() == 0) {
                                                $applicant->create();
                                            }else{
                                                $applicant->delete();
                                            }
                                        }
                                    }
                                }
                            }else{
                                echo 2;
                            }
                                    
                        }else{
                            echo 2;
                        }
                    }else{
                        echo 3; //if the user or email already exists, returns 3
                    }
                        
                }else{
                    echo 0; //if any data is missing, returns 0
                }
            }
        }else{
            if ($first_name && $surname && $last_name && $day && $month && $year && $gender && $state && $city && $level && $job_title && $description && $area && $subarea && $telephone && $password && $email && $id_user_type) {
                $user = new User();
                $user->setUsername(NULL);
                $user->setPassword($password);
                $user->setFirst_name($first_name);
                $user->setLast_name($surname.' '.$last_name);
                $user->setEmail($email);
                $user->setActivation(0);
                $user->setId_user_type($id_user_type);

                $userExists = $user->userExists();
                $emailExists = $user->emailExists();

                if (!$userExists && !$emailExists) {
                    $save = $user->save();

                    if ($save) {
                        $date = new DateTime();
                        $date->setDate($year, $month, $day);
                        $date_birth = $date->format('Y-m-d');

                        $candidate = new Candidate();
                        $candidate->setFirst_name($first_name);
                        $candidate->setSurname($surname);
                        $candidate->setLast_name($last_name);
                        $candidate->setDate_birth($date_birth);
                        $candidate->setAge(NULL);
                        $candidate->setId_gender($gender);
                        $candidate->setId_state($state);
                        $candidate->setEmail($email);

                        $candidate->setId_civil_status(NULL);
                        $candidate->setJob_title($job_title);
                        $candidate->setDescription($description);
                        $candidate->setTelephone($telephone);
                        $candidate->setCellphone('');
                        $candidate->setId_city($city);
                        $candidate->setId_area($area);
                        $candidate->setId_subarea($subarea);
                        $candidate->setLinkedinn('');
                        $candidate->setFacebook('');
                        $candidate->setInstagram('');
                        $candidate->setId_user($user->getId());
                        $candidate->setCreated_by(NULL);

                        $created = $candidate->save();
                        if ($created) {
                            $id = $candidate->getId();
                            $studies = new CandidateEducation();
                            $studies->setId_candidate($id);
                            $studies->setTitle(NULL);
                            $studies->setInstitution(NULL);
                            $studies->setStart_date(NULL);
                            $studies->setEnd_date(NULL);
                            $studies->setStill_studies(NULL);
                            $studies->setId_level($level);

                            $save_edu = $studies->save();

                            if ($save_edu) {
                                
                                $id_user = Encryption::encode($user->getId());
                                $token = $user->getToken();
                                
                                $url = base_url.'usuario/activar_cuenta&id='.$id_user.'&val='.$token;
                                
                                $subject = 'Verificación de correo electrónico';
                                $body = "Gracias por registrarte en RRHH Ingenia, {$first_name}, ingresa a nuestra página e inicia sesión con tu correo electrónico.<br/><br/> Contraseña : {$password} <br /> <br /> Para continuar, es necesario que verifiques tu correo dando clic en el siguiente <a href={$url}>enlace</a>";
                                
                                echo 1; //if everything is ok, returns 1
                                Utils::sendEmail($email, $first_name.' '.$surname, $subject, $body);

                                $identity = $user->getOne();
                
                                /* if ($identity && is_object($identity)) {
                                    $_SESSION['identity'] = $identity;
                                } */

                                if ($id_vacancy && is_numeric($id_vacancy)) {
                                    $vacancy = new Vacancy();
                                    $vacancy->setId($id_vacancy);
                                    $vacante = $vacancy->getOne();
                                    if ($vacante) {
                                        $applicant = new VacancyApplicant();
                                        $applicant->setId_vacancy($id_vacancy);
                                        $applicant->setId_candidate($id);

                                        if ($applicant->getTotal() == 0) {
                                            $applicant->create();
                                        }else{
                                            $applicant->delete();
                                        }
                                    }
                                }
                            }
                        }else{
                            echo 2;
                        }
                                
                    }else{
                        echo 2;
                    }
                }else{
                    echo 3; //if the user or email already exists, returns 3
                }
                    
            }else{
                echo 0; //if any data is missing, returns 0
            }
        }

            
    }

    public function editar_perfil(){
        if (isset($_SESSION['identity']) & !empty($_SESSION['identity'])) {
            $first_name = $_SESSION['identity']->first_name;
            $last_name = $_SESSION['identity']->last_name;

            if (Utils::isCandidate()) {
                $candidate = new Candidate();
                $candidate->setId_user($_SESSION['identity']->id);
                $candidato = $candidate->getCandidateByUsername();

                $first_name = $candidato->first_name;
                $surname = $candidato->surname;
                $last_name = $candidato->last_name;
            }

            $page_title = 'Editar perfil | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/user/edit_profile.php';
            require_once 'views/layout/footer.php';

        }else {
            header('location:'.base_url);
        }
    }

    public function upload_image(){
        if (isset($_SESSION['identity'])) {
            if ($_FILES['avatar']['error'] > 0) {
                echo 0; //Error loading file
            }else{
                $id = ($_SESSION['identity']->id);
                if (file_exists('uploads/avatar/'.$id)) {
                    Utils::deleteDir('uploads/avatar/'. $id);
                }
                
                $allowed_formats = array("image/gif","image/png","image/jpeg", "image/jpg");
                $limit_kb = 6000;
                
                if(in_array($_FILES["avatar"]["type"], $allowed_formats) && $_FILES["avatar"]["size"] <= $limit_kb * 1024){
                    
                    $route = 'uploads/avatar/'.$id.'/';
                    $avatar = $route.$_FILES["avatar"]["name"];
                    
                    if(!file_exists($route)){
                        mkdir($route);
                    }
                    
                    if(!file_exists($avatar)){
                        
                        $result = @move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar);
                        
                        if($result){
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
        }else{
            header("location:".base_url);
        }
    }

    public function upload_image64(){
        if (isset($_SESSION['identity']) && isset($_POST['avatar'])) {
            $img = $_POST['avatar'];
            $img = str_replace('data:image/png;base64,', '', $img);  
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $id = $_SESSION['identity']->id;
            $route = 'uploads/avatar/'.$id.'/';

            if (file_exists($route)) {
                Utils::deleteDir('uploads/avatar/'. $id);
            }

            if(!file_exists($route)){
                mkdir($route);
            }

            $file = $route . uniqid() . '.png';
            $success = file_put_contents($file, $data);

            if (Utils::isCandidate()) {
                $candidate = new Candidate();
                $candidate->setId_user($_SESSION['identity']->id);
                $candidato = $candidate->getCandidateByUsername();

                $route_candidate = 'uploads/candidate/'.$candidato->id.'/';

                if (file_exists($route_candidate)) {
                    Utils::deleteDir('uploads/candidate/'. $candidato->id.'/');
                }
    
                if(!file_exists($route_candidate)){
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
            
        }else{
            header("location:".base_url);
        }
    }

    //en proceso
    public function change_password(){
        if (Utils::isValid($_POST)) {
            $password = isset($_POST['password']) ? $_POST['password'] : FALSE;
            $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : FALSE;
            $confirm_new_password = isset($_POST['confirm_new_password']) ? $_POST['confirm_new_password'] : FALSE;

            if($new_password && $confirm_new_password){
                if ($new_password == $confirm_new_password) {
                    if ($password == Utils::decrypt($_SESSION['identity']->password)) {
                        $user = new User();
                        $user->setId($_SESSION['identity']->id);
                        $user->setPassword($new_password);
                        $user->updatePassword();

                        $_SESSION['identity']->password = Utils::encrypt($new_password);
                        echo 1;
                    }else{
                        echo 3;
                    }
                    
                }else{
                    echo 2;
                }
                
            }else{
                echo 0;
            }
            
        }else {
            header("location:".base_url);
        }
    }

    public function update(){
        $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
        $surname = isset($_POST['surname']) ? trim($_POST['surname']) : FALSE;
        $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;
        
        if ($first_name && $last_name) {
            if (Utils::isCandidate()) {
                $candidate = new Candidate();
                $candidate->setId_user($_SESSION['identity']->id);
                $candidato = $candidate->getCandidateByUsername();

                $candidate->setId($candidato->id);
                $candidate->setFirst_name($first_name);
                $candidate->setSurname($surname);
                $candidate->setLast_name($last_name);

                $candidate->update_name();

                $last_name = $surname.' '.$last_name;
            }
            $user = new User();
            $user->setId($_SESSION['identity']->id);
            $user->setFirst_name($first_name);
            $user->setLast_name($last_name);
            
            $save = $user->update();

            if ($save) {
                echo 1;

                $_SESSION['identity']->first_name = $first_name;
                $_SESSION['identity']->last_name = $last_name;
            }else{
                echo 2;
            }
   
        }else{
            echo 0; //if any data is missing, returns 0
        }
        header("location:".base_url."usuario/editar_perfil");
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

            echo json_encode(array('status' => 1));
        } else
            echo json_encode(array('status' => 0));
    }

    public function dark_mode(){
        if (isset($_SESSION['identity']) & !empty($_SESSION['identity'])) {
            
            $mode = isset($_POST['mode']) && !empty($_POST['mode']) ? $_POST['mode'] : 0;
            $_SESSION['dark_mode'] = $mode;

            $user = new User();
            $user->setId($_SESSION['identity']->id);
            $user->setDark_mode($mode);
            $user->darkMode();
        }
    }
	
	public function salma_fest(){
        if ($_SESSION['identity']->username == 'salmaperez') {
            require_once 'birthday/index.php';
            $_SESSION['salma_fest'] = 0;
        }else
            header('location:'.base_url.'usuario/index');
    }
	
  public function getOne()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $UserObj = new User();
                $UserObj->setId($id);
                $user = $UserObj->getOne();
                $user->password = Utils::decrypt($user->password);
                echo json_encode(array(
                    'status' => 1,
                    'user' => $user
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
