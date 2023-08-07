<?php

require_once 'models/SA/Candidatos.php';
class EstudioSocioEconomicoController {

    public function index(){
        if (Utils::isValid($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer()) {
            $estudio = new Candidatos();
            $estudios = $estudio->getAll();
            
            $page_title = 'Estudios SocioEconómicos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:'.base_url);
        }
    }

    public function en_proceso(){
        if (Utils::isValid($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer()) {
            $estudio = new Candidatos();
            $estudios = $estudio->getServiciosEnProceso();
            
            $page_title = 'Estudios SocioEconómicos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:'.base_url);
        }
    }

    public function datos(){
        if (Utils::isValid($_SESSION['identity']) && !Utils::isCandidate() && !Utils::isCustomer()) {
           
            $page_title = 'Estudios SocioEconómicos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/ese/edit.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:'.base_url);
        }
    }

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isLiderSA())) {
            $Folio = isset($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;
            
            if ($Folio) {
                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $data = $estudio->getOne();

                header('Content-Type: text/html; charset=utf-8');
                echo $json_vacancy = json_encode($data, \JSON_UNESCAPED_UNICODE);
            }else{
                echo 0;
            }
        } else {
            header('location:'.base_url);
        }
    }

    public function update_config(){
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isLiderSA())) {
            $Folio = isset($_POST['Folio']) && !empty($_POST['Folio']) ? trim($_POST['Folio']) : FALSE;
            $Ejecutivo = isset($_POST['Ejecutivo']) && !empty($_POST['Ejecutivo']) ? trim($_POST['Ejecutivo']) : '';

            $Dia_Solicitud = isset($_POST['Dia_Solicitud']) ? $_POST['Dia_Solicitud'] : FALSE;
            $Mes_Solicitud = isset($_POST['Mes_Solicitud']) ? str_pad($_POST['Mes_Solicitud'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Anio_Solicitud = isset($_POST['Anio_Solicitud']) ? str_pad($_POST['Anio_Solicitud'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Hora_Solicitud = isset($_POST['Hora_Solicitud']) ? str_pad($_POST['Hora_Solicitud'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Minuto_Solicitud = isset($_POST['Minuto_Solicitud']) ? str_pad($_POST['Minuto_Solicitud'], 2, "0", STR_PAD_LEFT) : FALSE;

            $Dia_Entrega = isset($_POST['Dia_Entrega']) ? $_POST['Dia_Entrega'] : FALSE;
            $Mes_Entrega = isset($_POST['Mes_Entrega']) ? str_pad($_POST['Mes_Entrega'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Anio_Entrega = isset($_POST['Anio_Entrega']) ? str_pad($_POST['Anio_Entrega'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Hora_Entrega = isset($_POST['Hora_Entrega']) ? str_pad($_POST['Hora_Entrega'], 2, "0", STR_PAD_LEFT) : FALSE;
            $Minuto_Entrega = isset($_POST['Minuto_Entrega']) ? str_pad($_POST['Minuto_Entrega'], 2, "0", STR_PAD_LEFT) : FALSE;

            if ($Folio && $Ejecutivo && $Dia_Solicitud && $Mes_Solicitud && $Anio_Solicitud && $Hora_Solicitud && $Minuto_Solicitud) {
                $Solicitud = DateTime::createFromFormat('Y-m-d H:i', "{$Anio_Solicitud}-{$Mes_Solicitud}-{$Dia_Solicitud} {$Hora_Solicitud}:{$Minuto_Solicitud}");
                $Solicitud = $Solicitud->format('Y-m-d H:i');

                
                if ($Dia_Entrega && $Mes_Entrega && $Anio_Entrega && $Anio_Entrega && $Minuto_Entrega) {
                    $Entrega = DateTime::createFromFormat('Y-m-d H:i', "{$Anio_Entrega}-{$Mes_Entrega}-{$Dia_Entrega} {$Hora_Entrega}:{$Minuto_Entrega}");
                    $Entrega = $Entrega->format('Y-m-d H:i');
                } else {
                    $Entrega = NULL;
                }
                

                $estudio = new Candidatos();
                $estudio->setCandidato($Folio);
                $estudio->setFecha_solicitud($Solicitud);
                $estudio->setFecha_entregado($Entrega);
                $estudio->setEjecutivo($Ejecutivo);
                $update = $estudio->updateConfig();

                if ($update)
                    echo 1;
                else
                    echo 2;
            }else{
                echo 0;
            }

            
        }else{
            header("location:".base_url); 
        }
    }
}