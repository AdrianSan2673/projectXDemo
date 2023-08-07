<?php
require_once 'models/RH/EmployeeContact.php';

class EmpleadoContactoController
{

    public function save()
    {
        if (Utils::isCustomerSA() || Utils::isAdmin()) {
            $phone_number1 = Utils::sanitizeStringBlank($_POST['phone_number1']);
            $label1 = Utils::sanitizeStringBlank($_POST['label1']);
            $phone_number2 = Utils::sanitizeStringBlank($_POST['phone_number2']);
            $label2 = Utils::sanitizeStringBlank($_POST['label2']);
            $email = Utils::sanitizeEmail($_POST['email']);
            $emergency_number1 = Utils::sanitizeStringBlank($_POST['emergency_number1']);
            $emergency_contact1 = Utils::sanitizeStringBlank($_POST['emergency_contact1']);
            $emergency_relationship1 = Utils::sanitizeStringBlank($_POST['emergency_relationship1']);
            $emergency_number2 = Utils::sanitizeStringBlank($_POST['emergency_number2']);
            $emergency_contact2 = Utils::sanitizeStringBlank($_POST['emergency_contact2']);
            $emergency_relationship2 = Utils::sanitizeStringBlank($_POST['emergency_relationship2']);
            $id_employee = Utils::sanitizeNumber($_POST['id_employee']);
            $flag = $_POST['flag'];

            if ($id_employee) {
                $employeeContact = new EmployeeContact();
                $employeeContact->setId_employee($id_employee);
                $employeeContact->setPhone_number1($phone_number1);
                $employeeContact->setLabel1($label1);
                $employeeContact->setPhone_number2($phone_number2);
                $employeeContact->setLabel2($label2);
                $employeeContact->setEmail($email);
                $employeeContact->setEmergency_number1($emergency_number1);
                $employeeContact->setEmergency_contact1($emergency_contact1);
                $employeeContact->setEmergency_relationship1($emergency_relationship1);
                $employeeContact->setEmergency_number2($emergency_number2);
                $employeeContact->setEmergency_contact2($emergency_contact2);
                $employeeContact->setEmergency_relationship2($emergency_relationship2);

                if ($flag == 1)
                    $save = $employeeContact->save();
                else
                    $save = $employeeContact->update();

                if ($save)
                    echo json_encode(array('status' => 1));
            } else
                echo json_encode(array('status' => 0));
        }
    }


    public function getEmailsByIdEmployee()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_employee = Encryption::decode($_POST['id_employee']);
            if ($id_employee) {

                $employeeContactObj = new EmployeeContact();
                $employeeContactObj->setId_employee($id_employee);
                $email_Employee =  $employeeContactObj->getEmailsByIdEmployee();

                if ($email_Employee) {
                    echo json_encode(array(
                        'status' => 1,
                        'email_Employee' => $email_Employee
                    ));
                } else {
                    echo json_encode(array('status' => 0));
                }
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }
}
