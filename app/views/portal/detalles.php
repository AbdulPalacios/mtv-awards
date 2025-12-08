<?php
session_start();
// Activamos reporte de errores por si acaso, para no ver pantalla blanca
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$canciones_album = []; // Array vacío por defecto
$albumes_artista = []; // NUEVO: Array para álbumes del artista

try {
    if ($tipo == 'artista') {
        // Consulta para Artista
        $sql = "SELECT a.*, g.nombre_genero 
                FROM artistas a 
                LEFT JOIN generos g ON a.id_genero = g.id_genero 
                WHERE id_artista = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($datos) {
            $titulo = $datos['pseudonimo_artista'];
            $desc = $datos['biografia_artista'];
            $img = $datos['imagen_artista'];
            $extra = "Nacionalidad: " . $datos['nacionalidad_artista'];
            $subtitulo = "Artista • " . ($datos['nombre_genero'] ?? 'Sin género');

            // AGREGADO: Consultar álbumes del artista (DISCOGRAFÍA)
            $stmt_albums = $conexion->prepare("SELECT * FROM albumes WHERE id_artista = :id AND estatus_album = 1");
            $stmt_albums->execute([':id' => $id]);
            $albumes_artista = $stmt_albums->fetchAll(PDO::FETCH_ASSOC);
        }

    } elseif ($tipo == 'album') {
        // Consulta para Álbum
        $sql = "SELECT al.*, ar.pseudonimo_artista 
                FROM albumes al 
                INNER JOIN artistas ar ON al.id_artista = ar.id_artista 
                WHERE id_album = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if($datos) {
            $titulo = $datos['titulo_album'];
            $desc = $datos['descripcion_album'];
            $img = $datos['imagen_album'];
            $extra = "Fecha Lanzamiento: " . $datos['fecha_lanzamiento_album'];
            $subtitulo = "Álbum de " . $datos['pseudonimo_artista'];

            // Lógica para obtener canciones
            $stmt_songs = $conexion->prepare("SELECT * FROM canciones WHERE id_album = :id AND estatus_cancion = 1");
            $stmt_songs->execute([':id' => $id]);
            $canciones_album = $stmt_songs->fetchAll(PDO::FETCH_ASSOC);
        }
    }
} catch (PDOException $e) { 
    die("Error en base de datos: " . $e->getMessage()); 
}

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
    <title><?php echo htmlspecialchars($titulo); ?> | Detalles</title>
    
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/detalles.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
    <div class="header-container">
        <?php include '../../../recursos/recursos_portal/header.php'; ?>
    </div>
    
    <main>
        <div class="detalle-container">
            <div class="img-col">
                <?php 
                    $ruta_img = !empty($img) ? HOST . ltrim($img, '/') : "https://via.placeholder.com/400x400?text=No+Image"; 
                ?>
                <img src="<?php echo $ruta_img; ?>" alt="Imagen">
            </div>
            
            <div class="info-col">
                <h1><?php echo htmlspecialchars($titulo); ?></h1>
                <div class="subtitle"><?php echo htmlspecialchars($subtitulo); ?></div>
                
                <div class="desc-box">
                    <p><?php echo !empty($desc) ? nl2br(htmlspecialchars($desc)) : "Sin descripción disponible."; ?></p>
                </div>
                
                <div class="extra-data">
                    <i class="fa-solid fa-circle-info"></i> <?php echo htmlspecialchars($extra); ?>
                </div>

                <?php if($tipo == 'album' && !empty($canciones_album)): ?>
                    <div class="track-list-container" style="margin-top: 20px;">
                        <h3 style="color: var(--neon-pink); border-bottom: 1px solid #333; padding-bottom: 5px; margin-bottom: 15px;">Lista de Canciones</h3>
                        
                        <div class="track-list">
                            <?php foreach($canciones_album as $cancion): ?>
                                <div class="track-item" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background: rgba(255,255,255,0.05); margin-bottom: 8px; border-radius: 5px;">
                                    
                                    <div class="track-info" style="display: flex; align-items: center; gap: 10px;">
                                        <i class="fa-solid fa-music" style="color: var(--neon-cyan);"></i>
                                        <span><?php echo htmlspecialchars($cancion['nombre_cancion']); ?></span>
                                    </div>
                                    
                                    <?php if(!empty($cancion['mp3_cancion'])): ?>
                                        <audio controls style="height: 30px; max-width: 200px;">
                                            <source src="<?php echo HOST . ltrim($cancion['mp3_cancion'], '/'); ?>" type="audio/mpeg">
                                        </audio>
                                    <?php else: ?>
                                        <span style="font-size: 0.8rem; color: #666; font-style: italic;">Sin audio</span>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br>
                <?php endif; ?>

                <?php 
                // --- NUEVO: MOSTRAR DISCOGRAFÍA (ÁLBUMES) ---
                if($tipo == 'artista' && !empty($albumes_artista)): ?>
                    <div class="track-list-container" style="margin-top: 20px;">
                        <h3 style="color: var(--neon-pink); border-bottom: 1px solid #333; padding-bottom: 5px; margin-bottom: 15px;">Discografía</h3>
                        <div style="display:flex; gap:15px; flex-wrap:wrap;">
                            <?php foreach($albumes_artista as $alb): ?>
                                <a href="detalles.php?tipo=album&id=<?php echo $alb['id_album']; ?>" style="width:120px; text-align:center; text-decoration:none;">
                                    <img src="<?php echo HOST . ltrim($alb['imagen_album'], '/'); ?>" style="width:100%; border-radius:8px; border:1px solid #444; margin-bottom:5px;">
                                    <span style="color:white; font-size:0.8rem; display:block;"><?php echo htmlspecialchars($alb['titulo_album']); ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <br>
                <?php endif; ?>

                <a href="javascript:history.back()" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Regresar
                </a>
            </div>
        </div>
    </main>

    <footer><?php include '../../../recursos/recursos_portal/footer.php'; ?></footer>
    <script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
</body>
</html>