<?php
        session_start();
        unset($_SESSION['login'],$_SESSION['nome_usuario'] );
        session_destroy();
        header("Location:index.php");
        exit();
?>