<?php
$nombre_del_servidor='localhost';
$nombre_de_usuario='root';
$password='';
$baseDatos='egresados';

$dbcon=mysql_connect($nombre_del_servidor, $nombre_de_usuario, $password) or die('Error en la conexion');
mysql_select_db($baseDatos,$dbcon) or die ('Error al selecionar la bd');
?>