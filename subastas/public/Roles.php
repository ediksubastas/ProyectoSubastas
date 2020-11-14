  <!-- top header -->
    <?php include("../Plantillas/Cabezera.php"); ?>
<!-- /top header -->


<!-- Menur -->
    <?php include("../Plantillas/Menu.php"); 

        //INCLUIMOS  LA  CONEXION
          
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
        Módulo, Creación De Roles 
              <label style="display:none;" id="rolSesion"> <?php   $Rol = $_SESSION['Rol'];  echo $Rol ;  ?> </label>
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Roles</li>
      </ol>
          </section>


    <!-- PARTE DE LA PAGINA ESENCIAL MAIN-->
      <!-- content -->
       <section class="content">
		      
		 
			 		<!-- Form Nuevo Rol -->
          <div class="box box-primary">
                  <div class="box-header with-border">
                      <h3 class="box-title">Nuevos Roles Para El Sistema</h3>
                  </div>
                  <form>
                  <div class="box-body">        

                    
                     <div class="box-header with-border">
                          <div class="col-xs-4">
                             <label>Nombre</label>
                              <input class="form-control" id="Nombre" type="text" placeholder="Nombre Del Nuevo Rol" required>
                          </div>

                          <br>
                                <div class="col-xs-1">
                                      <button type="submit"  id="btnGuardar" class="glyphicon glyphicon-trash btn  btn-primary"><i class='glyphicon glyphicon-ok'></i> Guardar</button>

                                </div>
                  </div>
                  </form>                  
          </div>

        
        

  </div>
                    <!-- Form Asignacion Permisos -->
          <div class="box box-primary">
                  <div class="box-header with-border">
                      <h3 class="box-title">Asignación De Permisos</h3>
                  </div>
                  <div class="box-body">        

                    
                     <div class="box-header with-border">
                          <div class="col-xs-4">
                              <select id ="DropRoles" class="form-control ">  
                              </select> 
                          </div>

                         <div class="col-xs-4">
                            <select id ="DropPermisos" class="form-control ">  
                            </select> 
                          </div>

                          <div class="col-xs-1">
                               <button id="btnPermiso" class="glyphicon glyphicon-trash btn  btn-success">
                               <i class='glyphicon glyphicon-ok'></i> Guardar</button>       
                          </div>                              
                      </div>            

                    <div class="box-header with-border">
                        <table  class="table TablaPermisos"  id="TablaPermisos" width="100%">
                               <thead>
                                  <tr>
                                     <th>Rol. </th>                                    
                                     <th>Permisos</th>
                                     <th>Deshabilitar</th>
                                     

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




<!-- END PAGE -->
    
    <?php include("../Plantillas/Footer.php"); ?>




<!-- MODAL -->
<div  id="ModalConfirmacion" class="modal bs-modal-sm ModalConfirmacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">¿Deseas Eliminar Este Permiso?</h4>
        </div>
        <div class="modal-body">
              <input type="text" id="textid" aling=left readonly="readonly"  name="textid"  class="form-control"  style="display:none;"/>
                

 
        </div>
        <div class="modal-footer no-border">
       
          <button type="button" id="BtnEliminar" class="btn btn-primary">Si</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
</div>
<!-- /MODAL -->






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
      // Var Rol
        var Rol = 0;
        
        



      //CARGAMOS LOS  ROLES  QUE ACTUALMENTE  EXISTAN  DENTRO DEL  SISTEMAS 
          $("#DropRoles").load("../Service/DropRoles.php");


          document.getElementById("DropRoles").onchange = 
              function() {
                             Rol = $("#DropRoles").val();
                             MostrarPermisos(Rol);
                            $("#DropPermisos").load("../Service/DropPerSinAs.php?rol=" + Rol);
                            
                         };

      //EVENTOS DE LOS BOTONES
            $("#btnGuardar").click(function () {
                GuardarRol();
            });          

            $("#btnPermiso").click(function () {
                SaveNewPerm(Rol);
            });    

            $("#BtnEliminar").click(function () {
                var permiso = document.getElementById("textid").value;
                deletePermiso(Rol , permiso);
            });

      // EVENTO PARA LA TABLA  DE PERMISOS
        $("#TablaPermisos").on("click", ".BtnDelete", function(){
                    var id = this.id;
                    $("#textid").val(id);
                    $('.ModalConfirmacion').modal('toggle');
                
                
       });



      //PLUGIN DATATABLE 
      
      $("#TablaPermisos").dataTable({
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
                              title: 'Detalle De Boletas.',
                               message: 'Censo Poblacional 2016 (18/09/2016).'

                            }
                            
              ]
      });

  }); // FINAL DOCUMENTE READY



      function GuardarRol(){

 
      var Nombre = document.getElementById('Nombre').value;
      
      
      if(!Nombre){
        
                MensajesControlador('error' , 'Ingrese información en todos  los campos.' , 'topRight');
      }
      else{
            $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'NewRol', Descripcion: Nombre },
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
                                          document.getElementById('Nombre').value = "";
                                          $("#DropRoles").load("../Service/DropRoles.php");
                                         

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



      function SaveNewPerm(_Rol){

                var Rol = $("#DropRoles").val();
                var Permiso = $("#DropPermisos").val();
                


              if(Rol == 0  ||  Permiso == 0 ){
                          MensajesControlador('error' , 'Ingrese información en todos  los campos.' , 'topRight');
              }
              else{
                     $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'UpdatePermiso', Mod: Permiso ,  Acc:Rol  },
                      datatype: 'json',
                     type:'POST',
                     beforeSend: function () {
                            
                            document.getElementById("btnPermiso").disabled = true;
                      },
                      complete: function () {
                            
                            document.getElementById("btnPermiso").disabled = false;
                      },          
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){
                                          document.getElementById('Nombre').value = "";
                                          $("#DropPermisos").load("../Service/DropPerSinAs.php?rol=" + _Rol);
                                          MostrarPermisos(_Rol);
                                          MensajesControlador(item.type , item.value , item.posicion);
                                          var rolSesion = document.getElementById('rolSesion').textContent;
                                          var rolint = parseInt(rolSesion);
                                 
                                 
                                          if(rolint == _Rol){
                                                window.location.href='Roles.php';          
                                          }

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



      function MostrarPermisos(_Rol){

              $("#TablaPermisos").dataTable().fnClearTable();

              
              var combo = document.getElementById("DropRoles");
              var Selecionado = combo.options[combo.selectedIndex].text;
                
             

                $.ajax({
                      url: '../Service/Ws.php',
                       data: {op :'MostrarPermisos', rol : _Rol},
                       datatype: 'json',
                       type:'POST',
  
                       success: function(data) {
                          
                          $.each(data, function(index, item){
                             if(item.strError=="0"){
                             
                                     MensajesControlador(item.type , item.value , item.posicion);
                            }
                            else{
                                  $("#TablaPermisos").dataTable().fnAddData([
                                  Selecionado,
                                  item.Nombre,
                                                           
                                  "<button type='button' id='" + item.id +  "'class='btn btn-xs btn-danger BtnDelete'><i class='glyphicon glyphicon-trash   BtnDelete'></i> Eliminar</button>"                                  
                              ]);
                            }
                              
                          });
                          
                      },
                        error:function(){
                          MensajesControlador('error' , 'No hay Respuesta Del Servicio' , 'topRight');
                        }
                });

      }



      /*################ FUNCION PARA ELIMINAR LOS PERMISOS   ###########################*/

      function deletePermiso(_Rol , _Permiso)
      {
              
                  $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'DeletePermiso', Permiso: _Permiso },
                      datatype: 'json',
                     type:'POST',
                     beforeSend: function () {
                            
                            document.getElementById("BtnEliminar").disabled = true;
                      },
                      complete: function () {
                            
                            document.getElementById("BtnEliminar").disabled = false;
                      },          
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){
                                          
                                        $('ModalConfirmacion').modal('toggle');
                                         $("#DropPermisos").load("../Service/DropPerSinAs.php?rol=" + _Rol);
                                          $('.ModalConfirmacion').modal('toggle');
                                          MensajesControlador(item.type , item.value , item.posicion);
                                          MostrarPermisos(_Rol);
                                          var rolSesion = document.getElementById('rolSesion').textContent;
                                          var rolint = parseInt(rolSesion);
                                 
                                 
                                          if(rolint == _Rol){
                                                window.location.href='Roles.php';          
                                          }
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

 
