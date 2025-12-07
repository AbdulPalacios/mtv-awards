<?php
// 1. Incluir la conexión
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

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
        echo "<script>
                alert('El correo ya está registrado.');
                window.history.back();
              </script>";
        exit();
    }

    // --- NUEVO: Procesar IMAGEN DE PERFIL ---
    $ruta_imagen_bd = null; // Por defecto NULL si no sube nada

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        
        // 1. Obtener extensión y crear nombre único
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombre_archivo = time() . "_" . uniqid() . "." . $extension;
        
        // 2. Definir rutas
        // Ruta física para mover el archivo (subimos 3 niveles para llegar a la raíz)
        $carpeta_destino = "../../../recursos/assets/uploads/usuarios/";
        
        // Crear carpeta si no existe
        if (!file_exists($carpeta_destino)) {
            mkdir($carpeta_destino, 0777, true);
        }

        $ruta_fisica = $carpeta_destino . $nombre_archivo;
        
        // Ruta relativa para guardar en la BD (lo que usará el HTML)
        $ruta_imagen_bd = "recursos/assets/uploads/usuarios/" . $nombre_archivo;
        
        // 3. Mover el archivo del temporal al destino final
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica);
    }
    // ----------------------------------------

    // 3. Encriptar contraseña (Nunca guardar texto plano)
    // Usamos PASSWORD_DEFAULT que genera un hash seguro de 60 caracteres (cabe en tu varchar(64))
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    // 4. Valores por defecto
    $estatus = 1; // 1 = Admin
    $id_rol = 4;  //Rol 4 es Audiencia

    // 5. Insertar usuario
    try {
        // MODIFICADO: Se agregó 'imagen_usuario' en los campos y ':img' en los valores
        $sql_insert = "INSERT INTO usuarios (estatus_usuario, nombre_usuario, ap_usuario, am_usuario, sexo_usuario, correo_usuario, password_usuario, imagen_usuario, id_rol) 
                       VALUES (:estatus, :nombre, :ap, :am, :sexo, :email, :pass, :img, :rol)";
        
        $stmt = $conexion->prepare($sql_insert);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ap', $apPaterno);
        $stmt->bindParam(':am', $apMaterno);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass_hash);
        $stmt->bindParam(':img', $ruta_imagen_bd); // NUEVO: Vinculamos la ruta de la imagen
        $stmt->bindParam(':rol', $id_rol);

        if ($stmt->execute()) {
            // ÉXITO: Usamos HOST para redirigir al login
            echo "<script>
                    alert('Registro exitoso. Por favor inicia sesión.');
                    window.location.href = '" . HOST . "app/views/portal/login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al registrar.');
                    window.history.back();
                  </script>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>