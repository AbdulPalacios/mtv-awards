<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// Solo Admin (Rol 1)
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: " . HOST . "index.php");
    exit();
}

// Obtener lista de roles para el select
$roles = $conexion->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);

// Obtener lista de usuarios
$usuarios = $conexion->query("SELECT u.*, r.rol FROM usuarios u INNER JOIN roles r ON u.id_rol = r.id_rol")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/menu-lateral.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/artistas.css"> </head>
<body>
    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main>
        <h1>Gestión de Usuarios</h1>

        <div class="formulario-caja">
            <h3>Registrar Nuevo Usuario (Staff)</h3>
            <form action="../../backend/panel/acc_usuarios.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="crear">

                <label>Nombre:</label>
                <input type="text" name="nombre" required>

                <div style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Ap. Paterno:</label>
                        <input type="text" name="ap_paterno" required>
                    </div>
                    <div style="flex:1;">
                        <label>Ap. Materno:</label>
                        <input type="text" name="ap_materno">
                    </div>
                </div>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <label>Rol:</label>
                <select name="id_rol" required>
                    <option value="">-- Seleccionar Rol --</option>
                    <?php foreach($roles as $r): ?>
                        <option value="<?php echo $r['id_rol']; ?>"><?php echo $r['rol']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Foto (Opcional):</label>
                <input type="file" name="imagen">

                <button type="submit" class="btn btn-guardar">Crear Usuario</button>
            </form>
        </div>

        <h3>Usuarios Registrados</h3>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $u): ?>
                <tr>
                    <td>
                        <?php if($u['imagen_usuario']): ?>
                            <img src="<?php echo HOST . ltrim($u['imagen_usuario'], '/'); ?>" class="img-artista" style="width:40px; height:40px;">
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $u['nombre_usuario'] . ' ' . $u['ap_usuario']; ?></td>
                    <td><?php echo $u['correo_usuario']; ?></td>
                    <td>
                        <span style="padding: 3px 8px; border-radius: 4px; font-size: 0.8rem; 
                            background-color: <?php echo ($u['id_rol']==1)?'var(--neon-pink)':(($u['id_rol']==2)?'var(--neon-cyan)':'#555'); ?>; 
                            color: black; font-weight: bold;">
                            <?php echo $u['rol']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="../../backend/panel/acc_usuarios.php?accion=borrar&id=<?php echo $u['id_usuario']; ?>" 
                           class="btn btn-borrar" onclick="return confirm('¿Eliminar usuario?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>