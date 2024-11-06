<?php

class Utils
{

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = NULL;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isValid($var)
    {
        if (isset($var) && !empty($var)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public static function sanitizeString($var)
    {
        if (strpos($var, "'") == true) {
            return isset($var) && !empty(trim($var)) ? trim($var) : null;
        } else {
            return isset($var) && !empty(trim($var)) ? trim(filter_var($var, FILTER_SANITIZE_STRING)) : null;
        }
    }

    public static function sanitizeStringBlank($var)
    {
        if (strpos($var, "'") == true) {
            return isset($var) && !empty(trim($var)) ? trim($var) : '';
        } else {
            return isset($var) && !empty(trim($var)) ? trim(filter_var($var, FILTER_SANITIZE_STRING)) : '';
        }
    }

    public static function sanitizeNumber($var)
    {
        return isset($var) && !empty(trim($var)) && $var != 0 ? trim(filter_var($var, FILTER_SANITIZE_NUMBER_INT)) : ($var == 0 ? 0 : null);
    }

    public static function sanitizeFloat($var)
    {
        return isset($var) && !empty(trim($var)) ? trim(filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT)) : ($var == 0 ? 0 : null);
    }

    public static function sanitizeEmail($var)
    {
        return isset($var) && !empty(trim($var)) ? trim(filter_var($var, FILTER_SANITIZE_EMAIL)) : null;
    }

    public static function isAdmin($tipo_usuario)
    {
        return $tipo_usuario == 'gerente de logistica' ? true : false;
    }

    public static function isLogistica($tipo_usuario) {
        return $tipo_usuario == 'logistica' ? true : false;
    }

    public static function isProcura($tipo_usuario) {
        return $tipo_usuario == 'procura' ? true : false;
    }

    public static function isCalidad($tipo_usuario) {
        return $tipo_usuario == 'calidad' ? true : false;
    }

    public static function isManagmentLogistic($tipo_usuario) {
        return $tipo_usuario == 'gerente de logistica' ? true : false;
    }

    public static function isSupervisor($tipo_usuario) {
        return $tipo_usuario == 'superviso' ? true : false;
    }

    
    public static function isSenior()
    {
        if (!isset($_SESSION['Calidad'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isJunior()
    {
        if (!isset($_SESSION['junior'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isManager()
    {
        if (!isset($_SESSION['manager'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isSalesManager()
    {
        if (!isset($_SESSION['salesmanager'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isCustomer()
    {
        if (!isset($_SESSION['customer'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isCandidate()
    {
        if (!isset($_SESSION['candidate'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isSales()
    {
        if (!isset($_SESSION['sales'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isRecruitmentManager()
    {
        return !isset($_SESSION['recruitmentmanager']) ? false : true;
    }

    public static function isSAManager()
    {
        if (!isset($_SESSION['samanager'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isOperationsSupervisor()
    {
        return !isset($_SESSION['operationssupervisor']) ? false : true;
    }

    public static function isLogisticsSupervisor()
    {
        return !isset($_SESSION['logisticssupervisor']) ? false : true;
    }

    public static function isAccount()
    {
        return !isset($_SESSION['account']) ? false : true;
    }

    public static function isLogistics()
    {
        return !isset($_SESSION['logistics']) ? false : true;
    }

    public static function isCustomerSA()
    {

        if (Utils::isManager()) { //Esto es para que la conta pueda ver RH
            return  true;
        } else
            return !isset($_SESSION['customerSA']) ? false : true;
    }

    public static function isHumanResources()
    {
        return !isset($_SESSION['humanresources']) ? false : true;
    }

    public static function isDarkMode() {}

    public static function showRoles()
    {
        require_once 'models/ModelosSigma/usuario.php';
        $user = new Usuario();
        $roles = $user->getUserTypes();
        return $roles;
    }




    public static function sendEmail($email, $name, $subject, $body, $cc = false)
    {

        // require_once 'libraries/PHPMailer/PHPMailerAutoload.php';

        // $mail = new PHPMailer();
        // $mail->isSMTP();
        // $mail->SMTPAuth = true;
        // $mail->SMTPSecure = 'tls';
        // $mail->Host = 'smtp.gmail.com';
        // $mail->Port = '587';

        // $mail->Username = 'soporteingenia@rrhhingenia.com';
        // $mail->Password = 'miguel2019';

        // $mail->setFrom('soporteingenia@rrhhingenia.com', 'RRHH Ingenia');
        // $mail->addAddress($email, $name);

        // $mail->Subject = $subject;
        // $mail->Body    = $body;
        // $mail->IsHTML(true);
        // $mail->CharSet = 'UTF-8';
        // if ($cc)
        //     $mail->addCC($cc['email'], $cc['name']);
        // if ($mail->send())
        return true;
        // else
        //     return false;
    }


    public static function getFullDate($date)
    {
        $day = Utils::getDayOfTheWeek($date);
        $num = date("j", strtotime($date));
        $year = date("Y", strtotime($date));
        //$month = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
        $month = Utils::getMonths();
        $month = $month[(date('m', strtotime($date)) * 1) - 1];
        $time = date("H:i", strtotime(($date)));
        //return $day.', '.$num.' '.$month.' '.$year.'. '.$time;
        return $num . ' de ' . $month . ' de ' . $year . ' ' . $time;
    }

    public static function getFullDate12($date)
    {
        $day = Utils::getDayOfTheWeek($date);
        $num = date("j", strtotime($date));
        $year = date("Y", strtotime($date));
        //$month = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
        $month = Utils::getMonths();
        $month = $month[(date('m', strtotime($date)) * 1) - 1];
        $time = date("h:i A", strtotime(($date)));
        //return $day.', '.$num.' '.$month.' '.$year.'. '.$time;
        return $num . ' de ' . $month . ' de ' . $year . ' ' . $time;
    }

    public static function getDayOfTheWeek($date)
    {
        $dias = array('Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab');
        $day = $dias[date('w', strtotime($date))];
        return $day;
    }

    public static function getMonths()
    {
        $months = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        return $months;
    }

    public static function getDiasSemana()
    {
        $months = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');
        return $months;
    }

    public static function getShortDate($date)
    {
        $num = date("j", strtotime($date));
        $year = date("Y", strtotime($date));
        $month = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
        $month = $month[(date('m', strtotime($date)) * 1) - 1];
        return $num . '/' . $month . '/' . $year;
    }
    public static function getShortDateMoth($date)
    {
        $year = date("Y", strtotime($date));
        $month = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
        $month = $month[(date('m', strtotime($date)) * 1) - 1];
        return  $month . '/' . $year;
    }
    public static function getDate($date)
    {
        $day = Utils::getDayOfTheWeek($date);
        $num = date("d", strtotime($date));
        $year = date("Y", strtotime($date));
        $month = Utils::getMonths();
        $month = $month[(date('m', strtotime($date)) * 1) - 1];
        return $num . ' de ' . $month . ' del ' . $year;
    }


    public static function lineBreak($txt)
    {
        return str_replace("\n", '</br>', addslashes($txt));
    }

    public static function deleteDir($folder)
    {
        foreach (glob($folder . "/*") as $folder_files) {
            if (is_dir($folder_files)) {
                Utils::deleteDir($folder_files);
            } else {
                unlink($folder_files);
            }
        }
        rmdir($folder);
    }



    public static function encrypt($data)
    {
        $key = "r3c1ut4m13nt0";
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, "aes-256-cbc", $key, 0, $iv);
        // return the encrypted string with $iv joined 
        return base64_encode($encrypted . "::" . $iv);
    }

    public static function decrypt($data)
    {
        $key = "r3c1ut4m13nt0";
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    }
}
