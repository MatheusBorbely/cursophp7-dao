<?php 

require_once("config.php");



$usuarios = new Usuario();

/*
chamando um usuario especifico
$usuarios->loadById(3);

 echo $usuarios;
*/
 /*
 listando todos usuarios
 $lista = Usuario::getList();

 echo json_encode($lista);
*/
$usuarios->login("sa", "09090");

echo $usuarios
 ?>