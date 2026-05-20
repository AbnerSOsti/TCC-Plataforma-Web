<!DOCTYPE html>
<html lang="en">
<?php
    // Inicia a sessão para rastreamento de acessos
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>linguagens</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/selecionar.css">
    <script src="js/SalaGeral.js" defer></script>
   
</head>
<body>
   <?php
        include "./Controller/controller.php";

        $controller = new Controller();
        $controller->Selecionar_Curso();
    ?>

</body>
</html>