<?php
session_start();
require_once '../../../config/conexion-bd.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: ../../backend/portal/login.php");
    exit();
}

// Cargar listas para los selects
$artistas = $conexion->query("SELECT * FROM artistas WHERE estatus_artista = 1")->fetchAll(PDO::FETCH_ASSOC);
$generos = $conexion->query("SELECT * FROM generos WHERE estatus_genero = 1")->fetchAll(PDO::FETCH_ASSOC);

// Listar Álbumes existentes
$sql_list = "SELECT al.*, ar.pseudonimo_artista, g.nombre_genero 
             FROM albumes al 
             INNER JOIN artistas ar ON al.id_artista = ar.id_artista
             LEFT JOIN generos g ON al.id_genero = g.id_genero
             WHERE al.estatus_album = 1";
$lista_albumes = $conexion->query($sql_list)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Álbumes - Admin</title>
    <link rel="stylesheet" href="../../../recursos/assets/css/root.css">
    <style>
        body { font-family: sans-serif; display: flex; }
        aside { width: 250px; background: #222; color: #fff; min-height: 100vh; padding: 20px; }
        aside a { display: block; color: #ccc; text-decoration: none; margin: 10px 0; padding: 10px; }
        aside a:hover { color: #fff; background: #444; }
        main { flex: 1; padding: 40px; }
        .formulario-caja { background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #ddd; }
        input, select, textarea { width: 100%; padding: 8px; margin: 5px 0 15px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; vertical-align: middle; }
        th { background-color: #333; color: white; }
        .portada-mini { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; }
        .btn { padding: 5px 10px; color: white; text-decoration: none; border-radius: 4px; }
        .btn-borrar { background: #e74c3c; }
        .btn-guardar { background: #2ecc71; border: none; padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>

    

    <main>
        <h1>Gestión de Álbumes</h1>

        <div class="formulario-caja">
            <h3>Registrar Nuevo Álbum</h3>
            
            <form action="../../backend/panel/acc_albumes.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="crear">

                <label>Título del Álbum:</label>
                <input type="text" name="titulo" required placeholder="Ej: Un Verano Sin Ti">

                <label>Artista:</label>
                <select name="id_artista" required>
                    <option value="">-- Selecciona Artista --</option>
                    <?php foreach ($artistas as $a): ?>
                        <option value="<?php echo $a['id_artista']; ?>"><?php echo $a['pseudonimo_artista']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Género Principal:</label>
                <select name="id_genero" required>
                    <?php foreach ($generos as $g): ?>
                        <option value="<?php echo $g['id_genero']; ?>"><?php echo $g['nombre_genero']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Fecha Lanzamiento:</label>
                <input type="date" name="fecha" required>

                <label>Descripción:</label>
                <textarea name="descripcion" rows="2"></textarea>

                <label>Portada (Imagen):</label>
                <input type="file" name="imagen" accept="image/*" required>

                <button type="submit" class="btn btn-guardar">Guardar Álbum</button>
            </form>
        </div>

        <h3>Álbumes Registrados</h3>
        <table>
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Título</th>
                    <th>Artista</th>
                    <th>Lanzamiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_albumes as $alb): ?>
                <tr>
                    <td>
                        <?php if ($alb['imagen_album']): ?>
                            <img src="../<?php echo $alb['imagen_album']; ?>" class="portada-mini">
                        <?php else: ?>
                            Sin foto
                        <?php endif; ?>
                    </td>
                    <td><?php echo $alb['titulo_album']; ?></td>
                    <td><?php echo $alb['pseudonimo_artista']; ?></td>
                    <td><?php echo $alb['fecha_lanzamiento_album']; ?></td>
                    <td>
                        <a href="../../backend/panel/acc_albumes.php?accion=borrar&id=<?php echo $alb['id_album']; ?>" 
                           class="btn btn-borrar"
                           onclick="return confirm('¿Eliminar álbum?');">Borrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

</body>
</html>