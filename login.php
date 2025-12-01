<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MTV Awards</title>
    <link rel="stylesheet" href="recursos/assets/css/root.css">
    <link rel="stylesheet" href="recursos/assets/css/index.css">
</head>
<body>

    <?php include 'recursos/recursos_portal/header.php'; ?>

    <main class="container">
        <h2>Iniciar Sesión</h2>
        <form action="actions/public_actions/login.php" method="POST">
            
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
        <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </main>

    <?php include 'recursos/recursos_portal/footer.php'; ?>

</body>
</html>