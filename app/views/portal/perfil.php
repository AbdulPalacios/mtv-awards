<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// Validar que sea Audiencia (Rol 4)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 4) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$usuario = $conexion->query("SELECT * FROM usuarios WHERE id_usuario = $id_usuario")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil - MTV Awards</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/registrarse.css"> </head>
<body>
    <div class="header-container">
        <?php include '../../../recursos/recursos_portal/header.php'; ?>
    </div>

    <div class="bg-image-registrarse" style="height: 100vh;">
        <main class="container register-container" style="margin-top: 120px;">
            <h2><i class="fa-solid fa-user-gear"></i> Mi Perfil</h2>
            
            <form action="../../backend/portal/acc_perfil.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="actualizar">
                
                <label>Nombre:</label>
                <div class="input-group">
                    <i class="fa-solid fa-user icon"></i>
                    <input type="text" value="<?php echo $usuario['nombre_usuario']; ?>" disabled style="opacity:0.7;">
                </div>

                <label>Correo Electrónico:</label>
                <div class="input-group">
                    <i class="fa-solid fa-envelope icon"></i>
                    <input type="email" value="<?php echo $usuario['correo_usuario']; ?>" disabled style="opacity:0.7;">
                </div>

                <label>Cambiar Foto de Perfil:</label>
                <div class="input-group">
                    <i class="fa-solid fa-camera icon"></i>
                    <input type="file" name="imagen" accept="image/*" style="padding-top:10px;">
                </div>
                
                <?php if($usuario['imagen_usuario']): ?>
                    <div style="text-align:center; margin:10px;">
                        <img src="<?php echo HOST . ltrim($usuario['imagen_usuario'], '/'); ?>" style="width: 80px; height:80px; border-radius: 50%; border: 2px solid var(--neon-cyan);">
                    </div>
                <?php endif; ?>

                <label>Nueva Contraseña (Dejar vacío si no deseas cambiarla):</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock icon"></i>
                    <input type="password" name="password" placeholder="Nueva contraseña">
                </div>

                <button type="submit">Actualizar Perfil <i class="fa-solid fa-check"></i></button>
            </form>
        </main>
    </div>
    
    <script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
</body>
</html>