<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// Validar Admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

// 1. CREAR ÁLBUM
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $id_artista = $_POST['id_artista'];
    $id_genero = $_POST['id_genero']; // Opcional, pero tu BD lo tiene
    $estatus = 1;

    // --- PROCESAR IMAGEN ---
    $ruta_imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_archivo = time() . "_" . $_FILES['imagen']['name']; // Evitar nombres duplicados
        $ruta_destino = "../../../recursos/assets/uploads/album/" . $nombre_archivo;

        // Ruta para guardar en BD (sin barra inicial para que HOST funcione bien)
        $ruta_bd = "recursos/assets/uploads/album/" . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
            $ruta_imagen = $ruta_bd;
        }
    }

    try {
        $sql = "INSERT INTO albumes (estatus_album, fecha_lanzamiento_album, titulo_album, descripcion_album, imagen_album, id_artista, id_genero) 
                VALUES (:estatus, :fecha, :titulo, :desc, :img, :art, :gen)";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':desc', $descripcion);
        $stmt->bindParam(':img', $ruta_imagen);
        $stmt->bindParam(':art', $id_artista);
        $stmt->bindParam(':gen', $id_genero);
        $stmt->execute();
        
        // Redirigir a la vista del panel usando HOST
        header("Location: " . HOST . "app/views/panel/albumes.php?msj=creado");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// 2. BORRAR ÁLBUM
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar') {
    $id = $_GET['id'];
    try {
        $sql = "UPDATE albumes SET estatus_album = 0 WHERE id_album = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: " . HOST . "app/views/panel/albumes.php?msj=borrado");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>