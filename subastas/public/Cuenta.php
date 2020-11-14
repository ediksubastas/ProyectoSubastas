  <!-- top header -->
    <?php include("../Plantillas/Cabezera.php"); ?>
<!-- /top header -->


<!-- Menur -->
    <?php include("../Plantillas/Menu.php");


          $NoPagina = 0;

          // MENU A LA CUAL  PERTENECE LA PAGINA
          $Modulo = 6;

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
        Registro de Cuenta
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cuenta</li>
      </ol>
          </section>


    <!-- PARTE DE LA PAGINA ESENCIAL MAIN-->
      <!-- content -->
       <section class="content">
		
		 
			 		<!-- Form Element sizes -->
          <div class="box box-primary">
                  <div class="box-header with-border">
                      <h3 class="box-title">Registro de Tarjetas de Crédito y Débito</h3>
                  </div>
                  <div class="box-body">        

                    
                     <div class="box-header with-border">
                          <div class="col-xs-4">
                             <label>Banco</label>
                              <input class="form-control" id="txtBanco" type="text"  placeholder="Banco Emisor" onkeypress="return soloLetras(event)" required>
                          </div>

                         <div class="col-xs-4">
                            <label>No. Tarjeta</label>
                            <input class="form-control" id="txtNoTarjeta" type="text" placeholder="No. Tarjeta" required>
                         </div>

                      <div class="col-xs-4">
                          <label>Fecha De Vencimiento</label>
                          <input class="form-control" id="txtFechaVencimiento" type="date" placeholder="Fecha" required>
                      </div>
                    </div>

                    <div class="box-header with-border">
                          <div class="col-xs-4">
                             <label>CVV</label>
                              <input class="form-control" id="txtcvv" type="number" placeholder="Numero CVV" pattern="[0-9]{3}" required>
                          </div>

                         <div class="col-xs-4">
                            <label>Marca</label>
                            <input class="form-control" id="txtMarca" type="text" placeholder="Marca" required>
                         </div>
                    </div>


                    <div class="box-header with-border">                       
                        
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
                      <h3 class="box-title">Tarjetas Registradas</h3>
                  </div>
                  <div class="box-body">        
                                        

                          <div class="col-xs-1">
                               <button id="BtnBuscar" class="glyphicon glyphicon-serch btn  btn-success">
                               <i class='glyphicon glyphicon-serch'></i> Buscar</button>       
                          </div>                              
                      </div>            

                    <div class="box-header with-border">
                        <table  class="table TablaTarjeta"  id="TablaTarjeta" width="100%">
                               <thead>
                                  <tr>
                                     <th>Código Tarjeta</th>                                    
                                     <th>Banco</th>
                                     <th>No. Tarjeta</th>
                                     <th>Fecha Vencimiento</th>
                                     <th>Marca</th>
                                     <th>Saldo Disponible</th>
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
         $("#DropTarjetas").load("../Service/DropTarjetas.php");
         $("#DropTarjetas").select2(); 


      //EVENTOS DE LOS BOTONES  
         $("#btnGuardar").click(function(){
                GuardarNewTarjeta();
          });

         $("#btnCancelar").click(function(){
                CancelarIngreso();
          });


         $("#BtnBuscar").click(function(){
                BuscarTarjeta();
          });
 
              //PLUGIN DATATABLE 
                         
      
      $("#TablaTarjeta").dataTable({
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
                              title: 'Detalle Tarjetas Cliente.',
                               message: 'Sistema Subastas'

                            }
                            
              ]
      });


 }); //FINAL DEL DOCUMENT READY


function CancelarIngreso(){

limpiarFormularioIngreso();

}


 function GuardarNewTarjeta(){



      var Banco = document.getElementById('txtBanco').value;
      var Tarjeta = document.getElementById('txtNoTarjeta').value;
      var Fecha = document.getElementById('txtFechaVencimiento').value;
      var CVV = document.getElementById('txtcvv').value;
      var Marca = document.getElementById('txtMarca').value;
      
      
      
      
      if(!Banco || !Tarjeta || !Fecha || !CVV || !Marca ) {
        
                MensajesControlador('error' , 'Ingrese información en todos  los campos.' , 'topRight');
      }
      else{
            $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'NewTarjeta', Banco : Banco  , Tarjeta: Tarjeta, Fecha: Fecha, CVV: CVV, Marca: Marca },
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
                                          $("#DropTarjetas").load("../Service/DropTarjetas.php");
                                          $("#DropTarjetas").select2(); 

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


 function BuscarTarjeta(){
          $("#TablaTarjeta").dataTable().fnClearTable();
          //var cliente = $("#DropTarjetas").val();
      
             $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'MostrarTarjeta', idCliente : <?php $clienteactual = $_SESSION['idCliente']; echo $clienteactual; ?> , Opc: 1 },
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
                                  $("#TablaTarjeta").dataTable().fnAddData([
                                        item.id,
                                        item.Banco,
                                        item.Tarjeta,
                                        item.Fecha, 
                                        item.Marca,
                                        item.Saldo,                                  
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

                     document.getElementById('txtBanco').value = "";
                     document.getElementById('txtNoTarjeta').value = "";
                     document.getElementById('txtFechaVencimiento').value = "";
                     document.getElementById('txtcvv').value = "";
                     document.getElementById('txtMarca').value = "";
 
}//FINAL limpiarFormularioIngreso

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

 
