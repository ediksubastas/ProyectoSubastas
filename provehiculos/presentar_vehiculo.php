<?php
  include ("conexion/Conexion.php");
  //include ("Encryptar.php");
  $bd = new Conexion();
  //$enc = new Encryptar();
  session_start();
  if(!isset($_SESSION["id_usuario"])){
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ingresar vehículo</title>

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <?php

    if(isset($_POST["agregar"])){

      //Variables que se guardaran en la tabla vehiculo
      
      $proveedor = $_SESSION["id_usuario"];
      $marca = $_POST["marca"];
      $linea = $_POST["linea"];
      $tipoMotor = $_POST["tipomotor"];
      $cc = $_POST["cc"];
      $traccion = $_POST["traccion"];
      $modelo = $_POST["modelo"];
      $color = $_POST["color"];
      $precio = $_POST["precio"];
      $comentario = $_POST["comentario"];
      $estado = "ACTIVO";


      //Variables que se guardaran en la tabla fotografia

      $foto = $_FILES["foto"]["name"];//nombre de la imagen del producto
      
      $ruta = $_FILES["foto"]["tmp_name"];//ruta de la imagen del producto
   
      
      if($foto == null){       
        $res = $bd->query("INSERT into vehiculo(marca, linea, tipoMotor, cc, traccion, modelo,color, precio, comentario, estado, Usuario_idUsuario,imagen)
          values('$marca','$linea','$tipoMotor','$cc','$traccion','$modelo','$color','$precio','$comentario','$estado','$proveedor','default.jpg');");
          
      }

      else{
              
              $dest = "images/vehiculos/";
              copy($ruta,$dest.''.$foto);
              $res2 = $bd->query("INSERT into fotografia(imagen, Vehiculo_idVehiculo)
              values('$foto',$id_vehiculo);");
              $res = $bd->query("INSERT into vehiculo(marca, linea, tipoMotor, cc, traccion, modelo,color, precio, comentario, estado, Usuario_idUsuario,imagen)
              values('$marca','$linea','$tipoMotor','$cc','$traccion','$modelo','$color','$precio','$comentario','$estado','$proveedor','$foto');");
              
              } 



        if($res==true){
         
          header("Location: index.php");
          
        }
      else{
         echo "<script>alert('No se pudo agregar el vehículo, error 002');</script>";}
        }

  ?>

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
                            Registro <small>Nuevo registro de vehículo</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> Consola
                            </li>
                            <li class="active">
                                <i class="fa fa-plus"></i> Nuevo registro
                            </li>
                        </ol>
                    </div>
                </div>

                      <div class="row">

                        <form role="form" action="" method="post" enctype="multipart/form-data">

                          <div class="col-lg-6">

                                <h3>Detalle del vehículo</h3>

                                <div class="form-group">
                                      <label>Marca</label>
                                      <input type="text" name="marca" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Linea</label>
                                      <input type="text" name="linea" class="form-control" required>
                                  </div> 

                                  <div class="form-group">
                                      <label>Tipo de motor</label>
                                      <select class="form-control" name="tipomotor" required>
                                        <option value="GASOLINA" selected>Gasolina</option> 
                                        <option value="DIESEL" >Diesel</option>
                                        <option value="ELECTRICO" >Eléctrico</option>
                                        <option value="HIBRIDO" >Híbrido</option>
                                      </select>
                                  </div>
                               
                                  <div class="form-group">
                                      <label>Centímetros cúbicos</label>
                                      <input type="number" name="cc" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Tracción</label>
                                      <select class="form-control" name="traccion" required>
                                        <option value="0" selected disable>Tipo de tracción</option> 
                                        <option value="4x2" >4x2</option>
                                        <option value="4x4" >4x4</option>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                      <label>modelo</label>
                                      <?php
                                      $cont = date('Y');
                                      ?>
                                      <select class="form-control" name="modelo" required>
                                        <?php while ($cont >= 1950) { ?>
                                          <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                                        <?php $cont = ($cont-1); } ?>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                      <label>color</label>
                                      <input type="color" name="color" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label>Precio</label>
                                      <input type="number" name="precio" class="form-control" required>
                                  </div>
                                  
                                  

                                  <div class="form-group">
                                      <label>Descripcion</label>
                                      <textarea name="comentario" class="form-control" ></textarea>
                                  </div>                                  

                                  <h3>Fotografía del vehículo</h3>
                                                            
                                    <div class="form-group">                      
                                      <br>
                                      <input type="file" name="foto" require>
                                      <br>                                    
                                    </div>

                                    <br>

                                    <button name="agregar" type="submit" class="btn btn-success">Registrar</button>
                                    <button type="reset" class="btn btn-danger">Cancelar</button>
                        </div>
                        

                          


                            

                         

                        </form>

                      </div>
                      <!-- /.row -->
                  <br>

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
