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

    <div id="main" class="container">
    
    <div class="panel panel-info">
    <!-- Default panel contents -->
      <div class="panel-heading"><strong><?php echo 'Mesa: ' . $table ?></strong></div>
    
    <table class="table">
      <thead>
        <tr>
          <th>Tipo</th>
          <th>Producto</th>
          <th>Precio Uni.</th>
          <th>Cant.</th>
          <th>+1</th>
          <th>-1</th>
          <th>Imagen</th>
        </tr>
      </thead>
      
      <tbody>
        <?php
            $groups = get_groups();
            
            if ($groups)
            {
                for ($i = 0; $i < count($groups); $i++)
                {
                    $group = $groups[$i];
                    
                    $plates = get_plates_by_group($group['CodGru']);
                    
                    for ($j = 0; $j < count($plates); $j++)
                    {
                        $cant = 0;
                        
                        if (isset($_SESSION['order']) && isset($_SESSION['order'][$plates[$j]['CodPro']]))
                            $cant = $_SESSION['order'][$plates[$j]['CodPro']];
                        
                        echo '<tr id="plate-'.$plates[$j]['CodPro'].'" data-plate="' . $plates[$j]['CodPro'] .'">' . PHP_EOL;
                        echo '<td>' . $group['NomGru'] . '</td>' . PHP_EOL;
                        echo '<td>' . $plates[$j]['NomPro'] . '</td>' . PHP_EOL;
                        echo '<td>' . $plates[$j]['PrecioPro'] . '</td>' . PHP_EOL;
                        echo '<td class="cant">' . $cant . '</td>' . PHP_EOL;
                        echo '<td> <center> <button class="btnadd"> <span class="glyphicon glyphicon-plus"></span> </center> </button> </td>' . PHP_EOL;
                        echo '<td> <center> <button class="btnsubtract"> <span class="glyphicon glyphicon-minus"></span> </center> </button> </td>' . PHP_EOL;
                        echo '<td> <center> <button class="btncamera"> <span class="glyphicon glyphicon-camera"></span> </center> </button> </td>' . PHP_EOL;
                        echo '</tr>' . PHP_EOL;
                    }
                }
            }
            else
            {
                echo '<tr> <td col-span="5"> ¡No hay platos! </td> </tr>' . PHP_EOL;
            }
        ?>
      </tbody>
    </table>
    
    </div>
    
    <a type="button" class="btn btn-default" href="order.php?table=<?php echo $table; ?>">Regresar</a>
    <form action="send_order.php" method="post">
        <input type="submit" class="btn btn-primary" href="#" value="Enviar">
    </form>

    </div> <!-- /container -->
    
    <div id="second" class="container">
        <div id="image">
        </div>
        <button id="to-main" type="button" class="btn btn-default">Regresar</a>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="plates.js"></script>
    
  </body>
</html>