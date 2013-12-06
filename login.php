<?php
    session_start();

    include 'database.php';

    if(isset($_SESSION['user']))
    {
        header(' Location: tables.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = get_user($username);

        if (!$user)
        {
            // no existe el usuario
            header("Location: error.php?error_code=1001");
            die();
        }

        if ($user['ClaPer'] != $password)
        {
            // contraseña incorrecta
            header("Location: error.php?error_code=1002");
            die();
        }

        if ($user['CargoPer'] != 'M')
        {
            // no es mozo
            header("Location: error.php?error_code=1003");
            die();
        }

        $_SESSION['user'] = $username;

        header("Location: tables.php");
        exit();
    }

    header("Location: signin.php");
    exit();
