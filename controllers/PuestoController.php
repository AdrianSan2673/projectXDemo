<?php

use MyCLabs\Enum\Enum;

require_once 'libraries/fpdf/fpdf.php';

require_once 'models/RH/Positions.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/Clientes.php';
require_once 'models/RH/SpecificResponsabilities.php';
require_once 'models/RH/EffectivenessIndicatiors.php';
require_once 'models/RH/RequiredKnowledge.php';
require_once 'models/RH/InterpersonalSkills.php';
require_once 'models/RH/Department.php';
require_once 'models/RH/SupervisingPositions.php';
require_once 'models/RH/PositionsToAspire.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/CatalogoOcupaciones.php';
require_once 'helpers/puestoDocumento.php';


class PuestoController
{

    public function index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $id_contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $position = new Positions();
            $position->setID_Cliente($_SESSION['id_cliente']);

            $position->setStatus(1);
            $positions = $position->getPositionsByIDContacto();
          
            $position->setStatus(0);
            $positionsDesc = $position->getPositionsByIDContacto();

            $page_title = 'Puestos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/position/index.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function ver()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_position = Encryption::decode($_GET['id']);
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            if ($id_position) {
                $positionObj = new Positions();
                $positionObj->setId($id_position);
                $position = $positionObj->getOne();

                $clienteObj = new Clientes();
                $clienteObj->setCliente($position->ID_Cliente);
                $position->Nombre_cliente = $clienteObj->getOne()->Nombre_Cliente;

                $catalogoOcupaciones = new CatalogoOcupaciones();
                $catalogoOcupaciones->setClave($position->clave_ocupacion);
                $catalogoOcupaciones = $catalogoOcupaciones->getOne();

                $positionObj->setID_Cliente($_SESSION['id_cliente']);
                $positionObj->setStatus(1);
                $positionReport = $positionObj->getPositionsByCliente();
                $positionSupervising = $positionObj->getSupervisingPositionByIdPosition();
                $arraySupervising = [];

                foreach ($positionSupervising as $value) {
                    array_push($arraySupervising,  $value['id']);
                }

                $positionsToAspire = new PositionsToAspire();
                $positionsToAspire->setId_position($id_position);
                $positionsToAspire = $positionsToAspire->getAllPositionsToAspireByIdPosition();
                $arrayToSupervising = [];

                foreach ($positionsToAspire as $value) {
                    array_push($arrayToSupervising,  $value['id_position_to_aspire']);
                }

                $positionBoss = new Positions();
                $positionObj->setID_Cliente($_SESSION['id_cliente']);
                $positionBoss->setStatus(1);
                $positionBoss = $positionBoss->getPositionsByCliente();

                $responsabilityEspec = new SpecificResponsabilities();
                $responsabilityEspec->setId_position($id_position);
                $responsabilityEspec = $responsabilityEspec->getAllByIdPosition();

                $effectivenessIndicatiors = new EffectivenessIndicatiors();
                $effectivenessIndicatiors->setId_position($id_position);
                $effectivenessIndicatiors = $effectivenessIndicatiors->getAllByIdPosition();

                $requiredKnowledge = new RequiredKnowledge();
                $requiredKnowledge->setId_position($id_position);
                $requiredKnowledge = $requiredKnowledge->getAllByIdPosition();

                $interpersonalSkills = new InterpersonalSkills();
                $interpersonalSkills->setId_position($id_position);
                $interpersonalSkills = $interpersonalSkills->getAllByIdPosition();

                $deparment = new Department();
                $deparment->setEmpresa($Empresa);
                $deparment = $deparment->getDepartmentsByEmpresa();

                if ($position->id_boss_position && $position->id_boss_position != 0) {
                    $positionName = new Positions();
                    $positionName->setId($position->id_boss_position);
                    $positionName = $positionName->getOne()->title;
                }

                $employe = new Employees();
                $employe->setCliente($_SESSION['id_cliente']);
                $employe->setStatus(1);
                $employes = $employe->getAllEmployeesByCliente();


                $page_title = 'Ver Puesto';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/position/read.php';
                require_once 'views/position/modal-department.php';
                require_once 'views/position/moda-general-data.php';
                require_once 'views/position/modal-objective.php';
                require_once 'views/position/modal-authority.php';
                require_once 'views/position/modal-responsability.php';
                require_once 'views/position/modal-indicators.php';
                require_once 'views/position/modal_profile.php';
                require_once 'views/position/modal_knowledge.php';
                require_once 'views/position/modal-skills.php';
                require_once 'views/position/modal_plan.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url);
            }
        }
    }



    public function puestoFormato()
    {

        $contactoEmpresa = new ContactosEmpresa();
        $contactoEmpresa->setUsuario($_SESSION['identity']->username);
        $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
        $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;
        $id_position = Encryption::decode($_GET['id']);

        $positionObj = new Positions();
        $positionObj->setId($id_position);
        $position = $positionObj->getOne();
        $id_position = $position->id_position;

        //Titutlo del puesto al que reporta
        $positionName = new Positions();
        $positionName->setId($position->id_boss_position);
        $positionName = isset($positionName->getOne()->title) ? $positionName->getOne()->title : 'Sin asignar';

        //Titulos a los puesto que supervisara
        $positionSupervising = $positionObj->getSupervisingPositionByIdPosition();

        $supervisingText = '';
        if ($positionSupervising) {
            foreach ($positionSupervising as $ps) {
                $supervisingText .= $ps['title'] . ", ";
            }
            $supervisingText = substr($supervisingText, 0, -2);
        } else {
            $supervisingText .= 'Sin asignar';
        }

        $responsabilityEspec = new SpecificResponsabilities();
        $responsabilityEspec->setId_position($id_position);
        $responsabilityEspec = $responsabilityEspec->getAllByIdPosition();

        $effectivenessIndicatiors = new EffectivenessIndicatiors();
        $effectivenessIndicatiors->setId_position($id_position);
        $effectivenessIndicatiors = $effectivenessIndicatiors->getAllByIdPosition();

        $requiredKnowledge = new RequiredKnowledge();
        $requiredKnowledge->setId_position($id_position);
        $requiredKnowledge = $requiredKnowledge->getAllByIdPosition();
        $requiredKnowledgetex = '';

        if ($requiredKnowledge) {
            foreach ($requiredKnowledge as $rk) {
                $requiredKnowledgetex .= $rk['knowledge'] . "\n";
            }
        } else {
            $requiredKnowledgetex .= 'Sin asignar';
        }

        $interpersonalSkills = new InterpersonalSkills();
        $interpersonalSkills->setId_position($id_position);
        $interpersonalSkills = $interpersonalSkills->getAllByIdPosition();

        $interpersonalSkillstex = '';
        if ($interpersonalSkills) {
            foreach ($interpersonalSkills as $rk) {
                $interpersonalSkillstex .= $rk['skill'] . "\n";
            }
        } else {
            $interpersonalSkillstex .= 'Sin asignar';
        }


        //Puesto a aspirar
        $positions_to_aspire = new PositionsToAspire();
        $positions_to_aspire->setId_position($id_position);
        $positions_to_aspire = $positions_to_aspire->getAllPositionsToAspireByIdPosition();
        $positions_to_aspiretex = '';

        if ($positions_to_aspire) {
            foreach ($positions_to_aspire as $ps) {
                $positionObj->setId($ps['id_position_to_aspire']);
                $positionAux = $positionObj->getOne();

                $positions_to_aspiretex .= $positionAux->title . ", ";
            }
            $positions_to_aspiretex = substr($positions_to_aspiretex, 0, -2);
        } else {
            $positions_to_aspiretex .= '';
        }


        $employe_reviewed_by = '';
        $employe_approved_by = '';
        //Revisado por

        $employe = new Employees();
        if ($position->id_approved_by) {
            $employe->setId($position->id_approved_by);
            $employe_approved_by = $employe->getOne();
            $employe_approved_by = $employe_approved_by->first_name . ' ' . $employe_approved_by->last_name . ' ' . $employe_approved_by->surname;
        }
        //Aprobado por
        if ($position->id_reviewed_by) {
            # code...
            $employe->setId($position->id_reviewed_by);
            $employe_reviewed_by = $employe->getOne();
            $employe_reviewed_by = $employe_reviewed_by->first_name . ' ' . $employe_reviewed_by->last_name . ' ' . $employe_reviewed_by->surname;
        }



        $pdf = new puestoDocumento();
        require('./libraries/fpdf/makefont/makefont.php');

        $pdf->AliasNbPages();
        $pdf->AddFont('SinkinSansLight', '', 'SinkinSans-300Light.php');
        $pdf->AddFont('SinkinSans', '', 'SinkinSans-400Regular.php');
        $pdf->AddFont('SinkinSans', 'I', 'SinkinSans-400Italic.php');
        $pdf->AddFont('SinkinSans', 'B', 'SinkinSans-700Bold.php');
        $pdf->AddFont('SinkinSans', 'BI', 'SinkinSans-700BoldItalic.php');
        $pdf->AddFont('SinkinSansBold', 'B', 'SinkinSans-800Black.php');
        $pdf->SetTitle("Puesto - " . utf8_decode($position->title), true);
        $pdf->SetMargins(0, 55, 0, 0);
        //$pdf->nombre = $nombre;
        $pdf->SetMargins(10, 100, 10);
        $pdf->tieneHeader = true;
        $pdf->setDatosGenerales($position, $positionName, $supervisingText);
        $pdf->setResponsabilidades($responsabilityEspec);
        $pdf->setIndicadores($effectivenessIndicatiors);
        $pdf->setPerfil($position);
        $pdf->setCompetencia($requiredKnowledgetex, $interpersonalSkillstex);

        if ($employe_approved_by != '' || $employe_reviewed_by != '' || $positions_to_aspiretex != '') {
            $pdf->setPlanCarrera($employe_approved_by, $employe_reviewed_by, $positions_to_aspiretex);
        }


        $pdf->Output('I', 'Puesto - ' . utf8_decode($position->title) . '.pdf', true);
    }


    public function nuevo()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;
            /*   $Empresa = 82;
            $ID_Contacto = 242; */

            $position = new Positions();
            $position->setEmpresa($Empresa);
            $position->setID_Cliente($_SESSION['id_cliente']);

            $position->setStatus(1);
            $position = $position->getPositionsByCliente();


            $deparment = new Department();
            $deparment->setID_Cliente($_SESSION['id_cliente']);
            $deparment = $deparment->getDepartmentsByCliente();

            $page_title = 'Nuevo Puesto';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/position/modal-department.php';
            require_once 'views/position/create.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }


    public function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            //$id = Utils::sanitizeNumber($_POST['id']);
            $title = Utils::sanitizeStringBlank($_POST['title']);
            $objective = Utils::sanitizeStringBlank($_POST['objective']);
            $authority = Utils::sanitizeStringBlank($_POST['authority']);
            $scholarship = Utils::sanitizeStringBlank($_POST['scholarship']);
            $experience = Utils::sanitizeStringBlank($_POST['experience']);
            $additional_studies = isset($_POST['additional_studies']) ? Utils::sanitizeNumber($_POST['additional_studies']) : NULL;
            $experience_years = isset($_POST['experience_years']) ? Utils::sanitizeNumber($_POST['experience_years']) : NULL;
            $language = Utils::sanitizeStringBlank($_POST['language']);
            $id_department = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_department']));
            $id_boss_position = isset($_POST['id_boss_position']) ? Utils::sanitizeNumber(Encryption::decode($_POST['id_boss_position'])) : NULL;
            $id_reviewed_by = isset($_POST['id_reviewed_by']) ? Utils::sanitizeNumber($_POST['id_reviewed_by']) : NULL;
            $id_approved_by = isset($_POST['id_approved_by']) ? Utils::sanitizeNumber($_POST['id_approved_by']) : NULL;
            $id_created_by = isset($_POST['id_created_by']) ? Utils::sanitizeNumber($_POST['id_created_by']) : NULL;
            $clave_ocupacion = isset($_POST['clave_ocupacion']) ? Encryption::decode($_POST['clave_ocupacion']) : NULL;
            $type_position = isset($_POST['type_position']) ? Encryption::decode($_POST['type_position']) : NULL;
            //===[gabo 7 junio puestos]===
            $id_cliente = isset($_POST['id_cliente_position']) ? Utils::sanitizeNumber($_POST['id_cliente_position']) : NULL;
            //===[gabo 7 junio puestos fin]===

            $flag = isset($_POST['flag']) ? '1' : 2;
            if ($title && $objective && $authority && $scholarship && $experience && $id_department && $type_position) {
                $position = new Positions();
                //$position->setId($id);
                $position->setTitle($title);
                $position->setObjective($objective);
                $position->setAuthority($authority);
                $position->setScholarship($scholarship);
                $position->setExperience($experience);
                $position->setAdditional_studies($additional_studies);
                $position->setExperience_years($experience_years);
                $position->setLanguage($language);
                $position->setId_boss_position($id_boss_position);
                $position->setId_reviewed_by(null);
                $position->setId_approved_by(null);
                $position->setId_created_by($_SESSION['identity']->id);
                $position->setId_department($id_department);
                $position->setEmpresa($Empresa);
                $position->setID_Contacto($ID_Contacto);
                $position->setClave_ocupacion($clave_ocupacion);
                $position->setType_position($type_position);
                //===[gabo 7 junio puestos]===
                $position->setID_Cliente($id_cliente);
                //===[gabo 7 junio puestos fin]===

                if ($flag == 1) {
                    $save = $position->update();
                } else {
                    $save = $position->save();
                    if (isset($_POST['supervising'])) {
                        if (count($_POST['supervising']) > 0) {
                            $supervisingPositions = new SupervisingPositions();
                            foreach ($_POST['supervising'] as $key => $value) {
                                $supervisingPositions->setId_position($position->getId());
                                $supervisingPositions->setId_supervising_position(Encryption::decode($value));
                                $supervisingPositions->save();
                            }
                        }
                    }
                }

                if ($save) {
                    echo json_encode(array(
                        'status' => 1,
                        'id' => Encryption::encode($position->getId())
                    ));
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        }
    }


    function updateObject()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
            $objective = Utils::sanitizeStringBlank($_POST['objective']);
            if ($objective && $id_position) {
                $position = new Positions();
                $position->setId($id_position);
                $position->setObjective($objective);
                $position->updateObjective();

                echo json_encode(array(
                    'objectives' => $objective,
                    'status' => 1
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    function updateAuthority()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_position = Encryption::decode($_POST['id_position']);
            $authority = Utils::sanitizeString($_POST['authority']);
            if ($authority && $id_position) {
                $position = new Positions();
                $position->setId($id_position);
                $position->setAuthority($authority);
                $position->updateOnlyAuthority();

                echo json_encode(array(
                    'authoritys' => $authority,
                    'status' => 1
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

    function updateProfile()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
            $scholarship = Utils::sanitizeStringBlank($_POST['scholarship']);
            $experience = Utils::sanitizeStringBlank($_POST['experience']);
            $additional_studies = Utils::sanitizeStringBlank($_POST['additional_studies']);
            $experience_years = Utils::sanitizeStringBlank($_POST['experience_years']);
            $language = Utils::sanitizeStringBlank($_POST['language']);

            if ($scholarship && $experience  && $experience_years) {
                $position = new Positions();
                $position->setId($id_position);
                $position->setScholarship($scholarship);
                $position->setExperience($experience);
                $position->setAdditional_studies($additional_studies);
                $position->setExperience_years($experience_years);
                $position->setLanguage($language);
                $position->updateAuthority();

                echo json_encode(array(
                    'scholarship' => $scholarship,
                    'experience' => $experience,
                    'additional_studies' => $additional_studies,
                    'experience_years' => $experience_years,
                    'language' => $language,
                    'status' => 1
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }




    function updateDatosGenerales()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
            $title = Utils::sanitizeStringBlank($_POST['title']);
            $id_department = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_department']));
            $id_boss_position = isset($_POST['id_boss_position']) ? Encryption::decode($_POST['id_boss_position']) : null;
            $clave_ocupacion = isset($_POST['clave_ocupacion']) ? Encryption::decode($_POST['clave_ocupacion']) : NULL;
            $type_position = isset($_POST['type_position']) ? Encryption::decode($_POST['type_position']) : NULL;
            $ID_Cliente = isset($_POST['ID_Cliente']) ? Encryption::decode($_POST['ID_Cliente']) : NULL;

            if ($title && $id_department && $id_position && $ID_Cliente) {
                $position = new Positions();
                $position->setId($id_position);
                $position->setTitle($title);
                $position->setId_department($id_department);
                $position->setId_boss_position($id_boss_position);
                $position->setClave_ocupacion($clave_ocupacion);
                $position->setType_position($type_position);
                $position->setID_Cliente($ID_Cliente);
                $update = $position->updateGeneral();

                if ($update) {
                    $deparment = new Department();
                    $deparment->setId($id_department);
                    $deparment = $deparment->getOne();

                    if (isset($clave_ocupacion)) {
                        $catalogoOcupaciones = new CatalogoOcupaciones();
                        $catalogoOcupaciones->setClave($clave_ocupacion);
                        $catalogoOcupaciones = $catalogoOcupaciones->getOne();
                    } else
                        $catalogoOcupaciones = 'Sin definir';

                    if ($id_boss_position) {
                        $positionName = new Positions();
                        $positionName->setId($id_boss_position);
                        $positionName = $positionName->getOne()->title;
                    } else
                        $positionName = 'Sin asignar';

                    $type_position = Utils::getTypePosition($type_position);


                    $clienteObj = new Clientes();
                    $clienteObj->setCliente($ID_Cliente);
                    $Nombre_Cliente = $clienteObj->getOne()->Nombre_Cliente;

                    echo json_encode(array(
                        'title' => $title,
                        'department' => $deparment->department,
                        'boss_position' => $positionName,
                        'catalogoOcupaciones' => $catalogoOcupaciones,
                        'type_position' => $type_position,
                        'Nombre_Cliente' => $Nombre_Cliente,
                        'status' => 1
                    ));
                } else
                    echo json_encode(array('status' => 0));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 2));
    }




    function updateSupervising()
    {
        $id_position = Encryption::decode($_POST['id_position']);
        $supervising = new SupervisingPositions();
        $supervising->setId_position($id_position);
        $supervising->deleteByIdPosition();

        if (isset($_POST['supervising'])) {
            foreach ($_POST['supervising'] as $value) {
                $supervising = new SupervisingPositions();
                $supervising->setId_position($id_position);
                $supervising->setId_supervising_position($value);
                $supervising->save();
            }
        }
        echo json_encode(array('status' => 1));
    }



    function updatePlanCarrera()
    {
        $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
        $id_reviewed_by = $_POST['reviewed_by'] == '' ? null : Encryption::decode($_POST['reviewed_by']);
        $id_approved_by = $_POST['approved_by'] == '' ? null : Encryption::decode($_POST['approved_by']);
        if ($id_position) {
            $positionsToAspire = new PositionsToAspire();
            $positionsToAspire->setId_position($id_position);
            $positionsToAspire->deleteByIdPosition();

            if (isset($_POST['positionsToAspire'])) {
                foreach ($_POST['positionsToAspire'] as $value) {
                    $positionsToAspire = new PositionsToAspire();
                    $positionsToAspire->setId_position($id_position);
                    $positionsToAspire->setId_position_to_aspire(Encryption::decode($value));
                    $positionsToAspire->save();
                }
            }

            $position = new Positions();
            $position->setId($id_position);
            $position->setId_reviewed_by($id_reviewed_by);
            $position->setId_approved_by($id_approved_by);
            $position->updatePlanCarrera();

            echo json_encode(array('status' => 1));
        } else
            echo json_encode(array('status' => 0));
    }


    function updateSatusPosition()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id']));

            if ($id_position) {
                $position = new Positions();
                $position->setId($id_position);
                $status = $position->getOne()->status;
                $status = $status == 1 ? 0 : 1;
                $position->setStatus($status);
                $position->updateSatusPosition();

                echo json_encode(array(
                    'status' => 1,
                    'estado' => $status,
                    'id_position' => Encryption::encode($id_position)
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
