<?php

require_once 'models/Notification.php';

class NotificationsController {

    public function getNotificacionsByUser(){
        if (Utils::isValid($_SESSION) && Utils::isValid($_SESSION['identity'])) {
            $id_user = $_SESSION['identity']->id;
            $notificacion = new Notification();
            $notificacion->setId_user($id_user);
            $notificaciones = $notificacion->getNotificationsByIdUser();
            $new = count($notificaciones) > 0 ? (in_array(1, array_column($notificaciones, 'status')) ? (array_count_values(array_column($notificaciones, 'status'))[1]) : 0) : 0;
            $received = count($notificaciones) > 0 ? (in_array(2, array_column($notificaciones, 'status')) ? (array_count_values(array_column($notificaciones, 'status'))[2]) : 0) : 0;
            $new = $new + $received;
            $data = array(
                'notifications' => $notificaciones,
                'id_user' => $id_user,
                'new' => $new,
                'status' => 1 ,
                'received'=> $received
             );
            $notificacion->received();
            echo json_encode($data);
        }
    }

    public function checked (){
        if (Utils::isValid($_SESSION) && Utils::isValid($_SESSION['identity'])) {
            $id_user = $_SESSION['identity']->id;
            $notificacion = new Notification();
            $notificacion->setId_user($id_user);
            $notificacion->checked();
            $notificaciones = $notificacion->getNotificationsByIdUser();
            $new = count($notificaciones) > 0 ? (in_array(1, array_column($notificaciones, 'status')) ? (array_count_values(array_column($notificaciones, 'status'))[1]) : 0) : 0;
            $received = count($notificaciones) > 0 ? (in_array(2, array_column($notificaciones, 'status')) ? (array_count_values(array_column($notificaciones, 'status'))[2]) : 0) : 0;
            $new = $new + $received;
            $data = array(
                'notifications' => $notificaciones,
                'id_user' => $id_user,
                'new' => $new,
                'status' => 1 
            );
            echo json_encode($data);
        }
    }

    public function clicked (){
        if (Utils::isValid($_SESSION['identity']) && isset($_POST) && isset($_POST['id'])) {
            $id = $_POST['id'];
            $id_user = $_SESSION['identity']->id;
            $notificacion = new Notification();
            $notificacion->setId($id);
            $notificacion->setId_user($id_user);
            $notificacion->clicked();
            $notificaciones = $notificacion->getNotificationsByIdUser();
            $new = count($notificaciones) > 0 ? (in_array(1, array_column($notificaciones, 'status')) ? (array_count_values(array_column($notificaciones, 'status'))[1]) : 0) : 0;
            $received = count($notificaciones) > 0 ? (in_array(1, array_column($notificaciones, 'status')) ? (array_count_values(array_column($notificaciones, 'status'))[2]) : 0) : 0;
            $new = $new + $received;
            $data = array(
                'notifications' => $notificaciones,
                'id_user' => $id_user,
                'new' => $new,
                'status' => 1 
            );
            echo json_encode($data);
        }
    }
}