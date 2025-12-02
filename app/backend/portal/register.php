<?php
// 1. Incluir la conexión
require_once '../../config/conexion-bd.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir datos
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['ap_paterno'];
    $apMaterno = $_POST['ap_materno'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 2. Validar que el correo no exista
    $sql_check = "SELECT id_usuario FROM usuarios WHERE correo_usuario = :email";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bindParam(':email', $email);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        echo "<script>alert('El correo ya está registrado.');</script>";
        exit();
    }

    // 3. Encriptar contraseña (Nunca guardar texto plano)
    // Usamos PASSWORD_DEFAULT que genera un hash seguro de 60 caracteres (cabe en tu varchar(64))
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    // 4. Valores por defecto
    $estatus = 1; // 1 = Activo
    $id_rol = 2;  // Asumimos que 2 es 'Fan' o 'Usuario'. Asegúrate de tener este rol en la tabla `roles`.

    // 5. Insertar usuario
    try {
        $sql_insert = "INSERT INTO usuarios (estatus_usuario, nombre_usuario, ap_usuario, am_usuario, sexo_usuario, correo_usuario, password_usuario, id_rol) 
                       VALUES (:estatus, :nombre, :ap, :am, :sexo, :email, :pass, :rol)";
        
        $stmt = $conexion->prepare($sql_insert);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ap', $apPaterno);
        $stmt->bindParam(':am', $apMaterno);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass_hash);
        $stmt->bindParam(':rol', $id_rol);

        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso. Por favor inicia sesión.');</script>";
        } else {
            echo "Error al registrar.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>