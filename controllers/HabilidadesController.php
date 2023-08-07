<?php


require_once 'models/RH/InterpersonalSkills.php';

class HabilidadesController
{

     public function save()
     {
          if (Utils::isAdmin() || Utils::isCustomerSA()) {
               $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
               $skill = Utils::sanitizeStringBlank($_POST['skill']);
               $flag = $_POST['flag'];

               if ($skill && $id_position) {
                    $interpersonalSkills = new InterpersonalSkills();
                    $interpersonalSkills->setSkill($skill);
                    $interpersonalSkills->setId_position($id_position);
                    if ($flag == 1) {
                         $interpersonalSkills->save();
                    } else {
                         
                         $interpersonalSkills->setId(Encryption::decode($_POST['id_skill']));
                         $interpersonalSkills->update();
                    }
                    $interpersonalSkills = $interpersonalSkills->getAllByIdPosition();

                    for ($i = 0; $i < count($interpersonalSkills); $i++) {
                         $interpersonalSkills[$i]['id'] = Encryption::encode($interpersonalSkills[$i]['id']);
                         $interpersonalSkills[$i]['id_position'] = Encryption::encode($interpersonalSkills[$i]['id_position']);
                    }

                    echo json_encode(array(
                         'habilidades' => $interpersonalSkills,
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
                $interpersonalSkills = new InterpersonalSkills();
                $interpersonalSkills->setId($id);
                $interpersonalSkills = $interpersonalSkills->getOne();
                $interpersonalSkills->id = Encryption::encode($interpersonalSkills->id);
                echo json_encode($interpersonalSkills);
            } else echo 0;
        } else echo 0;
    }

    public function delete()
    {
        if (Utils::isAdmin() || Utils::isCustomerSA()) {
            $id = Encryption::decode($_POST['id']);
            $id_position = Utils::sanitizeStringBlank(Encryption::decode($_POST['id_position']));
            if ($id) {
                $interpersonalSkills = new InterpersonalSkills();
                $interpersonalSkills->setId($id);
                $interpersonalSkills->delete();

                $interpersonalSkills->setId_position($id_position);
                $interpersonalSkills = $interpersonalSkills->getAllByIdPosition();

                for ($i = 0; $i < count($interpersonalSkills); $i++) {
                    $interpersonalSkills[$i]['id'] = Encryption::encode($interpersonalSkills[$i]['id']);
                    $interpersonalSkills[$i]['id_position'] = Encryption::encode($interpersonalSkills[$i]['id_position']);
                }

                echo json_encode(array(
                    'habilidades' => $interpersonalSkills,
                    'id_position' => $id_position,
                    'status' => 1
                ));
            } else  echo json_encode(array('status' => 0));
        } else echo json_encode(array('status' => 0));
    }
}
