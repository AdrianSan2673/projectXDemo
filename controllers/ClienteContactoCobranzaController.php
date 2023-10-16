<?php

require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/ContactosCliente.php';
require_once 'models/CustomerContactsCollection.php';
require_once 'models/User.php';
require_once 'models/SA/Clientes.php';
require_once 'models/CustomerContact.php';


class ClienteContactoCobranzaController
{

    function getOne()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isSales() || Utils::isSalesManager())) {
            $id = Utils::sanitizeNumber(Encryption::decode($_POST['id']));
            if ($id) {
                $contactObj = new CustomerContactsCollection();
                $contactObj->setId($id);
                $contact = $contactObj->getOne();

                if ($contact) {
                    echo json_encode(array('status' => 1, 'contact' => $contact));
                } else {
                    echo json_encode(array('status' => 0));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }



    public function save()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isSales() || Utils::isSalesManager())) {
            $id = isset($_POST['id']) ? Utils::sanitizeNumber(Encryption::decode($_POST['id'])) : null;
            $id_cliente = isset($_POST['Cliente']) ? Utils::sanitizeNumber(Encryption::decode($_POST['Cliente'])) : null;
            $Nombre = isset($_POST['Cuentas_Contacto']) ? Utils::sanitizeString($_POST['Cuentas_Contacto']) : null;
            $Correo = isset($_POST['Cuentas_Correo']) ? Utils::sanitizeString($_POST['Cuentas_Correo']) : null;
            $Telefono = isset($_POST['Cuentas_Telefono']) ? Utils::sanitizeNumber($_POST['Cuentas_Telefono']) : null;
            $Extension = isset($_POST['Cuentas_Extension']) ? Utils::sanitizeNumber($_POST['Cuentas_Extension']) : null;
            $flag = $_POST['flag'];

            if ($id_cliente && ($flag == 1 || $flag == 2) && $Nombre) {
                $contactObj = new CustomerContactsCollection();
                $contactObj->setId($id);
                $contactObj->setId_customer($id_cliente);
                $contactObj->setName($Nombre);
                $contactObj->setEmail($Correo);
                $contactObj->setPhone($Telefono);
                $contactObj->setExtension($Extension);

                if ($flag == 1) {
                    $success  = $contactObj->save();
                } else if ($flag == 2) {
                    $success  = $contactObj->update();
                }

                $contactos = $contactObj->getALLById_cliente();
                foreach ($contactos as &$contacto) {
                    $contacto['id'] = Encryption::encode($contacto['id']);
                }

                if ($success) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'contactos' => $contactos
                        )
                    );
                } else {
                    echo json_encode(array('status' => 2));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 3));
        }
    }



    public function delete()
    {
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isManager() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isSales() || Utils::isSalesManager())) {
            $id = isset($_POST['id']) ? Utils::sanitizeNumber(Encryption::decode($_POST['id'])) : null;

            if ($id) {
                $contactObj = new CustomerContactsCollection();
                $contactObj->setId($id);
                $id_cliente = $contactObj->getOne()->id_customer;
                $success = $contactObj->delete();

                if ($success) {
                    $contactObj->setId_customer($id_cliente);
                    $contactos = $contactObj->getALLById_cliente();
                    foreach ($contactos as &$contacto) {
                        $contacto['id'] = Encryption::encode($contacto['id']);
                    }
                    echo json_encode(
                        array(
                            'status' => 1,
                            'contactos' => $contactos
                        )
                    );
                } else {
                    echo json_encode(array('status' => 0));
                }
            } else {
                echo json_encode(array('status' => 0));
            }
        } else {
            echo json_encode(array('status' => 0));
        }
    }
}
