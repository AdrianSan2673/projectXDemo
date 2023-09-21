<?php

require_once 'models/Vacancy.php';
require_once 'models/Candidate.php';
require_once 'models/VacancyApplicant.php';
require_once 'models/User.php';
require_once 'models/ExecutiveJRRecruiter.php';
//gabo eliminar
require_once 'models/ApplicantProfile.php';
class PostulacionesController
{
    public function index()
    {
        if (isset($_SESSION['identity']) && $_SESSION['identity'] != FALSE) {
            $applicant = new VacancyApplicant();
            $applicants = $applicant->getAll();

            $total = $applicant->getTotal();
            for ($i = 0; $i < count($applicants); $i++) {
                $path = 'uploads/candidate/' . $applicants[$i]['id'];
                if (file_exists($path)) {
                    $directory = opendir($path);

                    while ($file = readdir($directory)) {
                        if (!is_dir($file)) {
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path . "/" . $file);
                            $route = $path . '/' . $file;
                        }
                    }
                } else {
                    if ($applicants[$i]['id_gender'] != 2) {
                        $route = "dist/img/user-icon.png";
                    } else {
                        $route = "dist/img/user-icon-rose.png";
                    }

                    $type = pathinfo($route, PATHINFO_EXTENSION);
                    $img_content = file_get_contents($route);
                }
                //$img_base64 = chunk_split(base64_encode($img_content));

                /*$img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);*/
                $applicants[$i]['avatar'] = base_url . $route;

                $resumepath = 'uploads/resume/' . $applicants[$i]['id'];
                if (file_exists($resumepath)) {
                    $resumedirectory = opendir($resumepath);
                    while ($cv = readdir($resumedirectory)) {
                        if (!is_dir($cv)) {
                            $cvtype = pathinfo($resumepath, PATHINFO_EXTENSION);
                            $cvroute = $resumepath . '/' . $cv;
                        }
                    }
                    $applicants[$i]['resume'] = base_url . $cvroute;
                }
            }
            $page_title = 'Todas las postulaciones | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/applicant/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function buscar()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacante = $vacancy->getOne();
                $vacancy->setId_area($vacante->id_area);

                $candidate = new Candidate();
                if (isset($_GET['area'])) {
                    $candidates = $candidate->getCandidatesByArea($vacancy);
                } else {
                    $candidates = $candidate->getCandidatesByVacancy($vacancy);
                }
                $total = $candidate->getTotal();

                $lbl_candidates = 'Búsqueda de candidatos';
                $lbl_n_candidates = 'Total de candidatos de acuerdos a filtros';

                $page_title = $vacante->vacancy . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/index_postular.php';

                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'vacante/index');
            }
        } else {
            header('location:' . base_url);
        }
    }


    public function postulate_multiple()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST['postulate']) && isset($_POST['id_vacancy'])) {
            $id_vacancy = $_POST['id_vacancy'];
            $postulate = json_decode($_POST['postulate']);

            if (count($postulate) > 0) {
                $vacancy = new Vacancy();
                $vacancy->setId($id_vacancy);
                $vacante = $vacancy->getOne();

                $recruiter = $vacante->id_recruiter;

                $postulado = "";
                foreach ($postulate as $p) {
                    $applicant = new VacancyApplicant();
                    $applicant->setId_vacancy($id_vacancy);
                    $applicant->setId_candidate(Encryption::decode($p));
                    if ($applicant->create()) {
                        $applicant->setId_status(3);
                        $applicant->setCustomer_date(true);
                        $applicant->updateStatus();
                        $cdto = new Candidate();
                        $cdto->setId(Encryption::decode($p));
                        $candidate = $cdto->getOne();
                        $postulado .= "  * " . $candidate->first_name . " " . $candidate->surname . " " . $candidate->last_name . "<br>";
                    }
                }

                $subject = count($postulate) > 1 ? 'Nuevas postulaciones ' : 'Nueva postulación ';
                $subject .= 'para ' . $vacante->vacancy;

                $body = count($postulate) > 1 ? 'Se han postulado los siguientes candidatos ' : 'Se ha postulado el siguiente candidato ';

                $body .= "a la vacante de <b>" . $vacante->vacancy . "</b> perteneciente al cliente <b>" . $vacante->customer . "</b>:<br><br>" . $postulado;

                if ($recruiter) {
                    $user = new User();
                    $user->setId($recruiter);
                    $executive = $user->getOne();

                    Utils::sendEmail($executive->email, $executive->first_name . ' ' . $executive->last_name, $subject, $body);

                    $exe = new ExecutiveJRRecruiter();
                    $exe->setId_recruiter($executive->id);
                    $executiveJR = $exe->getExecutiveJRByRecruiter();

                    if ($executiveJR) {
                        Utils::sendEmail($executiveJR->email, $executiveJR->first_name . ' ' . $executiveJR->last_name, $subject, $body);
                    }
                }
                //Utils::sendEmail('ernesto.rivas@rrhhingenia.com', 'Ernesto Rivas', $subject, $body);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url . "vacante/index");
        }
    }

    public function postulate()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_GET['id_candidate']) && isset($_GET['id_vacancy'])) {
            $id_vacancy = Encryption::decode($_GET['id_vacancy']);
            $id_candidate = Encryption::decode($_GET['id_candidate']);

            if (Utils::isCandidate()) {
                $id_vacancy = ($id_vacancy);
                $candidate = new Candidate();
                $candidate->setId_user($id_candidate);
                $candidato = $candidate->getCandidateByUsername();
                $id_candidate = $candidato->id;
            }

            $applicant = new VacancyApplicant();
            $applicant->setId_vacancy($id_vacancy);
            $applicant->setId_candidate($id_candidate);

            $vacancy = new Vacancy();
            $vacancy->setId($id_vacancy);
            $vacante = $vacancy->getOne();

            $recruiter = $vacante->id_recruiter;

            $cdto = new Candidate();
            $cdto->setId($id_candidate);
            $postulado = $cdto->getOne();

            if ($applicant->getTotal() == 0) {
                $applicant->create();

                $subject = 'Nueva postulación para ' . $vacante->vacancy;

                $body = "Se ha postulado el candidato <b>{$postulado->first_name} {$postulado->surname}  {$postulado->last_name}</b> a la vacante de <b>{$vacante->vacancy}</b> perteneciente al cliente <b>{$vacante->customer}</b>";
                if ($recruiter) {
                    $user = new User();
                    $user->setId($recruiter);
                    $executive = $user->getOne();

                    Utils::sendEmail($executive->email, $executive->first_name . ' ' . $executive->last_name, $subject, $body);

                    $exe = new ExecutiveJRRecruiter();
                    $exe->setId_recruiter($executive->id);
                    $executiveJR = $exe->getExecutiveJRByRecruiter();

                    if ($executiveJR) {
                        Utils::sendEmail($executiveJR->email, $executiveJR->first_name . ' ' . $executiveJR->last_name, $subject, $body);
                    }
                }
            } else {
                $applicant->delete();

                $subject = 'Postulación eliminada de ' . $vacante->vacancy;

                $body = "Se ha eliminado la postulación del candidato <b>{$postulado->first_name} {$postulado->surname} {$postulado->last_name}</b> a la vacante de <b>{$vacante->vacancy}</b> perteneciente al cliente <b>{$vacante->customer}</b>";
                if ($recruiter) {
                    $user = new User();
                    $user->setId($recruiter);
                    $executive = $user->getOne();

                    Utils::sendEmail($executive->email, $executive->first_name . ' ' . $executive->last_name, $subject, $body);

                    $exe = new ExecutiveJRRecruiter();
                    $exe->setId_recruiter($executive->id);
                    $executiveJR = $exe->getExecutiveJRByRecruiter();

                    if ($executiveJR) {
                        Utils::sendEmail($executiveJR->email, $executiveJR->first_name . ' ' . $executiveJR->last_name, $subject, $body);
                    }
                }
            }
            if (Utils::isCandidate()) {
                header("location:" . base_url . "bolsa/ver&vacante=" . $_GET['id_vacancy']);
            } else {
                if (isset($_GET['id_area'])) {
                    header("location:" . base_url . "postulaciones/buscar&id=" . $_GET['id_vacancy'] . "&area=" . $_GET['id_area']);
                } else {
                    //header("location:".base_url."postulaciones/buscar&id=".$_GET['id_vacancy']);
                    header('Location:' . getenv('HTTP_REFERER'));
                }
            }
        } else {
            header("location:" . base_url . "vacante/index");
        }
    }

    public function send_to_sr()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_GET['id_candidate']) && isset($_GET['id_vacancy'])) {
            $id_vacancy = Encryption::decode($_GET['id_vacancy']);
            $id_candidate = Encryption::decode($_GET['id_candidate']);
            $id_status = $_GET['id_status'];

            $applicant = new VacancyApplicant();
            $applicant->setId_vacancy($id_vacancy);
            $applicant->setId_candidate($id_candidate);

            if ($id_status == 1) {
                $applicant->setId_status(2);
                $applicant->setRecruiter_date(true);
            } elseif ($id_status == 2) {
                $applicant->setId_status(1);
            }
            $applicant->updateStatus();

            header('Location:' . getenv('HTTP_REFERER'));
            //header("location:".base_url."postulaciones/ver&id=".Encryption::encode($id_vacancy));

        } else {
            header("location:" . base_url . "vacante/index");
        }
    }

    public function discard()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_GET['id_candidate']) && isset($_GET['id_vacancy'])) {
            $id_vacancy = Encryption::decode($_GET['id_vacancy']);
            $id_candidate = Encryption::decode($_GET['id_candidate']);
            $id_status = $_GET['id_status'];

            $applicant = new VacancyApplicant();
            $applicant->setId_vacancy($id_vacancy);
            $applicant->setId_candidate($id_candidate);

            if ($id_status == 1 || $id_status == 5) {
                $applicant->setId_status(6);
            } elseif ($id_status == 6) {
                $applicant->setId_status(5);
            }
            $applicant->updateStatus();

            header('Location:' . getenv('HTTP_REFERER'));
            //header("location:".base_url."postulaciones/ver&id=".Encryption::encode($id_vacancy));

        } else {
            header("location:" . base_url . "vacante/index");
        }
    }

    public function send_to_customer()
    {


        if (Utils::isValid($_SESSION['identity']) && isset($_GET['id_candidate']) && isset($_GET['id_vacancy'])) {
            $id_vacancy = Encryption::decode($_GET['id_vacancy']);
            $id_candidate = Encryption::decode($_GET['id_candidate']);
            $id_status = $_GET['id_status'];

            $applicant = new VacancyApplicant();
            $applicant->setId_vacancy($id_vacancy);
            $applicant->setId_candidate($id_candidate);

            if ($id_status <= 2 || $id_status == 5) {
                $applicant->setId_status(3);
                $applicant->setCustomer_date(true);
            } elseif ($id_status == 3) {
                $applicant->setId_status(5);
            }
            $applicant->updateStatus();

            header('Location:' . getenv('HTTP_REFERER'));
            //header("location:".base_url."postulaciones/enviados_a_reclutador&id=".Encryption::encode($id_vacancy));

        } else {
            header("location:" . base_url . "vacante/index");
        }
    }

    public function enviados_a_reclutador()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacante = $vacancy->getOne();

                $candidate = new Candidate();
                $candidates = $candidate->getCandidatesByApplicationStatus($vacancy, 2);
                $total = $candidate->getTotal();


                $c = new Candidate();
                for ($i = 0; $i < count($candidates); $i++) {


                    $candidates[$i]['area'] = "";
                    $candidates[$i]['subarea'] = "";
                    $candidates[$i]['language'] = "";

                    $c->setId($candidates[$i]['id']);
                    $language = $c->getLanguageFromCandidate();
                    if ($language) {
                        $candidates[$i]['language'] = $language->language;
                        if ($candidates[$i]['language'] == "") {
                            $candidates[$i]['language'] = "-";
                        }
                    } else {
                        $candidates[$i]['language'] = "-";
                    }


                    $area = $c->getAreasYSubareasFromCandidate();

                    if ($area) {
                        $candidates[$i]['area'] = $area->area;
                        $candidates[$i]['subarea'] = $area->subarea;
                    } else {
                        $candidates[$i]['area'] = "-";
                        $candidates[$i]['subarea'] = "-";
                    }

                    $path = 'uploads/candidate/' . $candidates[$i]['id'];
                    if (file_exists($path)) {
                        $directory = opendir($path);

                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $img_content = file_get_contents($path . "/" . $file);
                                $route = $path . '/' . $file;
                            }
                        }
                    } else {
                        if ($candidates[$i]['id_gender'] != 2) {
                            $route = "dist/img/user-icon.png";
                        } else {
                            $route = "dist/img/user-icon-rose.png";
                        }
                        $type = pathinfo($route, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($route);
                    }
                    //$img_base64 = chunk_split(base64_encode($img_content));

                    /*$img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);*/
                    $candidates[$i]['avatar'] = base_url . $route;

                    $resumepath = 'uploads/resume/' . $candidates[$i]['id'];
                    if (file_exists($resumepath)) {
                        $resumedirectory = opendir($resumepath);
                        while ($cv = readdir($resumedirectory)) {
                            if (!is_dir($cv)) {
                                $cvtype = pathinfo($resumepath, PATHINFO_EXTENSION);
                                $cvroute = $resumepath . '/' . $cv;
                            }
                        }
                        $candidates[$i]['resume'] = base_url . $cvroute;
                    }
                }

                $lbl_candidates = 'Candidatos enviados por ej. de búsqueda';
                $lbl_n_candidates = 'Total de candidatos enviados a ej. reclutador';
                $page_title = $vacante->vacancy . ' | RRHH Ingenia';

                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/candidate/enviados_a_reclutador.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'vacante/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function choose_for_vacancy()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST['id_candidate']) && isset($_POST['id_vacancy']) && isset($_POST['id_status'])) {
            $id_vacancy = Encryption::decode($_POST['id_vacancy']);
            $id_candidate = Encryption::decode($_POST['id_candidate']);
            $id_status = $_POST['id_status'];
            $entry_date = isset($_POST['entry_date']) && !empty($_POST['entry_date']) ? $_POST['entry_date'] : NULL;
            $amount = Utils::sanitizeString($_POST['amount']);

            $applicant = new VacancyApplicant();
            $applicant->setId_vacancy($id_vacancy);
            $applicant->setId_candidate($id_candidate);
            $applicant->setEntry_date($entry_date);
            $applicant->setAmount($amount);

            if ($id_status == 3) {
                $applicant->setId_status(4);
            } elseif ($id_status == 4) {
                $applicant->setId_status(3);
            }
            $applicant->updateStatus();

            header('Location:' . getenv('HTTP_REFERER'));
            //header("location:".base_url."postulaciones/enviados_a_cliente&id=".Encryption::encode($id_vacancy));

        } else {
            header("location:" . base_url . "vacante/index");
        }
    }

    public function add_videocall_link()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST['id_candidate']) && isset($_POST['id_vacancy']) && isset($_POST['id_status'])) {
            $id_vacancy = Encryption::decode($_POST['id_vacancy']);
            $id_candidate = Encryption::decode($_POST['id_candidate']);
            $video_call_url = $_POST['video_call_url'];

            $applicant = new VacancyApplicant();
            $applicant->setId_vacancy($id_vacancy);
            $applicant->setId_candidate($id_candidate);
            $applicant->setVideo_call_url($video_call_url);
            $applicant->updateVideoCallURL();

            header('Location:' . getenv('HTTP_REFERER'));
            //header("location:".base_url."postulaciones/enviados_a_cliente&id=".Encryption::encode($id_vacancy));

        } else {
            header("location:" . base_url . "vacante/index");
        }
    }

    public function ver()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacante = $vacancy->getOne();

                $candidate = new Candidate();
                //$candidates = $candidate->getCandidatesByApplicationStatus($vacancy, 1);
                $candidates = $candidate->getCandidatesByApplication($vacancy);
                $total = $candidate->getTotal();

                for ($i = 0; $i < count($candidates); $i++) {
                    $path = 'uploads/candidate/' . $candidates[$i]['id'];
                    if (file_exists($path)) {
                        $directory = opendir($path);

                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $img_content = file_get_contents($path . "/" . $file);
                                $route = $path . '/' . $file;
                            }
                        }
                    } else {
                        if ($candidates[$i]['id_gender'] != 2) {
                            $route = "dist/img/user-icon.png";
                        } else {
                            $route = "dist/img/user-icon-rose.png";
                        }
                        $type = pathinfo($route, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($route);
                    }
                    //$img_base64 = chunk_split(base64_encode($img_content));

                    /*$img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);*/
                    $candidates[$i]['avatar'] = base_url . $route;
                }

                $lbl_candidates = 'Candidatos postulados';
                $lbl_n_candidates = 'Total de candidatos postulados';
                $page_title = $vacante->vacancy . ' | RRHH Ingenia';

                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/applicant/candidates.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'vacante/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function enviados_a_cliente()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            if (isset($_GET['id'])) {
                $id = Encryption::decode($_GET['id']);
                $vacancy = new Vacancy();
                $vacancy->setId($id);
                $vacante = $vacancy->getOne();


                if (!$vacante) {
                    header("location:" . base_url . "vacante/index");
                }

                $candidate = new Candidate();

                //gabo act 
                if (Utils::isSenior() || Utils::isRecruitmentManager() || Utils::isAdmin()) {
                    $candidates = $candidate->getCandidatesByApplicationStatus2($vacancy, 3);
                } else {
                    $candidates = $candidate->getCandidatesByApplicationStatus($vacancy, 3);
                }


                $total = $candidate->getTotal();
                for ($i = 0; $i < count($candidates); $i++) {
                    $path = 'uploads/candidate/' . $candidates[$i]['id'];
                    if (file_exists($path)) {
                        $directory = opendir($path);

                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $img_content = file_get_contents($path . "/" . $file);
                                $route = $path . '/' . $file;
                            }
                        }
                    } else {
                        if ($candidates[$i]['id_gender'] != 2) {
                            $route = "dist/img/user-icon.png";
                        } else {
                            $route = "dist/img/user-icon-rose.png";
                        }
                        $type = pathinfo($route, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($route);
                    }
                    //$img_base64 = chunk_split(base64_encode($img_content));
                    /*$img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);*/
                    $candidates[$i]['avatar'] = base_url . $route;

                    $resumepath = 'uploads/resume/' . $candidates[$i]['id'];
                    if (file_exists($resumepath)) {
                        $resumedirectory = opendir($resumepath);
                        while ($cv = readdir($resumedirectory)) {
                            if (!is_dir($cv)) {
                                $cvtype = pathinfo($resumepath, PATHINFO_EXTENSION);
                                $cvroute = $resumepath . '/' . $cv;
                            }
                        }
                        $candidates[$i]['resume'] = base_url . $cvroute;
                    }
                }

                $page_title = $vacante->vacancy . ' | RRHH Ingenia';

                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/applicant/selected.php';
                // ===[gabo 2 junio modal-experiencia]=== 
                require_once 'views/applicant/modal-experiencia.php';
                // ===[gabo 2 junio modal-experiencia fin]===
                require_once 'views/applicant/modal-eliminar-postulante.php';
                require_once 'views/applicant/modal-reactivar-postulante.php';
                require_once 'views/applicant/modal-descartar-postulante.php';
                require_once 'views/applicant/modal-mover-postulante.php';
                require_once 'views/applicant/modal-perfil-postulante.php';


                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'vacante/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function descripcion_candidato()
    {
        if (Utils::isValid($_SESSION['identity'])) {
            if (isset($_GET['id_vacancy']) && isset($_GET['id_candidate'])) {
                $id_vacancy = Encryption::decode($_GET['id_vacancy']);
                $id_candidate = Encryption::decode($_GET['id_candidate']);

                $va = new VacancyApplicant();
                $va->setId_vacancy($id_vacancy);
                $va->setId_candidate($id_candidate);
                $postulacion = $va->getOne();

                if (!$postulacion) {
                    header("location:" . base_url . "vacante/index");
                }

                $page_title = 'Descripción de ' . $postulacion->first_name . ' ' . $postulacion->surname . ' | RRHH Ingenia';

                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/applicant/description.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'vacante/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function description()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST['id_candidate']) && isset($_POST['id_vacancy'])) {
            $id_vacancy = $_POST['id_vacancy'];
            $id_candidate = $_POST['id_candidate'];
            $about = $_POST['about'];
            $id_status = $_POST['id_status'];
            $video_call_url = $_POST['video_call_url'];

            $applicant = new VacancyApplicant();
            $applicant->setId_vacancy($id_vacancy);
            $applicant->setId_candidate($id_candidate);
            $applicant->setId_status($id_status);
            $applicant->setAbout($about);
            $applicant->setVideo_call_url($video_call_url);
            $save = $applicant->updateDescription();

            if ($save) {
                $vacancy = new Vacancy();
                $vacancy->setId($id_vacancy);
                $vacante = $vacancy->getOne();
                if ($vacante->id_status == 1 && $vacante->n_sent == 5) {
                    $vacancy->setId_status(2);
                    $done = $vacancy->changeStatus();
                }
                echo 1;
            } else {
                echo 2;
            }
        } else {
            header("location:" . base_url . "vacante/index");
        }
    } //resolver variaciones SA

    public function listar()
    {
        if (Utils::isCandidate()) {
            $candidate = new Candidate();
            $candidate->setId_user($_SESSION['identity']->id);
            $candidato = $candidate->getCandidateByUsername();

            if (!$candidato) {
                header("location:" . base_url . "candidato/crear");
            }

            $id_candidate = $candidato->id;

            $va = new VacancyApplicant();
            $va->setId_candidate($id_candidate);
            $vacancies = $va->getApplicantsByCandidate();

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/applicant/applicants.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }

    public function getApplicantInterview()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSenior()) {
            $id_applicant = isset($_POST['id_applicant']) ? trim($_POST['id_applicant']) : FALSE;
            if ($id_applicant) {
                $applicant = new VacancyApplicant();
                $applicant->setId($id_applicant);
                $applicant_data = $applicant->getApplicantById();

                /*$business = new BusinessName();
                $business->setId_Customer($applicant_data->id_customer);
                $business_names = $business->getBNByCustomer();*/

                header('Content-Type: text/html; charset=utf-8');
                echo $json_applicant = json_encode($applicant_data, \JSON_UNESCAPED_UNICODE);
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function update_interview()
    {
        if (Utils::isValid($_POST) && !Utils::isCustomer() && !Utils::isCandidate()) {
            $id = isset($_POST['id_applicant']) && !empty($_POST['id_applicant']) ? trim($_POST['id_applicant']) : FALSE;
            $interview_comments = isset($_POST['interview_comments']) ? trim($_POST['interview_comments']) : NULL;
            $interview_date = isset($_POST['interview_date']) ? trim($_POST['interview_date']) : NULL;

            if ($id && $interview_comments && $interview_date) {
                $applicant = new VacancyApplicant();
                $applicant->setId($id);
                $applicant->setInterview_comments($interview_comments);
                $applicant->setInterview_date($interview_date);
                $update = $applicant->updateInterview();

                if ($update)
                    echo 1;
                else
                    echo 2;
            } else {
                echo 0;
            }
        } else {
            header("location:" . base_url);
        }
    }

    //==================================[Gabo Marzo 21]==========================
    public function mover_postulante()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin()) {
            $id_vacancy = isset($_POST['id_vacancy']) ? $_POST['id_vacancy'] : FALSE;
            $id_candidate = isset($_POST['id_candidate']) ? trim(Encryption::decode($_POST['id_candidate'])) : FALSE;

            if ($id_vacancy  && $id_candidate) {
                $vacante = new VacancyApplicant();
                $vacante->setId_vacancy($id_vacancy);
                $vacante->setId_candidate($id_candidate);
                $existe = $vacante->getOne();

                if (!$existe) {
                    $save = $vacante->move_postulant();
                    if ($save) {
                        echo json_encode(array('status' => 1));
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                } else
                    echo json_encode(array('status' => 3));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
    //===============================================================

    //gabo act
    public function update_comments()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST['id_vacancy_modal']) && isset($_POST['id_candidate_modal'])) {
            $id_vacancy = isset($_POST['id_vacancy_modal']) ? Encryption::decode($_POST['id_vacancy_modal']) : FALSE;
            $id_candidate = isset($_POST['id_candidate_modal']) ? Encryption::decode($_POST['id_candidate_modal']) : FALSE;
            $comments = isset($_POST['comments_modal']) ? Utils::sanitizeString($_POST['comments_modal']) : FALSE;
            $id_status = isset($_POST['id_status_modal']) ? Utils::sanitizeString($_POST['id_status_modal']) : FALSE;



            if ($id_vacancy  && $id_candidate) {
                $vacante = new VacancyApplicant();
                $vacante->setId_vacancy($id_vacancy);
                $vacante->setId_candidate($id_candidate);
                $vacante->setComments($comments);
                $resultado = $vacante->update_comments();

                if ($resultado) {

                    $applicant = new VacancyApplicant();
                    $applicant->setId_vacancy($id_vacancy);
                    $applicant->setId_candidate($id_candidate);

                    if ($id_status <= 2 || $id_status == 5) {
                        $applicant->setId_status(3);
                        $applicant->setCustomer_date(true);
                    } elseif ($id_status == 3) {
                        $applicant->setId_status(7);
                    }
                    $resultado =   $applicant->updateStatus();
                }

                if ($resultado) {
                    echo json_encode(array('status' => 1));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else {
            echo json_encode(array('status' => 0));
        }
    }


    //gabo reactivar
    public function reactivar_postulante()
    {

        if (Utils::isValid($_SESSION['identity']) && isset($_POST['id_vacancy_reactivar']) && isset($_POST['id_candidate_reactivar'])) {
            $id_vacancy = isset($_POST['id_vacancy_reactivar']) ? Encryption::decode($_POST['id_vacancy_reactivar']) : FALSE;
            $id_candidate = isset($_POST['id_candidate_reactivar']) ? Encryption::decode($_POST['id_candidate_reactivar']) : FALSE;
            $id_status = isset($_POST['id_status_reactivar']) ? Utils::sanitizeString($_POST['id_status_reactivar']) : FALSE;


            if ($id_vacancy  && $id_candidate) {

                $applicant = new VacancyApplicant();
                $applicant->setId_vacancy($id_vacancy);
                $applicant->setId_candidate($id_candidate);

                if ($id_status == 7) {
                    $applicant->setId_status(3);
                }

                $resultado =   $applicant->updateStatus();


                if ($resultado) {
                    echo json_encode(array('status' => 1));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 3));
        } else {
            echo json_encode(array('status' => 4));
        }
    }


    //gabo eliminar
    public function eliminar_postulante()
    {
        if (Utils::isValid($_SESSION['identity']) && isset($_POST['id_vacancy_eliminar']) && isset($_POST['id_candidate_eliminar'])) {
            $id_vacancy = isset($_POST['id_vacancy_eliminar']) ? Encryption::decode($_POST['id_vacancy_eliminar']) : FALSE;
            $id_candidate = isset($_POST['id_candidate_eliminar']) ? Encryption::decode($_POST['id_candidate_eliminar']) : FALSE;
            $id_status = isset($_POST['id_status_eliminar']) ? Utils::sanitizeString($_POST['id_status_eliminar']) : FALSE;

            if ($id_vacancy  && $id_candidate) {
                $applicant = new VacancyApplicant();
                $applicant->setId_vacancy($id_vacancy);
                $applicant->setId_candidate($id_candidate);
                $eliminado = $applicant->getOne();
                $resultado =   $applicant->delete();

                if ($resultado) {
                    $profile = new ApplicantProfile();
                    $profile->setid($eliminado->id_profile);
                    $profile->delete();
                }

                if ($resultado) {
                    echo json_encode(array('status' => 1));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 3));
        } else
            echo json_encode(array('status' => 4));
    }


    //===[Gabo 2 mayo modal vacantes]===
    public function agregar_a_vacante()
    {
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin()) {
            $id_vacancies = isset($_POST['id_vacancies']) ? $_POST['id_vacancies'] : FALSE;
            $id_candidate = isset($_POST['id_candidate']) ? trim(Encryption::decode($_POST['id_candidate'])) : FALSE;
            $save = false;
            if ($id_vacancies  && $id_candidate) {
                $vacante = new VacancyApplicant();

                $vacante->setId_candidate($id_candidate);
                for ($i = 0; $i < count($id_vacancies); $i++) {
                    $vacante->setId_vacancy($id_vacancies[$i]);
                    $existe = $vacante->getOne();
                    if (!$existe) {
                        $save = $vacante->move_postulant();
                    }
                }

                if ($save) {
                    echo json_encode(array('status' => 1));
                } else
                    echo json_encode(array('status' => 3));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function getVacanciesByCandidato()
    {
        if (Utils::isValid($_SESSION['identity'])) {

            $id_candidato = isset($_POST['id_candidato']) ? trim(Encryption::decode($_POST['id_candidato'])) : FALSE;

            if ($id_candidato) {

                $vacantes = new Vacancy();
                //===[gabo 9 agosto postular]=== correcion
                $vacantes->setId_recruiter($_SESSION['identity']->id);
                $vacantes = Utils::isAdmin() ? $vacantes->getVacanciesInProcess() : $vacantes->getVacanciesInProcessByIdRecruiter();
                //===[gabo 9 agosto postular fin]===
                $applicant = new VacancyApplicant();
                $applicant->setId_candidate($id_candidato);

                //Se guarda en un array para evitar los candidatos que ya estan en esa vacante
                $vacantesFiltradas = array();
                for ($i = 0; $i < count($vacantes); $i++) {
                    $applicant->setId_vacancy($vacantes[$i]['id']);
                    $existe = $applicant->getOne();

                    if (!$existe) {
                        $vacantesFiltradas[$i]['id'] = $vacantes[$i]['id'];
                        $vacantesFiltradas[$i]['vacancy'] = $vacantes[$i]['vacancy'];
                    }
                }

                echo json_encode(array(
                    'vacantes' => $vacantesFiltradas,
                    'status' => 1
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    //sideserver

    function postulate_one()
    {

        if (Utils::isValid($_SESSION['identity']) && isset($_POST['id_candidate']) && isset($_POST['id_vacancy'])) {
            $id_vacancy = Encryption::decode($_POST['id_vacancy']);
            $id_candidate = Encryption::decode($_POST['id_candidate']);


            $applicant = new VacancyApplicant();
            $applicant->setId_vacancy($id_vacancy);
            $applicant->setId_candidate($id_candidate);

            $vacancy = new Vacancy();
            $vacancy->setId($id_vacancy);
            $vacante = $vacancy->getOne();

            $recruiter = $vacante->id_recruiter;

            $cdto = new Candidate();
            $cdto->setId($id_candidate);
            $postulado = $cdto->getOne();

            $save =  $applicant->move_postulant();


            $subject = 'Nueva postulación para ' . $vacante->vacancy;

            $body = "Se ha postulado el candidato <b>{$postulado->first_name} {$postulado->surname}  {$postulado->last_name}</b> a la vacante de <b>{$vacante->vacancy}</b> perteneciente al cliente <b>{$vacante->customer}</b>";
            if ($recruiter) {
                $user = new User();
                $user->setId($recruiter);
                $executive = $user->getOne();

                Utils::sendEmail($executive->email, $executive->first_name . ' ' . $executive->last_name, $subject, $body);

                $exe = new ExecutiveJRRecruiter();
                $exe->setId_recruiter($executive->id);
                $executiveJR = $exe->getExecutiveJRByRecruiter();

                if ($executiveJR) {
                    Utils::sendEmail($executiveJR->email, $executiveJR->first_name . ' ' . $executiveJR->last_name, $subject, $body);
                }
            }

            if ($save) {
                echo json_encode(array('status' => 1));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function sideserver()
    {

        $_GET['filtros'] .= ($_GET['id_language'] != '') ? "and id_language like " . "'%" . $_GET['id_language'] . "%'" : '';
        $extrawhere = substr($_GET['filtros'], 3);
        $tabla = "rrhhinge_Candidatos.filtros_candidatos fc";


        if ($_GET['clave'] != '') {
            $extrawhere = " ( first_name LIKE " . "'%" . $_GET['clave'] . "%' OR job_title LIKE " . "'%" . $_GET['clave'] . "%' OR description LIKE " . "'%" . $_GET['clave'] . "%' OR experiences LIKE " . "'%" . $_GET['clave'] . "%' OR aptitudes LIKE " . "'%" . $_GET['clave'] . "%')";
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
            array('db' => 'postulaciones',  'dt' => 24)
        );

        $sql_details = array(
            'user' => '',
            'pass' => '',
            'db'   => 'reclutamiento',
            'host' => 'localhost'
        );

        $botones = 1;

        require("helpers/SideServer/Candidatos/ssp.php");

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
