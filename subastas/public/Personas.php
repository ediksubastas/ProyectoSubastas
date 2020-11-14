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
        Módulo de Personas
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Personas</li>
      </ol>
          </section>


    <!-- PARTE DE LA PAGINA ESENCIAL MAIN-->
      <!-- content -->
       <section class="content">
		
		 
			 		<!-- Form Element sizes -->
          <div class="box box-primary">
                  <div class="box-header with-border">
                      <h3 class="box-title">Registro de Nuevos Clientes</h3>
                  </div>
                  <div class="box-body">        

                    
                     <div class="box-header with-border">
                          <div class="col-xs-4">
                             <label>Nombres</label>
                              <input class="form-control" id="txtNombres" type="text"  placeholder="Nombres" onkeypress="return soloLetras(event)" required>
                          </div>

                         <div class="col-xs-4">
                            <label>Apellidos</label>
                            <input class="form-control" id="txtApellidos" type="text" placeholder="Apellidos" onkeypress="return soloLetras(event)" required>
                         </div>

                      <div class="col-xs-4">
                          <label>Fecha De Nacimiento</label>
                          <input class="form-control" id="txtFechaNacimiento" type="date" placeholder="Fecha" required>
                      </div>
                    </div>

                    <div class="box-header with-border">
                          <div class="col-xs-4">
                             <label>CUI</label>
                              <input class="form-control" id="txtcui" type="number" placeholder="Numero De DPI" pattern="[0-9]{3}" required>
                          </div>

                         <div class="col-xs-4">
                            <label>Dirección</label>
                            <input class="form-control" id="direccion" type="text" placeholder="Dirección" required>
                         </div>

                      <div class="col-xs-4">
                          <label>Móvil</label>
                          <input class="form-control" id="textTel" type="number" placeholder="Número De Celular" required>
                      </div>
                    </div>


                    <div class="box-header with-border">
                          <div class="col-xs-4">
                             <label>Teléfono Residencial</label>
                              <input class="form-control" id="TelefonoResidencial" type="number" placeholder="Número De Teledono Residencial">
                          </div>

                         <div class="col-xs-4">
                            
                         </div>

                         <div class="col-xs-4">
                                <br>
                                <div class="col-xs-4">
                                      <button type="submit"  id="btnGuardar" class="btn btn-block btn-primary">Guardar</button>

                                </div>
                                <div class="col-xs-4">
                                       <button type="submit" id="btnCancelar" class="btn btn-block btn-danger">Cancelar</button>
                                </div>
                                
                          </div>
                    </div>
          </div>
      </div>


          <!--  FORM TABLA  DE CLIENTES  -->
          <div class="box box-primary">
                  <div class="box-header with-border">
                      <h3 class="box-title">Clientes Existentes</h3>
                  </div>
                  <div class="box-body">        

                    
                     <div class="box-header with-border">
                          <div class="col-xs-4">
                              <select id ="DropPersonas" class="form-control ">  
                                        <option value ="0">Todos</option>
                              </select> 
                          </div>



                          <div class="col-xs-1">
                               <button id="BtnBuscar" class="glyphicon glyphicon-serch btn  btn-success">
                               <i class='glyphicon glyphicon-serch'></i> Buscar</button>       
                          </div>                              
                      </div>            

                    <div class="box-header with-border">
                        <table  class="table TablaPersona"  id="TablaPersona" width="100%">
                               <thead>
                                  <tr>
                                     <th>Código Cliente</th>                                    
                                     <th>Nombres</th>
                                     <th>Fecha de Nacimiento</th>
                                     <th>Cui</th>
                                     <th>Dirección</th>
                                     <th>Móvil</th>
                                     <th>Teléfono</th>
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
<div  id="ModalUpdateClientes" class="modal bs-modal-sm ModalUpdateClientes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Actualización de Datos</h4>
        </div>
        <div class="modal-body">
              <div class="box-body">      
                <input type="text" id="textid" aling=left readonly="readonly"  name="textid"  class="form-control"  style="display:none;"/>  
                     <div class="box-header with-border">
                         <div class="col-xs-4">
                             <label>Cui</label>
                              <input class="form-control" id="txtCui" type="text" required>
                          </div>


                          <div class="col-xs-4">
                             <label>Nombre</label>
                              <input class="form-control" id="txtNombre"  type="text"  onkeypress="return soloLetras(event)" required>
                          </div>

                         <div class="col-xs-4">
                             <label>Apellido</label>
                              <input class="form-control" id="txtApellido" type="text"  onkeypress="return soloLetras(event)" required>                        
                            
                         </div>
                    </div>


                    <div class="box-header with-border">
                          <div class="col-xs-4">
                             <label>Dirección</label>
                              <input class="form-control" id="txtDireccion" type="text" required>
                          </div>

                         <div class="col-xs-4">
                             <label>Teléfono Celular</label>
                              <input class="form-control" id="txtTelefono" type="number" required>                        
                            
                         </div>

                         <div class="col-xs-4">
                             <label>Tel Domiciliar</label>
                              <input class="form-control" id="txtCelular" type="number" required>                        
                            
                         </div>                         
                    </div>  


                    <div class="box-header with-border">
                          <div class="col-xs-4">
                             <label>Fecha Nacimiento</label>
                              <input class="form-control" id="txtFechaNacimiento" type="date" required>
                          </div>

                                         
                    </div>                      


              </div>

        </div>
        <div class="modal-footer no-border">
       
          <button type="button" id="BtnGuardarCliente" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>
<!-- /MODAL -->

<!-- MODAL -->
<div  id="ModalConfirmacion" class="modal bs-modal-sm ModalConfirmacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">¿Deseas eliminar al cliente seleccionado?</h4>
        </div>
        <div class="modal-body">
              <input type="text" id="txtClienteBaja" aling=left readonly="readonly"  name="textid"  class="form-control"  style="display:none;"/>
                <p>Tome en cuenta que  automaticamente  el usuario asignado a este se dara de baja.</p>

 
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
         $("#DropPersonas").load("../Service/DropPersonas.php");
         $("#DropPersonas").select2(); 


      //EVENTOS DE LOS BOTONES  
         $("#btnGuardar").click(function(){
                GuardarNewPersona();
          });

         $("#btnCancelar").click(function(){
                CancelarIngreso();
          });


         $("#BtnBuscar").click(function(){
                BuscarPersona();
          });


          $("#BtnGuardarCliente").click(function(){
                ActualizarCliente();
          });     


          $("#BtnEliminar").click(function(){
                BajaCliente();
          });


              //PLUGIN DATATABLE 
           
       // EVENTO PARA LA TABLA  DE PERMISOS
        $("#TablaPersona").on("click", ".BtnUpdate", function(){
                    var cliente = this.id;
                    $("#textid").val(cliente);
            $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'MostrarPersona', idCliente : cliente , Opc: 2 },
                      datatype: 'json',
                     type:'POST',
          
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){                               
                                     MensajesControlador(item.type , item.value , item.posicion);

                                }
                                else{
                                        $("#txtCui").val(item.Cui);
                                        $("#txtNombre").val(item.Nombres);
                                        $("#txtApellido").val(item.Apellido);
                                        $("#txtDireccion").val(item.Dir);
                                        $("#txtTelefono").val(item.Celular);
                                        $("#txtCelular").val(item.TelefonoResidencial);
                                        $("#txtFechaNacimiento").val(item.fecha);

                                     $('.ModalUpdateClientes').modal('toggle');                         
                                } 
                        });
                      },
                      error:function(){
                                        MensajesControlador('error' , 'No hay Respuesta Del Servicio' , 'topRight');
                      }
            });




                
                
       });        
              
      
      $("#TablaPersona").dataTable({
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
                              title: 'Detalle De Clientes.',
                               message: 'Sistema Subastas'

                            }
                            
              ]
      });


      $("#TablaPersona").on("click", ".BtnDelete", function(){
            var cliente = this.id;
            $("#txtClienteBaja").val(cliente);
           
            $('.ModalConfirmacion').modal('toggle'); 

      });





 }); //FINAL DEL DOCUMENT READY


function CancelarIngreso(){

limpiarFormularioIngreso();

}


 function GuardarNewPersona(){



      var Nombre = document.getElementById('txtNombres').value;
      var Apellidos = document.getElementById('txtApellidos').value;
      var FechaNacimiento = document.getElementById('txtFechaNacimiento').value;
      var Cui = document.getElementById('txtcui').value;
      var Direccion = document.getElementById('direccion').value;
      var Movil = document.getElementById('textTel').value;
      var Telefono = document.getElementById('TelefonoResidencial').value;
      
      
      
      if(!Nombre || !Apellidos || !FechaNacimiento || !Cui || !Direccion || !Movil || !Telefono ) {
        
                MensajesControlador('error' , 'Ingrese información en todos  los campos.' , 'topRight');
      }
      else{
            $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'NewCliente', Nombre : Nombre  , Apellidos: Apellidos, FechaNacimiento: FechaNacimiento, Cui: Cui, Direccion: Direccion, Movil:Movil, Telefono:Telefono },
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
                                                                                                                     
                                          limpiarFormularioIngreso();
                                          MensajesControlador(item.type , item.value , item.posicion);
                                          $("#DropPersonas").load("../Service/DropPersonas.php");
                                          $("#DropPersonas").select2(); 

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

    

 }//FINAL  DE FUNCION  PARA  GUARDAR  UN  NUEVO  ClIENTE


 function BuscarPersona(){
          $("#TablaPersona").dataTable().fnClearTable();
          var cliente = $("#DropPersonas").val();

          if(cliente == 0){
              cliente = "%";
            }


            $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'MostrarPersona', idCliente : cliente , Opc: 1 },
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
                                  $("#TablaPersona").dataTable().fnAddData([
                                        item.id,
                                        item.Nombres + ' ' + item.Apellido,
                                        item.fecha,
                                        item.Cui, 
                                        item.Dir,
                                        item.Celular,
                                        item.TelefonoResidencial,
                                        "<button type='button' id='" + item.id +  "'class='btn btn-xs btn-info BtnUpdate'><i class='glyphicon glyphicon-ok    '></i> </button> <button type='button' id='" + item.id +  "'class='btn btn-xs btn-danger BtnDelete'><i class='glyphicon glyphicon-trash'></i></button>"                                  
                                  ]);                                        
                                } 
                        });
                      },
                      error:function(){
                                        MensajesControlador('error' , 'No hay Respuesta Del Servicio' , 'topRight');
                      }
            });
       


 }


 function limpiarFormularioIngreso(){

                     document.getElementById('txtNombres').value = "";
                     document.getElementById('txtApellidos').value = "";
                     document.getElementById('txtFechaNacimiento').value = "";
                     document.getElementById('txtcui').value = "";
                     document.getElementById('direccion').value = "";
                     document.getElementById('textTel').value = "";
                     document.getElementById('TelefonoResidencial').value = "";   
 
}//FINAL limpiarFormularioIngreso



function ActualizarCliente(){


      var idCliente = document.getElementById('textid').value;
      var Nombre = document.getElementById('txtNombre').value;
      var Apellidos = document.getElementById('txtApellido').value;
      var FechaNacimiento = document.getElementById('txtFechaNacimiento').value;
      var Cui = document.getElementById('txtCui').value;
      var Direccion = document.getElementById('txtDireccion').value;
      var Movil = document.getElementById('txtCelular').value;
      var Telefono = document.getElementById('txtTelefono').value;

            $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'ActualizarCliente', Nombre : Nombre  , Apellidos: Apellidos, FechaNacimiento: FechaNacimiento, Cui: Cui, Direccion: Direccion, Telefono:Movil, TelefonoResidencial:Telefono , Cliente:  idCliente },
                      datatype: 'json',
                     type:'POST',
                     beforeSend: function () {
                            
                            document.getElementById("BtnGuardarCliente").disabled = true;
                      },
                      complete: function () {
                            
                            document.getElementById("BtnGuardarCliente").disabled = false;
                      },          
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){                               
                                          BuscarPersona();                                                
                                          $('.ModalUpdateClientes').modal('toggle');  
                                          MensajesControlador(item.type , item.value , item.posicion);
                                         $("#DropPersonas").load("../Service/DropPersonas.php");
                                          $("#DropPersonas").select2(); 

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



function BajaCliente(){
              var cliente = document.getElementById('txtClienteBaja').value;
              $.ajax({
                     url: '../Service/Ws.php',

                     data: {op :'UpdateEstado', _tabla : 'Tbl_cliente'  , _Nombre_id: 'Id_cliente', _id: cliente },
                      datatype: 'json',
                     type:'POST',
         
                      success: function(data) {
                          $.each(data, function(index, item){
                                if(item.strError=="0"){                               
                                    
                                         $('.ModalConfirmacion').modal('toggle');                               
                                          BuscarPersona();
                                          MensajesControlador(item.type , item.value , item.posicion);
                                          $("#DropColaboradores").load("../Service/DropColaboradores.php");
                                          $("#DropColaboradores").select2(); 

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

 function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    

</script>

 
