<?php
session_start();

// 1. Validar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit();
}

include("../db/db.php");

// 2. Si necesitas consultar más datos del usuario en la BD, puedes hacerlo aquí

// 3. Llamar a la vista para mostrar la interfaz
include("../views/mi_perfil.php");
?>