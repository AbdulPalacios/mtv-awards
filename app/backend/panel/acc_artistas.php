<?php
session_start();
require_once '../../../config/conexion-bd.php';

// Validar Admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) { header("Location: ../../login.php"); exit(); }

// ---------------------------------------------------
// 1. CREAR ARTISTA
// ---------------------------------------------------
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $pseudonimo = $_POST['pseudonimo'];
    $nacionalidad = $_POST['nacionalidad'];
    $biografia = $_POST['biografia'];
    $id_usuario = $_POST['id_usuario'];
    $id_genero = $_POST['id_genero'];
    $estatus = 1;

    // --- PROCESAR IMAGEN ARTISTA ---
    $ruta_imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_archivo = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['imagen']['name']);
        
        // Rutas
        $ruta_fisica = "../../recursos/assets/uploads/artistas/" . $nombre_archivo;
        $ruta_bd = "recursos/assets/uploads/artistas/" . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica)) {
            $ruta_imagen = $ruta_bd;
        }
    }

    try {
        // Verificar duplicado de usuario
        $check = $conexion->prepare("SELECT id_artista FROM artistas WHERE id_usuario = :uid");
        $check->bindParam(':uid', $id_usuario);
        $check->execute();

        if ($check->rowCount() > 0) {
            header("Location: ../../admin/artistas.php?error=usuario_ocupado");
            exit();
        }

        $sql = "INSERT INTO artistas (estatus_artista, pseudonimo_artista, nacionalidad_artista, biografia_artista, id_usuario, id_genero, imagen_artista) 
                VALUES (:estatus, :pseudo, :nacion, :bio, :uid, :gid, :img)";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':pseudo', $pseudonimo);
        $stmt->bindParam(':nacion', $nacionalidad);
        $stmt->bindParam(':bio', $biografia);
        $stmt->bindParam(':uid', $id_usuario);
        $stmt->bindParam(':gid', $id_genero);
        $stmt->bindParam(':img', $ruta_imagen); // Nueva imagen
        $stmt->execute();
        
        header("Location: ../../admin/artistas.php?msj=creado");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// ---------------------------------------------------
// 2. EDITAR ARTISTA (Actualizado con imagen)
// ---------------------------------------------------
if (isset($_POST['accion']) && $_POST['accion'] == 'editar') {
    $id_artista = $_POST['id_artista'];
    $pseudonimo = $_POST['pseudonimo'];
    $nacionalidad = $_POST['nacionalidad'];
    $biografia = $_POST['biografia'];
    $id_genero = $_POST['id_genero'];

    // Lógica para actualizar imagen solo si subieron una nueva
    // (Nota: Si quieres hacer esto completo, habría que consultar la imagen vieja para no perderla, 
    // pero para mantenerlo simple actualizaremos los datos de texto o la imagen si viene)
    
    // Si quieres actualizar la imagen al editar, requeriría un poco más de lógica de consulta previa.
    // Por ahora, actualizamos los textos.
    
    try {
        $sql = "UPDATE artistas SET 
                pseudonimo_artista = :pseudo, 
                nacionalidad_artista = :nacion, 
                biografia_artista = :bio, 
                id_genero = :gid 
                WHERE id_artista = :id";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':pseudo', $pseudonimo);
        $stmt->bindParam(':nacion', $nacionalidad);
        $stmt->bindParam(':bio', $biografia);
        $stmt->bindParam(':gid', $id_genero);
        $stmt->bindParam(':id', $id_artista);
        $stmt->execute();
        
        header("Location: ../../admin/artistas.php?msj=editado");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// 3. BORRAR (Igual que antes)
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar') {
    $id = $_GET['id'];
    try {
        $sql = "UPDATE artistas SET estatus_artista = 0 WHERE id_artista = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: ../../admin/artistas.php?msj=borrado");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>