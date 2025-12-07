<?php
// 1. Aseguramos que la constante HOST esté disponible
require_once __DIR__ . '/../../config/constantes.php';
$rol = $_SESSION['rol'] ?? 0;
?>

<aside>
    <h3>
        <?php 
            // TÍTULO DINÁMICO SEGÚN ROL
            if ($rol == 1) echo 'Admin Panel';
            elseif ($rol == 2) echo 'Panel Manager';
            else echo 'Panel Artista'; 
        ?>
    </h3>
    <p>Hola, <?php echo $_SESSION['nombre']; ?></p>
    <hr>
    <nav>
        <a href="<?php echo HOST; ?>app/views/panel/dashboard.php">Inicio</a>

        <?php if ($rol == 1): ?>
            <a href="<?php echo HOST; ?>app/views/panel/generos.php">Gestionar Géneros</a>
        <?php endif; ?>

        <a href="<?php echo HOST; ?>app/views/panel/artistas.php">
            <?php 
                if ($rol == 1) echo 'Gestionar Artistas';
                elseif ($rol == 2) echo 'Mi Perfil (Manager)';
                else echo 'Mi Perfil';
            ?>
        </a>

        <a href="<?php echo HOST; ?>app/views/panel/albumes.php">
            <?php echo ($rol == 1) ? 'Gestionar Álbumes' : 'Mis Álbumes'; ?>
        </a>

        <a href="<?php echo HOST; ?>app/views/panel/canciones.php">
            <?php echo ($rol == 1) ? 'Gestionar Canciones' : 'Mis Canciones'; ?>
        </a>

        <?php if ($rol == 1): ?>
            <a href="<?php echo HOST; ?>app/views/panel/nominaciones.php">Crear Nominaciones</a>
        <?php endif; ?>

        <hr>
        <a href="<?php echo HOST; ?>app/backend/portal/logout.php" class="logout">Cerrar Sesión</a>
    </nav>
</aside>