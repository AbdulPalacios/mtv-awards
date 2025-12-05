<?php
session_start();
require_once '../../../config/conexion-bd.php';
require_once '../../../config/constantes.php';

// 2. Seguridad: Redirigir usando HOST
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header("Location: " . HOST . "app/views/portal/login.php");
    exit();
}

// 1. Cargar Categorías Activas
$categorias = $conexion->query("SELECT * FROM categorias_nominaciones WHERE estatus_categoria_nominacion = 1 ORDER BY id_categoria_nominacion DESC")->fetchAll(PDO::FETCH_ASSOC);

// 2. Cargar TODAS las opciones posibles para los selects (Artistas, Álbumes, Canciones)
$artistas = $conexion->query("SELECT id_artista, pseudonimo_artista FROM artistas WHERE estatus_artista=1")->fetchAll(PDO::FETCH_ASSOC);
$albumes  = $conexion->query("SELECT id_album, titulo_album FROM albumes WHERE estatus_album=1")->fetchAll(PDO::FETCH_ASSOC);
$canciones = $conexion->query("SELECT id_cancion, nombre_cancion FROM canciones WHERE estatus_cancion=1")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nominaciones - Admin</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>recursos/assets/css/root.css">
    <style>
        body { font-family: sans-serif; display: flex; background: #f0f0f0; }
        aside { width: 250px; background: #222; color: #fff; min-height: 100vh; padding: 20px; flex-shrink: 0;}
        aside a { display: block; color: #ccc; text-decoration: none; margin: 10px 0; padding: 10px; }
        aside a:hover { color: #fff; background: #444; }
        
        main { flex: 1; padding: 30px; overflow-y: auto; }

        .panel-crear { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 30px; }
        
        .categoria-card { 
            background: white; border-radius: 8px; padding: 20px; margin-bottom: 20px; border-left: 5px solid #e1306c; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .header-cat { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px;}
        .badge { background: #333; color: white; padding: 3px 8px; border-radius: 10px; font-size: 0.8rem; }
        
        /* Formulario Inline dentro de la tarjeta */
        .form-nominar { display: flex; gap: 10px; background: #f9f9f9; padding: 10px; border-radius: 5px; }
        .form-nominar select { flex: 1; padding: 8px; }
        .btn-add { background: #2ecc71; color: white; border: none; padding: 0 15px; cursor: pointer; border-radius: 4px;}
        
        /* Lista de nominados */
        .lista-nominados { list-style: none; padding: 0; margin-top: 15px; display: flex; flex-wrap: wrap; gap: 10px;}
        .nominado-item { background: #eee; padding: 5px 15px; border-radius: 20px; display: flex; align-items: center; gap: 10px; font-size: 0.9rem;}
        .btn-x { color: red; text-decoration: none; font-weight: bold; }

        input, select { padding: 8px; margin: 5px 0; }
        .btn-main { background: #e1306c; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>

    <?php include '../../../recursos/recursos_panel/menu_lateral.php'; ?>

    <main>
        <h1>Centro de Nominaciones</h1>

        <div class="panel-crear">
            <h3>Crear Nueva Categoría de Premios</h3>
            <form action="../../backend/panel/acc_nominaciones.php" method="POST">
                <input type="hidden" name="accion" value="crear_categoria">
                
                <div style="display: flex; gap: 20px;">
                    <div style="flex: 2;">
                        <label>Nombre del Premio:</label><br>
                        <input type="text" name="nombre" required placeholder="Ej: Mejor Artista Urbano" style="width: 100%;">
                    </div>
                    <div style="flex: 1;">
                        <label>Tipo de Nominado:</label><br>
                        <select name="tipo" required style="width: 100%;">
                            <option value="1">Artista</option>
                            <option value="2">Álbum</option>
                            <option value="3">Canción</option>
                        </select>
                    </div>
                    <div style="flex: 1;">
                        <label>Fecha Límite Votación:</label><br>
                        <input type="date" name="fecha_limite" required style="width: 100%;">
                    </div>
                </div>
                <br>
                <button type="submit" class="btn-main">Crear Categoría</button>
            </form>
        </div>

        <h2>Categorías Activas</h2>
        
        <?php foreach ($categorias as $cat): ?>
            <?php 
                $tipo_txt = "";
                if($cat['tipo_categoria_nominacion'] == 1) $tipo_txt = "Artistas";
                if($cat['tipo_categoria_nominacion'] == 2) $tipo_txt = "Álbumes";
                if($cat['tipo_categoria_nominacion'] == 3) $tipo_txt = "Canciones";
            ?>
            
            <div class="categoria-card">
                <div class="header-cat">
                    <div>
                        <strong style="font-size: 1.2rem;"><?php echo $cat['nombre_categoria_nominacion']; ?></strong>
                        <span class="badge"><?php echo $tipo_txt; ?></span>
                    </div>
                    <a href="../../backend/panel/acc_nominaciones.php?accion=borrar_cat&id=<?php echo $cat['id_categoria_nominacion']; ?>" 
                       style="color: red; font-size: 0.8rem;" onclick="return confirm('¿Borrar categoría?')">Eliminar</a>
                </div>

                <form class="form-nominar" action="../../backend/panel/acc_nominaciones.php" method="POST">
                    <input type="hidden" name="accion" value="agregar_nominado">
                    <input type="hidden" name="id_categoria" value="<?php echo $cat['id_categoria_nominacion']; ?>">
                    <input type="hidden" name="tipo_categoria" value="<?php echo $cat['tipo_categoria_nominacion']; ?>">

                    <select name="id_item" required>
                        <option value="">-- Seleccionar nominado --</option>
                        
                        <?php if($cat['tipo_categoria_nominacion'] == 1): // Artistas ?>
                            <?php foreach($artistas as $a): ?>
                                <option value="<?php echo $a['id_artista']; ?>"><?php echo $a['pseudonimo_artista']; ?></option>
                            <?php endforeach; ?>
                        
                        <?php elseif($cat['tipo_categoria_nominacion'] == 2): // Álbumes ?>
                            <?php foreach($albumes as $al): ?>
                                <option value="<?php echo $al['id_album']; ?>"><?php echo $al['titulo_album']; ?></option>
                            <?php endforeach; ?>

                        <?php elseif($cat['tipo_categoria_nominacion'] == 3): // Canciones ?>
                            <?php foreach($canciones as $c): ?>
                                <option value="<?php echo $c['id_cancion']; ?>"><?php echo $c['nombre_cancion']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    
                    <button type="submit" class="btn-add">Agregar Nominado</button>
                </form>

                <ul class="lista-nominados">
                    <?php 
                        // Consulta rápida para traer los nominados de ESTA categoría
                        // (Es un poco ineficiente hacer queries dentro de un loop, pero para este nivel es aceptable y claro)
                        $sql_noms = "SELECT n.id_nominacion, 
                                            ar.pseudonimo_artista, 
                                            al.titulo_album, 
                                            cn.nombre_cancion 
                                     FROM nominaciones n
                                     LEFT JOIN artistas ar ON n.id_artista = ar.id_artista
                                     LEFT JOIN albumes al ON n.id_album = al.id_album
                                     LEFT JOIN canciones cn ON n.id_cancion = cn.id_cancion
                                     WHERE n.id_categoria_nominacion = " . $cat['id_categoria_nominacion'];
                        $noms = $conexion->query($sql_noms)->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php foreach($noms as $n): ?>
                        <li class="nominado-item">
                            <?php 
                                if($n['pseudonimo_artista']) echo "👤 " . $n['pseudonimo_artista'];
                                if($n['titulo_album']) echo "💿 " . $n['titulo_album'];
                                if($n['nombre_cancion']) echo "🎵 " . $n['nombre_cancion'];
                            ?>
                            <a href="../../backend/panel/acc_nominaciones.php?accion=borrar_nom&id=<?php echo $n['id_nominacion']; ?>" class="btn-x">×</a>
                        </li>
                    <?php endforeach; ?>
                    
                    <?php if(empty($noms)): ?>
                        <span style="color: #999; font-size: 0.9rem; margin-top: 5px;">Sin nominados aún.</span>
                    <?php endif; ?>
                </ul>

            </div>
        <?php endforeach; ?>

    </main>

</body>
</html>