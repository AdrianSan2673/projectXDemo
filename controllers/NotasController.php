<?php

require_once 'models/SA/NotasEjecutivo.php';

class NotasController{

    public function getOne(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Id = Utils::sanitizeNumber($_POST['Id']);
            
            if ($Id) {
                $nota = new NotasEjecutivo();
                $nota->setId($Id);
                $data = $nota->getOne();

                if ($data) {
                    header('Content-Type: text/html; charset=utf-8');
                    echo json_encode($data, \JSON_UNESCAPED_UNICODE);
                } else echo 0;
                
            }else echo 0;
        } else
            header('location:'.base_url);
    }

    public function save(){
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {

            $Id = Utils::sanitizeNumber(($_POST['Id']));
            $Folio = Utils::sanitizeNumber(($_POST['Folio']));
            $Nota = ($_POST['Nota']);
            $Ejecutivo = $_SESSION['identity']->username;
            $flag = $_POST['flag'];

            if ($Nota) {
                $nota = new NotasEjecutivo();
                $nota->setId($Id);
                $nota->setNota($Nota);
                $nota->setEjecutivo($Ejecutivo);
                $nota->setCandidato($Folio);

                if ($flag == 1)
                    $save = $nota->update();
                else
                    $save = $nota->create();

                if ($save) {
                    $notas = $nota->getNotasPorCandidato();

                    for($i=0; $i < count($notas); $i++){
                        $path = 'uploads/avatar/'.$notas[$i]['id_user'];
                        if (file_exists($path)) {
                            $directory = opendir($path);
                
                            while ($file = readdir($directory))
                            {
                                if (!is_dir($file))
                                    $route = $path.'/'.$file;
                            }
                        }else
                            $route = "dist/img/user-icon.png";
                            
                        $notas[$i]['avatar'] = base_url.$route;
                    }

                    echo json_encode(
                        array(
                            'notas' => $notas,
                            'display' => Utils::getDisplayBotones(),
                            'status' => 1
                        )
                    );
                } else 
                    echo json_encode(array('status' => 2));
                
            }else {
                echo json_encode(array('status' => 0));
            }
        }else{
            header('location:'.base_url);
        }
    }

    public function delete(){
        if (Utils::isValid($_SESSION['identity']) && Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics()) {
            $Id = Utils::sanitizeNumber($_POST['Id']);
            $Candidato = Utils::sanitizeNumber($_POST['Folio']);

            if ($Candidato && $Id) {
                $nota = new NotasEjecutivo();
                $nota->setId($Id);
                $nota->setCandidato($Candidato);
                
                $delete = $nota->delete();

                if ($delete) {
                    $notas = $nota->getNotasPorCandidato();

                    for($i=0; $i < count($notas); $i++){
                        $path = 'uploads/avatar/'.$notas[$i]['id_user'];
                        if (file_exists($path)) {
                            $directory = opendir($path);
                
                            while ($file = readdir($directory))
                            {
                                if (!is_dir($file))
                                    $route = $path.'/'.$file;
                            }
                        }else
                            $route = "dist/img/user-icon.png";
                            
                        $notas[$i]['avatar'] = base_url.$route;
                    }
                    
                    $data = array(
                        'notas' => $notas,
                        'display' => Utils::getDisplayBotones(),
                        'status' => 1
                    );
                    echo json_encode($data);
                }
                else echo json_encode(array('status' => 2));

            }else
                echo json_encode(array('status' => 0));
        } else
            header('location:'.base_url);
    }
}