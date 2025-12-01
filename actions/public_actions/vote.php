<?php
session_start();
require_once '../../config/conexion-bd.php';

// 1. Validar que esté logueado
if (!isset($_SESSION['id_usuario'])) {
    // Si no está logueado, lo mandamos al login con un mensaje
    header("Location: ../../login.php?error=necesitas_login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_SESSION['id_usuario'];
    $id_nominacion = $_POST['id_nominacion'];
    $id_categoria = $_POST['id_categoria']; // Necesario para verificar duplicados en la categoría

    try {
        // 2. VERIFICAR: ¿El usuario ya votó en ESTA categoría?
        // Buscamos si existe un voto de este usuario en alguna nominación que pertenezca a esta categoría
        $sql_check = "SELECT v.id_votacion 
                      FROM votaciones v 
                      INNER JOIN nominaciones n ON v.id_nominacion = n.id_nominacion 
                      WHERE v.id_usuario = :uid AND n.id_categoria_nominacion = :cat_id";
        
        $stmt_check = $conexion->prepare($sql_check);
        $stmt_check->bindParam(':uid', $id_usuario);
        $stmt_check->bindParam(':cat_id', $id_categoria);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            // YA VOTÓ: Lo regresamos con error
            header("Location: ../../index.php?error=ya_votaste");
            exit();
        }

        // 3. REGISTRAR EL VOTO
        $conexion->beginTransaction(); // Usamos transacción para seguridad

        // A) Insertar en tabla votaciones
        $sql_insert = "INSERT INTO votaciones (id_nominacion, id_usuario) VALUES (:nom, :uid)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bindParam(':nom', $id_nominacion);
        $stmt_insert->bindParam(':uid', $id_usuario);
        $stmt_insert->execute();

        // B) Aumentar el contador en la tabla nominaciones (para ver resultados rápido)
        $sql_update = "UPDATE nominaciones SET contador_nominacion = contador_nominacion + 1 WHERE id_nominacion = :nom";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bindParam(':nom', $id_nominacion);
        $stmt_update->execute();

        $conexion->commit();
        
        header("Location: ../../index.php?msj=voto_exitoso");

    } catch (PDOException $e) {
        $conexion->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>