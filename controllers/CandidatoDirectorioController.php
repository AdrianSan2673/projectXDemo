<?php

require_once 'models/User.php';
require_once 'models/CandidateDirectory.php';
require_once 'models/CustomerContact.php';
require_once 'models/State.php';
require_once 'models/City.php';
require_once 'models/Vacancy.php';

require_once 'models/CandidateContact.php';
require_once 'models/Vacancy.php';
require_once 'models/CandidateExperienceDirectory.php';
require_once 'models/CandidateEducationDirectory.php';
require_once 'models/Candidate.php';
require_once 'models/CandidateExperience.php';
require_once 'models/CandidateEducation.php';
require_once 'models/VacancyApplicant.php';
require_once 'models/Subarea.php';

class CandidatoDirectorioController
{

    public function index()
    {
		//  || Utils::isSenior() || Utils::isJunior() || Utils::isRecruitmentManager() || Utils::isCustomer()
        if (Utils::isAdmin()) {
            $id_vacancy = isset($_POST['vacancy']) && $_POST['vacancy'] != 0 ? $_POST['vacancy'] : 0;

            $candidatesDirector = $this->candidatesDirectory($id_vacancy);

            $candidateDirectoryObj = new CandidateDirectory();
            $vacancies = $candidateDirectoryObj->getAllCandidateByVacancy();

            $page_title = 'Directorio Candidatos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/candidateDirectory/index.php';
            require_once 'views/candidateDirectory/modal-create.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function save()
    {
        if (Utils::isAdmin()  || Utils::isSenior() || Utils::isJunior() || Utils::isRecruitmentManager() || Utils::isCustomer() && $_POST) {

            $flag = $_POST['flag'];
            $id = Encryption::decode($_POST['id']);
            $first_name =  isset($_POST['first_name']) ? Utils::sanitizeStringBlank($_POST['first_name']) : NULL;
            $surname =  isset($_POST['surname']) ? Utils::sanitizeStringBlank($_POST['surname']) : NULL;
            $last_name =  isset($_POST['last_name']) ? Utils::sanitizeStringBlank($_POST['last_name']) : NULL;

            $telephone =  isset($_POST['telephone']) ? Utils::sanitizeStringBlank($_POST['telephone']) : NULL;
            $experience = isset($_POST['experience']) ? Utils::sanitizeStringBlank($_POST['experience']) : NULL;
            $id_vacancy = isset($_POST['id_vacancy']) ? Utils::sanitizeNumber($_POST['id_vacancy']) : NULL;
            $id_state = isset($_POST['id_state']) ? Utils::sanitizeNumber($_POST['id_state']) : NULL;
            $id_city = isset($_POST['id_city']) ? Utils::sanitizeNumber($_POST['id_city']) : NULL;
            $email = isset($_POST['email']) ? Utils::sanitizeStringBlank($_POST['email']) : Null;
            $url = isset($_POST['url']) ? Utils::sanitizeStringBlank($_POST['url']) : Null;
            $comment = isset($_POST['comment']) ? Utils::sanitizeStringBlank($_POST['comment']) : Null;
            $status = isset($_POST['status']) ? Utils::sanitizeStringBlank($_POST['status']) : Null;
            $id_vacancy_filter = isset($_POST['id_vacancy_filter']) ? Utils::sanitizeNumber($_POST['id_vacancy_filter']) : NULL;

            if (($flag == 1 || $flag == 2) && $first_name && $surname && $last_name && $telephone  && $id_state) {
                if (Utils::isCustomer()) {
                    $contact = new CustomerContact();
                    $contact->setId_user($_SESSION['identity']->id);
                    $contactos = $contact->getContactByUser();
                }
                $candidateDirectoryObj = new CandidateDirectory();
                $candidateDirectoryObj->setFirst_name($first_name);
                $candidateDirectoryObj->setSurname($surname);
                $candidateDirectoryObj->setLast_name($last_name);
                $candidateDirectoryObj->setTelephone($telephone);
                $candidateDirectoryObj->setExperience($experience);
                $candidateDirectoryObj->setId_vacancy($id_vacancy);
                $candidateDirectoryObj->setId_state($id_state);
                $candidateDirectoryObj->setId_city($id_city);
                $candidateDirectoryObj->setEmail($email);
                $candidateDirectoryObj->setUrl($url);
                $candidateDirectoryObj->setComment($comment);
                $candidateDirectoryObj->setStatus($status);
                $candidateDirectoryObj->setCreated_by($_SESSION['identity']->id);
                $candidateDirectoryObj->setId_customer(Utils::isCustomer() ? $contactos->id_customer : null);

                if ($flag == 1) {
                    $respons = $candidateDirectoryObj->save();
                } else {
                    $candidateDirectoryObj->setid($id);
                    $respons = $candidateDirectoryObj->update();
                }

                $candidatesDirector = $this->candidatesDirectory($id_vacancy_filter == null || $id_vacancy_filter == ''|| $id_vacancy_filter == 0 ? $id_vacancy_filter: $id_vacancy);

                if ($respons) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'flag' => Utils::isCustomer(),
                            'candidatesDirector' => $candidatesDirector
                        )
                    );
                } else {
                    echo json_encode(array('status' => 0));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 2));
        }
    }


    function getOne()
    {
        if (Utils::isAdmin()  || Utils::isSenior() || Utils::isJunior() || Utils::isRecruitmentManager() || Utils::isCustomer() && $_POST) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $candidateDirectoryObj = new CandidateDirectory();
                $candidateDirectoryObj->setId($id);
                $candidate = $candidateDirectoryObj->getOne();
                $candidate->id = Encryption::encode($candidate->id);

                $State = new State();
                $State = $State->getAll();

                $City = new City();
                $City->setId_state($candidate->id_state);
                $City = $City->getCitiesByState();

                if ($candidate) {
                    echo json_encode(array('status' => 1, 'candidate' => $candidate, 'State' => $State, 'City' => $City));
                } else {
                    echo json_encode(array('status' => 0));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function delete()
    {

        if (Utils::isAdmin()  || Utils::isSenior() || Utils::isJunior() || Utils::isRecruitmentManager() || Utils::isCustomer() && $_POST) {
            $id = Encryption::decode($_POST['id']);
            $id_vacancy_filter = Utils::sanitizeNumber($_POST['id_vacancy']);

            if ($id) {
                $candidateDirectoryObj = new CandidateDirectory();
                $candidateDirectoryObj->setId($id);

                $id_vacancy = $id_vacancy_filter != 0 ? $candidateDirectoryObj->getOne()->id_vacancy : $id_vacancy_filter;

                $candidateDirectoryObj->delete();


                $candidatesDirector = $this->candidatesDirectory($id_vacancy);
                echo json_encode(
                    array(
                        'status' => 1,
                        'flag' => Utils::isCustomer(),
                        'candidatesDirector' => $candidatesDirector
                    )
                );
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 2));
        }
    }

    public function candidatesDirectory($id_vacancy = 0)

    {
        $candidateDirectoryObj = new CandidateDirectory();

        if (Utils::isCustomer()) {
            $contact = new CustomerContact();
            $contact->setId_user($_SESSION['identity']->id);
            $contactos = $contact->getContactByUser();
            $candidateDirectoryObj->setId_customer($contactos->id_customer);
            $candidatesDirector = $candidateDirectoryObj->getAllById_customer();
        } else {

            if ($id_vacancy != 0) {
                $candidateDirectoryObj->setId_vacancy($id_vacancy);
                $candidatesDirector = $candidateDirectoryObj->getAllByVacancy();
            } else {
                $candidatesDirector = $candidateDirectoryObj->getAll();
            }
        }
        foreach ($candidatesDirector as &$candidate) {
            $candidate['id'] = Encryption::encode($candidate['id']);
            $candidate['id_vacancy'] = Encryption::encode($candidate['id_vacancy']);
            $candidate['id_candidate'] = Encryption::encode($candidate['id_candidate']);
            $candidate['name'] = $candidate['first_name'] . ' ' . $candidate['surname'] . ' ' . $candidate['last_name'];
            $candidate['created_at_month'] = Utils::getShortDateMoth($candidate['created_at']);
            $candidate['created_at'] = Utils::getShortDate($candidate['created_at']);
            $candidate['experience'] == null || $candidate['experience'] == '' ? 'Sin experencia' : $candidate['experience'];
            $candidate['vacancy'] = $candidate['vacancy'] == null ||  $candidate['id_vacancy'] == null ? 'Sin vacante' : $candidate['vacancy'];
            $candidate['id_state'] = $candidate['id_state'] == null ? 'Sin verificar' : $candidate['state'];
            $candidate['id_city'] = $candidate['id_city'] == null ? 'Sin verificar' : $candidate['city'];
            $candidate['comment'] = $candidate['comment'] == null || $candidate['comment'] == '' ? '' : $candidate['comment'];
            $candidate['modified_at'] = Utils::getFullDate12($candidate['modified_at']);

            $candidate['hidden_ver'] = $candidate['id_candidate'] == null || $candidate['id_candidate'] == '' ? ' hidden' : '';
            $candidate['hidden'] = $candidate['id_candidate'] == null || $candidate['id_candidate'] == '' ? ' ' : 'hidden';

            $candidate['url_ver'] = base_url . 'candidato/ver&id=' . $candidate['id_candidate'];
            $candidate['url_crear'] = base_url . 'candidato/crear&vacante=' . $candidate['id_vacancy'] . '&contact=' . $candidate['id'];

            switch ($candidate['status']) {
                case 1: //nuevo
                    $candidate['color'] = '';
                    break;
                case 2: //Por contactar
                    $candidate['color'] = 'bg-warning';
                    break;
                case 3: //Contactado
                    $candidate['color'] = 'bg-success';
                    break;
                case 4: //Pendiente
                    $candidate['color'] = 'bg-orange';
                    break;
                case 5: //No recomendado
                    $candidate['color'] = 'bg-danger';
                    break;
                case 6: //Postulado
                    $candidate['color'] = 'bg-info';
                    break;
                default:
                    $candidate['color'] = '';
                    break;
            }
        }

        return  $candidatesDirector;
    }
	
	
	
	
	
    public function save_contacto()
    {

        if (Utils::isValid($_POST)) {

            $id_contact = isset($_POST['id_contact']) ? trim($_POST['id_contact']) : FALSE;

            if ($id_contact) {
                $contacto = new CandidateContact();
                $contacto->setId($id_contact);
                $contact = $contacto->getOne();



                $vacancy = new Vacancy();
                $vacancy->setId($contact->id_vacancy);
                $vacante = $vacancy->getOne();
                $vacancy = $vacante->vacancy;


                $candidateDirectoryObj = new CandidateDirectory();
                $candidateDirectoryObj->setFirst_name($contact->first_name);
                $candidateDirectoryObj->setSurname($contact->surname);
                $candidateDirectoryObj->setLast_name($contact->last_name);
                $candidateDirectoryObj->setTelephone($contact->telephone);
                // $candidateDirectoryObj->setAge(NULL);
                $candidateDirectoryObj->setExperience('');
                $candidateDirectoryObj->setId_vacancy($contact->id_vacancy);
                $candidateDirectoryObj->setId_state($vacante->id_state);
                $candidateDirectoryObj->setId_city($vacante->id_city);
                // $candidateDirectoryObj->setUrl($url);
                // $candidateDirectoryObj->setComment($comment);
                $candidateDirectoryObj->setStatus(3);
                // $candidateDirectoryObj->setCreated_at(getDate());
                $candidateDirectoryObj->setCreated_by($_SESSION['identity']->id);
                // $candidateDirectoryObj->setModified_at(getDate());
                // $candidateDirectoryObj->setDate_birth($date_birth);
                // $candidateDirectoryObj->setJob_title($job_title);
                // $candidateDirectoryObj->setDescription($description);
                // $candidateDirectoryObj->setCellphone($cellphone);
                $candidateDirectoryObj->setId_area($vacante->id_area);
                $candidateDirectoryObj->setId_subarea($vacante->id_subarea);

                $save = $candidateDirectoryObj->save_candidate();

                if ($save) {
                    $contacto->setId($id_contact);
                    $contacto->setStatus(3);
                    $contacto->updateStatus();

                    $contacts =  $contacto->getAll();

                    echo json_encode(array('status' => 1, 'contacts' => $contacts));
                } else {

                    echo json_encode(array('status' => 0));
                }
            }
        }
    }

    public function descart_contact()
    {

        if (Utils::isValid($_POST)) {

            $id_contact = isset($_POST['id_contact']) ? trim($_POST['id_contact']) : FALSE;

            if ($id_contact) {
                $contacto = new CandidateContact();
                $contacto->setId($id_contact);
                $contacto->setStatus(2);
                $save = $contacto->updateStatus();

                if ($save) {
                    $contacts =  $contacto->getAll();


                    echo json_encode(array('status' => 1, 'contacts' => $contacts));
                } else {

                    echo json_encode(array('status' => 0));
                }
            }
        }
    }
	
	//gabo 18 oct
	
	
	
	
    public function save_candidato()
    {

        if (Utils::isValid($_POST)) {

            $first_name = isset($_POST['first_name']) && !empty($_POST['first_name']) ? trim($_POST['first_name']) : FALSE;
            $surname = isset($_POST['surname']) && $_POST['surname']!=""  ? trim($_POST['surname']) : FALSE;
            $last_name = isset($_POST['last_name']) && $_POST['last_name']!="" ? trim($_POST['last_name']) : NULL;
            $date_birth = isset($_POST['date_birth']) && !empty($_POST['date_birth']) ? trim($_POST['date_birth']) : NULL;
            $age = isset($_POST['age']) && !empty($_POST['age']) ? trim($_POST['age']) : NULL;
            $id_gender = isset($_POST['id_gender']) && !empty($_POST['id_gender']) ? trim($_POST['id_gender']) : NULL;
            $id_civil_status = isset($_POST['id_civil_status']) && !empty($_POST['id_civil_status']) ? trim($_POST['id_civil_status']) : NULL;
            $id_level = isset($_POST['id_level']) && !empty($_POST['id_level']) ? trim($_POST['id_level']) : FALSE;
            $job_title = isset($_POST['job_title']) && !empty($_POST['job_title']) ? trim($_POST['job_title']) : FALSE;
            $description = isset($_POST['description']) && !empty($_POST['description']) ? trim($_POST['description']) : '';
            $telephone = isset($_POST['telephone']) && !empty($_POST['telephone']) ? trim($_POST['telephone']) : NULL;
            $cellphone = isset($_POST['cellphone']) && !empty($_POST['cellphone']) ? trim($_POST['cellphone']) : NULL;
            $email = isset($_POST['email']) && !empty($_POST['email']) ? trim($_POST['email']) : FALSE;
            $id_state = isset($_POST['id_state']) && !empty($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) && !empty($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $id_area = isset($_POST['id_area']) && !empty($_POST['id_area']) ? trim($_POST['id_area']) : FALSE;
            $id_subarea = isset($_POST['id_subarea']) && !empty($_POST['id_subarea']) ? trim($_POST['id_subarea']) : FALSE;
            $resume = isset($_FILES['resume']) && $_FILES['resume']['name'] != '' ? $_FILES['resume'] : FALSE;
            $id_vacancy = isset($_POST['id_vacancy'])  && !empty($_POST['id_vacancy']) ? $_POST['id_vacancy'] : FALSE;
            $id_contacto = isset($_POST['contact']) && !empty($_POST['contact']) ? Encryption::decode($_POST['contact']) : NULL; //id del contacto del directorio
            $start_date = isset($_POST['start_date']) && !empty($_POST['start_date']) ?  $_POST['start_date'] : null;
            $end_date = isset($_POST['end_date']) && !empty($_POST['end_date']) ?  $_POST['end_date'] : null;
            $enterpise_experience = isset($_POST['enterprise_experience']) && !empty($_POST['enterprise_experience']) ?  $_POST['enterprise_experience'] : null;
            $review_experience = isset($_POST['review_experience']) && !empty($_POST['review_experience']) ?  $_POST['review_experience'] : null;
            $tipo = isset($_POST['tipo']) && !empty($_POST['tipo']) ?  $_POST['tipo'] : null;
            $url = isset($_POST['url']) && !empty($_POST['url']) ?  $_POST['url'] : null;
            $comment = isset($_POST['comment']) && !empty($_POST['comment']) ?  $_POST['comment'] : null;
            $status = isset($_POST['status']) && !empty($_POST['status']) ?  $_POST['status'] : null;
            $cellphone = isset($_POST['cellphone']) && !empty($_POST['cellphone']) ?  $_POST['cellphone'] : null;

            $flag = isset($_POST['flag']) ?  $_POST['flag'] : null;
            //id_gender , id_state ,id_vacancy     
            $id_candidate_directory = isset($_POST['id_candidate_directory']) && !empty($_POST['id_candidate_directory']) ? Encryption::decode(($_POST['id_candidate_directory'])) : FALSE;
			
			$id_candidate=NULL;




            if ($date_birth < '1950-01-01') {
                echo json_encode(array('status' => 5));
                die();
            }


            $vacancy = new Vacancy();
            $vacancy->setId($id_vacancy);
            $vacante = $vacancy->getOne();



            if (($first_name && $surname && $last_name && $age && $date_birth   && $id_level && $job_title  && $status && $id_vacancy  && $id_state && $id_city && $id_area && $id_subarea)) {


                if ($resume) {
                    $allowed_formats = array("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/pdf");
                    $limit_kb = 6000;
                    if (!in_array($_FILES["resume"]["type"], $allowed_formats) || $_FILES["resume"]["size"] > $limit_kb * 1024) {
                        echo 4;
                        die();
                    }
                }


                if (($vacante->type == 1 || $vacante->type == 4)) {


                    // if ($tipo == 'directory') {
                    $candidateDirectoryObj = new CandidateDirectory();
                    $candidateDirectoryObj->setFirst_name($first_name);
                    $candidateDirectoryObj->setSurname($surname);
                    $candidateDirectoryObj->setLast_name($last_name);
                    $candidateDirectoryObj->setTelephone($telephone);
                    $candidateDirectoryObj->setAge($age);
                    $candidateDirectoryObj->setExperience($job_title);
                    $candidateDirectoryObj->setId_vacancy($id_vacancy);
                    $candidateDirectoryObj->setId_state($id_state);
                    $candidateDirectoryObj->setId_city($id_city);
                    //$candidateDirectoryObj->setEmail($email);
                    $candidateDirectoryObj->setUrl($url);
                    $candidateDirectoryObj->setComment($comment);
                    $candidateDirectoryObj->setStatus($status);
                    $candidateDirectoryObj->setCreated_at(getDate());
                    $candidateDirectoryObj->setCreated_by($_SESSION['identity']->id);
                    $candidateDirectoryObj->setModified_at(getDate());
                    $candidateDirectoryObj->setDate_birth($date_birth);
                    //$candidateDirectoryObj->setId_gender($id_gender);
                    //$candidateDirectoryObj->setId_civil_status($id_civil_status);
                    $candidateDirectoryObj->setJob_title($job_title);
                    $candidateDirectoryObj->setDescription($description);
                    $candidateDirectoryObj->setCellphone($cellphone);
                    $candidateDirectoryObj->setId_area($id_area);
                    $candidateDirectoryObj->setId_subarea($id_subarea);
                    //$candidateDirectoryObj->setId_user($id_user);

                    if ($flag == 'create') {
                        $candidateDirectoryObj->save_candidate();
                        $id_candidate_directory = $candidateDirectoryObj->getId();
                    }

                    $studies = new CandidateEducationDirectory();
                    $studies->setId_directory($id_candidate_directory);
                    $studies->setTitle(NULL);
                    $studies->setInstitution(NULL);
                    $studies->setStart_date(NULL);
                    $studies->setEnd_date(NULL);
                    $studies->setStill_studies(NULL);
                    $studies->setId_level($id_level);

                    if ($flag == 'create') {
                        $save =  $studies->save();
                    } else {
                        $save =   $studies->update();
                    }



                    if (isset($_POST['enterprise_experience'])) {
                        $experience = new CandidateExperienceDirectory;
                        $experience->setId_directory($id_candidate_directory);
                        $experience->delete_experiences();

                        $experience->setId_area(1);
                        $experience->setId_subarea(1);
                        $experience->setId_state(1);
                        $experience->setId_city(1);
                        $experience->setType('operativa');
                        // $experience->setStart_date(NULL);

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

                    if ($tipo == 'postulate') {

                        $candidate = new Candidate();
                        $candidate->setFirst_name($first_name);
                        $candidate->setSurname($surname);
                        $candidate->setLast_name($last_name);
                        $candidate->setDate_birth($date_birth);
                        $candidate->setAge($age);
                        //$candidate->setId_gender($id_gender);
                        //$candidate->setId_civil_status($id_civil_status);
                        $candidate->setJob_title($job_title);
                        $candidate->setDescription($description);
                        $candidate->setTelephone($telephone);
                        //$candidate->setCellphone($cellphone);
                        $candidate->setEmail($email);
                        $candidate->setId_state($id_state);
                        $candidate->setId_city($id_city);
                        $candidate->setId_area($id_area);
                        $candidate->setId_subarea($id_subarea);;
                        $candidate->setId_user(NULL);
                        $candidate->setCreated_by($_SESSION['identity']->id);
                        $save = $candidate->save();
                        $id_candidate = $candidate->getId();

                        if ($save) {
                            //vincular candidato con el directorio
                            $candidateDirectoryObj = new CandidateDirectory();
                            $candidateDirectoryObj->setId($id_candidate_directory);
                            $candidateDirectoryObj->setStatus(6);
                            $candidateDirectoryObj->setId_candidate($id_candidate);
                            $candidateDirectoryObj->updateSatusCandidate();


                            $studies = new CandidateEducation();
                            $studies->setId_candidate($id_candidate);
                            $studies->setTitle(NULL);
                            $studies->setInstitution(NULL);
                            $studies->setStart_date(NULL);
                            $studies->setEnd_date(NULL);
                            $studies->setStill_studies(NULL);
                            $studies->setId_level($id_level);
                            $save = $studies->save();


                            $experience = new CandidateExperience;
                            $experience->setId_candidate($id_candidate);
                            if (isset($_POST['enterprise_experience'])) {
                                $experience->setId_area(1);
                                $experience->setId_subarea(1);
                                $experience->setId_state(1);
                                $experience->setId_city(1);
                                $experience->setType('operativa');
                                $experience->setStart_date(NULL);

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

                            //===[gabo 15 junio experiencia candidato fin ]===

                            if ($id_vacancy && is_numeric($id_vacancy)) {
                                $vacancy = new Vacancy();
                                $vacancy->setId($id_vacancy);
                                $vacante = $vacancy->getOne();
                                if ($vacante) {
                                    $applicant = new VacancyApplicant();
                                    $applicant->setId_vacancy($id_vacancy);
                                    $applicant->setId_candidate($id_candidate);
                                    $save = $applicant->create();
                                    $applicant->setId_status(3);
                                    $applicant->setCustomer_date(true);
                                    $applicant->updateStatus();
                                }
                            }
                        }
                    } else  if ($tipo == 'candidate') {

                        $candidate = new Candidate();
                        $candidate->setFirst_name($first_name);
                        $candidate->setSurname($surname);
                        $candidate->setLast_name($last_name);
                        $candidate->setDate_birth($date_birth);
                        $candidate->setAge($age);
                        //$candidate->setId_gender($id_gender);
                        //$candidate->setId_civil_status($id_civil_status);
                        $candidate->setJob_title($job_title);
                        $candidate->setDescription($description);
                        $candidate->setTelephone($telephone);
                        $candidate->setCellphone($cellphone);
                        $candidate->setEmail($email);
                        $candidate->setId_state($id_state);
                        $candidate->setId_city($id_city);
                        $candidate->setId_area($id_area);
                        $candidate->setId_subarea($id_subarea);;
                        $candidate->setId_user(NULL);
                        $candidate->setCreated_by($_SESSION['identity']->id);
                        $save = $candidate->save();
                        $id_candidate = $candidate->getId();

                        if ($save) {
                            //vincular candidato con el directorio
                            $candidateDirectoryObj = new CandidateDirectory();
                            $candidateDirectoryObj->setId($id_candidate_directory);
                            $candidateDirectoryObj->setStatus(6);
                            $candidateDirectoryObj->setId_candidate($id_candidate);
                            $candidateDirectoryObj->updateSatusCandidate();


                            $studies = new CandidateEducation();
                            $studies->setId_candidate($id_candidate);
                            $studies->setTitle(NULL);
                            $studies->setInstitution(NULL);
                            $studies->setStart_date(NULL);
                            $studies->setEnd_date(NULL);
                            $studies->setStill_studies(NULL);
                            $studies->setId_level($id_level);

                            $save = $studies->save();

                            if ($id_candidate) {
                                $experience = new CandidateExperience;
                                $experience->setId_candidate($id_candidate);
                                if (isset($_POST['enterprise_experience'])) {
                                    $experience->setId_area(1);
                                    $experience->setId_subarea(1);
                                    $experience->setId_state(1);
                                    $experience->setId_city(1);
                                    $experience->setType('operativa');
                                    $experience->setStart_date(NULL);

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

                    ///fin metodo
                    $candidatesDirector = $this->candidatesDirectory();
					if($id_candidate!=NULL){
						$id_candidate= Encryption::encode($id_candidate);
						$id_vacancy= Encryption::encode($id_vacancy);
					}

                    if ($save) {
                        echo json_encode(
                            array(
                                'status' => 1,
                                'candidatesDirector' => $candidatesDirector,
								'tipo' => $tipo,
								'id_candidate' => $id_candidate,
								'id_vacancy' => $id_vacancy
                            )
                        );
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                } else {
                    //valida los datos restantes 

                    if ($id_gender && $id_civil_status && $email && $cellphone) {

                        //  if ($tipo == 'directory') {

                        $candidateDirectoryObj = new CandidateDirectory();
                        $candidateDirectoryObj->setId($id_candidate_directory);
                        $candidateDirectoryObj->setFirst_name($first_name);
                        $candidateDirectoryObj->setSurname($surname);
                        $candidateDirectoryObj->setLast_name($last_name);
                        $candidateDirectoryObj->setTelephone($telephone);
                        $candidateDirectoryObj->setAge($age);
                        $candidateDirectoryObj->setExperience($job_title);
                        $candidateDirectoryObj->setId_vacancy($id_vacancy);
                        $candidateDirectoryObj->setId_state($id_state);
                        $candidateDirectoryObj->setId_city($id_city);
                        $candidateDirectoryObj->setEmail($email);
                        $candidateDirectoryObj->setUrl($url);
                        $candidateDirectoryObj->setComment($comment);
                        $candidateDirectoryObj->setStatus($status);
                        $candidateDirectoryObj->setCreated_at(getDate());
                        $candidateDirectoryObj->setCreated_by($_SESSION['identity']->id);
                        $candidateDirectoryObj->setModified_at(getDate());
                        $candidateDirectoryObj->setDate_birth($date_birth);
                        $candidateDirectoryObj->setId_gender($id_gender);
                        $candidateDirectoryObj->setId_civil_status($id_civil_status);
                        $candidateDirectoryObj->setJob_title($job_title);
                        $candidateDirectoryObj->setDescription($description);
                        $candidateDirectoryObj->setCellphone($cellphone);
                        $candidateDirectoryObj->setId_area($id_area);
                        $candidateDirectoryObj->setId_subarea($id_subarea);


                      
                        if ($flag == 'create') {
                            $save = $candidateDirectoryObj->save_candidate();
                            $id_candidate_directory = $candidateDirectoryObj->getId();
                        } else {
                            $save = $candidateDirectoryObj->update_candidate();
                        }


                   
                        $studies = new CandidateEducationDirectory();
                        $studies->setId_directory($id_candidate_directory);
                        $studies->setId_level($id_level);
                        $flag == 'create' ? $save = $studies->save() : $save = $studies->update();

             

                        if ($resume) {

                            if (file_exists('uploads/resume_directory/' . $id_candidate_directory . '.pdf')) {
                                unlink('uploads/resume_directory/' . $id_candidate_directory . '.pdf');
                            }

                            $route2 = 'uploads/resume_directory/';
                            $resume2 = $route2 . $id_candidate_directory . '.pdf';

                            if (!file_exists($resume2)) {
                                $result = @move_uploaded_file($_FILES["resume"]["tmp_name"], $resume2);
                                $routeDocu = base_url . $resume2;
                            }
                        }

               
                        if ($tipo == 'postulate') {

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
                            $candidate->setId_subarea($id_subarea);;
                            $candidate->setId_user(NULL);
                            $candidate->setCreated_by($_SESSION['identity']->id);
                            $save = $candidate->save();
                            $id_candidate = $candidate->getId();

                            if ($save) {
                                //vincular candidato con el directorio
                                $candidateDirectoryObj = new CandidateDirectory();
                                $candidateDirectoryObj->setId($id_candidate_directory);
                                $candidateDirectoryObj->setStatus(6);
                                $candidateDirectoryObj->setId_candidate($id_candidate);
                                $candidateDirectoryObj->updateSatusCandidate();



                                $studies = new CandidateEducation();
                                $studies->setId_candidate($id_candidate);
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
                                        $applicant->setId_candidate($id_candidate);
                                        $save = $applicant->create();
                                        $applicant->setId_status(3);
                                        $applicant->setCustomer_date(true);
                                        $applicant->updateStatus();
                                    }
                                }

                                if (file_exists('uploads/resume_directory/' . $id_candidate_directory . '.pdf')) {
                                    $route = 'uploads/resume/' . $id_candidate . '/';
                                    if (!file_exists($route)) {
                                        mkdir($route);
                                    }
                                  
                                    rename('uploads/resume_directory/' . $id_candidate_directory . '.pdf', "uploads/resume/" . $id_candidate . "/" . $id_candidate . ".pdf");
                                 
                                }
                            }
                        } else  if ($tipo == 'candidate') {

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
                            $candidate->setId_user(NULL);
                            $candidate->setCreated_by($_SESSION['identity']->id);
                            $save = $candidate->save();
                            $id_candidate = $candidate->getId();

                            if ($save) {

                                //vincular candidato con el directorio
                                $candidateDirectoryObj = new CandidateDirectory();
                                $candidateDirectoryObj->setId($id_candidate_directory);
                                $candidateDirectoryObj->setStatus(6);
                                $candidateDirectoryObj->setId_candidate($id_candidate);
                                $status = $candidateDirectoryObj->updateSatusCandidate();

                                $studies = new CandidateEducation();
                                $studies->setId_candidate($id_candidate);
                                $studies->setTitle(NULL);
                                $studies->setInstitution(NULL);
                                $studies->setStart_date(NULL);
                                $studies->setEnd_date(NULL);
                                $studies->setStill_studies(NULL);
                                $studies->setId_level($id_level);

                                $save = $studies->save();

                                if (file_exists('uploads/resume_directory/' . $id_candidate_directory . '.pdf')) {


                                    $route = 'uploads/resume/' . $id_candidate . '/';
                                    if (!file_exists($route)) {
                                        mkdir($route);
                                    }
                             
                                    rename('uploads/resume_directory/' . $id_candidate_directory . '.pdf', "uploads/resume/" . $id_candidate . "/" . $id_candidate . ".pdf");
                                  
                                }

                            }
                        }

                        ///fin metodo
                        $candidatesDirector = $this->candidatesDirectory();
						if($id_candidate!=NULL){
						$id_candidate= Encryption::encode($id_candidate);
					    $id_vacancy= Encryption::encode($id_vacancy);
					    }

                        if ($save) {
                            echo json_encode(
                                array(
                                    'status' => 1,
                                    'candidatesDirector' => $candidatesDirector,
									'tipo' => $tipo,
									'id_candidate' => $id_candidate,
									'id_vacancy' => $id_vacancy
                                )
                            );
                        } else {
                            echo json_encode(array('status' => 2));
                        }
                    } else {
                        //valida los datyos restantes
                        echo json_encode(array('status' => 0));
                    }

                    //fin else


                }
            }else{
				 echo json_encode(array('status' => 0));
				
			}


            //fin de todo


        } else {
            echo json_encode(array('status' => 0));
        }
    }


    //6 oct

    function fill_modal()
    {
        if (Utils::isValid($_POST)) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {

                $candidateDirectoryObj = new CandidateDirectory();
                $candidateDirectoryObj->setId($id);
                $candidatedirectory = $candidateDirectoryObj->getOne();

                $vacancy = new Vacancy();
                $vacancy->setId($candidatedirectory->id_vacancy);
                $vacancy = $vacancy->getOne();

                $experience = new CandidateExperienceDirectory();
                $experience->setId_directory($id);
                $experience = $experience->getOneById_Directory();

                $education = new CandidateEducationDirectory();
                $education->setId_directory($id);
                $education = $education->getOneById_Directory();

                $candidatedirectory->id = Encryption::encode($candidatedirectory->id);

                $State = new State();
                $states = $State->getAll();

                $City = new City();
                $City->setId_state($candidatedirectory->id_state);
                $cities = $City->getCitiesByState();


                $subareas = new Subarea();
                $subareas->setId_area($candidatedirectory->id_area);
                $subareas = $subareas->getSubareasByArea();


                $curriculum = '';
                if (file_exists('uploads/resume_directory/' . $id . '.pdf')) {
                    $curriculum = '../uploads/resume_directory/' . $id . '.pdf';
                }



                $id_candidate = $candidatedirectory->id_candidate;

                $candidate = new Candidate();
                $candidate->setId($id_candidate);
                $candidate = $candidate->getOne();
                if ($candidate) {
                    if (file_exists('uploads/resume/' . $candidate->id . '/' . $candidate->id . '.pdf')) {
                        $curriculum = '../uploads/resume/' . $candidate->id . '/' . $candidate->id . '.pdf';
                    }
                    $candidate->id = Encryption::encode($candidate->id);
                }



                $postulado = new VacancyApplicant();
                $postulado->setId_candidate($id_candidate);
                $postulado = $postulado->getOneByIdCandidate();


                if ($candidatedirectory) {
                    echo json_encode(array('status' => 1, 'candidatedirectory' => $candidatedirectory, 'states' => $states, 'cities' => $cities, 'vacancy' => $vacancy, 'experience' => $experience, 'education' => $education, 'subareas' => $subareas, 'curriculum' => $curriculum, 'candidate' => $candidate, 'postulado' => $postulado));
                } else {
                    echo json_encode(array('status' => 0));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }
	
		
	
	
}