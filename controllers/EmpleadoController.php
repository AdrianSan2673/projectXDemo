<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/Department.php';
require_once 'models/RH/EffectivenessIndicatiors.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/InterpersonalSkills.php';
require_once 'models/RH/Positions.php';
require_once 'models/RH/PositionsToAspire.php';
require_once 'models/RH/RequiredKnowledge.php';
require_once 'models/RH/SpecificResponsabilities.php';
require_once 'models/RH/SupervisingPositions.php';
require_once 'models/RH/EmployeeContact.php';
require_once 'models/RH/EmployeePayroll.php';
require_once 'models/RH/Employee_trainings.php';
require_once 'models/RH/HistoryPositions.php';
require_once 'models/RH/EmployeeContract.php';
require_once 'models/RH/EmployeeAvatar.php';
require_once 'models/RH/EmployeeFamily.php';

class EmpleadoController
{
    public function index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
                $status = Encryption::decode($_GET['flag']);
                if ($status == 0 || $status == 1) {
                    $contactoEmpresa = new ContactosEmpresa();
                    $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                    $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                    $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                    $employee = new Employees();
                    $employee->setCliente($_SESSION['id_cliente']);
                    $employee->setStatus($status);
                    $employees = $employee->getAllEmployeesByCliente();
                } else
                    header("location:" . base_url);
            } else {
                $employee = new Employees();
                $employees = $employee->getAll();
            }

            $page_title = 'Empleados | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/employee/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }



    public function nuevo()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            if (Utils::isCustomerSA()) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $positionObj2 = new Positions();
                $positionObj2->setID_Contacto($id_contacto);
                $positionObj2->setStatus(1);
                $positionObj2->setType_position(5);
                $positionObj = $positionObj2->getPositionsByContacto();
                $type_positions = $positionObj2->getAllPositionByTypePosition();

                $deparment = new Department();
                $deparment->setEmpresa($Empresa);
                $deparment = $deparment->getDepartmentsByEmpresa();
            }

            $lbl_executives = "";
            $page_title = 'Nuevo Empleado | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/employee/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header("location:" . base_url);
        }
    }



    public function ver()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $id = Encryption::decode($_GET['id']);

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $employeeObj = new Employees();
            $employeeObj->setId($id);
            $employee = $employeeObj->getOne();

            $employeeObj->setStatus(1);
            $employeeObj->setCliente($_SESSION['id_cliente']);
            //$employeeObj->setID_Contacto($id_contacto);
            $incidens = $employeeObj->getAllEmployeesIncidenceByIdEmployee();
            $employees = $employeeObj->getAllEmployeesByCliente();

            $employeeFamilyObj = new EmployeeFamily();
            $employeeFamilyObj->setId_employee($id);
            $employeeFamily = $employeeFamilyObj->getAllByIdEmployee();

            $employeeContractObj = new EmployeeContract();
            $employeeContractObj->setId_employee($id);
            $employeeContract = $employeeContractObj->getOneByIdEmployee();
            $employeeContractAll = $employeeContractObj->getAllByIdEmployee();

            $positionObj = new Positions();
            $positionObj->setId($employee->id_position);
            $positionObj->setStatus(1);
            $positionObj->setID_Cliente($_SESSION['id_cliente']);
            $positionObj->setType_position(5);
            $position = $positionObj->getOne();
            $type_positions = $positionObj->getAllPositionByTypePosition();

            $positionObj->setID_Cliente($_SESSION['id_cliente']);
            $positionObj->setStatus(1);
            $positionContac = $positionObj->getPositionsByCliente();

            $deparment = new Department();
            $deparment->setId($position->id_department);
            $deparment = $deparment->getOne();

            $employee_contacts = new EmployeeContact();
            $employee_contacts->setId_employee($id);
            $employee_contacts = $employee_contacts->getOne();

            $employeePayrollObj = new EmployeePayroll();
            $employeePayrollObj->setId_employee($id);
            $employeePayroll = $employeePayrollObj->getOne();
            $employeePayrollAll = $employeePayrollObj->getAll();

            $employee_trainingsObj = new Employee_trainings();
            $employee_trainingsObj->setId_employee($id);
            $employee_trainings = $employee_trainingsObj->getAllByIdEmployee();

            $avatar = new EmployeeAvatar();
            $avatar->setId_employee($id);
            $avatar = $avatar->getOneByIdEmployee();

            if (!$avatar) {
                $avatar = new stdClass();
                if ($employee->id_gender == 2)
                    $avatar->image = array('../dist/img/user-icon-rose.png', 'png', false);
                else
                    $avatar->image = array('../dist/img/user-icon.png', 'png', false);
            } else
                $avatar->image[2] = true;

            //Label para los telefonos
            $arrayLabel = array(
                ['id'  => '0', "label"  => "Movil"],
                ['id'  => '1', "label"  => "Casa"],
                ['id'  => '2', "label"  => "Personal"],
                ['id'  => '3', "label"  => "Trabajo"],
                ['id'  => '4', "label"  => "Otros"]
            );

            $historyPositionsObj = new HistoryPositions();
            $historyPositionsObj->setId_employee($id);
            $historyPositions = $historyPositionsObj->getAllByIdEmployee();

            $pathDocument = 'uploads/cv/' . $id;
            if (file_exists($pathDocument)) {
                $directory = opendir($pathDocument);

                while ($file = readdir($directory)) {
                    if (!is_dir($file)) {
                        $type = pathinfo($pathDocument, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($pathDocument . "/" . $file);
                        $routeDocu = $pathDocument . '/' . $file;
                    }
                }
                $routeDocu = base_url . $routeDocu;
            } else
                $routeDocu = false;

            $pathDocumentRFC = 'uploads/rfc/' . $id;
            if (file_exists($pathDocumentRFC)) {
                $directoryrfc = opendir($pathDocumentRFC);

                while ($file = readdir($directoryrfc)) {
                    if (!is_dir($file)) {
                        /*      $type = pathinfo($pathDocumentRFC, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($pathDocumentRFC . "/" . $file); */
                        $routeDocuRFC = $pathDocumentRFC . '/' . $file;
                    }
                }
                $routeDocuRFC = base_url . $routeDocuRFC;
            } else
                $routeDocuRFC = false;


            $pathDocumentCFDI = 'uploads/cfdi/' . $id;
            if (file_exists($pathDocumentCFDI)) {
                $directoryrfc = opendir($pathDocumentCFDI);

                while ($file = readdir($directoryrfc)) {
                    if (!is_dir($file)) {
                        /*      $type = pathinfo($pathDocumentCFDI, PATHINFO_EXTENSION);
                        $img_content = file_get_contents($pathDocumentCFDI . "/" . $file); */
                        $routeDocuCFDI = $pathDocumentCFDI . '/' . $file;
                    }
                }
                $routeDocuCFDI = base_url . $routeDocuCFDI;
            } else
                $routeDocuCFDI = false;


            $lbl_executives = "";
            $page_title = $employee->first_name . ' ' . $employee->surname . ' | RRHH Ingenia';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/employee/moda-general-data.php';
            require_once 'views/employee/modal-contract.php';
            require_once 'views/employee/modal-family.php';
            require_once 'views/employee/modal-data-contact.php';
            require_once 'views/employee/modal-data-emergency.php';
            require_once 'views/employee/modal-historyposition.php';
            require_once 'views/employee/modal-baja.php';
            require_once 'views/employee/modal-alta.php';
            require_once 'views/employee/modal-incidence.php';
            require_once 'views/employee/modal-payroll.php';
            require_once 'views/employee/modal-imagen.php';
            require_once 'views/employee/read.php';
            require_once 'views/layout/footer.php';
        } else
            header("location:" . base_url);
    }

   
    public function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = isset($_POST['id']) ? Utils::sanitizeNumber(Encryption::decode($_POST['id'])) : null;
            $first_name = Utils::sanitizeStringBlank($_POST['first_name']);
            $surname = Utils::sanitizeStringBlank($_POST['surname']);
            $last_name = Utils::sanitizeStringBlank($_POST['last_name']);
            $Cliente = Utils::sanitizeNumber($_POST['cliente']);
            $ID_Contacto = Utils::sanitizeNumber(Encryption::decode($_POST['ID_Contacto']));
            $Empresa = Utils::sanitizeNumber(Encryption::decode($_POST['Empresa']));
            $date_birth = Utils::sanitizeString($_POST['date_birth']);
            $id_gender = Utils::sanitizeNumber($_POST['id_gender']);
            $start_date = Utils::sanitizeString($_POST['start_date']);
            $end_date =  isset($_POST['end_date']) ?  Utils::sanitizeString($_POST['end_date']) : null;
            $id_position = Utils::sanitizeString(isset($_POST['id_position']) ? $_POST['id_position'] : '0');
            $new_position = isset($_POST['new_position']) ? Utils::sanitizeString($_POST['new_position']) : null;
            $id_departament = Utils::sanitizeString(isset($_POST['id_departament']) ? $_POST['id_departament'] : '0');
            $new_deparment = isset($_POST['new_deparment']) ? Utils::sanitizeString($_POST['new_deparment']) : null;
            $reason_for_leaving = isset($_POST['reason_for_leaving']) ? Utils::sanitizeString($_POST['reason_for_leaving']) : null;
            $comment_for_leaving = isset($_POST['comment_for_leaving']) ? Utils::sanitizeStringBlank($_POST['comment_for_leaving']) : null;
            $re_entry_date = isset($_POST['re_entry_date']) && $_POST['re_entry_date'] != '' ? Utils::sanitizeStringBlank($_POST['re_entry_date']) : null;
            $curp = isset($_POST['curp']) ? Utils::sanitizeString($_POST['curp']) : null;
            $rfc = isset($_POST['rfc']) ? Utils::sanitizeString($_POST['rfc']) : null;
            $nss = isset($_POST['nss']) ? Utils::sanitizeString($_POST['nss']) : null;
            $scholarship = isset($_POST['scholarship']) ? Utils::sanitizeString($_POST['scholarship']) : null;
            $employee_number = isset($_POST['employee_number']) && $_POST['employee_number'] != 0 ? Utils::sanitizeNumber($_POST['employee_number']) : null;
            $civil_status =  isset($_POST['civil_status']) ?  Utils::sanitizeString($_POST['civil_status']) : null;
            $id_razon = Utils::sanitizeNumber($_POST['id_razon']);
            $id_boss =  Encryption::decode($_POST['id_boss']) ?  Encryption::decode($_POST['id_boss']) : null;

            if (isset($_POST['contract'])) {
                $contract = Encryption::decode($_POST['contract']);
                $contractType = Utils::contractType();
                $contractType = $contractType[$contract];
                if ($contract < 5 && isset($_POST['number']) && isset($_POST['period'])) {
                    $number = Utils::sanitizeNumber($_POST['number']);
                    $period = Utils::sanitizeString($_POST['period']);
                }
            }

            //Las consultas de abajo es solo para ver si el cliente esta creando un nuevo puesto y/o departamento
            if ($id_position == 0 && $new_position) {
                $deparment = new Department();
                if ($id_departament == 0 && $new_deparment) {
                    $deparment->setDepartment($new_deparment);
                    $deparment->setID_Contacto($ID_Contacto);
                    $deparment->setEmpresa($Empresa);
                    //===[gabo 9 junio excel evaluaciones]===
                    $deparment->setID_Cliente($Cliente);
                    //===[gabo 9 junio excel evaluaciones fin]===
                    $deparment2 = $deparment->save();

                    if ($deparment2) {
                        $id_departament = $deparment->getId();
                    } else {
                        echo json_encode(array('status' => 2));
                        die();
                    }
                } else if (isset($id_departament)) {
                    $id_departament = Encryption::decode($id_departament);
                } else {
                    echo json_encode(array('status' => 0));
                    die();
                }

                if (isset($id_departament)) {
                    $position = new Positions();
                    $position->setTitle($new_position);
                    $position->setId_department($id_departament);
                    $position->setId_created_by($_SESSION['identity']->id);
                    $position->setEmpresa($Empresa);
                    $position->setID_Contacto($ID_Contacto);
                    //===[gabo 9 junio excel evaluaciones]===
                    $deparment->setID_Cliente($Cliente);
                    //===[gabo 9 junio excel evaluaciones fin]===
                    $position2 = $position->save2();
                    if ($position2) {
                        $id_position = $position->getId();
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                } else {
                    echo json_encode(array('status' => 2));
                    die();
                }
            } else if (isset($id_position)) {
                $position = new Positions();
                $id_position = Encryption::decode($id_position);
            } else {
                echo json_encode(array('status' => 0));
                die();
            }


            //Aqui inicia el save o update
            $flag = Encryption::decode($_POST['flag']);
            if ($first_name && $last_name && $surname && $ID_Contacto && $date_birth && $id_gender && $start_date && $id_position) {
                $employee = new Employees();
                $employee->setId($id);
                $employee->setFirst_name($first_name);
                $employee->setSurname($surname);
                $employee->setLast_name($last_name);
                //$employee->setID_Candidato(null);
                $employee->setCliente($Cliente);
                $employee->setID_Contacto($ID_Contacto);
                $employee->setDate_birth($date_birth);
                $employee->setId_gender($id_gender);
                $employee->setStart_date($start_date);
                $employee->setId_position($id_position);
                $employee->setEnd_date($end_date);
                $employee->setReason_for_leaving($reason_for_leaving);
                $employee->setComment_for_leaving($comment_for_leaving);
                $employee->setRe_entry_date($re_entry_date);
                $employee->setScholarship($scholarship);
                $employee->setCurp($curp);
                $employee->setRfc($rfc);
                $employee->setNss($nss);
                $employee->setEmployee_number($employee_number);
                $employee->setCivil_status($civil_status);
                $employee->setId_razon($id_razon);
                $employee->setId_boss($id_boss);

                if ($flag == 1) {

                    //===[gabo 11 julio validar curp]===
                    //validar que no exista el curp con ese cliente
                    $validado = $employee->Validate_Curp();
                    if ($validado) {
                        $id_encontrado = $validado->id;
                        if ($id_encontrado != $id) {
                            echo json_encode(array('status' => 3));
                            die();
                        }
                    }

                    //===[gabo 11 julio validar curp fin]===

                    $candidato = $employee->getOne();
                    $id_Candidato = $candidato->ID_Candidato;
                    if (isset($id_Candidato)) {
                        $candidatosDatosObj = new CandidatosDatos();
                        $candidatosDatosObj->setCandidato($id_Candidato);
                        $candidatosDatosObj->setNombres($first_name);
                        $candidatosDatosObj->setApellido_Paterno($surname);
                        $candidatosDatosObj->setApellido_Materno($last_name);
                        $candidatosDatosObj->setRFC($rfc);
                        $candidatosDatosObj->setCURP($curp);
                        $candidatosDatosObj->setIMSS($nss);
                        $candidatosDatosObj->updateNameData();
                    }

                    if ($id_position != $employee->getOne()->id_position) {
                        $historyPositionsObj = new HistoryPositions();
                        $historyPositionsObj->setId_employee($id);
                        $historyPositionsObj->setId_position($id_position);
                        $historyPositionsObj->save();
                    }


                    
                    $save = $employee->update();
                } else {

                    //===[gabo 11 julio validar curp]===
                    //validar que no exista el curp con ese cliente
                    $validado = $employee->Validate_Curp();
                    if ($validado) {
                        echo json_encode(array('status' => 3));
                        die();
                    }
                    //===[gabo 11 julio validar curp fin]===

                    $save = $employee->save();
                    $id = $employee->getId();

                    //===[gabo 7 julio rh_empleado]===
                    $user_rh = new UsuariosRH();
                    $user_rh->setUsername($curp);
                    $user_rh->setId_cliente($Cliente);
                    $password = random_int(111111, 999999);
                    $user_rh->setPassword( Encryption::encode($password));
                    $usuario_saved = $user_rh->save();
                    //actualizar su  id_user_rh
                    if ($usuario_saved) {
                        $employee->setId($id);
                        $employee->setId_Usuario_Rh($user_rh->getId());
                        $employee->Update_Id_userRH();
                    }
                    //===[gabo 7 julio rh_empleado]===

                    $historyPositionsObj = new HistoryPositions();
                    $historyPositionsObj->setId_employee($id);
                    $historyPositionsObj->setId_position($id_position);
                    $historyPositionsObj->setStart_date($start_date);
                    $historyPositionsObj->save1();

                    $employeeContractObj = new EmployeeContract();
                    $employeeContractObj->setId_employee($id);
                    $employeeContractObj->setContract_start($start_date);
                    $employeeContractObj->setType($contractType);

                    if ($contract == 5) {
                        $employeeContractObj->setContract_end(null);
                        $employeeContractObj->save();
                    } else {
                        $contract_end = date("Y-m-d", strtotime($start_date . "+ " . $number . $period));
                        $employeeContractObj->setContract_end($contract_end);
                        $employeeContractObj->save();
                    }
                    $flag = 2;
                }

                if ($save) {

                    if ($flag == 1) {
                        $employee2 = new Employees();
                        $employee2->setId($employee->getId());
                        $employee2 = $employee2->getOne();
                        $contactos = Utils::getEmpresaByContacto();
                        foreach ($contactos as $contacto) {
                            if ($contacto['Cliente'] == $employee2->Cliente) {
                                $employee2->Cliente = $contacto['Nombre_Cliente'];
                            }
                        }

                        $employee2->age = date("Y") - date("Y", strtotime($employee2->date_birth));
                        $employee2->date_birth = Utils::getDate($employee2->date_birth);
                        $employee2->start_date = Utils::getDate($employee2->start_date);
                        $employee2->created_at = Utils::getDate($employee2->created_at);
                        $employee2->end_date = isset($employee2->end_date) ? Utils::getDate($employee2->end_date) : 'Sin definir';
                        $employee2->re_entry_date = isset($employee2->re_entry_date) ? Utils::getDate($employee2->re_entry_date) : null;
                        $employee2->id_gender = $employee2->id_gender == 1 ? 'Hombre' : 'Mujer';

                        $razonSocial = Utils::showRazonesSocialesPorID($employee2->id_razon);
                        $employee2->id_razon = $razonSocial->Nombre_Razon;


                        $position = new Positions();
                        $position->setId($employee2->id_position);
                        $position = $position->getOne();

                        $historyPositionsObj = new HistoryPositions();
                        $historyPositionsObj->setId_employee($id);
                        $historyPositions = $historyPositionsObj->getAllByIdEmployee();

                        for ($i = 0; $i < count($historyPositions); $i++) {
                            $historyPositions[$i]['id'] = Encryption::encode($historyPositions[$i]['id']);
                            $historyPositions[$i]['created_at'] = Utils::getDate($historyPositions[$i]['created_at']);
                            $historyPositions[$i]['start_date'] = Utils::getDate($historyPositions[$i]['start_date']);
                        }

                        echo json_encode(array(
                            'status' => 1,
                            'id' => Encryption::encode($employee->getId()),
                            'employee' => $employee2,
                            'position' => $position,
                            'hisotryPosition' => $historyPositions,
                        ));
                    } else {
                        echo json_encode(array(
                            'status' => 1,
                            'id' => Encryption::encode($employee->getId())
                        ));
                    }
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            header('location:' . base_url);
    }

    public function updateEnd_date()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $reason_for_leaving = Utils::sanitizeStringBlank($_POST['reason_for_leaving']);
            $comment_for_leaving = Utils::sanitizeStringBlank($_POST['comment_for_leaving']);
            $end_date = $_POST['end_date'];

            if ($id && $reason_for_leaving && $end_date) {
                $employeeObj = new Employees();
                $employeeObj->setId($id);
                $employeeObj->setReason_for_leaving($reason_for_leaving);
                $employeeObj->setComment_for_leaving($comment_for_leaving);
                $employeeObj->setEnd_date($end_date);
                $employeeObj->setStatus(0);
                $employeeObj->updateReasonForLeaving();

                $employee = $employeeObj->getOne();

                echo json_encode(array(
                    'status' => 1,
                    'end_date' => Utils::getDate($employee->end_date),
                    'end_date2' => $employee->end_date,
                    'reason_for_leaving' => $employee->reason_for_leaving,
                    'comment_for_leaving' => $employee->comment_for_leaving
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function updateRe_entry_date()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $re_entry_date = Utils::sanitizeString($_POST['re_entry_date']);
            if ($id && $re_entry_date) {
                $employeeObj = new Employees();
                $employeeObj->setId($id);
                $employeeObj->setRe_entry_date($re_entry_date);
                $employeeObj->setStatus(1);
                $employeeObj->updateRe_entry_date();

                $employee = $employeeObj->getOne();

                $end_date = isset($employee->end_date) ? Utils::getDate($employee->end_date) : 'Sin definir';
                $re_entry_date = isset($employee->re_entry_date) ? Utils::getDate($employee->re_entry_date) : 'Sin definir';
                $re_entry_dateFullDate = isset($employee->re_entry_date) ? Utils::getDate($employee->re_entry_date) : 'Sin definir';
                $reason_for_leaving = isset($employee->reason_for_leaving) ? $employee->reason_for_leaving : 'Sin definir';

                echo json_encode(array(
                    'status' => 1,
                    'end_date' => $end_date,
                    'end_date2' => $employee->end_date,
                    're_entry_date' => $employee->re_entry_date,
                    're_entry_dateFullDate' => $re_entry_dateFullDate,
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function updateDataContact()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $phone_number1 = isset($_POST['phone_number1']) ? $_POST['phone_number1'] : null;
            $label1 = isset($_POST['label1']) ? $_POST['label1'] : null;
            $phone_number2 = isset($_POST['phone_number2']) ? $_POST['phone_number2'] : null;
            $label2 = isset($_POST['label2']) ? $_POST['label2'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $institutional_email = isset($_POST['institutional_email']) ? $_POST['institutional_email'] : null;
            $flag = Encryption::decode($_POST['flag']);


            $employee_contactsObj = new EmployeeContact();
            $employee_contactsObj->setId_employee($id);
            $employee_contacts = $employee_contactsObj->getOne();

            if ($employee_contacts) {
                if ($id) {
                    $employee_contactsObj->setId_employee($id);

                    $employee_contactsObj->setPhone_number1(!isset($phone_number1) || $phone_number1 == '' ? null : $phone_number1);
                    $employee_contactsObj->setLabel1(isset($label1) ? $label1 : $employee_contacts->label1);
                    $employee_contactsObj->setPhone_number2(!isset($phone_number2) || $phone_number2 == '' ? null : $phone_number2);
                    $employee_contactsObj->setLabel2(isset($label2) ?  $label2 : $employee_contacts->label2);

                    $employee_contactsObj->setEmail($email == null || $email == '' ?  '' : $email);
                    $employee_contactsObj->setInstitutional_email($institutional_email == null || $institutional_email == '' ?  null : $institutional_email);
                    $employee_contactsObj->updateContact();

                    $employee_contacts = $employee_contactsObj->getOne();
                    $employee_contacts->label1 = Utils::labelContact($employee_contacts->label1);
                    $employee_contacts->label2 = Utils::labelContact($employee_contacts->label2);

                    echo json_encode(array(
                        'status' => 1,
                        'employee_contacts' => $employee_contacts
                    ));
                } else
                    echo json_encode(array('status' => 0));
            } else {
                $employee_contactsObj->setPhone_number1($phone_number1);
                $employee_contactsObj->setLabel1($label1);
                $employee_contactsObj->setPhone_number2($phone_number2);
                $employee_contactsObj->setLabel2($label2);
                $employee_contactsObj->setEmail($email);
                $employee_contactsObj->setInstitutional_email($institutional_email);
                $employee_contactsObj->setId_employee($id);
                $employee_contactsObj->save1();
                $employee_contacts = $employee_contactsObj->getOne();
                $employee_contacts->label1 = Utils::labelContact($employee_contacts->label1);
                $employee_contacts->label2 = Utils::labelContact($employee_contacts->label2);

                echo json_encode(array(
                    'status' => 1,
                    'employee_contacts' => $employee_contacts
                ));
            }
        } else
            echo json_encode(array('status' => 0));
    }

    public function updateDataEmergency()
    {

        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $emergency_number1 = isset($_POST['emergency_number1']) ? $_POST['emergency_number1'] : null;
            $emergency_contact1 = isset($_POST['emergency_contact1']) ? $_POST['emergency_contact1'] : null;
            $emergency_relationship1 = isset($_POST['emergency_relationship1']) ? $_POST['emergency_relationship1'] : null;
            $emergency_number2 = isset($_POST['emergency_number2']) ? $_POST['emergency_number2'] : null;
            $emergency_contact2 = isset($_POST['emergency_contact2']) ? $_POST['emergency_contact2'] : null;
            $emergency_relationship2 = isset($_POST['emergency_relationship2']) ? $_POST['emergency_relationship2'] : null;

            $employee_contactsObj = new EmployeeContact();
            $employee_contactsObj->setId_employee($id);
            $employee_contacts = $employee_contactsObj->getOne();

            if ($employee_contacts) {
                $employee_contactsObj->setEmergency_number1(!isset($emergency_number1) || $emergency_number1 == '' ? null : $emergency_number1);
                $employee_contactsObj->setEmergency_contact1(!isset($emergency_contact1) || $emergency_contact1 == '' ? null : $emergency_contact1);
                $employee_contactsObj->setEmergency_relationship1(!isset($emergency_relationship1) || $emergency_relationship1 == '' ? null : $emergency_relationship1);
                $employee_contactsObj->setEmergency_number2(!isset($emergency_number2) || $emergency_number2 == '' ? null : $emergency_number2);
                $employee_contactsObj->setEmergency_contact2(!isset($emergency_contact2) || $emergency_contact2 == '' ? null : $emergency_contact2);
                $employee_contactsObj->setEmergency_relationship2(!isset($emergency_relationship2) || $emergency_relationship2 == '' ? null : $emergency_relationship2);
                $employee_contactsObj->updateContactEmergency();

                $employee_contacts = $employee_contactsObj->getOne();
                echo json_encode(array(
                    'status' => 1,
                    'employee_contacts' => $employee_contacts
                ));
            } else {
                $employee_contactsObj->setEmergency_number1($emergency_number1);
                $employee_contactsObj->setEmergency_contact1($emergency_contact1);
                $employee_contactsObj->setEmergency_relationship1($emergency_relationship1);
                $employee_contactsObj->setEmergency_number2($emergency_number2);
                $employee_contactsObj->setEmergency_contact2($emergency_contact2);
                $employee_contactsObj->setEmergency_relationship2($emergency_relationship2);
                $employee_contactsObj->save2();
                $employee_contacts = $employee_contactsObj->getOne();

                echo json_encode(array(
                    'status' => 1,
                    'employee_contacts' => $employee_contacts
                ));
            }
        } else
            echo json_encode(array('status' => 0));
    }

    public function updatePayroll()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $gross_pay = isset($_POST['gross_pay']) && is_numeric($_POST['gross_pay']) ? number_format($_POST['gross_pay'], 2) : null;
            $net_pay = isset($_POST['net_pay']) && is_numeric($_POST['net_pay']) ? number_format($_POST['net_pay'], 2) : null;
            $bank = isset($_POST['bank']) ? $_POST['bank'] : null;
            $account_number = isset($_POST['account_number']) ? $_POST['account_number'] : null;
            $CLABE = isset($_POST['CLABE']) ? $_POST['CLABE'] : null;
            $created_at = Utils::sanitizeString($_POST['created_at']);

            if ($id && $gross_pay  && $bank && ($account_number || $CLABE) && $created_at) {

                $employeePayrollObj = new EmployeePayroll();
                $employeePayrollObj->setId_employee($id);
                $employeePayrollObj->setGross_pay($gross_pay);
                $employeePayrollObj->setNet_pay($net_pay);
                $employeePayrollObj->setBank($bank);
                $employeePayrollObj->setAccount_number($account_number);
                $employeePayrollObj->setCLABE($CLABE);
                $employeePayrollObj->setCreated_at($created_at);

                $employeePayrollObj->save();

                $id = $employeePayrollObj->getId();
                $employeePayrollObj->setId($id);
                $employeePayroll = $employeePayrollObj->getOne1();

                $employeePayroll->modified_at = Utils::getFullDate($employeePayroll->modified_at);
                $employeePayroll->gross_pay = number_format($employeePayroll->gross_pay, 2);
                $employeePayroll->start_pay = number_format($employeePayroll->start_pay, 2);
                //$employeePayroll->net_pay = number_format($employeePayroll->net_pay, 2);
                $employeePayroll->created_at = Utils::getDate($employeePayroll->created_at);
                $employeePayroll->account_number = isset($employeePayroll->account_number) ? $employeePayroll->account_number : 'Sin definir';
                $employeePayroll->CLABE = isset($employeePayroll->CLABE) ? $employeePayroll->CLABE : 'Sin definir';

                $employeePayrollAll = $employeePayrollObj->getAll();
                for ($i = 0; $i < count($employeePayrollAll); $i++) {
                    $employeePayrollAll[$i]['id'] = Encryption::encode($employeePayrollAll[$i]['id'], 2);
                    $employeePayrollAll[$i]['gross_pay'] = number_format($employeePayrollAll[$i]['gross_pay'], 2);
                    //$employeePayrollAll[$i]['net_pay'] = number_format($employeePayrollAll[$i]['net_pay'], 2);

                    $employeePayrollAll[$i]['created_at'] = Utils::getDate($employeePayrollAll[$i]['created_at']);
                }

                echo json_encode(array(
                    'status' => 1,
                    'employeePayroll' => $employeePayroll,
                    'employeePayrollAll' => $employeePayrollAll
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 2));
    }



    public function upload_file()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $cv = isset($_FILES['cv']) && $_FILES['cv']['name'] != '' ? $_FILES['cv'] : FALSE;
            $rfc = isset($_FILES['rfc']) && $_FILES['rfc']['name'] != '' ? $_FILES['rfc'] : FALSE;
            $cfdi = isset($_FILES['cfdi']) && $_FILES['cfdi']['name'] != '' ? $_FILES['cfdi'] : FALSE;
            $id_employee = Encryption::decode($_POST['id_employee']);



            if (($cv || $rfc || $cfdi) && $id_employee) {
                $employeeObj = new Employees();
                $employeeObj->setId($id_employee);
                $employee = $employeeObj->getOne();
                $id_employee = $employee->id;

                $allowed_formats = array("application/pdf");
                $limit_kb = 15368312;

                if ($cv) {
                    $full_name_employee = 'CV_' . $employee->first_name . '_' . $employee->surname . '_' . $employee->last_name;
                    if (!in_array($_FILES["cv"]["type"], $allowed_formats) || $_FILES["cv"]["size"] > $limit_kb) {
                        echo 0;
                        die();
                    } else {
                        if (file_exists('uploads/cv/' . $id_employee)) {
                            Utils::deleteDir('uploads/cv/' . $id_employee);
                        }

                        $route2 = 'uploads/cv/' . $id_employee . '/';
                        $resume2 = $route2 . $_FILES["cv"]["name"];

                        if (!file_exists($route2)) {
                            mkdir($route2);
                        }

                        if (!file_exists($resume2)) {
                            $result = @move_uploaded_file($_FILES["cv"]["tmp_name"], $resume2);
                            $routeDocu = base_url . $resume2;
                        }

                        echo json_encode(array(
                            'status' => 1,
                            'full_name_employee' => $full_name_employee,
                            'routeDocu' => $routeDocu,
                            'flag' => 1
                        ));
                    }
                }

                if ($rfc) {
                    $full_name_employee = 'rfc_' . $employee->first_name . '_' . $employee->surname . '_' . $employee->last_name;
                    if (!in_array($_FILES["rfc"]["type"], $allowed_formats) || $_FILES["rfc"]["size"] > $limit_kb) {
                        echo 0;
                        die();
                    } else {
                        if (file_exists('uploads/rfc/' . $id_employee)) {
                            Utils::deleteDir('uploads/rfc/' . $id_employee);
                        }

                        $route2 = 'uploads/rfc/' . $id_employee . '/';
                        $resume2 = $route2 . $_FILES["rfc"]["name"];

                        if (!file_exists($route2)) {
                            mkdir($route2);
                        }

                        if (!file_exists($resume2)) {
                            $result = @move_uploaded_file($_FILES["rfc"]["tmp_name"], $resume2);
                            $routeDocu = base_url . $resume2;
                        }
                        echo json_encode(array(
                            'status' => 1,
                            'full_name_employee' => $full_name_employee,
                            'routeDocu' => $routeDocu,
                            'flag' => 2
                        ));
                    }
                }

                if ($cfdi) {
                    $full_name_employee = 'cfdi_' . $employee->first_name . '_' . $employee->surname . '_' . $employee->last_name;
                    if (!in_array($_FILES["cfdi"]["type"], $allowed_formats) || $_FILES["cfdi"]["size"] > $limit_kb) {
                        echo 0;
                        die();
                    } else {
                        if (file_exists('uploads/cfdi/' . $id_employee)) {
                            Utils::deleteDir('uploads/cfdi/' . $id_employee);
                        }

                        $route2 = 'uploads/cfdi/' . $id_employee . '/';
                        $resume2 = $route2 . $_FILES["cfdi"]["name"];

                        if (!file_exists($route2)) {
                            mkdir($route2);
                        }

                        if (!file_exists($resume2)) {
                            $result = @move_uploaded_file($_FILES["cfdi"]["tmp_name"], $resume2);
                            $routeDocu = base_url . $resume2;
                        }
                        echo json_encode(array(
                            'status' => 1,
                            'full_name_employee' => $full_name_employee,
                            'routeDocu' => $routeDocu,
                            'flag' => 3
                        ));
                    }
                }
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }



    public function updateDeleteSatus()
    {
        if ($_POST['id']) {

            $employeeObj = new Employees();
            $employeeObj->setId(Encryption::decode($_POST['id']));
            $employeeObj->setStatus(2);
            $flag = $employeeObj->updateEmployeeStatus();
            if ($flag) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $employee = new Employees();
                $employee->setCliente($_SESSION['id_cliente']);
                $employee->setStatus(0);
                $employee = $employee->getAllEmployeesByCliente();

                for ($i = 0; $i <  count($employee); $i++) {
                    $employee[$i]['id_employee'] = Encryption::encode($employee[$i]['id_employee']);
                    $employee[$i]['modified_at'] = Utils::getDate($employee[$i]['modified_at']);
                    $employee[$i]['start_date'] = Utils::getFullDate($employee[$i]['start_date']);
                }

                echo json_encode(array('status' => 1, 'employee' => $employee));
            } else
                echo json_encode(array('status' => 2));
        } else {
            echo json_encode(array('status' => 2));
        }
    }


    public function getAllEmployeeByIdBoss()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $id_boss = Encryption::decode($_POST['id_employee']);
            if ($id_boss) {
                $contactoEmpresa = new ContactosEmpresa();
                $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
                $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                $employeetObj = new Employees();
                $employeetObj->setCliente($_SESSION['id_cliente']);
                $employeetObj->setStatus(0);
                $employeetObj->setStatus(1);
                $employeetObj->setId_boss($id_boss);
                $employeesBoss =  $employeetObj->getAllEmployeeByIdBoss();
                $employees = $employeetObj->getAllEmployeesByCliente();


                echo json_encode(array(
                    'status' => 1,
                    'employees' => $employees,
                    'employeesBoss' => $employeesBoss
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
