<?php
require_once 'models/User.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/EmployeeFamily.php';



class EmpleadoFamiliaController
{


    public function save()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && $_POST) {
            $id =isset($_POST['id'])?Encryption::decode($_POST['id']):'null';
            $name = isset($_POST['name'])? Utils::sanitizeStringBlank($_POST['name']):null;
            $type = $_POST['type'];
            $age =isset($_POST['age'])?  Utils::sanitizeNumber($_POST['age']):null;
            $id_employee = Encryption::decode($_POST['id_employee']);
            $flag = $_POST['flag'];

            if ($type && $id_employee) {
                $employeeFamilyObj = new EmployeeFamily();
                $employeeFamilyObj->setId($id);
                $employeeFamilyObj->setName($name);
                $employeeFamilyObj->setType($type);
                $employeeFamilyObj->setAge($age);
                $employeeFamilyObj->setId_employee($id_employee);

                if ($flag == 1)
                    $save = $employeeFamilyObj->save();
                else
                    $save = $employeeFamilyObj->update();

                $employeeFamily = $employeeFamilyObj->getAllByIdEmployee();

                for ($i = 0; $i < count($employeeFamily); $i++) {
                    $employeeFamily[$i]['id'] = Encryption::encode($employeeFamily[$i]['id']);
                    $employeeFamily[$i]['id_employee'] = Encryption::encode($employeeFamily[$i]['id_employee']);
                    $employeeFamily[$i]['type'] = Utils::labelFamily($employeeFamily[$i]['type']);
                    $employeeFamily[$i]['created_at'] = Utils::getFullDate($employeeFamily[$i]['created_at']);
                }

                if ($save) {
                    $id = $employeeFamilyObj->getId();
                    echo json_encode(
                        array(
                            'status' => 1,
                            'employeeFamily' => $employeeFamily
                        )
                    );
                }
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 2));
    }


    public function getOne()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $employeeFamilyObj = new EmployeeFamily();
                $employeeFamilyObj->setId($id);
                $employeeFamily = $employeeFamilyObj->getOne();
                $employeeFamily->id=Encryption::encode($employeeFamily->id);
                echo json_encode(array(
                    'status' => 1,
                    'employeeFamily' => $employeeFamily,
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }




    public function delete()
    {
        if ((Utils::isAdmin() || Utils::isCustomerSA()) && $_POST) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $employeeFamilyObj = new EmployeeFamily();
                $employeeFamilyObj->setId($id);
                $id_employee=$employeeFamilyObj->getOne()->id_employee;
                $employeeFamilyObj->setId_employee($id_employee);
                
                $delete = $employeeFamilyObj->delete();

                $employeeFamily = $employeeFamilyObj->getAllByIdEmployee();

                for ($i = 0; $i < count($employeeFamily); $i++) {
                    $employeeFamily[$i]['id'] = Encryption::encode($employeeFamily[$i]['id']);
                    $employeeFamily[$i]['id_employee'] = Encryption::encode($employeeFamily[$i]['id_employee']);
                    $employeeFamily[$i]['type'] = Utils::labelFamily($employeeFamily[$i]['type']);
                    $employeeFamily[$i]['created_at'] = Utils::getFullDate($employeeFamily[$i]['created_at']);
                }

                if ($delete) {
                    echo json_encode(
                        array(
                            'status' => 1,
                            'employeeFamily' => $employeeFamily
                        )
                    );
                } else
                    echo json_encode(array('status' => 2));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 2));
    }



}
