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
        header("Location: error.php?error_code=1100");
        die();
    }
    
    $table = $_POST['table'];
    
    if (!isset($_SESSION['active_table']))
    {
        header("Location: error.php?error_code=1101");
        die();
    }
    
    $active_table = $_SESSION['active_table'];
    
    if ($table != $active_table)
    {
        header("Location: error.php?error_code=1102");
        die();
    }
    
    if (!isset($_SESSION['order']))
    {
        header("Location: error.php?error_code=1103");
        die();
    }
    
    $order = $_SESSION['order'];
    
    add_order($table, $order);
    
    $_SESSION['order'] = array();
    unset($_SESSION['order']);
    
    header("Location: order.php?table=".$table);
    
    