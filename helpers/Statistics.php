<?php

class Statistics{
    
    /*public static function getVacancyCountPerMonth($date){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancy->setRequest_date(date('Y-m-d'));
        return $vacancy->getVacancyCountPerMonth();
    }*/

    public static function getVacancyCountInCurrentMonth(){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancy->setRequest_date(date('Y-m-d'));
        return $vacancy->getVacancyCountPerMonth();
    }

    public static function getVacancyCountByCustomerInCurrentMonth($id_customer){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancy->setRequest_date(date('Y-m-d'));
        $vacancy->setId_customer($id_customer);
        return $vacancy->getVacancyCountPerMonthAndCustomer();
    }

    public static function getVacancyInProcessCount(){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        return $vacancy->getVacancyInProcessCount();
    }

    public static function getVacancyInProcessCountByCustomer($id_customer){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancy->setId_customer($id_customer);
        return $vacancy->getVacancyInProcessCountByCustomer();
    }

    public static function getVacancyCountByCustomer($id_customer){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancy->setId_customer($id_customer);
        return $vacancy->getVacancyCountByCustomer();
    }

    public static function getVacancyClosedCountInCurrentMonth(){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancy->setRequest_date(date('Y-m-d'));
        $vacancy->setId_status(5);
        return $vacancy->getVacancyClosedCountInCurrentMonth();
    }

    public static function getVacancyClosedCountByCustomerInCurrentMonth($id_customer){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancy->setRequest_date(date('Y-m-d'));
        $vacancy->setId_status(5);
        $vacancy->setId_customer($id_customer);
        return $vacancy->getVacancyClosedCountByCustomerInCurrentMonth();
    }

    public static function getVacancyClosedCountByCustomer($id_customer){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancy->setId_status(5);
        $vacancy->setId_customer($id_customer);
        return $vacancy->getVacancyClosedCountByCustomer();
    }

    public static function getTodayCandidatesCount(){
        require_once 'models/Candidate.php';
        $candidate = new Candidate();
        $candidate->setCreated_At(date('Y-m-d'));
        return $candidate->getCandidateCountPerDay();
    }

    public static function getCandidateCountFromLast7Days(){
        require_once 'models/Candidate.php';
        $candidate = new Candidate();
        $candidates = $candidate->getCandidateCountFromLast7Days();

        for ($i=0; $i < count($candidates); $i++) { 
            switch ($candidates[$i]['dia_semana']) {
                case 'Sunday':
                    $candidates[$i]['dia_semana'] = 'Domingo';
                    break;
                case 'Monday':
                    $candidates[$i]['dia_semana'] = 'Lunes';
                    break;
                case 'Tuesday':
                        $candidates[$i]['dia_semana'] = 'Martes';
                        break;
                case 'Wednesday':
                    $candidates[$i]['dia_semana'] = 'Miércoles';
                    break;
                case 'Thursday':
                    $candidates[$i]['dia_semana'] = 'Jueves';
                    break;
                case 'Friday':
                    $candidates[$i]['dia_semana'] = 'Viernes';
                    break;
                case 'Saturday':
                    $candidates[$i]['dia_semana'] = 'Sábado';
                    break;
            }
        }
        
        return $candidates;
    }

    public static function getCandidateCountByExecutive(){
        require_once 'models/Candidate.php';
        $candidate = new Candidate();
        $candidates = $candidate->getCandidateCountByExecutive();
        for($i=0; $i < count($candidates); $i++){
            if (!is_null($candidates[$i]['id'])) {
                $path = 'uploads/avatar/'.$candidates[$i]['id'];
                if (file_exists($path)) {
                    $directory = opendir($path);
        
                    while ($file = readdir($directory))
                    {
                        if (!is_dir($file)){
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path."/".$file);
                            $route = $path.'/'.$file;
                        }
                    }
                }else{
                    $route = "dist/img/user-icon.png";
                    $type = pathinfo($route, PATHINFO_EXTENSION);
                    $img_content = file_get_contents($route);
                }
                //$img_base64 = chunk_split(base64_encode($img_content));
                $img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
                $candidates[$i]['avatar'] = base_url.$route;
            }
            
            
        }
        return $candidates;
    }

    public static function getVacancyCountByExecutive(){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancies = $vacancy->getVacancyCountByExecutive();
        for($i=0; $i < count($vacancies); $i++){
            if (!is_null($vacancies[$i]['id'])) {
                $path = 'uploads/avatar/'.$vacancies[$i]['id'];
                if (file_exists($path)) {
                    $directory = opendir($path);
        
                    while ($file = readdir($directory))
                    {
                        if (!is_dir($file)){
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img_content = file_get_contents($path."/".$file);
                            $route = $path.'/'.$file;
                        }
                    }
                }else{
                    $route = "dist/img/user-icon.png";
                    $type = pathinfo($route, PATHINFO_EXTENSION);
                    $img_content = file_get_contents($route);
                }
                //$img_base64 = chunk_split(base64_encode($img_content));
                $img_base64 = 'data:image/' . $type . ';base64,' . base64_encode($img_content);
                $vacancies[$i]['avatar'] = base_url.$route;
            }
            
            
        }
        return $vacancies;
    }

    public static function getVacancyInProcessCountByCustomers(){
        require_once 'models/Vacancy.php';
        $vacancy = new Vacancy();
        $vacancies = $vacancy->getVacancyInProcessCountByCustomers();
        
        return $vacancies;
    }

    public static function getCustomerCountInCurrentMonth(){
        require_once 'models/Customer.php';
        $customer = new Customer();
        $customer->setCreated_At(date('Y-m-d'));
        return $customer->getCustomerCountPerMonth();
    }

    public static function getCustomerCountInPreviousMonths(){
        require_once 'models/Customer.php';
        $customer = new Customer();
        return $customer->getCustomerCountInPreviousMonths();
    }

    /*Prospección*/
    public static function getTotalProspectosMesActual(){
        require_once 'models/SA/Prospecto.php';
        $prospecto = new Prospecto();
        return $prospecto->getTotalProspectosMesActual();
    }

    public static function getTotalProspectosMesesAnteriores(){
        require_once 'models/SA/Prospecto.php';
        $prospecto = new Prospecto();
        return $prospecto->getTotalProspectosMesesAnteriores();
    }


    /**
     * SA
     */

    public static function getTotalServiciosApoyoHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setFecha_solicitud(date('Y-m-d'));
        return $candidate->getTotalServiciosPorDia();
    }

    public static function getTotalRALESHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setFecha_solicitud(date('Y-m-d'));
        return $candidate->getTotalRALESPorDia();
    }

    public static function getTotalInvHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setFecha_solicitud(date('Y-m-d'));
        return $candidate->getTotalInvPorDia();
    }

    public static function getTotalESESHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setFecha_solicitud(date('Y-m-d'));
        return $candidate->getTotalESESPorDia();
    }

    //POR EJECUTIVO
    public static function getTotalServiciosApoyoHoyPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setFecha_solicitud(date('Y-m-d'));
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalServiciosPorDiaYEjecutivo();
    }

    public static function getTotalRALESHoyPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setFecha_solicitud(date('Y-m-d'));
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalRALESPorDiaYEjecutivo();
    }

    public static function getTotalInvHoyPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setFecha_solicitud(date('Y-m-d'));
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalInvPorDiaYEjecutivo();
    }

    public static function getTotalESESHoyPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setFecha_solicitud(date('Y-m-d'));
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalESESPorDiaYEjecutivo();
    }


    //*****En Proceso */
    public static function getTotalServiciosApoyoEnProceso(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalServiciosEnProceso();
    }

    public static function getTotalRALESEnProceso(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalRALESEnProceso();
    }

    public static function getTotalInvEnProceso(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalInvEnProceso();
    }

    public static function getTotalESESEnProceso(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalESESEnProceso();
    }

    //POR EJECUTIVO
    public static function getTotalServiciosApoyoEnProcesoPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalServiciosEnProcesoEjecutivo();
    }

    public static function getTotalRALESEnProcesoPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalRALESEnProcesoEjecutivo();
    }

    public static function getTotalInvEnProcesoPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalInvEnProcesoEjecutivo();
    }

    public static function getTotalESESEnProcesoPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalESESEnProcesoEjecutivo();
    }


    //**** En la semana */
    public static function getTotalServiciosApoyoSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalServiciosSemana();
    }

    public static function getTotalRALESSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalRALESSemana();
    }

    public static function getTotalInvSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalInvSemana();
    }

    public static function getTotalESESSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalESESSemana();
    }

    //POR EJECUTIVO
    public static function getTotalServiciosApoyoSemanaPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalServiciosSemanaEjecutivo();
    }

    public static function getTotalRALESSemanaPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalRALESSemanaEjecutivo();
    }

    public static function getTotalInvSemanaPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalInvSemanaEjecutivo();
    }

    public static function getTotalESESSemanaPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalESESSemanaEjecutivo();
    }


    //***** En el mes */
    public static function getTotalServiciosApoyoMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalServiciosMes();
    }

    public static function getTotalRALESMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalRALESMes();
    }

    public static function getTotalInvMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalInvMes();
    }

    public static function getTotalESESMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        return $candidate->getTotalESESMes();
    }

    //POR EJECUTIVO
    public static function getTotalServiciosApoyoMesPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalServiciosMesEjecutivo();
    }

    public static function getTotalRALESMesPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalRALESMesEjecutivo();
    }

    public static function getTotalInvMesPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalInvMesEjecutivo();
    }

    public static function getTotalESESMesPorEjecutivo(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        return $candidate->getTotalESESMesEjecutivo();
    }

    public static function getServiciosSolicitadosPorClientesHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorClientesHoy();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorClientesYEjecutivoHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorClientesYEjecutivoHoy();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorClientesEnProceso(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorClientesEnProceso();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorClientesYEjecutivoEnProceso(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorClientesYEjecutivoEnProceso();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorClientesSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorClientesSemana();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorClientesYEjecutivoSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorClientesYEjecutivoSemana();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorClientesMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorClientesMes();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorClientesYEjecutivoMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorClientesYEjecutivoMes();

        return $candidates;
    }


    public static function getServiciosSolicitadosPorCCHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorCCHoy();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorCCYEjecutivoHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorCCYEjecutivoHoy();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorCCEnProceso(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorCCEnProceso();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorCCYEjecutivoEnProceso(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorCCYEjecutivoEnProceso();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorCCSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorCCSemana();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorCCYEjecutivoSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorCCYEjecutivoSemana();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorCCMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorCCMes();

        return $candidates;
    }

    public static function getServiciosSolicitadosPorCCYEjecutivoMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorCCYEjecutivoMes();

        return $candidates;
    }
	
	public static function getServiciosPorEjecutivoHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosSolicitadosPorEjecutivoHoy();

        return $candidates;
    }

    public static function getServiciosPorEjecutivoUnicoHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosSolicitadosPorEjecutivoUnicoHoy();

        return $candidates;
    }

    public static function getServiciosEntregadosPorEjecutivoHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosEntregadosPorEjecutivoHoy();

        return $candidates;
    }

    public static function getServiciosEntregadosPorEjecutivoUnicoHoy(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosEntregadosPorEjecutivoUnicoHoy();

        return $candidates;
    }

    public static function getServiciosEntregadosPorEjecutivoSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosEntregadosPorEjecutivoSemana();

        return $candidates;
    }

    public static function getServiciosEntregadosPorEjecutivoUnicoSemana(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosEntregadosPorEjecutivoUnicoSemana();

        return $candidates;
    }

    public static function getServiciosEntregadosPorEjecutivoMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidates = $candidate->getServiciosEntregadosPorEjecutivoMes();

        return $candidates;
    }

    public static function getServiciosEntregadosPorEjecutivoUnicoMes(){
        require_once 'models/SA/Candidatos.php';
        $candidate = new Candidatos();
        $candidate->setEjecutivo($_SESSION['identity']->username);
        $candidates = $candidate->getServiciosEntregadosPorEjecutivoUnicoMes();

        return $candidates;
    }
	
	public static function getEvaluationByID_ContactoAndStatus(){
        require_once 'models/RH/EvaluationEmployee.php';
        require_once 'models/SA/ContactosEmpresa.php';
        $contactoEmpresa = new ContactosEmpresa();
        $contactoEmpresa->setUsuario($_SESSION['identity']->username);
        $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

        $evaluation_employee = new EvaluationEmployee();
        $evaluation_employee->setID_Contacto($id_contacto);
        $evaluation_employee->setStatus(2);
        $evaluation_employees = $evaluation_employee->getEvaluationByID_ContactoAndStatus();

        return $evaluation_employees;
    }
}