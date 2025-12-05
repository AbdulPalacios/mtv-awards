<?php
session_start();

// 1. Incluimos las constantes para poder usar HOST
require_once '../../../config/constantes.php';

// 2. Destruimos la sesión
session_unset();
session_destroy();

// 3. Redirigimos al Login (Vista) usando la ruta absoluta segura
header("Location: " . HOST . "app/views/portal/login.php");
exit();
?>