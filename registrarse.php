<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - MTV Awards</title>
    <link rel="stylesheet" href="recursos/assets/css/root.css">
    <link rel="stylesheet" href="recursos/assets/css/index.css">
</head>
<body>
    
     <?php include 'recursos/recursos_portal/header.php'; ?>

    <main class="container">
        <h2>Crear Cuenta</h2>
        <form action="actions/public_actions/register.php" method="POST">
            
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="ap_paterno">Apellido Paterno:</label>
            <input type="text" name="ap_paterno" required>

            <label for="ap_materno">Apellido Materno:</label>
            <input type="text" name="ap_materno">

            <label for="sexo">Sexo:</label>
            <select name="sexo" required>
                <option value="1">Masculino</option>
                <option value="2">Femenino</option>
                <option value="3">Otro</option>
            </select>

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </main>

    <?php include 'recursos/recursos_portal/footer.php'; ?>

</body>
</html>