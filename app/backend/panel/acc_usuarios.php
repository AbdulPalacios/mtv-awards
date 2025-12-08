<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: " . HOST . "index.php");
    exit();
}

// 1. CREAR USUARIO
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $nombre = $_POST['nombre'];
    $ap = $_POST['ap_paterno'];
    $am = $_POST['ap_materno'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['id_rol'];
    $estatus = 1;
    $sexo = 1; // Default

    // Imagen
    $ruta_img = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_archivo = time() . "_" . $_FILES['imagen']['name'];
        $destino = "../../../recursos/assets/uploads/usuarios/" . $nombre_archivo;
        
        // Crear carpeta si no existe
        if (!file_exists("../../../recursos/assets/uploads/usuarios/")) {
            mkdir("../../../recursos/assets/uploads/usuarios/", 0777, true);
        }

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
            $ruta_img = "recursos/assets/uploads/usuarios/" . $nombre_archivo;
        }
    }

    try {
        $sql = "INSERT INTO usuarios (estatus_usuario, nombre_usuario, ap_usuario, am_usuario, sexo_usuario, correo_usuario, password_usuario, imagen_usuario, id_rol) 
                VALUES (:st, :nom, :ap, :am, :sex, :mail, :pass, :img, :rol)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':st' => $estatus, ':nom' => $nombre, ':ap' => $ap, ':am' => $am, 
            ':sex' => $sexo, ':mail' => $email, ':pass' => $pass, ':img' => $ruta_img, ':rol' => $rol
        ]);
        header("Location: " . HOST . "app/views/panel/usuarios.php?msj=creado");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// 2. BORRAR USUARIO
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar') {
    $id = $_GET['id'];
    $conexion->query("DELETE FROM usuarios WHERE id_usuario = $id");
    header("Location: " . HOST . "app/views/panel/usuarios.php?msj=borrado");
}
?>