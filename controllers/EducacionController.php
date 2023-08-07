<?php

require_once 'models/Candidate.php';
require_once 'models/CandidateEducation.php';
require_once 'models/User.php';

class EducacionController
{

    public function crear()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            if (isset($_GET['id']) || Utils::isCandidate()) {
                $id = Encryption::decode($_GET['id']);
                $candidate = new Candidate();
                $candidate->setId($id);
                $candidato = $candidate->getOne();

                if (isset($candidato->level)) {
                    header('location:' . base_url . 'educacion/editar&id=' . $_GET['id']);
                }

                $page_title = $candidato->first_name . ' ' . $candidato->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/education.php';
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
                $education = new CandidateEducation();
                $education->setId_candidate($id);
                $educacion = $education->getOne();

                $page_title = $educacion->first_name . ' ' . $educacion->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/education.php';
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
            $education_level = isset($_POST['education_level']) ? trim($_POST['education_level']) : FALSE;
            $institution = isset($_POST['institution']) ? trim($_POST['institution']) : FALSE;
            $title = isset($_POST['title']) ? trim($_POST['title']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $still_studies = isset($_POST['still_studies']) && $_POST['still_studies'] == 'on' ? 1 : 0;


            if ($id_candidate && $education_level && $institution && $title && $start_date) {
                $studies = new CandidateEducation();
                $studies->setId_candidate($id_candidate);
                $studies->setTitle($title);
                $studies->setInstitution($institution);
                $studies->setStart_date($start_date);
                $studies->setEnd_date($end_date);
                $studies->setStill_studies($still_studies);
                $studies->setId_level($education_level);

                $save = $studies->save();
                if ($save) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function update()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id_candidate = isset($_POST['id_candidate']) ? trim(Encryption::decode($_POST['id_candidate'])) : FALSE;
            $education_level = isset($_POST['education_level']) ? trim($_POST['education_level']) : FALSE;
            $institution = isset($_POST['institution']) ? trim($_POST['institution']) : FALSE;
            $title = isset($_POST['title']) ? trim($_POST['title']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $still_studies = isset($_POST['still_studies']) && $_POST['still_studies'] == 'on' ? 1 : 0;

            if ($id_candidate && $education_level && $institution && $title && $start_date) {
                $studies = new CandidateEducation();
                $studies->setId_candidate($id_candidate);
                $studies->setTitle($title);
                $studies->setInstitution($institution);
                $studies->setStart_date($start_date);
                $studies->setEnd_date($end_date);
                $studies->setStill_studies($still_studies);
                $studies->setId_level($education_level);
                //$studies->setId_document();

                $update = $studies->update();

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




    // ===[gabo 21 abril ver candidato]===

    public function getOne()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_candidate']) ? trim(Encryption::decode($_POST['id_candidate'])) : FALSE;

            if ($id) {
                $education = new CandidateEducation();
                $education->setId_candidate($id);
                $educacion = $education->getOne();
                $education_levels = Utils::showEducationLevels();

                if ($educacion) {
                    echo json_encode(array(
                        'education_levels' => $education_levels,
                        'educacion' => $educacion,
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
            $id_candidate = isset($_POST['id_candidate_education']) ? trim(Encryption::decode($_POST['id_candidate_education'])) : FALSE;
            $education_level = isset($_POST['education_level']) ? trim($_POST['education_level']) : FALSE;
            $institution = isset($_POST['institution']) ? trim($_POST['institution']) : FALSE;
            $title = isset($_POST['title']) ? trim($_POST['title']) : FALSE;
            $start_date = isset($_POST['start_date_education']) ? trim($_POST['start_date_education']) : FALSE;
            $end_date = isset($_POST['end_date_education']) ? trim($_POST['end_date_education']) : FALSE;
            $still_studies = isset($_POST['still_studies']) && $_POST['still_studies'] == 'on' ? 1 : 0;

            if ($id_candidate && $education_level && $institution && $title && $start_date) {
                $studies = new CandidateEducation();
                $studies->setId_candidate($id_candidate);
                $studies->setTitle($title);
                $studies->setInstitution($institution);
                $studies->setStart_date($start_date);
                $studies->setEnd_date($end_date);
                $studies->setStill_studies($still_studies);
                $studies->setId_level($education_level);
                $update = $studies->update();
                $educacion = $studies->getOne();

                $educacion->id_candidate = Encryption::encode($educacion->id_candidate);
                $educacion->texto = strftime("%Y", strtotime($educacion->start_date)) . ' - ' . $end_date = ($educacion->still_studies == 1) ? 'Presente' : strftime("%Y", strtotime($educacion->end_date));
                if ($update) {
                    echo json_encode(array(
                        'educacion' => $educacion,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
