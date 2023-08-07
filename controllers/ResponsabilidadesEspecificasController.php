<?php


require_once 'models/RH/SpecificResponsabilities.php';

class ResponsabilidadesEspecificasController
{

     public function save()
     {
          if (Utils::isAdmin() || Utils::isCustomerSA()) {
               $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
               $responsability = Utils::sanitizeStringBlank($_POST['responsability']);
               $activities = Utils::sanitizeStringBlank($_POST['activities']);
               $flag = $_POST['flag'];
               //$id_position = 10;

               if ($responsability && $activities ) {
                    $responsabilityEspec = new SpecificResponsabilities();
                    $responsabilityEspec->setResponsability($responsability);
                    $responsabilityEspec->setActivities($activities);
                    $responsabilityEspec->setId_position($id_position);

                    if ($flag == 1) {
                         $respEspec = $responsabilityEspec->save();
                    } else {
                         $responsabilityEspec->setId(Encryption::decode($_POST['id_responsabilidad']));
                         $respEspec = $responsabilityEspec->update();
                    }
                    $responsabilityEspec = $responsabilityEspec->getAllByIdPosition();

                    for ($i = 0; $i < count($responsabilityEspec); $i++) {
                         $responsabilityEspec[$i]['id'] = Encryption::encode($responsabilityEspec[$i]['id']);
                    }

                    echo json_encode(array(
                         'responsabilidades' => $responsabilityEspec,
                         'id_position' => $_POST['id_position'],
                         'status' => 1
                    ));
               } else {
                    echo json_encode(array('status' => 0));
               }
          } else {
               echo json_encode(array('status' => 2));
          }
     }


     public function getOne()
     {
          if (Utils::isAdmin() || Utils::isCustomerSA()) {
               $id = Encryption::decode($_POST['id']);
               if ($id) {
                    $responsabilityEspec = new SpecificResponsabilities();
                    $responsabilityEspec->setId($id);
                    $responsabilityEspec = $responsabilityEspec->getOne();
                    $responsabilityEspec->id = Encryption::encode($responsabilityEspec->id);
                    echo json_encode($responsabilityEspec);
               } else echo 0;
          } else echo 0;
     }

     public function delete()
     {
          if (Utils::isAdmin() || Utils::isCustomerSA()) {
               $id = Encryption::decode($_POST['id']);
               $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
               //$id_position = 10;


               if ($id && $id_position) {
                    $responsabilityEspec = new SpecificResponsabilities();
                    $responsabilityEspec->setId($id);
                    $responsabilityEspec->delete();
                    $responsabilityEspec->setId_position($id_position);
                    $responsabilityEspec = $responsabilityEspec->getAllByIdPosition();

                    for ($i = 0; $i < count($responsabilityEspec); $i++) {
                         $responsabilityEspec[$i]['id'] = Encryption::encode($responsabilityEspec[$i]['id']);
                    }

                    echo json_encode(array(
                         'responsabilidades' => $responsabilityEspec,
                         'id_position' => $_POST['id_position'],
                         'status' => 1
                    ));
               } else  echo json_encode(array('status' => 0));
          } else echo json_encode(array('status' => 0));
     }
}
