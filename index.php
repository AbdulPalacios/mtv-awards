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
            </span>
        </div>
    </div>
    
    <div class="bg-image">
        <main class="main">
            <div class="mtv-music-container">
                <h3>MTV Video Music Awards</h3>
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
        </main>
    </div>

    <footer>
        <?php
            include('recursos/recursos_portal/footer.php');
        ?>
    </footer>
<script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
</body>
</html>