<?php
session_start();
require_once '../../config/conexion-bd.php';

// Validar que sea admin (seguridad extra)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../login.php");
    exit();
}

// 1. CREAR GÉNERO
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $nombre = trim($_POST['nombre']);
    $estatus = 1; // 1 = Activo

    if (!empty($nombre)) {
        try {
            $sql = "INSERT INTO generos (estatus_genero, nombre_genero) VALUES (:estatus, :nombre)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':estatus', $estatus);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            
            header("Location: ../../admin/generos.php?msj=creado");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        header("Location: ../../admin/generos.php?error=vacio");
    }
}

// 2. EDITAR GÉNERO
if (isset($_POST['accion']) && $_POST['accion'] == 'editar') {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre) && !empty($id)) {
        try {
            $sql = "UPDATE generos SET nombre_genero = :nombre WHERE id_genero = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            header("Location: ../../admin/generos.php?msj=editado");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// 3. ELIMINAR GÉNERO (Borrado Lógico - Cambiar estatus a 0)
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // No borramos el registro (DELETE), solo lo desactivamos (UPDATE) para no romper historiales
        $sql = "UPDATE generos SET estatus_genero = 0 WHERE id_genero = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ../../admin/generos.php?msj=borrado");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>