<?php

require_once 'models/Candidate.php';
require_once 'models/CandidateAdditionalPreparation.php';
require_once 'models/User.php';

class FormacionController
{

    public function crear()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            if (isset($_GET['id']) || Utils::isCandidate()) {
                $id = Encryption::decode($_GET['id']);
                $candidate = new Candidate();
                $candidate->setId($id);
                $candidato = $candidate->getOne();

                $page_title = $candidato->first_name . ' ' . $candidato->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/preparation.php';
                require_once 'views/layout/footer.php';
            } else {
                header("location:" . base_url . "candidato/index");
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function editar()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            if (isset($_GET['id']) || Utils::isCandidate()) {
                $id = Encryption::decode($_GET['id']);
                $preparation = new CandidateAdditionalPreparation();
                $preparation->setId($id);
                $formacion = $preparation->getOne();

                $page_title = $formacion->first_name . ' ' . $formacion->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/preparation.php';
                require_once 'views/layout/footer.php';
            } else {
                header("location:" . base_url . "candidato/index");
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function create()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id_candidate = isset($_POST['id_candidate']) ? trim(Encryption::decode($_POST['id_candidate'])) : FALSE;
            $course = isset($_POST['course']) ? trim($_POST['course']) : FALSE;
            $institution = isset($_POST['institution']) ? trim($_POST['institution']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;

            if ($id_candidate && $course && $institution && $start_date && $end_date && $level) {
                $cap = new CandidateAdditionalPreparation();
                $cap->setId_candidate($id_candidate);
                $cap->setCourse($course);
                $cap->setInstitution($institution);
                $cap->setStart_date($start_date);
                $cap->setEnd_date($end_date);
                $cap->setId_level($level);

                $save = $cap->save();
                if ($save) {
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

    public function update()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $course = isset($_POST['course']) ? trim($_POST['course']) : FALSE;
            $institution = isset($_POST['institution']) ? trim($_POST['institution']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;

            if ($id && $course && $institution && $start_date && $end_date && $level) {
                $cap = new CandidateAdditionalPreparation();
                $cap->setId($id);
                $cap->setCourse($course);
                $cap->setInstitution($institution);
                $cap->setStart_date($start_date);
                $cap->setEnd_date($end_date);
                $cap->setId_level($level);

                $update = $cap->update();
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



    // === [gabo 24 abril ver candidato] === 

    public function getOne()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_preparation']) ? trim(Encryption::decode($_POST['id_preparation'])) : FALSE;

            if ($id) {
                $cap = new CandidateAdditionalPreparation();
                $cap->setId($id);

                $preparation = $cap->getOne();

                if ($preparation) {
                    echo json_encode(array(
                        'preparation' => $preparation,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function update_modal()
    {

        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_preparation']) ? trim(Encryption::decode($_POST['id_preparation'])) : FALSE;
            $course = isset($_POST['course']) ? trim($_POST['course']) : FALSE;
            $institution = isset($_POST['institution_preparation']) ? trim($_POST['institution_preparation']) : FALSE;
            $start_date = isset($_POST['start_date_preparation']) ? trim($_POST['start_date_preparation']) : FALSE;
            $end_date = isset($_POST['end_date_preparation']) ? trim($_POST['end_date_preparation']) : FALSE;
            $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;

            if ($id && $course && $institution && $start_date && $end_date && $level) {
                $cap = new CandidateAdditionalPreparation();
                $cap->setId($id);
                $cap->setCourse($course);
                $cap->setInstitution($institution);
                $cap->setStart_date($start_date);
                $cap->setEnd_date($end_date);
                $cap->setId_level($level);

                $update = $cap->update();
                $preparation = $cap->getOne();
                $cap->setId_candidate($preparation->id_candidate);
                $preparations = $cap->getAdditionalPreparationsByCandidate();

                for ($i = 0; $i < count($preparations); $i++) {
                    $preparations[$i]['id'] =    Encryption::encode($preparations[$i]['id']);
                    $preparations[$i]['start_date'] =    date("Y", strtotime($preparations[$i]['start_date']));
                    $preparations[$i]['end_date'] =    date("Y", strtotime($preparations[$i]['end_date']));
                }

                if ($update) {
                    echo json_encode(array(
                        'preparations' => $preparations,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function create_modal()
    {

        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id_candidate = isset($_POST['id_candidate_preparation']) ? trim(Encryption::decode($_POST['id_candidate_preparation'])) : FALSE;
            $course = isset($_POST['course']) ? trim($_POST['course']) : FALSE;
            $institution = isset($_POST['institution_preparation']) ? trim($_POST['institution_preparation']) : FALSE;
            $start_date = isset($_POST['start_date_preparation']) ? trim($_POST['start_date_preparation']) : FALSE;
            $end_date = isset($_POST['end_date_preparation']) ? trim($_POST['end_date_preparation']) : FALSE;
            $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;

            if ($id_candidate && $course && $institution && $start_date && $end_date && $level) {
                $cap = new CandidateAdditionalPreparation();
                $cap->setId_candidate($id_candidate);
                $cap->setCourse($course);
                $cap->setInstitution($institution);
                $cap->setStart_date($start_date);
                $cap->setEnd_date($end_date);
                $cap->setId_level($level);

                $save = $cap->save();

                $preparations = $cap->getAdditionalPreparationsByCandidate();

                for ($i = 0; $i < count($preparations); $i++) {
                    $preparations[$i]['id'] =    Encryption::encode($preparations[$i]['id']);
                    $preparations[$i]['start_date'] =    date("Y", strtotime($preparations[$i]['start_date']));
                    $preparations[$i]['end_date'] =    date("Y", strtotime($preparations[$i]['end_date']));
                }

                if ($save) {
                    echo json_encode(array(
                        'preparations' => $preparations,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function delete_preparation()
    {

        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id_experience = isset($_POST['id_preparation']) ? trim(Encryption::decode($_POST['id_preparation'])) : FALSE;

            if ($id_experience) {
                $prep = new CandidateAdditionalPreparation();
                $prep->setId($id_experience);
                $preparation = $prep->getOne();
                $delete = $prep->delete();

                if ($delete) {
                    $prep->setId_candidate($preparation->id_candidate);

                    $preparations = $prep->getAdditionalPreparationsByCandidate();

                    for ($i = 0; $i < count($preparations); $i++) {
                        $preparations[$i]['id'] =    Encryption::encode($preparations[$i]['id']);
                        $preparations[$i]['start_date'] =    date("Y", strtotime($preparations[$i]['start_date']));
                        $preparations[$i]['end_date'] =    date("Y", strtotime($preparations[$i]['end_date']));
                    }

                    echo json_encode(array(
                        'preparations' => $preparations,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
    // ===[FIN]===
}
