<?php

require_once 'models/SA/EncuestaCliente.php';

class EncuestaClienteController{

    public function save(){
        if (Utils::isValid($_POST) && (Utils::isCustomerSA() || Utils::isCustomer())) {
            $ID_Empresa = Utils::sanitizeNumber($_POST['ID_Empresa']);
            $ID_Cliente = Utils::sanitizeNumber($_POST['ID_Cliente']);
            $ID_Cliente_Reclu = Utils::sanitizeNumber($_POST['ID_Cliente_Reclu']);
            $Experiencia = Utils::sanitizeNumber($_POST['Experiencia']);
            /* $Objetivos = Utils::sanitizeNumber($_POST['Objetivos']);
            $Asesoria = Utils::sanitizeNumber($_POST['Asesoria']);
            $Resolucion = Utils::sanitizeNumber($_POST['Resolucion']); */
            
            $Comentarios = Utils::sanitizeStringBlank($_POST['Comentarios']);
            $Usuario = $_SESSION['identity']->username;
            if (($ID_Cliente || $ID_Cliente_Reclu)) {
                $encuesta = new EncuestaCliente();
                $encuesta->setID_Empresa($ID_Empresa);
                $encuesta->setID_Cliente($ID_Cliente);
                $encuesta->setid_Cliente_Reclu($ID_Cliente_Reclu);
                $encuesta->setExperiencia($Experiencia);
                $encuesta->setObjetivos(0);
                $encuesta->setAsesoria(0);
                $encuesta->setResolucion(0);
                $encuesta->setComentarios($Comentarios);
                $encuesta->setUsuario($Usuario);
                $save = $encuesta->create();

                if ($save) {
                    unset($_SESSION['Encuesta']);
                    echo json_encode(
                        array(
                            'status' => 1
                        )
                    );
                } else 
                    echo json_encode(array('status' => 2));
                
            }else {
                echo json_encode(array('status' => 0));
            }
        }else{
            header('location:'.base_url);
        }
    }

    public function index(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager())) {
            $evaluation = new EncuestaCliente();
            $evaluations = $evaluation->getAll();

            $page_title = 'Encuesta de Satisfacción de clientes | RRHH Ingenia';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/encuesta/evaluations.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:'.base_url);
        }
    }
}