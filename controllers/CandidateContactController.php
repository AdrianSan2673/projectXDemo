<?php

require_once 'models/User.php';
require_once 'models/CandidateDirectory.php';
require_once 'models/CustomerContact.php';
//5 oct
require_once 'models/Vacancy.php';
require_once 'models/CandidateContact.php';
//require_once 'models/CandidateExperienceDirectory.php';
//require_once 'models/CandidateEducationDirectory.php';

class CandidateContactController
{


    public function index()
    {

        if (isset($_SESSION['identity']) && !empty($_SESSION['identity'])) {


            $candidate = new CandidateContact();
            $candidatecontact = $candidate->getAll();



            $page_title = 'Bienvenido(a) | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/candidateContact/index.php';
            require_once 'views/layout/footer.php';
        } else {

            $page_title = 'Iniciar sesión | RRHH Ingenia';
            require_once 'views/user/header.php';
            require_once 'views/user/login.php';
            require_once 'views/user/footer.php';
        }
    }





    public function register()
    {

        if (isset($_GET['vacante']) and $_GET['vacante'] != '') {

            $id_vacancy = Encryption::decode($_GET['vacante']);
            $vacancy = new Vacancy();
            $vacancy->setId($id_vacancy);
            $vacancy = $vacancy->existsVacancy();

            if ($vacancy) {
                $page_title = 'Iniciar sesión | RRHH Ingenia';
                require_once 'views/user/header.php';
                require_once 'views/user/form-candidate-contact.php';
                require_once 'views/user/footer.php';
                die();
            } else {
               header("location:" . base_url . "usuario/index");
            }
        } else {
          header("location:" . base_url . "usuario/index");
        }
    }
}
