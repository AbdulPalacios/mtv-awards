<?php
// app/backend/portal/get_votar.php

// 1. Iniciar sesión si no está iniciada (para poder leer $_SESSION)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Incluir la conexión de forma segura
require_once __DIR__ . '/../../../config/conexion-bd.php';

// 3. Obtener todas las categorías activas
// Usamos try-catch por si falla la consulta (buena práctica)
try {
    $sql_cat = "SELECT * FROM categorias_nominaciones WHERE estatus_categoria_nominacion = 1 ORDER BY id_categoria_nominacion DESC";
    $query = $conexion->query($sql_cat);
    
    // Si la consulta falla, $query será false
    if ($query) {
        $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $categorias = []; // Array vacío para evitar errores en el foreach
    }

} catch (Exception $e) {
    $categorias = [];
}

// 4. Revisar votos previos
$mis_votos_categorias = [];

if (isset($_SESSION['id_usuario'])) {
    $uid = $_SESSION['id_usuario'];
    
    $sql_votos = "SELECT n.id_categoria_nominacion 
                  FROM votaciones v 
                  INNER JOIN nominaciones n ON v.id_nominacion = n.id_nominacion 
                  WHERE v.id_usuario = :uid";
    
    try {
        $stmt = $conexion->prepare($sql_votos);
        $stmt->execute([':uid' => $uid]);
        // FETCH_COLUMN devuelve un array simple [1, 3, 5...] ideal para usar con in_array()
        $mis_votos_categorias = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (Exception $e) {
        // Si falla, asumimos que no ha votado nada
        $mis_votos_categorias = [];
    }
}
?>






<?php /*
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
}*/
?>