<?php
session_start();
require_once '../../../config/constantes.php';
// Incluimos la lógica del backend (esto carga $categorias y $mis_votos_categorias)
require_once '../../backend/portal/get_votar.php';

// 1. Obtener todas las categorías activas
$categorias = $conexion->query("SELECT * FROM categorias_nominaciones WHERE estatus_categoria_nominacion = 1 ORDER BY id_categoria_nominacion DESC")->fetchAll(PDO::FETCH_ASSOC);

// 2. Si el usuario está logueado, averiguar en qué categorías ya votó
$mis_votos_categorias = []; // Array para guardar IDs de categorías donde ya votó
if (isset($_SESSION['id_usuario'])) {
    $uid = $_SESSION['id_usuario'];
    $sql_votos = "SELECT n.id_categoria_nominacion 
                  FROM votaciones v 
                  INNER JOIN nominaciones n ON v.id_nominacion = n.id_nominacion 
                  WHERE v.id_usuario = $uid";
    $res_votos = $conexion->query($sql_votos)->fetchAll(PDO::FETCH_COLUMN);
    $mis_votos_categorias = $res_votos; // Ej: [1, 4, 5] IDs de categorías votadas
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTV Awards - Vota Ahora</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <style>
        /* Estilos rápidos para el Home (puedes moverlos a index.css) */
        body { font-family: 'Arial', sans-serif; background-color: #121212; color: white; margin: 0; }
        
        /* HERO SECTION */
        .hero { 
            background: url('<?php echo HOST; ?>recursos/assets/img/hero__mtv-awards.png') no-repeat center center/cover;
            height: 400px; display: flex; align-items: center; justify-content: center; text-align: center;
            position: relative;
        }
        .hero::after { content:''; position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); }
        .hero-content { position: relative; z-index: 2; }
        .hero h1 { font-size: 4rem; margin: 0; color: #ffff00; text-transform: uppercase; font-style: italic; }
        
        /* CONTENIDO */
        .container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        
        .categoria-section { margin-bottom: 60px; }
        .cat-title { 
            border-left: 10px solid #ffff00; padding-left: 20px; font-size: 2.5rem; margin-bottom: 30px; text-transform: uppercase;
        }

        .grid-nominados { 
            display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; 
        }

        .card-nominado { 
            background: #222; border-radius: 10px; overflow: hidden; transition: transform 0.3s; position: relative;
            border: 1px solid #333;
        }
        .card-nominado:hover { transform: translateY(-5px); border-color: #ffff00; }

        .card-img { width: 100%; height: 200px; object-fit: cover; background: #333; }
        .card-body { padding: 20px; text-align: center; }
        .card-title { font-size: 1.2rem; font-weight: bold; margin: 0 0 10px 0; color: #fff; }
        .card-subtitle { color: #888; font-size: 0.9rem; margin-bottom: 20px; display: block; }

        .btn-votar { 
            background: #ffff00; color: black; border: none; padding: 10px 30px; 
            font-weight: bold; cursor: pointer; text-transform: uppercase; width: 100%;
            transition: background 0.3s;
        }
        .btn-votar:hover { background: #fff; }

        /* Estado Votado */
        .votado-overlay {
            background: #333; color: #555; cursor: not-allowed;
        }
        .ya-votaste-msg {
            color: #ffff00; font-weight: bold; text-align: center; display: block; margin-top: 10px;
        }
    </style>
</head>
<body>

    <?php include('../../../recursos/recursos_portal/header.php'); ?>

    <header class="hero">
        <div class="hero-content">
            <h1>Vote Now</h1>
            <p>Tu voz define a los ganadores.</p>
            
            <?php if (!isset($_SESSION['id_usuario'])): ?>
                <a href="registrarse.php" style="color: white; font-size: 1.2rem; text-decoration: underline;">Regístrate para votar</a>
            <?php else: ?>
                <p>Hola, <strong><?php echo $_SESSION['nombre']; ?></strong></p>
                
                <?php if($_SESSION['rol'] == 1): ?>
                    <a href="<?php echo HOST; ?>app/views/panel/dashboard.php" style="background:red; color:white; padding:5px 10px; text-decoration:none;">Ir al Panel Admin</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </header>

    <main class="container">

        <?php foreach ($categorias as $cat): ?>
            
            <?php 
                // Verificar si el usuario ya votó en ESTA categoría
                $ya_vote_aqui = in_array($cat['id_categoria_nominacion'], $mis_votos_categorias);
            ?>

            <section class="categoria-section">
                <h2 class="cat-title"><?php echo $cat['nombre_categoria_nominacion']; ?></h2>
                
                <?php if($ya_vote_aqui): ?>
                    <p style="color: #ffff00;">✅ Ya has registrado tu voto en esta categoría.</p>
                <?php endif; ?>

                <div class="grid-nominados">
                    <?php 
                        $cat_id = $cat['id_categoria_nominacion'];
                        $sql_nom = "SELECT n.id_nominacion, 
                                    ar.pseudonimo_artista, ar.imagen_artista,
                                    al.titulo_album, al.imagen_album,
                                    cn.nombre_cancion, cn.imagen_cancion, 
                                    n.contador_nominacion
                                    FROM nominaciones n
                                    LEFT JOIN artistas ar ON n.id_artista = ar.id_artista
                                    LEFT JOIN albumes al ON n.id_album = al.id_album
                                    LEFT JOIN canciones cn ON n.id_cancion = cn.id_cancion
                                    WHERE n.id_categoria_nominacion = $cat_id";

                        // Ejecutar la consulta
                        $nominados = $conexion->query($sql_nom)->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php foreach ($nominados as $nom): ?>
                        
                       <?php 
                            $titulo = "Desconocido";
                            $subtitulo = "";
                            $imagen = HOST . "recursos/assets/img/mtv-logo.jpg"; // Imagen global por defecto

                            // CASO 1: Es un Álbum
                            if ($nom['titulo_album']) {
                                $titulo = $nom['titulo_album'];
                                $subtitulo = "Álbum";
                                
                                // Verificar si tiene portada en la BD
                                if (!empty($nom['imagen_album'])) {
                                    $imagen = HOST . ltrim($nom['imagen_album'], '/');
                                } else {
                                    // Si no tiene, usa esta genérica
                                    $imagen = HOST . "recursos/assets/img/mtv-logo.jpg"; 
                                }
                            }
                            // CASO 2: Es una Canción
                            elseif ($nom['nombre_cancion']) {
                                $titulo = $nom['nombre_cancion'];
                                $subtitulo = "Canción";
                                
                                // --- CAMBIO AQUÍ ---
                                // Si la base de datos trae una imagen, úsala.
                                if (!empty($nom['imagen_cancion'])) {
                                    $imagen = HOST . ltrim($nom['imagen_cancion'], '/');
                                } else {
                                    // Si está vacía, usa la genérica por defecto
                                    $imagen = HOST . "recursos/assets/img/mtv-icon.svg"; 
                                }
                            }
                            // CASO 3: Es un Artista
                            elseif ($nom['pseudonimo_artista']) {
                                $titulo = $nom['pseudonimo_artista'];
                                $subtitulo = "Artista";
                                
                                // VERIFICAR SI TIENE FOTO PERSONALIZADA
                                if (!empty($nom['imagen_artista'])) {
                                    $imagen = HOST . ltrim($nom['imagen_artista'], '/');
                                } else {
                                    $imagen = HOST . "recursos/assets/img/mtvawardsblack.jpg"; //Genérica
                                }
                            }
                        ?>

                        <div class="card-nominado">
                            <img src="<?php echo $imagen; ?>" alt="Nominado" class="card-img">
                            
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $titulo; ?></h3>
                                <span class="card-subtitle"><?php echo $subtitulo; ?></span>

                                <form action="../../backend/portal/vote.php" method="POST">
                                    <input type="hidden" name="id_nominacion" value="<?php echo $nom['id_nominacion']; ?>">
                                    <input type="hidden" name="id_categoria" value="<?php echo $cat['id_categoria_nominacion']; ?>">

                                    <?php if (isset($_SESSION['id_usuario'])): ?>
                                        <?php if (!$ya_vote_aqui): ?>
                                            <button type="submit" class="btn-votar">Votar</button>
                                        <?php else: ?>
                                            <button type="button" class="btn-votar votado-overlay" disabled>Voto Cerrado</button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="login.php" class="btn-votar" style="display:block; text-decoration:none; font-size:0.8rem; background:#555; color:white;">Login para Votar</a>
                                    <?php endif; ?>
                                </form>
                                
                                <p style="font-size: 0.8rem; color: #666; margin-top: 10px;">
                                    <?php echo $nom['contador_nominacion']; ?> Votos
                                </p>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </section>
        <?php endforeach; ?>

        <?php if(empty($categorias)): ?>
            <div style="text-align: center; padding: 50px;">
                <h2>Aún no hay categorías de votación activas.</h2>
                <p>Regresa pronto.</p>
            </div>
        <?php endif; ?>

    </main>

    <?php include('../../../recursos/recursos_portal/footer.php'); ?>

</body>
</html>