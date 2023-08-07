<?php

require_once 'models/Candidate.php';
require_once 'models/CandidateLanguage.php';
require_once 'models/User.php';

class IdiomaController
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
                require_once 'views/candidate/language.php';
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
                $language = new CandidateLanguage();
                $language->setId($id);
                $idioma = $language->getOne();

                $page_title = $idioma->first_name . ' ' . $idioma->surname . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/language.php';
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
            $language = isset($_POST['language']) ? trim($_POST['language']) : FALSE;
            $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;
            $institution = isset($_POST['institution']) ? trim($_POST['institution']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;

            if ($id_candidate && $language && $institution && $start_date && $end_date) {
                $lan = new CandidateLanguage();
                $lan->setId_candidate($id_candidate);
                $lan->setId_language($language);
                $lan->setLevel($level);
                $lan->setInstitution($institution);
                $lan->setStart_date($start_date);
                $lan->setEnd_date($end_date);

                $save = $lan->save();
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
            $language = isset($_POST['language']) ? trim($_POST['language']) : FALSE;
            $level = isset($_POST['level']) ? trim($_POST['level']) : FALSE;
            $institution = isset($_POST['institution']) ? trim($_POST['institution']) : FALSE;
            $start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : FALSE;
            $end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : FALSE;

            if ($id && $language && $institution && $start_date && $end_date) {
                $lan = new CandidateLanguage();
                $lan->setId($id);
                $lan->setId_language($language);
                $lan->setLevel($level);
                $lan->setInstitution($institution);
                $lan->setStart_date($start_date);
                $lan->setEnd_date($end_date);

                $update = $lan->update();
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


    // ===[GABO 25 ABRIL VER CANDIDATO]===

    public function getOne()
    {


        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_language']) ? trim(Encryption::decode($_POST['id_language'])) : FALSE;

            if ($id) {
                $lan = new CandidateLanguage();
                $lan->setId($id);

                $language = $lan->getOneFull();

                if ($language) {
                    echo json_encode(array(
                        'language' => $language,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else {
            echo json_encode(array('status' => 0));
        }
    }


    public function update_modal()
    {

        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id = isset($_POST['id_language']) ? trim(Encryption::decode($_POST['id_language'])) : FALSE;
            $language = isset($_POST['language']) ? trim($_POST['language']) : FALSE;
            $level = isset($_POST['level_language']) ? trim($_POST['level_language']) : FALSE;
            $institution = isset($_POST['institution_language']) ? trim($_POST['institution_language']) : FALSE;
            $start_date = isset($_POST['start_date_language']) ? trim($_POST['start_date_language']) : FALSE;
            $end_date = isset($_POST['end_date_language']) ? trim($_POST['end_date_language']) : FALSE;

            if ($id && $language && $institution && $start_date && $end_date) {
                $lan = new CandidateLanguage();
                $lan->setId($id);
                $lan->setId_language($language);
                $lan->setLevel($level);
                $lan->setInstitution($institution);
                $lan->setStart_date($start_date);
                $lan->setEnd_date($end_date);

                $update = $lan->update();
                $language = $lan->getOneFull();
                $lan->setId_candidate($language->id_candidate);
                $languages = $lan->getLanguagesByCandidate();


                for ($i = 0; $i < count($languages); $i++) {
                    $languages[$i]['id'] = Encryption::encode($languages[$i]['id']);
                    $languages[$i]['texto'] =   date("Y", strtotime($languages[$i]['start_date'])) . ' - ' . date("Y", strtotime($languages[$i]['end_date']));
                }


                if ($update) {
                    echo json_encode(array(
                        'languages' => $languages,
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
            $id = isset($_POST['id_candidate_language']) ? trim(Encryption::decode($_POST['id_candidate_language'])) : FALSE;
            $language = isset($_POST['language']) ? trim($_POST['language']) : FALSE;
            $level = isset($_POST['level_language']) ? trim($_POST['level_language']) : FALSE;
            $institution = isset($_POST['institution_language']) ? trim($_POST['institution_language']) : FALSE;
            $start_date = isset($_POST['start_date_language']) ? trim($_POST['start_date_language']) : FALSE;
            $end_date = isset($_POST['end_date_language']) ? trim($_POST['end_date_language']) : FALSE;

            if ($id && $language && $institution && $start_date && $end_date) {
                $lan = new CandidateLanguage();
                $lan->setId_candidate($id);
                $lan->setId_language($language);
                $lan->setLevel($level);
                $lan->setInstitution($institution);
                $lan->setStart_date($start_date);
                $lan->setEnd_date($end_date);
                $existe = $lan->getLanguageByCandidateAndLanguage();

                if (!$existe) {
                    $save = $lan->save();
                    $lan->setId_candidate($id);
                    $languages = $lan->getLanguagesByCandidate();

                    for ($i = 0; $i < count($languages); $i++) {
                        $languages[$i]['id'] = Encryption::encode($languages[$i]['id']);
                        $languages[$i]['texto'] =   date("Y", strtotime($languages[$i]['start_date'])) . ' - ' . date("Y", strtotime($languages[$i]['end_date']));
                    }

                    if ($save) {
                        echo json_encode(array(
                            'languages' => $languages,
                            'status' => 1
                        ));
                    } else
                        echo json_encode(array('status' => 2));
                } else
                    echo json_encode(array('status' => 3));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function delete_language()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer()) {
            $id_language = isset($_POST['id_language']) ? trim(Encryption::decode($_POST['id_language'])) : FALSE;

            if ($id_language) {
                $lan = new CandidateLanguage();
                $lan->setId($id_language);
                $language = $lan->getOneFull();
                $delete = $lan->delete();

                if ($delete) {
                    $lan->setId_candidate($language->id_candidate);
                    $languages = $lan->getLanguagesByCandidate();

                    for ($i = 0; $i < count($languages); $i++) {
                        $languages[$i]['id'] = Encryption::encode($languages[$i]['id']);
                        $languages[$i]['texto'] =   date("Y", strtotime($languages[$i]['start_date'])) . ' - ' . date("Y", strtotime($languages[$i]['end_date']));
                    }

                    echo json_encode(array(
                        'languages' => $languages,
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
