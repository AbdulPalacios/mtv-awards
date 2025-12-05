<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// 2. Seguridad: Redirigir usando HOST
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

// Cargas de listas (igual que antes)
$artistas = $conexion->query("SELECT * FROM artistas WHERE estatus_artista = 1")->fetchAll(PDO::FETCH_ASSOC);
$generos = $conexion->query("SELECT * FROM generos WHERE estatus_genero = 1")->fetchAll(PDO::FETCH_ASSOC);

// Listar Canciones (seleccionando imagen_cancion)
$sql_list = "SELECT c.*, a.pseudonimo_artista, g.nombre_genero 
             FROM canciones c 
             INNER JOIN artistas a ON c.id_artista = a.id_artista
             LEFT JOIN generos g ON c.id_genero = g.id_genero
             WHERE c.estatus_cancion = 1
             ORDER BY c.id_cancion DESC";
$lista_canciones = $conexion->query($sql_list)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Canciones - Admin</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <style>
        /* (Tus estilos previos se mantienen igual) */
        body { font-family: sans-serif; display: flex; }
        aside { width: 250px; background: #222; color: #fff; min-height: 100vh; padding: 20px; }
        aside a { display: block; color: #ccc; text-decoration: none; margin: 10px 0; padding: 10px; }
        aside a:hover { color: #fff; background: #444; }
        main { flex: 1; padding: 40px; }
        .formulario-caja { background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #ddd; }
        input, select { width: 100%; padding: 8px; margin: 5px 0 15px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; vertical-align: middle; }
        th { background-color: #333; color: white; }
        .btn { padding: 5px 10px; color: white; text-decoration: none; border-radius: 4px; }
        .btn-borrar { background: #e74c3c; }
        .btn-guardar { background: #2ecc71; border: none; padding: 10px 20px; cursor: pointer; }
        
        /* Nuevo estilo para la miniatura */
        .img-cancion { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>

    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main>
        <h1>Gestión de Canciones</h1>

        <div class="formulario-caja">
            <h3>Registrar Nueva Canción</h3>
            
            <form action="../../backend/panel/acc_canciones.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="crear">

                <label>Nombre de la Canción:</label>
                <input type="text" name="nombre" required placeholder="Ej: Monaco">

                <label>Artista:</label>
                <select name="id_artista" required>
                    <option value="">-- Selecciona Artista --</option>
                    <?php foreach ($artistas as $a): ?>
                        <option value="<?php echo $a['id_artista']; ?>"><?php echo $a['pseudonimo_artista']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Género:</label>
                <select name="id_genero" required>
                    <?php foreach ($generos as $g): ?>
                        <option value="<?php echo $g['id_genero']; ?>"><?php echo $g['nombre_genero']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Duración (HH:MM:SS):</label>
                <input type="text" name="duracion" value="00:03:00">

                <label>Fecha de Lanzamiento:</label>
                <input type="date" name="fecha" required>

                <label>Portada de la Canción (Imagen):</label>
                <input type="file" name="imagen" accept="image/*" required>

                <label>Link Video YouTube (Opcional):</label>
                <input type="text" name="video_url" placeholder="https://youtube.com/...">

                <button type="submit" class="btn btn-guardar">Guardar Canción</button>
            </form>
        </div>

        <h3>Biblioteca de Canciones</h3>
        <table>
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Nombre</th>
                    <th>Artista</th>
                    <th>Género</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_canciones as $c): ?>
                <tr>
                    <td>
                        <?php if ($c['imagen_cancion']): ?>
                            <img src="<?php echo HOST . ltrim($c['imagen_cancion'], '/'); ?>" class="img-cancion" alt="Portada">
                        <?php else: ?>
                            <span>Sin foto</span>
                        <?php endif; ?>
                    </td>
                    
                    <td><?php echo $c['nombre_cancion']; ?></td>
                    <td><?php echo $c['pseudonimo_artista']; ?></td>
                    <td><?php echo $c['nombre_genero']; ?></td>
                    <td>
                        <a href="../../backend/panel/acc_canciones.php?accion=borrar&id=<?php echo $c['id_cancion']; ?>" 
                           class="btn btn-borrar"
                           onclick="return confirm('¿Eliminar esta canción?');">Borrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>

</body>
</html>