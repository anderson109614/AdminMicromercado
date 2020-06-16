<?php
     //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$mysqli = new mysqli("btmb3qlrmuy0ckijcl3g-mysql.services.clever-cloud.com","umjuyueocaxayceh","vy2F5qFFA0clu5QN0zlj","btmb3qlrmuy0ckijcl3g"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>