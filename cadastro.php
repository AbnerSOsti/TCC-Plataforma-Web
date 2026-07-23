 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cadastro_usuario.css">

    <title>Cadastro</title>
</head>
<body>
    <div class="container">
    <?php
        include "./Controller/controller.php";

        $controller = new Controller();
        $controller->Cadastro();
        ?>
    </div>

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