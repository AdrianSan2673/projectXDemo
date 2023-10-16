<?php
require_once 'models/User.php';
require_once 'models/SA/ContactosEmpresa.php';
require_once 'models/SA/CandidatosDatos.php';
require_once 'models/RH/Department.php';
require_once 'models/RH/EffectivenessIndicatiors.php';
require_once 'models/RH/Employees.php';
require_once 'models/RH/InterpersonalSkills.php';
require_once 'models/RH/Positions.php';
require_once 'models/RH/PositionsToAspire.php';
require_once 'models/RH/RequiredKnowledge.php';
require_once 'models/RH/SpecificResponsabilities.php';
require_once 'models/RH/SupervisingPositions.php';
require_once 'models/RH/EmployeeContact.php';
require_once 'models/RH/EmployeePayroll.php';
require_once 'models/RH/Employee_trainings.php';
require_once 'models/RH/HistoryPositions.php';

require_once 'models/RH/EmployeeContract.php';


class EmpleadoContratoController
{

    public function save()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_employee = Encryption::decode($_POST['id']);
            $contract_start = isset($_POST['contract_start']) ? Utils::sanitizeStringBlank($_POST['contract_start']) : null;
            $contract = isset($_POST['contract']) ? Encryption::decode($_POST['contract']) : null;
            
            if ($contract && $contract_start) {
                $contract = Encryption::decode($_POST['contract']);
                $contractType = Utils::contractType();
                $contractType = $contractType[$contract];

                $employeeContractObj = new EmployeeContract();
                $employeeContractObj->setId_employee($id_employee);
                $employeeContractObj->setContract_start($contract_start);
                $employeeContractObj->setType($contractType);

                if ($contract < 5 && isset($_POST['number']) && isset($_POST['period'])) {
                    $number = Utils::sanitizeNumber($_POST['number']);
                    $period = Utils::sanitizeString($_POST['period']);
                    $contract_end = date("Y-m-d", strtotime($contract_start . "+ " . $number . $period));
                    $employeeContractObj->setContract_end($contract_end);
                } else if ($contract >= 5) 
                    $employeeContractObj->setContract_end(null);
                
                $employeeContractObj->save();

                $oneContractEmployee=$employeeContractObj->getOneByIdEmployee();
                $oneContractEmployee->created_at=Utils::getDate($oneContractEmployee->created_at);
                $oneContractEmployee->contract_start=Utils::getDate($oneContractEmployee->contract_start);
                $oneContractEmployee->contract_end=isset($oneContractEmployee->contract_end) ? Utils::getDate($oneContractEmployee->contract_end) : 'Sin finalizacion';

                $employeeContractAll = $employeeContractObj->getAllByIdEmployee();
                for ($i = 0; $i < count($employeeContractAll); $i++) {
                    $employeeContractAll[$i]['id'] = Encryption::encode($employeeContractAll[$i]['id']);
                    $employeeContractAll[$i]['contract_start'] = Utils::getDate($employeeContractAll[$i]['contract_start']);
                    $employeeContractAll[$i]['contract_end'] = isset($employeeContractAll[$i]['contract_end']) ? Utils::getDate($employeeContractAll[$i]['contract_end']) : 'Sin finalizacin';
                }


                echo json_encode(
                    array(
                        'status' => 1,
                        'employeeContract' => $employeeContractAll,
                        'oneContractEmployee' => $oneContractEmployee
                    )
                );
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }


    public function delete()
    {

        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id_contract = Encryption::decode($_POST['id']);

            if ($id_contract) {
                $employeeContractObj = new EmployeeContract();
                $employeeContractObj->setId($id_contract);
                $employeeContractObj->setId_employee($employeeContractObj->getOne()->id_employee);

                $flag = $employeeContractObj->delete();

                if ($flag) {
                    $oneContractEmployee=$employeeContractObj->getOneByIdEmployee();
                    $oneContractEmployee->created_at=Utils::getDate($oneContractEmployee->created_at);
                    $oneContractEmployee->contract_start=Utils::getDate($oneContractEmployee->contract_start);
                    $oneContractEmployee->contract_end=isset($oneContractEmployee->contract_end) ? Utils::getDate($oneContractEmployee->contract_end) : 'Sin finalizacion';
                    $employeeContractAll = $employeeContractObj->getAllByIdEmployee();
                    for ($i = 0; $i < count($employeeContractAll); $i++) {
                        $employeeContractAll[$i]['id'] = Encryption::encode($employeeContractAll[$i]['id']);
                        $employeeContractAll[$i]['contract_start'] = Utils::getDate($employeeContractAll[$i]['contract_start']);
                        $employeeContractAll[$i]['contract_end'] = isset($employeeContractAll[$i]['contract_end']) ? Utils::getDate($employeeContractAll[$i]['contract_end']) : 'Sin finalizacin';
                    }

                    echo json_encode(
                        array(
                            'status' => 1,
                            'employeeContract' => $employeeContractAll,
                            'oneContractEmployee' => $oneContractEmployee
                        )
                    );
                } else
                    echo json_encode(array('status' => 3));
            } else
                echo json_encode(array('status' => 3));
        } else
            echo json_encode(array('status' => 0));
    }
}
