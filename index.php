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
        <?php
            include('recursos/recursos_portal/header.php');
        ?>
    </div>

    <div class="hero">
        <div class="hero__container">
            <h1>MTV VMAs 2025</h1>
            <span>
                Decide cuál de tus celebridades favoritas ganará a lo grande y se llevara a casa una Moon Person en el show de este año.
            </span> <br>

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
                <p>Somos el puente directo entre los artistas y sus seguidores. A través de este sistema integral de votación, gestionamos millones de voces alrededor del mundo para garantizar que cada voto cuente de manera transparente y segura.</p>
                <ul>
                    <li>
                        <a href="https://www.facebook.com/VMAs/">
                            <i class="fa-brands fa-square-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/vmas/">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://x.com/vmas">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    
                    </li>
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

                <h3 class="nominados-h3">Mejor Artista</h3>
                <div class="nominados__container">
                    <div class="card" id="faraon">
                        <span class="nombre">Faraón Love Shady</span>
                        <p>El artista peruano que ha viralizado el internet con su estilo único y extravagante.</p>
                        <a href="https://open.spotify.com/artist/3j8f1t1g2y2z3x4k5l6m7n" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="badbunny">
                        <span class="nombre">Bad Bunny</span>
                        <p>El "Conejo Malo", ícono global del trap y reguetón puertorriqueño.</p>
                        <a href="https://open.spotify.com/artist/4q3ewBCX7sLwd24euuV69X" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="romeo_santos">
                        <span class="nombre">Romeo Santos</span>
                        <p>El Rey de la Bachata, conocido por su voz suave y letras románticas.</p>
                        <a href="https://open.spotify.com/artist/5lwmRuXgjX8xIvF36k7jx4" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="the_weeknd">
                        <span class="nombre">The Weeknd</span>
                        <p>Estrella canadiense del pop y R&B alternativo con éxitos mundiales.</p>
                        <a href="https://open.spotify.com/artist/1Xyo4u8uXC1ZmMpatF05PJ" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="xxxtentacion">
                        <span class="nombre">XXXTentacion</span>
                        <p>Artista versátil que revolucionó el emo-rap y el trap con un impacto global masivo.</p>
                        <a href="https://open.spotify.com/artist/15UsOTVnJzReFVN1VCnxy4" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="canserbero">
                        <span class="nombre">Canserbero</span>
                        <p>El legendario rapero venezolano, voz eterna del rap conciencia y la lírica profunda.</p>
                        <a href="https://open.spotify.com/artist/1bAftSH8umNcGZ0uyV7LMg" target="_blank">Ver en Spotify</a>
                    </div>
                </div>

                <h3 class="nominados-h3">Mejor Álbum</h3>
                <div class="nominados__container">
                    <div class="card" id="stars_dance">
                        <span class="nombre">Stars Dance</span>
                        <p>El álbum debut en solitario de Selena Gomez, lleno de energía pop y electrónica.</p>
                        <a href="https://open.spotify.com/album/6AorUqeD0b6zXU5JgS2Q4H" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="verano">
                        <span class="nombre">Un Verano Sin Ti</span>
                        <p>Un viaje por los sonidos del Caribe que rompió récords de streaming.</p>
                        <a href="https://open.spotify.com/album/3RQQmkQEvNCY4prGKE6oc5" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="formula">
                        <span class="nombre">Fórmula, Vol. 3</span>
                        <p>La tercera entrega de su exitosa saga, mezclando bachata con nuevos ritmos.</p>
                        <a href="https://open.spotify.com/album/151w1FgRZfvjnWTkVKsvry" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="genesis">
                        <span class="nombre">GÉNESIS</span>
                        <p>El álbum que consolidó a Peso Pluma y los corridos tumbados a nivel mundial.</p>
                        <a href="https://open.spotify.com/album/4jOXszrE3t7QYlFqpF4wK6" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="muerte">
                        <span class="nombre">Muerte</span>
                        <p>Considerado su obra maestra, un álbum oscuro y narrativo que marcó la historia del hip-hop latino.</p>
                        <a href="https://open.spotify.com/album/3fC24U9L6U3zR5W5zF5z5z" target="_blank">Ver en Spotify</a>
                    </div>

                    <div class="card" id="x17">
                        <span class="nombre">17</span>
                        <p>El álbum más exitoso de X, incluye éxitos mundiales como "SAD!" y "Moonlight".</p>
                        <a href="https://open.spotify.com/album/2Ti79nwTsont5ZHfdxIzAm" target="_blank">Ver en Spotify</a>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <footer>
        <?php
            include('recursos/recursos_portal/footer.php');
        ?>
    </footer>
    <script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
    <script src="recursos/assets/js/cuenta-regresiva.js"></script>
</body>
</html>