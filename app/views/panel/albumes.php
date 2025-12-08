<?php
session_start();
// 1. Incluir constantes y conexión
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// 2. Seguridad
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], [1, 2, 3])) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

$es_admin = ($_SESSION['rol'] == 1);
$mi_id_artista = null;

// Si NO es admin, averiguamos su ID de artista
if (!$es_admin) {
    $stmt = $conexion->prepare("SELECT id_artista FROM artistas WHERE id_usuario = :uid");
    $stmt->execute([':uid' => $_SESSION['id_usuario']]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($res) {
        $mi_id_artista = $res['id_artista'];
    } else {
        echo "<script>alert('Primero debes crear tu perfil de artista.'); window.location.href='artistas.php';</script>";
        exit();
    }
}

// Lógica para cargar datos si vamos a EDITAR (NUEVO)
$album_editar = null;
if (isset($_GET['editar_id'])) {
    $stmt_edit = $conexion->prepare("SELECT * FROM albumes WHERE id_album = :id");
    $stmt_edit->execute([':id' => $_GET['editar_id']]);
    $album_editar = $stmt_edit->fetch(PDO::FETCH_ASSOC);
}

// Cargar listas
$generos = $conexion->query("SELECT * FROM generos WHERE estatus_genero = 1")->fetchAll(PDO::FETCH_ASSOC);
if ($es_admin) {
    $artistas = $conexion->query("SELECT * FROM artistas WHERE estatus_artista = 1")->fetchAll(PDO::FETCH_ASSOC);
}

// Listar Álbumes existentes (Filtrado)
$sql_list = "SELECT al.*, ar.pseudonimo_artista, g.nombre_genero 
             FROM albumes al 
             INNER JOIN artistas ar ON al.id_artista = ar.id_artista
             LEFT JOIN generos g ON al.id_genero = g.id_genero
             WHERE al.estatus_album = 1";

if (!$es_admin) {
    $sql_list .= " AND al.id_artista = " . $mi_id_artista;
}

$lista_albumes = $conexion->query($sql_list)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Álbumes</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/menu-lateral.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/albumes.css">
    <style>
        .btn-editar { background-color: var(--btn-edit); color: black; margin-right: 5px; }
        .btn { text-decoration: none; padding: 8px 12px; border-radius: 4px; font-size: 0.8rem; font-weight: bold; display: inline-block; }
    </style>
</head>
<body>

    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main>
        <h1><?php echo $es_admin ? 'Gestión de Álbumes' : 'Mis Álbumes'; ?></h1>

        <div class="formulario-caja">
            <h3><?php echo $album_editar ? 'Editar Álbum' : 'Registrar Nuevo Álbum'; ?></h3>
            
            <form action="../../backend/panel/acc_albumes.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="accion" value="<?php echo $album_editar ? 'editar' : 'crear'; ?>">
                
                <?php if($album_editar): ?>
                    <input type="hidden" name="id_album" value="<?php echo $album_editar['id_album']; ?>">
                <?php endif; ?>

                <label>Título del Álbum:</label>
                <input type="text" name="titulo" required placeholder="Ej: Un Verano Sin Ti"
                       value="<?php echo $album_editar ? $album_editar['titulo_album'] : ''; ?>">

                <?php if ($es_admin): ?>
                    <?php if(!$album_editar): // Solo mostrar select si es nuevo o admin ?>
                    <label>Artista:</label>
                    <select name="id_artista" required>
                        <option value="">-- Selecciona Artista --</option>
                        <?php foreach ($artistas as $a): ?>
                            <option value="<?php echo $a['id_artista']; ?>"><?php echo $a['pseudonimo_artista']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php endif; ?>
                <?php else: ?>
                    <input type="hidden" name="id_artista" value="<?php echo $mi_id_artista; ?>">
                <?php endif; ?>

                <label>Género Principal:</label>
                <select name="id_genero" required>
                    <?php foreach ($generos as $g): ?>
                        <option value="<?php echo $g['id_genero']; ?>" 
                            <?php if($album_editar && $album_editar['id_genero'] == $g['id_genero']) echo 'selected'; ?>>
                            <?php echo $g['nombre_genero']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Fecha Lanzamiento:</label>
                <input type="date" name="fecha" required value="<?php echo $album_editar ? $album_editar['fecha_lanzamiento_album'] : ''; ?>">

                <label>Descripción:</label>
                <textarea name="descripcion" rows="2"><?php echo $album_editar ? $album_editar['descripcion_album'] : ''; ?></textarea>

                <label>Portada (Imagen):</label>
                <input type="file" name="imagen" accept="image/*" <?php echo $album_editar ? '' : 'required'; ?>>
                <?php if($album_editar && $album_editar['imagen_album']): ?>
                    <p style="font-size:0.8rem; color:#aaa;">Actual: <a href="#" style="color:cyan;">Ver imagen</a></p>
                <?php endif; ?>

                <button type="submit" class="btn btn-guardar">
                    <?php echo $album_editar ? 'Actualizar Álbum' : 'Guardar Álbum'; ?>
                </button>
                
                <?php if($album_editar): ?>
                    <a href="albumes.php" style="display:block; text-align:center; margin-top:10px; color:#aaa;">Cancelar Edición</a>
                <?php endif; ?>
            </form>
        </div>

        <h3><?php echo $es_admin ? 'Álbumes Registrados' : 'Mi Discografía'; ?></h3>
        <table>
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Título</th>
                    <?php if($es_admin): ?><th>Artista</th><?php endif; ?>
                    <th>Lanzamiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_albumes as $alb): ?>
                <tr>
                    <td>
                        <?php if ($alb['imagen_album']): ?>
                            <img src="<?php echo HOST . ltrim($alb['imagen_album'], '/'); ?>" class="portada-mini">
                        <?php else: ?>
                            Sin foto
                        <?php endif; ?>
                    </td>
                    <td><?php echo $alb['titulo_album']; ?></td>
                    <?php if($es_admin): ?>
                        <td><?php echo $alb['pseudonimo_artista']; ?></td>
                    <?php endif; ?>
                    <td><?php echo $alb['fecha_lanzamiento_album']; ?></td>
                    <td>
                        <a href="albumes.php?editar_id=<?php echo $alb['id_album']; ?>" class="btn btn-editar">Editar</a>
                        
                        <a href="../../backend/panel/acc_albumes.php?accion=borrar&id=<?php echo $alb['id_album']; ?>" 
                           class="btn btn-borrar"
                           onclick="return confirm('¿Eliminar álbum?');">Borrar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($lista_albumes)): ?>
                    <tr><td colspan="5">No hay álbumes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

</body>
</html>