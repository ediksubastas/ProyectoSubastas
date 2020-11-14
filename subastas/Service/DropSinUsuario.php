<?php
	//INCLUIMOS  LA  CONEXION
	require('conexion.php'); 
	$consulta = "select Id_cliente , concat(Nombres , ' ' , Apellidos ) as Nombres  from  tbl_cliente where Id_cliente not in (select Id_cliente from  tbl_user where Estado = 1) and Estado = 1;"; 
	$sql = mysql_query($consulta);

	echo '<option value ="0">Colaboradores Sin Usuario </option>';
	

	while ($row = mysql_fetch_array($sql)) {
			echo '<option value ="'.$row['0'].'">'.$row['1'].'</option>';
  	}


?>