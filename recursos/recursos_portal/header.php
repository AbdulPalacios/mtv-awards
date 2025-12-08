<?php 
require_once __DIR__ . '/../../config/constantes.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="navbar">
<div class="navbar-content">
    <div class="navbar-left">
        <div class="logo">
            <a href="<?php echo HOST; ?>index.php">
                <img src="<?php echo HOST;?>recursos/assets/img/mtv-icon.svg" alt="Logo" class="nav-icon">
            </a>
        </div> 
        <nav class="nav-links">
            <a href="<?php echo HOST; ?>index.php">Home</a>
            <a href="<?php echo HOST; ?>app/views/portal/ranking.php">Ranking en Vivo</a>
            <a href="https://www.mtv.com/series/all-content">Browse</a>
            <div class="dropdown">
                <a href="#">Fan Favorites <span class="dropdown-arrow">▼</span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">The challenge</a></li>
                    <li><a href="#">Jersey Shore</a></li>
                </ul>
            </div>
        </nav>
    </div>
    
    <div class="navbar-right" style="display: flex; gap: 15px; align-items: center;">
        
        <?php if(isset($_SESSION['id_usuario'])): ?>
            
            <?php 
                $foto_perfil = "https://ui-avatars.com/api/?name=" . urlencode($_SESSION['nombre']) . "&background=random&color=fff";
                if (!empty($_SESSION['imagen'])) {
                    $foto_perfil = HOST . ltrim($_SESSION['imagen'], '/');
                }
            ?>

            <a href="<?php echo HOST; ?>app/views/portal/perfil.php" title="Ir a Mi Perfil">
                <img src="<?php echo $foto_perfil; ?>" alt="Perfil" class="user-avatar">
            </a>

            <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2): ?>
                <a href="<?php echo HOST; ?>app/views/panel/dashboard.php" class="paramount-btn" style="background-color: var(--neon-cyan); color: black;">
                    Panel
                </a>
            <?php endif; ?>

            <a href="<?php echo HOST; ?>app/backend/portal/logout.php" class="paramount-btn">
                Salir
            </a>

        <?php else: ?>
            <a href="<?php echo HOST; ?>app/views/portal/login.php" class="paramount-btn">Iniciar sesión</a>
        <?php endif; ?>
        
    </div>
</div>
</header>