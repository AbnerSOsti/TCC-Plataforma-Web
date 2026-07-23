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
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login_usuario.css">
   
</head>
<body>
   <?php
        include "./Controller/controller.php";

        $controller = new Controller();
        $controller->Login();
    ?>

</body>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('senha_usuario');
        const toggleButton = document.querySelector('.toggle-password');
        const eyeIcon = toggleButton.querySelector('.lucide-eye-icon');
        const eyeOffIcon = toggleButton.querySelector('.lucide-eye-off-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOffIcon.style.display = 'inline';
        } else {
            passwordInput.type = 'password';
            eyeIcon.style.display = 'inline';
            eyeOffIcon.style.display = 'none';
        }
    }
</script>
</html>