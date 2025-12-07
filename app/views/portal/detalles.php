<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// Validar parámetros
if (!isset($_GET['id']) || !isset($_GET['tipo'])) {
    header("Location: " . HOST . "index.php");
    exit();
}

$id = $_GET['id'];
$tipo = $_GET['tipo'];
$datos = null;

try {
    if ($tipo == 'artista') {
        $stmt = $conexion->prepare("SELECT a.*, g.nombre_genero FROM artistas a LEFT JOIN generos g ON a.id_genero = g.id_genero WHERE id_artista = :id");
        $stmt->execute([':id' => $id]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        if($datos) {
            $titulo = $datos['pseudonimo_artista'];
            $desc = $datos['biografia_artista'];
            $img = $datos['imagen_artista'];
            $extra = "Nacionalidad: " . $datos['nacionalidad_artista'];
            $subtitulo = "Artista • " . $datos['nombre_genero'];
        }
    } elseif ($tipo == 'album') {
        $stmt = $conexion->prepare("SELECT al.*, ar.pseudonimo_artista FROM albumes al INNER JOIN artistas ar ON al.id_artista = ar.id_artista WHERE id_album = :id");
        $stmt->execute([':id' => $id]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        if($datos) {
            $titulo = $datos['titulo_album'];
            $desc = $datos['descripcion_album'];
            $img = $datos['imagen_album'];
            $extra = "Fecha Lanzamiento: " . $datos['fecha_lanzamiento_album'];
            $subtitulo = "Álbum de " . $datos['pseudonimo_artista'];
        }
    }
} catch (Exception $e) { die("Error de conexión"); }

if (!$datos) {
    echo "<h2 style='color:white; text-align:center; margin-top:50px;'>Información no encontrada.</h2>";
    echo "<center><a href='".HOST."index.php' style='color:cyan;'>Volver</a></center>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?> | Detalles</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/detalles.css">
</head>
<body>
    
    <div class="header-container">
        <?php include '../../../recursos/recursos_portal/header.php'; ?>
    </div>
    
    <main>
        <div class="detalle-container">
            <div class="img-col">
                <?php $ruta_img = !empty($img) ? HOST . ltrim($img, '/') : "https://via.placeholder.com/400x400?text=No+Image"; ?>
                <img src="<?php echo $ruta_img; ?>" alt="Imagen">
            </div>
            
            <div class="info-col">
                <h1><?php echo $titulo; ?></h1>
                <div class="subtitle"><?php echo $subtitulo; ?></div>
                <div class="desc-box">
                    <p><?php echo !empty($desc) ? $desc : "Sin biografía disponible."; ?></p>
                </div>
                <div class="extra-data">
                    <i class="fa-solid fa-circle-info"></i> <?php echo $extra; ?>
                </div>
                <a href="javascript:history.back()" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Regresar</a>
            </div>
        </div>
    </main>

    <footer><?php include '../../../recursos/recursos_portal/footer.php'; ?></footer>
    <script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
</body>
</html>