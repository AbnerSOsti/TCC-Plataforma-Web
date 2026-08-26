<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: admin.php');
    exit();
}

$tipo = isset($_SESSION['tipo_usuario']) ? strtoupper((string) $_SESSION['tipo_usuario']) : '';

    if ($tipo !== 'ADMIN') {
    header('Location: sala.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="js/dashboard.js" defer></script>
</head>
<body>
    <div class="container">
        <?php 
        include "./Controller/controller.php";
        
        $controller = new Controller();
        $controller->Dashboard();

        ?>
    </div>
</body>
</html>