  <!-- MENU -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" id="menu">
        <div class="pull-left image">
          <img src="<?php   $Avatar = $_SESSION['Avatar'];  echo $Avatar ;  ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info ">
         <p> <?php   $usuario = $_SESSION['Usuarname'];  echo $usuario ;  ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Activo</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>
        <li class="active treeview">
 
        </li>

    
        <!-- CARGAMOS LOS MODULOS LOS  CUALES  TIENE HABILITADO EL  USUARIO -->
              <?php 
               require ("../Service/conexion.php");
              $Rol = $_SESSION['Rol'];
              
               $consulta = "SELECT m.id_Modulo , m.Nombre , m.HtmlEncabezado ,  m.HtmlFin 
                         FROM tbl_permisos per
                         inner  join tbl_modulos m  on per.Id_Modulo  =  m.id_modulo
                         where  per.Estado = 1 and per.Id_Rol = '".$Rol."' order by Prioridad; ";
            
            $sql = mysql_query($consulta);

            while ($row = mysql_fetch_array($sql)){
                
                  echo $row['HtmlEncabezado'];

                      $Acciones = "select * from tbl_acciones where Id_Modulos = '".$row['id_Modulo']."' ;";

                         $sqlAcciones = mysql_query($Acciones);
                                            while ($rowDetalles = mysql_fetch_array($sqlAcciones)){
                                                  echo '<li>';
                                                      echo '<a href="../Public/'.$rowDetalles['NombreArchivo'].'"">';
                                                        echo '<i class="'.$rowDetalles['class'].'"></i>';
                                                          echo $rowDetalles['Descripcion'];
                                                        echo '</a>';
                                                  echo "</li>";                                                  
                                              } 




                  echo $row['HtmlFin'];
                


            }

          ?>

        <!-- CARGAMOS LOS MODULOS LOS  CUALES  TIENE HABILITADO EL  USUARIO -->









      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

 