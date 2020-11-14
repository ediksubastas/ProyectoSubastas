	<?php
	//INCLUIMOS  LA  CONEXION
	require('conexion.php'); 

	
	$consulta = "select id_cliente , No_Tarjeta as Nombre from tbl_tarjeta where Id_Cliente= 1"; 
	$sql = mysql_query($consulta);


	echo '<option value ="0">Todos</option>';

	while ($row = mysql_fetch_array($sql)) {
			echo '<option value ="'.$row['0'].'">'.$row['1'].'</option>';
  	}

?>