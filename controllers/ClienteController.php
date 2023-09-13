<?php

require_once 'models/Customer.php';
require_once 'models/CustomerContact.php';
require_once 'models/BusinessName.php';
require_once 'models/CustomerEvaluation.php';
require_once 'models/SA/ClientesNotas.php';
require_once 'models/SA/Prospecto.php';
require_once 'models/CustomerContactsCollection.php';

class ClienteController
{

    public function index()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {
            $customer = new Customer();
              if ($_SESSION['identity']->id == 9396) {
                $customer->setCreated_by($_SESSION['identity']->username);
                $customers = $customer->getAllByCreate();
            } else {
                $customers = $customer->getAll();
            }


            $page_title = 'Nuestros clientes | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/customer/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function crear()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {

            if (isset($_GET['prospecto'])) {
                $id = Encryption::decode($_GET['prospecto']);
                $prospecto = new Prospecto();
                $prospecto->setID($id);
                $prospecto = $prospecto->getOne();
            }

            $page_title = 'Nuevo cliente | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/customer/create.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function create()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $customer = (isset($_POST['customer'])) ? trim($_POST['customer']) : FALSE;
            $alias = (isset($_POST['alias'])) ? trim($_POST['alias']) : FALSE;
            $id_cost_center = (isset($_POST['id_cost_center'])) ? trim($_POST['id_cost_center']) : FALSE;


            if ($customer && $alias && $id_cost_center) {
                $cliente = new Customer();
                $cliente->setCustomer($customer);
                $cliente->setAlias($alias);
                $cliente->setId_cost_center($id_cost_center);

                $cliente->setCreated_by($_SESSION['identity']->username);

                $save = $cliente->create();
                $id_customer = Encryption::encode($cliente->getId());

                if ($save) {
                    echo json_encode(array('status' => 1, 'id_customer' => $id_customer));
                } else {
                    echo json_encode(array('status' => 2));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            header('location:' . base_url);
        }
    }
    public function ver()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $customer = new Customer();
                $customer->setId($id);
                $cliente = $customer->getOne();

                $customerContact = new CustomerContact();
                $customerContact->setId_Customer($id);
                $contacts = $customerContact->getContactsByCustomer();

                $customerContactObj = new CustomerContactsCollection();
                $customerContactObj->setId_Customer($id);
                $CustomerContactsCollection = $customerContactObj->getALLById_cliente();

                $business = new BusinessName();
                $business->setId_Customer($id);
                $business_names = $business->getBNByCustomer();

                for ($i = 0; $i < count($business_names); $i++) {
                    $path = 'uploads/fiscalsituations/' . $business_names[$i]['id_customer'] . '/' . $business_names[$i]['RFC'];
                    if (file_exists($path)) {
                        $directory = opendir($path);
                        while ($file = readdir($directory)) {
                            if (!is_dir($file)) {
                                $route = $path . '/' . $file;
                            }
                        }
                        $business_names[$i]['file'] = base_url . $route;
                    }
                }

                $evaluation = new CustomerEvaluation();
                $evaluation->setId_Customer($id);
                $evaluation_names = $evaluation->getEvaluationsByCustomer();

                $nota = new ClientesNotas();
                $nota->setID_Cliente_Reclu($id);
                $notas = $nota->getNotasPorClienteReclu();

                for ($i = 0; $i < count($notas); $i++) {
                    $path = 'uploads/avatar/' . $notas[$i]['id_user'];
                    if (file_exists($path)) {
                        $directory = opendir($path);

                        while ($file = readdir($directory)) {
                            if (!is_dir($file))
                                $route = $path . '/' . $file;
                        }
                    } else
                        $route = "dist/img/user-icon.png";

                    $notas[$i]['avatar'] = base_url . $route;
                }

                $page_title = $cliente->alias . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/read.php';
                require_once 'views/cliente/modal-nota.php';
                require_once 'views/customer/modal-contacto.php';
                require_once 'views/customer/modal-collection.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'cliente/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    /* public function editar(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = $_GET['id'];
                $customer = new Customer();
                $customer->setId($id);
                $cliente = $customer->getOne();

                $page_title = $cliente->alias.' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/create.php';
                require_once 'views/layout/footer.php';
            }else {
                header('location:'.base_url.'cliente/index');
            }
        }else {
            header('location:'.base_url);
        }
    } */

    public function editar()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $customer = new Customer();
                $customer->setId($id);
                $cliente = $customer->getOne();

                $page_title = $cliente->alias . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/create.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'cliente/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function update()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $id = (isset($_POST['id'])) ? Encryption::decode($_POST['id']) : FALSE;
            $customer = (isset($_POST['customer'])) ? trim($_POST['customer']) : FALSE;
            $alias = (isset($_POST['alias'])) ? trim($_POST['alias']) : FALSE;
            $id_cost_center = (isset($_POST['id_cost_center'])) ? trim($_POST['id_cost_center']) : FALSE;
            //===[gabo 7 agosto creado por ]===
            $created_by = isset($_POST['created_by']) ? Utils::sanitizeStringBlank($_POST['created_by']) : false;
            //===[gabo 7 agosto creado por fin===

            if ($id && $customer && $alias && $id_cost_center) {
                $cliente = new Customer();
                $cliente->setId($id);
                $cliente->setCustomer($customer);
                $cliente->setAlias($alias);
                $cliente->setId_cost_center($id_cost_center);
                //===[gabo 7 agosto creado por ]===
                $cliente->setCreated_by($created_by);
                //===[gabo 7 agosto creado por fin===

                $update = $cliente->update();
                if ($update) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function evaluar()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $customer = new Customer();
                $customer->setId($id);
                $cliente = $customer->getOne();

                $page_title = $cliente->alias . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/evaluate.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'cliente/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function create_evaluation()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $id_customer = (isset($_POST['id_customer'])) ? Encryption::decode($_POST['id_customer']) : FALSE;
            $response_time = isset($_POST['response_time']) && !empty($_POST['response_time']) ? Utils::evaluationValues($_POST['response_time']) : NULL;
            $reception_time = isset($_POST['reception_time']) && !empty($_POST['reception_time']) ? Utils::evaluationValues($_POST['reception_time']) : FALSE;
            $communication_with_executive = isset($_POST['communication_with_executive']) && !empty($_POST['communication_with_executive']) ? Utils::evaluationValues($_POST['communication_with_executive']) : FALSE;
            $executive_friendliness = isset($_POST['executive_friendliness']) && !empty($_POST['executive_friendliness']) ? Utils::evaluationValues($_POST['executive_friendliness']) : FALSE;
            $quality_of_candidates = isset($_POST['quality_of_candidates']) && !empty($_POST['quality_of_candidates']) ? Utils::evaluationValues($_POST['quality_of_candidates']) : FALSE;
            $comments = isset($_POST['comments']) && !empty($_POST['comments']) ? trim($_POST['comments']) : FALSE;


            if ($id_customer && $reception_time && $communication_with_executive && $executive_friendliness && $quality_of_candidates && $comments) {
                $cliente = new CustomerEvaluation();
                $cliente->setId_customer($id_customer);
                $cliente->setResponse_time($response_time);
                $cliente->setReception_time($reception_time);
                $cliente->setCommunication_with_executive($communication_with_executive);
                $cliente->setExecutive_friendliness($executive_friendliness);
                $cliente->setQuality_of_candidates($quality_of_candidates);
                $cliente->setComments($comments);
                $cliente->setCreated_by($_SESSION['identity']->id);

                $save = $cliente->create();
                if ($save) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function evaluaciones()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isJunior())) {
            $customer = new Customer();
            $customers = $customer->getEvaluations();

            $page_title = 'Evaluaciones de clientes | RRHH Ingenia';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/customer/evaluations.php';
            require_once 'views/layout/footer.php';
        } else {
            header('location:' . base_url);
        }
    }

    public function condiciones()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            if (isset($_GET['id'])) {
                $edit = true;
                $id = Encryption::decode($_GET['id']);
                $customer = new Customer();
                $customer->setId($id);
                $cliente = $customer->getOne();
                //var_dump($cliente);die();

                $page_title = $cliente->alias . ' | RRHH Ingenia';
                require_once 'views/layout/header.php';
                require_once 'views/layout/sidebar.php';
                require_once 'views/customer/conditions.php';
                require_once 'views/layout/footer.php';
            } else {
                header('location:' . base_url . 'cliente/index');
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function update_conditions()
    {
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior())) {
            $id = (isset($_POST['id'])) ? Encryption::decode($_POST['id']) : FALSE;
            $recruitment_fee = (isset($_POST['recruitment_fee'])) ? trim($_POST['recruitment_fee']) : FALSE;
            $price_for_psychometrics = (isset($_POST['price_for_psychometrics'])) ? trim($_POST['price_for_psychometrics']) : FALSE;
            $price_for_talent_attraction = (isset($_POST['price_for_talent_attraction'])) ? trim($_POST['price_for_talent_attraction']) : FALSE;
            $credit_days = (isset($_POST['credit_days'])) ? trim($_POST['credit_days']) : FALSE;
            $box_cut = Utils::sanitizeNumber($_POST['box_cut']);

            if ($id && $credit_days) {
                $cliente = new Customer();
                $cliente->setId($id);
                $cliente->setRecruitment_fee($recruitment_fee);
                $cliente->setPrice_for_psychometrics($price_for_psychometrics);
                $cliente->setPrice_for_talent_attraction($price_for_talent_attraction);
                $cliente->setCredit_days($credit_days);
                $cliente->setBox_cut($box_cut);

                $update = $cliente->updateConditions();
                if ($update) {
                    echo 1;
                } else {
                    echo 2;
                }
            } else {
                echo 0;
            }
        } else {
            header('location:' . base_url);
        }
    }

    public function detallado()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager())) {
            $cliente = new Customer();
            $clientes = $cliente->getYearlyReport();

            $page_title = 'Detallado de clientes | RRHH Ingenia';

            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/customer/detail.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }
}
