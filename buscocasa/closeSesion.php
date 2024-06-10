<?php
session_start();
if (!isset($_SESSION["login"]) || !$_SESSION["nombre"]) {
    header("Location: index.php");
}
session_destroy();
header("Location: admin.php");
?>