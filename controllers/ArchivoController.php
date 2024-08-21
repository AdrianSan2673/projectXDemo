<?php
class ArchivoController
{
    public function index()
    {
        $fileModel = new FileModel();
        $files = $fileModel->getAllFiles(); // Obtener todos los archivos para mostrarlos en la tabla

        require '../views/department/read.php'; // Renderiza la vista y pasa los archivos
    }

    public function upload_file()
    {
        if (Utils::isValid($_POST)) {
            $evidence_document = isset($_FILES['evidence_document']) && $_FILES['evidence_document']['name'] != '' ? $_FILES['evidence_document'] : FALSE;

            if ($evidence_document) {
                $allowed_formats = array("application/pdf");

                if (in_array($_FILES["evidence_document"]["type"], $allowed_formats)) {
                    $fileModel = new FileModel();

                    $fileName = basename($_FILES["evidence_document"]["name"]);
                    $uploadDate = date('Y-m-d');
                    $uploadTime = date('H:i:s');
                    $uploadDir = 'uploads/evidencias/';
                    $filePath = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES["evidence_document"]["tmp_name"], $filePath)) {
                        $fileModel->saveFile($fileName, $uploadDate, $uploadTime);

                        $viewLink = base_url . $filePath;
                        $downloadLink = base_url . $filePath;

                        header('Content-Type: application/json');
                        echo json_encode([
                            'status' => 1,
                            'fileData' => [
                                'file_name' => $fileName,
                                'upload_date' => $uploadDate,
                                'upload_time' => $uploadTime,
                                'view_link' => $viewLink,
                                'download_link' => $downloadLink
                            ]
                        ]);
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 0]);
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 9]); // Formato no permitido
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 0]); // Archivo no seleccionado
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 0]); // Validación fallida
        }
    }
}
