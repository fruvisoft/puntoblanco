<?php
    session_start();
    
    include 'database.php';
    
    if(!isset($_SESSION['user']))
    {
        header("Location: signin.php");
        exit();
    }
    
    if(!isset($_GET['table']))
    {
        header("Location: tables.php");
        exit();
    }
    
    $table = $_GET['table'];
    
    if (isset($_SESSION['active_table']) && $_SESSION['active_table'] != $table)
    {
        $_SESSION['order'] = array();
        unset($_SESSION['order']);
    }
    
    $_SESSION['active_table'] = $table;
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
    <link href="base.css" rel="stylesheet">

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
    
    <div class="panel panel-info">
    <!-- Default panel contents -->
      <div class="panel-heading"><strong><?php echo 'Mesa: ' . $table ?></strong></div>
    
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Uni.</th>
          <th>Precio Total</th>
        </tr>
      </thead>
      
      <tbody>
        <?php
            $order = get_order($table);
            
            if ($order)
            {
                for ($i = 0; $i < count($order); $i++)
                {
                    echo '<tr>' . PHP_EOL;
                    echo '<td>' . ($i+1) . '</td>' . PHP_EOL;
                    echo '<td>' . $order[$i]['NomPro'] . '</td>' . PHP_EOL;
                    echo '<td>' . $order[$i]['Cant'] . '</td>' . PHP_EOL;
                    echo '<td>' . $order[$i]['PrecioPro'] . '</td>' . PHP_EOL;
                    echo '<td>' . $order[$i]['PrecioPro'] * $order[$i]['Cant'] . '</td>' . PHP_EOL;
                    echo '</tr>' . PHP_EOL;
                }
            }
            else
            {
                echo '<tr> <td col-span="5"> No hay pedidos para esta mesa </td> </tr>' . PHP_EOL;
            }
        ?>
      </tbody>
    </table>
    
    </div>
    
    <a type="button" class="btn btn-default" href="plates.php?table=<?php echo $table; ?>">Agregar</button>
    <a type="button" class="btn btn-default" href="tables.php">Regresar</a>
    <a type="button" class="btn btn-primary" href="#">Enviar</a>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>