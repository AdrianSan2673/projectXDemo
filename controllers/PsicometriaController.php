<?php

require_once 'models/CustomerContact.php';
require_once 'models/User.php';
require_once 'models/Customer.php';
require_once 'models/Candidate.php';
require_once 'models/Psychometry.php';

class PsicometriaController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            if (Utils::isCustomer()) {
                $contact = new CustomerContact();
                $contact->setId_user($_SESSION['identity']->id);
                $contacto = $contact->getContactByUser();
                $psychometry = new Psychometry();
                $psychometry->setId_customer($contacto->id_customer);
                $psychometrics = $psychometry->getPsychometricsByCustomer();
            } else {
                $psychometry = new Psychometry();
                if (Utils::isAdmin()) {

                    $psychometrics = $psychometry->getAll();
                } else {
                    $psychometry->setId_Recruiter($_SESSION['identity']->id);
                    $psychometrics = $psychometry->getPsicometresByRecruiter();
                }
            }

            $page_title = 'Psicometrías | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/psychometry/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function crear()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE && !Utils::isCandidate()) {
            if (isset($_GET['candidate'])) {
                $id = Encryption::decode($_GET['candidate']);
                $candidate = new Candidate();
                $candidate->setId($id);
                $candidato = $candidate->getOne();
            }
            if (isset($_GET['customer'])) {
                $id_customer = Encryption::decode($_GET['customer']);
                $customer = new Customer();
                $customer->setId($id_customer);
                $cliente = $customer->getOne();
            }

            $page_title = 'Nueva psicometria | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/psychometry/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function agregar()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE && !Utils::isCandidate()) {
            if (isset($_GET['candidate'])) {
                $id = Encryption::decode($_GET['candidate']);
                $candidate = new Candidate();
                $candidate->setId($id);
                $candidato = $candidate->getOne();
            } else {
                header("location:" . base_url . "psicometria/index");
            }

            $page_title = 'Agregar psicometria | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/psychometry/add.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function create()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isCustomer())) {
            //$id_candidate = (isset($_POST['id_candidate'])) ? trim($_POST['id_candidate']) : FALSE;
            $first_name = Utils::sanitizeStringBlank($_POST['first_name']);
            $surname = Utils::sanitizeStringBlank($_POST['surname']);
            $last_name = Utils::sanitizeStringBlank($_POST['last_name']);
            $job_title = Utils::sanitizeStringBlank($_POST['job_title']);
            $telephone = Utils::sanitizeStringBlank($_POST['telephone']);
            $email = Utils::sanitizeEmail($_POST['email']);

            $behavior = isset($_POST['behavior']) && $_POST['behavior'] == 1 ? 1 : 0;
            $intelligence = isset($_POST['intelligence']) && $_POST['intelligence'] == 1 ? 1 : 0;
            $labor_competencies = isset($_POST['labor_competencies']) && $_POST['labor_competencies'] == 1 ? 1 : 0;
            $honesty_ethics_values = isset($_POST['honesty_ethics_values']) && $_POST['honesty_ethics_values'] == 1 ? 1 : 0;
            $personality = isset($_POST['personality']) && $_POST['personality'] == 1 ? 1 : 0;
            $sales_skills = isset($_POST['sales_skills']) && $_POST['sales_skills'] == 1 ? 1 : 0;
            $leadership = isset($_POST['leadership']) && $_POST['leadership'] == 1 ? 1 : 0;

            $id_customer = (isset($_POST['customer'])) ? trim($_POST['customer']) : FALSE;
            $id_business_name = (isset($_POST['business_name'])) ? trim($_POST['business_name']) : FALSE;

            $id_recruiter = (isset($_POST['id_recruiter'])) ? trim($_POST['id_recruiter']) : FALSE;


            if ($id_customer && $id_business_name && $id_recruiter) {
                $candidate = new Candidate();
                $candidate->setFirst_name($first_name);
                $candidate->setSurname($surname);
                $candidate->setLast_name($last_name);
                $candidate->setDate_birth(NULL);
                $candidate->setAge(NULL);
                $candidate->setId_gender(NULL);
                $candidate->setId_state(NULL);
                $candidate->setEmail($email);

                $candidate->setId_civil_status(NULL);
                $candidate->setJob_title($job_title);
                $candidate->setDescription('');
                $candidate->setTelephone($telephone);
                $candidate->setCellphone('');
                $candidate->setId_city(NULL);
                $candidate->setId_area(NULL);
                $candidate->setId_subarea(NULL);
                $candidate->setLinkedinn('');
                $candidate->setFacebook('');
                $candidate->setInstagram('');
                $candidate->setId_user(NULL);
                $candidate->setCreated_by($_SESSION['identity']->id);

                $candidate->save();

                $id_candidate = $candidate->getId();

                $psychometry = new Psychometry();
                $psychometry->setId_candidate($id_candidate);
                $psychometry->setId_customer($id_customer);
                $psychometry->setId_business_name($id_business_name);
                $psychometry->setBehavior($behavior);
                $psychometry->setIntelligence($intelligence);
                $psychometry->setLabor_competencies($labor_competencies);
                $psychometry->setHonesty_ethics_values($honesty_ethics_values);
                $psychometry->setPersonality($personality);
                $psychometry->setSales_skills($sales_skills);
                $psychometry->setLeadership($leadership);
                $psychometry->setId_Recruiter($id_recruiter);

                $save = $psychometry->create();
                if ($save) {
                    $cust = new Customer();
                    $cust->setId($id_customer);
                    $cliente = $cust->getOne()->customer;

                    /*  $email = 'cindy.luna@rrhhingenia.com';
                        $name = 'Cindy Luna'; */
                    // $email = 'iveth.gomez@rrhhingenia.com';
                    // $name = 'Iveth Gómez ';

                    $subject = 'Nueva solicitud de Psicometrías de ' . $cliente;
                    $created_by = $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name;

                    $body = "
                    Se ha registrado una solicitud de psicometrías de <b>{$cliente}</b> la cual fue creada por {$created_by}.
                    <br><br>
                    Las psicometrías a realizar son las siguientes:
                    <ul>" .
                        ($behavior == 1 ? '<li>Comportamiento</li>' : '') .
                        ($intelligence == 1 ? '<li>Inteligencia</li>' : '') .
                        ($labor_competencies == 1 ? '<li>Competencias Laborales</li>' : '') .
                        ($honesty_ethics_values == 1 ? '<li>Honestidad, ética y valores</li>' : '') .
                        ($personality == 1 ? '<li>Personalidad</li>' : '') .
                        ($sales_skills == 1 ? '<li>Habilidades de ventas</li>' : '') .
                        ($leadership == 1 ? '<li>Liderazgo</li>' : '') .
                        "</ul>";
                    //   Utils::sendEmail($email, $name, $subject, $body);
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function add()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $id_psychometry_type = isset($_POST['id_psychometry_type']) ? $_POST['id_psychometry_type'] : FALSE;
            $id_candidate = (isset($_POST['id_candidate'])) ? trim($_POST['id_candidate']) : FALSE;
            $psycho_file = isset($_FILES['psycho_file']) && $_FILES['psycho_file']['name'] != '' ? $_FILES['psycho_file'] : FALSE;

            if ($id_psychometry_type && $id_candidate) {
                $psychometry = new Psychometry();
                $psychometry->setId_psychometry_type($id_psychometry_type);
                $psychometry->setId_candidate($id_candidate);
                $psychometry->setCreated_by($_SESSION['identity']->id);

                $save = $psychometry->add();
                $id = $psychometry->getId();
                if ($psycho_file) {
                    if (file_exists('uploads/psychometrics/' . $id)) {
                        Utils::deleteDir('uploads/psychometrics/' . $id);
                    }

                    $allowed_formats = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf", "image/gif", "image/png", "image/jpeg", "image/jpg");
                    $limit_kb = 6000;

                    if (in_array($_FILES["psycho_file"]["type"], $allowed_formats) && $_FILES["psycho_file"]["size"] <= $limit_kb * 1024) {
                        $route = 'uploads/psychometrics/' . $id . '/';
                        $psycho_file = $route . $_FILES["psycho_file"]["name"];

                        if (!file_exists($route)) {
                            mkdir($route);
                        }

                        if (!file_exists($psycho_file)) {
                            $result = @move_uploaded_file($_FILES["psycho_file"]["tmp_name"], $psycho_file);
                        }

                        if ($save) {
                            echo 1;
                        } else {
                            echo 2;
                        }
                    } else {
                        echo 4;
                    }
                } else {
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

    public function ver()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE && !Utils::isCandidate()) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $psychometry = new Psychometry();
                $psychometry->setId($id);
                $psycho = $psychometry->getOne();

                $psychometry->setId_candidate($psycho->id_candidate);
                $psychometrics = $psychometry->getPsychometryFilesByCandidate();

                for ($i = 0; $i < count($psychometrics); $i++) {
                    $path = 'uploads/psychometrics/' . $psychometrics[$i]['id'];
                    if (file_exists($path)) {
                        $directory = opendir($path);
                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $route = $path . '/' . $file;
                            }
                        }
                        $psychometrics[$i]['file'] = base_url . $route;
                    }
                }



                //gabo 25 sept

                // $pathDocument = 'uploads/psychometrics/';
                // if (file_exists($pathDocument)) {
                //     $directory = opendir($pathDocument);

                //     while ($file = readdir($directory)) {
                //         if (!is_dir($file)) {
                //             $type = pathinfo($pathDocument, PATHINFO_EXTENSION);

                //             $routeDocu = $pathDocument  . $id . '.pdf';
                //         }
                //     }
                //     $routeDocu = base_url . $routeDocu;
                // } else
                //     $routeDocu = false;


                if (file_exists('uploads/psychometrics/' . $id . '.pdf')) {
                    $routeDocu = base_url . 'uploads/psychometrics/' . $id . '.pdf';
                } else {
                    $routeDocu = false;
                }
            }




            $page_title = "Psicometrías de {$psycho->candidate} | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/psychometry/read.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function editar()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE && !Utils::isCandidate()) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $psychometry = new Psychometry();
                $psychometry->setId($id);
                $psycho = $psychometry->getOne();
            }

            $page_title = "Psicometrías de {$psycho->candidate} | RRHH Ingenia";
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/psychometry/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    //gabo 22
    public function update()
    {
        if (Utils::isAdmin() || Utils::isSales() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : FALSE;

            $first_name = Utils::sanitizeStringBlank($_POST['first_name']);
            $surname = Utils::sanitizeStringBlank($_POST['surname']);
            $last_name = Utils::sanitizeStringBlank($_POST['last_name']);
            $job_title = Utils::sanitizeStringBlank($_POST['job_title']);
            $telephone = Utils::sanitizeStringBlank($_POST['telephone']);
            $email = Utils::sanitizeEmail($_POST['email']);

            $request_date = isset($_POST['request_date']) ? $_POST['request_date'] : FALSE;
            $behavior = isset($_POST['behavior']) && $_POST['behavior'] == 1 ? 1 : 0;
            $intelligence = isset($_POST['intelligence']) && $_POST['intelligence'] == 1 ? 1 : 0;
            $labor_competencies = isset($_POST['labor_competencies']) && $_POST['labor_competencies'] == 1 ? 1 : 0;
            $honesty_ethics_values = isset($_POST['honesty_ethics_values']) && $_POST['honesty_ethics_values'] == 1 ? 1 : 0;
            $personality = isset($_POST['personality']) && $_POST['personality'] == 1 ? 1 : 0;
            $sales_skills = isset($_POST['sales_skills']) && $_POST['sales_skills'] == 1 ? 1 : 0;
            $leadership = isset($_POST['leadership']) && $_POST['leadership'] == 1 ? 1 : 0;
            $id_candidate = (isset($_POST['id_candidate'])) ? trim($_POST['id_candidate']) : FALSE;
            $id_customer = (isset($_POST['customer'])) ? trim($_POST['customer']) : FALSE;
            $id_business_name = (isset($_POST['business_name'])) && !empty($_POST['business_name']) ? trim($_POST['business_name']) : NULL;
            $end_date = isset($_POST['end_date']) && !empty($_POST['end_date']) ? $_POST['end_date'] : NULL;
            $status = isset($_POST['status']) ? $_POST['status'] : FALSE;

            $id_recruiter = (isset($_POST['id_recruiter'])) ? trim($_POST['id_recruiter']) : FALSE;

            if ($id && $request_date && $id_customer && $id_recruiter) {
                $candidate = new Candidate();
                $candidate->setFirst_name($first_name);
                $candidate->setSurname($surname);
                $candidate->setLast_name($last_name);
                $candidate->setEmail($email);
                $candidate->setJob_title($job_title);
                $candidate->setTelephone($telephone);
                $candidate->setId($id_candidate);

                $candidate->update2();

                $psychometry = new Psychometry();
                $psychometry->setId($id);
                $psychometry->setRequest_date($request_date);
                $psychometry->setBehavior($behavior);
                $psychometry->setIntelligence($intelligence);
                $psychometry->setLabor_competencies($labor_competencies);
                $psychometry->setHonesty_ethics_values($honesty_ethics_values);
                $psychometry->setPersonality($personality);
                $psychometry->setSales_skills($sales_skills);
                $psychometry->setLeadership($leadership);
                $psychometry->setId_candidate($id_candidate);
                $psychometry->setId_customer($id_customer);
                $psychometry->setId_business_name($id_business_name);
                $psychometry->setEnd_date($end_date);
                $psychometry->setStatus($status);

                $psychometry->setId_Recruiter($id_recruiter);

                $update = $psychometry->update();

                if ($update) {
                    echo 1;
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

    public function update2()
    {
        if (Utils::isAdmin() || Utils::isManager() && Utils::isValid($_POST)) {
            $id = isset($_POST['id']) ? Encryption::decode($_POST['id']) : FALSE;
            $request_date = isset($_POST['request_date']) ? $_POST['request_date'] : FALSE;
            $behavior = isset($_POST['behavior']) && $_POST['behavior'] == 1 ? 1 : 0;
            $intelligence = isset($_POST['intelligence']) && $_POST['intelligence'] == 1 ? 1 : 0;
            $labor_competencies = isset($_POST['labor_competencies']) && $_POST['labor_competencies'] == 1 ? 1 : 0;
            $honesty_ethics_values = isset($_POST['honesty_ethics_values']) && $_POST['honesty_ethics_values'] == 1 ? 1 : 0;
            $personality = isset($_POST['personality']) && $_POST['personality'] == 1 ? 1 : 0;
            $sales_skills = isset($_POST['sales_skills']) && $_POST['sales_skills'] == 1 ? 1 : 0;
            $leadership = isset($_POST['leadership']) && $_POST['leadership'] == 1 ? 1 : 0;
            $id_psychometry_type = isset($_POST['id_psychometry_type']) ? $_POST['id_psychometry_type'] : FALSE;
            $id_candidate = (isset($_POST['id_candidate'])) ? trim($_POST['id_candidate']) : FALSE;
            $id_customer = (isset($_POST['customer'])) ? trim($_POST['customer']) : FALSE;
            $id_business_name = (isset($_POST['business_name'])) ? trim($_POST['business_name']) : NULL;
            $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : NULL;
            $status = isset($_POST['status']) ? $_POST['status'] : FALSE;

            $psycho_file = isset($_FILES['psycho_file']) && $_FILES['psycho_file']['name'] != '' ? $_FILES['psycho_file'] : FALSE;


            if ($id && $request_date && $id_psychometry_type && $id_candidate && $id_customer) {
                $psychometry = new Psychometry();
                $psychometry->setId($id);
                $psychometry->setRequest_date($request_date);
                $psychometry->setBehavior($behavior);
                $psychometry->setIntelligence($intelligence);
                $psychometry->setLabor_competencies($labor_competencies);
                $psychometry->setHonesty_ethics_values($honesty_ethics_values);
                $psychometry->setPersonality($personality);
                $psychometry->setSales_skills($sales_skills);
                $psychometry->setLeadership($leadership);
                $psychometry->setId_psychometry_type($id_psychometry_type);
                $psychometry->setId_candidate($id_candidate);
                $psychometry->setId_customer($id_customer);
                $psychometry->setId_business_name($id_business_name);
                $psychometry->setEnd_date($end_date);
                $psychometry->setStatus($status);

                $update = $psychometry->update();

                if ($psycho_file) {
                    if (file_exists('uploads/psychometrics/' . $id)) {
                        Utils::deleteDir('uploads/psychometrics/' . $id);
                    }

                    $allowed_formats = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf", "image/gif", "image/png", "image/jpeg", "image/jpg");
                    $limit_kb = 6000;

                    if (in_array($_FILES["psycho_file"]["type"], $allowed_formats) && $_FILES["psycho_file"]["size"] <= $limit_kb * 1024) {
                        $route = 'uploads/psychometrics/' . $id . '/';
                        $psycho_file = $route . $_FILES["psycho_file"]["name"];

                        if (!file_exists($route)) {
                            mkdir($route);
                        }

                        if (!file_exists($psycho_file)) {
                            $result = @move_uploaded_file($_FILES["psycho_file"]["tmp_name"], $psycho_file);
                        }

                        if ($update) {
                            echo 1;
                        } else {
                            echo 2;
                        }
                    } else {
                        echo 4;
                    }
                } else {
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
            header("location:" . base_url);
        }
    }






    //gabo 22 sept



    public function update_interpretation()
    {
        if (Utils::isValid($_POST)) {
            $id_psycho = isset($_POST['id_psycho']) ? Encryption::decode($_POST['id_psycho']) : FALSE;
            $interpretation = isset($_POST['interpretation']) ? Utils::sanitizeString($_POST['interpretation']) : FALSE;


            if ($interpretation && $id_psycho) {

                $psychometry = new Psychometry();
                $psychometry->setId($id_psycho);
                $psychometry->setInterpretation($interpretation);
                $update = $psychometry->update_interpretation();

                if ($update) {
                    echo  json_encode(array('status' => 1));
                } else {
                    echo  json_encode(array('status' => 2));
                }
            } else {
                echo  json_encode(array('status' => 0));
            }
        } else {
            header("location:" . base_url);
        }
    }



    public function upload_file()
    {
        if (Utils::isValid($_POST)) {
            $psycho_document = isset($_FILES['psycho_document']) && $_FILES['psycho_document']['name'] != '' ? $_FILES['psycho_document'] : FALSE;
            $id_psycho = isset($_POST['id_psychometry'])  ? Encryption::decode($_POST['id_psychometry']) : FALSE;
            // $rfc = isset($_FILES['rfc']) && $_FILES['rfc']['name'] != '' ? $_FILES['rfc'] : FALSE;
            // $cfdi = isset($_FILES['cfdi']) && $_FILES['cfdi']['name'] != '' ? $_FILES['cfdi'] : FALSE;
            // $id_employee = Encryption::decode($_POST['id_employee']);


            if ($id_psycho || $psycho_document) {

                // $employeeObj = new Employees();
                // $employeeObj->setId($id_employee);
                // $employee = $employeeObj->getOne();
                // $id_employee = $employee->id;

                $allowed_formats = array("application/pdf");


                if ($psycho_document) {

                    if (!in_array($_FILES["psycho_document"]["type"], $allowed_formats)) {
                        echo json_encode(array('status' => 9));
                        die();
                    } else {



                        if (file_exists('uploads/psychometrics/' . $id_psycho . '.pdf')) {
                            unlink('uploads/psychometrics/' . $id_psycho . '.pdf');
                        }

                        $route2 = 'uploads/psychometrics/';
                        $resume2 = $route2 . $id_psycho . '.pdf';


                        if (!file_exists($resume2)) {
                            $result = @move_uploaded_file($_FILES["psycho_document"]["tmp_name"], $resume2);
                            $routeDocu = base_url . $resume2;
                        }

                        echo json_encode(array(
                            'status' => 1,
                            'routeDocu' => $routeDocu,
                            'flag' => 1
                        ));
                    }
                }
            } else
                echo json_encode(array('status' => 7));
        } else
            echo json_encode(array('status' => 0));
    }
}
