<?php

require_once 'models/RH/EmployeeDocument.php';

class EmpleadoDocumentoController {


    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isCustomerSA())) {
            $id = isset($_POST['id']) ? Utils::sanitizeNumber($_POST['id']) : Utils::sanitizeNumber($_GET['id']);
            if ($id) {
                $document = new EmployeeDocument();
                $document->setId($id);
                $data = $document->getOne();

                $image = new EmployeeDocument();
                $image->setId_employee($data->id_employee);
                $documents = $image->getMissingDocuments();
                $documents = array_values($documents);

                if ($data) {
                    echo json_encode(array('data' => $data, 'documents' => $documents, 'status' => 1));
                } else 
                    echo json_encode(array('status' => 0));
                
            }else echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isCustomerSA())) {
            $id = Utils::sanitizeNumber(($_POST['id']));
            $file_name = Utils::sanitizeString($_POST['file_name']);
            $Objeto = $_POST['Objeto'];
            $id_employee = Utils::sanitizeNumber(Encryption::decode($_POST['id_employee']));
            $document = Utils::sanitizeNumber($_POST['document']);
            $flag = $_POST['flag'];
            
            $Objeto = explode(';', $Objeto);
            $Objeto = explode(',', $Objeto[1]);
            $Objeto = str_replace(' ', '+', $Objeto);
            $Objeto = (base64_decode($Objeto[1]));
            $file_name = strlen($file_name) < 50 ? $file_name : substr($file_name, -50);
            if ($Objeto) {
                $employeeDocument = new EmployeeDocument();
                $employeeDocument->setId($id);
                $employeeDocument->setId_employee($id_employee);
                $employeeDocument->setImage($Objeto);
                $employeeDocument->setFile_name($file_name);
                $employeeDocument->setDocument($document);
                
                if ($flag == 1)
                    $save = $employeeDocument->update();
                else{
                    $save = $employeeDocument->save();
                }

                if ($save) {
                    $documents = $employeeDocument->getDocumentsByIdEmployee();
                    

                    $display = Utils::getDisplayBotones();
                    $data = array(
                        'documents' => $documents,
                        'status' => 1,
                        'display' => $display
                    );

                    echo json_encode($data);
                }else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }

    public function getDocumentosPorCompletar(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isCustomerSA())) {
            $id_employee = Utils::sanitizeNumber(Encryption::decode($_POST['id_employee']));

            if ($id_employee) {
                $image = new EmployeeDocument();
                $image->setId_employee($id_employee);
                $data = $image->getMissingDocuments();
                $data = array_values($data);

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }
}