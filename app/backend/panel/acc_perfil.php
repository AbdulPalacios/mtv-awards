<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: " . HOST . "index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['accion'] == 'actualizar') {
    $id = $_SESSION['id_usuario'];
    $pass = $_POST['password'];
    
    // Actualizar imagen si se subió
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre = time() . "_" . $_FILES['imagen']['name'];
        $ruta = "../../../recursos/assets/uploads/usuarios/" . $nombre;
        
        // Crear carpeta si no existe
        if (!file_exists("../../../recursos/assets/uploads/usuarios/")) {
            mkdir("../../../recursos/assets/uploads/usuarios/", 0777, true);
        }

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
            $ruta_bd = "recursos/assets/uploads/usuarios/" . $nombre;
            $conexion->query("UPDATE usuarios SET imagen_usuario = '$ruta_bd' WHERE id_usuario = $id");
            $_SESSION['imagen'] = $ruta_bd; // Actualizar sesión al instante
        }
    }

    // Actualizar contraseña si escribió algo
    if (!empty($pass)) {
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("UPDATE usuarios SET password_usuario = :p WHERE id_usuario = :id");
        $stmt->execute([':p' => $pass_hash, ':id' => $id]);
    }

    header("Location: " . HOST . "app/views/portal/perfil.php?msj=actualizado");
}
?>