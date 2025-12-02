<?php
// app/backend/portal/get_votar.php
require_once __DIR__ . '/../../../config/conexion-bd.php';

// Obtener todas las categorías activas
$query = $conexion->query("SELECT * FROM categorias_nominaciones WHERE estatus_categoria_nominacion = 1 ORDER BY id_categoria_nominacion DESC");
$categorias = $query->fetchAll(PDO::FETCH_ASSOC);

// Revisar votos previos
$mis_votos_categorias = [];
if (isset($_SESSION['id_usuario'])) {
    $uid = $_SESSION['id_usuario'];
    $sql_votos = "SELECT n.id_categoria_nominacion 
                  FROM votaciones v 
                  INNER JOIN nominaciones n ON v.id_nominacion = n.id_nominacion 
                  WHERE v.id_usuario = :uid"; // Usamos parámetros por seguridad
    
    $stmt = $conexion->prepare($sql_votos);
    $stmt->execute([':uid' => $uid]);
    $mis_votos_categorias = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>