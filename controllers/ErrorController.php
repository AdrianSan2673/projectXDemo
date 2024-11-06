<?php

class ErrorController{

    public function index(){
        $page_title = 'Error | SIGMA';
        require_once 'views/layout/header.php';
        require_once 'views/error/index.php';
    }
}