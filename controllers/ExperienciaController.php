<?php

require_once 'models/Candidate.php';
require_once 'models/CandidateExperience.php';
require_once 'models/User.php';

class ExperienciaController
{

    public function crear()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            if (isset($_GET['id']) || Utils::isCandidate()) {
                if (Utils::isCandidate()) {
                    if (isset($_GET['id'])) {
                        header("location:" . base_url . "experiencia/crear");
                    }
                    $id_username = $_SESSION['identity']->id;
                    $candidate = new Candidate();
                    $candidate->setId_user($id_username);
                    $candidato = $candidate->getCandidateByUsername();
                    $id = $candidato->id;
                } else {
                    $id = Encryption::decode($_GET['id']);
                    $candidate = new Candidate();
                    $candidate->setId($id);
                    $candidato = $candidate->getOne();
                }

                $page_title = $candidato->first_name . ' ' . $candidato->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/experience.php';
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
                $experience = new CandidateExperience();
                $experience->setId($id);
                $experiencia = $experience->getOne();

                $page_title = $experiencia->first_name . ' ' . $experiencia->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/experience.php';
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
            $position = isset($_POST['position']) ? trim($_POST['position']) : FALSE;
            $enterprise = isset($_POST['enterprise']) ? trim($_POST['enterprise']) : FALSE;
            $id_area = isset($_POST['id_area']) ? trim($_POST['id_area']) : FALSE;
            $id_subarea = isset($_POST['id_subarea']) ? trim($_POST['id_subarea']) : FALSE;
            $id_state = isset($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $still_works = isset($_POST['still_works']) && $_POST['still_works'] == 'on' ? 1 : 0;
            $review = isset($_POST['review']) ? trim($_POST['review']) : FALSE;
            $activity1 = isset($_POST['activity1']) ? trim($_POST['activity1']) : FALSE;
            $activity2 = isset($_POST['activity2']) ? trim($_POST['activity2']) : FALSE;
            $activity3 = isset($_POST['activity3']) ? trim($_POST['activity3']) : FALSE;
            $activity4 = isset($_POST['activity4']) ? trim($_POST['activity4']) : FALSE;


            if ($id_candidate && $position && $enterprise && $id_area && $id_subarea && $id_state && $id_city && $start_date && $review && $activity1 && $activity2 && $activity3 && $activity4) {
                $exp = new CandidateExperience();
                $exp->setId_candidate($id_candidate);
                $exp->setPosition($position);
                $exp->setEnterprise($enterprise);
                $exp->setId_area($id_area);
                $exp->setId_subarea($id_subarea);
                $exp->setId_state($id_state);
                $exp->setId_city($id_city);
                $exp->setStart_date($start_date);
                $exp->setEnd_date($end_date);
                $exp->setStill_works($still_works);
                $exp->setReview($review);
                $exp->setActivity1($activity1);
                $exp->setActivity2($activity2);
                $exp->setActivity3($activity3);
                $exp->setActivity4($activity4);

                $update = $exp->save();
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

    public function update()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id']) ? trim(Encryption::decode($_POST['id'])) : FALSE;
            $position = isset($_POST['position']) ? trim($_POST['position']) : FALSE;
            $enterprise = isset($_POST['enterprise']) ? trim($_POST['enterprise']) : FALSE;
            $id_area = isset($_POST['id_area']) ? trim($_POST['id_area']) : FALSE;
            $id_subarea = isset($_POST['id_subarea']) ? trim($_POST['id_subarea']) : FALSE;
            $id_state = isset($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $still_works = isset($_POST['still_works']) && $_POST['still_works'] == 'on' ? 1 : 0;
            $review = isset($_POST['review']) ? trim($_POST['review']) : FALSE;
            $activity1 = isset($_POST['activity1']) ? trim($_POST['activity1']) : FALSE;
            $activity2 = isset($_POST['activity2']) ? trim($_POST['activity2']) : FALSE;
            $activity3 = isset($_POST['activity3']) ? trim($_POST['activity3']) : FALSE;
            $activity4 = isset($_POST['activity4']) ? trim($_POST['activity4']) : FALSE;

            if ($id && $position && $enterprise && $id_area && $id_subarea && $id_state && $id_city && $start_date && $review && $activity1 && $activity2 && $activity3 && $activity4) {
                $exp = new CandidateExperience();
                $exp->setId($id);
                $exp->setPosition($position);
                $exp->setEnterprise($enterprise);
                $exp->setId_area($id_area);
                $exp->setId_subarea($id_subarea);
                $exp->setId_state($id_state);
                $exp->setId_city($id_city);
                $exp->setStart_date($start_date);
                $exp->setEnd_date($end_date);
                $exp->setStill_works($still_works);
                $exp->setReview($review);
                $exp->setActivity1($activity1);
                $exp->setActivity2($activity2);
                $exp->setActivity3($activity3);
                $exp->setActivity4($activity4);

                $update = $exp->update();
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

    // ===[gabo 20 abril ver candidato]===
    public function getOne()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_experience']) ? trim(Encryption::decode($_POST['id_experience'])) : FALSE;

            if ($id) {
                $exp = new CandidateExperience();
                $exp->setId($id);

                $exp = $exp->getOne();

                require_once 'models/Area.php';
                $area = new Area();
                $areas = $area->getAll();


                require_once 'models/State.php';
                $state = new State();
                $states = $state->getAll();


                require_once 'models/City.php';
                $city = new City();
                $city->setId_state($exp->id_state);
                $cities = $city->getCitiesByState();



                require_once 'models/Area.php';
                $area = new Area();
                $areas = $area->getAll();


                require_once 'models/Subarea.php';
                $subarea = new Subarea();
                $subarea->setId_area($exp->id_area);
                $subareas = $subarea->getSubareasByArea();



                if ($exp) {
                    echo json_encode(array(
                        'exp' => $exp,
                        'areas' => $areas,
                        'states' => $states,
                        'cities' => $cities,
                        'subareas' => $subareas,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    // ===[GABO 21 ABRIL VER CANDIDATO ]===
    public function update_modal()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_experience']) ? trim(Encryption::decode($_POST['id_experience'])) : FALSE;
            $position = isset($_POST['position']) ? trim($_POST['position']) : FALSE;
            $enterprise = isset($_POST['enterprise']) ? trim($_POST['enterprise']) : FALSE;
            $id_area = isset($_POST['id_area']) ? trim($_POST['id_area']) : FALSE;
            $id_subarea = isset($_POST['id_subarea']) ? trim($_POST['id_subarea']) : FALSE;
            $id_state = isset($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $still_works = isset($_POST['still_works']) && $_POST['still_works'] == 'on' ? 1 : 0;
            $review = isset($_POST['review']) ? trim($_POST['review']) : FALSE;
            $activity1 = isset($_POST['activity1']) ? trim($_POST['activity1']) : FALSE;
            $activity2 = isset($_POST['activity2']) ? trim($_POST['activity2']) : FALSE;
            $activity3 = isset($_POST['activity3']) ? trim($_POST['activity3']) : FALSE;
            $activity4 = isset($_POST['activity4']) ? trim($_POST['activity4']) : FALSE;

            if ($id && $position && $enterprise && $id_area && $id_subarea && $id_state && $id_city && $start_date && $review && $activity1 && $activity2 && $activity3 && $activity4) {



                if ($still_works == 1) {
                    $end_date = '';
                }
                if (isset($start_date)) {
                    if ($start_date < '1950-01-01') {
                        echo json_encode(array('status' => 3));
                        die();
                    }
                    if (isset($end_date) and $end_date != '') {
                        if ($end_date < '1950-01-01') {
                            echo json_encode(array('status' => 4));
                            die();
                        }
                    }
                }

                $exp = new CandidateExperience();
                $exp->setId($id);
                $exp->setPosition($position);
                $exp->setEnterprise($enterprise);
                $exp->setId_area($id_area);
                $exp->setId_subarea($id_subarea);
                $exp->setId_state($id_state);
                $exp->setId_city($id_city);
                $exp->setStart_date($start_date);
                $exp->setEnd_date($end_date);
                $exp->setStill_works($still_works);
                $exp->setReview($review);
                $exp->setActivity1($activity1);
                $exp->setActivity2($activity2);
                $exp->setActivity3($activity3);
                $exp->setActivity4($activity4);
                $update = $exp->update();


                if ($update) {
                    $experience = $exp->getOne();
                    $id_candidate = $experience->id_candidate;
                    $exp->setId_candidate($id_candidate);
                    $experiencias = $exp->getExperiencesByCandidate($id_candidate);

                    for ($i = 0; $i < count($experiencias); $i++) {
                        $experiencias[$i]['id_experience'] = Encryption::encode($experiencias[$i]['id_experience']);
                        $experiencias[$i]['texto'] =    $experiencias[$i]['enterprise'] . ' | ' . $experiencias[$i]['city'] . ' - ' . $experiencias[$i]['state'] . ' | ' . strftime("%B %Y", strtotime($experiencias[$i]['start_date'])) . ' - ';
                        if ($experiencias[$i]['still_works'] == 1) {
                            $experiencias[$i]['texto'] .= 'Presente';
                        } else {
                            $experiencias[$i]['texto'] .= strftime("%B %Y", strtotime($experiencias[$i]['end_date']));
                        }
                    }

                    echo json_encode(array(
                        'experiencias' => $experiencias,
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
            $id_candidate = isset($_POST['id_candidate']) ? trim(Encryption::decode($_POST['id_candidate'])) : FALSE;
            $position = isset($_POST['position']) ? trim($_POST['position']) : FALSE;
            $enterprise = isset($_POST['enterprise']) ? trim($_POST['enterprise']) : FALSE;
            $id_area = isset($_POST['id_area']) ? trim($_POST['id_area']) : FALSE;
            $id_subarea = isset($_POST['id_subarea']) ? trim($_POST['id_subarea']) : FALSE;
            $id_state = isset($_POST['id_state']) ? trim($_POST['id_state']) : FALSE;
            $id_city = isset($_POST['id_city']) ? trim($_POST['id_city']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;
            $still_works = isset($_POST['still_works']) && $_POST['still_works'] == 'on' ? 1 : 0;
            $review = isset($_POST['review']) ? trim($_POST['review']) : FALSE;
            $activity1 = isset($_POST['activity1']) ? trim($_POST['activity1']) : FALSE;
            $activity2 = isset($_POST['activity2']) ? trim($_POST['activity2']) : FALSE;
            $activity3 = isset($_POST['activity3']) ? trim($_POST['activity3']) : FALSE;
            $activity4 = isset($_POST['activity4']) ? trim($_POST['activity4']) : FALSE;

            if ($id_candidate && $position && $enterprise && $id_area && $id_subarea && $id_state && $id_city && $start_date && $review && $activity1 && $activity2) {

                if ($still_works == 1) {
                    $end_date = '';
                }
                if (isset($start_date)) {
                    if ($start_date < '1950-01-01') {
                        echo json_encode(array('status' => 3));
                        die();
                    }
                    if (isset($end_date) and $end_date != '') {
                        if ($end_date < '1950-01-01') {
                            echo json_encode(array('status' => 4));
                            die();
                        }
                    }
                }

                $exp = new CandidateExperience();
                $exp->setId_candidate($id_candidate);
                $exp->setPosition($position);
                $exp->setEnterprise($enterprise);
                $exp->setId_area($id_area);
                $exp->setId_subarea($id_subarea);
                $exp->setId_state($id_state);
                $exp->setId_city($id_city);
                $exp->setStart_date($start_date);
                $exp->setEnd_date($end_date);
                $exp->setStill_works($still_works);
                $exp->setReview($review);
                $exp->setActivity1($activity1);
                $exp->setActivity2($activity2);
                $exp->setActivity3($activity3);
                $exp->setActivity4($activity4);
                $update = $exp->save();

                if ($update) {
                    $experiencias = $exp->getExperiencesByCandidate($id_candidate);
                    for ($i = 0; $i < count($experiencias); $i++) {
                        $experiencias[$i]['id_experience'] = Encryption::encode($experiencias[$i]['id_experience']);
                        $experiencias[$i]['texto'] =    $experiencias[$i]['enterprise'] . ' | ' . $experiencias[$i]['city'] . ' - ' . $experiencias[$i]['state'] . ' | ' . strftime("%B %Y", strtotime($experiencias[$i]['start_date'])) . ' - ';
                        if ($experiencias[$i]['still_works'] == 1) {
                            $experiencias[$i]['texto'] .= 'Presente';
                        } else {
                            $experiencias[$i]['texto'] .= strftime("%B %Y", strtotime($experiencias[$i]['end_date']));
                        }
                    }

                    echo json_encode(array(
                        'experiencias' => $experiencias,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    public function delete_experience()
    {

        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id_experience = isset($_POST['id_experience']) ? trim(Encryption::decode($_POST['id_experience'])) : FALSE;

            if ($id_experience) {
                $exp = new CandidateExperience();
                $exp->setId($id_experience);
                $experiencia = $exp->getOne();
                $delete = $exp->delete();

                if ($delete) {
                    $exp->setId_candidate($experiencia->id_candidate);
                    $experiencias = $exp->getExperiencesByCandidate();

                    for ($i = 0; $i < count($experiencias); $i++) {
                        $experiencias[$i]['id_experience'] = Encryption::encode($experiencias[$i]['id_experience']);
                        $experiencias[$i]['texto'] =    $experiencias[$i]['enterprise'] . ' | ' . $experiencias[$i]['city'] . ' - ' . $experiencias[$i]['state'] . ' | ' . strftime("%B %Y", strtotime($experiencias[$i]['start_date'])) . ' - ';
                        if ($experiencias[$i]['still_works'] == 1) {
                            $experiencias[$i]['texto'] .= 'Presente';
                        } else {
                            $experiencias[$i]['texto'] .= strftime("%B %Y", strtotime($experiencias[$i]['end_date']));
                        }
                    }

                    echo json_encode(array(
                        'experiencias' => $experiencias,
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
