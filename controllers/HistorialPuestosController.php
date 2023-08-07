<?php

require_once 'models/RH/HistoryPositions.php';


class HistorialPuestosController
{

    public function getOne()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            if ($_POST && (Utils::isAdmin() || Utils::isCustomerSA())) {
                $historyPositionsObj = new HistoryPositions();
                $historyPositionsObj->setId($id);
                $historyPositions = $historyPositionsObj->getOne();
                $historyPositions->id = Encryption::encode($historyPositions->id);
                echo json_encode($historyPositions);
            } else echo 0;
        } else echo 0;
    }

    function save()
    {
        
        if ($_POST && (Utils::isAdmin() || Utils::isCustomerSA())) {
            $id_employee = Encryption::decode($_POST['id']);
            $start_date = $_POST['start_date'];
            $id_position = Encryption::decode($_POST['id_position']);

            $historyPositionsObj = new HistoryPositions();
            $historyPositionsObj->setId_employee($id_employee);
            $historyPositionsObj->setId_position($id_position);
            $historyPositionsObj->setStart_date($start_date);
            $historyPositionsObj->save1();

            $historyPositions = $historyPositionsObj->getAllByIdEmployee();

            for ($i = 0; $i < count($historyPositions); $i++) {
                $historyPositions[$i]['id'] = Encryption::encode($historyPositions[$i]['id']);
                $historyPositions[$i]['created_at'] = Utils::getDate($historyPositions[$i]['created_at']);
                $historyPositions[$i]['start_date'] = Utils::getDate($historyPositions[$i]['start_date']);
            }


            echo json_encode(array(
                'status' => 1,
                'hisotryPosition' => $historyPositions,
            ));
        } else
            echo json_encode(array('status' => 0));
    }



    function updatStartDate()
    {

        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $start_date = Utils::sanitizeString($_POST['start_date']);
            $id_employee = Encryption::decode($_POST['id_employee']);

            if ($id && $start_date && $id_employee) {
                $historyPositionsObj = new HistoryPositions();
                $historyPositionsObj->setId($id);
                $historyPositionsObj->setStart_date($start_date);
                $historyPositionsObj->updateStar_date();

                $historyPositionsObj->setId_employee($id_employee);
                $historyPositions = $historyPositionsObj->getAllByIdEmployee();

                for ($i = 0; $i < count($historyPositions); $i++) {
                    $historyPositions[$i]['id'] = Encryption::encode($historyPositions[$i]['id']);
                    $historyPositions[$i]['created_at'] = Utils::getDate($historyPositions[$i]['created_at']);
                    $historyPositions[$i]['start_date'] = Utils::getDate($historyPositions[$i]['start_date']);
                }


                echo json_encode(array(
                    'status' => 1,
                    'hisotryPosition' => $historyPositions,
                ));
            } else
                echo json_encode(array('status' => 0));
        } else
            echo json_encode(array('status' => 0));
    }

















    function delet()
    {
        $id = Encryption::decode($_POST['id']);
        if ($id) {
            $historyPositionsObj = new HistoryPositions();
            $historyPositionsObj->setId($id);
            $id_employee = $historyPositionsObj->getOne()->id_employee;
            $flag = $historyPositionsObj->delet();


            if ($flag) {
                $historyPositionsObj = new HistoryPositions();
                $historyPositionsObj->setId_employee($id_employee);
                $historyPositions = $historyPositionsObj->getAllByIdEmployee();

                for ($i = 0; $i < count($historyPositions); $i++) {
                    $historyPositions[$i]['id'] = Encryption::encode($historyPositions[$i]['id']);
                    $historyPositions[$i]['created_at'] = Utils::getDate($historyPositions[$i]['created_at']);
                }


                echo json_encode(array(
                    'status' => 1,
                    'hisotryPosition' => $historyPositions,
                ));
            } else
                echo json_encode(array('status' => 1));
        } else
            echo json_encode(array('status' => 1));
    }
}
