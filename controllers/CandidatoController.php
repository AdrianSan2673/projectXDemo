<?php

require_once 'models/Candidate.php';
require_once 'models/CandidateEducation.php';
require_once 'models/CandidateAdditionalPreparation.php';
require_once 'models/CandidateExperience.php';
require_once 'models/CandidateLanguage.php';
require_once 'models/CandidateAptitude.php';
require_once 'models/User.php';
require_once 'models/Vacancy.php';
require_once 'models/VacancyApplicant.php';
require_once 'models/Psychometry.php';
require_once 'models/ApplicantProfile.php';   //gabo perfil
//=========================
require_once 'models/CandidateDirectory.php';
require_once 'models/Area.php';
require_once 'models/Subarea.php';
require_once 'models/CivilStatus.php';

class CandidatoController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer()) {

            $candidate = new Candidate();
            // $consulta = "";
            // $campos = "";
            // $inners = "";

            // $candidates = $candidate->getCandidatesByKey("", $campos, $inners);
            $total = $candidate->getTotal();
            // $c = new Candidate();

            $page_title = 'Candidatos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/candidate/index.php';
            // ===[gabo 28 abril modal vacantes]===
            require_once 'views/candidate/modal-vacantes.php';
            // ===[gabo 28 abril modal vacantes fin]===
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function crear()
    {

        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE && !Utils::isCustomer()) {

            if (Utils::isCandidate()) {
                $candidate = new Candidate();
                $candidate->setId_user($_SESSION['identity']->id);
                $candidate_exists = $candidate->getCandidateByUsername();

                if ($candidate_exists) {
                    header('location:' . base_url . 'candidato/ver');
                }
            }

            //gabo nuevo
            if (Utils::isAdmin() || Utils::isRecruitmentManager() || Utils::isSenior()) {
                $id = isset($_GET['vacante']) ? trim(Encryption::decode($_GET['vacante'])) : FALSE;
                $vacante = new Vacancy();
                $vacante->setId($id);
                $vacante = $vacante->getOne();


                if (isset($_GET['contact'])) {
                    $id_contacto = Encryption::decode($_GET['contact']);
                    $candidateDirectoryObj = new CandidateDirectory();
                    $candidateDirectoryObj->setId($id_contacto);
                    $candidateDirectory = $candidateDirectoryObj->getOne();
                    $candidato = $candidateDirectoryObj->getOne();

                    if ($candidateDirectory->id_vacancy != null || $candidateDirectory->id_vacancy != 0) {
                        $VacancyObj = new Vacancy();
                        $VacancyObj->setId($candidateDirectory->id_vacancy);
                        $vacante = $VacancyObj->getOne();
                    }
                    $candidato->id_area = $candidateDirectory->id_vacancy != null || $candidateDirectory->id_vacancy != 0 ? $vacante->id_area : 0;
                    $candidato->id_subarea = $candidateDirectory->id_vacancy != null || $candidateDirectory->id_vacancy != 0 ? $vacante->id_subarea : 0;

                    $candidato->id_gender = 0;
                    $candidato->id_civil_status = 0;
                    $candidato->id_education_level = 0;
                    $candidato->description = '';
                    $candidato->id = null;
                    $candidato->job_title = $candidato->experience;
                    $candidato->experience = $candidato->experience;
                    $candidato->cellphone = '';
                    $candidato->linkedinn = '';
                    $candidato->facebook = '';
                    $candidato->instagram = '';
                }
            }

            $page_title = 'Nuevo candidato | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/candidate/edit.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    /**OLD */
    public function create()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
            $surname = isset($_POST['surname']) ? trim($_POST['surname']) : FALSE;
            $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;
            $date_birth = isset($_POST['date_birth']) ? trim($_POST['date_birth']) : FALSE;
            $id_gender = isset($_POST['id_gender']) ? trim($_POST['id_gender']) : FALSE;
            $id_civil_status = isset($_POST['id_civil_status']) ? trim($_POST['id_civil_status']) : FALSE;
            $job_title = isset($_POST['job_title']) ? trim($_POST['job_title']) : FALSE;
            $description = isset($_POST['description']) ? trim($_POST['description']) : FALSE;
            $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : FALSE;
            $cellphone = isset($_POST['cellphone']) ? trim($_POST['cellphone']) : FALSE;
            $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
            $id_state = isset($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $linkedinn = isset($_POST['linkedinn']) ? trim($_POST['linkedinn']) : FALSE;
            $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : FALSE;
            $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : FALSE;
            //$id_user = isset($_POST['id_user']) ? trim($_POST['id_user']) : FALSE;

            $education_level = isset($_POST['education_level']) ? trim($_POST['education_level']) : FALSE;
            $institution = isset($_POST['institution']) ? trim($_POST['institution']) : FALSE;
            $title = isset($_POST['title']) ? trim($_POST['title']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $still_studies = ($_POST['still_studies'] == "true") ? 1 : 0;

            $course = isset($_POST['course']) ? trim($_POST['course']) : FALSE;
            $institution_additional_education = isset($_POST['institution_additional_education']) ? trim($_POST['institution_additional_education']) : FALSE;
            $start_date_additional = isset($_POST['start_date_additional']) ? trim($_POST['start_date_additional']) : FALSE;
            $end_date_additional = isset($_POST['end_date_additional']) ? trim($_POST['end_date_additional']) : FALSE;

            $experiences = isset($_POST['experiences']) ? json_decode($_POST['experiences']) : FALSE;
            $languages = isset($_POST['languages']) ? json_decode($_POST['languages']) : FALSE;
            $aptitudes = isset($_POST['aptitudes']) ? json_decode($_POST['aptitudes']) : FALSE;

            $avatar = isset($_POST['avatar']) ? trim($_POST['avatar']) : FALSE;

            //if ($first_name && $surname && $last_name && $date_birth && $id_gender && $id_civil_status && $job_title && $description && $telephone && $cellphone && $email && $id_state && $id_city && $linkedinn && $facebook && $instagram && $education_level && $institution && $title && $start_date && $course && $institution_additional_education && $start_date_additional && $end_date_additional) {

            if (true) {
                $candidate = new Candidate();
                $candidate->setFirst_name($first_name);
                $candidate->setSurname($surname);
                $candidate->setLast_name($last_name);
                $candidate->setDate_birth($date_birth);
                $candidate->setId_gender($id_gender);
                $candidate->setId_civil_status($id_civil_status);
                $candidate->setJob_title($job_title);
                $candidate->setDescription($description);
                $candidate->setTelephone($telephone);
                $candidate->setCellphone($cellphone);
                $candidate->setEmail($email);
                $candidate->setId_state($id_state);
                $candidate->setId_city($id_city);
                $candidate->setLinkedinn($linkedinn);
                $candidate->setFacebook($facebook);
                $candidate->setInstagram($instagram);
                $candidate->setId_user(NULL);
                if (Utils::isCandidate()) {
                    $candidate->setEmail($_SESSION['identity']->email);
                    $candidate->setId_user($_SESSION['identity']->id);
                    $usuario = new User();
                    $usuario->setId($_SESSION['identity']->id);
                    $usuario->setFirst_name($first_name);
                    $usuario->setLast_name($surname . ' ' . $last_name);
                    $usuario->update();

                    $_SESSION['identity']->first_name = $first_name;
                    $_SESSION['identity']->last_name = $surname . ' ' . $last_name;
                }
                //$candidate->setId_user(NULL);
                $save = $candidate->save();
                $id = $candidate->getId();

                if ($avatar) {
                    $img = $_POST['avatar'];
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $route = 'uploads/candidate/' . $id . '/';

                    if (file_exists($route)) {
                        Utils::deleteDir('uploads/candidate/' . $id);
                    }

                    if (!file_exists($route)) {
                        mkdir($route);
                    }

                    $file = $route . uniqid() . '.png';
                    $success = file_put_contents($file, $data);

                    if (Utils::isCandidate()) {


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

                        if ($success) {
                            Utils::showProfilePicture();
                        }
                    }
                }

                if ($save) {
                    $id = $candidate->getId();
                    $studies = new CandidateEducation();
                    $studies->setId_candidate($id);
                    $studies->setTitle($title);
                    $studies->setInstitution($institution);
                    $studies->setStart_date($start_date);
                    $studies->setEnd_date($end_date);
                    $studies->setStill_studies($still_studies);
                    $studies->setId_level($education_level);
                    //$studies->setId_document();

                    $save_edu = $studies->save();

                    $additional_edu = new CandidateAdditionalPreparation();
                    $additional_edu->setId_candidate($id);
                    $additional_edu->setCourse($course);
                    $additional_edu->setInstitution($institution_additional_education);
                    $additional_edu->setStart_date($start_date_additional);
                    $additional_edu->setEnd_date($end_date_additional);
                    $save_ap = $additional_edu->save();

                    foreach ($experiences as $experience) {
                        $exp = NULL;
                        $still_works = ($experience->still_works == "true") ? 1 : 0;
                        $end_date_experience = ($experience->end_date != "") ? $experience->end_date : NULL;
                        $exp = new CandidateExperience();
                        $exp->setId_candidate($id);
                        $exp->setPosition($experience->position);
                        $exp->setEnterprise($experience->enterprise);
                        $exp->setId_area($experience->area);
                        $exp->setId_subarea($experience->subarea);
                        $exp->setId_state($experience->state);
                        $exp->setId_city($experience->city);
                        $exp->setStart_date($experience->start_date);
                        $exp->setEnd_date($end_date_experience);
                        $exp->setStill_works($still_works);
                        $exp->setReview($experience->review);
                        $exp->setActivity1($experience->activity1);
                        $exp->setActivity2($experience->activity2);
                        $exp->setActivity3($experience->activity3);
                        $exp->setActivity4($experience->activity4);
                        $exp->save();
                    }

                    foreach ($languages as $language) {
                        $lan = NULL;
                        $lan = new CandidateLanguage();
                        $lan->setId_candidate($id);
                        $lan->setId_language($language->language);
                        $lan->setLevel($language->language_level);
                        $lan->setInstitution($language->institution);
                        $lan->setStart_date($language->start_date);
                        $lan->setEnd_date($language->end_date);
                        $lan->save();
                    }

                    foreach ($aptitudes as $aptitude) {
                        $apt = NULL;
                        $apt = new CandidateAptitude();
                        $apt->setId_candidate($id);
                        $apt->setAptitude($aptitude->aptitude);
                        $apt->setLevel($aptitude->level);
                        $apt->save();
                    }

                    if ($save_edu && $save_ap) {
                        echo 1;
                    } else {
                        echo 5;
                    }
                } else {
                    echo 6;
                }
            }
        } else {
            header("location:" . base_url);
        }
    }

    public function new()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isRecruitmentManager() || Utils::isCandidate()) {
            $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
            $surname = isset($_POST['surname']) ? trim($_POST['surname']) : FALSE;
            $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;
            $date_birth = isset($_POST['date_birth']) && !empty($_POST['date_birth']) ? trim($_POST['date_birth']) : NULL;
            $age = isset($_POST['age']) && !empty($_POST['age']) ? trim($_POST['age']) : NULL;
            $id_gender = isset($_POST['id_gender']) ? trim($_POST['id_gender']) : NULL;
            $id_civil_status = isset($_POST['id_civil_status']) && !empty($_POST['id_civil_status']) ? trim($_POST['id_civil_status']) : NULL;
            $id_level = isset($_POST['id_level']) ? trim($_POST['id_level']) : FALSE;
            $job_title = isset($_POST['job_title']) ? trim($_POST['job_title']) : FALSE;
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : NULL;
            $cellphone = isset($_POST['cellphone']) ? trim($_POST['cellphone']) : NULL;
            $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
            $id_state = isset($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $id_area = isset($_POST['id_area']) ? trim($_POST['id_area']) : FALSE;
            $id_subarea = isset($_POST['id_subarea']) ? trim($_POST['id_subarea']) : FALSE;
            $linkedinn = isset($_POST['linkedinn']) ? trim($_POST['linkedinn']) : NULL;
            $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : NULL;
            $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : NULL;
            $avatar = isset($_POST['avatar']) ? trim($_POST['avatar']) : FALSE;
            $resume = isset($_FILES['resume']) && $_FILES['resume']['name'] != '' ? $_FILES['resume'] : FALSE;
            $email = Utils::isCandidate() ? $_SESSION['identity']->email : $email;
            $id_vacancy = isset($_POST['id_vacancy']) && !empty($_POST['id_vacancy']) ? Encryption::decode($_POST['id_vacancy']) : FALSE;
            $id_contacto = isset($_POST['contact']) ? Encryption::decode($_POST['contact']) : NULL; //id del contacto del directorio


            //===[gabo 1 agosto  operativa]==      
            $isCandidate = false;
            $vacancy = new Vacancy();
            $vacancy->setId($id_vacancy);
            $vacante = $vacancy->getOne();

            if (($vacante && $vacante->type == 1 && $first_name && $surname && $last_name && $id_level && $job_title  && $id_state && $id_city && $id_area && $id_subarea) || ($first_name && $surname && $last_name && $id_level && $job_title && $email && $id_state && $id_city && $id_area && $id_subarea)) {
                //===[gabo 1 agosto  operativa fin]==   
                if ($resume) {
                    $allowed_formats = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf");
                    $limit_kb = 6000;
                    if (!in_array($_FILES["resume"]["type"], $allowed_formats) || $_FILES["resume"]["size"] > $limit_kb * 1024) {
                        echo 4;
                        die();
                    }
                }

                $candidate = new Candidate();
                $candidate->setFirst_name($first_name);
                $candidate->setSurname($surname);
                $candidate->setLast_name($last_name);
                $candidate->setDate_birth($date_birth);
                $candidate->setAge($age);
                $candidate->setId_gender($id_gender);
                $candidate->setId_civil_status($id_civil_status);
                $candidate->setJob_title($job_title);
                $candidate->setDescription($description);
                $candidate->setTelephone($telephone);
                $candidate->setCellphone($cellphone);
                $candidate->setEmail($email);
                $candidate->setId_state($id_state);
                $candidate->setId_city($id_city);
                $candidate->setId_area($id_area);
                $candidate->setId_subarea($id_subarea);
                $candidate->setLinkedinn($linkedinn);
                $candidate->setFacebook($facebook);
                $candidate->setInstagram($instagram);
                $candidate->setId_user(NULL);
                $candidate->setCreated_by($_SESSION['identity']->id);

                if (Utils::isCandidate()) {
                    //===[gabo 2 julio operativa]===
                    $isCandidate = true;
                    //===[gabo 2 julio operativa fin]===

                    $candidate->setEmail($_SESSION['identity']->email);
                    $candidate->setId_user($_SESSION['identity']->id);
                    $usuario = new User();
                    $usuario->setId($_SESSION['identity']->id);
                    $usuario->setFirst_name($first_name);
                    $usuario->setLast_name($surname . ' ' . $last_name);
                    $usuario->update();

                    $_SESSION['identity']->first_name = $first_name;
                    $_SESSION['identity']->last_name = $surname . ' ' . $last_name;
                }

                $save = $candidate->save();

                if ($save) {
                    if (isset($id_contacto) && $id_contacto != null) {
                        $candidateDirectoryObj = new CandidateDirectory();
                        $candidateDirectoryObj->setId($id_contacto);
                        $candidateDirectoryObj->setStatus(6);
                        $candidateDirectoryObj->setId_candidate($candidate->getId());
                        $candidateDirectoryObj->updateSatusCandidate();
                    }

                    $id = $candidate->getId();
                    $studies = new CandidateEducation();
                    $studies->setId_candidate($id);
                    $studies->setTitle(NULL);
                    $studies->setInstitution(NULL);
                    $studies->setStart_date(NULL);
                    $studies->setEnd_date(NULL);
                    $studies->setStill_studies(NULL);
                    $studies->setId_level($id_level);

                    $save = $studies->save();

                    if ($id_vacancy && is_numeric($id_vacancy)) {
                        $vacancy = new Vacancy();
                        $vacancy->setId($id_vacancy);
                        $vacante = $vacancy->getOne();
                        if ($vacante) {
                            $applicant = new VacancyApplicant();
                            $applicant->setId_vacancy($id_vacancy);
                            $applicant->setId_candidate($id);
                            $aplicante = $applicant->create();
                            $applicant->setId_status(3);
                            $applicant->setCustomer_date(true);
                            $applicant->updateStatus();

                            //gabi nuevo
                            if ($aplicante && !Utils::isCandidate()) {

                                //===[gabo 15 junio experiencia candidato ]=== */

                                $enterpise_experience = isset($_POST['enterprise_experience']) ?  $_POST['enterprise_experience'] : null;
                                $review_experience = isset($_POST['review_experience']) ?  $_POST['review_experience'] : null;
                                if ($id) {
                                    $experience = new CandidateExperience;
                                    $experience->setId_candidate($id);
                                    if (isset($_POST['enterprise_experience'])) {
                                        $experience->setId_area(1);
                                        $experience->setId_subarea(1);
                                        $experience->setId_state(1);
                                        $experience->setId_city(1);
                                        $experience->setType('operativa');
                                        $experience->setStart_date(date('Y-m-d', time()));

                                        $tamanio = count($enterpise_experience);
                                        for ($i = 0; $i < $tamanio; $i++) {
                                            $enterpise_experience[$i] =  trim($enterpise_experience[$i]);
                                            $review_experience[$i] =  trim($review_experience[$i]);
                                            if ($enterpise_experience[$i] != '' and  $review_experience[$i] != '') {
                                                $experience->setEnterprise($enterpise_experience[$i]);
                                                $experience->setPosition($enterpise_experience[$i]);
                                                $experience->setReview($review_experience[$i]);
                                                $result = $experience->save();
                                            }
                                        }
                                    }
                                }
                                //===[gabo 15 junio experiencia candidato fin ]===
                            }
                        }
                    }
                }
                $id = $candidate->getId();
                //===[gabo 2 julio operativa]===
                $id_candidate = Encryption::encode($id);
                $id_vacancy = Encryption::encode($id_vacancy);
                if (!$vacante) { //cuando no tenga vacante
                    $vacante = new  stdClass();
                    $vacante->type = 0;
                }
                //===[gabo 2 julio operativa fin]===

                if ($avatar) {
                    $img = $_POST['avatar'];
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $route = 'uploads/candidate/' . $id . '/';

                    if (file_exists($route)) {
                        Utils::deleteDir('uploads/candidate/' . $id);
                    }

                    if (!file_exists($route)) {
                        mkdir($route);
                    }

                    $file = $route . uniqid() . '.png';
                    $success = file_put_contents($file, $data);
                    /* if (!$success) {
                         echo 3;
                         die();
                     } */
                    if (Utils::isCandidate()) {
                        $id_user = $_SESSION['identity']->id;
                        $route = 'uploads/avatar/' . $id_user . '/';

                        if (file_exists($route)) {
                            Utils::deleteDir('uploads/avatar/' . $id_user);
                        }

                        if (!file_exists($route)) {
                            mkdir($route);
                        }

                        $file = $route . uniqid() . '.png';
                        $success = file_put_contents($file, $data);

                        if ($success) {
                            Utils::showProfilePicture();
                        }
                    }
                }

                if ($resume) {
                    if (file_exists('uploads/resume/' . $id)) {
                        Utils::deleteDir('uploads/resume/' . $id);
                    }

                    /* $allowed_formats = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf"); 
                    $limit_kb = 6000;
                    
                    if(in_array($_FILES["resume"]["type"], $allowed_formats) && $_FILES["resume"]["size"] <= $limit_kb * 1024){*/
                    $route = 'uploads/resume/' . $id . '/';
                    $resume = $route . $_FILES["resume"]["name"];

                    if (!file_exists($route)) {
                        mkdir($route);
                    }

                    if (!file_exists($resume)) {
                        $result = @move_uploaded_file($_FILES["resume"]["tmp_name"], $resume);
                    }

                    if ($save) {
                        //===[gabo 2 julio operativa]===
                        echo json_encode(array('status' => 1, 'id_vacancy' => $id_vacancy, 'id_candidate' => $id_candidate, 'type' => $vacante->type, 'isCandidate' => $isCandidate));
                        //===[gabo 2 julio operativa]===
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                    /* 
                    }else{
                        echo 4;
                    } */
                } else {
                    if ($save) {
                        //===[gabo 2 julio operativa]===
                        echo json_encode(array(
                            'status' => 1,
                            'id_vacancy' => $id_vacancy,
                            'id_candidate' => $id_candidate,
                            'type' => $vacante->type,
                            'isCandidate' => $isCandidate
                        ));
                        //===[gabo 2 julio operativa]===
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function update()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
            $surname = isset($_POST['surname']) ? trim($_POST['surname']) : FALSE;
            $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;
            $date_birth = isset($_POST['date_birth']) && !empty($_POST['date_birth']) ? trim($_POST['date_birth']) : NULL;
            $age = isset($_POST['age']) && !empty($_POST['age']) ? trim($_POST['age']) : NULL;
            $id_gender = isset($_POST['id_gender']) ? trim($_POST['id_gender']) : NULL;
            $id_civil_status = isset($_POST['id_civil_status']) && !empty($_POST['id_civil_status']) ? trim($_POST['id_civil_status']) : NULL;
            $id_level = isset($_POST['id_level']) ? trim($_POST['id_level']) : FALSE;
            $job_title = isset($_POST['job_title']) ? trim($_POST['job_title']) : FALSE;
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : NULL;
            $cellphone = isset($_POST['cellphone']) ? trim($_POST['cellphone']) : NULL;
            $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
            $id_state = isset($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $id_area = isset($_POST['id_area']) ? trim($_POST['id_area']) : FALSE;
            $id_subarea = isset($_POST['id_subarea']) ? trim($_POST['id_subarea']) : FALSE;
            $linkedinn = isset($_POST['linkedinn']) ? trim($_POST['linkedinn']) : NULL;
            $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : NULL;
            $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : NULL;

            $avatar = isset($_POST['avatar']) ? trim($_POST['avatar']) : FALSE;
            $resume = isset($_FILES['resume']) && $_FILES['resume']['name'] != '' ? $_FILES['resume'] : FALSE;
            $email = Utils::isCandidate() ? $_SESSION['identity']->email : $email;

            if ($first_name && $surname && $last_name && $id_level && $job_title && $email && $id_state && $id_city && $id_area && $id_subarea) {
                $candidate = new Candidate();
                $candidate->setId($id);
                $candidate->setFirst_name($first_name);
                $candidate->setSurname($surname);
                $candidate->setLast_name($last_name);
                $candidate->setDate_birth($date_birth);
                $candidate->setAge($age);
                $candidate->setId_gender($id_gender);
                $candidate->setId_civil_status($id_civil_status);
                $candidate->setJob_title($job_title);
                $candidate->setDescription($description);
                $candidate->setTelephone($telephone);
                $candidate->setCellphone($cellphone);
                $candidate->setEmail($email);
                $candidate->setId_state($id_state);
                $candidate->setId_city($id_city);
                $candidate->setId_area($id_area);
                $candidate->setId_subarea($id_subarea);
                $candidate->setLinkedinn($linkedinn);
                $candidate->setFacebook($facebook);
                $candidate->setInstagram($instagram);

                if (Utils::isCandidate()) {
                    $candidate->setEmail($_SESSION['identity']->email);
                    $candidate->setId_user($_SESSION['identity']->id);
                    $usuario = new User();
                    $usuario->setId($_SESSION['identity']->id);
                    $usuario->setFirst_name($first_name);
                    $usuario->setLast_name($surname . ' ' . $last_name);
                    $usuario->update();
                }
                //$candidate->setId_user(NULL);
                $update = $candidate->update();

                if ($update) {
                    $id = $candidate->getId();
                    $studies = new CandidateEducation();
                    $studies->setId_candidate($id);
                    $studies->setId_level($id_level);

                    $update = $studies->updateLevel();
                }

                if ($avatar) {
                    $img = $_POST['avatar'];
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $route = 'uploads/candidate/' . $id . '/';

                    if (file_exists($route)) {
                        Utils::deleteDir('uploads/candidate/' . $id);
                    }

                    if (!file_exists($route)) {
                        mkdir($route);
                    }

                    $file = $route . uniqid() . '.png';
                    $success = file_put_contents($file, $data);
                    if (!$success) {
                        echo 3;
                    }

                    if (Utils::isCandidate()) {


                        $id_user = $_SESSION['identity']->id;
                        $route = 'uploads/avatar/' . $id_user . '/';

                        if (file_exists($route)) {
                            Utils::deleteDir('uploads/avatar/' . $id);
                        }

                        if (!file_exists($route)) {
                            mkdir($route);
                        }

                        $file = $route . uniqid() . '.png';
                        $success = file_put_contents($file, $data);

                        if ($success) {
                            Utils::showProfilePicture();
                        }
                    }
                }

                if ($resume) {
                    if (file_exists('uploads/resume/' . $id)) {
                        Utils::deleteDir('uploads/resume/' . $id);
                    }

                    $allowed_formats = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf");
                    $limit_kb = 6000;

                    if (in_array($_FILES["resume"]["type"], $allowed_formats) && $_FILES["resume"]["size"] <= $limit_kb * 1024) {
                        $route = 'uploads/resume/' . $id . '/';
                        $resume = $route . $_FILES["resume"]["name"];

                        if (!file_exists($route)) {
                            mkdir($route);
                        }

                        if (!file_exists($resume)) {
                            $result = @move_uploaded_file($_FILES["resume"]["tmp_name"], $resume);
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

    public function ver()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            if (isset($_GET['id']) || Utils::isCandidate()) {
                if (Utils::isCandidate()) {
                    if (isset($_GET['id'])) {
                        header("location:" . base_url . "candidato/ver");
                    }
                    $id_username = $_SESSION['identity']->id;
                    $candidate = new Candidate();
                    $candidate->setId_user($id_username);
                    $candidato = $candidate->getCandidateByUsername();
                    $id = $candidato->id;

                    //$img_base64 = $_SESSION['avatar'];
                    $route = $_SESSION['avatar_route'];

                    if (!$candidato) {
                        header("location:" . base_url . "candidato/crear_curriculum");
                    }
                } else {
                    $id = Encryption::decode($_GET['id']);
                    $candidate = new Candidate();
                    $candidate->setId($id);
                    $candidato = $candidate->getOne();

                    $path = 'uploads/candidate/' . $candidato->id;
                    if (file_exists($path) && !empty($candidato->id)) {
                        $directory = opendir($path);

                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $img_content = file_get_contents($path . "/" . $file);
                                $route = $path . '/' . $file;
                            }
                        }
                    } else {
                        if ($candidato->id_gender != 2) {
                            $route = "dist/img/user-icon.png";
                        } else {
                            $route = "dist/img/user-icon-rose.png";
                        }

                        $type = pathinfo($route, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($route);
                    }
                    //$img_base64 = chunk_split(base64_encode($img_content));
                    /*$img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);*/
                    $route = base_url . $route;

                    $va = new VacancyApplicant();
                    $va->setId_candidate($id);
                    $vacancies = $va->getApplicantsByCandidate();
                    if (isset($_GET['vacante'])) {
                        $id_vacancy = Encryption::decode($_GET['vacante']);
                        $va->setId_vacancy($id_vacancy);
                        $postulacion = $va->getOne();
                        if ($postulacion) {
                            if ($postulacion->id_status == 1) {
                                $va->setId_status(5);
                                $va->updateStatus();
                            }
                        }
                        $vacancy = new Vacancy();
                        $vacancy->setId($id_vacancy);
                        $vacante = $vacancy->getOne();
                    }

                    $psycho = new Psychometry();
                    $psycho->setId_candidate($id);
                    $psychometrics = $psycho->getPsychometricsByCandidate();
                }

                $cv_path = 'uploads/resume/' . $id;
                if (file_exists($cv_path) && !empty($id)) {
                    $cv_directory = opendir($cv_path);

                    while ($cv_file = readdir($cv_directory)) {
                        if (!is_dir($cv_file)) {
                            $type = pathinfo($cv_path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($cv_path . "/" . $cv_file);
                            $cv_route = base_url . $cv_path . '/' . $cv_file;
                        }
                    }
                } else {
                    $cv_route = FALSE;
                }

                $experience = new CandidateExperience();
                $experience->setId_candidate($id);
                $experiences = $experience->getExperiencesByCandidate();

                $preparation = new CandidateAdditionalPreparation();
                $preparation->setId_candidate($id);
                $preparations = $preparation->getAdditionalPreparationsByCandidate();

                $aptitude = new CandidateAptitude();
                $aptitude->setId_candidate($id);
                $aptitudes = $aptitude->getAptitudesByCandidate();

                $language = new CandidateLanguage();
                $language->setId_candidate($id);
                $languages = $language->getLanguagesByCandidate();


                $page_title = $candidato->first_name . ' ' . $candidato->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';

                require_once 'views/candidate/read.php';
                // <!--===[gabo 19 abril  ver candidate]===-->
                require_once 'views/candidate/modal-aptitude-candidato.php';
                require_once 'views/candidate/modal-idiomas-candidato.php';
                require_once 'views/candidate/modal-formacion-candidato.php';
                require_once 'views/candidate/modal-educacion-candidato.php';
                require_once 'views/candidate/modal-experiencia-candidato.php';
                require_once 'views/candidate/modal-candidato.php'; // <!--===[gabo 27 abril  ver candidato2]===--> 

                //  ===[FIN]===
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'vacante/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function crear_curriculum()
    {
        if (Utils::isCandidate()) {

            $candidate = new Candidate();
            $candidate->setId_user($_SESSION['identity']->id);
            $candidate_exists = $candidate->getCandidateByUsername();

            if ($candidate_exists) {
                header('location:' . base_url . 'candidato/ver');
            }
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/candidate/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function curriculum()
    {
        if (Utils::isCandidate()) {
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/candidate/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function editar()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            if (isset($_GET['id']) || Utils::isCandidate()) {

                if (Utils::isCandidate()) {
                    $id_username = $_SESSION['identity']->id;
                    $candidate = new Candidate();
                    $candidate->setId_user($id_username);
                    $candidato = $candidate->getCandidateByUsername();
                    $id = $candidato->id;

                    $img_base64 = $_SESSION['avatar'];
                    $route = $_SESSION['avatar_route'];
                } else {
                    $id = Encryption::decode($_GET['id']);
                    $candidate = new Candidate();
                    $candidate->setId($id);
                    $candidato = $candidate->getOne();

                    $path = 'uploads/candidate/' . $candidato->id;
                    if (file_exists($path) && !empty($candidato->id)) {
                        $directory = opendir($path);

                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $img_content = file_get_contents($path . "/" . $file);
                                $route = $path . '/' . $file;
                            }
                        }
                    } else {
                        if ($candidato->id_gender != 2) {
                            $route = "dist/img/user-icon.png";
                        } else {
                            $route = "dist/img/user-icon-rose.png";
                        }
                        $type = pathinfo($route, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($route);
                    }
                    //$img_base64 = chunk_split(base64_encode($img_content));
                    $img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
                    $route = base_url . $route;
                }
                $experience = new CandidateExperience();
                $experience->setId_candidate($id);
                $experiences = $experience->getExperiencesByCandidate();

                $aptitude = new CandidateAptitude();
                $aptitude->setId_candidate($id);
                $aptitudes = $aptitude->getAptitudesByCandidate();

                $language = new CandidateLanguage();
                $language->setId_candidate($id);
                $languages = $language->getLanguagesByCandidate();

                $page_title = $candidato->first_name . ' ' . $candidato->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/edit.php';
                require_once 'views/layout/footer.php';
            } else {
                header("location:" . base_url . "candidato/index");
            }
        } else {
            header('location:' . base_url);
        }
    }

    //======================[Gabo Marzo 28 Perfil Postulado]===============
    public function consulta_perfil()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            $id_candidato = isset($_POST['id_candidato']) ? trim(Encryption::decode($_POST['id_candidato'])) : FALSE;
            $id_vacancy = isset($_POST['id_vacancy']) ? trim(Encryption::decode($_POST['id_vacancy'])) : FALSE;

            //    ===[gabo 21 mayo operativa]===
            $experience = new CandidateExperience();
            $experience->setId_candidate($id_candidato);
            $experiencia = $experience->getExperiencesByCandidate();


            if ($id_candidato && $id_vacancy) {
                $vacancy = new VacancyApplicant();
                $vacancy->setId_candidate($id_candidato);
                $vacancy->setId_vacancy($id_vacancy);
                $result = $vacancy->getOne();

                $candidato = new Candidate();
                $candidato->setId($id_candidato);
                $name_candidate = $candidato->getOne()->first_name . ' ' . $candidato->getOne()->surname . ' ' . $candidato->getOne()->last_name;
                //    ===[gabo 21 mayo operativa fin]=== 


                if ($result) {
                    if ($result->id_profile !== NULL) {
                        $candidato = new ApplicantProfile();
                        $candidato->setId($result->id_profile);
                        $result = $candidato->getOne();

                        if ($result)
                            echo json_encode(array('candidato' => $result, 'status' => 2, 'name_candidate' => $name_candidate, 'experience' => $experiencia));
                        else
                            echo json_encode(array('status' => 0));
                    } else {
                        $candidato = new Candidate();
                        $candidato->setId($id_candidato);
                        $result = $candidato->getOneFull();
                        $language = $candidato->getLanguageFromCandidate();

                        echo json_encode(array('candidato' => $result, 'language' => $language, 'status' => 1, 'name_candidate' => strtoupper($name_candidate), 'experience' => $experiencia));
                    }
                } else
                    echo json_encode(array('status' => 3));  //no se pudo consultar
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    //===[gabo 2 junio modal-experiencia]=== 

    public function consulta_experiencia()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            $id_candidato = isset($_POST['id_candidato']) ? trim(Encryption::decode($_POST['id_candidato'])) : FALSE;
            if ($id_candidato) {
                $experience = new CandidateExperience();
                $experience->setId_candidate($id_candidato);
                $experiencia = $experience->getExperiencesByCandidate();
                echo json_encode(array('status' => 1, 'experience' => $experiencia));
            }
        } else
            echo json_encode(array('status' => 0));
    }

    public function save_experiencia()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            $id_candidate = isset($_POST['id_candidate_exp']) ? trim(Encryption::decode($_POST['id_candidate_exp'])) : null;

            $enterpise_experience = isset($_POST['enterprise_experience']) ?  $_POST['enterprise_experience'] : null;
            $review_experience = isset($_POST['review_experience']) ?  $_POST['review_experience'] : null;

            if ($id_candidate) {

                $experience = new CandidateExperience;
                $experience->setId_candidate($id_candidate);
                $result = $experience->delete_experiences();

                if (isset($_POST['enterprise_experience'])) {
                    $experience->setId_area(1);
                    $experience->setId_subarea(1);
                    $experience->setId_state(1);
                    $experience->setId_city(1);
                    $experience->setType('operativa');
                    $experience->setStart_date(date('Y-m-d', time()));

                    $tamanio = count($enterpise_experience);
                    for ($i = 0; $i < $tamanio; $i++) {

                        $enterpise_experience[$i] =  trim($enterpise_experience[$i]);
                        $review_experience[$i] =  trim($review_experience[$i]);

                        if ($enterpise_experience[$i] != '' and  $review_experience[$i] != '') {
                            $experience->setEnterprise($enterpise_experience[$i]);
                            $experience->setPosition($enterpise_experience[$i]);
                            $experience->setReview($review_experience[$i]);

                            $result = $experience->save();
                        }
                    }
                }
                if ($result) {
                    echo json_encode(array('status' => 1));
                }
            } else {
                echo json_encode(array('status' => 2));
            }
        } else
            echo json_encode(array('status' => 0));
    }

    //===[gabo 2 junio modal-experiencia fin]=== 


    public function save_perfil()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            $id_vacancy = isset($_POST['vacancy_id']) ? trim(Encryption::decode($_POST['vacancy_id'])) : null;
            $id_candidate = isset($_POST['id_candidate']) ? trim(Encryption::decode($_POST['id_candidate'])) : null;
            $gender = isset($_POST['gender_c']) ?  Utils::sanitizeString($_POST['gender_c']) : null;
            $status_gender = isset($_POST['status_gender']) ?  Utils::sanitizeString($_POST['status_gender']) : null;
            $age = isset($_POST['age_c']) ?  Utils::sanitizeString($_POST['age_c']) : null;
            $status_age = isset($_POST['status_age']) ?  Utils::sanitizeString($_POST['status_age']) : null;
            $civil_status =  isset($_POST['civil_status_c']) ?  Utils::sanitizeString($_POST['civil_status_c']) : null;
            $status_civil_status =  isset($_POST['status_civil_status']) ?  Utils::sanitizeString($_POST['status_civil_status']) : null;
            $level =  isset($_POST['level_c']) ?  Utils::sanitizeString($_POST['level_c']) : null;
            $status_level =  isset($_POST['status_level']) ?  Utils::sanitizeString($_POST['status_level']) : null;
            $language =  isset($_POST['language_c']) ?  Utils::sanitizeString($_POST['language_c']) : null;
            $status_language =  isset($_POST['status_language']) ?  Utils::sanitizeString($_POST['status_language']) : null;
            $language_level =  isset($_POST['language_level_c']) ? Utils::sanitizeString($_POST['language_level_c']) : null;
            $status_language_level = isset($_POST['status_language_level']) ? Utils::sanitizeString($_POST['status_language_level']) : null;
            // $requirements = isset($_POST['requirements_c']) ? Utils::sanitizeString($_POST['requirements_c']) : null;
            $functions = isset($_POST['functions_c']) ? Utils::sanitizeString($_POST['functions_c']) : null;
            $experience_years_c = isset($_POST['experience_years_c']) || $_POST['experience_years_c'] != null  ?  Utils::sanitizeString($_POST['experience_years_c']) : '0';
            $status_experience_years = isset($_POST['status_experience_years']) ?  Utils::sanitizeString($_POST['status_experience_years']) : null;
            $experiencia_comments = isset($_POST['experiencia_comments']) ?  Utils::sanitizeString($_POST['experiencia_comments']) : null;
            $general_comments = isset($_POST['general_comments']) ?  Utils::sanitizeString($_POST['general_comments']) : null;
            $functions_comments = isset($_POST['functions_comments']) ?  Utils::sanitizeString($_POST['functions_comments']) : null;
            $status_functions = isset($_POST['status_functions']) ?  Utils::sanitizeString($_POST['status_functions']) : null;
            $enterpise_experience = isset($_POST['enterprise_experience']) ?  $_POST['enterprise_experience'] : null;
            // ===[ 31 mayo gabo review]=== 
            $review_experience = isset($_POST['review_experience']) ?  $_POST['review_experience'] : null;
            // ===[ 31 mayo gabo review fin]=== 

            //===[gabo 27 junio perfil]==
            $tiempo =  isset($_POST['tiempo']) ? Utils::sanitizeString($_POST['tiempo']) : null;
            //===[gabo 27 junio perfil]==

            if ($id_vacancy  && $id_candidate   && $gender  && $age     &&  $general_comments  &&   $functions  &&   $experiencia_comments  &&   $general_comments &&   $functions_comments) {
                $candidato = new VacancyApplicant();
                $candidato->setId_candidate($id_candidate);
                $candidato->setId_vacancy($id_vacancy);
                $result = $candidato->getOne();

                $perfil = new ApplicantProfile();
                // ===[ 31 mayo gabo review]=== 
                $experience = new CandidateExperience;
                $experience->setId_candidate($id_candidate);
                $experience->delete_experiences();

                if (isset($_POST['enterprise_experience'])) {
                    $experience->setId_area(1);
                    $experience->setId_subarea(1);
                    $experience->setId_state(1);
                    $experience->setId_city(1);
                    $experience->setType('operativa');
                    $experience->setStart_date(date('Y-m-d', time()));

                    $tamanio = count($enterpise_experience);
                    for ($i = 0; $i < $tamanio; $i++) {

                        $enterpise_experience[$i] =  trim($enterpise_experience[$i]);
                        $review_experience[$i] =  trim($review_experience[$i]);

                        if ($enterpise_experience[$i] != '' and  $review_experience[$i] != '') {
                            $experience->setEnterprise($enterpise_experience[$i]);
                            $experience->setPosition($enterpise_experience[$i]);
                            $experience->setReview($review_experience[$i]);

                            $experience->save();
                        }
                    }
                }


                // ===[ 31 mayo gabo review fin]=== 
                if ($result->id_profile !== NULL) {
                    $perfil->setId($result->id_profile);
                    $perfil->setGender($gender);
                    $perfil->setStatus_gender($status_gender);
                    $perfil->setAge($age);
                    $perfil->setStatus_age($status_age);
                    $perfil->setCivil_status($civil_status);
                    $perfil->setStatus_civil_status($status_civil_status);
                    $perfil->setLevel($level);
                    $perfil->setStatus_level($status_level);
                    $perfil->setLanguage($language);
                    $perfil->setStatus_language($status_language);
                    $perfil->setLanguage_level($language_level);
                    $perfil->setStatus_language_level($status_language_level);
                    // $perfil->setRequirements($requirements);
                    $perfil->setFunctions($functions);
                    //===[gabo 27 junio perfil]==
                    $perfil->setExperience_years($experience_years_c);
                    //===[gabo 27 junio perfil]==
                    $perfil->setStatus_experience_years($status_experience_years);
                    $perfil->setExperiencia_comments($experiencia_comments);
                    $perfil->setGeneral_comments($general_comments);
                    $perfil->setFunctions_comments($functions_comments);
                    $perfil->setStatus_functions($status_functions);
                    //===[gabo 27 junio perfil]==
                    $perfil->setTiempo($tiempo);
                    //===[gabo 27 junio perfil]==
                    //actualizar
                    $actualizado =  $perfil->update_profile();

                    if ($actualizado)
                        echo json_encode(array('status' => 1));
                    else
                        echo json_encode(array('status' => 0));
                } else {
                    //insertar perfil
                    $perfil = new ApplicantProfile();
                    $perfil->setGender($gender);
                    $perfil->setStatus_gender($status_gender);
                    $perfil->setAge($age);
                    $perfil->setStatus_age($status_age);
                    $perfil->setCivil_status($civil_status);
                    $perfil->setStatus_civil_status($status_civil_status);
                    $perfil->setLevel($level);
                    $perfil->setStatus_level($status_level);
                    $perfil->setLanguage($language);
                    $perfil->setStatus_language($status_language);
                    $perfil->setLanguage_level($language_level);
                    $perfil->setStatus_language_level($status_language_level);
                    // $perfil->setRequirements($requirements);
                    $perfil->setFunctions($functions);
                    //===[gabo 27 junio perfil]==
                    $perfil->setExperience_years($experience_years_c);
                    //===[gabo 27 junio perfil fin]==
                    $perfil->setStatus_experience_years($status_experience_years);
                    $perfil->setExperiencia_comments($experiencia_comments);
                    $perfil->setGeneral_comments($general_comments);
                    $perfil->setFunctions_comments($functions_comments);
                    $perfil->setStatus_functions($status_functions);
                    $perfil->setTiempo($tiempo);
                    $insertado = $perfil->save();

                    if ($insertado) {
                        //actualizar el id 
                        $candidato = new VacancyApplicant();
                        $candidato->setId_candidate($id_candidate);
                        $candidato->setId_vacancy($id_vacancy);
                        $candidato->setId_profile($perfil->getId());
                        $actualizado = $candidato->update_id_profile();

                        if ($actualizado) {
                            echo json_encode(array('status' => 1));
                        } else
                            echo json_encode(array('status' => 2));
                    } else
                        echo json_encode(array('status' => 2));
                }
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
    //========================================================

    // ===[GABO 27 ABRIL VER CANDIDATO2]
    public function update_modal()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
            $surname = isset($_POST['surname']) ? trim($_POST['surname']) : FALSE;
            $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : FALSE;
            $date_birth = isset($_POST['date_birth']) && !empty($_POST['date_birth']) ? trim($_POST['date_birth']) : NULL;
            $age = isset($_POST['age']) && !empty($_POST['age']) ? trim($_POST['age']) : NULL;
            $id_gender = isset($_POST['id_gender']) ? trim($_POST['id_gender']) : NULL;
            $id_civil_status = isset($_POST['id_civil_status']) && !empty($_POST['id_civil_status']) ? trim($_POST['id_civil_status']) : NULL;
            $id_level = isset($_POST['id_level']) ? trim($_POST['id_level']) : FALSE;
            $job_title = isset($_POST['job_title']) ? trim($_POST['job_title']) : FALSE;
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : NULL;
            $cellphone = isset($_POST['cellphone']) ? trim($_POST['cellphone']) : NULL;
            $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
            $id_state = isset($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $id_area = isset($_POST['id_area']) ? trim($_POST['id_area']) : FALSE;
            $id_subarea = isset($_POST['id_subarea']) ? trim($_POST['id_subarea']) : FALSE;
            $linkedinn = isset($_POST['linkedinn']) ? trim($_POST['linkedinn']) : NULL;
            $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : NULL;
            $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : NULL;

            $avatar = isset($_POST['avatar']) ? trim($_POST['avatar']) : FALSE;
            $resume = isset($_FILES['resume']) && $_FILES['resume']['name'] != '' ? $_FILES['resume'] : FALSE;
            $email = Utils::isCandidate() ? $_SESSION['identity']->email : $email;

            if ($first_name && $surname && $last_name && $id_level && $job_title && $email && $id_state && $id_city && $id_area && $id_subarea) {
                $candidate = new Candidate();
                $candidate->setId($id);
                $candidate->setFirst_name($first_name);
                $candidate->setSurname($surname);
                $candidate->setLast_name($last_name);
                $candidate->setDate_birth($date_birth);
                $candidate->setAge($age);
                $candidate->setId_gender($id_gender);
                $candidate->setId_civil_status($id_civil_status);
                $candidate->setJob_title($job_title);
                $candidate->setDescription($description);
                $candidate->setTelephone($telephone);
                $candidate->setCellphone($cellphone);
                $candidate->setEmail($email);
                $candidate->setId_state($id_state);
                $candidate->setId_city($id_city);
                $candidate->setId_area($id_area);
                $candidate->setId_subarea($id_subarea);
                $candidate->setLinkedinn($linkedinn);
                $candidate->setFacebook($facebook);
                $candidate->setInstagram($instagram);

                if (Utils::isCandidate()) {
                    $candidate->setEmail($_SESSION['identity']->email);
                    $candidate->setId_user($_SESSION['identity']->id);
                    $usuario = new User();
                    $usuario->setId($_SESSION['identity']->id);
                    $usuario->setFirst_name($first_name);
                    $usuario->setLast_name($surname . ' ' . $last_name);
                    $usuario->update();
                }
                //$candidate->setId_user(NULL);
                $update = $candidate->update();

                $candidato = $candidate->getOne();
                $candidato->created_at = Utils::getFullDate($candidato->created_at);
                $candidato->modified_at = Utils::getFullDate($candidato->modified_at);
                //===[FIN]===

                if ($update) {
                    $id = $candidate->getId();
                    $studies = new CandidateEducation();
                    $studies->setId_candidate($id);
                    $studies->setId_level($id_level);

                    $update = $studies->updateLevel();
                }

                if ($avatar) {
                    $img = $_POST['avatar'];
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $route = 'uploads/candidate/' . $id . '/';

                    if (file_exists($route)) {
                        Utils::deleteDir('uploads/candidate/' . $id);
                    }

                    if (!file_exists($route)) {
                        mkdir($route);
                    }

                    $file = $route . uniqid() . '.png';
                    $success = file_put_contents($file, $data);
                    if (!$success) {
                        echo json_encode(array('status' => 3));
                    }

                    if (Utils::isCandidate()) {


                        $id_user = $_SESSION['identity']->id;
                        $route = 'uploads/avatar/' . $id_user . '/';

                        if (file_exists($route)) {
                            Utils::deleteDir('uploads/avatar/' . $id);
                        }

                        if (!file_exists($route)) {
                            mkdir($route);
                        }

                        $file = $route . uniqid() . '.png';
                        $success = file_put_contents($file, $data);

                        if ($success) {
                            Utils::showProfilePicture();
                        }
                    }
                }


                $path = 'uploads/candidate/' . $candidato->id;
                if (file_exists($path) && !empty($candidato->id)) {
                    $directory = opendir($path);

                    while ($file = readdir($directory)) {
                        if (!is_dir($file)) {
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path . "/" . $file);
                            $route = $path . '/' . $file;
                        }
                    }
                }

                $candidato->img = base_url . $route;



                if ($resume) {
                    if (file_exists('uploads/resume/' . $id)) {
                        Utils::deleteDir('uploads/resume/' . $id);
                    }

                    $allowed_formats = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf");
                    $limit_kb = 6000;

                    if (in_array($_FILES["resume"]["type"], $allowed_formats) && $_FILES["resume"]["size"] <= $limit_kb * 1024) {
                        $route = 'uploads/resume/' . $id . '/';
                        $resume = $route . $_FILES["resume"]["name"];

                        if (!file_exists($route)) {
                            mkdir($route);
                        }

                        if (!file_exists($resume)) {
                            $result = @move_uploaded_file($_FILES["resume"]["tmp_name"], $resume);
                        }

                        if ($update) {

                            echo json_encode(array(
                                'candidato' => $candidato,
                                'status' => 1
                            ));
                        } else {
                            echo json_encode(array('status' => 2));
                        }
                    } else {
                        echo json_encode(array('status' => 4));
                    }
                } else {
                    if ($update) {

                        echo json_encode(array(
                            'candidato' => $candidato,
                            'status' => 1
                        ));
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }
    //========================================================
    public function profile()
    {

        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE && Utils::isAdmin() || Utils::isRecruitmentManager() || Utils::isSenior()) {
            $id_vacancy = isset($_GET['id_vacancy']) ? trim(Encryption::decode($_GET['id_vacancy'])) : FALSE;
            $id_candidate = isset($_GET['id_candidate']) ? trim(Encryption::decode($_GET['id_candidate'])) : FALSE;

            $vacante = new Vacancy();
            $vacante->setId($id_vacancy);
            $vacante = $vacante->getOne();

            $candidato = new Candidate();
            $candidato->setId($id_candidate);
            $language = $candidato->getLanguageFromCandidate();
            $candidato = $candidato->getOneFull();

            $civil_status = new CivilStatus();
            $civil_status->setId($vacante->id_civil_status);
            $status =  $civil_status->getOne();
            $vacante->id_civil_status = $status->status;



            $page_title = 'Perfil | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/candidate/profile.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }


    public function pruebaserver()
    {

        $_GET['filtros'] .= ($_GET['id_language'] != '') ? "and id_language like " . "'%" . $_GET['id_language'] . "%'" : '';
        $extrawhere = substr($_GET['filtros'], 3);
        $tabla = "filtros_candidatos4 fc";


        if ($_GET['clave'] != '') {
            $extrawhere = " ( first_name LIKE " . "'%" . $_GET['clave'] . "%' OR age LIKE " . "'%" . $_GET['clave'] . "%' OR city LIKE " . "'%" . $_GET['clave'] . "%' OR state LIKE " . "'%" . $_GET['clave'] . "%' OR level LIKE " . "'%" . $_GET['clave'] . "%' OR job_title LIKE " . "'%" . $_GET['clave'] . "%' OR language LIKE " . "'%" . $_GET['clave'] . "%' OR area LIKE " . "'%" . $_GET['clave'] . "%' OR subarea LIKE " . "'%" . $_GET['clave'] . "%' OR description LIKE " . "'%" . $_GET['clave'] . "%' OR experiences LIKE " . "'%" . $_GET['clave'] . "%' OR aptitudes LIKE " . "'%" . $_GET['clave'] . "%' OR created_at LIKE " . "'%" . $_GET['clave'] . "%' OR created_by LIKE " . "'%" . $_GET['clave'] . "%')";
        }




        $primaryKey = 'id';
        $columns = array(

            array('db' => 'first_name',  'dt' => 1),
            array('db' => 'age',  'dt' => 2),
            array('db' => 'city',  'dt' => 3),
            array('db' => 'state',  'dt' => 4),
            array('db' => 'level',  'dt' => 5),
            array('db' => 'job_title',  'dt' => 6),
            array('db' => 'language',  'dt' => 7),
            array('db' => 'area',  'dt' => 8),
            array('db' => 'subarea',  'dt' => 9),
            array('db' => 'description',  'dt' => 10),
            array('db' => 'experiences',  'dt' => 11),
            array('db' => 'aptitudes',  'dt' => 12),
            array('db' => 'created_at',  'dt' => 13),
            array('db' => 'created_by',  'dt' => 14),
            array('db' => 'id',  'dt' => 15),
            array('db' => 'id_gender',  'dt' => 16),
            array('db' => 'surname',  'dt' => 18),
            array('db' => 'last_name',  'dt' => 19),
            array('db' => 'id_language',  'dt' => 20),
            // array('db' => 'first_name',  'dt' => 11),
            // array('db' => 'first_name',  'dt' => 12),
            // array('db' => 'first_name',  'dt' => 13)

        );


        $sql_details = array(
            'user' => '',
            'pass' => '',
            'db'   => 'reclutamiento3',
            'host' => 'localhost'
        );

        // $sql_details = array(
        //     'user' => 'reclutador',
        //     'pass' => 'Sr65s$0z',
        //     'db'   => 'reclutamiento',
        //     'host' => '148.72.144.152'
        // );

        $botones = 1;

        require("views/candidate/ssp.php");
        // require("helpers/Encryption.php");
        // require("../../config/Connection.php");
        // require("../../config/Parameters.php");
        // require("../../models/Candidate.php");
        // require("../../helpers/utils.php");

        $extraFields = '';
        //si la busqueda viene del datatable input
        $_POST['search']['value'] != "" ? $extrawhere = '' : '';

        //si la tabla es postulate ocupamos 2 atributos extra
        if (isset($_GET['id_vacancy'])) {
            $_GET['id_vacancy'] = Encryption::decode($_GET['id_vacancy']);
            $extraFields = " ,(SELECT top (1) id_status FROM vacancy_applicants va WHERE va.id_candidate=fc.id AND va.id_vacancy=" . $_GET['id_vacancy'] . ") AS id_status, (SELECT top (1) vas.status FROM vacancy_applicants va LEFT JOIN vacancy_applicant_status vas ON va.id_status=vas.id WHERE va.id_candidate=fc.id AND va.id_vacancy=" . $_GET['id_vacancy'] . ") AS status";
        }

        echo json_encode(
            SSP::simple($_POST, $sql_details,  $tabla, $primaryKey, $columns, $botones, $extrawhere, $extraFields)
        );
    }
}
