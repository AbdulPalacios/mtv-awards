<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// Validar Admin con HOST
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

// ---------------------------------------------------
// 1. CREAR CATEGORÍA
// ---------------------------------------------------
if (isset($_POST['accion']) && $_POST['accion'] == 'crear_categoria') {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo']; // 1=Artista, 2=Álbum, 3=Canción
    $fecha_limite = $_POST['fecha_limite'];
    $estatus = 1;

    try {
        $sql = "INSERT INTO categorias_nominaciones (estatus_categoria_nominacion, tipo_categoria_nominacion, nombre_categoria_nominacion, fecha_categoria_nominacion) 
                VALUES (:estatus, :tipo, :nombre, :fecha)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha', $fecha_limite);
        $stmt->execute();

        header("Location: " . HOST . "app/views/panel/nominaciones.php?msj=cat_creada");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// ---------------------------------------------------
// 2. AGREGAR NOMINADO A UNA CATEGORÍA
// ---------------------------------------------------
if (isset($_POST['accion']) && $_POST['accion'] == 'agregar_nominado') {
    $id_categoria = $_POST['id_categoria'];
    $tipo = $_POST['tipo_categoria']; // Para saber qué ID buscar
    $id_item = $_POST['id_item']; // Puede ser ID de artista, album o canción

    // Variables para insertar
    $id_artista = null;
    $id_album = null;
    $id_cancion = null;

    // Asignar el ID correcto según el tipo de categoría
    if ($tipo == 1) $id_artista = $id_item;
    if ($tipo == 2) $id_album = $id_item;
    if ($tipo == 3) $id_cancion = $id_item;

    try {
        // Verificar duplicados (que no lo nominen 2 veces a lo mismo)
        // Construimos la query dinámica
        $check_sql = "SELECT id_nominacion FROM nominaciones WHERE id_categoria_nominacion = :cat AND ";
        if ($tipo == 1) $check_sql .= "id_artista = :item";
        if ($tipo == 2) $check_sql .= "id_album = :item";
        if ($tipo == 3) $check_sql .= "id_cancion = :item";

        $stmt_check = $conexion->prepare($check_sql);
        $stmt_check->bindParam(':cat', $id_categoria);
        $stmt_check->bindParam(':item', $id_item);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            header("Location: " . HOST . "app/views/panel/nominaciones.php?error=ya_nominado");
            exit();
        }

        // Insertar nominación
        $sql = "INSERT INTO nominaciones (id_categoria_nominacion, id_artista, id_album, id_cancion, contador_nominacion) 
                VALUES (:cat, :art, :alb, :can, 0)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':cat', $id_categoria);
        $stmt->bindParam(':art', $id_artista);
        $stmt->bindParam(':alb', $id_album);
        $stmt->bindParam(':can', $id_cancion);
        $stmt->execute();

        header("Location: " . HOST . "app/views/panel/nominaciones.php?msj=nominado_ok");

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// ---------------------------------------------------
// 3. BORRAR CATEGORÍA (y sus nominaciones en cascada lógica)
// ---------------------------------------------------
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar_cat') {
    $id = $_GET['id'];
    // Aquí solo desactivamos la categoría
    $conexion->query("UPDATE categorias_nominaciones SET estatus_categoria_nominacion = 0 WHERE id_categoria_nominacion = $id");
    header("Location: " . HOST . "app/views/panel/nominaciones.php?msj=cat_borrada");
}

// ---------------------------------------------------
// 4. BORRAR NOMINADO
// ---------------------------------------------------
if (isset($_GET['accion']) && $_GET['accion'] == 'borrar_nom') {
    $id = $_GET['id'];
    // Borrado físico porque es una tabla de relación
    $conexion->query("DELETE FROM nominaciones WHERE id_nominacion = $id");
    header("Location: " . HOST . "app/views/panel/nominaciones.php?msj=nom_borrado");
}
?>