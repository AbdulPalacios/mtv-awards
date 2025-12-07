<?php 
require_once 'config/conexion-bd.php';
require_once 'config/constantes.php';

// --- LÓGICA DE "LOS MEJORES" (TOP 10) ---

// 1. TOP 10 ARTISTAS
// Traemos al artista Y sus votos, ordenados de mayor a menor.
$sql_artistas = "SELECT a.*, n.contador_nominacion 
                 FROM artistas a 
                 INNER JOIN nominaciones n ON a.id_artista = n.id_artista
                 WHERE a.estatus_artista = 1 
                 AND n.id_categoria_nominacion = 1 
                 AND n.contador_nominacion > 0 
                 ORDER BY n.contador_nominacion DESC 
                 LIMIT 10"; // <--- AQUÍ ESTÁ EL CAMBIO A TOP 10

$artistas = $conexion->query($sql_artistas)->fetchAll(PDO::FETCH_ASSOC);

// 2. TOP 10 ÁLBUMES
$sql_albumes = "SELECT al.*, n.contador_nominacion 
                FROM albumes al 
                INNER JOIN nominaciones n ON al.id_album = n.id_album
                WHERE al.estatus_album = 1 
                AND n.id_categoria_nominacion = 2 
                AND n.contador_nominacion > 0 
                ORDER BY n.contador_nominacion DESC 
                LIMIT 10"; // <--- CAMBIO A TOP 10

$albumes = $conexion->query($sql_albumes)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTV Video Music Awards 2025</title>
    
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/index.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/footer.css">
</head>
<body>
    <div class="header-container">
        <?php include('recursos/recursos_portal/header.php'); ?>
    </div>

    <div class="hero">
        <div class="hero__container">
            <h1>MTV VMAs 2025</h1>
            <span>Decide cuál de tus celebridades favoritas ganará a lo grande.</span> <br>
            <a class="votar" href="app/views/portal/votar.php"> IR A VOTAR</a>
        </div>
    </div>
    
    <div class="bg-image">
        <main class="main">
            <div class="voting-deadline">
                <p>¡No te quedes fuera! Las votaciones cierran el: <time datetime="2025-12-31">31 de Diciembre de 2025</time>.</p>
                <p>
                    <span id="dias" class="countdown-number">00</span>D 
                    <span id="horas" class="countdown-number">00</span>H 
                    <span id="minutos" class="countdown-number">00</span>M 
                    <span id="segundos" class="countdown-number">00</span>S
                </p>
            </div>

            <div class="mtv-music-container">
                <h2>MTV Video Music Awards</h2>
                <p>Los MTV Video Music Awards están dedicados a celebrar a los artistas y videos musicales más importantes del año con actuaciones, honores y más.</p>
                <ul>
                    <li><a href="https://www.facebook.com/VMAs/"><i class="fa-brands fa-square-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/vmas/"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="https://x.com/vmas"><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>

            <section class="about-awards">
                <h2>Sobre los MTV Awards</h2>
                <p>
                    Los MTV Awards son la premiación definitiva que celebra la excelencia musical. 
                    Reconocemos la trayectoria de los artistas más influyentes y las producciones 
                    discográficas que marcaron el año. Tu voz es lo más importante: decide quién 
                    se lleva el galardón votando por tus favoritos en categorías como Mejor Artista y Mejor Álbum.
                </p>
            </section>
            
            <section class="nominados">
                <div class="nominados__ver-mas">
                    <h2>Nominaciones</h2>
                    <a href="app/views/portal/votar.php">Ver Más</a>
                </div>

                <h3 class="nominados-h3">Mejor Artista (Top 10)</h3>
                
                <div class="nominados__container">
                    
                    <?php if(count($artistas) > 0): ?>
                        <?php foreach($artistas as $art): ?>
                            <?php 
                                $img = !empty($art['imagen_artista']) ? HOST . ltrim($art['imagen_artista'], '/') : 'https://via.placeholder.com/300x400?text=No+Image';
                            ?>
                            
                            <div class="card" style="background-image: linear-gradient(to top, rgba(0,0,0,0.9) 10%, rgba(0,0,0,0) 60%), url('<?php echo $img; ?>');">
                                
                                <span class="nombre"><?php echo htmlspecialchars($art['pseudonimo_artista']); ?></span>
                                
                                <span style="color: var(--neon-lime); font-size: 0.8rem; font-weight: bold; margin-bottom: 5px;">
                                    <i class="fa-solid fa-fire"></i> <?php echo $art['contador_nominacion']; ?> Votos
                                </span>

                                <a href="app/views/portal/detalles.php?tipo=artista&id=<?php echo $art['id_artista']; ?>" class="btn-detalles">
                                   Detalles
                                </a>

                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #666; font-style: italic; padding: 20px;">
                            Aún no hay suficientes votos para mostrar el Top Artistas. ¡Sé el primero en votar!
                        </p>
                    <?php endif; ?>

                </div>

                <h3 class="nominados-h3" style="margin-top: 40px;">Mejor Álbum (Top 10)</h3>
                
                <div class="nominados__container">
                    
                    <?php if(count($albumes) > 0): ?>
                        <?php foreach($albumes as $alb): ?>
                            <?php 
                                $img_alb = !empty($alb['imagen_album']) ? HOST . ltrim($alb['imagen_album'], '/') : 'https://via.placeholder.com/300x400?text=No+Image';
                            ?>
                            
                            <div class="card" style="background-image: linear-gradient(to top, rgba(0,0,0,0.9) 10%, rgba(0,0,0,0) 60%), url('<?php echo $img_alb; ?>');">
                                
                                <span class="nombre"><?php echo htmlspecialchars($alb['titulo_album']); ?></span>
                                
                                <span style="color: var(--neon-lime); font-size: 0.8rem; font-weight: bold; margin-bottom: 5px;">
                                    <i class="fa-solid fa-fire"></i> <?php echo $alb['contador_nominacion']; ?> Votos
                                </span>

                                <a href="app/views/portal/detalles.php?tipo=album&id=<?php echo $alb['id_album']; ?>" class="btn-detalles">
                                   Detalles
                                </a>

                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #666; font-style: italic; padding: 20px;">
                            Aún no hay suficientes votos para mostrar el Top Álbumes.
                        </p>
                    <?php endif; ?>

                </div>

            </section>
        </main>
    </div>

    <footer><?php include('recursos/recursos_portal/footer.php'); ?></footer>
    <script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
    <script src="recursos/assets/js/cuenta-regresiva.js"></script>
</body>
</html>