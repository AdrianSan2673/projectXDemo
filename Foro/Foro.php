<?php
require_once __DIR__ . '/../config/Connection.php';
session_start(); // Asegurarse de que la sesión está iniciada

try {
    $db = Connection::connect(); // Establecer conexión a la base de datos

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['comentario'])) {
            $usuario = $_SESSION['identity']->Nombres . ' ' . $_SESSION['identity']->Apellidos; // Obtener el usuario de la sesión
            $comentario = htmlspecialchars($_POST['comentario']);

            $stmt = $db->prepare("INSERT INTO comentarios (usuario, comentario) VALUES (:usuario, :comentario)");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':comentario', $comentario);
            $stmt->execute();
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $stmt = $db->query("SELECT usuario, comentario, fecha FROM comentarios ORDER BY fecha DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<div class="d-flex align-items-center mb-2">';
            // Agregar ícono de usuario junto al nombre
            echo '<i class="fas fa-user comment-icon me-2"></i>'; // me-2 para margen derecho del ícono
            echo '<h5 class="card-title mb-0">' . htmlspecialchars($row['usuario']) . '</h5>';
            echo '</div>'; // Cierre del contenedor de ícono y nombre
            echo '<h6 class="card-subtitle mb-2 text-muted">' . $row['fecha'] . '</h6>';
            echo '<p class="card-text">' . htmlspecialchars($row['comentario']) . '</p>';
            echo '</div>';
            echo '</div>';
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
