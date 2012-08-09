<?php
  session_start();
  include("conexion2.php");
    
	if ( (!isset($_SESSION["gato"])) || (!isset($_SESSION["perro"])) )
  {    
    echo ("No fue Iniciada la Sesion");
	
    session_destroy();
		printf("<META HTTP-EQUIV='Refresh' CONTENT='2; URL=home.html'>");
		die (); 
  }//fin if (NO fue iniciada la sesión)
  
   if(isset($_POST['modificar']))
  {
    $nombre=$_POST['nombre'];
    $pasword=$_POST['pasword'];
    $email=$_POST['email'];
	$fecha=$_POST['fecha'];

    $cadenaSQL="UPDATE usuarios SET nombre='$nombre', pasword='$pasword', email='$email' ,fecha = '$fecha' WHERE  nombre = '$nombre' ";
    $query=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la actualizacion</h3>");
    unset($_POST['modificar']);
    unset($_GET['op']);
   echo "<meta http-equiv='refresh' content='0;URL=hadmin.php'>";
  }

  

  if(isset($_GET['op']) && $_GET['op']=="editar")
  {
	  //die("aki");
    $nombre=$_GET['nombre'];
     $cadenaSQL="SELECT * FROM usuarios WHERE nombre = '$nombre'";
    $query=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la consulta</h3>");
    $arreglo=mysql_fetch_assoc($query);
  }

   if(isset($_GET['op']) && $_GET['op']=="eliminar")
  {
	  //die("aqui");
    $nombre=$_GET['nombre'];
    $cadenaSQL="DELETE FROM usuarios WHERE nombre = '$nombre'";
    $query=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la eliminacion</h3>");
    echo "<meta http-equiv='refresh' content='0;URL=hadmin.php'>";
     echo "<h1>Registro ELIMINADO s... </h1>";
  }

  if(isset($_POST['buscar']))
  {
    //Recepción de datos

 $nombre="%".$_POST['nombre']."%";
    $pasword="%".$_POST['pasword']."%";
    $email="%".$_POST['email']."%";
	$fecha="%".$_POST['fecha']."%";
   

    $cadenaSQL="SELECT * FROM usuarios WHERE nombre LIKE '$nombre' AND pasword LIKE '$pasword' ";
    $query=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la consulta</h3>");

	}
 

 if(isset($_POST['registrar']))
  {
    //Recepci&oacute;n de datos
     $nombre=$_POST['nombre'];
    $pasword=$_POST['pasword'];
    $email=$_POST['email'];
	 $fecha=$_POST['fecha'];

    //Validar que no exista ese registro
    $cadenaSQL="SELECT * FROM usuarios WHERE nombre='$usuario'";
    $result=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la consulta</h3>");
    $numFilas=mysql_num_rows($result);

    if($numFilas>=1) echo "El registro ya existe";
    else {
      $cadenaSQL="INSERT INTO usuarios (nombre, pasword, email, fecha) VALUES ('$nombre', '$pasword', '$email', '$fecha')";
      $result=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la insercion</h3>");
      echo "<h1>Registro insertado... </h1>";
    }
  }

?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Calliope</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="images/favicon.gif" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/swfobject/swfobject.js"></script>
<script type="text/javascript">
var flashvars = {};
flashvars.xml = "config.xml";
flashvars.font = "font.swf";
var attributes = {};
attributes.wmode = "transparent";
attributes.id = "slider";
swfobject.embedSWF("cu3er.swf", "cu3er-container", "960", "270", "9", "expressInstall.swf", flashvars, attributes);
</script>
<style type="text/css">
.Estilo1 {color: #0000FF}
.Estilo4 {color: #000000; font-weight: bold; }
.style1 {	color: #FFFFFF;
	font-weight: bold;
}
</style>
</head>
<body>
<!--Header Begin-->
<div id="header">
  <div class="center">
    <div id="logo"><a href="#">Calliope</a></div>
    <!--Menu Begin-->
    <div id="menu">
      <ul>
      <li><a  href='logout.php'><span>Cerrar sesion</span></a></li>
        <li><a href="home2.phpl"><span>Home</span></a></li>
        <li><a class="active" href="hadmin.php"><span>Usuarios</span></a></li>
        <li><a href="egresados.php"><span>Egresados</span></a></li>
      </ul>
    </div>
    <!--Menu END-->
  </div>
</div>
<!--Header END-->
<!--Toprow Begin-->
<div id="toprow">
  <div class="center">
    <div id="cubershadow">
      <div id="cu3er-container"> <a href="http://www.adobe.com/go/getflashplayer"> <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="" /> </a> </div>
    </div>
  </div>
</div>
<!--Toprow END-->
<!--MiddleRow Begin-->
<div id="midrow">
  <div id="container"></div>
</div>
<!--MiddleRow END-->
<!--BottomRow Begin-->
<div id="bottomrow">
  <div class="textbox">
<form action="#" method="post">
      <h1>&nbsp;</h1>
  <h1>&nbsp;</h1>
      <table width="435" background="fondosabstractos017.jpg">
        <tr>
          <td colspan="3" align="center"><h1 class="style1"><span class="Estilo4">MANEJO DE USUARIOS </span></h1></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td class="style1"><span class="Estilo4">Usuario</span></td>
          <td colspan="2"><span class="Estilo4">
          <input name="nombre" type="text" id="nombre" placeholder="ADMIN"
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['nombre']; echo " readonly='readonly'";   } ?>/>
          </span></td>
        </tr>
        <tr>
          <td class="style1"><span class="Estilo4">Password</span></td>
          <td colspan="2"><span class="Estilo4">
          <input name="pasword" type="password" id="pasword" placeholder="*******" 
				 <?php if (isset($arreglo)) { echo "value='".$arreglo['pasword']."'"; } ?>/>
          </span></td>
        </tr>
        <tr>
          <td class="style1"><span class="Estilo4">Email</span></td>
          <td colspan="2"><span class="Estilo4">
          <input name="email" type="text" id="email" placeholder="admin@hotmail.com" 
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['email']; } ?> />
          </span></td>
        </tr>
        <tr>
          <td class="style1"><span class="Estilo4">Fecha</span></td>
          <td colspan="2"><span class="Estilo4">
          <input name="fecha" type="text" id="fecha" placeholder="2012/04/07" 
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['fecha']; } ?> />
          </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <?php if (isset($_GET['op'])=="editar") { ?>
          <td><input type="submit" name="modificar" id="modificar" value="Modificar"/></td>
          <?php }
         else { ?>
          <td><input type="submit" name="registrar" id="registrar" value="Registrar"/></td>
          <?php } ?>
          <td><input type="submit" name="buscar" id="buscar" value="Buscar"/></td>
          <td><input name="reset" type="reset" id="limpiar" value="Limpiar"/></td>
        </tr>
      </table>
    </form>
     <p>
      <?php if(isset($_POST['buscar'])) {?>
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>
<div  id="reporte">
      <span class="Estilo1">
      <table border="3" cellpadding="2" cellspacing="0" bordercolor="#FFFFFF" background="f.jpg">
      </p>
      </span>
    <tr>
   <th class="Estilo1">Indice</th>
   <th class="Estilo1">Nombre</th>
   <th class="Estilo1">Password</th>
   <th class="Estilo1">e-mail</th>
   <th class="Estilo1">Fecha</th>
   <th class="Estilo1"><span class="Estilo3">Eliminar<span class="Estilo3"></th>
   <th class="Estilo1">Editar</th>
</tr>
    <span class="Estilo1">
    <?php
  $conta=0;
  while($arreglo=mysql_fetch_array($query))
  {
     echo "<tr><td align='center'><span class='Estilo3'><b>".$conta++."</b></span></td>";
     echo "<td align='center'><span class='Estilo3'><b>".$arreglo['nombre']."</b></span></td>";
     echo "<td align='center'><span class='Estilo3'><b>".$arreglo['pasword']."</b></span></td>";
     echo "<td align='center'><span class='Estilo3'><b>".$arreglo['email']."</b></span></td>";
	  echo "<td align='center'><span class='Estilo3'><b>".$arreglo['fecha']."</b></span></td>";
	 echo "<td align='center'><span class='Estilo3'><a href='hadmin.php?op=eliminar&nombre=".$arreglo['nombre']."'> <img src='GetOpenContent.gif '></a></span></td>";
	  echo "<td align='center'><span class='Estilo3'><a href='hadmin.php?op=editar&nombre=".$arreglo['nombre']."'> <img src='e.jpg '></a></span></td>";
      }
  echo "</table>";
 ?>
    </span>
</div>
<?php } ?>
    
    
    
    
    
    
    
    
     <p><!--BottomRow END-->
<!--Footer Begin--></p>
<div id="footer">
  <li></li>
  <div class="foot"> <span>Calliope</span> by <a href="http://www.towfiqi.com">Towfiq I.</a> is licensed under a <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 Unported License.</a> </div>
</div>
<!--Footer END-->
</body>
</html>
