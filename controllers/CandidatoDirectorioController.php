<?php

require_once 'models/User.php';
require_once 'models/CandidateDirectory.php';
require_once 'models/CustomerContact.php';
require_once 'models/State.php';
require_once 'models/City.php';



class CandidatoDirectorioController
{

    public function index()
    {
        if (Utils::isAdmin()  || Utils::isSenior() || Utils::isJunior() || Utils::isRecruitmentManager() || Utils::isCustomer()) {
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
            $candidate['url_crear'] = base_url . 'candidato/crear&id=' . $candidate['id_vacancy'] . '&contact=' . $candidate['id'];

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
}
