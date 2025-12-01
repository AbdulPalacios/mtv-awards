<?php
session_start();
require_once '../../config/conexion-bd.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../login.php");
    exit();
}

// ---------------------------------------------------
// 1. CREAR CANCIÓN (Ahora con Imagen)
// ---------------------------------------------------
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $duracion = $_POST['duracion'];
    $video_url = $_POST['video_url'];
    $id_artista = $_POST['id_artista'];
    $id_genero = $_POST['id_genero'];
    $estatus = 1;

    // --- PROCESAR IMAGEN DE LA CANCIÓN ---
    $ruta_imagen = null; // Por defecto null
    
    // Verificamos si subieron un archivo en el campo 'imagen'
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        
        $nombre_archivo = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['imagen']['name']);
        
        // Rutas definidas
        // 1. Ruta física donde PHP guardará el archivo (subiendo 2 niveles desde actions/admin_actions)
        $ruta_fisica = "../../recursos/assets/uploads/canciones/" . $nombre_archivo;
        
        // 2. Ruta relativa para guardar en la BD (para usar en HTML)
        $ruta_bd = "recursos/assets/uploads/canciones/" . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica)) {
            $ruta_imagen = $ruta_bd;
        }
    }

    try {
        // Insertamos en 'imagen_cancion' y ya NO en 'mp3_cancion'
        $sql = "INSERT INTO canciones (estatus_cancion, nombre_cancion, fecha_lanzamiento_cancion, duracion_cancion, url_video_cancion, imagen_cancion, id_artista, id_genero) 
                VALUES (:estatus, :nom, :fecha, :dur, :vid, :img, :art, :gen)";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':nom', $nombre);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':dur', $duracion);
        $stmt->bindParam(':vid', $video_url);
        $stmt->bindParam(':img', $ruta_imagen); // Guardamos la ruta de la imagen
        $stmt->bindParam(':art', $id_artista);
        $stmt->bindParam(':gen', $id_genero);
        $stmt->execute();
        
        header("Location: ../../admin/canciones.php?msj=creado");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// ---------------------------------------------------
// 2. BORRAR CANCIÓN
// ---------------------------------------------------
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar') {
    $id = $_GET['id'];
    try {
        $sql = "UPDATE canciones SET estatus_cancion = 0 WHERE id_cancion = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: ../../admin/canciones.php?msj=borrado");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>