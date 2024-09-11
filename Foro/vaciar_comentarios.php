<?php
require_once __DIR__ . '/../config/Connection.php';
session_start();

try {
    $db = Connection::connect();
    $stmt = $db->prepare("DELETE FROM comentarios");
    $stmt->execute();

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
