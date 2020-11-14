

<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SUBASTAS | Login</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		    <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">


         <link rel="stylesheet" href="Public/dist/css/animate.css">
         <link rel="stylesheet" href="Public/dist/css/urban.css">
         <link rel="stylesheet" href="Public/dist/css/urban.skins.css"> 



      

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                              	<h3>SUBASTAS | Login</h3>
                            		<p>Ingrese sus Credenciales de  Ususario:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
                                <form role="form"    class="login-form"  >
                                    <div class="form-group">
                                        <label class="sr-only"  for="form-username">Username</label>
                                        <input type="text" id="txtUsername" name="form-username" placeholder="Username..." class="form-username form-control" onkeypress="loging(event)">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" id="txtPassword" name="form-password" placeholder="Password..." class="form-password form-control" onkeypress="loging(event)" >
                                    </div>
                                    
                                </form>
                                  <div align="right">
                                    <button  id="BtnLogin" type="button" class="btn " >Ingresar</button>
                                  </div>
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>




        <script src="Public/dist/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
        <script src="Public/dist/js/extentions/noty-defaults.js"></script>
        <!-- /page level scripts -->        
        
        <script src="Public/dist/js/FuncionesMensajes.js"></script>
    <!-- /Funciones  para  mensajes -->

  <script type="text/javascript">
    $(document).ready(function() {
     
         $("#BtnLogin").click(function () {
                VerificarUsuario();              
          }); 
    });

  function VerificarUsuario()
  {
      
      var Usuario = document.getElementById('txtUsername').value;      
      var Password = document.getElementById('txtPassword').value;

      if(!Usuario || !Password){
          
          MensajesControlador('error' , 'Ingrese Usuario y Password.' , 'topRight');

      }
      else{
          $.ajax({
          
          url: 'Service/Ws.php',
          data: {op :'ValidarUsuario',Username:Usuario,  Password : Password},
          datatype: 'json',
          type:'POST',
          success: function(data) {
                $.each(data, function(index, item){

                           if(item.strError=="0" && item.Exis=="1"){
                                  if(item.Acceso == "0"){
                                      
                                  } 
                                  else{
                                      window.location.href = "Public/index.php";
                                  }                  
                                      
                            }
                            else {
                                      MensajesControlador(item.type , item.value , item.posicion);  
                            } 
                });
          },
          error:function(){
              alert(item.strError);
          }
        });

      } 
  }


  function loging(e){
      if (e.keyCode == 13) {
          VerificarUsuario();
      } 
  }

</script>


    </body>

</html>