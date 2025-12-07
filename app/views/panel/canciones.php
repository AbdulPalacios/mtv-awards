<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// 2. Seguridad
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], [1, 2, 3])) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

$es_admin = ($_SESSION['rol'] == 1);
$mi_id_artista = null;

if (!$es_admin) {
    $stmt = $conexion->prepare("SELECT id_artista FROM artistas WHERE id_usuario = :uid");
    $stmt->execute([':uid' => $_SESSION['id_usuario']]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res) {
        $mi_id_artista = $res['id_artista'];
    } else {
        echo "<script>alert('Crea tu perfil de artista primero.'); window.location.href='artistas.php';</script>";
        exit();
    }
}

// Cargas de listas
if ($es_admin) {
    $artistas = $conexion->query("SELECT * FROM artistas WHERE estatus_artista = 1")->fetchAll(PDO::FETCH_ASSOC);
}
$generos = $conexion->query("SELECT * FROM generos WHERE estatus_genero = 1")->fetchAll(PDO::FETCH_ASSOC);

// Listar Canciones
$sql_list = "SELECT c.*, a.pseudonimo_artista, g.nombre_genero 
             FROM canciones c 
             INNER JOIN artistas a ON c.id_artista = a.id_artista
             LEFT JOIN generos g ON c.id_genero = g.id_genero
             WHERE c.estatus_cancion = 1";

if (!$es_admin) {
    $sql_list .= " AND c.id_artista = " . $mi_id_artista;
}

$sql_list .= " ORDER BY c.id_cancion DESC";
$lista_canciones = $conexion->query($sql_list)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Canciones</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/menu-lateral.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/canciones.css">
</head>
<body>

    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main>
        <h1><?php echo $es_admin ? 'Gestión de Canciones' : 'Mis Canciones'; ?></h1>

        <div class="formulario-caja">
            <h3>Registrar Nueva Canción</h3>
            
            <form action="../../backend/panel/acc_canciones.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="crear">

                <label>Nombre de la Canción:</label>
                <input type="text" name="nombre" required placeholder="Ej: Monaco">

                <?php if ($es_admin): ?>
                    <label>Artista:</label>
                    <select name="id_artista" required>
                        <option value="">-- Selecciona Artista --</option>
                        <?php foreach ($artistas as $a): ?>
                            <option value="<?php echo $a['id_artista']; ?>"><?php echo $a['pseudonimo_artista']; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <input type="hidden" name="id_artista" value="<?php echo $mi_id_artista; ?>">
                <?php endif; ?>

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

                <label>Archivo de Audio (MP3):</label>
                <input type="file" name="audio" accept="audio/mpeg, audio/mp3">

                <label>Link Video YouTube (Opcional):</label>
                <input type="text" name="video_url" placeholder="https://youtube.com/...">

                <button type="submit" class="btn btn-guardar">Guardar Canción</button>
            </form>
        </div>

        <h3><?php echo $es_admin ? 'Biblioteca de Canciones' : 'Mis Pistas'; ?></h3>
        <table>
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Nombre</th>
                    <?php if($es_admin): ?><th>Artista</th><?php endif; ?>
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
                    <?php if($es_admin): ?>
                        <td><?php echo $c['pseudonimo_artista']; ?></td>
                    <?php endif; ?>
                    <td><?php echo $c['nombre_genero']; ?></td>
                    <td>
                        <a href="../../backend/panel/acc_canciones.php?accion=borrar&id=<?php echo $c['id_cancion']; ?>" 
                           class="btn btn-borrar"
                           onclick="return confirm('¿Eliminar esta canción?');">Borrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($lista_canciones)): ?>
                    <tr><td colspan="5">No hay canciones registradas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

    </main>

</body>
</html>