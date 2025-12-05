<?php
// 1. Aseguramos que la constante HOST esté disponible
require_once __DIR__ . '/../../config/constantes.php';
?>

<aside>
    <h3>Admin Panel</h3>
    <p>Hola, <?php echo $_SESSION['nombre']; ?></p>
    <hr>
    <nav>
        <a href="<?php echo HOST; ?>app/views/panel/dashboard.php">Inicio</a>
        <a href="<?php echo HOST; ?>app/views/panel/generos.php">Gestionar Géneros</a>
        <a href="<?php echo HOST; ?>app/views/panel/artistas.php">Gestionar Artistas</a>
        <a href="<?php echo HOST; ?>app/views/panel/albumes.php">Gestionar Álbumes</a>
        <a href="<?php echo HOST; ?>app/views/panel/canciones.php">Gestionar Canciones</a>
        <a href="<?php echo HOST; ?>app/views/panel/nominaciones.php">Crear Nominaciones</a>
        <hr>
        <a href="<?php echo HOST; ?>app/backend/portal/logout.php" style="color:red;">Cerrar Sesión</a>
    </nav>
</aside>