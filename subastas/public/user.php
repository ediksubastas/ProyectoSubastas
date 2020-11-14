  <!-- top header -->
    <?php include("../Plantillas/Cabezera.php"); ?>
<!-- /top header -->


<!-- Menur -->
    <?php include("../Plantillas/Menu.php");


          $NoPagina = 0;

          // MENU A LA CUAL  PERTENECE LA PAGINA
          $Modulo = 1;

           $consulta = "select isnull((select id_Permiso from tbl_permisos where Id_Rol =  '".$_SESSION['Rol']."'  and id_Modulo = '".$Modulo."')) as Permiso ;"; 
           $sql = mysql_query($consulta);
            $total = mysql_num_rows($sql);

              if($total > 0){
                     while ($row = mysql_fetch_array($sql)){
                         if ($row['Permiso'] == 1){
                                  echo '<script language = javascript> self.location = "404.php";  </script>';       
                         }

                     }
                   
              } 

    ?>
<!-- /Menu -->   

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
          <section class="content-header ">
      <h1>
        Modulo De Usuarios
              <label style="display:none;" id="rolSesion"> <?php   $Rol = $_SESSION['Rol'];  echo $Rol ;  ?> </label>
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usuarios</li>
      </ol>
          </section>


    <!-- PARTE DE LA PAGINA ESENCIAL MAIN-->
      <!-- content -->
       <section class="content">
          
     
          <!-- Form Nuevo Rol -->
          <div class="box box-primary">
              <div class="box-header with-border">
                      <h3 class="box-title">Asignación de Nuevo Usuario</h3>
                  </div>
                  <div class="box-body">     
                     <div class="box-header with-border">
                                                                   
                          <div class="col-xs-3">
                              <label>Persona</label>
                                <select class="form-control" id="DropPersonas">
                                      <option value ="0">Clientes Sin Usuario </option>
                                </select>
                          </div>

                          <div class="col-xs-3">
                              <label>Rol</label>
                                  <select class="form-control" id="DropRoles">
                                        <option value ="0">Roles Existentes </option>
                                  </select>
                          </div>        
                          <div class="col-xs-3">
                             <label>Username:</label>
                              <input class="form-control" id="txtUsername" type="text" placeholder="Nombre Del Usuario" required>
                          </div> 
                          <div class="col-xs-3">
                            <label>Password Inicial:</label>
                            <input class="form-control" id="txtPassword" type="password" placeholder="Password" required>
                          </div>             
                    </div>       


                     <div class="box-header with-border">
                          
 

                          <div class="col-xs-4">
  
                          </div>

                          <div class="col-xs-4">
 
                          </div>   

                          <div class="col-xs-2">
                              <button type="submit"  id="btnGuardar" class="btn btn-block btn-primary">Guardar</button>
                          </div>

                          <div class="col-xs-2">
                               <button  id="btnCancelar" class="btn btn-block btn-danger">Cancelar</button>
        
                          </div>                      
                    </div>                                   





                  </div>
              </div>



          <!--  FORM TABLA  DE COLABORADORES  -->
          <div class="box box-primary">
                  <div class="box-header with-border">
                      <h3 class="box-title">Usuarios Del Sistema</h3>
                  </div>
                  <div class="box-body">        

                    
                     <div class="box-header with-border">
                          <div class="col-xs-4">
                              <select id ="DropUser" class="form-control ">  
                                        <option value ="0">Todos</option>
                              </select> 
                          </div>



                          <div class="col-xs-1">
                               <button id="BtnBuscar" class="glyphicon glyphicon-serch btn  btn-success">
                               <i class='glyphicon glyphicon-serch'></i> Buscar</button>       
                          </div>                              
                      </div>            

                    <div class="box-header with-border">
                        <table  class="table TablaUsuarios"  id="TablaUsuarios" width="100%">
                               <thead>
                                  <tr>
                                     <th>Codigo</th>                                    
                                     <th>Usuario</th>                                    
                                     <th>Fecha Creacion</th>
                                     <th>Asignado</th>
                                     <th>Rol</th>
  
                                     <th>Acciones</th>

                                     

                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                     </table> 
                    </div>      
          </div>  


       
       </section>
      <!-- /.content -->
    <!-- / PARTE DE LA PAGINA ESENCIAL MAIN-->




<!-- MODAL -->
<div  id="ModalConfirmacion" class="modal bs-modal-sm ModalConfirmacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">¿Deseas Eliminar Este Usuario?</h4>
        </div>
        <div class="modal-body">
              <input type="text" id="txtCodigo" aling=left readonly="readonly"  name="textid"  class="form-control"  style="display:none;"/>
                <p>Tome en cuenta que  automaticamente  el usuario no prodra ingresar al sistema nuevamente.</p>

 
        </div>
        <div class="modal-footer no-border">
       
          <button type="button" id="BtnEliminar" class="btn btn-primary">Si</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
</div>
<!-- /MODAL -->




<!-- END PAGE -->
    
    <?php include("../Plantillas/Footer.php"); ?>






   <script type="text/javascript" src="../Public/dist/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" src="../Public/dist/js/jquery.dataTables.js"></script>
   <script type="text/javascript" src="../Public/dist/js/jszip.min.js"></script>
   <script type="text/javascript" src="../Public/dist/js/dataTables.buttons.min.js"></script>
   <script type="text/javascript" src="../Public/dist/js/pdfmake.min.js"></script>
   <script type="text/javascript" src="../Public/dist/js/vfs_fonts.js"></script>
   <script type="text/javascript" src="../Public/dist/js/buttons.html5.min.js"></script>
<!-- /END PAGE -->


 <script type="text/javascript">
    $( document ).ready(function() {
      //CARGAMOS ELEMENTOS  DE  BUSQUEDA  PARA  MANTENIMIENTOS  DE  LOS  COLABORADORES
                  
         $("#DropRoles").load("../Service/DropRoles.php");
       
         $("#DropPersonas").load("../Service/DropSinUsuario.php");         
         $("#DropUser").load("../Service/DropUser.php");         
         
          
         $("#DropRoles").select2(); 
         $("#DropPersonas").select2(); 
         $("#DropUser").select2(); 
         



      //EVENTOS DE LOS BOTONES  
         $("#btnGuardar").click(function(){
                GuardarUsuario();
          }); 

         $("#BtnBuscar").click(function(){
                BuscarUsuario();
          }); 

          $("#BtnEliminar").click(function(){
                BajaUsuario();
          });         



      $("#TablaUsuarios").dataTable({
             "scrollX": true,
             "aLengthMenu": [[5, 8, 10,  -1], [5, 8, 10,  "Todo"]],
             "language": {
                            "url": "dist/lang/dataTables.spanish.lang"
                          },   
            dom: 'Blfrtip',
                  buttons: [

                            {
                              copyTitle: 'Documento Generado Exitosamente',
                              extend: 'pdfHtml5',
                              title: 'Detalle De Usuarios.',
                               message: 'Sistema Subastas'

                            }
                            
              ]
      });

      $("#TablaUsuarios").on("click", ".BtnDelete", function(){
            var usuario = this.id;
            $("#txtCodigo").val(usuario);
           
            $('.ModalConfirmacion').modal('toggle'); 

      });  



           




  }); //FINAL DOCUMENT READY.



    function GuardarUsuario(){
           
         var Username = document.getElementById('txtUsername').value;
         var Password = document.getElementById('txtPassword').value;

         var Rol = $("#DropRoles").val();
         var cliente = $("#DropPersonas").val();

         $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'GuardarUsuario', Usuario : Username  , Password: Password, cliente: cliente, Rol: Rol },
                      datatype: 'json',
                     type:'POST',
                     beforeSend: function () {
                            
                            document.getElementById("btnGuardar").disabled = true;
                      },
                      complete: function () {
                            
                            document.getElementById("btnGuardar").disabled = false;
                      },          
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){           
                                        document.getElementById('txtUsername').value = "";
                                        document.getElementById('txtPassword').value = "";
                                        $("#DropPersonas").select2("val", "");
                                        $("#DropRoles").load("../Service/DropRoles.php");
                                        $("#DropPersonas").load("../Service/DropSinUsuario.php");   

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
            }); //FINAL AJAX.
           
    }//FINAL DE LA FUNCION  DE  GUARDAR USUARIO


 function BuscarUsuario(){
          $("#TablaUsuarios").dataTable().fnClearTable();
          var Usuario = $("#DropUser").val();

          if(Usuario == 0){
              Usuario = "%";
            }

            $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'MostrarUsuarios', idUsuario : Usuario },
                      datatype: 'json',
                     type:'POST',
                     beforeSend: function () {
                            
                            document.getElementById("BtnBuscar").disabled = true;
                      },
                      complete: function () {
                            
                            document.getElementById("BtnBuscar").disabled = false;
                      },          
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){                               
                                     MensajesControlador(item.type , item.value , item.posicion);

                                }
                                else{
                                  $("#TablaUsuarios").dataTable().fnAddData([
                                        item.id,
                                        
                                        item.username,
                                        item.Fecha, 
                                        item.Cliente,
                                        item.Rol,
                                         
                                        "<button type='button' id='" + item.id +  "'class='btn btn-xs btn-danger BtnDelete'><i class='glyphicon glyphicon-trash'></i></button>"                                  
                                  ]);                                        
                                } 
                        });
                      },
                      error:function(){
                                        MensajesControlador('error' , 'No hay Respuesta Del Servicio' , 'topRight');
                      }
            }); //FINAL AJAX.
       


 }//FINAL  DE LA FUNCION  DE BUSCAR  USUARIO



 function BajaUsuario(){
              var Usuario = document.getElementById('txtCodigo').value;
              $.ajax({
                     url: '../Service/Ws.php',

                     data: {op :'UpdateEstado', _tabla : 'Tbl_User'  , _Nombre_id: 'id_Usuario', _id: Usuario },
                      datatype: 'json',
                     type:'POST',
         
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){                               
                                    
                                         $('.ModalConfirmacion').modal('toggle');                               
                                          
                                          
                                          $("#DropUser").load("../Service/DropUser.php");
                                          BuscarUsuario();                                           
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

</script>
