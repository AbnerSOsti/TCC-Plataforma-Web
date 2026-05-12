<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/recuperarsenha.css">
</head>
<body>
    <div class="container">
        <?php 
        include "./Controller/controller.php";
        
        $controller = new Controller();
        $controller->NovaSenha();

        ?>
    </div>
</body>
</html>