<?php
    session_start();
    
    include 'database.php';
    
    if(!isset($_SESSION['user']))
    {
        header("Location: signin.php");
        exit();
    }
    
    if (!isset($_POST['plate']))
        die('No hay codigo de plato');
   
    $plate = $_POST['plate'];
    
    if (!isset($_POST['value']))
        die('No hay valor');
        
    $value = $_POST['value'];
    
    if (!isset($_SESSION['order']))
        $order = array();
    else
        $order = $_SESSION['order'];
        
    if (!isset($order[$plate]))
        $order[$plate] = 0;
        
    $order[$plate] += $value;
    
    if ($order[$plate] < 0)
        $order[$plate] = 0;
        
    $_SESSION['order'] = $order;

    echo $order[$plate];