<?php

class Connection
{

    public static function connect()
    {
        try {
  // //$link = new PDO("mysql:host=localhost;dbname=reclutamiento", "root", "");
   //$link = new PDO("sqlsrv:Server=(local);Database=ProjectX","","");
    $link = new PDO("sqlsrv:Server=localhost\\sqlexpress;Database=ProjectX", "sa", "sasa");


            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true);
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        } catch (PDOException $ex) {
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }
    public static function connectSA()
    {
        try {
        //    $link = new PDO("sqlsrv:Server=localhost;Database=ProyectoX","","");
       $link = new PDO("sqlsrv:Server=localhost\\sqlexpress;Database=ProjectX", "sa", "sasa");

       
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true);
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        } catch (PDOException $ex) {
            $link = null;
            die("Error de conexión. Inténtelo de nuevo");
        }
    }
}
?>