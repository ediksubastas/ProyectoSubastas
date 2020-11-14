<!-- top header -->
    <?php include("../Plantillas/Cabezera.php"); ?>
<!-- /top header -->


<!-- Menu -->
    <?php include("../Plantillas/Menu.php"); ?>
<!-- /Menu -->

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
          <section class="content-header">
      <h1>
        Principal
        <small>Resumen</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
          <section class="content">
      <!-- Info boxes -->
      
      <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Subastas Activas</span>
              <span class="info-box-number" id="txtSubastasAC"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>  


            <div class="info-box-content">
              <span class="info-box-text">Vehículos Disp.</span>
              <span class="info-box-number" id="txtve"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-flag-o"></i></span>


            <div class="info-box-content">
              <span class="info-box-text">Subastas Participacion</span>
              <span class="info-box-number" id="txtSubastasPar"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
      <!-- /.row -->
    </section>
          </section>


<!-- END PAGE -->
    <?php include("../Plantillas/Footer.php"); ?>
<!-- /END PAGE -->

 <script type="text/javascript">
  $( document ).ready(function() {
      MuestraDeIndicadores();

  }); //FINAL DOCUMENT READY.


    function MuestraDeIndicadores(){
 
         $.ajax({
                     url: '../Service/Ws.php',
                     data: {op :'MuestraDeIndicadores'},
                      datatype: 'json',
                     type:'POST',
          
                      success: function(data) {
                          $.each(data, function(index, item){
                                $('#txtSubastasAC').text(item.Sactivas);
                                $('#txtve').text(item.vdispo);
                                $('#txtSubastasPar').text(item.Sparticipantes);
                                                                
                          });
                      },
                      error:function(){
                                        MensajesControlador('error' , 'No hay Respuesta Del Servicio' , 'topRight');
                      }
            }); //FINAL AJAX.
           
    }//FINAL DE LA FUNCION  DE  GUARDAR USUARIO

</script>
 
