<?php
session_start();
require_once '../config/conexion-bd.php';

// Seguridad: Solo Admins
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../login.php");
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
    <link rel="stylesheet" href="../recursos/assets/css/root.css">
    <style>
        /* Estilos rápidos para el panel */
        body { font-family: sans-serif; display: flex; }
        aside { width: 250px; background: #222; color: #fff; min-height: 100vh; padding: 20px; }
        aside a { display: block; color: #ccc; text-decoration: none; margin: 10px 0; padding: 10px; }
        aside a:hover { color: #fff; background: #444; }
        main { flex: 1; padding: 40px; }
        
        .formulario-caja { background: #f4f4f4; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #333; color: white; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; color: white; font-size: 0.9rem; }
        .btn-editar { background-color: #f39c12; }
        .btn-borrar { background-color: #e74c3c; }
        .btn-guardar { background-color: #2ecc71; border: none; padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>

    <aside>
        <h3>Admin Panel</h3>
        <p>Usuario: <?php echo $_SESSION['nombre']; ?></p>
        <hr>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="generos.php" style="color: white; font-weight: bold;">Gestionar Géneros</a>
            <a href="artistas.php">Gestionar Artistas</a>
            <a href="albumes.php">Gestionar Álbumes</a>
            <a href="canciones.php">Gestionar Canciones</a>
            <a href="nominaciones.php">Crear Nominaciones</a>
            <hr>
            <a href="../actions/public_actions/logout.php">Cerrar Sesión</a>
        </nav>
    </aside>

    <main>
        <h1>Gestión de Géneros Musicales</h1>

        <div class="formulario-caja">
            <h3><?php echo $genero_editar ? 'Editar Género' : 'Agregar Nuevo Género'; ?></h3>
            
            <form action="../actions/admin_actions/acc_generos.php" method="POST">
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
                        
                        <a href="../actions/admin_actions/acc_generos.php?accion=borrar&id=<?php echo $g['id_genero']; ?>" 
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