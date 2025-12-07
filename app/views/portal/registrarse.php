<?php
// 1. Incluimos constantes para poder usar HOST en el <head>
require_once '../../../config/constantes.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - MTV Awards</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/registrarse.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/footer.css">
</head>
<body>
    
    <div class="bg-image-registrarse">
        <?php include '../../../recursos/recursos_portal/header.php'; ?>

        <main class="container register-container">
            <h2><i class="fa-solid fa-address-card"></i> Crear Cuenta</h2>
            
            <form action="../../backend/portal/register.php" method="POST" enctype="multipart/form-data">
                
                <label for="nombre">Nombre:</label>
                <div class="input-group">
                    <i class="fa-solid fa-user icon"></i>
                    <input type="text" name="nombre" placeholder="Tu nombre" required>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="ap_paterno">Apellido Paterno:</label>
                        <div class="input-group">
                            <i class="fa-solid fa-signature icon"></i>
                            <input type="text" name="ap_paterno" placeholder="Paterno" required>
                        </div>
                    </div>
                    
                    <div class="col">
                        <label for="ap_materno">Apellido Materno:</label>
                        <div class="input-group">
                            <i class="fa-solid fa-signature icon"></i>
                            <input type="text" name="ap_materno" placeholder="Materno">
                        </div>
                    </div>
                </div>

                <label for="sexo">Sexo:</label>
                <div class="input-group">
                    <i class="fa-solid fa-venus-mars icon"></i>
                    <select name="sexo" required>
                        <option value="" disabled selected>Selecciona una opción</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                        <option value="3">Otro</option>
                    </select>
                    <i class="fa-solid fa-chevron-down arrow-icon"></i>
                </div>

                <label for="imagen">Foto de Perfil (Opcional):</label>
                <div class="input-group">
                    <i class="fa-solid fa-camera icon"></i>
                    <input type="file" name="imagen" accept="image/*" style="padding-top: 10px;">
                </div>
                <label for="email">Correo Electrónico:</label>
                <div class="input-group">
                    <i class="fa-solid fa-envelope icon"></i>
                    <input type="email" name="email" placeholder="ejemplo@mtv.com" required>
                </div>

                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock icon"></i>
                    <input type="password" name="password" placeholder="Crea una contraseña segura" required>
                </div>

                <button type="submit">
                    Registrarse <i class="fa-solid fa-user-plus"></i>
                </button>
            </form>
            
            <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </main>
    </div>

    <?php include '../../../recursos/recursos_portal/footer.php'; ?>

    <script src="https://kit.fontawesome.com/e2dc84faef.js" crossorigin="anonymous"></script>
</body>
</html>