<?php

require_once 'models/Vacancy.php';
require_once 'models/Area.php';
require_once 'models/Subarea.php';
require_once 'models/State.php';
require_once 'models/City.php';
require_once 'models/VacancyApplicant.php';
require_once 'models/Candidate.php';

class BolsaController{

	public function vacantes(){
        if (Utils::isCandidate()) {
            $candidate = new Candidate();
            $candidate->setId_user($_SESSION['identity']->id);
            $candidato = $candidate->getCandidateByUsername();
            if (!$candidato) {
                header('location:'.base_url.'candidato/crear');
            }
            // else{
            //     if ($candidato->job_title == NUll || $candidato->description == NULL || $candidato->id_state == NULL || $candidato->id_city == NULL || $candidato->id_civil_status == NULL || $candidato->id_area == NULL || ($candidato->telephone == NULL && $candidato->cellphone == NULL)) {
            //         header('location:'.base_url.'candidato/editar');
            //     }
            // }
        }

        if (isset($_GET['area'])) {
            $id_area = Encryption::decode($_GET['area']);
            $vacancy = new Vacancy();
            $vacancy->setId_area($id_area);
            $vacancies = $vacancy->getVacanciesAByArea();
        }
        elseif (isset($_GET['subarea'])) {
            $id_subarea = Encryption::decode($_GET['subarea']);
            $vacancy = new Vacancy();
            $vacancy->setId_subarea($id_subarea);
            $vacancies = $vacancy->getVacanciesABySubarea();
        }
        elseif (isset($_GET['state'])) {
            $id_state = Encryption::decode($_GET['state']);
            $vacancy = new Vacancy();
            $vacancy->setId_state($id_state);
            $vacancies = $vacancy->getVacanciesAByState();
        }
        elseif (isset($_GET['city'])){
            $id_city = Encryption::decode($_GET['city']);
            $vacancy = new Vacancy();
            $vacancy->setId_city($id_city);
            $vacancies = $vacancy->getVacanciesAByCity();
        }
        else {
            $vacancy = new Vacancy();
            $vacancies = $vacancy->getVacanciesAvailable();            
        }
        
        $area = new Area();
        $areas = $area->getAVacancyCountByArea();
        $subarea = new Subarea();
        $subareas = $subarea->getAVacancyCountBySubarea();
        $state = new State();
        $states = $state->getAVacancyCountByState();
        $city = new City();
        $cities = $city->getAVacancyCountByCity();

        $page_title = 'Bolsa de Trabajo | RRHH Ingenia';
        require_once 'views/layout/header.php';
        if (isset($_SESSION['identity'])) {
            require_once 'views/layout/sidebar.php';
        } else {
            require_once 'views/layout/navbar.php';
        }
        
        require_once 'views/jobs/index.php';
        require_once 'views/layout/footer.php';
    }

    public function ver(){
        if (isset($_GET['vacante'])) {
            if (Utils::isCandidate()) {
                $candidate = new Candidate();
                $candidate->setId_user($_SESSION['identity']->id);
                $candidato = $candidate->getCandidateByUsername();
                if (!$candidato) {
                    header('location:'.base_url.'candidato/crear');
                }else{
                    if ($candidato->job_title == NUll || $candidato->description == NULL || $candidato->id_state == NULL || $candidato->id_city == NULL || $candidato->id_civil_status == NULL || $candidato->id_area == NULL || ($candidato->telephone == NULL && $candidato->cellphone == NULL)) {
                        header('location:'.base_url.'candidato/editar');
                    }
                }
            }
            $id = Encryption::decode($_GET['vacante']);
            $vacancy = new Vacancy();
            $vacancy->setId($id);
            $vacante = $vacancy->getOne();

            if (Utils::isCandidate()) {
                $candidate = new Candidate();
                $candidate->setId_user($_SESSION['identity']->id);
                $candidato = $candidate->getCandidateByUsername();
                $id_candidate = $candidato->id;

                $va = new VacancyApplicant();
                $va->setId_vacancy($id);
                $va->setId_candidate($id_candidate);
                $postulacion = $va->getOne();
            }

            $page_title = $vacante->vacancy.' | RRHH Ingenia';
            require_once 'views/layout/header.php';
            if (isset($_SESSION['identity'])) {
                require_once 'views/layout/sidebar.php';
            } else {
                require_once 'views/layout/navbar.php';
            }
            require_once 'views/jobs/read.php';
            require_once 'views/layout/footer.php';
        }else {
            header('location:'.base_url.'bolsa/vacantes');
        }
    }
}