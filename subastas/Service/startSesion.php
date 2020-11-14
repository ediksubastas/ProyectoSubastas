<?php  
@session_start();

if (!$_SESSION){
 	echo '<script language = javascript>
			 
			self.location = "../";
	</script>';
}

$Usuarname = $_SESSION['Usuarname'];
$idusuario = $_SESSION['idUsuario'];
$idCliente = $_SESSION['idCliente'];
 

?>