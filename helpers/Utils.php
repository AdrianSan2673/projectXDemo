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

    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            return false;
        } else {
            return true;
        }
    }

    public static function isSenior()
    {
        if (!isset($_SESSION['senior'])) {
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

    public static function isDarkMode()
    {
        if ($_SESSION['dark_mode'] == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function showRoles()
    {
        require_once 'models/User.php';
        $user = new User();
        $roles = $user->getUserTypes();
        return $roles;
    }

    public static function getEmailByUsername($username)
    {
        require_once 'models/User.php';
        $user = new User();
        $user->setUsername($username);
        $email = $user->getUserByUsername()->email;
        return $email;
    }

    public static function getUserByUsername($username)
    {
        require_once 'models/User.php';
        $user = new User();
        $user->setUsername($username);
        $usuario = $user->getUserByUsername();
        return $usuario;
    }

    public static function showStates()
    {
        require_once 'models/State.php';
        $state = new State();
        $states = $state->getAll();
        return $states;
    }

    public static function showCitiesByState($state)
    {
        require_once 'models/City.php';
        $city = new City();
        $city->setId_state($state);
        $cities = $city->getCitiesByState();
        return $cities;
    }

    public static function showStateById($id_state)
    {
        require_once 'models/State.php';
        $state = new State();
        $state->setId($id_state);
        $state = $state->getone();
        return $state;
    }

    public static function showCityById($id_city)
    {
        require_once 'models/City.php';
        $city = new City();
        $city->setId($id_city);
        $city = $city->getOne();
        return $city;
    }

    public static function showAreas()
    {
        require_once 'models/Area.php';
        $area = new Area();
        $areas = $area->getAll();
        return $areas;
    }

    public static function showSubareasByArea($area)
    {
        require_once 'models/Subarea.php';
        $subarea = new Subarea();
        $subarea->setId_area($area);
        $subareas = $subarea->getSubareasByArea();
        return $subareas;
    }

    public static function showContactsByCustomer($customer)
    {
        require_once 'models/CustomerContact.php';
        $CustomerContact = new CustomerContact();
        $CustomerContact->setId_Customer($customer);
        $customers = $CustomerContact->getContactsByCustomer();
        return $customers;
    }

    public static function showBNByCustomer($BusinessName)
    {
        require_once 'models/BusinessName.php';
        $BN = new BusinessName();
        $BN->setId_Customer($BusinessName);
        $BNs = $BN->getBNByCustomer();
        return $BNs;
    }

    public static function showCustomers()
    {
        require_once 'models/Customer.php';
        $customer = new Customer();
        $customers = $customer->getAll();
        return $customers;
    }

    public static function showEducationLevels()
    {
        require_once 'models/EducationLevel.php';
        $education_level = new EducationLevel();
        $education_levels = $education_level->getAll();
        if ($_GET['controller'] == 'formacion') {
            unset($education_levels[0], $education_levels[1], $education_levels[2], $education_levels[3]);
        } else {
            unset($education_levels[7], $education_levels[8]);
        }
        return $education_levels;
    }

    public static function showEducationById($id_education)
    {
        require_once 'models/EducationLevel.php';
        $education = new EducationLevel();
        $education->setId($id_education);
        $education = $education->getone();
        return $education;
    }

    public static function showCivilStatus()
    {
        require_once 'models/CivilStatus.php';
        $status = new CivilStatus();
        $civil_status = $status->getAll();
        if ($_GET['controller'] != 'vacante') {
            array_pop($civil_status);
        }
        return $civil_status;
    }

    public static function showGenders()
    {
        require_once 'models/Gender.php';
        $gender = new Gender();
        $genders = $gender->getAll();

        if ($_GET['controller'] != 'vacante') {
            array_pop($genders);
        }
        return $genders;
    }

    public static function showCostCenters()
    {
        require_once 'models/CostCenter.php';
        $center = new CostCenter();
        $cost_centers = $center->getAll();
        return $cost_centers;
    }

    public static function showLanguages()
    {
        require_once 'models/Language.php';
        $language = new Language();
        $languages = $language->getAll();
        return $languages;
    }

    public static function showLanguageLevels()
    {
        require_once 'models/LanguageLevel.php';
        $level = new LanguageLevel();
        $levels = $level->getAll();
        return $levels;
    }

    public static function showLanguageById($id_language)
    {
        require_once 'models/Language.php';
        $language = new Language();
        $language->setId($id_language);
        $language = $language->getone();
        return $language;
    }

    public static function showLanguageLevelById($id_language_level)
    {
        require_once 'models/LanguageLevel.php';
        $level = new LanguageLevel();
        $level->setId($id_language_level);
        $level = $level->getOne();
        return $level;
    }

    public static function showRecruiters()
    {
        require_once 'models/User.php';
        $recruiter = new User();
        $recruiter->setId_user_type(2);
        $recruiters = $recruiter->getUsersByType();
        return $recruiters;
    }

    public static function showPsychometryTypes()
    {
        require_once 'models/PsychometryType.php';
        $type = new PsychometryType();
        $types = $type->getAll();
        return $types;
    }

    public static function showCandidates()
    {
        require_once 'models/Candidate.php';
        $candidate = new Candidate();
        $candidates = $candidate->getAllNames();
        return $candidates;
    }

    public static function showUsuariosPorPerfil($perfil)
    {
        /* require_once 'models/SA/Usuarios.php';
        $usuario = new Usuarios();
        $usuario->setPerfil($perfil);
        $usuarios = $usuario->getUsuariosPorPerfil();
        return $usuarios; */
        require_once 'models/User.php';
        $user = new User();
        $user->setId_user_type($perfil);
        $users = $user->getUsersByType();
        return $users;
    }

    public static function showRazonesSocialesPorCliente($cliente)
    {
        require_once 'models/SA/RazonesSociales.php';
        $razon = new RazonesSociales();
        $razon->setID_Cliente($cliente);
        $razones = $razon->getRazonesSocialesPorCliente();
        return $razones;
    }

    public static function showProspectosPorSeguirHoy()
    {
        require_once 'models/SA/Prospecto.php';
        $pros = new Prospecto();
        $pros->setFecha_Prox_Seguimiento(date('Y-m-d'));
        $prospectos = $pros->getProspectosPorFechadeSeguimiento();
        return $prospectos;
    }

    public static function showProspectosPorSeguirHoyEjecutivo()
    {
        require_once 'models/SA/Prospecto.php';
        $pros = new Prospecto();
        $pros->setFecha_Prox_Seguimiento(date('Y-m-d'));
        $pros->setEjecutivo(strtoupper($_SESSION['identity']->username));
        $prospectos = $pros->getProspectosPorFechadeSeguimientoYEjecutivo();
        return $prospectos;
    }

    public static function showOrdenesCompraHoy()
    {
        require_once 'models/SA/OrdenesCompra.php';
        $orden = new OrdenesCompra();
        $orden->setFecha_Prox_Gestion(date('Y-m-d'));
        $ordenes = $orden->getOrdenesPorFecha();
        return $ordenes;
    }

    public static function showCuentasPorCobrarHoy()
    {
        require_once 'models/SA/Facturas.php';
        $factura = new Facturas();
        $factura->setPromesa_Pago(date('Y-m-d'));
        $facturas = $factura->getCuentasPorCobrarPorFecha();
        return $facturas;
    }

    public static function showTiposServiciosApoyo()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(116);
        $campos = $campo->getCamposByTabla();
        return $campos;
    }

    public static function showFasesServiciosApoyo()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(200);
        $campos = $campo->getCamposByTabla();
        $ral = array(array('Campo' => 298, 'Descripcion' => 'RAL', 'Tabla' => 116, 'Modifico' => '', 'Modificado' => '', 'Activo' => 1));
        $campos = array_merge($ral, $campos);
        return $campos;
    }

    public static function showCentrosCostoPorEmpresa($Empresa)
    {
        require_once 'models/SA/Empresas.php';
        $enterprise = new Empresas();
        $enterprise->setEmpresa($Empresa);
        $cost_centers = $enterprise->getCentroCostosPorEmpresa();
        return $cost_centers;
    }

    public static function sendEmail($email, $name, $subject, $body, $cc = false)
    {

        require_once 'libraries/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '587';

        $mail->Username = 'soporte.ingenia@rrhhingenia.com';
        $mail->Password = 'miguel2019';

        $mail->setFrom('soporte.ingenia@rrhhingenia.com', 'RRHH Ingenia');
        $mail->addAddress($email, $name);

        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        if ($cc)
            $mail->addCC($cc['email'], $cc['name']);
        if ($mail->send())
            return true;
        else
            return false;
    }

    public static function sendMultipleEmail($emails, $subject, $body, $cc = false)
    {

        require_once 'libraries/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '587';

        $mail->Username = 'soporte.ingenia@rrhhingenia.com';
        $mail->Password = 'miguel2019';

        $mail->setFrom('soporte.ingenia@rrhhingenia.com', 'RRHH Ingenia');
        foreach ($emails as $email) {
            $mail->addAddress($email);
        }
        if ($cc)
            $mail->addCC($cc['email'], $cc['name']);

        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        if ($mail->send())
            return true;
        else
            return false;
    }

    public static function sendEmailPayment($email, $name, $subject, $body, $cc = false)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '587';

        $mail->Username = 'cuentasxcobrar@rrhhingenia.com';
        $mail->Password = 'RRHHI2023';

        $mail->setFrom('cuentasxcobrar@rrhhingenia.com', 'Cuentas Por Cobrar RRHH Ingenia');
        $mail->addAddress($email, $name);

        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        if ($cc)
            $mail->addCC($cc['email'], $cc['name']);
        if ($mail->send())
            return true;
        else
            return false;
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
        return $num . ' de ' . $month . ' de ' . $year;
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

    public static function showProfilePicture()
    {
        $path = "uploads/avatar/" . $_SESSION['identity']->id;
        if (file_exists($path)) {
            $directory = opendir($path);

            while ($file = readdir($directory)) {
                if (!is_dir($file)) {
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $img_content = file_get_contents($path . "/" . $file);
                    $route = $path . '/' . $file;
                }
            }
        } else {
            $route = "dist/img/user-icon.png";
            $type = pathinfo($route, PATHINFO_EXTENSION);
            $img_content = file_get_contents($route);
        }
        //$img_base64 = chunk_split(base64_encode($img_content));
        $img_base64 = 'data:image/jpeg;base64,' . base64_encode($img_content);
        $_SESSION['avatar'] = $img_base64;
        $_SESSION['avatar_route'] = base_url . $route;
    }

    public static function evaluationValues($data)
    {
        if ($data == 1) {
            $correct_data = 5;
        } elseif ($data == 2) {
            $correct_data = 4;
        } elseif ($data == 4) {
            $correct_data = 2;
        } elseif ($data == 5) {
            $correct_data = 1;
        } else {
            $correct_data = 3;
        }

        return $correct_data;
    }

    /**
     * 
     * SA
     */

    public static function getSexo($id_sexo)
    {
        return $id_sexo == 98 ? 'Hombre' : ($id_sexo == 99 ? 'Mujer' : 'No asignado');
    }

    public static function getEstadoCivil($id_estado_civil)
    {
        return $id_estado_civil == 100 ? 'Soltero(a)' : ($id_estado_civil == 101 ? 'Unión libre' : ($id_estado_civil == 102 ? 'Casado(a)' : ($id_estado_civil == 103 ? 'Divorciado(a)' : ($id_estado_civil == 104 ? 'Viudo(a)' : 'No asignado'))));
    }

    public static function getGradoEstudio($id_grado)
    {
        return $id_grado == 112 ? 'Carrera técnica' : ($id_grado == 113 ? 'Postgrado' : ($id_grado == 114 ? 'Primaria' : ($id_grado == 115 ? 'Secundaria' : ($id_grado == 116 ? 'Bachillerato técnico' : ($id_grado == 117 ? 'Preparatoria' : ($id_grado == 118 ? 'Universidad' : ($id_grado == 119 ? 'Diplomado' : ($id_grado == 120 ? 'Maestría' : ($id_grado == 121 ? 'Doctorado' : 'No cuenta')))))))));
    }

    public static function getDocumentoEscolar($id_documento)
    {
        return $id_documento == 122 ? 'Certificado' : ($id_documento == 123 ? 'Diploma' : ($id_documento == 124 ? 'Constancia' : ($id_documento == 125 ? 'Carta pasante' : ($id_documento == 126 ? 'Cédula profesional' : ($id_documento == 297 ? 'Título' : 'No proporcionado')))));
    }

    public static function getTipoReferencia($id_referencia)
    {
        return $id_referencia == 1 ? 'Personal' : ($id_referencia == 2 ? 'Vecinal' : ($id_referencia == 3 ? 'Familiar' : ($id_referencia == 4 ? 'Último arrendador' : '')));
    }

    public static function getParentesco($id_parentesco)
    {
        return $id_parentesco == 130 ? 'Esposo(a)' : ($id_parentesco == 131 ? 'Hijo(a)' : ($id_parentesco == 132 ? 'Hermano(a)' : ($id_parentesco == 133 ? 'Padre/Madre' : ($id_parentesco == 134 ? 'Abuelo(a)' : ($id_parentesco == 135 ? 'Otros' : ($id_parentesco == 136 ? 'Concubino(a)' : ($id_parentesco == 292 ? 'Suegro(a)' : ($id_parentesco == 293 ? 'Cuñado(a)' : ($id_parentesco == 137 ? 'Tío(a)' : ($id_parentesco == 138 ? 'Sobrino(a)' : ($id_parentesco == 139 ? 'Primo(a)' : ($id_parentesco == 144 ? 'Amistad' : ($id_parentesco == 334 ? 'Hijastro(a)' : ($id_parentesco == 335 ? 'Nieto(a)' : ''))))))))))))));
    }


    public static function getTiempoDesplazamiento($id_desplazamiento)
    {
        return $id_desplazamiento == 0 ? 'Menos de 20 minutos' : ($id_desplazamiento == 1 ? 'De 20 a 40 minutos' : ($id_desplazamiento == 2 ? 'De 40 a 60 minutos' : ($id_desplazamiento == 3 ? 'De 1 a 2 horas' : ($id_desplazamiento == 4 ? 'Más de 2 horas' : ''))));
    }

    public static function getTipoVivienda($id_tipo_vivienda)
    {
        return $id_tipo_vivienda == 150 ? 'Casa individual' : ($id_tipo_vivienda == 151 ? 'Departamento' : ($id_tipo_vivienda == 152 ? 'Dúplex' : ($id_tipo_vivienda == 153 ? 'Cuádruplex' : '')));
    }

    public static function getDomicilioEs($id_domicilio_es)
    {
        return $id_domicilio_es == 160 ? 'Propio' : ($id_domicilio_es == 161 ? 'Rentado' : ($id_domicilio_es == 162 ? 'Prestado' : ($id_domicilio_es == 163 ? 'De sus padres' : ($id_domicilio_es == 164 ? 'Otros' : ($id_domicilio_es == 337 ? 'Familiar' : ' ')))));
    }

    public static function getSaludSeguros($seguros)
    {
        $s = '';
        foreach ($seguros as $seguro) {
            $s .= $seguro['Descripcion'] . ', ';
        }
        return substr($s, 0, -2);
    }

    public static function showParentescos()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(107);
        $parentescos = $campo->getCamposByTabla();
        return $parentescos;
    }

    public static function showEstadosCiviles()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(103);
        $estados_civiles = $campo->getCamposByTabla();
        return $estados_civiles;
    }

    public static function showTiposVivienda()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(109);
        $tipos = $campo->getCamposByTabla();
        return $tipos;
    }

    public static function showEstatusDomicilio()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(110);
        $tipos = $campo->getCamposByTabla();
        return $tipos;
    }

    public static function showEstadosMX()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $estados = $campo->getEstados();
        return $estados;
    }

    public static function showEstadosPorPais($pais)
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setPais($pais);
        $estados = $campo->getEstadosPorPais();
        return $estados;
    }

    public static function showEscolaridades()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(105);
        $tipos = $campo->getCamposByTabla();
        return $tipos;
    }

    public static function showDocumentosEscolaridad()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(106);
        $tipos = $campo->getCamposByTabla();
        return $tipos;
    }

    public static function showSaludSeguros()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(108);
        $tipos = $campo->getCamposByTabla();
        return $tipos;
    }

    public static function showEmpresas()
    {
        require_once 'models/SA/Empresas.php';
        $empresa = new Empresas();
        $empresas = $empresa->getAll();
        return $empresas;
    }

    public static function showClientes()
    {
        require_once 'models/SA/Clientes.php';
        $cliente = new Clientes();
        $clientes = $cliente->getAllSuspender();
        return $clientes;
    }

    public static function showClientesPorUsuario()
    {
        require_once 'models/SA/ContactosEmpresa.php';
        $cliente = new ContactosEmpresa();
        $cliente->setUsuario($_SESSION['identity']->username);
        $clientes = $cliente->getClientesPorUsuario();
        return $clientes;
    }

    public static function showRazonesPorUsuario()
    {
        require_once 'models/SA/ContactosEmpresa.php';
        $cliente = new ContactosEmpresa();
        $cliente->setUsuario($_SESSION['identity']->username);
        $clientes = $cliente->getRazonesPorUsuario();
        return $clientes;
    }

    public static function showContactoPorUsuario()
    {
        require_once 'models/SA/ContactosEmpresa.php';
        $cliente = new ContactosEmpresa();
        $cliente->setUsuario($_SESSION['identity']->username);
        $customer = $cliente->getContactoPorUsuario();
        return $customer;
    }

    public static function showServiciosASolicitarPorUsuario()
    {
        require_once 'models/SA/ContactosEmpresa.php';
        $contacto = new ContactosEmpresa();
        $contacto->setUsuario($_SESSION['identity']->username);
        $Empresa = $contacto->getEmpresaPorUsuario();
        $Procedimiento = $Empresa->Nuevo_Procedimiento;
        $ID_Empresa = $Empresa->Empresa;

        $Servicios = [];
        if ($Procedimiento == 0) {
            $Servicios = array(array('Campo' => 230, 'Descripcion' => 'Estudio Socioeconómico (ESE)'), array('Campo' => 231, 'Descripcion' => 'Investigación Laboral'), array('Campo' => 5, 'Descripcion' => 'RAL + ESE'));
        } else {
            $Servicios = array(array('Campo' => 231, 'Descripcion' => 'Investigación Laboral (RAL + Inv. Lab.)'), array('Campo' => 230, 'Descripcion' => 'Estudio Socioeconómico (RAL + Inv. Lab. + Verificación)'));

            if ($ID_Empresa == 87)
                array_push($Servicios, array('Campo' => 300, 'Descripcion' => 'Verificación Domiciliaria'));
        }
        return $Servicios;
    }

    public static function showCumpleanosClientes()
    {
        require_once 'models/SA/ContactosEmpresa.php';
        $cliente = new ContactosEmpresa();
        $clientes = $cliente->getContactosPorCumpleanos();
        return $clientes;
    }

    public static function getNonWorkingDays()
    {
        require_once 'models/NonWorkingDays.php';
        $non_working_day = new NonWorkingDays();
        $non_working_days = $non_working_day->getAll();
        return $non_working_days;
    }

    public static function getOneNonWorkingDay($Fecha)
    {
        require_once 'models/NonWorkingDays.php';
        $non_working_day = new NonWorkingDays();
        $non_working_day->setDate($Fecha);
        $day = $non_working_day->getOne();
        return $day;
    }

    public static function getFechaIngresoSA($Cliente)
    {

        $fechaActual = date('Y-m-d', time());
        $horaActual = date('H:i:s', time());

        $diahab = false;
        $diainhabil = Utils::getOneNonWorkingDay($fechaActual);

        //Solicitud para que estos clientes puedan ingresar hasta antes de las 4, 5 o 6
        //$HoraLimite = $Cliente == 68 || $Cliente == 150 || $Cliente == 264 || $Cliente == 303 || $Cliente == 265 || $Cliente == 316 || $Cliente == 301 || $Cliente == 302 || $Cliente == 315 || $Cliente == 175 || $Cliente == 245 || $Cliente == 43 || $Cliente == 181 || $Cliente == 158 || $Cliente == 180 || $Cliente == 193 || $Cliente == 223 || $Cliente == 23 || $Cliente == 21 || $Cliente == 204 || $Cliente == 358 || $Cliente == 360 || $Cliente == 361 || $Cliente == 221 || $Cliente == 191 || $Cliente == 403 || $Cliente == 410 || $Cliente == 409 || $Cliente ==  61 ? 16 : ($Cliente == 394 || $Cliente == 393 || $Cliente == 412 || $Cliente == 414 || $Cliente == 411 ? 17 : ($Cliente == 395 || $Cliente == 413 ? 18 : 14));
        $HoraLimite = $Cliente == 150 || $Cliente == 264 || $Cliente == 303 || $Cliente == 265 || $Cliente == 316 || $Cliente == 301 || $Cliente == 302 || $Cliente == 315 || $Cliente == 175 || $Cliente == 245 || $Cliente == 43 || $Cliente == 181 || $Cliente == 158 || $Cliente == 180 || $Cliente == 193 || $Cliente == 223 || $Cliente == 23 || $Cliente == 21 || $Cliente == 358 || $Cliente == 360 || $Cliente == 361 || $Cliente == 221 || $Cliente == 191 || $Cliente ==  61 || $Cliente == 506 ? 16 : 14;
        $HoraLimite = $Cliente == 68 ? 17 : $HoraLimite;

        if (date('G', strtotime($horaActual)) >= $HoraLimite) {
            while ($diahab == false) {
                $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));
                if (date('N', strtotime($fechaActual)) == 6 || date('N', strtotime($fechaActual)) == 7) {
                    $diahab = false;
                } else {
                    //Aqui va la consulta tal vez en arreglos 
                    $diainhabil = Utils::getOneNonWorkingDay($fechaActual);
                    if ($diainhabil != 0) {
                        $diahab = false;
                    } else {
                        $diahab = true;
                    }
                }
            }
            return date($fechaActual . " 09:00:00.000");
        } else {
            if (date('G', strtotime($horaActual)) < 9) {
                while ($diahab == false) {
                    if (date('N', strtotime($fechaActual)) == 6 || date('N', strtotime($fechaActual)) == 7) {
                        $diahab = false;
                        $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));
                    } else {
                        //Aqui va la consulta tal vez en arreglos
                        $diainhabil = Utils::getOneNonWorkingDay($fechaActual);
                        if ($diainhabil != 0) {
                            $diahab = false;
                            $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));
                        } else {
                            $diahab = true;
                        }
                    }
                }
                return date($fechaActual . " 09:00:00.000");
            } else {
                //$diainhabil = Utils::getOneNonWorkingDay($fechaActual);
                if (date('N', strtotime($fechaActual)) == 6 || date('N', strtotime($fechaActual)) == 7 || $diainhabil != 0) {
                    while ($diahab == false) {
                        $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));

                        if (date('N', strtotime($fechaActual)) == 6 || date('N', strtotime($fechaActual)) == 7) {
                            $diahab = false;
                        } else {
                            $diainhabil = Utils::getOneNonWorkingDay($fechaActual);
                            if ($diainhabil != 0) {
                                $diahab = false;
                            } else {
                                $diahab = true;
                            }
                        }
                    }
                    return date($fechaActual . " 09:00:00.000");
                } else {
                    return $fechaActual . ' ' . $horaActual . '.000';
                }
            }
        }
    }

    public static function getFechaIngresoVacante()
    {

        $fechaActual = date('Y-m-d', time());
        $horaActual = date('H:i:s', time());

        $diahab = false;
        $diainhabil = Utils::getOneNonWorkingDay($fechaActual);
        if (date('G', strtotime($horaActual)) >= 15) {
            while ($diahab == false) {
                $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));
                if (date('N', strtotime($fechaActual)) == 6 || date('N', strtotime($fechaActual)) == 7) {
                    $diahab = false;
                } else {
                    //Aqui va la consulta tal vez en arreglos 
                    $diainhabil = Utils::getOneNonWorkingDay($fechaActual);
                    if ($diainhabil != 0) {
                        $diahab = false;
                    } else {
                        $diahab = true;
                    }
                }
            }
            return date($fechaActual . " 09:00:00.000");
        } else {
            if (date('G', strtotime($horaActual)) < 9) {
                while ($diahab == false) {
                    if (date('N', strtotime($fechaActual)) == 6 || date('N', strtotime($fechaActual)) == 7) {
                        $diahab = false;
                        $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));
                    } else {
                        //Aqui va la consulta tal vez en arreglos
                        $diainhabil = Utils::getOneNonWorkingDay($fechaActual);
                        if ($diainhabil != 0) {
                            $diahab = false;
                            $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));
                        } else {
                            $diahab = true;
                        }
                    }
                }
                return date($fechaActual . " 09:00:00.000");
            } else {
                //$diainhabil = Utils::getOneNonWorkingDay($fechaActual);
                if (date('N', strtotime($fechaActual)) == 6 || date('N', strtotime($fechaActual)) == 7 || $diainhabil != 0) {
                    while ($diahab == false) {
                        $fechaActual = date("Y-m-d", strtotime($fechaActual . "+ 1 days"));
                        $diainhabil = Utils::getOneNonWorkingDay($fechaActual);
                        if (date('N', strtotime($fechaActual)) == 6 || date('N', strtotime($fechaActual)) == 7)
                            $diahab = false;
                        else {
                            if ($diainhabil != 0)
                                $diahab = false;
                            else
                                $diahab = true;
                        }
                    }
                    return date($fechaActual . " 09:00:00.000");
                } else {
                    return $fechaActual . ' ' . $horaActual . '.000';
                }
            }
        }
    }

    public static function getDisplayBotones()
    {
        $displaySA = (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) && !Utils::isCustomerSA() ? 'block' : 'none';
        $displayAccount = (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isAccount()) && !Utils::isCustomerSA() ? 'block' : 'none';
        $displayAccountCustomerSA = (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor()) || Utils::isCustomerSA() ? 'block' : 'none';
        $displayLogistics = (Utils::isAdmin() || Utils::isSAManager() || Utils::isLogisticsSupervisor() || Utils::isLogistics() || Utils::isOperationsSupervisor()) && !Utils::isCustomerSA() ? 'block' : 'none';
        $displayOperations = (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor()) && !Utils::isCustomerSA() ? 'block' : 'none';
        $displayLogisticManagement = (Utils::isAdmin() || Utils::isSAManager() || Utils::isLogisticsSupervisor()) && !Utils::isCustomerSA() ? 'block' : 'none';
        $displaySAManagement = $_SESSION['identity']->username == 'juanitahernandez' ? 'block' : 'none';

        return array(
            'SA' => $displaySA,
            'Account' => $displayAccount,
            'AccountCustomerSA' => $displayAccountCustomerSA,
            'Logistics' => $displayLogistics,
            'Operations' => $displayOperations,
            'LogisticManagement' => $displayLogisticManagement,
            'SAManagement' => $displaySAManagement
        );
    }

    public static function showDocumentos()
    {
        require_once 'models/SA/SysCampo.php';
        $campo = new SysCampo();
        $campo->setTabla(104);
        $tipos = $campo->getCamposByTabla();
        return $tipos;
    }

    public static function getImage($dataURI)
    {
        $img = explode(',', $dataURI, 2);
        $pic = 'data://text/plain;base64,' . $img[1];
        $type = explode("/", explode(':', substr($dataURI, 0, strpos($dataURI, ';')))[1])[1]; // get the image type
        if ($type == "png" || $type == "jpeg" || $type == "gif" || $type == "jpg") return array($pic, $type);
        return false;
    }

    public static function recursive_array_intersect_key(array $array1, array $array2)
    {
        $array1 = array_intersect_key($array1, $array2);
        foreach ($array1 as $key => &$value) {
            if (is_array($value) && is_array($array2[$key])) {
                $value = Utils::recursive_array_intersect_key($value, $array2[$key]);
            }
        }
        return $array1;
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


    public static function getEmpresaByContacto()
    {
        require_once 'models/SA/ContactosCliente.php';
        require_once 'models/SA/ContactosEmpresa.php';
        require_once 'models/SA/Clientes.php';

        if (Utils::isCustomerSA()) {
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

            $contactoCliente = new ContactosCliente();
            $contactoCliente->setID_Contacto($id_contacto);
            $contacto = $contactoCliente->getClientesByContacto();
        } else {
            $clientes = new Clientes();
            $contacto = $clientes->getAll();
        }
        return $contacto;
    }

    public static function getCatalogoOcupaciones()
    {
        require_once 'models/RH/CatalogoOcupaciones.php';
        $catalogoOcupaciones = new CatalogoOcupaciones();
        $catalogoOcupaciones = $catalogoOcupaciones->getAll();
        return $catalogoOcupaciones;
    }

    public static function getCatalogoAreasTematicas()
    {
        require_once 'models/RH/CatalogoAreasTematicas.php';
        $catalogoAreasTematicas = new CatalogoAreasTematicas();
        $catalogoAreasTematicas = $catalogoAreasTematicas->getAll();
        return $catalogoAreasTematicas;
    }
    public static function showAreasTematicas($clave)
    {
        require_once 'models/RH/CatalogoAreasTematicas.php';
        $catalogoAreasTematicas = new CatalogoAreasTematicas();
        $catalogoAreasTematicas->setClave($clave);
        $catalogoAreasTematicas = $catalogoAreasTematicas->getOne();
        return $catalogoAreasTematicas->descripcion;
    }

    public static function labelContact($label)
    {
        switch ($label) {
            case '0':
                return 'Movil';
                break;
            case '1':
                return 'Casa';
                break;
            case '2':
                return 'Personal';
                break;
            case '3':
                return 'Trabajo';
                break;
            case '4':
                return 'Otros';
                break;
            default:
                return 'Otros';
                break;
        }
    }

    public static function labelFamily($label)
    {
        $arrayFamily = array('Esposa', 'Esposo', 'Hija', 'Hijo', 'Madre', 'Padre');
        if ($label <= count($arrayFamily) && $label > 0)
            return $arrayFamily[$label - 1];
        else
            return 'Otros';
    }

    public static function removeSpaces($cadena)
    {
        return implode(' ', array_filter(explode(' ', $cadena)));
    }

    public static function removeAccents($string)
    {
        $unwanted_array = array(
            'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
        );
        return strtr($string, $unwanted_array);
    }

    public static function contractType()
    {
        return  array('', 'Periodo de prueba', 'Capacitación', 'Laborales temporal', 'Tiempo determinado', 'Tiempo indeterminado');
    }

    public static function getQuestionsCriterionByIdCriterion($id_criterion)
    {
        require_once 'models/RH/Questions.php';
        $questionsObj = new Questions();
        $questionsObj->setId_criterion($id_criterion);
        $questionsObj->setStatus(1);
        $questions = $questionsObj->getAllByIdCriterion();
        return $questions;
    }

    public static function getCriterionScoreByIdCriterion($id_criterion)
    {
        require_once 'models/RH/CriterionScore.php';
        $criterionScoreObj = new CriterionScore();
        $criterionScoreObj->setId_criterion($id_criterion);
        $criterionScoreObj->setStatus(1);

        $criterionScore = $criterionScoreObj->getAllByIdCriterion();
        return $criterionScore;
    }

    public static function getAllCriterionsByIdCategory($id_category)
    {
        require_once 'models/RH/CategoryCriterion.php';
        $categoryCriterionObj = new CategoryCriterion();
        $categoryCriterionObj->setId_category($id_category);
        $categoryCriterionObj->setStatus(1);
        $categoryCriterion = $categoryCriterionObj->getAllByIdCategory();
        return $categoryCriterion;
    }

    public static function showRazonesSocialesPorID($ID)
    {
        require_once 'models/SA/RazonesSociales.php';
        $razon = new RazonesSociales();
        $razon->setID_Razon($ID);
        $razones = $razon->getOne();
        return $razones;
    }

    public static function getTypePosition($position)
    {
        $arryaTypePostion = array('', 'Gerencia', 'Subgerencia', 'Administrativo', 'Supervisorios / Coordinacion', 'Operativo');
        return $arryaTypePostion[$position];
    }


    public static function getAniosSA()
    {
        require_once 'models/SA/Candidatos.php';
        $candidato = new Candidatos();
        $anios = $candidato->getAnios();
        return $anios;
    }

    //=======================[ULISES 23 Feb]===================================================
    public static function showCumpleanosClientesReclu()
    {
        require_once 'models/CustomerContact.php';
        $customerContact = new CustomerContact();
        $customerContact = $customerContact->getBirthdayByClient();
        return $customerContact;
    }
    //==========================[Ulises 24 Feb ESE en ingles]================================================

    public static function getEstadoCivilIng($id_estado_civil)
    {
        return $id_estado_civil == 100 ? 'Single' : ($id_estado_civil == 101 ? 'Free Union' : ($id_estado_civil == 102 ? 'Married' : ($id_estado_civil == 103 ? 'Divorced' : ($id_estado_civil == 104 ? 'Widower' : 'Not assigned'))));
    }

    public static function getGradoEstudioIng($id_grado)
    {
        return $id_grado == 112 ? 'CTechnical start' : ($id_grado == 113 ? 'Postgraduate' : ($id_grado == 114 ? 'Elementary school' : ($id_grado == 115 ? 'Secondary' : ($id_grado == 116 ? 'Baccalaureate technician' : ($id_grado == 117 ? 'Preparatory' : ($id_grado == 118 ? 'universidad' : ($id_grado == 119 ? 'diplomat' : ($id_grado == 120 ? "master's degree" : ($id_grado == 121 ? 'Doctorate' : 'Not assigned')))))))));
    }

    public static function getDocumentoEscolarIng($id_documento)
    {
        return $id_documento == 122 ? 'Certificate' : ($id_documento == 123 ? 'diploma' : ($id_documento == 124 ? 'Constancy' : ($id_documento == 125 ? 'Intern letter' : ($id_documento == 126 ? 'Professional ID' : ($id_documento == 297 ? 'Title' : 'Not assigned')))));
    }

    public static function getTipoReferenciaIng($id_referencia)
    {
        return $id_referencia == 1 ? 'Personal' : ($id_referencia == 2 ? 'Neighborhood' : ($id_referencia == 3 ? 'Family' : ''));
    }


    public static function getParentescoIng($id_parentesco)
    {
        return $id_parentesco == 130 ? 'Spouse' : ($id_parentesco == 131 ? 'Children' : ($id_parentesco == 132 ? 'Sibling' : ($id_parentesco == 133 ? 'father/Mother' : ($id_parentesco == 134 ? 'Grandparent' : ($id_parentesco == 135 ? 'Others' : ($id_parentesco == 136 ? 'Common-law' : ($id_parentesco == 292 ? 'Parent-in-law' : ($id_parentesco == 293 ? 'brother in law' : ($id_parentesco == 137 ? 'Uncle/Aunt' : ($id_parentesco == 138 ? 'Nephew/Niece' : ($id_parentesco == 139 ? 'Cousin' : ($id_parentesco == 144 ? 'Friendship' : ($id_parentesco == 334 ? 'Stepson/Stepdaughter' : ($id_parentesco == 335 ? 'Grandson/Granddaughter' : ''))))))))))))));
    }

    public static function getTiempoDesplazamientoIng($id_desplazamiento)
    {
        return $id_desplazamiento == 0 ? 'Menos de 20 minutos' : ($id_desplazamiento == 1 ? 'De 20 a 40 minutos' : ($id_desplazamiento == 2 ? 'De 40 a 60 minutos' : ($id_desplazamiento == 3 ? 'De 1 a 2 horas' : ($id_desplazamiento == 4 ? 'Más de 2 horas' : ''))));
    }

    public static function getTipoViviendaIng($id_tipo_vivienda)
    {
        return $id_tipo_vivienda == 150 ? 'Individual house' : ($id_tipo_vivienda == 151 ? 'Department' : ($id_tipo_vivienda == 152 ? 'Duplex' : ($id_tipo_vivienda == 153 ? 'Cuadruplex' : '')));
    }

    public static function getDomicilioEsIng($id_domicilio_es)
    {
        return $id_domicilio_es == 160 ? 'Own' : ($id_domicilio_es == 161 ? 'Home rental' : ($id_domicilio_es == 162 ? 'Rendered' : ($id_domicilio_es == 163 ? "parents' house" : ($id_domicilio_es == 164 ? 'Others' : ($id_domicilio_es == 337 ? 'Familiar' : ' ')))));
    }

    public static function getEconomiaFamiliarIng($Economia)
    {
        $arrayEconomy = array(
            'Otros' => 'Others', 'Pagos de seguros' => 'Insurance payments', 'Ahorro' => 'Saving', 'Créditos' => 'Credits', 'Vestido, calzado' => 'Dress, footwear',
            'Transporte, gasolina' => 'Transportation, gasoline', 'Educación' => 'Education', 'Alimentación' => 'Feeding', 'Gas' => 'Gas service', 'Tv paga, Internet' => 'Streaming Tv, Internet',
            'Celular' => 'Cell phone', 'Luz' => 'Light service', 'Agua' => 'Water service', 'Renta o Hipoteca' => 'Rent or Mortgage'
        );
        return $arrayEconomy[$Economia];
    }

    public static function getMonthsIng()
    {
        $months = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        return $months;
    }
    //==========================================================================

    //===========================[Ulises 6 de marzo]===============================================
    public static function eliminarAcentos($cadena)
    {
        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        $cadena = $cadena;

        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena
        );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena
        );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena
        );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena
        );

        return $cadena;
    }

    public static function newNotification($message, $url, $status, $id_type, $id_user, $created_by, $cliente = NULL, $customer = NULL)
    {
        $notification = new Notification();
        $notification->setId_user($id_user);
        $notification->setMessage($message);
        $notification->setUrl($url);
        $notification->setStatus($status);
        $notification->setId_type($id_type);
        $notification->setCreated_by($created_by);
        $notification->setCliente($cliente);
        $notification->setCustomer($customer);
        $notification->create();
    }

    public static function permission($controller, $action)
    {
        if (isset($_SESSION['accesos'])) {
            $permissions = $_SESSION['accesos'];
            $controller = (str_replace('controller', '', strtolower($controller)));
            for ($i = 0; $i < count($permissions); $i++) {
                if (strtolower($permissions[$i]['section_name']) == $controller && $permissions[$i][$action] == 1) {
                    return true;
                }
            }
            return false;
        } else
            return true;
    }
    //==========================================================================

    //==================================[Gabo Marzo 21]=========================
    public static function getVacantesEnProceso()
    {
        require_once 'models/Vacancy.php';
        $vacantes = new Vacancy();
        if (Utils::isRecruitmentManager()) {
            $vacantes->setId_recruiter($_SESSION['identity']->id);
            $vacantes = $vacantes->getVacanciesInProcessByIdRecruiter();
        } else {
            $vacantes = $vacantes->getVacanciesInProcess();
        }

        return $vacantes;
    }
    //==========================================================================
    //==================================[Ulises Marzo 31 Vetar cliente]=========
    public static function isClienteVetado($Cliente)
    {
        require_once 'models/SA/Clientes.php';
        $clienteObj = new Clientes();
        $clienteObj->setCliente($Cliente);
        $cliente = $clienteObj->getOne();
        $Cliente_vetado = $cliente->Activo == 0 ? header('location:' . base_url) : '';
        return $Cliente_vetado;
    }
    //==========================================================================

    //==================================[Ulises Abril 18 Acentos]=========
    public static function upperAcentos($texto)
    {
        $vocales = array("á", "é", "í", "ó", "ú", "ñ");
        $vocalesAcentos = array("Á", "É", "Í", "Ó", "Ú", 'Ñ');
        $texto = str_replace($vocales, $vocalesAcentos, $texto);
        return $texto;
    }
    //==========================================================================

    //==================================[Ulises Abril 20 ]=========
    public static function estudiosPorCliente($Anio, $Cliente)
    {
        require_once 'models/CustomerContact.php';

        $candidato = new Candidatos();
        $candidato->setFecha_solicitud($Anio);
        $candidato->setCliente($Cliente);
        $clientes = $candidato->getDetallePorAnioYCliente();

        return $clientes;
    }
    //==========================================================================
    //==================================[Ulises Abril 21 ]=========
    public static function avisoClientes()
    {
        require_once 'models/SA/AvisoClientes.php';
        require_once 'models/SA/ContactosEmpresa.php';

        if (Utils::isCustomerSA()) {
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;
        }

        $AvisoClientes = new AvisoClientes();
        if (Utils::isCustomer() && Utils::isCustomerSA()) { //estado 2 y 3
            $AvisoClientes = $AvisoClientes->getAll();

            for ($i = 0; $i < count($AvisoClientes); $i++) {
                if ($AvisoClientes[$i]['id'] == 6 && $Empresa != 45)
                    unset($AvisoClientes[$i]); // Se elimina este id porque solo es para Transpais
            }
        } else  if (Utils::isCustomerSA()) {
            $AvisoClientes = $AvisoClientes->getAllSA(); //Estado 2

            for ($i = 0; $i < count($AvisoClientes); $i++) {
                if ($AvisoClientes[$i]['id'] == 6 && $Empresa != 45)
                    unset($AvisoClientes[$i]); // Se elimina este id porque solo es para Transpais
            }
        } else  if (Utils::isCustomer()) {
            $AvisoClientes = $AvisoClientes->getAllReclu(); //Estado 3
        }

        return $AvisoClientes;
    }
    //==========================================================================
    //==================================[Ulises MAyo 17 ]=========
    public static function nameVacancy($id)
    {
        require_once 'models/Bill.php';
        $bill = new Bill();
        $bill->setId($id);
        $applicants = $bill->getApplicantsByBill();
        $name = '';

        foreach ($applicants as $applicant) {
            if (count($applicants) == 1) {
                $name = $applicant['vacancy'];
            } else {
                $name .= $applicant['vacancy'] . ' - ';
            }
        }

        return $name;
    }
    //==========================================================================    //===[gabo 6 junio puestos fin]===
    public static function showID_ClienteByID_ContactoPositon($id_contacto)
    {
        require_once 'models/SA/ContactosCliente.php';
        $ContactosCliente = new ContactosCliente();
        $ContactosCliente->setID_Contacto($id_contacto);
        $id_clientes = $ContactosCliente->GetID_ClientesPorID_Contacto();
        $ids_clientes = "";
        $primero = true;

        foreach ($id_clientes as $clientes) {

            if ($primero) {
                $ids_clientes .= "p.ID_Cliente=" . $clientes['ID_Cliente'];
                $primero = false;
            } else {
                $ids_clientes .= " OR p.ID_Cliente=" . $clientes['ID_Cliente'];
            }
        }


        return $ids_clientes;
    }
    //===[gabo 6 junio puestos fin]===

    //===[gabo 6 junio departamento]===
    public static function showID_ClienteByID_ContactoDpto($id_contacto)
    {
        require_once 'models/SA/ContactosCliente.php';
        $ContactosCliente = new ContactosCliente();
        $ContactosCliente->setID_Contacto($id_contacto);
        $id_clientes = $ContactosCliente->GetID_ClientesPorID_Contacto();
        $ids_clientes = "";
        $primero = true;

        foreach ($id_clientes as $clientes) {

            if ($primero) {
                $ids_clientes .= "d.ID_Cliente=" . $clientes['ID_Cliente'];
                $primero = false;
            } else {
                $ids_clientes .= " OR d.ID_Cliente=" . $clientes['ID_Cliente'];
            }
        }

        //===[gabo 6 junio departamento fin]===
        return $ids_clientes;
    }

    public static function showID_ClienteByID_Contacto($id_contacto)
    {
        require_once 'models/SA/ContactosCliente.php';
        $ContactosCliente = new ContactosCliente();
        $ContactosCliente->setID_Contacto($id_contacto);
        $id_clientes = $ContactosCliente->GetID_ClientesPorID_Contacto();
        $ids_clientes = "";
        $primero = true;

        foreach ($id_clientes as $clientes) {
            if ($primero) {
                $ids_clientes .= "ge.ID_Cliente=" . $clientes['ID_Cliente'];
                $primero = false;
            } else {
                $ids_clientes .= " OR ge.ID_Cliente=" . $clientes['ID_Cliente'];
            }
        }


        //===[gabo 6 junio evaluaciones fin]===
        return $ids_clientes;
    }

    //===[gabo 6 junio evaluaciones fin]===


    //======================[Ulises RH]=========================
    public static function showPackages()
    {
        require_once 'models/RH/PackagesRH.php';
        $PackagesRHObj = new PackagesRH();
        $PackagesRH = $PackagesRHObj->getAll();

        return $PackagesRH;
    }

    public static function activeModuleRH()
    {
        require_once 'models/SA/Clientes.php';

        if (isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] != 0) {

            $clienteObj = new Clientes();
            $clienteObj->setCliente($_SESSION['id_cliente']);
            $active = $clienteObj->getOne()->Modulo_RH == 1 ? true : false;
        } else {
            $active = false;
        }

        return $active;
    }

    public static function getEmpresaByContactoRH()
    {
        require_once 'models/SA/ContactosCliente.php';
        require_once 'models/SA/ContactosEmpresa.php';
        require_once 'models/SA/Clientes.php';

        if (Utils::isCustomerSA()) {
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;

            $contactoCliente = new ContactosCliente();
            $contactoCliente->setID_Contacto($id_contacto);
            $contacto = $contactoCliente->getClientesByContactoAcriveRH();
        } else {
            $clientes = new Clientes();
            $contacto = $clientes->getAll();
        }
        return $contacto;
    }

    public static function showUsuariosByVentas()
    {
        require_once 'models/user.php';
        $user = new User();
        $roles = $user->showUsuariosByVentas();
        return $roles;

        return $contacto;
    }

    public static function userClientePrudential($empresa)
    {
        $id = $_SESSION['identity']->id;
        if ($empresa == 525 && ($id != 9517 || $id != 9518 || $id != 9510 || $id != 9511 || $id != 9512 || $id != 9513)) {
            $falg = true;
        } else {
            $falg = false;
        }
        return $falg;
    }
    //gabo 5 septiembre
    public static function getVacanciesInProcessByIdRecruiter($id)
    {
        require_once 'models/Vacancy.php';
        $vacantes = new Vacancy();
        if (Utils::isAdmin()) {
            $vacantes = $vacantes->getVacanciesInProcess();
        } else {
            $vacantes = $vacantes->getVacanciesInProcessByIdRecruiter($id);
        }

        return $vacantes;
    }

    public static function getEjecutivosPorCliente($cliente)
    {
        require_once 'models/SA/EjecutivosPlazas.php';

        $EjecutivosPlazasObj = new EjecutivosPlazas();
        $EjecutivosPlazasObj->setID_Cliente($cliente);
        $EjecutivosPlazas = $EjecutivosPlazasObj->getEjecutivosPorCliente();

        if (count($EjecutivosPlazas) == 0) {
            $EjecutivosPlazas = array('username' => 'angelesdelacruz', 'first_name' => 'Angeles', 'last_name' => 'de la cruz');
        }

        return $EjecutivosPlazas;
    }
    //11 sep
    public static function getTypesByCliente()
    {
        require_once 'models/RH/AsistenceTypes.php';
        $Atypes = new AsistenceTypes();
        $Atypes->setClient($_SESSION['identity']->id_cliente);
        $tipos = $Atypes->getAllByClient();
        return $tipos;
    }

    //15 sept

    public static function getVentasContactoTipo()
    {
        require_once 'models/SA/VentasContactoTipo.php';
        $tipo = new VentasContactoTipo();
        $tipos = $tipo->getAll();
        return $tipos;
    }
}
