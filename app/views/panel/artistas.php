<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// 2. Seguridad: Redirigir usando HOST
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

// Consultas necesarias
$stmt_gen = $conexion->prepare("SELECT * FROM generos WHERE estatus_genero = 1");
$stmt_gen->execute();
$generos = $stmt_gen->fetchAll(PDO::FETCH_ASSOC);

$sql_users = "SELECT u.id_usuario, u.nombre_usuario, u.ap_usuario 
              FROM usuarios u 
              LEFT JOIN artistas a ON u.id_usuario = a.id_usuario 
              WHERE u.id_rol = 3 AND u.estatus_usuario = 1 AND a.id_artista IS NULL";
$stmt_users = $conexion->prepare($sql_users);
$stmt_users->execute();
$usuarios_disponibles = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

$artista_editar = null;
if (isset($_GET['editar_id'])) {
    $stmt = $conexion->prepare("SELECT * FROM artistas WHERE id_artista = :id");
    $stmt->bindParam(':id', $_GET['editar_id']);
    $stmt->execute();
    $artista_editar = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Listar Artistas (con imagen)
$sql_list = "SELECT a.*, g.nombre_genero, u.nombre_usuario 
             FROM artistas a 
             INNER JOIN generos g ON a.id_genero = g.id_genero
             INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
             WHERE a.estatus_artista = 1";
$stmt_list = $conexion->prepare($sql_list);
$stmt_list->execute();
$lista_artistas = $stmt_list->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Artistas - Admin</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/menu-lateral.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/artistas.css">
</head>
<body>

    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main>
        <h1>Gestión de Artistas</h1>

        <div class="formulario-caja">
            <h3><?php echo $artista_editar ? 'Editar Artista' : 'Registrar Nuevo Artista'; ?></h3>
            
            <form action="../../backend/panel/acc_artistas.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="<?php echo $artista_editar ? 'editar' : 'crear'; ?>">
                <?php if ($artista_editar): ?>
                    <input type="hidden" name="id_artista" value="<?php echo $artista_editar['id_artista']; ?>">
                <?php endif; ?>

                <label>Pseudónimo:</label>
                <input type="text" name="pseudonimo" required value="<?php echo $artista_editar ? $artista_editar['pseudonimo_artista'] : ''; ?>">

                <label>Nacionalidad:</label>
                <input type="text" name="nacionalidad" value="<?php echo $artista_editar ? $artista_editar['nacionalidad_artista'] : ''; ?>">

                <label>Biografía:</label>
                <textarea name="biografia" rows="3"><?php echo $artista_editar ? $artista_editar['biografia_artista'] : ''; ?></textarea>

                <label>Género Musical:</label>
                <select name="id_genero" required>
                    <option value="">-- Selecciona un Género --</option>
                    <?php foreach ($generos as $g): ?>
                        <option value="<?php echo $g['id_genero']; ?>" 
                            <?php if ($artista_editar && $artista_editar['id_genero'] == $g['id_genero']) echo 'selected'; ?>>
                            <?php echo $g['nombre_genero']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Foto de Perfil:</label>
                <input type="file" name="imagen" accept="image/*">

                <?php if (!$artista_editar): ?>
                    <label>Usuario Vinculado:</label>
                    <select name="id_usuario" required>
                        <option value="">-- Selecciona Usuario --</option>
                        <?php foreach ($usuarios_disponibles as $u): ?>
                            <option value="<?php echo $u['id_usuario']; ?>">
                                <?php echo $u['nombre_usuario'] . " " . $u['ap_usuario']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>

                <button type="submit" class="btn btn-guardar">
                    <?php echo $artista_editar ? 'Actualizar Datos' : 'Registrar Artista'; ?>
                </button>
            </form>
        </div>

        <h3>Artistas Registrados</h3>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Pseudónimo</th>
                    <th>Género</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_artistas as $a): ?>
                <tr>
                    <td>
                        <?php if (!empty($a['imagen_artista'])): ?>
                            <img src="<?php echo HOST . ltrim($a['imagen_artista'], '/'); ?>" class="img-artista">
                        <?php else: ?>
                            <span>Sin Foto</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $a['pseudonimo_artista']; ?></td>
                    <td><?php echo $a['nombre_genero']; ?></td>
                    <td><?php echo $a['nombre_usuario']; ?></td>
                    <td>
                        <a href="artistas.php?editar_id=<?php echo $a['id_artista']; ?>" class="btn btn-editar">Editar</a>
                        <a href="../../backend/panel/acc_artistas.php?accion=borrar&id=<?php echo $a['id_artista']; ?>" 
                           class="btn btn-borrar" onclick="return confirm('¿Borrar artista?');">Borrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>