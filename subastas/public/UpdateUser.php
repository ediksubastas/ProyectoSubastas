<!-- top header -->
    <?php include("../Plantillas/Cabezera.php"); ?>
<!-- /top header -->


<!-- Menur -->
    <?php include("../Plantillas/Menu.php"); ?>
<!-- /Menu -->


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
          <section class="content-header">
      <h1>
        Usuario  <?php   $usuario = $_SESSION['Usuarname'];  echo $usuario ;  ?>
        <small>Actualización De Credenciales</small>
        <label style="display:none;" id="rolSesion"> <?php   $Rol = $_SESSION['idUsuario'];  echo $Rol ;  ?> </label>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usuario</li>
      </ol>
          </section>


    <!-- PARTE DE LA PAGINA ESENCIAL MAIN-->
      <!-- content -->
       <section class="content">
		
			
			 	 

		<!-- Form Element sizes -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Actualización de datos usuarios  del  sistema  </h3>
            </div>
            
              <div class="box-body">
              	<div class="col-xs-3">
              			<label>Nuevo Password</label>
               			<input class="form-control" id="txtNewPass"  minlength="6"  type="password" placeholder="Nuevo Password" required="required">
	   			       </div>
  				       <div class="col-xs-3">
              			<label>Repita El Nuevo Password</label>
               			<input class="form-control" id="txtNewPassR" minlength="6"  type="password"  placeholder="Repita Su Nuevo Password" required="required" >
	   			        </div>     
  				        <div class="col-xs-3">
              			<label>Antiguo Password</label>
               			<input class="form-control" id="txtPasswordA"  type="password"  required>
			             </div>
                    <div class="col-xs-3">
			     		      <br>
			     		        <button type="submit" id="btnUpdatePass" class="btn btn-primary">Guardar</button>
			               </div>    				         
              
              </div>
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          		
			

                <div class="box box-primary">
                  <div class="box-header with-border">
                      <h3 class="box-title">Cambio De Avatar</h3>
                  </div>
                  <div class="box-body">        

                    
                     <div class="box-header with-border">
                          <div class="col-xs-4">
                              <select id ="dropAvatar"  class="form-control" >  
                                  <option value="dist/img/avatar.png" >Avatar Hombre</option>
                                  <option value="dist/img/avatar2.png">Avatar Mujer</option>
                                  <option value="dist/img/avatar3.png">Avatar Mujer (2)</option>
                                  <option value="dist/img/avatar4.png">Avatar Hombre (2)</option>
                                  <option value="dist/img/avatar5.png">Avatar Hombre (3)</option>
                                  
        
                              </select> 
                          </div>



                          <div class="col-xs-1">
                               <button id="btnAvatar" class="glyphicon glyphicon-trash btn  btn-success">
                               <i class='glyphicon glyphicon-ok'></i> Guardar</button>       
                          </div>                              
                      </div>            

              
          </div>  


       
       </section>
      <!-- /.content -->
    <!-- / PARTE DE LA PAGINA ESENCIAL MAIN-->




<!-- END PAGE -->
    <?php include("../Plantillas/Footer.php"); ?>
<!-- /END PAGE -->

<script type="text/javascript">
    
    $( document ).ready(function() {


       $("#btnAvatar").click(function () {
                Avatar = $("#dropAvatar").val();   
                SaveAvatar(Avatar);             
       });     


       $("#btnUpdatePass").click(function () {
                UpdatePassword();
       }); 

    }); // FINAL DE DOCUMENT READY


      function SaveAvatar(_Avatar){
              var rolSesion = document.getElementById('rolSesion').textContent;
              var rolint = parseInt(rolSesion);


             if(!_Avatar){
                          MensajesControlador('error' , 'Ingrese información en todos  los campos.' , 'topRight');
              }
              else{
                     $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'Update', _tabla: 'tbl_user' , _Nombre_id : 'Id_Usuario' , _id : rolint , _Campo : 'Avatar', _dato: _Avatar },




                      datatype: 'json',
                     type:'POST',
                     beforeSend: function () {
                            
                            document.getElementById("btnAvatar").disabled = true;
                      },
                      complete: function () {
                            
                            document.getElementById("btnAvatar").disabled = false;
                      },          
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){
                                      MensajesControlador(item.type , item.value , item.posicion);
                                       window.location.href='../Service/logout.php'; 
                                }
                                else if (item.strError =="1"){
                                        MensajesControlador(item.type , item.value , item.posicion);
                                } 
                        });
                      },
                      error:function(){
                                        MensajesControlador('error' , 'No hay Respuesta Del Servicio' , 'topRight');
                      }
                  });
              }
      }    




      function UpdatePassword(){
           
              var NewPass = document.getElementById('txtNewPass').value;
              var RnewPass = document.getElementById('txtNewPassR').value;
              var Password = document.getElementById('txtPasswordA').value;


             if(NewPass != RnewPass){
                          MensajesControlador('error' , 'El nuevo password no coincide. ' , 'topRight');
              }
              else{

                     $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'UpdatePassword' , Password:Password , NewPassword:NewPass  },

                     datatype: 'json',
                     type:'POST',
                     beforeSend: function () {
                            
                            document.getElementById("btnUpdatePass").disabled = true;
                      },
                      complete: function () {
                            
                            document.getElementById("btnUpdatePass").disabled = false;
                      },          
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){
                                       window.location.href='../Service/logout.php'; 
                                      MensajesControlador(item.type , item.value , item.posicion);

                                }
                                else if (item.strError =="1"){
                                        MensajesControlador(item.type , item.value , item.posicion);
                                } 
                        });
                      },
                      error:function(){
                                        MensajesControlador('error' , 'No hay Respuesta Del Servicio' , 'topRight');
                      }
                  });
              }
      }    


</script>


 
