<?php

require_once 'models/RH/Employees.php';
require_once 'models/RH/EmployeePayroll.php';

class EmpleadoNominaController
{

    public function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $gross_pay = isset($_POST['gross_pay']) && is_numeric($_POST['gross_pay']) ? number_format($_POST['gross_pay'], 2) : null;
            $net_pay = isset($_POST['net_pay']) && is_numeric($_POST['net_pay']) ? number_format($_POST['net_pay'], 2) : null;
            $bank = isset($_POST['bank']) ? $_POST['bank'] : null;
            $account_number = isset($_POST['account_number']) ? $_POST['account_number'] : null;
            $CLABE = isset($_POST['CLABE']) ? $_POST['CLABE'] : null;
            $created_at = Utils::sanitizeString($_POST['created_at']);

            if ($id && $gross_pay  && $bank && ($account_number || $CLABE) && $created_at) {

                $employeePayrollObj = new EmployeePayroll();
                $employeePayrollObj->setId_employee($id);
                $employeePayrollObj->setGross_pay($gross_pay);
                $employeePayrollObj->setNet_pay($net_pay);
                $employeePayrollObj->setBank($bank);
                $employeePayrollObj->setAccount_number($account_number);
                $employeePayrollObj->setCLABE($CLABE);
                $employeePayrollObj->setCreated_at($created_at);
                $employeePayrollObj->save();

                $id = $employeePayrollObj->getId();
                $employeePayrollObj->setId($id);
                $employeePayroll = $employeePayrollObj->getOne1();

                $employeePayroll->modified_at = Utils::getDate($employeePayroll->modified_at);

                $employeePayroll->gross_pay = number_format($employeePayroll->gross_pay, 2);
                $employeePayroll->start_pay = isset($employeePayroll->start_pay) ? number_format($employeePayroll->start_pay, 2) : $employeePayroll->gross_pay;

                $employeePayroll->created_at = Utils::getDate($employeePayroll->created_at);
                $employeePayroll->account_number = isset($employeePayroll->account_number) ? $employeePayroll->account_number : 'Sin definir';
                $employeePayroll->CLABE = isset($employeePayroll->CLABE) && $employeePayroll->CLABE != '' ? $employeePayroll->CLABE : 'Sin definir';

                $employeePayrollAll = $employeePayrollObj->getAll();
                for ($i = 0; $i < count($employeePayrollAll); $i++) {
                    $employeePayrollAll[$i]['id'] = Encryption::encode($employeePayrollAll[$i]['id'], 2);
                    $employeePayrollAll[$i]['gross_pay'] = number_format($employeePayrollAll[$i]['gross_pay'], 2);
                    $employeePayrollAll[$i]['created_at'] = Utils::getDate($employeePayrollAll[$i]['created_at']);
                }

                echo json_encode(array(
                    'status' => 1,
                    'employeePayroll' => $employeePayroll,
                    'employeePayrollAll' => $employeePayrollAll
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 2));
    }


    public function deletePayroll()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($id) {
                $employeePayrollObj = new EmployeePayroll();
                $employeePayrollObj->setId($id);

                $employeePayroll2 = $employeePayrollObj->getOne1();
                $id_employee = $employeePayroll2->id_employee;

                $employeePayrollObj->delete();

                $employeePayrollObj->setId_employee($id_employee);
                $employeePayroll = $employeePayrollObj->getOneByIdEmployee();

                if ($employeePayroll != false) {
                    $employeePayroll->modified_at = isset($employeePayroll->modified_at) ? Utils::getDate($employeePayroll->modified_at) : 'Sin definir';
                    $employeePayroll->gross_pay = isset($employeePayroll->gross_pay) ? number_format($employeePayroll->gross_pay, 2) : 'Sin definir';
                    $employeePayroll->start_pay = isset($employeePayroll->start_pay) ? number_format($employeePayroll->start_pay, 2) : $employeePayroll->gross_pay;
                    $employeePayroll->created_at = isset($employeePayroll->created_at) ? Utils::getDate($employeePayroll->created_at) : 'Sin definir';
                    $employeePayroll->account_number = isset($employeePayroll->account_number) ? $employeePayroll->account_number : 'Sin definir';
                    $employeePayroll->CLABE = isset($employeePayroll->CLABE) && $employeePayroll->CLABE != '' ? $employeePayroll->CLABE : 'Sin definir';

                    $employeePayrollAll = $employeePayrollObj->getAll();

                    for ($i = 0; $i < count($employeePayrollAll); $i++) {
                        $employeePayrollAll[$i]['id'] = Encryption::encode($employeePayrollAll[$i]['id'], 2);
                        $employeePayrollAll[$i]['gross_pay'] = number_format($employeePayrollAll[$i]['gross_pay'], 2);
                        $employeePayrollAll[$i]['created_at'] = Utils::getDate($employeePayrollAll[$i]['created_at']);
                    }
                } else {
                    $employeePayroll='';

             /*        $employeePayroll->modified_at = 'Sin definir';
                    $employeePayroll->gross_pay = 'Sin definir';
                    $employeePayroll->start_pay = $employeePayroll->gross_pay;
                    $employeePayroll->created_at = 'Sin definir';
                    $employeePayroll->account_number = 'Sin definir';
                    $employeePayroll->CLABE = 'Sin definir'; */

                    $employeePayrollAll = '';
                }



                echo json_encode(array(
                    'status' => 1,
                    'employeePayroll' => $employeePayroll,
                    'employeePayrollAll' => $employeePayrollAll
                ));
            } else {
                echo json_encode(array('status' => 0));
            }
        } else
            echo json_encode(array('status' => 2));
    }
}
