<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// Validar Roles
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], [1, 2, 3])) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

$es_admin = ($_SESSION['rol'] == 1);

// 1. CREAR ÁLBUM
if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $id_genero = $_POST['id_genero'];
    $estatus = 1;

    // DETERMINAR ID_ARTISTA
    if ($es_admin) {
        $id_artista = $_POST['id_artista']; // Admin elige
    } else {
        // Manager/Artista: Buscar su ID en BD por seguridad
        $stmt_art = $conexion->prepare("SELECT id_artista FROM artistas WHERE id_usuario = :uid");
        $stmt_art->execute([':uid' => $_SESSION['id_usuario']]);
        $res = $stmt_art->fetch(PDO::FETCH_ASSOC);
        
        if ($res) {
            $id_artista = $res['id_artista'];
        } else {
            die("Error: No tienes un perfil de artista creado.");
        }
    }

    // --- PROCESAR IMAGEN ---
    $ruta_imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_archivo = time() . "_" . $_FILES['imagen']['name']; 
        $ruta_destino = "../../../recursos/assets/uploads/album/" . $nombre_archivo;
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

// 3. EDITAR ÁLBUM (NUEVO)
if (isset($_POST['accion']) && $_POST['accion'] == 'editar') {
    $id_album = $_POST['id_album'];
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $id_genero = $_POST['id_genero'];
    
    // Procesar imagen solo si se sube una nueva
    $sql_img = "";
    $ruta_imagen = null;
    
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_archivo = time() . "_" . $_FILES['imagen']['name'];
        $ruta_destino = "../../../recursos/assets/uploads/album/" . $nombre_archivo;
        $ruta_bd = "recursos/assets/uploads/album/" . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
            $sql_img = ", imagen_album = :img";
            $ruta_imagen = $ruta_bd;
        }
    }

    try {
        $sql = "UPDATE albumes SET 
                titulo_album = :titulo, 
                fecha_lanzamiento_album = :fecha, 
                descripcion_album = :desc, 
                id_genero = :gen" . $sql_img . " 
                WHERE id_album = :id";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':desc', $descripcion);
        $stmt->bindParam(':gen', $id_genero);
        $stmt->bindParam(':id', $id_album);
        
        if($ruta_imagen){
            $stmt->bindParam(':img', $ruta_imagen);
        }
        
        $stmt->execute();
        
        header("Location: " . HOST . "app/views/panel/albumes.php?msj=editado");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>