<?php include('../Service/startSesion.php');?>
<!DOCTYPE html>
<html>
    <head>
           <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <title>SUBASTAS | Dashboard</title>
            
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <!-- Bootstrap 3.3.6 -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
          <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
          <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
          <!-- iCheck -->
          <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
          <!-- Morris chart -->
          <link rel="stylesheet" href="plugins/morris/morris.css">
          <!-- jvectormap -->
          <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
            <!-- Date Picker -->
          <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
          <!-- Daterange picker -->
          <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
          <!-- bootstrap wysihtml5 - text editor -->
          <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

          <link rel="stylesheet" type="text/css" href="../Public/dist/css/select2.min.css">

            <link rel="stylesheet" type="text/css" href="../assets/js/fancybox/jquery.fancybox.css" media="screen" />

          <link rel="stylesheet" type="text/css" href="../Public/dist/css/jquery.dataTables.min.css">
          <link rel="stylesheet" type="text/css" href="../Public/dist/css/buttons.dataTables.min.css">


         <link rel="stylesheet" href="../Public/dist/css/animate.css">
         <link rel="stylesheet" href="../Public/dist/css/urban.css">
         <link rel="stylesheet" href="../Public/dist/css/urban.skins.css"> 

          <style>  
               .lista{  
                    background-color:#eee;  
                    cursor:pointer;  
                }  
                .cuerpolista{  
                 padding:12px;  
               }  
           </style>  


               <style>

            div.gallery {
            margin: 5px;
        
            float: left;
            width: 180px;
        }

        div.gallery:hover {

        }

        div.gallery img {
            width: 400%;
            height: 315px;
        }

        div.desc {
            padding: 15px;
            text-align: center;
                        width: 400%;
            height: 315px;
        }

    #cabecera {  padding: 0; }

    nav.navbar {
         background-color: #5b9ea4 ;

        
    }

     #map {
        height: 90%;
      }

    figure, body {
      margin: 0;
      padding: 0;
      line-height: 1.4;
    }

    body {
            font-family: 'Roboto', sans-serif;
            background-color: #eee;
          }
    .demo {
            background-color: #666;
    }
    h1, h2, h3 {
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: 400;
            letter-spacing: 1px;
    }
    h1 {
          font-size: 24px;
    }
    h1, #wrapper > figure > figcaption {
        text-align: center;
    }
    #wrapper > figure > figcaption {
          margin: 1em;
    }
    .demo h1,
    .demo #wrapper > figure > figcaption {
    color: #fff;
    }

    .mis-slider li figcaption {
        font-weight: 500;
        letter-spacing: .5px; 
    }
    .main {
            width: 80%;
            margin: 2em auto;
    /*display: block;*/
    }

    div.main pre {
              font-size: 1.1em;
              overflow: auto;
              max-height: 500px;
              background-color: #fff;
              padding: 0 1em 1em;
    }
  
    @media screen and (min-width: 1200px) {
    .main {
            width: 50%;
      }
    }
 
    .footer {
    background:  #5b9ea4;
    
    }
    
    #Proyectos {  padding: 15px; }

    </style>
 

  </head>


  <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
                <!-- PARTE DE ENCABEZADO -->
                        <header class="main-header">
                <!-- Logo -->
                        <a href="index.php" class="logo">
                          <!-- mini logo for sidebar mini 50x50 pixels -->
                          <span class="logo-mini"><b>S</b>UB</span>
                          <!-- logo for regular state and mobile devices -->
                          <span class="logo-lg">SUBASTAS</span>
                        </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                          <span class="sr-only">Toggle navigation</span>
                      </a>

                <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
    
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown">
                    
                    <span class="hidden-xs  "> <?php   $usuario = $_SESSION['Usuarname'];  echo $usuario ;  ?></span>
                    </a>
                    <ul class="dropdown-menu">
  

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="UpdateUser.php" class="btn btn-default btn-flat">Cuenta</a>
                </div>
                <div class="pull-right">
                  <a href="../Service/logout.php" class="btn btn-default btn-flat">Cerrar Sesion</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- / PARTE DE ENCABEZADO -->