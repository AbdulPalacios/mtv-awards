<?php
session_start();
require_once '../../../config/constantes.php';

// Verificamos si existe el archivo de lógica backend, si no, continuamos aquí mismo
if (file_exists('../../backend/portal/get_votar.php')) {
    require_once '../../backend/portal/get_votar.php';
} else {
    // Si no tienes ese archivo, asegúrate de tener la conexión aquí:
    require_once '../../../config/conexion-bd.php'; 
}

// 1. Obtener todas las categorías activas
// Usamos !empty para asegurar que la conexión existe
if (isset($conexion)) {
    $categorias = $conexion->query("SELECT * FROM categorias_nominaciones WHERE estatus_categoria_nominacion = 1 ORDER BY id_categoria_nominacion DESC")->fetchAll(PDO::FETCH_ASSOC);
} else {
    $categorias = [];
}

// 2. Si el usuario está logueado, averiguar en qué categorías ya votó
$mis_votos_categorias = []; 
if (isset($_SESSION['id_usuario']) && isset($conexion)) {
    $uid = $_SESSION['id_usuario'];
    
    // Consulta optimizada para traer solo los IDs
    $sql_votos = "SELECT n.id_categoria_nominacion 
                  FROM votaciones v 
                  INNER JOIN nominaciones n ON v.id_nominacion = n.id_nominacion 
                  WHERE v.id_usuario = :uid";
                  
    $stmt = $conexion->prepare($sql_votos);
    $stmt->bindParam(':uid', $uid);
    $stmt->execute();
    
    $mis_votos_categorias = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTV Awards - Vota Ahora</title>
    
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/votar.css"> 
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/footer.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <header class="header">
        <?php include('../../../recursos/recursos_portal/header.php'); ?>
    </header>

    <div class="hero" style="background: url('<?php echo HOST; ?>recursos/assets/img/hero__mtv-awards.png') no-repeat center center/cover;">
        <div class="hero-content">
            <h1>Vota AHORA</h1>
            <p>Tu voz define a los ganadores.</p>
            
            <?php if (!isset($_SESSION['id_usuario'])): ?>
                <a href="registrarse.php">Regístrate para votar</a>
            <?php else: ?>
                <p class="hero-welcome">Hola, <strong><?php echo htmlspecialchars($_SESSION['nombre']); ?></strong></p>
                
                <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                    <a href="<?php echo HOST; ?>app/views/panel/dashboard.php" style="border-color: var(--neon-pink); color: var(--neon-pink);">
                        <i class="fa-solid fa-gear"></i> Ir al Panel Admin
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <main class="container">

        <?php foreach ($categorias as $cat): ?>
            
            <?php 
                // Verificar si el usuario ya votó en ESTA categoría
                $ya_vote_aqui = in_array($cat['id_categoria_nominacion'], $mis_votos_categorias);
            ?>

            <section class="categoria-section">
                <h2 class="cat-title"><?php echo htmlspecialchars($cat['nombre_categoria_nominacion']); ?></h2>
                
                <?php if($ya_vote_aqui): ?>
                    <p style="color: var(--neon-lime); text-align:center;">
                        <i class="fa-solid fa-circle-check"></i> Ya has registrado tu voto en esta categoría.
                    </p>
                <?php endif; ?>

                <div class="grid-nominados">
                    <?php 
                        $cat_id = $cat['id_categoria_nominacion'];
                        // Preparamos la consulta para evitar inyecciones SQL aunque venga de la BD
                        $sql_nom = "SELECT n.id_nominacion, 
                                           ar.pseudonimo_artista, ar.imagen_artista,
                                           al.titulo_album, al.imagen_album,
                                           cn.nombre_cancion, cn.imagen_cancion, 
                                           n.contador_nominacion
                                    FROM nominaciones n
                                    LEFT JOIN artistas ar ON n.id_artista = ar.id_artista
                                    LEFT JOIN albumes al ON n.id_album = al.id_album
                                    LEFT JOIN canciones cn ON n.id_cancion = cn.id_cancion
                                    WHERE n.id_categoria_nominacion = :cat_id";
                        
                        $stmt_nom = $conexion->prepare($sql_nom);
                        $stmt_nom->bindParam(':cat_id', $cat_id);
                        $stmt_nom->execute();
                        $nominados = $stmt_nom->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php foreach ($nominados as $nom): ?>
                        
                        <?php 
                            $titulo = "Desconocido";
                            $subtitulo = "";
                            // Imagen por defecto global
                            $imagen = HOST . "recursos/assets/img/mtv-logo.jpg"; 

                            // LÓGICA DE VISUALIZACIÓN
                            // 1. Es un Álbum
                            if (!empty($nom['titulo_album'])) {
                                $titulo = $nom['titulo_album'];
                                $subtitulo = "Álbum";
                                if (!empty($nom['imagen_album'])) {
                                    $imagen = HOST . ltrim($nom['imagen_album'], '/');
                                }
                            }
                            // 2. Es una Canción
                            elseif (!empty($nom['nombre_cancion'])) {
                                $titulo = $nom['nombre_cancion'];
                                $subtitulo = "Canción";
                                if (!empty($nom['imagen_cancion'])) {
                                    $imagen = HOST . ltrim($nom['imagen_cancion'], '/');
                                } else {
                                    $imagen = HOST . "recursos/assets/img/mtv-icon.svg"; 
                                }
                            }
                            // 3. Es un Artista
                            elseif (!empty($nom['pseudonimo_artista'])) {
                                $titulo = $nom['pseudonimo_artista'];
                                $subtitulo = "Artista";
                                if (!empty($nom['imagen_artista'])) {
                                    $imagen = HOST . ltrim($nom['imagen_artista'], '/');
                                } else {
                                    $imagen = HOST . "recursos/assets/img/mtvawardsblack.jpg";
                                }
                            }
                        ?>

                        <div class="card-nominado">
                            <img src="<?php echo $imagen; ?>" alt="<?php echo htmlspecialchars($titulo); ?>" class="card-img">
                            
                            <div class="card-body">
                                <h3 class="card-title"><?php echo htmlspecialchars($titulo); ?></h3>
                                <span class="card-subtitle"><?php echo $subtitulo; ?></span>

                                <form action="../../backend/portal/vote.php" method="POST">
                                    <input type="hidden" name="id_nominacion" value="<?php echo $nom['id_nominacion']; ?>">
                                    <input type="hidden" name="id_categoria" value="<?php echo $cat['id_categoria_nominacion']; ?>">

                                    <?php if (isset($_SESSION['id_usuario'])): ?>
                                        <?php if (!$ya_vote_aqui): ?>
                                            <button type="submit" class="btn-votar">
                                                Votar <i class="fa-solid fa-bolt"></i>
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn-votar votado-overlay" disabled>
                                                Voto Cerrado
                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="login.php" class="btn-votar" style="background-color: var(--table-border); color: white;">
                                            Login para Votar
                                        </a>
                                    <?php endif; ?>
                                </form>
                                
                                <p>
                                    <i class="fa-solid fa-chart-simple"></i> 
                                    <?php echo $nom['contador_nominacion']; ?> Votos
                                </p>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </section>
        <?php endforeach; ?>

        <?php if(empty($categorias)): ?>
            <div style="text-align: center; padding: 100px 20px;">
                <h2 style="color: var(--text-muted);">Aún no hay categorías de votación activas.</h2>
                <p>Regresa pronto para apoyar a tus artistas favoritos.</p>
            </div>
        <?php endif; ?>

    </main>

    <?php include('../../../recursos/recursos_portal/footer.php'); ?>

</body>
</html>