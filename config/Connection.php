<?php

class Connection
{

    public static function connect()
    {
        try {
            //148.72.144.152
            //$link = new PDO("mysql:host=localhost;dbname=reclutamiento", "root", "");
            $link = new PDO("sqlsrv:Server=localhost;Database=reclutamiento", "", "");
            //   $link = new PDO("sqlsrv:Server=148.72.144.152;Database=reclutamiento", "reclutador", "Sr65s$0z");
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
            $link = new PDO("sqlsrv:Server=localhost;Database=rrhhinge_Candidatos", "", "");
            // $link = new PDO("sqlsrv:Server=148.72.144.152;Database=rrhhinge_Candidatos", "rrhhinge_Candidatos", "Sr65s$0z");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true);
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        } catch (PDOException $ex) {
            $link = null;
            die("Error de conexión. Inténtelo de nuevo");
        }
    }


    /* 
    public static function connectRAL(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=antecedentes_legales", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
            
    }

    public static function connectSA2(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
            
    }

    public static function connectSA3(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo1", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA4(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo2", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA5(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo3", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA6(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo4", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA7(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo5", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA8(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo6", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA9(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo7", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA10(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo8", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA11(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo9", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA12(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo10", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA13(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo11", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA14(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo12", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }
	
	 public static function connectSA15(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo13", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    } 
	
	 public static function connectSA16()
    {
        try {
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo14", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true);
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        } catch (PDOException $ex) {
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    }

    public static function connectSA17()
    {
        try {
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=servicios_apoyo15", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true);
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        } catch (PDOException $ex) {
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    } */

    /*     public static function connectRH(){
        try{
            $link = new PDO("sqlsrv:Server=148.72.144.152;Database=recursos_humanos", "root", "P4s9q6#y");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->setAttribute(constant('PDO::SQLSRV_ATTR_DIRECT_QUERY'), true); 
            $link->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
            return $link;
        }catch(PDOException $ex){
            $link = null;
            die("Error de conexión. Inténtelo de nuevo " . $ex);
        }
    } */
}
