<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// 2. Seguridad: Redirigir usando HOST
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

// Lógica para cargar datos si vamos a EDITAR
$genero_editar = null;
if (isset($_GET['editar_id'])) {
    $stmt = $conexion->prepare("SELECT * FROM generos WHERE id_genero = :id");
    $stmt->bindParam(':id', $_GET['editar_id']);
    $stmt->execute();
    $genero_editar = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Lógica para LISTAR todos los géneros activos
$stmt_lista = $conexion->prepare("SELECT * FROM generos WHERE estatus_genero = 1 ORDER BY id_genero DESC");
$stmt_lista->execute();
$lista_generos = $stmt_lista->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Géneros - Admin</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/menu-lateral.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/generos.css">
</head>
<body>

    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main>
        <h1>Gestión de Géneros Musicales</h1>

        <div class="formulario-caja">
            <h3><?php echo $genero_editar ? 'Editar Género' : 'Agregar Nuevo Género'; ?></h3>
            
            <form action="../../backend/panel/acc_generos.php" method="POST">
                <input type="hidden" name="accion" value="<?php echo $genero_editar ? 'editar' : 'crear'; ?>">
                
                <?php if ($genero_editar): ?>
                    <input type="hidden" name="id" value="<?php echo $genero_editar['id_genero']; ?>">
                <?php endif; ?>

                <label>Nombre del Género:</label>
                <input type="text" name="nombre" required 
                       value="<?php echo $genero_editar ? $genero_editar['nombre_genero'] : ''; ?>" 
                       placeholder="Ej: Pop, Rock, Urbano...">

                <button type="submit" class="btn btn-guardar">
                    <?php echo $genero_editar ? 'Actualizar Género' : 'Guardar Género'; ?>
                </button>
                
                <?php if ($genero_editar): ?>
                    <a href="generos.php" style="margin-left: 10px; color: #555;">Cancelar</a>
                <?php endif; ?>
            </form>
        </div>

        <h3>Listado de Géneros</h3>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_generos as $g): ?>
                <tr>
                    <td><?php echo $g['nombre_genero']; ?></td>
                    <td>
                        <a href="generos.php?editar_id=<?php echo $g['id_genero']; ?>" class="btn btn-editar">Editar</a>
                        
                        <a href="../../backend/panel/acc_generos.php?accion=borrar&id=<?php echo $g['id_genero']; ?>" 
                           class="btn btn-borrar" 
                           onclick="return confirm('¿Seguro que deseas eliminar este género?');">
                           Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>

                <?php if (empty($lista_generos)): ?>
                    <tr><td colspan="3">No hay géneros registrados aún.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

    </main>

</body>
</html>