<?php include('config/constantes.php');?>

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
                <p>Los MTV Video Music Awards están dedicados a celebrar a los artistas y videos musicales más importantes.</p>
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
                    Tu voz es lo más importante: decide quién se lleva el galardón votando por tus favoritos.
                </p>
            </section>
            
            <section class="nominados">
                <div class="nominados__ver-mas">
                    <h2>Nominaciones</h2>
                    <a href="app/views/portal/votar.php">Ver Más</a>
                </div>

                <h3 class="nominados-h3">Mejor Artista</h3>
                <div class="nominados__container">
                    
                    <div class="card" id="faraon">
                        <span class="nombre">Faraón Love Shady</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/artist/3j8f1t1g2y2z3x4k5l6m7n" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=artista&id=1" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="badbunny">
                        <span class="nombre">Bad Bunny</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/artist/4q3ewBCX7sLwd24euuV69X" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=artista&id=2" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="romeo_santos">
                        <span class="nombre">Romeo Santos</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/artist/5lwmRuXgjX8xIvF36k7jx4" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=artista&id=3" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="the_weeknd">
                        <span class="nombre">The Weeknd</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/artist/1Xyo4u8uXC1ZmMpatF05PJ" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=artista&id=4" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="xxxtentacion">
                        <span class="nombre">XXXTentacion</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/artist/15UsOTVnJzReFVN1VCnxy4" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=artista&id=5" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="canserbero">
                        <span class="nombre">Canserbero</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/artist/1bAftSH8umNcGZ0uyV7LMg" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=artista&id=6" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>
                </div>

                <h3 class="nominados-h3">Mejor Álbum</h3>
                <div class="nominados__container">
                    
                    <div class="card" id="stars_dance">
                        <span class="nombre">Stars Dance</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/album/6AorUqeD0b6zXU5JgS2Q4H" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=album&id=14" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="verano">
                        <span class="nombre">Un Verano Sin Ti</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/album/3RQQmkQEvNCY4prGKE6oc5" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=album&id=17" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="formula">
                        <span class="nombre">Fórmula, Vol. 3</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/album/151w1FgRZfvjnWTkVKsvry" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=album&id=2" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="genesis">
                        <span class="nombre">GÉNESIS</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/album/4jOXszrE3t7QYlFqpF4wK6" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=album&id=24" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="muerte">
                        <span class="nombre">Muerte</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/album/3fC24U9L6U3zR5W5zF5z5z" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=album&id=33" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>

                    <div class="card" id="x17">
                        <span class="nombre">17</span>
                        <div style="margin-top: auto; display: flex; gap: 5px; justify-content: center;">
                            <a href="https://open.spotify.com/album/2Ti79nwTsont5ZHfdxIzAm" target="_blank">Spotify</a>
                            <a href="app/views/portal/detalles.php?tipo=album&id=34" style="background-color: var(--neon-pink);">Detalles</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <footer><?php include('recursos/recursos_portal/footer.php'); ?></footer>
    <script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
    <script src="recursos/assets/js/cuenta-regresiva.js"></script>
</body>
</html>