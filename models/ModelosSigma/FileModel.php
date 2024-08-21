<?php

class FileModel
{
    private $conn;

    public function __construct()
    {
        // Usamos la conexión establecida por el archivo Connection.php
        $this->conn = Connection::connect();
    }

    public function saveFile($fileName, $uploadDate, $uploadTime)
    {
        $query = "INSERT INTO archivos_subidos (file_name, upload_date, upload_time) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fileName, $uploadDate, $uploadTime]);
        return $stmt;
    }

    public function getAllFiles()
    {
        $query = "SELECT * FROM archivos_subidos ORDER BY id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
