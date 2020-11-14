<?php
	//INCLUIMOS  LA  CONEXION
	require('conexion.php'); 

	$rol = $_GET['rol'];


	$consulta = "select * from tbl_modulos where id_Modulo not in (SELECT id_Modulo FROM tbl_permisos where id_Rol = '".$rol."');"; 
	$sql = mysql_query($consulta);

	echo '<option value ="0">Permisos Sin Asignar </option>';
	

	while ($row = mysql_fetch_array($sql)) {
			echo '<option value ="'.$row['id_Modulo'].'">'.$row['Nombre'].'</option>';
  	}


?>