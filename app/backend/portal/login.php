<?php
session_start();
// Incluimos constantes para usar HOST en las redirecciones
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1. Buscar usuario por correo (AGREGADO: imagen_usuario)
    $sql = "SELECT id_usuario, nombre_usuario, password_usuario, id_rol, estatus_usuario, imagen_usuario 
            FROM usuarios WHERE correo_usuario = :email LIMIT 1";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Verificar contraseña (Bcrypt estándar)
        if (password_verify($password, $usuario['password_usuario'])) {
            
            // 3. Verificar si está activo (Estatus 1)
            if ($usuario['estatus_usuario'] == 1) {
                
                // 4. Crear variables de sesión
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre'] = $usuario['nombre_usuario'];
                $_SESSION['rol'] = $usuario['id_rol'];
                $_SESSION['imagen'] = $usuario['imagen_usuario']; // <--- Ahora sí funcionará porque está en el SELECT

                // 5. Redireccionar según rol (Usando HOST)
                // En tu SQL actual: 1 = Admin
                if ($usuario['id_rol'] == 1) {
                    header("Location: " . HOST . "app/views/panel/dashboard.php"); 
                } else {
                    header("Location: " . HOST . "index.php");
                }
                exit();

            } else {
                echo "<script>
                        alert('Tu cuenta está desactivada.');
                        window.location.href = '" . HOST . "app/views/portal/login.php';
                      </script>";
            }

        } else {
            echo "<script>
                    alert('Contraseña incorrecta.');
                    window.location.href = '" . HOST . "app/views/portal/login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Usuario no encontrado.');
                window.location.href = '" . HOST . "app/views/portal/login.php';
              </script>";
    }
}
?>