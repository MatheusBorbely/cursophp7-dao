<?php 

require_once("config.php");



$usuarios = new Usuario();

$usuarios->loadById(3);

echo $usuarios;


 ?>