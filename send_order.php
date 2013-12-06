<?php
    session_start();
    
    include 'database.php';
    
    if(!isset($_SESSION['user']))
    {
        header("Location: signin.php");
        exit();
    }
    
    if (!isset($_POST['table']))
    {
        header("Location: error.php");
        die();
    }
    
    $table = $_POST['table'];
    
    if (!isset($_SESSION['active_table']))
    {
        header("Location: error.php");
        die();
    }
    
    $active_table = $_SESSION['active_table'];
    
    if ($table != $active_table)
    {
        header("Location: error.php");
        die();
    }
    
    if (!isset($_SESSION['order']))
    {
        header("Location: error.php");
        die();
    }
    
    $order = $_SESSION['order'];
    
    add_order($table, $order);
    
    $_SESSION['order'] = array();
    unset($_SESSION['order']);
    
    