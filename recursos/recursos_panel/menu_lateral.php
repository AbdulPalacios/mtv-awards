<aside>
    <h3>Admin Panel</h3>
    <p>Hola, <?php echo $_SESSION['nombre']; ?></p>
    <hr>
    <nav>
        <a href="../../app/views/panel/dashboard.php">Inicio</a>
        <a href="../../app/views/panel/generos.php">Gestionar Géneros</a>
        <a href="../../app/views/panel/artistas.php">Gestionar Artistas</a>
        <a href="../../app/views/panel/albumes.php" style="color: white; font-weight: bold;">Gestionar Álbumes</a>
        <a href="../../app/views/panel/canciones.php">Gestionar Canciones</a>
        <a href="../../app/views/panel/nominaciones.php">Crear Nominaciones</a>
        <hr>
        <a href="../../app/backend/portal/logout.php">Cerrar Sesión</a>
    </nav>
</aside>