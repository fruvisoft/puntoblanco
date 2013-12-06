<?php
    session_start();
    
    include 'database.php';
    
    if(!isset($_SESSION['user']))
    {
        header("Location: signin.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Punto Blanco</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="base.css" rel="stylesheet"> -->
    <link href="tables.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

    <?php
        $tables = get_tables();
    
        for ($i = 0; $i < count($tables); $i++)
        {
          echo '<a class="btn btn-default fruvi-table fruvi-table-' . $tables[$i]['EstMesa'] . '" href="order.php?table=' . $tables[$i]['NumMesa'] . '">' . PHP_EOL;
          echo 'Mesa <br />' . PHP_EOL;
          echo '<span class="fruvi-table-number"> ' . $tables[$i]['NumMesa'] . '</span>' . PHP_EOL;
          echo '</a>' . PHP_EOL;
        }
    ?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>