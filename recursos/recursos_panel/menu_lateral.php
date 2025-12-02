<aside>
    <h3>Admin Panel</h3>
    <p>Hola, <?php echo $_SESSION['nombre']; ?></p>
    <hr>
    <nav>
        <a href="dashboard.php">Inicio</a>
        <a href="generos.php">Gestionar Géneros</a>
        <a href="artistas.php">Gestionar Artistas</a>
        <a href="albumes.php" style="color: white; font-weight: bold;">Gestionar Álbumes</a>
        <a href="canciones.php">Gestionar Canciones</a>
        <a href="nominaciones.php">Crear Nominaciones</a>
        <hr>
        <a href="../actions/public_actions/logout.php">Cerrar Sesión</a>
    </nav>
</aside>