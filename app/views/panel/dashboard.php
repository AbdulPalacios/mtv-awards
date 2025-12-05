<?php
session_start();
// 1. Incluir constantes (para usar HOST)
require_once '../../../config/constantes.php';

// 1. Validar si existe la sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

// 2. Validar si es Administrador (Rol 1)
if ($_SESSION['rol'] != 1) {
    // Si es usuario normal o artista, lo mandamos al inicio público
    header("Location: " . HOST . "index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - MTV Awards</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
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

    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main>
        <h1>Bienvenido al Panel de Control</h1>
        <p>Desde aquí podrás administrar todo el contenido de los MTV Awards.</p>
        
        <div style="margin-top: 20px; padding: 20px; background: #f4f4f4; border-radius: 8px;">
            <p><strong>Usuario activo:</strong> <?php echo $_SESSION['nombre']; ?></p>
            <p>Selecciona una opción del menú lateral para comenzar.</p>
        </div>
    </main>

</body>
</html>