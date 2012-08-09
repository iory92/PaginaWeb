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
  $matricula=$_POST['matricula'];
  $nombre=$_POST['nombre'];
  $carrera=$_POST['carrera'];
  $promedio=$_POST['promedio'];
  $mail=$_POST['mail'];
  $celular=$_POST['celular'];
  $titulo=$_POST['titulo'];
  $trabajo=$_POST['trabajo'];

    $cadenaSQL="UPDATE datos SET matricula='$matricula', nombre='$nombre', carrera='$carrera', promedio='$promedio', mail='$mail' ,celular = '$celular',titulo = '$titulo',trabajo = '$trabajo' WHERE  matricula = '$matricula' ";
    $query=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la actualizacion</h3>");
    unset($_POST['modificar']);
    unset($_GET['op']);
   echo "<meta http-equiv='refresh' content='0;URL=egresados.php'>";
  }

  

   if(isset($_GET['op']) && $_GET['op']=="editar")
  {
	  //die("aki");
    $matricula=$_GET['matricula'];
     $cadenaSQL="SELECT * FROM datos WHERE matricula = '$matricula'";
    $query=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la consulta</h3>");
    $arreglo=mysql_fetch_assoc($query);
  }

   if(isset($_GET['op']) && $_GET['op']=="eliminar")
  {
	  //die("aqui");
    $matricula=$_GET['matricula'];
    $cadenaSQL="DELETE FROM datos WHERE matricula = '$matricula'";
    $query=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la eliminacion</h3>");
    echo "<meta http-equiv='refresh' content='0;URL=egresados.php'>";
     echo "<h1>Registro ELIMINADO s... </h1>";
  }

  if(isset($_POST['buscar']))
  {
    //Recepción de datos
$matricula="%".$_POST['matricula']."%";
  $nombre="%".$_POST['nombre']."%";
  $carrera="%".$_POST['carrera']."%";
  $promedio="%".$_POST['promedio']."%";
 
  $celular="%".$_POST['celular']."%";
  $titulo="%".$_POST['titulo']."%";
  $trabajo="%".$_POST['trabajo']."%";
 
   

    $cadenaSQL="SELECT * FROM datos WHERE matricula LIKE '$matricula' ";
    $query=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la consulta</h3>");

	}
 

 if(isset($_POST['registrar']))
  {
    //Recepci&oacute;n de datos
	$matricula=$_POST['matricula'];
  $nombre=$_POST['nombre'];
  $carrera=$_POST['carrera'];
  $promedio=$_POST['promedio'];
  $mail=$_POST['mail'];
  $celular=$_POST['celular'];
  $titulo=$_POST['titulo'];
  $trabajo=$_POST['trabajo'];
    

    //Validar que no exista ese registro
    $cadenaSQL="SELECT * FROM datos WHERE  matricula=$matricula";
    $result=mysql_query($cadenaSQL,$dbcon) or die("<h3>Error en la consulta</h3>");
    $numFilas=mysql_num_rows($result);

    if($numFilas>=1) echo "El registro ya existe";
    else {
	  $cadenaSQL="INSERT INTO datos (matricula, nombre, carrera, promedio, mail, celular, titulo, trabajo) VALUES ('$matricula', '$nombre', '$carrera', '$promedio', '$mail', '$celular', '$titulo', '$trabajo')";
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
        <li><a href="hadmin.php"><span>Usuarios</span></a></li>
        <li><a class="active"  href="egresados.php"><span>Egresados</span></a></li>
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
          <td colspan="3" align="center"><h1 class="Estilo4">MANEJO DE USUARIOS </h1></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td class="Estilo4">Matricula</td>
          <td colspan="2"><input name="matricula" type="text" id="matricula" placeholder="200600"
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['matricula']; echo " readonly='readonly'";   } ?>/></td>
        </tr>
        <tr>
          <td class="Estilo4">Nombre</td>
          <td colspan="2"><input name="nombre" type="text" id="nombre" placeholder="armando" 
				 <?php if (isset($arreglo)) { echo "value='".$arreglo['nombre']."'"; } ?>/></td>
        </tr>
        <tr>
          <td class="Estilo4">Carrera</td>
          <td colspan="2"><input name="carrera" type="text" id="carrera" placeholder="admin@hotmail.com" 
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['carrera']; } ?> /></td>
        </tr>
        <tr>
          <td class="Estilo4">Promedio</td>
          <td colspan="2"><input name="promedio" type="text" id="promedio" placeholder="2012/04/07" 
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['promedio']; } ?> /></td>
        </tr>
        <tr>
          <td class="Estilo4">E-mail</td>
          <td colspan="2"><input name="mail" type="text" id="mail" placeholder="2012/04/07" 
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['mail']; } ?> /></td>
        </tr>
        <tr>
          <td class="Estilo4">Celular</td>
          <td colspan="2"><input name="celular" type="text" id="celular" placeholder="2012/04/07" 
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['celular']; } ?> /></td>
        </tr>
        <tr>
          <td class="Estilo4">Titulo</td>
          <td colspan="2"><input name="titulo" type="text" id="titulo" placeholder="2012/04/07" 
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['titulo']; } ?> /></td>
        </tr>
        <tr>
          <td class="Estilo4">Trabajo</td>
          <td colspan="2"><input name="trabajo" type="text" id="trabajo" placeholder="2012/04/07" 
				 <?php if (isset($arreglo)) { echo "value=".$arreglo['trabajo']; } ?> /></td>
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
   <th class="Estilo1">Matricula</th>
   <th class="Estilo1">Nombre</th>
   <th class="Estilo1">Carrera</th>
   <th class="Estilo1">Promedio</th>
      <th class="Estilo1">E-mail</th>
   <th class="Estilo1">Celular</th>   
   <th class="Estilo1">Titulo</th>
   <th class="Estilo1">Trabajo</th>
   
   <th class="Estilo1"><span class="Estilo3">Eliminar<span class="Estilo3"></th>
   <th class="Estilo1">Editar</th>
</tr>
    <span class="Estilo1">
    <?php
  $conta=0;
  while($arreglo=mysql_fetch_array($query))
  {
     echo "<tr><td align='center'><span class='Estilo3'><b>".$conta++."</b></span></td>";
     echo "<td align='center'><span class='Estilo3'><b>".$arreglo['matricula']."</b></span></td>";
     echo "<td align='center'><span class='Estilo3'><b>".$arreglo['nombre']."</b></span></td>";
     echo "<td align='center'><span class='Estilo3'><b>".$arreglo['carrera']."</b></span></td>";
	  echo "<td align='center'><span class='Estilo3'><b>".$arreglo['promedio']."</b></span></td>";
	  echo "<td align='center'><span class='Estilo3'><b>".$arreglo['mail']."</b></span></td>";
	  echo "<td align='center'><span class='Estilo3'><b>".$arreglo['celular']."</b></span></td>";
	  echo "<td align='center'><span class='Estilo3'><b>".$arreglo['titulo']."</b></span></td>";
	  echo "<td align='center'><span class='Estilo3'><b>".$arreglo['trabajo']."</b></span></td>";
	 echo "<td align='center'><span class='Estilo3'><a href='egresados.php?op=eliminar&matricula=".$arreglo['matricula']."'> <img src='GetOpenContent.gif '></a></span></td>";
	 
	  echo "<td align='center'><span class='Estilo3'><a href='egresados.php?op=editar&matricula=".$arreglo['matricula']."'> <img src='e.jpg '></a></span></td>";
      }
  echo "</table>";
 ?>
    </span>
</div>
<?php } ?>
    
    
    
    
    
    
    
    
     <p><!--BottomRow END-->
<!--Footer Begin--></p>
<div id="footer">
   <li><a href='logout.php'><img src='c.gif' width="119" /></a></li>
  <div class="foot"> <span>Calliope</span> by <a href="http://www.towfiqi.com">Towfiq I.</a> is licensed under a <a href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 Unported License.</a> </div>
</div>
<!--Footer END-->
</body>
</html>
