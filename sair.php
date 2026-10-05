<?php
        session_start();
        unset($_SESSION['login'], $_SESSION['id_usuario'], $_SESSION['nome_usuario'], $_SESSION['email_usuario'], $_SESSION['tipo_usuario']);
        session_destroy();
        header("Location:index.php");
        exit();
?>