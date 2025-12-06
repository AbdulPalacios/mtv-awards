<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// CONSULTA PARA OBTENER EL TOP 5 MÁS VOTADOS (Ranking Global)
// Unimos las tablas para saber si es artista, álbum o canción
$sql_ranking = "
    SELECT n.id_nominacion, n.contador_nominacion, c.nombre_categoria_nominacion,
           art.pseudonimo_artista, art.imagen_artista,
           alb.titulo_album, alb.imagen_album,
           can.nombre_cancion, can.imagen_cancion
    FROM nominaciones n
    INNER JOIN categorias_nominaciones c ON n.id_categoria_nominacion = c.id_categoria_nominacion
    LEFT JOIN artistas art ON n.id_artista = art.id_artista
    LEFT JOIN albumes alb ON n.id_album = alb.id_album
    LEFT JOIN canciones can ON n.id_cancion = can.id_cancion
    WHERE n.contador_nominacion > 0
    ORDER BY n.contador_nominacion DESC
    LIMIT 5"; // Mostramos el Top 5

$top_ranking = $conexion->query($sql_ranking)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ranking en Vivo - MTV Awards</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/ranking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="header-container">
        <?php include('../../../recursos/recursos_portal/header.php'); ?>
    </div>

    <main class="ranking-container">
        <h1 class="titulo-ranking"><i class="fa-solid fa-trophy"></i> Top Votados</h1>

        <?php 
        $posicion = 1;
        foreach ($top_ranking as $item): 
            // Determinar qué mostrar (Artista, Álbum o Canción)
            $nombre = "Desconocido";
            $imagen = HOST . "recursos/assets/img/mtv-logo.jpg";
            $tipo = "Nominado";

            if ($item['pseudonimo_artista']) {
                $nombre = $item['pseudonimo_artista'];
                $imagen = $item['imagen_artista'] ? HOST . ltrim($item['imagen_artista'], '/') : $imagen;
                $tipo = "Artista";
            } elseif ($item['titulo_album']) {
                $nombre = $item['titulo_album'];
                $imagen = $item['imagen_album'] ? HOST . ltrim($item['imagen_album'], '/') : $imagen;
                $tipo = "Álbum";
            } elseif ($item['nombre_cancion']) {
                $nombre = $item['nombre_cancion'];
                $imagen = $item['imagen_cancion'] ? HOST . ltrim($item['imagen_cancion'], '/') : $imagen;
                $tipo = "Canción";
            }
        ?>

        <div class="rank-card rank-<?php echo $posicion; ?>">
            <div class="rank-number">#<?php echo $posicion; ?></div>
            <img src="<?php echo $imagen; ?>" alt="Imagen" class="rank-img">
            
            <div class="rank-info">
                <h3><?php echo $nombre; ?></h3>
                <span>Nominado a: <?php echo $item['nombre_categoria_nominacion']; ?></span>
            </div>

            <div class="rank-votes">
                <span class="vote-count"><?php echo $item['contador_nominacion']; ?></span>
                <span class="vote-label">Votos</span>
            </div>
        </div>

        <?php 
        $posicion++;
        endforeach; 
        ?>

        <?php if(empty($top_ranking)): ?>
            <div style="text-align: center; margin-top: 50px;">
                <h3 style="color: #666;">Aún no hay votos registrados. ¡Sé el primero!</h3>
                <br>
                <a href="votar.php" class="paramount-btn">IR A VOTAR</a>
            </div>
        <?php endif; ?>

    </main>

    <footer>
        <?php include('../../../recursos/recursos_portal/footer.php'); ?>
    </footer>

</body>
</html>