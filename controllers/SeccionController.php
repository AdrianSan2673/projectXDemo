<?php

class SeccionController{

    public function inicio(){
        require_once 'views/layout/header.php';
        require_once 'views/layout/navbar.php';
        require_once 'views/layout/landing.php';
        require_once 'views/layout/footer.php';
    }

    public function contacto(){
        require_once 'views/layout/header.php';
        require_once 'views/layout/navbar.php';
        require_once 'views/layout/contacto.php';
        require_once 'views/layout/footer.php';
    }

    public function aviso_de_privacidad(){

    }
	
	public function activar_notificaciones(){
        $page_title = 'Activar Notificaciones | RRHH Ingenia';
        require_once 'views/layout/header.php';
        require_once 'views/layout/sidebar.php';
        require_once 'views/layout/newNotifications.php';
        require_once 'views/layout/footer.php';
    }
}