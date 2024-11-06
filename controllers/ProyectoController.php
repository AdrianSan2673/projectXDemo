<?php

require_once 'models/User.php';
require_once 'models/RH/Department.php';
require_once 'models/ModelosSigma/proyecto.php';
require_once 'models/ModelosSigma/usuario.php';
//require_once 'controllers/ModalEditProjectController.php';

class ProyectoController
{

    public function index()
    {
        //var_dump($_SESSION['identity']->tipo_usuario);
        //die();
        //if (Utils::isAdmin() || Utils::isCustomerSA()) {
				
  
            $projec = new Proyecto();
     

            $proyectos = $projec->getAllProject();
       

            $user = new User();

            $users = $user->getAll();

            $page_title =  'proyectos | SIGMA';
            $userType = $_SESSION['identity']->tipo_usuario;

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/proyecto/modal-create.php';
            require_once 'views/proyecto/modal_editar_proyecto.php';
            require_once 'views/proyecto/index.php';
            require_once 'views/layout/footer.php';
    }

    public function ver()
    {
        //var_dump($_SESSION);
        //if (Utils::isAdmin() || Utils::isCustomerSA()) {
			$idProyecto = Encryption::decode($_GET['id']) ;

  
            $projec = new Proyecto();
     
            $projec->setId($idProyecto);
            $proyecto = $projec->getOne();
            
            $page_title =  'Proyectos | SIGMA';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/proyecto/read.php';
            require_once 'views/proyecto/modal-create.php';
            require_once 'views/layout/footer.php';
            require_once 'views/proyecto/modal_editar_proyecto.php';
        //} 
            //header('location:' . base_url);
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
                    $departments[$i]['url'] = base_url . 'proyecto/ver&id=' . $departments[$i]['id'];
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

    public function createNewProject(){
       
        $Nombre = isset($_POST['Nombre']) ? trim($_POST['Nombre']) : FALSE;
        $Estado = isset($_POST['Estado']) ? trim($_POST['Estado']) : FALSE;
        $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : FALSE;
       
        $Telefono = isset($_POST['Telefono']) ? trim($_POST['Telefono']) : FALSE;
        
        $userSelect = isset($_POST['userSelect']) ? $_POST['userSelect'] : FALSE;

        if($Nombre && $Estado && $direccion && $Telefono){
            $projectObj = new Proyecto();
            $projectObj->setNombre($Nombre);
            $projectObj->setEstado($Estado);
            $projectObj->setDireccion($direccion);
            $projectObj->setTelefono($Telefono);
         
           
            $create = $projectObj->createNewProject();
            $proyecto = $projectObj->getAllProject();
            if ($create){
                echo json_encode(array('status' => 1, 'proyectos' => $proyecto));
            } else {
                echo json_encode(array('status' => 2));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function updateProject() {
        $id = $_POST['id'];
        $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : FALSE;
        $fase = isset($_POST['fase']) ? trim($_POST['fase']) : FALSE;
        $Telefono = isset($_POST['Telefono']) ? trim($_POST['Telefono']) : FALSE;
        $id_tipo_usuario = isset($_POST['id_tipo_usuario']) ? trim($_POST['id_tipo_usuario']) : FALSE;
        
        if($id && $direccion && $fase && $Telefono && $id_tipo_usuario) {
            $projectObj = new Proyecto();
            $projectObj->setId($id);
            $projectObj->setDireccion($direccion); 
            $projectObj->setStatus($fase);
            $projectObj->setTelefono($Telefono);
            $projectObj->setId_tipo_usuario($id_tipo_usuario);
       
            $update = $projectObj->updateProject();
            $proyecto = $projectObj->getOne();
            if ($update) {
                echo json_encode(array('status' => 1, 'proyecto' => $proyecto));
            } else {
                echo json_encode(array('status' => 2));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function deleteProject() {
        
    }
}
