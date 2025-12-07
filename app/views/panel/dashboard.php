<?php
session_start();
// 1. Incluir constantes (para usar HOST)
require_once '../../../config/constantes.php';

// 1. Validar si existe la sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

// 2. Validar si es Rol permitido (1=Admin, 2=Manager, 3=Artista)
// Si NO es ninguno de estos, va para afuera.
if (!in_array($_SESSION['rol'], [1, 2, 3])) {
    header("Location: " . HOST . "index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - MTV Awards</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/menu-lateral.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/dashboard.css">
</head>
<body>

    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main class="main">
        <h1>Bienvenido al Panel de Control</h1>
        <p>Desde aquí podrás administrar el contenido de los MTV Awards.</p>
        
        <div class="dashboard">
            <p><strong>Usuario activo:</strong> <?php echo $_SESSION['nombre']; ?></p>
            <p><strong>Rol:</strong> 
                <?php 
                    if($_SESSION['rol'] == 1) echo "Administrador Global";
                    elseif($_SESSION['rol'] == 2) echo "Manager";
                    elseif($_SESSION['rol'] == 3) echo "Artista";
                ?>
            </p>
            <p>Selecciona una opción del menú lateral para comenzar.</p>
        </div>
    </main>

</body>
</html>