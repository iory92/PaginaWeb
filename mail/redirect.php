<?php
session_start();
  include("conexion2.php");
  $nombre=$_POST['nombre'];
	$pasword=$_POST['pasword'];
		
	if ( empty($nombre) || empty($pasword))
	{
	   echo "Introduce todos los datos";
	   printf("<META HTTP-EQUIV='Refresh' CONTENT='2; URL=index.htm'>");
		 session_destroy();
		 die();
	}
	
	 $cadenaSQL="SELECT * FROM usuarios WHERE nombre = '$nombre' AND pasword = '$pasword'";
  $result=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la consulta</h3>");
	$numFilas=mysql_num_rows($result);
	

    if($numFilas>=1) {
	   if ($nombre == "admin" OR $nombre =="admin"){
	   $_SESSION['gato']=$nombre;
	   $_SESSION['perro']=$pasword;
	   printf("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=hadmin.php'>");
	   }
	   else{
	   $_SESSION['gato']=$nombre;
	   $_SESSION['perro']=$pasword;
	    printf("<META HTTP-EQUIV='Refresh' CONTENT='0; URL=home.php'>");
	    }
	 
	
	}
    else {
	echo " <h3>Usuario no encontrado</h3>";
     
    }
 
 

?>