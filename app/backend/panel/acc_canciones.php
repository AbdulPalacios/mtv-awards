<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// Validar Admin con HOST
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], [1, 2, 3])) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

$es_admin = ($_SESSION['rol'] == 1);

// 1. CREAR CANCIÓN
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $duracion = $_POST['duracion'];
    $video_url = $_POST['video_url'];
    $id_genero = $_POST['id_genero'];
    $estatus = 1;

    // DETERMINAR ARTISTA
    if ($es_admin) {
        $id_artista = $_POST['id_artista'];
    } else {
        $stmt_art = $conexion->prepare("SELECT id_artista FROM artistas WHERE id_usuario = :uid");
        $stmt_art->execute([':uid' => $_SESSION['id_usuario']]);
        $res = $stmt_art->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            $id_artista = $res['id_artista'];
        } else {
            die("Error: No tienes perfil de artista.");
        }
    }

    // --- PROCESAR IMAGEN ---
    $ruta_imagen = null; 
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_img = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['imagen']['name']);
        $ruta_fisica_img = "../../../recursos/assets/uploads/canciones/" . $nombre_img;
        $ruta_bd_img = "recursos/assets/uploads/canciones/" . $nombre_img;
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica_img)) {
            $ruta_imagen = $ruta_bd_img;
        }
    }

    // --- PROCESAR AUDIO ---
    $ruta_audio = null;
    if (isset($_FILES['audio']) && $_FILES['audio']['error'] == 0) {
        $nombre_audio = time() . "_audio_" . preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['audio']['name']);
        $ruta_fisica_audio = "../../../recursos/assets/uploads/canciones/" . $nombre_audio;
        $ruta_bd_audio = "recursos/assets/uploads/canciones/" . $nombre_audio;
        
        if (move_uploaded_file($_FILES['audio']['tmp_name'], $ruta_fisica_audio)) {
            $ruta_audio = $ruta_bd_audio;
        }
    }

    try {
        $sql = "INSERT INTO canciones (estatus_cancion, nombre_cancion, fecha_lanzamiento_cancion, duracion_cancion, url_video_cancion, imagen_cancion, mp3_cancion, id_artista, id_genero) 
                VALUES (:estatus, :nom, :fecha, :dur, :vid, :img, :aud, :art, :gen)";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':nom', $nombre);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':dur', $duracion);
        $stmt->bindParam(':vid', $video_url);
        $stmt->bindParam(':img', $ruta_imagen);
        $stmt->bindParam(':aud', $ruta_audio);
        $stmt->bindParam(':art', $id_artista);
        $stmt->bindParam(':gen', $id_genero);
        $stmt->execute();
        
        header("Location: " . HOST . "app/views/panel/canciones.php?msj=creado");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// 2. BORRAR CANCIÓN
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar') {
    $id = $_GET['id'];
    try {
        $sql = "UPDATE canciones SET estatus_cancion = 0 WHERE id_cancion = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: " . HOST . "app/views/panel/canciones.php?msj=borrado");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>