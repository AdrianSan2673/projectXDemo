<?php

require_once 'models/SA/ClientesNotas.php';

class ClienteNotasController{

    public function save(){
        if (Utils::isValid($_POST) && (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior() || Utils::isSalesManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount())) {

            $ID_Cliente = Utils::sanitizeNumber(Encryption::decode($_POST['ID_Cliente']));
            $ID_Cliente_Reclu = Utils::sanitizeNumber(Encryption::decode($_POST['ID_Cliente_Reclu']));
            $Comentarios = Utils::sanitizeStringBlank($_POST['Comentarios']);
            $Usuario = $_SESSION['identity']->username;
            if (($ID_Cliente || $ID_Cliente_Reclu) && $Comentarios) {
                $nota = new ClientesNotas();
                $nota->setID_Cliente($ID_Cliente);
                $nota->setid_Cliente_Reclu($ID_Cliente_Reclu);
                $nota->setComentarios($Comentarios);
                $nota->setUsuario($Usuario);
                $save = $nota->create();

                if ($save) {
                    $notas = $ID_Cliente ? $nota->getNotasPorCliente() : $nota->getNotasPorClienteReclu();

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
}