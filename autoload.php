<?php

function controllers_autoload($className){
    if (file_exists('controllers/'.$className.'.php')) {
        include 'controllers/'.$className.'.php';
    }
    
}

spl_autoload_register('controllers_autoload');