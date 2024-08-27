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

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $filename = $_FILES['file']['name'];
    $file_temp = $_FILES['file']['tmp_name'];

    $route = $targetDir . basename($filename);

    // Añadimos un echo para verificar si el archivo se está moviendo
    if (move_uploaded_file($file_temp, $route)) {
        echo "El archivo " . htmlspecialchars($filename) . " ha sido subido.";

        $upload_date = date("Y-m-d");
        $upload_time = date("H:i:s");

        // Preparar la consulta SQL para insertar en SQL Server
        $sql = "INSERT INTO archivos_subidos (file_name, upload_date, upload_time) 
        VALUES (:file_name, :upload_date, :upload_time)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':file_name', $filename);
        $stmt->bindParam(':upload_date', $upload_date);
        $stmt->bindParam(':upload_time', $upload_time);


        // Añadimos un echo para verificar si la consulta SQL se ejecuta
        if ($stmt->execute()) {
            echo "Los detalles del archivo han sido guardados en la base de datos.";
        } else {
            echo "Hubo un error al guardar los detalles del archivo en la base de datos.";
            print_r($stmt->errorInfo()); // Mostrar información del error SQL
        }
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
} else {
    echo "Método de solicitud no válido o archivo no enviado.";
}
