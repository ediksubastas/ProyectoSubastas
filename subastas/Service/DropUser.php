<?php
	//INCLUIMOS  LA  CONEXION
	require('conexion.php'); 
	$consulta = "SELECT * FROM tbl_user where Estado = 1 and Id_Rol != 1 "; 
	$sql = mysql_query($consulta);

	echo '<option value ="0">Todos</option>';
	

	while ($row = mysql_fetch_array($sql)) {
			echo '<option value ="'.$row['0'].'">'.$row['1'].'</option>';
  	}


?>