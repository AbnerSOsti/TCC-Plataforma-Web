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
    <title>Inicio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modulos.css">
    <link rel="stylesheet" href="css/homepage.css">
   
</head>
<body>
   <?php
        include "./Controller/controller.php";

        $controller = new Controller();
        $controller->Index();
    ?>

</body>
</html>
<script>
    window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    // Se a página rolar mais de 20px para baixo, adiciona a classe, senão remove
    if (window.scrollY > 20) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
</script>