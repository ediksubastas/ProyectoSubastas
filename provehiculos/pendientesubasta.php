<?php
  //Se incluye el archivo Conexion.php que contiene la clase usada para la conexion a la bd
  include ("conexion/Conexion.php");
  //Se crea el objeto conexion
  $bd = new Conexion();
  //Se inicia la sesion o se propaga
  session_start();
  //Condicion que no deja entrar al index a menos que exista una variable de session
  if(!isset($_SESSION["id_usuario"])){
    //Redirecciona al login
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vehículos</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="subastas.php">Vehículos</a>
            </div>
            <!-- Top Menu Items -->
            <?php
              include ("header.php");
            ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php
              include ("sidebar.php");
            ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Vehículos <small>Subasta pendiente</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-comment"></i> Vehículos
                            </li>
                            <li class="active">
                                <i class="fa fa-comments"></i> Subasta pendiente
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- Listado de subastas -->
                <div class="row">
                  <table class="table table-hover" >
                          <thead>
                                <tr>
                                    <th>IMAGEN</th>
                            
                                    <th>MARCA</th>
                                    <th>LINEA</th>
                                    <th>C. C.</th>
                                    <th>TRACCIÓN</th>
                                    <th>MODELO</th>
                                    <th>COLOR</th>
                                    <th>PRECIO</th>
                                    <th>DESCRIPCION</th>
                                </tr>
                          </thead>

                          <?php 
                         
                           
                         $res =  $bd->select("SELECT * from vehiculo where estado='ACTIVO'");
                          if($res->num_rows > 0){
                            while($row = $res->fetch_assoc()){
                            $imagen_v= $row["imagen"]

                           ?>

                          <tr>
                            <td width="180px">
                              <center>
                                <img src="<?php echo "images/vehiculos/$imagen_v";?>" style="height: 80px;">
                                </a>
                              </center>
                            </td>
                     
                            <td><?php echo $row["marca"]?></td>
                            <td><?php echo $row["linea"] ?></td>
                            <td><?php echo $row["tipoMotor"] ?></td>
                            <td><?php echo $row['cc'] ?></td>
                            <td><?php echo $row['traccion'] ?></td>
                            <td><?php echo $row['color'] ?></td>
                            <td><?php echo $row['precio'] ?></td>
                            <td><?php echo $row['comentario'] ?></td>
                          </tr>
                        <?php 
                        }
                        } 

                         ?>
                  </table>
                </div>
                <!-- Fin de listado -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
