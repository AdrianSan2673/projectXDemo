<?php
require_once 'models/Area.php';


class ConfiguracionesController
{

    public function index()
    {
        if (Utils::isAdmin() || Utils::isManager()) {

            $areas = new Area();
            $areas = $areas->getAllAreasAvaiable();


            $page_title = 'Cobranza RH | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/configuraciones/index.php';
            require_once 'views/layout/footer.php';
           // require_once 'views/configuraciones/Areas/modal-areaVacante.php';
            require_once 'views/configuraciones/Areas/modal-verSubAreas.php';
            require_once 'views/configuraciones/Areas/modal-agregar-area.php';
            require_once 'views/configuraciones/Areas/modal-agregar-subarea.php';
        } else {
            header("location:" . base_url);
        }
    }
}
