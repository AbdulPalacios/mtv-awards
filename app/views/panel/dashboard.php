<?php
session_start();

// 1. Validar si existe la sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../backend/portal/login.php");
    exit();
}

// 2. Validar si es Administrador (Rol 1)
if ($_SESSION['rol'] != 1) {
    // Si es usuario normal o artista, lo mandamos al inicio público
    header("Location: ../../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - MTV Awards</title>
    <style>
        /* Luego elimina esto we, es provisinal xd */
        body { font-family: sans-serif; display: flex; }
        aside { width: 250px; background: #333; color: white; height: 100vh; padding: 20px; }
        aside a { display: block; color: white; text-decoration: none; margin: 10px 0; padding: 10px; }
        aside a:hover { background: #555; }
        main { flex: 1; padding: 20px; }
    </style>
</head>
<body>

    <aside>
        <h3>Admin Panel</h3>
        <p>Hola, <?php echo $_SESSION['nombre']; ?></p>
        <hr>
        <nav>
            <a href="../../../index.php">Inicio</a>
            <a href="generos.php">Gestionar Géneros</a>
            <a href="artistas.php">Gestionar Artistas</a>
            <a href="albumes.php">Gestionar Álbumes</a>
            <a href="canciones.php">Gestionar Canciones</a>
            <a href="nominaciones.php">Crear Nominaciones</a>
            <hr>
            <a href="../../backend/portal/logout.php" style="color: #ff6b6b;">Cerrar Sesión</a>
        </nav>
    </aside>

    <main>
        <h1>Bienvenido al Panel de Control</h1>
        <p>Desde aquí podrás administrar todo el contenido de los MTV Awards.</p>
    </main>

</body>
</html>