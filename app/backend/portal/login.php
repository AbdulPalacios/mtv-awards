<?php
session_start();
require_once '../../config/conexion-bd.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1. Buscar usuario por correo
    $sql = "SELECT id_usuario, nombre_usuario, password_usuario, id_rol, estatus_usuario 
            FROM usuarios WHERE correo_usuario = :email LIMIT 1";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Verificar contraseña encriptada
        if (password_verify($password, $usuario['password_usuario'])) {
            
            // 3. Verificar si está activo (estatus 1)
            if ($usuario['estatus_usuario'] == 1) {
                
                // 4. Crear variables de sesión
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre'] = $usuario['nombre_usuario'];
                $_SESSION['rol'] = $usuario['id_rol'];

                // 5. Redireccionar según rol
                if ($usuario['id_rol'] == 1) {
                    // Si es Admin, ir al panel de admin
                    header("Location: ../../admin/index.php"); 
                } else {
                    // Si es usuario normal, ir al home o a votar
                    header("Location: ../../index.php");
                }
                exit();

            } else {
                echo "<script>alert('Tu cuenta está desactivada.');</script>";
            }

        } else {
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado.');</script>";
    }
}
?>