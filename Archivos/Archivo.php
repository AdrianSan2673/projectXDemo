<?php

require_once __DIR__ . '/../config/Connection.php';

try {
    // Establecer la conexión a la base de datos
    $db = Connection::connect();
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}

$targetDir = __DIR__ . '/Files/';

// Manejo de la eliminación de archivos
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = $_GET['delete'];

    // Recuperar la información del archivo a eliminar
    $sql = "SELECT file_name FROM archivos_subidos WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $file = $stmt->fetch(PDO::FETCH_OBJ);

    if ($file) {
        $filePath = $targetDir . $file->file_name;

        // Eliminar archivo del sistema de archivos
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Eliminar detalles del archivo de la base de datos
        $sql = "DELETE FROM archivos_subidos WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            echo "Archivo eliminado correctamente.";
        } else {
            echo "Hubo un error al eliminar el archivo.";
        }
    }

    // Redirigir a la página anterior después de eliminar el archivo
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}


if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $filename = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];
    $id_proyecto = $_POST['id_proyecto'];

    $route = $targetDir . basename($filename);

    // Añadimos un echo para verificar si el archivo se está moviendo
    if (move_uploaded_file($file_temp, $route)) {
        echo "El archivo " . htmlspecialchars($filename) . " ha sido subido.";

        $upload_date = date("Y-m-d");
        $upload_time = date("H:i:s");


        // Preparar la consulta SQL para insertar en SQL Server
        $sql = "INSERT INTO archivos_subidos (file_name, upload_date, upload_time, id_proyecto) 
        VALUES (:file_name, :upload_date, :upload_time, :id_proyecto)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':file_name', $filename);
        $stmt->bindParam(':upload_date', $upload_date);
        $stmt->bindParam(':upload_time', $upload_time);
        $stmt->bindParam(':id_proyecto', $id_proyecto);

        // Añadimos un echo para verificar si la consulta SQL se ejecuta
        if ($stmt->execute()) {
            //echo "Los detalles del archivo han sido guardados en la base de datos.";

            // Redirigir a la página anterior después de la carga exitosa
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            session_start();
            $_SESSION['msj'] = "Archivo subido correctamente";
        } else {
            //echo "Hubo un error al guardar los detalles del archivo en la base de datos.";
            session_start();
            $_SESSION['msj2'] = "Hubo un error al guardar los detalles del archivo";
            print_r($stmt->errorInfo()); // Mostrar información del error SQL
        }
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
} else {
    echo "Método de solicitud no válido o archivo no enviado.";
}

// Recuperar los archivos subidos desde la base de datos
$sql = "SELECT * FROM archivos_subidos";
$stmt = $db->prepare($sql);
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_OBJ);
