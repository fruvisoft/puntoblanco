<?php
    session_start();

    if(isset($_SESSION['user']))
    {
        header("Location: tables.php");
        exit();
    }
    else
    {
        header("Location: signin.php");
        exit();
    }
