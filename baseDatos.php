<?php
class MYSQL{
static public function conecta(){

    

$usuario="omorales";
$passwd='salermo';
$servidor='10.2.2.32';


/*
$usuario="omorales";
$passwd='wolf3333';
$servidor='localhost';
*/

mysql_connect($servidor,$usuario,$passwd); 
//mysql_query ("SET NAMES 'utf8'");
} //cierra funcion 



static public function basedatos(){
return $basedatos='sima';
}//cierra funcino
}

?>