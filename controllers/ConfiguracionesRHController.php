<?php

require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/User.php';
require_once 'models/RH/AsistenceTypes.php';

class ConfiguracionesRHController
{


    public function index()
    {

        if (Utils::isAdmin() || Utils::isCustomerSA()) {

            $contactoEmpresa = new ContactosEmpresa();
            $contactoEmpresa->setUsuario($_SESSION['identity']->username);
            $contactos = $contactoEmpresa->getClientesPorUsuarioContacto();

            $dptos = new AsistenceTypes();

            $dptos->setClient($_SESSION['id_cliente']);
            $types = $dptos->getAll();

            $page_title =  'Departamentos | RRHH Ingenia';
            require_once 'views/layout/header.php';
            require_once 'views/layout/sidebar.php';
            require_once 'views/SettingsRH/index.php';
            require_once 'views/SettingsRH/AsistenceTypes/modal-add-type.php';
            require_once 'views/layout/footer.php';
        } else
            header('location:' . base_url);
    }



    public function save_type()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA())) {

            $cliente = isset($_POST['client']) ? Encryption::decode(($_POST['client'])) : false;
            $type = isset($_POST['type']) ? Utils::sanitizeString($_POST['type']) : false;
            $flag = isset($_POST['flag']) ? Utils::sanitizeNumber($_POST['flag']) : false;
            $id_type = isset($_POST['id_type']) ? Utils::sanitizeNumber($_POST['id_type']) : false;


            if ($cliente && $type) {

                $Atype = new AsistenceTypes();

                if ($flag == 1) {

                    $Atype->setName($type);
                    $Atype->setClient($cliente);
                    $save = $Atype->save_type();

                    if ($save) {
                        $types = $Atype->getAllByClient();
                        echo json_encode(array('status' => 1, 'types' => $types));
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                } else if ($flag == 2) {

                    $Atype->setName($type);
                    $Atype->setId($id_type);
                    $save = $Atype->update_type();
                    $Atype->setClient($cliente);

                    if ($save) {
                        $types = $Atype->getAllByClient();
                        echo json_encode(array('status' => 1, 'types' => $types));
                    } else {
                        echo json_encode(array('status' => 2));
                    }
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }

    public function delete_type()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA())) {

            $id_type = isset($_POST['id_type']) ? Utils::sanitizeString($_POST['id_type']) : false;

            if ($id_type) {

                $Atype = new AsistenceTypes();


                $Atype->setId($id_type);
                $save = $Atype->delete_type();

                if ($save) {
                    $Atype->setClient($_SESSION['id_cliente']);
                    $types = $Atype->getAllByClient();
                    echo json_encode(array('status' => 1, 'types' => $types));
                } else {
                    echo json_encode(array('status' => 2));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }
}
