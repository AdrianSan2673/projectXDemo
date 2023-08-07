<?php

require_once 'models/Candidate.php';
require_once 'models/CandidateEducation.php';
require_once 'models/CandidateAdditionalPreparation.php';
require_once 'models/CandidateExperience.php';
require_once 'models/CandidateLanguage.php';
require_once 'models/CandidateAptitude.php';
require_once 'models/User.php';

class AptitudController
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
                require_once 'views/candidate/aptitude.php';
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
                $aptitude = new CandidateAptitude();
                $aptitude->setId($id);
                $aptitud = $aptitude->getOne();

                $page_title = $aptitud->first_name . ' ' . $aptitud->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/aptitude.php';
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
            $aptitude = isset($_POST['aptitude']) ? trim($_POST['aptitude']) : FALSE;
            $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;
            if ($id_candidate && $aptitude && $level) {
                $apt = new CandidateAptitude();
                $apt->setId_candidate($id_candidate);
                $apt->setAptitude($aptitude);
                $apt->setLevel($level);


                $save = $apt->save();
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
            $aptitude = isset($_POST['aptitude']) ? trim($_POST['aptitude']) : FALSE;
            $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;

            if ($id && $aptitude && $level) {
                $apt = new CandidateAptitude();
                $apt->setId($id);
                $apt->setAptitude($aptitude);
                $apt->setLevel($level);


                $update = $apt->update();
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




    // ===[GABO 26 ABRIL  VER CANDIDATO]====

    public function getOne()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_aptitude']) ? trim(Encryption::decode($_POST['id_aptitude'])) : FALSE;

            if ($id) {
                $apt = new CandidateAptitude();
                $apt->setId($id);

                $aptitude = $apt->getOne();

                if ($aptitude) {
                    echo json_encode(array(
                        'aptitude' => $aptitude,
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
            $id = isset($_POST['id_aptitude']) ? trim(Encryption::decode($_POST['id_aptitude'])) : FALSE;
            $aptitude = isset($_POST['aptitude']) ? trim($_POST['aptitude']) : FALSE;
            $level = isset($_POST['level_aptitude']) ? trim($_POST['level_aptitude']) : FALSE;

            if ($id && $aptitude && $level) {
                $apt = new CandidateAptitude();
                $apt->setId($id);
                $apt->setAptitude($aptitude);
                $apt->setLevel($level);

                $update = $apt->update();
                $aptitude = $apt->getOne();
                $apt->setId_candidate($aptitude->id_candidate);
                $aptitudes = $apt->getAptitudesByCandidate();

                for ($i = 0; $i < count($aptitudes); $i++) {
                    $aptitudes[$i]['id'] = Encryption::encode($aptitudes[$i]['id']);
                }

                if ($update) {
                    echo json_encode(array(
                        'aptitudes' => $aptitudes,
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
            $id_candidate = isset($_POST['id_candidate_aptitude']) ? trim(Encryption::decode($_POST['id_candidate_aptitude'])) : FALSE;
            $aptitude = isset($_POST['aptitude']) ? trim($_POST['aptitude']) : FALSE;
            $level = isset($_POST['level_aptitude']) ? trim($_POST['level_aptitude']) : FALSE;

            if ($id_candidate && $aptitude && $level) {
                $apt = new CandidateAptitude();
                $apt->setId_candidate($id_candidate);
                $apt->setAptitude($aptitude);
                $apt->setLevel($level);

                $save = $apt->save();
                $apt->setId_candidate($id_candidate);
                $aptitudes = $apt->getAptitudesByCandidate();

                for ($i = 0; $i < count($aptitudes); $i++) {
                    $aptitudes[$i]['id'] = Encryption::encode($aptitudes[$i]['id']);
                }

                if ($save) {
                    echo json_encode(array(
                        'aptitudes' => $aptitudes,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function delete_aptitude()
    {

        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id_aptitude = isset($_POST['id_aptitude']) ? trim(Encryption::decode($_POST['id_aptitude'])) : FALSE;

            if ($id_aptitude) {
                $apt = new CandidateAptitude();
                $apt->setId($id_aptitude);
                $aptitude = $apt->getOne();

                $delete = $apt->delete();

                if ($delete) {
                    $apt->setId_candidate($aptitude->id_candidate);
                    $aptitudes = $apt->getAptitudesByCandidate();

                    for ($i = 0; $i < count($aptitudes); $i++) {
                        $aptitudes[$i]['id'] = Encryption::encode($aptitudes[$i]['id']);
                    }

                    echo json_encode(array(
                        'aptitudes' => $aptitudes,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    // ===[FIN]====

}
