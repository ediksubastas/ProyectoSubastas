  <?php
      require("conexion.php");
   

  	if (isset($_POST["op"]) && !empty($_POST["op"]))
  	{
          
   
  		$action = $_POST["op"];
  			switch($action){


                    // ############  MODULOS DEL SISTEMA   ############  \\
                   case 'ValidarUsuario': Login($_POST['Username'] , $_POST['Password']); break;
                   case 'NewRol': GuardarRol($_POST['Descripcion'] ); break;
                   case 'UpdatePermiso': GuardarPermisos($_POST['Mod'], $_POST['Acc'] ); break;                           
                   case 'MostrarPermisos': MostrarPermisos($_POST['rol'] ); break;                           
                   case 'MuestraDeIndicadores': MuestraDeIndicadores(); break; 
                                           
                   case 'DeletePermiso': DeletePermiso($_POST['Permiso'] ); break;    
                   case 'Update': UpdateGeneral($_POST['_tabla']  , $_POST['_Nombre_id']  , $_POST['_id']  , $_POST['_Campo']  , $_POST['_dato']   ); break;


                   case 'UpdatePassword': UpdatePassword($_POST['Password'] , $_POST['NewPassword']); break;
                   case 'MostrarUsuarios': MostrarUsuarios($_POST['idUsuario'] ); break;
                   case 'GuardarUsuario': InsertarUsuario($_POST['Usuario'] , $_POST['Password'], $_POST['cliente'], $_POST['Rol']); break; 

             

                  // ############  MODULOS DE CLIENTES ############  \\
                   case 'NewCliente': GuardarCliente($_POST['Nombre'],$_POST['Apellidos'],$_POST['FechaNacimiento'],$_POST['Cui'], $_POST['Direccion'],$_POST['Movil'],$_POST['Telefono']); break;

                   case 'NewTarjeta': GuardarTarjeta($_POST['Banco'],$_POST['Tarjeta'],$_POST['Fecha'],$_POST['CVV'], $_POST['Marca']); break;

                   case 'MostrarPersona': MostrarPersona($_POST['idCliente'], $_POST['Opc']   ); break;  

                   case 'MostrarTarjeta': MostrarTarjeta($_POST['idCliente'], $_POST['Opc']   ); break;  

                   case 'ActualizarCliente': UpdateDatosCliente($_POST['Nombre'], $_POST['Apellidos'] , $_POST['Cui'] , $_POST['Direccion'] , $_POST['Telefono'] , $_POST['TelefonoResidencial'] , $_POST['Cliente']    ); break; 

                   case 'UpdateEstado': UpdateEstado($_POST['_tabla']  , $_POST['_Nombre_id']  , $_POST['_id']); break;
         
  		}
  	}


          

            /**
              * Verifica si existe un usuario dentro de la base de  datos y si este  esta  activo
              *      Crea la sesion de usuario.
              *      
              * @return Un arreglo tipo json con un true si  existe el usuario. (Exis 1 || 0) 
              * @param string $Username usuario asignado en el sistema
              * @param string $Password clave para ingresar al  sistema
            */	

       function Login($Username , $Password  ){
         
         $datos = new datos();

         $varPassword = md5($Password);
          $consulta = "select Id_Usuario , User  , Avatar , Id_Rol , Id_Cliente from tbl_user where  User = '".$Username."' and Pasword = '".$varPassword."' and Estado = 1;";                
   
          $sql = mysql_query($consulta);

              if ($row = mysql_fetch_array($sql)){ 
                  if($row == 0){
                          $return[] = array('strError' => '0', 'Exis' => '0', "value" =>  'Datos incorrectos Por favor Verifique sus credenciales.' , "type" => 'error', "posicion" => 'topRight');
                          $datos->retornaJson($return);  
                      }

                  else {
                          $return[] = array('strError' => '0', 'Exis' => '1');
                          session_start();
                          $_SESSION['idUsuario'] = $row['Id_Usuario'];
                          $_SESSION['Usuarname'] = $row['User'];
                          $_SESSION['Avatar'] = $row['Avatar'];
                          $_SESSION['Rol'] = $row['Id_Rol'];
                          $_SESSION['idCliente'] = $row['Id_Cliente'];                        

                          $datos->retornaJson($return);  

                  }
                 
              }
              else{
                   $return[] = array('strError' => '1',  'Exis' => '0' ,"value" => 'Datos incorrectos por favor verifique sus credenciales.' , "type" => 'error', "posicion" => 'topRight');
                   $datos->retornaJson($return);
              }            

      }  



      // #################### FUNCION PARA GUARDAR UN NUEVO ROL ####################################
            /**
              * Funcion que nos sirve  para  guardar un nuevo Rol dentro del  sistema
              *                         *      
              * @return Un arreglo tipo json con un true si en caso se presento un error y un false si  todo paso sin novedad.
              * @param string $Descripcion nombre del nuevo Rol
            */    
      

         function GuardarRol( $Descripcion ){
              
              $datos = new datos();
              $datos->startTransaction();

              $consulta = "INSERT INTO tbl_roles (Nombre, Estado) VALUES ( '".$Descripcion."', '1');";

              $sql = mysql_query($consulta);

                          if($sql){
                                     $return[] = array('strError' => '0', "value" => 'Ingreso Realizado Exitosamente.', "type" => 'success', "posicion" => 'topRight' );
                                     $datos->commit();    
                                     $datos->retornaJson($return);
                          }

                          else{
                              $return[] = array('strError' => '1', "value" =>  mysql_error() , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  

      } 


      // #################### FUNCION PARA GUARDAR PERMISOS DE UN  ROL ####################################
            /**
              * Funcion que nos sirve  para  guardar permisos de un Rol dentro del  sistema
              *                         
              * @return Un arreglo tipo json con un true si en caso se presento un error y un false si  todo paso sin novedad.
              * @param int $Mod idModulo
              * @param int $Acc idPermiso (Tabla Acciones en modelo e-r)
            */    
      

         function GuardarPermisos( $Mod ,  $Acc ){
              
              $datos = new datos();
              $datos->startTransaction();

              $consulta = "INSERT INTO tbl_permisos ( Id_Modulo , Id_Rol) VALUES ( '".$Mod."', '".$Acc."');";

              $sql = mysql_query($consulta);

                          if($sql){
                                     $return[] = array('strError' => '0', "value" => 'Ingreso Realizado Exitosamente.', "type" => 'success', "posicion" => 'topRight'  );
                                     $datos->commit();    
                                     $datos->retornaJson($return);
                          }

                          else{
                              $return[] = array('strError' => '1', "value" =>  mysql_error() , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  

      }    


      #####################  FUNCION PARA LISTAR LAS ACCIONES  ASIGNADAS AL ROL ##########################
          /**
              * Funcion que nos sirve  para  Mostrar permisos de un Rol dentro del  sistema
              *                         
              * @return Un arreglo tipo json con lo datos de la consulta idpermiso , moduloNombre
              * @param int $rol  variable que representa el id de un rol
              * 
            */   
       
             function  MostrarPermisos($rol) 
            {
               
              $datos = new datos();
   
              $consulta = "SELECT per.id_permiso  , m.Nombre FROM tbl_modulos m  inner  join  tbl_permisos per   on per.Id_Modulo  =  m.id_modulo  where per.Id_Rol = '".$rol."';";
   
                          
              $sql = mysql_query($consulta);
              $total = mysql_num_rows($sql);

              if($total > 0){
                  while ($row = mysql_fetch_array($sql)){
                     
                      $return[] = array(
                              
                              "Nombre"=>$row['Nombre'],
                              "id"=>$row['id_permiso']
                      );

                  
                  }
                  $datos->retornaJson($return); 


              }   

              else{
                              $return[] = array('strError' => '0', "value" =>  'No Hay Permisos Relacionados Con 
                                  Este Rol.', "type" => 'error', "posicion" => 'topRight');
                              $datos->retornaJson($return);  

              }               
      }

      // #################### FUNCION PARA BORRAR PERMISO  DE UN  ROL ####################################
          /**
              * Funcion que nos sirve  para  Mostrar permisos de un Rol dentro del  sistema
              *                         
              * @return Un arreglo tipo json con lo datos de la consulta idpermiso , moduloNombre
              * @param int $rol  variable que representa el id de un rol
              * 
            */      
      

         function DeletePermiso($Permiso ){
              
              $datos = new datos();
              $datos->startTransaction();

              $consulta = "delete from tbl_permisos where  id_permiso = '".$Permiso."'";

              $sql = mysql_query($consulta);

                          if($sql){
                                     $return[] = array('strError' => '0', "value" => 'Ingreso Realizado Exitosamente.', "type" => 'success', "posicion" => 'topRight'  );
                                     $datos->commit();    
                                     $datos->retornaJson($return);
                          }

                          else{
                              $return[] = array('strError' => '1', "value" =>  mysql_error() , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  

      }


      ########################### FUNCION PARA  DAR DE ACTUALIZAR  GENERAL ######################
      /**
          * Funcion que nos sirve  para  cambiar de estado de un registra ACIVO / INACTIVO
          * @return Un arreglo tipo json con un true si en caso se presento un error y un false si  todo paso sin novedad.
          * @param int $_tabla  variable que representa de la tabla  con la  cual trabajaremos
          * @param int $_Nombre_id  Nombre del  id que actualizaremos 
          * @param int $_id  identificador unico del o los registros
          * @param int $_campo nombre  del campo con el  cual se  modificara el dato
          * @param int $_dato que tendra el nuevo valor 
          * 
      */
           
      function UpdateGeneral($_tabla , $_Nombre_id , $_id , $_Campo  ,  $_dato ){


              $datos = new datos();
              $datos->startTransaction();

              $consulta = "update  ".$_tabla." set ".$_Campo." = '".$_dato ."' where ".$_Nombre_id."  =  '".$_id."' ";

              

              $sql = mysql_query($consulta);

                          if($sql){
                                     

                                     $return[] = array('strError' => '0', "value" => "Actualizacion Exitosa.", "type" => 'success', "posicion" => 'topRight'  );                              
                                     $datos->commit();    
                                     $datos->retornaJson($return);
                          }

                          else{
                              $return[] = array('strError' => '1', "value" =>  mysql_error() , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  

      }




      ########################### FUNCION PARA  DAR DE BAJA  GENERAL ######################
      /**
          * Funcion que nos sirve  para  cambiar de estado de un registra ACIVO / INACTIVO
          * @return Un arreglo tipo json con un true si en caso se presento un error y un false si  todo paso sin novedad.
          * @param int $_tabla  variable que representa de la tabla  con la  cual trabajaremos
          * @param int $_Nombre_id  Nombre del  id que actualizaremos 
          * @param int $_id  identificador unico del o los registros
          * 
      */
           
      function UpdateEstado($_tabla , $_Nombre_id , $_id ){


              $datos = new datos();
              $datos->startTransaction();

              $consulta = "update  ".$_tabla." set Estado = 0 where ".$_Nombre_id."  =  '".$_id."' ";

              $sql = mysql_query($consulta);

                          if($sql){
                                     $return[] = array('strError' => '0', "value" => 'Eliminación Realizada Exitosamente.', "type" => 'success', "posicion" => 'topRight'  );
                                     $datos->commit();    
                                     $datos->retornaJson($return);
                          }

                          else{
                              $return[] = array('strError' => '1', "value" =>  mysql_error() , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  

      }


      
                
  // #################### FUNCION PARA GUARDAR UN NUEVO CLIENTE ####################################
            /**
              * Funcion que nos sirve  para  guardar un nuevo colaborador dentro del  sistema
              *                         *      
              * @return Un arreglo tipo json con un true si en caso se presento un error y un false si  todo paso sin novedad.
              * @param string $Nombre nombre del nuevo Cliente
              * @param string $Apellidos del nuevo Cliente
              * @param date $FechaNacimiento del nuevo Cliente
              * @param int $Cui del nuevo Cliente
              * @param int $Movil del nuevo Cliente
              * @param int $Telefono del nuevo Cliente
            
            */    
      

         function GuardarCliente( $Nombre,$Apellidos,$FechaNacimiento,$Cui,$Direccion,$Movil,$Telefono ){
              
              $datos = new datos();
              $datos->startTransaction();

      
              $consulta= "INSERT INTO tbl_cliente (Nombres, Apellidos, Fecha_Nacimiento, Cui, Direccion, Telefono, TelefonoResidencial) VALUES ('$Nombre', '$Apellidos', '$FechaNacimiento', '$Cui', '$Direccion', '$Movil', '$Telefono');";
              $sql = mysql_query($consulta);


                          if($sql){
                                     $return[] = array('strError' => '0', "value" => 'Ingreso Realizado Exitosamente.', "type" => 'success', "posicion" => 'topRight' );
                                     $datos->commit();    
                                     $datos->retornaJson($return);
                          }

                          else{
                              $return[] = array('strError' => '1', "value" =>   $consulta , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  

      }     

      function GuardarTarjeta( $Banco,$Tarjeta,$Fecha,$CVV,$Marca){
              
              $datos = new datos();
              $datos->startTransaction();

      
              $consulta= "INSERT INTO tbl_tarjeta (Nombre_Banco, No_Tarjeta, Fecha_Vencimiento, CVV, Marca_Tarjeta, Id_Cliente) VALUES ('$Banco', '$Tarjeta', '$Fecha', '$CVV', '$Marca', '1');";
              $sql = mysql_query($consulta);


                          if($sql){
                                     $return[] = array('strError' => '0', "value" => 'Ingreso Realizado Exitosamente.', "type" => 'success', "posicion" => 'topRight' );
                                     $datos->commit();    
                                     $datos->retornaJson($return);
                          }

                          else{
                              $return[] = array('strError' => '1', "value" =>   $consulta , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  

      }     




  // ########## FUNCION PARA MOSTRAR LOS EMPLEADOS HABILITADOS DENTRO DEL SISTEMA   ##########################
            /**
              * Funcion que nos sirve  para  Mostrar los colaboradores Bien sea con filtro o todos
              *                         *      
              * @return Un arreglo tipo json con un los datos de los empleados 
              * @param string $idColaborador nombre del nuevo Empleado

            
            */       

       function  MostrarPersona($idCliente  , $Opc){
               
              $datos = new datos();
   
              if($Opc == 1 ){
                  $consulta = "select  Id_Cliente, Nombres, Apellidos, date_format(Fecha_Nacimiento, '%d-%m-%Y') as Fecha, Cui, Direccion, Telefono, TelefonoResidencial     from  tbl_cliente where   Estado = 1 and   (Id_Cliente = '$idCliente' or '$idCliente' = '%');";
              }else{
                  $consulta = "select Id_Cliente, Nombres, Apellidos, date_format(Fecha_Nacimiento, '%d-%m-%Y') as Fecha, Cui, Direccion, Telefono, TelefonoResidencial    from  tbl_cliente where   Estado = 1 and   (Id_Cliente = ".$idCliente.");";
              }
   
                          
              $sql = mysql_query($consulta);
              $total = mysql_num_rows($sql);

              if($total > 0){
                  while ($row = mysql_fetch_array($sql)){
                     
                      $return[] = array(
                              
                              "id"=>$row['0'],
                              "Nombres"=>$row['1'],
                              "Apellido"=>$row['2'],
                              "fecha"=>$row['3'],
                              "Cui"=>$row['4'],
                              "Dir"=>$row['5'],
                              "Celular"=>$row['6'],
                              "TelefonoResidencial"=>$row['7']
                      );

                  
                  }
                  $datos->retornaJson($return); 


              }   

              else{
                              $return[] = array('strError' => '0', "value" =>  'No hay Colaboradores Ingresados.', "type" => 'error', "posicion" => 'topRight');
                              $datos->retornaJson($return);  

              }               
      }


  // ########## FUNCION PARA MOSTRAR LOS EMPLEADOS HABILITADOS DENTRO DEL SISTEMA   ##########################
            /**
              * Funcion que nos sirve  para  Mostrar los colaboradores Bien sea con filtro o todos
              *                         *      
              * @return Un arreglo tipo json con un los datos de los empleados 
              * @param string $idColaborador nombre del nuevo Empleado

            
            */       

       function  MostrarTarjeta($idCliente  , $Opc){
               
              $datos = new datos();
   
              if($Opc == 1 ){
                  $consulta = "select t.Id_Tarjeta, t.Nombre_Banco, t.No_Tarjeta, t.Fecha_Vencimiento, t.Marca_Tarjeta, c.Saldo_Actual from  tbl_tarjeta t inner join tbl_cuenta c on t.Id_Tarjeta=c.Id_Tarjeta where t.Id_Cliente=".$idCliente."";
              }else{
                  $consulta = "select t.Id_Tarjeta, t.Nombre_Banco, t.No_Tarjeta, t.Fecha_Vencimiento, t.Marca_Tarjeta, c.Saldo_Actual from  tbl_tarjeta t inner join tbl_cuenta c on t.Id_Tarjeta=c.Id_Tarjeta where t.Id_Cliente=".$idCliente."";
              }
   
                          
              $sql = mysql_query($consulta);
              $total = mysql_num_rows($sql);

              if($total > 0){
                  while ($row = mysql_fetch_array($sql)){
                     
                      $return[] = array(
                              
                              "id"=>$row['0'],
                              "Banco"=>$row['1'],
                              "Tarjeta"=>$row['2'],
                              "Fecha"=>$row['3'],
                              "Marca"=>$row['4'],
                              "Saldo"=>$row['5'],
                      );

                  
                  }
                  $datos->retornaJson($return); 


              }   

              else{
                              $return[] = array('strError' => '0', "value" =>  'No hay tarjetas registradas.', "type" => 'error', "posicion" => 'topRight');
                              $datos->retornaJson($return);  

              }               
      }


      ########################### FUNCION PARA ACTUALIZAR  CAMPOS DE DE LOS CLIENTES ######################
      /**
          * Funcion que nos sirve  para  cambiar de estado de un registra ACIVO / INACTIVO
          * @return Un arreglo tipo json con un true si en caso se presento un error y un false si  todo paso sin novedad.
          * @param int $Nombre  variable que representa de la tabla  con la  cual trabajaremos
          * @param int $Apellidos  Nombre del  id que actualizaremos 
          * @param int $_id  identificador unico del o los registros
          * @param int $_campo nombre  del campo con el  cual se  modificara el dato
          * @param int $_dato que tendra el nuevo valor 
          * 
      */
           
      function UpdateDatosCliente($Nombre , $Apellidos , $Cui , $Direccion  ,  $Telefono , $TelefonoResidencial , $Cliente ){


              $datos = new datos();
              $datos->startTransaction();

              $consulta = "UPDATE tbl_cliente SET Nombres='$Nombre', Apellidos='$Apellidos ', Cui='$Cui', Direccion='$Direccion', Telefono='$Telefono', TelefonoResidencial='$TelefonoResidencial' WHERE Id_Cliente='$Cliente';";

              

              $sql = mysql_query($consulta);

                          if($sql){
                                     

                                     $return[] = array('strError' => '0', "value" => "Actualizacion Exitosa.", "type" => 'success', "posicion" => 'topRight'  );                              
                                     $datos->commit();    
                                     $datos->retornaJson($return);
                          }

                          else{
                              $return[] = array('strError' => '1', "value" =>  mysql_error() , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  

      }




      ########################### FUNCION PARA  ACTUALIZAR  EL PASSWORD DE UN USUARIO ######################
      /**
          * Funcion que nos sirve  para  actualizar el password de un usuario.
          * @return Un arreglo tipo json con un true si en caso se presento un error y un false si  todo paso sin novedad.
          * @param int $usuario  variable que representa el id del usuario.

          * 
      */
           
      function UpdatePassword($Password , $NewPassword){
                             
         $datos = new datos();
         $varPassword = md5($Password);
         $varPasswordN = md5($NewPassword);
         include('startSesion.php');

          $consulta = "select * from tbl_user where Id_Usuario = ".$idusuario." and Pasword = '".$varPassword."' and Estado = 1;";        
         
         $sql = mysql_query($consulta);

         if ($row = mysql_fetch_array($sql)){ 

                  if($row['Pasword'] == $varPassword){
                       $datos->startTransaction();

                      $consulta = "UPDATE tbl_user SET Pasword= '".$varPasswordN."'  where Id_Usuario=".$idusuario.";";
                         
                      $sql = mysql_query($consulta);

                      if($sql){
                               $return[] = array('strError' => '0', "value" => "Actualizacion Exitosa.", "type" => 'success', "posicion" => 'topRight'  );                              
                               $datos->commit();    
                               $datos->retornaJson($return);
                      }else{

                              $return[] = array('strError' => '1', "value" =>  mysql_error() , "type" => 'error', "posicion" => 'topRight');
                              $datos->rollback();
                              $datos->retornaJson($return);

                          }  


                  }else{
                              $return[] = array('strError' => '1', "value" =>  'No Coincide el password actual' , "type" => 'error', "posicion" => 'topRight');                             
                              $datos->retornaJson($return);

                  }
         }else{
                              $return[] = array('strError' => '1', "value" =>  'No Coincide el password actual' , "type" => 'error', "posicion" => 'topRight');                             
                              $datos->retornaJson($return);        
         }

      }


      function InsertarUsuario($Usuario , $Password , $cliente , $Rol){

        $datos = new datos();
        $datos->startTransaction();

        $Cifrado = md5($Password);

   

         $StrInsert = mysql_query("INSERT INTO tbl_user (User, Pasword, Estado, Id_Cliente, Id_Rol, Avatar , Fecha_Creacion) VALUES ('".$Usuario."', '".$Cifrado."', '1', '".$cliente."', '".$Rol."', 'dist/img/avatar5.png' , date(now()));");


         if($StrInsert){
                      $return[] = array('strError' => '0', "value" => "Usuario Creado Exitosamente.", "type" => 'success', "posicion" => 'topRight'  );                              
                      $datos->commit();    
                      $datos->retornaJson($return);
         }else{
                      $return[] = array('strError' => '1', "value" =>  'Error, valide los datos ingresados' , "type" => 'error', "posicion" => 'topRight');                             
                      $datos->rollback();
                      $datos->retornaJson($return);            

         }
    }



  // ########## FUNCION PARA MOSTRAR LOS EMPLEADOS HABILITADOS DENTRO DEL SISTEMA   ##########################
            /**
              * Funcion que nos sirve  para  Mostrar los colaboradores Bien sea con filtro o todos
              *                         *      
              * @return Un arreglo tipo json con un los datos de los empleados 
              * @param string $idColaborador nombre del nuevo Empleado

            
            */       

       function  MostrarUsuarios($idUsuario){
               
              $datos = new datos();
   
              
               $consulta = "select U.id_Usuario ,  U.User as Usuario, date_Format(U.Fecha_Creacion, '%d/%m/%Y') as FechaCreacion, concat(e.Nombres , ' ' , e.Apellidos) as Cliente  , R.Nombre as Rol from tbl_user U inner join tbl_cliente e on e.Id_cliente =  U.Id_cliente inner join  tbl_roles  r on  r.Id_Rol =  U.Id_Rol where U.Estado = 1 and  U.Id_Rol != 1 and  (U.id_Usuario  = '$idUsuario' or '$idUsuario' = '%');";
              
            
   
                          
              $sql = mysql_query($consulta);
              $total = mysql_num_rows($sql);

              if($total > 0){
                  while ($row = mysql_fetch_array($sql)){
                     
                      $return[] = array(
                              
                              "id"=>$row['0'],
                              "username"=>$row['1'],
                              "Fecha"=>$row['2'],
                              "Cliente"=>$row['3'],
                              "Rol"=>$row['4']
                      );

                  
                  }
                  $datos->retornaJson($return); 


              }   

              else{
                              $return[] = array('strError' => '0', "value" =>  'No hay Usuarios Ingresados.', "type" => 'error', "posicion" => 'topRight');
                              $datos->retornaJson($return);  

              }               
      }  


     
            
      function DetermminarMes($mesNombre){
      
          switch ($mesNombre) {
            case "Enero":
                   return 1;
            break;
            case "Febrero":
                  return 2;
            break;
            case "Marzo":
                  return 3;
            break;
            case "Abril":
                  return 4;
            break;
            case "Mayo":
                  return 5;
            break;
            case "Junio":
                  return 6;
            break;
              case "Julio":
                  return 7;
            break;
              case "Agosto":
                  return 8;
            break;
              case "Septiembre":
                  return 9;
            break;
              case "Octubre":
                  return 10;
            break;
              case "Noviembre":
                  return 11;
            break;
              case "Diciembre":
                  return 12;
            break;
          }



      }

      function MuestraDeIndicadores(){
        $datos = new datos();
        $SubastasA = 0;
        $Vdisponibles = 0;
        $SubastasP = 0;
           

           $consulta = "select count(*)  as SubastasA from tbl_subasta where Estado=1;";
           $sql = mysql_query($consulta);

           if($row = mysql_fetch_array($sql)){
                  $SubastasA = $row['SubastasA'];
                  
            }

          $consulta = "select count(*)  as SubastasA from tbl_subasta where Estado=1;";
           $sql = mysql_query($consulta);

           if($row = mysql_fetch_array($sql)){
                  $Vdisponibles = $row['SubastasA'];
                  
            }

           $consulta = "select count(*)  as SubastasA from tbl_subasta where Estado=1;";
           $sql = mysql_query($consulta);

           if($row = mysql_fetch_array($sql)){
                  $SubastasP = $row['SubastasA'];
                  
            }

        $return[] = array('Sactivas' => $SubastasA, 'vdispo' =>  $Vdisponibles, 'Sparticipantes' =>  $SubastasP);
        $datos->retornaJson($return);  

      }

      //FUNCION  PARA QUITAR  COMAS  DESDE  PHP 
      function stripAccents($string){
                           return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
                          'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
      }



  ?>


