<?php
// 1. Incluimos constantes para poder usar HOST en el <head>
require_once '../../../config/constantes.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MTV Awards</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/login.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/footer.css">
</head>
<body>

    <div class="bg-image-login">
        <?php include '../../../recursos/recursos_portal/header.php'; ?>

        <main class="container">
            <h2><i class="fa-solid fa-user-astronaut"></i> Iniciar Sesión</h2>
            
            <form action="../../backend/portal/login.php" method="POST">
                
                <label for="email">Correo Electrónico:</label>
                <div class="input-group">
                    <i class="fa-solid fa-envelope icon"></i>
                    <input type="email" name="email" placeholder="ejemplo@email.com" required>
                </div>

                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock icon"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit">
                    Entrar <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>

            </form>
            
            <p>¿No tienes cuenta? <a href="registrarse.php">Regístrate aquí</a></p>
        </main>
    </div>

    <?php include '../../../recursos/recursos_portal/footer.php'; ?>

    <script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
</body>
</html>