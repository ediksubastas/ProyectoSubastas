<?php
	//INCLUIMOS  LA  CONEXION
	require('conexion.php'); 
	$consulta = "SELECT * FROM tbl_roles where Estado = 1 and Id_Rol != 1"; 
	$sql = mysql_query($consulta);

	echo '<option value ="0">Roles Existentes </option>';
	

	while ($row = mysql_fetch_array($sql)) {
			echo '<option value ="'.$row['Id_Rol'].'">'.$row['Nombre'].'</option>';
  	}


?>