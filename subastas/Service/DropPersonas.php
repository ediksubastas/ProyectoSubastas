<?php
	//INCLUIMOS  LA  CONEXION
	require('conexion.php'); 
	$consulta = "select Id_Cliente , concat(Nombres , ' ' , Apellidos ) as Nombres  from  tbl_Cliente where  Estado = 1;"; 
	$sql = mysql_query($consulta);

	echo '<option value ="0">Todos</option>';
	

	while ($row = mysql_fetch_array($sql)) {
			echo '<option value ="'.$row['0'].'">'.$row['1'].'</option>';
  	}


?>