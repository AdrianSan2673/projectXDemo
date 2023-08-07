<?php

require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/User.php';
require_once 'models/RH/Department.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/Positions.php';
// gabo 1 de junio
require_once 'models/SA/ContactosCliente.php';

class DepartamentoController
{

    public function index()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $contactos = $contactoEmpresa->getClientesPorUsuarioContacto();

            $dptos = new Department();
            $dptos->setID_Cliente($_SESSION['id_cliente']);
            $departamentos = $dptos->getDepartmentsByCliente();

            $page_title =  'Departamentos | RRHH Ingenia';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/department/index.php';
            require_once 'views/department/modal-create.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function ver()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_department = Encryption::decode($_GET['id']);

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $department = new Department();
            $department->setId($id_department);
            $departamento = $department->getOne();

            $positionObj = new Positions();
            $positionObj->setId_department($id_department);
            $employees = $positionObj->getPositionEmployeeByIdDepartment();
            $positions = $positionObj->getPositionByIdeDeparment();

            $page_title = $departamento->department . ' | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/department/read.php';
            require_once 'views/department/modal-edit.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }

    public function save()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && $_POST) {
            //$id = Utils::sanitizeNumber($_POST['id']);

            $department = Utils::sanitizeString($_POST['department']);
            //===[gabo 6 junio departamento]===
            $id_cliente = Utils::sanitizeNumber($_POST['id_cliente_create']);
            //===[gabo 6 junio departamento fin]===


            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $ID_Contacto = $contactoEmpresa->getContactoPorUsuario()->ID;
            $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

            $flag = $_POST['flag'];

            if ($department && $department && $Empresa && $id_cliente) {
                $departamento = new Department();
                $departamento->setDepartment($department);
                $departamento->setEmpresa($Empresa);
                $departamento->setID_Contacto($ID_Contacto);
                $departamento->setID_Cliente($id_cliente);

                if ($flag == 1) {
                    $save = $departamento->save();
                } else {
                    //$departamento->setId(Encryption::decode($_POST['id']));
                    $save = $departamento->update();
                }

                //===[gabo 5 de junio departamento]===
                $ids_clientes = Utils::showID_ClienteByID_ContactoDpto($ID_Contacto);
                $dptos = new Department();
                $departments = $dptos->getDepartmentsByClientes($ids_clientes);
                //===[gabo 5 de junio departamento]===


                for ($i = 0; $i < count($departments); $i++) {
                    $departments[$i]['id'] = Encryption::encode($departments[$i]['id']);
                    $departments[$i]['url'] = base_url . 'departamento/ver&id=' . $departments[$i]['id'];
                }

                if ($save) {
                    $id = $departamento->getId();
                    echo json_encode(
                        array(
                            'status' => 1,
                            'departamentos' => $departments
                        )
                    );
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else
            echo json_encode(array('status' => 2));
    }

    public function getDepartmentsByEmpresa()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $Empresa = Utils::sanitizeNumber($_POST['Empresa']);

            $department = new Department();
            $department->setEmpresa($Empresa);
            $departamentos = $department->getDepartmentsByEmpresa();
            echo json_encode(
                array(
                    'status' => 1,
                    'departments' => $departamentos
                )
            );
        } else
            header('location:' . base_url);
    }

    public function updateDepartamento()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $deparment = Utils::sanitizeStringBlank($_POST['department']);
            if ($id && $deparment) {

                $deparments = new Department();
                $deparments->setId($id);
                $deparments->setDepartment($deparment);
                $deparments->updateDepartament();

                echo json_encode(
                    array(
                        'status' => 1,
                        'departments' => $_POST['department']
                    )
                );
            } else {
                echo json_encode(
                    array('status' => 0)
                );
            }
        } else
            header('location:' . base_url);
    }



    function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $id = Encryption::decode($_POST['id']);

            if ($id) {
                $deparmentObj = new Department();
                $deparmentObj->setId($id);
                $countDepartment = $deparmentObj->countEmployeesAndPositionByIdDepartment();
                // if ($countDepartment->no_employees == 0 && $countDepartment->no_positions == 0) {
                $depFlag = $deparmentObj->delete();
                if ($depFlag) {
                    $contactoEmpresa = new ContactosEmpresa();
                    $contactoEmpresa->setUsuario($_SESSION['identity']->username);
                    $Empresa = $contactoEmpresa->getContactoPorUsuario()->Empresa;

                    $deparmentObj = new Department();
                    $deparmentObj->setEmpresa($Empresa);

                    $deparments = $deparmentObj->getDepartmentsByEmpresa();
                    for ($i = 0; $i < count($deparments); $i++) {
                        $deparments[$i]['id'] = Encryption::encode($deparments[$i]['id']);
                    }

                    echo json_encode(
                        array(
                            'status' => 1,
                            'departamentos' => $deparments,
                            'base_url' => base_url
                        )
                    );
                } else
                    echo json_encode(array('status' => 0));
                //} else
                //  echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
