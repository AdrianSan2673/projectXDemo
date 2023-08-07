<?php

require_once 'models/User.php';
require_once 'models/Candidate.php';
require_once 'models/CandidateEducation.php';
require_once 'models/Vacancy.php';
require_once 'models/VacancyApplicant.php';
require_once 'models/CustomerContact.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/ContactosCliente.php';
require_once 'models/SA/EncuestaCliente.php';
require_once 'models/RH/EmployeeAvatar.php';
require_once 'models/RH/Employees.php';

class EmpleadoFotoController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isCustomerSA())) {
            $id = isset($_POST['id']) ? Utils::sanitizeNumber($_POST['id']) : Utils::sanitizeNumber($_GET['id']);
            if ($id) {
                $avatar = new EmployeeAvatar();
                $avatar->setId($id);
                $data = $avatar->getOne();

                if ($data) {
                    $data->status = 1;
                    echo json_encode($data);
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
            $id_employee = Utils::sanitizeNumber(($_POST['id_employee']));
            $flag = $_POST['flag'];
            
            $Objeto = explode(';', $Objeto);
            $Objeto = explode(',', $Objeto[1]);
            $Objeto = str_replace(' ', '+', $Objeto);
            $Objeto = (base64_decode($Objeto[1]));
            $file_name = strlen($file_name) < 50 ? $file_name : substr($file_name, -50);
            if ($Objeto) {
                $employeeAvatarObj = new EmployeeAvatar();
                $employeeAvatarObj->setId($id);
                $employeeAvatarObj->setId_employee($id_employee);
                $employeeAvatarObj->setImage($Objeto);
                $employeeAvatarObj->setFile_name($file_name);
                
                if ($flag == 1)
                    $save = $employeeAvatarObj->update();
                else{
                    $employeeAvatarObj->delete();
                    $save = $employeeAvatarObj->save();
                }

                if ($save) {
                    $avatar = $employeeAvatarObj->getOne();

                    $employeeObj = new Employees();
                    $employeeObj->setId($id_employee);
                    $employee = $employeeObj->getOne();

                    if (!$avatar) {
                        $avatar = new stdClass();
                        if ($employee->id_gender == 2)
                            $avatar->image = array('../dist/img/user-icon-rose.png', 'png', false);
                        else
                            $avatar->image = array('../dist/img/user-icon.png', 'png', false);
                    }else
                        $avatar->image[2] = true;


                    $display = Utils::getDisplayBotones();
                    $data = array(
                        'avatar' => $avatar,
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

    public function delete(){
        if (Utils::isValid($_SESSION['identity']) && (Utils::isAdmin() || Utils::isCustomerSA())) {
            $id_employee = Utils::sanitizeNumber(($_POST['id_employee']));
            
            if ($id_employee) {
                $employeeAvatarObj = new EmployeeAvatar();
                $employeeAvatarObj->setId_employee($id_employee);
                $delete = $employeeAvatarObj->delete();

                if ($delete) {
                    $avatar = $employeeAvatarObj->getOne();

                    $employeeObj = new Employees();
                    $employeeObj->setId($id_employee);
                    $employee = $employeeObj->getOne();

                    if (!$avatar) {
                        $avatar = new stdClass();
                        if ($employee->id_gender == 2)
                            $avatar->image = array('../dist/img/user-icon-rose.png', 'png', false);
                        else
                            $avatar->image = array('../dist/img/user-icon.png', 'png', false);
                    }else
                        $avatar->image[2] = true;


                    $display = Utils::getDisplayBotones();
                    $data = array(
                        'avatar' => $avatar,
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
}
